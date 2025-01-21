<?php

namespace App\Http\Controllers\Admin\Masters;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\Masters\StoreLandAcquisitionRequest;
use App\Http\Requests\Admin\Masters\UpdateLandAcquisitionRequest;

use App\Models\Land_Acquisition;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;


class LandAcquisitionController extends Controller
{
    public function index()
    {
        $land_acquisitions = Land_Acquisition::latest()->get();

        // dd($districts);
        return view('admin.masters.land_acquisition')->with(['land_acquisitions'=> $land_acquisitions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('admin.masters.districts');


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLandAcquisitionRequest $request)
    {
       // dd($request->all());

        try
        {
            DB::beginTransaction();

            // Validate and filter input
            $input = $request->validated();

            // Create the district and retrieve the created instance
            $land_acquisition = Land_Acquisition::create(Arr::only($input, Land_Acquisition::getFillables()));

            DB::commit();

            // Return the created district in the response
            return response()->json([
                'success' => 'Land_Acquisition created successfully!',
                'data' => $land_acquisition
            ]);
        }
        catch (\Exception $e)
        {
            DB::rollBack(); // Ensure the transaction is rolled back on failure

            return $this->respondWithAjax($e, 'creating', 'Land_Acquisition');
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
    public function edit(Land_Acquisition $land_acquisition)
    {
        if ($land_acquisition)
        {
            $response = [
                'result' => 1,
                'land_acquisition' => $land_acquisition,
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
    public function update(UpdateLandAcquisitionRequest $request, Land_Acquisition $land_acquisition)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            $land_acquisition->update( Arr::only( $input, Land_Acquisition::getFillables() ) );
            DB::commit();

            return response()->json(['success'=> 'Land_Acquisition updated successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'updating', 'Land_Acquisition');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Land_Acquisition $land_acquisition)
    {
        try
        {
            DB::beginTransaction();
            $land_acquisition->delete();
            DB::commit();

            return response()->json(['success'=> 'Land_Acquisition deleted successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'deleting', 'Land_Acquisition');
        }
    }
}
