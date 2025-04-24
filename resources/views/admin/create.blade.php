<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Practice</title>
</head>
<body>
    <form action="{{ route('admin.movies.store') }}" method="POST">
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
                {{ __('Movie Title') }}
                <input type="text" name="title" value="{{ old('title') }}" required>
            </label>
        </div>
        <div>
            <label>
                {{ __('Image URL') }}
                <input type="url" name="image_url" value="{{ old('image_url') }}" required>
            </label>
        </div>
        <div>
            <label>
                {{ __('Published Year') }}
                <input type="number" name="published_year" maxlength="4" value="{{ old('published_year') }}" required>
            </label>
        </div>
        <div>
            <label>
                {{ __('Is Showing') }}
                <input type="checkbox" name="is_showing" value="1" {{ old('is_showing') ? 'checked' : '' }}>
            </label>
        </div>
        <div>
            <label>
                {{ __('Description') }}
                <textarea name="description" rows="4" cols="40" required>{{ old('description') }}</textarea>
            </label>
        </div>
        <div>
            <label>
                {{ __('Genre Name') }}
                <input type="text" name="genre" value="{{ old('genre') }}" required>
            </label>
        </div>
        <div>
            <button type="submit">{{ __('Submit') }}</button>
            <a href="{{ route('admin.movies.index') }}">{{ __('Back') }}</a>
        </div>
    </form>
</body>
</html>
