@extends('layouts.backend.main')

@section('content')
<div class="card mb-4">
  <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0">Tambah Detail Ruang</h5>
  </div>
  <div class="card-body">
      <form method="POST" action="{{ route('ruang/detail.store') }}">
          @csrf
          <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="room_id">Ruang</label>
              <div class="col-sm-10">
                <select name="room_id" id="room_id" class="form-select">
                    <option disabled selected>Pilih</option>
                    @foreach ($data as $item)
                        @if (old('room_id') == $item->id)
                            <option value="{{ $item->id }}" selected>{{ $item->name ?? '' }}</option>
                        @else
                            <option value="{{ $item->id }}">{{ $item->name ?? '' }}</option>
                        @endif
                    @endforeach
                </select>
              </div>
          </div>
          <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="name">Nama Detail Ruang</label>
              <div class="col-sm-10">
                  <input type="text" name="name" id="name" class="form-control" required />
              </div>
          </div>
          <div class="row justify-content-end">
              <div class="col-sm-10">
                  <button type="submit" class="btn btn-sm btn-success">Simpan</button>
              </div>
          </div>
      </form>
  </div>
</div>
@endsection
