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
                'name' => 'Admin',
                'surname' => 'Adminov',
                'email' => 'admin@admin.com',
                'login' => 'admin',
                'password' => Hash::make('Test1234!'),
                'role_id' => $roleAdminId
            ],
            [
                'name' => 'Manager1',
                'surname' => 'Managerov1',
                'email' => 'manager1@manager.com',
                'login' => 'manager1',
                'password' => Hash::make('Test1234!'),
                'role_id' => $roleManagerId
            ],
            [
                'name' => 'Manager2',
                'surname' => 'Managerov2',
                'email' => 'manager2@manager.com',
                'login' => 'manager2',
                'password' => Hash::make('Test1234!'),
                'role_id' => $roleManagerId
            ],
            [
                'name' => 'Manager3',
                'surname' => 'Managerov3',
                'email' => 'manager3@manager.com',
                'login' => 'manager3',
                'password' => Hash::make('Test1234!'),
                'role_id' => $roleManagerId
            ],
            [
                'name' => 'User1',
                'surname' => 'Userov1',
                'email' => 'user1@user.com',
                'login' => 'user1',
                'password' => Hash::make('Test1234!'),
                'role_id' => $roleUserId
            ],
            [
                'name' => 'User2',
                'surname' => 'Userov2',
                'email' => 'user2@user.com',
                'login' => 'user2',
                'password' => Hash::make('Test1234!'),
                'role_id' => $roleUserId
            ],
            [
                'name' => 'User3',
                'surname' => 'Userov3',
                'email' => 'user3@user.com',
                'login' => 'user3',
                'password' => Hash::make('Test1234!'),
                'role_id' => $roleUserId
            ],
        ];
    }
}
