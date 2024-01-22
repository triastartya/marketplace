@extends('administrator.template.layout')
@section('css')
@endsection

@section('content')
    <section class="content">
        <div class="card card-primary card-tabs mt-3">
          <div class="card-header p-0 pt-1">
            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="false">Pembayaran Ke Merchant</a>
              </li>
              <li class="nav-item">
                <a class="nav-link " id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="true">Sudah Di Bayarkan</a>
              </li>
            </ul>
          </div>
          <div class="card-body">
            <div class="tab-content" id="custom-tabs-one-tabContent">
              <div class="tab-pane fade active show" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                <div class="row" >
                    <div class="col-md-12">
                        <table id="listdatatable" class="table table-bordered table-css-history table-hover dataTable no-footer"></table>
                    </div>
                </div>
              </div>
              <div class="tab-pane fade " id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                <div class="row" >
                    <div class="col-md-12">
                        <table id="listdatatable_history" class="table table-bordered table-css-history table-hover dataTable no-footer"></table>
                    </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card -->
        </div>
    </section>
    <div class="modal fade" id="model_lihat">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
          <form id="form_bukti_transfer">
            <div class="modal-header">
              <h4 class="modal-title">Bukti Transfer</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-2 row">
                    <label for="file" class="col-sm-4 col-form-label">Bukti Transfer</label>
                    <div class="col-sm-8">
                        <input class="form-control" id="file" name="file" type="file">
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="submit" class="btn btn-primary">Cairkan Dana</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection

@section('ctrl')
    <script>
    app.controller("myCtrl", function($scope,$http) {
        $scope.data = [];
        $scope.update =false;
        $scope.selected = {
            transfer : "https://via.placeholder.com/800x400"
        }
        var btnEdit =  " <a class='btn btn-outline-success btn-nav btn-tabel-icon' href='javascript:void(0)' title='Ubah' id='EditRow' >Lihat</a>";
        var table =  $('#listdatatable').DataTable({
            columns: [
                {
                    "title":"Bukti Transfer",
                    "data": "order.transfer" ,
                    "render": function ( data) {
                        return '<img src="'+data+'" height="100px">';
                    }
                },
                { title:"No Order",    "data": "no_order","width":"300px" },
                { title:"Produk",    "data": "merchant_produk.nama_produk","width":"300px" },
                { title:"Toko",    "data": "merchant.nama_toko","width":"300px" },
                { title:"No HP",    "data": "merchant.no_hp","width":"300px" },
                { title:"Total Bayar",    "data": "total_harga","width":"300px" ,"className": "text-right",render: $.fn.dataTable.render.number( '.', ',', 0, '' )},
                { title:"Action",      "defaultContent": btnEdit  , "width":"80px" },
            ]
        });
        
        var table_history =  $('#listdatatable_history').DataTable({
            autoWidth: false,
            columns: [
                {
                    "title":"Bukti Transfer",
                    "data": "cair" ,
                    "render": function ( data) {
                        return '<img src="'+data+'" height="100px">';
                    }
                },
                { title:"No Order",    "data": "no_order","width":"300px" },
                { title:"Produk",    "data": "merchant_produk.nama_produk","width":"300px" },
                { title:"Toko",    "data": "merchant.nama_toko","width":"300px" },
                { title:"No HP",    "data": "merchant.no_hp","width":"300px" },
                { title:"Total Bayar",    "data": "total_harga","width":"300px" ,"className": "text-right",render: $.fn.dataTable.render.number( '.', ',', 0, '' )},
            ]
        });

        $('#listdatatable tbody').on('click', '#EditRow', function () {
            var tr = $(this).closest('tr');
            data = table.row( tr ).data();
            $('#model_lihat').modal('show'); 
            $scope.selected = data;
            $scope.$apply();
        });
         
        $scope.reloadlist = function(){
            Swal.fire({title: 'Loading..',onOpen: () => {Swal.showLoading()}})
            
            table.clear().draw();
            $http.get("{{ url('pengajuan') }}").then(function(res){
                table.rows.add(res.data.data).draw( );
                Swal.close();
            });
            
            table_history.clear().draw();
            $http.get("{{ url('history_pembayaran') }}").then(function(res){
                table_history.rows.add(res.data.data).draw( );
                table_history.columns.adjust().draw();
                Swal.close();
            });
        }
        $scope.reloadlist();
        
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
			    formData.append('id',$scope.selected.tr_order_detail_id);
        			    
                $.ajax({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
    				url: "{{ url('pencairan') }}",
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
                           $scope.reloadlist();
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
        
        $('a[data-toggle="pill"]').on('shown.bs.tab', function(e) {
          console.log(e.target.hash)
          if (e.target.hash == '#custom-tabs-one-profile') {
            setTimeout(function() {
                table_history.columns.adjust().draw()
            }, 2000);
          }
        })

    });
    </script>
@endsection