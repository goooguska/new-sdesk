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
            'full_name' => $this->user->full_name,
            'email' => $this->user->email,
            'login' => $this->user->login,
            'role' => $this->user->role['name']
        ];
    }
}
