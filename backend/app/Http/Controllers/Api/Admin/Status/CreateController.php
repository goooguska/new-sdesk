<?php

namespace App\Http\Controllers\Api\Admin\Status;

use App\Contracts\Services\Admin\StatusService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Status\CreateRequest;
use Illuminate\Http\JsonResponse;

class CreateController extends Controller
{
    public function __invoke(
        CreateRequest $request,
        StatusService $service
    )
    {
        $data = $service->create($request->all());

        return new JsonResponse([
            'data' => $data,
        ], 200);
    }
}
