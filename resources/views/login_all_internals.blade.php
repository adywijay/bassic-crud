<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('load_extern/js/plugins/jquery-1.11.2.min.js') }}"></script>
    @extends('login.load_css')
    <title>{{ $judul }}</title>
</head>

<body>
    <div class="section">
        <div class="row">
            <div class="col s4"></div>
            <div class="col s4">
                @include('admin.page.flash_message')
            </div>
            <div class="col s4"></div>
        </div>
    </div>
    <main>
        <section class="center">
            <div class="container">
                <div class="z-depth-5 orange grey lighten-5 login-card" style="border-radius: 10px;opacity: 0.8;">
                    <form class="col s12" method="post" action="{{ route('loginvalidation') }}">
                        @csrf
                        <div class="row">
                            <div class="col s12">
                                <img src="{{ asset('load_extern/images/user.png') }}"
                                    class="orange circle responsive-img img">
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <input class="validate" type="email" name="email" id="email" required=""
                                    placeholder="Email Accounts" />
                                <label for="email" id="email" class="black-text">Email Accounts</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input class="validate" type="password" name="password" id="password" required=""
                                    placeholder="Password Accounts" />
                                <label for="password" id="password" class="black-text">Password</label>
                            </div>
                        </div>
                        <br />
                        <section class="center">
                            <div class="row">
                                <button class="btn waves-effect waves-light amber  orange darken-4" type="submit"
                                    name="action">login
                                    <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </section>
                    </form>
                </div>
            </div>
        </section>
    </main>
    @extends('login.load_js')
</body>

</html>
