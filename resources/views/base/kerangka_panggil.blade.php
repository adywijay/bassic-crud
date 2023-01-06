<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('load_extern/js/plugins/jquery-1.11.2.min.js') }}"></script>
    @extends('base.layout.load_css')
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
                            <span>{{ config('app.name', 'Laravel') }}</span>
                            <ul id="nav-mobile" class="right hide-on-med-and-down">
                                <li class="button-atas">
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"
                                        class="btn-floating btn-small waves-effect waves-light red">
                                        <i class="material-icons">exit_to_app</i>
                                    </a>
                                    <form id="frm-logout" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <!-- SIDEBAR 1 - HAS .SIDENAV-FIXED -->
    @extends('base.konten.side_nav.list_side_nav')
    @section('list_menu')
    @endsection

    <main style="margin-top: 50px !important;border-radius: 28px;">
        @yield('list_content')
    </main>

    @extends('base.layout.load_js')
</body>

</html>
