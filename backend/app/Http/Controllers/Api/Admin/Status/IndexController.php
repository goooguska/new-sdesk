<?php

namespace App\Http\Controllers\Api\Admin\Status;

use App\Contracts\Services\Admin\StatusService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke(
        Request $request,
        StatusService $service
    )
    {
        $data = $service->getAll();

        return new JsonResponse([
            'data' => $data,
        ], 200);
    }
}
