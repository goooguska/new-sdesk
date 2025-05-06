<?php

namespace App\Http\Controllers\Api\Admin\Role;

use App\Contracts\Services\Admin\RoleService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\UpdateRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UpdateController extends Controller
{
    /**
     * @throws Exception
     */
    public function __invoke(
        UpdateRequest $request,
        string $roleId,
        RoleService $service
    )
    {
        try {
            $data = $service->update($roleId, $request->all());

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
