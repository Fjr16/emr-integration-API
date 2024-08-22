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
                            <th>Penjamin</th>
                            <th>Diagnosa Utama</th>
                            <th>ICD 9</th>
                            <th>Satu Sehat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td class="text-center">
                                    <div class="btn-group dropend">
                                        <button type="button" class="btn btn-dark btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class='bx bx-pulse me-2'></i>Action
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li> <a class="dropdown-item" href="{{ route('bridging/data/satusehat.show', encrypt($item->id)) }}">Detail</a> </li>
                                            <li> <a class="dropdown-item" href="{{ route('bridging/data/satusehat.post', encrypt($item->id)) }}">Kirim Data</a> </li>
                                        </ul>
                                    </div>
                                </td>
                                <td>{{ $item->no_antrian ?? '-' }}</td>
                                <td>{{ ($item->patient->name ?? '') . '/' . ($item->patient->no_rm ?? '') }}</td>
                                <td>{{ $item->dpjp->poliklinik->name ?? '' }}</td>
                                <td>{{ $item->patientCategory->name ?? '-' }}</td>
                                <td>
                                    @if ($item->diagnosticProcedurePatient && !$item->diagnosticProcedurePatient->desc_diagnosa_primer && $item->diagnosticProcedurePatient->diagnostic_id)
                                        {{ '['. $item->diagnosticProcedurePatient->diagnostic->icd_x_code . '] ' . $item->diagnosticProcedurePatient->diagnostic->name }}
                                    @else
                                        <span class="badge bg-danger"><i class="bx bx-x"></i></span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->diagnosticProcedurePatient && $item->diagnosticProcedurePatient->procedure_id && !$item->diagnosticProcedurePatient->desc_prosedure)     
                                        {{ '['. $item->diagnosticProcedurePatient->procedure->icd_ix_code . '] ' . $item->diagnosticProcedurePatient->procedure->name }}
                                    @else
                                        <span class="badge bg-danger"><i class="bx bx-x"></i></span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->stts_satu_sehat == 'FINISHED')
                                        <span class="badge bg-success">SUDAH DIKIRIM</span>
                                    @elseif ($item->stts_satu_sehat == 'WAITING')
                                        <span class="badge bg-warning">BELUM DIKIRIM</span>
                                    @else
                                        <span class="badge bg-danger">TIDAK DIKETAHUI</span>
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
