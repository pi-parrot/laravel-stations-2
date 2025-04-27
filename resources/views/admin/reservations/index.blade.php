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
    <a href="{{ route('admin.reservations.create') }}">新規登録</a>
    <h1>予約</h1>
    <table>
        <tr>
            <td>ID</td>
            <td>映画作品</td>
            <td>座席</td>
            <td>日時</td>
            <td>名前</td>
            <td>メールアドレス</td>
            <td>操作</td>
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
                <a href="{{ route('admin.reservations.edit', $reservation->id) }}">編集</a>
                <button type="button" onclick="if (confirm('本当に削除しますか？')) { document.getElementById('delete-form-{{ $reservation->id }}').submit(); }">削除</button>
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
