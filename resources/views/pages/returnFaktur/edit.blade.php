@extends('layouts.backend.main')

@section('content')
<div class="card mb-4">
  <div class="card-header m-0">
      <h5 class="mb-0 m-0">Edit Faktur Pembelian</h5>
  </div>
  <div class="card-body">
      <form method="POST" action="{{ route('farmasi/obat/return/faktur.update', $item->id) }}">
        @method('PUT')
        @csrf
          <hr class="m-0 mb-3">
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label form-label-sm" for="basic-default-name">Nama PBF</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control form-control-sm" id="basic-default-name" value="{{ $item->supplier->name }}" disabled required />
                <input type="hidden" name="supplier_id" value="{{ $item->supplier->id }}" required />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label form-label-sm" for="basic-default-name">Tanggal Transaksi</label>
            <div class="col-sm-4">
                <input type="date" name="tanggal" class="form-control form-control-sm" id="basic-default-name" value="{{ old('tanggal', $item->tanggal) }}" required />
            </div>
            <label class="col-sm-2 col-form-label" for="basic-default-name">Status Pembayaran</label>
            <div class="col-sm-4">
              <select class="form-select form-select-sm" name="isPaid" aria-label="Default select example">
                  <option selected>Pilih</option>
                  @if (old('isPaid', $item->isPaid) == '1')
                    <option value="1" selected>Lunas</option>
                    <option value="0">Kredit</option>
                  @elseif (old('isPaid', $item->isPaid) == '0')
                    <option value="1">Lunas</option>
                    <option value="0" selected>Kredit</option>
                  @else
                    <option value="1">Lunas</option>
                    <option value="0">Kredit</option>
                  @endif
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label form-label-sm" for="basic-default-name">Diskon (Rupiah)</label>
            <div class="col-sm-10">
                <input type="text" name="diskon" class="form-control form-control-sm" id="basic-default-name" value="{{ old('diskon', $item->diskon) }}" required />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label form-label-sm" for="basic-default-name">PPN</label>
            <div class="col-sm-4 d-flex">
                <input type="text" name="ppn" class="form-control form-control-sm" id="basic-default-name" value="{{ old('ppn', $item->ppn) }}" required />
                <p class="m-0 mt-2 mx-2">%</p>
            </div>
            <label class="col-sm-2 col-form-label form-label-sm" for="basic-default-name">Materai</label>
            <div class="col-sm-4 d-flex">
                <input type="text" name="materai" class="form-control form-control-sm" id="basic-default-name" value="{{ old('materai', $item->materai) }}" required />
            </div>
          </div>
          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button class="btn btn-sm btn-dark">Simpan</button>
            </div>
          </div>
          <hr class="m-0 mt-2 mb-3">
      </form>
  </div>
</div>
@endsection