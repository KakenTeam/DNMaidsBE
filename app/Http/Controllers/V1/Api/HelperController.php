<?php

namespace App\Http\Controllers\V1\Api;

use App\Http\Requests\StoreHelperRequest;
use App\Http\Requests\UpdateHelperRequest;
use App\Models\Helper;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HelperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
     * @param  \Illuminate\Http\Request $request
     * @return  422 if validate fails
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHelperRequest $request)
    {
        $helper = new Helper();
        $helper->fill($request->all());
        if ($helper->save())
            return response()->json([
                'info' => $helper,
                'message' => 'Successfully created helper!'
            ], 201);
        return response()->json([
            'message' => 'Failed to create helper!',
        ],500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return  422 if validate fails
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHelperRequest $request, Helper $helper)
    {
        $helper->update($request->all());
        return response()->json([
            'message' => "Successfully Updated Helper"
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Helper $helper)
    {
        $result = $helper->delete();

        if ($result) {
            return response()->json([
                'message' => "Successfuly Deleted Helper",
                'info' => $helper,
            ],200);
        }
        return response()->json([
            'message' => 'Failed To Delete Helper',
        ],500);
    }
}
