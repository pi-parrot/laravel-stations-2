<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SheetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (['a', 'b', 'c'] as $row) {
            for ($column = 1; $column <= 5; $column++) {
                DB::table('sheets')->insert([
                    'column' => $column,
                    'row' => $row,
                ]);
            }
        }
    }
}
