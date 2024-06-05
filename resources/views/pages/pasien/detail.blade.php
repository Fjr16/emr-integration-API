@extends('layouts.backend.main')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="p-3 mt-5">
        <div class="d-flex p-3 justify-content-between">
            <h4 class="align-self-center m-0">Detail Data Pasien</h4>
            <a href="{{ route('pasien.index') }}" class="btn btn-sm btn-success">Kembali</a>
        </div>
        {{-- <hr class="m-0 mt-2 mb-3"> --}}
        <div class="row mt-3">
            <div class="col col-12 col-lg-6">
                <div class="card shadow-sm p-3">

                    <div class="row px-5">
                        {{-- no rm --}}
                        <div class="col col-4">
                            <label class="col-form-label" for="basic-default-name">No Rekam Medis</label>
                        </div>
                        <div class="col col-8">
                            <p class="mt-2 mb-0"> :
                                &nbsp;&nbsp;&nbsp;{{ implode('-', str_split(str_pad($item->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}
                            </p>
                        </div>

                        {{-- noka --}}
                        <div class="col col-4">
                            <label class="col-form-label" for="basic-default-name">No Kartu</label>
                        </div>
                        <div class="col col-8">
                            <p class="mt-2 mb-0">: &nbsp;&nbsp;&nbsp;{{ $item->noka ?? '-' }}</p>
                        </div>

                        {{-- nama --}}
                        <div class="col col-4">
                            <label for="basic-default-name" class="col-form-label">Nama Pasien</label>
                        </div>
                        <div class="col col-8">
                            <p class="mt-2 mb-0">: &nbsp;&nbsp;&nbsp;{{ $item->name ?? '-' }}</p>
                        </div>

                        {{-- nik --}}
                        <div class="col col-4">
                            <label class="col-form-label" for="basic-default-name">Nik</label>
                        </div>
                        <div class="col col-8">
                            <p class="mt-2 mb-0">: &nbsp;&nbsp;&nbsp;{{ $item->nik ?? '-' }}</p>
                        </div>


                        {{-- ttl --}}
                        <div class="col col-4">
                            <label for="basic-default-name" class="col-form-label">Tempat / Tanggal Lahir</label>
                        </div>
                        <div class="col col-8">
                            <p class="mt-2 mb-0"> : &nbsp;&nbsp;&nbsp;{{ $item->tempat_lhr ?? '-' }} /
                                {{ $item->tanggal_lhr ?? '-' }}</p>
                        </div>

                        {{-- gender --}}
                        <div class="col col-4">
                            <label for="basic-default-name" class="col-form-label">Jenis Kelamin</label>
                        </div>
                        <div class="col col-8">
                            : &nbsp;&nbsp;&nbsp;{{ $item->jenis_kelamin ?? '-' }}
                        </div>

                        {{-- status --}}
                        <div class="col col-4">
                            <label for="basic-default-name" class="col-form-label">Status</label>
                        </div>
                        <div class="col col-8">
                            : &nbsp;&nbsp;&nbsp;{{ $item->status ?? '-' }}
                        </div>

                        {{-- Agama --}}
                        <div class="col col-4">
                            <label for="basic-default-name" class="col-form-label">Agama</label>
                        </div>
                        <div class="col col-8">
                            : &nbsp;&nbsp;&nbsp;{{ $item->agama ?? '-' }}
                        </div>

                        {{-- Nama Ayah --}}
                        <div class="col col-4">
                            <label for="basic-default-name" class="col-form-label">Nama Ayah</label>
                        </div>
                        <div class="col col-8">
                            : &nbsp;&nbsp;&nbsp;{{ $item->nm_ayah ?? '-' }}
                        </div>

                        {{-- Nama Ibu --}}
                        <div class="col col-4">
                            <label for="basic-default-name" class="col-form-label">Nama Ibu</label>
                        </div>
                        <div class="col col-8">
                            : &nbsp;&nbsp;&nbsp;{{ $item->nm_ibu ?? '-' }}
                        </div>

                        {{-- Nama Wali --}}
                        <div class="col col-4">
                            <label for="basic-default-name" class="col-form-label">Nama Wali</label>
                        </div>
                        <div class="col col-8">
                            : &nbsp;&nbsp;&nbsp;{{ $item->nm_wali ?? '-' }}
                        </div>

                        {{-- No telp --}}
                        <div class="col col-4">
                            <label for="basic-default-name" class="col-form-label">No Telp</label>
                        </div>
                        <div class="col col-8">
                            : &nbsp;&nbsp;&nbsp;{{ $item->telp ?? '-' }}
                        </div>

                        {{-- Pendidikan --}}
                        <div class="col col-4">
                            <label for="basic-default-name" class="col-form-label">Pendidikan</label>
                        </div>
                        <div class="col col-8">
                            : &nbsp;&nbsp;&nbsp;{{ $item->pendidikan ?? '-' }}
                        </div>

                        {{-- Pekerjaan --}}
                        <div class="col col-4">
                            <label for="basic-default-name" class="col-form-label">Pekerjaan</label>
                        </div>
                        <div class="col col-8">
                            : &nbsp;&nbsp;&nbsp;{{ $item->job->name ?? '-' }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col col-12 col-lg-6">
                <div class="card shadow-sm p-3">
                    <div class="row px-5 container">
                        {{-- Alamat --}}
                        <div class="col col-4">
                            <label for="basic-default-name" class="col-form-label">Alamat</label>
                        </div>
                        <div class="col col-8">
                            : &nbsp;&nbsp;&nbsp;{{ $item->alamat ?? '-' }}
                        </div>

                        {{-- RT --}}
                        <div class="col col-4">
                            <label for="basic-default-name" class="col-form-label">RT</label>
                        </div>
                        <div class="col col-8">
                            : &nbsp;&nbsp;&nbsp;{{ $item->rt ?? '-' }}
                        </div>

                        {{-- RW --}}
                        <div class="col col-4">
                            <label for="basic-default-name" class="col-form-label">RW</label>
                        </div>
                        <div class="col col-8">
                            : &nbsp;&nbsp;&nbsp;{{ $item->rw ?? '-' }}
                        </div>

                        {{-- Provinsi --}}
                        <div class="col col-4">
                            <label for="basic-default-name" class="col-form-label">Provinsi</label>
                        </div>
                        <div class="col col-8">
                            : &nbsp;&nbsp;&nbsp;{{ $item->province->name ?? '-' }}
                        </div>

                        {{-- Kabupaten --}}
                        <div class="col col-4">
                            <label for="basic-default-name" class="col-form-label">Kabupaten</label>
                        </div>
                        <div class="col col-8">
                            : &nbsp;&nbsp;&nbsp;{{ $item->city->name ?? '-' }}
                        </div>

                        {{-- Kecamatan --}}
                        <div class="col col-4">
                            <label for="basic-default-name" class="col-form-label">Kecamatan</label>
                        </div>
                        <div class="col col-8">
                            : &nbsp;&nbsp;&nbsp;{{ $item->district->name ?? '-' }}
                        </div>

                        {{-- Kelurahan / Desa --}}
                        <div class="col col-4">
                            <label for="basic-default-name" class="col-form-label">Kelurahan / Desa</label>
                        </div>
                        <div class="col col-8">
                            : &nbsp;&nbsp;&nbsp;{{ $item->village->name ?? '-' }}
                        </div>

                        {{-- bangsa --}}
                        <div class="col col-4">
                            <label for="basic-default-name" class="col-form-label">Kewarganegaraan</label>
                        </div>
                        <div class="col col-8">
                            : &nbsp;&nbsp;&nbsp;{{ $item->bangsa ?? '-' }}
                        </div>

                        {{-- Suku --}}
                        <div class="col col-4">
                            <label for="basic-default-name" class="col-form-label">Suku Bangsa</label>
                        </div>
                        <div class="col col-8">
                            : &nbsp;&nbsp;&nbsp;{{ $item->suku ?? '-' }}
                        </div>

                        {{-- alergi --}}
                        <div class="col col-4">
                            <label for="basic-default-name" class="col-form-label">Daftar Alergi Pasien</label>
                        </div>
                        <div class="col col-8">
                            : &nbsp;&nbsp;&nbsp;{{ $item->alergi ?? '-' }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="card bg-warning p-1">
            <div>
                <textarea class="form-control" id="text-area1" rows="9">
              Pasien Yth, {{ $item->name }} sudah terdaftar di RSK Bedah Ropanasuri dengan:

              Nomor RM : {{ $item->no_rm }}
              di Poli : {{ $item->doctor->poli->name ?? '' }}
              Tanggal : {{ $item->tgl_antrian }}
              Jadwal Dokter :

              Mohon melakukan pendaftaran ulang kebagian PENDAFTARAN dimulai pukul 08:00 sampai minimal 15 menit sebelum poliklinik dimulai.
              Dengan membawa KTP/KK, Kartu BPJS/Asuransi, dan Jaminan Lainnya.

            </textarea>
            </div>
            <button type="button" class="btn btn-warning btn-sm mt-2" onclick="copyToClipboard()">Copy</button>
        </div> --}}
    </div>
@endsection
