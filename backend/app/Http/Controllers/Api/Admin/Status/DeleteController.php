<?php

namespace App\Http\Controllers\Api\Admin\Status;

use App\Contracts\Services\Admin\StatusService;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DeleteController extends Controller
{
    public function __invoke(
        Request $request,
        string $statusId,
        StatusService $service
    )
    {
        try {
            $deleted = $service->delete($statusId);

            if ($deleted) {
                return new JsonResponse([
                    'success' => true
                ], 200);
            }

            return new JsonResponse([
                'error' => 'Ошибка удаления записи'
            ], 400);
        } catch (Exception $e) {
            Log::error($e->getMessage(), ['exception' => $e]);

            return new JsonResponse([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
