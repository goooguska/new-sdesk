<?php

namespace App\Http\Requests\Admin\Category;

use App\Traits\Authorized;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    use Authorized;

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Название статуса обязательно для заполнения',
        ];
    }
}
