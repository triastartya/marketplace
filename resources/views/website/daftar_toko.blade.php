

@extends('website.layout')
@section('css')
@endsection

@section('content')
    <div class="container">        
        <div class="row ">
          <div class="col-lg-6 text-center">
            <img class="img-fluid" src="{{ url('/') }}/images/toko-baru.jpg">
            <p class="fs-4 fw-bold text-primary">Buat Toko Onlinemu Di Sini</p>
          </div>
          <div class="col-lg-6">
          <form id="form_daftar_toko">
            <div class="card shadow">
              <div class="card-body">
                <h5 class="card-title fw-bold">Informasi Toko</h5>
                <hr/>
                <div class="form-group mb-2 row">
                  <label for="nama_toko" class="col-sm-3 col-form-label">nama toko</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" id="nama_toko" name="nama_toko">
                  </div>
                </div>
                <div class="form-group mb-2 row">
                    <label for="no_hp" class="col-sm-3 col-form-label">no hp</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" id="no_hp" name="no_hp">
                    </div>
                </div>
                <div class="form-group mb-2 row">
                    <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="alamat" name="alamat" rows="3"></textarea>
                    </div>
                </div>
                <div class="form-group mb-2 row">
                    <label for="file" class="col-sm-3 col-form-label">Logo</label>
                    <div class="col-sm-9">
                        <input class="form-control form-control-sm" id="file" name="file" type="file">
                    </div>
                </div>
                <div class="form-group mb-2 row">
                    <label for="email" class="col-sm-3 col-form-label">email</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control form-control-sm" id="email" name="email">
                    </div>
                </div>
                <div class="form-group mb-2 row">
                    <label for="password" class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control form-control-sm" id="password" name="password">
                    </div>
                </div>
                <div class="form-group mb-2 row">
                    <label for="confirm" class="col-sm-3 col-form-label">Confirm</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control form-control-sm" id="confirm" name="confirm">
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Daftar Toko</button>
              </div>
            </div>
          </form>
          </div>
        </div>
    </div>
@endsection 

@section('ctrl')
<script>
app.controller("myCtrl", function($scope,$http) {
    var validator = $("#form_daftar_toko").validate({
        rules: {
            nama_toko: {
                required: !0,
            },
            no_hp: {
                required: !0,
            },
            alamat: {
                required: !0,
            },
            file: {
                required: !0,
            },
            email: {
                required: !0,
            },
            password: {
                required: !0,
            },
            confirm: {
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

            form = $("#form_daftar_toko")[0];
			formData = new FormData(form);	    
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
				url: "{{ url('daftar_merchant') }}",
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
                           window.location.href = "{{ url('toko') }}";
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