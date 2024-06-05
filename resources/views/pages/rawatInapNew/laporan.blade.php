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


        {{-- Laporan --}}
        <div class="card-body">
            <div class="nav-align-top mb-4 shadow-sm">
                <ul class="nav nav-tabs nav-sm nav-fill" role="tablist">
                    <li class="nav-item">
                        <button id="btn-link" type="button" {{-- @dd(session()->all()) --}}
                            class="nav-link {{ session('btn') == 'Laporan Operasi' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-laporan-operasi"
                            aria-controls="navs-justified-laporan-operasi" aria-selected="true">
                            <i class="tf-icons bx bx-bookmark-alt-plus"></i>
                            <p class="m-0">Laporan Operasi</p>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button id="btn-link" type="button" {{-- @dd(session()->all()) --}}
                            class="nav-link {{ session('btn') == 'Laporan Anestesi' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-laporan-anestesi"
                            aria-controls="navs-justified-laporan-anestesi" aria-selected="true">
                            <i class="tf-icons bx bx-bookmark-alt-plus"></i>
                            <p class="m-0">Laporan Anestesi</p>
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade {{ session('btn') == 'Laporan Operasi' ? 'show active' : '' }}"
                        id="navs-justified-laporan-operasi" role="tabpanel">
                        <div class="row">
                            <div class="col-sm-12">
                                <h6>Laporan Operasi <span class="m-3">
                                        {{-- <a href="{{ route('laporan/operasi.create', $item->id) }}"
                                    class="btn btn-success ms-auto btn-sm m-0 mx-3">+
                                    Tambah Data</a> --}}
                                    </span>
                                </h6>
                                <div class="card">
                                    <div class="table-responsive">
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
                                                @foreach ($data as $laporan)
                                                    <tr>
                                                        <td scope="row">{{ $loop->iteration }}</td>
                                                        <td>{{ $laporan->nama_ahli_bedah }}</td>
                                                        <td>{{ $laporan->asisten_bedah }}</td>
                                                        <td>{{ $laporan->nama_ahli_anestesi }}</td>
                                                        <td>{{ $laporan->jenis_anestesi }}</td>
                                                        <td>{{ $laporan->tingkatan_operasi }}</td>
                                                        <td>{{ $laporan->diagnosis_pra_operasi }}</td>
                                                        <td>{{ $laporan->diagnosis_pasca_operasi }}</td>
                                                        <td>{{ $laporan->nama_operasi }}</td>
                                                        <td>{{ $laporan->komplikasi }}</td>
                                                        <td>{{ $laporan->spesimen_operasi_pemeriksaan_pa }}</td>
                                                        <td>{{ $laporan->jumlah_pendarahan }}</td>
                                                        <td>{{ $laporan->jumlah_ditransfusi }}</td>
                                                        <td>{{ $laporan->tanggal }}</td>
                                                        <td>{{ $laporan->jam_dimulai }}</td>
                                                        <td>{{ $laporan->jam_selesai }}</td>
                                                        <td>{{ $laporan->lama_operasi }}</td>
                                                        <td>{{ $laporan->prosedur_operasi }}</td>

                                                        <td>
                                                            <div class="dropdown">
                                                                <button type="button"
                                                                    class="btn p-0 dropdown-toggle hide-arrow"
                                                                    data-bs-toggle="dropdown">
                                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('laporan/operasi.edit', $laporan->id) }}">
                                                                        <i class="bx bx-edit-alt me-1"></i>
                                                                        Edit
                                                                    </a>
                                                                    <form
                                                                        action="{{ route('laporan/operasi.destroy', $laporan->id) }}"
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
                    <div class="tab-pane fade {{ session('btn') == 'Laporan Anestesi' ? 'show active' : '' }}"
                        id="navs-justified-laporan-anestesi" role="tabpanel">
                        <div class="row">
                            <div class="col-sm-12">
                                <h6>
                                    {{ $title }} -- {{ $item->queue->patient->name }}
                                    <span><a href="{{ route('laporan/anestesi.create', $item->id) }}"
                                            class="btn mx-2 btn-sm btn-primary">+</a></span>
                                </h6>
                                <div class="card">
                                    <table class="table">
                                        <thead>
                                            <tr class="text-nowrap bg-dark">
                                                <th>No</th>
                                                <th>User Pengisi</th>
                                                <th>Asisten Anestesi</th>
                                                <th>Dokter Anestesi</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data2 as $d)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</th>
                                                    <td>{{ $d->user->name }}</td>
                                                    <td>{{ $d->nama_penata_anestesi }}</td>
                                                    <td>{{ $d->nama_dokter_anestesi }}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button"
                                                                class="btn p-0 dropdown-toggle hide-arrow"
                                                                data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item"
                                                                    href="{{ route('laporan/anestesi.show', $d->id) }}"
                                                                    target="_blank">
                                                                    <i class="bx bx-printer me-1"></i>
                                                                    Print
                                                                </a>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('laporan/anestesi.edit', $d->id) }}">
                                                                    <i class="bx bx-edit-alt me-1"></i>
                                                                    Edit
                                                                </a>
                                                                <form
                                                                    action="{{ route('laporan/anestesi.destroy', $d->id) }}"
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
        {{-- end Laporan --}}
    </div>
@endsection
