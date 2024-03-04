

@extends('website.layout')
@section('css')
@endsection

@section('content')
    <div class="container">        
        <div class="row">
          <div class="col-sm-12 col-md-12 col-lg-12">
              <div class="card m-2 mt-3">
                  <div class="d-flex flex-row m-2">
                  @foreach($kategoris as $key => $kategori)
                    <div class="p-2" id="find-table">
                      <input ng-click="kat()" value="{{ $kategori['kategori_id'] }}" name="kategori" class="form-check-input" @if($kategori['checked']) checked @endif type="checkbox" value="" id="makanan{{ $kategori['kategori_id'] }}">
                      <label class="form-check-label" for="makanan{{ $kategori['kategori_id'] }}">
                        {{ $kategori['kategori'] }}
                      </label>
                    </div>
                  @endforeach
                  </div>
              </div>
          </div>
        </div>
        <div class="row">
          @foreach($produks as $key => $produk)
            <div class="col-lg-2">
              <div ng-click="detail('{{$produk->uuid}}')" class="card my-1 pointer">
                <img src="{{$produk->merchant_produk_gambar[0]->src}}" class="card-img-top" alt="image" style="height: 6rem; width: 100%; object-fit: cover; object-position: center">
                <div class="card-body p-2">
                  <p class="fs-nama-produk">{{$produk->nama_produk}}</p>
                  <p class="fs-harga-produk">Rp {{ number_format($produk->harga_jual,2,',','.') }}</p>
                  <p class="fs-nama-toko mb-1"><i class="fa-solid fa-shop"></i> {{$produk->merchant->nama_toko}}</p>
                <div class="d-flex flex-row "> <i class="fas fa-star text-warning me-1"></i><p class="fs-info mb-1">{{$produk->rating}} | {{$produk->terjual}} terjual</p> </div>
                </div>
              </div>
            </div>  
          @endforeach
        </div>
    </div>
@endsection 

@section('ctrl')
    <script>
    app.controller("myCtrl", function($scope,$http) {
        $scope.kat = function(){
          let array = []; 
          $("input:checkbox[name=kategori]:checked").each(function() { 
              array.push($(this).val()); 
          });
          window.location.href = "{{ url('produk') }}?kat="+array.toString();
        }
    });
    </script>
@endsection