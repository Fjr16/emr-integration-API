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


        {{-- Menu Discharge --}}
        <div class="card-body">
            <div class="nav-align-top mb-4 shadow-sm">
                <ul class="nav nav-tabs nav-sm nav-fill" role="tablist">
                    <li class="nav-item">
                        <button id="btn-link" type="button" {{-- @dd(session()->all()) --}}
                            class="nav-link {{ session('btn') == 'discharge planning perawat' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-discharge-planning-perawat"
                            aria-controls="navs-justified-discharge-planning-perawat" aria-selected="true">
                            <i class="tf-icons bx bx-bookmark-alt-plus"></i>
                            <p class="m-0">Discharge Planning (Perawat)</p>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button id="btn-link" type="button" {{-- @dd(session()->all()) --}}
                            class="nav-link {{ session('btn') == 'discharge planning gizi farmasi' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-justified-discharge-planning-gizi-farmasi"
                            aria-controls="navs-justified-discharge-planning-gizi-farmasi" aria-selected="true">
                            <i class="tf-icons bx bx-bookmark-alt-plus"></i>
                            <p class="m-0">Discharge Planning (Gizi & Farmasi)</p>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button id="btn-link" type="button" {{-- @dd(session()->all()) --}}
                            class="nav-link {{ session('btn') == 'discharge' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-discharge"
                            aria-controls="navs-justified-discharge" aria-selected="true">
                            <i class="tf-icons bx bx-bookmark-alt-plus"></i>
                            <p class="m-0">Discharge Summary</p>
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade {{ session('btn') == 'discharge planning perawat' ? 'show active' : '' }}"
                        id="navs-justified-discharge-planning-perawat" role="tabpanel">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="text-end mb-3">
                                    <a href="#" target="blank" class="btn btn-dark btn-sm"><i
                                            class='bx bx-printer'></i></a>
                                    <a class="btn btn-success btn-sm"
                                        href="{{ route('checklist/rencana/pulang/page/one.create', $item->id) }}">+Tambah
                                        Discharge
                                        Planning</a>
                                </div>
                                <div class="card">
                                    <table class="table">
                                        <thead>
                                            <tr class="text-nowrap bg-dark">
                                                <th>No</th>
                                                <th>Nama User</th>
                                                <th>Tanggal</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($item->ranapDischargePlanningPerawatPatients as $dis)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $dis->created_at->format('Y-m-d') ?? '-' }}</td>
                                                    <td>{{ $dis->user->name ?? '-' }}</td>
                                                    <td>

                                                        <div class="dropdown">
                                                            <button type="button"
                                                                class="btn p-0 dropdown-toggle hide-arrow"
                                                                data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>

                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item"
                                                                    href="{{ route('checklist/rencana/pulang/page/one.edit', $dis->id) }}">
                                                                    <i class="bx bx-plus"></i>
                                                                    Edit
                                                                </a>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('checklist/rencana/pulang/page/one.print', $dis->id) }}">
                                                                    <i class="bx bx-printer"></i>
                                                                    Print
                                                                </a>
                                                                <form
                                                                    action="{{ route('checklist/rencana/pulang/page/one.destroy', $dis->id) }}"
                                                                    method="POST">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button type="submit" class="dropdown-item"
                                                                        onclick="return confirm('Yakin Ingin Menghapus Data ?')">
                                                                        <i class="bx bx-trash"></i>
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
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade {{ session('btn') == 'discharge planning gizi farmasi' ? 'show active' : '' }}"
                        id="navs-justified-discharge-planning-gizi-farmasi" role="tabpanel">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="text-end mb-3">
                                    <a href="#" target="blank" class="btn btn-dark btn-sm"><i
                                            class='bx bx-printer'></i></a>
                                    <a class="btn btn-success btn-sm" href="#">+Tambah Discharge
                                        Planning</a>
                                </div>
                                <div class="card">
                                    <table class="table">
                                        <thead>
                                            <tr class="text-nowrap bg-dark">
                                                <th>No</th>
                                                <th>Nama User</th>
                                                <th>Tanggal</th>
                                                <th>Keterangan Gizi</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($item->ranapDischargePlanningGiziPharmacies as $dis)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $dis->user->name ?? '-' }}</td>
                                                    <td>{{ $dis->created_at->format('Y-m-d') ?? '-' }}</td>
                                                    <td>{!! $dis->keterangan_gizi ?? '-' !!}</td>
                                                    <td>

                                                        <div class="dropdown">
                                                            <button type="button"
                                                                class="btn p-0 dropdown-toggle hide-arrow"
                                                                data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>

                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item"
                                                                    href="{{ route('checklist/rencana/pulang/page/two.edit', $dis->id) }}">
                                                                    <i class="bx bx-plus"></i>
                                                                    Edit
                                                                </a>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('checklist/rencana/pulang/page/two.print', $dis->id) }}">
                                                                    <i class="bx bx-printer"></i>
                                                                    Print
                                                                </a>
                                                                <form
                                                                    action="{{ route('checklist/rencana/pulang/page/two.destroy', $dis->id) }}"
                                                                    method="POST">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button type="submit" class="dropdown-item"
                                                                        onclick="return confirm('Yakin Ingin Menghapus Data ?')">
                                                                        <i class="bx bx-trash"></i>
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
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade {{ session('btn') == 'discharge' ? 'show active' : '' }}"
                        id="navs-justified-discharge" role="tabpanel">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="text-end mb-3">
                                    <a href="{{ route('ringkasan/catatan/medis.show', $item->id) }}" target="blank"
                                        class="btn btn-dark btn-sm"><i class='bx bx-printer'></i></a>
                                    <a class="btn btn-success btn-sm"
                                        href="{{ route('ringkasan/catatan/medis.create', $item->id) }}">+Tambah Discharge
                                        Summary</a>
                                </div>
                                <div class="card">
                                    <table class="table">
                                        <thead>
                                            <tr class="text-nowrap bg-dark">
                                                <th>No</th>
                                                <th>Dokter Pengirim</th>
                                                <th>Tanggal Masuk</th>
                                                <th>Petugas</th>
                                                {{-- @canany(['edit discharge', 'delete discharge']) --}}
                                                <th>Action</th>
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
                                                    <td class="d-flex">
                                                        <a href="{{ route('ringkasan/catatan/medis.edit', $discharge->id) }}"
                                                            class="btn btn-warning btn-sm"><i class='bx bx-edit'></i></a>
                                                        <form
                                                            action="{{ route('ringkasan/catatan/medis.destroy', $discharge->id) }}"
                                                            method="POST">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- end Menu Discharge --}}
    </div>
@endsection
