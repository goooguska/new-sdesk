<?php

namespace App\Http\Controllers\Api\Admin\Ticket;

use App\Contracts\Services\Admin\TicketService;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DeleteController extends Controller
{
    public function __invoke(
        Request $request,
        string $ticketId,
        TicketService $service
    )
    {
        try {
            $deleted = $service->delete($ticketId);

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
