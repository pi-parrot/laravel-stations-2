<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
// use Faker\Factory as Faker;
use App\Models\Genre;
use App\Models\Movie;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::statement('SET FOREIGN_KEY_CHECKS=0');
        // Movie::truncate();
        // Genre::truncate();
        // DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $genres = ['アクション', '恋愛', 'SF', 'ドラマ', 'アニメ'];
        foreach ($genres as $genre) {
            Genre::firstOrCreate([
                'name' => $genre,
            ]);
        }

        // $faker = Faker::create('ja_JP');
        // ジャンルのIDを配列として取得する
        $genreIds = Genre::pluck('id')->all();

        for ($i = 1; $i <= 41; $i++) {
            $bg_color = sprintf('%02x%02x%02x', rand(0, 99), rand(0, 99), rand(0, 99));
            // この条件に一致する映画が既にあれば取得する(取得した値は使わないので、何もしない)
            $param = [
                'genre_id' => $genreIds[array_rand($genreIds)],
                'title' => '映画タイトル' . $i,
            ];
            // なければこの値を追加して新規作成する
            $defaults = [
                'image_url' => 'https://placehold.jp/' . $bg_color . '/ffffff/640x480.png',
                'published_year' => rand(2000, 2025),
                'is_showing' => rand(0, 1),
                'description' => '映画の概要' . $i,
            ];
            Movie::firstOrCreate($param, $defaults);
        }
    }
}
