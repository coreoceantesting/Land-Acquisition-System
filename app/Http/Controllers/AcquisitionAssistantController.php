<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AcquisitionAssistantController extends Controller
{
    public function create()
    {
        // Sample data for dropdown options
        $districts = ['District 1', 'District 2', 'District 3'];
        $talukas = ['Taluka 1', 'Taluka 2', 'Taluka 3'];
        $villages = ['Village 1', 'Village 2', 'Village 3'];
        $yearOptions = ['2020', '2021', '2022'];
        $purposeOptions = ['Acquisition', 'Development', 'Other'];

        return view('acquisition_assistant.create', compact('districts', 'talukas', 'villages', 'yearOptions', 'purposeOptions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'district' => 'required',
            'taluka' => 'required',
            'village' => 'required',
            'sr_no' => 'required',
            'purpose' => 'required',
            'project_name' => 'required|string',
            'year' => 'required',
            'mandal_name' => 'required|string',
            'details' => 'nullable|string',
            'designation' => 'required',
            'proposal_status' => 'required',
            'law' => 'required',
            'survey_or_group' => 'required',
            'survey_number' => 'required|numeric',
            'area' => 'required|numeric',
        ]);

        // Store the data (you could use a database or session for simplicity)
        // For example, save to session or a database model

        return redirect()->route('acquisition_assistant.create')->with('success', 'Land Acquisition Form submitted successfully.');
    }
}
