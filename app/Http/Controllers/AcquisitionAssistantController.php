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
use Illuminate\Support\Facades\Log;

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
        $districts = District::when(auth()->user()->roles[0]->name != 'Super Admin', fn($q) => $q->where('id', auth()->user()->district_id))->get();
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
            DB::commit();

            return response()->json([
                'success' => 'Land Acquisition Record created successfully!',
                'data' => $acquisition_assistant,
            ]);
        } catch (\Exception $e) {
            Log::info($e);

            return response()->json([
                'error' => 'An error occurred while creating the Acquisition Assistant.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }



    public function show($id)
    {
        try {
            $acquisitionAssistant = AcquisitionAssistant::findOrFail($id);
            $acquisitionAssistantSizes = AcquisitionAssistantSize::where('acquisition_assistant_id', $id)->get();

            $districts = District::when(auth()->user()->roles[0]->name != 'Super Admin', fn($q) => $q->where('id', auth()->user()->district_id))->get();
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
            $user = auth()->user();
            $acquisitionAssistant = AcquisitionAssistant::with('land_acquisition')->findOrFail($id);

            $districts = District::when(!$user->hasRole('Super Admin'), fn($q) => $q->where('id', $user->district_id))->get();
            $talukas = Taluka::when(!$user->hasRole('Super Admin'), fn($q) => $q->where('district_id', $user->district_id))->get();

            $villages = Village::when(!$user->hasRole('Super Admin'), fn($q) => $q->whereHas('taluka', fn($q) => $q->where('district_id', $user->district_id)))->get();

            $sr_nos = AcquisitionRegister::query()
                ->select('sr_no', 'id')
                ->when(!$user->hasRole('Super Admin'), fn($q) => $q->where('district_id', $user->district_id))
                ->where('taluka_id', $acquisitionAssistant->taluka_id)
                ->get();

            $land_acquisitions = Land_Acquisition::all();
            $years = Year::all();
            $designations = Designation::all();
            $acquisitionAssistantSizes = AcquisitionAssistantSize::where('acquisition_assistant_id', $id)->get();


            return view('acquisition_assistants.edit', compact('acquisitionAssistant', 'districts', 'talukas', 'villages', 'sr_nos', 'land_acquisitions', 'years', 'designations', 'acquisitionAssistantSizes'));
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred while fetching the Acquisition Assistant for editing.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAcquisitionAssistantRequest $request, AcquisitionAssistant $acquisition_assistant)
    {
        try {
            DB::beginTransaction();

            $input = $request->validated();
            $input['acquisition_officer_status'] = 0;
            $acquisition_assistant->update(Arr::only($input, AcquisitionAssistant::getFillables()));

            AcquisitionAssistantSize::where('acquisition_assistant_id', $acquisition_assistant->id)->delete();
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

            DB::commit();

            return response()->json(['success' => 'Record Filled Successfully!']);
        } catch (\Exception $e) {
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
        $acquisitionAssistant = AcquisitionAssistant::find($id);

        if (!$acquisitionAssistant) {
            return response()->json(['error2' => 'No data found']);
        }

        try {
            $acquisitionAssistant->acquisition_officer_status = 1;
            $acquisitionAssistant->save();
            return response()->json(['success' => 'Approved successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error2' => 'Something went wrong, please try again!']);
        }
    }

    public function reject(Request $request, $id)
    {
        $acquisitionAssistant = AcquisitionAssistant::find($id);

        if (!$acquisitionAssistant) {
            return redirect()->back()->with('error', 'Not found.');
        }
        $acquisitionAssistant->acquisition_officer_status = 2; // Reject
        $acquisitionAssistant->acquisition_officer_remark = $request->input('remark');

        // Add remark
        $acquisitionAssistant->save();

        return redirect()->route('acquisition_assistant.rejected')->with('message', 'Rejected successfully.');
    }

    public function pending()
    {
        $user = Auth::user();
        $userRole = $user->roles()->first();

        $records = AcquisitionAssistant::with(['district', 'taluka', 'village', 'year', 'sr_no', 'land_acquisition'])
            ->where('acquisition_officer_status', 0)
            ->when($userRole == 'Officer', fn($q) => $q->where('district_id', $user->district_id))
            ->when($userRole == 'Assistant Officer', fn($q) => $q->where('user_id', $user->id))
            ->latest()
            ->paginate(10);


        return view('acquisition_assistants.pending', compact('records'));
    }


    public function land_acquisition(Request $request)
    {
        $records = AcquisitionAssistant::with(['district', 'taluka', 'village', 'year', 'sr_no', 'land_acquisition'])
                                    ->latest()
                                    ->where('acquisition_officer_status', 1)
                                    ->whereIn('acquisition_proposal', [2])
                                    ->paginate(10);

        $acquisition_assistants = AcquisitionAssistant::all();

        return view('acquisition_assistants.land_acquisition', compact('acquisition_assistants', 'records'));
    }

    public function complete_reco_auth()
    {
        $acquisition_assistants = AcquisitionAssistant::all();

        $records = AcquisitionAssistant::with(['district', 'taluka', 'village', 'year', 'land_acquisition'])
                                ->latest()
                                ->where('acquisition_officer_status', 1)
                                ->whereIn('acquisition_proposal', [1])
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

        if (!$acquisitionAssistant) {
            return redirect()->back()->with('error', 'Not found.');
        }

        // Update the acquisition proposal status and the date
        $acquisitionAssistant->acquisition_proposal = $request->input('acquisition_proposal');
        $acquisitionAssistant->updated_date = $request->input('updated_date');
        $acquisitionAssistant->save();

        // Redirect to the complete_auth page with a success message

        return redirect()->route('acquisition_assistant.complete_reco_auth')->with('message', 'Approved successfully.');
    }



    public function approved()
    {
        $user = Auth::user();
        $userRole = $user->roles()->first();

        $records = AcquisitionAssistant::with(['district', 'taluka', 'village', 'year', 'sr_no', 'land_acquisition'])
            ->where('acquisition_officer_status', 1)
            ->when($userRole == 'Officer', fn($q) => $q->where('district_id', $user->district_id))
            ->when($userRole == 'Assistant Officer', fn($q) => $q->where('user_id', $user->id))
            ->latest()
            ->paginate(10);


        return view('acquisition_assistants.approved', compact('records'));
    }

    public function rejected()
    {
        $user = Auth::user();
        $userRole = $user->roles()->first();

        $records = AcquisitionAssistant::with(['district', 'taluka', 'village', 'year', 'sr_no', 'land_acquisition'])
            ->where('acquisition_officer_status', 2)
            ->when($userRole == 'Officer', fn($q) => $q->where('district_id', $user->district_id))
            ->when($userRole == 'Assistant Officer', fn($q) => $q->where('user_id', $user->id))
            ->latest()
            ->paginate(10);


        return view('acquisition_assistants.rejected', compact('records'));
    }


    public function getTalukas($districtId)
    {
        $talukas = Taluka::where('district_id', $districtId)->get(['id', 'taluka_name']);

        return response()->json($talukas);
    }

    public function getVillages($talukaId)
    {
        $villages = Village::where('taluka_id', $talukaId)->get();
        return response()->json($villages);
    }
}
