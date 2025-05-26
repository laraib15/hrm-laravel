<!doctype html>
<html>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>@yield('pageTitle')</title>
    @include('layouts.css_file')
</head>
<body oncontextmenu='return false' class='snippet-body'>
    <input type="checkbox" id="check">

        @include('layouts.header')


        @yield('content')




    @include('layouts.js_file')
</body>
</html>
