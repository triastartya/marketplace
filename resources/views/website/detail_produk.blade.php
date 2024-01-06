

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
              <img src="https://via.placeholder.com/800x400" class="d-block w-100" alt="Product Image 1">
          </div>
          <div class="col-lg-8">
              <p class="fs-5 fw-bold">Laptop Murah Hp 15 Intel Celeron N4120 8GB SSD 256GB Backlight FingerPrint Window 11 Original</p>
              <div class="d-flex flex-row "> <i class="fas fa-star text-warning me-1"></i><p class="fs-info mb-1">4.9 | 250 terjual</p> </div>
              <p class="fs-nama-toko my-2"><i class="fa-solid fa-shop text-primary"></i> berkah bismillah sdfdf sdfsdf dsf</p>
              <p class="fs-3 fw-bold text-primary my-3"> Rp 15.000 </p>
              <div class="d-flex flex-row ">
                <p class="me-3 my-1">kuantitas</p>
                <div class="input-group mb-3 input-group-sm" style="width:120px">
                  <button class="btn btn-outline-secondary" type="button" id="button-addon1">-</button>
                  <input type="number" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                  <button class="btn btn-outline-secondary" type="button" id="button-addon2">+</button>
                </div>
              </div>
              <div>
              <a href="{{ url('keranjang-belanja') }}">
                <button class="btn btn-outline-primary mx-1">
                  <i class="fa-solid fa-cart-shopping text-primary"></i>
                  Masukan Keranjang
                </button>
              </a>
                {{-- <button class="btn btn-primary mx-1">Beli Sekarang</button> --}}
              </div>
          </div>
        </div>
        <hr/>
        <h4 class="mt-5 text-bold">Deskripsi Produk</h4>
        <div class="row">
          <div class="col-lg-12">
            <p> bla bla bla ....</p>
          </div>
        </div>
        <h4 class="mt-5 mb-3 text-bold">Review</h4>
        <div class="row mb-3">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-body p-2">
                <div class="d-flex flex-row ">
                 <p class="mb-2">Handoko</p>
                  <i class="fas fa-star text-warning ms-2 me-1"></i> 
                  <i class="fas fa-star text-warning me-1"></i>
                  <i class="fas fa-star text-warning me-1"></i>
                  <i class="fas fa-star text-warning me-1"></i>
                  <i class="fas fa-star text-warning me-1"></i>
                </div>
                <p class="mb-1" style="font-size:13px">terima kasih barang di terima dengan baik</p>
              </div>
            </div>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-body p-2">        
                <div class="d-flex flex-row ">
                 <p class="mb-2">Mulyadi</p>
                  <i class="fas fa-star text-warning ms-2 me-1"></i> 
                  <i class="fas fa-star text-warning me-1"></i>
                  <i class="fas fa-star text-warning me-1"></i>
                </div>
                <p class="mb-1" style="font-size:13px">terima kasih barang di terima dengan baik</p>
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