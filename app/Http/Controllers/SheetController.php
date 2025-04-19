<?php

namespace App\Http\Controllers;

use App\Models\Sheet;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SheetController extends Controller
{
    public function index()
    {
        $_sheets = Sheet::all();
        $sheets = [];
        foreach ($_sheets as $sheet) {
            $sheets[$sheet->row][$sheet->column] = $sheet;
        }
        return view('sheets', ['sheets' => $sheets]);
    }

    public function reserve(Request $request)
    {
        // dateがなければ400を返す
        // 日付フォーマットのバリデーションはあえて緩くしている
        $validator = Validator::make(request()->all(), [
            'date' => 'required|date|after_or_equal:today',
        ]);
        if ($validator->fails()) {
            if ($validator->errors()->has('date')) {
                abort(400, '日付を指定してください。');
            }
        }

        $_sheets = Sheet::all();
        $sheets = [];
        foreach ($_sheets as $sheet) {
            $sheets[$sheet->row][$sheet->column] = $sheet;
        }
        $schedule = Schedule::find($request->schedule_id);
        return view('sheets', ['sheets' => $sheets, 'request' => $request, 'schedule' => $schedule]);
    }
}
