<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link rel="icon" href="{{ asset('resources/Image/Logo.png') }}" type="image/x-icon" />
    <link rel="shortcut icon" href="{{ asset('resources/Image/Logo.png') }}" type="image/x-icon" />
    @vite('resources/css/app.css')
</head>

<body>
    <div class="flex flex-col justify-center px-6 h-screen mx-auto  lg:px-8 bg-neutral-50">
        @yield('content')
    </div>

</body>

</html>
