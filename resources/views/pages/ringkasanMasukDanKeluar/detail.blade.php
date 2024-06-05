@extends('layouts.backend.main')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="card p-3 mt-5">

        <div class="d-flex">
            <h4 class="align-self-center m-0">Ringkasan Masuk Dan Keluar</h4>
            <a href="{{ route('ringkasan-masuk-keluar.create', $item->id) }}" class="btn btn-dark btn-sm m-0 mx-3">+</a>
        </div>
        <hr class="m-0 mt-2 mb-3">
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr class="text-nowrap bg-dark">
                        <th>No</th>
                        <th>Pasien</th>
                        <th>Tgl-Jam Masuk</th>
                        <th>Tgl-Jam Keluar</th>
                        <th>Tahun Kunjungan</th>
                        <th>Ruang Rawat</th>
                        <th>Agama</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            @php
                                $tgl_masuk = Carbon\Carbon::parse($item->tanggal_masuk)->isoformat('D MMM Y');
                                $jam_masuk = Carbon\Carbon::parse($item->jam_masuk)->format('H:i');
                                $tgl_keluar = Carbon\Carbon::parse($item->tanggal_keluar)->isoformat('D MMM Y');
                                $jam_keluar = Carbon\Carbon::parse($item->jam_keluar)->format('H:i');
                                if ($item->tanggal_masuk == null) {
                                    $tgl_masuk = '-';
                                }
                                if ($item->jam_masuk == null) {
                                    $jam_masuk = '-';
                                }
                                if ($item->tanggal_keluar == null) {
                                    $tgl_keluar = '-';
                                }
                                if ($item->jam_keluar == null) {
                                    $jam_keluar = '-';
                                }
                            @endphp
                            <td>{{ $loop->iteration }}</th>
                            <td>{{ $item->patient->name }}</td>
                            <td>{{ $tgl_masuk . ' / ' . $jam_masuk }}</td>
                            <td>{{ $tgl_keluar . ' / ' . $jam_keluar }}</td>
                            <td>{{ $item->tahun_kunjungan }}</td>
                            <td>{{ $item->ruang_rawat }}</td>
                            <td>{{ $item->agama }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item"
                                            href="{{ route('ringkasan-masuk-keluar.show', $item->id) }}" target="_blank">
                                            <i class="bx bx-printer me-1"></i>
                                            Print
                                        </a>
                                        <a class="dropdown-item"
                                            href="{{ route('ringkasan-masuk-keluar.edit', $item->id) }}">
                                            <i class="bx bx-edit-alt me-1"></i>
                                            Edit
                                        </a>
                                        <form action="{{ route('ringkasan-masuk-keluar.destroy', $item->id) }}"
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
@endsection
