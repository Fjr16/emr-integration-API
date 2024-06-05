@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif
@if (session()->has('forbidden'))
      <div class="alert alert-danger w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('forbidden') }}
      </div>
  @endif
<div class="card p-3 mt-5">
  <div class="row">
    <div class="col-md-9">
        <h4 class="align-self-center m-0">
            Daftar Pasien
            <span class="text text-primary text-uppercase fw-bold fs-7">Rawat Inap</span>
          </h4>
      </div>
  </div>
  <hr class="m-0 mt-2 mb-3">
  <div class="table-responsive text-nowrap">
    <table id="example" class="table">
      <thead>
        <tr class="text-nowrap bg-dark">
          <th>No Antrian</th>
          <th>No Rekam Medis</th>
          <th>Nama</th>
          <th>Kategori Pasien</th>
          <th>Jenis Kelamin</th>
          <th>Telp</th>
          <th>Alamat</th>
          <th>Alergi Obat</th>
          <th>Status Rawat Inap</th>
          <th class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $item)    
          <tr>
            <td>{{ $item->no_antrian ?? '-'}}</td>
            <td>{{ implode('-', str_split(str_pad($item->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}</td>
            <td>{{ $item->patient->name ?? '-'}}</td>
            <td>{{ $item->patientCategory->name ?? '-'}}</td>
            <td>{{ $item->patient->jenis_kelamin ?? '-'}}</td>
            <td>{{ $item->patient->telp ?? '-'}}</td>
            <td>{{ $item->patient->alamat ?? '-'}}</td>
            <td>{!! $item->patient->alergi ?? '-'!!}</td>
            <td>{{ $item->rawatInapPatient->status ?? '-'}}</td>
            <td>
              
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{ route('formulir/rekonsilasi/obat.create', $item->rawatInapPatient->id) }}">
                    <i class="bx bx-plus"></i>
                    Tambah
                  </a>
                  <a class="dropdown-item" href="">
                    <i class="bx bx-printer"></i>
                    Print
                  </a>
                </div>
              </div>
            </td>
          </tr>
        @endforeach
        </tbody>
    </table>
  </div>
</div>
@endsection

