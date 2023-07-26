@extends('layouts.admin')

@section('title', 'Buat Pesanan')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Pesanan</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
              <a href="{{ url('admin/ukuran') }}">Pesanan</a>
            </li>
            <li class="breadcrumb-item active">Buat</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <section class="content">
    <div class="container-fluid">
      @if (session('error_pelanggans') || session('error_pesanans'))
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h5>
            <i class="icon fas fa-ban"></i> Error!
          </h5>
          @if (session('error_pelanggans'))
            @foreach (session('error_pelanggans') as $error)
              - {{ $error }} <br>
            @endforeach
          @endif
          @if (session('error_pesanans'))
            @foreach (session('error_pesanans') as $error)
              - {{ $error }} <br>
            @endforeach
          @endif
        </div>
      @endif
      <form action="{{ url('admin/pesanan') }}" method="post" autocomplete="off">
        @csrf
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Detail Pelanggan</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="form-group">
              <label for="nama_pelanggan">Nama Pelanggan</label>
              <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan"
                placeholder="Masukan nama pelanggan" value="{{ old('nama_pelanggan') }}">
            </div>
            <div class="form-group">
              <label for="telp_pelanggan">Nomor Telepon</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">+62</span>
                </div>
                <input type="text" class="form-control" id="telp_pelanggan" name="telp_pelanggan"
                  placeholder="Masukan nomor telepon" value="{{ old('telp_pelanggan') }}">
              </div>
            </div>
            <div class="form-group">
              <label for="asal_pelanggan">Asal</label>
              <input type="text" class="form-control" id="asal_pelanggan" name="asal_pelanggan"
                placeholder="Alamat / Sekolah" value="{{ old('asal_pelanggan') }}">
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Detail Pesanan</h3>
            <div class="float-right">
              <button type="button" class="btn btn-primary btn-sm" onclick="addPesanan()">
                Tambah
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th class="text-center">No</th>
                  <th>Nama Produk</th>
                  <th>Harga</th>
                  <th>Jumlah</th>
                  <th>Total</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody id="tabel-pesanan">
                <tr id="pesanan-0">
                  <td class="text-center" id="urutan">1</td>
                  <td>
                    <div class="form-group">
                      <input type="text" class="form-control" id="produk-0" name="produk[]">
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <input type="text" class="form-control" id="harga-0" name="harga[]" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onkeyup="getTotal(0)">
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <input type="text" class="form-control" id="jumlah-0" name="jumlah[]" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onkeyup="getTotal(0)">
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <input type="text" class="form-control" id="total-0" name="total[]" readonly>
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
          </div>
          <div class="card-footer text-right">
            <button type="reset" class="btn btn-secondary">Reset</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </div>
      </form>
    </div>
  </section>
  <script>
    function getTotal(id) {
      var harga = document.getElementById('harga-' + id);
      var jumlah = document.getElementById('jumlah-' + id);
      var total = document.getElementById('total-' + id);

      if (harga.value != "" && jumlah.value != "") {
        var h = harga.value.split('.').join('');
        var j = jumlah.value.split('.').join('');
        total.value =  h * j;
      } else {
        total.value = "";
      }

      setRupiah(harga);
      setRupiah(jumlah);
      setRupiah(total);
    }

    var data_pesanan = @json(session('data_pesanans'));
    var jumlah_pesanan = 1;

    if (data_pesanan != null) {
      jumlah_pesanan = data_pesanan.length;
      $('#tabel-pesanan').empty();
      var urutan = 0;
      $.each(data_pesanan, function(key, value) {
        urutan = urutan + 1;
        itemPesanan(urutan, key, value);
      });
    }

    function addPesanan() {
      jumlah_pesanan = jumlah_pesanan + 1;

      if (jumlah_pesanan == 1) {
        $('#tabel-pesanan').empty();
      }

      itemPesanan(jumlah_pesanan, jumlah_pesanan - 1);
    }

    function removePesanan(params) {
      jumlah_pesanan = jumlah_pesanan - 1;

      console.log(jumlah_pesanan);

      var tabel_pesanan = document.getElementById('tabel-pesanan');
      var pesanan = document.getElementById('pesanan-' + params);

      tabel_pesanan.removeChild(pesanan);

      if (jumlah_pesanan == 0) {
        var item_pesanan = '<tr>';
        item_pesanan += '<td class="text-center" colspan="6">- Pesanan belum ditambahkan -</td>';
        item_pesanan += '</tr>';
        $('#tabel-pesanan').append(item_pesanan);
      } else {
        var urutan = document.querySelectorAll('#urutan');
        for (let i = 0; i < urutan.length; i++) {
          urutan[i].innerText = i + 1;
        }
      }
    }

    function itemPesanan(urutan, key, value = null) {
      var produk = '';
      var harga = '';
      var jumlah = '';
      var total = '';

      if (value !== null) {
        produk = value.produk;
        harga = value.harga;
        jumlah = value.jumlah;
        total = value.total;
      }

      var item_pesanan = '<tr id="pesanan-' + urutan + '">';
      item_pesanan += '<td class="text-center" id="urutan">' + urutan + '</td>';
      item_pesanan += '<td>';
      item_pesanan += '<div class="form-group">';
      item_pesanan += '<input type="text" class="form-control" id="produk-' + key + '" name="produk[]" value="' + produk +
        '">';
      item_pesanan += '</div>';
      item_pesanan += '</td>';
      item_pesanan += '<td>';
      item_pesanan += '<div class="form-group">';
      item_pesanan += '<input type="text" class="form-control" id="harga-' + key + '" name="harga[]" value="' + harga +
        '" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onkeyup="getTotal(' + key + ')">';
      item_pesanan += '</div>';
      item_pesanan += '</td>';
      item_pesanan += '<td>';
      item_pesanan += '<div class="form-group">';
      item_pesanan += '<input type="text" class="form-control" id="jumlah-' + key + '" name="jumlah[]" value="' +
        jumlah + '" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onkeyup="getTotal(' + key + ')">';
      item_pesanan += '</div>';
      item_pesanan += '</td>'
      item_pesanan += '<td>';
      item_pesanan += '<div class="form-group">'
      item_pesanan += '<input type="text" class="form-control" id="total-' + key + '" name="total[]" value="' + total +
        '" readonly>';
      item_pesanan += '</div>';
      item_pesanan += '</td>';
      item_pesanan += '<td>';
      item_pesanan += '<button type="button" class="btn btn-danger" onclick="removePesanan(' + urutan + ')">';
      item_pesanan += '<i class="fas fa-trash"></i>';
      item_pesanan += '</button>';
      item_pesanan += '</td>';
      item_pesanan += '</tr>';

      $('#tabel-pesanan').append(item_pesanan);
    }

    function setRupiah(params) {
      var number_string = params.value.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

      if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
      }

      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
      params.value = rupiah;
    }
  </script>
@endsection
