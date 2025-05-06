<?php

namespace App\Http\Presenters\Api\Auth;

use App\Models\User;

class AuthUserPresenter
{
    public function __construct(private readonly User $user,) {}

    public static function make(User $user): array
    {
        return (new self($user))->present();
    }

    private function present(): array
    {
        return [
            'id' => $this->user->id,
            'name' => $this->user->name,
            'surname' => $this->user->surname,
            'email' => $this->user->email,
            'login' => $this->user->login,
            'role' => $this->user->role['name'],
            'role_code' => $this->user->role['code']
        ];
    }
}
