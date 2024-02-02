<!DOCTYPE html>
<html>
<head>
    <title>History Check Details</title>
</head>
<body>

<h1>History Check Details</h1>

<h2>History Check Information</h2>
<p>ID: {{ $historyCheck->id }}</p>
<p>Date Checked: {{ $historyCheck->check_date }}</p>
<p>Total Proxies Checked: {{ $historyCheck->total_proxies_checked }}</p>
<p>Working Proxies: {{ $historyCheck->working_proxies }}</p>

<h2>Associated Proxies</h2>
@if ($historyCheck->proxies->count() > 0)
    <table border="1">
        <tr>
            <th>ID</th>
            <th>IP Port</th>
            <th>Type</th>
            <th>Status</th>
        </tr>
        @foreach ($historyCheck->proxies as $proxy)
            <tr>
                <td>{{ $proxy->id }}</td>
                <td>{{ $proxy->ip_port }}</td>
                <td>{{ $proxy->type }}</td>
                <td>{{ $proxy->status }}</td>
            </tr>
        @endforeach
    </table>
@else
    <p>No associated proxies found.</p>
@endif

</body>
</html>