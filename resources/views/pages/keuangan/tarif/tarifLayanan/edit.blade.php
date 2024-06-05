@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
@endif

<div class="card mb-4">
  <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0">Edit Tarif</h5>
  </div>
  <div class="card-body">
      <form method="POST" action="{{ route('tarif/layanan.update', $item->id) }}">
        @method('PUT')
          @csrf
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Type</label>
              <div class="col-sm-10">
                  <input type="text" name="type" value="{{ $item->type }}" class="form-control" id="basic-default-name" required />
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Category</label>
              <div class="col-sm-10">
                  <input type="text" name="category" value="{{ $item->category }}" class="form-control" id="basic-default-name" required />
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Layanan</label>
              <div class="col-sm-10">
                  <input type="text" name="layanan" value="{{ $item->layanan }}" class="form-control" id="basic-default-name" required />
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Tarif</label>
              <div class="col-sm-10">
                  <input type="number" value="{{ $item->tarif }}" name="tarif" class="form-control" id="basic-default-name" required />
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