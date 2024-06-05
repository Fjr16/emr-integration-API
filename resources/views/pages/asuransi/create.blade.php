@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
@endif

<div class="card mb-4">
  <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0">Tambah Asuransi</h5>
  </div>
  <div class="card-body">
      <form method="POST" action="{{ route('asuransi.store') }}">
          @csrf
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">No Surat</label>
              <div class="col-sm-10">
                  <input type="text" name="no" class="form-control" id="basic-default-name" required />
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Lamp</label>
              <div class="col-sm-10">
                  <input type="text" name="lamp" class="form-control" id="basic-default-name" required />
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Hal</label>
              <div class="col-sm-10">
                  <input type="text" name="hal" class="form-control" id="basic-default-name" required />
              </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Asuransi</label>
                <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" id="basic-default-name" required />
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">periode</label>
                <div class="col-sm-10">
                    <input type="text" name="periode" class="form-control" id="basic-default-name" required />
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