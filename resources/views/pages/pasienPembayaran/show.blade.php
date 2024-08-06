@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
<div class="alert alert-success d-flex" role="alert">
    <span class="alert-icon rounded-circle"><i class='bx bxs-check-circle' style="font-size: 40px"></i></span>
    <div class="d-flex flex-column ps-1">
        <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">BERHASIL !!</h6>
        <span>{{ session('success') }}</span>
    </div>
</div>
@endif
@if (session()->has('error'))
<div class="alert alert-danger d-flex" role="alert">
    <span class="alert-icon rounded-circle"><i class='bx bxs-x-circle' style="font-size: 40px"></i></span>
    <div class="d-flex flex-column ps-1">
        <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">ERROR !!</h6>
        <span>{{ session('error') }}</span>
    </div>
</div>
@endif
@if (session()->has('exceptions'))
<div class="alert alert-danger d-flex" role="alert">
    <span class="alert-icon rounded-circle"><i class='bx bxs-x-circle' style="font-size: 40px"></i></span>
    <div class="d-flex flex-column ps-1">
        <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">ERROR !!</h6>
        <span>
          @foreach (session('exceptions') as $error)
            <li>{{ $error }}</li>
          @endforeach
        </span>
    </div>
</div>
@endif
@if ($errors->any())
<div class="alert alert-danger d-flex" role="alert">
    <span class="alert-icon rounded-circle"><i class='bx bxs-x-circle' style="font-size: 40px"></i></span>
    <div class="d-flex flex-column ps-1">
        <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">ERROR !!</h6>
        <span>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </span>
    </div>
