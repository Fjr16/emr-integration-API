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
            <form action="{{ $routeToFilter }}" method="GET">
                <div class="row">
                    <div class="col-8">
                        <h4 class="align-self-center m-0">
                            Daftar Pasien
                            @if ($user->hasRole('Dokter'))
                                Dokter
                                {{ Auth::user()->name }} ({{ Auth::user()->staff_id }})
                            @endif
                        </h4>
                    </div>
                    <div class="col-3">
                        <div class="row">
                            <label class="col-form-label col-3"></label>
                            <div class="col-9">
                                <input type="date" id="tanggal" name="filter" value="{{ request('filter', date('Y-m-d')) }}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-1">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>
            <div class="col-12">
                <h5 class="text text-primary text-uppercase fw-bold fs-7 d-flex">Rawat Jalan ({{ $filterDate->format('Y-m-d') ?? date('Y-m-d') }})</h5>
            </div>
        </div>
        <hr class="m-0">
        <div class="card-body">
            <div class="table-responsive text-wrap py-4">
                <table id="Field1NoOrder" class="table">
                    <thead>
                        <tr class="text-nowrap bg-dark">
                            {{-- @if ($user->hasRole(['Dokter', 'Perawat'])) --}}
                            <th class="text-center">Action</th>
                            {{-- @endif --}}
                            <th>No Antrian</th>
                            <th>No Rekam Medis</th>
                            <th>Nama</th>
                            <th>Tanggungan</th>
                            <th>Jenis Kelamin</th>
                            <th>Telp</th>
                            @if ($user->hasRole(['Perawat','Rekam Medis dan Casemix'] ))
                                <th>Poli / Dokter</th>
                            @endif
                            <th>Status Poli</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                {{-- @if ($user->hasRole(['Dokter', 'Perawat'])) --}}
                                <td class="text-center" style="width: 9%">
                                    <div class="btn-group dropend">
                                        <button type="button" class="btn btn-dark btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class='bx bx-pulse me-2'></i>Periksa
                                        </button>
                                        <ul class="dropdown-menu">
                                          <li> <a class="dropdown-item" href="{{ route('rajal/detail/pemeriksaan.show', encrypt($item->id)) }}">Riwayat Kunjungan</a> </li>
                                          <li>
                                            <hr class="dropdown-divider">
                                          </li>
                                          <li> <a class="dropdown-item" href="{{ route('asesmen/awal/perawat.create_step_one', encrypt($item->id)) }}">Perawat</a> </li>
                                          <li> <a class="dropdown-item" href="{{ route('rajal/show', ['id' => encrypt($item->id), 'title' => encrypt($title)]) }}">Dokter</a> </li>
                                        </ul>
                                    </div>
                                </td>
                                {{-- @endif --}}
                                <td>{{ $item->no_antrian ?? '-' }}</td>
                                <td>{{ $item->patient->no_rm ?? '' }}
                                </td>
                                <td>{{ $item->patient->name ?? '-' }}</td>
                                <td>{{ $item->patientCategory->name ?? '-' }}</td>
                                <td>{{ $item->patient->jenis_kelamin ?? '-' }}</td>
                                <td>{{ $item->patient->telp ?? '-' }}</td>
                                @if ($user->hasRole('Perawat|Rekam Medis dan Casemix'))
                                    <td>{{ $item->dpjp->poliklinik->name ?? '' }} / {{ $item->dpjp->name ?? '' }}</td>
                                @endif
                                <td>
                                    @if ($item->rawatJalanPoliPatient)     
                                        @if ($item->rawatJalanPoliPatient->status == 'WAITING')                                    
                                            <span class="badge bg-danger">BELUM DILAYANI</span>
                                        @elseif ($item->rawatJalanPoliPatient->status == 'ONGOING')
                                            <span class="badge bg-warning">DALAM PERAWATAN</span>
                                        @elseif ($item->rawatJalanPoliPatient->status == 'FINISHED')
                                            <span class="badge bg-success">SUDAH DILAYANI</span>
                                        @else
                                            <span class="badge bg-success">TIDAK DIKETAHUI</span>
                                        @endif
                                    @endif
                                </td>
                               
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
