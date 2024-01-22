

@extends('website.layout')
@section('css')
@endsection

@section('content')
    <div class="container">                  
        <div class="d-flex justify-content-between mt-4 mb-2">
          <h5 class="card-title fw-bold "> 
            <i class="fa-solid fa-shop text-primary mx-2"></i> Toko
          </h5>
          <a href="{{ url('logout_merchant')}}">
            <button class="btn btn-outline-danger btn-sm mx-1">Logout</button>
          </a>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="shadow card p-3 d-flex flex-row text-danger">
                <i class="fa-solid fa-bell fs-1"></i>
                <div class="ms-4">
                  <p class="mb-1" style="font-size:14px;">Order Baru</p>
                  <p class="mb-1 fw-bold">Rp <% sum_baru | currency:"" %></p>
                </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="shadow card p-3 d-flex flex-row text-primary">
                <i class="fa-solid fa-hourglass-start fs-1"></i>
                <div class="ms-4">
                  <p class="mb-1" style="font-size:14px;">Menunggu Pencairan</p>
                  <p class="mb-1 fw-bold">Rp <% sum_menunggu | currency:"" %></p>
                </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="shadow card p-3 d-flex flex-row text-success">
                <i class="fa-solid fa-money-bill-wave fs-1"></i>
                <div class="ms-4">
                  <p class="mb-1" style="font-size:14px;">Sudah Di cairkan</p>
                  <p class="mb-1 fw-bold">Rp <% sum_cair | currency:"" %></p>
                </div>
            </div>
          </div>
        </div>
        <div class="row ">
          <div class="col-lg-12">
            <nav class="mt-3">
              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-profil-tab" data-bs-toggle="tab" data-bs-target="#nav-profil" type="button" role="tab" aria-controls="nav-profil" aria-selected="true"><i class="fa-solid fa-shop text-primary"></i> Toko</button>
                <button class="nav-link" id="nav-invoice-tab" data-bs-toggle="tab" data-bs-target="#nav-baru" type="button" role="tab" aria-controls="nav-baru" aria-selected="false"><i class="fa-solid fa-bell"></i> Order Baru <span class="badge text-bg-danger" ng-if="order_baru.length!=0"><% order_baru.length %></span></button>
                <button class="nav-link" id="nav-dikirim-tab" data-bs-toggle="tab" data-bs-target="#nav-dikirim" type="button" role="tab" aria-controls="nav-dikirim" aria-selected="false"><i class="fa-solid fa-truck"></i> Di Kirim <span class="badge text-bg-danger" ng-if="order_dikirim.length !=0"><% order_dikirim.length %></span></button>
                <button class="nav-link" id="nav-diterima-tab" data-bs-toggle="tab" data-bs-target="#nav-diterima" type="button" role="tab" aria-controls="nav-diterima" aria-selected="false"><i class="fa-solid fa-hand-holding-heart"></i> Sudah Di Terima <span class="badge text-bg-danger" ng-if="order_diterima.length !=0"><% order_diterima.length %></button>
                <button class="nav-link" id="nav-dicairkan-tab" data-bs-toggle="tab" data-bs-target="#nav-dicairkan" type="button" role="tab" aria-controls="nav-dicairkan" aria-selected="false"><i class="fa-solid fa-money-bill"></i> Sudah Di Cairkan <span class="badge text-bg-danger" ng-if="order_dicairkan.length !=0"><% order_dicairkan.length %></button>
              </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active  p-3" id="nav-profil" role="tabpanel" aria-labelledby="nav-profil-tab" tabindex="0">
                <div class="row">
                  <div class="col-lg-6">
                    <h4>Informasi Toko</h4>
                    <div class="mb-2 row">
                        <label for="nama_toko" class="col-sm-3 col-form-label">Nama Toko</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nama_toko" name="nama_toko" value="{{ $merchant->nama_toko }}">
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <label for="email" class="col-sm-3 col-form-label">email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control form-control-sm" id="email" name="email" value="{{ $merchant->email }}">
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <label for="no_hp" class="col-sm-3 col-form-label">no hp</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="no_hp" name="no_hp" value="{{ $merchant->no_hp }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="alamat" name="alamat" rows="3">{{ $merchant->alamat }}</textarea>
                        </div>
                    </div>
                    <button class="btn btn-outline-primary me-3">save</button>
                    <button class="btn btn-outline-primary">ubah password</button>
                    <hr/>
                  </div>
                  <div class="col-lg-6">
                    <h4>Produk <button ng-click="tambah_produk()" class="btn btn-outline-primary btn-sm ms-2">Tambah Produk</button></h4>
                    <div class="row">
                      <div ng-repeat="x in produk" ng-click="detail()" class="col-lg-4">
                        <div class="card my-1 pointer" >
                          <img src="<% x.merchant_produk_gambar[0].src %>" class="card-img-top" alt="...">
                          <div class="card-body p-2">
                            <p class="fs-nama-produk"><% x.nama_produk %></p>
                            <p class="fs-harga-produk">Rp <% x.harga_jual | currency:"" %></p>
                            <div class="d-flex flex-row "> <i class="fas fa-star text-warning me-1"></i><p class="fs-info mb-1"><% x.rating %> | <% x.terjual %> terjual</p> </div>
                            <div>
                              <a href="{{ url('edit_produk') }}/<% x.uuid %>">
                                <button class="btn btn-primary btn-sm me-2">edit</button>
                              </a>
                              <button class="btn btn-danger btn-sm">hapus</button>
                            </div>
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
                    <tr ng-repeat="baru in order_baru">
                      <td class="align-middle"><% baru.no_order %></td>
                      <td class="tg-0lax">
                        <div class="d-flex flex-row pointer mb-3">
                          <div>
                            <img style="width:200px" src="<% baru.merchant_produk.merchant_produk_gambar[0].src %>" alt="Product Image 1">
                          </div>
                          <div>
                            <p class="ms-2 mb-1"><% baru.merchant_produk.nama_produk %></p>
                            <p class="ms-2 fs-nama-toko"><i class="fa-solid fa-user text-primary"></i> <% baru.member.nama %></p>
                          </div>
                        </div>
                        <button ng-click="kirim(baru)" class="btn btn-success btn-sm">Kirim Barang</button>
                        <button ng-click="alamat(baru)" class="btn btn-primary btn-sm">Lihat Alamat</button>
                      </td>
                      <td class="align-middle text-center">Rp <% baru.harga | currency:"" %></td>
                      <td class="align-middle text-center"> <% baru.qty | currency:"" %></td>
                      <td class="align-middle text-center">Rp <% baru.total_harga | currency:""%></td>
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
                     <tr ng-repeat = "dikirim in order_dikirim">
                      <td class="align-middle"><% dikirim.no_order %></td>
                      <td class="tg-0lax">
                        <div class="d-flex flex-row pointer mb-3">
                          <div>
                            <img style="height:60px" src="<% dikirim.merchant_produk.merchant_produk_gambar[0].src %>" alt="Product Image 1">
                          </div>
                          <div>
                            <p class="ms-2 mb-1"><% dikirim.merchant_produk.nama_produk %></p>
                            <p class="ms-2 fs-nama-toko"><i class="fa-solid fa-shop text-primary"></i> <% dikirim.merchant_produk.merchant.nama_toko %></p>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-center">Rp <% dikirim.harga | currency:"" %></td>
                      <td class="align-middle text-center"> <% dikirim.qty | currency:"" %></td>
                      <td class="align-middle text-center">Rp <% dikirim.total_harga | currency:""%></td>
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
                    <tr ng-repeat="diterima in order_diterima">
                      <td class="align-middle"><% diterima.no_order %></td>
                      <td class="tg-0lax">
                        <div class="d-flex flex-row pointer mb-3">
                          <div>
                            <img style="height:60px" src="<% diterima.merchant_produk.merchant_produk_gambar[0].src %>" alt="Product Image 1">
                          </div>
                          <div>
                            <p class="ms-2 mb-1"><% diterima.merchant_produk.nama_produk %></p>
                            <p class="ms-2 fs-nama-toko"><i class="fa-solid fa-user text-primary"></i> <% diterima.member.nama %></p>
                          </div>
                        </div>
                        <div class="card">
                          <div class="card-body p-2">
                            <div class="d-flex flex-row ">
                             <p class="fw-bold mb-2">Review</p>
                              <i ng-if="diterima.rating>=1" class="fas fa-star text-warning ms-2 me-1"></i> 
                              <i ng-if="diterima.rating>=2" class="fas fa-star text-warning me-1"></i>
                              <i ng-if="diterima.rating>=3" class="fas fa-star text-warning me-1"></i>
                              <i ng-if="diterima.rating>=4" class="fas fa-star text-warning me-1"></i>
                              <i ng-if="diterima.rating>=5" class="fas fa-star text-warning me-1"></i>
                            </div>
                            <p class="mb-1" style="font-size:13px"><% diterima.review %></p>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-center">Rp <% diterima.harga | currency:"" %></td>
                      <td class="align-middle text-center"> <% diterima.qty | currency:"" %></td>
                      <td class="align-middle text-center">Rp <% diterima.total_harga | currency:""%></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="tab-pane fade" id="nav-dicairkan" role="tabpanel" aria-labelledby="nav-dicairkan-tab" tabindex="0">
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
                    <tr ng-repeat="dicairkan in order_dicairkan">
                      <td class="align-middle"><% dicairkan.no_order %></td>
                      <td class="tg-0lax">
                        <div class="d-flex flex-row pointer mb-3">
                          <div>
                            <img style="height:60px" src="<% dicairkan.merchant_produk.merchant_produk_gambar[0].src %>" alt="Product Image 1">
                          </div>
                          <div>
                            <p class="ms-2 mb-1"><% dicairkan.merchant_produk.nama_produk %></p>
                            <p class="ms-2 fs-nama-toko"><i class="fa-solid fa-user text-primary"></i> <% dicairkan.member.nama %></p>
                          </div>
                        </div>
                        <div class="card mb-2">
                          <div class="card-body p-2">
                            <div class="d-flex flex-row ">
                             <p class="fw-bold mb-2">Review</p>
                              <i ng-if="dicairkan.rating>=1" class="fas fa-star text-warning ms-2 me-1"></i> 
                              <i ng-if="dicairkan.rating>=2" class="fas fa-star text-warning me-1"></i>
                              <i ng-if="dicairkan.rating>=3" class="fas fa-star text-warning me-1"></i>
                              <i ng-if="dicairkan.rating>=4" class="fas fa-star text-warning me-1"></i>
                              <i ng-if="dicairkan.rating>=5" class="fas fa-star text-warning me-1"></i>
                            </div>
                            <p class="mb-1" style="font-size:13px"><% dicairkan.review %></p>
                          </div>
                        </div>
                        <button ng-click="cari(dicairkan)" class="btn btn-success btn-sm">Lihat Bukti Transfer</button>
                      </td>
                      <td class="align-middle text-center">Rp <% dicairkan.harga | currency:"" %></td>
                      <td class="align-middle text-center"> <% dicairkan.qty | currency:"" %></td>
                      <td class="align-middle text-center">Rp <% dicairkan.total_harga | currency:""%></td>
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
    
    <div class="modal fade" id="model_lihat" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Bukti Transfer</h4>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img style="height:600px" src="<% selected.cair %>" alt="Product Image 1">
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection 

