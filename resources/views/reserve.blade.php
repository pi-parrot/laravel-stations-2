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
    @if (session('errors'))
    <div>
        @foreach (session('errors')->all() as $error)
        <p>{{ $error }}</p>
        @endforeach
    </div>
    @endif
    <table>
        @foreach ($sheets as $row_number => $row)
        <tr>
            @foreach ($row as $column_number => $sheet)
            <td>
                @if(!in_array($sheet->id, $reservation))
                <a href="{{ route('reservations.create', [$request->movie_id, $schedule->id]) }}?date={{ $request->date }}&sheetId={{ $sheet->id }}">{{ $sheet->row }}-{{ $sheet->column }}</a>
                @else
                <span style="background-color: #999;">{{ $sheet->row }}-{{ $sheet->column }}</span>
                @endif
            </td>
            @endforeach
        </tr>
        @endforeach
    </table>
</body>
</html>
