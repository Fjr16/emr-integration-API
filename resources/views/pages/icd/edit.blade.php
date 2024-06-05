@extends('layouts.backend.main')

@section('content')
<div class="card mb-4">
  <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0">Edit ICD</h5>
  </div>
  <div class="card-body">
      <form method="POST" action="{{ route('icd.update', $item->id) }}">
          @csrf
          @method('PUT')
          <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Kode ICD</label>
              <div class="col-sm-10">
                  <input type="text" value="{{ old('kode', $item->kode) }}" name="kode" class="form-control" id="basic-default-name" required />
              </div>
          </div>
          <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Nama ICD</label>
              <div class="col-sm-10">
                  <input type="text" value="{{ old('name', $item->name) }}" name="name" class="form-control" id="basic-default-name" required />
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