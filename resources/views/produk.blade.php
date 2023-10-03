@extends('layouts.web')

@section('content')
  <!-- Page Header Start -->
  <div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
      <h1 class="font-weight-semi-bold text-uppercase mb-3">Produk Kami</h1>
      <div class="d-inline-flex">
        <p class="m-0">
          <a href="{{ url('/') }}">Home</a>
        </p>
        <p class="m-0 px-2">-</p>
        <p class="m-0">Produk</p>
      </div>
    </div>
  </div>
  <!-- Page Header End -->

  <!-- Shop Start -->
  <div class="container-fluid pt-5">
    <div class="row pb-3">
      <div class="col-12 pb-1">
        <div class="d-flex float-right mb-4">
          <div class="dropdown ml-4">
            <button class="btn border dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              Filter berdasarkan
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
              <a class="dropdown-item" style="cursor: pointer;" onclick="getFilter('populer')">Populer</a>
              <a class="dropdown-item" style="cursor: pointer;" onclick="getFilter('terbaru')">Terbaru</a>
            </div>
          </div>
        </div>
      </div>
      <form action="{{ url()->full() }}" method="get" id="form_filter">
        <input type="hidden" name="filter" id="filter">
      </form>
      @forelse ($produks as $produk)
        <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
          <div class="card product-item border-0 mb-4">
            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
              <img class="img-fluid w-100" src="{{ asset('storage/uploads/' . $produk->gambar) }}" alt="">
            </div>
            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
              <h6 class="text-truncate mb-3">{{ $produk->subkategori->nama }}
                <span class="text-muted">({{ $produk->kode }})</span>
              </h6>
            </div>
            <div class="card-footer text-center bg-light border">
              <a href="{{ url('unduh/' . $produk->kode) }}" class="btn btn-sm text-dark p-0">
                <i class="fas fa-download text-primary mr-1"></i>Unduh Gambar
              </a>
            </div>
          </div>
        </div>
      @empty
        <div class="col-12">
          <p class="text-center bg-light rounded" style="border: 1px solid gray; padding: 100px">- Produk belum
            ditambahkan -</p>
        </div>
      @endforelse
      <div class="col-12 pb-1">
        <nav aria-label="Page navigation">
          <ul class="pagination justify-content-center mb-3">
            <li class="page-item disabled">
              <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
              </a>
            </li>
            <li class="page-item active">
              <a class="page-link" href="#">1</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="#">2</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="#">3</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
  <script>
    function getFilter(params) {
      document.getElementById('filter').value = params;
      document.getElementById('form_filter').submit();
    }
  </script>
  <!-- Shop End -->
@endsection
