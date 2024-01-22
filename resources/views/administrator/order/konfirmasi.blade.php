@extends('administrator.template.layout')
@section('css')
@endsection

@section('content')
    <section class="content">
        <!-- Default box -->
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">Verifikasi Pembayaran</h3>
            </div>
            <div class="card-body">
                <div class="row" >
                    <div class="col-md-12">
                        <table id="listdatatable" class="table table-bordered table-css-history table-hover dataTable no-footer"></table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </section>
    <div class="modal fade" id="model_lihat">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Bukti Transfer</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <img style="height:600px" src="<% selected.transfer %>" alt="Product Image 1">
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" ng-click="verifikasi()" class="btn btn-primary">Verifikasi Bukti Transfer</button>
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
                    "title":"Bukti Pembayaran",
                    "data": "transfer" ,
                    "render": function ( data) {
                        return '<img src="'+data+'" height="100px">';
                    }
                },
                { title:"Nama",    "data": "member.nama","width":"300px" },
                { title:"Email",    "data": "member.email","width":"300px" },
                { title:"No Hp",    "data": "member.no_hp","width":"300px" },
                { title:"No Invoice",    "data": "no_invoice","width":"300px" },
                { title:"Total Bayar",    "data": "total_bayar","width":"300px" ,"className": "text-right",render: $.fn.dataTable.render.number( '.', ',', 0, '' )},
                { title:"Action",      "defaultContent": btnEdit  , "width":"80px" },
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
            $http.get("{{ url('konfirmasi') }}").then(function(res){
                table.rows.add(res.data.data).draw( );
                Swal.close();
            });
        }
        $scope.reloadlist();
        
        $scope.verifikasi = function(){
            Swal.fire({title: 'Loading..',onOpen: () => {Swal.showLoading()}})
            $http.post("{{ url('verifikasi') }}",{
                uuid : $scope.selected.uuid
            }).then(function(res){
                if(res.data.status){
                    Swal.fire({icon: 'success',title: 'Data Berhasil Di Simpan',text: '',}).then(function(){
                        Swal.close();
                        $('#model_lihat').modal('hide');
                        $scope.reloadlist();
                    })
                }else{
                    Swal.fire({icon: 'error',title: 'Oops...',text: res.data.message,})
                }
            });
        }

    });
    </script>
@endsection