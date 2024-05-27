<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;
use App\Models\Survey;
use App\Models\SurveyImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use Illuminate\Support\Facades\Log;
use App\Services\OcrService;
use App\Services\ZeroBounceService;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Services\NumverifyService;

class LeadController extends Controller
{
    protected $ocrService;
    protected $zeroBounceService;
    protected $numverifyService;

    public function __construct(OcrService $ocrService, ZeroBounceService $zeroBounceService, NumverifyService $numverifyService)
    {
        $this->ocrService = $ocrService;
        $this->zeroBounceService = $zeroBounceService;
        $this->numverifyService = $numverifyService;

        $this->middleware('permission:create leads', ['only' => ['create', 'store']]);
        $this->middleware('permission:read leads', ['only' => ['index', 'show']]);
        $this->middleware('permission:update leads', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete leads', ['only' => ['destroy']]);
    }

    public function verifyPhoneNumber(Request $request)
    {
        $request->validate([
            'phone_number' => 'required',
        ]);

        $phoneNumber = $request->input('phone_number');
        $verificationResult = $this->numverifyService->verifyPhoneNumber($phoneNumber);

        return response()->json($verificationResult);
    }

    public function index(Request $request)
    {
        $status = $request->query('status', 'open'); // Defaults to 'open' if not specified
        $leads = Lead::when($status, function ($query, $status) {
            return $query->where('status', $status);
        })->get();
    
        $statuses = ['open', 'contacted', 'qualified', 'unqualified']; // Define as needed
    
        return view('leads.index', [
            'leads' => $leads,
            'statuses' => $statuses,
            'selectedStatus' => $status
        ]);
    }

    public function create()
    {
        $rules = [
            'salutation' => 'required',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email',
            'phone_number' => 'required|max:255',
            'kota' => 'nullable|max:255',
            'provinsi' => 'nullable|max:255',
            'address' => 'nullable',
            'fishery_address' => 'nullable',
            'fishery_lat' => 'nullable|numeric',
            'fishery_lng' => 'nullable|numeric',
            'NIK' => 'nullable|digits_between:1,20',
            'NPWP' => 'nullable|digits_between:1,20',
            'status' => 'required',
            'source' => 'required',
            'survey_description' => 'required',
            'survey_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'ktp_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    
        return view('leads.create', compact('rules'));
    }

    public function store(Request $request)
    {
        // Validate input
        $validatedData = $request->validate([
            'salutation' => 'required',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email',
            'phone_number' => 'required|max:255',
            'kota' => 'nullable|max:255',
            'provinsi' => 'nullable|max:255',
            'address' => 'nullable',
            'fishery_address' => 'nullable',
            'fishery_lat' => 'nullable|numeric',
            'fishery_lng' => 'nullable|numeric',
            'NIK' => 'nullable|digits_between:1,20',
            'NPWP' => 'nullable',
            'status' => 'required',
            'source' => 'required',
            'survey_description' => 'required',
            'survey_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'ktp_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Verify email using ZeroBounce API
        $emailVerification = $this->zeroBounceService->verifyEmail($request->input('email'));
        \Log::info('Email Verification Result:', $emailVerification); // Log the result for debugging

        $validatedData['email_valid'] = isset($emailVerification['status']) && $emailVerification['status'] == 'valid' ? true : false;

        // Validate phone number using Numverify API
        $phoneNumberVerification = $this->numverifyService->verifyPhoneNumber($request->input('phone_number'));
        \Log::info('Phone Number Verification Result:', $phoneNumberVerification); // Log the result for debugging

        $validatedData['phone_valid'] = isset($phoneNumberVerification['valid']) && $phoneNumberVerification['valid'] ? true : false;


        // Handle KTP image upload
        if ($request->hasFile('ktp_image')) {
            $path = $request->file('ktp_image')->store('ktp_images', 'public');
            $validatedData['ktp_image'] = Storage::url($path);
        }

        // Proceed with storing lead data
        $validatedData['created_by'] = auth()->id();
        $lead = Lead::create($validatedData);
        $survey = $lead->survey()->create(['description' => $request->input('survey_description')]);

        // Handle survey images
        if ($request->hasFile('survey_images')) {
            foreach ($request->file('survey_images') as $file) {
                if ($file->isValid()) {
                    $path = $file->store('surveys', 'public');
                    $survey->images()->create(['image_path' => Storage::url($path)]);
                } else {
                    return back()->withErrors('Uploaded file is not valid.');
                }
            }
        }

        $lead->updateScore();
        return redirect()->route('leads.show', $lead->id)
                         ->with('success', 'Lead and Survey created successfully.');
    }

    public function show($id)
    {
        // Fetch the lead along with the related survey and survey images
        $lead = Lead::with(['survey.images'])->findOrFail($id);
        $leadScore = $lead->score; // Retrieve the lead's score
    
        // Pass the lead and leadScore to the view
        return view('leads.show', compact('lead', 'leadScore'));
    }

    public function edit($id)
    {
        $lead = Lead::findOrFail($id);
        return view('leads.edit', compact('lead'));
    }
    public function update(Request $request, $id)
    {
        try {
            Log::info("Update method called for lead: $id");
            Log::info("Request Data:", $request->all());
    
            // Validate input
            $validatedData = $request->validate([
                'salutation' => 'required',
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'email' => 'required|email',
                'phone_number' => 'required|max:255',
                'kota' => 'nullable|max:255',
                'provinsi' => 'nullable|max:255',
                'address' => 'nullable',
                'fishery_address' => 'nullable',
                'fishery_lat' => 'nullable|numeric',
                'fishery_lng' => 'nullable|numeric',
                'NIK' => 'nullable|digits_between:1,20',
                'NPWP' => 'nullable|digits_between:1,20',
                'status' => 'required',
                'source' => 'required',
                'survey_description' => 'required',
                'survey_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'ktp_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
    
            Log::info("Validated Data:", $validatedData);
    
            // Find the lead
            $lead = Lead::findOrFail($id);
            Log::info("Found Lead:", $lead->toArray());
    
            // Handle KTP image upload
            if ($request->hasFile('ktp_image')) {
                $path = $request->file('ktp_image')->store('ktp_images', 'public');
                $validatedData['ktp_image'] = Storage::url($path);
                Log::info("KTP Image uploaded to:", ['path' => $validatedData['ktp_image']]);
            }
    
            // Handle survey description update or creation
            if ($lead->survey) {
                $lead->survey->update(['description' => $validatedData['survey_description']]);
            } else {
                $lead->survey()->create(['description' => $validatedData['survey_description']]);
            }
    
            // Handle survey images
            if ($request->hasFile('survey_images')) {
                foreach ($request->file('survey_images') as $file) {
                    if ($file->isValid()) {
                        $path = $file->store('surveys', 'public');
                        $lead->survey->images()->create(['image_path' => Storage::url($path)]);
                        Log::info("Survey Image uploaded to:", ['path' => Storage::url($path)]);
                    } else {
                        Log::error("Invalid survey image file.");
                        return back()->withErrors('Uploaded file is not valid.');
                    }
                }
            }
    
            // Update the lead with validated data
            $lead->update($validatedData);
            Log::info("Updated Lead Data:", $lead->fresh()->toArray());
    
            // Update the score after lead is updated
            $lead->updateScore();
            Log::info("Updated Lead Score:", ['score' => $lead->score]);
    
            return redirect()->route('leads.show', $lead->id)->with('success', 'Lead updated successfully!');
        } catch (\Exception $e) {
            Log::error("Error updating lead: " . $e->getMessage());
            Log::error($e->getTraceAsString());
            return back()->withErrors('An error occurred while updating the lead. Please try again.');
        }
    }
    
    
    
    public function destroy($id)
    {
        $lead = Lead::findOrFail($id);
        $lead->delete();
        return redirect()->route('leads.index')->with('success', 'Lead deleted successfully');
    }

    public function approvalIndex()
    {
        // Fetch leads that require approval and are in the 'open' or 'contacted' statuses
        $leads = Lead::whereIn('status', ['open', 'contacted'])->get();
    
        // The 'score' attribute is directly accessible as it's a column in your leads table
        return view('approvals.index', compact('leads'));
    }
    
    public function approve($id)
    {
        DB::transaction(function () use ($id) {
            $lead = Lead::findOrFail($id);
            $lead->update(['status' => 'qualified']);

            // Create a customer from the lead data
            $customerData = $lead->only(['first_name', 'last_name', 'email', 'phone_number', 'kota', 'provinsi', 'address', 'NIK', 'NPWP', 'fishery_address', 'fishery_lat', 'fishery_lng']);
            $customerData['name'] = $lead->first_name . ' ' . $lead->last_name; // Assuming you want a full name in one column for Customer
            $customerData['assigned_to'] = $lead->created_by; // Assign the lead creator as the customer's assigned user
            $customerData['phone'] = $lead->phone_number; // Assuming you want to store the phone number in one column for Customer
            $customerData['address'] = $lead->address ?? ''; // Assuming you want to store the address in one column for Customer

            Customer::create($customerData);
        });

        return redirect()->route('lead.approvals.index')->with('success', 'Lead has been qualified and converted to customer successfully.');
    }

    public function disapprove($id)
    {
        $lead = Lead::findOrFail($id);
        $lead->update(['status' => 'unqualified']);

        return redirect()->route('lead.approvals.index')->with('error', 'Lead has been marked as unqualified.');
    }

    private function generateToken()
    {
        $accessKey = 'bd939c5c0c98155d';
        $secretKey = 'dd7c2578085629f8';
        $timestamp = round(microtime(true) * 1000); // Current timestamp in milliseconds
        $signature = hash('sha256', $accessKey . $secretKey . $timestamp);

        $response = Http::post('https://api.advance.ai/openapi/auth/ticket/v1/generate-token', [
            'accessKey' => $accessKey,
            'timestamp' => $timestamp,
            'signature' => $signature,
            'periodSecond' => 3600 // Token validity in seconds
        ]);

        return $response->json();
    }

    public function ocrKtp(Request $request)
    {
        $request->validate([
            'ktp_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Generate token
        $tokenResponse = $this->generateToken();
        if ($tokenResponse['code'] !== 'SUCCESS') {
            return response()->json(['error' => 'Failed to generate access token.'], 500);
        }

        $accessToken = $tokenResponse['data']['token'];
        $imagePath = $request->file('ktp_image')->path();

        $client = new \GuzzleHttp\Client();
        try {
            $response = $client->post('https://api.advance.ai/openapi/face-recognition/v3/ocr-ktp-check', [
                'headers' => [
                    'X-ACCESS-TOKEN' => $accessToken,
                ],
                'multipart' => [
                    [
                        'name' => 'ocrImage',
                        'contents' => fopen($imagePath, 'r'),
                        'filename' => $request->file('ktp_image')->getClientOriginalName()
                    ]
                ]
            ]);

            $responseData = json_decode($response->getBody()->getContents(), true);
            return response()->json($responseData);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error processing OCR request.'], 500);
        }
    }

    public function verifyEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);
    
        $email = $request->input('email');
        $emailDomain = substr(strrchr($email, "@"), 1);
    
        if ($emailDomain === 'gmail.com') {
            $verificationResult = [
                'status' => 'valid',
                'email' => $email,
            ];
        } else {
            $verificationResult = [
                'status' => 'invalid',
                'email' => $email,
            ];
        }
    
        return response()->json($verificationResult);
    }
    
}
