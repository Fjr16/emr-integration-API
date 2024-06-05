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
    <h4 class="align-self-center m-0">Return Response</h4>
  </div>
  <hr class="m-0 mt-2 mb-3">
  <div class="table-responsive text-nowrap">
    <table class="table" id="example">
      <thead>
        <tr class="text-nowrap bg-dark">
          <th>No</th>
          <th>Dari Unit</th>
          <th>Ke Unit</th>
          <th>Kode Obat / Alkes</th>
          <th>Nama Obat / Alkes</th>
          <th>Jumlah</th>
          <th>No Batch</th>
          <th>Expire</th>
          <th>Harga Satuan</th>
          <th class="text-center">Status</th>
          <th class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $item)    
          <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $item->unitCategory->unit->name }} - {{ $item->unitCategory->unitCategoryPivot->name }}</td>
            <td>{{ $item->medicineDistributionRequest->unitCategory->unit->name }} - {{ $item->medicineDistributionRequest->unitCategory->unitCategoryPivot->name }}</td>
            <td>{{ $item->medicineDistributionRequest->medicine->kode }}</td>
            <td>{{ $item->medicineDistributionRequest->medicine->name }}</td>
            <td>{{ $item->medicineDistributionRequest->jumlah }}</td>
            <td>{{ $item->no_batch }}</td>
            <td>{{ $item->exp_date }}</td>
            <td>{{ $item->harga }}</td>
            <td>
              <button class="btn btn-sm btn-dark" disabled>{{ $item->status }}</button>
            </td>
            <td>
              <form action="{{ route('farmasi/obat/distribusi/return/response.update', $item->id) }}" method="POST">
                @method('PUT')
                @csrf
              @if ($item->status == 'SELESAI')
                <button class="btn btn-sm btn-success" disabled>Return Berhasil</button>
              @elseif($item->status == 'PENDING')
                <button type="submit" class="btn btn-sm btn-primary" onclick="return confirm('Yakin ingin malanjutkan ?')" name="status" value="DITERIMA">Terima</button>
                <button type="submit" class="btn btn-sm btn-warning" onclick="return confirm('Yakin ingin melanjutkan ?')" name="status" value="DITOLAK">Tolak</button>
              @elseif($item->status == 'DITERIMA')
                <button type="submit" class="btn btn-sm btn-primary" onclick="return confirm('Yakin ingin malanjutkan ?')" name="status" value="SELESAI">Selesai</button>
                <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin membatalkan ?')" name="status" value="BATAL">Batalkan</button>
              @elseif($item->status == 'DITOLAK')
                <button class="btn btn-sm btn-warning" disabled>Return Ditolak</button>
              @elseif($item->status == 'BATAL')
                <button class="btn btn-sm btn-danger" disabled>Return Batal</button>
              @endif
            </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection