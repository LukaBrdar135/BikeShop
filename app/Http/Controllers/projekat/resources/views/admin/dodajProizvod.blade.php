@extends('layouts.adminLayout')
@section('content')
<h1>Dodaj novi proizvod</h1>
<hr>

<style>
    .hidden{
        position: absolute;
        visibility: hidden;
    }
</style>

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
    {{ Form::open(array('action' => 'AdminController@dodajProizvodPost', 'method'=>'post' ,'files'=>true, 'enctype'=>'multipart/form-data')) }}
    <div class="form-group">
        <label class="control-label">Naziv</label>
        <input class="form-control mr-sm-2" type="text" name="naziv">
    </div>
    <div class="form-group">
        <label class="control-label">Brend</label>
        <input class="form-control mr-sm-2" type="text" name="brend">
    </div>
    <div class="form-group">
        <label class="control-label">Kategorija</label>
        <input class="form-control mr-sm-2" type="text" name="kategorija" id="kategorija" onkeyup="kategorijaF()">
    </div>
    <div class="form-group">
        <label class="control-label">Potkategorija</label>
        <input class="form-control mr-sm-2" type="text" name="potkategorija">
    </div>
    <div class="form-group">
        <label class="control-label">Cena</label>
        <input class="form-control mr-sm-2" type="number" step=0.01 name="cena">
    </div>
    <div class="form-group">
        <label class="control-label">Opis</label>
        <textarea class="form-control" name="opis"></textarea>
    </div>
    <div class="form-group">
        <label class="control-label">Slika</label>
        <input class="form-control mr-sm-2" type="file" name="slika">
    </div>

    <!-- ako je kategorija Bicikli -->
    <div class="hidden" id="divBicikli">
    <div class="form-group">
        <label class="control-label">Ram</label>
        <input class="form-control mr-sm-2" type="text" name="ram">
    </div>
    <div class="form-group">
        <label class="control-label">Boja</label>
        <input class="form-control mr-sm-2" type="text" name="boja">
    </div>
    <div class="form-group">
        <label class="control-label">Viljuska</label>
        <input class="form-control mr-sm-2" type="text" name="viljuska">
    </div>
    <div class="form-group">
        <label class="control-label">Zadnji amortizer</label>
        <input class="form-control mr-sm-2" type="text" name="zadnjiAmort">
    </div>
    <div class="form-group">
        <label class="control-label">Kocnice</label>
        <input class="form-control mr-sm-2" type="text" name="kocnice">
    </div>
    <div class="form-group">
        <label class="control-label">Zadnji menjac</label>
        <input class="form-control mr-sm-2" type="text" name="menjacZadnji">
    </div>
    <div class="form-group">
        <label class="control-label">Prednji menjac</label>
        <input class="form-control mr-sm-2" type="text" name="menjacPrednji">
    </div>
    </div>
    <!-- kraj ako je kategorija bicikli-->

    <button class="btn btn-outline-danger my-2 my-sm-0" type="submit">Dodaj</button>
    <button class="btn btn-outline-primary my-2 my-sm-0"><a href="{{URL::previous()}}">Odustani</a></button>
    {{ Form::close() }}

</div>

<script>
function kategorijaF() {
    if ((document.getElementById('kategorija').value).toLowerCase()=="bicikli") {
        document.getElementById('divBicikli').classList.remove('hidden');
    }
    else{
    if(!document.getElementById('divBicikli').classList.contains('hidden')){
            document.getElementById('divBicikli').classList.add('hidden');
             console.log("promena");
    }
    }
    
}
</script>
@endsection