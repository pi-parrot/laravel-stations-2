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
                ID
                {{ $schedule->id }}
            </label>
        </div>
        <div>
            <label>
                映画ID
                {{ $schedule->movie_id }}
            </label>
            <input type="hidden" name="movie_id" value="{{ $schedule->movie_id }}">
        </div>
        <div>
            <label>
                開始日付
                <input type="date" name="start_time_date" value="{{ $schedule->start_time->format('Y-m-d') }}" required>
            </label>
            <label>
                開始時間
                <input type="time" name="start_time_time" value="{{ $schedule->start_time->format('H:i') }}" required>
            </label>
        </div>
        <div>
            <label>
                終了日付
                <input type="date" name="end_time_date" value="{{ $schedule->end_time->format('Y-m-d') }}" required>
            </label>
            <label>
                終了時間
                <input type="time" name="end_time_time" value="{{ $schedule->end_time->format('H:i') }}" required>
            </label>
        </div>
        <div>
            <label>
                登録日時
                {{ $schedule->created_at }}
            </label>
        </div>
        <div>
            <label>
                更新日時
                {{ $schedule->updated_at }}
            </label>
        </div>
        <div>
            <button type="submit">登録</button>
            <a href="{{ route('admin.schedules.index', $schedule->movie_id) }}">戻る</a>
        </div>
    </form>
</body>
</html>
