@extends('layouts.layout')
@section ('content')


<hr>
<h2 style="text-align: center; text-transform: uppercase;"><i class="fa fa-shopping-cart"></i>Korpa</h2>
<hr>
<div class="container">
    <!-- container -->

    @if($korpaSession)
    @include('korpa.sessionDodatak', ['$korpaSession' => '$korpaSession'])
    @elseif($korpa)
    @include('korpa.dbDodatak', ['$korpa' => '$korpa'])
    @else
    <div style="text-align: center;">
        <h3 style="color: #f00">Korpa je prazna.</h3>
        <p>Klikom na dugme pogledajte koje proizvode imamo.</p>
        <a href="/proizvodi/svi" class="btn btn-success">Proizvodi</a>
    </div>
    @endif


</div> <!-- kraj containera -->

@endsection