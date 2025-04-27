<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->categories() as $category) {
            Category::factory()->create([
                'name' => $category,
            ]);
        }
    }

    private function categories(): array
    {
        return [
            'IT-поддержка',
            'Оборудование и техника',
            'Кадровые вопросы',
            'Финансы и зарплата',
            'Административные вопросы'
        ];
    }
}
