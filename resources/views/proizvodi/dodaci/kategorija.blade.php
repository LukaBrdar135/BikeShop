<?php
    $kategorije=App\Proizvod::distinct()->get('kategorija');
?>

<h2>Kategorija</h2>
<div class="panel-group category-products" id="accordian">
    <!--Izbor kategorije-->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title"><a href="/proizvodi/svi">Svi proizvodi</a></h4>
        </div>
    </div>
    @foreach($kategorije as $kategorija)
    <?php $potkategorije= App\Proizvod::where('kategorija','=',$kategorija->kategorija)->distinct()->get('potkategorija'); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordian" href="#{{$kategorija->kategorija}}">
                    <span class="badge"><i class="fa fa-plus"></i></span>
                    {{$kategorija->kategorija}}
                </a>
            </h4>
        </div>
        <div id="{{$kategorija->kategorija}}" class="panel-collapse collapse">
            <div class="panel-body">
                <ul>
                    <li><a href="/proizvodi/{{$kategorija->kategorija}}">Svi</a></li>
                    @foreach($potkategorije as $potkategorija)
                    <li><a
                            href="/proizvodi/{{$kategorija->kategorija}}/{{$potkategorija->potkategorija}}/svi">{{$potkategorija->potkategorija}}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endforeach
</div>