

@extends('website.layout')
@section('css')
@endsection

@section('content')
    <div class="container">        
        <div class="row">
          <div class="col-sm-12 col-md-12 col-lg-12">
              <div class="card m-2 mt-3">
                  <div class="d-flex flex-row m-2">
                    <div class="p-2">
                      <input class="form-check-input" type="checkbox" value="" id="makanan">
                      <label class="form-check-label" for="makanan">
                        Makanan
                      </label>
                    </div>
                    <div class="p-2">
                      <input class="form-check-input" type="checkbox" value="" id="minuman">
                      <label class="form-check-label" for="minuman">
                        Minuman
                      </label>
                    </div>
                  </div>
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-2">
            <div class="card my-1">
              <img src="https://images.tokopedia.net/img/cache/200-square/VqbcmM/2021/8/9/0756df71-e25a-43fd-a9ca-4a75f6f5ccf7.jpg" class="card-img-top" alt="...">
              <div class="card-body p-2">
                <p class="fs-nama-produk">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <p class="fs-harga-produk">Rp 15.000</p>
                <p class="fs-nama-toko mb-1"><i class="fa-solid fa-shop"></i> berkah bismillah sdfdf sdfsdf dsf</p>
                <div class="d-flex flex-row "> <i class="fas fa-star text-warning me-1"></i><p class="fs-info mb-1">4.9 | 250 terjual</p> </div>
              </div>
            </div>
          </div>
          <div class="col-lg-2">
            <div class="card my-1">
              <img src="https://images.tokopedia.net/img/cache/200-square/VqbcmM/2021/8/9/0756df71-e25a-43fd-a9ca-4a75f6f5ccf7.jpg" class="card-img-top" alt="...">
              <div class="card-body p-2">
                <p class="fs-nama-produk">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <p class="fs-harga-produk">Rp 15.000</p>
                <p class="fs-nama-toko mb-1"><i class="fa-solid fa-shop"></i> berkah bismillah sdfdf sdfsdf dsf</p>
                <div class="d-flex flex-row "> <i class="fas fa-star text-warning me-1"></i><p class="fs-info mb-1">4.9 | 250 terjual</p> </div>
              </div>
            </div>
          </div>
          <div class="col-lg-2">
            <div class="card my-1">
              <img src="https://images.tokopedia.net/img/cache/200-square/VqbcmM/2021/8/9/0756df71-e25a-43fd-a9ca-4a75f6f5ccf7.jpg" class="card-img-top" alt="...">
              <div class="card-body p-2">
                <p class="fs-nama-produk">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <p class="fs-harga-produk">Rp 15.000</p>
                <p class="fs-nama-toko mb-1"><i class="fa-solid fa-shop"></i> berkah bismillah sdfdf sdfsdf dsf</p>
                <div class="d-flex flex-row "> <i class="fas fa-star text-warning me-1"></i><p class="fs-info mb-1">4.9 | 250 terjual</p> </div>
              </div>
            </div>
          </div>
        </div>
    </div>
@endsection 

@section('ctrl')
    <script>
    app.controller("myCtrl", function($scope,$http) {
        
    });
    </script>
@endsection