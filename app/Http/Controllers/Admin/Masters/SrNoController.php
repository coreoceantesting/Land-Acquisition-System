<?php

namespace App\Http\Controllers\Admin\Masters;

use App\Http\Controllers\Controller;
use App\Models\Srno;
use App\Http\Requests\Admin\Masters\StoreSrNoRequest;
use App\Http\Requests\Admin\Masters\UpdateSrNoRequest;


use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;


class SrNoController extends Controller
{
    public function index()
    {
        $sr_nos = Srno::latest()->get();

        // dd($districts);
        return view('admin.masters.sr_nos')->with(['sr_nos'=> $sr_nos]);
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
    public function store(StoreSrNoRequest $request)
    {

        try
        {
            DB::beginTransaction();

            // Validate and filter input
            // $input = $request->validated();

            // Create the district and retrieve the created instance
            // dd($input());
            $sr_no = Srno::create($request->all());


            DB::commit();

            // Return the created district in the response
            return response()->json([
                'success' => 'Srno created successfully!',
                'data' => $sr_no
            ]);
        }
        catch (\Exception $e)
        {
            DB::rollBack(); // Ensure the transaction is rolled back on failure

            return $this->respondWithAjax($e, 'creating', 'Srno');
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
    public function edit(Srno $sr_no)
    {
        if ($sr_no)
        {
            $response = [
                'result' => 1,
                'sr_no' => $sr_no,
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
    public function update(UpdateSrNoRequest $request, Srno $sr_no)
    {
        try
        {
            DB::beginTransaction();
            // $input = $request->validated();
            // $sr_no = Srno::create($request->all());
            $sr_no->update( $request->all() );
            DB::commit();

            return response()->json(['success'=> 'Srno updated successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'updating', 'Srno');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Srno $sr_no)
    {
        try
        {
            DB::beginTransaction();
            $sr_no->delete();
            DB::commit();

            return response()->json(['success'=> 'Srno deleted successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'deleting', 'Srno');
        }
    }
}
