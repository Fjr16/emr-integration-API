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
    <div class="card p-3 pb-0 mt-5">
        <div class="card-body">
            <div class="row">
                <div class="col-8">
                    <h4 class="align-self-center m-0">
                        Daftar Pasien
                        @if ($user->hasRole('Dokter Poli'))
                            Dokter
                            {{ Auth::user()->name }} ({{ Auth::user()->staff_id }})
                        @endif
                    </h4>
                </div>
                <div class="col-3">
                    <form action="{{ $routeToFilter }}" method="GET">
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
                    </form>
                </div>
                <div class="col-12">
                    <h5 class="text text-primary text-uppercase fw-bold fs-7 d-flex">Rawat Jalan ({{ $filterDate->format('Y-m-d') ?? date('Y-m-d') }})</h5>
                </div>
            </div>
        </div>
        <hr class="m-0 mt-2 mb-3">
        <div class="table-responsive text-wrap py-4">
            <table id="Field1NoOrder" class="table">
                <thead>
                    <tr class="text-nowrap bg-dark">
                        @if ($user->hasRole('Rekam Medis Rajal'))
                        <th>General Consent</th>
                        @endif
                        @can('show pasien poli')
                            <th class="text-center">Action</th>
                        @endcan
                        <th>No Antrian</th>
                        <th>No Rekam Medis</th>
                        <th>Nama</th>
                        <th>Tanggungan</th>
                        <th>Jenis Kelamin</th>
                        <th>Telp</th>
                        <th>Status Poli</th>
                        @if ($user->hasRole(['Perawat Rajal','Rekam Medis Rajal'] ))
                            <th>Poli / Dokter</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            @if ($user->hasRole('Rekam Medis Rajal'))
                                <td class="">
                                    @if ($item->rajalGeneralConsent)
                                      <div class="d-flex flex-row">
                                        <a class="btn btn-warning btn-sm" href="{{ route('rajal/general/consent.edit', $item->id) }}">
                                            <i class='bx bx-edit-alt me-1'></i>
                                        </a>
                                        <form action="{{ route('rajal/general/consent.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm mx-2"
                                                onclick="return confirm('Yakin ingin menghapus data?')"><i
                                                    class="bx bx-trash me-1"></i></button>
                                        </form>
                                        <div class="btn-group dropend">
                                            <button type="button" class="btn btn-dark btn-sm dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-printer"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('rajal/general/consent.show', $item->id ?? '') }}" target="_blank">
                                                    <i class='bx bx-printer me-1'></i>
                                                    General Consent
                                                </a>
                                            <a class="dropdown-item" href="{{ route('rajal/general/consent.showtatatertib', $item->id ?? '') }}" target="_blank">
                                                <i class='bx bx-printer me-1'></i>
                                                Tata Tertib
                                            </a>
                                            <a class="dropdown-item" href="{{ route('rajal/general/consent.showhakdankewajiban', $item->id) }}" target="_blank">
                                                <i class='bx bx-printer me-1'></i>
                                                Hak Dan Kewajiban
                                            </a>
                                            </div>
                                        </div>
                                      </div>
                                    @else
                                        <a class="btn btn-success btn-sm mx-2"
                                            href="{{ route('rajal/general/consent.create', $item->id) }}">
                                            <i class='bx bx-plus me-1'></i>
                                        </a>
                                    @endif
                                </td>
                            @endif
                            @can('show pasien poli')
                            <td class="text-center" style="width: 9%">
                                <div class="btn-group dropend">
                                    <button type="button" class="btn btn-dark btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class='bx bx-pulse me-2'></i>Periksa
                                    </button>
                                    <ul class="dropdown-menu">
                                      <li> <a class="dropdown-item" href="{{ route('rajal/show', ['id' => $item->id, 'title' => $title]) }}">Riwayat Kunjungan</a> </li>
                                      <li>
                                        <hr class="dropdown-divider">
                                      </li>
                                      <li> <a class="dropdown-item" href="{{ route('asesmen/awal/perawat.create_step_one', $item->id) }}">Perawat</a> </li>
                                      <li> <a class="dropdown-item" href="{{ route('rajal/show', ['id' => $item->id, 'title' => $title]) }}">Dokter</a> </li>
                                    </ul>
                                </div>
                            </td>
                            @endcan
                            <td>{{ $item->no_antrian ?? '-' }}</td>
                            <td>{{ implode('-', str_split(str_pad($item->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}
                            </td>
                            <td>{{ $item->patient->name ?? '-' }}</td>
                            <td>{{ $item->patientCategory->name ?? '-' }}</td>
                            <td>{{ $item->patient->jenis_kelamin ?? '-' }}</td>
                            <td>{{ $item->patient->telp ?? '-' }}</td>
                            <td>
                                @if ($item->rawatJalanPoliPatient->status == 'WAITING')                                    
                                    <span class="badge bg-danger">BELUM DILAYANI</span>
                                @elseif ($item->rawatJalanPoliPatient->status == 'ONGOING')
                                    <span class="badge bg-warning">DALAM PERAWATAN</span>
                                @elseif ($item->rawatJalanPoliPatient->status == 'FINISHED')
                                    <span class="badge bg-success">SUDAH DILAYANI</span>
                                @else
                                    <span class="badge bg-success">TIDAK DIKETAHUI</span>
                                @endif
                            </td>
                            @if ($user->hasRole('Perawat Rajal|Rekam Medis Rajal'))
                                <td>{{ $item->doctorPatient->user->roomDetail->name ?? '' }} / {{ $item->doctorPatient->user->name ?? '' }}</td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="openModal" data-bs-backdrop="static" tabindex="-1">

    </div>

@endsection
