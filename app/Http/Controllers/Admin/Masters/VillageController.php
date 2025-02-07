<?php

namespace App\Http\Controllers\Admin\Masters;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\Masters\UpdateVillageRequest;
use App\Http\Requests\Admin\Masters\StoreVillageRequest;
use App\Models\District;
use App\Models\Village;
use App\Models\Taluka;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
class VillageController extends Controller
{
    public function index()
    {

        $villages = Village::with('taluka')->latest()->get();
        $talukas = Taluka::all();
        $districts = District::all();
        return view('admin.masters.villages')->with(['villages'=>  $villages,  'talukas' =>  $talukas,'districts'=>$districts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        // return view('admin.masters.districts');
        $districts = District::all();
        $talukas = Taluka::all();
        return view('admin.masters.create_village')->with(['districts'=>$districts,
            'talukas' => $talukas // Pass districts to the create view
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVillageRequest $request)
    {


        try
        {
            DB::beginTransaction();

            // Validate and filter input
            $input = $request->validated();

            // Create the district and retrieve the created instance
            $village = Village::create(Arr::only($input, Village::getFillables()));

            DB::commit();

            // Return the created district in the response
            return response()->json([
                'success' => 'Village created successfully!',
                'data' => $village
            ]);
        }
        catch (\Exception $e)
        {
            DB::rollBack(); // Ensure the transaction is rolled back on failure

            return $this->respondWithAjax($e, 'creating', 'Village');
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
    public function edit(Village $village)
    {
        if ($village)
        {
            $response = [
                'result' => 1,
                'village' => $village,
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
    public function update(UpdateVillageRequest $request,Village $village)
    {
        try
        {
            DB::beginTransaction();

            // Get validated data from the request
            $input = $request->validated();

            // Use the fillable property to get allowed fields for mass update
            $village->update(Arr::only($input, $village->getFillable()));

            DB::commit();

            return response()->json(['success' => 'Village updated successfully!']);
        }
        catch(\Exception $e)
        {
            // Handle the exception and respond with an error
            return $this->respondWithAjax($e, 'updating', 'Village');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Village $village)
    {
        try
        {
            DB::beginTransaction();
            $village->delete();
            DB::commit();

            return response()->json(['success'=> 'Village deleted successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'deleting', 'Village');
        }
    }
}
