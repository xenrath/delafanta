@extends('layouts.admin')

@section('title', 'Tambah Sub Kategori')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Sub Kategori</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
              <a href="{{ url('admin/sub-kategori') }}">Sub Kategori</a>
            </li>
            <li class="breadcrumb-item active">Tambah</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <section class="content">
    <div class="container-fluid">
      @if (session('error'))
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h5>
            <i class="icon fas fa-ban"></i> Error!
          </h5>
          @foreach (session('error') as $error)
            - {{ $error }} <br>
          @endforeach
        </div>
      @endif
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Tambah Sub Kategori</h3>
        </div>
        <!-- /.card-header -->
        <form action="{{ url('admin/sub-kategori') }}" method="post" autocomplete="off">
          @csrf
          <div class="card-body">
            <div class="form-group">
              <label for="kategori_id">Kategori</label>
              <select class="custom-select form-control" id="kategori_id" name="kategori_id">
                <option value="">- Pilih -</option>
                @foreach ($kategoris as $kategori)
                  <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                    {{ $kategori->nama }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="nama">Nama Sub Kategori</label>
              <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan nama kategori"
                value="{{ old('nama') }}">
            </div>
            <div class="form-group">
              <label for="jenis">Jenis Ukuran</label>
              <select class="custom-select form-control" id="jenis" name="jenis">
                <option value="">- Pilih -</option>
                <option value="1" {{ old('jenis') == '1' ? 'selected' : '' }}>Berdasarkan tingkat</option>
                <option value="0" {{ old('jenis') == '0' ? 'selected' : '' }}>Tidak berdasarkan tingkat</option>
              </select>
            </div>
          </div>
          <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </section>
@endsection
