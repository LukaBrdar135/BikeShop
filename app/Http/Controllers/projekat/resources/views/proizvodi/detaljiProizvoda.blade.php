@extends('layouts.layout')
@section ('content')
<hr>
<h2 style="text-align: center; text-transform: uppercase;">Detalji proizvoda: {{$proizvod->naziv}}</h2>
<hr>
<div class="container"> <!-- container -->
<a href="{{ URL::previous() }}"><i class="fa fa-long-arrow-left"></i>Nazad na prethodnu stranicu</a>
    <div class="row">
        <div class="col-md-8">
        <img src="{{Storage::disk('local')->url($proizvod->slika)}}" style="border: 1px solid #F7F7F0;
    height: 100%;
    width: 100%;">
        </div>
        <div class="col-md-4 align-self-center" style="background-color: #eee; padding:20px; border-radius:15px">
            <h3>Naziv: {{$proizvod->naziv}}</h3>
            <h3>Brend: {{$proizvod->brend}}</h3>
            <h3>Cena: ${{$proizvod->cena}}</h3>
            <a class="btn btn-success" href="{{ route('dodajUKorpu', ['id'=> $proizvod->id])}}" ><i class="fa fa-shopping-cart"></i>Dodaj u korpu</a>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
        <h2>Opis proizvoda</h2>
        <p>{{$proizvod->opis}}</p>
        </div>
    </div>

    <hr>

    @if($proizvod->kategorija='bicikli')
    @php $specs = $proizvod->biciklSpec @endphp
    @include('proizvodi.dodaci.biciklSpecs', ['$specs'=>'$specs'])
    @endif
</div> <!-- kraj containera -->
<hr>
@endsection