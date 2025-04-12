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
        <h1>{{ $schedule->movie->title }}のスケジュール</h1>
        <div>
            <label>
                ID
                {{ $schedule->id }}
            </label>
        </div>
        <div>
            <label>
                開始時刻
                {{ $schedule->start_time }}
            </label>
        </div>
        <div>
            <label>
                終了時刻
                {{ $schedule->end_time }}
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
            <a href="{{ route('admin.movies.show', $schedule->movie->id) }}">戻る</a>
        </div>
    </div>
</body>
</html>
