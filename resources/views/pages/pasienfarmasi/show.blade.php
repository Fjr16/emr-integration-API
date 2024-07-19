@extends('layouts.backend.main')

@section('content')

    @if (session()->has('success'))
        <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger w-100 border mb-5 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('error') }}
        </div>
    @endif
    <style>
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #fafafa;
        }

        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .bg-gray {
            background-color: #d3d3d3
        }

        .page {
            /* height: 210mm; */
            height: auto;
            /* width: 297mm; */
            width: 210mm;
            min-height: 13.97cm;
            padding: 15mm;
            margin: 15mm auto;
            border: 1px #d3d3d3 solid;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .subpage {
            padding: 1cm;
            border: 5px red solid;
            height: 257mm;
            outline: 2cm #ffeaea solid;
        }

        /* td {
                padding-top: 5px;
            } */
        th {
            font-size: 10pt !important;
        }

        .borderhr {
            color: black;
            background-color: black;
            border-color: black;
            height: 5px;
            opacity: 100;
        }

        .header h1 {
            margin: 0;
            font-size: 20px;
            font-weight: bold;
        }

        .compact-table th,
        .compact-table td {
            padding: 2px 5px;
            /* Reduce padding */
            font-size: 10.5px;
            /* Smaller font size */
        }

        .compact-table th {
            /* white-space: nowrap; */
            /* Prevent header text from wrapping */
        }

        @page {
            size: A4;
            /* Specify A4 size */
            margin: 0;
            margin-top: 10mm;
            margin-bottom: 10mm;
        }

        @media print {

            *,
            *:before,
            *:after {
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }

            html,
            body {
                width: 210mm;
                height: 297mm;
            }

            .page {
                margin: 15mm;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
        }
    </style>
        {{-- Informasi Pasien --}}
        <div class="card mb-2">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <h4 class="mb-1 text-primary d-flex">
                            {{ $item->queue->patient->name }} ({{ implode('-', str_split(str_pad($item->queue->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }})
                            <span class="ms-2 badge {{ $item->queue->patient->jenis_kelamin == 'Wanita' ? 'bg-danger' : 'bg-info' }}">{{ $item->queue->patient->jenis_kelamin == 'Wanita' ? 'P' : 'L' }}</span> 
                        </h4>
                        <h6 class="mb-1">{{ $item->queue->dpjp->name }} ({{ $item->queue->dpjp->staff_id }})</h6>
                        <h6 class="mt-0 mb-1">{{ $item->queue->dpjp->roomDetail->name ?? '' }}<h6>
                        <span class="badge bg-info my-0">{{ $item->status == 'FINISHED' ? 'SUDAH DIAMBIL' : ($item->status == 'ONGOING' ? 'DITERIMA' : 'PERMINTAAN') }}</span>
                    </div>
                    <div class="col-8 text-end">
                        <p class="mb-0">No. Antrian : <span class="fst-italic fw-bold">{{ $item->queue->no_antrian ?? '' }}</span></p>
                        <p class="mb-0">Tanggungan : <span class="fw-bold fst-italic">{{ $item->queue->patientCategory->name }}</span></p>
                        <p class="mb-0">Tgl. Lahir : <span class="fw-bold fst-italic">{{ $item->queue->patient->tanggal_lhr }}</span></p>
                    </div>
                </div>
            </div>
        </div>
        {{-- end Informasi Pasien --}}
    <div class="row">
        <div class="accordion accordion-header-primary" id="form-tambah-obat">
            <div class="accordion-item card">
                <h2 class="accordion-header">
                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#form-tambah-obat-1" aria-expanded="false">
                    <i class="bx bx-book me-2"></i> Resep Dokter
                </button>
                </h2>
            
                <div id="form-tambah-obat-1" class="accordion-collapse collapse" data-bs-parent="#form-tambah-obat">
                <div class="accordion-body" id="form-input">
                    <div class="page">
                        <div class="header">
                            <div class="row justify-content-center">
                                <div class="col-8 text-center justify-content-center">
                                    <div class="d-flex flex-column">
                                        <span class="fw-bold fs-5">{{ $item->queue->dpjp->name ?? '....' }}</span>
                                        <hr class="my-0 border border-dark border-1">
                                        <span class="fw-bold">SIP : {{ $item->queue->dpjp->sip ?? '....' }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-6">
                                    <div class="d-flex flex-column">
                                        <span class="fw-bold">{{ $item->queue->patient->name ?? '....' }} / {{ implode('-', str_split(str_pad($item->queue->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) ?? '....' }}</span>
                                        @php
                                            $tanggalLahir = new DateTime($item->queue->patient->tanggal_lhr);
                                            $now = new DateTime();
                                            $ageDiff = $now->diff($tanggalLahir);
                                            $ageString = $ageDiff->format('%y tahun %m bulan');
                                        @endphp
                                        <span class="fw-bold">BB : {{ $item->queue->perawatInitialAssesment->bb ?? '...' }} kg</span>
                                        <span class="fw-bold">Usia : {{ $ageString ?? '....' }}</span>
                                    </div>
                                </div>
                                <div class="col-6 text-end">
                                    <div class="d-flex flex-column">
                                        <span class="fw-bold">R.S **F**F* **F***F** XYZ</span>
                                        <span>Jl. Air Tawar Barat Padang</span>
                                        <span>Telp. ***** - *****</span>
                                    </div>
                                </div>
                            </div>
                            <hr class="border border-dark border-3 opacity-100">
                        </div>
                
                        <div class="content mt-4">
                            <div class="row my-5">
                                @foreach ($item->queue->medicineReceipt->medicineReceiptDetails as $detail)
                                    <div class="col-12 mt-3">
                                        <div class="d-flex flex-row">
                                            <div class="d-flex align-items-center" style="min-width: 150px"><span class="fw-bold fs-4">R
                                                    / &nbsp;</span>
                                                <span class="fs-6">{{ $detail->medicine ? ($detail->medicine->name ?? '') : ($detail->nama_obat_custom ?? '') }}</span>
                                            </div>
                                            <div class="d-flex align-items-center ms-3">
                                                <span class="fw-bold fs-5">NO.
                                                    {{ $detail->jumlah ?? 0 }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 ps-4">
                                        <div class="d-flex flex-row">
                                            <span class="fs-1">S</span>
                                            <div class="d-flex flex-row align-items-center ms-1 pt-3">
                                                <div class="mx-2">{{ $detail->aturan_pakai ?? '' }}</div>
                                                <div class="">{{ $detail->other ?? '' }}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="col-sm-12 mt-3 mb-4">
                    <table class="table" id="example1">
                        <thead>
                            <tr class="text-nowrap bg-dark">
                                <th>#</th>
                                <th>Nama Obat</th>
                                <th>Aturan Pakai</th>
                                <th>Jumlah</th>
                                <th>Harga Satuan</th>
                                <th>Sub Total</th>
                            </tr>
                        </thead>
                        <tbody class="dinamic-input">
                            @foreach ($item->rajalFarmasiObatDetails as $detail)
                                <tr>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" name="include[]" checked>
                                        </div>
                                    </td>
                                    <td>
                                       {{ $detail->nama_obat ?? '' }}
                                    </td>
                                    <td>
                                        {{ $detail->aturan_pakai }}
                                    </td>
                                    <td>
                                        {{ $detail->jumlah ?? '' }}
                                    </td>
                                    <td>
                                        {{ 'Rp. ' . number_format($detail->harga_satuan) ?? "" }}
                                    </td>
                                    <td>
                                        {{ 'Rp. ' . number_format($detail->sub_total ?? 0) }}
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="5" class="fw-bold fst-italic text-uppercase">
                                        Total Akhir
                                    </td>
                                    <td class="fw-bold">Rp. {{ number_format($item->grand_total ?? '') }}</td>
                                </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mt-4 d-flex justify-content-end">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class='bx bx-printer'></i> Print
                        </button>
                        <ul class="dropdown-menu ">
                            <li> <a class="dropdown-item" href=""> Copy Resep Farmasi</a> </li>
                            <li> <a class="dropdown-item" href=""> Copy Resep Dokter</a></li>
                        </ul>
                    </div>
                    <button type="button" onclick="history.back()" class="ms-3 btn btn-outline-danger"><i class='bx bx-left-arrow me-1'></i>Kembali</button>
                </div>
            </div>
        </div>
    </div>
@endsection
