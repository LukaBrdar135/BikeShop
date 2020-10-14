@extends('layouts.adminLayout')
@section('content')
<h1>Azuriraj proizvod: {{$proizvod->id}}</h1>
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
@endif
{{ Form::open(array('action' => 'AdminController@azurirajProizvodPost', 'method'=>'post')) }}
<div class="form-group">
<label class="control-label">Naziv</label>
<input class="form-control mr-sm-2" type="text" name="naziv" value="{{$proizvod->naziv}}">
</div>
<div class="form-group">
<label class="control-label">Brend</label>
<input class="form-control mr-sm-2" type="text" name="brend" value="{{$proizvod->brend}}">
</div>
<div class="form-group">
<label class="control-label">Kategorija</label>
<input class="form-control mr-sm-2" type="text" name="kategorija" value="{{$proizvod->kategorija}}">
</div>
<div class="form-group">
<label class="control-label">Potkategorija</label>
<input class="form-control mr-sm-2" type="text" name="potkategorija" value="{{$proizvod->potkategorija}}">
</div>
<div class="form-group">
<label class="control-label">Cena</label>
<input class="form-control mr-sm-2" type="number" step=0.01 name="cena" value="{{$proizvod->cena}}">
</div>
<div class="form-group">
<label class="control-label">Slika</label>
<img src="{{Storage::disk('local')->url($proizvod->slika)}}" style="border: 1px solid #F7F7F0; height: 100%; width: 100%;">
<input class="form-control mr-sm-2" type="hidden" name="slikaHidden" value="{{$proizvod->slika}}">
<input class="form-control mr-sm-2" type="file" name="slika">
</div>
<div class="form-group">
<label class="control-label">Opis</label>
<textarea class="form-control" name="opis">{{$proizvod->opis}}</textarea>
</div>
<input type="hidden" name="id" value="{{$proizvod->id}}"> 
<button class="btn btn-outline-danger my-2 my-sm-0" type="submit">Azuriraj</button>
<button class="btn btn-outline-primary my-2 my-sm-0"><a href="{{URL::previous()}}">Odustani</a></button>
{{ Form::close() }}

</div>
@endsection