<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Florencia')</title>

    <!-- Font -->
    <link href="https://fonts.cdnfonts.com/css/mango-vintage-personal-use-only" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/alice-2" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Uncial+Antiqua&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Brygada+1918&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">


    <!-- icon -->
    <link rel="icon" href="{{ asset('images/icon.png') }}">
    
    @stack('styles')
    
</head>

<body class="@yield('body_class')">
    @include('partials.nav')

    <main>
        @yield('content')
    </main>



    @include('partials.footer')

    @stack('scripts')


</body>

</html>