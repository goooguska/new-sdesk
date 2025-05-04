<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->users() as $user) {
            User::factory()->create($user);
        }
    }

    private function users(): array
    {
        $roleAdminId = Role::where('code', 'admin')->value('id');
        $roleManagerId = Role::where('code', 'manager')->value('id');
        $roleUserId = Role::where('code', 'user')->value('id');

        return [
            [
                'full_name' => 'Test Admin',
                'email' => 'admin@admin.com',
                'login' => 'admin',
                'password' => Hash::make('Test1234!'),
                'role_id' => $roleAdminId
            ],
            [
                'full_name' => 'Test Manager',
                'email' => 'manager@manager.com',
                'login' => 'manager',
                'password' => Hash::make('Test1234!'),
                'role_id' => $roleManagerId
            ],
            [
                'full_name' => 'Test User',
                'email' => 'user@user.com',
                'login' => 'user',
                'password' => Hash::make('Test1234!'),
                'role_id' => $roleUserId
            ],
        ];
    }
}
