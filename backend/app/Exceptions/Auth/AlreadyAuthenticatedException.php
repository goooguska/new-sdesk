<?php

namespace App\Exceptions\Auth;

use Exception;
use Illuminate\Http\JsonResponse;

class AlreadyAuthenticatedException extends Exception
{
    public function render(): JsonResponse
    {
        return response()->json([
            'message' => $this->getMessage(),
            'errors' => [
                'auth' => ['User already authenticated']
            ]
        ], $this->getCode());
    }
}
