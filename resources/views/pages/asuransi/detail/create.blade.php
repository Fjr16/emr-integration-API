@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
@endif

<div class="card mb-4">
  <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0">Tambah Detail Lampiran Asuransi</h5>
  </div>
  <div class="card-body">
      <form method="POST" action="{{ route('asuransi/detail.store', $item->id) }}">
          @csrf
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Jenis Rawatan</label>
              <div class="col-sm-10">
                <select class="form-select" name="category" aria-label="Default select example">
                    <option value="Rawat Jalan">Rawat Jalan</option>
                    <option value="Rawat Inap">Rawat Inap</option>
                </select>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Pasien</label>
              <div class="col-sm-10">
                  <input type="text" name="name" class="form-control" id="basic-default-name" required />
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Tanggal Masuk</label>
              <div class="col-sm-10">
                  <input type="date" name="masuk" class="form-control" id="basic-default-name" required />
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Tanggal Keluar</label>
              <div class="col-sm-10">
                  <input type="date" name="keluar" class="form-control" id="basic-default-name" required />
              </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Total</label>
                <div class="col-sm-10">
                    <input type="number" name="total" class="form-control" id="basic-default-name" required />
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