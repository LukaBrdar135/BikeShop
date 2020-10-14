@extends('layouts.adminLayout')
@section('content')



<h1>Reklamacija</h1>
<a href="{{ URL::previous() }}"><i class="fa fa-long-arrow-left"></i>Nazad na prethodnu stranicu</a>
<hr>
<div class="container">
@if(session()->has('uspeh'))
    <div class="alert alert-success container">
        {{ session()->get('uspeh') }}
    </div>
@endif
<table class="table" style="margin-bottom: 50px; border:1px solid rgba(0,0,0,.1);">
    <tr>
        <thead class="thead-dark">
            <th>Email</th>
            <td>{{$reklamacija->email}}</td>
        </thead>
    </tr>
    <tr>
        <thead class="thead-dark">
            <th>Ime</th>
            <td>{{$reklamacija->ime}}</td>
        </thead>
    </tr>
    <tr>
        <thead class="thead-dark">
            <th>Prezime</th>
            <td>{{$reklamacija->prezime}}</td>
        </thead>
    </tr>
    <tr>
        <thead class="thead-dark">
            <th>Kod racuna</th>
            <td>{{$reklamacija->id_racuna}}</td>
        </thead>
    </tr>
    <tr>
        <thead class="thead-dark">
            <th>Datum</th>
            <td>{{$reklamacija->created_at}}</td>
        </thead>
    </tr>
    <tr>
        <thead class="thead-dark">
            <th>Proizvodi</th>
            <td>{{$reklamacija->proizvodi}}</td>
        </thead>
    </tr>
    <tr>
        <thead class="thead-dark">
            <th>Poruka</th>
            <td style="word-break: break-word; max-width: 500px">{{$reklamacija->poruka}}</td>
        </thead>
    </tr>
</table>
</div>
<div class="container" style="margin-bottom: 30px">
{{ Form::open(array('action' => 'AdminController@posaljiOdgovor', 'method'=>'post' ,'files'=>true, 'enctype'=>'multipart/form-data')) }} 
    <div class="form-group">
        <label class="control-label">Email</label>
        <input class="form-control mr-sm-2" type="text" name="email" value="{{$reklamacija->email}}">
    </div>
    <div class="form-group">
        <label class="control-label">Ime</label>
        <input class="form-control mr-sm-2" type="text" name="ime" value="{{$reklamacija->ime}}">
    </div>
    <div class="form-group">
        <label class="control-label">Prezime</label>
        <input class="form-control mr-sm-2" type="text" name="prezime" value="{{$reklamacija->prezime}}">
    </div>
    <div class="form-group">
        <label class="control-label">Proizvod/i</label>
        <input class="form-control mr-sm-2" type="text" name="proizvodi" value="{{$reklamacija->ime}}">
    </div>
    <div class="form-group">
        <label class="control-label">Poruka</label>
        <textarea class="form-control" name="poruka" style="height: 100px"></textarea>
    </div>
    <div class="text-center">
    <button class="btn btn-success" type="submit" style="width: 100px">Posalji</button>
    </div>
    {{ Form::close() }}
</div>




@endsection