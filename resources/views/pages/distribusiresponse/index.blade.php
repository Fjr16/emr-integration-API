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
    <h4 class="align-self-center m-0">Distribusi Response</h4>
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
          <th>Satuan</th>
          <th>No Batch</th>
          <th>Production Date</th>
          <th>Expire</th>
          <th>Harga Satuan</th>
          <th class="text-center">Status</th>
          <th class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $item)    
          <tr>
            <th scope="row" class="text-dark">{{ $loop->iteration }}</th>
            <td>{{ $item->unitCategory->unit->name ?? '' }} - {{ $item->unitCategory->unitCategoryPivot->name ?? '' }}</td>
            <td>{{ $item->medicineDistributionRequest->unitCategory->unit->name ?? '' }} - {{ $item->medicineDistributionRequest->unitCategory->unitCategoryPivot->name ?? '' }}</td>
            <td>
              <table>
                @foreach ($item->medicineDistributionRequest->medicineDistributionDetails as $detail)
                <tr>
                  <td>{{ $detail->medicine->kode ?? '' }}</td>
                </tr>
                @endforeach
              </table>
            </td>
            <td>
              <table>
                @foreach ($item->medicineDistributionRequest->medicineDistributionDetails as $detail)
                <tr>
                  <td>{{ $detail->medicine->name ?? '' }}</td>
                </tr>
                @endforeach
              </table>
            </td>
            <td>
              <table>
                @foreach ($item->medicineDistributionRequest->medicineDistributionDetails as $detail)
                <tr>
                  <td>{{ $detail->jumlah ?? '' }}</td>
                </tr>
                @endforeach
              </table>
            </td>
            <td>
              <table>
                @foreach ($item->medicineDistributionRequest->medicineDistributionDetails as $detail)
                <tr>
                  <td>{{ $detail->satuan ?? '' }}</td>
                </tr>
                @endforeach
              </table>
            </td>
            <td>
              <table>
                @foreach ($item->medicineDistributionRequest->medicineDistributionDetails as $detail)
                <tr>
                  <td>{{ $detail->medicineStok->no_batch ?? '' }}</td>
                </tr>
                @endforeach
              </table>
            </td>
            <td>
              <table>
                @foreach ($item->medicineDistributionRequest->medicineDistributionDetails as $detail)
                <tr>
                  <td>{{ $detail->medicineStok->production_date ?? '' }}</td>
                </tr>
                @endforeach
              </table>
            </td>
            <td>
              <table>
                @foreach ($item->medicineDistributionRequest->medicineDistributionDetails as $detail)
                <tr>
                  <td>{{ $detail->medicineStok->exp_date ?? '' }}</td>
                </tr>
                @endforeach
              </table>
            </td>
            <td>
              <table>
                @foreach ($item->medicineDistributionRequest->medicineDistributionDetails as $detail)
                <tr>
                  <td>{{ $detail->medicineStok->harga ?? '' }}</td>
                </tr>
                @endforeach
              </table>
            </td>
            <td>
              <button class="btn btn-sm btn-dark" disabled>{{ $item->medicineDistributionRequest->status ?? '' }}</button>
            </td>
            <td class="text-center">
              @if ($item->medicineDistributionRequest)                
                @if ($item->medicineDistributionRequest->status == 'SELESAI')
                  <button class="btn btn-sm btn-success" disabled>Distribusi Berhasil</button>
                @elseif($item->medicineDistributionRequest->status == 'PENDING')
                  <form action="{{ route('farmasi/obat/distribusi/response.update', $item->medicine_distribution_request_id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <button type="submit" class="btn btn-sm btn-primary" name="status" value="EDIT">Terima</button>
                    <button type="submit" class="btn btn-sm btn-warning" name="status" value="DITOLAK">Tolak</button>
                  </form>
                @elseif($item->medicineDistributionRequest->status == 'DITERIMA')
                  <form action="{{ route('farmasi/obat/distribusi/response.update', $item->medicine_distribution_request_id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <button class="btn btn-sm btn-danger" name="status" value="BATAL">Batalkan</button>
                  </form>
                @elseif($item->medicineDistributionRequest->status == 'DITOLAK')
                  <form action="{{ route('farmasi/obat/distribusi/response.update', $item->medicine_distribution_request_id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <button class="btn btn-sm btn-warning" disabled>Distribusi Ditolak</button>
                  </form>
                @elseif($item->medicineDistributionRequest->status == 'BATAL')
                  <button class="btn btn-sm btn-danger" disabled>Distribusi Batal</button>
                @endif
              @endif
              <a href="{{ route('farmasi/obat/distribusi/response/cetak/faktur.show', $item->id) }}" target="blank" class="btn btn-info btn-sm mt-2 mx-auto">Cetak</a>

              
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection