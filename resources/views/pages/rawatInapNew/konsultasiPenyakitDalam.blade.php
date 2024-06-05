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
                                <td class="pb-3">{{ $item->queue->patient->status ?? '' }}</td>
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
                                    {{ $item->queue->patient->city->name ?? '' }},
                                    {{ $item->queue->patient->province->name ?? '' }},{{ $item->queue->patient->alamat ?? '' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- end Informasi Pasien --}}


        {{-- Konsultasi Penyakit Dalam --}}
        <div class="card-body">
            <div class="nav-align-top mb-4 shadow-sm">
                <ul class="nav nav-tabs nav-sm nav-fill" role="tablist">
                    <li class="nav-item">
                        <button id="btn-link" type="button" {{-- @dd(session()->all()) --}}
                            class="nav-link {{ session('btn') == 'Konsultasi Penyakit Dalam' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-konsultasi-penyakit-dalam"
                            aria-controls="navs-justified-konsultasi-penyakit-dalam" aria-selected="true">
                            <i class="tf-icons bx bx-bookmark-alt-plus"></i>
                            <p class="m-0">Konsultasi Penyakit Dalam</p>
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade {{ session('btn') == 'Konsultasi Penyakit Dalam' ? 'show active' : '' }}"
                        id="navs-justified-konsultasi-penyakit-dalam" role="tabpanel">
                        <div class="row">
                            <div class="col-sm-12">
                                <h6>Konsultasi Penyakit Dalam Pasien
                                    {{ $item->queue->patient->name }} <span><a
                                            href="{{ route('lembar/konsultasi/penyakit/dalam.create', $item->id) }}"
                                            class="btn mx-2 btn-sm btn-primary">+</a></span>
                                </h6>
                                <div class="card">
                                    <table class="table">
                                        <thead>
                                            <tr class="text-nowrap bg-dark">
                                                <th class="">No</th>
                                                <th class="">Petugas / Dokter</th>
                                                <th class="">Ruangan</th>
                                                <th class="">Tanggal</th>
                                                <th class="">Jawab</th>
                                                <th class="">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($konsultasi as $k)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</th>
                                                    <td>{{ $k->user->name }}</td>
                                                    <td>{{ $k->roomDetail->name }}</td>
                                                    @php
                                                        $formatId = Carbon\Carbon::parse($k->tanggal);
                                                    @endphp
                                                    <td>{{ $formatId->isoformat('D MMM Y') }}</td>
                                                    <td>
                                                        <a href="{{ route('jawaban/konsultasi/penyakit/dalam.create', $k->ranapJawabanKonsulPenyakitDalamPatient->id) }}"
                                                            target="blank" class="btn btn-dark btn-sm mx-2"><i
                                                                class='bx bx-plus'></i></a>
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button"
                                                                class="btn p-0 dropdown-toggle hide-arrow"
                                                                data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item"
                                                                    href="{{ route('lembar/konsultasi/penyakit/dalam.show', $k->id) }}"
                                                                    target="_blank">
                                                                    <i class="bx bx-printer me-1"></i>
                                                                    Print
                                                                </a>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('lembar/konsultasi/penyakit/dalam.edit', $k->id) }}">
                                                                    <i class="bx bx-edit-alt me-1"></i>
                                                                    Edit
                                                                </a>
                                                                <form
                                                                    action="{{ route('lembar/konsultasi/penyakit/dalam.destroy', $k->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="dropdown-item"
                                                                        onclick="return confirm('Yakin ingin menghapus data?')"><i
                                                                            class="bx bx-trash me-1"></i>Hapus</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- end Konsultasi Penyakit Dalam --}}
    </div>
@endsection
