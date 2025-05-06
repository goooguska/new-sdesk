<?php

namespace App\Http\Requests\Admin\Ticket;

use App\Traits\Authorized;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    use Authorized;

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'assigned_id' => 'required|exists:users,id',
            'creator_id' => 'required|exists:users,id',
            'status_id' => 'required|exists:statuses,id',
            'category_id' => 'required|exists:categories,id',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Поле заголовка обязательно для заполнения.',
            'title.string' => 'Заголовок должен быть строкой.',
            'title.max' => 'Заголовок не должен превышать 255 символов.',

            'description.required' => 'Поле описания обязательно для заполнения.',
            'description.string' => 'Описание должно быть строкой.',

            'assigned_id.required' => 'Не указан исполнитель.',
            'assigned_id.exists' => 'Указанный исполнитель не найден.',

            'creator_id.required' => 'Не указан создатель заявки.',
            'creator_id.exists' => 'Указанный создатель не найден.',

            'status_id.required' => 'Не указан статус заявки.',
            'status_id.exists' => 'Указанный статус не найден.',

            'category_id.required' => 'Не указана категория заявки.',
            'category_id.exists' => 'Указанная категория не найдена.',
        ];
    }
}

