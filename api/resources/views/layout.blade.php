<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Document</title>
</head>
<body>
    <sidebar class="sidebar">
        <a href="{{ route('home')}}">Home</a>
        <a href="{{ route('section1') }}">Section1</a>
        <a href="{{ route('section2') }}">Section2</a>
        <a href="{{ route('section3') }}">Section3</a>
    </sidebar>

    <div class="container">
        @yield('content')
    </div>
</body>
</html>