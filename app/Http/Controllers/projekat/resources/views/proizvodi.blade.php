@extends('layouts.layout')
@section ('content')

<hr>
<h2 style="text-align: center; text-transform: uppercase;">Svi proizvodi</h2>
<hr>
<div class="container">
    <!-- container -->
    <div class="row">
        <div class="col-sm-3 " style="height:max-content">
            <div class="left-sidebar">
                <!--izbor kategorije-->
                @include('proizvodi.dodaci.kategorija')
                <!--kraj izbora kategorije-->

                <!-- brendovi -->
                <h2>Brendovi</h2>
                <div class="panel-group category-products" id="accordian">
                    @foreach($brendovi as $brend)
                    <?php
                        $brProizvodaBrenda= App\Proizvod::where('brend','=',$brend->brend)->count();
                        ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a
                                    href="/proizvodi/svi/{{$brend->brend}}">{{$brend->brend}}({{$brProizvodaBrenda}})</a>
                            </h4>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!--  kraj brendova -->

            </div>
        </div>
        <!-- proizvodi -->
        @include('proizvodi.dodaci.artikli', ['$proizvods' => '$proizvods'])
        <!-- kraj proizvoda -->
    </div>


</div> <!-- kraj containera -->
<hr>
@endsection