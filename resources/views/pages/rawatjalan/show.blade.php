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
            <form action="{{ route('rajal/update', $item->rawatJalanPatient->rawatJalanPoliPatient->id) }}" method="POST"
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
            @php
                $tanggalLahir = new DateTime($item->patient->tanggal_lhr);
                $ageDiff = $today->diff($tanggalLahir);
                $ageString = $ageDiff->format('%y tahun');
            @endphp
            @can('show pasien poli')
                <div class="row mt-4 px-5">
                    <div class="col-sm-6">
                        <div class="d-flex">
                            <h6 class="m-0 mt-1">{{ $item->patient->name }}
                                ({{ implode('-', str_split(str_pad($item->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }})
                            </h6>
                        </div>
                        <hr class="p-0 mt-2">
                        <table class="w-100">
                            <tbody>
                                <tr>
                                    <td style="min-width: 150px">Tanggungan</td>
                                    <td style="min-width: 30px">:</td>
                                    <td>{{ $item->patientCategory->name }}</td>
                                </tr>
                                <tr>
                                    <td style="min-width: 150px">Jenis Kelamin</td>
                                    <td style="min-width: 30px">:</td>
                                    <td>{{ $item->patient->jenis_kelamin }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Lahir</td>
                                    <td>:</td>
                                    <td>{{ $item->patient->tanggal_lhr }}</td>
                                </tr>
                                <tr>
                                    <td>Usia</td>
                                    <td>:</td>
                                    <td>{{ $ageString }}</td>
                                </tr>
                                <tr>
                                    <td>Telepon</td>
                                    <td>:</td>
                                    <td>{{ $item->patient->telp }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td>{{ $item->patient->alamat }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <hr class="p-0 mt-2">
                        <h6>Dokter Penanggung Jawab Pelayanan (DPJP)</h6>
                        <p>{{ $item->doctorPatient->user->name }} ({{ $item->doctorPatient->user->staff_id }})</p>
                    </div>
                    <div class="col-sm-6">
                        <div class="container mt-4 pt-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title text-center">Antrian</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12 text-center">
                                                    <span class="display-3">{{ $item->no_antrian ?? '' }}</span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan
        </div>
        {{-- end Informasi Pasien --}}

        {{-- Menu Rajal --}}
        <div class="card-body">
            <div class="nav-align-top mb-2 shadow-sm">
                <ul class="nav nav-tabs nav-sm nav-fill" role="tablist">
                    {{-- @can('show pasien poli')
                        <li class="nav-item">
                            <button id="btn-link" type="button"
                                class="nav-link {{ session('btn') == 'dashboard' ? 'active' : '' }} d-flex justify-content-center"
                                role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-home"
                                aria-controls="navs-justified-home" aria-selected="true">
                                <i class="tf-icons bx bx-grid-alt"></i>
                                <p class="m-0">Dashboard</p>
                            </button>
                        </li>
                    @endcan --}}
                    @canany(['daftar assesmen awal', 'daftar permintaan radiologi', 'daftar permintaan labor pk'])
                        <li class="nav-item">
                            <button id="btn-link" type="button"
                                class="nav-link {{ session('btn') == 'dokter' ? 'active' : '' }} d-flex justify-content-center"
                                role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-profile"
                                aria-controls="navs-justified-profile" aria-selected="false" onclick="showHasil()">
                                <i class="tf-icons bx bx-bookmark-alt-plus"></i>
                                <p class="m-0">RME Dokter</p>
                            </button>
                        </li>
                    @endcanany
                    @can('daftar rme perawat')
                        <li class="nav-item">
                            <button id="btn-link" type="button"
                                class="nav-link {{ session('btn') == 'perawat' ? 'active' : '' }} d-flex justify-content-center"
                                role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-messages"
                                aria-controls="navs-justified-messages" aria-selected="false">
                                <i class="tf-icons bx bx-message-square-add"></i>
                                <p class="m-0">RME Perawat</p>
                            </button>
                        </li>
                    @endcan
                    @can('daftar cppt')
                        <li class="nav-item">
                            <button id="btn-link" type="button"
                                class="nav-link {{ session('btn') == 'cppt' ? 'active' : '' }} d-flex justify-content-center"
                                role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-cppt"
                                aria-controls="navs-justified-cppt" aria-selected="false">
                                <i class="tf-icons bx bx-message-alt-add"></i>
                                <p class="m-0">CPPT</p>
                            </button>
                        </li>
                    @endcan
                    @can('daftar prmrj')
                        <li class="nav-item">
                            <button id="btn-link" type="button"
                                class="nav-link {{ session('btn') == 'prmrj' ? 'active' : '' }} d-flex justify-content-center"
                                role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-prmrj"
                                aria-controls="navs-justified-prmrj" aria-selected="false">
                                <i class="tf-icons bx bx-message-alt-add"></i>
                                <p class="m-0">PRMRJ</p>
                            </button>
                        </li>
                    @endcan
                    @can('daftar laporan tindakan')
                        <li class="nav-item">
                            <button type="button"
                                class="nav-link d-flex justify-content-center {{ session('btn') == 'tindakan' ? 'active' : '' }}"
                                role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-tindakan"
                                aria-controls="navs-justified-tindakan" aria-selected="false">
                                <i class="tf-icons bx bx-sitemap"></i>
                                <p class="m-0">Laporan Tindakan</p>
                            </button>
                        </li>
                    @endcan
                    @can('daftar resep dokter')
                        <li class="nav-item">
                            <button type="button"
                                class="nav-link d-flex justify-content-center {{ session('btn') == 'resep dokter' ? 'active' : '' }}"
                                role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-resep"
                                aria-controls="navs-justified-resep" aria-selected="false">
                                <i class="tf-icons bx bx-list-ul"></i>
                                <p class="m-0">Resep Obat</p>
                            </button>
                        </li>
                    @endcan
                    <li class="nav-item">
                        <button type="button"
                            class="nav-link d-flex justify-content-center {{ session('btn') == 'sbpk' ? 'active' : '' }}"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-sbpk"
                            aria-controls="navs-justified-sbpk" aria-selected="false">
                            <i class="tf-icons bx bx-mail-send"></i>
                            <p class="m-0">SBPK</p>
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    @canany(['daftar assesmen awal', 'daftar permintaan radiologi', 'daftar permintaan labor pk'])
                        <div class="tab-pane fade {{ session('btn') == 'dokter' ? 'show active' : '' }}"
                            id="navs-justified-profile" role="tabpanel">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="nav-align-top w-100 mb-4">
                                        <ul class="nav nav-pills nav-sm mb-3 nav-fill" role="tablist">
                                            @can('daftar assesmen awal')
                                                <li class="nav-item">
                                                    <button type="button"
                                                        class="border  nav-link {{ session('dokter') == 'assesmen' ? 'active' : '' }}"
                                                        role="tab" data-bs-toggle="tab"
                                                        data-bs-target="#navs-pills-justified-asesmen"
                                                        aria-controls="navs-pills-justified-asesmen" aria-selected="true">
                                                        Asesmen Awal
                                                    </button>
                                                </li>
                                            @endcan
                                            @can('daftar permintaan radiologi')
                                                <li class="nav-item">
                                                    <button type="button"
                                                        class="border nav-link {{ session('dokter') == 'radiologi' ? 'active' : '' }}"
                                                        role="tab" data-bs-toggle="tab"
                                                        data-bs-target="#navs-pills-justified-radiologi"
                                                        aria-controls="navs-pills-justified-radiologi" aria-selected="true">
                                                        Permintaan Radiologi
                                                    </button>
                                                </li>
                                            @endcan
                                            @can('daftar permintaan labor pk')
                                                <li class="nav-item">
                                                    <button type="button"
                                                        class="border nav-link {{ session('dokter') == 'laboratorium' ? 'active' : '' }}"
                                                        role="tab" data-bs-toggle="tab"
                                                        data-bs-target="#navs-pills-justified-laboratorium"
                                                        aria-controls="navs-pills-justified-laboratorium" aria-selected="true">
                                                        Permintaan Laboratorium PK
                                                    </button>
                                                </li>
                                            @endcan
                                            @can('daftar permintaan labor pa')
                                                <li class="nav-item">
                                                    <button type="button"
                                                        class="border nav-link {{ session('dokter') == 'laboratorium PA' ? 'active' : '' }}"
                                                        role="tab" data-bs-toggle="tab"
                                                        data-bs-target="#navs-pills-justified-laboratorium-pa"
                                                        aria-controls="navs-pills-justified-laboratorium-pa" aria-selected="true">
                                                        Permintaan Laboratorium PA
                                                    </button>
                                                </li>
                                            @endcan
                                        </ul>
                                        <div class="tab-content">
                                            @can('daftar assesmen awal')
                                                <div class="tab-pane fade {{ session('dokter') == 'assesmen' ? 'show active' : '' }}"
                                                    id="navs-pills-justified-asesmen" role="tabpanel">
                                                    @can('tambah assesmen awal')
                                                        <div class="text-end">
                                                            <a href="{{ route('rajal/rmedokter/assesmenawal.create', $item->id) }}"
                                                                class="btn btn-success btn-sm">+Tambah Assesmen</a>
                                                        </div>
                                                    @endcan
                                                    <table class="table">
                                                        <thead>
                                                            <tr class="text-nowrap">
                                                                <th class="text-body">No</th>
                                                                <th class="text-body">Dokter</th>
                                                                <th class="text-body">Tanggal</th>
                                                                @can('print assesmen awal')
                                                                    <th class="text-body">Action</th>
                                                                @endcan
                                                            </tr>
                                                        </thead>
                                                        @php
                                                            $sortedAssessments = $item->patient->initialAssesments->sortByDesc(
                                                                'created_at',
                                                            );
                                                        @endphp
                                                        <tbody>
                                                            @foreach ($sortedAssessments as $itemAssesment)
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>{{ $itemAssesment->user->name }}</td>
                                                                    <td>{{ $itemAssesment->created_at ?? '' }}</td>
                                                                    @can('print assesmen awal')
                                                                        {{-- <td>
                                                                            <a href="{{ route('rajal/rmedokter/assesmenawal.show', $itemAssesment->id) }}"
                                                                                class="btn btn-dark btn-sm"><i
                                                                                    class='bx bx-low-vision'></i></a>
                                                                        </td> --}}
                                                                        <td>
                                                                            <div class="dropdown">
                                                                                <button type="button"
                                                                                    class="btn p-0 dropdown-toggle hide-arrow"
                                                                                    data-bs-toggle="dropdown">
                                                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                                                </button>
                                                                                <div class="dropdown-menu">
                                                                                    <a href="{{ route('rajal/rmedokter/assesmenawal.print', $itemAssesment->id) }}"
                                                                                        target="blank" class="dropdown-item">
                                                                                        <i class='bx bx-printer'></i>
                                                                                        Print
                                                                                    </a>
                                                                                    <a class="dropdown-item"
                                                                                        href="{{ route('rajal/rmedokter/assesmenawal.edit', $itemAssesment->id) }}">
                                                                                        <i class="bx bx-edit-alt me-1"></i>
                                                                                        Edit
                                                                                    </a>
                                                                                    {{-- <a href="{{  route('rajal/rmedokter/assesmenawal.show', $itemAssesment->id) }}"
                                                                                        target="blank" class="dropdown-item">
                                                                                        <i class='bx bx-printer'></i>
                                                                                        Show
                                                                                    </a> --}}

                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    @endcan
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endcan
                                            @can('daftar permintaan radiologi')
                                                <div class="tab-pane fade {{ session('dokter') == 'radiologi' ? 'show active' : '' }}"
                                                    id="navs-pills-justified-radiologi" role="tabpanel">
                                                    @can('tambah permintaan radiologi')
                                                        <div class="text-end">
                                                            <a href="{{ route('rajal/permintaan/radiologi.create', $item->id) }}"
                                                                class="btn btn-success btn-sm">+Tambah Permintaan</a>
                                                        </div>
                                                    @endcan
                                                    <table class="table">
                                                        <thead>
                                                            <tr class="text-nowrap">
                                                                <th class="text-body">No</th>
                                                                <th class="text-body">Dokter</th>
                                                                <th class="text-body">Asal Ruang</th>
                                                                <th class="text-body">Diagnosa Klinis</th>
                                                                <th class="text-body">Tanggal</th>
                                                                @canany([
                                                                    'print permintaan radiologi',
                                                                    'delete permintaan
                                                                    radiologi',
                                                                    ])
                                                                    <th class="text-body">Action</th>
                                                                @endcanany
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($item->patient->radiologiFormRequests()->orderBy('created_at', 'DESC')->get() as $radiologi)
                                                                <tr class="{{ $item->id == $radiologi->queue->id ? 'text-success' : '' }}">
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>{{ $radiologi->user->name ?? '' }}
                                                                        ({{ $radiologi->user->staff_id ?? '' }})
                                                                    </td>
                                                                    <td>{{ $radiologi->roomDetail->name ?? '' }}</td>
                                                                    <td>{!! $radiologi->diagnosa_klinis ?? '' !!}</td>
                                                                    <td>{{ $radiologi->created_at->format('Y-m-d / H:i:s') }}</td>
                                                                    @canany([
                                                                        'print permintaan radiologi',
                                                                        'delete permintaan
                                                                        radiologi',
                                                                        ])
                                                                        <td>
                                                                            <div class="d-flex align-self-center">
                                                                                <a href="{{ route('rajal/permintaan/radiologi.show', ['queue_id' => $item->id, 'radiologi_id' => $radiologi->id]) }}"
                                                                                    target="blank" class="btn btn-dark btn-sm mx-2"><i
                                                                                        class='bx bx-printer'></i></a>
                                                                                @if ($radiologi->status == 'FINISHED' || $radiologi->status == 'ONGOING')
                                                                                    <button type="button" class="btn btn-info btn-sm"><i class='bx bx-file'></i></button>
                                                                                @else    
                                                                                    <a href="{{ route('rajal/permintaan/radiologi.edit', ['queue_id' => $item->id, 'radiologi_id' => $radiologi->id]) }}"
                                                                                        class="btn btn-warning btn-sm me-2"><i
                                                                                            class='bx bx-edit'></i></a>
                                                                                    @can('delete permintaan radiologi')
                                                                                        <form
                                                                                            action="{{ route('rajal/permintaan/radiologi.destroy', $radiologi->id) }}"
                                                                                            method="POST">
                                                                                            @method('DELETE')
                                                                                            @csrf
                                                                                            <button type="submit"
                                                                                                class="btn btn-sm btn-danger"><i
                                                                                                    class="bx bx-trash"></i></button>
                                                                                        </form>
                                                                                    @endcan
                                                                                @endif
                                                                            </div>
                                                                        </td>
                                                                    @endcanany
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endcan
                                            @can('daftar permintaan labor pk')
                                                <div class="tab-pane fade {{ session('dokter') == 'laboratorium' ? 'show active' : '' }}"
                                                    id="navs-pills-justified-laboratorium" role="tabpanel">
                                                    @can('tambah permintaan labor pk')
                                                        <div class="text-end">
                                                            <a href="{{ route('rajal/laboratorium/request.index', $item->id) }}"
                                                                class="btn btn-success btn-sm">+Tambah Permintaan</a>
                                                        </div>
                                                    @endcan
                                                    <table class="table">
                                                        <thead>
                                                            <tr class="text-nowrap">
                                                                <th class="text-body">No</th>
                                                                <th class="text-body">Dokter</th>
                                                                <th class="text-body">Asal Ruang</th>
                                                                <th class="text-body">Diagnosa</th>
                                                                <th class="text-body">Kategori</th>
                                                                <th class="text-body">Tgl. Ambil Sampel</th>
                                                                <th class="text-body">Tanggal Permintaan</th>
                                                                @canany(['print permintaan labor pk', 'delete permintaan labor pk'])
                                                                    <th class="text-body">Action</th>
                                                                @endcanany
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($item->patient->laboratoriumRequests as $labor)
                                                                <tr class="{{ $item->id == $labor->queue->id ? 'text-success' : '' }}">
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>{{ $labor->user->name ?? '' }}</td>
                                                                    <td>{{ $labor->roomDetail->name ?? '' }}</td>
                                                                    <td>{{ $labor->diagnosa ?? '' }}</td>
                                                                    <td>{{ $labor->tipe_permintaan ?? '' }}</td>
                                                                    <td>{{ $labor->tanggal_sampel ?? '' }}</td>
                                                                    <td>{{ $labor->created_at->format('Y-m-d') ?? '' }}</td>
                                                                    <td>
                                                                        <div class="d-flex align-self-center">
                                                                            <a href="{{ route('rajal/laboratorium/request.show', ['queue_id' => $item->id, 'labor_id' => $labor->id]) }}"
                                                                                target="blank" class="btn btn-dark btn-sm mx-2"><i
                                                                                    class='bx bx-printer'></i></a>
                                                                            @if ($labor->status == 'FINISHED' || $labor->status == 'ONGOING')
                                                                                <button type="button" class="btn btn-info btn-sm"><i class='bx bx-file'></i></button>
                                                                            @else
                                                                                <a href="" class="btn btn-warning btn-sm me-2"><i class='bx bx-edit'></i></a>
                                                                                <form
                                                                                    action="{{ route('rajal/laboratorium/request.destroy', $labor->id) }}"
                                                                                    method="POST">
                                                                                    @method('DELETE')
                                                                                    @csrf
                                                                                    <button type="submit"
                                                                                        class="btn btn-sm btn-danger"><i
                                                                                            class="bx bx-trash"></i></button>
                                                                                </form>
                                                                            @endif
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endcan
                                            <div class="tab-pane fade {{ session('dokter') == 'laboratorium PA' ? 'show active' : '' }}"
                                                id="navs-pills-justified-laboratorium-pa" role="tabpanel">
                                                <div class="text-end">
                                                    <a href="{{ route('permintaan/laboratorium/patologi/anatomik.create', $item->id) }}"
                                                        class="btn btn-success btn-sm">+Tambah Permintaan</a>
                                                </div>
                                                <table class="table">
                                                    <thead>
                                                        <tr class="text-nowrap">
                                                            <th class="text-body">No</th>
                                                            <th class="text-body">Dokter</th>
                                                            <th class="text-body">Asal Ruangan</th>
                                                            <th class="text-body">Tanggal Permintaan</th>
                                                            <th class="text-body">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($item->patient->permintaanLaboratoriumPatologiAnatomikPatient()->orderBy('created_at', 'DESC')->take(5)->get() as $laborPa)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $laborPa->user->name ?? '' }}</td>
                                                                <td>{{ $laborPa->user->roomDetail->name ?? '' }}</td>
                                                                <td>{{ date_format($laborPa->created_at, 'd - F - Y') }}</td>
                                                                <td>
                                                                    <div class="d-flex align-self-center">
                                                                        <a href="{{ route('permintaan/laboratorium/patologi/anatomik.print', $laborPa->id) }}"
                                                                            target="blank" class="btn btn-dark btn-sm"><i
                                                                                class='bx bx-printer'></i>
                                                                        </a>
                                                                        <a href="{{ route('permintaan/laboratorium/patologi/anatomik.edit', $laborPa->id) }}"
                                                                            class="btn btn-warning btn-sm ms-2"><i
                                                                                class='bx bx-edit'></i>
                                                                        </a>
                                                                        <a href="{{ route('permintaan/laboratorium/patologi/anatomik.delete', $laborPa->id) }}"
                                                                            class="btn btn-danger btn-sm ms-2"><i
                                                                                class='bx bx-trash'></i>
                                                                        </a>
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
                    @endcanany
                    @can('daftar rme perawat')
                        <div class="tab-pane fade {{ session('btn') == 'perawat' ? 'show active' : '' }}"
                            id="navs-justified-messages" role="tabpanel">
                            @can('tambah rme perawat')
                                {{-- @if ($title == 'Rawat Jalan') --}}
                                <div class="text-end mb-3">

                                    {{-- <a href="{{ route('rajal/asesmen/status/fisik.index', $item->id) }}" type="button"
                                        class="btn btn-{{ $diagnosisPatient ? 'warning' : 'success' }} btn-sm">{{ $diagnosisPatient ? 'Edit' : 'Tambah' }}
                                        Asesmen Keperawatan</a> --}}

                                    @if (!$diagnosisPatient)
                                        <form id="keperawatan-form-{{ $item->id }}"
                                            action="{{ route('rajal/asesmen/status/fisik.save', $item->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="no_rm" value="{{ $item->id }}">
                                            <input type="hidden" name="patient_id" value="{{ $item->patient->id }}">
                                            <input type="hidden" name="queue_id" value="{{ $item->id }}">
                                            <button type="submit" class="btn btn-success btn-sm">
                                                Tambah Asesmen Keperawatan
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route('rajal/asesmen/status/fisik.index', $item->id) }}" type="button"
                                            class="btn btn-warning btn-sm">
                                            Edit Asesmen Keperawatan
                                        </a>
                                    @endif



                                    {{-- <a href="{{ route('clear/asesment/perawat') }}" class="btn btn-success btn-sm">Unit Test Hapus</a> --}}
                                </div>
                                {{-- @endif --}}
                            @endcan
                            <table class="table" id="example">
                                <thead>
                                    <tr class="text-nowrap">
                                        <th class="text-body">No</th>
                                        <th class="text-body">Nama Pasien</th>
                                        <th class="text-body">Petugas</th>
                                        <th class="text-body">Tanggal</th>
                                        @canany(['lihat rme perawat'])
                                            <th class="text-body">Action</th>
                                        @endcanany
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($asesmentPatient as $asesment)
                                        <tr class="{{ $asesment->queue_id == $item->id ? 'text-success' : '' }}">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $asesment->patient->name }}</td>
                                            <td>{{ $asesment->user->name }}</td>
                                            <td>{{ date_format($asesment->created_at, 'd - m - Y') }}</td>
                                            @canany(['lihat rme perawat'])
                                                <td>
                                                    @can('lihat rme perawat')
                                                        <div class="d-flex flex-row">
                                                            <a href="{{ route('rajal/asesmen.print', $asesment->id) }}"
                                                                class="btn btn-dark btn-sm" target="blank"><i
                                                                    class='bx bx-printer'></i></a>
                                                            <a href="{{ route('rajal/asesmen/status/fisik.index', $asesment->queue) }}"
                                                                class="btn btn-warning btn-sm ms-1"><i class='bx bx-edit-alt'></i></a>
                                                        </div>
                                                    @endcan
                                                </td>
                                            @endcanany
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endcan
                    @can('daftar cppt')
                        <div class="tab-pane fade {{ session('btn') == 'cppt' ? 'show active' : '' }}"
                            id="navs-justified-cppt" role="tabpanel">
                            <div class="text-end mb-3">
                                @can('print cppt')
                                    <a href="{{ route('rajal/cppt.print', $item->id) }}" target="blank"
                                        class="btn btn-dark btn-sm"><i class='bx bx-printer'></i></a>
                                    <a href="{{ route('rajal/cppt.show', $item->id) }}" target="blank"
                                        class="btn btn-dark btn-sm"><i class='bx bx-low-vision'></i></a>
                                @endcan
                                @can('tambah cppt')
                                    @if ($title == 'Rawat Jalan')
                                        <a class="btn btn-success btn-sm"
                                            href="{{ route('rajal/cppt.create', $item->id) }}">+Tambah
                                            CPPT</a>
                                    @endif
                                @endcan
                            </div>
                            <table class="table" id="example">
                                <thead>
                                    <tr class="text-nowrap">
                                        <th class="text-body">No</th>
                                        <th class="text-body">PPA (Profesional Pemberi Asuhan)</th>
                                        <th class="text-body">Tanggal / Jam</th>
                                        @canany(['edit cppt', 'delete cppt'])
                                            @if ($title == 'Rawat Jalan')
                                                <th class="text-body">Action</th>
                                            @endif
                                        @endcanany
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($item->patient->rmeCppts->sortDesc() as $cppt)
                                        <tr
                                            class="{{ $item->id == $cppt->rawatJalanPoliPatient->rawatJalanPatient->queue_id ? 'text-success' : '' }}">
                                            <td>{{ $loop->iteration ?? '' }}</td>
                                            <td>{{ $cppt->user->name ?? '' }}</td>
                                            <td>{{ $cppt->tanggal ?? '' }}</td>
                                            @canany(['edit cppt', 'delete cppt'])
                                                @if ($title == 'Rawat Jalan')
                                                    <td class="d-flex">
                                                        @can('edit cppt')
                                                            <a href="{{ route('rajal/cppt.edit', $cppt->id) }}"
                                                                class="btn btn-warning btn-sm"><i class='bx bx-edit'></i></a>
                                                        @endcan
                                                        @can('delete cppt')
                                                            <form action="{{ route('rajal/cppt.destroy', $cppt->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm mx-2"
                                                                    onclick="return confirm('Yakin Ingin Menghapus Data ?')"><i
                                                                        class='bx bx-trash'></i></button>
                                                            </form>
                                                        @endcan
                                                    </td>
                                                @endif
                                            @endcanany
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endcan
                    @can('daftar prmrj')
                        <div class="tab-pane fade {{ session('btn') == 'prmrj' ? 'show active' : '' }}"
                            id="navs-justified-prmrj" role="tabpanel">
                            <div class="text-end mb-3">
                                @can('print prmrj')
                                    <a href="{{ route('rajal/prmrj.show', $item->patient_id) }}" target="blank"
                                        class="btn btn-dark btn-sm"><i class='bx bx-printer'></i></a>
                                @endcan
                            </div>
                            <table class="table" id="example">
                                <thead>
                                    <tr class="text-nowrap">
                                        <th class="text-body">No</th>
                                        <th class="text-body">Tanggal</th>
                                        <th class="text-body">Jam</th>
                                        <th class="text-body">DPJP</th>
                                        <th class="text-body">Diagnosa Penting</th>
                                        <th class="text-body">Uraian Klinis Penting</th>
                                        <th class="text-body">Rencana Penting</th>
                                        <th class="text-body">Paraf</th>
                                        @canany(['edit prmrj', 'delete prmrj'])
                                            @if ($title == 'Rawat Jalan')
                                                <th class="text-body">Action</th>
                                            @endif
                                        @endcanany
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($item->patient->prmrjs as $prmrj)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ date('Y-m-d', strtotime($prmrj->tanggal ?? '')) }}</td>
                                            <td>{{ date('H:i', strtotime($prmrj->tanggal ?? '')) }}</td>
                                            <td>
                                                {{ $prmrj->user->name ?? '' }} <br>
                                            </td>
                                            <td>{!! $prmrj->diagnosa_penting ?? '' !!}</td>
                                            <td>{!! $prmrj->uraian_klinis ?? '' !!}</td>
                                            <td>{!! $prmrj->rencana_penting ?? '' !!}</td>
                                            <td>
                                                <a href="{{ Storage::url($prmrj->paraf) }}"><img
                                                        src="{{ Storage::url($prmrj->paraf) }}" alt=""></a>
                                            </td>
                                            @canany(['edit prmrj', 'delete prmrj'])
                                                @if ($title == 'Rawat Jalan')
                                                    <td>
                                                        <div class="d-flex align-self-center">
                                                            @can('edit prmrj')
                                                                <button class="btn btn-warning btn-sm mx-2"
                                                                    onclick="editPrmrj({{ $prmrj->id }})"><i
                                                                        class='bx bx-edit'></i></button>
                                                            @endcan
                                                            @can('delete prmrj')
                                                                <form action="{{ route('rajal/prmrj.destroy', $prmrj->id) }}"
                                                                    method="POST">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button class="btn btn-danger btn-sm" type="submit"
                                                                        onclick="return confirm('Yakin Ingin Menghapus Data ?')"><i
                                                                            class='bx bx-trash'></i></button>
                                                                </form>
                                                            @endcan
                                                        </div>
                                                    </td>
                                                @endif
                                            @endcanany
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    @endcan
                    @can('daftar laporan tindakan')
                        <div class="tab-pane fade {{ session('btn') == 'tindakan' ? 'show active' : '' }}"
                            id="navs-justified-tindakan" role="tabpanel">
                            @can('tambah laporan tindakan')
                                @if ($title == 'Rawat Jalan')
                                    <div class="text-end mb-3">
                                        <button class="btn btn-success btn-sm"
                                            onclick="createTindakan({{ $item->id }})">+Tambah
                                            Tindakan</button>
                                    </div>
                                @endif
                            @endcan
                            <table class="table" id="example">
                                <thead>
                                    <tr class="">
                                        <th class="text-body">Tanggal / Jam</th>
                                        <th class="text-body">Dokter</th>
                                        <th class="text-body">Diagnosa</th>
                                        <th class="text-body">Tindakan</th>
                                        <th class="text-body">Lokasi</th>
                                        <th class="text-body">Laporan</th>
                                        <th class="text-body">Intruksi</th>
                                        <th class="text-body">Paraf</th>
                                        @canany(['edit laporan tindakan', 'delete laporan tindakan'])
                                            <th class="text-body">Action</th>
                                        @endcanany
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reportActions as $action)
                                        <tr>
                                            <td>{{ date('Y-m-d H:i', strtotime($action->tgl_tindakan ?? '')) }}</td>
                                            <td>{{ $action->user->name ?? '' }}</td>
                                            <td>{{ $action->diagnosa ?? '' }}</td>
                                            <td>{{ $action->jenis_tindakan ?? '' }}</td>
                                            <td>{{ $action->lokasi ?? '' }}</td>
                                            <td>{{ $action->laporan_tindakan ?? '' }}</td>
                                            <td>{{ $action->intruksi ?? '' }}</td>
                                            <td>
                                                <a href="{{ Storage::url($item->paraf) }}"><img src="{{ Storage::url($item->paraf) }}" alt=""></a>
                                                
                                            </td>
                                            @canany(['edit laporan tindakan', 'delete laporan tindakan'])
                                                <td>
                                                    <div class="d-flex">
                                                        @can('print laporan tindakan')
                                                            <a href="{{ route('rajal/laporan/tindakan.show', $action->id) }}"
                                                                target="blank" class="btn btn-dark btn-sm"><i
                                                                    class='bx bx-printer'></i></a>
                                                        @endcan
                                                        @if ($title == 'Rawat Jalan')
                                                            @can('edit laporan tindakan')
                                                                <button class="btn btn-warning btn-sm mx-2"
                                                                    onclick="editTindakan({{ $action->id }})"><i
                                                                        class='bx bx-edit'></i></button>
                                                            @endcan
                                                            @can('delete laporan tindakan')
                                                                <form
                                                                    action="{{ route('rajal/laporan/tindakan.destroy', $action->id) }}"
                                                                    method="POST"
                                                                    onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button type = "submit" class="btn btn-danger btn-sm">
                                                                        <i class='bx bx-trash'></i>
                                                                    </button>
                                                                </form>
                                                            @endcan
                                                        @endif
                                                    </div>
                                                </td>
                                            @endcanany
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    @endcan
                    @can('daftar resep dokter')
                        <div class="tab-pane fade {{ session('btn') == 'resep dokter' ? 'show active' : '' }}"
                            id="navs-justified-resep" role="tabpanel">
                            <table class="table" id="example">
                                <thead>
                                    <tr class="text-nowrap">
                                        <th class="text-body">No</th>
                                        <th class="text-body">Tanggal / Jam</th>
                                        <th class="text-body">Dokter</th>
                                        @canany(['edit resep dokter', 'hapus resep dokter', 'print resep dokter'])
                                            <th class="text-body">Action</th>
                                        @endcanany
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($receipts as $receipt)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $receipt->created_at->format('Y-m-d H:i') }}</td>
                                            <td>{{ $receipt->user->name ?? '' }}</td>
                                            @canany(['edit resep dokter', 'print resep dokter', 'hapus resep dokter'])
                                                <td>
                                                    <div class="d-flex">
                                                        @can('print resep dokter')
                                                            <a href="{{ route('rajal/resep/dokter.show', $receipt->id) }}"
                                                                target="blank" class="btn btn-dark btn-sm"><i
                                                                    class='bx bx-printer'></i></a>
                                                        @endcan
                                                        @can('edit resep dokter')
                                                            <a class="btn btn-warning btn-sm mx-2"
                                                                href="{{ route('rajal/resep/dokter.edit', $receipt->id) }}"><i
                                                                    class='bx bx-edit'></i></a>
                                                        @endcan
                                                        @can('hapus resep dokter')
                                                            <form action="{{ route('rajal/resep/dokter.destroy', $receipt->id) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button type = "submit" class="btn btn-danger btn-sm">
                                                                    <i class='bx bx-trash'></i>
                                                                </button>
                                                            </form>
                                                        @endcan
                                                    </div>
                                                </td>
                                            @endcanany
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    @endcan
                    <div class="tab-pane fade {{ session('btn') == 'sbpk' ? 'show active' : '' }}"
                        id="navs-justified-sbpk" role="tabpanel">
                        <div class="text-end mb-3">
                            <a href="{{ route('rajal/sbpk.create', $item->id) }}" class="btn btn-success btn-sm">+Tambah
                                SBPK</a>
                        </div>
                        <table class="table">
                            <thead>
                                <tr class="text-nowrap">
                                    <th class="text-body">No</th>
                                    <th class="text-body">Nama Pasien</th>
                                    <th class="text-body">Tanggal Masuk</th>
                                    <th class="text-body">Jam Keluar</th>
                                    <th class="text-body">Keterangan</th>
                                    <th class="text-body">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sbpks as $sbpk)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $sbpk->patient->name ?? '' }}</td>
                                        <td>{{ $sbpk->tanggal_masuk ?? '' }}</td>
                                        <td>{{ $sbpk->jam_keluar ?? '' }}</td>
                                        <td>{{ $sbpk->keterangan ?? '' }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('rajal/sbpk.show', $sbpk->id) }}" target="blank"
                                                    class="btn btn-dark btn-sm"><i class='bx bx-printer'></i></a>
                                                <a href="{{ route('rajal/sbpk.edit', $sbpk->id) }}"
                                                    class="btn btn-warning btn-sm mx-2"><i class='bx bx-edit'></i></a>
                                                <form action="{{ route('rajal/sbpk.destroy', $sbpk->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type = "submit" class="btn btn-danger btn-sm">
                                                        <i class='bx bx-trash'></i>
                                                    </button>
                                                </form>
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
        {{-- end Menu Rajal --}}
    </div>

    {{-- Hasil Pemeriksaan --}}
    <div class="card overflow-hidden mb-4 mt-3" style="height: 500px;">
        <h5 class="card-title px-4 mt-3 m-0">
            Hasil Pemeriksaan
        </h5>
        <hr class="mb-0">
        <div class="card-body mt-0" id="vertical-example">
          <p>Sweet roll I love I love. Tiramisu I love soufflé cake tart sweet roll cotton candy cookie. Macaroon biscuit dessert. Bonbon cake soufflé jelly gummi bears lemon drops. Chocolate bar I love macaroon danish candy pudding. Jelly carrot cake I love tart cake bear claw macaroon candy candy canes. Muffin gingerbread sweet jujubes croissant sweet roll. Topping muffin carrot cake sweet. Toffee chocolate muffin I love croissant. Donut carrot cake ice cream ice cream. Wafer I love pie danish marshmallow cheesecake oat cake pie I love. Icing pie chocolate marzipan jelly ice cream cake.</p>
          <p>Marzipan oat cake caramels chocolate. Lemon drops cheesecake jelly beans sweet icing pudding croissant. Donut candy canes carrot cake soufflé. Croissant candy wafer pie I love oat cake lemon drops caramels jujubes. I love macaroon halvah liquorice cake. Danish sweet roll pudding cookie sweet roll I love. Jelly cake I love bear claw jujubes dragée gingerbread. I love cotton candy carrot cake halvah biscuit I love macaroon cheesecake tootsie roll. Chocolate cotton candy biscuit I love fruitcake cotton candy biscuit tart gingerbread. Powder oat cake I love. Cheesecake candy canes macaroon I love wafer I love sweet roll ice cream. Toffee cookie macaroon lemon drops tart candy canes. Gummies gummies pie tiramisu I love bear claw cheesecake.</p>
          <p>Marzipan oat cake caramels chocolate. Lemon drops cheesecake jelly beans sweet icing pudding croissant. Donut candy canes carrot cake soufflé. Croissant candy wafer pie I love oat cake lemon drops caramels jujubes. I love macaroon halvah liquorice cake. Danish sweet roll pudding cookie sweet roll I love. Jelly cake I love bear claw jujubes dragée gingerbread. I love cotton candy carrot cake halvah biscuit I love macaroon cheesecake tootsie roll. Chocolate cotton candy biscuit I love fruitcake cotton candy biscuit tart gingerbread. Powder oat cake I love. Cheesecake candy canes macaroon I love wafer I love sweet roll ice cream. Toffee cookie macaroon lemon drops tart candy canes. Gummies gummies pie tiramisu I love bear claw cheesecake.</p>
          <p>Sweet roll I love I love. Tiramisu I love soufflé cake tart sweet roll cotton candy cookie. Macaroon biscuit dessert. Bonbon cake soufflé jelly gummi bears lemon drops. Chocolate bar I love macaroon danish candy pudding. Jelly carrot cake I love tart cake bear claw macaroon candy candy canes. Muffin gingerbread sweet jujubes croissant sweet roll. Topping muffin carrot cake sweet. Toffee chocolate muffin I love croissant. Donut carrot cake ice cream ice cream. Wafer I love pie danish marshmallow cheesecake oat cake pie I love. Icing pie chocolate marzipan jelly ice cream cake.</p>
          <p>Sweet roll I love I love. Tiramisu I love soufflé cake tart sweet roll cotton candy cookie. Macaroon biscuit dessert. Bonbon cake soufflé jelly gummi bears lemon drops. Chocolate bar I love macaroon danish candy pudding. Jelly carrot cake I love tart cake bear claw macaroon candy candy canes. Muffin gingerbread sweet jujubes croissant sweet roll. Topping muffin carrot cake sweet. Toffee chocolate muffin I love croissant. Donut carrot cake ice cream ice cream. Wafer I love pie danish marshmallow cheesecake oat cake pie I love. Icing pie chocolate marzipan jelly ice cream cake.</p>
          <p class="mb-0">Sweet roll I love I love. Tiramisu I love soufflé cake tart sweet roll cotton candy cookie. Macaroon biscuit dessert. Bonbon cake soufflé jelly gummi bears lemon drops. Chocolate bar I love macaroon danish candy pudding. Jelly carrot cake I love tart cake bear claw macaroon candy candy canes. Muffin gingerbread sweet jujubes croissant sweet roll. Topping muffin carrot cake sweet. Toffee chocolate muffin I love croissant. Donut carrot cake ice cream ice cream. Wafer I love pie danish marshmallow cheesecake oat cake pie I love. Icing pie chocolate marzipan jelly ice cream cake.</p>
        </div>
      </div>
    {{-- end Hasil Pemeriksaan --}}

    {{-- modal --}}
    <div class="modal fade" id="modalScrollable" tabindex="-1" aria-labelledby="modalScrollableTitle"
        aria-hidden="true">

    </div>

    <script>
        function createPrmrj(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url: "{{ URL::route('rajal/prmrj.create') }}",
                data: {
                    queue_id: id,
                },
                success: function(data) {
                    var div = document.createElement('div');
                    div.className = 'modal-dialog modal-lg modal-dialog-scrollable';
                    div.innerHTML = data;
                    $('#modalScrollable').html(div);
                    $('#modalScrollable').modal('show');
                }
            });
        }

        function editPrmrj(id) {
            $.ajax({
                type: 'get',
                url: "{{ route('rajal/prmrj.edit', '') }}/" + id,
                success: function(data) {
                    var div = document.createElement('div');
                    div.className = 'modal-dialog modal-lg modal-dialog-scrollable';
                    div.innerHTML = data;
                    $('#modalScrollable').html(div);
                    $('#modalScrollable').modal('show');
                }
            });
        }

        function createTindakan(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url: "{{ URL::route('rajal/laporan/tindakan.create') }}",
                data: {
                    queue_id: id,
                },
                success: function(data) {
                    var div = document.createElement('div');
                    div.className = 'modal-dialog modal-lg modal-dialog-scrollable';
                    div.innerHTML = data,
                        $('#modalScrollable').html(div);
                    $('#modalScrollable').modal('show');
                }
            });
        }

        function editTindakan(id) {
            $.ajax({
                type: 'get',
                url: "{{ url('rajal/laporan/tindakan/edit') }}/" + id,
                success: function(data) {
                    var div = document.createElement('div');
                    div.className = 'modal-dialog modal-lg modal-dialog-scrollable';
                    div.innerHTML = data;
                    $('#modalScrollable').html(div);
                    $('#modalScrollable').modal('show');
                }
            });
        }

        function showHasil() {
            $('#hasilPemeriksaan').show('content');
        }

        var buttons = document.querySelectorAll('#btn-link');

        buttons.forEach(function(button) {
            button.addEventListener('click', function() {
                buttons.forEach(function(btn) {
                    btn.classList.remove('active');
                });
                this.classList.add('active');
            });
        });
    </script>
    
    
@endsection
