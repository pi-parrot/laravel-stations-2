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
    <table>
        <tr>
            <td>ID</td>
            <td>映画タイトル</td>
            <td>画像URL</td>
            <td>公開年</td>
            <td>上映中かどうか</td>
            <td>概要</td>
            <td>登録日時</td>
            <td>更新日時</td>
            <td>操作</td>
        </tr>
        @foreach ($movies as $movie)
        <tr>
            <td>{{ $movie->id }}</td>
            <td>{{ $movie->title }}</td>
            <td>{{ $movie->image_url }}</td>
            <td>{{ $movie->published_year }}</td>
            <td>{{ $movie->is_showing ? '上映中' : '上映予定' }}</td>
            <td>{{ $movie->description }}</td>
            <td>{{ $movie->created_at }}</td>
            <td>{{ $movie->updated_at }}</td>
            <td>
                <a href="{{ route('admin.movies.edit', $movie->id) }}">編集</a>
                <button type="button" onclick="if (confirm('本当に削除しますか？')) { document.getElementById('delete-form-{{ $movie->id }}').submit(); }">削除</button>
                <form id="delete-form-{{ $movie->id }}" action="{{ route('admin.movies.destroy', $movie->id) }}" method="POST">
                    @method('DELETE')
                    @csrf
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>
