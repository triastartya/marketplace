@extends('administrator.template.layout')
@section('css')
@endsection

@section('content')
    <section class="content">
        <!-- Default box -->
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">Data Kategori</h3>
            </div>
            <div class="card-body">
                <div class="row" >
                    <div class="col-md-12">
                        <button ng-click="create()" type="button" class="btn btn-outline-primary mb-3"><i class="fa fa-plus"></i> Tambah Data</button>
                        <table id="listdatatable" class="table table-bordered table-css-history table-hover dataTable no-footer"></table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </section>
    <div class="modal fade" id="modalform">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <form id="forminput">
            <input type="text" class="form-control hidden" ng-model="kategori_id" name="kategori_id" id="kategori_id">
            <div class="modal-header">
              <h4 class="modal-title">Kategori</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="fasilitas" class="col-sm-2 col-form-label">kategori</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" ng-model="kategori" name="kategori" id="kategori">
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="submit" class="btn btn-primary">Simpan</button>
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

        var validator = $("#forminput").validate({
            rules: {
                kategori: {
                    required: !0,
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group .col-sm-10').append(error);
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

                form = $("#forminput")[0];
			    formData = new FormData(form);
			    
			    if($scope.update){
			        type = "POST";
			        url="{{ url('api/admin/kategori_update') }}";
			    }else{
			        type = "POST";
			        url="{{ url('api/admin/kategori') }}";
			    }
			    
                $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
					url: url,
					type: type,
                    data:$("#forminput").serialize(),
					dataType: "JSON",
					success: function(data)
                    {
                        if(data.status){
                            Swal.fire({icon: 'success',title: 'Data Berhasil Di Simpan',text: '',}).then(function(){
                                $scope.reloadlist();
                                Swal.close();
                                $('#modalform').modal('hide');
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

        var btnDel  =  "<a class='btn btn-outline-danger btn-nav btn-tabel-icon' href='javascript:void(0)' title='Hapus' id='DeleteRow' ><i class='fa fa-trash-alt tip pointer posdel'></i></a>";
        var btnEdit =  " <a class='btn btn-outline-success btn-nav btn-tabel-icon' href='javascript:void(0)' title='Ubah' id='EditRow' ><i class='fa fa-pen tip pointer posdel'></i></a>";
        var table =  $('#listdatatable').DataTable({
                columns: [
                    { title:"Id" ,         "data":"uuid" ,     "width":"300px" },
                    { title:"Kategory",        "data": "kategori" },
                    { title:"Action",      "defaultContent": btnEdit+btnDel  , "width":"100px" },
                ]
            });

            $('#listdatatable tbody').on('click', '#DeleteRow', function () {
                var tr = $(this).closest('tr');
                var id = table.row(tr).data().kategori_id;
                $scope.delete(id);
            });

            $('#listdatatable tbody').on('click', '#EditRow', function () {
                var tr = $(this).closest('tr');
                $scope.edit(table.row( tr ).data());
            });

        $scope.reloadlist = function(){
            Swal.fire({title: 'Loading..',onOpen: () => {Swal.showLoading()}})

            table.clear().draw();
            $http.get("{{ url('api/admin/kategori') }}").then(function(res){
                table.rows.add(res.data.data).draw( );
                Swal.close();
            });
        }

        $scope.reloadlist();

        $scope.create = function(){
            $scope.update        = false;
            $scope.kategori_id   = '';
            $scope.kategori      = '';
            $('#modalform').modal('show');
        }

        $scope.edit = function(x){
            $scope.update        = true;
            $scope.kategori      = x.kategori;
            $scope.kategori_id   = x.kategori_id;
            validator.resetForm();
            $('#modalform').modal('show');
            $scope.$apply();
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
                    $http.delete("{{ url('api/admin/kategori') }}"+"/"+x).then(function(res){
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