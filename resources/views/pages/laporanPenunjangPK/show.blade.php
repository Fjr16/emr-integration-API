@extends('layouts.backend.main')

@section('content')
    <div class="card p-3 mt-5">
        <div class="row">
            <div class="col-md-9">
                <h4 class="align-self-center m-0">
                    Riwayat Pemeriksaan Laboratorium Patologi Klinik
                    <span class="text-primary">{{ $item->name ?? '' }} / {{ implode('-', str_split(str_pad($item->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}</span>
                </h4>
            </div>
        </div>
        <hr class="m-0 mt-2 mb-3">
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr class="text-nowrap bg-dark">
                        <th>Tanggal Permintaan</th>
                        <th>Petugas Laboratorium</th>
                        <th>No. Reg Labor</th>
                        <th>Diagnosa Klinis</th>
                        <th>Tanggal Periksa</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $item->laboratoriumRequest->created_at->format('Y-m-d') ?? '' }}</td>
                            <td>{{ $item->user->name ?? '' }}</td>
                            <td>{{ $item->nomor_reg_lab ?? '' }}</td>
                            <td>{!! $item->laboratoriumRequest->diagnosa ?? '' !!}</td>
                            <td>{{ $item->tanggal_periksa ?? '' }}</td>
                            <td class="d-flex justify-content-center">
                                <button class="btn btn-sm btn-info toggle-details mx-2">Details</button>
                                <a href="{{ route('laporan/lab/patologi/klinik.exportExcel', $item->id) }}" class="btn btn-sm btn-success"><i class="bx bxs-file-export"></i> Export</a>
                            </td>
                        </tr>
                        <tr class="details-row">
                            <td colspan="6">
                                <div class="details-content">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="text-nowrap bg-secondary">
                                                <th colspan="3" class="text-center">Nama Pemeriksaan</th>
                                                <th class="text-center">Hasil Nilai</th>
                                                <th class="text-center">Kondisi Kritis</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($item->laboratoriumPatientResultDetails as $detail) 
                                                <tr>
                                                    <td colspan="3" class="text-center">{{ $detail->laboratoriumRequestMasterVariable->name ?? '' }}</td>
                                                    <td class="text-center">{{ $detail->value ?? '' }}</td>
                                                    <td class="text-center">
                                                        <i class="{{ $detail->kondisi_kritis == true ? 'bx bxs-check-square text-success' : 'bx bxs-x-square text-danger' }} fs-2"></i>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
