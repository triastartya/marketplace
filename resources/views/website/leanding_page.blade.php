@extends('website.layout')
@section('css')
@endsection

@section('content')
    <div class="container mt-4">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="https://images.tokopedia.net/img/cache/1208/NsjrJu/2024/1/2/6dbd099d-ad5d-49a1-9870-22d5cbee1366.jpg.webp?ect=4g" class="d-block w-100 rounded-4" alt="...">
            </div>
            <div class="carousel-item">
              <img src="https://images.tokopedia.net/img/cache/1208/NsjrJu/2023/12/20/9b52b315-1791-439b-b68a-2639ce5e2f68.jpg.webp?ect=4g" class="d-block w-100 rounded-4" alt="...">
            </div>
            <div class="carousel-item">
              <img src="https://images.tokopedia.net/img/cache/1208/NsjrJu/2024/1/2/6dbd099d-ad5d-49a1-9870-22d5cbee1366.jpg.webp?ect=4g" class="d-block w-100 rounded-4" alt="...">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
        <h3 class="mt-4 mx-3 text-bold">Kategori</h3>
        <div class="row">
          <div class="col-sm-12 col-md-12 col-lg-12">
              <div class="card m-2 mt-3">
                  <div class="d-flex flex-row m-2">
                    <div class="p-2"><a href="javascript:void(0);">Makanan</a></div>
                    <div class="p-2"><a href="javascript:void(0);">Minuman</a></div>
                    <div class="p-2"><a href="javascript:void(0);">Jajan</a></div>
                    <div class="p-2"><a href="javascript:void(0);">Sembako</a></div>
                  </div>
              </div>
          </div>
        </div>
        <h3 class="mt-4 mx-3 text-bold">Produk Populer</h3>
        <div class="row">
          <div class="col-lg-2">
            <div ng-click="detail()" class="card my-1 pointer">
              <img src="https://images.tokopedia.net/img/cache/200-square/VqbcmM/2021/8/9/0756df71-e25a-43fd-a9ca-4a75f6f5ccf7.jpg" class="card-img-top" alt="...">
              <div class="card-body p-2">
                <p class="fs-nama-produk">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <p class="fs-harga-produk">Rp 15.000</p>
                <p class="fs-nama-toko mb-1"><i class="fa-solid fa-shop"></i> berkah bismillah sdfdf sdfsdf dsf</p>
                <div class="d-flex flex-row "> <i class="fas fa-star text-warning me-1"></i><p class="fs-info mb-1">4.9 | 250 terjual</p> </div>
              </div>
            </div>
          </div>
          <div ng-click="detail()" class="col-lg-2">
            <div class="card my-1 pointer">
              <img src="https://images.tokopedia.net/img/cache/200-square/VqbcmM/2021/8/9/0756df71-e25a-43fd-a9ca-4a75f6f5ccf7.jpg" class="card-img-top" alt="...">
              <div class="card-body p-2">
                <p class="fs-nama-produk">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <p class="fs-harga-produk">Rp 15.000</p>
                <p class="fs-nama-toko mb-1"><i class="fa-solid fa-shop"></i> berkah bismillah sdfdf sdfsdf dsf</p>
                <div class="d-flex flex-row "> <i class="fas fa-star text-warning me-1"></i><p class="fs-info mb-1">4.9 | 250 terjual</p> </div>
              </div>
            </div>
          </div>
          <div ng-click="detail()" class="col-lg-2">
            <div class="card my-1 pointer" >
              <img src="https://images.tokopedia.net/img/cache/200-square/VqbcmM/2021/8/9/0756df71-e25a-43fd-a9ca-4a75f6f5ccf7.jpg" class="card-img-top" alt="...">
              <div class="card-body p-2">
                <p class="fs-nama-produk">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <p class="fs-harga-produk">Rp 15.000</p>
                <p class="fs-nama-toko mb-1"><i class="fa-solid fa-shop"></i> berkah bismillah sdfdf sdfsdf dsf</p>
                <div class="d-flex flex-row "> <i class="fas fa-star text-warning me-1"></i><p class="fs-info mb-1">4.9 | 250 terjual</p> </div>
              </div>
            </div>
          </div>
          <div ng-click="detail()" class="col-lg-2">
            <div class="card my-1 pointer">
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
        <div class="d-flex justify-content-center">
          <a href="{{ url('produk') }}">
            <button class="btn btn-outline-primary m-3">Muat lebih banyak</button>
          </a>
        </div>
        {{-- Buat Toko Baru --}}
        <div class="row justify-content-between m-4">
          <div class="col-lg-6 my-auto">
            <div>
              <p class="fs-4 fw-bold text-warning">Punya Toko Online?</p>
              <p>Mudah, nyaman dan bebas Biaya Layanan Transaksi. GRATIS!</p>
              <button ng-click="register_toko()" class="btn btn-primary me-3">Buat Toko GRATIS</button>
              <button ng-click="masuk_toko()" class="btn btn-outline-primary">Masuk Toko</button>
            </div>
          </div>
          <div class="col-lg-4">
              <img class="img-fluid" src="{{ url('/') }}/images/toko-baru.jpg">
          </div>
        </div>
        <h3 class="mt-5 mb-3 mx-3 text-bold">Tentang Kami</h3>
        <div class="row">
          <div class="col-lg-23 col-md-12 col-sm-12">
            <p>bla bla bla bla</p>
          </div>
        </div>
    </div>
@endsection 

@section('ctrl')
    <script>
    app.controller("myCtrl", function($scope,$http) {
        $scope.detail = function(){
          window.location.href = "{{ url('detail') }}";
        }
        $scope.register_toko = function(){
          window.location.href = "{{ url('register-toko') }}";
        }
        $scope.masuk_toko = function(){
          window.location.href = "{{ url('masuk-toko') }}";
        }
    });
    </script>
@endsection