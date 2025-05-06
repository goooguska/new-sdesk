<?php

namespace App\Http\Controllers\Api\Admin\User;

use App\Contracts\Services\Admin\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UpdateRequest;
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
        string $userId,
        UserService $service
    )
    {
        try {
            $data = $service->update($userId, $request->all());

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
