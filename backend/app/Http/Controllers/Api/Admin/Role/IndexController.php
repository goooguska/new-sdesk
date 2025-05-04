<?php

namespace App\Http\Controllers\Api\Admin\Role;

use App\Contracts\Services\Admin\RoleService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke(
        Request $request,
        RoleService $service
    )
    {
        $data = $service->getAll();

        return new JsonResponse([
            'data' => $data,
        ], 200);
    }
}
