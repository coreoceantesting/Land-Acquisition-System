<?php

namespace App\Http\Controllers\Admin\Masters;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Masters\StoreYearRequest;
use App\Http\Requests\Admin\Masters\UpdateYearRequest;
use App\Models\Year;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;


class YearController extends Controller
{
    public function index()
    {
        $years = Year::latest()->get();

        // dd($districts);
        return view('admin.masters.years')->with(['years'=> $years]);
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
    public function store(StoreYearRequest $request)
    {

        try
        {
            DB::beginTransaction();

            // Validate and filter input
            // $input = $request->validated();
            // dd($request->all());

            $year = Year::create($request->all());


            DB::commit();

            return response()->json([
                'success' => 'Year created successfully!',
                'data' => $year
            ]);
        }
        catch (\Exception $e)
        {
            DB::rollBack(); // Ensure the transaction is rolled back on failure

            return $this->respondWithAjax($e, 'creating', 'Year');
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
    public function edit(Year $year)
    {
        if ($year)
        {
            $response = [
                'result' => 1,
                'year' => $year,
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
    public function update(UpdateYearRequest $request, Year $year)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            $year->update( Arr::only( $input, Year::getFillables() ) );
            DB::commit();

            return response()->json(['success'=> 'Year updated successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'updating', 'Year');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Year $year)
    {
        try
        {
            DB::beginTransaction();
            $year->delete();
            DB::commit();

            return response()->json(['success'=> 'Year deleted successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'deleting', 'Year');
        }
    }
}
