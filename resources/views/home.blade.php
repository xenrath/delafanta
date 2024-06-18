@extends('layouts.web')

@section('content')
    <!-- Promosi -->
    {{-- <div class="container-fluid pt-5">
  <div class="row px-xl-5 pb-3">
    <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
      <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
        <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
        <h5 class="font-weight-semi-bold m-0">Kualias Bagus</h5>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
      <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
        <h1 class="fas fa-money-bill text-primary m-0 mr-2"></h1>
        <h5 class="font-weight-semi-bold m-0">Harga Terjangkau</h5>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
      <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
        <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
        <h5 class="font-weight-semi-bold m-0">Banyak Varian Ukuran</h5>
      </div>
    </div>
  </div>
</div> --}}

    <!-- Kategori -->
    {{-- <div class="container-fluid pt-5">
  <div class="row px-xl-5 pb-3">
    <div class="col-lg-4 col-md-6 pb-1">
      <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
        <p class="text-right">15 Produk</p>
        <a href="" class="cat-img position-relative overflow-hidden mb-3">
          <img class="img-fluid" src="{{ asset('storage/uploads/image-placeholder.jpg') }}" alt="">
        </a>
        <h5 class="font-weight-semi-bold m-0">Mayoret</h5>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 pb-1">
      <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
        <p class="text-right">15 Produk</p>
        <a href="" class="cat-img position-relative overflow-hidden mb-3">
          <img class="img-fluid" src="{{ asset('storage/uploads/image-placeholder.jpg') }}" alt="">
        </a>
        <h5 class="font-weight-semi-bold m-0">Drumband</h5>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 pb-1">
      <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
        <p class="text-right">15 Produk</p>
        <a href="" class="cat-img position-relative overflow-hidden mb-3">
          <img class="img-fluid" src="{{ asset('storage/uploads/image-placeholder.jpg') }}" alt="">
        </a>
        <h5 class="font-weight-semi-bold m-0">Sepatu Kulit</h5>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 pb-1">
      <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
        <p class="text-right">15 Produk</p>
        <a href="" class="cat-img position-relative overflow-hidden mb-3">
          <img class="img-fluid" src="{{ asset('storage/uploads/image-placeholder.jpg') }}" alt="">
        </a>
        <h5 class="font-weight-semi-bold m-0">Aksesoris</h5>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 pb-1">
      <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
        <p class="text-right">15 Produk</p>
        <a href="" class="cat-img position-relative overflow-hidden mb-3">
          <img class="img-fluid" src="{{ asset('storage/uploads/image-placeholder.jpg') }}" alt="">
        </a>
        <h5 class="font-weight-semi-bold m-0">Lainnya</h5>
      </div>
    </div>
  </div>
</div> --}}

    <!-- Informasi -->
    <div class="container-fluid bg-secondary my-5">
        <div class="row justify-content-md-center py-5 px-xl-5">
            <div class="col-md-6 col-12 py-5">
                <div class="text-center mb-2 pb-2">
                    <h2 class="section-title px-5 mb-3">
                        <span class="bg-secondary px-2">Informasi</span>
                    </h2>
                    <p>Untuk informasi lebih lanjut terkait lokasi toko dan cara pemesanan produk dapat dilihat pada halaman
                        Kontak
                        Saya</p>
                </div>
                <div class="text-center">
                    <a href="{{ url('kontak') }}" class="btn btn-outline-primary py-md-2 px-md-3">Kontak Saya</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Start -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5">
                <span class="px-2">Produk Terbaru</span>
            </h2>
        </div>
        <div class="row px-xl-5 pb-3">
            @forelse ($produks as $produk)
                <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                    <div class="card product-item border-0 mb-4">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <img class="img-fluid w-100" src="{{ asset('storage/uploads/' . $produk->gambar) }}"
                                alt="">
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3">{{ $produk->subkategori_nama }}</h6>
                            <div class="d-flex justify-content-center">
                                <h6 class="text-muted">{{ $produk->kode }}</h6>
                            </div>
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
                    <p class="p-5 text-center bg-light rounded" style="border: 1px solid gray">- Produk belum ditambahkan -
                    </p>
                </div>
            @endforelse
        </div>
    </div>
    <!-- Products End -->
@endsection
