<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Taluka;
use App\Models\Village;
use App\Models\Srno;
use App\Models\Land_Acquisition;
use App\Http\Requests\Assistant\StoreAcquisitionRegisterRequest;
use App\Http\Requests\Assistant\UpdateAcquisitionRegisterRequest;

use App\Models\AcquisitionRegister;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AcquisitionRegisterController extends Controller
{

    public function index()
    {
        $record_reg = AcquisitionRegister::with(['district', 'taluka', 'village', 'land_acquisition'])->latest()->paginate(10);


        $acquisition_register = AcquisitionRegister::all();
        return view('acquisition_registers.record_register', compact('acquisition_register', 'record_reg'));
    }

    public function create()
    {
        $districts = District::when(auth()->user()->roles[0]->name != 'Super Admin', fn($q) => $q->where('id', auth()->user()->district_id) )->get();
        $talukas = Taluka::all();
        $villages = Village::all();
        $land_acquisitions = Land_Acquisition::all();

        return view('acquisition_registers.register', compact('districts', 'talukas', 'villages', 'land_acquisitions'));
    }

    public function store(StoreAcquisitionRegisterRequest $request)
    {
        try {
            DB::beginTransaction();

            $acquisition_register = AcquisitionRegister::create($request->all());

            DB::commit();

            // Return success response
            return response()->json([
                'success' => 'Acquisition Register created successfully!',
                'data' => $acquisition_register,
            ]);
        } catch (\Exception $e) {
            // Rollback the transaction if anything goes wrong
            DB::rollBack();

            // Log the exception for debugging (optional but useful)
            Log::error('Error saving acquisition register: ' . $e->getMessage());
            // Return an error response
            return response()->json([
                'error' => 'An error occurred while creating the Acquisition Register.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $acquisition_register = AcquisitionRegister::find($id);

            $districts = District::when(auth()->user()->roles[0]->name != 'Super Admin', fn($q) => $q->where('id', auth()->user()->district_id) )->get();
            $talukas = Taluka::all();
            $villages = Village::all();
            $land_acquisitions = Land_Acquisition::all();


            return view('acquisition_registers.show', compact(
                'acquisition_register',
                'districts',
                'talukas',
                'villages',
                'land_acquisitions'
            ));
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred while fetching the Acquisition Register.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $acquisition_register = AcquisitionRegister::findOrFail($id);

            $districts = District::when(auth()->user()->roles[0]->name != 'Super Admin', fn($q) => $q->where('id', auth()->user()->district_id) )->get();
            $talukas = Taluka::all();
            $villages = Village::all();
            $sr_nos = Srno::all();
            $land_acquisitions = Land_Acquisition::all();


            return view('acquisition_registers.edit', compact('acquisition_register', 'districts', 'talukas', 'villages', 'sr_nos', 'land_acquisitions'));
        } catch (\Exception $e) {

            return response()->json([
                'error' => 'An error occurred while fetching the Acquisition Assistant for editing.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    public function update(UpdateAcquisitionRegisterRequest $request, $id)

    {
        try {
            DB::beginTransaction();

            $acquisition_register = AcquisitionRegister::find($id);
            $acquisition_register->update($request->all());

            DB::commit();

            return redirect()->route('acquisition_register.index', $acquisition_register->id)
                ->with('success', 'Acquisition Assistant updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'error' => 'An error occurred while updating the Acquisition Assistant.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    public function destroy(AcquisitionRegister $acquisition_register)
    {
        try {
            if (!$acquisition_register) {
                return response()->json(['error' => 'Record not found'], 404);
            }

            DB::beginTransaction();

            $acquisition_register->delete();

            DB::commit();

            return redirect()->route('acquisition_register.index')->with('success', 'Acquisition Assistant deleted successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => 'Failed to delete the AcquisitionAssistant', 'message' => $e->getMessage()], 500);
        }
    }
}
