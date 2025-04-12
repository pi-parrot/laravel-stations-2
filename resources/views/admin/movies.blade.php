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
    <a href="{{ route('admin.movies.create') }}">新規登録</a>
    <form action="{{ route('admin.movies.index') }}" method="GET">
        <div>
            <label>
                キーワード
                <input type="text" name="keyword" value="{{ request('keyword') }}">
            </label>
        </div>
        <div>
            上映中かどうか
            <label>
                <input type="radio" name="is_showing" value="" {{ !in_array(request('is_showing'), ['0', '1']) ? 'checked' : '' }}>
                すべて
            </label>
            <label>
                <input type="radio" name="is_showing" value="1" {{ request('is_showing') === '1' ? 'checked' : '' }}>
                公開中
            </label>
            <label>
                <input type="radio" name="is_showing" value="0" {{ request('is_showing') === '0' ? 'checked' : '' }}>
                公開予定
            </label>
        </div>
        <div>
            <button type="submit">検索</button>
        </div>
    </form>

    {{ $movies->appends(request()->query())->links() }}

    <table>
        <tr>
            <td>ID</td>
            <td>映画タイトル</td>
            <td>画像URL</td>
            <td>公開年</td>
            <td>上映中かどうか</td>
            <td>概要</td>
            <td>ジャンル名</td>
            <td>登録日時</td>
            <td>更新日時</td>
            <td>操作</td>
        </tr>
        @foreach ($movies as $movie)
        <tr>
            <td>{{ $movie->id }}</td>
            <td><a href="{{ route('admin.movies.show', $movie->id) }}">{{ $movie->title }}</a></td>
            <td>{{ $movie->image_url }}</td>
            <td>{{ $movie->published_year }}</td>
            <td>{{ $movie->is_showing ? '上映中' : '上映予定' }}</td>
            <td>{{ $movie->description }}</td>
            <td>{{ $movie->genre->name }}</td> 
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

    {{ $movies->appends(request()->query())->links() }}

</body>
</html>
