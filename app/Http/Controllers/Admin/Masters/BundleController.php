<?php

namespace App\Http\Controllers\Admin\Masters;

use App\Http\Controllers\Controller;
use App\Models\Bundle;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Masters\StoreBundleRequest;
use App\Http\Requests\Admin\Masters\UpdateBundleRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BundleController extends Controller
{
    public function index()
    {
        $bundles = Bundle::latest()->get();

        // dd($districts);
        return view('admin.masters.bundles')->with(['bundles'=> $bundles]);
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
    public function store(StoreBundleRequest $request)
    {

        try
        {
            DB::beginTransaction();

            // Validate and filter input
            $input = $request->validated();

            // Create the district and retrieve the created instance
            // dd($input());
            $bundle = Bundle::create($request->all());


            DB::commit();

            // Return the created district in the response
            return response()->json([
                'success' => 'Bundle created successfully!',
                'data' => $bundle
            ]);
        }
        catch (\Exception $e)
        {
            DB::rollBack(); // Ensure the transaction is rolled back on failure

            return $this->respondWithAjax($e, 'creating', 'Bundle');
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
    public function edit(Bundle $bundle)
    {
        if ($bundle)
        {
            $response = [
                'result' => 1,
                'bundle' => $bundle,
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
    public function update(UpdateBundleRequest $request, Bundle $bundle)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            $bundle->update( Arr::only( $input, Bundle::getFillables() ) );
            DB::commit();

            return response()->json(['success'=> 'Bundle updated successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'updating', 'Bundle');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bundle $bundle)
    {
        try
        {
            DB::beginTransaction();
            $bundle->delete();
            DB::commit();

            return response()->json(['success'=> 'Bundle deleted successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'deleting', 'Bundle');
        }
    }
}


