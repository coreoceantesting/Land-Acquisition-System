<?php

namespace App\Http\Controllers\Admin\Masters;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\Masters\StoreDesignationRequest;
use App\Http\Requests\Admin\Masters\UpdateDesignationRequest;
use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class DesignationController extends Controller
{
    public function index()
    {
        $designations = Designation::latest()->get();

        // dd($Designations);
        return view('admin.masters.designations')->with(['designations'=> $designations]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('admin.masters.Designations');


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDesignationRequest $request)
    {
       // dd($request->all());

        try
        {
            DB::beginTransaction();

            // Validate and filter input
            $input = $request->validated();

            // Create the Designation and retrieve the created instance
            $designation = Designation::create(Arr::only($input, Designation::getFillables()));

            DB::commit();

            // Return the created Designation in the response
            return response()->json([
                'success' => 'Designation created successfully!',
                'data' => $designation
            ]);
        }
        catch (\Exception $e)
        {
            DB::rollBack(); // Ensure the transaction is rolled back on failure

            return $this->respondWithAjax($e, 'creating', 'Designation');
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
    public function edit(Designation $designation)
    {
        if ($designation)
        {
            $response = [
                'result' => 1,
                'Designation' => $designation,
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
    public function update(UpdateDesignationRequest $request, Designation $designation)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            $designation->update( Arr::only( $input, Designation::getFillables() ) );
            DB::commit();

            return response()->json(['success'=> 'Designations updated successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'updating', 'Ward');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Designation $designation)
    {
        try
        {
            DB::beginTransaction();
            $designation->delete();
            DB::commit();

            return response()->json(['success'=> 'Designations deleted successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'deleting', 'Ward');
        }
    }
}
