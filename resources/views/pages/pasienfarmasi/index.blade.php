@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif
<div class="card p-3 mt-5">
    <div class="col-md-12">
        <h4 class="align-self-center m-0">
            Daftar Pasien Dokter {{ Auth::user()->name }} ({{ Auth::user()->staff_id }})
            <span class="text text-primary text-uppercase fw-bold fs-7">Rawat Jalan</span>
            <span class="text text-primary text-uppercase fw-bold fs-7">({{ date('d-m-Y') }})</span>
        </h4>
    </div>
  <hr class="m-0 mt-2 mb-3">
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr class="text-nowrap bg-dark">
          @can('show pasien farmasi rajal')
          <th class="text-center">Action</th>
          @endcan
          <th>No Antrian</th>
          <th>No Rekam Medis</th>
          <th>Nama</th>
          <th>Kategori Pasien</th>
          <th>Jenis Kelamin</th>
          <th>Telp</th>
          <th>Alamat</th>
          <th>Alergi Obat</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $item)    
          <tr>
            @can('show pasien farmasi rajal')   
            <td>
              <a class="btn btn-dark btn-sm" href="{{ route('rajal/farmasi/create', $item->id) }}">
                <i class='bx bx-show-alt me-1'></i>
                  show
              </a>
            </td>
            @endcan
            <td>{{ $item->rawatJalanPatient->queue->no_antrian ?? '' }}</td>
            <td>{{ implode('-', str_split(str_pad($item->rawatJalanPatient->queue->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}</td>
            <td>{{ $item->rawatJalanPatient->queue->patient->name ?? '' }}</td>
            <td>{{ $item->rawatJalanPatient->queue->patientCategory->name ?? '' }}</td>
            <td>{{ $item->rawatJalanPatient->queue->patient->jenis_kelamin ?? '' }}</td>
            <td>{{ $item->rawatJalanPatient->queue->patient->telp ?? '' }}</td>
            <td>{{ $item->rawatJalanPatient->queue->patient->alamat ?? '' }}</td>
            <td>{{ $item->rawatJalanPatient->queue->patient->alergi ?? '' }}</td>
            <td>{{ $item->status ?? '' }}</td>
          </tr>
        @endforeach
        </tbody>
    </table>
  </div>
</div>
@endsection

