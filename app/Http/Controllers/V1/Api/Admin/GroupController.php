<?php

namespace App\Http\Controllers\V1\Api\Admin;

use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Models\Group;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $this->authorize('index', new Group());
            $groups = Group::all();

            return response()->json(
                $groups,
                200);
        } catch (AuthorizationException $e) {
            return response()->json([
                'message' => 'This Action is Unauthorized',
                ], 403);
        }

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
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGroupRequest $request)
    {
        try {
            $group = new Group();
            $this->authorize('create', $group);
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
        } catch (AuthorizationException $e) {
            return response()->json([
                'message' => 'This Action is Unauthorized',
                ], 403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        try {
            $this->authorize('view', $group);

            return response()->json(
                $group,
                200
            );
        } catch (AuthorizationException $e) {
            return response()->json([
                'message' => 'This Action is Unauthorized',
                ], 403);
        }

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
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGroupRequest $request, Group $group)
    {
        try {
            $this->authorize('update', $group);
            $group->update($request->all());

            return response()->json([
                'message' => "Successfully Updated Group!"
            ], 200);
        } catch (AuthorizationException $e) {
            return response()->json([
                'message' => 'This Action is Unauthorized',
                ], 403);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        try {
            $this->authorize('delete', $group);
            if ($group->delete()) {
                return response()->json([], 204);
            }
            return response()->json([
                'message' => "Failed to Update Group!"
            ], 500);
        } catch (AuthorizationException $e) {
            return response()->json([
                'message' => 'This Action is Unauthorized',
                ], 403);
        }
    }
}
