

@extends('website.layout')
@section('css')
@endsection

@section('content')
    <div class="container">     
        <h5 class="card-title fw-bold mt-3"> <i class="fa-solid fa-user text-primary mx-2"></i> Member</h5>
        <div class="row ">
          <div class="col-lg-12">
            <nav class="mt-3">
              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-profil-tab" data-bs-toggle="tab" data-bs-target="#nav-profil" type="button" role="tab" aria-controls="nav-profil" aria-selected="true"><i class="fa-solid fa-user"></i> Profil</button>
                <button class="nav-link" id="nav-invoice-tab" data-bs-toggle="tab" data-bs-target="#nav-invoice" type="button" role="tab" aria-controls="nav-invoice" aria-selected="false"><i class="fa-solid fa-money-bill-wave"></i> Belum Di Bayar <span class="badge text-bg-danger">1</span></button>
                <button class="nav-link" id="nav-dikemas-tab" data-bs-toggle="tab" data-bs-target="#nav-dikemas" type="button" role="tab" aria-controls="nav-dikemas" aria-selected="false"><i class="fa-solid fa-box"></i> Di Kemas <span class="badge text-bg-danger">1</span></button>
                <button class="nav-link" id="nav-dikirim-tab" data-bs-toggle="tab" data-bs-target="#nav-dikirim" type="button" role="tab" aria-controls="nav-dikirim" aria-selected="false"><i class="fa-solid fa-truck"></i> Di Kirim <span class="badge text-bg-danger">1</span></button>
                <button class="nav-link" id="nav-diterima-tab" data-bs-toggle="tab" data-bs-target="#nav-diterima" type="button" role="tab" aria-controls="nav-diterima" aria-selected="false"><i class="fa-solid fa-hand-holding-heart"></i> Di Terima</button>
              </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active  p-3" id="nav-profil" role="tabpanel" aria-labelledby="nav-profil-tab" tabindex="0">
                <div class="row">
                  <div class="col-lg-6">
                    <h4>Informasi Personal</h4>
                    <div class="mb-2 row">
                        <label for="inputPassword" class="col-sm-3 col-form-label">nama</label>
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
                    <button class="btn btn-outline-primary me-3">save</button>
                    <button class="btn btn-outline-primary">ubah password</button>
                    <hr/>
                  </div>
                  <div class="col-lg-6">
                    <h4>Alamat <button class="btn btn-outline-primary btn-sm ms-2" data-bs-toggle="modal" data-bs-target="#tambah-alamat">Tambah</button></h4>
                    <div class="card shadow">
                      <div class="card-body">
                          <p class="mb-1" style="font-size:13px">Jl. Imam Bonjol No.207, Pendrikan Kidul, Kec. Semarang Tengah, Kota Semarang, Jawa Tengah 50131</p>
                          <p style="font-size:13px">no hp. 08592374927</p>
                          <button class="btn btn-outline-success btn-sm me-3">edit</button>
                          <button class="btn btn-outline-danger btn-sm">Hapus</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="nav-invoice" role="tabpanel" aria-labelledby="nav-invoice-tab" tabindex="0">
                <table style="font-size:13px" class="table table-bordered mt-4">
                  <thead>
                    <tr>
                      <th style="width:150px;">#</th>
                      <th style="width:50%;text-align:center">Invoice</th>
                      <th style="width:15%;text-align:center">Total Bayar</th>
                      <th style="width:15%;text-align:center">Status</th>
                      <th style="width:5%;text-align:center">aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="align-middle"><p class="pointer text-primary">INV-1237673</p></td>
                      <td class="tg-0lax">
                        <ul class="mb-1">
                          <li>Coffee</li>
                          <li>Tea</li>
                          <li>Milk</li>
                        </ul>
                        <div class="mb-1 row">
                            <label for="inputPassword" class="col-sm-4 col-form-label">Kirim Bukti Transfer</label>
                            <div class="col-sm-6">
                                <input class="form-control form-control-sm" id="formFileSm" type="file">
                            </div>
                            <div class="col-sm-2">
                                <button class="btn btn-primary btn-sm">kirim</button>
                            </div>
                        </div>
                      </td>
                      <td class="align-middle text-center">Rp 15.000</td>
                      <td class="align-middle text-center"><a class="text-danger pointer"><span style="font-size:12px" class="badge text-bg-secondary">Belum Di Bayar</span></a></td>
                      <td class="align-middle text-center"><a class="text-danger pointer">Batal</a></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="tab-pane fade" id="nav-dikemas" role="tabpanel" aria-labelledby="nav-dikemas-tab" tabindex="0">
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
                        <button class="btn btn-success btn-sm">Barang Sudah Di Terima</button>
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