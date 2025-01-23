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
        $years=Year::all();
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
        $acquisition_assistant = AcquisitionAssistant::where('id', $id)->get();
    $districts = District::all();
    $talukas = Taluka::all();
    $villages = Village::all();
    $sr_nos = SrNo::all();
    $land_acquisitions = Land_Acquisition::all();
    $years = Year::all();

    return view('acquisition_assistants.show', compact(
        'acquisition_assistant', 'districts', 'talukas', 'villages', 'sr_nos', 'land_acquisitions', 'years'
    ));
}


    public function edit($id)
    {

        // Fetch the AcquisitionAssistant by ID
        $acquisitionAssistant = AcquisitionAssistant::find($id);
        $districts = District::all(); // Fetch districts
        $talukas = Taluka::all(); // Fetch talukas
        $villages = Village::all(); // Fetch villages
        $sr_nos = SrNo::all(); // Fetch selection numbers
        $land_acquisitions = Land_Acquisition::all(); // Fetch land acquisitions
        $years = Year::all();

        // Check if the acquisitionAssistant exists
        if (!$acquisitionAssistant) {

            return redirect()->route('acquisition_assistant.edit')->with('error', 'Record not found.');
        }

        // Pass the data to the view
        return view('acquisition_assistants.edit', compact('acquisitionAssistant','districts', 'talukas', 'villages', 'sr_nos', 'land_acquisitions', 'years'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAcquisitionAssistantRequest $request, AcquisitionAssistant $acquisition_assistant)
    {
        try {
            DB::beginTransaction();

            // Validate and log input
            $input = $request->validated();

            // Handle special cases for fields
            if (isset($input['survey_or_group']) && is_array($input['survey_or_group'])) {
                $input['survey_or_group'] = implode(',', $input['survey_or_group']);
            }

            if (isset($input['number']) && is_array($input['number'])) {
                $input['number'] = $input['number'][0];
            }

            if (isset($input['area']) && is_array($input['area'])) {
                $input['area'] = $input['area'][0];
            }

            // Log filtered data for update
            $fillableData = Arr::only($input, AcquisitionAssistant::getFillables());

            // Perform the update
            $acquisition_assistant->update($fillableData);

            // Commit transaction
            DB::commit();

            // \Log::info('Acquisition Assistant Updated Successfully:', $acquisition_assistant->toArray());

            // Fetch all acquisition assistants to pass to the view
            $acquisition_assistants = AcquisitionAssistant::all(); // Adjust this as needed

            // Return success response
            return redirect()->route('acquisition_assistants.index')->with('message', 'Acquisition Assistant updated successfully!');
        } catch (\Exception $e) {
            // Log error and rollback
            DB::rollBack();
            // \Log::error('Update Error:', ['error' => $e->getMessage()]);

            return redirect()->route('acquisition_assistant.index')->with('error', 'Record not updated.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
 public function destroy(AcquisitionAssistant $acquisition_assistant)
{
    try
    {
        // Check if the record exists before deleting
        if (!$acquisition_assistant) {
            return response()->json(['error' => 'Record not found'], 404);
        }

        // Start transaction
        DB::beginTransaction();

        // Attempt to delete the record (soft delete if SoftDeletes is used)
        $acquisition_assistant->delete();

        // Commit transaction
        DB::commit();

        // Return success response and redirect to the index route
        return redirect()->route('acquisition_assistant.index')->with('success', 'Acquisition Assistant deleted successfully!');
    }
    catch(\Exception $e)
    {
        // Log the error message for debugging
        // \Log::error('Error deleting AcquisitionAssistant: ' . $e->getMessage());

        // Rollback in case of error
        DB::rollBack();

        // Return a more detailed error response
        return response()->json(['error' => 'Failed to delete the AcquisitionAssistant', 'message' => $e->getMessage()], 500);
    }
}

}


