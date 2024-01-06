

@extends('website.layout')
@section('css')
@endsection

@section('content')
    <div class="container">     
        <h5 class="card-title fw-bold mt-3 mb-3"> <i class="fa-solid fa-shop text-primary"></i> Toko</h5>
        <div class="row">
          <div class="col-md-4">
            <div class="shadow card p-3 d-flex flex-row text-danger">
                <i class="fa-solid fa-bell fs-1"></i>
                <div class="ms-4">
                  <p class="mb-1" style="font-size:14px;">Order Baru</p>
                  <p class="mb-1 fw-bold">Rp 30.000</p>
                </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="shadow card p-3 d-flex flex-row text-primary">
                <i class="fa-solid fa-hourglass-start fs-1"></i>
                <div class="ms-4">
                  <p class="mb-1" style="font-size:14px;">Menunggu Pembayaran</p>
                  <p class="mb-1 fw-bold">Rp 50.000</p>
                </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="shadow card p-3 d-flex flex-row text-success">
                <i class="fa-solid fa-money-bill-wave fs-1"></i>
                <div class="ms-4">
                  <p class="mb-1" style="font-size:14px;">Sudah Di Bayar</p>
                  <p class="mb-1 fw-bold">Rp 70.000</p>
                </div>
            </div>
          </div>
        </div>
        <div class="row ">
          <div class="col-lg-12">
            <nav class="mt-3">
              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-profil-tab" data-bs-toggle="tab" data-bs-target="#nav-profil" type="button" role="tab" aria-controls="nav-profil" aria-selected="true"><i class="fa-solid fa-shop text-primary"></i> Toko</button>
                <button class="nav-link" id="nav-invoice-tab" data-bs-toggle="tab" data-bs-target="#nav-baru" type="button" role="tab" aria-controls="nav-baru" aria-selected="false"><i class="fa-solid fa-bell"></i> Order Baru <span class="badge text-bg-danger">1</span></button>
                <button class="nav-link" id="nav-dikirim-tab" data-bs-toggle="tab" data-bs-target="#nav-dikirim" type="button" role="tab" aria-controls="nav-dikirim" aria-selected="false"><i class="fa-solid fa-truck"></i> Di Kirim <span class="badge text-bg-danger">1</span></button>
                <button class="nav-link" id="nav-diterima-tab" data-bs-toggle="tab" data-bs-target="#nav-diterima" type="button" role="tab" aria-controls="nav-diterima" aria-selected="false"><i class="fa-solid fa-hand-holding-heart"></i>Sudah Di Terima</button>
              </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active  p-3" id="nav-profil" role="tabpanel" aria-labelledby="nav-profil-tab" tabindex="0">
                <div class="row">
                  <div class="col-lg-6">
                    <h4>Informasi Toko</h4>
                    <div class="mb-2 row">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Nama Toko</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputPassword">
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <label for="inputPassword" class="col-sm-3 col-form-label">email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control form-control-sm" id="inputPassword">
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <label for="inputPassword" class="col-sm-3 col-form-label">no hp</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="inputPassword">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                    </div>
                    <button class="btn btn-outline-primary me-3">save</button>
                    <button class="btn btn-outline-primary">ubah password</button>
                    <hr/>
                  </div>
                  <div class="col-lg-6">
                    <h4>Produk <button class="btn btn-outline-primary btn-sm ms-2">Tambah Produk</button></h4>
                    <div class="row">
                      <div ng-click="detail()" class="col-lg-4">
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
                      <div ng-click="detail()" class="col-lg-4">
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
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="nav-baru" role="tabpanel" aria-labelledby="nav-baru-tab" tabindex="0">
                <table style="font-size:13px" class="table table-bordered mt-4">
                  <thead>
                    <tr>
                      <th style="width:30px;">#</th>
                      <th style="width:50%;text-align:center">produk</th>
                      <th style="width:15%;text-align:center">harga satuan</th>
                      <th style="width:10%;text-align:center">kuantitas</th>
                      <th style="width:15%;text-align:center">total harga</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="align-middle">ORD-786235</td>
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
                        <button class="btn btn-success btn-sm">Kirim Barang</button>
                      </td>
                      <td class="align-middle text-center">Rp 15.000</td>
                      <td class="align-middle text-center"> 2</td>
                      <td class="align-middle text-center">Rp 15.000</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="tab-pane fade" id="nav-dikirim" role="tabpanel" aria-labelledby="nav-dikirim-tab" tabindex="0">
                <table style="font-size:13px" class="table table-bordered mt-4">
                  <thead>
                    <tr>
                      <th style="width:30px;">#</th>
                      <th style="width:50%;text-align:center">produk</th>
                      <th style="width:15%;text-align:center">harga satuan</th>
                      <th style="width:10%;text-align:center">kuantitas</th>
                      <th style="width:15%;text-align:center">total harga</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="align-middle">ORD-786235</td>
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
                      <td class="align-middle text-center"> 2</td>
                      <td class="align-middle text-center">Rp 15.000</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="tab-pane fade" id="nav-diterima" role="tabpanel" aria-labelledby="nav-diterima-tab" tabindex="0">
                <table style="font-size:13px" class="table table-bordered mt-4">
                  <thead>
                    <tr>
                      <th style="width:30px;">#</th>
                      <th style="width:50%;text-align:center">produk</th>
                      <th style="width:15%;text-align:center">harga satuan</th>
                      <th style="width:10%;text-align:center">kuantitas</th>
                      <th style="width:15%;text-align:center">total harga</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="align-middle">ORD-786235</td>
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
                        <div class="card">
                          <div class="card-body p-2">
                            
                            <div class="d-flex flex-row ">
                             <p class="fw-bold mb-2">Review</p>
                              <i class="fas fa-star text-warning ms-2 me-1"></i> 
                              <i class="fas fa-star text-warning me-1"></i>
                              <i class="fas fa-star text-warning me-1"></i>
                              <i class="fas fa-star text-warning me-1"></i>
                              <i class="fas fa-star text-warning me-1"></i>
                            </div>
                            <p class="mb-1" style="font-size:13px">terima kasih barang di terima dengan baik</p>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-center">Rp 15.000</td>
                      <td class="align-middle text-center"> 2</td>
                      <td class="align-middle text-center">Rp 15.000</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
    </div>
    
    <!-- Modal Login -->
    <div class="modal fade" id="tambah-alamat" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
        <form id="forminput">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Alamat</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-3 col-form-label">Alamat</label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
            </div>
            <div class="mb-2 row">
                <label for="inputPassword" class="col-sm-3 col-form-label">no hp</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="inputPassword">
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <a href="{{ url('member') }}">
              <button type="button" class="btn btn-primary">Simpan</button>
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