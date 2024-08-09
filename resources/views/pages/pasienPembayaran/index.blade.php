@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif
<div class="card p-3 mt-5">
  <div class="card-header">
    <form action="{{ route('rajal/kasir/pembayaran/index') }}" method="GET">
      <div class="row">
        <div class="col-md-8">
            <h4 class="align-self-center m-0">
              Daftar Tagihan
              <span class="text text-primary fw-bold">Rawat Jalan ({{ date('d-m-Y') }})</span>
            </h4>
        </div>
        <div class="col-md-3">
          <div class="row">
            <label class="col-form-label col-3"></label>
            <div class="col-9">
                <input type="date" id="tanggal" name="filter" value="{{ request('filter', date('Y-m-d')) }}" class="form-control">
            </div>
          </div>
        </div>
        <div class="col-md-1">
          <button type="submit" class="btn btn-primary">Filter</button>
        </div>
      </div>
    </form>
  </div>
  <hr class="m-0 mt-2 mb-3">
  <div class="card-body">
    <div class="table-responsive text-nowrap">
      <table id="example" class="table">
        <thead>
          <tr class="text-nowrap bg-dark">
            <th class="text-center">Action</th>
            <th>No Antrian</th>
            <th>No. RM / Nama</th>
            <th>Tanggungan</th>
            <th>Jenis Kelamin</th>
            <th>Status Rawatan</th>
            <th>Status Obat</th>
            <th>Status Tagihan</th>
            <th>Kasir</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $item)    
          <tr>
            <td>
              <a class="btn btn-dark btn-sm" href="{{ route('rajal/kasir/pembayaran/edit', encrypt($item->id)) }}">
                <i class='bx bx-show-alt me-1'></i>
                  show
              </a>
            </td>
            <td>{{ $item->queue->no_antrian ?? '' }}</td>
            <td>{{ $item->queue->patient->no_rm ?? }} / {{ $item->queue->patient->name ?? '...'  }}</td>
            <td>{{ $item->queue->patientCategory->name ?? '...'  }}</td>
            <td>{{ $item->queue->patient->jenis_kelamin ?? '...'  }}</td>
            <td>
              @if ($item->queue->rawatJalanPoliPatient->status == 'WAITING')                                    
                <span class="badge bg-danger">BELUM DILAYANI</span>
              @elseif ($item->queue->rawatJalanPoliPatient->status == 'ONGOING')
                  <span class="badge bg-warning">DALAM PERAWATAN</span>
              @elseif ($item->queue->rawatJalanPoliPatient->status == 'FINISHED')
                  <span class="badge bg-success">SUDAH DILAYANI</span>
              @else
                  <span class="badge bg-success">TIDAK DIKETAHUI</span>
              @endif
            </td>
            <td>
              @if ($item->queue->rajalFarmasiPatient)    
                @if ($item->queue->rajalFarmasiPatient->status == 'WAITING')                                    
                    <span class="badge bg-warning">PERMINTAAN</span>
                @elseif ($item->queue->rajalFarmasiPatient->status == 'ONGOING')
                    <span class="badge bg-info">DITERIMA</span>
                @elseif ($item->queue->rajalFarmasiPatient->status == 'FINISHED')
                    <span class="badge bg-success">SUDAH DIAMBIL</span>
                @elseif ($item->queue->rajalFarmasiPatient->status == 'DENIED')
                    <span class="badge bg-danger">DITOLAK / REVISI</span>
                @else 
                  <span class="badge bg-danger">TIDAK DIKETAHUI</span>
                @endif
              @else
                <span class="badge bg-danger">BELUM ADA RESEP</span>
              @endif
            </td>
            <td>
              @if ($item->status == 'WAITING')                                    
                  <span class="badge bg-danger">BELUM BAYAR</span>
              @elseif ($item->status == 'FINISHED')
                  <span class="badge bg-success">SUDAH BAYAR</span>
              @else 
                <span class="badge bg-danger">TIDAK DIKETAHUI</span>
              @endif
            </td>
            <td>{{ $item->user->name ?? '- - -'  }}</td>
          </tr>
          @endforeach
          </tbody>
      </table>
    </div>
  </div>
</div>

@endsection

