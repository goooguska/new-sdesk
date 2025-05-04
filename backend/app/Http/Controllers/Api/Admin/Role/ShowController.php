<?php

namespace App\Http\Controllers\Api\Admin\Role;

use App\Contracts\Services\Admin\RoleService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ShowController extends Controller
{
    public function __invoke(
        string $roleId,
        RoleService $service,
    )
    {
        try {
            $data = $service->getById($roleId);
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
