<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Practice</title>
</head>
<body>
    <form action="{{ route('admin.reservations.store') }}" method="POST">
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
                上映スケジュール
                <select name="schedule_id">
                    @foreach ($schedules as $schedule)
                    <option value="{{ $schedule->id }}">{{ $schedule->movie->title }} - {{ $schedule->start_time->format('Y-m-d H:i') }} - {{ $schedule->end_time->format('Y-m-d H:i') }}</option>
                    @endforeach
                </select>
            </label>
        </div>
        <div>
            <label>
                座席
                <select name="sheet_id">
                    @foreach ($sheets as $sheet)
                    <option value="{{ $sheet->id }}">{{ strtoupper($sheet->row . $sheet->column) }}</option>
                    @endforeach
                </select>
            </label>
        </div>
        <div>
            <label>
                日付
                <input type="date" name="date" value="{{ old('date') }}" required>
            </label>
        </div>
        <div>
            <label>
                予約者氏名
                <input type="text" name="name" value="{{ old('name') }}" required>
            </label>
        </div>
        <div>
            <label>
                予約者メールアドレス
                <input type="email" name="email" value="{{ old('email') }}" required>
            </label>
        </div>
        <div>
            <button type="submit">登録</button>
            <a href="{{ route('admin.reservations.index', ['id' => $schedule->movie->id]) }}">戻る</a>
        </div>
    </form>
</body>
</html>
