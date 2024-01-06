

@extends('website.layout')
@section('css')
@endsection

@section('content')
    <div class="container">     
        <h5 class="card-title fw-bold mt-5"> <i class="fa-solid fa-cart-shopping text-primary mx-2"></i> Keranjang Belanja</h5>
        <div class="row ">
          <div class="col-lg-12">
            <table style="font-size:13px" class="table table-bordered mt-4">
              <thead>
                <tr>
                  <th style="width:30px;">#</th>
                  <th style="width:50%;text-align:center">produk</th>
                  <th style="width:15%;text-align:center">harga satuan</th>
                  <th style="width:10%;text-align:center">kuantitas</th>
                  <th style="width:15%;text-align:center">total harga</th>
                  <th style="width:5%;text-align:center">aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="align-middle"><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"></td>
                  <td class="tg-0lax">
                    <div class="d-flex flex-row pointer">
                      <div>
                        <img style="height:60px" src="https://via.placeholder.com/800x400" alt="Product Image 1">
                      </div>
                      <div>
                        <p class="ms-2 mb-1">Laptop Murah Hp 15 Intel Celeron N4120 8GB SSD 256GB Backlight FingerPrint Window 11 Original</p>
                        <p class="ms-2 fs-nama-toko"><i class="fa-solid fa-shop text-primary"></i> berkah bismillah sdfdf sdfsdf dsf</p>
                      </div>
                    </div>
                  </td>
                  <td class="align-middle text-center">Rp 15.000</td>
                  <td class="align-middle">
                    <div class="input-group mb-3 input-group-sm" style="width:120px">
                      <button class="btn btn-outline-secondary" type="button" id="button-addon1">-</button>
                      <input value="1" type="number" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                      <button class="btn btn-outline-secondary" type="button" id="button-addon2">+</button>
                    </div>
                  </td>
                  <td class="align-middle text-center">Rp 15.000</td>
                  <td class="align-middle text-center"><a class="text-danger pointer">Hapus</a></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
    </div>
    <div class="shadow-lg p-3 px-4 mb-2 sticky-bottom" style="background-color: #e3e8fa">
      <div class="d-flex flex-row-reverse">
        <button class="btn btn-primary mx-2 " data-bs-toggle="modal" data-bs-target="#bayar">Checkout</button>
        <p class="mx-2 my-auto fw-bold fs-4">Rp 15.000</p>
        <p class="mx-2 my-auto text-primary">Total(1 produk)</p>
      </div>
    </div>
    
    <!-- Modal Login -->
    <div class="modal fade" id="bayar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
        <form id="forminput">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Bayar</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>#INV-73528</p>
            <h3 class="fw-bold m-3">Rp 15.000</h3>
            <div class="shadow card p-2">
              <div class="row">
                <div class="col-lg-4"><p>Atas Nama </p></div><div class="col-lg-7"><p class="fw-bold">Badu Raharjo</p></div>
                <div class="col-lg-4"><p>Rekeing </p></div><div class="col-lg-7"><p>Mandiri</p></div>
                <div class="col-lg-4"><p>Nomor Rekening </p></div><div class="col-lg-7"><p>987638563</p></div>
              </div>
            </div>
            <p class="mt-3">Silahkan Transfer ke rekening di atas dan upload bukti transfer</p>
          </div>
          <div class="modal-footer">
            <a href="{{ url('member') }}">
              <button type="button" class="btn btn-primary">Buat Invoice</button>
            </a>
          </div>
        </form>
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