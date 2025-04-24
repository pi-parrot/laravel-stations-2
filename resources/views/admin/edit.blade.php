<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Practice</title>
</head>
<body>
    <form action="{{ route('admin.movies.update', $movie->id) }}" method="POST">
        @method('PATCH')
        @csrf
        @if (session('message'))
        <div>{{ session('message') }}</div>
        @endif
        @if (session('errors'))
        <div>
            @foreach (session('errors')->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
        @endif
        <div>
            <label>
                {{ __('ID') }}
                {{ $movie->id }}
            </label>
        </div>
        <div>
            <label>
                {{ __('Movie Title') }}
                <input type="text" name="title" value="{{ $movie->title }}" required>
            </label>
        </div>
        <div>
            <label>
                {{ __('Image URL') }}
                <input type="url" name="image_url" value="{{ $movie->image_url }}" required>
            </label>
        </div>
        <div>
            <label>
                {{ __('Published Year') }}
                <input type="number" name="published_year" maxlength="4" value="{{ $movie->published_year }}" required>
            </label>
        </div>
        <div>
            <label>
                {{ __('Is Showing') }}
                <input type="checkbox" name="is_showing" value="1" {{ $movie->is_showing ? 'checked' : '' }}>
            </label>
        </div>
        <div>
            <label>
                {{ __('Description') }}
                <textarea name="description" rows="4" cols="40" required>{{ $movie->description }}</textarea>
            </label>
        </div>
        <div>
            <label>
                {{ __('Genre Name') }}
                <input type="text" name="genre" value="{{ $movie->genre->name }}" required>
            </label>
        </div>
        <div>
            <label>
                {{ __('Created At') }}
                {{ $movie->created_at }}
            </label>
        </div>
        <div>
            <label>
                {{ __('Updated At') }}
                {{ $movie->updated_at }}
            </label>
        </div>
        <div>
            <button type="submit">{{ __('Submit') }}</button>
            <a href="{{ route('admin.movies.index') }}">{{ __('Back') }}</a>
        </div>
    </form>
</body>
</html>
