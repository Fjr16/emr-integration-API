@extends('layouts.backend.main')

@section('content')
<div class="card mb-4">
  <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0">Edit Jenis Kamar</h5>
  </div>
  <div class="card-body">
      <form method="POST" action="{{ route('kamar.update', $item->id) }}" enctype="multipart/form-data">
        @method('PUT')
          @csrf
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Nama</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control" id="basic-default-name" value="{{ old('name',$item->name) }}" required />
            </div>
          </div>
          <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Lantai</label>
              <div class="col-sm-10">
                  <select class="form-select" id="exampleFormControlSelect1"
                      aria-label="Default select example" name="floor_id">
                      <option selected disabled>Pilih</option>
                      @foreach ($floors as $floor)
                          @if (old('floor_id', $item->floor_id) == $floor->id)
                              <option value="{{ $floor->id }}" selected>{{ $floor->name }}</option>
                          @else
                              <option value="{{ $floor->id }}">{{ $floor->name }}</option>
                          @endif
                      @endforeach
                  </select>
              </div>
          </div>
          <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Deskripsi</label>
              <div class="col-sm-10">
                  <textarea name="deskripsi" class="form-control form-control-sm">{{ old('deskripsi', $item->deskripsi) }}</textarea>
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