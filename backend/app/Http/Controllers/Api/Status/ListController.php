<?php

namespace App\Http\Controllers\Api\Status;

use App\Contracts\Services\StatusService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function __construct(private readonly StatusService $statusService) {}

    public function statuses(Request $request): JsonResponse
    {
        $data = $this->statusService->getAll();

        return new JsonResponse([
            'data' => $data,
        ], 200);
    }
}
