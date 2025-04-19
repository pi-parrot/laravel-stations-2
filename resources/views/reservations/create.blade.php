<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Practice</title>
</head>
<body>
    <form action="{{ route('reservations.store') }}" method="POST">
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
                映画作品
                {{ $schedule->movie->title }}
            </label>
            <input type="hidden" name="movie_id" value="{{ $schedule->movie->id }}">
        </div>
        <div>
            <label>
                上映スケジュール
                {{ $schedule->id }}
                <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
            </label>
        </div>
        <div>
            <label>
                座席
                {{ $request->sheetId }}
                <input type="hidden" name="sheet_id" value="{{ $request->sheetId }}">
            </label>
        </div>
        <div>
            <label>
                日付
                {{ $request->date }}
                <input type="hidden" name="date" value="{{ $request->date }}">
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
            <a href="{{ route('sheets.reserve', ['movie_id' => $schedule->movie->id, 'schedule_id' => $schedule->id, 'date' => $request->date]) }}">戻る</a>
        </div>
    </form>
</body>
</html>
