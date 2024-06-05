@extends('layouts.backend.main')

@section('content')
<div class="card mb-4">
  <div class="card-header d-flex">
    <div class="col-11 d-flex">
      <h5 class="mb-0">Edit Tipe Pemeriksaan Labor PK</h5>
    </div>
    <div class="col-1 text-end">
      <button class="btn btn-sm btn-success" onclick="history.back()">Kembali</button>
    </div>
  </div>
  <div class="card-body">
      <form method="POST" action="{{ route('laboratorium/pk/tipe/permintaan.update', $item->id) }}">
          @csrf
          @method('PUT')
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Tipe</label>
              <div class="col-sm-10">
              <input type="text" name="name" class="form-control" id="basic-default-name" value="{{ old('name', $item->name) }}" required />
              </div>
          </div>
          <div class="row mb-3">
            <div class="col-sm-2"></div>
            <div class="col-sm-10 d-flex">
              <div class="form-check">
                <input class="form-check-input" type="radio" value="0" name="isPrioritas" id="flexRadioDefault1" {{ !$item->isPrioritas ? 'checked' : '' }}>
                <label class="form-check-label" for="flexRadioDefault1">
                  Non Prioritas (Reguler)
                </label>
              </div>
              <div class="form-check mx-4">
                <input class="form-check-input" type="radio" value="1" name="isPrioritas" id="flexRadioDefault2" {{ $item->isPrioritas ? 'checked' : '' }}>
                <label class="form-check-label" for="flexRadioDefault2">
                  Prioritas (Cito)
                </label>
              </div>
            </div>
        </div>
          <div class="row">
              <div class="col-sm-2"></div>
              <div class="col-sm-10">
                  <button type="submit" class="btn btn-sm btn-success">Simpan</button>
              </div>
          </div>
      </form>
  </div>
</div>
@endsection