<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Delafan Putri Avon - Toko Mayoret Tegal</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="Free HTML Templates" name="keywords">
  <meta content="Free HTML Templates" name="description">

  <!-- Favicon -->
  <link href="img/favicon.ico" rel="icon">

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

  <!-- Libraries Stylesheet -->
  <link href="{{ asset('eshopper/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

  <!-- Customized Bootstrap Stylesheet -->
  <link href="{{ asset('eshopper/css/style.css') }}" rel="stylesheet">
</head>

<body>
  <!-- Topbar Start -->
  <div class="container-fluid">
    <div class="row bg-secondary py-2 px-xl-5">
      <div class="col-lg-6 d-none d-lg-block">
        <div class="d-inline-flex align-items-center">
          <a class="text-dark" href="#faq">FAQs</a>
        </div>
      </div>
      <div class="col-lg-6 text-center text-lg-right">
        <div class="d-inline-flex align-items-center">
          <a class="text-dark px-2" href="">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a class="text-dark px-2" href="">
            <i class="fab fa-instagram"></i>
          </a>
          <a class="text-dark pl-2" href="">
            <i class="fab fa-youtube"></i>
          </a>
        </div>
      </div>
    </div>
    <div class="row align-items-center py-3 px-xl-5">
      <div class="col-lg-3 d-none d-lg-block">
        <a href="" class="text-decoration-none">
          <h1 class="m-0 display-5 font-weight-semi-bold">
            <span class="text-primary font-weight-bold border px-3 mr-1">8</span>Delafan
          </h1>
        </a>
      </div>
      <div class="col-lg-6 col-6 text-left">
        <form action="">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Cari produk">
            <div class="input-group-append">
              <span class="input-group-text bg-transparent text-primary">
                <i class="fa fa-search"></i>
              </span>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Topbar End -->

  <!-- Navbar Start -->
  <div class="container-fluid {{ request()->is('/') ? 'mb-5' : '' }}">
    <div class="row border-top px-xl-5">
      <div class="col-lg-3 d-none d-lg-block">
        <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100"
          data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
          <h6 class="m-0">Kategori</h6>
          <i class="fa fa-angle-down text-dark"></i>
        </a>
        <nav
          class="collapse {{ request()->is('/') ? 'show' : 'position-absolute' }} navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0"
          id="navbar-vertical"
          style="{{ request()->is('produk') || request()->is('kontak') ? 'width: calc(100% - 30px); z-index: 1;' : '' }}">
          <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
            <div class="nav-item dropdown">
              <a href="#" class="nav-link" data-toggle="dropdown">
                Mayoret <i class="fa fa-angle-down float-right mt-1"></i>
              </a>
              <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                <a href="" class="dropdown-item">Seragam Mayoret</a>
                <a href="" class="dropdown-item">Topi Mayoret</a>
                <a href="" class="dropdown-item">Sepatu Mayoret</a>
              </div>
            </div>
            <div class="nav-item dropdown">
              <a href="#" class="nav-link" data-toggle="dropdown">
                Drumband <i class="fa fa-angle-down float-right mt-1"></i>
              </a>
              <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                <a href="" class="dropdown-item">Seragam Drumband</a>
                <a href="" class="dropdown-item">Topi Drumband</a>
                <a href="" class="dropdown-item">Sepatu Drumband</a>
              </div>
            </div>
            <a href="" class="nav-item nav-link">Aksesoris</a>
            <a href="" class="nav-item nav-link">Lainnya</a>
          </div>
        </nav>
      </div>
      <div class="col-lg-9">
        <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
          <a href="" class="text-decoration-none d-block d-lg-none">
            <h1 class="m-0 display-5 font-weight-semi-bold">
              <span class="text-primary font-weight-bold border px-3 mr-1">8</span>Delafan
            </h1>
          </a>
          <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
            <div class="navbar-nav mr-auto py-0">
              <a href="{{ url('/') }}" class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
              <a href="{{ url('produk') }}"
                class="nav-item nav-link {{ request()->is('produk') ? 'active' : '' }}">Produk</a>
              <a href="{{ url('kontak') }}"
                class="nav-item nav-link {{ request()->is('kontak') ? 'active' : '' }}">Kontak</a>
            </div>
          </div>
        </nav>
        @if (request()->is('/'))
        <div id="header-carousel" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active" style="height: 410px;">
              <img class="img-fluid" src="{{ asset('eshopper/img/carousel-1.jpeg') }}" alt="Image">
              <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                <div class="p-3" style="max-width: 700px;">
                  <h4 class="text-light text-uppercase font-weight-medium mb-3">10% Off Your First
                    Order</h4>
                  <h3 class="display-4 text-white font-weight-semi-bold mb-4">Fashionable Dress</h3>
                  <a href="" class="btn btn-light py-2 px-3">Beli Sekarang</a>
                </div>
              </div>
            </div>
            <div class="carousel-item" style="height: 410px;">
              <img class="img-fluid" src="{{ asset('eshopper/img/carousel-3.jpg') }}" alt="Image">
              <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                <div class="p-3" style="max-width: 700px;">
                  <h4 class="text-light text-uppercase font-weight-medium mb-3">10% Off Your First
                    Order</h4>
                  <h3 class="display-4 text-white font-weight-semi-bold mb-4">Reasonable Price</h3>
                  <a href="" class="btn btn-light py-2 px-3">Beli Sekarang</a>
                </div>
              </div>
            </div>
          </div>
          <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
            <div class="btn btn-dark" style="width: 45px; height: 45px;">
              <span class="carousel-control-prev-icon mb-n2"></span>
            </div>
          </a>
          <a class="carousel-control-next" href="#header-carousel" data-slide="next">
            <div class="btn btn-dark" style="width: 45px; height: 45px;">
              <span class="carousel-control-next-icon mb-n2"></span>
            </div>
          </a>
        </div>
        @endif
      </div>
    </div>
  </div>
  <!-- Navbar End -->

  @yield('content')

  <!-- Footer Start -->
  <div class="container-fluid bg-secondary text-dark mt-5">
    <div class="border-top border-light mx-xl-5 py-4">
      <p class="mb-md-0 text-center text-md-left text-dark">
        &copy; <a class="text-dark font-weight-semi-bold" href="#">Delafan Putri Avon</a>. All Rights Reserved. Designed
        by
        <a class="text-dark font-weight-semi-bold" href="#">Xenrath</a>
      </p>
    </div>
  </div>
  <!-- Footer End -->

  <!-- Back to Top -->
  <a href="#" class="btn btn-primary back-to-top">
    <i class="fa fa-angle-double-up"></i>
  </a>


  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('eshopper/lib/easing/easing.min.js') }}"></script>
  <script src="{{ asset('eshopper/lib/owlcarousel/owl.carousel.min.js') }}"></script>

  <!-- Contact Javascript File -->
  <script src="{{ asset('eshopper/mail/jqBootstrapValidation.min.js') }}"></script>
  <script src="{{ asset('eshopper/mail/contact.js') }}"></script>

  <!-- Template Javascript -->
  <script src="{{ asset('eshopper/js/main.js') }}"></script>
</body>

</html>