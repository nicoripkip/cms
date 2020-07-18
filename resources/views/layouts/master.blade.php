<!-- -->
<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>
        <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet" /> -->
        <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/cms.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/bootstrap/dist/css/bootstrap.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/AdminLTE.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/skins/skin-blue.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/jvectormap/jquery-jvectormap.css') }}" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.2/dragula.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet" />

        <!-- Google Font -->
    <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>


    <!-- Alle google fonts imports -->
    <style>
        @import url('https://fonts.googleapis.com/css?family=Indie+Flower&display=swap');
        @import url('https://fonts.googleapis.com/css?family=Kanit&display=swap');
        @import url('https://fonts.googleapis.com/css?family=Permanent+Marker&display=swap');
        @import url('https://fonts.googleapis.com/css?family=Lobster+Two&display=swap');
        @import url('https://fonts.googleapis.com/css?family=Ubuntu&display=swap');
    </style>


    <body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <div class="wrapper">

    @include('layouts.header')

    @include('layouts.sidebar')
    
        @yield('content')

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
        </form>

    @include('layouts.footer')

</body>
</html>