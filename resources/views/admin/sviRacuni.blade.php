@extends('layouts.adminLayout')
@section('content')

<style>
    tr[data-href]{
        cursor: pointer;
    }
    tr:hover{
        color: #38c172;
    }
</style>

<h1>Svi racuni</h1>
<hr>
<table class="table table-striped">
    <thead class="thead-dark">
        <tr>
            <th>Email</th>
            <th>Ime</th>
            <th>Prezime</th>
            <th>Datum</th>
            <th>Vrednost</th>
            <th>Kolicina</th>
        </tr>
    </thead>
    @foreach($racuni as $racun)
    <tr data-href="../racuni/{{$racun->id}}">
        <td>{{$racun->email}}</td>
        <td>{{$racun->ime}}</td>
        <td>{{$racun->prezime}}</td>
        <td>{{$racun->created_at}}</td>
        <td>${{$racun->vrednost}}</td>
        <td>{{$racun->kolicina}}</td>
    </tr>
    @endforeach
</table>


<script>
    document.addEventListener("DOMContentLoaded", ()=>{
        const rows = document.querySelectorAll("tr[data-href]");

        rows.forEach(row=> {
            row.addEventListener("click", ()=> {
                window.location.href= row.dataset.href;
            });
        });
    });
</script>

@endsection