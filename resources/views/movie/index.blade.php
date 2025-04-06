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
                キーワード
                <input type="text" name="keyword" value="{{ request('keyword') }}">
            </label>
        </div>
        <div>
            上映中かどうか
            <label>
                <input type="radio" name="is_showing" value="" {{ !in_array(request('is_showing'), ['0', '1']) ? 'checked' : '' }}>
                すべて
            </label>
            <label>
                <input type="radio" name="is_showing" value="1" {{ request('is_showing') === '1' ? 'checked' : '' }}>
                公開中
            </label>
            <label>
                <input type="radio" name="is_showing" value="0" {{ request('is_showing') === '0' ? 'checked' : '' }}>
                公開予定
            </label>
        </div>
        <div>
            <button type="submit">検索</button>
        </div>
    </form>

    {{ $movies->appends(request()->query())->links() }}

    @foreach ($movies as $movie)
    <div>
        <div>{{ $movie->title }}</div>
        <img src="{{ $movie->image_url }}" alt="{{ $movie->title }}">
    </div>
    @endforeach

    {{ $movies->appends(request()->query())->links() }}
</body>
</html>
