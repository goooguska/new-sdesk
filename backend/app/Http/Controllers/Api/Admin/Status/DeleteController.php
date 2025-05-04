<?php

namespace App\Http\Controllers\Api\Admin\Status;

use App\Contracts\Services\Admin\StatusService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function __invoke(
        Request $request,
        string $statusId,
        StatusService $service
    )
    {
        return new JsonResponse([
            'success' => $service->delete($statusId)
        ], 200);
    }
}
