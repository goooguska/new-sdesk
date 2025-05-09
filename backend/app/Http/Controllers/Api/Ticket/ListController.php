<?php

namespace App\Http\Controllers\Api\Ticket;

use App\Contracts\Services\TicketService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListController
{
    public function __construct(private readonly TicketService $ticketService) {}

    public function tickets(Request $request): JsonResponse
    {
        $data = $this->ticketService->getAllForCurrentUser();

        return new JsonResponse([
            'data' => $data,
        ], 200);
    }
}
