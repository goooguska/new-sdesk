<?php

namespace App\Http\Controllers\Api\Admin\Role;

use App\Contracts\Services\Admin\RoleService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\CreateRequest;
use Illuminate\Http\JsonResponse;

class CreateController extends Controller
{
    public function __invoke(
        CreateRequest $request,
        RoleService $service
    )
    {
        $data = $service->create($request->all());

        return new JsonResponse([
            'data' => $data,
        ], 200);
    }
}
