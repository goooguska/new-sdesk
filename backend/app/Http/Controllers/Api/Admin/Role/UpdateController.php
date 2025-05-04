<?php

namespace App\Http\Controllers\Api\Admin\Role;

use App\Contracts\Services\Admin\RoleService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\UpdateRequest;
use Illuminate\Http\JsonResponse;

class UpdateController extends Controller
{
    public function __invoke(
        UpdateRequest $request,
        string $roleId,
        RoleService $service
    )
    {
        $data = $service->update($roleId, $request->all());

        return new JsonResponse([
            'data' => $data,
        ], 200);
    }
}
