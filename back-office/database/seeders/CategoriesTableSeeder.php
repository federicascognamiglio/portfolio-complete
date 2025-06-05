<?php

namespace Database\Seeders;

use App\CategoryEnum;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (CategoryEnum::cases() as $case) {
            Category::updateOrCreate(
                [ 'name' => $case->value ],
                [ 'description' => $case->description() ]
            );
        }
    }
}