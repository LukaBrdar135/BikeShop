<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet">
    
    <link href="/css/font-awesome.min.css" rel="stylesheet">
    <link href="/css/lightbox.css" rel="stylesheet">

    <script src="/js/app.js"></script>
    <script src="/js/lightbox.js"></script>
</head>
<style>
    body{
        margin: 0;
    }
    .navbar{
        margin-bottom: 20px;
        height: 60px;
    background: #343a40;
    clear: both;
    }
    .navbar-toggle {
    background-color: #000;
}

.navbar div.container{
    background-color: #343a40;
    padding: 0px 10px;
}
.navbar-expand-lg
{
    background-color: #343a40;
}
</style>



</style>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <!-- pocetak navbar -->
        <div class="container">
            <!-- pocetak container -->

            <a class="navbar-brand" href="/" style="font-size: 25px;">Admin panel</a>
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
                        <a class="nav-link" href="/admin/proizvodi">Proizvodi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/racuni/svi">Racuni</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/reklamacije/sve">Reklamacije</a>
                    </li>
                </ul>

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

</body>

</html>