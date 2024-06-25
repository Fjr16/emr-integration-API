@extends('layouts.backend.main')

@section('content')
<div class="card mb-4">
  <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0">Edit Tindakan</h5>
  </div>
  <div class="card-body">
      <form method="POST" action="{{ route('tindakan.update', $item->id) }}">
          @csrf
          @method('PUT')
          <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Jenis Tindakan</label>
              <div class="col-sm-10">
                <select name="action_category_id" id="action_category_id" class="form-control form-select">
                    @foreach ($data as $cat)
                        @if (old('action_category_id', $cat->id) == $item->id)
                            <option value="{{ $cat->id }}" selected>{{ $cat->name }}</option>
                        @else
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endif
                    @endforeach
                </select>
              </div>
          </div>
          <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Kode ICD</label>
              <div class="col-sm-10">
                  <input type="text" name="icd_code" value="{{ old('icd_code', $item->icd_code) }}" class="form-control @error('icd_code') is-invalid @enderror" id="basic-default-name" required />
              </div>
          </div>
          <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Tindakan</label>
              <div class="col-sm-10">
                  <input type="text" name="name" value="{{ old('name', $item->name) }}" class="form-control @error('name') is-invalid @enderror" id="basic-default-name" required />
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