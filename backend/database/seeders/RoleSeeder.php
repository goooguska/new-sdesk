<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->roles() as $role) {
            Role::factory()->create([
                'name' => $role,
            ]);
        }
    }

    private function roles(): array
    {
        return [
            'Руководитель',
            'Сотрудник',
        ];
    }
}
