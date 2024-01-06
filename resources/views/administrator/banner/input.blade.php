@extends('administrator.template.layout')
@section('css')
    <!-- summernote -->
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
        <div class='row'>
            <div class="col-md-12">
                <!-- Horizontal Form -->
                <div class="card card-info mt-3">
                    <div class="card-header">
                        <h3 class="card-title">Input Artikel</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="formData" class="form-horizontal">
                        <input style="display:none" type="text" name="id" id="id" value="{{ $id }}">
                        <div class="card-body">
                            <div class=" form-group row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label><span class="m--font-danger">*</span> Image </label>
                                </div>
                                <div class="col-lg-12">
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
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Judul</label>
                                <div class="col-sm-5">
                                    <input type="text" name="judul" value="{{ $judul }}" class="form-control" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Detail</label>
                                <div class="col-sm-7">
                                    <textarea id="description" name="description">{{ $detail }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="button" ng-click="back()" class="btn btn-default">Kembali</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
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

        $scope.id = '';

        angular.element(document).ready(function () {
            $('#description').summernote({
                height:200
            })


            if('{{$gambar}}'!=''){
                image = "{{ url('images/banner') }}"+"/"+"{{ $gambar }}"
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


        $('#formData').validate({
            rules: {
                judul: {
                    required: true,
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element
                    .closest('.form-group')
                    .append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function(e){
                description = $('#description').summernote('code');

                form = $("#formData")[0];
				let formData = new FormData(form);
				formData.append('detail',description);
                if({{ $id }}){
                    vurl = "{{ url('api/admin/banner/update') }}";
                }else{
                    vurl = "{{ url('api/admin/banner/create') }}";
                }

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
                            Swal.fire({icon: 'success',title: 'Artikel Berhasil Di Simpan',text: '',}).then(function(){
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

        $scope.back = function(){
            window.location.href = "{{ url('administrator/banner') }}";
        }

    });
    </script>
@endsection