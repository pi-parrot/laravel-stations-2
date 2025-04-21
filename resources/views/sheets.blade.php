<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Practice</title>
</head>
<body>
    <table>
        @foreach ($sheets as $row_number => $row)
        <tr>
            @foreach ($row as $column_number => $sheet)
            <td>
                {{ $sheet->row }}-{{ $sheet->column }}
            </td>
            @endforeach
        </tr>
        @endforeach
    </table>
</body>
</html>
