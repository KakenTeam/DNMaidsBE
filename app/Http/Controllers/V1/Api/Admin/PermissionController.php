<?php

namespace App\Http\Controllers\V1\Api\Admin;

use App\Models\Group;
use App\Models\Permission;
use Illuminate\Auth\Access\AuthorizationException;

use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    public function index () {
        try {
            $this->authorize('index', new Group());
            $permissons = Permission::where('id', '!=', '1')->get();

            return response()->json(
                $permissons,
                200);

        } catch (AuthorizationException $e) {
            return response()->json([
                'message' => 'This Action is Unauthorized',
            ], 403);
        }

    }
}
