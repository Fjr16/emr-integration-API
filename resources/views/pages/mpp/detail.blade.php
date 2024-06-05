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
                        href="{{ route('evaluasi/awal/MPP.create', $item->id) }}"
                        class="btn mx-2 btn-sm btn-primary">+</a></span>
            </h4>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr class="text-nowrap bg-dark">
                        <th>No</th>
                        <th>Tanggal Masuk </th>
                        <th>Tanggal Keluar </th>
                        <th>Ruangan</th>
                        <th>Kelas Rawatan</th>
                        <th>Tindakan</th>
                        <th>Diangnosa</th>
                        <th>Total Skor Major</th>
                        <th>Total Skor Minor</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</th>
                            <td>{{ $d->tanggal_masuk }}</td>
                            <td>{{ $d->tanggal_keluar }}</td>
                            <td>{{ $d->roomDetail->name ?? '' }}</td>
                            <td>{{ $d->kelas_rawatan }}</td>
                            <td>{{ $d->tindakan }}</td>
                            <td>{{ $d->diagnosa }}</td>
                            <td>{{ $d->total_skor_major }}</td>
                            <td>{{ $d->total_skor_minor }}</td>


                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        {{-- <a class="dropdown-item" href="{{ route('laporan/anestesi.show', $d->id) }}"
                                            target="_blank">
                                            <i class="bx bx-printer me-1"></i>
                                            Print
                                        </a> --}}
                                        <a class="dropdown-item" href="{{ route('evaluasi/awal/MPP.edit', $d->id) }}">
                                            <i class="bx bx-edit-alt me-1"></i>
                                            Edit
                                        </a>
                                        <form action="{{ route('evaluasi/awal/MPP.destroy', $d->id) }}" method="POST">
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
