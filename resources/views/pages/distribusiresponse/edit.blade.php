@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif
<div class="card p-3 mt-5">
  
  <form action="{{ route('farmasi/obat/distribusi/response.update', $item->id) }}" method="POST">
    @method('PUT')
    @csrf
    <div class="d-flex">
      <h4 class="align-self-center m-0">Finishing Distribusi Response</h4>
    </div>
    <hr class="m-0 mt-2 mb-3">
    <div class="row mb-3">
      <label for="select2Basic" class="col-sm-2 col-form-label">Dari Unit</label>
      <div class="col-sm-4">
        <select id="select2Basic" class="select2 form-select form-select-sm" data-allow-clear="true" disabled>
          <option selected>{{ $item->unitCategory->unit->name }} - {{ $item->unitCategory->unitCategoryPivot->name }}</option>
        </select>
      </div>
      <label for="select2Basic" class="col-sm-2 col-form-label">Ke Unit</label>
      <div class="col-sm-4">
        <select class="select2 form-select form-select-sm" data-allow-clear="true" disabled>
          <option selected disabled>Pilih</option>
                <option selected>{{ $item->medicineDistributionRequest->unitCategory->unit->name }} - {{ $item->medicineDistributionRequest->unitCategory->unitCategoryPivot->name }}</option>
        </select>
      </div>
    </div>
    
    <div class="table-responsive text-nowrap mb-3">
      <table class="table">
        <thead>
          <tr class="text-nowrap bg-dark">
            <th>No</th>
            <th>Nama Obat / Alkes</th>
            <th>Stock</th>
            <th>Satuan</th>
            {{-- <th>Harga</th>
            <th>No Batch</th>
            <th>Production Date</th>
            <th>Expired</th> --}}
            <th>Jumlah</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($item->medicineDistributionRequest->medicineDistributionDetails as $detail) 
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>
                <input type="hidden" name="detail_id[]" value="{{ $detail->id }}">
                <input type="text" class="form-control form-control-sm" value="{{ $detail->medicine->kode }}/{{ $detail->medicine->name }}" required disabled />
              </td>
              <td>
                <input type="text" class="form-control form-control-sm" value="{{ $detail->medicine->medicineStoks->where('unit_category_id', $item->unit_category_id)->where('medicine_id', $detail->medicine_id)->sum('stok') }}" required disabled />
              </td>
              <td>
                <input type="text" class="form-control form-control-sm" value="{{ $detail->satuan }}" required disabled />
              </td>
              {{-- <td>
                <input type="text" class="form-control form-control-sm" name="harga[]" value="{{ old('harga', $detail->medicine->medicineStoks->where('medicine_id', $detail->medicine_id)->where('unit_category_id', $item->unit_category_id)->pluck('harga')->first()) }}" required readonly/>
              </td>
              <td>
                <input type="text" name="no_batch[]" class="form-control form-control-sm" id="basic-default-name" value="{{ old('no_batch', $detail->medicine->medicineStoks->where('medicine_id', $detail->medicine_id)->where('unit_category_id', $item->unit_category_id)->pluck('no_batch')->first()) }}" required readonly />
              </td>
              <td>
                <input type="date" name="production_date[]" class="form-control form-control-sm" id="basic-default-name" value="{{ old('production_date', $detail->medicine->medicineStoks->where('medicine_id', $detail->medicine_id)->where('unit_category_id', $item->unit_category_id)->pluck('production_date')->first()) }}" required readonly />
              </td>
              <td>
                <input type="date" name="exp_date[]" class="form-control form-control-sm" id="basic-default-name" value="{{ old('exp_date', $detail->medicine->medicineStoks->where('medicine_id', $detail->medicine_id)->where('unit_category_id', $item->unit_category_id)->pluck('exp_date')->first()) }}" required readonly />
              </td> --}}
              <td>
                <input type="text" class="form-control form-control-sm" name="jumlah[]" value="{{ old('jumlah', $detail->jumlah) }}" required/>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    {{-- <div class="row mb-3">
      <label for="select2Basic" class="col-sm-2 col-form-label">Nama Obat / Alkes</label>
      <div class="col-sm-4">
        <select class="select2 form-select form-select-sm" data-allow-clear="true" disabled>
            <option selected>{{ $item->medicineDistributionRequest->medicine->kode }}/{{ $item->medicineDistributionRequest->medicine->name }}</option>
        </select>
      </div>
      <label class="col-sm-1 col-form-label" for="basic-default-name">Stok Obat</label>
      <div class="col-sm-2">
          <input type="number" class="form-control" value="{{ $medicineStok->stok }}" required disabled/>
      </div>
      <label class="col-sm-1 col-form-label form-label-sm" for="basic-default-name">Satuan</label>
      <div class="col-sm-2">
        <input type="text" class="form-control" required disabled/>
      </div>
    </div>
    <div class="row mb-3">
      <label class="col-sm-2 col-form-label form-label-sm" for="basic-default-name">Jumlah Obat</label>
      <div class="col-sm-4">
          <input type="text" class="form-control" value="{{ old('jumlah', $item->medicineDistributionRequest->jumlah) }}" required disabled/>
      </div>
      <label class="col-sm-1 col-form-label form-label-sm" for="basic-default-name">Satuan Obat</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" value="{{ $item->medicineDistributionRequest->satuan }}" required disabled />
      </div>
    </div>
    <div class="row mb-3">
      <label class="col-sm-2 col-form-label" for="basic-default-name">Harga Satuan</label>
      <div class="col-sm-10">
          <input type="text" class="form-control" name="harga" value="{{ old('harga', $item->harga) }}" required/>
      </div>
    </div>
    <div class="row mb-3">
      <label class="col-sm-2 col-form-label form-label-sm" for="basic-default-name">Nomor Batch</label>
      <div class="col-sm-3">
        <input type="text" name="no_batch" class="form-control form-control-sm" id="basic-default-name" value="{{ old('no_batch', $item->no_batch) }}" required />
      </div>
      <label class="col-sm-2 col-form-label form-label-sm" for="basic-default-name">Production Date</label>
      <div class="col-sm-2">
        <input type="date" name="production_date" class="form-control form-control-sm" id="basic-default-name" value="{{ old('production_date', $item->production_date) }}" required />
      </div>
      <label class="col-sm-1 col-form-label form-label-sm" for="basic-default-name">Expired Date</label>
      <div class="col-sm-2">
        <input type="date" name="exp_date" class="form-control form-control-sm" id="basic-default-name" value="{{ old('exp_date', $item->exp_date) }}" required />
      </div>
    </div> --}}
    <div class="text-end">
      <button type="submit" class="btn btn-sm btn-dark ms-auto" name="status" value="DITERIMA">Simpan</button>
    </div>
  </form>
</div>
@endsection