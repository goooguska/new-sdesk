<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            StatusSeeder::class,
            RoleSeeder::class,
        ]);

        $this->makeTestAdmin();
    }

    private function makeTestAdmin(): void
    {
        $roleId = Role::where('code', 'admin')->first()->id;

        User::factory()->create([
            'full_name' => 'Test User',
            'email' => 'test@example.com',
            'login' => 'test',
            'password' => Hash::make('password'),
            'role_id' => $roleId
        ]);
    }
}
