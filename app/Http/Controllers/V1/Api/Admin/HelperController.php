<?php

namespace App\Http\Controllers\V1\Api\Admin;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HelperController extends Controller
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
                    $user = User::where('status', '1')
                        ->where('role', '1')->paginate(10);
                } else {
                    $user = User::where('status', '1')
                        ->where('role', '1')
                        ->where($request->field, 'like', '%' . $request->search . '%')
                        ->paginate(10);
                }

                $user->appends(['field' => $request->field, 'search' => $request->search]);

                return response()->json([
                    'success' => 'true',
                    'info' => $user,
                ], 200);
            } else {
                if ($request->field == null) {
                    $user = User::where('status', '1')
                        ->where('role', '1')
                        ->get();
                } else {
                    $user = User::where('status', '1')
                        ->where('role', '1')
                        ->where($request->field, 'like', '%' . $request->search . '%')
                        ->get();
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}