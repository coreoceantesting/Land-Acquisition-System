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
        $record_reg = AcquisitionRegister::with(['district', 'taluka', 'village','land_acquisition'])->paginate(10);
        // dd($record_reg);
        $acquisition_register =AcquisitionRegister ::all();
        return view('acquisition_registers.record_register', compact('acquisition_register','record_reg'));

    }

    public function create()
    {
        $districts = District::all();
        $talukas = Taluka::all();
        $villages = Village::all();
        $land_acquisitions=Land_Acquisition::all();
        return view('acquisition_registers.register',compact('districts','talukas','villages','land_acquisitions'));
    }

    public function store(StoreAcquisitionRegisterRequest $request)
    {
        try {
            DB::beginTransaction();



            $acquisition_register = AcquisitionRegister::create($request->all());

            DB::commit();

            // Return success response
            return response()->json([
                'status' => 'success',
                'message' => 'Data saved successfully!'
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
            // Fetch the Acquisition Assistant and its related data
            $acquisition_register = AcquisitionRegister::find($id);

            // dd($acquisition_register);

            $districts = District::all();
            $talukas = Taluka::all();
            $villages = Village::all();
            $land_acquisitions = Land_Acquisition::all();


        return view('acquisition_registers.record_register', compact('acquisition_register','districts',
                 'talukas',
                'villages',
            'land_acquisitions'));
    }catch (\Exception $e) {
        return response()->json([
            'error' => 'An error occurred while fetching the Acquisition Register.',
            'message' => $e->getMessage(),
        ], 500);
    }

    }

    public function edit($id)
    {
        try {
            // Attempt to fetch the record by ID
            $acquisition_register = AcquisitionRegister::findOrFail($id);

            // Fetch additional data for the edit form
            $districts = District::all();
            $talukas = Taluka::all();
            $villages = Village::all();
            $sr_nos = Srno::all();
            $land_acquisitions = Land_Acquisition::all();


            // Return the edit view with the data
            return view('acquisition_registers.edit', compact('acquisition_register', 'districts', 'talukas', 'villages', 'sr_nos', 'land_acquisitions'));
        } catch (\Exception $e) {
            // In case of error, catch the exception and show a message
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

            // Find the AcquisitionAssistant to update
            $acquisition_register = AcquisitionRegister::find($id);

            // Validate the request data
            // $validated = $request->validated();

            // Update the AcquisitionAssistant record
            $acquisition_register->update($request->all());

            // Update or create associated AcquisitionAssistantSize records

            // Commit the transaction
            DB::commit();
            // return($request);

            // Redirect to the show page with a success message
            return redirect()->route('acquisition_register.index', $acquisition_register->id)
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
    public function destroy(AcquisitionRegister $acquisition_register)
    {
        try
        {
            // Check if the record exists before deleting
            if (!$acquisition_register) {
                return response()->json(['error' => 'Record not found'], 404);
            }

            // Start transaction
            DB::beginTransaction();

            // Attempt to delete the record (soft delete if SoftDeletes is used)
            $acquisition_register->delete();

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


