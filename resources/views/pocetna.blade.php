@extends('layouts.layout')

@section('content')
<style>
.carousel-caption {
    position: absolute;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 10;
    padding-top: 20px;
    padding-bottom: 40px;
    color: #fff;
    text-align: center;
    background: rgba(0, 0, 0, 0.4);
}
</style>
<!-- carousel start -->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="{{Storage::disk('local')->url('public/images/canyon2000x500.jpg')}}"
                alt="First slide">
            <div class="carousel-caption">
                <h2>Proizvodi</h2>
                <a href="/proizvodi/svi" class="btn btn-primary">Pogledaj vise</a>
            </div>
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="{{Storage::disk('local')->url('public/images/rockyMountain 2000x500.jpg')}}"
                alt="Second slide">
            <div class="carousel-caption">
                <h2>Bicikli</h2>
                <a href="/proizvodi/bicikli" class="btn btn-primary">Pogledaj vise</a>
            </div>
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="{{Storage::disk('local')->url('public/images/tools 2000x500.jpg')}}"
                alt="Third slide">
            <div class="carousel-caption">
                <h2>Delovi</h2>
                <a href="/proizvodi/delovi" class="btn btn-primary">Pogledaj vise</a>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<!-- carousel kraj -->
<hr>
<h2 style="text-align:center">O nama</h2>
<hr>
<div class="container">
    <h2>Bikeshop.com je online prodavnica napravljena od strane biciklista za bicikliste</h2>
    <p style="text-align: center;">Nas cilj je da napravimo nacin da svi biciklisti mogu da kupe bicikle i delove u samo par klikova po
        najpovoljnijoj ceni.</p>
    <hr>

    <blockquote class="blockquote-reverse">
    <p> “A Bad Day On The Mountain Bike Always Beats A Good Day In The Office”</p>
    <footer><cite>- Mike Brcic</cite></footer>
    </blockquote>
    <hr>

    <blockquote class="blockquote-reverse">
    <p> “There Is Nothing, Absolutely Nothing, Quite So Worthwhile As Simply Messing About On Bicycles”</p>
    <footer><cite>– Tom Kunich</cite></footer>
    </blockquote>
<!-- container -->
<div class="container">



</div> <!-- kraj containera -->


@endsection