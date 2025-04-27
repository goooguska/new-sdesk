<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->statuses() as $status) {
            Status::factory()->create([
                'name' => $status,
            ]);
        }
    }

    private function statuses(): array
    {
        return [
            'Выполнена',
            'В работе',
            'Отклонена'
        ];
    }
}
