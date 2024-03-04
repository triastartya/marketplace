

@extends('website.layout')
@section('css')
@endsection

@section('content')
    <div class="container"> 
        <div class="d-flex justify-content-between mt-4 mb-2">
          <h5 class="card-title fw-bold"> 
            <i class="fa-solid fa-user text-primary mx-2"></i> Member
          </h5>
          <a href="{{ url('logout_member')}}">
            <button class="btn btn-outline-danger btn-sm mx-1">Logout</button>
          </a>
        </div>
        <div class="row ">
          <div class="col-lg-12">
            <nav class="mt-3">
              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-profil-tab" data-bs-toggle="tab" data-bs-target="#nav-profil" type="button" role="tab" aria-controls="nav-profil" aria-selected="true"><i class="fa-solid fa-user"></i> Profil</button>
                <button class="nav-link" id="nav-invoice-tab" data-bs-toggle="tab" data-bs-target="#nav-invoice" type="button" role="tab" aria-controls="nav-invoice" aria-selected="false"><i class="fa-solid fa-money-bill-wave"></i> Belum Di Bayar <span class="badge text-bg-danger" ng-if="jml_orders!=0"><% jml_orders %></span></button>
                <button class="nav-link" id="nav-dikemas-tab" data-bs-toggle="tab" data-bs-target="#nav-dikemas" type="button" role="tab" aria-controls="nav-dikemas" aria-selected="false"><i class="fa-solid fa-box"></i> Di Kemas <span class="badge text-bg-danger" ng-if="order_dikemas.length !=0"><% order_dikemas.length %></span></button>
                <button class="nav-link" id="nav-dikirim-tab" data-bs-toggle="tab" data-bs-target="#nav-dikirim" type="button" role="tab" aria-controls="nav-dikirim" aria-selected="false"><i class="fa-solid fa-truck"></i> Di Kirim <span class="badge text-bg-danger" ng-if="order_dikirim.length !=0"><% order_dikirim.length %></span></button>
                <button class="nav-link" id="nav-diterima-tab" data-bs-toggle="tab" data-bs-target="#nav-diterima" type="button" role="tab" aria-controls="nav-diterima" aria-selected="false"><i class="fa-solid fa-hand-holding-heart"></i> Di Terima <span class="badge text-bg-danger" ng-if="order_diterima.length !=0"><% order_diterima.length %></button>
              </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active  p-3" id="nav-profil" role="tabpanel" aria-labelledby="nav-profil-tab" tabindex="0">
                <div class="row">
                  <div class="col-lg-6">
                  <form id="form_edit_profil">
                    <h4>Informasi Personal</h4>
                    <div class="mb-2 row">
                        <label for="nama" class="col-sm-3 col-form-label">nama</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{$member->nama}}" id="nama" name="nama">
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <label for="email" class="col-sm-3 col-form-label">email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control form-control-sm" value="{{$member->email}}" id="email" name="email">
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <label for="no_hp" class="col-sm-3 col-form-label">no hp</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" value="{{$member->no_hp}}" id="no_hp" name="no_hp">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-outline-primary me-3">save</button>
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#ubah-password">ubah password</button>
                    <hr/>
                  </form>
                  </div>
                  <div class="col-lg-6">
                    <h4>Alamat <button class="btn btn-outline-primary btn-sm ms-2" data-bs-toggle="modal" data-bs-target="#tambah-alamat">Tambah</button></h4>
                    <div class="card shadow mb-3" ng-repeat="x in alamat">
                      <div class="card-body">
                          <p class="mb-1" style="font-size:13px"><% x.alamat %></p>
                          <p style="font-size:13px">no hp. <% x.no_hp %></p>
                          <button class="btn btn-outline-success btn-sm me-3">edit</button>
                          <button ng-click="hapus_alamat(x.uuid)" class="btn btn-outline-danger btn-sm">Hapus</button>
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
                    <tr ng-repeat = "order  in orders">
                      <td class="align-middle"><p class="pointer text-primary"><% order.no_invoice %></p></td>
                      <td class="tg-0lax">
                        <ul class="mb-1">
                          <li ng-repeat="detail_order in order.tr_order_detail"><% detail_order.merchant_produk.nama_produk %>, <% detail_order.qty %></li>
                        </ul>
                        <div class="mb-1 row" ng-if="order.status<=2">
                            <div class="col">
                                <button ng-click="open_bukti_transfer(order)" class="btn btn-primary btn-sm">Kirim Bukti Transfer</button>
                            </div>
                        </div>
                        <img ng-if="order.status>=2" style="width:200px" src="<% order.transfer %>" alt="Product Image 1">
                      </td>
                      <td class="align-middle text-center">Rp <% order.total_bayar | currency:"" %></td>
                      <td class="align-middle text-center">
                        <a class="text-danger pointer">
                          <span style="font-size:12px" ng-if="order.status<=2" class="badge text-bg-secondary"><% order.status_bayar %></span>
                          <span style="font-size:12px" ng-if="order.status>2" class="badge text-bg-success">SUDAH DI BAYAR</span>
                        </a>
                      </td>
                      <td class="align-middle text-center">
                        <a ng-if="order.status<=2" class="text-danger pointer">Batal</a>
                      </td>
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
                    <tr ng-repeat = "dikemas in order_dikemas">
                      <td class="align-middle"><% dikemas.no_order %></td>
                      <td class="tg-0lax">
                        <div class="d-flex flex-row pointer">
                          <div>
                            <img style="height:60px" src="<% dikemas.merchant_produk.merchant_produk_gambar[0].src %>" alt="Product Image 1">
                          </div>
                          <div>
                            <p class="ms-2 mb-1"><% dikemas.merchant_produk.nama_produk %></p>
                            <p class="ms-2 fs-nama-toko"><i class="fa-solid fa-shop text-primary"></i> <% dikemas.merchant_produk.merchant.nama_toko %></p>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-center">Rp <% dikemas.harga | currency:"" %></td>
                      <td class="align-middle text-center"> <% dikemas.qty | currency:"" %></td>
                      <td class="align-middle text-center">Rp <% dikemas.total_harga | currency:""%></td>
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
                        <button ng-click="modal_diterima(dikirim)" class="btn btn-success btn-sm">Barang Sudah Di Terima</button>
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
                            <p class="ms-2 fs-nama-toko"><i class="fa-solid fa-shop text-primary"></i> <% diterima.merchant_produk.merchant.nama_toko %></p>
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
            </div>
          </div>
        </div>
    </div>
    
    <!-- Modal Login -->
    <div class="modal fade" id="tambah-alamat" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
        <form id="form_alamat">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Alamat</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3 row">
                <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="alamat" name="alamat" rows="3"></textarea>
                </div>
            </div>
            <div class="mb-2 row">
                <label for="no_hp" class="col-sm-3 col-form-label">no hp</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="no_hp" name="no_hp">
                </div>
            </div>
          </div>
          <div class="modal-footer">
              <button type="submit"  class="btn btn-primary">Simpan</button>
          </div>
        </form>
        </div>
      </div>
    </div>
    
    <!-- Modal Login -->
    <div class="modal fade" id="bukti-transfer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
        <form id="form_bukti_transfer">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Kirim Bukti Transfer</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="form-group mb-2 row">
                <label for="file" class="col-sm-4 col-form-label">Bukti Transfer</label>
                <div class="col-sm-8">
                    <input class="form-control form-control-sm" id="file" name="file" type="file">
                </div>
            </div>
          </div>
          <div class="modal-footer">
              <button type="submit"  class="btn btn-primary">Simpan</button>
          </div>
        </form>
        </div>
      </div>
    </div>
    
    <!-- Modal Login -->
    <div class="modal fade" id="modal-diterima" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
        <form id="form_review">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Di terima</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-2 row justify-content-center">
                <div class="col d-flex flex-row pointer mb-3">
                  <span ng-click=setrating(1)>
                    <i ng-if="rating<1" class="fa-regular fa-star fs-5 me-2"></i>
                    <i ng-if="rating>=1" class="fa-solid fa-star fs-5 me-2 text-warning"></i>
                  </span>
                  <span ng-click=setrating(2)>
                    <i ng-if="rating<2" class="fa-regular fa-star fs-5 me-2"></i>
                    <i ng-if="rating>=2" class="fa-solid fa-star fs-5 me-2 text-warning"></i>
                  </span>
                  <span ng-click=setrating(3)>
                    <i ng-if="rating<3" class="fa-regular fa-star fs-5 me-2"></i>
                    <i ng-if="rating>=3" class="fa-solid fa-star fs-5 me-2 text-warning"></i>
                  </span>
                  <span ng-click=setrating(4)>
                    <i ng-if="rating<4" class="fa-regular fa-star fs-5 me-2"></i>
                    <i ng-if="rating>=4" class="fa-solid fa-star fs-5 me-2 text-warning"></i>
                  </span>
                  <span ng-click=setrating(5)>
                    <i ng-if="rating<5" class="fa-regular fa-star fs-5 me-2"></i>
                    <i ng-if="rating>=5" class="fa-solid fa-star fs-5 me-2 text-warning"></i>
                  </span>
                </div>
            </div>
            <div class="form-group mb-2 row">
                <div class="col-sm-12">
                    <textarea ng-model="review" class="form-control" ></textarea>
                </div>
            </div>
          </div>
          <div class="modal-footer">
              <button type="button" ng-click="simpan_id_terima()"  class="btn btn-primary">Simpan</button>
          </div>
        </form>
        </div>
      </div>
    </div>
    
    <!-- Modal ubah password -->
    <div class="modal fade" id="ubah-password" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
        <form id="form_ubah_password">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Password Baru</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-2 row">
                <label for="no_hp" class="col-sm-3 col-form-label">password</label>
                <div class="col-sm-9">
                    <input type="password" class="form-control form-control-sm" id="password" name="password">
                </div>
            </div>
          </div>
          <div class="modal-footer">
              <button type="submit"  class="btn btn-primary">Simpan</button>
          </div>
        </form>
        </div>
      </div>
    </div>
