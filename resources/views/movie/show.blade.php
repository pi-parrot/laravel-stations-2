<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Practice</title>
</head>
<body>
    <p>ID: {{ $movie->id }}</p>
    <h1>{{ $movie->title }}</h1>
    <img src="{{ $movie->image_url }}" alt="{{ $movie->title }}">
    <p>公開年: {{ $movie->published_year }}</p>
    <p>上映中: {{ $movie->is_showing ? '上映中' : '上映予定' }}</p>
    <p>{{ $movie->description }}</p>
    <p>ジャンル: {{ $movie->genre->name }}</p>
    {{--
    <p>登録日時: {{ $movie->created_at }}</p>
    <p>更新日時: {{ $movie->updated_at }}</p>
    --}}

    <h2>スケジュール</h2>
    @if ($movie->schedules->isNotEmpty())
        <ul>
            @foreach ($movie->schedules as $schedule)
                <li>
                    {{ $schedule->start_time->format('H:i') }} - {{ $schedule->end_time->format('H:i') }}
                </li>
            @endforeach
        </ul>
    @else
        <p>スケジュールはありません</p>
    @endif
</body>
</html>
