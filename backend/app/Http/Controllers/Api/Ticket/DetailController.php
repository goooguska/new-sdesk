<?php

namespace App\Http\Controllers\Api\Ticket;

use App\Contracts\Services\TicketService;
use App\Exceptions\TicketException;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DetailController extends Controller
{
    public function __construct(public readonly TicketService $ticketService) {}

    public function ticket(Request $request, string $ticketId): JsonResponse
    {
        try {
            $data = $this->ticketService->getTicketById($ticketId);

            return new JsonResponse([
                'data' => $data,
            ]);
        } catch (TicketException $e) {
            Log::error($e->getMessage(), ['exception' => $e]);

            return new JsonResponse([
                'error' => $e->getMessage(),
            ], 404);
        }
    }
}