@endsection 

@section('ctrl')
<script>
app.controller("myCtrl", function($scope,$http) {

  $scope.load_alamat = function(){
    $scope.alamat = []
    $http.get("{{ url('get_alamat') }}").then(function(res){
        $scope.alamat = res.data.data;
    });
  }
  $scope.load_alamat();
  
  $scope.load_order = function(){
    $scope.jml_orders = 0;
    $scope.orders = []
    $http.get("{{ url('order_member') }}").then(function(res){
        $scope.orders = res.data.data;
        $scope.jml_orders = res.data.data.filter(function(e){
          return e.status <=2
        }).length;
    });
  }
  $scope.load_order();
  
  $scope.load_produk = function(){
    $scope.order_dikemas = [];
    $scope.order_dikirim = [];
    $scope.order_diterima = [];
    $http.get("{{ url('order_produk_member') }}").then(function(res){
        $scope.order_dikemas = res.data.data.filter(function(e){
          return e.status == 3
        });
        $scope.order_dikirim = res.data.data.filter(function(e){
          return e.status == 4
        });
        $scope.order_diterima = res.data.data.filter(function(e){
          return e.status >= 5
        });
    });
  }
  $scope.load_produk();
  
  $scope.hapus_alamat = function(uuid){
    Swal.fire({title: 'Loading..',onOpen: () => {Swal.showLoading()}})
    $http.get("{{ url('hapus_alamat') }}/"+uuid).then(function(res){
        $scope.load_alamat();
        Swal.close();
    });
  }
  
  var validator = $("#form_alamat").validate({
    rules: {
        alamat: {
            required: !0,
        },
        no_hp: {
            required: !0,
        },
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        error.addClass('fst-italic');
        element.closest('.mb-3 .col-sm-9').append(error);
    },
    highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
    },
    invalidHandler: function(e, r){

    },
    submitHandler: function(e){
			    
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
					url: "{{ url('tambah_alamat') }}",
					type: "POST",
          data:$("#form_alamat").serialize(),
					dataType: "JSON",
					success: function(data)
            {
                if(data.status){
                  Swal.fire({icon: 'success',title: 'Tambah Alamat Berhasil',text: '',}).then(function(){
                    $scope.load_alamat();
                    $('#tambah-alamat').modal('hide');
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
        return false;
    }
  });
  
  $scope.selected_order=null;
  
  $scope.open_bukti_transfer = function(order_detail){
    console.log(order_detail);
    $scope.selected_order = order_detail
    $('#bukti-transfer').modal('show');
  }
  
  var validator = $("#form_bukti_transfer").validate({
      rules: {},
      errorElement: 'span',
      errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          error.addClass('fst-italic');
          element.closest('.form-group .col-sm-9').append(error);
      },
      highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
      },
      invalidHandler: function(e, r){

      },
      submitHandler: function(e){

        form = $("#form_bukti_transfer")[0];
			    formData = new FormData(form);
			    formData.append('uuid',$scope.selected_order.uuid);
			    
        $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
				url: "{{ url('bukti_transfer') }}",
				type: "POST",
        data: formData,
				mimeType: "multipart/form-data",
				contentType: false,
				cache: false,
				processData: false,
				dataType: "JSON",
				success: function(data)
            {
              if(data.status){
                Swal.fire({icon: 'success',title: 'Data Berhasil Di Simpan',text: '',}).then(function(){
                   $('#bukti-transfer').modal('hide');
                   $scope.load_order();
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
        return false;
      }
  });
  
  var validator = $("#form_edit_profil").validate({
      rules: {
        nama: {
            required: !0,
        },
        no_hp: {
            required: !0,
        },
        email: {
            required: !0,
        },
      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          error.addClass('fst-italic');
          element.closest('.form-group .col-sm-9').append(error);
      },
      highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
      },
      invalidHandler: function(e, r){

      },
      submitHandler: function(e){

        form = $("#form_edit_profil")[0];
			    formData = new FormData(form);
			    
        $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
				url: "{{ url('edit_profil') }}",
				type: "POST",
        data: formData,
				mimeType: "multipart/form-data",
				contentType: false,
				cache: false,
				processData: false,
				dataType: "JSON",
				success: function(data)
            {
              if(data.status){
                Swal.fire({icon: 'success',title: 'Data Berhasil Di Simpan',text: '',}).then(function(){
                  window.location.reload();
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
        return false;
      }
  });
  
  $scope.modal_diterima = function(data){
    $scope.selected_order = data
    $scope.rating = 0;
    $scope.review = "";
    $('#modal-diterima').modal('show');
  }
  
  $scope.rating = 0;
  $scope.setrating = function(val){
    $scope.rating = val;
  }
  
  $scope.simpan_id_terima = function(){
    Swal.fire({title: 'Loading..',onOpen: () => {Swal.showLoading()}})
    $http.post("{{ url('di_terima') }}",{
      rating: $scope.rating,
      review: $scope.review,
      id : $scope.selected_order.tr_order_detail_id
    }).then(function(res){
      if(res.data.status){
        Swal.fire({icon: 'success',title: 'Data Berhasil Ubah Status Ke di kirim',text: '',}).then(function(){
          $scope.load_order();
          Swal.close();
          $('#modal-diterima').modal('hide');
        })
      }else{
        Swal.fire({icon: 'error',title: 'Oops...',text: res.data.message,})
      }
    });
  }
  
  var validator = $("#form_ubah_password").validate({
    rules: {
        password: {
            required: !0,
        },
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        error.addClass('fst-italic');
        element.closest('.mb-3 .col-sm-9').append(error);
    },
    highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
    },
    invalidHandler: function(e, r){

    },
    submitHandler: function(e){
			    
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
					url: "{{ url('ubah_password_member') }}",
					type: "POST",
          data:$("#form_ubah_password").serialize(),
					dataType: "JSON",
					success: function(data)
            {
                if(data.status){
                    Swal.fire({icon: 'success',title: 'Masuk Ke Halaman Member',text: '',}).then(function(){
                      window.location.href = "{{ url('member') }}";
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
        return false;
    }
  });
      
  
});
  

</script>
@endsection