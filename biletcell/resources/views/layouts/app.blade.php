<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BiletCell</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900">
    @yield('content')
    <a href="{{ route('profile.tickets') }}" class="text-gray-300 hover:text-orange-500 font-bold">
    Biletlerim
</a>

</body>
</html>
