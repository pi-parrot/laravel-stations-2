<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Models\Movie;
// use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{
    public function index()
    {
        // $movies = Movie::all();
        $query = Movie::query();
        // $query = Movie::with('schedules');

        if (request('keyword') !== null && request('keyword') !== '') {
            $keyword = request('keyword');
            $query->where(function ($query) use ($keyword) {
                $query->where('title', 'like', '%' . $keyword . '%')
                ->orWhere('description', 'like', '%' . $keyword . '%');
            });
        }

        if (request('is_showing') === '1') {
            $query = $query->where('is_showing', 1);
        } elseif (request('is_showing') === '0') {
            $query = $query->where('is_showing', 0);
        }

        $movies = $query->simplePaginate(20);

        return view('movie/index', ['movies' => $movies]);
    }

    public function show($id)
    {
        // $movie = Movie::findOrFail($id);
        // $schedules = DB::table('schedules')
        //     ->where('movie_id', $id)
        //     ->orderBy('start_time', 'asc')
        //     ->get();
        $movie = Movie::with('schedules')->findOrFail($id);

        return view('movie/show', [
            'movie' => $movie,
            // 'schedules' => $schedules,
        ]);
    }
}
