<?php

namespace App\Http\Controllers\Admin\Masters;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\Masters\StoreDistrictRequest;
use App\Http\Requests\Admin\Masters\UpdateDistrictRequest;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class DistrictController extends Controller
{
    public function index()
    {
        $districts = District::latest()->get();

        return view('admin.masters.districts')->with(['districts'=> $districts]);
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
    public function store(StoreDistrictRequest $request)
    {
       // dd($request->all());

        try
        {
            DB::beginTransaction();

            // Validate and filter input
            $input = $request->validated();

            // Create the district and retrieve the created instance
            $district = District::create(Arr::only($input, District::getFillables()));

            DB::commit();

            // Return the created district in the response
            return response()->json([
                'success' => 'District created successfully!',
                'data' => $district
            ]);
        }
        catch (\Exception $e)
        {
            DB::rollBack(); // Ensure the transaction is rolled back on failure

            return $this->respondWithAjax($e, 'creating', 'District');
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
    public function edit(District $district)
    {
        if ($district)
        {
            $response = [
                'result' => 1,
                'district' => $district,
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
    public function update(UpdateDistrictRequest $request, District $district)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            $district->update( Arr::only( $input, District::getFillables() ) );
            DB::commit();

            return response()->json(['success'=> 'Ward updated successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'updating', 'Ward');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(District $district)
    {
        try
        {
            DB::beginTransaction();
            $district->delete();
            DB::commit();

            return response()->json(['success'=> 'Ward deleted successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'deleting', 'Ward');
        }
    }
}
