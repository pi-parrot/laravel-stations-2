<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $movies = DB::table('movies')->get();

        $schedules = [
            ['start' => '14:00', 'end' => '16:00'],
            ['start' => '10:00', 'end' => '12:00'],
            ['start' => '19:00', 'end' => '21:00']
        ];
        foreach ($movies as $movie) {
            foreach ($schedules as $schedule) {
                DB::table('schedules')->insert([
                    'movie_id' => $movie->id,
                    'start_time' => $schedule['start'],
                    'end_time' => $schedule['end'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
