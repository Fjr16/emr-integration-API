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

        {{-- Skrining Covid --}}
        <div class="card-body">
            <div class="nav-align-top mb-4 shadow-sm">
                <ul class="nav nav-tabs nav-sm nav-fill" role="tablist">
                    <li class="nav-item">
                        <button id="btn-link" type="button" {{-- @dd(session()->all()) --}}
                            class="nav-link {{ session('btn') == 'skriningCovid' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-skriningCovid"
                            aria-controls="navs-justified-skriningCovid" aria-selected="true">
                            <i class="tf-icons bx bx-bookmark-alt-plus"></i>
                            <p class="m-0">Skrining Covid</p>
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade {{ session('btn') == 'skriningCovid' ? 'show active' : '' }}"
                        id="navs-justified-skriningCovid" role="tabpanel">
                        <div class="row">
                            <div class="col-sm-12">
                                <h6>Form Skrining Covid Rawat Inap
                                    <span class="m-3">
                                        @if ($item->skriningCovidRanapPatient)
                                            @can('edit skrining covid')
                                                <a href="{{ route('skrining/covid.edit', $item->skriningCovidRanapPatient->id) }}"
                                                    class="btn btn-sm btn-success" target="_blank"
                                                    rel="noopener noreferrer">Edit
                                                    Skrining Covid</a>
                                        </span>
                                    @endcan
                                @else
                                    @can('tambah skrining covid')
                                        <a href="{{ route('skrining/covid.create', $item->id) }}"
                                            class="btn btn-sm btn-success" target="_blank" rel="noopener noreferrer">Tambah
                                            Skrining Covid</a></span>
                                    @endcan
                                    @endif
                                </h6>
                                <div class="card">
                                    <table class="table">
                                        <thead>
                                            <tr class="text-nowrap bg-dark">
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Total Skor</th>
                                                <th>Tingkat Resiko</th>
                                                <th class="text-center">Permintaan Labor PK</th>
                                                @canany(['edit skrining covid', 'delete skrining covid'])
                                                    <th>Action</th>
                                                @endcanany
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @if ($item->skriningCovidRanapPatient)
                                                    <td>1</td>
                                                    <td>{{ date_format($item->created_at, 'd - F - Y') }}</td>
                                                    <td>{{ $item->skriningCovidRanapPatient->total_skor ?? '' }}</td>
                                                    @if ($item->skriningCovidRanapPatient->total_skor > 4)
                                                        <td>Resiko Tinggi</td>
                                                    @elseif ($item->skriningCovidRanapPatient->total_skor >= 1 && $item->skriningCovidRanapPatient->total_skor <= 4)
                                                        <td>Resiko Sedang</td>
                                                    @elseif ($item->skriningCovidRanapPatient->total_skor == 0)
                                                        <td>Resiko Rendah</td>
                                                    @else
                                                        <td>Unknown</td>
                                                    @endif
                                                    @if ($item->skriningCovidRanapPatient->total_skor > 4)
                                                        <td class="text-center"><a
                                                                href="{{ route('ranap/laboratorium/request.index', $item->queue->id) }}"
                                                                class="btn btn-sm btn-success"><i
                                                                    class="bx bx-plus"></i></a>
                                                        </td>
                                                    @else
                                                        <td class="text-center"><button class="btn btn-sm btn-success"
                                                                disabled><i class="bx bx-plus"></i></button></td>
                                                    @endif
                                                    @can('edit skrining covid')
                                                        <td>
                                                            <a class="btn btn-dark btn-sm"
                                                                href="{{ route('skrining/covid.edit', $item->skriningCovidRanapPatient->id) }}">
                                                                <i class='bx bx-show-alt'></i>
                                                            </a>
                                                        </td>
                                                    @endcan
                                                @else
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                @endif
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- end Skrining Covid --}}
    </div>
@endsection
