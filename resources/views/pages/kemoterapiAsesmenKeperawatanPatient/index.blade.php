@extends('layouts.backend.main')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session()->has('forbidden'))
        <div class="alert alert-danger w-100 border mb-5 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('forbidden') }}
        </div>
    @endif
    <div class="card p-3 mt-5">
        <div class="row">
            <div class="col-md-9">
                <h4 class="align-self-center m-0">
                    Daftar Pasien
                    <span class="text text-primary text-uppercase fw-bold fs-7">Rawat Inap</span>
                </h4>
            </div>
        </div>
        <hr class="m-0 mt-2 mb-3">
        <div class="table-responsive text-nowrap">
            <table id="example" class="table">
                <thead>
                    <tr class="text-nowrap bg-dark">
                        <th>No Antrian</th>
                        <th>No Rekam Medis</th>
                        <th>Nama</th>
                        <th>Kategori Pasien</th>
                        <th>Jenis Kelamin</th>
                        <th>Telp</th>
                        <th>Alamat</th>
                        <th>Alergi Obat</th>
                        <th>Status Rawat Inap</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $item->no_antrian ?? '-' }}</td>
                            <td>{{ implode('-', str_split(str_pad($item->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}
                            </td>
                            <td>{{ $item->patient->name ?? '-' }}</td>
                            <td>{{ $item->patientCategory->name ?? '-' }}</td>
                            <td>{{ $item->patient->jenis_kelamin ?? '-' }}</td>
                            <td>{{ $item->patient->telp ?? '-' }}</td>
                            <td>{{ $item->patient->alamat ?? '-' }}</td>
                            <td>{!! $item->patient->alergi ?? '-' !!}</td>
                            <td>{{ $item->rawatInapPatient->status ?? '-' }}</td>
                            <td class="text-center">
                                <a class="btn btn-dark btn-sm"
                                    href="{{ route('ranap/assesmen/awal/keperawatan.detail', $item->rawatInapPatient->id) }}">
                                    <i class='bx bx-show-alt me-1'></i>
                                    Show
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
