<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css?v=3.2.0') }}">
</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="{{ asset('adminlte') }}/index2.html"><b>Admin</b>Delafan</a>
    </div>

    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Masuk dengan username dan password</p>
        <form action="{{ route('login') }}" method="POST">
          @csrf
          <div class="input-group mb-3">
            <input type="text" name="username" class="form-control" placeholder="Username">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-block btn-primary">Masuk</button>
        </form>
      </div>
    </div>
  </div>


  <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('adminlte/dist/js/adminlte.min.js?v=3.2.0') }}"></script>
</body>
</html>