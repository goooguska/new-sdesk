<?php

namespace App\Http\Controllers\Api\Admin\Ticket;

use App\Contracts\Services\Admin\TicketService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ticket\UpdateRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UpdateController extends Controller
{
    /**
     * @throws Exception
     */
    public function __invoke(
        UpdateRequest $request,
        string $ticketId,
        TicketService $service
    )
    {
        try {
            $data = $service->update($ticketId, $request->all());

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
