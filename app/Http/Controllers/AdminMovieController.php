<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Models\Movie;

class AdminMovieController extends Controller
{
    public function index()
    {
        $movies = Movie::all();
        return view('admin/movies', ['movies' => $movies]);
    }

}
