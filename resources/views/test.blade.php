<!DOCTYPE html>
<html>
<head>
    <title>Proxy Checker</title>
</head>
<body>
    <form action="{{ route('checkProxy') }}" method="post">
        @csrf
        <label for="proxies">Enter Proxies (ip:port):</label>
        <textarea name="proxies" id="proxies" rows="10" cols="30"></textarea>
        <br>
        <button type="submit">Check Proxies</button>
    </form>
</body>
</html>