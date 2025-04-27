<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// use Illuminate\Support\Facades\DB;
use App\Models\Movie;

class UpdateMoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 13; $i <= 18; $i++) {
            Movie::where('id', $i)->update([
                'published_year' => rand(2000, 2025),
                'is_showing' => rand(0, 1),
                'description' => '映画の概要' . $i,
            ]);
        }
    }
}
