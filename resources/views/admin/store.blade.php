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
        @if ($message)
        <div>{{ $message }}</div>
        @endif
        <div>
            <label>
                ID
                {{ $movie->id }}
            </label>
        </div>
        <div>
            <label>
                映画タイトル
                {{ $movie->title }}
            </label>
        </div>
        <div>
            <label>
                画像URL
                {{ $movie->image_url }}
            </label>
        </div>
        <div>
            <label>
                公開年
                {{ $movie->published_year }}
            </label>
        </div>
        <div>
            <label>
                上映中かどうか
                {{ $movie->is_showing ? '上映中' : '上映予定' }}
            </label>
        </div>
        <div>
            <label>
                概要
                {!! nl2br(e($movie->description)) !!}
            </label>
        </div>
        <div>
            <label>
                登録日時
                {{ $movie->created_at }}
            </label>
        </div>
        <div>
            <label>
                更新日時
                {{ $movie->updated_at }}
            </label>
        </div>
        <div>
            <a href="{{ route('admin.movies.index') }}">戻る</a>
        </div>
    </div>
</body>
</html>
