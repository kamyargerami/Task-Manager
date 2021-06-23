<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    @yield('style')
</head>
<body class="bg-dark">
@yield('content')

<script src="{{mix('js/app.js')}}"></script>
@yield('script')
</body>
</html>
