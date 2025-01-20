<?php

namespace App\Http\Controllers\Admin\Masters;
use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\Masters\UpdateTypeOfLandAcquisitionRequest;
use App\Http\Requests\Admin\Masters\StoreTypeOfLandAcquisitioRequest;
use App\Models\Land_Acqusition;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
class TypeOfLandAcquisition extends Controller
{
    public function index()
    {
        $lands = Land_Acqusition::latest()->get();
        // $villages = Village::all();
        // $districts = District;
        // dd($districts);
        return view('admin.masters.typeofland')->with([ 'lands' =>  $lands]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('admin.masters.districts');
        // $talukas = Taluka::all();
        // return view('admin.masters.create_taluka')->with([
        //     'talukas' => $talukas // Pass districts to the create view
        // ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTypeOfLandAcquisitioRequest $request)
    {

        try
        {
            DB::beginTransaction();

            // Validate and filter input
            $input = $request->validated();

            // Create the district and retrieve the created instance
            $land = Land_Acqusition::create(Arr::only($input, Land_Acqusition::getFillables()));

            DB::commit();

            // Return the created district in the response
            return response()->json([
                'success' => 'Land_Acqusition created successfully!',
                'data' => $land
            ]);
        }
        catch (\Exception $e)
        {
            DB::rollBack(); // Ensure the transaction is rolled back on failure

            return $this->respondWithAjax($e, 'creating', 'land');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Land_Acqusition $land)
    {
        if ($land)
        {
            $response = [
                'result' => 1,
                'land' => $land,
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
    public function update(UpdateTypeOfLandAcquisitionRequest $request,Land_Acqusition $land)
    {
        try
        {
            DB::beginTransaction();

            // Get validated data from the request
            $input = $request->validated();

            // Use the fillable property to get allowed fields for mass update
            $land->update(Arr::only($input, $land->getFillable()));

            DB::commit();

            return response()->json(['success' => 'Land_Acqusition updated successfully!']);
        }
        catch(\Exception $e)
        {
            // Handle the exception and respond with an error
            return $this->respondWithAjax($e, 'updating', 'land');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Land_Acqusition $land)
    {
        try
        {
            DB::beginTransaction();
            $land->delete();
            DB::commit();

            return response()->json(['success'=> 'Land_Acqusition deleted successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'deleting', 'land');
        }
    }
}
