@extends('layouts.backend.main')

@section('content')
<div class="card mb-4">
  <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0">Entri Hasil Pemeriksaan</h5>
  </div>
  <div class="card-body">
      <form method="POST" action="{{ route('dokter/diagnosis/report.store') }}">
          @csrf
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Pasien</label>
            <div class="col-sm-10">
              <select class="form-select select2" name="patient_id" aria-label="Default select example">
                  <option selected disabled>Pilih</option>
                  @foreach ($patients as $doctorPatient)

                    @if (old('patient_id') == $doctorPatient->queue->patient->id)
                      <option value="{{ $doctorPatient->queue->patient->id }}" selected>{{ $doctorPatient->queue->patient->no_rm }}/{{ $doctorPatient->queue->patient->name }}</option>
                    @else
                      <option value="{{ $doctorPatient->queue->patient->id }}">{{ $doctorPatient->queue->patient->no_rm }}/{{ $doctorPatient->queue->patient->name }}</option>
                    @endif
                  @endforeach
              </select>
            </div>
          </div>
          
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Tindakan Dokter</label>
              <div class="col-sm-10">
                @foreach ($actions as $action)
                  <input type="checkbox" name="action_members_id[]" value="{{ $action->id }}">
                  <label for="">{{ $action->name }}</label>
                @endforeach
              </div>
          </div>
          <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Diagnosis Dokter</label>
              <div class="col-sm-10">
                <textarea class="form-control" name="diagnosis" id="editor" rows="3"></textarea>
              </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Rawat Inap</label>
            <div class="col-sm-10">
              <select class="form-select" name="rawat_inap" aria-label="Default select example">
                  <option selected disabled>Pilih</option>
                  <option value="1">YA</option>
                  <option value="0">TIDAK</option>
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Pemeriksaan Penunjang</label>
            <div class="col-sm-10">
              <select class="form-select" name="penunjang" aria-label="Default select example">
                  <option selected disabled>Pilih</option>
                  <option value="1">YA</option>
                  <option value="0">TIDAK</option>
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Daftar Resep Obat</label>
            <div class="col-sm-10">
              <textarea class="form-control" name="resep_obat" id="editor1" rows="3"></textarea>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Keterangan</label>
            <div class="col-sm-10">
              <textarea class="form-control" name="keterangan" id="editor2" rows="3"></textarea>
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