<?php

namespace App\Http\Controllers\Api\Admin\User;

use App\Contracts\Services\Admin\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke(
        Request $request,
        UserService $service
    )
    {
        $data = $service->getAll();

        return new JsonResponse([
            'data' => $data,
        ], 200);
    }
}
