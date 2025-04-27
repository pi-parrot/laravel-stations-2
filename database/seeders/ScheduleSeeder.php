<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Movie;
use App\Models\Schedule;
use Carbon\Carbon;
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

        $today = CarbonImmutable::today();
        
        // 本日から3日分のスケジュールを作成
        for ($i = 1; $i <= 3; $i++) {
            $targetDate = $today->copy()->addDays($i)->format('Y-m-d');

            foreach ($movies as $movie) {
                foreach ($baseSchedules as $schedule) {
                    Schedule::create([
                        'movie_id' => $movie->id,
                        'start_time' => $targetDate . ' ' . $schedule['start_time'],
                        'end_time' => $targetDate . ' ' . $schedule['end_time'],
                        'created_at' => CarbonImmutable::now(),
                        'updated_at' => CarbonImmutable::now(),
                    ]);
                }
            }
        }
    }
}
