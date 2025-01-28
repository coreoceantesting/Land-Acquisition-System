<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AcquisitionAssistant;

use App\Models\District;
use App\Models\Taluka;
use App\Models\Village;
use App\Models\Srno;
use App\Models\Land_Acquisition;
use App\Models\AcquisitionAssistantSize;
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
        $records = AcquisitionAssistant::with(['district', 'taluka', 'village', 'year','sr_no', 'land_acquisition'])->paginate(10);

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


        $acquisitionAssistantSizes = AcquisitionAssistantSize::all(); // Adjust if you need specific data

        return view('acquisition_assistants.create',compact('districts','talukas','villages','sr_nos','land_acquisitions','years','acquisitionAssistantSizes'));

    }

    public function store(StoreAcquisitionAssistantRequest $request)
    {
        try {
            DB::beginTransaction();

            // $input = $request->validated();


            $acquisition_assistant = AcquisitionAssistant::create($request->all());
            // dd($request->all());

            foreach ($request->survey_or_group as $index => $surveyOrGroup) {

                $number = $request->number[$index];
                $area = $request->area[$index];


                AcquisitionAssistantSize::create([
                    'acquisition_assistant_id' => $acquisition_assistant->id,
                    'survey_or_group' => $surveyOrGroup,
                    'number' => $number,
                    'area' => $area,
                ]);
            }
            // return($request);

            // Commit the transaction
            DB::commit();

            // Return success response
            return response()->json([
                'success' => 'Acquisition Assistant created successfully!',
                'data' => $acquisition_assistant,
            ]);
        } catch (\Exception $e) {
            // Rollback the transaction if anything goes wrong
            DB::rollBack();

            // Log the exception for debugging (optional but useful)

            // Return an error response
            return response()->json([
                'error' => 'An error occurred while creating the Acquisition Assistant.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }




    // In your AcquisitionAssistantController.php
    public function show($id)
    {

        try {
            // Fetch the Acquisition Assistant and its related data
            $acquisitionAssistant = AcquisitionAssistant::findOrFail($id);
            // $records = AcquisitionAssistant::with(['district', 'taluka', 'village', 'year','sr_no', 'land_acquisition'])->paginate(10);

            // Fetch related Acquisition Assistant Sizes
            $acquisitionAssistantSizes = AcquisitionAssistantSize::where('acquisition_assistant_id', $id)->get();

            // Fetch other related data (for dropdowns, etc.)
            $districts = District::all();
            $talukas = Taluka::all();
            $villages = Village::all();
            $sr_nos = Srno::all();
            $land_acquisitions = Land_Acquisition::all();
            $years = Year::all();

            // Return the show view with the data
            return view('acquisition_assistants.show', compact(
                'acquisitionAssistant',
                'acquisitionAssistantSizes',
                'districts',
                'talukas',
                'villages',
                'sr_nos',
                'land_acquisitions',
                'years'
            ));
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred while fetching the Acquisition Assistant.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }



public function edit($id)
{
    try {
        // Attempt to fetch the record by ID
        $acquisitionAssistant = AcquisitionAssistant::findOrFail($id);

        // Fetch additional data for the edit form
        $districts = District::all();
        $talukas = Taluka::all();
        $villages = Village::all();
        $sr_nos = Srno::all();
        $land_acquisitions = Land_Acquisition::all();
        $years = Year::all();
        $acquisitionAssistantSizes = AcquisitionAssistantSize::where('acquisition_assistant_id', $id)->get();

        // Return the edit view with the data
        return view('acquisition_assistants.edit', compact('acquisitionAssistant', 'districts', 'talukas', 'villages', 'sr_nos', 'land_acquisitions', 'years', 'acquisitionAssistantSizes'));
    } catch (\Exception $e) {
        // In case of error, catch the exception and show a message
        return response()->json([
            'error' => 'An error occurred while fetching the Acquisition Assistant for editing.',
            'message' => $e->getMessage(),
        ], 500);
    }
}


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAcquisitionAssistantRequest $request, $id)
    {

        try {
            DB::beginTransaction();

            // Find the AcquisitionAssistant to update
            $acquisitionAssistant = AcquisitionAssistant::find($id);

            // Validate the request data
            // $validated = $request->validated();

            // Update the AcquisitionAssistant record
            $acquisitionAssistant->update($request->all());

            // Update or create associated AcquisitionAssistantSize records
            foreach ($request->survey_or_group as $index => $surveyOrGroup) {
                $number = $request->number[$index];
                $area = $request->area[$index];

                AcquisitionAssistantSize::updateOrCreate(
                    ['acquisition_assistant_id' => $acquisitionAssistant->id, 'survey_or_group' => $surveyOrGroup],
                    ['number' => $number, 'area' => $area]
                );
            }

            // Commit the transaction
            DB::commit();
            // return($request);

            // Redirect to the show page with a success message
            return redirect()->route('acquisition_assistant.pending', $acquisitionAssistant->id)
                             ->with('success', 'Acquisition Assistant updated successfully!');
        } catch (\Exception $e) {
            // Rollback if any exception occurs
            DB::rollBack();

            // Log or handle the exception if necessary
            return response()->json([
                'error' => 'An error occurred while updating the Acquisition Assistant.',
                'message' => $e->getMessage(),
            ], 500);
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
        return redirect()->route('acquisition_assistant.pending')->with('success', 'Acquisition Assistant deleted successfully!');
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


public function approve(Request $request,$id)
{
//  dd($request);
    $acquisitionAssistant = AcquisitionAssistant::find($id);

    if(!$acquisitionAssistant)
    {
        return redirect()->back()->with('error', 'Item not found.');
    }

    $acquisitionAssistant->acquisition_officer_status = 1; // Approve
    $acquisitionAssistant->acquisition_officer_remark = $request->input('remark');
    $acquisitionAssistant->save();

    return redirect()->route('acquisition_assistant.approved')->with('message', 'Item approved successfully.');
}

public function reject(Request $request,$id)
{
    // dd('dsfdg');
    $acquisitionAssistant = AcquisitionAssistant::find($id);

    if (!$acquisitionAssistant) {
        return redirect()->back()->with('error', 'Item not found.');
    }
    $acquisitionAssistant->acquisition_officer_status = 2; // Reject
    $acquisitionAssistant->acquisition_officer_remark = $request->input('remark');

    // Add remark
    $acquisitionAssistant->save();

    return redirect()->route('acquisition_assistant.rejected')->with('message', 'Item rejected successfully.');
}

public function pending()
{
    $records = AcquisitionAssistant::with(['district', 'taluka', 'village', 'year','sr_no', 'land_acquisition'])->where('acquisition_officer_status', 0)->paginate(10);

    $acquisition_assistants = AcquisitionAssistant::all();
    return view('acquisition_assistants.pending', compact('acquisition_assistants','records'));
}

public function land_acquisition()
{
    $records = AcquisitionAssistant::with(['district', 'taluka', 'village', 'year','sr_no', 'land_acquisition'])->whereIn('acquisition_proposal', [1,2])->paginate(10);

    $acquisition_assistants = AcquisitionAssistant::all();
    return view('acquisition_assistants.land_acquisition', compact('acquisition_assistants','records'));
}
public function approved()
{
    $records = AcquisitionAssistant::with(['district', 'taluka', 'village', 'year','sr_no', 'land_acquisition'])->where('acquisition_officer_status', 1)->paginate(10);

        $acquisition_assistants = AcquisitionAssistant::all();
        return view('acquisition_assistants.approved', compact('acquisition_assistants','records'));
}

public function rejected()
{
//  dd('sdff');
    $records = AcquisitionAssistant::with(['district', 'taluka', 'village', 'year','sr_no', 'land_acquisition'])->where('acquisition_officer_status', 2)->paginate(10);

    $acquisition_assistants = AcquisitionAssistant::where('acquisition_officer_status', 2)->get(); // 2 for rejected status
    return view('acquisition_assistants.rejected', compact('acquisition_assistants', 'records'));
}



}


