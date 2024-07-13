@extends('layouts.backend.main')

@section('content')
<div class="card mb-4">
  <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0">Tambah Tindakan</h5>
  </div>
    <form method="POST" action="{{ route('tindakan.store') }}">
        <div class="card-body">
            @csrf
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Kode Tindakan</label>
                <div class="col-sm-10">
                    <input type="text" name="action_code" class="form-control @error('action_code') is-invalid @enderror" id="basic-default-name" required />
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Tindakan</label>
                <div class="col-sm-10">
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="basic-default-name" required />
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Jenis Tindakan</label>
                <div class="col-sm-10">
                <select name="jenis_tindakan" id="jenis_tindakan" class="form-control form-select">
                    <option selected disabled>Pilih</option>
                    @foreach ($data as $item)
                        @if (old('jenis_tindakan', $item))
                            <option value="{{ $item }}">{{ $item }}</option>
                        @else
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endif
                    @endforeach
                </select>
                </div>
            </div>
        </div>
        {{-- tarif tindakan --}}
        <div class="card-body p-3 mt-3">
            <div class="d-flex">
                <h5 class="me-2">Tarif (Rupiah)</h5>
            </div>
            <div class="row">
                @foreach ($patientCategories as $category)     
                    <div class="col-3">
                        <label for="" class="fw-bold form-label">{{ $category->name ?? '' }}</label>
                        <input type="hidden" name="patient_category_id[]" value="{{ $category->id }}"/>
                        <input type="number" name="tarif[]" value="0" class="form-control" id="basic-default-name" />
                    </div>
                @endforeach
            </div>
            <div class="text-end mt-4 me-2">
                <button type="submit" class="btn btn-md btn-primary">Simpan</button>
            </div>
        </div>
    </form>
</div>

@endsection