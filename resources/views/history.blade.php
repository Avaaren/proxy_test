<!DOCTYPE html>
<html>
<head>
    <title>History Checks</title>
</head>
<body>

<h1>History Checks</h1>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Date</th>
        <th>Total Proxies Checked</th>
        <th>Working Proxies</th>
    </tr>
    @foreach ($historyChecks as $historyCheck)
        <tr>
            <td><a href="{{ route('historyDetail', $historyCheck->id) }}">{{ $historyCheck->id }}</a></td>
            <td>{{ $historyCheck->created_at }}</td>
            <td>{{ $historyCheck->total_proxies_checked }}</td>
            <td>{{ $historyCheck->working_proxies }}</td>
        </tr>
    @endforeach
</table>

</body>
</html>
