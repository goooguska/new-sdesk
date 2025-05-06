<?php

namespace App\Http\Requests\Admin\User;

use App\Traits\Authorized;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    use Authorized;

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'login' => 'required|string|max:255|unique:users,login',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[A-ZА-Я])(?=.*[\W_]).+$/u'
            ],
            'role_id'  => 'required|exists:roles,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Поле имени обязательно для заполнения.',
            'name.string' => 'Имя должно быть строкой.',
            'name.max' => 'Имя не должно превышать 255 символов.',

            'surname.required' => 'Поле фамилии обязательно для заполнения.',
            'surname.string' => 'Фамилия должна быть строкой.',
            'surname.max' => 'Фамилия не должна превышать 255 символов.',

            'email.required' => 'Поле email обязательно для заполнения.',
            'email.email' => 'Введите корректный email.',
            'email.unique' => 'Такой email уже используется.',

            'login.required' => 'Поле логин обязательно для заполнения.',
            'login.string' => 'Логин должен быть строкой.',
            'login.max' => 'Логин не должен превышать 255 символов.',
            'login.unique' => 'Такой логин уже используется.',

            'password.required' => 'Поле пароль обязательно для заполнения.',
            'password.string' => 'Пароль должен быть строкой.',
            'password.min' => 'Пароль должен содержать не менее 8 символов.',
            'password.regex' => 'Пароль должен содержать хотя бы одну заглавную букву и один специальный символ.',
            'password.confirmed' => 'Пароль и его подтверждение не совпадают.',

            'role_id.required' => 'Не указана роль пользователя.',
            'role_id.exists' => 'Указанная роль не существует',
        ];
    }
}

