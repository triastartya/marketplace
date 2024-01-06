@extends('administrator.template.layout')
@section('css')
@endsection

@section('content')
    <section class="content">
        <!-- Default box -->
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">Banner</h3>
            </div>
            <div class="card-body">
                <div class="row" >
                    <div class="col-md-12">
                        <button ng-click="create()" type="button" class="btn btn-outline-primary mb-3"><i class="fa fa-plus"></i> Buat Banner</button>
                        <table id="listdatatable" class="table table-bordered table-css-history table-hover dataTable no-footer"></table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </section>
@endsection

@section('ctrl')
    <script>
    app.controller("myCtrl", function($scope,$http) {
        $scope.data = [];
        $scope.update =false;
        var btnDel  =  "<a class='btn btn-outline-danger btn-nav btn-tabel-icon' href='javascript:void(0)' title='Hapus' id='DeleteRow' ><i class='fa fa-trash-alt tip pointer posdel'></i></a>";
        var btnEdit =  " <a class='btn btn-outline-success btn-nav btn-tabel-icon' href='javascript:void(0)' title='Ubah' id='EditRow' ><i class='fa fa-pen tip pointer posdel'></i></a>";
        var table =  $('#listdatatable').DataTable({
            columns: [
                { 
                        "title":"Banner",
                        "data": "src" ,
                        "render": function ( data) {
                            return '<img src="'+data+'" height="200px">';
                        }
                },
                { title:"judul",    "data": "judul","width":"300px" },
                { title:"Action",      "defaultContent": btnEdit+btnDel  , "width":"80px" },

            ]
        });
        
        $('#listdatatable tbody').on('click', '#DeleteRow', function () {
                var tr = $(this).closest('tr');
                var id = table.row(tr).data().id;
                $scope.delete(id);
        });

        $('#listdatatable tbody').on('click', '#EditRow', function () {
            var tr = $(this).closest('tr');
            data = table.row( tr ).data();
            window.location.href = "{{ url('administrator/banner/detail') }}"+"/"+data.id;
        });
         
        $scope.reloadlist = function(){
            Swal.fire({title: 'Loading..',onOpen: () => {Swal.showLoading()}})
            
            table.clear().draw();
            $http.get("{{ url('api/admin/banner') }}").then(function(res){
                table.rows.add(res.data.data).draw( );
                Swal.close();
            });
        }

        $scope.reloadlist();

        $scope.create = function(){
            window.location.href = "{{ url('administrator/banner/tambah') }}";
        }
        
        $scope.delete = function(x){
            Swal.fire({
                title: 'Apa kamu yakin?',
                text: "ingin menghapus data ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({title: 'Loading..',onOpen: () => {Swal.showLoading()}})
                    $http.delete("{{ url('api/admin/banner/delete') }}"+"/"+x).then(function(res){
                        if(res.data.status){
                            Swal.fire({icon: 'success',title: 'Data Berhasil Di Simpan',text: '',}).then(function(){
                                $scope.reloadlist();
                                Swal.close();
                            })
                        }else{
                            Swal.fire({icon: 'error',title: 'Oops...',text: res.data.message,})
                        }
                    });
                }
            })
        }
        
    });
    </script>
@endsection