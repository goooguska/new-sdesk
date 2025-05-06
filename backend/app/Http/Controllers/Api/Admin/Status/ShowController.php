<?php

namespace App\Http\Controllers\Api\Admin\Status;

use App\Contracts\Services\Admin\StatusService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ShowController extends Controller
{
    public function __invoke(
        string $statusId,
        StatusService $service,
    )
    {
        try {
            $data = $service->getById($statusId);

            return new JsonResponse([
                'data' => $data,
            ]);
        } catch (NotFoundHttpException $e) {
            Log::error($e->getMessage(), ['exception' => $e]);

            return new JsonResponse([
                'error' => $e->getMessage(),
            ], 404);
        }
    }
}
