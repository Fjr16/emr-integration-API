@extends('layouts.backend.main')

@section('content')
<div class="card mb-4">
  <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0">Edit Dokter</h5>
  </div>
  <div class="card-body">
      <form method="POST" action="{{ route('dokter.update', $item->id) }}">
        @method('PUT')
          @csrf
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Kode Dokter</label>
                <div class="col-sm-10">
                <input type="text" name="kode" class="form-control" id="basic-default-name" value="{{ old('kode', $item->kode) }}" required />
                </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Nama</label>
              <div class="col-sm-10">
                  <input type="text" name="name" class="form-control" id="basic-default-name" value="{{ old('name', $item->name) }}" required />
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Telp</label>
              <div class="col-sm-10">
                  <input type="text" name="telp" class="form-control" id="basic-default-name" value="{{ old('telp', $item->telp) }}" required />
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Alamat</label>
              <div class="col-sm-10">
                <textarea class="form-control" name="alamat" id="floatingTextarea2" style="height: 100px">{{ old('alamat', $item->alamat) }}</textarea>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Poli</label>
              <div class="col-sm-10">
                <select name="poli_id" class="form-select" aria-label="Default select example">
                  <option value="kosong" selected> Tidak Dalam Poli</option>
                  @foreach ($polis as $poli)                      
                    @if (old('poli_id', $item->poli_id) == $poli->id)
                      <option value="{{ $poli->id }}" selected>{{ $poli->name }}</option>
                    @else
                      <option value="{{ $poli->id }}">{{ $poli->name }}</option>
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