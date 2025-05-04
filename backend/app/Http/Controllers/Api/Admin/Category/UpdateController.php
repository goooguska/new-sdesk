<?php

namespace App\Http\Controllers\Api\Admin\Category;

use App\Contracts\Services\Admin\CategoryService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\UpdateRequest;
use Illuminate\Http\JsonResponse;

class UpdateController extends Controller
{
    public function __invoke(
        UpdateRequest $request,
        string $categoryId,
        CategoryService $service
    )
    {
        $data = $service->update($categoryId, $request->all());

        return new JsonResponse([
            'data' => $data,
        ], 200);
    }
}
