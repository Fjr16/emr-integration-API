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
            Daftar Antrian Kasir
        </h4>
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
          <th>Kasir</th>
          <th>Status</th>
          <th class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $item)    
        <tr>
          <td>{{ $item->rawatJalanPatient->queue->no_antrian ?? '' }}</td>
          <td>{{ implode('-', str_split(str_pad($item->rawatJalanPatient->queue->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}</td>
          <td>{{ $item->rawatJalanPatient->queue->patient->name ?? ''  }}</td>
          <td>{{ $item->rawatJalanPatient->queue->patientCategory->name ?? ''  }}</td>
          <td>{{ $item->rawatJalanPatient->queue->patient->jenis_kelamin ?? ''  }}</td>
          <td>{{ $item->rawatJalanPatient->queue->patient->telp ?? ''  }}</td>
          <td>{{ $item->rawatJalanPatient->queue->patient->alamat ?? ''  }}</td>
          <td>{{ $item->rawatJalanPatient->queue->patient->alergi ?? ''  }}</td>
          <td>{{ $item->user->name ?? ''  }}</td>
          <td>
            @if ($item->status == 'PENDING')
              <button class="btn btn-sm btn-warning" disabled >Pending</button>
            @elseif ($item->status == 'SELESAI')
              <button class="btn btn-sm btn-success" disabled >Selesai</button>
            @else
              <button class="btn btn-sm btn-dark" disabled >Error</button>
            @endif
          </td>
          <td>
            <a class="btn btn-dark btn-sm" href="{{ route('rajal/kasir/pembayaran/edit', $item->id) }}">
              <i class='bx bx-show-alt me-1'></i>
                show
            </a>
          </td>
        </tr>
        @endforeach
        </tbody>
    </table>
  </div>

@endsection

