@extends('layouts.backend.main')

@section('content')
<div class="card mb-4">
  <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0">Tambah Tindakan</h5>
  </div>
  <div class="card-body">
      <form method="POST" action="{{ route('pasien/category.update', $item->id) }}">
          @csrf
          @method('PUT')
          <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Kategori Pasien</label>
              <div class="col-sm-10">
                  <input type="text" value="{{ $item->name }}" name="name" class="form-control" id="basic-default-name" required />
              </div>
          </div>
          <div class="row mb-4">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Setting Margin (%)</label>
            <div class="col-sm-1">
                <input type="number" oninput="this.value=this.value.slice(0,3)" name="margin" class="form-control" id="basic-default-name" value="{{ $item->margin ?? 0 }}" required />
            </div>
            <div class="col-1 mt-2">%</div>
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