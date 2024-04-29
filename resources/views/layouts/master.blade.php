<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.header')
    @yield('page-css')
</head>

<body id="landing">
    @yield('content')
    @include('layouts.footer')
    @yield('page-js')
</body>

</html>
