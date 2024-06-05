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
            <h5 class="mb-0">Tambah Pasien Second Opinion</h5>
        </div>
        <form action="" method="POST" onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
            @csrf
            <div class="card-body">
                <div class="row mb-3">
                    <label for="nama" class="col-form-label col-2">Nama Peminta Second Opinion</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nik" class="col-form-label col-2">NIK</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="alamat" class="col-form-label col-2">alamat</label>
                    <div class="col-10">
                        <textarea class="form-control" type="text" value="" /></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nama_pasien" class="col-form-label col-2">nama pasien</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="dokter_yang_dituju" class="col-form-label col-2">Dokter Yang Dituju</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="rumah_sakit" class="col-form-label col-2">Nama rumah Sakit</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="rumah_sakit" class="col-form-label col-2">Nama rumah Sakit</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="hasil_pemeriksaan_penunjang" class="col-form-label col-2">Hasil Pemeriksaan Penunjang Yang di Perlukan</label>
                    <div class="col-9 align-self-center">
                        <input class="form-control" type="text" value="" />
                    </div>
                    <div class="col-1 text-center align-self-center">
                        <button class="btn btn-dark btn-sm"><i class='bx bx-plus'></i></button>
                    </div>
                </div>
                <h5 class="m-0">Saksi</h5>
                <hr class="m-0 mb-3">
                <div class="row mb-3">
                    <label for="pihak-keluarga" class="col-form-label col-2">Nama Pihak Keluarga</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="pihak-rumahsakit" class="col-form-label col-2">Nama Pihak Rumah Sakit</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="" />
                    </div>
                </div>
                <div class="mb-3 text-end">
                    <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                </div>
            </div>
        </form>
    </div>
@endsection
