<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sheet;

class SheetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (['a', 'b', 'c'] as $row) {
            for ($column = 1; $column <= 5; $column++) {
                Sheet::create([
                    'column' => $column,
                    'row' => $row,
                ]);
            }
        }
    }
}
