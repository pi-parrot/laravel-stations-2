<?php

namespace App\Http\Controllers;

use App\Models\Sheet;
use Illuminate\Http\Request;

class SheetController extends Controller
{
    public function index()
    {
        $_sheets = Sheet::all();
        $sheets = [];
        foreach ($_sheets as $sheet) {
            $sheets[$sheet->row][$sheet->column] = "{$sheet->row}-{$sheet->column}";
        }
        return view('sheets', ['sheets' => $sheets]);
    }
}
