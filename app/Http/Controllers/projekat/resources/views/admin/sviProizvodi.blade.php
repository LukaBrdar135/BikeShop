@extends('layouts.adminLayout')
@section('content')

<script>
    $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
<style>
    .tooltip-inner {
    background-color: #f00;
    }
</style>

<h1>Proizvodi</h1>
<hr>
<a class="btn btn-success" href="../admin/proizvodi/dodajProizvod">Dodaj novi</a>
<hr>
<table class="table table-striped">
    <thead class="thead-dark">
        <tr>
            <th>Id</th>
            <th>Naziv</th>
            <th>Brend</th>
            <th>Kategorija</th>
            <th>Potkategorija</th>
            <th>Cena</th>
            <th>Slika</th>
            <th></th>
        </tr>
    </thead>
    @foreach($proizvodi as $proizvod)
    <tr>
        <td>{{$proizvod->id}}</td>
        <td>{{$proizvod->naziv}}</td>
        <td>{{$proizvod->brend}}</td>
        <td>{{$proizvod->kategorija}}</td>
        <td>{{$proizvod->potkategorija}}</td>
        <td>{{$proizvod->cena}}</td>
        <td><a href="{{Storage::disk('local')->url($proizvod->slika)}}" data-lightbox="{{$proizvod->slika}}" data-title="{{$proizvod->slika}}">
            Klikni za detalje</a></td>
        <td>
            @if($proizvod->kategorija == "bicikli")
            <a class="btn btn-info" data-toggle="tooltip" data-placement="left" title="Azurirraj specifikacije bicikla" href="/admin/proizvod/{{$proizvod->id}}/spec"><i class="fa fa-gears"></a></i>
            <a class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="Azuriraj"  href="/admin/proizvod/{{$proizvod->id}}"><i class="fa fa-pencil"></i></a>
            <a class="btn btn-danger" data-toggle="tooltip" data-placement="right" title="Obrisi" onclick="return confirm('Siguran?')" href="/admin/proizvod/obrisiProizvod/{{$proizvod->id}}"><i class="fa fa-times"></i></a>
            @else
            <a class="btn btn-warning" data-toggle="tooltip" data-placement="left" title="Azuriraj"  href="/admin/proizvod/{{$proizvod->id}}"><i class="fa fa-pencil"></i></a>
            <a class="btn btn-danger" data-toggle="tooltip" data-placement="right" title="Obrisi" onclick="return confirm('Siguran?')" href="/admin/proizvod/obrisiProizvod/{{$proizvod->id}}"><i class="fa fa-times"></i></a>
            @endif
        </td>
    </tr>
    @endforeach
</table>
@endsection