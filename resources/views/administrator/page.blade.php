@extends('administrator.template.layout')
@section('css')
<link rel="stylesheet" href="{{ url('/') }}/template/plugins/summernote/summernote-bs4.min.css">
    <style>
        .box {
            position: relative;
            background: #ffffff;
            width: 100%;
        }
        .box-header {
            color: #444;
            display: block;
            padding: 10px;
            position: relative;
            border-bottom: 1px solid #f4f4f4;
            margin-bottom: 10px;
        }
        .box-tools {
            position: absolute;
            right: 10px;
            top: 5px;
        }
        .tdropzone-wrapper {
            border: 2px dashed #91b0b3;
            color: #92b0b3;
            position: relative;
            height: 150px;
        }
        .tdropzone-desc {
            position: absolute;
            margin: 0 auto;
            left: 0;
            right: 0;
            text-align: center;
            width: 40%;
            top: 50px;
            font-size: 16px;
        }
        .tdropzone,
        .tdropzone:focus {
            position: absolute;
            outline: none !important;
            width: 100%;
            height: 150px;
            cursor: pointer;
            opacity: 0;
        }
        .tdropzone-wrapper:hover,
        .tdropzone-wrapper.dragover {
            background: #ecf0f5;
        }
        .preview-zone {
            text-align: center;
            padding: 15px;
            border: 2px dashed #91b0b3;
        }
        .preview-zone .box {
            box-shadow: none;
            border-radius: 0;
            margin-bottom: 0;
        }
        .hidden{
            display: none;
        }
    </style>
@endsection

@section('content')
    <section class="content">
        <!-- Default box -->
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">Leanding Page</h3>
            </div>
            <div class="card-body">
            <form id="formData" class="form-horizontal">
                {{-- <button ng-click="create()" type="button" class="btn btn-outline-primary mb-3">Save</button> --}}
                <button type="submit" class="btn btn-primary">Simpan</button>
                <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Nama Marketplace</label>
                        <input type="text" class="form-control" name="nama" value="{{ $nama }}">
                      </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <div class="col-lg-8 col-md-8 col-sm-12">
                            <label><span class="m--font-danger">*</span> Logo </label>
                        </div>                            
                        <div class="col-lg-8">
                            <div class="preview-zone hidden preview-zone-banner" >
                                <div class="box box-solid">
                                    <div class="box-body box-body-banner"></div>
                                    <button type="button" class="btn btn-danger btn-xs remove-preview">
                                        <i class="fa fa-times"></i> Remove
                                    </button>
                                </div>
                            </div>
                            <div class="tdropzone-wrapper tdropzone-wrapper-banner" >
                                <div class="tdropzone-desc">
                                    <i class="glyphicon glyphicon-download-alt"></i>
                                        <p>Choose an image file or drag it here.</p>
                                </div>
                                <input type="file" name="file" id="file" class="tdropzone">
                            </div>
                        </div>

                      </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Tentang Marketplace</label>
                        <textarea id="description" name="description">{{ $tentang }}</textarea>
                      </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
        <!-- /.card -->
    </section>
@endsection

@section('ctrl')
    <!-- Summernote -->
    <script src="{{ url('/') }}/template/plugins/summernote/summernote-bs4.min.js"></script>
    <script type="text/javascript">
        function readFile(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    var htmlPreview =
                    '<img height="300" src="' + e.target.result + '" />'+
                    '<p>' + input.files[0].name + '</p>';
                    var wrapperZone = $(input).parent();
                    var previewZone = $(input).parent().parent().find('.preview-zone');
                    var boxZone = $(input).parent().parent().find('.preview-zone').find('.box').find('.box-body');

                    wrapperZone.removeClass('dragover');
                    wrapperZone.addClass('hidden');
                    previewZone.removeClass('hidden');

                    boxZone.empty();
                    boxZone.append(htmlPreview);
                    //$('#input1').hide();$('#preview1').show();
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $(document).ready(function(){
            function reset(e) {
                    input = e.find('input');
                    input.val(null);
                }

                $('#preview1').hide();
                $(".tdropzone").change(function(){
                    readFile(this);
                });

                $('.tdropzone-wrapper').on('dragover', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    $(this).addClass('dragover');
                });

                $('.tdropzone-wrapper').on('dragleave', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    $(this).removeClass('dragover');
                });

                $('.remove-preview').on('click', function() {
                    var boxZone = $(this).parents('.preview-zone').find('.box-body');
                    var wrapperZone = $(this).parent().parent().parent().find('.tdropzone-wrapper');
                    var previewZone = $(this).parents('.preview-zone');
                    var tdropzone = $(this).parents('.form-group').find('.tdropzone');
                    boxZone.empty();
                    //console.log(wrapperZone);
                    wrapperZone.removeClass('hidden');
                    previewZone.addClass('hidden');
                    reset(wrapperZone);
                });
        });
    </script>

    <script>
    app.controller("myCtrl", function($scope,$http) {
    
        angular.element(document).ready(function () {
            $('#description').summernote({
                height:500
            })
            if('{{$logo}}'!=''){
                image = "{{ url('images/logo') }}"+"/"+"{{ $logo }}"
                $('.box-body-banner').empty();
                $('.box-body-banner').append('<img height="300" src='+image+' />');
                $('.preview-zone-banner').removeClass('hidden');
                $('.tdropzone-wrapper-banner').addClass('hidden');
                
            }else{
                $('.box-body-banner').empty();
                $('.preview-zone-banner').addClass('hidden');
                $('.tdropzone-wrapper-banner').removeClass('hidden');
            }
        });
    
        $scope.data = [];
        $scope.update =false;

        var validator = $("#formData").validate({
            rules: {
                nama: {
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

                description = $('#description').summernote('code');

                form = $("#formData")[0];
				let formData = new FormData(form);
				formData.append('tentang',description);
                vurl = "{{ url('api/admin/page') }}";
               
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
					url: vurl,
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
                            Swal.fire({icon: 'success',title: 'Berhasil Di Simpan',text: '',}).then(function(){
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


        $scope.reloadlist = function(){
            Swal.fire({title: 'Loading..',onOpen: () => {Swal.showLoading()}})

            table.clear().draw();
            $http.get("{{ url('api/admin/kategori') }}").then(function(res){
                table.rows.add(res.data.data).draw( );
                Swal.close();
            });
        }

    });
    </script>
@endsection
