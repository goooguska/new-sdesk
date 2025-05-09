<?php

namespace App\Http\Requests\Ticket;

use App\Traits\Authorized;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    use Authorized;

    public function rules(): array
    {
        return [
            'status_id' => 'required|exists:statuses,id',
        ];
    }

    public function messages(): array
    {
        return [
            'status_id.required' => 'Не указан статус заявки.',
            'status_id.exists' => 'Указанный статус не найден.',
        ];
    }
}
