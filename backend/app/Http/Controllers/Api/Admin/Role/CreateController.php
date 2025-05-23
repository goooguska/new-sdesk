<?php

namespace App\Http\Controllers\Api\Admin\Role;

use App\Contracts\Services\Admin\RoleService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\CreateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class CreateController extends Controller
{
    public function __invoke(
        CreateRequest $request,
        RoleService $service
    )
    {
        try {
            $data = $service->create($request->all());

            return new JsonResponse([
                'data' => $data,
            ], 201);
        } catch (Throwable $e) {
            Log::error($e->getMessage(), ['exception' => $e]);

            return new JsonResponse([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
