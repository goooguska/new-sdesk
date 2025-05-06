<?php

namespace App\Http\Controllers\Api\Admin\Category;

use App\Contracts\Services\Admin\CategoryService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\UpdateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UpdateController extends Controller
{
    public function __invoke(
        UpdateRequest $request,
        string $categoryId,
        CategoryService $service
    )
    {
        try {
            $data = $service->update($categoryId, $request->all());

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
