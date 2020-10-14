<?php
if($korpa->totalnaKolicina == 0){
    ?>
    <p>Korpa je prazna.</p>
    <?php
}
else{
?>
<style>
    .table td {
    vertical-align: middle;
    }
</style>
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th></th>
                <th>Naziv</th>
                <th>Cena</th>
                <th>Kolicina</th>
                <th>Ukupna cena</th>
                <th></th>
            </tr>
        </thead>
        @foreach($korpa->proizvodiUKorpi as $proizvod)
        <tr>
            <td><img src="{{Storage::disk('local')->url($proizvod['proizvod']['slika'])}}" style="border: 1px solid #F7F7F0; height: 150px; width: 200px;"></td>
            <td>{{$proizvod->proizvod['naziv']}}</td>
            <td>{{$proizvod['proizvod']['cena']}}</td>
            <td><a class="btn btn-outline-danger" href="/korpa/smanji/{{$proizvod['proizvod']['id']}}">-</a>  {{$proizvod['kolicina']}}  <a class="btn btn-outline-success" href="{{ route('dodajUKorpu', ['id'=> $proizvod['proizvod']['id']])}}">+</a> </td>
            <td>${{$proizvod['kolicina'] * $proizvod['proizvod']['cena']}}</td>
            <td><a class="btn btn-danger" data-toggle="tooltip" data-placement="right" title="Obrisi" href="/korpa/izbaci/{{$proizvod->proizvod['id']}}"><i class="fa fa-times"></i></a></td>
        </tr>
        @endforeach
    </table>
    <p>Totalna kolicina: {{$korpa->totalnaKolicina}}</p>
    <p>Totalna cena: {{$korpa->totalnaCena}}</p>
<?php
}
?>