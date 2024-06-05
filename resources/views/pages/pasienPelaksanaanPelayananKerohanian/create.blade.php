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
            <h5 class="mb-0">Tambah Bukti Pelaksanaan Pelayanan Kerohanian</h5>
        </div>
        <form action="" method="POST" onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
            @csrf
            <div class="card-body">
                <h5 class="m-0">Rohaniawan</h5>
                <hr class="m-0 mb-3">
                <div class="row mb-3">
                    <label for="nama_rohaniawan" class="col-form-label col-2">Nama Rohaniawan</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="umur" class="col-form-label col-2">umur</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="agama" class="col-form-label col-2">agama</label>
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
                    <label for="waktu_pelaksanaan" class="col-form-label col-2">waktu pelaksanaan</label>
                    <div class="col-4">
                        <input class="form-control" type="dateTime-local" value="" />
                    </div>
                    <div class="col-1 text-center align-self-center">
                        s/d
                    </div>
                    <div class="col-5">
                        <input class="form-control" type="dateTime-local" value="" />
                    </div>
                </div>
                <h5 class="m-0">Pasien</h5>
                <hr class="m-0 mb-3">
                <div class="row mb-3">
                    <label for="nama_pasien" class="col-form-label col-2">nama pasien</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="no_rm" class="col-form-label col-2">Nomor RM</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="umur" class="col-form-label col-2">umur</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="ruangan" class="col-form-label col-2">Ruangan</label>
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
