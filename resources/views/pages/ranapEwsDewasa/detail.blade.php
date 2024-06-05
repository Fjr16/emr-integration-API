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
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="m-0">{{ $title }} -- {{ $item->queue->patient->name }}</h4>
                </div>
                <div class="col-sm-6 text-end">
                    <a href="{{ route('ews/dewasa.show', $item->id) }}" target="blank" class="btn btn-dark btn-sm"><i
                            class='bx bx-printer'></i></a>
                    <a href="{{ route('ews/dewasa.create', $item->id) }}" class="btn btn-success btn-sm"><i
                            class='bx bx-plus'></i> Tambah EWS Dewasa</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr class="text-nowrap bg-dark">
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Perawat Pengkaji</th>
                        <th>Total Skor</th>
                        <th>Kategori Skor</th>
                        <th>Tipe</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</th>
                                @php
                                    $formatId = Carbon\Carbon::parse($d->tanggal);
                                @endphp
                            <td>{{ $formatId->isoformat('D MMM Y') }}</td>
                            <td>{{ $d->nama_perawat }}</td>
                            <td>{{ $d->total_skor }}</td>
                            <td>{{ $d->kategori_skor }}</td>
                            <td>{{ $d->isPulang }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('ews/dewasa.edit', $d->id) }}">
                                            <i class="bx bx-edit-alt me-1"></i>
                                            Edit
                                        </a>
                                        <form action="{{ route('ews/dewasa.destroy', $d->id) }}" method="POST">
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
