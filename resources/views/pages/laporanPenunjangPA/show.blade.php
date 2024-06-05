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
                        <th>Tanggal Permintaan</th>
                        <th>Diminta Oleh</th>
                        <th>No Sediaan</th>
                        <th>Diagnosa Klinik</th>
                        <th>Keterangan Klinik</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $item->created_at->format('Y/m/d') ?? '' }}</td>
                            <td>{{ $item->user->name ?? '' }}</td>
                            <td>{{ $item->no_sediaan ?? '' }}</td>
                            <td>{!! $item->diagnosisKlinik ?? '' !!}</td>
                            <td>{!! $item->keteranganKlinik ?? '' !!}</td>
                            <td class="d-flex justify-content-center">
                                <button class="btn btn-sm btn-info toggle-details mx-2">Details</button>
                                <a href="{{ route('laporan/lab/patologi/anatomi.exportExcel', $item->id) }}" class="btn btn-sm btn-success"><i class="bx bxs-file-export"></i> Export</a>
                            </td>
                        </tr>
                        <tr class="details-row">
                            <td colspan="6">
                                <div class="details-content">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="text-nowrap bg-secondary">
                                                <th class="text-center">Tanggal Periksa</th>
                                                <th class="text-center">Jenis Pemeriksaan</th>
                                                {{-- <th class="text-center">Petugas</th> --}}
                                                <th class="text-center">Kategori</th>
                                                <th class="text-center">No Pendaftaran</th>
                                                <th class="text-center">Pemeriksaan</th>
                                                <th class="text-center">Bacaan</th>
                                                <th class="text-center">Diagnosis</th>
                                                <th class="text-center">Kesan</th>
                                                <th class="text-center">Dokter PA</th>
                                                <th class="text-center">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($item->antrianLaboratoriumPatologiAnatomiPatient->detailAntrianLaboratoriumPatologiAnatomiPatient as $detail) 
                                                <tr>
                                                    @php
                                                        $status = $detail->name;
                                                        $splitStatus = explode(' - ', $status);
                                                        $category = end($splitStatus);
                                                    @endphp
                                                    <td class="text-center">{{ $item->antrianLaboratoriumPatologiAnatomiPatient->tgl_diperiksa ?? '' }}</td>
                                                    <td class="text-center">{{ $splitStatus[0] ?? '' }}</td>
                                                    {{-- <td class="text-center">{{ $item->user->name ?? '' }}</td> --}}
                                                    <td class="text-center">{{ $category ?? '' }}</td>
                                                    <td class="text-center">{{ $category == 'HISTOPATOLOGI' ? $detail->hasilHistopatologiPatient->no_pend ?? '' : $detail->hasilSitopatologiPatient->no_pend ?? '' }}</td>
                                                    <td class="text-center">{{ $category == 'HISTOPATOLOGI' ? $detail->hasilHistopatologiPatient->pemeriksaan ?? '' : $detail->hasilSitopatologiPatient->pemeriksaan ?? '' }}</td>
                                                    @if ($category == 'HISTOPATOLOGI')
                                                        <td class="text-center">
                                                            <b>Makroskopik :</b> <br> 
                                                            {!! $detail->hasilHistopatologiPatient->makroskopik ?? '' !!}
                                                            <br><b>Mikroskopik :</b> <br> 
                                                            {!! $detail->hasilHistopatologiPatient->mikroskopik ?? '' !!}
                                                        </td>
                                                    @else
                                                        <td class="text-center">
                                                            {!! $detail->hasilSitopatologiPatient->bacaan ?? '' !!}
                                                        </td>
                                                    @endif
                                                    <td class="text-center">{!! $category == 'HISTOPATOLOGI' ? $detail->hasilHistopatologiPatient->diagnosis ?? '' : $detail->hasilSitopatologiPatient->diagnosis ?? '' !!}</td>
                                                    <td class="text-center">{!! $category == 'HISTOPATOLOGI' ? $detail->hasilHistopatologiPatient->kesan ?? '' : $detail->hasilSitopatologiPatient->kesan ?? '' !!}</td>
                                                    <td class="text-center">{{ $category == 'HISTOPATOLOGI' ? $detail->hasilHistopatologiPatient->dokterpa ?? '' : $detail->hasilSitopatologiPatient->dokterpa ?? '' }}</td>
                                                    <td class="text-center">{{ $detail->status ?? '' }}</td>
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
