@extends('layouts.backend.main')

@section('content')

<div class="card mb-4">
  <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0">Tambah Jasa Operasi</h5>
  </div>
  <div class="card-body">
      <form method="POST" action="{{ route('surgery/category.update', $item->id) }}">
            @csrf
            @method('PUT')
          <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Jasa Operasi</label>
              <div class="col-sm-10">
                  <input type="text" name="name" class="form-control" value="{{ $item->name }}" id="basic-default-name" required />
              </div>
          </div>
          <div class="row justify-content-end">
              <div class="col-sm-10">
                  <button type="submit" class="btn btn-sm btn-dark">Simpan</button>
              </div>
          </div>
      </form>
  </div>
</div>
@endsection