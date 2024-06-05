@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif
  @if (session()->has('error'))
  <div class="alert alert-danger w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
    {{ session('error') }}
  </div>
@endif
<div class="card p-3 mt-5">
  <div class="d-flex">
    <h4 class="align-self-center m-0">Daftar Pasien Dokter {{ Auth::user()->name }} ({{ Auth::user()->staff_id }}) <span class="text text-primary text-uppercase fw-bold fs-7">IGD</span></h4>
    <a href="{{ route('igd/patient.create') }}" class="btn btn-success btn-sm ms-auto">+Tambah Pasien IGD</a>
  </div>
  <hr class="m-0 mt-2 mb-3">
  <div class="table-responsive text-nowrap">
    <table id="example" class="table">
      <thead>
        <tr class="text-nowrap bg-dark">
          <th>No</th>
          <th>No Rekam Medis</th>
          <th>Nama</th>
          <th>Kategori Pasien</th>
          <th>Jenis Kelamin</th>
          <th>Telp</th>
          <th>Alamat</th>
          <th>Alergi Obat</th>
          <th>Status</th>
          <th class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $item)    
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ implode('-', str_split(str_pad($item->queue->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}</td>
            <td>{{ $item->queue->patient->name ?? '-'}}</td>
            <td>{{ $item->queue->patientCategory->name ?? '-'}}</td>
            <td>{{ $item->queue->patient->jenis_kelamin ?? '-'}}</td>
            <td>{{ $item->queue->patient->telp ?? '-'}}</td>
            <td>{{ $item->queue->patient->alamat ?? '-'}}</td>
            <td>{!! $item->queue->patient->alergi ?? '-'!!}</td>
            <td>{{ $item->status ?? '-'}}</td>
            <td>
              <a class="btn btn-dark btn-sm" href="{{ route('igd/patient/rme.show', $item->id) }}">
                <i class='bx bx-show-alt me-1'></i>
                  show
              </a>
            </td>
          </tr>
        @endforeach
        </tbody>
    </table>
  </div>
</div>
@endsection

