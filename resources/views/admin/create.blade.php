<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Practice</title>
</head>
<body>
    <form action="{{ route('admin.movies.store') }}" method="POST">
        @csrf
        @isset ($message)
        <div>{{ $message }}</div>
        @endisset
        @if (session('errors'))
        <div>
            @foreach (session('errors')->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
        @endif
        <div>
            <label>
                映画タイトル
                <input type="text" name="title" value="{{ old('title') }}" required>
            </label>
        </div>
        <div>
            <label>
                画像URL
                <input type="url" name="image_url" value="{{ old('image_url') }}" required>
            </label>
        </div>
        <div>
            <label>
                公開年
                <input type="number" name="published_year" maxlength="4" value="{{ old('published_year') }}" required>
            </label>
        </div>
        <div>
            <label>
                上映中かどうか
                <input type="checkbox" name="is_showing" value="1" {{ old('is_showing') ? 'checked' : '' }}>
            </label>
        </div>
        <div>
            <label>
                概要
                <textarea name="description" rows="4" cols="40" required>{{ old('description') }}</textarea>
            </label>
        </div>
        <div>
            <button type="submit">登録</button>
            <a href="{{ route('admin.movies.index') }}">戻る</a>
        </div>
    </form>
</body>
</html>
