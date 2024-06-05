@extends('layouts.backend.main')

@section('content')
<div class="card mb-4">
  <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0">Edit Supplier</h5>
  </div>
  <div class="card-body">
      <form method="POST" action="{{ route('farmasi/supplier.update', $item->id) }}">
          @csrf
          @method('PUT')
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Supplier</label>
              <div class="col-sm-10">
                  <input type="text" value="{{ old('name', $item->name) }}" name="name" class="form-control" id="basic-default-name" required />
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Kontak Supplier</label>
                <div class="col-sm-10">
                    <input type="number" name="telp" class="form-control" id="telp" min="0" value="{{ old('telp', $item->telp) }}" required />
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Contact Person Name</label>
                <div class="col-sm-10">
                    <input type="text" name="contact_person_name" class="form-control" value="{{ old('contact_person_name', $item->contact_person_name) }}" required />
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Contact Person Phone</label>
                <div class="col-sm-10">
                    <input type="number" name="contact_person_phone" class="form-control" min="0" value="{{ old('contact_person_phone', $item->contact_person_phone) }}" required />
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">NPWP</label>
                <div class="col-sm-10">
                    <input type="number" name="npwp" class="form-control" min="0" value="{{ old('npwp', $item->npwp) }}" required />
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">No Izin</label>
                <div class="col-sm-10">
                    <input type="number" name="no_izin" class="form-control" min="0" value="{{ old('no_izin', $item->no_izin) }}" required />
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Alamat</label>
                <div class="col-sm-10">
                  <textarea class="form-control" name="alamat" rows="3">{{ old('alamat', $item->alamat) }}</textarea>
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