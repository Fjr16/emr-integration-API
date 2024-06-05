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

    {{-- nav tab --}}
    <div class="nav-align-top mb-4">
        {{-- V1 --}}
        <ul class="nav nav-tabs nav-sm nav-fill" role="tablist">
            <li class="nav-item">
                <button id="btn-link" type="button" {{-- @dd(session()->all()) --}}
                    class="nav-link active {{ session('btn') == 'dashboard' ? 'active' : '' }} d-flex justify-content-center"
                    role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-dashboard"
                    aria-controls="navs-justified-dashboard" aria-selected="true">
                    <i class="tf-icons bx bx-grid-alt"></i>
                    <p class="m-0">Dashboard</p>
                </button>
            </li>

        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active {{ session('btn') == 'dashboard' ? 'show active' : '' }}"
                id="navs-justified-dashboard" role="tabpanel">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="d-flex">
                            {{-- <h6 class="m-0 mt-1">{{ $item->queue->patient->name }}
                                ({{ implode('-', str_split(str_pad($item->queue->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }})
                            </h6> --}}
                        </div>
                        <hr class="p-0 mt-2">
                        <table class="w-100">
                            {{-- <tbody>
                                <tr>
                                    <td style="min-width: 150px">Tanggungan</td>
                                    <td style="min-width: 30px">:</td>
                                    <td>{{ $item->queue->patientCategory->name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td style="min-width: 150px">Jenis Kelamin</td>
                                    <td style="min-width: 30px">:</td>
                                    <td>{{ $item->queue->patient->jenis_kelamin ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Lahir</td>
                                    <td>:</td>
                                    <td>{{ $item->queue->patient->tanggal_lhr ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>Usia</td>
                                    <td>:</td>
                                    <td>{{ $usia ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>Telepon</td>
                                    <td>:</td>
                                    <td>{{ $item->queue->patient->telp ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td>{{ $item->queue->patient->alamat ?? '' }}</td>
                                </tr>
                            </tbody> --}}
                        </table>
                        <hr class="p-0 mt-2">
                        <h6>Dokter Penanggung Jawab (DPJP)</h6>
                        <table class="table">
                            <thead>
                                <tr class="text-nowrap">
                                    <th class="text-body">nama</th>
                                    <th class="text-body">kode</th>
                                    <th class="text-body">dari</th>
                                    <th class="text-body">sampai</th>
                                    <th class="text-body">status</th>
                                </tr>
                            </thead>
                            {{-- <tbody>
                                @foreach ($item->ranapDpjpPatientDetails as $index => $dpjp)
                                    <tr>
                                        <td>{{ $dpjp->user->name ?? '' }}</td>
                                        <td>{{ $dpjp->user->staff_id ?? '' }}</td>
                                        @if ($loop->first)
                                            <td>{{ (new DateTime($dpjp->start))->format('d M Y') }}</td>
                                        @else
                                            <td>{{ (new DateTime($item->ranapDpjpPatientDetails[$index - 1]->end))->format('d M Y') }}
                                            </td>
                                        @endif
                                        <td>{{ $dpjp->end ? (new DateTime($dpjp->end))->format('d M Y') : 'Sekarang' }}
                                        </td>
                                        <td>{{ $dpjp->status ? 'Aktif' : 'Tidak Aktif' }}</td>
                                    </tr>
                                @endforeach
                            </tbody> --}}
                        </table>
                    </div>
                    <div class="col-sm-7">
                        <h6>Surat Pengantar Rawat</h6>
                        <div class="card">
                            <table class="table">
                                <thead>
                                    <tr class="text-nowrap">
                                        <th class="text-body">Nama Pasien</th>
                                        <th class="text-body">Diagnosa Primer</th>
                                        <th class="text-body">Diagnosa Sekunder</th>
                                        <th class="text-body">Ruangan</th>
                                        <th class="text-body">Action</th>
                                    </tr>
                                </thead>
                                {{-- <tbody>
                                    <tr>
                                        <td>{{ $item->queue->suratPengantarRawatJalanPatient->queue->patient->name ?? '' }}
                                        </td>
                                        <td>{{ $item->queue->suratPengantarRawatJalanPatient->primer ?? '' }}</td>
                                        <td>
                                            @foreach ($item->queue->suratPengantarRawatJalanPatient->sekunderSuratPengantarRawatJalanPatients as $sekunder)
                                                {{ $sekunder->name ?? '' }},
                                            @endforeach
                                        </td>
                                        <td>{{ $item->queue->suratPengantarRawatJalanPatient->ruangan ?? '' }}</td>
                                        <td>
                                            <a class="btn btn-dark btn-sm" href="/show-surat-pengantar">
                                                <i class='bx bx-show-alt'></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody> --}}
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    {{-- /nav tab --}}
@endsection
