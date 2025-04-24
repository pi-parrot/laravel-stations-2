<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Practice</title>
</head>
<body>
    <form action="{{ route('movies.index') }}" method="GET">
        <div>
            <label>
                {{ __('Keyword') }}
                <input type="text" name="keyword" value="{{ request('keyword') }}">
            </label>
        </div>
        <div>
            {{ __('Is Showing Status') }}
            <label>
                <input type="radio" name="is_showing" value="" {{ !in_array(request('is_showing'), ['0', '1']) ? 'checked' : '' }}>
                {{ __('All') }}
            </label>
            <label>
                <input type="radio" name="is_showing" value="1" {{ request('is_showing') === '1' ? 'checked' : '' }}>
                {{ __('Showing Status Showing') }}
            </label>
            <label>
                <input type="radio" name="is_showing" value="0" {{ request('is_showing') === '0' ? 'checked' : '' }}>
                {{ __('Showing Status Not Showing') }}
            </label>
        </div>
        <div>
            <button type="submit">{{ __('Search') }}</button>
        </div>
    </form>

    {{ $movies->appends(request()->query())->links() }}

    @foreach ($movies as $movie)
    <a href="{{ route('movies.show', $movie->id) }}">
        <div>{{ $movie->title }}</div>
        <img src="{{ $movie->image_url }}" alt="{{ $movie->title }}">
    </a>
    @endforeach

    {{ $movies->appends(request()->query())->links() }}
</body>
</html>
