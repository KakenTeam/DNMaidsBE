<?php

namespace App\Http\Controllers\V1\Api;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreUserRequest;

use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function signup(StoreUserRequest $request)
    {
        $user = new User();
        $user->fill($request->all());
        $user->save();
        return response()->json([
            'message' => 'Đăng ký thành công.'
        ], 201);
    }

    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(LoginRequest $request)
    {
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Đăng nhập thất bại.'
            ], 401);

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->save();

        return response()->json([
            'message' => 'Đăng nhập thành công.',
            'info' => [
                'user' => new UserResource($user),
            ],
            'token' => [
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString()
            ],
        ]);
    }

    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Đăng xuất thành công.'
        ], 200);
    }

    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        $user = new UserResource($request->user());
        return response()->json([
            'message' => 'Lấy dữ liệu người dùng thành công.',
            'info' => $user,
        ], 200);
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $user = $request->user();
        $user->update($request->except('password'));

        return response()->json([
            'message' => "Thay đổi thông tin thành công",
        ], 200);
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required | min: 6| old_password:' . $request->user()->password,
            'password' => 'required | min:6',
            'password_confirmation' => 'required | same:password',
        ]);
        if ($validator->fails()) {
            return response()->json([
               'message' => 'The given data was invalid.',
               'errors' => $validator->errors(),
            ], 422);
        }
        $user = $request->user();
        $user->update([
            'password' => $request->password,
        ]);

        return response()->json([
            'message' => "Thay đổi mật khẩu thành công.",
        ], 200);
    }
}
