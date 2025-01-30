<?php

namespace App\Http\Controllers\Admin\Masters;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\Masters\UpdateTalukaRequest;
use App\Http\Requests\Admin\Masters\StoreTalukaRequest;
use App\Models\Taluka;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class TalukaController extends Controller
{
    public function index()
    {
        $talukas = Taluka::with('district')->latest()->get();
        $districts = District::all();

        return view('admin.masters.talukas')->with(['talukas'=> $talukas,  'districts' => $districts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $districts = District::all();
        return view('admin.masters.create_taluka')->with([
            'districts' => $districts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTalukaRequest $request)
    {

        try
        {
            DB::beginTransaction();

            // Validate and filter input
            $input = $request->validated();

            $taluka = Taluka::create(Arr::only($input, Taluka::getFillables()));

            DB::commit();

            return response()->json([
                'success' => 'Taluka created successfully!',
                'data' => $taluka
            ]);
        }
        catch (\Exception $e)
        {
            DB::rollBack(); // Ensure the transaction is rolled back on failure

            return $this->respondWithAjax($e, 'creating', 'Taluka');
        }
    }


    /**
     * Display the specified resource.
     */
    public function showForm()
    {
        $districts = District::all();  // Get all districts
        return view('admin.masters.taluka', compact('districts'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Taluka $taluka)
    {
        if ($taluka)
        {
            $response = [
                'result' => 1,
                'taluka' => $taluka,
            ];
        }
        else
        {
            $response = ['result' => 0];
        }
        return $response;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTalukaRequest $request, Taluka $taluka)
    {
        try
        {
            DB::beginTransaction();

            // Get validated data from the request
            $input = $request->validated();

            // Use the fillable property to get allowed fields for mass update
            $taluka->update(Arr::only($input, $taluka->getFillable()));

            DB::commit();

            return response()->json(['success' => 'Taluka updated successfully!']);
        }
        catch(\Exception $e)
        {
            // Handle the exception and respond with an error
            return $this->respondWithAjax($e, 'updating', 'Taluka');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Taluka $taluka)
    {
        try
        {
            DB::beginTransaction();
            $taluka->delete();
            DB::commit();

            return response()->json(['success'=> 'Ward deleted successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'deleting', 'Taluka');
        }
    }
    public function getTalukas($districtId)
{
    // Fetch talukas based on the selected district
    $talukas = Taluka::where('district_id', $districtId)->get(['id', 'name']);

    return response()->json($talukas);
}
}
