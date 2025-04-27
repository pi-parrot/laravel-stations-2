<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Schedule;
use App\Models\Sheet;
use Illuminate\Support\Facades\Validator;
// use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Log;

class AdminReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Reservation::withWhereHas('schedule', function ($query) {
            $query->where('end_time', '>=', now());
        })->whereHas('sheet')->with('schedule.movie', 'sheet')->get();
        // $reservations = Reservation::withWhereHas('schedule', function ($query) {
        //     $query->where('end_time', '>=', now());
        // })->withWhereHas('sheet', function ($query) {
        //     $query->where('row', '!=', null);
        // })->with('schedule.movie')->get();
        // Log::info('Reservations query:', [
        //     'query' => $reservations->toArray(),
        //     'now' => now(),
        // ]);
        Log::info('Reservations result:', [
            'reservations' => $reservations->toArray(),
            'now' => now(),
        ]);

        return view('admin.reservations.index', ['reservations' => $reservations]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // パラメータに何も受け取らない
        // スケジュールと座席を選択させる
        $schedules = Schedule::with('movie')->where('end_time', '>=', now())->orderBy('start_time', 'asc')->get();
        $sheets = Sheet::all();
        return view('admin.reservations.create', ['schedules' => $schedules, 'sheets' => $sheets]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 日付フォーマットのバリデーションはあえて緩くしている
        // schedule_id, sheet_idのユニークチェックは後で別途行うため
        // バリデータ側では行わない
        $validator = Validator::make(request()->all(), [
            // 'id' => 'required',
            'date' => 'required|date|after_or_equal:today',
            'schedule_id' => 'required',
            // 'sheet_id' => 'required|unique:reservations,sheet_id',
            'sheet_id' => 'required',
            'email' => 'required|email',
            'name' => 'required',
            // 'is_canceled' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // 映画IDは渡されて来ない場合があるので、スケジュールから取得する
        $schedule = Schedule::findOrFail($request->schedule_id);
        $movie_id = $schedule->movie_id;

        // schedule_id, sheet_idのユニークチェック
        $existingReservation = Reservation::where('schedule_id', $request->schedule_id)
            ->where('sheet_id', $request->sheet_id)
            ->first();
        if ($existingReservation) {
            return redirect()->route('admin.reservations.index', [
                'movie_id' => $movie_id, 
                'schedule_id' => $request->schedule_id, 
                'date' => $request->date
            ])->withErrors(['error' => 'その座席はすでに予約済みです。']);
        }

        try {
            Reservation::create([
                'date' => $request->date,
                'schedule_id' => $request->schedule_id,
                'sheet_id' => $request->sheet_id,
                'email' => $request->email,
                'name' => $request->name,
                // 'is_canceled' => false,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => '予約に失敗しました。'])->withInput();
        }

        return redirect()->route('admin.reservations.index')->with(
            'message', '予約が完了しました。'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $reservation = Reservation::with('schedule', 'schedule.movie')->findOrFail($id);
        return view('admin.reservations.show', ['reservation' => $reservation]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $reservation = Reservation::with('schedule', 'schedule.movie')->findOrFail($id);
        return view('admin.reservations.edit', ['reservation' => $reservation]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update([
            'date' => $request->date,
            'schedule_id' => $request->schedule_id,
            'sheet_id' => $request->sheet_id,
            'email' => $request->email,
            'name' => $request->name,
        ]);
        return redirect()->route('admin.reservations.index')->with('message', '予約が更新されました。');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();
        return redirect()->route('admin.reservations.index')->with('message', '予約が削除されました。');
    }
}
