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
    <div class="d-flex justify-content-end mb-3 mt-0">
        <div id="show-alert">
        
        </div>
    </div>

    {{-- Informasi Pasien --}}
    <div class="card mb-2">
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <h4 class="mb-1 text-primary d-flex">
                        {{ $item->patient->name }} ({{ $item->patient->no_rm ?? '' }})
                        <span class="ms-2 badge {{ $item->patient->jenis_kelamin == 'Wanita' ? 'bg-danger' : 'bg-info' }}">{{ $item->patient->jenis_kelamin == 'Wanita' ? 'P' : 'L' }}</span> 
                    </h4>
                    <h6 class="mb-1">{{ $item->dpjp->name }} ({{ $item->dpjp->staff_id }})</h6>
                    <h6 class="mb-1">{{ $item->dpjp->poliklinik->name ?? '' }}<h6>
                    @if ($item->rawatJalanPoliPatient->status == 'WAITING')                                    
                        <span class="badge bg-danger">BELUM DILAYANI</span>
                    @elseif ($item->rawatJalanPoliPatient->status == 'ONGOING')
                        <span class="badge bg-warning">DALAM PERAWATAN</span>
                    @elseif ($item->rawatJalanPoliPatient->status == 'FINISHED')
                        <span class="badge bg-success">SUDAH DILAYANI</span>
                    @else
                        <span class="badge bg-success">TIDAK DIKETAHUI</span>
                    @endif
                </div>
                <div class="col-8 text-end">
                    <p class="mb-0">No. Antrian : <span class="fst-italic fw-bold">{{ $item->no_antrian ?? '' }}</span></p>
                    <p class="mb-0">Tanggungan : <span class="fw-bold fst-italic">{{ $item->patientCategory->name }}</span></p>
                    <p class="mb-0">Tgl. Lahir : <span class="fw-bold fst-italic">{{ $item->patient->tanggal_lhr }}</span></p>
                </div>
            </div>
        </div>
    </div>
    {{-- end Informasi Pasien --}}

    {{-- data riwayat pemeriksaan pasien --}}
    <div class="card mb-2">
        <div class="card-body">
            <div class="row">
                <div class="col-md-2 col-12 mb-3 mb-md-0">
                    <div class="list-group">
                        <a class="list-group-item list-group-item-action active" id="list-kunjungan-list" data-bs-toggle="list" href="#list-kunjungan">Kunjungan</a>
                        <a class="list-group-item list-group-item-action" id="list-diagnosa-list" data-bs-toggle="list" href="#list-diagnosa">Diagnosa (ICD X)</a>
                        <a class="list-group-item list-group-item-action" id="list-procedure-list" data-bs-toggle="list" href="#list-procedure">Prosedure (ICD IX)</a>
                        <a class="list-group-item list-group-item-action" id="list-penunjang-list" data-bs-toggle="list" href="#list-penunjang">Penunjang</a>
                        <a class="list-group-item list-group-item-action" id="list-tindakan-list" data-bs-toggle="list" href="#list-tindakan">Tindakan</a>
                        <a class="list-group-item list-group-item-action" id="list-resep-list" data-bs-toggle="list" href="#list-resep">Resep</a>
                        <a class="list-group-item list-group-item-action" id="list-ass-awal-list" data-bs-toggle="list" href="#list-ass-awal">Asesmen Awal</a>
                        <a class="list-group-item list-group-item-action" id="list-soap-list" data-bs-toggle="list" href="#list-soap">SOAP</a>
                        <a class="list-group-item list-group-item-action" id="list-resume-medis-list" data-bs-toggle="list" href="#list-resume-medis">Resume Medis</a>
                    </div>
                </div>
                <div class="col-md-10 col-12 border">
                    <div class="row">
                        <a href="{{ route('verifikasi/data/pasien/dokter.verifikasiDokter', encrypt($item->id)) }}" class="btn btn-dark btn-md" style="border-radius: 0%"><i class="bx bx-check"></i> Verifikasi</a>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="list-kunjungan">
                            <div class="row mt-0">
                                <div class="col col-12 col-lg-6">
                                    <div class="card shadow-sm p-3">
                                        <div class="row">
                                            <div class="row mb-4">
                                                <label class="col-form-label fw-bold text-uppercase" for="basic-default-name">Nomor Antrian</label>
                                                <div class="col">
                                                        {{ $item->no_antrian ?? '' }}
                                                </div>
                                            </div>
                    
                                            <div class="row mb-4">
                                                <label class="col-form-label fw-bold text-uppercase" for="basic-default-name">Usia Ketika Berkunjung</label>
                                                <div class="col">
                                                    <p class="mt-2 mb-0">{{ $usiaSaatBerkunjung ?? 'Tidak Diketahui' }}</p>
                                                </div>
                                            </div>
                    
                                            <div class="row mb-4 mt-0">
                                                <label for="basic-default-name" class="col-form-label fw-bold text-uppercase">Poliklinik</label>
                                                <div class="col">
                                                    <p class="mt-2 mb-0">{{ $item->dpjp->poliklinik->name ?? '-' }}</p>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label for="basic-default-name" class="col-form-label fw-bold text-uppercase">Dokter Penanggung Jawab</label>
                                                <div class="col">
                                                    {{ $item->dpjp->name ?? '-' }}
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label for="basic-default-name" class="col-form-label fw-bold text-uppercase">Cara Keluar</label>
                                                <div class="col">
                                                    {{ $item->rawatJalanPoliPatient->cara_keluar ?? '-' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col col-12 col-lg-6">
                                    <div class="card shadow-sm p-3">
                                        <div class="row px-5 container">
                                            <div class="row mb-4">
                                                <label for="basic-default-name" class="col-form-label fw-bold text-uppercase">Jenis Pasien</label>
                                                <div class="col">
                                                    {{ $item->patientCategory->name ?? '-' }}
                                                </div>
                                            </div>
                    
                                            <div class="row mb-4">
                                                <label for="basic-default-name" class="col-form-label fw-bold text-uppercase">Tanggal Kunjungan</label>
                                                <div class="col">
                                                    {{ $item->tgl_antrian ?? '-' }}
                                                </div>
                                            </div>
                    
                                            <div class="row mb-4">
                                                <label for="basic-default-name" class="col-form-label fw-bold text-uppercase">Status Pelayanan</label>
                                                <div class="col">
                                                    @if ($item->status_antrian == 'FINISHED')
                                                        SUDAH DILAYANI
                                                    @elseif ($item->status_antrian == 'WAITING')
                                                        BELUM DILAYANI
                                                    @elseif ($item->status_antrian == 'ARRIVED')
                                                        SEDANG DILAYANI
                                                    @elseif ($item->status_antrian == 'CANCEL')
                                                        ANTRIAN BATAL
                                                    @else
                                                        TIDAK DIKETAHUI
                                                    @endif
                                                </div>
                                            </div>
                    
                                            <div class="row mb-4">
                                                <label for="basic-default-name" class="col-form-label fw-bold text-uppercase">Keadaan Keluar</label>
                                                <div class="col">
                                                    {{ $item->rawatJalanPoliPatient->keadaan_keluar ?? '-' }}
                                                </div>
                                            </div>
                    
                                            <div class="row mb-4">
                                                <label for="basic-default-name" class="col-form-label fw-bold text-uppercase">Petugas Registrasi</label>
                                                <div class="col">
                                                    {{ $item->user->name ?? '-' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="list-diagnosa">
                            <div class="row mt-0">
                                <div class="col-12">
                                    <h5 class="mx-2">Diagnosa Primer</h5>
                                    <hr>
                                    <table class="table">
                                        <thead>
                                            <tr class="text-nowrap">
                                                <th class="text-dark">Kode Diagnosa</th>
                                                <th class="text-dark">Nama Diagnosa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @if (!$item->diagnosticProcedurePatient)
                                                    <td colspan="2" class="bg-info text-white"><i class="bx bx-x"></i> Tidak Ditemukan</td>
                                                @else
                                                    <td>{{ $item->diagnosticProcedurePatient->diagnostic->icd_x_code ?? '...' }}</td>
                                                    <td>{{ $item->diagnosticProcedurePatient->diagnostic->name ?? '...' }}</td>
                                                @endif
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-12 mt-5">
                                    <h5 class="mx-2">Diagnosa Sekunder</h5>
                                    <hr>
                                     <table class="table">
                                        <thead>
                                            <tr class="text-nowrap">
                                                <th class="text-dark">Kode Diagnosa</th>
                                                <th class="text-dark">Nama Diagnosa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (!$item->diagnosticProcedurePatient || $item->diagnosticProcedurePatient->diagnosticSecondary->isEmpty())
                                                <td colspan="2" class="bg-info text-white"><i class="bx bx-x"></i> Tidak Ditemukan</td>
                                            @else
                                                @foreach ($item->diagnosticProcedurePatient->diagnosticSecondary as $diagSekunder)     
                                                    <tr>
                                                        <td>{{ $diagSekunder->diagnostic->icd_x_code ?? '...' }}</td>
                                                        <td>{{ $diagSekunder->diagnostic->name ?? '...' }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="list-procedure">
                            <div class="row mt-0">
                                <div class="col-12">
                                    <h5 class="mx-2">Prosedur (ICD IX)</h5>
                                    <table class="table">
                                        <thead>
                                            <tr class="text-nowrap">
                                                <th class="text-dark">Kode Prosedur</th>
                                                <th class="text-dark">Nama Prosedur</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @if (!$item->diagnosticProcedurePatient)
                                                    <td colspan="2" class="bg-info text-white"><i class="bx bx-x"></i> Tidak Ditemukan</td>
                                                @else
                                                    <td>{{ $item->diagnosticProcedurePatient->procedure->icd_ix_code ?? '...' }}</td>
                                                    <td>{{ $item->diagnosticProcedurePatient->procedure->name ?? '...' }}</td>
                                                @endif
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="list-penunjang">
                            <div class="row mt-0">
                                <div class="col mx-1 border rounded">
                                    <h5 class="my-2">Pemeriksaan Radiologi</h5>
                                    
                                    @if ($item->radiologiFormRequests->isEmpty())
                                    <div class="row">
                                        <span class="col-11 bg-info text-white p-2 ps-3 mx-4"><i class="bx bx-x"></i> Tidak Ditemukan</span>
                                    </div>
                                    @else
                                        @foreach ($item->radiologiFormRequests as $rad)
                                            <div class="accordion accordion-header-primary mb-2" id="radiologi-accord{{ $loop->iteration ?? '' }}">
                                                <div class="accordion-item card border">
                                                    <h2 class="accordion-header">
                                                        <button type="button" class="accordion-button collapsed text-uppercase" data-bs-toggle="collapse" data-bs-target="#radiologi-accord-1" aria-expanded="false">
                                                        {{ $rad->created_at->format('Y-m-d H:i:s') ?? '' }} / Diagnosa : {{ $rad->diagnosa_klinis ?? '-' }} 
                                                        </button>
                                                    </h2>
                                                
                                                    <div id="radiologi-accord-1" class="accordion-collapse collapse" data-bs-parent="#radiologi-accord{{ $loop->iteration }}">
                                                        <div class="accordion-body">
                                                            <div class="table-responsive">
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="text-dark">Kode Tindakan</th>
                                                                            <th class="text-dark">Nama Tindakan</th>
                                                                            <th class="text-dark">Keterangan</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($rad->radiologiFormRequestDetails as $detailRad)    
                                                                            <tr>
                                                                                <td>{{ $detailRad->action->action_code ?? '-' }}</td>
                                                                                <td>{{ $detailRad->action->name ?? '-' }}</td>
                                                                                <td>{{ $detailRad->keterangan ?? '-' }}</td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col mx-1 border rounded">
                                    <h5 class="my-2">Pemeriksaan Laboratorium</h5>
                                    @if ($item->laboratoriumRequests->isEmpty())
                                    <div class="row">
                                        <span class="col-11 bg-info text-white p-2 ps-3 mx-4"><i class="bx bx-x"></i> Tidak Ditemukan</span>
                                    </div>
                                    @else
                                        @foreach ($item->laboratoriumRequests as $lab)
                                            <div class="accordion accordion-header-primary mb-2" id="laboratorium-accord{{ $loop->iteration ?? '' }}">
                                                <div class="accordion-item card border">
                                                    <h2 class="accordion-header">
                                                        <button type="button" class="accordion-button collapsed text-uppercase" data-bs-toggle="collapse" data-bs-target="#laboratorium-accord-1" aria-expanded="false">
                                                        {{ $lab->created_at->format('Y-m-d H:i:s') ?? '' }} / Diagnosa : {{ $lab->diagnosa_klinis ?? '-' }} 
                                                        </button>
                                                    </h2>
                                                
                                                    <div id="laboratorium-accord-1" class="accordion-collapse collapse" data-bs-parent="#laboratorium-accord{{ $loop->iteration }}">
                                                        <div class="accordion-body">
                                                            <div class="table-responsive">
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="text-dark">Kode Tindakan</th>
                                                                            <th class="text-dark">Nama Tindakan</th>
                                                                            <th class="text-dark">Keterangan</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($lab->laboratoriumRequestDetails as $detailLab)    
                                                                            <tr>
                                                                                <td>{{ $detailLab->action->action_code ?? '-' }}</td>
                                                                                <td>{{ $detailLab->action->name ?? '-' }}</td>
                                                                                <td>{{ $detailLab->keterangan ?? '-' }}</td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div> 
                        </div>
                        <div class="tab-pane fade" id="list-tindakan">
                            <div class="row mt-0">
                                @if (!$item->patientActionReport)
                                    <span class="col-12 bg-info text-white p-2 ps-3"><i class="bx bx-x"></i> Tidak Ditemukan</span>
                                @else    
                                    <div class="col-12">
                                        <h5>Tindakan Pelayanan Medis</h5>
                                        <hr>
                                        <div class="row">
                                            <div class="col col-2">
                                                <label for="col-form-label">Tgl / Jam Tindakan :</label>
                                            </div>
                                            <div class="col col-10">
                                                <p>
                                                    {{ ($item->patientActionReport->tgl_tindakan ?? '...') ?? ($item->patientActionReport->created_at->format('Y-m-d H:i') ?? '...') }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col col-2">
                                                <label for="col-form-label">Laporan Tindakan :</label>
                                            </div>
                                            <div class="col col-10">
                                                <p class="multi-line-text">{{ $item->patientActionReport->laporan_tindakan ?? '...' }}</p>
                                            </div>
                                        </div>
                                        <table class="table">
                                            <thead>
                                                <tr class="text-nowrap">
                                                    <th class="text-dark">Tindakan</th>
                                                    <th class="text-dark">Tarif</th>
                                                    <th class="text-dark">Jumlah</th>
                                                    <th class="text-dark">Sub Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($item->patientActionReport->patientActionReportDetails->isEmpty())
                                                    <tr>
                                                        <td colspan="4" class="bg-info text-white"><i class="bx bx-x"></i> Tidak Ditemukan</td>
                                                    </tr>
                                                @else
                                                    @foreach ($item->patientActionReport->patientActionReportDetails as $detailTindakan)
                                                        <tr>
                                                            <td>{{ $detailTindakan->action->name ?? '...' }}</td>
                                                            <td>{{ $detailTindakan->harga_satuan ?? '...' }}</td>
                                                            <td>{{ $detailTindakan->jumlah ?? '1' }}</td>
                                                            <td>{{ $detailTindakan->subTotal ?? '...' }}</td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade" id="list-resep">
                            <div class="row mt-0">
                                <table class="table">
                                    <thead>
                                        <tr class="text-nowrap bg-white text-dark">
                                            <th class="text-dark">Nama Obat</th>
                                            <th class="text-dark">Aturan Pakai</th>
                                            <th class="text-dark">Jumlah</th>
                                            <th class="text-dark">Harga Satuan</th>
                                            <th class="text-dark">Sub Total</th>
                                        </tr>
                                    </thead>
                                    <tbody class="dinamic-input">
                                        @if ($item->rajalFarmasiPatient)    
                                            @if (!$item->rajalFarmasiPatient->rajalFarmasiObatDetails->isNotEmpty())
                                                @foreach ($item->rajalFarmasiPatient->rajalFarmasiObatDetails as $detail)
                                                    <tr>
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
                                                    <td colspan="4" class="fw-bold fst-italic text-uppercase">
                                                        Total Akhir
                                                    </td>
                                                    <td class="fw-bold">Rp. {{ number_format($item->rajalFarmasiPatient->grand_total ?? 0) }}</td>
                                                </tr>
                                            @elseif ($item->medicineReceipt->medicineReceiptDetails->isNotEmpty())    
                                                @foreach ($item->medicineReceipt->medicineReceiptDetails as $detail)
                                                    <tr>
                                                        <td>
                                                            {{ $detail->medicine ? ($detail->medicine->name ?? '') : ($detail->nama_obat_custom ?? '') }}
                                                        </td>
                                                        <td>
                                                            {{ $detail->aturan_pakai ?? '' }}
                                                        </td>
                                                        <td>
                                                            {{ $detail->jumlah ?? '0' }}
                                                        </td>
                                                        <td>
                                                            {{ '0' }}
                                                        </td>
                                                        <td>
                                                            {{ '0' }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="4" class="fw-bold fst-italic text-uppercase">
                                                        Total Akhir
                                                    </td>
                                                    <td class="fw-bold">0</td>
                                                </tr>
                                            @else
                                                <tr>
                                                    <td colspan="5" class="bg-info text-white"><i class="bx bx-x"></i> Tidak Ditemukan</td>
                                                </tr>
                                            @endif
                                        @else
                                            <tr>
                                                <td colspan="5" class="bg-info text-white"><i class="bx bx-x"></i> Tidak Ditemukan</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="list-ass-awal">
                            <div class="card">
                                <div class="card-header pb-0">
                                    <div class="row">
                                        <div class="col-8 align-self-center ps-4">
                                            <h5 class="mb-2">ASESMEN AWAL DOKTER</h5>
                                            <h6>RAWAT JALAN</h6>
                                        </div>
                                        <div class="col-4">
                                            <table class="small small-table">
                                                <tr>
                                                    <td>Nama</td>
                                                    <td class="px-2">:</td>
                                                    <td>{{ $item->patient->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Tanggal Lahir</td>
                                                    <td class="px-2">:</td>
                                                    @php
                                                        $tanggalLahir = new DateTime($item->patient->tanggal_lhr);
                                                        $now = new DateTime();
                                                        $ageDiff = $now->diff($tanggalLahir);
                                                        $ageString = $ageDiff->format('%y tahun %m bulan');
                                                    @endphp
                                                    <td>{{ $tanggalLahir->format('d-m-Y') ?? '....' }}
                                                        <span>({{ $ageString ?? '....' }})</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>No Rekam Medis</td>
                                                    <td class="px-2">:</td>
                                                    <td>{{ $item->patient->no_rm ?? '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>NIK</td>
                                                    <td class="px-2">:</td>
                                                    <td>{{ $item->patient->nik }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-2">
                                <div class="card-body pt-0">
                                    <div class="mb-3">
                                        <label class="col-form-label fw-bold">Anamnesa / Keluhan Utama :</label>
                                        <div class="">
                                            {{ $item->doctorInitialAssesment->keluhan_utama ?? '' }}
                                        </div>
                                    </div>
                    
                                    <span class="text-dark fw-bold">STATUS FISIK</span>
                                    <hr class="my-1">
                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <label class="col-form-label fw-bold">Kesadaran :</label>
                                            <div class="">
                                                {{ $item->doctorInitialAssesment->kesadaran ?? '' }}
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label class="col-form-label fw-bold">Keadaan Umum :</label>
                                            <div class="">{{ $item->doctorInitialAssesment->keadaan_umum ?? '' }}</div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-4">
                                            <label class="col-form-label fw-bold">Tinggi Badan :</label>
                                            <div class="d-flex">
                                                <p>{{ $item->doctorInitialAssesment->tb ?? '...' }}</p>
                                                <span class="ms-2 fst-italic">cm</span>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <label class="col-form-label fw-bold">Berat Badan :</label>
                                             <div class="d-flex">
                                                <p>{{ $item->doctorInitialAssesment->bb ?? '...' }}</p>
                                                <span class="ms-2 fst-italic">kg</span>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <label class="col-form-label fw-bold">Lingkar Kepala :</label>
                                             <div class="d-flex">
                                                <p>{{ $itemAss->lk ?? '...' }}</p>
                                                <span class="ms-2 fst-italic">cm</span>
                                            </div>
                                        </div>
                                    </div>
                    
                                    <span class="text-dark fw-bold">TANDA - TANDA VITAL</span>
                                    <hr class="my-1">
                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <label class="col-form-label fw-bold">Nadi</label>
                                            <div class="d-flex">
                                                <p>{{ $item->doctorInitialAssesment->nadi ?? '...' }}</p>
                                                <span class="ms-2 fst-italic">bpm</span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label class="col-form-label fw-bold">Tekanan Darah</label>
                                            <div class="d-flex">
                                                <p>{{ $item->doctorInitialAssesment->td_sistolik ?? '...' }} / {{ $item->doctorInitialAssesment->td_diastolik ?? '...' }}</p>
                                                <span class="ms-2 fst-italic">mmHg</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <label class="col-form-label fw-bold">Suhu Badan</label>
                                            <div class="d-flex">
                                                <p>{{ $item->doctorInitialAssesment->suhu ?? '...' }}</p>
                                                <span class="ms-2 fst-italic">°C</span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label class="col-form-label fw-bold">Nafas</label>
                                            <div class="d-flex">
                                                <p>{{ $item->doctorInitialAssesment->nafas ?? '...' }}</p>
                                                <span class="ms-2 fst-italic">x/menit</span>
                                            </div>
                                        </div>
                                    </div>
                    
                                    <span class="text-dark fw-bold">RIWAYAT PENYAKIT & ALERGI</span>
                                    <hr class="my-1">
                                    <div class="row mb-3">
                                        <div class="col-3">
                                            <label class="col-form-label fw-bold">Riwayat Penyakit Pasien</label>
                                            <p class="multi-line-text">{!! $itemAss->riw_penyakit_pasien ?? '' !!}</p>
                                        </div>
                                        <div class="col-3">
                                            <label class="col-form-label fw-bold">Riwayat Penyakit Keluarga</label>
                                             <p class="multi-line-text">{!! $itemAss->riw_penyakit_keluarga ?? '' !!}</p>   
                                        </div>
                                        <div class="col-3">
                                            <label class="col-form-label fw-bold">Alergi Makanan</label>
                                            <p class="multi-line-text">{!! $item->patient->alergi_makanan ?? '' !!}</p>
                                        </div>
                                        <div class="col-3">
                                            <label class="col-form-label fw-bold">Alergi Obat</label>
                                            <p class="multi-line-text">{!! $item->patient->alergi_obat ?? '' !!}</p>
                                        </div>
                                    </div>
                    
                                    <span class="text-dark fw-bold">ASESMEN GIZI</span>
                                    <hr class="my-1">
                                    <div class="row mb-3">
                                        <div class="col-8">
                                            <div class="row mb-3">
                                                <label class="col-form-label fw-bold">Apakah pasien mengalami penurunan berat badan dalam 6 bulan terakhir ?</label>
                                                <div class="">
                                                    Ya (skor: {{ $itemAss->skor_ass_gizi_1 ?? '' }})
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-form-label fw-bold">Apakah memiliki keluhan kurang nafsu makan ?</label>
                                                <div class="">Tidak juga (skor: {{ $itemAss->skor_ass_gizi_2 ?? '' }})</div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-form-label fw-bold">Kondisi Gizi Pasien</label>
                                                <div class="">{{ $itemAss->kondisi_gizi ?? '' }}</div>
                                            </div>
                                        </div>
                                        <div class="col-4 text-center align-self-center">
                                            <h3 class="mb-2">SKOR MST</h3>
                                            <h1>{{ $itemAss ? ($itemAss->skor_ass_gizi_1 ?? 0 + $itemAss->skor_ass_gizi_2 ?? 0) : ''  }}</h1>
                                        </div>
                                    </div>
                    
                                    <span class="text-dark fw-bold">ASESMEN NYERI</span>
                                    <hr class="my-1">
                                    <div class="row mb-3">
                                        <div class="col-12 text-center">
                                            <img src="{{ asset('assets/img/aakprj2.jpg') }}" alt="" class="img-fluid" style="max-width: 780px">
                                        </div>
                                        <div class="row">
                                            <div class="col-12 text-center mx-3 ps-4">
                                                <div class="form-check form-check-inline mt-3 mx-5 ps-4">
                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" style="pointer-events: none;" {{ $itemAss ? ($itemAss->skor_nyeri == '0' ? 'checked' : '') : '' }} />
                                                </div>
                                                <div class="form-check form-check-inline mx-5 ps-4">
                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" style="pointer-events: none;" {{ $itemAss ? ($itemAss->skor_nyeri == '2' ? 'checked' : '') : '' }} />
                                                </div>
                                                <div class="form-check form-check-inline mx-5">
                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" style="pointer-events: none;" {{ $itemAss ? ($itemAss->skor_nyeri == '4' ? 'checked' : '') : '' }}/>
                                                </div>
                                                <div class="form-check form-check-inline mx-5 ps-4">
                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" style="pointer-events: none;" {{ $itemAss ? ($itemAss->skor_nyeri == '6' ? 'checked' : '') : '' }}/>
                                                </div>
                                                <div class="form-check form-check-inline mx-5 ps-4">
                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" style="pointer-events: none;" {{ $itemAss ? ($itemAss->skor_nyeri == '8' ? 'checked' : '') : '' }}/>
                                                </div>
                                                <div class="form-check form-check-inline mx-5 ps-5">
                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" style="pointer-events: none;" {{ $itemAss ? ($itemAss->skor_nyeri == '10' ? 'checked' : '') : '' }}/>
                                                </div>
                                            </div>
                    
                                        </div>
                                    </div>
                    
                                    <span class="text-dark fw-bold">ASESMEN RESIKO JATUH</span>
                                    <hr class="my-1">
                                    <div class="row mb-3">
                                        <div class="col-8">
                                            <div class="row">
                                                <div class="col-9 mt-4">
                                                    <p class="mb-4">a. Saat akan duduk dikursi pasien tampak tidak seimbang (sempoyongan / linglung) ?</p>
                                                    <p>b. Saat akan duduk pasien memegang pinggiran kursi atau benda lain sebagai penopang ?</p>
                                                </div>
                                                <div class="col-3 mt-4">
                                                    <p class="mb-4">{{ $itemAss ? ($itemAss->resiko_jatuh_a ? 'YA' : 'TIDAK') : '...' }}</p>
                                                    <p>{{ $itemAss ? ($itemAss->resiko_jatuh_b ? 'YA' : 'TIDAK') : '...' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4 align-self-center">
                                            <div class="card bg-transparent border border-primary">
                                                <div class="card-body text-center p-2 align-self-center">
                                                    <h2 class="text-uppercase mb-1 text-primary">
                                                        {{ $itemAss->resiko_jatuh_result ?? 'TIDAK ADA DATA' }}
                                                    </h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    
                                    <span class="text-dark fw-bold">PSIKOLOGIS & SOSIAL EKONOMI</span>
                                    <hr class="my-1">
                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <label class="col-form-label fw-bold">Status Psikologis</label>
                                            <div class="d-flex">
                                                @foreach ($itemAss->detailPsikologis ?? [] as $detail)
                                                    <p class="me-1">{{ $detail->name ?? '' }},</p>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label class="col-form-label fw-bold">Status Ekonomi</label>
                                            <div>{{ $itemAss->stts_ekonomi ?? '' }}</div>
                                        </div>
                                    </div>
                    
                                    <span class="text-dark fw-bold">SOAP KEPERAWATAN</span>
                                    <hr class="my-1">
                                    <div class="row mb-3">
                                        <div class="col-3">
                                            <label class="col-form-label fw-bold">Subjective:</label>
                                            <p class="multi-line-text">{!! $itemAss->subjective ?? '' !!}</p>
                                        </div>
                                        <div class="col-3">
                                            <label class="col-form-label fw-bold">Objective:</label>
                                            <p class="multi-line-text">{!! $itemAss->objective ?? '' !!}</p>
                                        </div>
                                        <div class="col-3">
                                            <label class="col-form-label fw-bold">Assesment:</label>
                                            <p class="multi-line-text">{!! $itemAss->asesmen ?? '' !!}</p>
                                        </div>
                                        <div class="col-3">
                                            <label class="col-form-label fw-bold">Planning:</label>
                                            <p class="multi-line-text">{!! $itemAss->planning ?? '' !!}</p>
                                        </div>
                                    </div>
                                    
                                    <hr>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="text-start align-self-center">
                                                <p class="mb-0">Padang, {{ $itemAss ? ($itemAss->created_at->format('d M Y') ?? 'Unknown') : '' }}</p>
                                                <p class="mb-1 fw-bold">Perawat,</p>
                                                <img src="{{ $itemAss ? (asset('storage/' . $itemAss->ttd ?? '')) : '' }}" width="150" alt="">
                                                <p class="fw-bold">{{ $itemAss ? ($itemAss->user->name ?? '') : '' }}</p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-end align-self-center">
                                                {{-- <p class="mb-0">Padang, {{ $itemAss->created_at->format('d M Y') ?? 'Unknown' : '' }}</p> --}}
                                                <p class="mb-0">Diketahui</p>
                                                <p class="mb-1 fw-bold">Dokter,</p>
                                                <img src="{{ $item ? (asset('storage/' . $item->ttd_verif ?? '')) : '' }}" width="150" alt="">
                                                <p class="fw-bold">{{ $item->dpjp->name ?? '' }}</p>
                                            </div>
                                        </div>
                                    </div>
                    
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="list-soap">                                
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="text-dark">Tanggal</th>
                                        <th class="text-dark">Profesional Pemberi Asuhan</th>
                                        <th class="text-dark">Subjective, Objective, Assesment, Planning</th>
                                        <th class="text-dark">Nama & Ttd</th>
                                    </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                    @if ($item->soapDokter)     
                                        <tr>
                                            <td>{{ $item->soapDokter->created_at->format('d M Y') ?? '' }}</td>
                                            <td>{{ $item->soapDokter->user->name ?? '' }}</td>
                                            <td>
                                                <p class="fw-bold mb-0">SUBJECTIVE:</p>
                                                <p class="multi-line-text">{{ $item->soapDokter->subjective ?? '' }}</p>
                                                <p class="fw-bold mb-0">OBJECTIVE:</p>
                                                <p class="multi-line-text">{{ $item->soapDokter->objective ?? '' }}</p>
                                                <p class="fw-bold mb-0">ASSESMENT:</p>
                                                <p class="multi-line-text">{{ $item->soapDokter->asesment ?? '' }}</p>
                                                <p class="fw-bold mb-0">PLANNING:</p>
                                                <p class="multi-line-text">{{ $item->soapDokter->planning ?? '' }}</p>
                                            </td>
                                            <td>
                                                @if ($item->soapDokter->ttd || $item->ttd_verif)
                                                    <img src="{{ Storage::url($item->soapDokter->ttd ?? $item->ttd_verif) }}" width="150" alt="">
                                                    <p>
                                                        {{ $item->dpjp->name ?? '' }}
                                                    </p>
                                                @endif
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td colspan="4" class="bg-info text-white">
                                                Data Tidak Tersedia !!
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="list-resume-medis">
                            <div class="card">
                                <div class="card-header pb-0">
                                    <div class="row">
                                        <div class="col-8 align-self-center ps-4">
                                            <h5 class="mb-2">RESUME MEDIS PASIEN</h5>
                                            <h6>RAWAT JALAN</h6>
                                        </div>
                                        <div class="col-4">
                                            <table class="small small-table">
                                                <tr>
                                                    <td>Nama</td>
                                                    <td class="px-2">:</td>
                                                    <td>{{ $item->patient->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Tanggal Lahir</td>
                                                    <td class="px-2">:</td>
                                                    @php
                                                        $tanggalLahir = new DateTime($item->patient->tanggal_lhr);
                                                        $now = new DateTime();
                                                        $ageDiff = $now->diff($tanggalLahir);
                                                        $ageString = $ageDiff->format('%y tahun %m bulan');
                                                    @endphp
                                                    <td>{{ $tanggalLahir->format('d-m-Y') ?? '....' }}
                                                        <span>({{ $ageString ?? '....' }})</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>No Rekam Medis</td>
                                                    <td class="px-2">:</td>
                                                    <td>{{ $item->patient->no_rm ?? '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>NIK</td>
                                                    <td class="px-2">:</td>
                                                    <td>{{ $item->patient->nik }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-2">
                                <div class="card-body pt-0">
                                    <div class="row mb-3">
                                        <div class="col-4">
                                            <label class="col-form-label fw-bold text-decoration-underline">Tanggal Pelayanan :</label>
                                            <div class="">
                                                {{ $item->tgl_antrian ?? '-' }}
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <label class="col-form-label fw-bold text-decoration-underline">DPJP :</label>
                                            <div class="">{{ $item->dpjp->name ?? '-' }}</div>
                                        </div>
                                        <div class="col-4">
                                            <label class="col-form-label fw-bold text-decoration-underline">Poliklinik :</label>
                                            <div class="">{{ $item->dpjp->poliklinik->name ?? '-' }}</div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <label class="col-form-label fw-bold text-decoration-underline">Anamnesa :</label>
                                            <div class="">
                                                {{ $item->doctorInitialAssesment->keluhan_utama ?? '-' }}
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label class="col-form-label fw-bold text-decoration-underline">Kesadaran :</label>
                                            <div class="">{{ $item->doctorInitialAssesment->kesadaran ?? '-' }}</div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-2">
                                            <label class="col-form-label fw-bold text-decoration-underline">Tinggi Badan :</label>
                                            <div class="d-flex">
                                                <p>{{ $item->doctorInitialAssesment->tb ?? '...' }}</p>
                                                <span class="ms-2 fst-italic">cm</span>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <label class="col-form-label fw-bold text-decoration-underline">Berat Badan :</label>
                                             <div class="d-flex">
                                                <p>{{ $item->doctorInitialAssesment->bb ?? '...' }}</p>
                                                <span class="ms-2 fst-italic">kg</span>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <label class="col-form-label fw-bold text-decoration-underline">Nadi</label>
                                            <div class="d-flex">
                                                <p>{{ $item->doctorInitialAssesment->nadi ?? '...' }}</p>
                                                <span class="ms-2 fst-italic">bpm</span>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <label class="col-form-label fw-bold text-decoration-underline">Tekanan Darah</label>
                                            <div class="d-flex">
                                                <p>{{ $item->doctorInitialAssesment->td_sistolik ?? '...' }} / {{ $item->doctorInitialAssesment->td_diastolik ?? '...' }}</p>
                                                <span class="ms-2 fst-italic">mmHg</span>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <label class="col-form-label fw-bold text-decoration-underline">Suhu Badan</label>
                                            <div class="d-flex">
                                                <p>{{ $item->doctorInitialAssesment->suhu ?? '...' }}</p>
                                                <span class="ms-2 fst-italic">°C</span>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <label class="col-form-label fw-bold text-decoration-underline">Nafas</label>
                                            <div class="d-flex">
                                                <p>{{ $item->doctorInitialAssesment->nafas ?? '...' }}</p>
                                                <span class="ms-2 fst-italic">x/menit</span>
                                            </div>
                                        </div>
                                    </div>
                    
                                    <hr class="my-1">
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <div class="row">
                                                <label class="col-form-label fw-bold text-decoration-underline">Diagnosa Utama:</label>
                                                <div class="col">
                                                    @if ($item->diagnosticProcedurePatient)      
                                                        @if ($item->diagnosticProcedurePatient->diagnostic_id)
                                                            <p>{{ '[' . ($item->diagnosticProcedurePatient->diagnostic->icd_x_code ?? '-') . '] '. ($item->diagnosticProcedurePatient->diagnostic->name ?? '-') }}</p>
                                                        @else
                                                            <p class="multi-line-text">{{ $item->diagnosticProcedurePatient->desc_diagnosa_primer ?? '-' }}</p>
                                                        @endif
                                                    @else
                                                        -
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="col-form-label fw-bold text-decoration-underline">Diagnosa Sekunder</label>
                                            <div class="col">
                                                @if ($item->diagnosticProcedurePatient)      
                                                <p class="multi-line-text">
                                                    @if ($item->diagnosticProcedurePatient->diagnosticSecondary->isNotEmpty())
                                                        @foreach ($item->diagnosticProcedurePatient->diagnosticSecondary as $sekunder)
                                                            {{ '[' . ($sekunder->diagnostic->icd_x_code ?? '-') . '] '. ($sekunder->diagnostic->name ?? '-') }}
                                                        @endforeach
                                                    @else
                                                        {{ $item->diagnosticProcedurePatient->desc_diagnosa_sekunder ?? '' }}
                                                    @endif
                                                </p>
                                                @else
                                                    -
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="col-form-label fw-bold text-decoration-underline">Prosedur (ICD IX)</label>
                                            <div class="col">
                                                @if ($item->diagnosticProcedurePatient)      
                                                    @if ($item->diagnosticProcedurePatient->procedure_id)
                                                    <p>
                                                        {{ '[' . ($item->diagnosticProcedurePatient->procedure->icd_ix_code ?? '-') . '] '. ($item->diagnosticProcedurePatient->procedure->name ?? '-') }}
                                                    </p>
                                                    @else
                                                    <p class="multi-line-text">
                                                        {{ $item->diagnosticProcedurePatient->desc_prosedure ?? '' }}
                                                    </p>
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-1">
                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <label class="col-form-label fw-bold text-decoration-underline">Radiologi</label>
                                            <div class="col">
                                                @if ($item->radiologiFormRequests->isNotEmpty())    
                                                    @foreach ($item->radiologiFormRequests as $req)
                                                        @foreach ($req->radiologiFormRequestDetails as $detailRad)
                                                            <span class="text-uppercase small">- {{ $detailRad->action->name ?? '...' }}</span><br>
                                                        @endforeach
                                                    @endforeach
                                                @else
                                                    -
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label class="col-form-label fw-bold text-decoration-underline">Laboratorium</label>
                                            <div class="col">
                                                @if ($item->laboratoriumRequests->isNotEmpty())     
                                                    @foreach ($item->laboratoriumRequests as $lab)
                                                        @foreach ($lab->laboratoriumRequestDetails as $detailLab)
                                                            <span class="text-uppercase small">- {{ $detailLab->action->name ?? '...' }}</span><br>
                                                        @endforeach
                                                    @endforeach
                                                @else
                                                    -
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-1">
                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <label class="col-form-label fw-bold text-decoration-underline">Tindakan</label>
                                            <div class="col">
                                                @if ($item->patientActionReport)    
                                                    @foreach ($item->patientActionReport->patientActionReportDetails as $detailTindakan)
                                                        <span class="text-uppercase small">- {{ '[' . ($detailTindakan->action->action_code ?? '-') . '] ' . ($detailTindakan->action->name ?? '-') }}</span>
                                                    @endforeach
                                                @else
                                                -
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label class="col-form-label fw-bold text-decoration-underline">Resep Obat</label>
                                            <div class="col">
                                                @if ($item->medicineReceipt)    
                                                    @foreach ($item->medicineReceipt->medicineReceiptDetails as $detailResep)
                                                        <span class="text-uppercase small">- {{ $detailResep->medicine->name ?? '-' }}</span>
                                                    @endforeach
                                                @else
                                                -
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                    
                                    <hr class="my-1">
                                    <div class="row mb-3">
                                        <label class="col-form-label fw-bold">Intruksi Pulang / Kontrol Ulang</label>
                                        <div class="">
                                            {{ ($item->rawatJalanPoliPatient ? ($item->rawatJalanPoliPatient->intruksi ?? '-') : '-') }}
                                        </div>
                                    </div>
                
                                    
                                    <hr>
                                    <div class="row">
                                        <div class="text-end align-self-center">
                                            <p class="mb-1 fw-bold">Dokter Penanggung Jawab Pasien,</p>
                                            <img src="{{ $item ? (asset('storage/' . $item->ttd_verif ?? '')) : '' }}" width="150" alt="">
                                            <p class="fw-bold">{{ $item->dpjp->name ?? '' }}</p>
                                        </div>
                                    </div>
                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end data riwayat pemeriksaan pasien --}}

    {{-- modal --}}
    <div class="modal fade" id="modalScrollable" tabindex="-1" aria-labelledby="modalScrollableTitle" aria-hidden="true">

    </div>
@endsection
