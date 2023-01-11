<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('load_extern/js/plugins/jquery-1.11.2.min.js') }}"></script>
    @extends('admin.layout.load_css')
    <title>{{ $judul }}</title>
</head>

<body>
    <header>
        <div class="navbar-fixed">
            <nav class="orange darken-4">
                <div class="nav-wrapper">
                    <div class="row">
                        <div class="col s12">
                            <a id="burger-icon-1" href="#" data-target="sidebar-1"
                                class="left sidenav-trigger show-on-medium"><i class="material-icons">menu</i></a>
                            <a href="{{ route('beranda') }}"><span>{{ config('app.name', 'Laravel') }}</span></a>
                            @include('admin.konten.top_nav.list_top_nav')
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <!-- SIDEBAR 1 - HAS .SIDENAV-FIXED -->
    @extends('admin.konten.side_nav.list_side_nav')
    @section('list_menu')
    @endsection

    <main style="margin-top: 50px !important;border-radius: 28px;">
        @yield('list_content')
    </main>

    @extends('admin.layout.load_js')
</body>

</html>
