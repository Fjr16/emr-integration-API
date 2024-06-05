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
            <h5 class="mb-0">Tambah Permintaan Pelaksanaan Pelayanan Kerohanian</h5>
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
                    <label for="alamat" class="col-form-label col-2">Alamat</label>
                    <div class="col-10">
                        <textarea class="form-control" type="text" value="" /></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="ruangan" class="col-form-label col-2">Ruangan</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="Agama" class="col-form-label col-2">Agama</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="yang_meminta" class="col-form-label col-2">Yang Meminta</label>
                    <div class="col-10">
                        <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="yang_meminta">
                            <option selected disabled>Pilih</option>
                            <option value="pasien">Pasien</option>
                            <option value="keluarga">Kaluarga</option>
                            <option value="wali">Wali</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="peminta" class="col-form-label col-2">Nama Yang Meminta</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="rohaniawan_dari" class="col-form-label col-2">Rohaniawan Dari</label>
                    <div class="col-10">
                        <div class="form-check">
                            <input name="rohaniawan-dari" class="form-check-input" type="radio" value="" id="ropanasuri" />
                            <label class="form-check-label" for="ropanasuri">
                              RSK Bedah Ropanasuri
                            </label>
                        </div>
                        <div class="form-check">
                            <input name="rohaniawan-dari" class="form-check-input" type="radio" value="" id="keluargaPasien" />
                            <label class="form-check-label" for="keluargaPasien">
                              Pihak Keluarga / Pasien
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="tanggal_permintaan" class="col-form-label col-2">Tanggal Permintaan</label>
                    <div class="col-10">
                        <input class="form-control" type="dateTime-local" value="" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nama_rohaniawan" class="col-form-label col-2">Nama Rohaniawan</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="no_telp" class="col-form-label col-2">No. Telp / HP</label>
                    <div class="col-10">
                        <input class="form-control" type="number" value="" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="konfirmasi_rohaniawan" class="col-form-label col-2">Konfirmasi Rohaniawan</label>
                    <div class="col-10">
                        <input class="form-control" type="dateTime-local" value="" />
                    </div>
                </div>


                <div class="mb-3 text-end">
                    <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                </div>
            </div>
        </form>
    </div>
@endsection
