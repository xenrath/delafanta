@extends('layouts.admin')

@section('title', 'Sub Kategori')

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
            <li class="breadcrumb-item active">Sub Kategori</li>
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
          <h3 class="card-title">Data Sub Kategori</h3>
          <div class="float-right">
            <a href="{{ url('admin/sub-kategori/create') }}" class="btn btn-primary btn-sm">
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
                  <th class="text-center" style="width: 20px">No</th>
                  <th>Kategori</th>
                  <th>Nama</th>
                  <th>Jenis Ukuran</th>
                  <th>Slug</th>
                  <th class="text-center" style="width: 80px">Opsi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($sub_kategoris as $sub_kategori)
                  <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $sub_kategori->kategori->nama }}</td>
                    <td>{{ $sub_kategori->nama }}</td>
                    <td>
                      @if ($sub_kategori->jenis)
                        Berdasarkan tingkat
                      @else
                        Tidak berdasarkan tingkat
                      @endif
                    </td>
                    <td>{{ $sub_kategori->slug }}</td>
                    <td class="text-center">
                      <a href="{{ url('admin/sub-kategori/' . $sub_kategori->id . '/edit') }}" class="btn btn-warning">
                        <i class="fas fa-pencil-alt"></i>
                      </a>
                      <button type="submit" class="btn btn-danger" data-toggle="modal"
                        data-target="#modal-hapus-{{ $sub_kategori->id }}">
                        <i class="fas fa-trash"></i>
                      </button>
                    </td>
                  </tr>
                  <div class="modal fade" id="modal-hapus-{{ $sub_kategori->id }}">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Hapus Sub Kategori</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p>Yakin hapus user <strong>{{ $sub_kategori->nama }}</strong>?</p>
                        </div>
                        <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                          <form action="{{ url('admin/sub-kategori/' . $sub_kategori->id) }}" method="POST">
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
