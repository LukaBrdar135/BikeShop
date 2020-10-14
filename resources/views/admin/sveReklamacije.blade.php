@extends('layouts.adminLayout')
@section('content')

<style>
tr[data-href] {
    cursor: pointer;
}

tr:hover {
    color: #38c172;
}
</style>

<script>
    function nePregledana() {
        document.getElementById("pregledana").style.fontWeight ="bold";
    }

    window.onhashchange = function() {
    location.reload();
}
</script>

<h1 style="margin: 0; display: inline-block;">Reklamacije</h1>
<button class="btn btn-success" onclick="location.reload();" style="float: right; margin-right: 30px;">Osvezi</button>
<hr>
<table class="table table-striped">
    <thead class="thead-dark">
        <tr>
            <th>Kod racuna</th>
            <th>Email</th>
            <th>Ime</th>
            <th>Prezime</th>
            <th>Datum</th>
        </tr>
    </thead>
    @foreach($reklamacije as $reklamacija)
    <tr data-href="../reklamacije/{{$reklamacija->id}}" id="pregledana" style>
        <td>{{$reklamacija->id}}</td>
        <td>{{$reklamacija->email}}</td>
        <td>{{$reklamacija->ime}}</td>
        <td>{{$reklamacija->prezime}}</td>
        <td>{{$reklamacija->created_at}}</td>
    </tr>
    <?php
        if(!$reklamacija->pregledana){
            echo '<script type="text/javascript">','nePregledana();','</script>';
        }
    ?>
    @endforeach
</table>


<script>
document.addEventListener("DOMContentLoaded", () => {
    const rows = document.querySelectorAll("tr[data-href]");

    rows.forEach(row => {
        row.addEventListener("click", () => {
            window.location.href = row.dataset.href;
        });
    });
});
</script>

@endsection