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
            <img class="d-block w-100" src="{{Storage::disk('local')->url('app/public/images/canyon2000x500.jpg')}}"
                alt="First slide">
            <div class="carousel-caption">
                <h2>Bikeshop</h2>
                <button class="btn">Proizvodi</button>
            </div>
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="{{Storage::disk('local')->url('app/public/images/canyon2000x500.jpg')}}"
                alt="Second slide">
            <div class="carousel-caption">
                <h2>Bikeshop</h2>
                <button class="btn">Proizvodi</button>
            </div>
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="{{Storage::disk('local')->url('app/public/images/canyon2000x500.jpg')}}"
                alt="Third slide">
            <div class="carousel-caption">
                <h2>Bikeshop</h2>
                <button class="btn">Proizvodi</button>
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
<h2 style="text-align:center">Izabrani proizvodi</h2>
<hr>
<!-- container -->
<div class="container">

    <div class="row"><!-- pocetak reda -->
        <?php
        $proizvods = App\Proizvod::where('kategorija','=','bicikl')->get(); 
        ?>
        @foreach($proizvods as $proizvod)
        <div class="col-sm-4"> <!-- pocetak itema-->
            <div class="product-image-wrapper">
                <!-- pocetak itema-->
                <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="{{Storage::disk('local')->url('images/proizvodi/'.$proizvod->slika)}}" alt=""/>
                        <h2>${{$proizvod->cena}}</h2>
                        <h4>{{$proizvod->brend}}</h4>
                        <p>{{$proizvod->naziv}}</p>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-search"></i>Pogledaj detalje</a>
                    </div>
                    <div class="product-overlay">
                        <div class="overlay-content">
                            <h2>${{$proizvod->cena}}</h2>
                            <p>{{$proizvod->naziv}}</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-search"></i>Pogledaj detalje</a>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- kraj itema-->
        @endforeach
    </div> <!-- kraj reda -->

</div> <!-- kraj containera -->
<hr>

@endsection