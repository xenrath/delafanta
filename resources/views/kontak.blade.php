@extends('layouts.web')

@section('content')
<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
  <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
    <h1 class="font-weight-semi-bold text-uppercase mb-3">Kontak</h1>
    <div class="d-inline-flex">
      <p class="m-0">
        <a href="{{ url('/') }}">Home</a>
      </p>
      <p class="m-0 px-2">-</p>
      <p class="m-0">Kontak</p>
    </div>
  </div>
</div>
<!-- Page Header End -->

<div class="container-fluid pt-5">
  {{-- <div class="text-center mb-4">
    <h2 class="section-title px-5">
      <span class="px-2">Cara Pemesanan</span>
    </h2>
  </div> --}}
  <div class="text-center mb-4">
    <h2 class="section-title px-5">
      <span class="px-2">Informasi Toko</span>
    </h2>
  </div>
  <div class="row px-xl-5">
    <div class="col-lg-5 mb-4">
      <h5 class="font-weight-semi-bold mb-3">Tentang Kami</h5>
      <p style="text-align: justify">
        <strong>Delafan Putri Avon</strong> merupakan sebuah toko yang menjual berbagai macam produk mayoret dan
        drumband yang meliputi seragam, sepatu dan topi. Serta produk lainnya seperti baju wisuda, topi toga dan sepatu
        kulit.
      </p>
      <div class="d-flex flex-column mb-3">
        <h5 class="font-weight-semi-bold mb-3">Info Toko</h5>
        <table>
          <tr>
            <td width="24px">
              <i class="fa fa-map-marker-alt text-primary"></i>
            </td>
            <th>Alamat</th>
          </tr>
          <tr>
            <td width="24px"></td>
            <td>
              RT.02/RW.03, Jetis, Pepedan, Kec. Dukuhturi, Kabupaten
              Tegal, Jawa Tengah 52192
            </td>
          </tr>
          <tr>
            <td width="24px">
              <i class="fa fa-phone-alt text-primary"></i>
            </td>
            <th>WhatsApp</th>
          </tr>
          <tr>
            <td width="24px"></td>
            <td>
              <a href="{{ url('hubungi') }}" class="btn btn-success mt-1" target="_blank">
                <i class="fab fa-whatsapp"></i> Hubungi
              </a>
            </td>
          </tr>
        </table>
      </div>
    </div>
    <div class="col-lg-7 mb-4">
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d401.4113804426078!2d109.1317604129893!3d-6.90318499591098!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6fb9d2df5642c5%3A0xee8a34c8be9ac02!2sDelafanta%20Putri%20Avon!5e0!3m2!1sid!2sid!4v1681680798012!5m2!1sid!2sid"
        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
  </div>
</div>
<!-- Contact End -->

@endsection