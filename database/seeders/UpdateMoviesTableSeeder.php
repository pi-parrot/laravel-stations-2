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
        // 特定のIDではなく、最新の映画を対象に更新
        Movie::latest()->take(6)->get()->each(function ($movie, $index) {
            $movie->update([
                'published_year' => rand(2000, 2025),
                'is_showing' => rand(0, 1),
                'description' => '映画の概要' . ($index + 1),
            ]);
        });
    }
}
