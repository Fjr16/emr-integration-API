@extends('layouts.backend.main')

@section('content')
    <style>
        .tab-nav-bar {
            position: relative;
        }

        .tab-navigation {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            max-width: fit-content;
            margin: 0 auto;
        }

        .tab-menu {
            /* color: black; */
            list-style: none;
            /* background: rgb(72, 105, 197); */
            max-width: 100rem;
            padding-top: 10px;
            padding-left: 0;
            padding-right: 0;
            margin-bottom: 0;
            white-space: nowrap;
            /* border-bottom: 1px solid black; */
            box-shadow: black;
            overflow-x: auto;
            user-select: none;
            scroll-behavior: smooth;
        }

        .tab-menu.dragging {
            scroll-behavior: unset;
            cursor: grab;
        }

        .tab-menu::-webkit-scrollbar {
            display: none;
        }

        .tab-btn {
            display: inline-block;
            font-size: 1em;
            border: 0px;
            user-select: none;
            transition: 0.3s ease;
        }

        .tab-menu.tab-menu.dragging .tab-btn {
            pointer-events: none;
        }

        .tab-btn:hover {
            background: #e2e2e2;
            border-radius: 5px;
        }

        .left-btn,
        .right-btn {
            position: absolute;
            font-size: 1.5em;
            padding: 8px;
            cursor: pointer;
            color: white;
        }

        .left-btn {
            left: 0;
            top: 0;
            background: linear-gradient(to left, transparent, rgb(48, 108, 148) 90%);
            border-top-left-radius: 20%;
            /* border-bottom-left-radius: 10%; */
            display: none;
        }

        .right-btn {
            right: 0;
            top: 0;
            background: linear-gradient(to right, transparent, rgb(48, 108, 148) 90%);
            border-top-right-radius: 20%;
            /* border-bottom-right-radius: 15%; */
        }
    </style>

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
        <form action="" method="POST"
            onsubmit="return confirm('Sebelum melanjutkan, Pastikan data telah diisi dengan benar dan lengkap !!!. Apakah anda yakin untuk melanjutkan ? ')">
            @method('PUT')
            @csrf
            <button type="submit" class="btn btn-success btn-sm" name="status" value="SELESAI">Selesai</button>
        </form>
    </div>
    <div class="nav-align-top mb-4">
        <div class="tab-nav-bar">
            <div class="tab-navigation nav nav-tabs nav-sm nav-fill" role="tablist">
                <i class='bx bx-chevron-left left-btn'></i>
                <i class='bx bx-chevron-right right-btn'></i>
                <ul class="tab-menu" role="tablist">
                    <li class="tab-btn">
                        <button id="btn-link" type="button" {{-- @dd(session()->all()) --}}
                            class="nav-link {{ session('btn') == 'dashboard' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-home"
                            aria-controls="navs-justified-home" aria-selected="true">
                            <i class="tf-icons bx bx-grid-alt"></i>
                            <p class="m-0">Dashboard</p>
                        </button>
                    </li>
                    <li class="tab-btn">
                        <button id="btn-link" type="button" {{-- @dd(session()->all()) --}}
                            class="nav-link {{ session('btn') == 'cpa' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-cpa"
                            aria-controls="navs-justified-cpa" aria-selected="true">
                            <i class="tf-icons bx bx-bookmark-alt-plus"></i>
                            <p class="m-0">Catatan Perjalanan Administrasi</p>
                        </button>
                    </li>
                    <li class="tab-btn">
                        <button id="btn-link" type="button"
                            class="nav-link {{ session('active') == 'general-consent' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-general-consent"
                            aria-controls="navs-justified-general-consent" aria-selected="false">
                            <i class="tf-icons bx bx-message-alt-add"></i>
                            <p class="m-0">General Consent</p>
                        </button>
                    </li>
                    <li class="tab-btn">
                        <button id="btn-link" type="button"
                            class="nav-link {{ session('active') == 'assesmen_medis' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-assesmen-medis"
                            aria-controls="navs-justified-asesmen-medis" aria-selected="false">
                            <i class="tf-icons bx bx-bookmark-alt-plus"></i>
                            <p class="m-0">Asesmen Medis</p>
                        </button>
                    </li>
                    </li>
                    <li class="tab-btn">
                        <button id="btn-link" type="button"
                            class="nav-link {{ session('btn') == 'cppt' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-cppt"
                            aria-controls="navs-justified-cppt" aria-selected="false">
                            <i class="tf-icons bx bx-message-alt-add"></i>
                            <p class="m-0">CPPT</p>
                        </button>
                    </li>
                    <li class="tab-btn">
                        <button id="btn-link" type="button" {{-- @dd(session()->all()) --}}
                            class="nav-link {{ session('btn') == 'discharge' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-discharge"
                            aria-controls="navs-justified-discharge" aria-selected="true">
                            <i class="tf-icons bx bx-bookmark-alt-plus"></i>
                            <p class="m-0">Discharge Summary</p>
                        </button>
                    </li>
                    <li class="tab-btn">
                        <button id="btn-link" type="button" {{-- @dd(session()->all()) --}}
                            class="nav-link {{ session('btn') == 'monitoringpelayananobatpasien' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-justified-monitoringpelayananobatpasien"
                            aria-controls="navs-justified-monitoringpelayananobatpasien" aria-selected="true">
                            <i class='tf-icons bx bx-alarm-exclamation'></i>
                            <p class="m-0">Monitoring Obat</p>
                        </button>
                    </li>
                    <li class="tab-btn">
                        <button type="button"
                            class="nav-link d-flex justify-content-center {{ session('btn') == 'sbpk' ? 'active' : '' }}"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-sbpk"
                            aria-controls="navs-justified-sbpk" aria-selected="false">
                            <i class="tf-icons bx bx-mail-send"></i>
                            <p class="m-0">SBPK</p>
                        </button>
                    </li>
                    <li class="tab-btn">
                        <button type="button"
                            class="nav-link d-flex justify-content-center {{ session('btn') == 'persetujuan kemoterapi' ? 'active' : '' }}"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-persetujuan-kemoterapi"
                            aria-controls="navs-justified-persetujuan-kemoterapi" aria-selected="false">
                            <i class="tf-icons bx bx-list-check"></i>
                            <p class="m-0">persetujuan kemoterapi</p>
                        </button>
                    </li>
                    <li class="tab-btn">
                        <button id="btn-link" type="button"
                            class="nav-link {{ session('active') == 'ringkasanMasukdanKeluar' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-justified-ringkasan_masuk_dan_keluar"
                            aria-controls="navs-justified-asesmen-medis" aria-selected="false">
                            <i class='bx bx-book-content'></i>
                            <p class="m-0">Ringkasan Masuk dan Keluar</p>
                        </button>
                    </li>
                    <li class="tab-btn">
                        <button id="btn-link" type="button"
                            class="nav-link {{ session('active') == 'monitoringTindakanKemoterapi' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-justified-monitoring-tindakan-kemoterapi"
                            aria-controls="navs-justified-asesmen-medis" aria-selected="false">
                            <i class='bx bx-desktop'></i>
                            <p class="m-0">Monitoring Tindakan Kemoterapi</p>
                        </button>
                    </li>
                    <li class="tab-btn">
                        <button type="button"
                            class="nav-link d-flex justify-content-center {{ session('btn') == 'monitoring resiko jatuh' ? 'active' : '' }}"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-monitoring-resiko-jatuh"
                            aria-controls="navs-justified-monitoring-resiko-jatuh" aria-selected="false">
                            <i class="tf-icons bx bx-desktop"></i>
                            <p class="m-0"> Monitoring Resiko Jatuh</p>
                        </button>
                    </li>
                    <li class="tab-btn">
                        <button type="button"
                            class="nav-link d-flex justify-content-center {{ session('btn') == 'tindakan pelayanan pasien' ? 'active' : '' }}"
                            role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-justified-tindakan-pelayanan-pasien"
                            aria-controls="navs-justified-tindakan-pelayanan-pasien" aria-selected="false">
                            <i class="tf-icons bx bx-alarm-exclamation"></i>
                            <p class="m-0"> Tindakan Pelayanan Pasien</p>
                        </button>
                    </li>
                    <li class="tab-btn">
                        <button type="button"
                            class="nav-link d-flex justify-content-center {{ session('btn') == 'lembarKonsulPasien' ? 'active' : '' }}"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-lembar-konsul-pasien"
                            aria-controls="navs-justified-lembar-konsul-pasien" aria-selected="false">
                            <i class='bx bx-file'></i>
                            <p class="m-0"> Lembar Konsultasi/Kontrol Pasien</p>
                        </button>
                    </li>
                </ul>
            </div>
        </div>


        <div class="tab-content">
            <div class="tab-pane fade {{ session('btn') == 'dashboard' ? 'show active' : '' }}" id="navs-justified-home"
                role="tabpanel">
                <div class="row">
                    <div class="col-sm-6">
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
                                    <td>{{ $item->queue->patientCategory->name }}</td>
                                </tr>
                                <tr>
                                    <td style="min-width: 150px">Jenis Kelamin</td>
                                    <td style="min-width: 30px">:</td>
                                    <td>{{ $item->queue->patient->jenis_kelamin }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Lahir</td>
                                    <td>:</td>
                                    <td>{{ $item->queue->patient->tanggal_lhr }}</td>
                                </tr>
                                <tr>
                                    <td>Usia</td>
                                    <td>:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Telepon</td>
                                    <td>:</td>
                                    <td>{{ $item->queue->patient->telp }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td>{{ $item->queue->patient->alamat }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <hr class="p-0 mt-2">
                        <h6>Dokter</h6>
                        <p>{{ $item->user->name }} ({{ $item->user->staff_id }})</p>
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
                                    {{-- @can('tambah catatan perjalanan administrasi') --}}
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
                                        <td>Perawat Kemoterapi</td>
                                        <td>-</td>
                                        <td>
                                            {{-- <a href="{{ route('perjalananadministrasi-ranap.asuransi', $item->catatanPerjalanRanapPatient->id) }}" class="btn btn-sm btn-dark">Tambah</a> --}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Farmasi Klinis</td>
                                        <td>-</td>
                                        <td>
                                            {{-- <a href="{{ route('perjalananadministrasi-ranap.registrasi', $item->catatanPerjalanRanapPatient->id) }}" class="btn btn-sm btn-dark">Tambah</a> --}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Perawat Ruangan</td>
                                        <td>-</td>
                                        <td>
                                            {{-- <a href="{{ route('perjalananadministrasi-ranap.kamar-bedah', $item->catatanPerjalanRanapPatient->id) }}" class="btn btn-sm btn-dark">Tambah</a> --}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Farmasi</td>
                                        <td>-</td>
                                        <td>
                                            {{-- <a href="{{ route('perjalananadministrasi-ranap.laboratorium', $item->catatanPerjalanRanapPatient->id) }}" class="btn btn-sm btn-dark">Tambah</a> --}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>Kasir</td>
                                        <td>-</td>
                                        <td>
                                            {{-- <a href="{{ route('perjalananadministrasi-ranap.farmasi-kasir', $item->catatanPerjalanRanapPatient->id) }}" class="btn btn-sm btn-dark">Tambah</a> --}}
                                        </td>
                                    </tr>
                                    {{-- @endcan --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{-- General Consent --}}
            <div class="tab-pane fade {{ session('active') == 'general-consent' ? 'show active' : '' }}"
                id="navs-justified-general-consent" role="tabpanel">
                <div class="text-end mb-3">
                    <a href="{{ route('kemoterapi/general/consent.create', $item->id) }}"
                        class="btn btn-success btn-sm">+Tambah
                        General
                        Consent</a>
                </div>
                <table class="table" id="example">
                    <thead>
                        <tr class="text-nowrap">
                            <th class="text-body">No</th>
                            <th class="text-body">Dokter</th>
                            <th class="text-body">Petugas</th>
                            <th class="text-body">Pasien</th>
                            <th class="text-body">Tanggal Kunjungan</th>
                            <th class="text-body">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($item->queue->patient->kemoterapiGeneralConsents as $gc)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->user->name ?? '' }}</td>
                                <td>{{ $gc->user->name ?? '' }}</td>
                                <td>{{ $gc->patient->name ?? '' }}</td>
                                <td>{{ $item->created_at->format('Y-m-d') ?? '' }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="{{ route('kemoterapi/general/consent.showtatatertib', $gc->id) }}"
                                                target="_blank">
                                                <i class="bx bx-printer me-1"></i>
                                                Tata Tertib
                                            </a>
                                            <a class="dropdown-item"
                                                href="{{ route('kemoterapi/general/consent.showhakdankewajiban', $gc->id) }}"
                                                target="_blank">
                                                <i class="bx bx-printer me-1"></i>
                                                Hak dan Kewajiban
                                            </a>
                                            <a href="{{ route('kemoterapi/general/consent.show', $gc->id) }}"
                                                class="dropdown-item">
                                                <i class='bx bx-printer me-1'></i>
                                                Print
                                            </a>
                                            <a href="{{ route('kemoterapi/general/consent.edit', $gc->id) }}"
                                                class="dropdown-item">
                                                <i class='bx bx-edit me-1'></i>
                                                Edit
                                            </a>
                                            <form action="{{ route('kemoterapi/general/consent.destroy', $gc->id) }}"
                                                method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="dropdown-item"
                                                    onclick="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
                                                    <i class='bx bx-trash me-1'></i>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- end General Consent --}}

            {{-- Assesmen Medis --}}
            <div class="tab-pane fade {{ session('active') == 'assesmen_medis' ? 'show active' : '' }}"
                id="navs-justified-assesmen-medis" role="tabpanel">
                <div class="text-end">
                    <a href="{{ route('kemoterapi/assesmenawal.create', $item->id) }}"
                        class="btn btn-success btn-sm">+Tambah
                        Assesmen</a>
                </div>
                <table class="table">
                    <thead>
                        <tr class="text-nowrap">
                            <th class="text-body">No</th>
                            <th class="text-body">Pasien</th>
                            <th class="text-body">Dokter</th>
                            <th class="text-body">Keluhan</th>
                            <th class="text-body">Tanggal</th>
                            <th class="text-body">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($item->queue->patient->kemoterapiInitialAssesments->where('isActive', true) as $itemAssesment)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $itemAssesment->patient->name }}</td>
                                <td>{{ $itemAssesment->user->name }}</td>
                                <td>{{ $itemAssesment->keluhan ?? '' }}</td>
                                <td>{{ date('Y-m-d H:i', strtotime($itemAssesment->tanggal_assesment ?? '')) }}</td>
                                <td class="d-flex">
                                    {{-- <a href="{{ route('igdass', $askep->igdPatient->id) }}" class="btn btn-warning btn-sm"><i class='bx bx-edit'></i></a> --}}
                                    <a href="{{ route('kemoterapi/assesmenawal.show', $itemAssesment->id) }}"
                                        class="btn btn-dark btn-sm mx-2"><i class='bx bx-printer'></i></a>
                                    <form action="{{ route('kemoterapi/assesmenawal.destroy', $itemAssesment->id) }}"
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
            {{-- end Assesmen Medis --}}

            <div class="tab-pane fade {{ session('btn') == 'cppt' ? 'show active' : '' }}" id="navs-justified-cppt"
                role="tabpanel">
                <div class="text-end mb-3">
                    {{-- @can('catatan pelayanan pt form ranap print') --}}
                    <a href="{{ route('kemoterapi/cppt.print', $item->queue->patient->id) }}" target="blank" class="btn btn-dark btn-sm"><i class='bx bx-printer' ></i></a>
                    <a href="{{ route('kemoterapi/cppt.show', $item->id) }}" target="blank" class="btn btn-dark btn-sm"><i class='bx bx-low-vision' ></i></a>
                    {{-- @endcan --}}
                    {{-- @can('catatan pelayanan pt form ranap create') --}}
                    <a class="btn btn-success btn-sm" href="{{ route('kemoterapi/cppt.create', $item->id) }}">+Tambah
                        CPPT</a>
                        {{-- @endcan --}}
                </div>
                <table class="table" id="example">
                    <thead>
                        <tr class="text-nowrap">
                            <th class="text-body">No</th>
                            <th class="text-body">PPA (Profesional Pemberi Asuhan)</th>
                            <th class="text-body">Tanggal / Jam</th>
                            <th class="text-body">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cpptKemoterapi as $cppt)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $cppt->user->name ?? '' }}</td>
                                <td>{{ $cppt->created_at->format('Y-m-d H:i:s') ?? '' }}</td>

                                {{-- @canany(['catatan pelayanan pt form ranap edit', 'catatan pelayanan pt form ranap delete']) --}}
                                <td class="d-flex">
                                    {{-- @can('catatan pelayanan pt form ranap edit') --}}
                                    <a href="{{ route('kemoterapi/cppt.edit', $cppt->id) }}"
                                        class="btn btn-warning btn-sm"><i class='bx bx-edit'></i></a>
                                    {{-- @endcan --}}
                                    {{-- @can('catatan pelayanan pt form ranap delete') --}}
                                    <form action="{{ route('kemoterapi/cppt.destroy', $cppt->id) }}" method="POST">
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
            <div class="tab-pane fade {{ session('btn') == 'discharge' ? 'show active' : '' }}"
                id="navs-justified-discharge" role="tabpanel">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-end mb-3">
                            {{-- @can('print discharge') --}}
                            <a href="{{ route('ringkasan/catatan/medis/kemoterapi.show', $item->id) }}" target="blank"
                                class="btn btn-dark btn-sm"><i class='bx bx-printer'></i></a>
                            {{-- @endcan --}}
                            {{-- @can('tambah discharge') --}}
                            <a class="btn btn-success btn-sm"
                                href="{{ route('ringkasan/catatan/medis/kemoterapi.create', $item->id) }}">+Tambah
                                Discharge Summary</a>
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
                                    @foreach ($discharges as $discharge)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $discharge->dokter_pengirim ?? '' }}</td>
                                            <td>{{ $discharge->tanggal_masuk ?? '' }}</td>
                                            <td>{{ $discharge->user->name ?? '' }}</td>
                                            {{-- @canany(['edit discharge', 'delete discharge']) --}}
                                            <td class="d-flex">
                                                {{-- @can('edit discharge') --}}
                                                <a href="{{ route('ringkasan/catatan/medis/kemoterapi.edit', $discharge->id) }}"
                                                    class="btn btn-warning btn-sm"><i class='bx bx-edit'></i></a>
                                                {{-- @endcan --}}
                                                {{-- @can('delete discharge') --}}
                                                <form
                                                    action="{{ route('ringkasan/catatan/medis/kemoterapi.destroy', $discharge->id) }}"
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
            <div class="tab-pane fade {{ session('btn') == 'monitoringpelayananobatpasien' ? 'show active' : '' }}"
                id="navs-justified-monitoringpelayananobatpasien" role="tabpanel">
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


                            </div>
                        </div>
                        <div class="tab-pane fade {{ session('perawat') == 'obatinjeksi' ? 'show active' : '' }}"
                            id="navs-pills-justified-obatinjeksi" role="tabpanel">
                            <div class="accordion" id="obatinjeksi">
                                <div class="card accordion-item active">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button type="button" class="accordion-button collapsed"
                                            data-bs-toggle="collapse" data-bs-target="#obatinjeksi1" aria-expanded="true"
                                            aria-controls="accordionOne" role="tabpanel">
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
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button type="button" class="accordion-button collapsed"
                                            data-bs-toggle="collapse" data-bs-target="#obatinjeksi2" aria-expanded="true"
                                            aria-controls="accordionOne" role="tabpanel">
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
                                    <h2 class="accordion-header" id="headingThree">
                                        <button type="button" class="accordion-button collapsed"
                                            data-bs-toggle="collapse" data-bs-target="#obatinjeksi3" aria-expanded="true"
                                            aria-controls="accordionOne" role="tabpanel">
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
                                                        <label class="col-sm-3 col-form-label" for="basic-default-name">P
                                                            / I (1)</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label" for="basic-default-name">P
                                                            / I (2)</label>
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
                                                            for="basic-default-name">P
                                                            / I (1)</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="p_i" class="form-control"
                                                                id="basic-default-name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="basic-default-name">P
                                                            / I (2)</label>
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
            <div class="tab-pane fade {{ session('btn') == 'sbpk' ? 'show active' : '' }}" id="navs-justified-sbpk"
                role="tabpanel">
                <div class="text-end mb-3">
                    <a href="{{ route('kemoterapi/sbpk.create', $item->id) }}" class="btn btn-success btn-sm">+Tambah
                        SBPK</a>
                </div>
                <table class="table">
                    <thead>
                        <tr class="text-nowrap">
                            <th class="text-body">No</th>
                            <th class="text-body">Nama Pasien</th>
                            <th class="text-body">Tanggal Masuk</th>
                            <th class="text-body">Keterangan</th>
                            <th class="text-body">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kemoterapiSbpk as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->patient->name }}</td>
                                <td>{{ $data->tanggal_masuk }}</td>
                                <td>{{ $data->keterangan }}</td>
                                <td>
                                    <a class="btn btn-success btn-sm"
                                        href="{{ route('kemoterapi/sbpk.show', $data->id) }}">
                                        <i class='bx bx-show-alt me-1'></i>Show
                                    </a>
                                    <a class="btn btn-warning btn-sm"
                                        href="{{ route('kemoterapi/sbpk.edit', $data->id) }}">
                                        <i class='bx bx-edit-alt me-1'></i>Edit
                                    </a>
                                    <a class="btn btn-danger btn-sm"
                                        onclick="return confirm('Apakah anda yakin untuk melanjutkan ? ')"
                                        href="{{ route('kemoterapi/sbpk.destroy', $data->id) }}">
                                        <i class="bx bx-trash me-1"></i>Hapus
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- start persetujuan kemo --}}
            <div class="tab-pane fade {{ session('btn') == 'persetujuan kemoterapi' ? 'show active' : '' }}"
                id="navs-justified-persetujuan-kemoterapi" role="tabpanel">
                <div class="text-end mb-3">
                    <a href="{{ route('kemoterapi/persetujuan.create', $item->id) }}"
                        class="btn btn-success btn-sm">+Tambah Persetujuan Kemoterapi</a>
                </div>
                <table class="table">
                    <thead>
                        <tr class="text-nowrap">
                            <th class="text-body">No</th>
                            <th class="text-body">Nama Pasien</th>
                            <th class="text-body">Nama PJ</th>
                            <th class="text-body">Umur</th>
                            <th class="text-body">Jenis Kelamin</th>
                            <th class="text-body">Alamat</th>
                            <th class="text-body">Hubungan</th>
                            <th class="text-body">Tanggal</th>
                            <th class="text-body">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kemoterapiPersetujuan as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->patient->name }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->umur }}</td>
                                <td>{{ $data->jenis_kelamin }}</td>
                                <td>{{ $data->alamat }}</td>
                                <td>{{ $data->hubungan }}</td>
                                <td>{{ $data->tanggal }}</td>
                                <td>{{ $data->keterangan }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a href="{{ route('kemoterapi/persetujuan.show', $data->id) }}"
                                                class="dropdown-item">
                                                <i class='bx bx-printer me-1'></i>
                                                Print
                                            </a>
                                            <a href="{{ route('kemoterapi/persetujuan.edit', $data->id) }}"
                                                class="dropdown-item">
                                                <i class='bx bx-edit me-1'></i>
                                                Edit
                                            </a>
                                            <a href="{{ route('kemoterapi/persetujuan.destroy', $data->id) }}"
                                                onclick="return confirm('Apakah anda yakin untuk melanjutkan ? ')"
                                                class="dropdown-item">
                                                <i class='bx bx-trash me-1'></i>
                                                Hapus
                                            </a>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- end persetujuan kemo --}}
            <div class="tab-pane fade {{ session('btn') == 'monitoring resiko jatuh' ? 'show active' : '' }}"
                id="navs-justified-monitoring-resiko-jatuh" role="tabpanel">
                <div class="text-end mb-3">
                    <a href="{{ route('kemoterapi/monitoring/resiko/jatuh.create', $item->id) }}"
                        class="btn btn-success btn-sm">+Tambah
                        Monitoring Resiko Jatuh</a>
                </div>
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
                        @foreach ($kemoterapiMonitoringResikoJatuh as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</th>
                                <td>{{ $data->user->name }}</td>
                                @php
                                    $formatId = Carbon\Carbon::parse($data->tanggal);
                                @endphp
                                <td>{{ $formatId->isoformat('D MMM Y') }}</td>
                                <td>{{ $data->tipe }}</td>
                                <td>{{ $data->total_skor }}</td>
                                <td>{{ $data->nilai_skor }}</td>
                                <td class="d-flex">
                                    @if ($data->kemoterapiIntervensiResikoJatuhPatient->user)
                                        <a href="{{ route('kemoterapi/intervensi/pencegahan/resiko/jatuh.edit', $data->id) }}"
                                            target="blank" class="btn btn-warning btn-sm mx-2"><i
                                                class='bx bx-edit'></i></a>
                                        <a href="{{ route('kemoterapi/intervensi/pencegahan/resiko/jatuh.destroy', $data->id) }}"
                                            class="btn btn-danger btn-sm mx-2"
                                            onclick="return confirm('Yakin ingin menghapus data?')"><i
                                                class="bx bx-trash"></i></a>

                                        <a href="{{ route('kemoterapi/intervensi/pencegahan/resiko/jatuh.show', $data->id) }}"
                                            target="blank" class="btn btn-dark btn-sm mx-2"><i
                                                class='bx bx-printer'></i></a>
                                    @else
                                        <a href="{{ route('kemoterapi/intervensi/pencegahan/resiko/jatuh.create', $data->id) }}"
                                            target="blank" class="btn btn-dark btn-sm mx-2"><i
                                                class='bx bx-plus'></i></a>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="{{ route('kemoterapi/monitoring/resiko/jatuh.show', $data->id) }}"
                                                target="_blank">
                                                <i class="bx bx-printer me-1"></i>
                                                Print
                                            </a>
                                            <a class="dropdown-item"
                                                href="{{ route('kemoterapi/monitoring/resiko/jatuh.edit', $data->id) }}">
                                                <i class="bx bx-edit-alt me-1"></i>
                                                Edit
                                            </a>
                                            <a href="{{ route('kemoterapi/monitoring/resiko/jatuh.destroy', $data->id) }}"
                                                onclick="return confirm('Apakah anda yakin untuk melanjutkan ? ')"
                                                class="dropdown-item">
                                                <i class='bx bx-trash me-1'></i>
                                                Hapus
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- end persetujuan kemo --}}

            {{-- Ringkasan Masuk dan Keluar --}}
            <div class="tab-pane fade {{ session('active') == 'ringkasanMasukdanKeluar' ? 'show active' : '' }}"
                id="navs-justified-ringkasan_masuk_dan_keluar" role="tabpanel">
                <div class="text-end">
                    <a href="{{ route('kemoterapi/ringkasan-masuk-keluar.create', $item->id) }}"
                        class="btn btn-success btn-sm">+Tambah Ringkasan</a>
                </div>
                <table class="table">
                    <thead>
                        <tr class="text-nowrap">
                            <th class="text-body">No</th>
                            <th class="text-body">Pasien</th>
                            <th class="text-body">Tanggal Masuk</th>
                            <th class="text-body">Jam Masuk</th>
                            <th class="text-body">Tanggal Keluar</th>
                            <th class="text-body">Jam Keluar</th>
                            <th class="text-body">Tahun Kunjungan</th>
                            <th class="text-body">Ruang Rawat</th>
                            <th class="text-body">Agama</th>
                            <th class="text-body">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($item->queue->patient->kemoterapiRingkasanMasukdanKeluar as $itemRingkasan)
                            {{-- @php
                                dd($itemRingkasan);
                                die();
                            @endphp --}}
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $itemRingkasan->patient->name }}</td>
                                <td>{{ $itemRingkasan->tanggal_masuk ?? '' }}</td>
                                <td>{{ $itemRingkasan->jam_masuk ?? '' }}</td>
                                <td>{{ $itemRingkasan->tanggal_keluar ?? '' }}</td>
                                <td>{{ $itemRingkasan->jam_keluar ?? '' }}</td>
                                <td>{{ $itemRingkasan->tahun_kunjungan ?? '' }}</td>
                                <td>{{ $itemRingkasan->ruang_rawat ?? '' }}</td>
                                <td>{{ $itemRingkasan->agama ?? '' }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="{{ route('kemoterapi/ringkasan-masuk-keluar.show', $itemRingkasan->id) }}"
                                                target="_blank">
                                                <i class="bx bx-printer me-1"></i>
                                                Print
                                            </a>
                                            <a href="{{ route('kemoterapi/ringkasan-masuk-keluar.edit', $itemRingkasan->id) }}"
                                                class="dropdown-item">
                                                <i class='bx bx-edit me-1'></i>
                                                Edit
                                            </a>
                                            <form
                                                action="{{ route('kemoterapi/ringkasan-masuk-keluar.destroy', $itemRingkasan->id) }}"
                                                method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="dropdown-item"
                                                    onclick="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
                                                    <i class='bx bx-trash me-1'></i>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>


                                </td>
                                {{-- <td>{{ date('Y-m-d H:i', strtotime($itemRingkasan->tanggal_Ringkasan ?? '')) }}</td> --}}
                                {{-- <td class="d-flex">
                                    <a href="{{ route('kemoterapi/assesmenawal.show', $itemRingkasan->id) }}"
                                        class="btn btn-dark btn-sm mx-2"><i class='bx bx-printer'></i></a>
                                    <form action="{{ route('kemoterapi/assesmenawal.destroy', $itemRingkasan->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin Ingin Menghapus Data ?')"><i
                                                class='bx bx-trash'></i></button>
                                    </form>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- end Ringkasan Masuk dan Keluar --}}

            {{-- tindakan pelayanan pasien --}}
            <div class="tab-pane fade {{ session('btn') == 'tindakan pelayanan pasien' ? 'show active' : '' }}"
                id="navs-justified-tindakan-pelayanan-pasien" role="tabpanel">
                <div class="text-end mb-3">
                    <a href="{{ route('kemoterapi/tindakan/pelayanan/pasien.index', $item->id) }}"
                        class="btn btn-success btn-sm">+Tambah
                        Tindakan Pelayanan Pasien</a>
                </div>
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
                        @foreach ($item->kemoterapiTindakanPelayananPatients as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->user->name }}</td>
                                <td>{{ $data->tanggal_masuk }}</td>
                                <td>{{ $data->tanggal_keluar }}</td>
                                <td>
                                    <a href="{{ route('kemoterapi/tindakan/pelayanan/pasien.create', $data->id) }}"
                                        class="btn btn-dark btn-sm"><i class="bx bx-plus"></i></a>
                                </td>
                                <td class="d-flex">
                                    <a href="{{ route('kemoterapi/tindakan/pelayanan/pasien.show', $data->id) }}"
                                        class="btn btn-dark btn-sm mx-2"><i class='bx bx-show'></i></a>
                                    <a href="{{ route('kemoterapi/tindakan/pelayanan/pasien.edit', $data->id) }}"
                                        class="btn btn-warning btn-sm mx-2"><i class='bx bx-edit'></i></a>
                                    <a href="{{ route('kemoterapi/tindakan/pelayanan/pasien.destroy', $data->id) }}"
                                        class="btn btn-danger btn-sm mx-2"
                                        onclick="return confirm('Yakin ingin menghapus data?')"><i
                                            class="bx bx-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- end tindakan pelayanan pasien --}}

            {{-- Monitoring Tindakan Kemoterapi --}}
            <div class="tab-pane fade {{ session('active') == 'monitoringTindakanKemoterapi' ? 'show active' : '' }}"
                id="navs-justified-monitoring-tindakan-kemoterapi" role="tabpanel">
                <div class="text-end">
                    <a href="{{ route('kemoterapi/monitoring-tindakan.create', $item->id) }}"
                        class="btn btn-success btn-sm">+Tambah Monitoring</a>
                </div>
                <table class="table">
                    <thead>
                        <tr class="text-nowrap">
                            <th class="text-body">No</th>
                            <th class="text-body">Pasien</th>
                            <th class="text-body">Agama</th>
                            <th class="text-body">Tanggal Monitoring</th>
                            <th class="text-body">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($item->queue->patient->kemoterapiMonitoringTindakanPatient as $itemMonitoring)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $itemMonitoring->patient->name }}</td>
                                <td>{{ $itemMonitoring->patient->agama ?? '' }}</td>
                                <td>{{ $itemMonitoring->created_at->format('Y-m-d') ?? '' }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="{{ route('kemoterapi/monitoring-tindakan.show', $itemMonitoring->id) }}"
                                                target="_blank">
                                                <i class="bx bx-printer me-1"></i>
                                                Print
                                            </a>
                                            <a href="{{ route('kemoterapi/monitoring-tindakan.edit', $itemMonitoring->id) }}"
                                                class="dropdown-item">
                                                <i class='bx bx-edit me-1'></i>
                                                Edit
                                            </a>
                                            <form
                                                action="{{ route('kemoterapi/monitoring-tindakan.destroy', $itemMonitoring->id) }}"
                                                method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="dropdown-item"
                                                    onclick="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
                                                    <i class='bx bx-trash me-1'></i>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>


                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- end Monitoring Tindakan Kemoterapi --}}

            {{-- Lembar Konsultasi/Kontrol Pasien Kemoterapi --}}
            <div class="tab-pane fade {{ session('active') == 'lembarKonsulPasien' ? 'show active' : '' }}"
                id="navs-justified-lembar-konsul-pasien" role="tabpanel">
                <div class="text-end">
                    <a href="{{ route('kemoterapi/lembar/konsul.create') }}"
                        class="btn btn-success btn-sm">+Tambah</a>
                </div>
                <table class="table">
                    <thead>
                        <tr class="text-nowrap">
                            <th class="text-body">No</th>
                            <th class="text-body">Pasien</th>
                            <th class="text-body">Agama</th>
                            <th class="text-body">Tanggal Monitoring</th>
                            <th class="text-body">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($item->queue->patient->kemoterapiMonitoringTindakanPatient as $itemMonitoring)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $itemMonitoring->patient->name }}</td>
                                <td>{{ $itemMonitoring->patient->agama ?? '' }}</td>
                                <td>{{ $itemMonitoring->created_at->format('Y-m-d') ?? '' }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="{{ route('kemoterapi/lembar/konsul.show) }}"
                                                target="_blank">
                                                <i class="bx bx-printer me-1"></i>
                                                Print
                                            </a>
                                            <a href="{{ route('kemoterapi/lembar/konsul.edit) }}"
                                                class="dropdown-item">
                                                <i class='bx bx-edit me-1'></i>
                                                Edit
                                            </a>
                                            <form
                                                action="{{ route('kemoterapi/monitoring-tindakan.destroy', $itemMonitoring->id) }}"
                                                method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="dropdown-item"
                                                    onclick="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
                                                    <i class='bx bx-trash me-1'></i>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>


                                </td>
                            </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
            {{-- end Lembar Konsultasi/Kontrol Pasien Kemoterapi --}}
        </div>
    </div>

    {{-- modal --}}
    <div class="modal fade" id="modalScrollable" tabindex="-1" aria-labelledby="modalScrollableTitle"
        aria-hidden="true">

    </div>

    <script>
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

    <script>
        const btnLeft = document.querySelector(".left-btn");
        const btnRight = document.querySelector(".right-btn");
        const tabMenu = document.querySelector(".tab-menu");

        const IconVisibility = () => {
            let scrollLeftValue = Math.ceil(tabMenu.scrollLeft);
            let scrollableWidthValue = tabMenu.scrollWidth - tabMenu.clientWidth;

            btnLeft.style.display = scrollLeftValue > 0 ? "block" : "none";
            btnRight.style.display =
                scrollableWidthValue > scrollLeftValue ? "block" : "none";
        };

        btnRight.addEventListener("click", () => {
            tabMenu.scrollLeft += 150;
            //   IconVisibility();
            setTimeout(() => IconVisibility(), 50);
        });

        btnLeft.addEventListener("click", () => {
            tabMenu.scrollLeft -= 150;
            // IconVisibility();
            setTimeout(() => IconVisibility(), 50);
        });

        window.onload = () => {
            btnRight.style.display =
                tabMenu.scrollWidth > tabMenu.clientWidth ||
                tabMenu.scrollWidth >= window.innerWidth ?
                "block" :
                "none";

            btnLeft.style.display =
                tabMenu.scrollWidth >= window.innerWidth ? "" : "none";
        };

        window.onresize = () => {
            btnRight.style.display =
                tabMenu.scrollWidth > tabMenu.clientWidth ||
                tabMenu.scrollWidth >= window.innerWidth ?
                "block" :
                "none";
            btnLeft.style.display =
                tabMenu.scrollWidth >= window.innerWidth ? "" : "none";

            let scrollLeftValue = Math.round(tabMenu.scrollLeft);

            btnLeft.style.display = scrollLeftValue > 0 ? "block" : "none";
        };
        //Javascript to make the tab navigation draggable
        let activeDrag = false;

        tabMenu.addEventListener("mousemove", (drag) => {
            if (!activeDrag) return;
            tabMenu.scrollLeft -= drag.movementX;
            IconVisibility();
            tabMenu.classList.add("dragging");
        });

        document.addEventListener("mouseup", () => {
            activeDrag = false;
            tabMenu.classList.remove("dragging");
        });

        tabMenu.addEventListener("mousedown", () => {
            activeDrag = true;
        });

        //Javascript to view tab contents on click tab buttons
        const tabs = document.querySelectorAll(".tab");
        const tabBtns = document.querySelectorAll(".tab-btn");

        const tab_nav = function(tabBtnClick) {
            tabBtns.forEach((tabBtn) => {
                tabBtn.classList.remove("active");
            });

            tabs.forEach((tab) => {
                tab.classList.remove("active");
            });

            tabBtns[tabBtnClick].classList.add("active");
            tabs[tabBtnClick].classList.add("active");
        };

        tabBtns.forEach((tabBtn, i) => {
            tabBtn.addEventListener("click", () => {
                tab_nav(i);
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Mendapatkan semua button yang mengontrol tab
            const tabButtons = document.querySelectorAll('[data-bs-toggle="tab"]');

            // Fungsi untuk mengaktifkan tab
            function activateTab(tabId) {
                const tabs = document.querySelectorAll('.tab-pane');
                const buttons = document.querySelectorAll('.tab-btn button');

                // Menonaktifkan semua tab dan button
                tabs.forEach(tab => {
                    tab.classList.remove('show', 'active');
                });
                buttons.forEach(button => {
                    button.classList.remove('active');
                });

                // Mengaktifkan tab yang dipilih
                const activeTab = document.querySelector(tabId);
                const activeButton = document.querySelector(`[data-bs-target="${tabId}"]`);

                if (activeTab && activeButton) {
                    activeTab.classList.add('show', 'active');
                    activeButton.classList.add('active');
                }
            }

            // Event listener untuk semua button tab
            tabButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const tabId = this.getAttribute('data-bs-target');
                    activateTab(tabId);
                });
            });

            // Aktifkan tab berdasarkan session state jika ada
            if (sessionStorage.getItem('activeTab')) {
                activateTab(sessionStorage.getItem('activeTab'));
            }
        });
    </script>
@endsection
