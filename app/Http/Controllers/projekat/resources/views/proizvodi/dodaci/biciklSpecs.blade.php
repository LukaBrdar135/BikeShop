<?php if($specs){?>
<h2>Specifikiacije</h2>
<table class="table" style="margin-bottom: 50px; border:1px solid rgba(0,0,0,.1);">
    <tr>
        <thead class="thead-dark">
            <th>Ram</th>
            <td>{{$specs->ram}}</td>
        </thead>
    </tr>
    <thead class="thead-dark">
        <th>Boja</th>
        <td>{{$specs->boja}}</td>
    </thead>
    </tr>
    <thead class="thead-dark">
        <th>Viljuska</th>
        <td>{{$specs->viljuska}}</td>
    </thead>
    </tr>
    <thead class="thead-dark">
        <th>Zadnji amortizer</th>
        <td>{{$specs->zadnjiAmortizer}}</td>
    </thead>
    </tr>
    <thead class="thead-dark">
        <th>Kocnice</th>
        <td>{{$specs->kocnice}}</td>
    </thead>
    </tr>
    <thead class="thead-dark">
        <th>Zadnji menjac</th>
        <td>{{$specs->menjacZadnji}}</td>
    </thead>
    </tr>
    <thead class="thead-dark">
        <th>Prednji menjac</th>
        <td>{{$specs->menjacPrednji}}</td>
    </thead>
    </tr>
</table>
<?php } ?>
