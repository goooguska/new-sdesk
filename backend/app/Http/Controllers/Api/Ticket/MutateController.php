<?php

namespace App\Http\Controllers\Api\Ticket;

use App\Contracts\Services\TicketService;
use App\Http\Requests\Ticket\CreateRequest;
use App\Http\Requests\Ticket\UpdateRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class MutateController
{
    public function __construct(private readonly TicketService $ticketService) {}

    public function create(CreateRequest $request): ?JsonResponse
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

    public function update(UpdateRequest $request, string $ticketId): ?JsonResponse
    {
        try {
            $data = $this->ticketService->update(
                $ticketId,
                $request->all()
            );

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

    public function delete(Request $request, string $ticketId): ?JsonResponse
    {
        try {
            $deleted = $this->ticketService->delete($ticketId);

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
