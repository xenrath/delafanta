@extends('layouts.admin')

@section('title', 'Ubah Produk')

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
          <li class="breadcrumb-item active">Ubah</li>
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
        <h3 class="card-title">Ubah Produk</h3>
      </div>
      <!-- /.card-header -->
      <form action="{{ url('admin/produk/' . $produk->id) }}" method="post" autocomplete="off"
        enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="card-body">
          <div class="form-group">
            <label for="kategori_id">Kategori</label>
            <select class="custom-select form-control" id="kategori_id" name="kategori_id" onchange="getKategoriId()">
              <option value="">- Pilih -</option>
              @foreach ($kategoris as $kategori)
              <option value="{{ $kategori->id }}" {{ old('kategori_id', $produk->
                subkategori->kategori_id)==$kategori->id ? 'selected' : '' }}>{{
                $kategori->nama }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="subkategori_id">Sub Kategori</label>
            <select class="custom-select form-control" id="subkategori_id" name="subkategori_id">
              <option value="" disabled>(pilih kategori terlebih dahulu)</option>
            </select>
          </div>
          <div class="form-group">
            <label for="jumlah">Jumlah</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Masukan jumlah"
              value="{{ old('jumlah', $produk->jumlah) }}">
          </div>
          <div class="form-group">
            <label for="tingkat">Tingkat</label>
            <select class="custom-select form-control" id="tingkat" name="tingkat">
              <option value="">- Pilih -</option>
              <option value="TK" {{ old('tingkat', $produk->tingkat)=='TK' ? 'selected' : '' }}>TK</option>
              <option value="SD" {{ old('tingkat', $produk->tingkat)=='SD' ? 'selected' : '' }}>SD</option>
              <option value="SMP" {{ old('tingkat', $produk->tingkat)=='SMP' ? 'selected' : '' }}>SMP</option>
              <option value="SMA" {{ old('tingkat', $produk->tingkat)=='SMA' ? 'selected' : '' }}>SMA</option>
            </select>
          </div>
          <div class="form-group">
            <label for="ukuran">Ukuran</label>
            <select class="custom-select form-control" id="ukuran" name="ukuran">
              <option value="">- Pilih -</option>
              <option value="S" {{ old('ukuran', $produk->ukuran)=='S' ? 'selected' : '' }}>S</option>
              <option value="M" {{ old('ukuran', $produk->ukuran)=='M' ? 'selected' : '' }}>M</option>
              <option value="L" {{ old('ukuran', $produk->ukuran)=='L' ? 'selected' : '' }}>L</option>
              <option value="XL" {{ old('ukuran', $produk->ukuran)=='XL' ? 'selected' : '' }}>XL</option>
              <option value="XXL" {{ old('ukuran', $produk->ukuran)=='XXL' ? 'selected' : '' }}>XXL</option>
              <option value="XXXL" {{ old('ukuran', $produk->ukuran)=='XXXL' ? 'selected' : '' }}>XXXL</option>
            </select>
          </div>
          <div class="form-group">
            <label>Warna</label>
            <div class="select2-purple">
              <select class="select2" name="warna[]" multiple="multiple" data-placeholder="- Pilih -"
                data-dropdown-css-class="select2-blue" style="width: 100%;">
                @foreach ($warnas as $warna)
                <option value="{{ $warna->id }}" @foreach (json_decode($produk->warna) as $pw)
                  {{ $pw == $warna->id ? 'selected' : '' }}
                  @endforeach
                  >{{ $warna->nama }}
                </option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="harga">Harga</label>
            <input type="number" class="form-control" id="harga" name="harga" placeholder="Masukan harga"
              value="{{ old('harga', $produk->harga) }}">
          </div>
          <div class="form-group">
            <label for="gambar">Tambah Gambar</label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="gambar" name="gambar[]" accept="image/*" multiple>
                <label class="custom-file-label" for="gambar">
                  @if (old('gambar'))
                  {{ old('gambar') }}
                  @endif
                  Masukan gambar
                </label>
              </div>
            </div>
          </div>
          <p>
            <strong>Gambar</strong>
          </p>
          <div class="row">
            @foreach (json_decode($produk->gambar) as $pg)
            <div class="col-md-4">
              <img src="{{ asset('storage/uploads/' . $pg) }}" alt="{{ $produk->kode }}" class="w-100 rounded">
            </div>
            @endforeach
          </div>
        </div>
        <div class="card-footer text-right">
          <button type="reset" class="btn btn-secondary">Reset</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</section>
<script>
  var kategori_id = document.getElementById('kategori_id');
  var subkategori_id = "{{ old('subkategori_id') }}";

  console.log(subkategori_id);

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
          $('#subkategori_id').empty();
          $('#subkategori_id').append("<option value=''>- Pilih -</option>");
          $.each(sub_kategori, function(key, value) {
            $('#subkategori_id').append("<option value=" + value.id + ">" + value.nama + "</option>");
            if (value.id == "{{ $produk->subkategori_id }}") {
              $('#subkategori_id').val("{{ $produk->subkategori_id }}").attr('selected', true);
            }
          });
        },
      });
    }
  }
</script>
@endsection