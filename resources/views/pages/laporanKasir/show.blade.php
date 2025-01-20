@extends('layouts.backend.main')

@section('content')

  <div class="card p-3">
    <div class="card-header d-flex justify-content-between px-0 py-1">
      <h4 class="m-0 mb-2">Riwayat Kunjungan
        <a href="{{ route('laporan/kasir.exportExcel', $item->id) }}" class="btn btn-sm btn-success">Export <i class="bx bxs-file-export"></i></a>
      </h4>
      <div class="">
        <a href="{{ route('laporan/kasir.list', $item->queue->patient->id) }}" class="btn btn-outline-danger btn-sm"><i class="bx bx-left-arrow"></i> Kembali</a>
      </div>
    </div>
    <table class="mb-3">
      <tr>
        <td style="width: 200px">Tgl. Kunjungan</td>
        <td>:</td>
        <td>{{ $item->created_at->format('Y/m/d') }}</td>
      </tr>
      <tr>
        <td style="width: 200px">Nomor Rekam Medis</td>
        <td>:</td>
        <td>{{ $item->queue->patient->no_rm ?? '' }}</td>
      </tr>
      <tr>
        <td>Nama Pasien</td>
        <td>:</td>
        <td>{{ $item->queue->patient->name ?? ''  }}</td>
      </tr>
      <tr>
        <td><h4>Total Tagihan</h4></td>
        <td><h4>:</h4></td>
        <td><h4>Rp. {{ number_format($item->total ?? '-') }}</h4></td>
      </tr>
    </table>

    <h5 class="m-0 mb-2 bg-label-dark text-dark fst-italic p-2"><i class="bx bxs-right-arrow"></i> Tindakan Pasien</h6>
    <table class="table mb-3" >
      <thead>
        <tr class="text-nowrap bg-dark">
          <th>Tindakan</th>
          <th>Tanggal / Jam</th>
          <th>Tarif</th>
        </tr>
      </thead>
      <tbody>
        @if ($item->billingDoctorActions->isNotEmpty() && $item->billingDoctorConsultations->isNotEmpty())     
          @foreach ($item->billingDoctorActions as $detailAction)
          <tr>
            <td>{{ $detailAction->nama_tindakan ?? '' }}</td>
            <td>{{ date('Y/m/d H:i', strtotime($detailAction->tanggal ?? '')) }}</td>
            <td>Rp. {{ number_format($detailAction->tarif ?? '') }}</td>
          </tr>
          @endforeach
          @foreach ($item->billingDoctorConsultations as $detailConsultation)
          <tr>
            <td>Konsul dokter : <span class="fw-bold">{{ $detailConsultation->nama_dokter ?? '' }}</span></td>
            <td>{{ date('Y/m/d H:i', strtotime($detailConsultation->tanggal ?? '')) }}</td>
            <td>Rp. {{ number_format($detailConsultation->tarif ?? '') }}</td>
          </tr>
          @endforeach
        @else
        <tr>
          <td colspan="3" class="text-center fw-bold fst-italic">--- Tidak ada data tindakan pada pasien ---</td>
        </tr>
        @endif
      </tbody>
      <tfoot>
        @if ($item->billingDoctorActions->isNotEmpty() && $item->billingDoctorConsultations->isNotEmpty())
        <tr>
          <td colspan="2" class="text-center fw-bold">Total</td>
          @php
              $totalAction = $item->billingDoctorActions->sum('tarif');
              $totalKonsultasi = $item->billingDoctorConsultations->sum('tarif');
              $totalOfBoth = $totalAction + $totalKonsultasi;
          @endphp
          <td class="fw-bold">Rp. {{ number_format($totalOfBoth) }}</td>
        </tr>
        @endif
      </tfoot>
    </table>
    <hr>
    <h5 class="m-0 mb-2 bg-label-dark text-dark fst-italic p-2"><i class="bx bxs-right-arrow"></i> Pemeriksaan Radiologi Pasien</h6>
    <table class="table mb-3" >
      <thead>
        <tr class="text-nowrap bg-dark">
          <th>Pemeriksaan</th>
          <th>Tanggal / Jam</th>
          <th>Tarif</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($item->billingRadiologies as $detailRadio)
        <tr>
          <td>{{ $detailRadio->kode_tindakan ?? '-' }} / {{ $detailRadio->nama_tindakan ?? '-' }}</td>
          <td>{{ date('Y/m/d H:i', strtotime($detailRadio->tanggal ?? '')) }}</td>
          <td>Rp. {{ number_format($detailRadio->tarif ?? '') }}</td>
        </tr>
        @empty
        <tr>
          <td colspan="3" class="text-center fw-bold fst-italic">--- Tidak ada data pemeriksaan radiologi ---</td>
        </tr>
        @endforelse
      </tbody>
      <tfoot>
        @if ($item->billingRadiologies->isNotEmpty())
        <tr>
          <td colspan="2" class="text-center fw-bold">Total</td>
          <td class="fw-bold">Rp. {{ number_format($item->billingRadiologies->sum('tarif')) }}</td>
        </tr>
        @endif
      </tfoot>
    </table>
    <hr>
    <h5 class="m-0 mb-2 bg-label-dark text-dark fst-italic p-2"><i class="bx bxs-right-arrow"></i> Pemeriksaan Laboratorium</h6>
    <table class="table mb-3" >
      <thead>
        <tr class="text-nowrap bg-dark">
          <th>Pemeriksaan</th>
          <th>Tanggal / Jam</th>
          <th>Tarif</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($item->billingLaboratories as $detailLabor)
        <tr>
          <td>{{ $detailLabor->kode_tindakan ?? '-' }} / {{ $detailLabor->nama_tindakan ?? '-' }}</td>
          <td>{{ date('Y/m/d H:i', strtotime($detailLabor->tanggal ?? '')) }}</td>
          <td>Rp. {{ number_format($detailLabor->tarif ?? '') }}</td>
        </tr>
        @empty
        <tr>
          <td colspan="3" class="text-center fw-bold fst-italic">--- Tidak ada data pemeriksaan labor ---</td>
        </tr>
        @endforelse
      </tbody>
      <tfoot>
        @if($item->billingLaboratories->isNotEmpty())
        <tr>
          <td colspan="2" class="text-center fw-bold">Total</td>
          <td class="fw-bold">Rp. {{ number_format($item->billingLaboratories->sum('tarif')) }}</td>
        </tr>
        @endif
      </tfoot>
    </table>
    <hr>
    <h5 class="m-0 mb-2 bg-label-dark text-dark fst-italic p-2"><i class="bx bxs-right-arrow"></i> Obat Pasien</h5>
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
        @forelse ($item->billingOfMedicineFees as $detailMedicine)
        <tr>
          <td>{{ $detailMedicine->nama_obat ?? '' }}</td>
          <td>{{ number_format($detailMedicine->jumlah ?? '') }} <span class="fw-bold">{{ $detailMedicine->satuan_obat ?? '-' }}</span></td>
          <td>Rp. {{ number_format($detailMedicine->tarif ?? '') }}</td>
          @php
              $total_harga = $detailMedicine->jumlah * $detailMedicine->tarif;
              $grandTotalMedicine += $total_harga;
          @endphp
          <td>Rp. {{ number_format($total_harga ?? '') }}</td>
        </tr>
        @empty
        <tr>
          <td colspan="4" class="text-center fw-bold fst-italic">--- Tidak ada data pembelian obat ---</td>
        </tr>
        @endforelse
      </tbody>
      <tfoot>
        @if ($item->billingOfMedicineFees->isNotEmpty())
        <tr>
          <td colspan="3" class="text-center fw-bold">Total</td>
          <td class="fw-bold">Rp. {{ number_format($grandTotalMedicine ?? '') }}</td>
        </tr>
        @endif
      </tfoot>
    </table>
  </div>

@endsection
