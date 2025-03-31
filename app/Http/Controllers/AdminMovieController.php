<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Models\Movie;
use Illuminate\Support\Facades\Validator;

class AdminMovieController extends Controller
{
    public function index()
    {
        $movies = Movie::all();
        return view('admin/movies', ['movies' => $movies]);
    }

    public function create()
    {
        return view('admin/create');
    }

    public function store()
    {
        $validator = Validator::make(request()->all(), [
            'title' => 'required|string|unique:movies,title',
            'image_url' => 'required|url',
            'published_year' => 'required|integer',
            'is_showing' => 'boolean',
            'description' => 'required|string',
        ]);
        $validator->validate();
        if ($validator->fails()) {
            session()->flash('errors', $validator->errors()->messages());
            return redirect()->back()->withInput();
        }

        $movie = new Movie();
        $movie->title = request('title');
        $movie->image_url = request('image_url');
        $movie->published_year = request('published_year');
        $movie->is_showing = request('is_showing') ? 1 : 0;
        $movie->description = request('description');
        $movie->save();

        return redirect()->route('admin.movies.create')->with([
            'message' => '映画が作成されました',
        ]);
    }
}
