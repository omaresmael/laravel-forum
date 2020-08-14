<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->

    <style>
        body{
            padding-bottom: 100px;
        }
        .level {
            display: flex;
            align-items: center;
        }
        .flex { flex: 1;}
        [v-cloak] {display: none;}
    </style>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->


                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse " id="bs-example-navbar-collapse-1">
                    <ul class="nav">
                        <li><a class="navbar-brand " href="{{ url('/') }}">
                                {{ config('app.name', 'Laravel') }}
                            </a></li>
                        @if(auth()->user())
                        <li class="nav-item">
                            <a class=" nav-link" href="/threads?by={{auth()->user()->name}}">
                                My Threads
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="" href="/threads/create">
                                New Thread
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="" href="/profile/{{auth()->user()->name}}">
                                My Profile
                            </a>
                        </li>
                        @endif
                        <li class="nav-item"><a class="" href="/threads">
                                All Threads
                            </a></li>
                        <li class="nav-item"><a class="" href="/threads?popular">
                                Popular Threads
                            </a></li>
                        @yield('channels')

                        @guest
                            <li class="nav-item ">
                                <a class="nav-link " href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>

                            @endif
                        @else
                            <li class="nav-item dropdown dropdown-menu-md-right">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</a>
                                <div class="dropdown-menu dropdown-menu-right">
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



                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>





        <main class="py-4">
            @yield('content')
            <flash message="{{session("flash")}}">this is message</flash>



        </main>
    </div>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>
