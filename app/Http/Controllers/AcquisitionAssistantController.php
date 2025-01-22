<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AcquisitionAssistant;

use App\Models\District;
use App\Models\Taluka;
use App\Models\Village;
use App\Models\Srno;
use App\Models\Land_Acquisition;
use App\Models\Year;
use App\Http\Requests\Assistant\StoreAcquisitionAssistantRequest;
use App\Http\Requests\Assistant\UpdateAcquisitionAssistantRequest;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

// use App\Http\Requests\Assistant\UpdateAcquisitionAssistantRequest;
// use GuzzleHttp\Psr7\Message;

class AcquisitionAssistantController extends Controller
{
    public function index()
    {
        $records = AcquisitionAssistant::with(['district', 'taluka', 'village', 'year', 'land_acquisition'])->paginate(10);

        $acquisition_assistants = AcquisitionAssistant::all();
        return view('acquisition_assistants.index', compact('acquisition_assistants','records'));
    }
    public function create()
{
    $districts = District::all();
    $talukas = Taluka::all();
    $villages = Village::all();
    $sr_nos = Srno::all();
    $land_acquisitions=Land_Acquisition::all();
    $years=year::all();
    return view('acquisition_assistants.create',compact('districts','talukas','villages','sr_nos','land_acquisitions','years'));

}
public function store(StoreAcquisitionAssistantRequest $request)
{
    try {
    //    dd($request->all());
        DB::beginTransaction();

        // Validate and filter input
        $input = $request->validated();
        if (isset($input['survey_or_group']) && is_array($input['survey_or_group'])) {
            $input['survey_or_group'] = implode(',', $input['survey_or_group']); // or json_encode($input['survey_or_group'])
        }

        if (isset($input['number']) && is_array($input['number'])) {
            $input['number'] = $input['number'][0]; // Take the first value
        }

        if (isset($input['area']) && is_array($input['area'])) {
            $input['area'] = $input['area'][0]; // Take the first value
        }

        // Create the acquisition assistant
        $acquisition_assistant = AcquisitionAssistant::create(Arr::only($input, AcquisitionAssistant::getFillables()));

        DB::commit();

        // Return success response
        return response()->json([
            'success' => 'Acquisition Assistant created successfully!',
            'data' => $acquisition_assistant,
        ]);
    } catch (\Exception $e) {
        DB::rollBack();

        return response()->json([
            'error' => 'An error occurred while creating the Acquisition Assistant.',
            'message' => $e->getMessage(),
        ], 500);
    }
}



// In your AcquisitionAssistantController.php
public function show($id)
{
    // Fetch the AcquisitionAssistant by ID
    $acquisitionAssistant = AcquisitionAssistant::find($id);

    // Check if the acquisitionAssistant exists
    if (!$acquisitionAssistant) {
        return response()->json(['result' => 0, 'message' => 'Record not found.'], 404);
    }

    // Return the acquisitionAssistant data in JSON format
    return response()->json([
        'result' => 1,
        'acquisition_assistant' => $acquisitionAssistant
    ]);
}


public function edit($id)
{
    // Fetch the AcquisitionAssistant by ID
    $acquisitionAssistant = AcquisitionAssistant::find($id);

    // Check if the acquisitionAssistant exists
    if (!$acquisitionAssistant) {
        return redirect()->route('acquisition_assistant.index')->with('error', 'Record not found.');
    }

    // Pass the data to the view
    return view('acquisition_assistants.edit', compact('acquisitionAssistant'));
}
/**
 * Update the specified resource in storage.
 */
public function update(UpdateAcquisitionAssistantRequest $request, AcquisitionAssistant $acquisition_assistant)
{
    try
    {
        DB::beginTransaction();
        $input = $request->validated();
        $acquisition_assistant->update( Arr::only( $input, AcquisitionAssistant::getFillables() ) );
        DB::commit();

        return response()->json(['success'=> 'Ward updated successfully!']);
    }
    catch(\Exception $e)
    {
        return $this->respondWithAjax($e, 'updating', 'AcquisitionAssistant');
    }
}

/**
 * Remove the specified resource from storage.
 */
public function destroy(AcquisitionAssistant $acquisition_assistant)
{
    try
    {
        DB::beginTransaction();
        $acquisition_assistant->delete();
        DB::commit();

        return response()->json(['success'=> 'AcquisitionAssistant deleted successfully!']);
    }
    catch(\Exception $e)
    {
        return $this->respondWithAjax($e, 'deleting', 'AcquisitionAssistant');
    }
}
}


