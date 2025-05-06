<?php

namespace App\Http\Controllers\Api\Admin\Ticket;

use App\Contracts\Services\Admin\TicketService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ticket\CreateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class CreateController extends Controller
{
    public function __invoke(
        CreateRequest $request,
        TicketService $service
    )
    {
        try {
            $data = $service->create($request->all());

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
