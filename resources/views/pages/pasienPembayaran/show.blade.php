@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif
  {{-- Informasi Pasien --}}
  <div class="card mb-2">
    <div class="card-body">
        <div class="row">
            <div class="col-4">
                <h4 class="mb-1 text-primary d-flex">
                    {{ $item->queue->patient->name }} ({{ implode('-', str_split(str_pad($item->queue->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }})
                    <span class="ms-2 badge {{ $item->queue->patient->jenis_kelamin == 'Wanita' ? 'bg-danger' : 'bg-info' }}">{{ $item->queue->patient->jenis_kelamin == 'Wanita' ? 'P' : 'L' }}</span> 
                </h4>
                <h6 class="mb-1">{{ $item->queue->dpjp->name }} ({{ $item->queue->dpjp->staff_id }})</h6>
                <h6 class="mb-1">{{ $item->queue->dpjp->poliklinik->name ?? '' }}<h6>
                @if ($item->status == 'WAITING')                                    
                    <span class="badge bg-danger">BELUM BAYAR</span>
                @elseif ($item->status == 'FINISHED')
                    <span class="badge bg-success">SUDAH BAYAR</span>
                @else
                    <span class="badge bg-success">TIDAK DIKETAHUI</span>
                @endif
            </div>
            <div class="col-8 text-end">
                <p class="mb-0">No. Antrian : <span class="fst-italic fw-bold">{{ $item->queue->no_antrian ?? '' }}</span></p>
                <p class="mb-0">Tanggungan : <span class="fw-bold fst-italic">{{ $item->queue->patientCategory->name }}</span></p>
                <p class="mb-0">Tgl. Lahir : <span class="fw-bold fst-italic">{{ $item->queue->patient->tanggal_lhr }}</span></p>
                <div class="mb-0 mt-3 d-flex justify-content-end">
                  <h2 class="fw-bold fst-italic rounded p-2 ">Rp. {{ number_format($item->total ?? 0) }}</h2>
                </div>
            </div>
        </div>
    </div>
  </div>
  {{-- end Informasi Pasien --}}
  <div class="card p-3">
    @if (empty($item->billingDoctorConsultations) || empty($item->detailKasirPatients))    
      <div class="alert-secondary p-4" role="alert">
        <h4 class="alert-heading d-flex align-items-center"><span class="alert-icon rounded-circle me-2"><i class='bx bx-error-alt'></i></span> Belum Ada Tagihan</h4>
        <hr>
        <div class="d-flex flex-column ps-1">
          <span>Mohon menunggu tagihan pasien dimasukkan oleh staff medis lainnya, tagihan akan muncul jika pasien telah menerima beberapa pelayanan !</span>
        </div>
      </div>
    @else    
    <div class="table-responsive">
      <table class="table">
        <thead class="table-success">
          <tr>
            {{-- <th>Kategori</th> --}}
            <th class="text-dark">No</th>
            <th class="text-dark">Kode / Nama</th>
            <th class="text-dark text-center">Tarif</th>
            <th class="text-dark text-center">Jumlah</th>
            <th class="text-dark text-center">Sub Total</th>
          </tr>
        </thead>
        <tbody>
          <tr class=" ">
            <td colspan="5"><h6 class="fw-bold fst-italic  small text-uppercase m-0 p-0"># Jasa Dokter</h6></td>
          </tr>
          @foreach ($item->billingDoctorConsultations as $jasaDokter)
          <tr>
            {{-- <td>Jasa Dokter</td> --}}
            <td>{{ $loop->iteration }}</td>
            <td>{{ ($jasaDokter->kode_dokter ?? $item->queue->dpjp->staff_id) . ' / ' .($jasa_dokter->nama_dokter ?? $item->queue->dpjp->name) }}</td>
            <td class="text-center">Rp. {{ number_format($jasaDokter->tarif ?? 0) }}</td>
            <td class="text-center">1</td>
            <td class="text-center">Rp. {{ number_format($jasaDokter->tarif ?? 0) }}</td>
          </tr>
          @endforeach
          @if (!$item->queue->rawatJalanPoliPatient->actions_ready == false || !empty($item->billingDoctorActions))
          <tr>
            <td colspan="5">
              <div class="d-flex justify-content-start m-0 p-0">
                <h6 class="align-self-center fw-bold fst-italic small text-uppercase me-2 m-0 p-0"># Tindakan Pelayanan Medis</h6>
                @if ($item->queue->rawatJalanPoliPatient->actions_ready == true && !empty($item->billingDoctorActions))
                <form action="{{ route('rajal/kasir/revisi/billing.tindakan', $item->queue->rawatJalanPoliPatient->id) }}" method="POST">
                  @method('PUT')
                  @csrf
                  <button type="submit" class="m-0 p-1 btn btn-sm btn-warning small" onclick="return confirm('Apakah Anda Ingin mengajukan revisi Tagihan Tindakan ?')">Ajukan Revisi</button>
                </form>
                @elseif ($item->queue->rawatJalanPoliPatient->actions_ready == false && !empty($item->billingDoctorActions))
                  <span class="m-0 p-1 badge bg-danger small">Menunggu Perbaikan</span>
                @else
                  <span class="m-0 p-1 badge bg-danger small"><i class="bx bx-x"></i> Error</span>
                @endif
              </div>
            </td>
          </tr>
          @endif
          @foreach ($item->billingDoctorActions as $tindakanMedis)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ ($tindakanMedis->kode_tindakan ?? ($tindakanMedis->action->action_code ?? '')) . ' / ' . ($tindakanMedis->nama_tindakan ?? ($tindakanMedis->action->name ?? '')) }}</td>
              <td class="text-center">Rp. {{ number_format($tindakanMedis->tarif ?? 0) }}</td>
              <td class="text-center">{{ $tindakanMedis->jumlah ?? 0 }}</td>
              <td class="text-center">Rp. {{ number_format($tindakanMedis->sub_total ?? 0) }}</td>
            </tr>
          @endforeach
          <tr>
            <td colspan="5"><h6 class="fw-bold fst-italic small text-uppercase m-0 p-0"># Tindakan Radiologi</h6></td>
          </tr>
          <tr>
            <td>1</td>
            <td>Trevor Baker</td>
            <td class="text-center">Rp. 35.000</td>
            <td class="text-center">10</td>
            <td class="text-center">Rp. 350.000</td>
          </tr>
        </tbody>
      </table>
    </div>
      {{-- <h6 class="m-0 mb-2">Jasa Dokter</h6>
      <table class="table mb-3">
        <thead>
          <tr class="text-nowrap bg-dark">
            <th>Kode / Nama </th>
            <th>Tarif</th>
            <th>Jumlah</th>
            <th>Sub Total</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($item->billingDoctorConsultations as $jasaDokter)
          <tr>
            <td>{{ ($jasaDokter->kode_dokter ?? $item->queue->dpjp->staff_id) . ' / ' .($jasa_dokter->nama_dokter ?? $item->queue->dpjp->name) }}</td>
            <td>{{ number_format($jasaDokter->tarif ?? 0) }}</td>
            <td>1</td>
            <td>{{ number_format($jasaDokter->tarif ?? 0) }}</td>
          </tr>
          @endforeach
        </tbody>
      </table> --}}
    @endif
    {{-- @can('lihat detail pembayaran')
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
    <div class="d-flex mt-3 ms-auto">
      @can('perbarui status pembayaran')
      @if ($item->status == 'SELESAI')
        <button class="btn btn-sm btn-success mx-1" disabled>LUNAS</button>
      @else
        <form action="{{ route('rajal/kasir/pembayaran/update', $item->id) }}" method="POST">
        @method('PUT')
        @csrf
          <button type="submit" class="btn btn-sm btn-danger mx-1" name="status" value="SELESAI" onclick="return confirm('Yakin Ingin Melanjutkan ? ')">Konfirmasi Pembayaran</button>
        </form>
      @endif
      @endcan
      @can('print nota pembayaran')
      <a target="blank" href="{{ route('rajal/kasir/pembayaran/show', $item->id) }}" class="btn btn-sm btn-dark"><i class="bx bx-printer"></i></a>
      @endcan
    </div> --}}
  </div>

@endsection
