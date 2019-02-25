<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="min-h-full">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600,700,800" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-grey-lightest font-sans min-h-full">
    
    <div class="content-wrapper min-h-full" id="app">

        @yield('content')

    </div>

    <script src="{{ mix('/js/app.js')}}"></script>

</body>
</html>