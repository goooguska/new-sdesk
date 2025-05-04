<?php

namespace App\Http\Controllers\Api\Admin\Category;

use App\Contracts\Services\Admin\CategoryService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ShowController extends Controller
{
    public function __invoke(
        string $categoryId,
        CategoryService $service,
    )
    {
        try {
            $data = $service->getById($categoryId);
        } catch (NotFoundHttpException $e) {
            return new JsonResponse([
                'error' => $e->getMessage(),
            ], 404);
        }

        return new JsonResponse([
            'data' => $data,
        ], 200);
    }
}
