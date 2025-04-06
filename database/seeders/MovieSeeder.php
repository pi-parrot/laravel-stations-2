<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
// use Faker\Factory as Faker;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $faker = Faker::create('ja_JP');
        for ($i = 1; $i <= 41; $i++) {
            $bg_color = sprintf('%02x%02x%02x', rand(0, 99), rand(0, 99), rand(0, 99));
            $param = [
                'title' => '映画タイトル' . $i,
                // 'image_url' => $faker->imageUrl(640, 480),
                'image_url' => 'https://placehold.jp/' . $bg_color . '/ffffff/640x480.png',
                'published_year' => rand(2000, 2025),
                'is_showing' => rand(0, 1),
                'description' => '映画の概要' . $i,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            DB::table('movies')->insert($param);
        }
    }
}
