<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Laravel CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Page Title -->
        <title>@yield('page_title')</title>

        <!-- Page Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Page Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

        <!-- Page Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Page Specific CDNs -->
        @yield('specific-cdns')
        <!-- FontAwesome CDN -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>

    <body>
        <div id="app">
            @yield('page_content')
        </div>
    </body>

    <!-- End Page Scripts -->
    @yield('end_page_scripts')

</html>