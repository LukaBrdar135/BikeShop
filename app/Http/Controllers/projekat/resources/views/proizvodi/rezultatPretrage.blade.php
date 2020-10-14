@extends('layouts.layout')
@section ('content')

<hr>
<h2 style="text-align: center; text-transform: uppercase;">Rezulatati pretrage: {{$pretraga}} </h2>
<hr>
<div class="container">
    <!-- container -->
    <div class="row">
        <div class="col-sm-3 " style="height:max-content">
            <div class="left-sidebar">
                <!--izbor kategorije-->
                @include('proizvodi.dodaci.kategorija')
                <!--kraj izbora kategorije-->
            </div>
        </div>
        <!-- proizvodi -->
        @if($proizvods->count()>=1)
        @include('proizvodi.dodaci.artikli', ['$proizvods' => '$proizvods'])
        @else
        <h2 style="color: #f00;">Proizvod sa imenom {{$pretraga}} ne postoji!</h2>
        @endif
        <!-- kraj proizvoda -->
    </div>


</div> <!-- kraj containera -->
<hr>
@endsection