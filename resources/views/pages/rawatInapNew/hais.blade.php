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


        {{-- HAIs --}}
        <div class="card-body">
            <div class="nav-align-top mb-4 shadow-sm">
                <ul class="nav nav-tabs nav-sm nav-fill" role="tablist">
                    <li class="nav-item">
                        <button id="btn-link" type="button" {{-- @dd(session()->all()) --}}
                            class="nav-link {{ session('btn') == 'hais' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-hais"
                            aria-controls="navs-justified-hais" aria-selected="true">
                            <i class='tf-icons bx bx-alarm-exclamation'></i>
                            <p class="m-0">HAIs</p>
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade {{ session('btn') == 'hais' ? 'show active' : '' }}" id="navs-justified-hais"
                        role="tabpanel">
                        <div class="text-end mb-3">
                            @if ($item->ranapHaisPatients->where('jenis', 'Infeksi Saluran Kemih')->first() == null)
                                <a class="btn btn-success btn-sm" href="{{ route('hais/isk.create', $item->id) }}">+
                                    Tambah
                                    Pencegahan ISK</a>
                            @endif
                            @if ($item->ranapHaisPatients->where('jenis', 'Infeksi Aliran Darah')->first() == null)
                                <a class="btn btn-success btn-sm" href="{{ route('hais/iad.create', $item->id) }}">+
                                    Tambah
                                    Pencegahan IAD</a>
                            @endif
                            @if ($item->ranapHaisPatients->where('jenis', 'Infeksi Daerah Operasi')->first() == null)
                                <a class="btn btn-success btn-sm" href="{{ route('hais/ido.create', $item->id) }}">+
                                    Tambah
                                    Pencegahan IDO</a>
                            @endif
                        </div>
                        <div class="card">
                            <table class="table">
                                <thead>
                                    <tr class="text-nowrap bg-dark">
                                        <th>No</th>
                                        <th>Petugas / Dokter</th>
                                        <th>Ruangan</th>
                                        <th>Jenis HAIs</th>
                                        <th>Tanggal</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $hais)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $hais->user->name }}</td>
                                            <td>{{ $hais->roomDetail->name }}</td>
                                            <td>{{ $hais->jenis }}</td>
                                            @php
                                                $formatId = Carbon\Carbon::parse($hais->tanggal);
                                            @endphp
                                            <td>{{ $formatId->isoformat('D MMM Y') }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    @if ($hais->jenis == 'Infeksi Saluran Kemih')
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" target="_blank"
                                                                href="{{ route('hais/isk.show', $hais->id) }}">
                                                                <i class='bx bx-show-alt me-1'></i>
                                                                Show
                                                            </a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('hais/isk.edit', $hais->id) }}">
                                                                <i class='bx bx-edit-alt me-1'></i>
                                                                Edit
                                                            </a>
                                                            <form action="{{ route('hais/isk.destroy', $hais->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item"
                                                                    onclick="return confirm('Yakin ingin menghapus data?')"><i
                                                                        class="bx bx-trash me-1"></i>Hapus</button>
                                                            </form>
                                                        </div>
                                                    @elseif ($hais->jenis == 'Infeksi Aliran Darah')
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" target="_blank"
                                                                href="{{ route('hais/iad.show', $hais->id) }}">
                                                                <i class='bx bx-show-alt me-1'></i>
                                                                Show
                                                            </a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('hais/iad.edit', $hais->id) }}">
                                                                <i class='bx bx-edit-alt me-1'></i>
                                                                Edit
                                                            </a>
                                                            <form action="{{ route('hais/iad.destroy', $hais->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item"
                                                                    onclick="return confirm('Yakin ingin menghapus data?')"><i
                                                                        class="bx bx-trash me-1"></i>Hapus</button>
                                                            </form>
                                                        </div>
                                                    @elseif ($hais->jenis == 'Infeksi Daerah Operasi')
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" target="_blank"
                                                                href="{{ route('hais/ido.show', $hais->id) }}">
                                                                <i class='bx bx-show-alt me-1'></i>
                                                                Show
                                                            </a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('hais/ido.edit', $hais->id) }}">
                                                                <i class='bx bx-edit-alt me-1'></i>
                                                                Edit
                                                            </a>
                                                            <form action="{{ route('hais/ido.destroy', $hais->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item"
                                                                    onclick="return confirm('Yakin ingin menghapus data?')"><i
                                                                        class="bx bx-trash me-1"></i>Hapus</button>
                                                            </form>
                                                        </div>
                                                    @endif
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
        {{-- end HAIs --}}
    </div>
@endsection
