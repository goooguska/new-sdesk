<?php

namespace App\Http\Controllers\Api\Admin\Category;

use App\Contracts\Services\Admin\CategoryService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function __invoke(
        Request $request,
        string $categoryId,
        CategoryService $service
    )
    {
        return new JsonResponse([
            'success' => $service->delete($categoryId)
        ], 200);
    }
}
