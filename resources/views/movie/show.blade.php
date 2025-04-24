<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Practice</title>
</head>
<body>
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
    <p>{{ __('ID') }}: {{ $movie->id }}</p>
    <h1>{{ $movie->title }}</h1>
    <img src="{{ $movie->image_url }}" alt="{{ $movie->title }}">
    <p>{{ __('Published Year') }}: {{ $movie->published_year }}</p>
    <p>{{ __('Is Showing') }}: {{ $movie->is_showing ? __('Showing Status Showing') : __('Showing Status Not Showing') }}</p>
    <p>{{ $movie->description }}</p>
    <p>{{ __('Genre') }}: {{ $movie->genre->name }}</p>
    {{--
    <p>登録日時: {{ $movie->created_at }}</p>
    <p>更新日時: {{ $movie->updated_at }}</p>
    --}}

    <h2>{{ __('Schedule') }}</h2>
    @if ($movie->schedules->isNotEmpty())
        <ul>
            @foreach ($movie->schedules as $schedule)
            <li>
                {{ $schedule->start_time->format('Y-m-d H:i') }} - {{ $schedule->end_time->format('Y-m-d H:i') }}
                <form action="{{ route('sheets.reserve', [$movie->id, $schedule->id]) }}" method="GET">
                    <input type="hidden" name="date" value="{{ $date }}">
                    <button type="submit" class="btn btn-primary">{{ __('Reserve Seat') }}</button>
                </form>
            </li>
            @endforeach
        </ul>
    @else
        <p>{{ __('No schedules available') }}</p>
    @endif
</body>
</html>
