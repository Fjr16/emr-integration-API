@extends('layouts.backend.main')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div id="success-message"></div>
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Tambah Laporan Pasien Melarikan Diri</h5>
        </div>
        <form action="" method="POST" onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
            @csrf
            <div class="card-body">
                <div class="mb-3 row">
                    <label for="defaultFormControlInput" class="col-form-label col-2">No Rekam Medis</label>
                    <div class="col-10">
                        <select class="form-control select2" id="patient_id" name="patient_id" onchange="getPatient()">
                            <option value="" selected>Pilih</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nama" class="col-form-label col-2">Nama Pasien</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="" disabled/>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="tanggal" class="col-form-label col-2">tanggal lahir</label>
                    <div class="col-10">
                        <input class="form-control" type="date" value="" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="ruangan" class="col-form-label col-2">Ruang Perawatan</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="tanggal_masuk" class="col-form-label col-2">tanggal masuk rumah sakit</label>
                    <div class="col-10">
                        <input class="form-control" type="date" value="" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="tanggal_kejadian" class="col-form-label col-2">tanggal kejadian</label>
                    <div class="col-10">
                        <input class="form-control" type="date" value="" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="ringkasan_kejadian" class="col-form-label col-2">ringkasan kejadian</label>
                    <div class="col-10">
                        <textarea class="form-control" type="text" value="" rows="3"/></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="bahaya" class="col-form-label col-2">membahayakan diri / lingkungan</label>
                    <div class="col-10">
                        <div class="form-check form-check-inline mt-3">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="ya" value="option1" />
                            <label class="form-check-label" for="ya">Ya</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="tidak" value="option2" />
                            <label class="form-check-label" for="tidak">Tidak</label>
                          </div>
                    </div>
                </div>

                <div class="mb-3 text-end">
                    <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                </div>
            </div>
        </form>
    </div>
@endsection
