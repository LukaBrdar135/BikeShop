<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet">
    <link href="/css/font-awesome.min.css" rel="stylesheet">
    <script src="/js/app.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <!-- pocetak navbar -->
        <div class="container">
            <!-- pocetak container -->

            <a class="navbar-brand" href="/" style="font-size: 25px;">Bikeshop</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="/">Pocetna <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/proizvodi/svi">Proizvodi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/korpa">
                        <i class="fa fa-shopping-cart"></i>Korpa</a>
                    </li>
                </ul>
                {{ Form::open(array('action' => 'ProizvodController@rezultatPretrage', 'class'=>'form-inline my-2 my-lg-0')) }}
                    <input class="form-control mr-sm-2" type="search" placeholder="Pretraga" aria-label="Search" name="pretraga" id="pretraga">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pretraga</button>
                    {{ Form::close() }}

                <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Prijavi se') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registracija') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Odjavi se') }}
                                    </a>

                                    @if(Auth::user()->isRole() == "admin")
                                    <a class="dropdown-item" href="/admin">Admin panel</a>
                                    @endif

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
            </div>
        </div>
    </nav> <!-- kraj navbar -->


    <!-- content  -->
    @yield('content')


    <footer class="bg-dark fixed-bottom" style="padding-top: 10px; border-top:2px solid #38c172;">
        <div class="container">
            <div>
                <div class="row">
                    <div class="col-md-6">
                        <!-- pocetak prvog dela -->
                        <ul class="list-inline">
                            <li class="list-inline-item"><a href="#">O nama</a></li>
                            <li class="list-inline-item"><a href="#">Proizvodi</a></li>
                            <li class="list-inline-item"><a href="#">FAQ</a></li>
                        </ul>
                    </div><!-- kraj prvog dela -->
                    <div class="col-md-6">
                        <!-- pocetak drugog dela -->
                        <p align="right" style="color:hsla(0,0%,100%,.5)">Projekat</p>
                    </div><!-- kraj drugog dela -->

                </div>
            </div>
        </div>
    </footer>

</body>

</html>