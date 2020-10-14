@extends('layouts.layout')
@section ('content')


<hr>
<h2 style="text-align: center; text-transform: uppercase;"><i class="fa fa-shopping-cart"></i>Naplata</h2>
<hr>
<div class="container"><!-- container -->

<style>
    .table td {
    vertical-align: middle;
    }
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none; 
    margin: 0; 
}
</style>

<table class="table table-striped">
    <thead class="thead-dark">
        <tr>
            <th>Naziv</th>
            <th>Kolicina</th>
            <th>Cena</th>
        </tr>
    </thead> 

@if($korpaSession)
@foreach($korpaSession->proizvodi as $proizvod)
        <tr>
            <td>{{$proizvod['proizvod']['naziv']}}</td>
            <td>{{$proizvod['kolicina']}}</td>
            <td>${{$proizvod['kolicina'] * $proizvod['proizvod']['cena']}}</td>
        </tr>
@endforeach
</table>
<hr>
<h4>Totalna kolicina: {{$korpaSession->totalKolicina}}</h4>
<h4>Totalna cena: ${{$korpaSession->totalCena}}</h4>
<hr>
@else
@foreach($korpa->proizvodiUKorpi as $proizvod)
        <tr>
            <td>{{$proizvod->proizvod['naziv']}}</td>
            <td>{{$proizvod['kolicina']}}</td>
            <td>${{$proizvod['kolicina'] * $proizvod['proizvod']['cena']}}</td>
        </tr>
        @endforeach
    </table>
    <hr>
    <h4>Totalna kolicina: {{$korpa->totalnaKolicina}}</h4>
    <h4>Totalna cena: ${{$korpa->totalnaCena}}</h4>
    <hr>
@endif


{{ Form::open(array('action' => 'KorpaController@naplataPost', 'method'=>'post')) }}
<div style="width: 500px">
<?php

use Illuminate\Support\Facades\Auth;

if(Auth::check()){ ?>
<div class="form-group">
        <label class="control-label">Email</label>
        <input class="form-control mr-sm-2" readonly type="text" name="email" value="{{Auth::user()->email}}">
    </div>
<?php } else{?>   
    <div class="form-group">
        <label class="control-label">Email</label>
        <input class="form-control mr-sm-2" type="text" name="email">
    </div>
<?php } ?> 
    <div class="form-group">
        <label class="control-label">Ime</label>
        <input class="form-control mr-sm-2" type="text" name="ime">
    </div>
    <div class="form-group">
        <label class="control-label">Prezime</label>
        <input class="form-control mr-sm-2" type="text" name="prezime">
    </div>
    <div class="form-group">
        <label class="control-label">Adresa</label>
        <input class="form-control mr-sm-2" type="text" name="adresa">
    </div>
    <div class="form-group">
        <label class="control-label">Broj kartice</label>
        <input class="form-control mr-sm-2" type="number" name="brojKartice">
    </div>
    <div style="display: inline-block;">
        <label class="control-label">Vazi do meseca</label>
        <input class="form-control mr-sm-2" type="number" name="vaziMesec">
    </div>
    <div style="display: inline-block; margin-left: 10px">
        <label class="control-label">Vazi do godine</label>
        <input class="form-control mr-sm-2" type="number" name="vaziGodina">
    </div>
    <div class="form-group">
        <label class="control-label">CVV</label>
        <input class="form-control mr-sm-2" type="number" name="cvv">
    </div>
</div>
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Plati</button>
    <button class="btn btn-outline-primary my-2 my-sm-0"><a href="{{URL::previous()}}">Odustani</a></button>
{{ Form::close() }}


</div> <!-- kraj containera -->

@endsection