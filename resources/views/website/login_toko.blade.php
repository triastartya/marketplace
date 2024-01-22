

@extends('website.layout')
@section('css')
@endsection

@section('content')
    <div class="container">        
        <div class="row ">
        <form id="form_masuk_toko">
          <div class="col-lg-6">
            <div class="card shadow">
              <div class="card-body">
                <h5 class="card-title fw-bold">Masuk Toko</h5>
                <hr/>
                <div class="mb-2 row">
                    <label for="email" class="col-sm-3 col-form-label">email</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control form-control-sm" id="email" name="email">
                    </div>
                </div>
                <div class="mb-2 row">
                    <label for="password" class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control form-control-sm" id="password" name="password">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Masuk Toko</button>
              </div>
            </div>
          </div>
        </form>
        </div>
    </div>
@endsection 

@section('ctrl')
<script>
app.controller("myCtrl", function($scope,$http) {
  var validator = $("#form_masuk_toko").validate({
      rules: {
          email: {
              required: !0,
          },
          password: {
              required: !0,
          },
      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          error.addClass('fst-italic');
          element.closest('.mb-2 .col-sm-9').append(error);
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
  					url: "{{ url('login_merchant') }}",
  					type: "POST",
            data:$("#form_masuk_toko").serialize(),
  					dataType: "JSON",
  					success: function(data)
              {
                  if(data.status){
                      Swal.fire({icon: 'success',title: 'Masuk Ke Toko',text: '',}).then(function(){
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