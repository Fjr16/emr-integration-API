@extends('layouts.backend.main')

@section('content')
    <div class="card p-3 mt-5">
        <div class="row">
            <div class="col-md-9">
                <h4 class="align-self-center m-0">
                    Riwayat Pemeriksaan Radiologi
                    <span class="text-primary">{{ $item->name ?? '' }} / {{ implode('-', str_split(str_pad($item->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}</span>
                </h4>
            </div>
        </div>
        <hr class="m-0 mt-2 mb-3">
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr class="text-nowrap bg-dark">
                        <th>Tanggal</th>
                        <th>Divalidasi Oleh</th>
                        <th>Diagnosa Klinis</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $item->tanggal_periksa ?? '' }}</td>
                            <td>{{ $item->user->name ?? '' }}</td>
                            <td>{!! $item->radiologiFormRequest->diagnosa_klinis ?? '' !!}</td>
                            <td>{{ $item->status ?? '' }}</td>
                            <td class="d-flex justify-content-center">
                                <button class="btn btn-sm btn-info toggle-details mx-2">Details</button>
                                <a href="{{ route('laporan/lab/radiologi.exportExcel', $item->id) }}" class="btn btn-sm btn-success"><i class="bx bxs-file-export"></i> Export</a>
                            </td>
                        </tr>
                        <tr class="details-row">
                            <td colspan="6">
                                <div class="details-content">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="text-nowrap bg-secondary">
                                                <th class="text-center">Tanggal Periksa</th>
                                                <th class="text-center">No Reg</th>
                                                <th class="text-center">Petugas Radiologi</th>
                                                <th class="text-center">Nama Pemeriksaan</th>
                                                <th class="text-center">Keterangan</th>
                                                <th class="text-center">Image</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($item->radiologiPatientRequestDetails as $detail) 
                                                <tr>
                                                    <td class="text-center">{{ $detail->tanggal ?? '' }}</td>
                                                    <td class="text-center">{{ $detail->nomor ?? '' }}</td>
                                                    <td class="text-center">{{ $detail->user->name ?? '' }}</td>
                                                    <td class="text-center">{{ $detail->radiologiFormRequestDetail->radiologiFormRequestMaster->name ?? '' }} <b>{{ $detail->radiologiFormRequestDetail->radiologiFormRequestMasterDetail->name ?? '' }} {{ $detail->radiologiFormRequestDetail->value ?? '' }}</b></td>
                                                    <td class="text-center">{{ $detail->hasil ?? 'Tidak Ada' }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ Storage::url($detail->image) }}" target="_blank">
                                                            <img src="{{ Storage::url($detail->image) }}" height="100px"></img>
                                                        </a>
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
