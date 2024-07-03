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
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col-6 d-flex justify-content-start">
          <h5 class="m-0">Input Hasil Pemeriksaan</h5>
          <span class="badge {{ $item->tipe_permintaan == 'Urgent' ? 'bg-danger' : 'bg-secondary' }} ms-2 text-uppercase">{{ $item->tipe_permintaan }}</span>
        </div>
        <div class="col-6 text-end">
          <span class="m-0 text-primary fw-bold">{{ $item->patient->name }} / {{ implode('-', str_split(str_pad($item->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}</span>
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
                <input type="date" id="tgl_periksa" class="form-control" name="tanggal_periksa" value="{{ $item->tanggal_periksa_selesai ?? date('Y-m-d') }}">
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
                      <th class="text-center">Hasil</th>
                      <th class="text-center">Kritis</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($item->laboratoriumRequestDetails as $index => $detail)
                      <tr>
                        <td>
                          <input type="hidden" name="detail_id[]" value="{{ $detail->id ?? '' }}">
                          {{ $detail->action->icd_code ?? '' }}
                        </td>
                        <td>{{ $detail->action->name ?? '' }}</td>
                        <td>
                          <input type="number" step="0.01" name="hasil[]" class="form-control form-control-sm text-center" value="{{ $detail->hasil ?? 0 }}">
                        </td>
                        <td class="text-center">
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="kritis[{{ $index }}]" id="kritis_ya_{{ $index }}" value="1" {{ $detail->kritis ? 'checked' : '' }}>
                            <label class="form-check-label" for="kritis_ya_{{ $index }}">YA</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="kritis[{{ $index }}]" id="kritis_no_{{ $index }}" value="0" {{ $detail->kritis == 0 ? 'checked' : '' }}>
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
        <div class="mt-4 text-end">
          <button type="submit" class="btn btn-success btn-sm">Simpan</button>
        </div>
      </div>
    </form>
  </div>
@endsection