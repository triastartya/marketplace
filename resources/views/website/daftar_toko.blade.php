

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
            <div class="card shadow">
              <div class="card-body">
                <h5 class="card-title fw-bold">Informasi Toko</h5>
                <hr/>
                <div class="mb-2 row">
                  <label for="inputPassword" class="col-sm-3 col-form-label">nama toko</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" id="inputPassword">
                  </div>
                </div>
                <div class="mb-2 row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">no hp</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" id="inputPassword">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Alamat</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Profil toko</label>
                    <div class="col-sm-9">
                        <input class="form-control form-control-sm" id="formFileSm" type="file">
                    </div>
                </div>
                <div class="mb-2 row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">email</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control form-control-sm" id="inputPassword">
                    </div>
                </div>
                <div class="mb-2 row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control form-control-sm" id="inputPassword">
                    </div>
                </div>
                <div class="mb-2 row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Confirm</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control form-control-sm" id="inputPassword">
                    </div>
                </div>
                <a href="{{ url('toko') }}" class="btn btn-primary">Daftar Toko</a>
              </div>
            </div>
          </div>
        </div>
    </div>
@endsection 

@section('ctrl')
    <script>
    app.controller("myCtrl", function($scope,$http) {
        
    });
    </script>
@endsection