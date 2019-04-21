<?php

namespace App\Http\Controllers\V1\Api\Admin;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
            if ($request->field != null && !in_array($request->field, $fillable)) {
                return response()->json([
                    'success' => 'false',
                    'message' => 'Field name is NOT correct!',
                ], 400);
            }
            if ($request->page != null) {
                if ($request->field == null) {
                    $user = User::where('status', '1')->paginate(10);
                } else {
                    $user = User::where('status', '1')->where($request->field, 'like', '%' . $request->search . '%')->paginate(10);
                }

                $user->appends(['field' => $request->field, 'search' => $request->search]);

                return response()->json([
                    'success' => 'true',
                    'info' => $user,
                ], 200);
            } else {
                if ($request->field == null) {
                    $user = User::where('status', '1')->get();
                } else {
                    $user = User::where('status', '1')->where($request->field, 'like', '%' . $request->search . '%')->get();
                }

                $count = $user->count();
                return response()->json([
                    'success' => 'true',
                    'data' => [
                        'users' => UserResource::collection($user),
                        'total' => $count,
                    ],
                ], 200);
            }
        } catch (AuthorizationException $e) {
            return response()->json(['message' => 'This Action is Unauthorized',], 403);
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
                return response()->json([
                    'message' => 'Successfully created User!',
                    'info' => new UserResource($user),
                ], 201);
            }

            return response()->json([
                'message' => 'Failed to create User!',
            ], 500);
        } catch (AuthorizationException $e) {
            return response()->json(['message' => 'This Action is Unauthorized',], 403);
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
                'message' => 'Successfully get User!',
                'info' => new UserResource($user),
            ], 200);
        } catch (AuthorizationException $e) {
            return response()->json(['message' => 'This Action is Unauthorized',], 403);
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

            return response()->json([
                'message' => "Successfully Updated User"
            ], 200);
        } catch (AuthorizationException $e) {
            return response()->json(['message' => 'This Action is Unauthorized',], 403);
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
                'message' => 'Failed To Delete User',
            ], 500);
        } catch (AuthorizationException $e) {
            return response()->json(['message' => 'This Action is Unauthorized',], 403);
        }

    }
}
