<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->roles() as $role) {
            Role::factory()->create([
                'name' => $role['name'],
                'code' => $role['code'],
            ]);
        }
    }

    private function roles(): array
    {
        return [
            [
                'name' => 'Администратор',
                'code' => 'admin',
            ],
            [
                'name' => 'Руководитель',
                'code' => 'manager',
            ],
            [
                'name' => 'Сотрудник',
                'code' => 'user',
            ]
        ];
    }
}
