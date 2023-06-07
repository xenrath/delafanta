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
      @if (session('error_produks') || session('error_details'))
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h5>
            <i class="icon fas fa-ban"></i> Error!
          </h5>
          @if (session('error_produks'))
            @foreach (session('error_produks') as $error)
              - {{ $error }} <br>
            @endforeach
          @endif
          @if (session('error_details'))
            @foreach (session('error_details') as $error)
              - {{ $error }} <br>
            @endforeach
          @endif
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
              <label>Warna</label>
              <div class="select2-purple">
                <select class="select2" name="warna[]" multiple="multiple" data-placeholder="- Pilih -"
                  data-dropdown-css-class="select2-blue" style="width: 100%;">
                  @foreach ($warnas as $warna)
                    <option value="{{ $warna->id }}"
                      {{ collect(old('warna'))->contains($warna->id) ? 'selected' : '' }}>{{ $warna->nama }}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="gambar">Gambar</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="gambar" name="gambar[]" accept="image/*"
                    multiple>
                  <label class="custom-file-label" for="gambar">
                    @if (old('gambar'))
                      {{ old('gambar') }}
                    @endif
                    Masukan gambar
                  </label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Detail Produk</h3>
            <div class="float-right">
              <button type="button" class="btn btn-primary btn-sm" onclick="addProduk()">
                Tambah
              </button>
            </div>
          </div>
          <div class="card-body">
            <table class="table table-bordered table-striped" id="table-detail" style="display: none">
              <thead>
                <tr>
                  <th class="text-center">No</th>
                  <th id="th-tingkat">Tingkat</th>
                  <th>Ukuran</th>
                  <th>Jumlah Stok</th>
                  <th>Harga Satuan</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody id="tabel-produk">
                <tr id="pesanan-0">
                  <td class="text-center" id="urutan">1</td>
                  <td id="td-tingkat">
                    <div class="form-group">
                      <input type="text" class="form-control" id="tingkat-0" name="tingkat[]">
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <input type="text" class="form-control" id="ukuran-0" name="ukuran[]">
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <input type="text" class="form-control" id="jumlah-0" name="jumlah[]"
                        onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <input type="text" class="form-control" id="harga-0" name="harga[]"
                        onkeypress="return event.charCode >= 48 && event.charCode <= 57" onkeyup="setHarga(0)">
                    </div>
                  </td>
                  <td>
                    <button type="button" class="btn btn-danger" onclick="removePesanan(0)">
                      <i class="fas fa-trash"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
            <p class="p-4 border rounded text-center" id="table-empty">- Pilih Sub Kategori Dahulu -</p>
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

    var table_detail = document.getElementById('table-detail');
    var table_empty = document.getElementById('table-empty');
    var th_tingkat = document.getElementById('th-tingkat');
    var td_tingkat = document.getElementById('td-tingkat');

    function getJenis(subkategori_id) {
      if (subkategori_id != "") {
        table_detail.style.display = '';
        table_empty.style.display = 'none';
        $.ajax({
          url: "{{ url('admin/produk/jenis-ukuran') }}" + "/" + subkategori_id,
          type: "GET",
          dataType: "json",
          success: function(sub_kategori) {
            if (sub_kategori.jenis) {
              console.log('benar');
              th_tingkat.style.display = '';
              td_tingkat.style.display = '';
            } else {
              console.log('salah');
              th_tingkat.style.display = 'none';
              td_tingkat.style.display = 'none';
            }
          },
        });
      } else {
        table_detail.style.display = 'none';
        table_empty.style.display = '';
      }
    }

    var data_produk = @json(session('data_produks'));
    var jumlah_produk = 1;

    if (data_produk != null) {
      jumlah_produk = data_produk.length;
      $('#tabel-produk').empty();
      var urutan = 0;
      $.each(data_produk, function(key, value) {
        urutan = urutan + 1;
        itemProduk(urutan, key, value);
      });
    }

    function addProduk() {
      var subkategori_id = document.getElementById('subkategori_id');
      if (subkategori_id.value != "") {
        jumlah_produk = jumlah_produk + 1;
        if (jumlah_produk == 1) {
          $('#tabel-produk').empty();
        }
        itemProduk(jumlah_produk, jumlah_produk - 1);
      }
    }

    function removePesanan(params) {
      jumlah_produk = jumlah_produk - 1;

      console.log(jumlah_produk);

      var tabel_pesanan = document.getElementById('tabel-produk');
      var pesanan = document.getElementById('pesanan-' + params);

      tabel_pesanan.removeChild(pesanan);

      if (jumlah_produk == 0) {
        var item_pesanan = '<tr>';
        item_pesanan += '<td class="text-center" colspan="6">- Pesanan belum ditambahkan -</td>';
        item_pesanan += '</tr>';
        $('#tabel-produk').append(item_pesanan);
      } else {
        var urutan = document.querySelectorAll('#urutan');
        for (let i = 0; i < urutan.length; i++) {
          urutan[i].innerText = i + 1;
        }
      }
    }

    function itemProduk(urutan, key, value = null) {
      var tingkat = '';
      var ukuran = '';
      var jumlah = '';
      var harga = '';

      if (value !== null) {
        tingkat = value.tingkat;
        ukuran = value.ukuran;
        jumlah = value.jumlah;
        harga = value.harga;
      }

      var item_pesanan = '<tr id="pesanan-' + urutan + '">';
      item_pesanan += '<td class="text-center" id="urutan">' + urutan + '</td>';
      item_pesanan += '<td>';
      item_pesanan += '<div class="form-group">';
      item_pesanan += '<input type="text" class="form-control" id="tingkat-' + key + '" name="tingkat[]" value="' +
        tingkat +
        '">';
      item_pesanan += '</div>';
      item_pesanan += '</td>';
      item_pesanan += '<td>';
      item_pesanan += '<div class="form-group">';
      item_pesanan += '<input type="text" class="form-control" id="ukuran-' + key + '" name="ukuran[]" value="' +
        ukuran + '">';
      item_pesanan += '</div>';
      item_pesanan += '</td>';
      item_pesanan += '<td>';
      item_pesanan += '<div class="form-group">';
      item_pesanan += '<input type="text" class="form-control" id="jumlah-' + key + '" name="jumlah[]" value="' + jumlah +
        '" onkeypress="return event.charCode >= 48 && event.charCode <= 57">';
      item_pesanan += '</div>';
      item_pesanan += '</td>';
      item_pesanan += '<td>';
      item_pesanan += '<div class="form-group">'
      item_pesanan += '<input type="text" class="form-control" id="harga-' + key + '" name="harga[]" value="' + harga +
        '" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onkeyup="setHarga(' + key + ')">';
      item_pesanan += '</div>';
      item_pesanan += '</td>';
      item_pesanan += '<td>';
      item_pesanan += '<button type="button" class="btn btn-danger" onclick="removePesanan(' + urutan + ')">';
      item_pesanan += '<i class="fas fa-trash"></i>';
      item_pesanan += '</button>';
      item_pesanan += '</td>';
      item_pesanan += '</tr>';

      $('#tabel-produk').append(item_pesanan);
    }

    function setHarga(id) {
      var harga = document.getElementById('harga-' + id);
      var number_string = harga.value.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

      if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
      }

      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
      harga.value = rupiah;
    }
  </script>
@endsection
