<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Schedule;
use Illuminate\Support\Facades\Validator;

class ReservationController extends Controller
{
    public function create(Request $request)
    {
        // 日付フォーマットのバリデーションはあえて緩くしている
        // schedule_id, sheet_idのユニークチェックは後で別途行うため
        // バリデータ側では行わない
        $validator = Validator::make(request()->all(), [
            'date' => 'required|date|after_or_equal:today',
            'schedule_id' => 'required',
            'sheetId' => 'required',
        ]);

        if ($validator->fails()) {
            if ($validator->errors()->has('date')) {
                abort(400, '日付を指定してください。');
            } elseif ($validator->errors()->has('sheetId')) {
                abort(400, '座席IDを指定してください。');
            }
        }

        // schedule_id, sheet_idのユニークチェック
        $existingReservation = Reservation::where('schedule_id', $request->schedule_id)
            ->where('sheet_id', $request->sheetId)
            ->first();
        if ($existingReservation) {
            abort(400, 'その座席はすでに予約済みです。');
        }

        $schedule = Schedule::with('movie')->find($request->schedule_id);
        return view('reservations.create', ['schedule' => $schedule, 'request' => $request]);
    }

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
            return redirect()->route('sheets.reserve', [
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

        return redirect()->route('movies.show', ['id' => $movie_id])->with(
            'message', '予約が完了しました。'
        );
    }
}
