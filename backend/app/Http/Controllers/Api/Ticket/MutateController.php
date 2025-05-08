<?php

namespace App\Http\Controllers\Api\Ticket;

use App\Contracts\Services\TicketService;
use App\Http\Requests\Ticket\CreateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class MutateController
{
    public function __construct(private readonly TicketService $ticketService) {}

    public function create(CreateRequest $request)
    {
        try {
            $data = $this->ticketService->createTicket($request->all());

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
