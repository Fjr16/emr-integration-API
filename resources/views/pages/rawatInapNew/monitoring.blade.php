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


        {{-- Monitoring --}}
        <div class="card-body">
            <div class="nav-align-top mb-4 shadow-sm">
                <ul class="nav nav-tabs nav-sm nav-fill" role="tablist">
                    <li class="nav-item">
                        <button id="btn-link" type="button" {{-- @dd(session()->all()) --}}
                            class="nav-link {{ session('btn') == 'monitoring-pacu' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-monitoring-pacu"
                            aria-controls="navs-justified-monitoring-pacu" aria-selected="true">
                            <i class="tf-icons bx bx-bookmark-alt-plus"></i>
                            <p class="m-0">Monitoring Pacu</p>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button id="btn-link" type="button" {{-- @dd(session()->all()) --}}
                            class="nav-link {{ session('btn') == 'monitoringresikojatuh' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-monitoringresikojatuh"
                            aria-controls="navs-justified-monitoringresikojatuh" aria-selected="true">
                            <i class='tf-icons bx bx-alarm-exclamation'></i>
                            <p class="m-0">Monitoring Resiko Jatuh</p>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button id="btn-link" type="button" {{-- @dd(session()->all()) --}}
                            class="nav-link {{ session('btn') == 'monitoringstatusfungsional' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-monitoringstatusfungsional"
                            aria-controls="navs-justified-monitoringstatusfungsional" aria-selected="true">
                            <i class='tf-icons bx bx-alarm-exclamation'></i>
                            <p class="m-0">Monitoring Status Fungsional</p>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button id="btn-link" type="button" {{-- @dd(session()->all()) --}}
                            class="nav-link {{ session('btn') == 'monitoringpelayananobatpasien' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-justified-monitoringpelayananobatpasien"
                            aria-controls="navs-justified-monitoringpelayananobatpasien" aria-selected="true">
                            <i class='tf-icons bx bx-alarm-exclamation'></i>
                            <p class="m-0">Monitoring Obat</p>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button id="btn-link" type="button" {{-- @dd(session()->all()) --}}
                            class="nav-link {{ session('btn') == 'monitoringcairaninfus' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-monitoringcairaninfus"
                            aria-controls="navs-justified-monitoringcairaninfus" aria-selected="true">
                            <i class='tf-icons bx bx-alarm-exclamation'></i>
                            <p class="m-0">Monitoring Cairan Infus</p>
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
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
                                            <tr class="text-nowrap bg-dark">
                                                <th>No</th>
                                                <th>Petugas / Dokter</th>
                                                <th>Ruangan</th>
                                                <th>Tanggal</th>
                                                <th>Action</th>
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
                                    <tr class="text-nowrap bg-dark">
                                        <th>No</th>
                                        <th>Perawat / Inisial</th>
                                        <th>Tanggal</th>
                                        <th>Tipe</th>
                                        <th>Total Skor</th>
                                        <th>Nilai Skor</th>
                                        <th>Intervensi</th>
                                        <th>Action</th>
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
                                    <tr class="text-nowrap bg-dark">
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Perawat Pengkaji</th>
                                        <th>Total Skor</th>
                                        <th>Kategori Skor</th>
                                        <th>Action</th>
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
                                        role="tab" data-bs-toggle="tab"
                                        data-bs-target="#navs-pills-justified-obatoral"
                                        aria-controls="navs-pills-justified-obatoral" aria-selected="true">
                                        Obat Oral
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button type="button"
                                        class="border nav-link {{ session('perawat') == 'obatinjeksi' ? 'active' : '' }}"
                                        role="tab" data-bs-toggle="tab"
                                        data-bs-target="#navs-pills-justified-obatinjeksi"
                                        aria-controls="navs-pills-justified-obatinjeksi" aria-selected="true">
                                        Obat Injeksi
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button type="button"
                                        class="border nav-link {{ session('perawat') == 'obathighalert' ? 'active' : '' }}"
                                        role="tab" data-bs-toggle="tab"
                                        data-bs-target="#navs-pills-justified-obathighalert"
                                        aria-controls="navs-pills-justified-obathighalert" aria-selected="true">
                                        Obat High Alert
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button type="button"
                                        class="border nav-link {{ session('perawat') == 'suppositoria' ? 'active' : '' }}"
                                        role="tab" data-bs-toggle="tab"
                                        data-bs-target="#navs-pills-justified-suppositoria"
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
                                        role="tab" data-bs-toggle="tab"
                                        data-bs-target="#navs-pills-justified-lainlain"
                                        aria-controls="navs-pills-justified-lainlain" aria-selected="true">
                                        Dan Lain - Lain
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button type="button"
                                        class="border nav-link {{ session('perawat') == 'monitoringobat' ? 'active' : '' }}"
                                        role="tab" data-bs-toggle="tab"
                                        data-bs-target="#navs-pills-justified-monitoringobat"
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
                                                    data-bs-target="#obat1" aria-expanded="true"
                                                    aria-controls="accordionOne" role="tabpanel">
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
                                                                    <input type="text" name="jml"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">Tanggal</label>
                                                                <div class="col-sm-9">
                                                                    <input type="date" name="tanggal"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">Jam</label>
                                                                <div class="col-sm-9">
                                                                    <input type="time" name="jam"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P
                                                                    / I</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i"
                                                                        class="form-control" id="basic-default-name">
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
                                                                    <input type="time" name="jam"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P
                                                                    / I</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i"
                                                                        class="form-control" id="basic-default-name">
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
                                                                    <input type="time" name="jam"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P
                                                                    / I</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i"
                                                                        class="form-control" id="basic-default-name">
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
                                                    data-bs-target="#obat2" aria-expanded="true"
                                                    aria-controls="accordionOne" role="tabpanel">
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
                                                                    <input type="text" name="jml"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">Tanggal</label>
                                                                <div class="col-sm-9">
                                                                    <input type="date" name="tanggal"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">Jam</label>
                                                                <div class="col-sm-9">
                                                                    <input type="time" name="jam"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P
                                                                    / I</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i"
                                                                        class="form-control" id="basic-default-name">
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
                                                                    <input type="time" name="jam"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P
                                                                    / I</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i"
                                                                        class="form-control" id="basic-default-name">
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
                                                                    <input type="time" name="jam"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P
                                                                    / I</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i"
                                                                        class="form-control" id="basic-default-name">
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
                                                    data-bs-target="#obat3" aria-expanded="true"
                                                    aria-controls="accordionOne" role="tabpanel">
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
                                                                    <input type="text" name="jml"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">Tanggal</label>
                                                                <div class="col-sm-9">
                                                                    <input type="date" name="tanggal"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">Jam</label>
                                                                <div class="col-sm-9">
                                                                    <input type="time" name="jam"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P
                                                                    / I</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i"
                                                                        class="form-control" id="basic-default-name">
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
                                                                    <input type="time" name="jam"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P
                                                                    / I</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i"
                                                                        class="form-control" id="basic-default-name">
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
                                                                    <input type="time" name="jam"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P
                                                                    / I</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i"
                                                                        class="form-control" id="basic-default-name">
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
                                                                    <input type="text" name="jml"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">Tanggal</label>
                                                                <div class="col-sm-9">
                                                                    <input type="date" name="tanggal"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">Jam</label>
                                                                <div class="col-sm-9">
                                                                    <input type="time" name="jam"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P
                                                                    / I</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i"
                                                                        class="form-control" id="basic-default-name">
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
                                                                    <input type="time" name="jam"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P
                                                                    / I</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i"
                                                                        class="form-control" id="basic-default-name">
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
                                                                    <input type="time" name="jam"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P
                                                                    / I</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i"
                                                                        class="form-control" id="basic-default-name">
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
                                                                    <input type="text" name="jml"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">Tanggal</label>
                                                                <div class="col-sm-9">
                                                                    <input type="date" name="tanggal"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">Jam</label>
                                                                <div class="col-sm-9">
                                                                    <input type="time" name="jam"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P
                                                                    / I</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i"
                                                                        class="form-control" id="basic-default-name">
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
                                                                    <input type="time" name="jam"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P
                                                                    / I</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i"
                                                                        class="form-control" id="basic-default-name">
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
                                                                    <input type="time" name="jam"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P
                                                                    / I</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i"
                                                                        class="form-control" id="basic-default-name">
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
                                                                    <input type="text" name="jml"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">Tanggal</label>
                                                                <div class="col-sm-9">
                                                                    <input type="date" name="tanggal"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">Jam</label>
                                                                <div class="col-sm-9">
                                                                    <input type="time" name="jam"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P
                                                                    / I</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i"
                                                                        class="form-control" id="basic-default-name">
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
                                                                    <input type="time" name="jam"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P
                                                                    / I</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i"
                                                                        class="form-control" id="basic-default-name">
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
                                                                    <input type="time" name="jam"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P
                                                                    / I</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i"
                                                                        class="form-control" id="basic-default-name">
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
                                                    data-bs-target="#obat1" aria-expanded="true"
                                                    aria-controls="accordionOne" role="tabpanel">
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
                                                                    <input type="text" name="jml"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">Tanggal</label>
                                                                <div class="col-sm-9">
                                                                    <input type="date" name="tanggal"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">Jam</label>
                                                                <div class="col-sm-9">
                                                                    <input type="time" name="jam"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P
                                                                    / I (1)</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P
                                                                    / I (2)</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i2"
                                                                        class="form-control" id="basic-default-name">
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
                                                                    <input type="time" name="jam"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P
                                                                    / I (1)</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P
                                                                    / I (2)</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i2"
                                                                        class="form-control" id="basic-default-name">
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
                                                                    <input type="time" name="jam"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P
                                                                    / I (1)</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P
                                                                    / I (2)</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i2"
                                                                        class="form-control" id="basic-default-name">
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
                                                    data-bs-target="#obat2" aria-expanded="true"
                                                    aria-controls="accordionOne" role="tabpanel">
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
                                                                    <input type="text" name="jml"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">Tanggal</label>
                                                                <div class="col-sm-9">
                                                                    <input type="date" name="tanggal"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">Jam</label>
                                                                <div class="col-sm-9">
                                                                    <input type="time" name="jam"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P
                                                                    / I (1)</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P
                                                                    / I (2)</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i2"
                                                                        class="form-control" id="basic-default-name">
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
                                                                    <input type="time" name="jam"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P
                                                                    / I (1)</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P
                                                                    / I (2)</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i2"
                                                                        class="form-control" id="basic-default-name">
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
                                                                    <input type="time" name="jam"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P
                                                                    / I (1)</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P
                                                                    / I (2)</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i2"
                                                                        class="form-control" id="basic-default-name">
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
                                                    data-bs-target="#obat1" aria-expanded="true"
                                                    aria-controls="accordionOne" role="tabpanel">
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
                                                                    <input type="text" name="jml"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">Tanggal</label>
                                                                <div class="col-sm-9">
                                                                    <input type="date" name="tanggal"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">Jam</label>
                                                                <div class="col-sm-9">
                                                                    <input type="time" name="jam"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P / I</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i"
                                                                        class="form-control" id="basic-default-name">
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
                                                                    <input type="time" name="jam"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P / I</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i"
                                                                        class="form-control" id="basic-default-name">
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
                                                                    <input type="time" name="jam"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P / I</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i"
                                                                        class="form-control" id="basic-default-name">
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
                                                <button type="button" class="accordion-button"
                                                    data-bs-toggle="collapse" data-bs-target="#obat2"
                                                    aria-expanded="true" aria-controls="accordionOne" role="tabpanel">
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
                                                                    <input type="text" name="jml"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">Tanggal</label>
                                                                <div class="col-sm-9">
                                                                    <input type="date" name="tanggal"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">Jam</label>
                                                                <div class="col-sm-9">
                                                                    <input type="time" name="jam"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P / I</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i"
                                                                        class="form-control" id="basic-default-name">
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
                                                                    <input type="time" name="jam"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P / I</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i"
                                                                        class="form-control" id="basic-default-name">
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
                                                                    <input type="time" name="jam"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P / I</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i"
                                                                        class="form-control" id="basic-default-name">
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
                                                <button type="button" class="accordion-button"
                                                    data-bs-toggle="collapse" data-bs-target="#obat1"
                                                    aria-expanded="true" aria-controls="accordionOne" role="tabpanel">
                                                    Cateter | Frekuensi : 3 X 1
                                                </button>
                                            </h2>

                                            <div id="obat1" class="accordion-collapse collapse"
                                                data-bs-parent="#alkes">
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">Jumlah / R</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="jml"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">Tanggal</label>
                                                                <div class="col-sm-9">
                                                                    <input type="date" name="tanggal"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">Jam</label>
                                                                <div class="col-sm-9">
                                                                    <input type="time" name="jam"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P / I (1)</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P / I (2)</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i2"
                                                                        class="form-control" id="basic-default-name">
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
                                                                    <input type="time" name="jam"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P / I (1)</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P / I (2)</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i2"
                                                                        class="form-control" id="basic-default-name">
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
                                                                    <input type="time" name="jam"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P / I (1)</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P / I (2)</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i2"
                                                                        class="form-control" id="basic-default-name">
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
                                                <button type="button" class="accordion-button"
                                                    data-bs-toggle="collapse" data-bs-target="#obat2"
                                                    aria-expanded="true" aria-controls="accordionOne" role="tabpanel">
                                                    Suntik | Frekuensi : 3 X 1
                                                </button>
                                            </h2>

                                            <div id="obat2" class="accordion-collapse collapse"
                                                data-bs-parent="#alkes">
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">Jumlah / R</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="jml"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">Tanggal</label>
                                                                <div class="col-sm-9">
                                                                    <input type="date" name="tanggal"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">Jam</label>
                                                                <div class="col-sm-9">
                                                                    <input type="time" name="jam"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P / I (1)</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P / I (2)</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i2"
                                                                        class="form-control" id="basic-default-name">
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
                                                                    <input type="time" name="jam"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P / I (1)</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P / I (2)</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i2"
                                                                        class="form-control" id="basic-default-name">
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
                                                                    <input type="time" name="jam"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P / I (1)</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P / I (2)</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i2"
                                                                        class="form-control" id="basic-default-name">
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
                                                <button type="button" class="accordion-button"
                                                    data-bs-toggle="collapse" data-bs-target="#obat1"
                                                    aria-expanded="true" aria-controls="accordionOne" role="tabpanel">
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
                                                                    <input type="text" name="jml"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">Tanggal</label>
                                                                <div class="col-sm-9">
                                                                    <input type="date" name="tanggal"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">Jam</label>
                                                                <div class="col-sm-9">
                                                                    <input type="time" name="jam"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P / I</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i"
                                                                        class="form-control" id="basic-default-name">
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
                                                                    <input type="time" name="jam"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P / I</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i"
                                                                        class="form-control" id="basic-default-name">
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
                                                                    <input type="time" name="jam"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P / I</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i"
                                                                        class="form-control" id="basic-default-name">
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
                                                <button type="button" class="accordion-button"
                                                    data-bs-toggle="collapse" data-bs-target="#obat2"
                                                    aria-expanded="true" aria-controls="accordionOne" role="tabpanel">
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
                                                                    <input type="text" name="jml"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">Tanggal</label>
                                                                <div class="col-sm-9">
                                                                    <input type="date" name="tanggal"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">Jam</label>
                                                                <div class="col-sm-9">
                                                                    <input type="time" name="jam"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P / I</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i"
                                                                        class="form-control" id="basic-default-name">
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
                                                                    <input type="time" name="jam"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P / I</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i"
                                                                        class="form-control" id="basic-default-name">
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
                                                                    <input type="time" name="jam"
                                                                        class="form-control" id="basic-default-name">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-sm-3 col-form-label"
                                                                    for="basic-default-name">P / I</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="p_i"
                                                                        class="form-control" id="basic-default-name">
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
                                                <button type="button" class="accordion-button"
                                                    data-bs-toggle="collapse" data-bs-target="#obat1"
                                                    aria-expanded="true" aria-controls="accordionOne" role="tabpanel">
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
                                                <button type="button" class="accordion-button"
                                                    data-bs-toggle="collapse" data-bs-target="#obat2"
                                                    aria-expanded="true" aria-controls="accordionOne" role="tabpanel">
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
                    <div class="tab-pane fade {{ session('btn') == 'monitoringcairaninfus' ? 'show active' : '' }}"
                        id="navs-justified-monitoringcairaninfus" role="tabpanel">
                        <div class="text-end mb-3">
                            <h6>
                                Daftar Pasien
                                <span class="text text-primary text-uppercase fw-bold fs-7">Rawat Inap</span>
                            </h6>
                        </div>
                        <div class="card">
                            <table id="example" class="table">
                                <thead>
                                    <tr class="text-nowrap bg-dark">
                                        <th>No Antrian</th>
                                        <th>No Rekam Medis</th>
                                        <th>Nama</th>
                                        <th>Kategori Pasien</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Telp</th>
                                        <th>Alamat</th>
                                        <th>Alergi Obat</th>
                                        <th>Status Rawat Inap</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $item->no_antrian ?? '-' }}</td>
                                            <td>{{ implode('-', str_split(str_pad($item->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}
                                            </td>
                                            <td>{{ $item->patient->name ?? '-' }}</td>
                                            <td>{{ $item->patientCategory->name ?? '-' }}</td>
                                            <td>{{ $item->patient->jenis_kelamin ?? '-' }}</td>
                                            <td>{{ $item->patient->telp ?? '-' }}</td>
                                            <td>{{ $item->patient->alamat ?? '-' }}</td>
                                            <td>{!! $item->patient->alergi ?? '-' !!}</td>
                                            <td>{{ $item->rawatInapPatient->status ?? '-' }}</td>
                                            <td>

                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>

                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item"
                                                            href="{{ route('monitoring/cairan/infus.create', $item->rawatInapPatient->id) }}">
                                                            <i class="bx bx-plus"></i>
                                                            Tambah
                                                        </a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('monitoring/cairan/infus.edit', $item->rawatInapPatient->id) }}">
                                                            <i class="bx bx-edit"></i>
                                                            Edit
                                                        </a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('monitoring/cairan/infus.show', $item->rawatInapPatient->id) }}">
                                                            <i class="bx bx-printer"></i>
                                                            Print
                                                        </a>
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
        {{-- end Monitoring --}}
    </div>
@endsection
