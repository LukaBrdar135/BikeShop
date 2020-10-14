@foreach($proizvods as $proizvod)
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <img src="{{Storage::disk('local')->url($proizvod->slika)}}" alt="" style="max-height:260px" />
                    <h2>${{$proizvod->cena}}</h2>
                    <h4>{{$proizvod->brend}}</h4>
                    <p>{{$proizvod->naziv}}</p>
                    <a href="/proizvod/{{$proizvod->id}}" class="btn btn-default add-to-cart"><i class="fa fa-search"></i>Pogledaj detalje</a>
                </div>
                <div class="product-overlay">
                    <div class="overlay-content">
                        <h2>${{$proizvod->cena}}</h2>
                        <p>{{$proizvod->naziv}}</p>
                        <a href="/proizvod/{{$proizvod->id}}" class="btn btn-default add-to-cart"><i class="fa fa-search"></i>Pogledaj detalje</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach 