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
            <div class="accordion" id="accordionExample">
                <div class="card accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                    <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="true" aria-controls="accordionOne" role="tabpanel">
                        <i class='bx bx-history me-2'></i> Data & Riwayat Medis Pasien
                    </button>
                  </h2>
                  
                  <div id="accordionOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                        <div class="row">
                            <div class="col-md-2 col-12 mb-3 mb-md-0">
                              <div class="list-group">
                                <a class="list-group-item list-group-item-action active" id="list-identitas-list" data-bs-toggle="list" href="#list-identitas">Identitas Pasien</a>
                                <a class="list-group-item list-group-item-action" id="list-kunjungan-terakhir-list" data-bs-toggle="list" href="#list-kunjungan-terakhir">Kunjungan Terakhir</a>
                                <a class="list-group-item list-group-item-action" id="list-rawat-jalan-list" data-bs-toggle="list" href="#list-rawat-jalan">Rawat Jalan</a>
                                <a class="list-group-item list-group-item-action" id="list-laboratorium-list" data-bs-toggle="list" href="#list-laboratorium">Laboratorium</a>
                                <a class="list-group-item list-group-item-action" id="list-radiologi-list" data-bs-toggle="list" href="#list-radiologi">Radiologi</a>
                              </div>
                            </div>
                            <div class="col-md-10 col-12 border">
                              <div class="tab-content">
                                <div class="tab-pane fade show active" id="list-identitas">
                                    <div class="row mt-0">
                                        <div class="col col-12 col-lg-6">
                                            <div class="card shadow-sm p-3">
                                                <div class="row">
                                                    {{-- no rm --}}
                                                    <div class="col col-4">
                                                        <label class="col-form-label" for="basic-default-name">No Rekam Medis</label>
                                                    </div>
                                                    <div class="col col-8">
                                                        <p class="mt-2 mb-0"> :
                                                            &nbsp;&nbsp;&nbsp;{{ $item->patient->no_rm ?? '' }}
                                                        </p>
                                                    </div>
                            
                                                    {{-- noka --}}
                                                    <div class="col col-4">
                                                        <label class="col-form-label" for="basic-default-name">No Kartu</label>
                                                    </div>
                                                    <div class="col col-8">
                                                        <p class="mt-2 mb-0">: &nbsp;&nbsp;&nbsp;{{ $item->patient->noka ?? '-' }}</p>
                                                    </div>
                            
                                                    {{-- nama --}}
                                                    <div class="col col-4">
                                                        <label for="basic-default-name" class="col-form-label">Nama Pasien</label>
                                                    </div>
                                                    <div class="col col-8">
                                                        <p class="mt-2 mb-0">: &nbsp;&nbsp;&nbsp;{{ $item->patient->name ?? '-' }}</p>
                                                    </div>
                            
                                                    {{-- nik --}}
                                                    <div class="col col-4">
                                                        <label class="col-form-label" for="basic-default-name">Nik</label>
                                                    </div>
                                                    <div class="col col-8">
                                                        <p class="mt-2 mb-0">: &nbsp;&nbsp;&nbsp;{{ $item->patient->nik ?? '-' }}</p>
                                                    </div>
                            
                            
                                                    {{-- ttl --}}
                                                    <div class="col col-4">
                                                        <label for="basic-default-name" class="col-form-label">Tempat / Tanggal Lahir</label>
                                                    </div>
                                                    <div class="col col-8">
                                                        <p class="mt-2 mb-0"> : &nbsp;&nbsp;&nbsp;{{ $item->patient->tempat_lhr ?? '-' }} /
                                                            {{ $item->patient->tanggal_lhr ?? '-' }}</p>
                                                    </div>
                            
                                                    {{-- gender --}}
                                                    <div class="col col-4">
                                                        <label for="basic-default-name" class="col-form-label">Jenis Kelamin</label>
                                                    </div>
                                                    <div class="col col-8">
                                                        : &nbsp;&nbsp;&nbsp;{{ $item->patient->jenis_kelamin ?? '-' }}
                                                    </div>
                            
                                                    {{-- status --}}
                                                    <div class="col col-4">
                                                        <label for="basic-default-name" class="col-form-label">Status</label>
                                                    </div>
                                                    <div class="col col-8">
                                                        : &nbsp;&nbsp;&nbsp;{{ $item->patient->status ?? '-' }}
                                                    </div>
                            
                                                    {{-- Agama --}}
                                                    <div class="col col-4">
                                                        <label for="basic-default-name" class="col-form-label">Agama</label>
                                                    </div>
                                                    <div class="col col-8">
                                                        : &nbsp;&nbsp;&nbsp;{{ $item->patient->agama ?? '-' }}
                                                    </div>
                            
                                                    {{-- Nama Ayah --}}
                                                    <div class="col col-4">
                                                        <label for="basic-default-name" class="col-form-label">Nama Ayah</label>
                                                    </div>
                                                    <div class="col col-8">
                                                        : &nbsp;&nbsp;&nbsp;{{ $item->patient->nm_ayah ?? '-' }}
                                                    </div>
                            
                                                    {{-- Nama Ibu --}}
                                                    <div class="col col-4">
                                                        <label for="basic-default-name" class="col-form-label">Nama Ibu</label>
                                                    </div>
                                                    <div class="col col-8">
                                                        : &nbsp;&nbsp;&nbsp;{{ $item->patient->nm_ibu ?? '-' }}
                                                    </div>
                            
                                                    {{-- Nama Wali --}}
                                                    <div class="col col-4">
                                                        <label for="basic-default-name" class="col-form-label">Nama Wali</label>
                                                    </div>
                                                    <div class="col col-8">
                                                        : &nbsp;&nbsp;&nbsp;{{ $item->patient->nm_wali ?? '-' }}
                                                    </div>
                            
                                                    {{-- No telp --}}
                                                    <div class="col col-4">
                                                        <label for="basic-default-name" class="col-form-label">No Telp</label>
                                                    </div>
                                                    <div class="col col-8">
                                                        : &nbsp;&nbsp;&nbsp;{{ $item->patient->telp ?? '-' }}
                                                    </div>
                            
                                                    {{-- Pendidikan --}}
                                                    <div class="col col-4">
                                                        <label for="basic-default-name" class="col-form-label">Pendidikan</label>
                                                    </div>
                                                    <div class="col col-8">
                                                        : &nbsp;&nbsp;&nbsp;{{ $item->patient->pendidikan ?? '-' }}
                                                    </div>
                            
                                                    {{-- Pekerjaan --}}
                                                    <div class="col col-4">
                                                        <label for="basic-default-name" class="col-form-label">Pekerjaan</label>
                                                    </div>
                                                    <div class="col col-8">
                                                        : &nbsp;&nbsp;&nbsp;{{ $item->patient->job->name ?? '-' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col col-12 col-lg-6">
                                            <div class="card shadow-sm p-3">
                                                <div class="row px-5 container">
                                                    {{-- Alamat --}}
                                                    <div class="col col-5">
                                                        <label for="basic-default-name" class="col-form-label">Alamat</label>
                                                    </div>
                                                    <div class="col col-7">
                                                        : &nbsp;&nbsp;&nbsp;{{ $item->patient->alamat ?? '-' }}
                                                    </div>
                            
                                                    {{-- RT --}}
                                                    <div class="col col-5">
                                                        <label for="basic-default-name" class="col-form-label">RT</label>
                                                    </div>
                                                    <div class="col col-7">
                                                        : &nbsp;&nbsp;&nbsp;{{ $item->patient->rt ?? '-' }}
                                                    </div>
                            
                                                    {{-- RW --}}
                                                    <div class="col col-5">
                                                        <label for="basic-default-name" class="col-form-label">RW</label>
                                                    </div>
                                                    <div class="col col-7">
                                                        : &nbsp;&nbsp;&nbsp;{{ $item->patient->rw ?? '-' }}
                                                    </div>
                            
                                                    {{-- Provinsi --}}
                                                    <div class="col col-5">
                                                        <label for="basic-default-name" class="col-form-label">Provinsi</label>
                                                    </div>
                                                    <div class="col col-7">
                                                        : &nbsp;&nbsp;&nbsp;{{ $item->patient->province->name ?? '-' }}
                                                    </div>
                            
                                                    {{-- Kabupaten --}}
                                                    <div class="col col-5">
                                                        <label for="basic-default-name" class="col-form-label">Kabupaten</label>
                                                    </div>
                                                    <div class="col col-7">
                                                        : &nbsp;&nbsp;&nbsp;{{ $item->patient->city->name ?? '-' }}
                                                    </div>
                            
                                                    {{-- Kecamatan --}}
                                                    <div class="col col-5">
                                                        <label for="basic-default-name" class="col-form-label">Kecamatan</label>
                                                    </div>
                                                    <div class="col col-7">
                                                        : &nbsp;&nbsp;&nbsp;{{ $item->patient->district->name ?? '-' }}
                                                    </div>
                            
                                                    {{-- Kelurahan / Desa --}}
                                                    <div class="col col-5">
                                                        <label for="basic-default-name" class="col-form-label">Kelurahan / Desa</label>
                                                    </div>
                                                    <div class="col col-7">
                                                        : &nbsp;&nbsp;&nbsp;{{ $item->patient->village->name ?? '-' }}
                                                    </div>
                            
                                                    {{-- bangsa --}}
                                                    <div class="col col-5">
                                                        <label for="basic-default-name" class="col-form-label">Kewarganegaraan</label>
                                                    </div>
                                                    <div class="col col-7">
                                                        : &nbsp;&nbsp;&nbsp;{{ $item->patient->bangsa ?? '-' }}
                                                    </div>
                            
                                                    {{-- Suku --}}
                                                    <div class="col col-5">
                                                        <label for="basic-default-name" class="col-form-label">Suku Bangsa</label>
                                                    </div>
                                                    <div class="col col-7">
                                                        : &nbsp;&nbsp;&nbsp;{{ $item->patient->suku ?? '-' }}
                                                    </div>
                            
                                                    {{-- alergi --}}
                                                    <div class="col col-5">
                                                        <label for="basic-default-name" class="col-form-label">Daftar Alergi Pasien</label>
                                                    </div>
                                                    <div class="col col-7">
                                                        : &nbsp;&nbsp;&nbsp;{{ $item->patient->alergi ?? '-' }}
                                                    </div>
                            
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="list-kunjungan-terakhir">
                                  Muffin lemon drops chocolate chupa chups jelly beans dessert jelly-o. Soufflé gummies gummies. Ice cream powder marshmallow cotton candy oat cake wafer. Marshmallow gingerbread tootsie roll. Chocolate cake bonbon jelly beans lollipop jelly beans halvah marzipan danish pie. Oat cake chocolate cake pudding bear claw liquorice gingerbread icing sugar plum brownie. Toffee cookie apple pie cheesecake bear claw sugar plum wafer gummi bears fruitcake. 
                                </div>
                                <div class="tab-pane fade" id="list-rawat-jalan">
                                    @foreach ($riwKunjungans as $kunj)
                                        <div class="accordion accordion-header-primary" id="accordionStyle{{ $loop->iteration ?? '' }}">
                                            <div class="accordion-item card border">
                                                <h2 class="accordion-header">
                                                    <button type="button" class="accordion-button collapsed text-uppercase" data-bs-toggle="collapse" data-bs-target="#accordionStyle{{ $loop->iteration }}-1" aria-expanded="false">
                                                    {{ $kunj->dpjp->poliklinik->name ?? '' }} - {{ $kunj->dpjp->name ?? '' }}
                                                    </button>
                                                </h2>
                                            
                                                <div id="accordionStyle{{ $loop->iteration }}-1" class="accordion-collapse collapse" data-bs-parent="#accordionStyle1">
                                                    <div class="accordion-body">
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
                                                                @if ($kunj->soapDokter)     
                                                                    <tr>
                                                                        <td>{{ $kunj->soapDokter->created_at->format('d M Y') ?? '' }}</td>
                                                                        <td>{{ $kunj->soapDokter->user->name ?? '' }}</td>
                                                                        <td>
                                                                            <p class="fw-bold mb-0">SUBJECTIVE:</p>
                                                                            <p class="multi-line-text">{{ $kunj->soapDokter->subjective ?? '' }}</p>
                                                                            <p class="fw-bold mb-0">OBJECTIVE:</p>
                                                                            <p class="multi-line-text">{{ $kunj->soapDokter->objective ?? '' }}</p>
                                                                            <p class="fw-bold mb-0">ASSESMENT:</p>
                                                                            <p class="multi-line-text">{{ $kunj->soapDokter->asesment ?? '' }}</p>
                                                                            <p class="fw-bold mb-0">PLANNING:</p>
                                                                            <p class="multi-line-text">{{ $kunj->soapDokter->planning ?? '' }}</p>
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
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="tab-pane fade" id="list-laboratorium">
                                  Marzipan cake oat cake. Marshmallow pie chocolate. Liquorice oat cake donut halvah jelly-o. Jelly-o muffin macaroon cake gingerbread candy cupcake. Cake lollipop lollipop jelly brownie cake topping chocolate. Pie oat cake jelly. Lemon drops halvah jelly cookie bonbon cake cupcake ice cream. Donut tart bonbon sweet roll soufflé gummies biscuit. Wafer toffee topping jelly beans icing pie apple pie toffee pudding. Tiramisu powder macaroon tiramisu cake halvah. 
                                </div>
                                <div class="tab-pane fade" id="list-radiologi">
                                  Marzipan cake oat cake. Marshmallow pie chocolate. Liquorice oat cake donut halvah jelly-o. Jelly-o muffin macaroon cake gingerbread candy cupcake. Cake lollipop lollipop jelly brownie cake topping chocolate. Pie oat cake jelly. Lemon drops halvah jelly cookie bonbon cake cupcake ice cream. Donut tart bonbon sweet roll soufflé gummies biscuit. Wafer toffee topping jelly beans icing pie apple pie toffee pudding. Tiramisu powder macaroon tiramisu cake halvah. 
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

    {{-- Menu Rajal Dokter --}}
    <div class="card">
        <div class="card-body">
            <div class="nav-align-top mb-2 shadow-sm">
                <ul class="nav nav-tabs nav-sm nav-fill" role="tablist">
                    <li class="nav-item">
                        <button id="btn-link" type="button"
                            class="nav-link {{ session('tab') == 'diagnosa' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-diagnosa"
                            aria-controls="navs-justified-diagnosa" aria-selected="false">
                            <i class='bx bx-accessibility me-1'></i>
                            <p class="m-0">Diagnosa</p>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button id="btn-link" type="button"
                            class="nav-link {{ session('tab') == 'prosedur' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-prosedur"
                            aria-controls="navs-justified-prosedur" aria-selected="false">
                            <i class='bx bx-accessibility me-1'></i>
                            <p class="m-0">Prosedur</p>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button"
                            class="nav-link d-flex justify-content-center {{ session('tab') == 'tindakan' ? 'active' : '' }}"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-tindakan"
                            aria-controls="navs-justified-tindakan" aria-selected="false">
                            <i class="tf-icons bx bx-sitemap"></i>
                            <p class="m-0">Tindakan</p>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button id="btn-link" type="button"
                            class="nav-link {{ session('tab') == 'cppt' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-cppt"
                            aria-controls="navs-justified-cppt" aria-selected="false">
                            <i class='bx bxs-analyse me-1'></i>
                            <p class="m-0">SOAP</p>
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade {{ session('tab') == 'diagnosa' ? 'show active' : '' }}" id="navs-justified-diagnosa" role="tabpanel">
                        <form action="{{ route('diagnosa/patient.update', $item->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label for="diagnostic_primer_id" class="form-label">Diagnosa Primer</label>
                                    <select class="form-select form-select-md select2-w-placeholder" name="diagnostic_primer_id" id="diagnostic_primer_id" style="width: 100%">
                                        <option selected disabled></option>
                                        @foreach ($diagnostics as $diagnosa)
                                            @if (($item->diagnosticProcedurePatient->diagnostic_id ?? null) == $diagnosa->id)
                                                <option value="{{ $diagnosa->id ?? '' }}" selected>{{ $diagnosa->icd_x_code ?? '...' }} - {{ $diagnosa->name ?? '...' }}</option>
                                            @else
                                                <option value="{{ $diagnosa->id ?? '' }}">{{ $diagnosa->icd_x_code ?? '...' }} - {{ $diagnosa->name ?? '...' }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="diagnosa_primer_text" class="form-label"></label>
                                    <textarea name="diagnosa_primer_text" id="diagnosa_primer_text" class="form-control" cols="50" rows="4" placeholder="Gunakan kolom ini untuk input diagnosa primer secara bebas / tidak sesuai dengan kode ICD 10">{{ $item->diagnosticProcedurePatient->desc_diagnosa_primer ?? '' }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    @if ($item->diagnosticProcedurePatient && $item->diagnosticProcedurePatient->diagnosticSecondary->isNotEmpty())
                                        @foreach ($item->diagnosticProcedurePatient->diagnosticSecondary as $index => $sekunder)     
                                        <div class="row dinamic-input {{ $loop->last ? '' : 'mb-2' }}">
                                            @if ($loop->first)
                                                <label class="form-label">Diagnosa Sekunder</label>
                                            @endif
                                            <div class="col-10">
                                                <select name="diagnostic_sekunder_id[]" class="select2-w-placeholder js-states form-control" id="diagnostic_sekunder_ids_{{ $index }}" style="width: 100%">
                                                    <option selected disabled></option>
                                                    @foreach ($diagnostics as $diagnosa)
                                                        @if (($sekunder->diagnostic_id ?? null) == $diagnosa->id)
                                                            <option value="{{ $diagnosa->id ?? '' }}" selected>{{ $diagnosa->icd_x_code ?? '...' }} - {{ $diagnosa->name ?? '...' }}</option>
                                                        @else
                                                            <option value="{{ $diagnosa->id ?? '' }}">{{ $diagnosa->icd_x_code ?? '...' }} - {{ $diagnosa->name ?? '...' }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-2">
                                                <label for="" class="form-label"></label>
                                                @if ($loop->last)
                                                    <button class="btn btn-dark btn-sm mt-1" onclick="setContentToDinamicInput(this)" type="button">+</button>
                                                @else
                                                    <button class="btn btn-danger btn-sm mt-1" onclick="removeInputDinamic(this)" type="button">-</button>
                                                @endif
                                            </div>
                                        </div>         
                                        @endforeach
                                    @else
                                        <div class="row dinamic-input">
                                            <label class="form-label">Diagnosa Sekunder</label>
                                            <div class="col-10">
                                                <select name="diagnostic_sekunder_id[]" class="select2-w-placeholder js-states form-control" id="diagnostic_sekunder_id" style="width: 100%">
                                                    <option selected disabled></option>
                                                    @foreach ($diagnostics as $diagnosa)
                                                        <option value="{{ $diagnosa->id ?? '' }}">{{ $diagnosa->icd_x_code ?? '...' }} - {{ $diagnosa->name ?? '...' }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-2">
                                                <label for="" class="form-label"></label>
                                                <button class="btn btn-dark btn-sm mt-1" onclick="setContentToDinamicInput(this)" type="button">+</button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-6">
                                    <label for="diagnosa_sekunder_text" class="form-label"></label>
                                    <textarea name="diagnosa_sekunder_text" id="diagnosa_sekunder_text" class="form-control" cols="50" rows="4" placeholder="Gunakan kolom ini untuk input diagnosa sekunder secara bebas / tidak sesuai dengan kode ICD 10">{{ $item->diagnosticProcedurePatient->desc_diagnosa_sekunder ?? '' }}</textarea>
                                </div>
                                <div class="ms-auto mt-2">
                                    <button type="submit" class="btn btn-md btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade {{ session('tab') == 'prosedur' ? 'show active' : '' }}" id="navs-justified-prosedur" role="tabpanel">
                        <form action="{{ route('procedure/patient.update', $item->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label for="procedure_id" class="form-label">Prosedur</label>
                                    <select class="form-select form-select-md select2-w-placeholder" name="procedure_id" id="procedure_id" style="width: 100%">
                                        <option selected disabled></option>
                                        @foreach ($procedures as $prosedur)
                                            @if (($item->diagnosticProcedurePatient->procedure_id ?? null) == $prosedur->id)
                                                <option value="{{ $prosedur->id ?? '' }}" selected>{{ $prosedur->icd_ix_code ?? '...' }} - {{ $prosedur->name ?? '...' }}</option>
                                            @else
                                                <option value="{{ $prosedur->id ?? '' }}">{{ $prosedur->icd_ix_code ?? '...' }} - {{ $prosedur->name ?? '...' }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="procedure_text" class="form-label"></label>
                                    <textarea name="procedure_text" id="procedure_text" class="form-control" cols="50" rows="4" placeholder="Gunakan kolom ini untuk input prosedur secara bebas / tidak sesuai dengan kode ICD 9">{{ $item->diagnosticProcedurePatient->desc_prosedure ?? '' }}</textarea>
                                </div>
                                <div class="ms-auto mt-2">
                                    <button type="submit" class="btn btn-md btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade {{ session('tab') == 'tindakan' ? 'show active' : '' }}" id="navs-justified-tindakan" role="tabpanel">
                        @if ($item->patientActionReport)
                        <div class="row">
                            <div class="col-6 my-2 text-start">
                                <a href="{{ route('rajal/laporan/tindakan.show', $item->patientActionReport->id) }}" target="blank" class="btn btn-info btn-sm"><i class='bx bx-printer'></i></a>
                            </div>
                            <div class="col-6 my-2 text-end">
                                @if ($item->kasirPatient && $item->kasirPatient->billingDoctorActions)    
                                    <div class="d-flex justify-content-end">
                                        <h5 class="fw-bold me-2">Status Tagihan Tindakan :</h5>
                                        <div>
                                            @if ($item->rawatJalanPoliPatient->actions_ready == false && !$item->kasirPatient->billingDoctorActions->isEmpty())            
                                                <span class="badge bg-danger">REVISI</span>
                                            @elseif ($item->rawatJalanPoliPatient->actions_ready == true && !$item->kasirPatient->billingDoctorActions->isEmpty())
                                                <span class="badge bg-primary">DIKIRIM</span>
                                            @elseif ($item->rawatJalanPoliPatient->actions_ready == false && $item->kasirPatient->billingDoctorActions->isEmpty())    
                                                <span class="badge bg-info">MENUNGGU VERIFIKASI</span>
                                            @else
                                                <span class="badge bg-danger">TIDAK DIKETAHUI</span>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="card-body table-wrapper outer-wrapper">
                            <table class="table-border w-100 mt-4">
                                <tbody>
                                    <tr>
                                        <td class="p-2">
                                            <div class="row">
                                                <div class="col-3 fw-bold">Tanggal Tindakan</div>
                                                <div class="col-1 text-center">:</div>
                                                <div class="col-5">{{ date('Y-m-d', strtotime($item->patientActionReport->tgl_tindakan ?? '')) }}</div>
                                                <div class="col-3">
                                                    <div class="d-flex flex-row">
                                                        <div class="fw-bold">Jam Tindakan</div>
                                                        <div class="px-2">:</div>
                                                        <div class="">{{ date('H:i', strtotime($item->patientActionReport->tgl_tindakan ?? '')) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 pb-5 pt-2">
                                            <div class="row">
                                                <div class="col-3 fw-bold">Laporan Tindakan</div>
                                                <div class="col-1 text-center">:</div>
                                                <div class="col-8">{!! $item->patientActionReport->laporan_tindakan ?? '' !!}</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-2 pb-5 pt-4">
                                            <table class="table-bordered w-100 mt-0 small">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center p-1">Nama Tindakan</th>
                                                        <th class="text-center p-1">Jumlah</th>
                                                        <th class="text-center p-1">Tarif</th>
                                                        <th class="text-center p-1">Subtotal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($item->patientActionReport->patientActionReportDetails as $detail)
                                                        <tr>
                                                            <td class="text-center p-1">{{ $detail->action->name ?? '' }}</td>
                                                            <td class="text-center p-1">{{ $detail->jumlah ?? '' }}</td>
                                                            <td class="text-center p-1">{{ number_format($detail->harga_satuan ?? '') }}</td>
                                                            <td class="text-center p-1">{{ number_format($detail->sub_total ?? '') }}</td>
                                                        </tr>
                                                    @endforeach
                                                    <tr class="fw-bold">
                                                        <td colspan="3" class="text-center">Total Akhir</td>
                                                        <td class="text-center">{{ number_format($item->patientActionReport->patientActionReportDetails->sum('sub_total')) }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                
                                            <div class="row justify-content-end mt-5">
                                                <div class="col-4">
                                                    <p class="mt-5 text-center fw-bold mb-0">
                                                        Dokter Penanggung Jawab Pasien
                                                    </p>
                                                    @if ($item->patientActionReport->ttd)
                                                        <p class="text-center">
                                                            <img src="{{ Storage::url($item->patientActionReport->ttd ?? '') }}" alt=""
                                                                class="img-fluid mb-0" style="max-width: 150px">
                                                        </p>
                                                    @else
                                                        <br /><br /><br />
                                                    @endif
                                                    <p class="text-center">
                                                        (&nbsp;{{ $item->patientActionReport->user->name ?? '.....................................' }}&nbsp;)
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="col-12 bg-info text-white p-2">
                            <i class="bx bx-info-circle"></i> Tidak Ada Tindakan
                        </div>
                        @endif
                    </div>
                    <div class="tab-pane fade {{ session('tab') == 'cppt' ? 'show active' : '' }}" id="navs-justified-cppt" role="tabpanel">
                        <div class="row mb-5">
                            <div class="col-sm-3">
                                <label for="subjective" class="form-label">Subjective</label>
                                @if ($item->soapDokter)
                                    <textarea name="subjective" id="subjective" class="form-control" rows="10" placeholder="Subjective" disabled>{!! $item->soapDokter->subjective ?? '' !!} </textarea>
                                @else
                                    <textarea name="subjective" id="subjective" class="form-control" rows="10" placeholder="Subjective" disabled>Keluhan: {{ ($itemAss->keluhan_utama ?? '') . "\r\nRiw. " .($item->perawatInitialAssesment->riw_penyakit_pasien ?? '') }} </textarea>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <label for="objective" class="form-label">Objective</label>
                                @if ($item->soapDokter)
                                    <textarea name="objective" id="objective" class="form-control" rows="10" placeholder="Objective" disabled>{!! $item->soapDokter->objective ?? '' !!}</textarea>
                                @else
                                    <textarea name="objective" id="objective" class="form-control" rows="10" placeholder="Objective" disabled>{{ "Keadaan Umum: " . ($itemAss->keadaan_umum ?? '') . "\r\n" . "Nadi: " . ($itemAss->nadi ?? '') . " bpm\r\n" . "Tekanan Darah: " . ($itemAss->td_sistolik ?? '') . " / " . ($itemAss->td_diastolik ?? '') . " mmHg\r\n" . "Suhu: " . ($itemAss->suhu ?? '') . " °C\r\n" . "Nafas: " . ($itemAss->nafas ?? '') . " x/menit\r\n" . "Tinggi Badan: " . ($itemAss->tb ?? '') . " cm\r\n" . "Berat Badan: " . ($itemAss->bb ?? '') . ' kg' }}</textarea>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <label for="asesmen" class="form-label">Assesment</label>
                                <textarea name="asesmen" id="asesmen" class="form-control" rows="10" placeholder="Assesment" disabled>{{ $item->soapDokter->asesment ?? '' }}</textarea>
                            </div>
                            <div class="col-sm-3">
                                <label for="planning" class="form-label">Planning</label>
                                <textarea name="planning" id="planning" class="form-control" rows="10" placeholder="Planning" disabled>{{ $item->soapDokter->planning ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end Menu Rajal Dokter --}}


    {{-- modal --}}
    <div class="modal fade" id="modalScrollable" tabindex="-1" aria-labelledby="modalScrollableTitle" aria-hidden="true">

    </div>

    <script>
        var elementAlert = document.getElementById('show-alert');     //untuk show alert
        var actions =  @json($dataTindakan);
        // untuk event trigger nav tab
        var buttons = document.querySelectorAll('#btn-link');
        buttons.forEach(function(button) {
            button.addEventListener('click', function() {
                buttons.forEach(function(btn) {
                    btn.classList.remove('active');
                });
                this.classList.add('active');
            });
        });
    </script>

    <script>
        let countInput = 0;
        function setContentToDinamicInput(element){
            countInput = countInput+1;
            var content = `
                <label for="diagnostic_sekunder_id_${countInput}" class="form-label"></label>
                <div class="col-10">
                    <select name="diagnostic_sekunder_id[]" class="select2-w-placeholder js-states form-control" id="diagnostic_sekunder_id_${countInput}" style="width: 100%">
                        <option selected disabled></option>
                        @foreach ($diagnostics as $diagnosa)
                            <option value="{{ $diagnosa->id ?? '' }}">{{ $diagnosa->icd_x_code ?? '...' }} - {{ $diagnosa->name ?? '...' }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-2">
                    <label for="" class="form-label"></label>
                    <button class="btn btn-danger btn-sm mt-1" type="button" onclick="removeInputDinamic(this)">-</button>
                </div>
            `;

            dinamicInput(element, content, `diagnostic_sekunder_id_${countInput}`, 'Pilih Dignosa Sesuai kode ICD 10', true);
        }

        function addDinamicTindakan(element) {
            countInput = countInput+1;
            const content = `<div class="col-5">
                                <select class="form-control" id="action_id_${countInput}" name="action_id[]" style="width: 100%" onchange="getDetailTindakan(this)">
                                <option value="" selected disabled></option>
                                @foreach ($dataTindakan as $action)
                                    <option value="{{ $action->id }}">{{ $action->name }}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="col-1">
                                <input type="number" class="form-control" name="jumlah_tindakan[]" value="1" onchange="countSubTotal(this)"/>
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control" name="tarif_tindakan[]" value="0" placeholder="Tarif Tindakan" readonly/>
                            </div>
                            <div class="col-3">
                                <input type="number" class="form-control" name="sub_total_tindakan[]" value="0" placeholder="Subtotal" readonly/>
                            </div>
                            <div class="col-1 text-center align-self-center">
                                <button class="btn btn-sm btn-danger" type="button" onclick="removeInputDinamic(this)">-</button>
                            </div>`;
            dinamicInput(element, content, `action_id_${countInput}`, 'Pilih Tindakan', true);
        }
    </script>

    <script>
        function getDetailTindakan(element){
            let elementJumlah = element.closest('.dinamic-input').querySelector('input[name="jumlah_tindakan[]"]');
            let elementTarif = element.closest('.dinamic-input').querySelector('input[name="tarif_tindakan[]"]');
            let elementSubTotal = element.closest('.dinamic-input').querySelector('input[name="sub_total_tindakan[]"]');
            
            let filteredAction = actions.find(function(item){
                return item.id == element.value;
            });
            if (filteredAction) {
                const rate = filteredAction.action_rates.find(function(rt){
                    return rt.patient_category_id === 1;
                });
                if (rate) {
                    elementTarif.value = rate.tarif ?? 0;
                    elementSubTotal.value = rate.tarif * elementJumlah.value;   
                } else {
                    elementJumlah.value = 1;
                    elementTarif.value = 0;
                    elementSubTotal.value = 0;
                    alertShow('Not Found !!', 'Tarif Untuk Tindakan ini belum diinputkan', elementAlert);
                }
            }else{
                elementJumlah.value = 1;
                elementTarif.value = 0;
                elementSubTotal.value = 0;
                alertShow('Not Found !!', 'Tindakan yang dipilih tidak ditemukan', elementAlert);
            }
        }
        function countSubTotal(element){
            let elementSubTotal = element.closest('.dinamic-input').querySelector('input[name="sub_total_tindakan[]"]');
            let elementTarif = element.closest('.dinamic-input').querySelector('input[name="tarif_tindakan[]"]');

            elementSubTotal.value = element.value * elementTarif.value;
        }
    </script>
    
    
@endsection
