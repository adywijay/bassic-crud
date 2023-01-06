<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('load_extern/js/plugins/jquery-1.11.2.min.js') }}"></script>
    {{-- <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script> --}}
    @extends('base.layout.load_css')
    <title>Laravel | Portofolio</title>
</head>

<body>
    <nav class="orange" role="navigation">
        <div class="nav-wrapper container"><a id="logo-container" href="#"
                class="brand-logo">{{ config('app.name', 'Laravel') }}</a>
            @if (Route::has('login'))
                @auth
                    <ul class="right hide-on-med-and-down">
                        <li>
                            <a href="{{ url('/home') }}">Home</a>
                        </li>
                    </ul>
                @else
                    <ul class="right hide-on-med-and-down">
                        <li><a href="{{ route('login') }}">Login</a></li>
                    </ul>
                    @if (Route::has('register'))
                        <ul class="right hide-on-med-and-down">
                            <li><a href="{{ route('register') }}">Register</a></li>
                        </ul>
                    @endif
                @endauth
            @endif

            <ul id="nav-mobile" class="sidenav">
                <li><a href="#">Navbar Link</a></li>
                @if (Route::has('login'))
                    @auth
                        <li>
                            <a href="{{ url('/home') }}">Home</a>
                        </li>
                    @else
                        <li><a href="{{ route('login') }}">Login</a></li>
                        @if (Route::has('register'))
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @endif
                    @endauth
                @endif
            </ul>
            <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        </div>
    </nav>
    <div id="index-banner" class="parallax-container">
        <div class="section no-pad-bot">
            <div class="container">
                <br><br>
                <h1 class="header center white-text">{{ config('app.name', 'Laravel') }} &nbsp; {{ App::VERSION() }}
                </h1>
                <div class="row center">
                    <h5 class="header col s12 light white-text">A modern responsive front-end framework based on
                        Material Design <?php
                        // prints e.g. 'Current PHP version: 4.1.1'
                        echo 'With PHP version: ' . phpversion(); ?>
                    </h5>
                </div>
                <div class="row center">
                    <a href="{{ route('login') }}" id="download-button"
                        class="btn waves-effect waves-light amber darken-3">Get Started<i
                            class="material-icons right">send</i></a>
                </div>
                <br><br>

            </div>
        </div>
        <div class="parallax"><img src="{{ asset('load_extern/images/bg/user-profile-bg.jpg') }}"
                alt="Unsplashed background img 1">
        </div>
    </div>


    <div class="container">
        <div class="section">

            <!--   Icon Section   -->
            <div class="row">
                <div class="col s12 m4">
                    <div class="icon-block">
                        <h2 class="center light-blue-text"><i class="material-icons">flash_on</i></h2>
                        <h5 class="center">Speeds up development</h5>

                        <p class="light">We did most of the heavy lifting for you to provide a default stylings that
                            incorporate our custom components. Additionally, we refined animations and transitions to
                            provide a smoother experience for developers.</p>
                    </div>
                </div>

                <div class="col s12 m4">
                    <div class="icon-block">
                        <h2 class="center light-blue-text"><i class="material-icons">group</i></h2>
                        <h5 class="center">User Experience Focused</h5>

                        <p class="light">By utilizing elements and principles of Material Design, we were able to
                            create a framework that incorporates components and animations that provide more feedback to
                            users. Additionally, a single underlying responsive system across all platforms allow for a
                            more unified user experience.</p>
                    </div>
                </div>

                <div class="col s12 m4">
                    <div class="icon-block">
                        <h2 class="center light-blue-text"><i class="material-icons">settings</i></h2>
                        <h5 class="center">Easy to work with</h5>

                        <p class="light">We have provided detailed documentation as well as specific code examples to
                            help new users get started. We are also always open to feedback and can answer any questions
                            a user may have about Materialize.</p>
                    </div>
                </div>
            </div>

        </div>
        <br><br>
    </div>
    <nav class="col s12  orange darken-4">
        <div class="container">
            <p class="row center">Made by Materialize</p>
        </div>
    </nav>
    <script>
        $(document).ready(function() {
            $('.parallax').parallax();
        });
    </script>
    <!--  Scripts-->
    @extends('base.layout.load_js')

</body>

</html>
