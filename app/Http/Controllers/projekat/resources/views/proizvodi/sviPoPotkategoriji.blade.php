@extends('layouts.layout')
@section ('content')


<hr>
<h2 style="text-align: center; text-transform: uppercase;">Svi {{$kategorijaProizvoda}} {{$potkategorijaProizvoda}}</h2>
<hr>
<div class="container">
    <!-- container -->
    <div class="row">
        <div class="col-sm-3 " style="height:max-content">
            <div class="left-sidebar">
                <!--izbor kategorije-->
                @include('proizvodi.dodaci.kategorija')
                <!--kraj izbora kategorije-->
                <?php $sviProizvodi = App\Proizvod::all(); ?>

                <!-- brendovi -->
                <h2>Brendovi</h2>
                <div class="panel-group category-products" id="accordian">
                    <!--Izbor kategorije-->
                    @foreach($brendovi as $brend)
                    <?php
                        $brModela=0;
                    ?>
                    @foreach($sviProizvodi as $proizvod)
                    <?php
                        if($proizvod->brend == $brend->brend && $proizvod->potkategorija == $potkategorijaProizvoda)
                        $brModela++;
                    ?>
                    @endforeach
                    @if($brModela>0)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a class="js"
                                    href="/proizvodi/{{$kategorijaProizvoda}}/{{$potkategorijaProizvoda}}/{{$brend->brend}}">{{$brend->brend}}({{$brModela}})</a>
                            </h4>
                        </div>
                    </div>
                    @endif

                    @endforeach
                </div>
                <!-- kraj brendovi -->

            </div>
        </div>
        <!-- proizvodi -->
        @include('proizvodi.dodaci.artikli', ['$proizvods' => '$proizvods'])

        <!-- kraj proizvoda -->
    </div>


</div> <!-- kraj containera -->
@endsection


<!-- brendovi -->