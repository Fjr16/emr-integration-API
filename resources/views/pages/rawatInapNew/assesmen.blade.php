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
                                    {{ $item->queue->patient->city->name }},
                                    {{ $item->queue->patient->province->name }},{{ $item->queue->patient->alamat }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- end Informasi Pasien --}}


        {{-- Menu Assesmen --}}
        <div class="card-body">
            <div class="nav-align-top mb-4 shadow-sm">
                <ul class="nav nav-tabs nav-sm nav-fill" role="tablist">
                    <li class="nav-item">
                        <button id="btn-link" type="button" {{-- @dd(session()->all()) --}}
                            class="nav-link {{ session('btn') == 'asesmen-awal-medis' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-asesmen-awal-medis"
                            aria-controls="navs-justified-asesmen-awal-medis" aria-selected="true">
                            <i class="tf-icons bx bx-bookmark-alt-plus"></i>
                            <p class="m-0">Asessment Awal Medis</p>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button id="btn-link" type="button" {{-- @dd(session()->all()) --}}
                            class="nav-link {{ session('btn') == 'asesmen-awal-keperawatan' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-asesmen-awal-keperawatan"
                            aria-controls="navs-justified-asesmen-awal-keperawatan" aria-selected="true">
                            <i class="tf-icons bx bx-bookmark-alt-plus"></i>
                            <p class="m-0">Asessment Awal Keperawatan</p>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button id="btn-link" type="button" {{-- @dd(session()->all()) --}}
                            class="nav-link {{ session('btn') == 'asesmenprasedasi' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-asesmenprasedasi"
                            aria-controls="navs-justified-asesmenprasedasi" aria-selected="true">
                            <i class='tf-icons bx bx-alarm-exclamation'></i>
                            <p class="m-0">Asesmen Pra Sedasi</p>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button id="btn-link" type="button" {{-- @dd(session()->all()) --}}
                            class="nav-link {{ session('btn') == 'asesmenpraanestesi-induksi' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-asesmenpraanestesi-induksi"
                            aria-controls="navs-justified-asesmenpraanestesi-induksi" aria-selected="true">
                            <i class='tf-icons bx bx-alarm-exclamation'></i>
                            <p class="m-0">Asesmen Pra Anestesi - Induksi</p>
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade {{ session('btn') == 'asesmen-awal-medis' ? 'show active' : '' }}"
                        id="navs-justified-asesmen-awal-medis" role="tabpanel">
                        <div class="row">
                            <div class="col-sm-12">
                                <h6>Asesment Awal Medis
                                    {{-- @can('tambah assesmen keperawatan ranap') --}}
                                    <span><a href="{{ route('assesmen/awal/medis/ranap.create', $item->id) }}"
                                            class="btn btn-sm btn-success">+ Tambah Assesmen Awal Medis</a></span>
                                    {{-- <a href="{{ route('ranap/cppt.show', $item->queue->patient->id) }}" target="blank"
                                        class="btn btn-dark btn-sm"><i class='bx bx-low-vision'></i></a> --}}
                                    {{-- @endcan --}}
                                </h6>
                                <div class="card">
                                    <table class="table">
                                        <thead>
                                            <tr class="text-nowrap bg-dark">
                                                <th>No</th>
                                                <th>Pasien</th>
                                                <th>Petugas</th>
                                                <th>Tanggal</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $assesmen)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $assesmen->patient->name ?? '' }}</td>
                                                    <td>{{ $assesmen->user->name ?? '' }}</td>
                                                    <td>{{ $assesmen->tanggal ?? '' }}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button"
                                                                class="btn p-0 dropdown-toggle hide-arrow"
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
                    <div class="tab-pane fade {{ session('btn') == 'asesmen-awal-keperawatan' ? 'show active' : '' }}"
                        id="navs-justified-asesmen-awal-keperawatan" role="tabpanel">
                        <div class="row">
                            <div class="col-sm-12">
                                <h6>Asesment Awal Keperawatan
                                    @can('tambah assesmen keperawatan ranap')
                                        <span><a href="{{ route('ranap/asesmen/status/fisik.index', $item->queue_id) }}"
                                                class="btn btn-sm btn-success">+ Tambah Assesmen Awal Keperawatan</a></span>
                                        <a href="{{ route('ranap/cppt.show', $item->queue->patient->id) }}" target="blank"
                                            class="btn btn-dark btn-sm"><i class='bx bx-low-vision'></i></a>
                                    @endcan
                                </h6>
                                <div class="card">
                                    <table class="table">
                                        <thead>
                                            <tr class="text-nowrap bg-dark">
                                                <th>No</th>
                                                <th>NORM</th>
                                                <th>Pasien</th>
                                                <th>Dokter</th>
                                                <th>Action</th>
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
                                                            <button type="button"
                                                                class="btn p-0 dropdown-toggle hide-arrow"
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
                    <div class="tab-pane fade {{ session('btn') == 'asesmenprasedasi' ? 'show active' : '' }}"
                        id="navs-justified-asesmenprasedasi" role="tabpanel">
                        <div class="text-end mb-3">
                            <a class="btn btn-dark btn-sm" href="#"><i class="bx bx-printer"></i> Cetak
                                Rekapitulasi</a>
                            <a class="btn btn-success btn-sm"
                                href="{{ route('rekapitulasi/tindakan/pelayanan/pasien.create', $item->id) }}">+ Tambah
                                Tindakan Pelayanan Pasien</a>
                            <a class="btn btn-success btn-sm"
                                href="{{ route('assesmen/pra/sedasi.create', $item->id) }}">+
                                Tambah Asesmen Pra Sedasi</a>
                        </div>
                        <div class="card">
                            <table class="table">
                                <thead>
                                    <tr class="text-nowrap bg-dark">
                                        <th>No</th>
                                        <th>Dokter Pengirim</th>
                                        <th>Tanggal Operasi</th>
                                        <th>Tanggal Pemeriksaan</th>
                                        <th>Dokter Anestesi</th>
                                        <th>Action</th>
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
                    <div class="tab-pane fade {{ session('btn') == 'asesmenpraanestesi-induksi' ? 'show active' : '' }}"
                        id="navs-justified-asesmenpraanestesi-induksi" role="tabpanel">
                        <div class="text-end mb-3">
                            <a class="btn btn-dark btn-sm" href="#"><i class="bx bx-printer"></i> Cetak
                                Rekapitulasi</a>
                            <a class="btn btn-success btn-sm"
                                href="{{ route('rekapitulasi/tindakan/pelayanan/pasien.create', $item->id) }}">+ Tambah
                                Tindakan Pelayanan Pasien</a>
                            <a class="btn btn-success btn-sm"
                                href="{{ route('assesmen/pra/anestesi/pra/induksi.create', $item->id) }}">+ Tambah Asesmen
                                Pra
                                Anestesi - Induksi</a>
                        </div>
                        <div class="card">
                            <table class="table">
                                <thead>
                                    <tr class="text-nowrap bg-dark">
                                        <th>No</th>
                                        <th>Tanggal Assesmen</th>
                                        <th>Dokter Anestesi</th>
                                        <th>Asisten Anestesi</th>
                                        <th>Dokter Bedah</th>
                                        <th>Diagnosis Pra Bedah</th>
                                        <th>Jenis Pembedahan</th>
                                        <th>Action</th>
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
                </div>
            </div>
        </div>
        {{-- end Menu Assesmen --}}
    </div>
@endsection
