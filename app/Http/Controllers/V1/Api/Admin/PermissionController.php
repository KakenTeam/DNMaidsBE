<?php

namespace App\Http\Controllers\V1\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Permission;
use Illuminate\Auth\Access\AuthorizationException;

class PermissionController extends Controller
{
    public function index()
    {
        try {
            $this->authorize('index', new Group());
            $permissons = Permission::where('id', '!=', '1')->get();

            return response()->json([
                'success' => 'true',
                'data' => $permissons
            ],
                200);

        } catch (AuthorizationException $e) {
            return response()->json([
                'message' => 'Bạn không có quyền để thực hiện hành động này.',
            ], 403);
        }

    }
}
