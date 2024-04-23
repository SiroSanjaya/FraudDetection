<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;

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
        ]);

        $lead = Lead::create($validatedData);
        $lead->updateScore();  // Update score after lead is created

        return redirect()->route('leads.index')->with('success', 'Lead added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $lead = Lead::findOrFail($id);
        $leadScore = $lead->score; // Retrieve the lead's score
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
