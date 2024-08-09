@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif
<div class="card p-3 mt-5">
  
  <div class="d-flex">
    <h4 class="align-self-center m-0">Riwayat Penggunaan Obat
      <span class="text text-primary text-uppercase fw-bold fs-7">{{ $item->name ?? '' }} / {{ $item->no_rm ?? '' }}</span>
      <a class="btn btn-sm btn-success text-end" href="{{ route('laporan/penggunaan/obat.exportExcel', $item->id) }}"><i class="bx bx-cloud-download"></i> Excel</a>
    </h4>
  </div>
  <hr class="m-0 mt-2 mb-3">
  <div class="table-responsive text-nowrap">
    <table class="table" id="example">
      <thead>
        <tr class="text-nowrap bg-dark">
          <th>Tanggal</th>
          <th>No Antrian</th>
          <th>Tanggungan Pasien</th>
          <th class="text-center">Tanggungan Obat</th>
          <th class="text-center">Nama Obat</th>
          <th class="text-center">No Batch</th>
          <th class="text-center">Harga Satuan</th>
          <th class="text-center">Jumlah</th>
          <th class="text-center">Total Harga</th>
          <th class="text-center">Total Faktur</th>
        </tr>
      </thead>
      <tbody>
        @php
          $total_all = 0;
        @endphp
        @foreach ($data as $invoice)
          <tr>
            <td>{{ $invoice->created_at->format('Y/m/d') ?? '' }}</td>
            <td>{{ $invoice->rajalFarmasiPatient->rawatJalanPatient->queue->no_antrian ?? '' }}</td>
            <td>{{ $invoice->rajalFarmasiPatient->rawatJalanPatient->queue->patientCategory->name ?? '' }}</td>
            <td>
              <table class="mx-auto">
                @foreach ($invoice->rajalFarmasiObatDetails as $detail)
                  <tr>
                    <td>{{ $detail->patientCategory->name ?? '' }}</td>
                  </tr>
                @endforeach
              </table>
            </td>
            <td>
              <table class="mx-auto">
                @foreach ($invoice->rajalFarmasiObatDetails as $detail)
                  <tr>
                    <td>{{ $detail->medicine->name ?? '' }}</td>
                  </tr>
                @endforeach
              </table>
            </td>
            <td>
              <table class="mx-auto">
                @foreach ($invoice->rajalFarmasiObatDetails as $detail)
                  <tr>
                    <td>{{ $detail->medicineStok->no_batch ?? '' }}</td>
                  </tr>
                @endforeach
              </table>
            </td>
            <td>
              <table class="mx-auto">
                @foreach ($invoice->rajalFarmasiObatDetails as $detail)
                  <tr>
                    <td>{{ number_format($detail->harga_satuan ?? '' ) }}</td>
                  </tr>
                @endforeach
              </table>
            </td>
            <td>
              <table class="mx-auto">
                @foreach ($invoice->rajalFarmasiObatDetails as $detail)
                  <tr>
                    <td>{{ $detail->jumlah ?? '' }}</td>
                  </tr>
                @endforeach
              </table>
            </td>
            <td>
              <table class="mx-auto">
                @foreach ($invoice->rajalFarmasiObatDetails as $detail)
                  <tr>
                    <td>{{ number_format($detail->total_harga ?? '') }}</td>
                  </tr>
                @endforeach
              </table>
            </td>
            <td class="text-center">{{ number_format($invoice->grand_total ?? '') }}</td>
            @php
            $total_all += $invoice->grand_total;
            @endphp
          </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <td class="text-center" colspan="8">Total Akhir</td>
          <td class="text-center"></td>
          <td class="text-center">{{ number_format($total_all ?? '0') }}</td>
        </tr>
      </tfoot>
    </table>
  </div>
</div>
@endsection