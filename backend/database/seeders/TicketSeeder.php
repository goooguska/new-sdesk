<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Role;
use App\Models\Status;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TicketSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->tickets() as $ticket) {
            Ticket::factory()->create($ticket);
        }
    }

    private function tickets(): array
    {
        $roleManagerId = Role::where('code', 'manager')->value('id');
        $roleUserId = Role::where('code', 'user')->value('id');

        return [
            [
                'title' => 'Test',
                'description' => 'При попытке входа выдаёт 500 ошибку',
                'creator_id' => $roleUserId,
                'assigned_id' => $roleManagerId,
                'status_id' => Status::all()->random()->id,
                'category_id' => Category::all()->random()->id,
            ],
            [
                'title' => 'Test2',
                'description' => 'Нужно добавить фильтрацию по дате создания заявки.',
                'creator_id' => $roleUserId,
                'assigned_id' => $roleManagerId,
                'status_id' => Status::all()->random()->id,
                'category_id' => Category::all()->random()->id,
            ],
        ];
    }


}
