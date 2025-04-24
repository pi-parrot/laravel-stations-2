<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Practice</title>
</head>
<body>
    <div>
        <h1>{{ __('Schedule for :movie', ['movie' => $schedule->movie->title]) }}</h1>
        <div>
            <label>
                {{ __('ID') }}
                {{ $schedule->id }}
            </label>
        </div>
        <div>
            <label>
                {{ __('Start Datetime') }}
                {{ $schedule->start_time }}
            </label>
        </div>
        <div>
            <label>
                {{ __('End Datetime') }}
                {{ $schedule->end_time }}
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
            <a href="{{ route('admin.reservations.create', ['date' => $date, 'scheduleId' => $schedule->id]) }}">{{ __('Reservation') }}</a>
            <a href="{{ route('admin.movies.show', $schedule->movie->id) }}">{{ __('Back') }}</a>
        </div>
    </div>
</body>
</html>
