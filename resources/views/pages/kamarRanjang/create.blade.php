@extends('layouts.backend.main')

@section('content')
<div class="card mb-4">
  <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0">Tambah Ranjang</h5>
  </div>
  <div class="card-body">
      <form method="POST" action="{{ route('kamar/ranjang.store') }}">
          @csrf
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Nama</label>
              <div class="col-sm-10">
                  <input type="text" name="name" class="form-control" id="basic-default-name" value="{{ old('name') }}" required />
              </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Tipe Ranjang</label>
                <div class="col-sm-10">
                    <select class="form-select" id="exampleFormControlSelect1"
                        aria-label="Default select example" name="bedroom_type_id">
                        <option selected disabled>Pilih</option>
                        @foreach ($types as $type)
                            @if (old('bedroom_type_id') == $type->id)
                                <option value="{{ $type->id }}" selected>{{ $type->name }}</option>
                            @else
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Kamar</label>
                <div class="col-sm-10">
                    <select class="form-select" id="exampleFormControlSelect1"
                        aria-label="Default select example" name="bedroom_id">
                        <option selected disabled>Pilih</option>
                        @foreach ($bedrooms as $bedroom)
                            @if (old('bedroom_id') == $bedroom->id)
                                <option value="{{ $bedroom->id }}" selected>{{ $bedroom->name }}-{{ $bedroom->floor->name }}</option>
                            @else
                                <option value="{{ $bedroom->id }}">{{ $bedroom->name }}-{{ $bedroom->floor->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="isAvailable">Tersedia</label>
                <div class="col-sm-10">
                    <input class="form-check-input" type="checkbox" id="isAvailable" name="isAvailable" value="1" checked>
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