<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Practice</title>
</head>
<body>
    <h1>スケジュール</h1>
    <h2>{{ $movie->id }}</h2>
    <h2>{{ $movie->title }}</h2>
    <table>
        <tr>
            <td>ID</td>
            <td>映画ID</td>
            <td>開始時刻</td>
            <td>終了時刻</td>
            <td>登録日時</td>
            <td>更新日時</td>
            <td>操作</td>
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
                <a href="{{ route('admin.schedules.edit', $schedule->id) }}">編集</a>
                <button type="button" onclick="if (confirm('本当に削除しますか？')) { document.getElementById('delete-form-{{ $schedule->id }}').submit(); }">削除</button>
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
