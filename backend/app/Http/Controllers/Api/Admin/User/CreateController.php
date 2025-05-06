<?php

namespace App\Http\Controllers\Api\Admin\User;

use App\Contracts\Services\Admin\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\CreateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class CreateController extends Controller
{
    public function __invoke(
        CreateRequest $request,
        UserService $service
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
