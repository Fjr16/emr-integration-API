@extends('layouts.backend.main')

@section('content')
<div class="card mb-4">
  <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0">Edit Kategori Dokter</h5>
  </div>
  <div class="card-body">
      <form method="POST" action="{{ route('user/specialist.update', $item->id) }}" enctype="multipart/form-data">
        @method('PUT')
          @csrf
          <div class="row mb-3">
            <label for="exampleFormControlSelect1" class="form-label col-sm-2 mt-2">Nama</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="basic-default-name" value="{{ old('name', $item->name) }}" /> 
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