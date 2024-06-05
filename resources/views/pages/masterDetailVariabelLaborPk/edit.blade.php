@extends('layouts.backend.main')

@section('content')
<div class="card mb-4">
  <div class="card-header d-flex">
    <div class="col-11 d-flex">
      <h5 class="mb-0">Edit Master Kondisi Normal Labor PK</h5>
    </div>
    <div class="col-1 text-end">
      <button class="btn btn-sm btn-success" onclick="history.back()">Kembali</button>
    </div>
  </div>
  <div class="card-body">
      <form method="POST" action="{{ route('laboratorium/pk/kondisi/normal/variabel.update', $item->id) }}">
          @csrf
          @method('PUT')
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Kategori</label>
              <div class="col-sm-10">
              <input type="text" name="name" class="form-control" id="basic-default-name" value="{{ old('name', $item->name) }}"/>
              </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Alias</label>
              <div class="col-sm-10">
              <input type="text" name="alias" class="form-control" id="basic-default-name" value="{{ old('alias', $item->alias) }}"/>
              </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Nilai Kondisi Normal</label>
              <div class="col-sm-3">
                <input type="number" name="from" class="form-control" id="basic-default-name" value="{{ old('from', $item->from) }}" required />
              </div>
              <div class="col-sm-1"><small>SAMPAI</small></div>
              <div class="col-sm-3">
                <input type="number" name="to" class="form-control" id="basic-default-name" value="{{ old('to', $item->to) }}" required />
              </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Satuan</label>
              <div class="col-sm-10">
              <input type="text" name="unit" class="form-control" id="basic-default-name" value="{{ old('unit', $item->unit) }}" required />
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