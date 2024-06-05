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


        {{-- Menu CPPT Ranap --}}
        <div class="card-body">
            <div class="nav-align-top mb-4 shadow-sm">
                <ul class="nav nav-tabs nav-sm nav-fill" role="tablist">
                    <li class="nav-item">
                        <button id="btn-link" type="button" {{-- @dd(session()->all()) --}}
                            class="nav-link {{ session('btn') == 'cppt' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-cppt"
                            aria-controls="navs-justified-cppt" aria-selected="true">
                            <i class="tf-icons bx bx-bookmark-alt-plus"></i>
                            <p class="m-0">Cppt Ranap</p>
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade {{ session('btn') == 'cppt' ? 'show active' : '' }}" id="navs-justified-cppt"
                        role="tabpanel">
                        <div class="row">
                            <div class="col-sm-4">
                                @if (auth()->user()->id == $item->ranapDpjpPatientDetails->where('status', true)->first()->user_id)
                                    <div class="text-start mb-3">
                                        <a href="{{ route('ranap/alih/rawat.create', $item->id) }}"
                                            class="btn btn-dark btn-sm"><i class='bx bx-move'></i> Alih Rawat</a>
                                    </div>
                                @endif
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
                                        <a class="btn btn-success btn-sm"
                                            href="{{ route('ranap/cppt.create', $item->id) }}">+Tambah
                                            CPPT</a>
                                    @endcan
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="card">
                                    <table class="table">
                                        <thead>
                                            <tr class="text-nowrap bg-dark">
                                                <th>No</th>
                                                <th>PPA (Profesional Pemberi Asuhan)</th>
                                                <th>Tanggal / Jam</th>
                                                @canany(['edit cppt', 'delete cppt'])
                                                    <th>Action</th>
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
                                                        'catatan pelayanan pt
                                                        form ranap delete',
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
                </div>
            </div>
        </div>
        {{-- end Menu CPPT Ranap --}}
    </div>
@endsection
