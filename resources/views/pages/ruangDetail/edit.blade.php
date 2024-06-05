@extends('layouts.backend.main')

@section('content')
<div class="card mb-4">
  <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0">Edit Ruang</h5>
  </div>
  <div class="card-body">
      <form method="POST" action="{{ route('ruang/detail.update', $item->id) }}">
        @csrf
        @method('PUT')
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="room_id">Ruang</label>
            <div class="col-sm-10">
              <select name="room_id" id="room_id" class="form-select">
                  <option disabled selected>Pilih</option>
                  @foreach ($data as $ruang)
                      @if (old('room_id', $item->room->id) == $ruang->id)
                          <option value="{{ $ruang->id }}" selected>{{ $ruang->name ?? '' }}</option>
                      @else
                          <option value="{{ $ruang->id }}">{{ $ruang->name ?? '' }}</option>
                      @endif
                  @endforeach
              </select>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="name">Nama Detail Ruang</label>
            <div class="col-sm-10">
                <input type="text" name="name" id="name" value="{{ $item->name ?? '' }}" class="form-control" required />
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