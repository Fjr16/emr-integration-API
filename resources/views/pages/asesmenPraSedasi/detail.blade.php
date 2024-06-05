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
    {{-- <div class="d-flex justify-content-end mb-3 mt-0">
        @can(['finish pasien poli', 'show pasien poli'])
            <form action="" method="POST"
                onsubmit="return confirm('Sebelum melanjutkan, Pastikan data telah diisi dengan benar dan lengkap !!!. Apakah anda yakin untuk melanjutkan ? ')">
                @method('PUT')
                @csrf
                <input type="hidden" name="title" value="{{ $title }}">
                <button type="submit" class="btn btn-success btn-sm" name="status" value="SELESAI">Selesai</button>
            </form>
        @endcan
    </div> --}}

    {{-- nav tab --}}
    <div class="card">
        <div class="card-header">
            <h4 class="m-0">{{ $title }} -- {{ $item->queue->patient->name }} <span><a
                        href="{{ route('assesmen/pra/sedasi.create', $item->id) }}"
                        class="btn mx-2 btn-sm btn-primary">+</a></span></h4>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr class="text-nowrap bg-dark">
                        <th>No</th>
                        <th>Perawat / Inisial</th>
                        <th>Tanggal Pemeriksaan</th>
                        <th>Dokter Bedah</th>
                        <th>Dokter Anestesi</th>
                        <th>Anamnesa</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</th>
                            <td>{{ $d->user->name }}</td>
                            @php
                                $formatId = Carbon\Carbon::parse($d->tanggal_pemeriksaan);
                            @endphp
                            <td>{{ $formatId->isoformat('D MMM Y') }}</td>
                            <td>{{ $d->dokter_bedah }}</td>
                            <td>{{ $d->dokter_anestesi }}</td>
                            <td>{{ $d->anamnesa }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        {{-- <a class="dropdown-item"
                                            href="{{ route('assesmen/monitoring/resiko/jatuh.show', $d->id) }}"
                                            target="_blank">
                                            <i class="bx bx-printer me-1"></i>
                                            Print
                                        </a> --}}
                                        <a class="dropdown-item" href="{{ route('assesmen/pra/sedasi.edit', $d->id) }}">
                                            <i class="bx bx-edit-alt me-1"></i>
                                            Edit
                                        </a>
                                        <form action="{{ route('assesmen/pra/sedasi.destroy', $d->id) }}" method="POST">
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

    {{-- /nav tab --}}
@endsection
