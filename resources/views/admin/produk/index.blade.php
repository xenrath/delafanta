@extends('layouts.admin')

@section('title', 'Produk')

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
            <li class="breadcrumb-item active">Produk</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      @if (session('success'))
        <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h5>
            <i class="icon fas fa-check"></i> Success!
          </h5>
          {{ session('success') }}
        </div>
      @endif
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Data Produk</h3>
          <div class="float-right">
            <a href="{{ url('admin/produk/create') }}" class="btn btn-primary btn-sm">
              <i class="fas fa-plus"></i> Tambah
            </a>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th class="text-center" style="width: 24px">No</th>
                  <th>Kode Produk</th>
                  <th>Kategori</th>
                  <th>Warna</th>
                  <th width="160px">Gambar</th>
                  <th class="text-center" style="width: 120px">Opsi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($produks as $produk)
                  <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $produk->kode }}</td>
                    <td>{{ $produk->subkategori->nama }}</td>
                    <td>
                      @foreach ($produk->warna as $key => $warna)
                        @php
                          $warna = App\Models\Warna::where('id', $warna)->first();
                          $comma = $key + 1 != count($produk->warna) ? ',' : '';
                        @endphp
                        {{ $warna->nama . $comma }}
                      @endforeach
                    </td>
                    <td>
                      @if (count($produk->gambar) > 0)
                        <img src="{{ asset('storage/uploads/' . $produk->gambar[0]) }}" alt="{{ $produk->kode }}"
                          class="w-100 rounded">
                      @else
                        <p>
                          <code>tidak ada gambar</code>
                        </p>
                      @endif
                    </td>
                    <td class="text-center">
                      <a href="{{ url('admin/produk/' . $produk->id) }}" class="btn btn-info">
                        <i class="fas fa-eye"></i>
                      </a>
                      <a href="{{ url('admin/produk/' . $produk->id . '/edit') }}" class="btn btn-warning">
                        <i class="fas fa-pencil-alt"></i>
                      </a>
                      <button type="submit" class="btn btn-danger" data-toggle="modal"
                        data-target="#modal-hapus-{{ $produk->id }}">
                        <i class="fas fa-trash"></i>
                      </button>
                    </td>
                  </tr>
                  <div class="modal fade" id="modal-hapus-{{ $produk->id }}">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Hapus Produk</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p>Yakin hapus user <strong>{{ $produk->nama }}</strong>?</p>
                        </div>
                        <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                          <form action="{{ url('admin/produk/' . $produk->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
    </div>
  </section>
  <!-- /.card -->
@endsection
