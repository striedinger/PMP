<!DOCTYPE html>
<html lang="es" ng-app="app">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PML Solutions - @yield('title')</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bootstrap-datetimepicker.min.css') }}">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/loading-bar.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('bower_components/sweetalert2/dist/sweetalert2.css') }}"></link>
    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ URL::asset('img/Logo.png') }}">
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    @if(!Auth::guest())
                        @if(!Auth::user()->isAdmin())
                        <li><a href="{{ url('/home') }}">Inicio</a></li>
                        <li><a href="{{ url('/results') }}">Resultados</a></li>
                        @endif
                        @if(Auth::user()->isAdmin())
                        <li><a href="{{ url('/home') }}">Inicio</a></li>
                        <li class="dropdown">
                            <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Usuarios <i class="caret"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ url('/users') }}">Ver Usuarios</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Examenes <i class="caret"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ url('/exams/create') }}">Crear Examen</a></li>
                                <li><a href="{{ url('/exams') }}">Ver Examenes</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Preguntas <i class="caret"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ url('/questions/create') }}">Crear Pregunta</a></li>
                                <li><a href="{{ url('/questions/import') }}">Importar Preguntas</a></li>
                                <li><a href="{{ url('/questions') }}">Ver Preguntas</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ url('/results') }}">Resultados</a></li>
                        @endif
                    @endif
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Iniciar Sesion</a></li>
                        <li><a href="{{ url('/register') }}">Registro</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Cerrar Sesion</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    @if(Session::has('status'))
    <div class="container">
        <div class="alert alert-success" align="center">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <p>{{ Session::get('status') }}</p>
        </div>
    </div>
    @endif

    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
    <script src="{{ URL::asset('js/ui-boostrap/ui-bootstrap-custom-2.1.2.min.js') }}"></script>
    <script src="{{ URL::asset('js/ui-boostrap/ui-bootstrap-custom-tpls-2.1.2.min.js') }}"></script>
    <script src="{{ URL::asset('js/moment.min.js') }}"></script>
    <script src="{{ URL::asset('js/humanize-duration.js') }}"></script>
    <script src="{{ URL::asset('js/app.js') }}"></script>
    <script src="{{ URL::asset('js/controllers.js') }}"></script>
    <script src="{{ URL::asset('js/services.js') }}"></script>
    <script src="{{ URL::asset('js/filters.js') }}"></script>
    <script src="{{ URL::asset('js/directives.js') }}"></script>
    <script src="{{ URL::asset('js/config.js') }}"></script>
   <!-- <script src="{{ URL::asset('js/routes.js') }}"></script>-->
    <script src="{{ URL::asset('js/angular-time.min.js') }}"></script>
 
    <script src="{{ URL::asset('js/loading-bar.min.js') }}"></script>
    <script src="{{ URL::asset('bower_components/spin.js/spin.js') }}"></script>
    <script src="{{ URL::asset('bower_components/angular-spinner/angular-spinner.js') }}"></script>
    <script src="{{ URL::asset('bower_components/angular-sweetalert-2/SweetAlert.js') }}"></script>
    <script src="{{ URL::asset('bower_components/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-router/0.3.1/angular-ui-router.min.js"></script>
 
    <script src="{{ URL::asset('js/circle-progress.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ URL::asset('bower_components/angular-cookies/angular-cookies.min.js') }}"></script>

 
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    @yield('scripts')
</body>
</html>
