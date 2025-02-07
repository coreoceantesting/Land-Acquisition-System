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
use App\Models\AcquisitionRegister;
use App\Models\Designation;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

// use App\Http\Requests\Assistant\UpdateAcquisitionAssistantRequest;
// use GuzzleHttp\Psr7\Message;

class AcquisitionAssistantController extends Controller
{
    public function index()
    {

        $records = AcquisitionAssistant::with(['district', 'taluka', 'village', 'year', 'sr_no', 'land_acquisition'])->latest()->where('user_id', Auth::user()->id)->paginate(10);

        $acquisition_assistants = AcquisitionAssistant::all();

        return view('acquisition_assistants.index', compact('acquisition_assistants', 'records'));
    }

    public function create()
    {
        $districts = District::all();
        $talukas = Taluka::all();
        $villages = Village::all();
        $sr_nos = Srno::all();
        $land_acquisitions = Land_Acquisition::all();
        $years = Year::all();
        $designations = Designation::all();


        $acquisitionAssistantSizes = AcquisitionAssistantSize::all();

        return view('acquisition_assistants.create', compact('districts', 'talukas', 'villages', 'sr_nos', 'designations', 'land_acquisitions', 'years', 'acquisitionAssistantSizes'));
    }

    public function store(StoreAcquisitionAssistantRequest $request)
    {

        try {
            DB::beginTransaction();

            $request['is_userdiff'] = Auth::user()->roles[0]->id ?? null;
            $request['user_id'] = Auth::user()->id;
            $input = $request->validated();
            $input['land_acquisition_id'] = Land_Acquisition::where('land_acquisitions_name', $request->purpose_of_land)->value('id');
            $input['sr_no_id'] = AcquisitionRegister::where('id', $request->sr_no_id)->value('sr_no');

            $acquisition_assistant = AcquisitionAssistant::create(Arr::only($input, AcquisitionAssistant::getFillables()));

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
            $acquisitionAssistant = AcquisitionAssistant::findOrFail($id);
            $acquisitionAssistantSizes = AcquisitionAssistantSize::where('acquisition_assistant_id', $id)->get();

            $districts = District::all();
            $talukas = Taluka::all();
            $villages = Village::all();
            $sr_nos = Srno::all();
            $land_acquisitions = Land_Acquisition::all();
            $years = Year::all();


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
            $designations = Designation::all();
            $acquisitionAssistantSizes = AcquisitionAssistantSize::where('acquisition_assistant_id', $id)->get();

            // Return the edit view with the data
            return view('acquisition_assistants.edit', compact('acquisitionAssistant', 'districts', 'talukas', 'villages', 'sr_nos', 'land_acquisitions', 'years', 'designations', 'acquisitionAssistantSizes'));
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
        try {
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
            return redirect()->back();
            // return redirect()->route('acquisition_assistant.pending')->with('success', 'Acquisition Assistant deleted successfully!');
        } catch (\Exception $e) {
            // Log the error message for debugging
            // \Log::error('Error deleting AcquisitionAssistant: ' . $e->getMessage());

            // Rollback in case of error
            DB::rollBack();

            // Return a more detailed error response
            return response()->json(['error' => 'Failed to delete the AcquisitionAssistant', 'message' => $e->getMessage()], 500);
        }
    }


    public function approve(Request $request, $id)
    {
        //  dd($request);
        $acquisitionAssistant = AcquisitionAssistant::find($id);

        if (!$acquisitionAssistant) {
            return redirect()->back()->with('error', 'Item not found.');
        }

        $acquisitionAssistant->acquisition_officer_status = 1; // Approve
        $acquisitionAssistant->acquisition_officer_remark = $request->input('remark');
        $acquisitionAssistant->save();

        return redirect()->route('acquisition_assistant.approved')->with('message', 'Item approved successfully.');
    }

    public function reject(Request $request, $id)
    {
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
        $user = Auth::user();
        $userRole = $user->roles()->first();

        $records = AcquisitionAssistant::with([
            'district',
            'taluka',
            'village',
            'year',
            'sr_no',
            'land_acquisition'
        ])->latest()
        ->where('acquisition_officer_status', 0)
            ->when($userRole == 'Officer', fn($q) => $q->where('district_id', $user->district_id))
            ->when($userRole == 'Assistant Officer', fn($q) => $q->where('user_id', $user->id))
            ->paginate(10);


        return view('acquisition_assistants.pending', compact('records'));
    }


    public function land_acquisition(Request $request)
    {
        $records = AcquisitionAssistant::with(['district', 'taluka', 'village', 'year', 'sr_no', 'land_acquisition'])->latest()->whereIn('acquisition_proposal', [2])->paginate(10);

        $acquisition_assistants = AcquisitionAssistant::all();
        return view('acquisition_assistants.land_acquisition', compact('acquisition_assistants', 'records'));
    }

    public function complete_reco_auth()
    {
        $acquisition_assistants = AcquisitionAssistant::all();

        $records = AcquisitionAssistant::with(['district', 'taluka', 'village', 'year', 'land_acquisition'])->latest()->whereIn('acquisition_proposal', [1])
            ->paginate(10);

        return view('acquisition_assistants.complete_reco_auth', compact('acquisition_assistants', 'records'));
    }

    public function complete_auth(Request $request)
    {
        $request->validate([
            'acquisition_proposal' => 'required',
            'updated_date' => 'required|date',
            'id' => 'required|exists:acquisition_assistants,id',
        ]);
        $acquisitionAssistant = AcquisitionAssistant::find($request->input('id'));
        // dd($request->all());
        if (!$acquisitionAssistant) {

            return redirect()->back()->with('error', 'Item not found.');
        }

        // Update the acquisition proposal status and the date
        $acquisitionAssistant->acquisition_proposal = $request->input('acquisition_proposal');
        $acquisitionAssistant->updated_date = $request->input('updated_date');
        $acquisitionAssistant->save();

        // Redirect to the complete_auth page with a success message

        return redirect()->route('acquisition_assistant.complete_reco_auth')->with('message', 'Item approved successfully.');
    }



    public function approved()
    {

        $user = Auth::user();
        $userRole = $user->roles()->first();

        // Fetch records with necessary relationships


        $records = AcquisitionAssistant::with([
            'district',
            'taluka',
            'village',
            'year',
            'sr_no',
            'land_acquisition'
        ])->latest()
        ->where('acquisition_officer_status', 1)
            ->when($userRole == 'Officer', fn($q) => $q->where('district_id', $user->district_id))
            ->when($userRole == 'Assistant Officer', fn($q) => $q->where('user_id', $user->id))
            ->paginate(10);




        return view('acquisition_assistants.approved', compact('records'));
    }

    public function rejected()
    {
        $user = Auth::user();
        $userRole = $user->roles()->first();

        // Fetch records with necessary relationships


        $records = AcquisitionAssistant::with([
            'district',
            'taluka',
            'village',
            'year',
            // 'sr_no',
            'land_acquisition'
        ])->latest()
        ->where('acquisition_officer_status', 2)
            ->when($userRole == 'Officer', fn($q) => $q->where('district_id', $user->district_id))
            ->when($userRole == 'Assistant Officer', fn($q) => $q->where('user_id', $user->id))
            ->paginate(10);


        return view('acquisition_assistants.rejected', compact('records'));
    }


    public function getTalukas($districtId)
    {
        // Fetch talukas based on the selected district
        $talukas = Taluka::where('district_id', $districtId)->get(['id', 'taluka_name']);

        // Return the talukas as a JSON response
        return response()->json($talukas);
    }

    public function getVillages($talukaId)
    {
        $villages = Village::where('taluka_id', $talukaId)->get();
        return response()->json($villages);
    }
}
