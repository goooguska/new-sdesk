<?php

namespace App\Http\Controllers\Api\Admin\Category;

use App\Contracts\Services\Admin\CategoryService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke(
        Request $request,
        CategoryService $service
    )
    {
        $data = $service->getAll();

        return new JsonResponse([
            'data' => $data,
        ], 200);
    }
}
