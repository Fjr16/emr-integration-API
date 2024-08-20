@extends('layouts.backend.main')

@section('content')
@if (session()->has('success'))
<div class="alert alert-success d-flex" role="alert">
    <span class="alert-icon rounded-circle"><i class='bx bxs-check-circle' style="font-size: 40px"></i></span>
    <div class="d-flex flex-column ps-1">
        <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">BERHASIL !!</h6>
        <span>{{ session('success') }}</span>
    </div>
</div>
@endif
@if (session()->has('error'))
<div class="alert alert-danger d-flex" role="alert">
    <span class="alert-icon rounded-circle"><i class='bx bxs-x-circle' style="font-size: 40px"></i></span>
    <div class="d-flex flex-column ps-1">
        <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">ERROR !!</h6>
        <span>{{ session('error') }}</span>
    </div>
</div>
@endif
@if (session()->has('exceptions'))
<div class="alert alert-danger d-flex" role="alert">
<span class="alert-icon rounded-circle"><i class='bx bxs-x-circle' style="font-size: 40px"></i></span>
<div class="d-flex flex-column ps-1">
    <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">ERROR !!</h6>
    <span>
    @foreach (session('exceptions') as $error)
        <li>{{ $error }}</li>
    @endforeach
    </span>
</div>
</div>
@endif
@if ($errors->any())
<div class="alert alert-danger d-flex" role="alert">
<span class="alert-icon rounded-circle"><i class='bx bxs-x-circle' style="font-size: 40px"></i></span>
<div class="d-flex flex-column ps-1">
    <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">ERROR !!</h6>
    <span>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
    </span>
</div>
</div>
@endif
    <div class="card p-3 pb-0 mt-5">
        <div class="card-header">
            <div class="row">
                <h4 class="align-self-center m-0">
                    Daftar Rawatan Pasien
                </h4>
                <h6 class="mb-0">Belum Verifikasi</h6>
            </div>
        </div>
        <hr class="m-0">
        <div class="card-body">
            <div class="table-responsive text-wrap py-4">
                <table id="Field1NoOrder" class="table">
                    <thead>
                        <tr class="text-nowrap bg-dark">
                            <th class="text-center">Action</th>
                            <th>No Antrian</th>
                            <th>Nama / No. RM</th>
                            <th>Poliklinik</th>
                            {{-- <th>Penjamin</th> --}}
                            <th>Tanggal Kunjungan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-primary me-1" href="{{ route('verifikasi/data/pasien.showVerif', encrypt($item->id)) }}"><i class="bx bx-search me-1"></i> Detail</a>
                                </td>
                                <td>{{ $item->no_antrian ?? '-' }}</td>
                                <td>{{ ($item->patient->name ?? '') . '/' . ($item->patient->no_rm ?? '') }}</td>
                                <td>{{ $item->dpjp->poliklinik->name ?? '' }}</td>
                                {{-- <td>{{ $item->patientCategory->name ?? '-' }}</td> --}}
                                <td>{{ Carbon\Carbon::parse(strtotime($item->tgl_antrian))->format('d F Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="openModal" data-bs-backdrop="static" tabindex="-1">

    </div>

@endsection
