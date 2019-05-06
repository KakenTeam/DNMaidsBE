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
    public function index(Request $request)
    {
        try {
            $this->authorize('index', new Group());

            if ($request->page != null) {
                $groups = Group::with('permissions')->where('group_name', 'like', '%' . $request->search . '%')->orderBy('group_name', 'asc')->paginate(10);
            } else {
                $groups = Group::with('permissions')->where('group_name', 'like', '%' . $request->search . '%')->orderBy('group_name', 'asc')->get();
            }
            return response()->json([
                'success' => 'true',
                'data' => $groups,
            ], 200);

        } catch (AuthorizationException $e) {
            return response()->json([
                'message' => 'Bạn không có quyền để thực hiện hành động này.',
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
            $group->fill([
                'group_name' => $request->group_name,
            ]);
            if ($group->save()) {
                if ($request->permissions) {
                    $group->permissions()->attach($request->permissions);
                }
                if ($request->users) {
                    $group->users()->attach($request->users);
                }
                return response()->json([
                    'info' => $group,
                    'message' => 'Tạo nhóm thành công.',
                ], 201);
            }

            return response()->json([
                'message' => 'Tạo nhóm thất bại.',
            ], 500);
        } catch (AuthorizationException $e) {
            return response()->json([
                'message' => 'Bạn không có quyền để thực hiện hành động này.',
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
                [   'success' => 'true',
                    'data' => $group,
                    ],
                200
            );
        } catch (AuthorizationException $e) {
            return response()->json([
                'message' => 'Bạn không có quyền để thực hiện hành động này.',
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
            $group->update([
                'group_name' => $request->group_name,
            ]);
            if ($request->permissions) {
                $group->permissions()->sync($request->permissions);
            }
            if ($request->users) {
                $group->users()->sync($request->users);
            }
            return response()->json([
                'message' => "Cập nhật nhóm thành công."
            ], 200);
        } catch (AuthorizationException $e) {
            return response()->json([
                'message' => 'Bạn không có quyền để thực hiện hành động này.',
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
                $group->permissions()->detach();
                $group->users()->detach();
                return response()->json([], 204);
            }
            return response()->json([
                'message' => "Xóa nhóm thất bại"
            ], 500);
        } catch (AuthorizationException $e) {
            return response()->json([
                'message' => 'Bạn không có quyền để thực hiện hành động này.',
            ], 403);
        }
    }
}
