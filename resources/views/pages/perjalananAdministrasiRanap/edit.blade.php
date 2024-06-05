@extends('layouts.backend.main')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Tambah Tindakan</h5>
        </div>
        <div class="card-body">
            <div class="row mb-3 container">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Pasien :</label>
                <div class="col-sm-10">
                    <input type="text" name="#" class="form-control" id="basic-default-name"
                        value="{{ $data->patient->name }}"@disabled(true)>
                </div>
            </div>

            <div class="row mt-5">
                <hr>
                <div class="col-sm-2">
                    <a href="{{ route('perjalananadministrasi-ranap.rekam-medis', $data->id) }}"
                        class="btn btn-sm btn-dark">Rekam
                        Medis</a>
                </div>
                <div class="col-sm-2">
                    <a href="{{ route('perjalananadministrasi-ranap.asuransi', $data->id) }}"
                        class="btn btn-sm btn-dark">Asuransi Lain</a>
                </div>
                <div class="col-sm-2">
                    <a href="{{ route('perjalananadministrasi-ranap.registrasi', $data->id) }}"
                        class="btn btn-sm btn-dark">Perawat Registrasi</a>
                </div>
                <div class="col-sm-2">
                    <a href="{{ route('perjalananadministrasi-ranap.kamar-bedah', $data->id) }}"
                        class="btn btn-sm btn-dark">Kamar Bedah</a>
                </div>
                <div class="col-sm-2">
                    <a href="{{ route('perjalananadministrasi-ranap.laboratorium', $data->id) }}"
                        class="btn btn-sm btn-dark">Laboratorium</a>
                </div>
                <div class="col-sm-2">
                    <a href="{{ route('perjalananadministrasi-ranap.farmasi-kasir', $data->id) }}"
                        class="btn btn-sm btn-dark">Farmasi-Kasir</a>
                </div>
            </div>
            <hr>
            @yield('form')
            {{-- <div class="row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-sm btn-dark">Simpan</button>
                    </div>
            </div> --}}

        </div>
    </div>
@endsection
