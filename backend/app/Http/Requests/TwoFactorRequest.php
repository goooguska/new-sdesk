<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\Authorized;

class TwoFactorRequest extends FormRequest
{
    use Authorized;

    public function rules(): array
    {
        return [
            'email' => 'required|string|email|max:255',
            'code' => 'required|string|min:6|max:6',
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
