<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Movie;
use App\Models\Schedule;
use Carbon\CarbonImmutable;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $movies = Movie::all();

        $baseSchedules = [
            ['start_time' => '10:00', 'end_time' => '12:00'],
            ['start_time' => '14:00', 'end_time' => '16:00'],
            ['start_time' => '19:00', 'end_time' => '21:00']
        ];

        // テストの再現性のために固定の日付を使用
        $baseDate = CarbonImmutable::create(2025, 4, 26);
        
        // 基準日から3日分のスケジュールを作成
        for ($i = 1; $i <= 3; $i++) {
            $targetDate = $baseDate->copy()->addDays($i)->format('Y-m-d');

            foreach ($movies as $movie) {
                foreach ($baseSchedules as $schedule) {
                    Schedule::create([
                        'movie_id' => $movie->id,
                        'start_time' => $targetDate . ' ' . $schedule['start_time'],
                        'end_time' => $targetDate . ' ' . $schedule['end_time'],
                        'created_at' => $baseDate,
                        'updated_at' => $baseDate,
                    ]);
                }
            }
        }
    }
}
