

@extends('website.layout')
@section('css')
<style>
    /* Hide the increment and decrement arrows */
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    input[type="number"] {
      -moz-appearance: textfield; /* Firefox */
    }
  </style>
@endsection

@section('content')
    <div class="container mt-3">        
        <div class="row">
          <div class="col-lg-4">
              <img src="{{$produk->merchant_produk_gambar[0]->src}}" class="d-block w-100" alt="Product Image 1">
          </div>
          <div class="col-lg-8">
              <p class="fs-5 fw-bold">{{$produk->nama_produk}}</p>
              <div class="d-flex flex-row "> <i class="fas fa-star text-warning me-1"></i><p class="fs-info mb-1">{{$produk->rating}} | {{$produk->terjual}} terjual</p> </div>
              <p class="fs-nama-toko my-2"><i class="fa-solid fa-shop text-primary"></i> {{$produk->merchant->nama_toko}}</p>
              <p class="fs-3 fw-bold text-primary my-3"> Rp {{ number_format($produk->harga_jual,2,',','.') }} </p>
              <div class="d-flex flex-row ">
                <p class="me-3 my-1">kuantitas</p>
                <div class="input-group mb-3 input-group-sm" style="width:120px">
                  <button ng-click="kurang()" class="btn btn-outline-secondary" type="button" id="button-addon1">-</button>
                  <input type="number" min="1" ng-model="qty" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                  <button ng-click="tambah()" class="btn btn-outline-secondary" type="button" id="button-addon2">+</button>
                </div>
              </div>
              <div>
                <button ng-click="tambah_keranjang_belanja()" class="btn btn-outline-primary mx-1">
                  <i class="fa-solid fa-cart-shopping text-primary"></i>
                  Masukan Keranjang
                </button>
                {{-- <button class="btn btn-primary mx-1">Beli Sekarang</button> --}}
              </div>
          </div>
        </div>
        <hr/>
        <h4 class="mt-5 text-bold">Deskripsi Produk</h4>
        <div class="row">
          <div class="col-lg-12">
            <p> {!! $produk->keterangan !!}</p>
          </div>
        </div>
        <h4 class="mt-5 mb-3 text-bold">Review</h4>
        @foreach($produk->order as $key => $review)
        <div class="row mb-3">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-body p-2">
                <div class="d-flex flex-row ">
                 <p class="mb-2">{{ $review->member->nama }}</p>
                  @if($review->rating >=1)<i class="fas fa-star text-warning ms-2 me-1"></i>@endif
                  @if($review->rating >=2)<i class="fas fa-star text-warning me-1"></i>@endif
                  @if($review->rating >=3)<i class="fas fa-star text-warning me-1"></i>@endif
                  @if($review->rating >=4)<i class="fas fa-star text-warning me-1"></i>@endif
                  @if($review->rating >=5)<i class="fas fa-star text-warning me-1"></i>@endif
                </div>
                <p class="mb-1" style="font-size:13px">{{ $review->review }}</p>
              </div>
            </div>
          </div>
        </div>
        @endforeach
    </div>
@endsection 

@section('ctrl')
    <script>
    app.controller("myCtrl", function($scope,$http) {
        $scope.qty = 1;
        $scope.tambah = function(){
          $scope.qty = $scope.qty + 1;
        }
        $scope.kurang = function(){
          if($scope.qty>=2){
            $scope.qty = $scope.qty - 1;
          }
        }
        $scope.tambah_keranjang_belanja = function(){
            $.ajax({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
              url : "{{ url('tambah_keranjang_belanja') }}",
              type: "POST",
              data:{
                'uuid':"{{$produk->uuid}}",
                'qty':$scope.qty
              },
              dataType: "JSON",
              success: function(data)
              {
                  if(data.status){
                      Swal.fire({icon: 'success',title: 'Berhasil tambah keranjang belanja',}).then(function(){
                        window.location.href = "{{ url('keranjang-belanja') }}";
                      })
                  }else{
                      Swal.fire({icon: 'error',title: 'Oops...',text: data.message,})
                  }
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  Swal.fire({icon: 'error',title: 'Oops...',text: 'Something went wrong! please contact IT system',})
              },
              beforeSend: function(){
                  Swal.fire({title: 'Loading..',onOpen: () => {Swal.showLoading()}})
              }
            });
        }
    });
    </script>
@endsection