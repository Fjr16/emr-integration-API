@extends('layouts.backend.main')

@section('content')
<div class="card mb-4">
  <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0">Tambah Dokter</h5>
  </div>
  <div class="card-body">
      <form method="POST" action="{{ route('konsultasi.store') }}">
          @csrf
          <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="user_id">Dokter</label>
              <div class="col-sm-10">
                <select name="user_id" id="user_id" class="form-select select2">
                    <option disabled selected>Pilih</option>
                    @foreach ($data as $item)
                        @if (old('user_id') == $item->id)
                            <option value="{{ $item->id }}" selected>{{ $item->name ?? '' / $item->roomDetail->name ?? '' }}</option>
                        @else
                            <option value="{{ $item->id }}">{{ $item->name ?? '' }} / {{ $item->roomDetail->name ?? '' }}</option>
                        @endif
                    @endforeach
                </select>
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