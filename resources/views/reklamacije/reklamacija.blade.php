@extends('layouts.layout')
@section('content')


<style>
    input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
</style>

<hr>
<h2 style="text-align: center; text-transform: uppercase;">Reklamacija</h2>
<hr>

<div class="container">

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @elseif(session()->has('uspeh'))
    <div class="alert alert-success">
        {{ session()->get('uspeh') }}
    </div>
    @elseif(session()->has('greska'))
    <div class="alert alert-danger">
        {{ session()->get('greska') }}
    </div>
    @endif

    {{ Form::open(array('action' => 'ReklamacijaController@reklamacijaPost', 'method'=>'post' ,'files'=>true, 'enctype'=>'multipart/form-data')) }}
    <?php

use Illuminate\Support\Facades\Auth;

if(Auth::check()){ ?>
<div class="form-group">
        <label class="control-label">Email</label>
        <input class="form-control mr-sm-2" type="text" name="email" value="{{Auth::user()->email}}">
    </div>
<?php } else{?>   
    <div class="form-group">
        <label class="control-label">Email</label>
        <input class="form-control mr-sm-2" type="text" name="email">
    </div>
<?php } ?> 
    <div class="form-group">
        <label class="control-label">Ime <small>(sa racuna)</small></label>
        <input class="form-control mr-sm-2" type="text" name="ime">
    </div>
    <div class="form-group">
        <label class="control-label">Prezime <small>(sa racuna)</small></label>
        <input class="form-control mr-sm-2" type="text" name="prezime">
    </div>
    <div class="form-group">
        <label class="control-label">Kod racuna</label>
        <input class="form-control mr-sm-2" type="number" step=1 name="id_racuna">
    </div>
    <div class="form-group">
        <label class="control-label">Proizvod/i</label>
        <input class="form-control mr-sm-2" type="text" name="proizvodi">
    </div>
    <div class="form-group">
        <label class="control-label">Poruka</label>
        <textarea class="form-control" name="poruka" style="height: 100px"></textarea>
    </div>
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Posalji</button>
    <button class="btn btn-outline-primary my-2 my-sm-0"><a href="{{URL::previous()}}">Odustani</a></button>
    {{ Form::close() }}

</div>


@endsection