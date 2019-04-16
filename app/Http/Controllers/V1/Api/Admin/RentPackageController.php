<?php

namespace App\Http\Controllers\V1\Api\Admin;

use App\Models\RentPackage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RentPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $package = RentPackage::all();

        return response()->json([
           $package
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $package = new RentPackage();
        $package->fill($request->all());
        if ($package->save()) {
            return response()->json([
                'message' => 'Successfully created Package!',
                'info' => $package,
            ], 201);
        }

        return response()->json([
            'message' => 'Creating Package Failed!'
        ],500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(RentPackage $rent_package)
    {
        return response()->json($rent_package, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(RentPackage $rent_package)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RentPackage $rent_package)
    {
        $rent_package->update($request->all());

        return response()->json([
            'message' => "Successfully Updated Package"
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(RentPackage $rent_package)
    {
        if ($rent_package->delete()){
            return response()->json([], 204);
        }

        return response()->json([
            'message' => 'Failed To Delete Package',
        ], 500);
    }
}
