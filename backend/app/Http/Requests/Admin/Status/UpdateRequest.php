<?php

namespace App\Http\Requests\Admin\Status;

use App\Traits\Authorized;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    use Authorized;

    public function rules(): array
    {
        return [
            'name' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
