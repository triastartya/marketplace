

@extends('website.layout')
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
    <div class="container">        
        <div class="row ">
          <div class="col-lg-12">
          <form id="form_produk">
            <div class="card shadow">
              <div class="card-body">
                <h5 class="card-title fw-bold">Produk</h5>
                <hr/>
                <div class="form-group mb-2 row">
                  <label for="nama_produk" class="col-sm-3 col-form-label">nama produk</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" @isset($produk) value="{{$produk->nama_produk}}" @endisset id="nama_produk" name="nama_produk">
                  </div>
                </div>
                <div class="form-group mb-2 row">
                  <label for="kategori_id" class="col-sm-3 col-form-label">kategori</label>
                  <div class="col-sm-9">
                        <select class="form-select" aria-label="Default select example" id="kategori_id" name="kategori_id">
                            <option value=""> </option>
                            @foreach($kategori as $item)
                                <option value="{{$item->kategori_id}}" @isset($produk) @if($produk->kategori_id==$item->kategori_id) selected @endif @endisset>{{ $item->kategori }}</option>
                            @endforeach
                        </select>
                  </div>
                </div>
                <div class="form-group mb-2 row">
                    <label for="harga" class="col-sm-3 col-form-label">harga</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control form-control-sm" @isset($produk) value="{{$produk->harga}}" @endisset id="harga" name="harga">
                    </div>
                </div>
                <div class="form-group mb-2 row">
                    <label for="harga" class="col-sm-3 col-form-label">stok</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control form-control-sm" @isset($produk) value="{{$produk->stok}}" @endisset id="stok" name="stok">
                    </div>
                </div>
                <div class=" form-group mb-3 row">
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
                <div class="form-group mb-3 row">
                    <label class="col-sm-3 col-form-label">Diskripsi</label>
                    <div class="col-sm-9">
                        <textarea id="description" id="description" name="description">@isset($produk) {{$produk->keterangan}} @endisset</textarea>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Simpan</button>
              </div>
            </div>
          </form>
          </div>
        </div>
    </div>
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
            height:200
        })
        
        @isset($produk)
            image = "{{ $produk->merchant_produk_gambar[0]->src }}"
            $('.box-body-banner').empty();
            $('.box-body-banner').append('<img height="300" src='+image+' />');
            $('.preview-zone-banner').removeClass('hidden');
            $('.tdropzone-wrapper-banner').addClass('hidden');
            $scope.posturl = "{{ url('edit_produk') }}";     
        @else
            $('.box-body-banner').empty();
            $('.preview-zone-banner').addClass('hidden');
            $('.tdropzone-wrapper-banner').removeClass('hidden');
            $scope.posturl = "{{ url('tambah_produk') }}";  
        @endisset
            
    });
    
    var validator = $("#form_produk").validate({
        rules: {
            nama_produk: {
                required: !0,
            },
            harga: {
                required: !0,
            },
            stok: {
                required: !0,
            }
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
        
            description = $('#description').summernote('code');
            form = $("#form_produk")[0];
			let formData = new FormData(form);
			formData.append('keterangan',description);
			@isset($produk)
			    formData.append('uuid',"{{$produk->uuid}}");
			@endisset
				
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
				url: $scope.posturl,
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
});
</script>
@endsection