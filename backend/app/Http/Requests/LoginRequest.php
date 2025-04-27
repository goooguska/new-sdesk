<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\Authorized;

class LoginRequest extends FormRequest
{
    use Authorized;

    public function rules(): array
    {
        return [
            'email' => 'required|string|email|max:255',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[A-ZА-Я])(?=.*[\W_]).+$/u'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Электронная почта обязательна для заполнения',
            'email.email' => 'Некорректный формат электронной почты',

            'password.required' => 'Пароль обязателен для заполнения',
            'password.min' => 'Пароль должен быть не менее :min символов',
            'password.regex' => 'Пароль должен содержать буквы в верхнем и нижнем регистре, цифры и специальные символы',
        ];
    }
}
