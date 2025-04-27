<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Rules\ValidateStartAndEndTimes;
// use Illuminate\Support\Facades\DB;
use Carbon\CarbonImmutable;

class AdminScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with('movie')->where('movie_id', request('id'))->orderBy('start_time', 'asc')->get();
        return view('admin.schedules.index', ['schedules' => $schedules, 'movie' => $schedules->first()->movie]);
    }

    public function create()
    {
        return view('admin.schedules.create', ['movie' => request('id')]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'movie_id' => 'required|exists:movies,id',
            'start_time_date' => 'required|date_format:Y-m-d|before_or_equal:end_time_date',
            'start_time_time' => [
                'required',
                'date_format:H:i',
                new ValidateStartAndEndTimes(),
            ],
            'end_time_date' => 'required|date_format:Y-m-d|after_or_equal:start_time_date',
            'end_time_time' => [
                'required',
                'date_format:H:i',
                new ValidateStartAndEndTimes(),
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $schedule = new Schedule();
        $schedule->create([
            'movie_id' => request('id'),
            'start_time' => request('start_time_date') . ' ' . request('start_time_time'),
            'end_time' => request('end_time_date') . ' ' . request('end_time_time'),
        ]);

        return redirect()->route('admin.schedules.index', request('id'))->with([
            'message' => 'スケジュールが作成されました',
        ]);
    }

    public function edit($id)
    {
        $schedule = Schedule::with('movie')->findOrFail($id);
        return view('admin.schedules.edit', ['schedule' => $schedule]);
    }

    public function update(Request $request, $scheduleId)
    {
        $validator = Validator::make(request()->all(), [
            'movie_id' => 'required|exists:movies,id',
            'start_time_date' => 'required|date_format:Y-m-d|before_or_equal:end_time_date',
            'start_time_time' => [
                'required',
                'date_format:H:i',
                new ValidateStartAndEndTimes(),
            ],
            'end_time_date' => 'required|date_format:Y-m-d|after_or_equal:start_time_date',
            'end_time_time' => [
                'required',
                'date_format:H:i',
                new ValidateStartAndEndTimes(),
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $schedule = Schedule::findOrFail($scheduleId);
        $schedule->update([
            'movie_id' => request('movie_id'),
            'start_time' => request('start_time_date') . ' ' . request('start_time_time'),
            'end_time' => request('end_time_date') . ' ' . request('end_time_time'),
        ]);

        return redirect()->route('admin.schedules.edit', ['scheduleId' => $scheduleId])->with([
            'message' => 'スケジュールが更新されました',
        ]);
    }

    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $movieId = $schedule->movie_id;
        $schedule->delete();
        return redirect()->route('admin.schedules.index', $movieId)->with([
            'message' => 'スケジュールが削除されました',
        ]);
    }

    public function show($id)
    {
        $schedule = Schedule::with('movie')->findOrFail($id);
        return view('admin.schedules.show', ['schedule' => $schedule, 'date' => CarbonImmutable::now()->format('Y-m-d')]);
    }   
}
