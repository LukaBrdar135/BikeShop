@extends('layouts.adminLayout')
@section('content')
<h1>Azuriraj specifikacije bicikla: {{$proizvod->id}}</h1>
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
{{ Form::open(array('action' => 'AdminController@azurirajProizvodSpecPost', 'method'=>'post')) }}
<div class="form-group">
<label class="control-label">Ram</label>
<input class="form-control mr-sm-2" type="text" name="ram" value="{{$proizvod->biciklSpec->ram}}">
</div>
<div class="form-group">
<label class="control-label">Boja</label>
<input class="form-control mr-sm-2" type="text" name="boja" value="{{$proizvod->biciklSpec->boja}}">
</div>
<div class="form-group">
<label class="control-label">Viljuska</label>
<input class="form-control mr-sm-2" type="text" name="viljuska" value="{{$proizvod->biciklSpec->viljuska}}">
</div>
<div class="form-group">
<label class="control-label">Zadnji amortizer</label>
<input class="form-control mr-sm-2" type="text" name="zadnjiAmort" value="{{$proizvod->biciklSpec->zadnjiAmortizer}}">
</div>
<div class="form-group">
<label class="control-label">Kocnince</label>
<input class="form-control mr-sm-2" type="text" name="kocnice" value="{{$proizvod->biciklSpec->kocnice}}">
</div>
<div class="form-group">
<label class="control-label">Zadnji menjac</label>
<input class="form-control mr-sm-2" type="text" name="menjacZadnji" value="{{$proizvod->biciklSpec->menjacZadnji}}">
</div>
<div class="form-group">
<label class="control-label">Prednji menjac</label>
<input class="form-control mr-sm-2" type="text" name="menjacPrednji" value="{{$proizvod->biciklSpec->menjacPrednji}}">
</div>

<input type="hidden" name="id" value="{{$proizvod->biciklSpec->id}}"> 
<button class="btn btn-outline-danger my-2 my-sm-0" type="submit">Azuriraj</button>
<button class="btn btn-outline-primary my-2 my-sm-0"><a href="{{URL::previous()}}">Odustani</a></button>
{{ Form::close() }}

</div>
@endsection