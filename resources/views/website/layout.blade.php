<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="{{ url('/') }}/fontawesome/css/all.min.css">
    <script src="{{ url('/') }}/fontawesome/js/all.min.js"></script>
    <link rel="stylesheet" href="{{ url('/') }}/assets/style-website.css">
    <script src="{{ url('/') }}/template/angularJS/angular.min.js"></script>
    <script src="{{ url('/') }}/template/angularJS/app.js"></script>
    <style>
      body {
          font-family: 'Poppins';
      }
    </style>
    @yield('css')
    @yield('ctrl')
</head>
<body ng-app="app"  ng-controller="myCtrl">
    <header class="shadow p-2 mb-2 sticky-top bg-light">
      <div class="d-flex flex-row justify-content-between">
          <div style="width:150px" >
            <a href="{{ url('') }}">
              <img style="height:38px" alt="tokopedia-logo" src="{{ url('/') }}/images/logo.jpeg">
            </a>
          </div>
          
          <div style="width:calc(100vw - 420px)">
            <div class="input-group input-group-sm">
              <span class="input-group-text" id="basic-addon1">
                <i class="fa-solid fa-search mx-1"></i>
              </span>
              <input type="text" class="form-control" placeholder="Cari Barang">
            </div>
          </div>
          
          <div style="width:190px">
            <a href="{{ url('keranjang-belanja') }}"><i class="fa-solid fa-cart-shopping text-primary mx-2"></i></a>
            <button class="btn btn-outline-primary btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Masuk</button>
            <button class="btn btn-primary btn-outline btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#register">Daftar</button>
          </div>
      </div>
    </header>
    @yield('content')
    <hr class="mt-5"/>
    <footer>
      <div class="row m-4">
        <div class="col">
          <p class="fw-bold">Alamat</p>
          <p style="font-size:13px">Jl. Imam Bonjol No.207, Pendrikan Kidul, Kec. Semarang Tengah, Kota Semarang, Jawa Tengah 50131</p>
        </div>
        <div class="col">
          <p class="fw-bold">Cara Pemesanan</p>
            <ul style="font-size:13px">
              <li>Pilih Barang</li>
              <li>Masukan Keranjang belanja</li>
              <li>Pilih Barang yang akan di bayar</li>
              <li>Transfer Pembayan ke rekeing</li>
              <li>Konfirmasi Pembayran upload bukti transfer</li>
            </ul>
        </div>
        <div class="col">
          <p class="fw-bold">Ikuti Kami</p>
          <div>
            <img class="pointer" src="{{ url('/') }}/images/1.svg">
            <img class="pointer" src="{{ url('/') }}/images/2.svg">
          </div>
        </div>
        <div class="col">
          <img class="img-fluid" src="{{ url('/') }}/images/footer.jpg">
        </div>
      </div>
    </footer>
    <!-- Modal Login -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
        <form id="forminput">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Masuk</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-3 col-form-label">email</label>
                <div class="col-sm-9">
                    <input type="email" class="form-control form-control-sm" id="inputPassword">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-9">
                    <input type="password" class="form-control form-control-sm" id="inputPassword">
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <a href="{{ url('member') }}">
              <button type="button" class="btn btn-primary">Login</button>
            </a>
          </div>
        </form>
        </div>
      </div>
    </div>
    <!-- Modal Register -->
    <div class="modal fade" id="register" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
        <form id="forminput">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Daftar Member</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-3 col-form-label">nama</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="inputPassword">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-3 col-form-label">email</label>
                <div class="col-sm-9">
                    <input type="email" class="form-control form-control-sm" id="inputPassword">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-3 col-form-label">no hp</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="inputPassword">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-9">
                    <input type="password" class="form-control form-control-sm" id="inputPassword">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-3 col-form-label">Confirm</label>
                <div class="col-sm-9">
                    <input type="password" class="form-control form-control-sm" id="inputPassword">
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <a href="{{ url('member') }}">
              <button type="button" class="btn btn-primary">Daftar</button>
            </a> 
          </div>
        </form>
        </div>
      </div>
    </div>
</body>
</html>