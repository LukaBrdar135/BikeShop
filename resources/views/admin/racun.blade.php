@extends('layouts.adminLayout')
@section('content')



<h1>Racun id: {{$racun->id}}</h1>
<hr>
<h3>Detalji racuna</h3>
<table class="table" style="margin-bottom: 50px; border:1px solid rgba(0,0,0,.1);">
    <tr>
        <thead class="thead-dark">
            <th>Email</th>
            <td>{{$racun->email}}</td>
        </thead>
    </tr>
    <tr>
        <thead class="thead-dark">
            <th>Ime</th>
            <td>{{$racun->ime}}</td>
        </thead>
    </tr>
    <tr>
        <thead class="thead-dark">
            <th>Prezime</th>
            <td>{{$racun->prezime}}</td>
        </thead>
    </tr>
    <tr>
        <thead class="thead-dark">
            <th>Datum</th>
            <td>{{$racun->created_at}}</td>
        </thead>
    </tr>
    <tr>
        <thead class="thead-dark">
            <th>Vrednost</th>
            <td>${{$racun->vrednost}}</td>
        </thead>
    </tr>
    <tr>
        <thead class="thead-dark">
            <th>Kolicina</th>
            <td>{{$racun->kolicina}}</td>
        </thead>
    </tr>
</table>

<hr>

<h3>Stavke racuna</h3>

<table class="table table-striped">
    <thead class="thead-dark">
        <tr>
            <th>Naziv</th>
            <th>Kolicina</th>
            <th>Cena</th>
        </tr>
    </thead>
    @foreach($stavkeRacuna as $stavka)
    <tr>
        <td>{{$stavka->naziv}}</td>
        <td>{{$stavka->kolicina}}</td>
        <td>${{$stavka->cena}}</td>
    </tr>
    @endforeach
</table>


@endsection