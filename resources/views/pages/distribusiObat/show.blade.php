@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif
@if (session()->has('danger'))
      <div class="alert alert-danger w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('danger') }}
      </div>
  @endif
  <div class="card p-3 mt-4 pb-0">
    <div class="card-body">
      <div class="row">
        <div class="col-6">
          <h4>Detail Amprahan Obat</h4>
        </div>
        <div class="col-6 text-end">
          <a href="{{ route('farmasi/obat/amprahan.index') }}" class="btn btn-outline-danger">Kembali</a>
        </div>
      </div>
      <hr class="m-0 mt-2 mb-3">
      <div class="row">
        <div class="col-6">
          <h5 class="mb-2 fw-bold">No. <span class="text-primary">{{ $item->no_distribusi ?? '...' }}</span></h5>
          <h6 class="mb-1">Diamprah Oleh. <span class="text-dark fw-bold">{{ $item->user->name ?? '...' }}</span></h6>
          <h6 class="mb-2">Dari <span class="text-dark fw-bold">{{ $item->unitAsal->name ?? '...' }}</span> Ke <span class="text-dark fw-bold">{{ $item->unitTujuan->name ?? '...' }}</span></h6>
          @if ($item->status == 'SUCCESS')
            <span class="badge bg-success">SUKSES</span>
          @elseif ($item->status == 'CANCEL')
            <span class="badge bg-warning">RETUR</span> 
          @else
            <span class="badge bg-danger">{{ $item->status == 'FAILED' ? 'GAGAL' : 'UNKNOWN' }}</span> 
          @endif
        </div>
        <div class="col-6 text-end">
          <h5 class="mb-1 fw-bold">Tgl. <span class="text-primary">{{ $item->created_at->format('d M Y') }}</span></h5>
          <h5 class="fw-bold text-uppercase mb-1"></h5>
          <h1 class="fw-bold"><span class="badge bg-warning">{{ $item->medicineDistributionDetails->count() ?? '' }} <span class="small">Item</span></span></h1>
        </div>
      </div>
    </div>
  </div>
<div class="card p-3 mt-2">
  <div class="card-body">
    <div class="table-responsive text-nowrap">
      <table class="table" id="example">
        <thead>
          <tr class="text-nowrap bg-dark">
            <th>Nomor Batch</th>
            <th>Nama Obat</th>
            <th>Production Date</th>
            <th>Expire</th>
            <th>Harga Satuan</th>
            <th>Jumlah</th>
            <th>Total Harga</th>
            {{-- <th>Action</th> --}}
          </tr>
        </thead>
        <tbody>
          @foreach ($item->medicineDistributionDetails as $detail)
          <tr>
            <td>{{ $detail->medicineStok->no_batch ?? ''}} <br></td>
            <td>{{ $detail->medicine->kode ?? '' }} - {{ $detail->medicine->name ?? '' }}</td>
            <td>{{ $detail->medicineStok->production_date ?? ''}}</td>
            <td>{{ $detail->medicineStok->exp_date ?? '' }}</td>
            <td>Rp. {{ number_format($detail->medicineStok->base_harga ?? '') }}</td>
            <td>{{ ($detail->jumlah ?? '') . ' ' . ($detail->satuan ?? '') }}</td>
            <td>Rp. {{ number_format($detail->medicineStok->base_harga * $detail->jumlah) }}</td>
            {{-- <td>
                    <form action="" method="POST" onsubmit="return confirm('Yakin Ingin Membatalkan Amprahan Obat ini ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"><i class="bx bx-trash me-1"></i>Cancel</button>
                    </form>
            </td> --}}
            
          </tr>
          @endforeach
          </tbody>
      </table>
    </div>
  </div>
</div>
@endsection