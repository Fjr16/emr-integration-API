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
                </h4>
            </div>
        </div>
        <hr class="m-0 mt-2 mb-3">
        <div class="table-responsive text-nowrap">
            <table id="example" class="table">
                <thead>
                    <tr class="text-nowrap bg-dark">
                        <th>No Rekam Medis</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Telp</th>
                        <th>Alamat</th>
                        <th>Alergi Obat</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ implode('-', str_split(str_pad($item->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}
                            </td>
                            <td>{{ $item->name ?? '-' }}</td>
                            <td>{{ $item->jenis_kelamin ?? '-' }}</td>
                            <td>{{ $item->telp ?? '-' }}</td>
                            <td>{{ $item->alamat ?? '-' }}</td>
                            <td>{!! $item->alergi ?? '-' !!}</td>
                            <td class="text-center">
                                <a class="btn btn-dark btn-sm"
                                    href="{{ route('laporan/lab/patologi/klinik.show', $item->id) }}">
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
