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

    {{-- nav tab --}}
    <div class="nav-align-top mb-4">
        {{-- V1 --}}
        <ul class="nav nav-tabs nav-sm nav-fill" role="tablist">
            <li class="nav-item">
                <button id="btn-link" type="button" {{-- @dd(session()->all()) --}}
                    class="nav-link {{ session('btn') == 'dashboard' ? 'active' : '' }} d-flex justify-content-center"
                    role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-dashboard"
                    aria-controls="navs-justified-dashboard" aria-selected="true">
                    <i class="tf-icons bx bx-grid-alt"></i>
                    <p class="m-0">Dashboard</p>
                </button>
            </li>
            @can('daftar skrining covid')
                <li class="nav-item">
                    <button id="btn-link" type="button" {{-- @dd(session()->all()) --}}
                        class="nav-link {{ session('btn') == 'skriningCovid' ? 'active' : '' }} d-flex justify-content-center"
                        role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-skriningCovid"
                        aria-controls="navs-justified-skriningCovid" aria-selected="true">
                        <i class="tf-icons bx bx-bookmark-alt-plus"></i>
                        <p class="m-0">Skrining Covid</p>
                    </button>
                </li>
            @endcan
            @can('daftar catatan perjalanan administrasi')
                <li class="nav-item">
                    <button id="btn-link" type="button" {{-- @dd(session()->all()) --}}
                        class="nav-link {{ session('btn') == 'cpa' ? 'active' : '' }} d-flex justify-content-center"
                        role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-cpa"
                        aria-controls="navs-justified-cpa" aria-selected="true">
                        <i class="tf-icons bx bx-bookmark-alt-plus"></i>
                        <p class="m-0">Catatan Perjalanan Administrasi</p>
                    </button>
                </li>
            @endcan
            @can('daftar tilik pasien')
                <li class="nav-item">
                    <button id="btn-link" type="button" {{-- @dd(session()->all()) --}}
                        class="nav-link {{ session('btn') == 'dtp' ? 'active' : '' }} d-flex justify-content-center"
                        role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-dtp"
                        aria-controls="navs-justified-dtp" aria-selected="true">
                        <i class="tf-icons bx bx-bookmark-alt-plus"></i>
                        <p class="m-0">Daftar Tilik</p>
                    </button>
                </li>
            @endcan
            {{-- @can('general consent form ranap')
                    <li class="nav-item">
                    <button
                        id="btn-link"
                        type="button"
                        class="nav-link {{ (session('btn') == 'gc') ? 'active' : '' }} d-flex justify-content-center"
                        role="tab"
                        data-bs-toggle="tab"
                        data-bs-target="#navs-justified-gc"
                        aria-controls="navs-justified-gc"
                        aria-selected="true"
                    >
                        <i class="tf-icons bx bx-bookmark-alt-plus"></i>
                        <p class="m-0">General Consent</p>
                    </button>
                    </li>
                    @endcan --}}
            {{-- @can('surat persetujuan pelayanan pasien form ranap')
                    <li class="nav-item">
                    <button
                        id="btn-link"
                        type="button"
                        class="nav-link {{ (session('btn') == 'persetujuanpelayanan') ? 'active' : '' }} d-flex justify-content-center"
                        role="tab"
                        data-bs-toggle="tab"
                        data-bs-target="#navs-justified-persetujuanpelayanan"
                        aria-controls="navs-justified-persetujuanpelayanan"
                        aria-selected="true"
                    >
                        <i class="tf-icons bx bx-bookmark-alt-plus"></i>
                        <p class="m-0">Persetujuan Pelayanan Pasien</p>
                    </button>
                    </li>
                    @endcan --}}
            {{-- @can('ringkasan masuk dan keluar form ranap')
                    <li class="nav-item">
                    <button
                        id="btn-link"
                        type="button"
                        class="nav-link {{ (session('btn') == 'rmdk') ? 'active' : '' }} d-flex justify-content-center"
                        role="tab"
                        data-bs-toggle="tab"
                        data-bs-target="#navs-justified-rmdk"
                        aria-controls="navs-justified-rmdk"
                        aria-selected="true"
                    >
                        <i class="tf-icons bx bx-bookmark-alt-plus"></i>
                        <p class="m-0">Ringkasan Masuk Dan keluar</p>
                    </button>
                    </li>
                    @endcan --}}
            @can('laporan operasi form ranap')
                <li class="nav-item">
                    <button id="btn-link" type="button" {{-- @dd(session()->all()) --}}
                        class="nav-link {{ session('btn') == 'lo' ? 'active' : '' }} d-flex justify-content-center"
                        role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-lo"
                        aria-controls="navs-justified-lo" aria-selected="true">
                        <i class="tf-icons bx bx-bookmark-alt-plus"></i>
                        <p class="m-0">Laporan Operasi</p>
                    </button>
                </li>
            @endcan
            @can('assesmen awal medis form ranap')
                <li class="nav-item">
                    <button id="btn-link" type="button" {{-- @dd(session()->all()) --}}
                        class="nav-link {{ session('btn') == 'asesmen-awal' ? 'active' : '' }} d-flex justify-content-center"
                        role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-asesmen-awal"
                        aria-controls="navs-justified-asesmen-awal" aria-selected="true">
                        <i class="tf-icons bx bx-bookmark-alt-plus"></i>
                        <p class="m-0">Asessment Awal Medis</p>
                    </button>
                </li>
            @endcan

            @can('catatan pelayanan pt form ranap')
                <li class="nav-item">
                    <button id="btn-link" type="button" {{-- @dd(session()->all()) --}}
                        class="nav-link {{ session('btn') == 'cppt' ? 'active' : '' }} d-flex justify-content-center"
                        role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-cppt"
                        aria-controls="navs-justified-cppt" aria-selected="true">
                        <i class="tf-icons bx bx-bookmark-alt-plus"></i>
                        <p class="m-0">Cppt Ranap</p>
                    </button>
                </li>
            @endcan
            @can('discharge summary form ranap')
                <li class="nav-item">
                    <button id="btn-link" type="button" {{-- @dd(session()->all()) --}}
                        class="nav-link {{ session('btn') == 'discharge' ? 'active' : '' }} d-flex justify-content-center"
                        role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-discharge"
                        aria-controls="navs-justified-discharge" aria-selected="true">
                        <i class="tf-icons bx bx-bookmark-alt-plus"></i>
                        <p class="m-0">Discharge Summary</p>
                    </button>
                </li>
            @endcan
            {{-- @can('konsul penyakit dalam form ranap')
                    <li class="nav-item">
                    <button
                        id="btn-link"
                        type="button"
                        class="nav-link {{ (session('btn') == 'lembar-konsul') ? 'active' : '' }} d-flex justify-content-center"
                        role="tab"
                        data-bs-toggle="tab"
                        data-bs-target="#navs-justified-lembar-konsul"
                        aria-controls="navs-justified-lembar-konsul"
                        aria-selected="true"
                    >
                        <i class="tf-icons bx bx-bookmark-alt-plus"></i>
                        <p class="m-0">Konsultasi Penyakit Dalam</p>
                    </button>
                    </li>
                    @endcan --}}
            @can('monitoring pacu')
                <li class="nav-item">
                    <button id="btn-link" type="button" {{-- @dd(session()->all()) --}}
                        class="nav-link {{ session('btn') == 'monitoring-pacu' ? 'active' : '' }} d-flex justify-content-center"
                        role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-monitoring-pacu"
                        aria-controls="navs-justified-monitoring-pacu" aria-selected="true">
                        <i class="tf-icons bx bx-bookmark-alt-plus"></i>
                        <p class="m-0">Monitoring Pacu</p>
                    </button>
                </li>
            @endcan
            @canany(['ews anak form ranap', 'ews dewasa form ranap'])
                <li class="nav-item">
                    <button id="btn-link" type="button" {{-- @dd(session()->all()) --}}
                        class="nav-link {{ session('btn') == 'ews' ? 'active' : '' }} d-flex justify-content-center"
                        role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-ews"
                        aria-controls="navs-justified-ews" aria-selected="true">
                        <i class='tf-icons bx bx-alarm-exclamation'></i>
                        <p class="m-0">EWS</p>
                    </button>
                </li>
            @endcan
            @can('hais form ranap')
                <li class="nav-item">
                    <button id="btn-link" type="button" {{-- @dd(session()->all()) --}}
                        class="nav-link {{ session('btn') == 'hais' ? 'active' : '' }} d-flex justify-content-center"
                        role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-hais"
                        aria-controls="navs-justified-hais" aria-selected="true">
                        <i class='tf-icons bx bx-alarm-exclamation'></i>
                        <p class="m-0">HAIs</p>
                    </button>
                </li>
            @endcan
            @can('monitoring resiko jatuh form ranap')
                <li class="nav-item">
                    <button id="btn-link" type="button" {{-- @dd(session()->all()) --}}
                        class="nav-link {{ session('btn') == 'monitoringresikojatuh' ? 'active' : '' }} d-flex justify-content-center"
                        role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-monitoringresikojatuh"
                        aria-controls="navs-justified-monitoringresikojatuh" aria-selected="true">
                        <i class='tf-icons bx bx-alarm-exclamation'></i>
                        <p class="m-0">Monitoring Resiko Jatuh</p>
                    </button>
                </li>
            @endcan
            @can('monitoring status fungsional form ranap')
                <li class="nav-item">
                    <button id="btn-link" type="button" {{-- @dd(session()->all()) --}}
                        class="nav-link {{ session('btn') == 'monitoringstatusfungsional' ? 'active' : '' }} d-flex justify-content-center"
                        role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-monitoringstatusfungsional"
                        aria-controls="navs-justified-monitoringstatusfungsional" aria-selected="true">
                        <i class='tf-icons bx bx-alarm-exclamation'></i>
                        <p class="m-0">Monitoring Status Fungsional</p>
                    </button>
                </li>
            @endcan
            @can('tindakan pelayanan form ranap')
                <li class="nav-item">
                    <button id="btn-link" type="button" {{-- @dd(session()->all()) --}}
                        class="nav-link {{ session('btn') == 'tindakanpelayananpasien' ? 'active' : '' }} d-flex justify-content-center"
                        role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-tindakanpelayananpasien"
                        aria-controls="navs-justified-tindakanpelayananpasien" aria-selected="true">
                        <i class='tf-icons bx bx-alarm-exclamation'></i>
                        <p class="m-0">Tindakan Pelayanan</p>
                    </button>
                </li>
            @endcan
            @can('asesmen pra sedasi form ranap')
                <li class="nav-item">
                    <button id="btn-link" type="button" {{-- @dd(session()->all()) --}}
                        class="nav-link {{ session('btn') == 'asesmenprasedasi' ? 'active' : '' }} d-flex justify-content-center"
                        role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-asesmenprasedasi"
                        aria-controls="navs-justified-asesmenprasedasi" aria-selected="true">
                        <i class='tf-icons bx bx-alarm-exclamation'></i>
                        <p class="m-0">Asesmen Pra Sedasi</p>
                    </button>
                </li>
            @endcan
            {{-- @can('laporan anestesi')    --}}
            <li class="nav-item">
                <button id="btn-link" type="button"
                    class="nav-link {{ session('btn') == 'laporananestesi' ? 'active' : '' }} d-flex justify-content-center"
                    role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-laporananestesi"
                    aria-controls="navs-justified-laporananestesi" aria-selected="true">
                    <i class='tf-icons bx bx-alarm-exclamation'></i>
                    <p class="m-0">Laporan Anestesi</p>
                </button>
            </li>
            {{-- @endcan --}}
            @can('asesmen pra anestesi-induksi form ranap')
                <li class="nav-item">
                    <button id="btn-link" type="button" {{-- @dd(session()->all()) --}}
                        class="nav-link {{ session('btn') == 'asesmenpraanestesi-induksi' ? 'active' : '' }} d-flex justify-content-center"
                        role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-asesmenpraanestesi-induksi"
                        aria-controls="navs-justified-asesmenpraanestesi-induksi" aria-selected="true">
                        <i class='tf-icons bx bx-alarm-exclamation'></i>
                        <p class="m-0">Asesmen Pra Anestesi - Induksi</p>
                    </button>
                </li>
            @endcan
            @can('monitoring obat form ranap')
                <li class="nav-item">
                    <button id="btn-link" type="button" {{-- @dd(session()->all()) --}}
                        class="nav-link {{ session('btn') == 'monitoringpelayananobatpasien' ? 'active' : '' }} d-flex justify-content-center"
                        role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-monitoringpelayananobatpasien"
                        aria-controls="navs-justified-monitoringpelayananobatpasien" aria-selected="true">
                        <i class='tf-icons bx bx-alarm-exclamation'></i>
                        <p class="m-0">Monitoring Obat</p>
                    </button>
                </li>
            @endcan
            {{-- @can('monitoring obat form ranap')     --}}
            <li class="nav-item">
                <button id="btn-link" type="button" {{-- @dd(session()->all()) --}}
                    class="nav-link {{ session('btn') == 'managerpelayananpasien' ? 'active' : '' }} d-flex justify-content-center"
                    role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-managerpelayananpasien"
                    aria-controls="navs-justified-managerpelayananpasien" aria-selected="true">
                    <i class='tf-icons bx bx-alarm-exclamation'></i>
                    <p class="m-0">Manager Pelayanan Pasien</p>
                </button>
            </li>
            {{-- @endcan --}}
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade {{ session('btn') == 'dashboard' ? 'show active' : '' }}"
                id="navs-justified-dashboard" role="tabpanel">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="d-flex">
                            <h6 class="m-0 mt-1">{{ $item->queue->patient->name }}
                                ({{ implode('-', str_split(str_pad($item->queue->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }})
                            </h6>
                        </div>
                        <hr class="p-0 mt-2">
                        <table class="w-100">
                            <tbody>
                                <tr>
                                    <td style="min-width: 150px">Tanggungan</td>
                                    <td style="min-width: 30px">:</td>
                                    <td>{{ $item->queue->patientCategory->name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td style="min-width: 150px">Jenis Kelamin</td>
                                    <td style="min-width: 30px">:</td>
                                    <td>{{ $item->queue->patient->jenis_kelamin ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Lahir</td>
                                    <td>:</td>
                                    <td>{{ $item->queue->patient->tanggal_lhr ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>Usia</td>
                                    <td>:</td>
                                    <td>{{ $usia ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>Telepon</td>
                                    <td>:</td>
                                    <td>{{ $item->queue->patient->telp ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td>{{ $item->queue->patient->alamat ?? '' }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <hr class="p-0 mt-2">
                        <h6>Dokter Penanggung Jawab (DPJP)</h6>
                        <table class="table">
                            <thead>
                                <tr class="text-nowrap">
                                    <th class="text-body">nama</th>
                                    <th class="text-body">kode</th>
                                    <th class="text-body">dari</th>
                                    <th class="text-body">sampai</th>
                                    <th class="text-body">status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($item->ranapDpjpPatientDetails as $index => $dpjp)
                                    <tr>
                                        <td>{{ $dpjp->user->name ?? '' }}</td>
                                        <td>{{ $dpjp->user->staff_id ?? '' }}</td>
                                        @if ($loop->first)
                                            <td>{{ (new DateTime($dpjp->start))->format('d M Y') }}</td>
                                        @else
                                            <td>{{ (new DateTime($item->ranapDpjpPatientDetails[$index - 1]->end))->format('d M Y') }}
                                            </td>
                                        @endif
                                        {{-- <td>{{  }}</td> --}}
                                        <td>{{ $dpjp->end ? (new DateTime($dpjp->end))->format('d M Y') : 'Sekarang' }}
                                        </td>
                                        <td>{{ $dpjp->status ? 'Aktif' : 'Tidak Aktif' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-7">
                        <h6>Surat Pengantar Rawat</h6>
                        <div class="card">
                            <table class="table">
                                <thead>
                                    <tr class="text-nowrap">
                                        <th class="text-body">Nama Pasien</th>
                                        <th class="text-body">Diagnosa Primer</th>
                                        <th class="text-body">Diagnosa Sekunder</th>
                                        <th class="text-body">Ruangan</th>
                                        <th class="text-body">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $item->queue->suratPengantarRawatJalanPatient->queue->patient->name ?? '' }}
                                        </td>
                                        <td>{{ $item->queue->suratPengantarRawatJalanPatient->primer ?? '' }}</td>
                                        <td>
                                            @foreach ($item->queue->suratPengantarRawatJalanPatient->sekunderSuratPengantarRawatJalanPatients as $sekunder)
                                                {{ $sekunder->name ?? '' }},
                                            @endforeach
                                        </td>
                                        <td>{{ $item->queue->suratPengantarRawatJalanPatient->ruangan ?? '' }}</td>
                                        <td>
                                            <a class="btn btn-dark btn-sm" href="/show-surat-pengantar">
                                                <i class='bx bx-show-alt'></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade {{ session('btn') == 'skriningCovid' ? 'show active' : '' }}"
                id="navs-justified-skriningCovid" role="tabpanel">
                <div class="row">
                    <div class="col-sm-12">
                        <h6>Form Skrining Covid Rawat Inap <span class="m-3">
                                @if ($item->skriningCovidRanapPatient)
                                    @can('edit skrining covid')
                                        <a href="{{ route('skrining/covid.edit', $item->skriningCovidRanapPatient->id) }}"
                                            class="btn btn-sm btn-success" target="_blank" rel="noopener noreferrer">Edit
                                            Skrining Covid</a>
                                </span>
                            @endcan
                        @else
                            @can('tambah skrining covid')
                                <a href="{{ route('skrining/covid.create', $item->id) }}" class="btn btn-sm btn-success"
                                    target="_blank" rel="noopener noreferrer">Tambah Skrining Covid</a></span>
                            @endcan
                            @endif
                        </h6>
                        <div class="card">
                            <table class="table">
                                <thead>
                                    <tr class="text-nowrap">
                                        <th class="text-body">No</th>
                                        <th class="text-body">Tanggal</th>
                                        <th class="text-body">Total Skor</th>
                                        <th class="text-body">Tingkat Resiko</th>
                                        <th class="text-body text-center">Permintaan Labor PK</th>
                                        @canany(['edit skrining covid', 'delete skrining covid'])
                                            <th class="text-body">Action</th>
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
                                                        class="btn btn-sm btn-success"><i class="bx bx-plus"></i></a>
                                                </td>
                                            @else
                                                <td class="text-center"><button class="btn btn-sm btn-success" disabled><i
                                                            class="bx bx-plus"></i></button></td>
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
            <div class="tab-pane fade {{ session('btn') == 'cpa' ? 'show active' : '' }}" id="navs-justified-cpa"
                role="tabpanel">
                <div class="row">
                    <div class="col-sm-12">
                        <h6>Catatan Perjalanan Adminstrasi Pasien</h6>
                        <div class="card">
                            <table class="table">
                                <thead>
                                    <tr class="text-nowrap">
                                        <th class="text-body">No</th>
                                        <th class="text-body">Bagian</th>
                                        <th class="text-body">User</th>
                                        <th class="text-body">Administrasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @can('tambah catatan perjalanan administrasi')
                                        <tr>
                                            <td>1</td>
                                            <td>Rekam Medis</td>
                                            <td>-</td>
                                            <td>
                                                {{-- <a href="{{ route('perjalananadministrasi-ranap.rekam-medis', $item->catatanPerjalanRanapPatient->id) }}" class="btn btn-sm btn-dark">Tambah</a> --}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Asuransi Lain</td>
                                            <td>-</td>
                                            <td>
                                                {{-- <a href="{{ route('perjalananadministrasi-ranap.asuransi', $item->catatanPerjalanRanapPatient->id) }}" class="btn btn-sm btn-dark">Tambah</a> --}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Perawat Registrasi</td>
                                            <td>-</td>
                                            <td>
                                                {{-- <a href="{{ route('perjalananadministrasi-ranap.registrasi', $item->catatanPerjalanRanapPatient->id) }}" class="btn btn-sm btn-dark">Tambah</a> --}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Kamar Bedah</td>
                                            <td>-</td>
                                            <td>
                                                {{-- <a href="{{ route('perjalananadministrasi-ranap.kamar-bedah', $item->catatanPerjalanRanapPatient->id) }}" class="btn btn-sm btn-dark">Tambah</a> --}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>Laboratorium</td>
                                            <td>-</td>
                                            <td>
                                                {{-- <a href="{{ route('perjalananadministrasi-ranap.laboratorium', $item->catatanPerjalanRanapPatient->id) }}" class="btn btn-sm btn-dark">Tambah</a> --}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>Farmasi-Kasir</td>
                                            <td>-</td>
                                            <td>
                                                {{-- <a href="{{ route('perjalananadministrasi-ranap.farmasi-kasir', $item->catatanPerjalanRanapPatient->id) }}" class="btn btn-sm btn-dark">Tambah</a> --}}
                                            </td>
                                        </tr>
                                    @endcan
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade {{ session('btn') == 'dtp' ? 'show active' : '' }}" id="navs-justified-dtp"
                role="tabpanel">
                <div class="row">
                    <div class="col-sm-12">
                        <h6>Daftar Tilik Pasien <span><a href="{{ route('daftar-tilik.create', $item->id) }}"
                                    class="btn mx-2 btn-sm btn-primary">+</a></span></h6>
                        <div class="card">
                            <table class="table">
                                <thead>
                                    <tr class="text-nowrap bg-dark">
                                        <th>No</th>
                                        <th>Pasien</th>
                                        <th>Jam Datang</th>
                                        <th>Ruang Rawat</th>
                                        <th>Tanggal Operasi</th>
                                        <th>Jam Keluar Operasi</th>
                                        <th>Sisi Operasi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($item->daftarTilikVerifikasiPraOperasiPatient as $tilik)
                                        <tr>
                                            <td>{{ $loop->iteration }}</th>
                                            <td>{{ $tilik->patient->name }}</td>
                                            <td>{{ $tilik->jam_tiba }}</td>
                                            <td>{{ $tilik->ruang_rawat }}</td>
                                            <td>{{ $tilik->tanggal_operasi }}</td>
                                            <td>{{ $tilik->jam_keluar }}</td>
                                            <td>{{ $tilik->lokasi_sisi_operasi_tindakan }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item"
                                                            href="{{ route('daftar-tilik.edit', $tilik->id) }}">
                                                            <i class="bx bx-edit-alt me-1"></i>
                                                            Edit
                                                        </a>
                                                        <form action="{{ route('daftar-tilik.destroy', $tilik->id) }}"
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
            {{-- @can('general consent form ranap')
            <div class="tab-pane fade {{ (session('btn') == 'gc') ? 'show active' : '' }}" id="navs-justified-gc" role="tabpanel">
                <div class="row">
                    <div class="col-sm-12">
                    <h6>General Consent <span><a href="{{ route('general-consent-ranap.create', $item->id) }}" class="btn mx-2 btn-sm btn-primary">+</a></span></h6>
                    <div class="card">
                        <table class="table">
                        <thead>
                            <tr class="text-nowrap bg-dark">
                                <th>No</th>
                                <th>Pasien</th>
                                <th>Nama PJ</th>
                                <th>Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat</th>
                                <th>Phone</th>
                                <th>Hubungan</th>
                                <th>Bacakan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($item->generalConsentPatient as $gc)
                                <tr>
                                    <td>{{ $loop->iteration }}</th>
                                    <td>{{ $gc->rawatInapPatient->queue->patient->name }}</td>
                                    <td>{{ $gc->name }}</td>
                                    <td>{{ $gc->tgl_lhr }}</td>
                                    <td>{{ $gc->kelamin }}</td>
                                    <td>{{ $gc->alamat }}</td>
                                    <td>{{ $gc->phone }}</td>
                                    <td>{{ $gc->hubungan }}</td>
                                    <td>
                                        <a href="{{ route('general-consent-ranap.halaman1', $gc->id) }}" class="btn btn-sm btn-success">Bacakan</a>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('daftar-tilik.edit', $gc->id) }}">
                                                    <i class="bx bx-edit-alt me-1"></i>
                                                    Edit
                                                </a>
                                                <form action="{{ route('daftar-tilik.destroy', $gc->id) }}" method="POST">
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
            @endcan --}}
            {{-- @can('surat persetujuan pelayanan pasien form ranap')
            <div class="tab-pane fade {{ (session('btn') == 'persetujuanpelayanan') ? 'show active' : '' }}" id="navs-justified-persetujuanpelayanan" role="tabpanel">
                <div class="row">
                    <div class="col-sm-12">
                    <h6>Surat Persetujuan Pelayanan <span><a href="{{ route('surat/pernyataan/persetujuan/status/pelayanan.create', $item->id) }}" class="btn mx-2 btn-sm btn-primary">+</a></span></h6>
                    <div class="card">
                        <table class="table">
                        <thead>
                            <tr class="text-nowrap bg-dark">
                                <th>Pasien</th>
                                <th>Alamat</th>
                                <th>Kelas Rawatan</th>
                                <th>Tanggal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($item->suratPernyataanPersetujuanPatients as $persetujuanP)
                                <tr>
                                    <td>{{ $persetujuanP->patient->name ?? '' }}</td>
                                    <td>{{ $persetujuanP->patient->alamat ?? '' }}</td>
                                    <td>{{ $persetujuanP->patient->patientCategory->name ?? '' }}</td>
                                    <td>{{ $persetujuanP->created_at->format('Y-m-d') ?? ''}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('surat/pernyataan/persetujuan/status/pelayanan.edit', $persetujuanP->id) }}">
                                                    <i class="bx bx-edit-alt me-1"></i>
                                                    Edit
                                                </a>
                                                <form action="{{ route('surat/pernyataan/persetujuan/status/pelayanan.destroy', $persetujuanP->id) }}" method="POST">
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
            @endcan --}}
            {{-- <div class="tab-pane fade {{ (session('btn') == 'rmdk') ? 'show active' : '' }}" id="navs-justified-rmdk" role="tabpanel">
                <div class="row">
                    <div class="col-sm-12">
                    <h6>Ringkasan Masuk Dan Keluar Patient <span><a href="{{ route('ringkasan-masuk-keluar.create', $item->id) }}" class="btn mx-2 btn-sm btn-primary">+</a></span></h6>
                    <div class="card">
                        <table class="table">
                        <thead>
                            <tr class="text-nowrap bg-dark">
                                <th>No</th>
                                <th>Pasien</th>
                                <th>Tgl-Jam Masuk</th>
                                <th>Tgl-Jam Keluar</th>
                                <th>Tahun Kunjungan</th>
                                <th>Ruang Rawat</th>
                                <th>Agama</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($item->ringkasanMasukDanKeluarPatient as $rmdk)
                                <tr>
                                    <td>{{ $loop->iteration }}</th>
                                    <td>{{ $rmdk->patient->name }}</td>
                                    <td>{{ $rmdk->tanggal_masuk . ' / ' . $rmdk->jam_masuk }}</td>
                                    <td>{{ $rmdk->tanggal_keluar . ' / ' . $rmdk->jam_keluar }}</td>
                                    <td>{{ $rmdk->tahun_kunjungan }}</td>
                                    <td>{{ $rmdk->ruang_rawat }}</td>
                                    <td>{{ $rmdk->agama }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="{{ route('ringkasan-masuk-keluar.edit', $rmdk->id) }}">
                                                    <i class="bx bx-edit-alt me-1"></i>
                                                    Edit
                                                </a>
                                                <form action="{{ route('ringkasan-masuk-keluar.destroy', $rmdk->id) }}"
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
            </div> --}}
            <div class="tab-pane fade {{ session('btn') == 'lo' ? 'show active' : '' }}" id="navs-justified-lo"
                role="tabpanel">
                <div class="row">
                    <div class="col-sm-12">
                        <h6>Laporan Operasi <span><a href="{{ route('laporan/operasi.create', $item->id) }}"
                                    class="btn mx-2 btn-sm btn-primary">+</a></span></h6>
                        <div class="card table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr class="text-nowrap bg-dark">
                                        <th>No</th>
                                        <th>Nama Ahli Bedah</th>
                                        <th>Asisten Bedah</th>
                                        <th>Nama Ahli Anestesi</th>
                                        <th>Jenis Anestesi</th>
                                        <th>Tingkatan Operasi</th>
                                        <th>Diagnosis Pra Operasi</th>
                                        <th>Diagnosis Pasca Operasi</th>
                                        <th>Nama Operasi</th>
                                        <th>Komplikasi</th>
                                        <th>Spesimen Operasi Untuk PA</th>
                                        <th>Jumlah Pendarahan (cc)</th>
                                        <th>Jumlah Darah Ditransfusi (unit)</th>
                                        <th>Tanggal</th>
                                        <th>Jam Dimulai</th>
                                        <th>Jam Selesai</th>
                                        <th>Lama Operasi</th>
                                        <th>Prosedur</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($item->laporanOperasiPatient as $lo)
                                        <tr>
                                            <td scope="row">{{ $loop->iteration }}</td>
                                            <td>{{ $lo->nama_ahli_bedah }}</td>
                                            <td>{{ $lo->asisten_bedah }}</td>
                                            <td>{{ $lo->nama_ahli_anestesi }}</td>
                                            <td>{{ $lo->jenis_anestesi }}</td>
                                            <td>{{ $lo->tingkatan_operasi }}</td>
                                            <td>{{ $lo->diagnosis_pra_operasi }}</td>
                                            <td>{{ $lo->diagnosis_pasca_operasi }}</td>
                                            <td>{{ $lo->nama_operasi }}</td>
                                            <td>{{ $lo->komplikasi }}</td>
                                            <td>{{ $lo->spesimen_operasi_pemeriksaan_pa }}</td>
                                            <td>{{ $lo->jumlah_pendarahan }}</td>
                                            <td>{{ $lo->jumlah_darah_ditransfusi }}</td>
                                            <td>{{ $lo->tanggal }}</td>
                                            <td>{{ $lo->jam_dimulai }}</td>
                                            <td>{{ $lo->jam_selesai }}</td>
                                            <td>{{ $lo->lama_operasi }}</td>
                                            <td>{{ $lo->prosedur_operasi }}</td>

                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item"
                                                            href="{{ route('laporan/operasi.edit', $lo->id) }}">
                                                            <i class="bx bx-edit-alt me-1"></i>
                                                            Edit
                                                        </a>
                                                        <form action="{{ route('laporan/operasi.destroy', $lo->id) }}"
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
            <div class="tab-pane fade {{ session('btn') == 'asesmen-awal' ? 'show active' : '' }}"
                id="navs-justified-asesmen-awal" role="tabpanel">
                <div class="row">
                    <div class="col-sm-12">
                        <h6>Asesment Awal Medis
                            {{-- @can('tambah assesmen keperawatan ranap') --}}
                            <span><a href="{{ route('assesmen/awal/medis/ranap.create', $item->id) }}"
                                    class="btn btn-sm btn-success">+ Tambah Assesmen Awal Medis</a></span>
                            {{-- <a href="{{ route('ranap/cppt.show', $item->queue->patient->id) }}" target="blank" class="btn btn-dark btn-sm"><i class='bx bx-low-vision' ></i></a> --}}
                            {{-- @endcan --}}
                        </h6>
                        <div class="card">
                            <table class="table">
                                <thead>
                                    <tr class="text-nowrap">
                                        <th class="text-body">No</th>
                                        <th class="text-body">Pasien</th>
                                        <th class="text-body">Petugas</th>
                                        <th class="text-body">Tanggal</th>
                                        <th class="text-body">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($item->ranapInitialAssesments as $assesmen)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $assesmen->patient->name ?? '' }}</td>
                                            <td>{{ $assesmen->user->name ?? '' }}</td>
                                            <td>{{ $assesmen->tanggal ?? '' }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a href="{{ route('assesmen/awal/medis/ranap.show', $assesmen->id) }}"
                                                            target="blank" class="dropdown-item">
                                                            <i class='bx bx-printer'></i>
                                                            Show / Print
                                                        </a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('assesmen/awal/medis/ranap.edit', $assesmen->id) }}">
                                                            <i class="bx bx-edit-alt me-1"></i>
                                                            Edit
                                                        </a>
                                                        <form
                                                            action="{{ route('assesmen/awal/medis/ranap.destroy', $assesmen->id) }}"
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
            @can('catatan pelayanan pt form ranap')
                <div class="tab-pane fade {{ session('btn') == 'cppt' ? 'show active' : '' }}" id="navs-justified-cppt"
                    role="tabpanel">
                    <div class="row">
                        <div class="col-sm-4">
                            {{-- @if (auth()->user()->id == $item->ranapDpjpPatientDetails->where('status', true)->first()->user_id)     --}}
                            <div class="text-start mb-3">
                                <a href="{{ route('ranap/alih/rawat.create', $item->id) }}" class="btn btn-dark btn-sm"><i
                                        class='bx bx-move'></i> Alih Rawat</a>
                            </div>
                            {{-- @endif --}}
                        </div>
                        <div class="col-sm-8">
                            <div class="text-end mb-3">
                                @can('catatan pelayanan pt form ranap print')
                                    <a href="{{ route('ranap/cppt.print', $item->queue->patient->id) }}" target="blank"
                                        class="btn btn-dark btn-sm"><i class='bx bx-printer'></i></a>
                                    <a href="{{ route('ranap/cppt.show', $item->id) }}" target="blank"
                                        class="btn btn-dark btn-sm"><i class='bx bx-low-vision'></i></a>
                                @endcan
                                @can('catatan pelayanan pt form ranap create')
                                    <a class="btn btn-success btn-sm" href="{{ route('ranap/cppt.create', $item->id) }}">+Tambah
                                        CPPT</a>
                                @endcan
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="card">
                                <table class="table">
                                    <thead>
                                        <tr class="text-nowrap">
                                            <th class="text-body">No</th>
                                            <th class="text-body">PPA (Profesional Pemberi Asuhan)</th>
                                            <th class="text-body">Tanggal / Jam</th>
                                            @canany(['edit cppt', 'delete cppt'])
                                                <th class="text-body">Action</th>
                                            @endcanany
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cpptRanaps as $cppt)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $cppt->user->name ?? '' }}</td>
                                                <td>{{ $cppt->created_at->format('Y-m-d H:i:s') ?? '' }}</td>
                                                @canany([
                                                    'catatan pelayanan pt form ranap edit',
                                                    'catatan pelayanan pt form
                                                    ranap delete',
                                                    ])
                                                    <td class="d-flex">
                                                        @can('catatan pelayanan pt form ranap edit')
                                                            <a href="{{ route('ranap/cppt.edit', $cppt->id) }}"
                                                                class="btn btn-warning btn-sm"><i class='bx bx-edit'></i></a>
                                                        @endcan
                                                        @can('catatan pelayanan pt form ranap delete')
                                                            <form action="{{ route('ranap/cppt.destroy', $cppt->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm mx-2"
                                                                    onclick="return confirm('Yakin Ingin Menghapus Data ?')"><i
                                                                        class='bx bx-trash'></i></button>
                                                            </form>
                                                        @endcan
                                                    </td>
                                                @endcanany
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan
            {{-- @can('daftar cppt') --}}
            <div class="tab-pane fade {{ session('btn') == 'discharge' ? 'show active' : '' }}"
                id="navs-justified-discharge" role="tabpanel">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-end mb-3">
                            {{-- @can('print discharge') --}}
                            <a href="{{ route('ringkasan/catatan/medis.show', $item->id) }}" target="blank"
                                class="btn btn-dark btn-sm"><i class='bx bx-printer'></i></a>
                            {{-- @endcan --}}
                            {{-- @can('tambah discharge') --}}
                            <a class="btn btn-success btn-sm"
                                href="{{ route('ringkasan/catatan/medis.create', $item->id) }}">+Tambah Discharge
                                Summary</a>
                            {{-- @endcan --}}
                        </div>
                        <div class="card">
                            <table class="table">
                                <thead>
                                    <tr class="text-nowrap">
                                        <th class="text-body">No</th>
                                        <th class="text-body">Dokter Pengirim</th>
                                        <th class="text-body">Tanggal Masuk</th>
                                        <th class="text-body">Petugas</th>
                                        {{-- @canany(['edit discharge', 'delete discharge']) --}}
                                        <th class="text-body">Action</th>
                                        {{-- @endcanany --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($item->queue->patient->ranapDischargeSummaries as $discharge)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $discharge->dokter_pengirim ?? '' }}</td>
                                            <td>{{ $discharge->tanggal_masuk ?? '' }}</td>
                                            <td>{{ $discharge->user->name ?? '' }}</td>
                                            {{-- @canany(['edit discharge', 'delete discharge']) --}}
                                            <td class="d-flex">
                                                {{-- @can('edit discharge') --}}
                                                <a href="{{ route('ringkasan/catatan/medis.edit', $discharge->id) }}"
                                                    class="btn btn-warning btn-sm"><i class='bx bx-edit'></i></a>
                                                {{-- @endcan --}}
                                                {{-- @can('delete discharge') --}}
                                                <form
                                                    action="{{ route('ringkasan/catatan/medis.destroy', $discharge->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm mx-2"
                                                        onclick="return confirm('Yakin Ingin Menghapus Data ?')"><i
                                                            class='bx bx-trash'></i></button>
                                                </form>
                                                {{-- @endcan --}}
                                            </td>
                                            {{-- @endcanany --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{-- @endcan --}}
            {{-- @can('daftar cppt') --}}
            <div class="tab-pane fade {{ session('btn') == 'lembar-konsul' ? 'show active' : '' }}"
                id="navs-justified-lembar-konsul" role="tabpanel">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-end mb-3">
                            {{-- @can('print lembar-konsul') --}}
                            {{-- @endcan --}}
                            {{-- @can('tambah lembar-konsul') --}}
                            <a class="btn btn-success btn-sm"
                                href="{{ route('lembar/konsultasi/penyakit/dalam.create', $item->id) }}">+Tambah Lembar
                                Konsultasi Penyakit Dalam</a>
                            {{-- @endcan --}}
                        </div>
                        <div class="card">
                            <table class="table">
                                <thead>
                                    <tr class="text-nowrap">
                                        <th class="text-body">No</th>
                                        <th class="text-body">Petugas / Dokter</th>
                                        <th class="text-body">Ruangan</th>
                                        <th class="text-body">Tanggal</th>
                                        <th class="text-body">Dokter Konsulen</th>
                                        {{-- @canany(['edit discharge', 'delete discharge']) --}}
                                        <th class="text-body">Action</th>
                                        {{-- @endcanany --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($item->queue->patient->ranapPermintaanKonsulPenyakitDalamPatients as $lembarKonsul)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $lembarKonsul->user->name ?? '' }}</td>
                                            <td>{{ $lembarKonsul->roomDetail->name ?? '' }}</td>
                                            <td>{{ $lembarKonsul->tanggal ?? '' }}</td>
                                            <td>{{ $lembarKonsul->ranapJawabanKonsulPenyakitDalamPatient->user->name ?? '' }}
                                            </td>
                                            {{-- @canany(['edit lembarKonsul', 'delete lembarKonsul']) --}}
                                            <td class="d-flex">
                                                {{-- @can('edit lembarKonsul') --}}
                                                <a href="{{ route('jawaban/konsultasi/penyakit/dalam.create', $lembarKonsul->ranapJawabanKonsulPenyakitDalamPatient->id) }}"
                                                    target="blank" class="btn btn-dark btn-sm mx-2"><i
                                                        class='bx bx-plus'></i></a>
                                                <a href="{{ route('lembar/konsultasi/penyakit/dalam.show', $lembarKonsul->id) }}"
                                                    target="blank" class="btn btn-dark btn-sm"><i
                                                        class='bx bx-printer'></i></a>
                                                <a href="{{ route('lembar/konsultasi/penyakit/dalam.edit', $lembarKonsul->id) }}"
                                                    class="btn btn-warning btn-sm mx-2"><i class='bx bx-edit'></i></a>
                                                {{-- @endcan --}}
                                                {{-- @can('delete lembarKonsul') --}}
                                                <form
                                                    action="{{ route('lembar/konsultasi/penyakit/dalam.destroy', $lembarKonsul->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Yakin Ingin Menghapus Data ?')"><i
                                                            class='bx bx-trash'></i></button>
                                                </form>
                                                {{-- @endcan --}}
                                            </td>
                                            {{-- @endcanany --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{-- @endcan --}}
            <div class="tab-pane fade {{ session('btn') == 'monitoring-pacu' ? 'show active' : '' }}"
                id="navs-justified-monitoring-pacu" role="tabpanel">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-end mb-3">
                            <a class="btn btn-success btn-sm" href="/create-monitoring-pacu">+ Tambah Monitoring
                                Pacu</a>
                        </div>
                        <div class="card">
                            <table class="table">
                                <thead>
                                    <tr class="text-nowrap">
                                        <th class="text-body">No</th>
                                        <th class="text-body">Petugas / Dokter</th>
                                        <th class="text-body">Ruangan</th>
                                        <th class="text-body">Tanggal</th>
                                        <th class="text-body">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade {{ session('btn') == 'ews' ? 'show active' : '' }}" id="navs-justified-ews"
                role="tabpanel">
                <div class="text-end mb-3">
                    <a class="btn btn-success btn-sm" href="{{ route('ews/dewasa.create', $item->id) }}">+ Tambah EWS
                        Dewasa</a>
                    <a class="btn btn-success btn-sm" href="{{ route('ews/anak.create', $item->id) }}">+ Tambah EWS
                        Anak</a>
                </div>
                <div class="row">
                    <h6 class="m-0 mt-1 col-1">Ews Dewasa</h6>
                    <div class="col-1">
                        <a href="{{ route('ews/dewasa.show', $item->id) }}" class="btn btn-dark btn-sm"><i
                                class='bx bx-printer'></i></a>
                    </div>
                </div>
                <div class="card">
                    <table class="table">
                        <thead>
                            <tr class="text-nowrap">
                                <th class="text-body">No</th>
                                <th class="text-body">Petugas / Dokter</th>
                                <th class="text-body">Tanggal / Jam</th>
                                <th class="text-body">Jumlah Skor</th>
                                <th class="text-body">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($item->ranapEwsDewasaPatients as $ewsDewasa)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $ewsDewasa->user->name ?? '' }}</td>
                                    <td>{{ $ewsDewasa->tanggal ?? '' }} / {{ $ewsDewasa->jam ?? '' }}</td>
                                    <td>{{ $ewsDewasa->total_skor ?? '' }}</td>
                                    <td class="d-flex">
                                        <a href="{{ route('ews/dewasa.edit', $ewsDewasa->id) }}"
                                            class="btn btn-warning btn-sm"><i class='bx bx-edit'></i></a>
                                        <form action="{{ route('ews/dewasa.destroy', $ewsDewasa->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm mx-2"
                                                onclick="return confirm('Yakin Ingin Menghapus Data ?')"><i
                                                    class='bx bx-trash'></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="row">
                    <h6 class="m-0 mt-1 col-1">Ews Anak</h6>
                    <div class="col-2">
                        <a href="{{ route('ews/anak.show', $item->id) }}" class="btn btn-dark btn-sm"><i
                                class='bx bx-printer'></i></a>
                    </div>
                </div>
                <div class="card">
                    <table class="table">
                        <thead>
                            <tr class="text-nowrap">
                                <th class="text-body">No</th>
                                <th class="text-body">Petugas / Dokter</th>
                                <th class="text-body">Tanggal / Jam</th>
                                <th class="text-body">Jumlah Skor</th>
                                <th class="text-body">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($item->ranapEwsAnakPatients as $ewsAnak)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $ewsAnak->user->name ?? '' }}</td>
                                    <td>{{ $ewsAnak->tanggal ?? '' }} / {{ $ewsAnak->jam ?? '' }}</td>
                                    <td>{{ $ewsAnak->total_skor ?? '' }}</td>
                                    <td class="d-flex">
                                        <a href="{{ route('ews/anak.edit', $ewsAnak->id) }}"
                                            class="btn btn-warning btn-sm"><i class='bx bx-edit'></i></a>
                                        <form action="{{ route('ews/anak.destroy', $ewsAnak->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm mx-2"
                                                onclick="return confirm('Yakin Ingin Menghapus Data ?')"><i
                                                    class='bx bx-trash'></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade {{ session('btn') == 'hais' ? 'show active' : '' }}" id="navs-justified-hais"
                role="tabpanel">
                <div class="text-end mb-3">
                    <a class="btn btn-success btn-sm" href="/pencegahan-infeksi-saluran-kemih">+ Tambah Pencegahan
                        ISK</a>
                    <a class="btn btn-success btn-sm" href="/pencegahan-infeksi-aliran-darah">+ Tambah Pencegahan
                        IAD</a>
                    <a class="btn btn-success btn-sm" href="/pencegahan-infeksi-daerah-operasi">+ Tambah Pencegahan
                        IDO</a>
                </div>
                <div class="card">
                    <table class="table">
                        <thead>
                            <tr class="text-nowrap">
                                <th class="text-body">No</th>
                                <th class="text-body">Petugas / Dokter</th>
                                <th class="text-body">Ruangan</th>
                                <th class="text-body">Jenis HAIs</th>
                                <th class="text-body">Tanggal</th>
                                <th class="text-body">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade {{ session('btn') == 'monitoringresikojatuh' ? 'show active' : '' }}"
                id="navs-justified-monitoringresikojatuh" role="tabpanel">
                <div class="text-end mb-3">
                    <a href="{{ route('assesmen/monitoring/resiko/jatuh.show', $item->id) }}" target="blank"
                        class="btn btn-dark btn-sm"><i class='bx bx-printer'></i></a>
                    <a class="btn btn-success btn-sm"
                        href="{{ route('assesmen/monitoring/resiko/jatuh.create', $item->id) }}">+ Tambah Asesmen dan
                        Monitoring</a>
                </div>
                <div class="card">
                    <table class="table">
                        <thead>
                            <tr class="text-nowrap">
                                <th class="text-body">No</th>
                                <th class="text-body">Perawat / Inisial</th>
                                <th class="text-body">Tanggal</th>
                                <th class="text-body">Tipe</th>
                                <th class="text-body">Total Skor</th>
                                <th class="text-body">Nilai Skor</th>
                                <th class="text-body">Intervensi</th>
                                <th class="text-body">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($item->ranapMonitoringResikoJatuhPatients as $monitoringRJ)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $monitoringRJ->user->name ?? '' }}</td>
                                    <td>{{ $monitoringRJ->tanggal ?? '' }}</td>
                                    <td>{{ $monitoringRJ->tipe ?? '' }}</td>
                                    <td>{{ $monitoringRJ->total_skor ?? '' }}</td>
                                    <td>{{ $monitoringRJ->nilai_skor ?? '' }}</td>
                                    <td>
                                        <a href="{{ route('intervensi/pencegahan/resiko/jatuh.create', $monitoringRJ->id) }}"
                                            target="blank" class="btn btn-dark btn-sm mx-2"><i
                                                class='bx bx-plus'></i></a>
                                    </td>
                                    <td class="d-flex">
                                        <a href="{{ route('assesmen/monitoring/resiko/jatuh.edit', $monitoringRJ->id) }}"
                                            class="btn btn-warning btn-sm mx-2"><i class='bx bx-edit'></i></a>
                                        <form
                                            action="{{ route('assesmen/monitoring/resiko/jatuh.destroy', $monitoringRJ->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin Ingin Menghapus Data ?')"><i
                                                    class='bx bx-trash'></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade {{ session('btn') == 'monitoringstatusfungsional' ? 'show active' : '' }}"
                id="navs-justified-monitoringstatusfungsional" role="tabpanel">
                <div class="text-end mb-3">
                    <a href="{{ route('monitoring/status/fungsional.show', $item->id) }}" target="blank"
                        class="btn btn-dark btn-sm"><i class='bx bx-printer'></i></a>
                    <a class="btn btn-success btn-sm"
                        href="{{ route('monitoring/status/fungsional.create', $item->id) }}">+ Tambah Monitoring Status
                        Fungsional</a>
                </div>
                <div class="card">
                    <table class="table">
                        <thead>
                            <tr class="text-nowrap">
                                <th class="text-body">No</th>
                                <th class="text-body">Tanggal</th>
                                <th class="text-body">Perawat Pengkaji</th>
                                <th class="text-body">Total Skor</th>
                                <th class="text-body">Kategori Skor</th>
                                <th class="text-body">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($item->ranapAsesMoniStatusFungsionalPatients as $statusFungsional)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $statusFungsional->tanggal }}</td>
                                    <td>{{ $statusFungsional->nama_perawat }}</td>
                                    <td>{{ $statusFungsional->total_skor }}</td>
                                    <td>{{ $statusFungsional->kategori_skor }}</td>
                                    <td class="d-flex">
                                        <a href="{{ route('monitoring/status/fungsional.edit', $statusFungsional->id) }}"
                                            class="btn btn-warning btn-sm mx-2"><i class='bx bx-edit'></i></a>
                                        <form
                                            action="{{ route('monitoring/status/fungsional.destroy', $statusFungsional->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin Ingin Menghapus Data ?')"><i
                                                    class='bx bx-trash'></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade {{ session('btn') == 'tindakanpelayananpasien' ? 'show active' : '' }}"
                id="navs-justified-tindakanpelayananpasien" role="tabpanel">
                <div class="text-end mb-3">
                    <a class="btn btn-dark btn-sm" href="#"><i class="bx bx-printer"></i> Cetak Rekapitulasi</a>
                    {{-- <a class="btn btn-success btn-sm" href="{{ route('rekapitulasi/tindakan/pelayanan/pasien.create', $item->id) }}">+ Tambah Tindakan Pelayanan Pasien</a> --}}
                    <a class="btn btn-success btn-sm"
                        href="{{ route('rekapitulasi/tindakan/pelayanan/pasien.index', $item->id) }}">+ Tambah Tindakan
                        Pelayanan Pasien</a>
                </div>
                <div class="card">
                    <table class="table">
                        <thead>
                            <tr class="text-nowrap">
                                <th class="text-body">No</th>
                                <th class="text-body">Dokter Pengirim</th>
                                <th class="text-body">Tanggal Masuk</th>
                                <th class="text-body">Tanggal Keluar</th>
                                <th class="text-body">Detail</th>
                                <th class="text-body">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($item->ranapRekapTindakanPelayananPatients as $rekap)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $rekap->user->name }}</td>
                                    <td>{{ $rekap->tanggal_masuk }}</td>
                                    <td>{{ $rekap->tanggal_keluar }}</td>
                                    <td>
                                        <a href="{{ route('rekapitulasi/tindakan/pelayanan/pasien.create', $rekap->id) }}"
                                            class="btn btn-dark btn-sm"><i class="bx bx-plus"></i></a>
                                    </td>
                                    <td class="d-flex">
                                        <a href="{{ route('rekapitulasi/tindakan/pelayanan/pasien.show', $rekap->id) }}"
                                            class="btn btn-dark btn-sm mx-2"><i class='bx bx-show'></i></a>
                                        <a href="{{ route('rekapitulasi/tindakan/pelayanan/pasien.edit', $rekap->id) }}"
                                            class="btn btn-warning btn-sm mx-2"><i class='bx bx-edit'></i></a>
                                        <form
                                            action="{{ route('rekapitulasi/tindakan/pelayanan/pasien.destroy', $rekap->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin Ingin Menghapus Data ?')"><i
                                                    class='bx bx-trash'></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade {{ session('btn') == 'asesmenprasedasi' ? 'show active' : '' }}"
                id="navs-justified-asesmenprasedasi" role="tabpanel">
                <div class="text-end mb-3">
                    {{-- <a class="btn btn-dark btn-sm" href="#"><i class="bx bx-printer"></i> Cetak Rekapitulasi</a> --}}
                    {{-- <a class="btn btn-success btn-sm" href="{{ route('rekapitulasi/tindakan/pelayanan/pasien.create', $item->id) }}">+ Tambah Tindakan Pelayanan Pasien</a> --}}
                    <a class="btn btn-success btn-sm" href="{{ route('assesmen/pra/sedasi.create', $item->id) }}">+
                        Tambah Asesmen Pra Sedasi</a>
                </div>
                <div class="card">
                    <table class="table">
                        <thead>
                            <tr class="text-nowrap">
                                <th class="text-body">No</th>
                                <th class="text-body">Dokter Pengirim</th>
                                <th class="text-body">Tanggal Operasi</th>
                                <th class="text-body">Tanggal Pemeriksaan</th>
                                <th class="text-body">Dokter Anestesi</th>
                                <th class="text-body">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($item->ranapAssesmenPraSedations as $praSedasi)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $praSedasi->user->name ?? '' }}</td>
                                    <td>{{ $praSedasi->tanggal_operasi ?? '' }}</td>
                                    <td>{{ $praSedasi->tanggal_pemeriksaan ?? '' }}</td>
                                    <td>{{ $praSedasi->dokter_anestesi ?? '' }}</td>
                                    <td></td>
                                    <td class="d-flex">
                                        <a href="{{ route('assesmen/pra/sedasi.show', $praSedasi->id) }}"
                                            class="btn btn-dark btn-sm mx-2"><i class='bx bx-show'></i></a>
                                        <a href="{{ route('assesmen/pra/sedasi.edit', $praSedasi->id) }}"
                                            class="btn btn-warning btn-sm mx-2"><i class='bx bx-edit'></i></a>
                                        <form action="{{ route('assesmen/pra/sedasi.destroy', $praSedasi->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin Ingin Menghapus Data ?')"><i
                                                    class='bx bx-trash'></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- laporan anestesi --}}
            <div class="tab-pane fade {{ session('btn') == 'laporananestesi' ? 'show active' : '' }}"
                id="navs-justified-laporananestesi" role="tabpanel">
                <div class="text-end mb-3">
                    <a class="btn btn-success btn-sm" href="{{ route('laporan/anestesi.create', $item->id) }}">+
                        Tambah
                        Laporan Anestesi</a>
                </div>
                <div class="card">
                    <table class="table">
                        <thead>
                            <tr class="text-nowrap">
                                <th class="text-body">No</th>
                                <th class="text-body">User Pengisi</th>
                                <th class="text-body">Penata Anestesi</th>
                                <th class="text-body">Dokter Anestesi</th>
                                <th class="text-body">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($item->queue->anestesiReports as $anes)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $anes->user->name ?? '' }}</td>
                                    <td>{{ $anes->nama_penata_anestesi ?? '' }}</td>
                                    <td>{{ $anes->nama_dokter_anestesi ?? '' }}</td>
                                    <td></td>
                                    <td class="d-flex">
                                        <a href="{{ route('laporan/anestesi.show', $anes->id) }}"
                                            class="btn btn-dark btn-sm mx-2"><i class='bx bx-show'></i></a>
                                        <a href="{{ route('laporan/anestesi.edit', $anes->id) }}"
                                            class="btn btn-warning btn-sm mx-2"><i class='bx bx-edit'></i></a>
                                        <form action="{{ route('laporan/anestesi.destroy', $anes->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin Ingin Menghapus Data ?')"><i
                                                    class='bx bx-trash'></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade {{ session('btn') == 'asesmenpraanestesi-induksi' ? 'show active' : '' }}"
                id="navs-justified-asesmenpraanestesi-induksi" role="tabpanel">
                <div class="text-end mb-3">
                    {{-- <a class="btn btn-dark btn-sm" href="#"><i class="bx bx-printer"></i> Cetak Rekapitulasi</a> --}}
                    {{-- <a class="btn btn-success btn-sm" href="{{ route('rekapitulasi/tindakan/pelayanan/pasien.create', $item->id) }}">+ Tambah Tindakan Pelayanan Pasien</a> --}}
                    <a class="btn btn-success btn-sm"
                        href="{{ route('assesmen/pra/anestesi/pra/induksi.create', $item->id) }}">+ Tambah Asesmen Pra
                        Anestesi - Induksi</a>
                </div>
                <div class="card">
                    <table class="table">
                        <thead>
                            <tr class="text-nowrap">
                                <th class="text-body">No</th>
                                <th class="text-body">Tanggal Assesmen</th>
                                <th class="text-body">Dokter Anestesi</th>
                                <th class="text-body">Asisten Anestesi</th>
                                <th class="text-body">Dokter Bedah</th>
                                <th class="text-body">Diagnosis Pra Bedah</th>
                                <th class="text-body">Jenis Pembedahan</th>
                                <th class="text-body">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($item->ranapAssesmenPraAnesthesias as $praAnesInduksi)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $praAnesInduksi->tanggal ?? '' }}</td>
                                    <td>{{ $praAnesInduksi->dokter_anestesi ?? '' }}</td>
                                    <td>{{ $praAnesInduksi->asisten_anestesi ?? '' }}</td>
                                    <td>{{ $praAnesInduksi->dokter_bedah ?? '' }}</td>
                                    <td>{{ $praAnesInduksi->diagnosis_pra_bedah ?? '' }}</td>
                                    <td>{{ $praAnesInduksi->jenis_pembedahan ?? '' }}</td>
                                    <td class="d-flex">
                                        <a href="{{ route('assesmen/pra/anestesi/pra/induksi.show', $praAnesInduksi->id) }}"
                                            class="btn btn-dark btn-sm mx-2"><i class='bx bx-show'></i></a>
                                        <a href="{{ route('assesmen/pra/anestesi/pra/induksi.edit', $praAnesInduksi->id) }}"
                                            class="btn btn-warning btn-sm mx-2"><i class='bx bx-edit'></i></a>
                                        <form
                                            action="{{ route('assesmen/pra/anestesi/pra/induksi.destroy', $praAnesInduksi->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin Ingin Menghapus Data ?')"><i
                                                    class='bx bx-trash'></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade {{ session('btn') == 'monitoringpelayananobatpasien' ? 'show active' : '' }}"
                id="navs-justified-monitoringpelayananobatpasien" role="tabpanel">
                {{-- <div class="text-end mb-3">
                <a class="btn btn-dark btn-sm" href="#"><i class="bx bx-printer"></i> Cetak Rekapitulasi</a>
                <a class="btn btn-success btn-sm" href="/create-tindakan-pelayanan-pasien">+ Tambah Tindakan Pelayanan Pasien</a>
            </div> --}}
                <div class="nav-align-top">
                    <ul class="nav nav-pills nav-sm mb-3 nav-fill w-100" role="tablist">
                        <li class="nav-item">
                            <button type="button"
                                class="border nav-link {{ session('perawat') == 'obatoral' ? 'active' : '' }}"
                                role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-obatoral"
                                aria-controls="navs-pills-justified-obatoral" aria-selected="true">
                                Obat Oral
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button"
                                class="border nav-link {{ session('perawat') == 'obatinjeksi' ? 'active' : '' }}"
                                role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-obatinjeksi"
                                aria-controls="navs-pills-justified-obatinjeksi" aria-selected="true">
                                Obat Injeksi
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button"
                                class="border nav-link {{ session('perawat') == 'obathighalert' ? 'active' : '' }}"
                                role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-obathighalert"
                                aria-controls="navs-pills-justified-obathighalert" aria-selected="true">
                                Obat High Alert
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button"
                                class="border nav-link {{ session('perawat') == 'suppositoria' ? 'active' : '' }}"
                                role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-suppositoria"
                                aria-controls="navs-pills-justified-suppositoria" aria-selected="true">
                                Suppositoria
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button"
                                class="border nav-link {{ session('perawat') == 'alkes' ? 'active' : '' }}"
                                role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-alkes"
                                aria-controls="navs-pills-justified-alkes" aria-selected="true">
                                Alkes
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button"
                                class="border nav-link {{ session('perawat') == 'lainlain' ? 'active' : '' }}"
                                role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-lainlain"
                                aria-controls="navs-pills-justified-lainlain" aria-selected="true">
                                Dan Lain - Lain
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button"
                                class="border nav-link {{ session('perawat') == 'monitoringobat' ? 'active' : '' }}"
                                role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-monitoringobat"
                                aria-controls="navs-pills-justified-monitoringobat" aria-selected="true">
                                Monitoring Obat
                            </button>
                        </li>


                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade {{ session('perawat') == 'obatoral' ? 'show active' : '' }}"
                            id="navs-pills-justified-obatoral" role="tabpanel">
                            <div class="accordion" id="accordionExample">
                                <div class="card accordion-item active">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                            data-bs-target="#obat1" aria-expanded="true" aria-controls="accordionOne"
                                            role="tabpanel">
                                            Paracetamol | Dosis : 300mg | Frekuensi : 3 X 1
                                        </button>
                                    </h2>

                                    <div id="obat1" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jumlah / R</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="jml" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Tanggal</label>
                                                        <div class="col-sm-9">
                                                            <input type="date" name="tanggal" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jam</label>
                                                        <div class="col-sm-9">
                                                            <input type="time" name="jam" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label" for="basic-default-name">P
                                                            / I</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="text-end">
                                                        <button class="btn btn-sm btn-dark mb-3">Simpan</button>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jam</label>
                                                        <div class="col-sm-9">
                                                            <input type="time" name="jam" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label" for="basic-default-name">P
                                                            / I</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="text-end">
                                                        <button class="btn btn-sm btn-dark mb-3">Simpan</button>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jam</label>
                                                        <div class="col-sm-9">
                                                            <input type="time" name="jam" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label" for="basic-default-name">P
                                                            / I</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="text-end">
                                                        <button class="btn btn-sm btn-dark mb-3">Simpan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card accordion-item active">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                            data-bs-target="#obat2" aria-expanded="true" aria-controls="accordionOne"
                                            role="tabpanel">
                                            Paracetamol | Dosis : 300mg | Frekuensi : 3 X 1
                                        </button>
                                    </h2>

                                    <div id="obat2" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jumlah / R</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="jml" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Tanggal</label>
                                                        <div class="col-sm-9">
                                                            <input type="date" name="tanggal" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jam</label>
                                                        <div class="col-sm-9">
                                                            <input type="time" name="jam" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label" for="basic-default-name">P
                                                            / I</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="text-end">
                                                        <button class="btn btn-sm btn-dark mb-3">Simpan</button>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jam</label>
                                                        <div class="col-sm-9">
                                                            <input type="time" name="jam" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label" for="basic-default-name">P
                                                            / I</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="text-end">
                                                        <button class="btn btn-sm btn-dark mb-3">Simpan</button>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jam</label>
                                                        <div class="col-sm-9">
                                                            <input type="time" name="jam" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">P
                                                            / I</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="text-end">
                                                        <button class="btn btn-sm btn-dark mb-3">Simpan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card accordion-item active">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                            data-bs-target="#obat3" aria-expanded="true" aria-controls="accordionOne"
                                            role="tabpanel">
                                            Paracetamol | Dosis : 300mg | Frekuensi : 3 X 1
                                        </button>
                                    </h2>

                                    <div id="obat3" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jumlah / R</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="jml" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Tanggal</label>
                                                        <div class="col-sm-9">
                                                            <input type="date" name="tanggal" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jam</label>
                                                        <div class="col-sm-9">
                                                            <input type="time" name="jam" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">P
                                                            / I</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="text-end">
                                                        <button class="btn btn-sm btn-dark mb-3">Simpan</button>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jam</label>
                                                        <div class="col-sm-9">
                                                            <input type="time" name="jam" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">P
                                                            / I</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="text-end">
                                                        <button class="btn btn-sm btn-dark mb-3">Simpan</button>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jam</label>
                                                        <div class="col-sm-9">
                                                            <input type="time" name="jam" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">P
                                                            / I</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="text-end">
                                                        <button class="btn btn-sm btn-dark mb-3">Simpan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="tab-pane fade {{ session('perawat') == 'obatinjeksi' ? 'show active' : '' }}"
                            id="navs-pills-justified-obatinjeksi" role="tabpanel">
                            <div class="accordion" id="obatinjeksi">
                                <div class="card accordion-item active">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button type="button" class="accordion-button collapsed"
                                            data-bs-toggle="collapse" data-bs-target="#obatinjeksi1"
                                            aria-expanded="true" aria-controls="accordionOne" role="tabpanel">
                                            Paracetamol | Dosis : 300mg | Frekuensi : 3 X 1
                                        </button>
                                    </h2>

                                    <div id="obatinjeksi1" class="accordion-collapse collapse"
                                        data-bs-parent="#obatinjeksi">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jumlah / R</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="jml" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Tanggal</label>
                                                        <div class="col-sm-9">
                                                            <input type="date" name="tanggal" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jam</label>
                                                        <div class="col-sm-9">
                                                            <input type="time" name="jam" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">P
                                                            / I</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="text-end">
                                                        <button class="btn btn-sm btn-dark mb-3">Simpan</button>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jam</label>
                                                        <div class="col-sm-9">
                                                            <input type="time" name="jam" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">P
                                                            / I</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="text-end">
                                                        <button class="btn btn-sm btn-dark mb-3">Simpan</button>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jam</label>
                                                        <div class="col-sm-9">
                                                            <input type="time" name="jam" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">P
                                                            / I</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="text-end">
                                                        <button class="btn btn-sm btn-dark mb-3">Simpan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card accordion-item active">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button type="button" class="accordion-button collapsed"
                                            data-bs-toggle="collapse" data-bs-target="#obatinjeksi2"
                                            aria-expanded="true" aria-controls="accordionOne" role="tabpanel">
                                            Paracetamol | Dosis : 300mg | Frekuensi : 3 X 1
                                        </button>
                                    </h2>

                                    <div id="obatinjeksi2" class="accordion-collapse collapse"
                                        data-bs-parent="#obatinjeksi">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jumlah / R</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="jml" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Tanggal</label>
                                                        <div class="col-sm-9">
                                                            <input type="date" name="tanggal" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jam</label>
                                                        <div class="col-sm-9">
                                                            <input type="time" name="jam" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">P / I</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="text-end">
                                                        <button class="btn btn-sm btn-dark mb-3">Simpan</button>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jam</label>
                                                        <div class="col-sm-9">
                                                            <input type="time" name="jam" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">P / I</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="text-end">
                                                        <button class="btn btn-sm btn-dark mb-3">Simpan</button>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jam</label>
                                                        <div class="col-sm-9">
                                                            <input type="time" name="jam" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">P / I</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="text-end">
                                                        <button class="btn btn-sm btn-dark mb-3">Simpan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card accordion-item active">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button type="button" class="accordion-button collapsed"
                                            data-bs-toggle="collapse" data-bs-target="#obatinjeksi3"
                                            aria-expanded="true" aria-controls="accordionOne" role="tabpanel">
                                            Paracetamol | Dosis : 300mg | Frekuensi : 3 X 1
                                        </button>
                                    </h2>

                                    <div id="obatinjeksi3" class="accordion-collapse collapse"
                                        data-bs-parent="#obatinjeksi">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jumlah / R</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="jml" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Tanggal</label>
                                                        <div class="col-sm-9">
                                                            <input type="date" name="tanggal" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jam</label>
                                                        <div class="col-sm-9">
                                                            <input type="time" name="jam" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">P / I</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="text-end">
                                                        <button class="btn btn-sm btn-dark mb-3">Simpan</button>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jam</label>
                                                        <div class="col-sm-9">
                                                            <input type="time" name="jam" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">P / I</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="text-end">
                                                        <button class="btn btn-sm btn-dark mb-3">Simpan</button>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jam</label>
                                                        <div class="col-sm-9">
                                                            <input type="time" name="jam" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">P / I</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="text-end">
                                                        <button class="btn btn-sm btn-dark mb-3">Simpan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="tab-pane fade {{ session('perawat') == 'obathighalert' ? 'show active' : '' }}"
                            id="navs-pills-justified-obathighalert" role="tabpanel">
                            <div class="accordion" id="obathighalert">
                                <div class="card accordion-item active">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                            data-bs-target="#obat1" aria-expanded="true" aria-controls="accordionOne"
                                            role="tabpanel">
                                            Paracetamol | Dosis : 300mg | Frekuensi : 3 X 1
                                        </button>
                                    </h2>

                                    <div id="obat1" class="accordion-collapse collapse"
                                        data-bs-parent="#obathighalert">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jumlah / R</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="jml" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Tanggal</label>
                                                        <div class="col-sm-9">
                                                            <input type="date" name="tanggal" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jam</label>
                                                        <div class="col-sm-9">
                                                            <input type="time" name="jam" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">P / I (1)</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">P / I (2)</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i2" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="text-end">
                                                        <button class="btn btn-sm btn-dark mb-3">Simpan</button>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jam</label>
                                                        <div class="col-sm-9">
                                                            <input type="time" name="jam" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">P / I (1)</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">P / I (2)</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i2" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="text-end">
                                                        <button class="btn btn-sm btn-dark mb-3">Simpan</button>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jam</label>
                                                        <div class="col-sm-9">
                                                            <input type="time" name="jam" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">P / I (1)</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">P / I (2)</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i2" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="text-end">
                                                        <button class="btn btn-sm btn-dark mb-3">Simpan</button>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card accordion-item active">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                            data-bs-target="#obat2" aria-expanded="true" aria-controls="accordionOne"
                                            role="tabpanel">
                                            Paracetamol | Dosis : 300mg | Frekuensi : 3 X 1
                                        </button>
                                    </h2>

                                    <div id="obat2" class="accordion-collapse collapse"
                                        data-bs-parent="#obathighalert">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jumlah / R</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="jml" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Tanggal</label>
                                                        <div class="col-sm-9">
                                                            <input type="date" name="tanggal" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jam</label>
                                                        <div class="col-sm-9">
                                                            <input type="time" name="jam" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">P / I (1)</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">P / I (2)</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i2" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="text-end">
                                                        <button class="btn btn-sm btn-dark mb-3">Simpan</button>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jam</label>
                                                        <div class="col-sm-9">
                                                            <input type="time" name="jam" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">P / I (1)</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">P / I (2)</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i2" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="text-end">
                                                        <button class="btn btn-sm btn-dark mb-3">Simpan</button>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jam</label>
                                                        <div class="col-sm-9">
                                                            <input type="time" name="jam" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">P / I (1)</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">P / I (2)</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i2" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="text-end">
                                                        <button class="btn btn-sm btn-dark mb-3">Simpan</button>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>
                        <div class="tab-pane fade {{ session('perawat') == 'suppositoria' ? 'show active' : '' }}"
                            id="navs-pills-justified-suppositoria" role="tabpanel">
                            <div class="accordion" id="suppositoria">
                                <div class="card accordion-item active">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                            data-bs-target="#obat1" aria-expanded="true" aria-controls="accordionOne"
                                            role="tabpanel">
                                            Paracetamol | Dosis : 300mg | Frekuensi : 3 X 1
                                        </button>
                                    </h2>

                                    <div id="obat1" class="accordion-collapse collapse"
                                        data-bs-parent="#suppositoria">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jumlah / R</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="jml" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Tanggal</label>
                                                        <div class="col-sm-9">
                                                            <input type="date" name="tanggal" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jam</label>
                                                        <div class="col-sm-9">
                                                            <input type="time" name="jam" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">P / I</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>

                                                    <div class="text-end">
                                                        <button class="btn btn-sm btn-dark mb-3">Simpan</button>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jam</label>
                                                        <div class="col-sm-9">
                                                            <input type="time" name="jam" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">P / I</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>

                                                    <div class="text-end">
                                                        <button class="btn btn-sm btn-dark mb-3">Simpan</button>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jam</label>
                                                        <div class="col-sm-9">
                                                            <input type="time" name="jam" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">P / I</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>

                                                    <div class="text-end">
                                                        <button class="btn btn-sm btn-dark mb-3">Simpan</button>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card accordion-item active">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                            data-bs-target="#obat2" aria-expanded="true" aria-controls="accordionOne"
                                            role="tabpanel">
                                            Paracetamol | Dosis : 300mg | Frekuensi : 3 X 1
                                        </button>
                                    </h2>

                                    <div id="obat2" class="accordion-collapse collapse"
                                        data-bs-parent="#suppositoria">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jumlah / R</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="jml" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Tanggal</label>
                                                        <div class="col-sm-9">
                                                            <input type="date" name="tanggal" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jam</label>
                                                        <div class="col-sm-9">
                                                            <input type="time" name="jam" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">P / I</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>

                                                    <div class="text-end">
                                                        <button class="btn btn-sm btn-dark mb-3">Simpan</button>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jam</label>
                                                        <div class="col-sm-9">
                                                            <input type="time" name="jam" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">P / I</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>

                                                    <div class="text-end">
                                                        <button class="btn btn-sm btn-dark mb-3">Simpan</button>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jam</label>
                                                        <div class="col-sm-9">
                                                            <input type="time" name="jam" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">P / I</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>

                                                    <div class="text-end">
                                                        <button class="btn btn-sm btn-dark mb-3">Simpan</button>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>
                        <div class="tab-pane fade {{ session('perawat') == 'alkes' ? 'show active' : '' }}"
                            id="navs-pills-justified-alkes" role="tabpanel">
                            <div class="accordion" id="alkes">
                                <div class="card accordion-item active">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                            data-bs-target="#obat1" aria-expanded="true" aria-controls="accordionOne"
                                            role="tabpanel">
                                            Cateter | Frekuensi : 3 X 1
                                        </button>
                                    </h2>

                                    <div id="obat1" class="accordion-collapse collapse" data-bs-parent="#alkes">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jumlah / R</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="jml" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Tanggal</label>
                                                        <div class="col-sm-9">
                                                            <input type="date" name="tanggal" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jam</label>
                                                        <div class="col-sm-9">
                                                            <input type="time" name="jam" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">P / I (1)</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">P / I (2)</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i2" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="text-end">
                                                        <button class="btn btn-sm btn-dark mb-3">Simpan</button>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jam</label>
                                                        <div class="col-sm-9">
                                                            <input type="time" name="jam" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">P / I (1)</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">P / I (2)</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i2" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="text-end">
                                                        <button class="btn btn-sm btn-dark mb-3">Simpan</button>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jam</label>
                                                        <div class="col-sm-9">
                                                            <input type="time" name="jam" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">P / I (1)</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">P / I (2)</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i2" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="text-end">
                                                        <button class="btn btn-sm btn-dark mb-3">Simpan</button>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card accordion-item active">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                            data-bs-target="#obat2" aria-expanded="true" aria-controls="accordionOne"
                                            role="tabpanel">
                                            Suntik | Frekuensi : 3 X 1
                                        </button>
                                    </h2>

                                    <div id="obat2" class="accordion-collapse collapse" data-bs-parent="#alkes">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jumlah / R</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="jml" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Tanggal</label>
                                                        <div class="col-sm-9">
                                                            <input type="date" name="tanggal" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jam</label>
                                                        <div class="col-sm-9">
                                                            <input type="time" name="jam" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">P / I (1)</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">P / I (2)</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i2" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="text-end">
                                                        <button class="btn btn-sm btn-dark mb-3">Simpan</button>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jam</label>
                                                        <div class="col-sm-9">
                                                            <input type="time" name="jam" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">P / I (1)</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">P / I (2)</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i2" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="text-end">
                                                        <button class="btn btn-sm btn-dark mb-3">Simpan</button>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jam</label>
                                                        <div class="col-sm-9">
                                                            <input type="time" name="jam" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">P / I (1)</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">P / I (2)</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i2" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="text-end">
                                                        <button class="btn btn-sm btn-dark mb-3">Simpan</button>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>
                        <div class="tab-pane fade {{ session('perawat') == 'lainlain' ? 'show active' : '' }}"
                            id="navs-pills-justified-lainlain" role="tabpanel">
                            <div class="accordion" id="lainlain">
                                <div class="card accordion-item active">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                            data-bs-target="#obat1" aria-expanded="true" aria-controls="accordionOne"
                                            role="tabpanel">
                                            Paracetamol | Dosis : 300mg | Frekuensi : 3 X 1
                                        </button>
                                    </h2>

                                    <div id="obat1" class="accordion-collapse collapse"
                                        data-bs-parent="#lainlain">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jumlah / R</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="jml" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Tanggal</label>
                                                        <div class="col-sm-9">
                                                            <input type="date" name="tanggal" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jam</label>
                                                        <div class="col-sm-9">
                                                            <input type="time" name="jam" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">P / I</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>

                                                    <div class="text-end">
                                                        <button class="btn btn-sm btn-dark mb-3">Simpan</button>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jam</label>
                                                        <div class="col-sm-9">
                                                            <input type="time" name="jam" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">P / I</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>

                                                    <div class="text-end">
                                                        <button class="btn btn-sm btn-dark mb-3">Simpan</button>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jam</label>
                                                        <div class="col-sm-9">
                                                            <input type="time" name="jam" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">P / I</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>

                                                    <div class="text-end">
                                                        <button class="btn btn-sm btn-dark mb-3">Simpan</button>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card accordion-item active">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                            data-bs-target="#obat2" aria-expanded="true" aria-controls="accordionOne"
                                            role="tabpanel">
                                            Paracetamol | Dosis : 300mg | Frekuensi : 3 X 1
                                        </button>
                                    </h2>

                                    <div id="obat2" class="accordion-collapse collapse"
                                        data-bs-parent="#lainlain">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jumlah / R</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="jml" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Tanggal</label>
                                                        <div class="col-sm-9">
                                                            <input type="date" name="tanggal" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jam</label>
                                                        <div class="col-sm-9">
                                                            <input type="time" name="jam" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">P / I</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>

                                                    <div class="text-end">
                                                        <button class="btn btn-sm btn-dark mb-3">Simpan</button>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jam</label>
                                                        <div class="col-sm-9">
                                                            <input type="time" name="jam" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">P / I</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>

                                                    <div class="text-end">
                                                        <button class="btn btn-sm btn-dark mb-3">Simpan</button>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">Jam</label>
                                                        <div class="col-sm-9">
                                                            <input type="time" name="jam" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">P / I</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>

                                                    <div class="text-end">
                                                        <button class="btn btn-sm btn-dark mb-3">Simpan</button>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>
                        <div class="tab-pane fade {{ session('perawat') == 'monitoringobat' ? 'show active' : '' }}"
                            id="navs-pills-justified-monitoringobat" role="tabpanel">
                            <div class="accordion" id="monitoringobat">
                                <div class="card accordion-item active">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                            data-bs-target="#obat1" aria-expanded="true" aria-controls="accordionOne"
                                            role="tabpanel">
                                            Paracetamol
                                        </button>
                                    </h2>

                                    <div id="obat1" class="accordion-collapse collapse"
                                        data-bs-parent="#monitoringobat">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-2 col-form-label"
                                                            for="basic-default-name">Skin Test</label>
                                                        <div class="col-sm-5">
                                                            <input type="text" name="plusskintest"
                                                                class="form-control" id="basic-default-name"
                                                                placeholder="+">
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <input type="text" name="minusskintest"
                                                                class="form-control" id="basic-default-name"
                                                                placeholder="-">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-2 col-form-label"
                                                            for="basic-default-name">Alergi</label>
                                                        <div class="col-sm-5">
                                                            <input type="text" name="plusalergi"
                                                                class="form-control" id="basic-default-name"
                                                                placeholder="+">
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <input type="text" name="minusalergi"
                                                                class="form-control" id="basic-default-name"
                                                                placeholder="-">
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="text-end">
                                                <button class="btn btn-sm btn-dark mb-3">Simpan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card accordion-item active">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                            data-bs-target="#obat2" aria-expanded="true" aria-controls="accordionOne"
                                            role="tabpanel">
                                            Paracetamol
                                        </button>
                                    </h2>

                                    <div id="obat2" class="accordion-collapse collapse"
                                        data-bs-parent="#monitoringobat">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-2 col-form-label"
                                                            for="basic-default-name">Skin Test</label>
                                                        <div class="col-sm-5">
                                                            <input type="text" name="plusskintest"
                                                                class="form-control" id="basic-default-name"
                                                                placeholder="+">
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <input type="text" name="minusskintest"
                                                                class="form-control" id="basic-default-name"
                                                                placeholder="-">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-2 col-form-label"
                                                            for="basic-default-name">Alergi</label>
                                                        <div class="col-sm-5">
                                                            <input type="text" name="plusalergi"
                                                                class="form-control" id="basic-default-name"
                                                                placeholder="+">
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <input type="text" name="minusalergi"
                                                                class="form-control" id="basic-default-name"
                                                                placeholder="-">
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>

                                            <div class="text-end">
                                                <button class="btn btn-sm btn-dark mb-3">Simpan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade {{ session('btn') == 'managerpelayananpasien' ? 'show active' : '' }}"
                id="navs-justified-managerpelayananpasien" role="tabpanel">
                <div class="text-end mb-3">
                    @if ($item->ranapMppPatient)
                        <a class="btn btn-warning btn-sm"
                            href="{{ route('evaluasi/awal/MPP.edit', $item->ranapMppPatient->id) }}"><i
                                class="bx bx-edit"></i> Edit MPP</a>
                    @else
                        <a class="btn btn-success btn-sm" href="{{ route('evaluasi/awal/MPP.create', $item->id) }}">+
                            Tambah MPP</a>
                    @endif
                </div>
                <div class="card">
                    <table class="table">
                        <thead>
                            <tr class="text-nowrap">
                                <th class="text-body">Tanggal Masuk</th>
                                <th class="text-body">Tanggal Keluar</th>
                                <th class="text-body">Ruangan</th>
                                <th class="text-body">Kelas Rawatan</th>
                                <th class="text-body">Tindakan</th>
                                <th class="text-body">Diagnosa</th>
                                <th class="text-body">Total Skor Major</th>
                                <th class="text-body">Total Skor Minor</th>
                                <th class="text-body">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($item->ranapMppPatient)
                                <tr>
                                    <td>{{ $item->ranapMppPatient->tanggal_masuk ?? '' }}</td>
                                    <td>{{ $item->ranapMppPatient->tanggal_keluar ?? '' }}</td>
                                    <td>{{ $item->ranapMppPatient->ruang ?? '' }}</td>
                                    <td>{{ $item->ranapMppPatient->kelas_rawatan ?? '' }}</td>
                                    <td>{{ $item->ranapMppPatient->tindakan ?? '' }}</td>
                                    <td>{{ $item->ranapMppPatient->diagnosa ?? '' }}</td>
                                    <td>{{ $item->ranapMppPatient->total_skor_major ?? '' }}</td>
                                    <td>{{ $item->ranapMppPatient->total_skor_minor ?? '' }}</td>
                                    <td class="d-flex">
                                        <a href="{{ route('evaluasi/awal/MPP.show', $item->ranapMppPatient->id) }}"
                                            class="btn btn-dark btn-sm mx-2"><i class='bx bx-show'></i></a>
                                        <a href="{{ route('evaluasi/awal/MPP.edit', $item->ranapMppPatient->id) }}"
                                            class="btn btn-warning btn-sm mx-2"><i class='bx bx-edit'></i></a>
                                        <form
                                            action="{{ route('evaluasi/awal/MPP.destroy', $item->ranapMppPatient->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin Ingin Menghapus Data ?')"><i
                                                    class='bx bx-trash'></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- end V1 --}}

    </div>
    {{-- /nav tab --}}
@endsection
