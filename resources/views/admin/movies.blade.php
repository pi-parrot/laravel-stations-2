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
    <a href="{{ route('admin.movies.create') }}">{{ __('Create New') }}</a>
    <form action="{{ route('admin.movies.index') }}" method="GET">
        <div>
            <label>
                {{ __('Keyword') }}
                <input type="text" name="keyword" value="{{ request('keyword') }}">
            </label>
        </div>
        <div>
            {{ __('Is Showing Status') }}
            <label>
                <input type="radio" name="is_showing" value="" {{ !in_array(request('is_showing'), ['0', '1']) ? 'checked' : '' }}>
                {{ __('All') }}
            </label>
            <label>
                <input type="radio" name="is_showing" value="1" {{ request('is_showing') === '1' ? 'checked' : '' }}>
                {{ __('Showing Status Showing') }}
            </label>
            <label>
                <input type="radio" name="is_showing" value="0" {{ request('is_showing') === '0' ? 'checked' : '' }}>
                {{ __('Showing Status Not Showing') }}
            </label>
        </div>
        <div>
            <button type="submit">{{ __('Search') }}</button>
        </div>
    </form>

    {{ $movies->appends(request()->query())->links() }}

    <table>
        <tr>
            <td>{{ __('ID') }}</td>
            <td>{{ __('Movie Title') }}</td>
            <td>{{ __('Image URL') }}</td>
            <td>{{ __('Published Year') }}</td>
            <td>{{ __('Is Showing') }}</td>
            <td>{{ __('Description') }}</td>
            <td>{{ __('Genre Name') }}</td>
            <td>{{ __('Created At') }}</td>
            <td>{{ __('Updated At') }}</td>
            <td>{{ __('Actions') }}</td>
        </tr>
        @foreach ($movies as $movie)
        <tr>
            <td>{{ $movie->id }}</td>
            <td><a href="{{ route('admin.movies.show', $movie->id) }}">{{ $movie->title }}</a></td>
            <td>{{ $movie->image_url }}</td>
            <td>{{ $movie->published_year }}</td>
            <td>{{ $movie->is_showing ? __('Showing Status Showing') : __('Showing Status Not Showing') }}</td>
            <td>{{ $movie->description }}</td>
            <td>{{ $movie->genre->name }}</td>
            <td>{{ $movie->created_at }}</td>
            <td>{{ $movie->updated_at }}</td>
            <td>
                <a href="{{ route('admin.movies.edit', $movie->id) }}">{{ __('Edit') }}</a>
                <button type="button"
                        data-confirm-message="{{ __('Are you sure you want to delete?') }}"
                        onclick="if (confirm(this.dataset.confirmMessage)) { document.getElementById('delete-form-{{ $movie->id }}').submit(); }">
                    {{ __('Delete') }}
                </button>
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
