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
   <div class="card mb-2">
    <div class="card-body">
        <div class="row">
            <div class="col-4">
                <h4 class="mb-1 text-primary d-flex">
                    {{ $item->queue->patient->name }} ({{ $item->queue->patient->no_rm ?? }})
                    <span class="ms-2 badge {{ $item->queue->patient->jenis_kelamin == 'Wanita' ? 'bg-danger' : 'bg-info' }}">{{ $item->queue->patient->jenis_kelamin == 'Wanita' ? 'P' : 'L' }}</span> 
                </h4>
                <h6 class="mb-1">{{ $item->queue->dpjp->name }} ({{ $item->queue->dpjp->staff_id }}) / <span class="fw-bold">{{ $item->queue->dpjp->poliklinik->name ?? '' }}</span></h6>
                <h6 class="mb-1"><h6>
                @if ($item->queue->rawatJalanPoliPatient->status == 'WAITING')                                    
                    <span class="badge bg-danger">BELUM DILAYANI</span>
                @elseif ($item->queue->rawatJalanPoliPatient->status == 'ONGOING')
                    <span class="badge bg-warning">DALAM PERAWATAN</span>
                @elseif ($item->queue->rawatJalanPoliPatient->status == 'FINISHED')
                    <span class="badge bg-success">SUDAH DILAYANI</span>
                @else
                    <span class="badge bg-success">TIDAK DIKETAHUI</span>
                @endif
            </div>
            <div class="col-8 text-end">
                <p class="mb-0">No. Antrian : <span class="fst-italic fw-bold">{{ $item->queue->no_antrian ?? '' }}</span></p>
                <p class="mb-0">Tanggungan : <span class="fw-bold fst-italic">{{ $item->queue->patientCategory->name }}</span></p>
                <p class="mb-0">Tgl. Lahir : <span class="fw-bold fst-italic">{{ $item->queue->patient->tanggal_lhr }}</span></p>
            </div>
        </div>
    </div>
</div>
{{-- end Informasi Pasien --}}
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col-6 text-start">
          <h5 class="m-0">Input Hasil Pemeriksaan</h5>
          <div class="">
            Kategori :
            <span class="{{ $item->tipe_permintaan == 'Urgent' ? 'badge bg-danger' : '' }} ms-1 text-uppercase">{{ $item->tipe_permintaan }}</span>
          </div>
        </div>
        <div class="col-6 text-end">
          <span class="m-0 text-primary fw-bold">{{ $item->queue->patient->name }} / {{ $item->queue->patient->no_rm ?? }}</span> <br>
          @if ($item->status == 'WAITING')
              <span class="badge bg-warning">PERMINTAAN</span>
          @elseif ($item->status == 'CANCEL')
              <span class="badge bg-danger">BATAL</span>
          @elseif ($item->status == 'DENIED')
              <span class="badge bg-warning">DITOLAK</span>
          @elseif ($item->status == 'ACCEPTED')
              <span class="badge bg-primary">DITERIMA</span>
          @elseif ($item->status == 'UNVALIDATE')
          <span class="badge bg-danger">BELUM DIVALIDASI</span>
          @elseif ($item->status == 'FINISHED')
              <span class="badge bg-success">SELESAI</span>
          @else
              <span class="badge bg-danger">TIDAK DIKETAHUI</span>
          @endif
        </div>
      </div>
    </div>
    <form action="{{ route('laboratorium/patient/hasil.store', $item->id) }}" method="POST">
    @csrf
      <div class="card-body">
        <div class="row">
          <div class="col-6">
            <div class="row mb-3">
              <label for="diagnosa" class="col-form-label col-3">Diagnosa</label>
              <div class="col-9">
                <input type="text" id="diagnosa" value="{{ $item->diagnosa ?? '' }}" class="form-control" disabled>
              </div>
            </div>
            <div class="row mb-3">
              <label for="tgl-pengambilan-sampel" class="col-form-label col-3">Tgl. Ambil Sampel</label>
              <div class="col-9">
                <input type="text" id="tgl-pengambilan-sampel" class="form-control" value="{{ $item->tanggal_sampel ?? '' }}" disabled >
              </div>
            </div>
    
          </div>
          <div class="col-6">
            <div class="row mb-3">
              <label for="nolabor" class="col-form-label col-3">No. Reg. Labor</label>
              <div class="col-9">
                <input type="text" id="nolabor" class="form-control" value="{{ $item->no_reg ?? '' }}" disabled>
              </div>
            </div>
         
            <div class="row mb-3">
              <label for="tgl-pengambilan-sampel" class="col-form-label col-3">Tgl. Pemeriksaan Selesai</label>
              <div class="col-9">
                <input type="date" id="tgl_periksa" class="form-control" name="tanggal_periksa" value="{{ old('tanggal_periksa',  $item->tanggal_periksa_selesai ?? date('Y-m-d')) }}">
              </div>
            </div>

          </div>
        </div>
        <div class="row mt-4">
              <div class="col-12">
                <table class="table">
                  <thead>
                    <tr class="text-nowrap bg-dark">
                      <th>Kode</th>
                      <th>Nama</th>
                      <th class="text-center">Hasil Pemeriksaan</th>
                      <th class="text-center">Kritis</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($item->laboratoriumRequestDetails as $index => $detail)
                      <tr>
                        <td style="width: 20%">
                          <input type="hidden" name="detail_id[]" value="{{ $detail->id ?? '' }}">
                          {{ $detail->action->action_code ?? '' }}
                        </td>
                        <td style="width: 20%">{{ $detail->action->name ?? '' }}</td>
                        <td style="width: 30%">
                            <div class="input-group">
                              <input type="number" step="0.01" name="hasil[]" class="form-control text-center" value="{{ old('hasil.' . $index, $detail->hasil ?? 0) }}" style="width: 70%">
                              <input type="text" class="form-control" name="satuan[]" value="{{ old('satuan.' .$index, $detail->satuan ?? '') }}" placeholder="satuan" style="width: 30%">
                            </div>
                        </td>
                        <td class="text-center" style="width: 30%">
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="kritis[{{ $index }}]" id="kritis_ya_{{ $index }}" value="1" {{ old('kritis.' . $index, $detail->kritis) == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="kritis_ya_{{ $index }}">YA</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="kritis[{{ $index }}]" id="kritis_no_{{ $index }}" value="0" {{ old('kritis.' . $index, $detail->kritis) == 0 ? 'checked' : '' }}>
                            <label class="form-check-label" for="kritis_no_{{ $index }}">Tidak</label>
                          </div>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
          <div class="card">
            <div class="card-body">
              <textarea name="kesan_anjuran" id="" class="form-control" cols="10" rows="6" placeholder="Tuliskan Kesan, Anjuran atau Catatan Utama Tentang Pemeriksaan yang Dilakukan pada Pasien">{{ $item->kesan_anjuran ?? '' }}</textarea>
            </div>
          </div>
        </div>
        <hr class="my-4">
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-outline-primary me-2"><i class="bx bx-save"></i> Submit</button>
            <a href="{{ route('laboratorium/patient/queue.index') }}" class="btn btn-outline-danger"><i class="bx bx-left-arrow"></i> Kembali</a>
        </div>
      </div>
    </form>
  </div>
@endsection