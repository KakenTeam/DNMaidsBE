<?php

namespace App\Http\Controllers\V1\Api\Admin;

use App\Http\Requests\StoreGroupRequest;
use App\Models\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $this->authorize('index', $request->user());
        $groups = Group::all();

        return response()->json(
            $groups,
            200);
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
    public function store(StoreGroupRequest $request)
    {
        $this->authorize('create', $request->user());
        $group = new Group();
        $group->fill($request->all());
        if ($group->save()) {
            return response()->json([
                'info' => $group,
                'message' => 'Successfully Created Group!',
            ], 201);
        }

        return response()->json([
            'message' => 'Failed to create Group!',
        ], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Group $group)
    {
        $this->authorize('update', $request->user(), $group);

        return response()->json(
            $group,
            200
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request, Group $group)
    {
        $this->authorize('update', $request->user(), $group);
        $group->update($request->all());

        return response()->json([
            'message' => "Successfully Updated Group!"
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Group $group)
    {
        $this->authorize('delete', $request->user(), $group);
        if ($group->delete()) {
            return response()->json([], 204);
        }
        return response()->json([
            'message' => "Failed to Update Group!"
        ], 500);

    }
}
