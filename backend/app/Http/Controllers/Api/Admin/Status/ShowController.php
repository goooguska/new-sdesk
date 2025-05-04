<?php

namespace App\Http\Controllers\Api\Admin\Status;

use App\Contracts\Services\Admin\StatusService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
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
        } catch (NotFoundHttpException $e) {
            return new JsonResponse([
                'error' => $e->getMessage(),
            ], 404);
        }

        return new JsonResponse([
            'data' => $data,
        ]);
    }
}
