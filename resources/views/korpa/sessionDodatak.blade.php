<?php
if($korpaSession->totalKolicina == 0){
    ?>
    <div style="text-align: center;">
        <h3 style="color: #f00">Korpa je prazna.</h3>
        <p>Klikom na dugme pogledajte koje proizvode imamo.</p>
        <a href="/proizvodi/svi" class="btn btn-success">Proizvodi</a>
    </div>
    <?php
}
else{
?>
<style>
    .table td {
    vertical-align: middle;
    }
</style>

    
    <h3 style="display: inline-block;">Totalna kolicina: {{$korpaSession->totalKolicina}}</h3>
    <a style="float: right; width: 300px; border:1px solid #000" href="/korpa/naplata" class="btn btn-primary">Nastavi na naplatu --></a>
    <h3>Totalna cena: ${{$korpaSession->totalCena}}</h3>
    
    <hr>

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
        @foreach($korpaSession->proizvodi as $proizvod)
        <tr>
            <td><img src="{{Storage::disk('local')->url($proizvod['proizvod']['slika'])}}" style="border: 1px solid #F7F7F0; height: 150px; width: 200px;"></td>
            <td>{{$proizvod['proizvod']['naziv']}}</td>
            <td>${{$proizvod['proizvod']['cena']}}</td>
            <td><a class="btn btn-outline-danger" href="/korpa/smanji/{{$proizvod['proizvod']['id']}}">-</a>  {{$proizvod['kolicina']}}  <a class="btn btn-outline-success" href="{{ route('dodajUKorpu', ['id'=> $proizvod['proizvod']['id']])}}">+</a> </td>
            <td>${{$proizvod['kolicina'] * $proizvod['proizvod']['cena']}}</td>
            <td><a class="btn btn-danger" data-toggle="tooltip" data-placement="right" title="Izbaci iz korpe" href="/korpa/izbaci/{{$proizvod['proizvod']['id']}}"><i class="fa fa-times"></i></a></td>
        </tr>
        @endforeach
    </table>

<?php
}
?>