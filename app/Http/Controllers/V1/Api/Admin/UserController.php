<?php

namespace App\Http\Controllers\V1\Api\Admin;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $user = new User();
            $this->authorize('index', $user);
            $fillable = $user->getFillable();

            $user = User::where('status', '1');
            if ($request->field) {
                if (!in_array($request->field, $fillable)) {
                    return response()->json([
                        'success' => 'false',
                        'message' => 'Tên trường không đúng.',
                    ], 400);
                } else {
                    $user = $user->where($request->field, 'like', '%' . $request->search . '%');
                }
            }
            if ($request->role != null) {
                $user = $user->where('role', $request->role);
            }
            $user = $user->get();

            return response()->json([
                'count' => $user->count(),
                'success' => 'true',
                'data' => UserResource::collection($user),
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
     * @return  422 if validate fails
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        try {
            $user = new User();
            $this->authorize('create', $user);

            $user->fill($request->all());

            if ($user->save()) {
                $user->groups()->attach($request->group);
                $user->skills()->attach($request->skill);
                return response()->json([
                    'message' => 'Tạo thành công người dùng.',
                    'info' => new UserResource($user),
                ], 201);
            }

            return response()->json([
                'message' => 'Tạo người dùng thất bại.',
            ], 500);
        } catch (AuthorizationException $e) {
            return response()->json(['message' => 'Bạn không có quyền để thực hiện hành động này.',], 403);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        try {
            $this->authorize('view', $user);
            return response()->json([
                'message' => 'Lấy thông tin người dùng thành công.',
                'info' => new UserResource($user),
            ], 200);
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
     * @return  422 if validate fails
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            $this->authorize('update', $user);
            $user->update($request->all());
            $user->groups()->sync($request->group);
            $user->skills()->sync($request->skill);

            return response()->json([
                'message' => "Cập nhật thông tin người dùng thành công."
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
    public function destroy(User $user)
    {
        try {
            $this->authorize('delete', $user);
            $result = $user->delete();
            if ($result) {
                return response()->json('', 204);
            }
            return response()->json([
                'message' => 'Xóa người dùng thất bại.',
            ], 500);
        } catch (AuthorizationException $e) {
            return response()->json([
                'message' => 'Bạn không có quyền để thực hiện hành động này.',
            ], 403);
        }

    }
}
