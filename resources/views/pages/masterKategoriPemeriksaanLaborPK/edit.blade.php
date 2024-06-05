@extends('layouts.backend.main')

@section('content')
<div class="card mb-4">
  <div class="card-header d-flex">
    <div class="col-11 d-flex">
      <h5 class="mb-0">Edit Kategori Pemeriksaan Labor PK</h5>
      {{-- <a href="{{ route('laboratorium/pk/paket/pemeriksaan.create') }}" class="btn btn-sm btn-success mx-2">Tambah Paket Pemeriksaan</a>
      <a href="" class="btn btn-sm btn-success">Tambah Variabel Pemeriksaan</a> --}}
    </div>
    <div class="col-1 text-end">
      <button class="btn btn-sm btn-success" onclick="history.back()">Kembali</button>
    </div>
  </div>
  <div class="card-body">
      <form method="POST" action="{{ route('laboratorium/pk/category/pemeriksaan.update', $item->id) }}">
          @csrf
          @method('PUT')
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Kategori</label>
              <div class="col-sm-10">
              <input type="text" name="name" class="form-control" id="basic-default-name" value="{{ old('name', $item->name) }}" required />
              </div>
          </div>
          <div class="row">
            <div class="col-2"></div>
              <div class="col-10">
                  <button type="submit" class="btn btn-sm btn-success">Simpan</button>
              </div>
          </div>
      </form>
  </div>
</div>
@endsection
