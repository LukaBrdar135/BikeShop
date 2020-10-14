@extends('layouts.layout')
@section ('content')


<hr>
<h2 style="text-align: center; text-transform: uppercase;"><i class="fa fa-shopping-cart"></i>Korpa</h2>
<hr>
<div class="container"><!-- container -->

@if($korpaSession)
@include('korpa.sessionDodatak', ['$korpaSession' => '$korpaSession'])
@elseif($korpa)
@include('korpa.dbDodatak', ['$korpa' => '$korpa'])
@else
<p>Korpa je prazna.</p>
@endif


</div> <!-- kraj containera -->
<hr>
@endsection