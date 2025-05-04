<?php

namespace App\Http\Controllers\Api\Admin\Role;

use App\Contracts\Services\Admin\RoleService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function __invoke(
        Request $request,
        string $roleId,
        RoleService $service
    )
    {
        return new JsonResponse([
            'success' => $service->delete($roleId)
        ], 200);
    }
}
