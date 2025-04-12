<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Models\Movie;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Genre;

class AdminMovieController extends Controller
{
    public function index()
    {
        // $movies = Movie::all();
        // $query = Movie::query();
        $query = Movie::with('genre');

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
            'genre' => 'required|string',
        ]);
        $validator->validate();

        if ($validator->fails()) {
            session()->flash('errors', $validator->errors()->messages());
            return redirect()->back()->withInput();
        }

        DB::beginTransaction();
        try {
            $genre = Genre::firstOrCreate(['name' => request('genre')]);

            $movie = new Movie();
            $movie->create([
                'title' => request('title'),
                'image_url' => request('image_url'),
                'published_year' => request('published_year'),
                'is_showing' => request('is_showing') ? 1 : 0,
                'description' => request('description'),
                'genre_id' => $genre->id,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            // session()->flash('errors', ['error' => '映画の作成に失敗しました']);
            // return redirect()->back()->withInput();
            abort(500);
        }

        return redirect()->route('admin.movies.create')->with([
            'message' => '映画が作成されました',
        ]);
    }

    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        return view('admin/edit', ['movie' => $movie]);
    }

    public function update($id)
    {
        $validator = Validator::make(request()->all(), [
            'title' => 'required|string|unique:movies,title,' . $id,
            'image_url' => 'required|url',
            'published_year' => 'required|integer',
            'is_showing' => 'boolean',
            'description' => 'required|string',
            'genre' => 'required|string',
        ]);
        $validator->validate();

        if ($validator->fails()) {
            session()->flash('errors', $validator->errors()->messages());
            return redirect()->back()->withInput();
        }

        DB::beginTransaction();
        try {
            $genre = Genre::firstOrCreate(['name' => request('genre')]);

            $movie = Movie::findOrFail($id);
            // 個別にフィールドを書く癖がつくと大量割り当て保護の意味がなくなるので
            // 大量割り当てを使うべき
            $movie->update([
                'title' => request('title'),
                'image_url' => request('image_url'),
                'published_year' => request('published_year'),
                'is_showing' => request('is_showing') ? 1 : 0,
                'description' => request('description'),
                'genre_id' => $genre->id,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            // session()->flash('errors', ['error' => '映画の更新に失敗しました']);
            // return redirect()->back()->withInput();
            abort(500);
        }

        return redirect()->route('admin.movies.edit', ['id' => $id])->with([
            'message' => '映画が更新されました',
        ]);
    }

    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();
        return redirect()->route('admin.movies.index')->with([
            'message' => '映画が削除されました',
        ]);
    }

    public function show($id)
    {
        $movie = Movie::with('schedules')->findOrFail($id);
        return view('admin/show', ['movie' => $movie]);
    }
}