</div>
@endif
  {{-- Informasi Pasien --}}
  <div class="card mb-1">
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
                {{-- <div class="mb-0 mt-3 d-flex justify-content-end"> --}}
                  {{-- <h2 class="fw-bold fst-italic rounded p-2 ">Rp. {{ number_format($item->total ?? 0) }}</h2> --}}
                  {{-- <h2 class="fw-bold fst-italic rounded p-2 ">Rp. {{ number_format($totalAkhir ?? 0) }}</h2> --}}
                {{-- </div> --}}
            </div>
        </div>
        <hr>
        <div class="d-flex justify-content-between">
            <h3 class="fst-italic align-self-center text-uppercase">Total</h3>
            <h2 class="fw-bold fst-italic rounded">Rp. {{ number_format($totalAkhir ?? 0) }}</h2>
        </div>
        <hr class="my-0">
    </div>
  </div>
  {{-- end Informasi Pasien --}}
  <div class="card p-3">
    @if (empty($item->billingDoctorConsultations) && empty($item->billingDoctorActions) && empty($item->billingRadiologies) && empty($item->billingLaboratories) && empty($item->billingOfMedicineFees))    
      <div class="alert-secondary p-4" role="alert">
        <h4 class="alert-heading d-flex align-items-center"><span class="alert-icon rounded-circle me-2"><i class='bx bx-error-alt'></i></span> Belum Ada Tagihan</h4>
        <hr>
        <div class="d-flex flex-column ps-1">
          <span>Mohon menunggu tagihan pasien dimasukkan oleh staff medis lainnya, tagihan akan muncul jika pasien telah menerima beberapa pelayanan !</span>
        </div>
      </div>
    @else    
    <div class="table-responsive">
    <form action="{{ route('rajal/kasir/pembayaran/update', encrypt($item->id)) }}" method="POST">
      @method('PUT')
      @csrf
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
          <tr>
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
          @if (!$item->queue->rawatJalanPoliPatient->actions_ready == false || !$item->billingDoctorActions->isEmpty())
          <tr>
            <td colspan="5">
              <div class="d-flex justify-content-start m-0 p-0">
                <h6 class="align-self-center fw-bold fst-italic small text-uppercase me-2 m-0 p-0"># Tindakan Pelayanan Medis</h6>
                @if ($item->queue->rawatJalanPoliPatient->actions_ready == true && !$item->billingDoctorActions->isEmpty())
                <form action="{{ route('rajal/kasir/revisi/billing.tindakan', $item->queue->rawatJalanPoliPatient->id) }}" method="POST">
                  @method('PUT')
                  @csrf
                  <button type="submit" class="m-0 p-1 btn btn-sm btn-outline-warning small" onclick="return confirm('Apakah Anda Ingin mengajukan revisi Tagihan Tindakan ?')">Ajukan Revisi</button>
                </form>
                @elseif ($item->queue->rawatJalanPoliPatient->actions_ready == false && !$item->billingDoctorActions->isEmpty())
                  <span class="m-0 p-1 badge bg-danger small">REVISI</span>
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
              <td class="text-center">{{ $tindakanMedis->jumlah ?? 1 }}</td>
              <td class="text-center">Rp. {{ number_format($tindakanMedis->sub_total ?? 0) }}</td>
            </tr>
          @endforeach

          @if (!$item->billingRadiologies->isEmpty())
          <tr>
            <td colspan="5">
                <h6 class="align-self-center fw-bold fst-italic small text-uppercase me-2 m-0 p-0"># Pemeriksaan Radiologi</h6>
            </td>
          </tr>
          @endif
          
          @foreach ($item->billingRadiologies as $rad)     
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ ($rad->kode_tindakan ?? ($rad->action->action_code ?? '')) . ' / ' . ($rad->nama_tindakan ?? ($rad->action->name ?? '')) }}</td>
              <td class="text-center">Rp. {{ number_format($rad->tarif ?? 0) }}</td>
              <td class="text-center">{{ $rad->jumlah ?? 1 }}</td>
              <td class="text-center">Rp. {{ number_format($rad->sub_total ?? 0) }}</td>
            </tr>
          @endforeach

          @if (!$item->billingLaboratories->isEmpty())
          <tr>
            <td colspan="5">
                <h6 class="align-self-center fw-bold fst-italic small text-uppercase me-2 m-0 p-0"># Pemeriksaan Laboratorium</h6>
            </td>
          </tr>
          @endif
          
          @foreach ($item->billingLaboratories as $lab)     
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ ($lab->kode_tindakan ?? ($lab->action->action_code ?? '')) . ' / ' . ($lab->nama_tindakan ?? ($lab->action->name ?? '')) }}</td>
              <td class="text-center">Rp. {{ number_format($lab->tarif ?? 0) }}</td>
              <td class="text-center">{{ $lab->jumlah ?? 1 }}</td>
              <td class="text-center">Rp. {{ number_format($lab->sub_total ?? 0) }}</td>
            </tr>
          @endforeach

          @if (!$item->billingOfMedicineFees->isEmpty())
          <tr>
            <td colspan="5">
                <h6 class="align-self-center fw-bold fst-italic small text-uppercase me-2 m-0 p-0"># Resep Obat</h6>
            </td>
          </tr>
          @endif
          
          @foreach ($item->billingOfMedicineFees as $med)     
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ ($med->kode_obat ?? '-') . ' / ' . ($med->nama_obat ?? '-') }}</td>
              <td class="text-center">Rp. {{ number_format($med->tarif ?? 0) }}</td>
              <td class="text-center">{{ $med->jumlah ?? 1 }} <span class="small fw-bold fst-italic">{{ $med->satuan_obat ?? '' }}</span></td>
              <td class="text-center">Rp. {{ number_format($med->sub_total ?? 0) }}</td>
              {{-- <td class="text-center">{{ $med->ditanggung_asuransi ? 'Ya' : 'Tidak') }}</td> --}}
            </tr>
          @endforeach

          {{-- total pembayaran --}}
          <tr class="table-primary">
            <td colspan="4">
              <h4 class="my-auto">Total Akhir</h4>
            </td>
            <td class="text-center">
              <h4 class="my-auto">
                Rp. {{ number_format($totalAkhir) }}
              </h4>
            </td>
          </tr>
          <tr class="bg-primary">
            <td colspan="4">
              <h4 class="text-white my-auto">Status Tagihan</h4>
            </td>
            <td class="text-center">
              <h4 class="my-auto text-center">
                <select class="form-control text-center" name="status" id="status">
                  <option value="WAITING" @selected($item->status == 'WAITING')>BELUM BAYAR</option>
                  <option value="FINISHED" @selected($item->status == 'FINISHED')>SUDAH BAYAR</option>
                </select>
              </h4>
            </td>
          </tr>
        </tbody>
      </table>
      <hr>
      <div class="d-flex justify-content-center my-3">
        <button type="submit" class="btn btn-outline-primary me-2"><i class="bx bx-save"></i> Submit</button>
        <a href="{{ route('rajal/kasir/pembayaran/index') }}" class="btn btn-outline-danger"><i class="bx bx-left-arrow"></i> Kembali</a>
      </div>
    </form>
    </div>
    @endif
  </div>

@endsection
