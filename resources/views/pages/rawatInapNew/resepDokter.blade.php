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


        {{-- Resep Dokter --}}
        <div class="card-body">
            <div class="nav-align-top mb-4 shadow-sm">
                <ul class="nav nav-tabs nav-sm nav-fill" role="tablist">
                    <li class="nav-item">
                        <button id="btn-link" type="button" {{-- @dd(session()->all()) --}}
                            class="nav-link {{ session('btn') == 'Resep Dokter' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-resep-dokter"
                            aria-controls="navs-justified-resep-dokter" aria-selected="true">
                            <i class="tf-icons bx bx-bookmark-alt-plus"></i>
                            <p class="m-0">Resep Dokter</p>
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade {{ session('btn') == 'Resep Dokter' ? 'show active' : '' }}"
                        id="navs-justified-resep-dokter" role="tabpanel">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-md-10">
                                        <h5 class="align-self-center m-0">
                                            Resep Obat
                                            <span
                                                class="text text-primary text-uppercase fw-bold fs-7">{{ $item->queue->patient->name ?? '' }}</span>
                                        </h5>
                                    </div>
                                    <div class="col-md-2 text-end">
                                        <a class="btn btn-success btn-sm text-white"
                                            href="{{ route('ranap/resep/dokter.create', $item->id) }}"><i
                                                class="bx bx-plus"></i>Tambah
                                            Resep Dokter</a>
                                    </div>
                                </div>
                                <hr class="m-0 mt-2 mb-3">
                                <div class="card">
                                    <table id="example" class="table">
                                        <thead>
                                            <tr class="text-nowrap bg-dark">
                                                <th>No</th>
                                                <th>Nama User</th>
                                                <th>Tanggal</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($item->ranapMedicineReceipts as $mr)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $mr->user->name ?? '-' }}</td>
                                                    <td>{{ $mr->created_at->format('Y-m-d') ?? '-' }}</td>
                                                    <td>

                                                        <div class="dropdown">
                                                            <button type="button"
                                                                class="btn p-0 dropdown-toggle hide-arrow"
                                                                data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>

                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item"
                                                                    href="{{ route('ranap/resep/dokter.edit', $mr->id) }}">
                                                                    <i class="bx bx-plus"></i>
                                                                    Edit
                                                                </a>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('ranap/resep/dokter.show', $mr->id) }}"
                                                                    target="_blank">
                                                                    <i class="bx bx-printer"></i>
                                                                    Print
                                                                </a>
                                                                <form
                                                                    action="{{ route('ranap/resep/dokter.destroy', $mr->id) }}"
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
                </div>
            </div>
        </div>
        {{-- end Resep Dokter --}}
    </div>
@endsection
