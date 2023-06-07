@extends('layouts.admin')

@section('title', 'Lihat Produk')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Produk</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
              <a href="{{ url('admin/user') }}">Produk</a>
            </li>
            <li class="breadcrumb-item active">Lihat</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Lihat Produk</h3>
          <div class="float-right">
            <strong>{{ $produk->kode }}</strong>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <h4>
            {{ $produk->subkategori->nama }}
            @php
              $w = [];
            @endphp
            @foreach (json_decode($produk->warna) as $key => $warna)
              @php
                $warna = App\Models\Warna::where('id', $warna)->first();
                array_push($w, $warna->nama);
              @endphp
            @endforeach
            ({{ implode(', ', array_values($w)) }})
          </h4>
          <hr>
          <div class="table-responsive">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th class="text-center" style="width: 24px">No</th>
                  <th>Ukuran</th>
                  <th>Jumlah</th>
                  <th>Harga</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($produk->detail_produks as $detail_produk)
                  <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $detail_produk->tingkat }} ({{ $detail_produk->ukuran }})</td>
                    <td>{{ $detail_produk->jumlah }}</td>
                    <td>Rp{{ $detail_produk->harga }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="row">
            @foreach (json_decode($produk->gambar) as $key => $gambar)
              <div class="col-lg-3 mb-3">
                <a href="#modal-lihat-{{ $key }}" data-toggle="modal">
                  <img src="{{ asset('storage/uploads/' . $gambar) }}" alt="{{ $produk->nama }}" class="w-100 rounded"
                    onclick="showModal($key)">
                </a>
              </div>
              <div class="modal fade" id="modal-lihat-{{ $key }}">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Gambar Produk</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <img src="{{ asset('storage/uploads/' . $gambar) }}" alt="{{ $produk->nama }}"
                        class="w-100 rounded">
                    </div>
                    <div class="modal-footer text-end">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                      <form action="{{ url('admin/produk/unduh/' . $produk->id) }}" method="post">
                        @csrf
                        <input type="hidden" class="form-control" name="key" value="{{ $key }}">
                        <button type="submit" href="{{ url('admin/produk/') }}" class="btn btn-primary">Unduh</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
