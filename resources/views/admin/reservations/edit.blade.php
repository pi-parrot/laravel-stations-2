<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Practice</title>
</head>
<body>
    <form action="{{ route('admin.reservations.update', ['id' => $reservation->id]) }}" method="POST">
        @method('PATCH')
        @csrf
        <input type="hidden" name="id" value="{{ $reservation->id }}">
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
                {{ __('Movie Title') }}
                <select name="movie_id" id="movie_select">
                    <option value="">{{ __('Select Movie') }}</option>
                    @foreach ($movies as $movie)
                    <option value="{{ $movie->id }}" @if($movie->id === $reservation->schedule->movie_id) selected @endif>{{ $movie->title }}</option>
                    @endforeach
                </select>
            </label>
        </div>
        <div>
            <label>
                {{ __('Schedule') }}
                <select name="schedule_id" id="schedule_select">
                    <option value="">{{ __('Select Schedule') }}</option>
                    @foreach ($schedules[$reservation->schedule->movie_id] ?? [] as $schedule)
                    <option value="{{ $schedule->id }}" @if($schedule->id === $reservation->schedule_id) selected @endif>
                        {{ \Carbon\Carbon::parse($schedule->start_time)->format('Y-m-d H:i') }} - 
                        {{ \Carbon\Carbon::parse($schedule->end_time)->format('Y-m-d H:i') }}
                    </option>
                    @endforeach
                </select>
            </label>
        </div>
        <div>
            <label>
                {{ __('Seat') }}
                <select name="sheet_id">
                    @foreach ($sheets as $sheet)
                    <option value="{{ $sheet->id }}" @if($sheet->id === $reservation->sheet_id) selected @endif>
                        {{ strtoupper($sheet->row . $sheet->column) }}
                    </option>
                    @endforeach
                </select>
            </label>
        </div>
        <div>
            <label>
                {{ __('Date') }}
                <input type="date" name="date" value="{{ old('date', $reservation->date) }}" required>
            </label>
        </div>
        <div>
            <label>
                {{ __('Reserved Name') }}
                <input type="text" name="name" value="{{ old('name', $reservation->name) }}" required>
            </label>
        </div>
        <div>
            <label>
                {{ __('Reserved Email') }}
                <input type="email" name="email" value="{{ old('email', $reservation->email) }}" required>
            </label>
        </div>
        <div>
            <label>
                {{ __('Is Cancelled') }}
                <input type="checkbox" name="is_canceled" value="1" @if($reservation->is_canceled) checked @endif>
            </label>
        </div>
        <div>
            <button type="submit">{{ __('Submit') }}</button>
            <a href="{{ route('admin.reservations.index') }}">{{ __('Back') }}</a>
        </div>
    </form>

    <script>
        const scheduleData = {!! json_encode($schedules) !!};
        const movieSelect = document.getElementById('movie_select');
        const scheduleSelect = document.getElementById('schedule_select');

        movieSelect.addEventListener('change', function() {
            const movieId = this.value;
            scheduleSelect.innerHTML = '';

            if (!movieId) {
                scheduleSelect.innerHTML = '<option value="">' + '{{ __("Select Movie") }}' + '</option>';
                scheduleSelect.disabled = true;
                return;
            }

            const movieSchedules = scheduleData[movieId] || [];
            if (movieSchedules.length === 0) {
                scheduleSelect.innerHTML = '<option value="">' + '{{ __("No schedules available") }}' + '</option>';
            } else {
                scheduleSelect.innerHTML = '<option value="">' + '{{ __("Select Schedule") }}' + '</option>';
                movieSchedules.forEach(schedule => {
                    const option = document.createElement('option');
                    option.value = schedule.id;
                    const startTime = new Date(schedule.start_time);
                    const endTime = new Date(schedule.end_time);
                    const formatDateTime = (date) => {
                        return `${date.getFullYear()}-${String(date.getMonth() + 1).padStart(2, '0')}-${String(date.getDate()).padStart(2, '0')} ${String(date.getHours()).padStart(2, '0')}:${String(date.getMinutes()).padStart(2, '0')}`;
                    };
                    option.textContent = `${formatDateTime(startTime)} - ${formatDateTime(endTime)}`;
                    scheduleSelect.appendChild(option);
                });
            }
            scheduleSelect.disabled = false;
        });

        // 初期表示時にスケジュールを有効化
        if (movieSelect.value) {
            scheduleSelect.disabled = false;
        }
    </script>
</body>
</html>
