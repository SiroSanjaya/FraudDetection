<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Lead;
use App\Models\Survey;
use App\Models\SurveyImage;
use Illuminate\Support\Facades\Storage;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leads = Lead::all();
        return view('leads.index', ['leads' => $leads]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('leads.create');
    }
    
    /**
     * Store a newly created resource in storage.
     * Includes lead score update after creation.
     */
    public function store(Request $request)
    {
        // debug
        \Log::info($request->all());
        

        $validatedData = $request->validate([
            'salutation' => 'required',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email',
            'phone_number' => 'nullable|max:255',
            'kota' => 'nullable|max:255',
            'provinsi' => 'nullable|max:255',
            'address' => 'nullable',
            'NIK' => 'nullable|digits_between:1,20',
            'NPWP' => 'nullable|digits_between:1,20',
            'status' => 'required',
            'source' => 'required',
            'survey_description' => 'required',
            'survey_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $lead = Lead::create($validatedData);
        $survey = $lead->survey()->create(['description' => $request->input('survey_description')]);
        
        // Check if the survey images are uploaded
        if ($request->hasfile('survey_images')) {
            foreach ($request->file('survey_images') as $file) {
                \Log::info("File is valid: " . $file->isValid());
                \Log::info("File original name: " . $file->getClientOriginalName());
                \Log::info("File type: " . $file->getClientMimeType());
                if ($file->isValid()) {
                    $path = $file->store('surveys', 'public');
                    $survey->images()->create([
                        'image_path' => Storage::url($path)
                    ]);
                } else {
                    \Log::error("Uploaded file is not valid.");
                    return back()->withErrors('Uploaded file is not valid.');
                }
            }
        }
        \Log::info($request->hasFile('survey_images'));

        $lead->updateScore();  // Update score after lead is created
        return redirect()->route('leads.index')->with('success', 'Lead and Survey created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Fetch the lead along with the related survey and survey images
        $lead = Lead::with(['survey.images'])->findOrFail($id);
        $leadScore = $lead->score; // Retrieve the lead's score
    
        // Pass the lead and leadScore to the view
        return view('leads.show', compact('lead', 'leadScore'));
    }
    
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $lead = Lead::findOrFail($id);
        return view('leads.edit', compact('lead'));
    }

    /**
     * Update the specified resource in storage.
     * Includes lead score update after update.
     */
    public function update(Request $request, $id)
    {
        \Log::info("Update method called for lead: $id");
        \Log::info("Request Data:", $request->all());

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'nullable',
            'kota' => 'required',
            'provinsi' => 'required',
            'address' => 'nullable',
            'NIK' => 'nullable',
            'NPWP' => 'nullable',
            'status' => 'required',
            'source' => 'required',
        ]);

        $lead = Lead::findOrFail($id);
        $lead->update($request->all());
        $lead->updateScore();  // Update score after lead is updated

        return redirect()->route('leads.show', $lead->id)->with('success', 'Lead updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Additional implementation needed if you decide to use this function
    }
    
}
