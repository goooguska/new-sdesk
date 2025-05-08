<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->statuses() as $status) {
            Status::factory()->create([
                'name' => $status['name'],
                'code' => $status['code'],
            ]);
        }
    }

    private function statuses(): array
    {
        return [
            [
                'name' => 'Выполнена',
                'code' => 'done',
            ],
            [
                'name' => 'В работе',
                'code' => 'work',
            ],
            [
                'name' => 'Отклонена',
                'code' => 'rejected',
            ],
        ];
    }
}
