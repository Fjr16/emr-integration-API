@extends('layouts.backend.main')

@section('content')
<div class="card mb-4">
  <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0">Tambah Tindakan</h5>
  </div>
  <div class="card-body">
      <form method="POST" action="{{ route('action/members.store') }}">
          @csrf
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Jenis Tindakan</label>
            <div class="col-sm-10">
              <select class="form-select select2" name="action_id" aria-label="Default select example">
                  <option selected disabled>Pilih</option>
                  @foreach ($action as $action)
                    @if (old('action_id') == $action->id)
                      <option value="{{ $action->id }}" selected>{{ $action->name }}</option>
                    @else
                      <option value="{{ $action->id }}">{{ $action->name }}</option>
                    @endif
                  @endforeach
              </select>
            </div>
          </div>
          <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Tindakan</label>
              <div class="col-sm-10">
                  <input type="text" name="name" class="form-control" id="basic-default-name" value="{{ old('name') }}" required />
              </div>
          </div>
          <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Code ICD 9</label>
              <div class="col-sm-10">
                  <input type="text" name="code_icd" class="form-control" id="basic-default-name" value="{{ old('code_icd') }}"/>
              </div>
          </div>
          <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Tarif Umum</label>
              <div class="col-sm-10">
                  <input type="number" name="tarif_umum" class="form-control" id="basic-default-name" value="{{ old('tarif_umum') }}"/>
              </div>
          </div>
          <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Tarif UC</label>
              <div class="col-sm-10">
                  <input type="number" name="tarif_uc" class="form-control" id="basic-default-name" value="{{ old('tarif_uc') }}"/>
              </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Keterangan Billing</label>
            <div class="col-sm-10">
              <select class="form-select select2" name="billing_caption_id" aria-label="Default select example">
                  <option selected disabled>Pilih</option>
                  @foreach ($billing as $billing)
                      @if (old('billing_caption_id') == $billing->id)
                        <option value="{{ $billing->id }}" selected>{{ $billing->name }}</option>
                      @else
                        <option value="{{ $billing->id }}">{{ $billing->name }}</option>
                      @endif
                  @endforeach
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Batas Tanggungan</label>
            <div class="col-sm-10">
              <select class="form-select select2" name="tanggungan" aria-label="Default select example">
                  <option selected>Pilih</option>
                  @foreach ($tanggungan as $t)
                  @if (old('tanggungan') == $t)
                    <option value="{{ $t }}" selected>{{ $t }}</option>
                  @else
                    <option value="{{ $t }}">{{ $t }}</option>
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