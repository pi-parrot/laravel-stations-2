<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Practice</title>
</head>
<body>
    <form action="{{ route('admin.schedules.store', ['id' => request('id')]) }}" method="POST">
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
                {{ __('Movie ID') }}
                {{ request('id') }}
            </label>
            <input type="hidden" name="movie_id" value="{{ request('id') }}">
        </div>
        <div>
            <label>
                {{ __('Start Date') }}
                <input type="date" name="start_time_date" value="{{ old('start_time_date') }}" required>
            </label>
            <label>
                {{ __('Start Time') }}
                <input type="time" name="start_time_time" value="{{ old('start_time_time') }}" required>
            </label>
        </div>
        <div>
            <label>
                {{ __('End Date') }}
                <input type="date" name="end_time_date" value="{{ old('end_time_date') }}" required>
            </label>
            <label>
                {{ __('End Time') }}
                <input type="time" name="end_time_time" value="{{ old('end_time_time') }}" required>
            </label>
        </div>
        <div>
            <button type="submit">{{ __('Submit') }}</button>
            <a href="{{ route('admin.schedules.index', request('id')) }}">{{ __('Back') }}</a>
        </div>
    </form>
</body>
</html>
