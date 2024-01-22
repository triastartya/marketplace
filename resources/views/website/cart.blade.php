

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
                <tr ng-repeat="item in keranjang_belanja">
                  <td class="align-middle"><input ng-model="item.checked" ng-change="sum()" class="form-check-input" type="checkbox"></td>
                  <td class="tg-0lax">
                    <div class="d-flex flex-row pointer">
                      <div>
                        <img style="height:60px" src="<% item.merchant_produk.merchant_produk_gambar[0].src %>" alt="Product Image 1">
                      </div>
                      <div>
                        <p class="ms-2 mb-1"><% item.merchant_produk.nama_produk %></p>
                        <p class="ms-2 fs-nama-toko"><i class="fa-solid fa-shop text-primary"></i> <% item.merchant_produk.merchant.nama_toko %> </p>
                      </div>
                    </div>
                  </td>
                  <td class="align-middle text-center">Rp <% item.merchant_produk.harga_jual | currency:"" %></td>
                  <td class="align-middle">
                    <div class="input-group mb-3 input-group-sm" style="width:120px">
                      <button ng-click="kurang($index,item)" class="btn btn-outline-secondary" type="button" id="button-addon1">-</button>
                      <input value="<% item.qty %>" type="number" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                      <button ng-click="tambah($index,item)" class="btn btn-outline-secondary" type="button" id="button-addon2">+</button>
                    </div>
                  </td>
                  <td class="align-middle text-center">Rp <% item.merchant_produk.harga_jual * item.qty | currency:"" %></td>
                  <td class="align-middle text-center"><a ng-click="hapus(item)" class="text-danger pointer">Hapus</a></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
    </div>
    <div class="shadow-lg p-3 px-4 mb-2 sticky-bottom" style="background-color: #e3e8fa">
      <div class="d-flex flex-row-reverse">
        <button class="btn btn-primary mx-2 " data-bs-toggle="modal" data-bs-target="#bayar">Checkout</button>
        <p class="mx-2 my-auto fw-bold fs-4">Rp <% total | currency:"" %></p>
        <p class="mx-2 my-auto text-primary">Total(<% jml | currency:"" %> item)</p>
      </div>
    </div>
    
    <!-- Modal Login -->
    <div class="modal fade" id="bayar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
        <form id="forminput">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Cara Bayar</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            {{-- <p>#INV-73528</p> --}}
            <h3 class="fw-bold m-3">Rp <% total | currency:"" %></h3>
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
              <button ng-click="bayar()" type="button" class="btn btn-primary">Buat Invoice</button>
          </div>
        </form>
        </div>
      </div>
    </div>
@endsection 

@section('ctrl')
    <script>
    app.controller("myCtrl", function($scope,$http) {
      
      $scope.total = 0;
      $scope.jml = 0;
      
      $scope.keranjang_belanja = [];
      
      Swal.fire({title: 'Loading..',onOpen: () => {Swal.showLoading()}})
      $http.get("{{ url('data_keranjang_belanja') }}").then(function(res){
          $scope.keranjang_belanja = res.data.data;
          Swal.close();
      });
      
      $scope.kurang = function(index,item){
          if($scope.keranjang_belanja[index].qty >= 2){
            $scope.keranjang_belanja[index].qty = $scope.keranjang_belanja[index].qty - 1;
          }
          $scope.sum();
      }
      
      $scope.tambah = function(index,item){
        $scope.keranjang_belanja[index].qty = $scope.keranjang_belanja[index].qty + 1;
        $scope.sum();
      }
      
      $scope.items = [];
      
      $scope.sum = function(){
         var c =  $scope.keranjang_belanja.filter(function(e){
           return e.checked
         });
         
         $scope.jml = c.sum('qty');
         
         $scope.total = c.sum('qty') * c.sum('harga');
      }
            
      
      $scope.bayar = function(){
        var c =  $scope.keranjang_belanja.filter(function(e){
            return e.checked
        });
        
        Swal.fire({title: 'Loading..',onOpen: () => {Swal.showLoading()}})
        $http.post("{{ url('buat_invoice') }}",{
          total : $scope.total,
          jml : $scope.jml,
          detail : c
        }).then(function(res){
          if(res.data.status){
              Swal.fire({icon: 'success',title: res.data.message,text: '',}).then(function(){
                window.location.href = "{{ url('member') }}";
              })
          }else{
              Swal.fire({icon: 'error',title: 'Oops...',text: res.data.message,})
          }
        });
      }
      
    });
    </script>
@endsection