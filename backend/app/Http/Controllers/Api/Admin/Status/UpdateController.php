<?php

namespace App\Http\Controllers\Api\Admin\Status;

use App\Contracts\Services\Admin\StatusService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Status\UpdateRequest;
use Illuminate\Http\JsonResponse;

class UpdateController extends Controller
{
    public function __invoke(
        UpdateRequest $request,
        string $statusId,
        StatusService $service
    )
    {
        $data = $service->update($statusId, $request->all());

        return new JsonResponse([
            'data' => $data,
        ], 200);
    }
}
