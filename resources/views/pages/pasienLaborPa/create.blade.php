@extends('layouts.backend.main')

@section('content')
<div class="card mb-4">
  <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0">Tambah Antrian Laboratorium Patologi Anatomi Pasien <span class="fw-bold">{{ $item->patient->name }}</span></h5>
  </div>
  <div class="card-body">
      <form method="POST" action="{{ route('permintaan/laboratorium/patologi/anatomik.storeAntrian', $item->id) }}">
          @csrf
          <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Tanggal Akan Di Periksa</label>
              <div class="col-sm-10">
                  <input type="datetime-local" name="tgl_diperiksa" class="form-control" id="basic-default-name" />
              </div>
          </div>
          <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Tindakan</label>
              <div class="col-sm-10">
                <div class="row mx-1">
                    @foreach ($tindakan as $tindak)
                    <div class="form-check col-4">
                      <input class="form-check-input" type="checkbox" name="tindakan[]" value="{{ $tindak['name'] }} - {{ $tindak['category'] }}" id="defaultCheck1" />
                      <label class="form-check-label" for="defaultCheck1">
                        {{ $tindak['name'] }} <span class="fw-bold">{{ $tindak['category'] }}</span>
                      </label>
                    </div>
                    @endforeach
                </div>
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