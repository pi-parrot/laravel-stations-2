<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Practice</title>
</head>
<body>
    <form action="{{ route('admin.schedules.update', $schedule->id) }}" method="POST">
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
                {{ $schedule->id }}
            </label>
        </div>
        <div>
            <label>
                {{ __('Movie ID') }}
                {{ $schedule->movie_id }}
            </label>
            <input type="hidden" name="movie_id" value="{{ $schedule->movie_id }}">
        </div>
        <div>
            <label>
                {{ __('Start Date') }}
                <input type="date" name="start_time_date" value="{{ $schedule->start_time->format('Y-m-d') }}" required>
            </label>
            <label>
                {{ __('Start Time') }}
                <input type="time" name="start_time_time" value="{{ $schedule->start_time->format('H:i') }}" required>
            </label>
        </div>
        <div>
            <label>
                {{ __('End Date') }}
                <input type="date" name="end_time_date" value="{{ $schedule->end_time->format('Y-m-d') }}" required>
            </label>
            <label>
                {{ __('End Time') }}
                <input type="time" name="end_time_time" value="{{ $schedule->end_time->format('H:i') }}" required>
            </label>
        </div>
        <div>
            <label>
                {{ __('Created At') }}
                {{ $schedule->created_at }}
            </label>
        </div>
        <div>
            <label>
                {{ __('Updated At') }}
                {{ $schedule->updated_at }}
            </label>
        </div>
        <div>
            <button type="submit">{{ __('Submit') }}</button>
            <a href="{{ route('admin.schedules.index', $schedule->movie_id) }}">{{ __('Back') }}</a>
        </div>
    </form>
</body>
</html>
