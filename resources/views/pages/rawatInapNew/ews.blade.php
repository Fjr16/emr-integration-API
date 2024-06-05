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


        {{-- Menu EWS --}}
        <div class="card-body">
            <div class="nav-align-top mb-4 shadow-sm">
                <ul class="nav nav-tabs nav-sm nav-fill" role="tablist">
                    <li class="nav-item">
                        <button id="btn-link" type="button" {{-- @dd(session()->all()) --}}
                            class="nav-link {{ session('btn') == 'ews' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-ews"
                            aria-controls="navs-justified-ews" aria-selected="true">
                            <i class='tf-icons bx bx-alarm-exclamation'></i>
                            <p class="m-0">EWS</p>
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade {{ session('btn') == 'ews' ? 'show active' : '' }}" id="navs-justified-ews"
                        role="tabpanel">
                        <div class="text-end mb-3">
                            <a class="btn btn-success btn-sm" href="{{ route('ews/dewasa.create', $item->id) }}">+ Tambah EWS
                                Dewasa</a>
                            <a class="btn btn-success btn-sm" href="{{ route('ews/anak.create', $item->id) }}">+ Tambah EWS
                                Anak</a>
                        </div>
                        <div class="row">
                            <h6 class="m-0 mt-1 col-2">Ews Dewasa</h6>
                            <div class="col-1">
                                <a href="{{ route('ews/dewasa.show', $item->id) }}" class="btn btn-dark btn-sm"><i
                                class='bx bx-printer'></i></a>
                            </div>
                        </div>
                        <div class="card">
                            <table class="table">
                                <thead>
                                    <tr class="text-nowrap bg-dark">
                                        <th>No</th>
                                        <th>Petugas / Dokter</th>
                                        <th>Tanggal / Jam</th>
                                        <th>Jumlah Skor</th>
                                        <th>Action</th>
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
                                    <tr class="text-nowrap bg-dark">
                                        <th>No</th>
                                        <th>Petugas / Dokter</th>
                                        <th>Tanggal / Jam</th>
                                        <th>Jumlah Skor</th>
                                        <th>Action</th>
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
                </div>
            </div>
        </div>
        {{-- end Menu EWS --}}
    </div>
@endsection
