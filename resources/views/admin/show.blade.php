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
        <div>
            <label>
                {{ __('ID') }}
                {{ $movie->id }}
            </label>
        </div>
        <div>
            <label>
                {{ __('Movie Title') }}
                {{ $movie->title }}
            </label>
        </div>
        <div>
            <label>
                {{ __('Image URL') }}
                <img src="{{ $movie->image_url }}" alt="{{ $movie->title }}">
            </label>
        </div>
        <div>
            <label>
                {{ __('Published Year') }}
                {{ $movie->published_year }}
            </label>
        </div>
        <div>
            <label>
                {{ __('Is Showing') }}
                {{ $movie->is_showing ? __('Showing Status Showing') : __('Showing Status Not Showing') }}
            </label>
        </div>
        <div>
            <label>
                {{ __('Description') }}
                {{ $movie->description }}
            </label>
        </div>
        <div>
            <label>
                {{ __('Genre Name') }}
                {{ $movie->genre->name }}
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
        <a href="{{ route('admin.schedules.index', $movie->id) }}">{{ __('Schedule List') }}</a>
        <a href="{{ route('admin.schedules.create', $movie->id) }}">{{ __('Create New Schedule') }}</a>
        @foreach ($movie->schedules as $schedule)
        <ul>
            <li><a href="{{ route('admin.schedules.show', $schedule->id) }}">{{ $schedule->start_time }} - {{ $schedule->end_time }}</a></li>
        </ul>
        @endforeach
        <div>
            <a href="{{ route('admin.movies.index') }}">{{ __('Back') }}</a>
        </div>
</div>
</body>
</html>
