@extends('layouts.backend.main')

@section('content')
<div class="card mb-4">
  <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0">Edit Diagnosa</h5>
  </div>
  <div class="card-body">
      <form method="POST" action="{{ route('diagnosa.update', $item->id) }}">
        @method('PUT')
          @csrf
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Diagnosa</label>
              <div class="col-sm-10">
                  <input type="text" name="name" class="form-control" id="basic-default-name" value="{{ old('name', $item->name) }}" required />
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Kode ICD</label>
              <div class="col-sm-10">
                <input type="text" name="icd_x_code" class="form-control" id="basic-default-name" value="{{ old('icd_x_code', $item->icd_x_code) }}" required />
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