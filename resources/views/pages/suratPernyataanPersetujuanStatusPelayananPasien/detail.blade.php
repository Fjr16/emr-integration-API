@extends('layouts.backend.main')

@section('content')
@if (session()->has('success'))
<div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
    {{ session('success') }}
</div>
@endif
<div class="card p-3 mt-5">

    <div class="d-flex">
        <h4 class="align-self-center m-0">Surat Pernyataan Persetujuan Status Pelayanan Pasien
            {{ $item->queue->patient->name }}
        </h4>
        <a href="{{ route('surat/pernyataan/persetujuan/status/pelayanan.create', $item->id) }}" class="btn btn-dark btn-sm m-0 mx-3">+</a>
    </div>
    <hr class="m-0 mt-2 mb-3">
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr class="text-nowrap bg-dark">
                    <th>No</th>
                    <th>Pasien</th>
                    <th>Nama PJ</th>
                    <th>Alamat PJ</th>
                    <th>Kelas Rawatan</th>
                    <th>Tanggal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</th>
                    <td>{{ $item->patient->name }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>{{ $item->rawatInapPatient->queue->patientCategory->name }}</td>
                    <td>{{ Carbon\Carbon::parse($item->created_at)->isoformat('D MMM Y') }}</td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('surat/pernyataan/persetujuan/status/pelayanan.show', $item->id) }}" target="_blank">
                                    <i class="bx bx-printer me-1"></i>
                                    Print
                                </a>
                                <a class="dropdown-item" href="{{ route('surat/pernyataan/persetujuan/status/pelayanan.edit', $item->id) }}">
                                    <i class="bx bx-edit-alt me-1"></i>
                                    Edit
                                </a>
                                <form action="{{ route('surat/pernyataan/persetujuan/status/pelayanan.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item" onclick="return confirm('Yakin ingin menghapus data?')"><i class="bx bx-trash me-1"></i>Hapus</button>
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