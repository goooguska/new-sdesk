<?php

namespace App\Http\Controllers\Api\Admin\Category;

use App\Contracts\Services\Admin\CategoryService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\CreateRequest;
use Illuminate\Http\JsonResponse;

class CreateController extends Controller
{
    public function __invoke(
        CreateRequest $request,
        CategoryService $service
    )
    {
        $data = $service->create($request->all());

        return new JsonResponse([
            'data' => $data,
        ], 200);
    }
}
