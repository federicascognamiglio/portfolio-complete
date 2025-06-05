<?php

namespace Database\Seeders;

use App\TypeEnum;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (TypeEnum::cases() as $case) {
            Type::updateOrCreate(
                [
                    'name' => $case->value,
                    'category_id' => $case->categoryId()
                ],
            );
        }
    }
}
