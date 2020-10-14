@extends('layouts.layout')
@section ('content')

<style>
.activeBrand {
    font-weight: bold;
    color: #38c172;
}
</style>

<hr>
<h2 style="text-align: center; text-transform: uppercase;">Svi proizvodi {{$activeBrend}}</h2>
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
                    <!-- svi brendovi -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a href="/proizvodi/svi">Svi brendovi</a></h4>
                        </div>
                    </div>
                    
                    @foreach($brendovi as $brend)
                    <?php
                        $brModela=0;
                    ?>
                    @foreach($sviProizvodi as $proizvod)
                    <?php
                        if($proizvod->brend == $brend->brend)
                        $brModela++;
                    ?>
                    @endforeach
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a class="js"
                                    href="/proizvodi/svi/{{$brend->brend}}">{{$brend->brend}}({{$brModela}})</a></h4>
                        </div>
                    </div>
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

@include('proizvodi.dodaci.aktivniBrend', ['$proizvod' => '$proizvod'])

@endsection