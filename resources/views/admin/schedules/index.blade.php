<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Practice</title>
</head>
<body>
    <h1>{{ __('Schedule') }}</h1>
    <h2>{{ $movie->id }}</h2>
    <h2>{{ $movie->title }}</h2>
    <table>
        <tr>
            <td>{{ __('ID') }}</td>
            <td>{{ __('Movie ID') }}</td>
            <td>{{ __('Start Datetime') }}</td>
            <td>{{ __('End Datetime') }}</td>
            <td>{{ __('Created At') }}</td>
            <td>{{ __('Updated At') }}</td>
            <td>{{ __('Actions') }}</td>
        </tr>
        @foreach ($schedules as $schedule)
        <tr>
            <td>{{ $schedule->id }}</td>
            <td>{{ $schedule->movie_id }}</td>
            <td>{{ $schedule->start_time }}</td>
            <td>{{ $schedule->end_time }}</td>
            <td>{{ $schedule->created_at }}</td>
            <td>{{ $schedule->updated_at }}</td>
            <td>
                <a href="{{ route('admin.schedules.edit', $schedule->id) }}">{{ __('Edit') }}</a>
                <button type="button"
                        data-confirm-message="{{ __('Are you sure you want to delete?') }}"
                        onclick="if (confirm(this.dataset.confirmMessage)) { document.getElementById('delete-form-{{ $schedule->id }}').submit(); }">
                    {{ __('Delete') }}
                </button>
                <form id="delete-form-{{ $schedule->id }}" action="{{ route('admin.schedules.destroy', $schedule->id) }}" method="POST">
                    @method('DELETE')
                    @csrf
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>
