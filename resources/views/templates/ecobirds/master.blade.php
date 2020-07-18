<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <title> @yield('title') </title>
        <link rel="stylesheet" href="{{ asset('css/ecobirds.css') }}" />
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap" rel="stylesheet">
        <link href="{{ asset('css/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
        <link href="{{ asset('js/OwlCarousel2-2.3.4/dist/assets/owl.carousel.css') }}" rel="stylesheet" />
        <link href="{{ asset('js/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/bootstrap/dist/css/bootstrap.css') }}" rel="stylesheet" />
    </head>

    <body>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="{{ asset('js/OwlCarousel2-2.3.4/dist/owl.carousel.js') }}"></script>
       @include('templates.ecobirds.partials.menu')

        <div class="container-fluid">
            @yield('pages')
        </div>

        @include('templates.ecobirds.partials.footer')
        

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <script src="https://kit.fontawesome.com/2098348b1b.js"></script>

    </body>
</html>