<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Tienda') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/Bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    @yield('css')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="@if( !Auth::user() ) {{ url('/') }} @else {{ url('/home') }} @endif">
                    {{ config('app.name', 'Tienda') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                @if (Route::has('register'))
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <!--<script src="{{ asset('js/app.js') }}" defer></script>-->
    <script src="{{ asset('plugins/jQuery/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('plugins/Bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('plugins/Bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('plugins/Font_awesome/js/all.js') }}"></script>
    
    <script>
        var tituloModal         = $('#modal-titulo');
	    var bodyModal           = $('#modal-body');
        var footerModal         = $('#modal-footer');
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('[data-toggle="tooltip"]').tooltip()

        $('.form-control').addClass('mayuscula');

        $("body").on('change', '.mayuscula', function(field){
            $(this).val($(this).val().toUpperCase());
        });

        $("body").on('keypress', '.soloNumeros', function(event){
        var key = window.event.keyCode;
            if (key < 48 || key > 57) {
                return false;
            }
        });
        
        var limpiarModal = function(){
            tituloModal.empty()
            //bodyModal.empty()
            //footerModal.empty()
        };
    
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('form-control');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('focusout', function(event) {
                        if( $(form).val() == '' ){
                            $( '#'+$(form).attr("id") ).removeClass('is-valid');
                            $( '#'+$(form).attr("id") ).addClass('is-invalid');
                            $( '#error_'+$(form).attr("id") ).show();
                        }else{
                            $( '#'+$(form).attr("id") ).removeClass('is-invalid');
                            $( '#'+$(form).attr("id") ).addClass('is-valid');
                            $( '#error_'+$(form).attr("id") ).hide();
                        }
                    }, false);
                });
            }, false);
        })();
    </script>

    @yield('scripts')
    
</body>
</html>
