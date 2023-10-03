@extends('layouts.admin')

@section('title', 'Tambah Produk')

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
              <a href="{{ url('admin/produk') }}">Produk</a>
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
      @if (session('errors'))
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h5>
            <i class="icon fas fa-ban"></i> Error!
          </h5>
          <ul class="mb-0">
            @foreach (session('errors') as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <form action="{{ url('admin/produk') }}" method="post" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Tambah Produk</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="form-group">
              <label for="kategori_id">Kategori</label>
              <select class="custom-select form-control" id="kategori_id" name="kategori_id" onchange="getKategoriId()">
                <option value="">- Pilih -</option>
                @foreach ($kategoris as $kategori)
                  <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                    {{ $kategori->nama }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="subkategori_id">Sub Kategori</label>
              <select class="custom-select form-control" id="subkategori_id" name="subkategori_id"
                onchange="getJenis(this.value)">
                <option value="" disabled>(pilih kategori terlebih dahulu)</option>
              </select>
            </div>
            <div class="form-group">
              <label for="gambar">Gambar</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="gambar" name="gambar" accept="image/*"
                    multiple>
                  <label class="custom-file-label" for="gambar">
                    Masukan gambar
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </div>
      </form>
    </div>
  </section>
  <script>
    var kategori_id = document.getElementById('kategori_id');
    var subkategori_id = "{{ old('subkategori_id') }}";

    getSubKategori(kategori_id.value);

    function getKategoriId() {
      getSubKategori(kategori_id.value);
    }

    function getSubKategori(kategori_id) {
      if (kategori_id != "") {
        $.ajax({
          url: "{{ url('admin/produk/sub-kategori') }}" + "/" + kategori_id,
          type: "GET",
          dataType: "json",
          success: function(sub_kategori) {
            console.log(sub_kategori);
            $('#subkategori_id').empty();
            $('#subkategori_id').append("<option value=''>- Pilih -</option>");
            $.each(sub_kategori, function(key, value) {
              $('#subkategori_id').append("<option value=" + value.id + ">" + value.nama + "</option>");
            });
            $('#subkategori_id').val(subkategori_id).attr('selected', true);
            getJenis(subkategori_id);
          },
        });
      }
    }
  </script>
@endsection
