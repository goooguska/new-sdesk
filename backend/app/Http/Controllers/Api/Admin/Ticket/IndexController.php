<?php

namespace App\Http\Controllers\Api\Admin\Ticket;

use App\Contracts\Services\Admin\TicketService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke(
        Request $request,
        TicketService $service
    )
    {
        $data = $service->getAll();

        return new JsonResponse([
            'data' => $data,
        ], 200);
    }
}
