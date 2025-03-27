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
        $bg_color = [
            '660000',
            '006600',
            '000066',
            '333300',
            '330033',
            '003333',
        ];
        for ($i = 0; $i < 6; $i++) {
            $param = [
                'title' => '映画タイトル' . $i,
                // 'image_url' => $faker->imageUrl(640, 480),
                'image_url' => 'https://placehold.jp/' . $bg_color[$i] .'/ffffff/640x480.png',
                'created_at' => now(),
                'updated_at' => now(),
            ];
            DB::table('movies')->insert($param);
        }
    }
}
