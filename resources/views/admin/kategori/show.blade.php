@extends('layouts.admin')

@section('title', 'Lihat Kategori')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Kategori</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item">
            <a href="{{ url('admin/user') }}">Kategori</a>
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
        <h3 class="card-title">Lihat Kategori</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
          <div class="col-lg-8">
            <table class="table">
              <tr>
                <th>Kode</th>
                <td>:</td>
                <td>{{ $user->kode }}</td>
              </tr>
              <tr>
                <th>Nama Kategori</th>
                <td>:</td>
                <td>{{ $user->nama }}</td>
              </tr>
              <tr>
                <th>No. Telepon</th>
                <td>:</td>
                <td>
                  @if ($user->telp)
                  +62{{ $user->telp }}
                  @endif
                </td>
              </tr>
              <tr>
                <th>Alamat</th>
                <td>:</td>
                <td>{{ $user->alamat }}</td>
              </tr>
              <tr>
                <th>Role</th>
                <td>:</td>
                <td>{{ ucfirst($user->role) }}</td>
              </tr>
              @if ($user->layanan_id)
              <tr>
                <th>Kategori</th>
                <td>:</td>
                <td>{{ $user->layanan->layanan }}</td>
              </tr>
              @endif
            </table>
          </div>
          <div class="col-lg-4">
            @if ($user->foto)
            <img src="{{ asset('storage/uploads/' . $user->foto) }}" alt="{{ $user->nama }}" class="w-100 rounded">
            @else
            <img src="{{ asset('storage/uploads/image-placeholder.jpg') }}" alt="{{ $user->nama }}"
              class="w-100 rounded">
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection