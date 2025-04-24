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
    <a href="{{ route('admin.reservations.create') }}">{{ __('Create New') }}</a>
    <h1>{{ __('Reservation') }}</h1>
    <table>
        <tr>
            <td>{{ __('ID') }}</td>
            <td>{{ __('Movie Title') }}</td>
            <td>{{ __('Seat') }}</td>
            <td>{{ __('Date') }}</td>
            <td>{{ __('Name') }}</td>
            <td>{{ __('Email Address') }}</td>
            <td>{{ __('Actions') }}</td>
        </tr>
        @foreach ($reservations as $reservation)
        <tr>
            <td>{{ $reservation->id }}</td>
            <td>{{ $reservation->schedule->movie->title }}</td>
            <td>{{ strtoupper($reservation->sheet->row) }}{{ $reservation->sheet->column }}</td>
            <td>{{ $reservation->date }}</td>
            <td>{{ $reservation->name }}</td>
            <td>{{ $reservation->email }}</td>
            <td>
                <a href="{{ route('admin.reservations.edit', $reservation->id) }}">{{ __('Edit') }}</a>
                <button type="button"
                        data-confirm-message="{{ __('Are you sure you want to delete?') }}"
                        onclick="if (confirm(this.dataset.confirmMessage)) { document.getElementById('delete-form-{{ $reservation->id }}').submit(); }">
                    {{ __('Delete') }}
                </button>
                <form id="delete-form-{{ $reservation->id }}" action="{{ route('admin.reservations.destroy', $reservation->id) }}" method="POST">
                    @method('DELETE')
                    @csrf
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>