@section('ctrl')
<script>
app.controller("myCtrl", function($scope,$http) {
    
    $scope.load_produk = function(){
      $scope.produk = []
      $http.get("{{ url('produk_toko') }}").then(function(res){
          $scope.produk = res.data.data;
      });
    }
    $scope.load_produk();
    
    $scope.load_order = function(){
      $scope.order_baru = [];
      $scope.order_dikirim = [];
      $scope.order_diterima = [];
      $scope.order_dicairkan = [];
      $scope.sum_baru = 0;
      $scope.sum_menunggu = 0;
      $scope.sum_cair = 0;
      $http.get("{{ url('order_produk_toko') }}").then(function(res){
          $scope.order_baru = res.data.data.filter(function(e){
            return e.status == 3;
          });
          $scope.order_dikirim = res.data.data.filter(function(e){
            return e.status == 4;
          });
          $scope.order_diterima = res.data.data.filter(function(e){
            return e.status == 5;
          });
          $scope.order_dicairkan = res.data.data.filter(function(e){
            return e.status == 6;
          });
          
          $scope.sum_baru = res.data.data.filter(function(e){
            return e.status == 3 || e.status == 4;
          }).sum('total_harga');
          
          $scope.sum_menunggu = $scope.order_diterima.sum('total_harga');
          $scope.sum_cair = $scope.order_dicairkan.sum('total_harga');
      });
    }
    $scope.load_order();
    
    $scope.tambah_produk = function(){
      window.location.href = "{{ url('tambah_produk') }}";
    }
    
    $scope.kirim = function(data){
      Swal.fire({
          title: 'Apa Kamu Sudah Mengirim Pesanan Ini ?',
          text: "",
          icon: 'info',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, kirim it!'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({title: 'Loading..',onOpen: () => {Swal.showLoading()}})
          $http.post("{{ url('di_kirim') }}",{
            id: data.tr_order_detail_id
          }).then(function(res){
            if(res.data.status){
              Swal.fire({icon: 'success',title: 'Data Berhasil Ubah Status Ke di kirim',text: '',}).then(function(){
                $scope.load_order();
                Swal.close();
              })
            }else{
              Swal.fire({icon: 'error',title: 'Oops...',text: res.data.message,})
            }
          });
        }
      })
    }
    
    $scope.cari = function(data){ 
      $('#model_lihat').modal('show'); 
      $scope.selected = data;
      $scope.$apply();
    }
});
</script>
@endsection