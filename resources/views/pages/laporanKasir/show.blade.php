@extends('layouts.backend.main')

@section('content')

  <div class="card p-3">
    <h4 class="m-0 mb-2">Riwayat Pembayaran Kunjungan <span class="
      text-primary">{{ $item->created_at->format('Y/m/d') }}</span>
      <a href="{{ route('laporan/kasir.exportExcel', $item->id) }}" class="btn btn-sm btn-success">Export <i class="bx bxs-file-export"></i></a>
    </h4>
    <table class="mb-3">
      <tr>
        <td style="width: 200px">Nomor Rekam Medis</td>
        <td>:</td>
        <td>{{ implode('-', str_split(str_pad($item->rawatJalanPatient->queue->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}</td>
      </tr>
      <tr>
        <td>Nama Pasien</td>
        <td>:</td>
        <td>{{ $item->rawatJalanPatient->queue->patient->name ?? ''  }}</td>
      </tr>
      <tr>
        <td>Total</td>
        <td>:</td>
        <td>{{ number_format($item->total ?? '') }}</td>
      </tr>
    </table>

    @can('lihat detail pembayaran')
    <h6 class="m-0 mb-2">Data Tindakan Pasien</h6>
    <table class="table mb-3" >
      <thead>
        <tr class="text-nowrap bg-dark">
          <th>Tindakan</th>
          <th>Tanggal / Jam</th>
          <th>Tarif</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($item->detailKasirPatients->where('category', 'Action') as $detail)
        <tr>
          <td>{{ $detail->name ?? '' }}</td>
          <td>{{ date('Y/m/d H:i', strtotime($detail->tanggal ?? '')) }}</td>
          <td>{{ number_format($detail->tarif ?? '') }}</td>
        </tr>
        @endforeach
        @foreach ($item->detailKasirPatients->where('category', 'Konsultasi') as $detail)
        <tr>
          <td>{{ $detail->name ?? '' }}</td>
          <td>{{ date('Y/m/d H:i', strtotime($detail->tanggal ?? '')) }}</td>
          <td>{{ number_format($detail->tarif ?? '') }}</td>
        </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <td colspan="2" class="text-center">Total</td>
          @php
              $totalAction = $item->detailKasirPatients->where('category', 'Action')->sum('tarif');
              $totalKonsultasi = $item->detailKasirPatients->where('category', 'Konsultasi')->sum('tarif');
              $totalOfBoth = $totalAction + $totalKonsultasi;
          @endphp
          <td>{{ number_format($totalOfBoth) }}</td>
        </tr>
      </tfoot>
    </table>
    <hr>
    <h6 class="m-0 mb-2">Data Pemeriksaan Radiologi Pasien</h6>
    <table class="table mb-3" >
      <thead>
        <tr class="text-nowrap bg-dark">
          <th>Pemeriksaan</th>
          <th>Tanggal / Jam</th>
          <th>Tarif</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($item->detailKasirPatients->where('category', 'Pemeriksaan Radiologi') as $detail)
        <tr>
          <td>{{ $detail->name ?? '' }}</td>
          <td>{{ date('Y/m/d H:i', strtotime($detail->tanggal ?? '')) }}</td>
          <td>{{ number_format($detail->tarif ?? '') }}</td>
        </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <td colspan="2" class="text-center">Total</td>
          <td>{{ number_format($item->detailKasirPatients->where('category', 'Pemeriksaan Radiologi')->sum('tarif')) }}</td>
        </tr>
      </tfoot>
    </table>
    <hr>
    <h6 class="m-0 mb-2">Data Pemeriksaan Laboratorium Patologi Klinik</h6>
    <table class="table mb-3" >
      <thead>
        <tr class="text-nowrap bg-dark">
          <th>Pemeriksaan</th>
          <th>Tanggal / Jam</th>
          <th>Tarif</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($item->detailKasirPatients->where('category', 'Pemeriksaan Laboratorium PK') as $detailPk)
        <tr>
          <td>{{ $detailPk->name ?? '' }}</td>
          <td>{{ date('Y/m/d H:i', strtotime($detailPk->tanggal ?? '')) }}</td>
          <td>{{ number_format($detailPk->tarif ?? '') }}</td>
        </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <td colspan="2" class="text-center">Total</td>
          <td>{{ number_format($item->detailKasirPatients->where('category', 'Pemeriksaan Laboratorium PK')->sum('tarif')) }}</td>
        </tr>
      </tfoot>
    </table>
    <hr>
    <h6 class="m-0 mb-2">Data Obat Pasien</h6>
    <table class="table mb-3" >
      <thead>
        <tr class="text-nowrap bg-dark">
          <th>Nama Obat</th>
          <th>Jumlah</th>
          <th>Harga Satuan</th>
          <th>Total Harga</th>
        </tr>
      </thead>
      <tbody>
        @php
            $grandTotalMedicine = 0;
        @endphp
        @foreach ($item->detailKasirPatients->where('category', 'Medicine') as $detailMedicine)
        <tr>
          <td>{{ $detailMedicine->name ?? '' }}</td>
          <td>{{ number_format($detailMedicine->jumlah ?? '') }}</td>
          <td>{{ number_format($detailMedicine->tarif ?? '') }}</td>
          @php
              $total_harga = $detailMedicine->jumlah * $detailMedicine->tarif;
              $grandTotalMedicine += $total_harga;
          @endphp
          <td>{{ number_format($total_harga ?? '') }}</td>
        </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <td colspan="3" class="text-center">Total</td>
          <td>{{ number_format($grandTotalMedicine ?? '') }}</td>
        </tr>
      </tfoot>
    </table>
    @endcan
  </div>

@endsection
