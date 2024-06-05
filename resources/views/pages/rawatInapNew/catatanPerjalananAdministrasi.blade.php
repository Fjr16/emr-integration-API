@extends('layouts.backend.main')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger w-100 border mb-5 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('error') }}
        </div>
    @endif
    <div class="d-flex justify-content-end mb-3 mt-0">
        @can(['finish pasien poli', 'show pasien poli'])
            <form action="" method="POST"
                onsubmit="return confirm('Sebelum melanjutkan, Pastikan data telah diisi dengan benar dan lengkap !!!. Apakah anda yakin untuk melanjutkan ? ')">
                @method('PUT')
                @csrf
                <input type="hidden" name="title" value="{{ $title }}">
                <button type="submit" class="btn btn-success btn-sm" name="status" value="SELESAI">Selesai</button>
            </form>
        @endcan
    </div>

    <div class="card">
        {{-- Informasi Pasien --}}
        <div class="card-body">
            <h4>Data Pasien</h4>
            <div class="row mt-4 px-5">
                <div class="col-12 col-lg-6">
                    <table>
                        <tbody>
                            <tr>
                                <td class="pb-3">Nama</td>
                                <td class="pb-3 px-2">:</td>
                                <td class="pb-3">{{ $item->queue->patient->name ?? '' }}</td>
                            </tr>
                            <tr>
                                <td class="pb-3">Tempat lahir</td>
                                <td class="pb-3 px-2">:</td>
                                <td class="pb-3">{{ $item->queue->patient->tempat_lhr ?? '' }}</td>
                            </tr>
                            <tr>
                                <td class="pb-3">Tanggal Lahir</td>
                                <td class="pb-3 px-2">:</td>
                                <td class="pb-3">{{ $item->queue->patient->tanggal_lhr ?? '' }}</td>
                            </tr>
                            <tr>
                                <td class="pb-3">Jenis Kelamin</td>
                                <td class="pb-3 px-2">:</td>
                                <td class="pb-3">{{ $item->queue->patient->jenis_kelamin ?? '' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-12 col-lg-6">
                    <table>
                        <tbody>
                            <tr>
                                <td class="pb-3">Status Kawin</td>
                                <td class="pb-3 px-2">:</td>
                                <td class="pb-3">{{ $item->queue->patient->name ?? '' }}</td>
                            </tr>
                            <tr>
                                <td class="pb-3">No. Hp</td>
                                <td class="pb-3 px-2">:</td>
                                <td class="pb-3">{{ $item->queue->patient->telp ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td>{{ $item->queue->patient->district->name ?? '' }},
                                    {{ $item->queue->patient->village->name ?? '' }},
                                    {{ $item->queue->patient->city->name }},
                                    {{ $item->queue->patient->province->name }},{{ $item->queue->patient->alamat }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- end Informasi Pasien --}}


        {{-- Menu Catatan Perjalanan Administrasi --}}
        <div class="card-body">
            <div class="nav-align-top mb-4 shadow-sm">
                <ul class="nav nav-tabs nav-sm nav-fill" role="tablist">
                    <li class="nav-item">
                        <button id="btn-link" type="button" {{-- @dd(session()->all()) --}}
                            class="nav-link {{ session('btn') == 'cpa' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-cpa"
                            aria-controls="navs-justified-cpa" aria-selected="true">
                            <i class="tf-icons bx bx-bookmark-alt-plus"></i>
                            <p class="m-0">Catatan Perjalanan Administrasi</p>
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade {{ session('btn') == 'cpa' ? 'show active' : '' }}" id="navs-justified-cpa"
                        role="tabpanel">
                        <div class="row">
                            <div class="col-sm-12">
                                <h6>Catatan Perjalanan Adminstrasi Pasien</h6>
                                <div class="card">
                                    <table class="table">
                                        <thead>
                                            <tr class="text-nowrap bg-dark">
                                                <th>No</th>
                                                <th>Bagian</th>
                                                <th>User</th>
                                                <th>Administrasi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @can('tambah catatan perjalanan administrasi')
                                                <tr>
                                                    <td>1</td>
                                                    <td>Rekam Medis</td>
                                                    <td>-</td>
                                                    <td>
                                                        {{-- <a href="{{ route('perjalananadministrasi-ranap.rekam-medis', $item->catatanPerjalanRanapPatient->id) }}"
                                                            class="btn btn-sm btn-dark">Tambah</a> --}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Asuransi Lain</td>
                                                    <td>-</td>
                                                    <td>
                                                        {{-- <a href="{{ route('perjalananadministrasi-ranap.asuransi', $item->catatanPerjalanRanapPatient->id) }}"
                                                            class="btn btn-sm btn-dark">Tambah</a> --}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Perawat Registrasi</td>
                                                    <td>-</td>
                                                    <td>
                                                        {{-- <a href="{{ route('perjalananadministrasi-ranap.registrasi', $item->catatanPerjalanRanapPatient->id) }}"
                                                            class="btn btn-sm btn-dark">Tambah</a> --}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>Kamar Bedah</td>
                                                    <td>-</td>
                                                    <td>
                                                        {{-- <a href="{{ route('perjalananadministrasi-ranap.kamar-bedah', $item->catatanPerjalanRanapPatient->id) }}"
                                                            class="btn btn-sm btn-dark">Tambah</a> --}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>5</td>
                                                    <td>Laboratorium</td>
                                                    <td>-</td>
                                                    <td>
                                                        {{-- <a href="{{ route('perjalananadministrasi-ranap.laboratorium', $item->catatanPerjalanRanapPatient->id) }}"
                                                            class="btn btn-sm btn-dark">Tambah</a> --}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>6</td>
                                                    <td>Farmasi-Kasir</td>
                                                    <td>-</td>
                                                    <td>
                                                        {{-- <a href="{{ route('perjalananadministrasi-ranap.farmasi-kasir', $item->catatanPerjalanRanapPatient->id) }}"
                                                            class="btn btn-sm btn-dark">Tambah</a> --}}
                                                    </td>
                                                </tr>
                                            @endcan
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- end Menu Catatan Perjalanan Administrasi --}}
    </div>
@endsection
