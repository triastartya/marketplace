

@extends('website.layout')
@section('css')
@endsection

@section('content')
    <div class="container">        
        <div class="row ">
          <div class="col-lg-6">
            <div class="card shadow">
              <div class="card-body">
                <h5 class="card-title fw-bold">Masuk Toko</h5>
                <hr/>
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
                <a href="{{ url('toko') }}" class="btn btn-primary">Masuk Toko</a>
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