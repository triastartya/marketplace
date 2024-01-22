@extends('website.layout')
@section('css')
@endsection

@section('content')
    <div class="container mt-4">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-indicators">
          @foreach($banners as $key => $banner)
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{$key}}" 
            @if($loop->first)
            class="active" 
            @endif
            aria-current="true" aria-label="Slide {{$key+1}}"></button>
          @endforeach  
          </div>
          <div class="carousel-inner">
            @foreach($banners as $key => $banner)
            <div class="carousel-item  @if($loop->first) active @endif" data-bs-interval="2000">
              <img src="{{$banner->src}}" class="d-block w-100 rounded-4" alt="...">
            </div>
            @endforeach
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
                    @foreach($kategoris as $key => $kategori)
                      <div class="p-2"><a href="javascript:void(0);">{{ $kategori->kategori }}</a></div>
                    @endforeach  
                  </div>
              </div>
          </div>
        </div>
        <h3 class="mt-4 mx-3 text-bold">Produk Populer</h3>
        <div class="row">
          @foreach($produks as $key => $produk)
            <div class="col-lg-2">
              <div ng-click="detail('{{$produk->uuid}}')" class="card my-1 pointer">
                <img src="{{$produk->merchant_produk_gambar[0]->src}}" class="card-img-top" alt="...">
                <div class="card-body p-2">
                  <p class="fs-nama-produk">{{$produk->nama_produk}}</p>
                  <p class="fs-harga-produk">Rp {{ number_format($produk->harga_jual,2,',','.') }}</p>
                  <p class="fs-nama-toko mb-1"><i class="fa-solid fa-shop"></i> {{$produk->merchant->nama_toko}}</p>
                  <div class="d-flex flex-row "> <i class="fas fa-star text-warning me-1"></i><p class="fs-info mb-1">{{$produk->rating}} | {{$produk->terjual}} terjual</p> </div>
                </div>
              </div>
            </div>  
          @endforeach
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
            {!!$page->tentang!!}
          </div>
        </div>
    </div>
@endsection 

@section('ctrl')
    <script>
    app.controller("myCtrl", function($scope,$http) {
        $scope.detail = function(uuid){
          window.location.href = "{{ url('detail') }}/"+uuid;
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