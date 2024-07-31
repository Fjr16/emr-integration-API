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
                        {{ $item->patient->name }} ({{ implode('-', str_split(str_pad($item->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }})
                        <span class="ms-2 badge {{ $item->patient->jenis_kelamin == 'Wanita' ? 'bg-danger' : 'bg-info' }}">{{ $item->patient->jenis_kelamin == 'Wanita' ? 'P' : 'L' }}</span> 
                    </h4>
                    <h6 class="mb-1">{{ $item->dpjp->name }} ({{ $item->dpjp->staff_id }})</h6>
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
                                                            &nbsp;&nbsp;&nbsp;{{ implode('-', str_split(str_pad($item->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}
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
                            class="nav-link {{ session('btn') == 'riwayat' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-riwayat"
                            aria-controls="navs-justified-riwayat" aria-selected="false">
                            <i class='bx bxs-book-open me-1'></i>
                            <p class="m-0">Riwayat Poli</p>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button id="btn-link" type="button"
                            class="nav-link {{ session('btn') == 'asesmen' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-asesmen"
                            aria-controls="navs-justified-asesmen" aria-selected="false">
                            <i class='bx bxs-notepad me-1'></i>
                            <p class="m-0">Asesmen</p>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button id="btn-link" type="button"
                            class="nav-link {{ session('btn') == 'penunjang' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-profile"
                            aria-controls="navs-justified-profile" aria-selected="false">
                            <i class='bx bxs-factory me-1'></i>
                            <p class="m-0">Penunjang</p>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button id="btn-link" type="button"
                            class="nav-link {{ session('btn') == 'diag-tind' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-diag-tind"
                            aria-controls="navs-justified-diag-tind" aria-selected="false">
                            <i class='bx bx-accessibility me-1'></i>
                            <p class="m-0">Diagnosa & Prosedur</p>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button"
                            class="nav-link d-flex justify-content-center {{ session('btn') == 'resep dokter' ? 'active' : '' }}"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-resep"
                            aria-controls="navs-justified-resep" aria-selected="false">
                            <i class='bx bxs-detail me-1'></i>
                            <p class="m-0">Resep Obat</p>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button"
                            class="nav-link d-flex justify-content-center {{ session('btn') == 'tindakan' ? 'active' : '' }}"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-tindakan"
                            aria-controls="navs-justified-tindakan" aria-selected="false">
                            <i class="tf-icons bx bx-sitemap"></i>
                            <p class="m-0">Tindakan</p>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button id="btn-link" type="button"
                            class="nav-link {{ session('btn') == 'kontrol-ulang' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-kontrol-ulang"
                            aria-controls="navs-justified-kontrol-ulang" aria-selected="false">
                            <i class='bx bx-calendar me-1'></i>
                            <p class="m-0">Kontrol Ulang</p>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button id="btn-link" type="button"
                            class="nav-link {{ session('btn') == 'cppt' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-cppt"
                            aria-controls="navs-justified-cppt" aria-selected="false">
                            <i class='bx bxs-analyse me-1'></i>
                            <p class="m-0">SOAP</p>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button"
                            class="nav-link d-flex justify-content-center {{ session('btn') == 'finished' ? 'active' : '' }}"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-finished"
                            aria-controls="navs-justified-finished" aria-selected="false">
                            <i class='bx bx-check-double me-1'></i>
                            <p class="m-0">Selesai</p>
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade {{ session('btn') == 'riwayat' ? 'show active' : '' }}" id="navs-justified-riwayat" role="tabpanel">
                        <div class="row">
                            <div class="col-md-2 col-12 mb-3 mb-md-0">
                              <div class="list-group">
                                <a class="list-group-item list-group-item-action active" id="list-kunj-terakhir-list" data-bs-toggle="list" href="#list-kunj-terakhir">Kunjungan Terakhir</a>
                                <a class="list-group-item list-group-item-action" id="list-rencana-kontrol-list" data-bs-toggle="list" href="#list-rencana-kontrol">Rencana Kontrol</a>
                                <a class="list-group-item list-group-item-action" id="list-rencana-kontrol-list" data-bs-toggle="list" href="#list-rencana-kontrol">Berkas</a>
                              </div>
                            </div>
                            <div class="col-md-10 col-12 border">
                              <div class="tab-content">
                                <div class="tab-pane fade show active" id="list-kunj-terakhir">
                                  Donut sugar plum sweet roll biscuit. Cake oat cake gummi bears. Tart wafer wafer halvah gummi bears cheesecake. Topping croissant cake sweet roll. Dessert fruitcake gingerbread halvah marshmallow pudding bear claw cheesecake. Bonbon dragée cookie gummies. Pudding marzipan liquorice. Sugar plum dragée cupcake cupcake cake dessert chocolate bar. Pastry lollipop lemon drops lollipop halvah croissant. Pastry sweet gingerbread lemon drops topping ice cream.
                                </div>
                                <div class="tab-pane fade" id="list-rencana-kontrol">
                                    survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade {{ session('btn') == 'asesmen' ? 'show active' : '' }}"
                        id="navs-justified-asesmen" role="tabpanel">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="nav-align-top w-100 mb-4">
                                    <ul class="nav nav-pills nav-sm mb-3 nav-fill" role="tablist">
                                        <li class="nav-item">
                                            <button type="button"
                                                class="border nav-link {{ session('asesmen') == 'dokter' ? 'active' : '' }}"
                                                role="tab" data-bs-toggle="tab"
                                                data-bs-target="#navs-pills-justified-dokter"
                                                aria-controls="navs-pills-justified-dokter" aria-selected="true">
                                                Dokter
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button type="button"
                                                class="border nav-link {{ session('asesmen') == 'perawat' ? 'active' : '' }}"
                                                role="tab" data-bs-toggle="tab"
                                                data-bs-target="#navs-pills-justified-perawat"
                                                aria-controls="navs-pills-justified-perawat" aria-selected="true">
                                                Perawat
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button type="button"
                                                class="border nav-link {{ session('asesmen') == 'berkas' ? 'active' : '' }}"
                                                role="tab" data-bs-toggle="tab"
                                                data-bs-target="#navs-pills-justified-berkas"
                                                aria-controls="navs-pills-justified-berkas" aria-selected="true">
                                                Berkas
                                            </button>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade {{ session('asesmen') == 'dokter' ? 'show active' : '' }}" id="navs-pills-justified-dokter" role="tabpanel">
                                            <form action="{{ route('assesmen/awal/dokter.update', $item->id) }}" method="POST">
                                                @method('PUT')
                                                @csrf
                                                <div class="card-body pt-0">
                                                    <div class="row mb-4">
                                                        <div class="col-12">
                                                            <label class="form-label fw-bold">Anamnesa / Keluhan Utama</label>
                                                            <textarea id="editor5" class="form-control" id="keluhan_utama" name="keluhan_utama" rows="4" placeholder="Keluhan Utama Pasien">{{ $item->doctorInitialAssesment->keluhan_utama ?? '' }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-4">
                                                        <div class="col-sm-6">
                                                            <label class="form-label fw-bold my-0">Keadaan Umum</label>
                                                            <div class="col-sm">
                                                                <div class="form-check form-check-inline mt-3">
                                                                <input class="form-check-input" type="radio" name="keadaan_umum" id="keadaan-umum1" value="Baik" {{ ($item->doctorInitialAssesment->keadaan_umum ?? '') == 'Baik' ? 'checked' : '' }}/>
                                                                <label class="form-check-label" for="keadaan-umum1">Baik</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="keadaan_umum" id="keadaan-umum2" value="Lemas" {{ ($item->doctorInitialAssesment->keadaan_umum ?? '') == 'Lemas' ? 'checked' : '' }}/>
                                                                <label class="form-check-label" for="keadaan-umum2">Lemas</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="keadaan_umum" id="keadaan-umum3" value="Sakit Ringan" {{ ($item->doctorInitialAssesment->keadaan_umum ?? '') == 'Sakit Ringan' ? 'checked' : '' }}/>
                                                                <label class="form-check-label" for="keadaan-umum3">Sakit Ringan</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="keadaan_umum" id="keadaan-umum4" value="Sakit Sedang" {{ ($item->doctorInitialAssesment->keadaan_umum ?? '') == 'Sakit Sedang' ? 'checked' : '' }}/>
                                                                <label class="form-check-label" for="keadaan-umum4">Sakit Sedang</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="keadaan_umum" id="keadaan-umum5" value="Sakit Berat" {{ ($item->doctorInitialAssesment->keadaan_umum ?? '') == 'Sakit Berat' ? 'checked' : '' }}/>
                                                                <label class="form-check-label" for="keadaan-umum5">Sakit Berat</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label class="form-label fw-bold">Kesadaran</label>
                                                            <input type="text" name="kesadaran" class="form-control form-control-md" placeholder="Tingkat Kesadaran" value="{{ $item->doctorInitialAssesment->kesadaran ?? '' }}">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-4">
                                                        <div class="col-6">
                                                            <label class="form-label fw-bold">Tinggi Badan</label>
                                                            <div class="input-group">
                                                                <input class="form-control" id="tb" name="tb" value="{{ $item->doctorInitialAssesment->tb ?? '' }}" placeholder="Tinggi Badan"></input>
                                                                <span class="input-group-text">cm</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <label class="form-label fw-bold">Berat Badan</label>
                                                            <div class="input-group">
                                                                <input class="form-control" id="bb" name="bb" value="{{ $item->doctorInitialAssesment->bb ?? '' }}" placeholder="Berat Badan"></input>
                                                                <span class="input-group-text">kg</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-12 mb-3">
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <label class="form-label fw-bold ">Nadi</label>
                                                                    <div class="input-group">
                                                                        <input type="number" step="0.01" name="nadi" class="form-control" aria-describedby="nadi" placeholder="0.00" value="{{ $item->doctorInitialAssesment->nadi ?? '' }}">
                                                                        <span class="input-group-text" id="nadi">bpm</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label class="form-label fw-bold">Tekanan Darah</label>
                                                                    <div class="input-group">
                                                                        <input type="number" step="0.01" name="td_sistolik" class="form-control" aria-describedby="td_sistolik" placeholder="0.00" value="{{ $item->doctorInitialAssesment->td_sistolik ?? '' }}">
                                                                        <span class="input-group-text" id="td_sistolik">/</span>
                                                                        <input type="number" step="0.01" name="td_diastolik" class="form-control" aria-describedby="td_diastolik" placeholder="0.00" value="{{ $item->doctorInitialAssesment->td_diastolik ?? '' }}">
                                                                        <span class="input-group-text" id="td_diastolik">mmHg</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 mb-3">
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <label class="form-label fw-bold">Suhu</label>
                                                                    <div class="input-group">
                                                                        <input type="number" step="0.01" name="suhu" class="form-control" aria-describedby="suhu" placeholder="0.00" value="{{ $item->doctorInitialAssesment->suhu ?? '' }}">
                                                                        <span class="input-group-text" id="suhu">°C</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label class="form-label fw-bold">Nafas</label>
                                                                    <div class="input-group">
                                                                        <input type="number" name="nafas" class="form-control" aria-describedby="nafas" placeholder="0" value="{{ $item->doctorInitialAssesment->nafas ?? '' }}">
                                                                        <span class="input-group-text" id="nafas">x/menit</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold">Dokter Penanggung Jawab Pasien</label>
                                                        <input type="text" class="form-control" value="{{ $item->dpjp->name ?? '' }}" @disabled(true)>
                                                    </div>
                                                </div>
                                                <div class="mb-3 text-end">
                                                    <button type="submit" class="btn btn-primary btn-sm mx-3">{{ $item->doctorInitialAssesment ? 'Update' : 'Submit' }}</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade {{ session('asesmen') == 'perawat' ? 'show active' : '' }}" id="navs-pills-justified-perawat" role="tabpanel">
                                            <div class="card">
                                                <div class="card-header pb-0">
                                                    <div class="row">
                                                        <div class="col-8 align-self-center ps-4">
                                                            <h5 class="mb-2">ASESMEN AWAL KEPERAWATAN</h5>
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
                                                                    <td>{{ implode('-', str_split(str_pad($item->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}
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
                                                            {{ $itemAss->keluhan_utama ?? '' }}
                                                        </div>
                                                    </div>
                                    
                                                    <span class="text-dark fw-bold">STATUS FISIK</span>
                                                    <hr class="my-1">
                                                    <div class="row mb-3">
                                                        <div class="col-6">
                                                            <label class="col-form-label fw-bold">Kesadaran :</label>
                                                            <div class="">
                                                                {{ $itemAss->kesadaran ?? '' }}
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <label class="col-form-label fw-bold">Keadaan Umum :</label>
                                                            <div class="">{{ $itemAss->keadaan_umum ?? '' }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-4">
                                                            <label class="col-form-label fw-bold">Tinggi Badan :</label>
                                                            <div class="d-flex">
                                                                <p>{{ $itemAss->tb ?? '...' }}</p>
                                                                <span class="ms-2 fst-italic">cm</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <label class="col-form-label fw-bold">Berat Badan :</label>
                                                             <div class="d-flex">
                                                                <p>{{ $itemAss->bb ?? '...' }}</p>
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
                                                                <p>{{ $itemAss->nadi ?? '...' }}</p>
                                                                <span class="ms-2 fst-italic">bpm</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <label class="col-form-label fw-bold">Tekanan Darah</label>
                                                            <div class="d-flex">
                                                                <p>{{ $itemAss->td_sistolik ?? '...' }} / {{ $itemAss->td_diastolik ?? '...' }}</p>
                                                                <span class="ms-2 fst-italic">mmHg</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-6">
                                                            <label class="col-form-label fw-bold">Suhu Badan</label>
                                                            <div class="d-flex">
                                                                <p>{{ $itemAss->suhu ?? '...' }}</p>
                                                                <span class="ms-2 fst-italic">°C</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <label class="col-form-label fw-bold">Nafas</label>
                                                            <div class="d-flex">
                                                                <p>{{ $itemAss->nafas ?? '...' }}</p>
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
                                                    <div class="row mx-4">
                                                        <div class="text-end align-self-center">
                                                            <p class="mb-0">Padang, {{ $itemAss ? ($itemAss->created_at->format('d M Y') ?? 'Unknown') : '' }}</p>
                                                            <p class="mb-1 fw-bold">Perawat,</p>
                                                            <img src="{{ $itemAss ? (asset('storage/' . $itemAss->ttd ?? '')) : '' }}" width="150" alt="">
                                                            <p class="fw-bold">{{ $itemAss ? ($itemAss->user->name ?? '') : '' }}</p>
                                                        </div>
                                                    </div>
                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade {{ session('asesmen') == 'berkas' ? 'show active' : '' }}"
                                            id="navs-pills-justified-berkas" role="tabpanel">
                                          
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade {{ session('btn') == 'penunjang' ? 'show active' : '' }}"
                        id="navs-justified-profile" role="tabpanel">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="nav-align-top w-100 mb-4">
                                    <ul class="nav nav-pills nav-sm mb-3 nav-fill" role="tablist">
                                        <li class="nav-item">
                                            <button type="button"
                                                class="border nav-link {{ session('penunjang') == 'radiologi' ? 'active' : '' }}"
                                                role="tab" data-bs-toggle="tab"
                                                data-bs-target="#navs-pills-justified-radiologi"
                                                aria-controls="navs-pills-justified-radiologi" aria-selected="true">
                                                Permintaan Radiologi
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button type="button"
                                                class="border nav-link {{ session('penunjang') == 'laboratorium' ? 'active' : '' }}"
                                                role="tab" data-bs-toggle="tab"
                                                data-bs-target="#navs-pills-justified-laboratorium"
                                                aria-controls="navs-pills-justified-laboratorium" aria-selected="true">
                                                Permintaan Laboratorium
                                            </button>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade {{ session('penunjang') == 'radiologi' ? 'show active' : '' }}"
                                            id="navs-pills-justified-radiologi" role="tabpanel">
                                            <div class="text-end">
                                                <a href="{{ route('rajal/permintaan/radiologi.create', $item->id) }}"
                                                    class="btn btn-success btn-sm">+Tambah Permintaan</a>
                                            </div>
                                            <table class="table">
                                                <thead>
                                                    <tr class="text-nowrap">
                                                        <th class="text-body">No</th>
                                                        <th class="text-body">Dokter</th>
                                                        <th class="text-body">Asal Ruang</th>
                                                        <th class="text-body">Diagnosa Klinis</th>
                                                        <th class="text-body">Tanggal</th>
                                                        <th class="text-body">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($item->patient->radiologiFormRequests()->orderBy('created_at', 'DESC')->get() as $radiologi)
                                                        <tr class="{{ $item->id == $radiologi->queue->id ? 'text-success' : '' }}">
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $radiologi->user->name ?? '' }}
                                                                ({{ $radiologi->user->staff_id ?? '' }})
                                                            </td>
                                                            <td>{{ $radiologi->queue->dpjp->poliklinik->name ?? '' }}</td>
                                                            {{-- <td>{{ $radiologi->poliklinik->name ?? '' }}</td> --}}
                                                            <td>{!! $radiologi->diagnosa_klinis ?? '' !!}</td>
                                                            <td>{{ $radiologi->created_at->format('Y-m-d / H:i:s') }}</td>
                                                            <td>
                                                                <div class="d-flex align-self-center">
                                                                    <a href="{{ route('rajal/permintaan/radiologi.show', ['queue_id' => $item->id, 'radiologi_id' => $radiologi->id]) }}"
                                                                        target="blank" class="btn btn-dark btn-sm mx-2"><i
                                                                            class='bx bx-printer'></i></a>
                                                                    @if ($radiologi->status == 'FINISHED' || $radiologi->status == 'ONGOING')
                                                                        <button type="button" class="btn btn-info btn-sm"><i class='bx bx-file'></i></button>
                                                                    @else    
                                                                        <a href="{{ route('rajal/permintaan/radiologi.edit', ['queue_id' => $item->id, 'radiologi_id' => $radiologi->id]) }}"
                                                                            class="btn btn-warning btn-sm me-2"><i
                                                                                class='bx bx-edit'></i></a>
                                                                            <form
                                                                                action="{{ route('rajal/permintaan/radiologi.destroy', $radiologi->id) }}"
                                                                                method="POST">
                                                                                @method('DELETE')
                                                                                @csrf
                                                                                <button type="submit"
                                                                                    class="btn btn-sm btn-danger"><i
                                                                                        class="bx bx-trash"></i></button>
                                                                            </form>
                                                                    @endif
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade {{ session('penunjang') == 'laboratorium' ? 'show active' : '' }}"
                                            id="navs-pills-justified-laboratorium" role="tabpanel">
                                            <div class="text-end">
                                                <a href="{{ route('rajal/laboratorium/request.index', $item->id) }}"
                                                    class="btn btn-success btn-sm">+Tambah Permintaan</a>
                                            </div>
                                            <table class="table">
                                                <thead>
                                                    <tr class="text-nowrap">
                                                        <th class="text-body">No</th>
                                                        <th class="text-body">Dokter</th>
                                                        <th class="text-body">Asal Ruang</th>
                                                        <th class="text-body">Diagnosa</th>
                                                        <th class="text-body">Kategori</th>
                                                        <th class="text-body">Tgl. Ambil Sampel</th>
                                                        <th class="text-body">Tanggal Permintaan</th>
                                                        <th class="text-body">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($item->patient->laboratoriumRequests as $labor)
                                                        <tr class="{{ $item->id == $labor->queue->id ? 'text-success' : '' }}">
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $labor->user->name ?? '' }}</td>
                                                            {{-- <td>{{ $labor->poliklinik->name ?? '' }}</td> --}}
                                                            <td>{{ $labor->queue->dpjp->poliklinik->name ?? '' }}</td>
                                                            <td>{{ $labor->diagnosa ?? '' }}</td>
                                                            <td>{{ $labor->tipe_permintaan ?? '' }}</td>
                                                            <td>{{ $labor->tanggal_sampel ?? '' }}</td>
                                                            <td>{{ $labor->created_at->format('Y-m-d') ?? '' }}</td>
                                                            <td>
                                                                <div class="d-flex align-self-center">
                                                                    <a href="{{ route('rajal/laboratorium/request.show', ['queue_id' => $item->id, 'labor_id' => $labor->id]) }}"
                                                                        target="blank" class="btn btn-dark btn-sm mx-2"><i
                                                                            class='bx bx-printer'></i></a>
                                                                    @if ($labor->status == 'FINISHED' || $labor->status == 'ONGOING')
                                                                        <button type="button" class="btn btn-info btn-sm"><i class='bx bx-file'></i></button>
                                                                    @else
                                                                        <a href="" class="btn btn-warning btn-sm me-2"><i class='bx bx-edit'></i></a>
                                                                        <form
                                                                            action="{{ route('rajal/laboratorium/request.destroy', $labor->id) }}"
                                                                            method="POST">
                                                                            @method('DELETE')
                                                                            @csrf
                                                                            <button type="submit"
                                                                                class="btn btn-sm btn-danger"><i
                                                                                    class="bx bx-trash"></i></button>
                                                                        </form>
                                                                    @endif
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade {{ session('btn') == 'diag-tind' ? 'show active' : '' }}" id="navs-justified-diag-tind" role="tabpanel">
                        <div class="row">
                            <div class="col-md-2 col-12 mb-3 mb-md-0">
                              <div class="list-group">
                                <a class="list-group-item list-group-item-action {{ session('diag-tind') == 'diagnosa' ? 'active' : '' }}" id="diagnosa-list" data-bs-toggle="list" href="#diagnosa">Diagnosa</a>
                                <a class="list-group-item list-group-item-action {{ session('diag-tind') == 'prosedur' ? 'active' : '' }}" id="prosedur-list" data-bs-toggle="list" href="#prosedur">Prosedur</a>
                              </div>
                            </div>
                            <div class="col-md-10 col-12 border">
                              <div class="tab-content">
                                <div class="tab-pane fade {{ session('diag-tind') == 'diagnosa' ? 'show active' : '' }}" id="diagnosa">
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
                                <div class="tab-pane fade {{ session('diag-tind') == 'prosedur' ? 'show active' : '' }}" id="prosedur">
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
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade {{ session('btn') == 'resep dokter' ? 'show active' : '' }}" id="navs-justified-resep" role="tabpanel">
                        <div class="card-body {{ $item->rajalFarmasiPatient ? ($item->rajalFarmasiPatient->status != 'DENIED' ? 'card-block' : '') : '' }}">
                            <form action="{{ route('rajal/resep/dokter.store', $item->id) }}" method="POST">
                                @csrf
                                <div class="row mb-1">
                                    <div class="col-12">
                                        <label for="medicine_id" class="form-label">Nama Obat</label>
                                        <select id="medicine_id" name="medicine_id" class="form-select form-select-sm select2-w-placeholder-medicine" data-allow-clear="true" placeholder="placeholder-element-id" style="width: 100%">
                                            <option value="" selected disabled></option>
                                            @foreach ($medicines as $obat)
                                                @if (old('medicine_id') == $obat->id)
                                                    <option value="{{ $obat->id }}" selected >{{ $obat->kode ?? '' }}/{{ $obat->name ?? '' }}</option>
                                                @else
                                                    <option value="{{ $obat->id }}" data-foo="Obat {{ $obat->medicineType->name ?? '...' }} | {{ $obat->medicineCategory->name ?? '...' }} | Stok : {{ $obat->medicineStoks->sum('stok') ?? '...' }} {{ $obat->small_unit ?? '...' }}" data-satuan="{{ $obat->small_unit ?? '' }}">{{ $obat->kode ?? '...' }} / {{ $obat->name ?? '...' }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-10">
                                        <input type="text" name="nama_obat_custom" id="medicine_name" class="form-control" placeholder="Input disini untuk obat yang stoknya tidak tersedia / atau obat yang harus dibeli diluar">
                                    </div>
                                    <div class="col-2">
                                        <input type="text" class="form-control" name="satuan_obat_custom" id="medicine_satuan" placeholder="Satuan Obat">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-sm-6">
                                        <label class="form-label" for="basic-default-name">Jumlah</label>
                                        <div class="input-group input-group-merge">
                                            <input type="number" class="form-control" name="jumlah" aria-label="Amount" value="1" />
                                            <span class="input-group-text bg-secondary text-white" id="satuan_jumlah_obat"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row mb-1">
                                            <label class="form-label" for="basic-default-name">Aturan Pakai</label>
                                            <div class="col-4">
                                                <select class="form-select form-select-md" data-allow-clear="true" id="interval_medicine">
                                                    <option selected disabled>Pilih</option>
                                                    <option value="1x1/2">1x1/2</option>
                                                    <option value="1x1">1x1</option>
                                                    <option value="2x1/2">2x1/2</option>
                                                    <option value="2x1">2x1</option>
                                                    <option value="3x1/2">3x1/2</option>
                                                    <option value="3x1">3x1</option>
                                                    <option value="4x1/2">4x1/2</option>
                                                    <option value="4x1">4x1</option>
                                                </select>
                                            </div>
                                            <div class="col-4">
                                                <select class="form-select form-select-md" data-allow-clear="true" id="medium_makan">
                                                    <option selected disabled>Pilih</option>
                                                    <option value="Sendok Makan">Sendok Makan</option>
                                                    <option value="Sendok Teh">Sendok Teh</option>
                                                    <option value="Bungkus">Bungkus</option>
                                                    <option value="Kapsul">Kapsul</option>
                                                    <option value="Kaplet">Kaplet</option>
                                                    <option value="Tablet">Tablet</option>
                                                </select>
                                            </div>
                                            <div class="col-4">
                                                <select class="form-select form-select-md" data-allow-clear="true" id="waktu_medicine">
                                                    <option selected disabled>Pilih</option>
                                                    <option value="Sebelum Makan">Sebelum Makan</option>
                                                    <option value="Sesudah Makan">Sesudah Makan</option>
                                                    <option value="Saat Makan">Saat Makan</option>
                                                    <option value="Dioleskan">Dioleskan</option>
                                                    <option value="Diteteskan">Diteteskan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <input type="text" name="aturan_pakai" id="aturan_pakai" class="form-control" id="aturan_pakai" placeholder="Aturan Pakai"></input>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 my-4 text-start">
                                        @if ($item->medicineReceipt)    
                                        <a href="{{ route('rajal/resep/dokter.show', $item->id) }}" target="blank" class="btn btn-info btn-sm">
                                            <i class='bx bx-printer'></i>
                                        </a>
                                        @endif
                                    </div>
                                    <div class="col-6 my-4 text-end">
                                            <button type="submit" class="btn btn-primary btn-sm">Tambah</button>
                                    </div>
                                    @if ($item->rajalFarmasiPatient)
                                        <div class="col-md-12 d-flex">
                                            <h5 class="fw-bold me-2">Status Resep :</h5>
                                            <div class="">
                                                @if ($item->rajalFarmasiPatient->status == 'WAITING')                                    
                                                    <span class="badge bg-warning">PERMINTAAN</span>
                                                @elseif ($item->rajalFarmasiPatient->status == 'ONGOING')
                                                    <span class="badge bg-info">DITERIMA</span>
                                                @elseif ($item->rajalFarmasiPatient->status == 'FINISHED')
                                                    <span class="badge bg-success">SUDAH DIAMBIL</span>
                                                @elseif ($item->rajalFarmasiPatient->status == 'DENIED')
                                                    <span class="badge bg-danger">DITOLAK / REVISI</span>
                                                @else
                                                    <span class="badge bg-success">TIDAK DIKETAHUI</span>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </form>
    
                            <table class="table">
                                <thead>
                                    <tr class="text-nowrap bg-dark text-white">
                                        <th>Action</th>
                                        <th>Nama Obat</th>
                                        <th>Aturan Pakai</th>
                                        <th>Jumlah</th>
                                        <th>Satuan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($item->medicineReceipt->medicineReceiptDetails ?? [] as $detailResep)     
                                            <tr>
                                                <td class="d-flex">
                                                <form action="{{ route('rajal/resep/dokter.destroy', $detailResep->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type = "submit" class="btn btn-danger btn-sm">
                                                        <i class='bx bx-trash'></i>
                                                    </button>
                                                </form>
                                                <form action="{{ route('rajal/resep/dokter.update', $detailResep->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT') 
                                                    <button class="btn btn-primary btn-sm ms-2" type="submit"><i class='bx bx-up-arrow-alt'></i></button>
                                                </td>
                                                @if ($detailResep->medicine_id)    
                                                    <td>
                                                        {{-- <input type="text" class="form-control" value="{{ $detailResep->medicine->name ?? '' }}" disabled> --}}
                                                        {{ $detailResep->medicine->name ?? '' }}
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control form-control-sm" name="aturan_pakai" value="{{ $detailResep->aturan_pakai ?? '' }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="jumlah" class="form-control form-control-sm" value="{{ $detailResep->jumlah ?? '' }}">
                                                    </td>
                                                    <td>{{ $detailResep->medicine->small_unit ?? '' }}</td>
                                                @else
                                                    <td>
                                                        <input type="text" class="form-control form-control-sm" name="nama_obat_custom" value="{{ $detailResep->nama_obat_custom ?? '' }}">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="aturan_pakai" class="form-control form-control-sm" value="{{ $detailResep->aturan_pakai ?? '' }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="jumlah" class="form-control form-control-sm" value="{{ $detailResep->jumlah ?? '' }}">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="satuan_obat_custom" class="form-control form-control-sm" value="{{ $detailResep->satuan_obat_custom ?? '' }}">
                                                    </td>
                                                @endif
                                            </tr>
                                        </form>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade {{ session('btn') == 'tindakan' ? 'show active' : '' }}" id="navs-justified-tindakan" role="tabpanel">
                        <form action="{{ route('rajal/laporan/tindakan.update', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
                            @method('PUT')
                            @csrf
                            <div class="row mb-4">
                                <div class="col-4">
                                    <div class="row mb-3">
                                        <label class="form-label">Tanggal/Jam tindakan</label>
                                        <input type="datetime-local" class="form-control" name="tgl_tindakan" value="{{ $item->patientActionReport->tgl_tindakan ?? date('Y-m-d H:i') }}"/>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="form-label">LAPORAN TINDAKAN</label>
                                        <textarea class="form-control" id="editor" name="laporan_tindakan" cols="30" rows="10">{{ $item->patientActionReport->laporan_tindakan ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-8">
                                    @if ($item->patientActionReport && $item->patientActionReport->patientActionReportDetails->isNotEmpty())
                                        @foreach ($item->patientActionReport->patientActionReportDetails as $detailTindakan)    
                                            <div class="row dinamic-input mb-2">
                                                <div class="col-5">
                                                    @if ($loop->first)
                                                    <label for="defaultFormControlInput" class="form-label">Tindakan</label>
                                                    @endif
                                                    <select class="form-control select2" id="action_ids_{{ $loop->iteration }}" data-allow-clear="true" name="action_id[]" style="width: 100%" onchange="getDetailTindakan(this)">
                                                    @foreach ($dataTindakan as $action)
                                                        <option value="{{ $action->id }}" @selected(old('action_id', $detailTindakan->action->id) == $action->id)>{{ $action->name }}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-1">
                                                    @if ($loop->first)
                                                    <label class="form-label">Jumlah</label>
                                                    @endif
                                                    <input type="number" class="form-control" name="jumlah_tindakan[]" value="{{ $detailTindakan->jumlah ?? 1 }}" onchange="countSubTotal(this)"/>
                                                </div>
                                                <div class="col-2">
                                                    @if ($loop->first)
                                                    <label class="form-label">Tarif</label>
                                                    @endif
                                                    <input type="number" class="form-control" name="tarif_tindakan[]" value="{{ $detailTindakan->harga_satuan ?? 0 }}" placeholder="Tarif Tindakan" readonly/>
                                                </div>
                                                <div class="col-3">
                                                    @if ($loop->first)                                                        
                                                    <label class="form-label">Subtotal</label>
                                                    @endif
                                                    <input type="number" class="form-control" name="sub_total_tindakan[]" value="{{ $detailTindakan->sub_total ?? 0 }}" placeholder="Subtotal" readonly/>
                                                </div>
                                                @if ($loop->first)
                                                <div class="col-1 text-center align-self-center mt-4 pt-1">
                                                    <button class="btn btn-sm btn-dark" onclick="addDinamicTindakan(this)" type="button">+</button>
                                                </div>
                                                @else
                                                <div class="col-1 text-center align-self-center">
                                                    <button class="btn btn-sm btn-danger" type="button" onclick="removeInputDinamic(this)">-</button>
                                                </div>
                                                @endif
                                            </div> 
                                        @endforeach
                                    @else
                                        <div class="row dinamic-input mb-2">
                                            <div class="col-5">
                                                <label for="defaultFormControlInput" class="form-label">Tindakan</label>
                                                <select class="form-control select2" id="action_id" name="action_id[]" style="width: 100%" onchange="getDetailTindakan(this)">
                                                    <option selected disabled>Pilih Tindakan</option>
                                                @foreach ($dataTindakan as $action)
                                                    <option value="{{ $action->id }}" @selected(old('action_id') == $action->id)>{{ $action->name }}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                            <div class="col-1">
                                                <label class="form-label">Jumlah</label>
                                                <input type="number" class="form-control" name="jumlah_tindakan[]" value="1" onchange="countSubTotal(this)"/>
                                            </div>
                                            <div class="col-2">
                                                <label class="form-label">Tarif</label>
                                                <input type="number" class="form-control" name="tarif_tindakan[]" value="0" placeholder="Tarif Tindakan" readonly/>
                                            </div>
                                            <div class="col-3">
                                                <label class="form-label">Subtotal</label>
                                                <input type="number" class="form-control" name="sub_total_tindakan[]" value="0" placeholder="Subtotal" readonly/>
                                            </div>
                                            <div class="col-1 text-center align-self-center mt-4 pt-1">
                                                <button class="btn btn-sm btn-dark" onclick="addDinamicTindakan(this)" type="button">+</button>
                                            </div>
                                        </div> 
                                    @endif
                                </div>
                            </div>
                          
                            @if (!$item->patientActionReport)
                                <div class="row mb-3">
                                    <div class="col-12 text-end">
                                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                    </div>
                                </div>
                            </form>
                            @else
                            <div class="row">
                                <div class="col-12 text-end">
                                    <a href="{{ route('rajal/laporan/tindakan.show', $item->patientActionReport->id) }}" target="blank" class="btn btn-info btn-sm"><i class='bx bx-printer'></i></a>
                                    <button type="submit" class="btn btn-dark btn-sm">Update</button>
                                </div>
                            </div>
                            @endif
                        </form>
                        @if ($item->patientActionReport)
                        <div class="row">
                            <div class="col-12 text-start">
                                <form action="{{ route('rajal/laporan/tindakan.destroy', $item->patientActionReport->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm" onsubmit=""><i class="bx bx-trash me-2"></i>Reset Tindakan</button>
                                </form>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="tab-pane fade {{ session('btn') == 'kontrol-ulang' ? 'show active' : '' }}" id="navs-justified-kontrol-ulang" role="tabpanel">
                        <form action="{{ route('rajal/kontrol/ulang.update', $item->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="row mb-3 p-4 w-50 border">
                                <h5 class="text-uppercase text-center">Lembar Kontrol Ulang Pasien</h5>
                                <hr>
                                <div class="row mb-2 mt-2">
                                    <label class="col-form-label col-sm-5">Nama Pasien  </label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" value="{{ $item->patient->name ?? '' }}" disabled></input>                                    
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-form-label col-sm-5">Nomor Rekam Medis  </label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" value="{{ implode('-', str_split(str_pad($item->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}" disabled></input>                                    
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm">
                                        <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="checkbox" name="isKontrol" id="isKontrol" value="1" {{ $item->planControlPatient ? 'checked' : '' }}/>
                                          <label class="form-check-label" for="inlineRadio1">Pasien Diminta Kontrol Ulang</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <input class="form-control" type="date" name="tgl_kontrol" id="html5-date-input" value="{{ $item->planControlPatient ? $item->planControlPatient->tgl_kontrol : '' }}" disabled/>
                                    </div>
                                </div>
                                <div class="col-12 mt-4">
                                    @if ($item->planControlPatient)
                                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                    <a href="{{ route('rajal/kontrol/ulang.destroy', $item->planControlPatient->id) }}" class="btn btn-sm btn-danger">Batal / Hapus</a>
                                    @else
                                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade {{ session('btn') == 'cppt' ? 'show active' : '' }}" id="navs-justified-cppt" role="tabpanel">
                        <form action="{{ route('rajal/cppt.store', $item->id) }}" method="POST" id="formSOAP">
                            @csrf
                            <div class="row mb-5">
                                <div class="col-sm-3">
                                    <label for="subjective" class="form-label">Subjective</label>
                                    <textarea name="subjective" id="subjective" class="form-control" rows="10" placeholder="Subjective">Keluhan: {{ ($itemAss->keluhan_utama ?? '') . "\r\nRiw. " .($item->perawatInitialAssesment->riw_penyakit_pasien ?? '') }} </textarea>
                                    <button type="button" class="btn btn-dark btn-sm mt-2 me-2 w-100" value="sub" onclick="autoFillSOAP(this)">
                                        <i class='bx bx-up-arrow-alt'></i> Tarik Data Anamnesa
                                    </button>
                                </div>
                                <div class="col-sm-3">
                                    <label for="objective" class="form-label">Objective</label>
                                    <textarea name="objective" id="objective" class="form-control" rows="10" placeholder="Objective">{{ "Keadaan Umum: " . ($itemAss->keadaan_umum ?? '') . "\r\n" . "Nadi: " . ($itemAss->nadi ?? '') . " bpm\r\n" . "Tekanan Darah: " . ($itemAss->td_sistolik ?? '') . " / " . ($itemAss->td_diastolik ?? '') . " mmHg\r\n" . "Suhu: " . ($itemAss->suhu ?? '') . " °C\r\n" . "Nafas: " . ($itemAss->nafas ?? '') . " x/menit\r\n" . "Tinggi Badan: " . ($itemAss->tb ?? '') . " cm\r\n" . "Berat Badan: " . ($itemAss->bb ?? '') . ' kg' }}</textarea>
                                    <button type="button" class="btn btn-dark btn-sm mt-2 me-2 w-100" value="obj" onclick="autoFillSOAP(this)">
                                        <i class='bx bx-up-arrow-alt'></i> Tarik Data Asesmen
                                    </button>
                                </div>
                                <div class="col-sm-3">
                                    <label for="asesmen" class="form-label">Assesment</label>
                                    <textarea name="asesmen" id="asesmen" class="form-control" rows="10" placeholder="Assesment">{{ $item->soapDokter->asesment ?? '' }}</textarea>
                                    <button type="button" class="btn btn-dark btn-sm mt-2 me-2 w-100" value="ases" onclick="autoFillSOAP(this)">
                                        <i class='bx bx-up-arrow-alt'></i> Tarik Data Diagnosa
                                    </button>
                                </div>
                                <div class="col-sm-3">
                                    <label for="planning" class="form-label">Planning</label>
                                    <textarea name="planning" id="planning" class="form-control" rows="10" placeholder="Planning">{{ $item->soapDokter->planning ?? '' }}</textarea>
                                    <div class="btn-group dropdown me-3 mt-2 w-100">
                                        <button class="btn btn-dark btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class='bx bx-up-arrow-alt'></i> Tarik Data
                                        </button>
                                        <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">
                                          <li><button class="dropdown-item" type="button" value="resep" onclick="autoFillSOAP(this)">Resep</button></li>
                                          <li><button class="dropdown-item" type="button" value="radiologi" onclick="autoFillSOAP(this)">Radiologi</button></li>
                                          <li><button class="dropdown-item" type="button" value="laboratorium" onclick="autoFillSOAP(this)">Laboratorium</button></li>
                                          <li><button class="dropdown-item" type="button" value="tindakan" onclick="autoFillSOAP(this)">Tindakan</button></li>
                                          <li><button class="dropdown-item" type="button" value="kontrolUlang" onclick="autoFillSOAP(this)">Rencana Kontrol</button></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end my-4">
                                <button type="submit" class="btn btn-primary btn-sm" onclick="openModal()"> {{ $item->soapDokter ? 'Update' : 'Submit' }}</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade {{ session('btn') == 'finished' ? 'show active' : '' }}" id="navs-justified-finished" role="tabpanel">
                        <div class="row">
                            <div class="col-md-2 col-12 mb-3 mb-md-0">
                              <div class="list-group">
                                <a class="list-group-item list-group-item-action {{ session('finished') == 'status-pelayanan' ? 'active' : '' }}" id="status-pelayanan-tab" data-bs-toggle="list" href="#list-status-pelayanan">Status Pelayanan</a>
                                <a class="list-group-item list-group-item-action {{ session('finished') == 'konsul-internal' ? 'active' : '' }}" id="konsul-poli-lain-tab" data-bs-toggle="list" href="#list-konsul-internal">Konsul Poli Lain</a>
                              </div>
                            </div>
                            <div class="col-md-10 col-12 border">
                              <div class="tab-content">
                                <div class="tab-pane fade {{ session('finished') == 'status-pelayanan' ? 'show active' : '' }}" id="list-status-pelayanan">
                                    <form action="{{ route('rajal/status/pelayanan.update', $item->rawatJalanPoliPatient->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <div class="row mb-3">
                                                    <div class="col-12">
                                                        <Label class="form-label">Diet Pasien</Label>
                                                        <select class="form-control select2" id="select_diet" style="width: 100%;" onchange="transferDietPasien(this.value)">
                                                            <option value="" selected disabled></option>
                                                            <option value="Diet Diabetes Melitus">Diet Diabetes Melitus</option>
                                                            <option value="Diet Lainnya">Diet Lainnya</option>
                                                        </select>
                                                        <textarea name="diet_pasien" id="diet_pasien" class="form-control" rows="3">{{ $item->rawatJalanPoliPatient->diet ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <Label class="form-label">Status Pelayanan</Label>
                                                    <div class="col-md">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="status_pelayanan" id="belum_dilayani" value="WAITING" {{ $item->rawatJalanPoliPatient->status == 'WAITING' ? 'checked' : '' }} onclick="belumDilayani(this)"/>
                                                            <label class="form-check-label" for="belum_dilayani">Belum Dilayani</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="status_pelayanan" id="dalam_perawatan" value="ONGOING" {{ $item->rawatJalanPoliPatient->status == 'ONGOING' ? 'checked' : '' }}  onclick="dalamPerawatan(this)"/>
                                                            <label class="form-check-label" for="dalam_perawatan">Dalam Perawatan</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="status_pelayanan" id="sudah_dilayani" value="FINISHED" {{ $item->rawatJalanPoliPatient->status == 'FINISHED' ? 'checked' : '' }} onclick="sudahDilayani(this)"/>
                                                            <label class="form-check-label" for="sudah_dilayani">Sudah Dilayani</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <Label class="form-label">Intruksi Pulang / Kontrol Ulang</Label>
                                                <textarea name="intruksi_pulang" id="intruksi_pulang" class="form-control" rows="5">{{ $item->rawatJalanPoliPatient->intruksi ? $item->rawatJalanPoliPatient->intruksi : ($item->planControlPatient ? 'Pasien Diminta Kontrol Ulang Pada Tanggal ' . date('d-m-Y', strtotime($item->planControlPatient->tgl_kontrol)) : '') }}</textarea>
                                            </div>
                                        </div>
                                         <div class="row mb-3">
                                            <div class="col-6">
                                                <div class="row">
                                                    <Label class="form-label d-block">Cara Keluar</Label>
                                                    <div class="col-6">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="cara_keluar" id="pulang" value="Pulang" {{ $item->rawatJalanPoliPatient->cara_keluar == 'Pulang' ? 'checked' : '' }}/>
                                                            <label class="form-check-label" for="pulang">Pulang</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="cara_keluar" id="rawat_inap" value="Rawat Inap" {{ $item->rawatJalanPoliPatient->cara_keluar == 'Rawat Inap' ? 'checked' : '' }}/>
                                                            <label class="form-check-label" for="rawat_inap">Rawat Inap</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="cara_keluar" id="rujuk_balik" value="Rujuk Balik" {{ $item->rawatJalanPoliPatient->cara_keluar == 'Rujuk Balik' ? 'checked' : '' }}/>
                                                            <label class="form-check-label" for="rujuk_balik">Rujuk Balik</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="cara_keluar" id="rujuk_eksternal" value="Dirujuk Ke Rumah Sakit Lain" {{ $item->rawatJalanPoliPatient->cara_keluar == 'Dirujuk Ke Rumah Sakit Lain' ? 'checked' : '' }}/>
                                                            <label class="form-check-label" for="rujuk_eksternal">Dirujuk Ke Rumah Sakit Lain</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="row">
                                                    <Label class="form-label d-block">Keadaan Keluar</Label>
                                                    <div class="col-6">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="keadaan_keluar" id="belum_sembuh" value="Belum Sembuh" {{ $item->rawatJalanPoliPatient->keadaan_keluar == 'Belum Sembuh' ? 'checked' : '' }}/>
                                                            <label class="form-check-label" for="belum_sembuh">Belum Sembuh</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="keadaan_keluar" id="mulai_sembuh" value="Mulai Sembuh" {{ $item->rawatJalanPoliPatient->keadaan_keluar == 'Mulai Sembuh' ? 'checked' : '' }}/>
                                                            <label class="form-check-label" for="mulai_sembuh">Mulai Sembuh</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="keadaan_keluar" id="membaik" value="Membaik" {{ $item->rawatJalanPoliPatient->keadaan_keluar == 'Membaik' ? 'checked' : '' }}/>
                                                            <label class="form-check-label" for="membaik">Membaik</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="keadaan_keluar" id="sembuh" value="Sembuh" {{ $item->rawatJalanPoliPatient->keadaan_keluar == 'Sembuh' ? 'checked' : '' }}/>
                                                            <label class="form-check-label" for="sembuh">Sembuh</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                         </div>
                                         {{-- verifikasi pengiriman data --}}
                                         <div class="row mb-3 p-4 border">
                                            <h5>Verifikasi Kesiapan Data Pasien</h5>
                                            <div class="col-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="receipts_ready" id="receipts_ready" value="1" onchange="receiptReadyFunc(this)" {{ $item->rawatJalanPoliPatient->receipts_ready ? 'checked' : '' }} style="{{ $item->rawatJalanPoliPatient->receipts_ready ? 'pointer-events : none;' : '' }}"/>
                                                    <label class="form-check-label" for="{{ $item->rawatJalanPoliPatient->receipts_ready ? '' : 'receipts_ready' }}">Data resep obat</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="actions_ready" id="actions_ready" value="1" onchange="actionReadyFunc(this)" {{ $item->rawatJalanPoliPatient->actions_ready ? 'checked' : '' }} style="{{ $item->rawatJalanPoliPatient->actions_ready ? 'pointer-events : none;' : '' }}"/>
                                                    <label class="form-check-label" for="{{ $item->rawatJalanPoliPatient->actions_ready ? '' : 'actions_ready' }}">Data tindakan dokter</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="radiologies_ready" id="radiologies_ready" value="1" onchange="radiologiReadyFunc(this)" {{ $item->rawatJalanPoliPatient->radiologies_ready ? 'checked' : '' }} style="{{ $item->rawatJalanPoliPatient->radiologies_ready ? 'pointer-events : none;' : '' }}"/>
                                                    <label class="form-check-label" for="{{ $item->rawatJalanPoliPatient->radiologies_ready ? '' : 'radiologies_ready' }}">Data permintaan pemeriksaan radiologi</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="laboratories_ready" id="laboratories_ready" value="1" onchange="laborReadyFunc(this)" {{ $item->rawatJalanPoliPatient->laboratories_ready ? 'checked' : '' }} style="{{ $item->rawatJalanPoliPatient->laboratories_ready ? 'pointer-events : none;' : '' }}"/>
                                                    <label class="form-check-label" for="{{ $item->rawatJalanPoliPatient->laboratories_ready ? '' : 'laboratories_ready' }}">Data permintaan pemeriksaan laboratorium</label>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- submit form --}}
                                        <div class="col-12 mt-5 ms-auto">
                                            <button type="submit" id="btn-finish-pelayanan" class="btn btn-sm btn-primary">Submit</button>
                                            @if ($item->rawatJalanPoliPatient->status == 'ONGOING' || $item->rawatJalanPoliPatient->status == 'FINISHED')
                                                <button type="submit" class="btn btn-sm btn-danger mx-2">Batal</button>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade {{ session('finished') == 'konsul-internal' ? 'show active' : '' }}" id="list-konsul-internal">
                                    <form action="{{ route('rajal/konsul/internal.update', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <h5 class="mb-3">Konsul Poli Lain (Konsul Internal)</h5>
                                            <div class="col-12 mb-1">
                                                <div class="form-check form-check-inline">
                                                  <input class="form-check-input" type="checkbox" name="isKonsul" id="isKonsul" value="1" {{ $item->konsulInternal ? 'checked' : '' }}/>
                                                  <label class="form-check-label" for="isKonsul">Ceklis jika pasien diminta konsul ke poli lain</label>
                                                </div>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <select name="dokter_id" id="dokter_id" class="form-control select2" style="width: 100%;" @disabled(true)>
                                                    <option value="" selected disabled></option>
                                                    <option value="1">dokter 2</option>
                                                    <option value="2">dokter 3</option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label for="" class="form-label d-block">Mohon Bantuan Sejawat Untuk:</label>
                                                <textarea name="keterangan_konsul" id="keterangan_konsul" class="form-control" rows="4" @disabled(true)>{{ $item->konsulInternal ? $item->konsulInternal->permintaan_konsul : "Konsultasikan tindakan masalah medik saat ini \r\n" . "Atas pasien ini yang kami rawat dengan\r\n" }}</textarea>
                                            </div>
                                            <div class="col-12 mt-4 ms-auto">
                                                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                                @if ($item->konsulInternal)
                                                    <button type="submit" class="btn btn-sm btn-danger mx-2">Batal</button>
                                                @endif
                                            </div>
                                        </div>
                                    </form>
                                </div>
                              </div>
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

        //untuk event Update status pelayanan poli
        const btnFinish = document.getElementById('btn-finish-pelayanan');
        btnFinish.addEventListener('click', function(e){
            const checkAssesmentDokter = @json($item->doctorInitialAssesment);
            const checkIcd = @json($item->diagnosticProcedurePatient);
            const checkSoap = @json($item->soapDokter);
            if (!checkAssesmentDokter) {
                alertShow('Error !!', 'Harap Isi Assesmen Dokter', elementAlert);
                e.preventDefault();
            }else if(!checkIcd){
                alertShow('Error !!', 'Harap Isi Diagnosa dan Prosedur Utama', elementAlert);
                e.preventDefault();
            }else if(!checkSoap){
                alertShow('Error !!', 'Harap Isi SOAP Pasien', elementAlert);
                e.preventDefault();
            }
        });

        // start function untuk status pelayanan
        // untuk event enable dan disable cara keluar dan keadaan keluar
        let caraKeluars = document.querySelectorAll('input[name="cara_keluar"]');
        let keadaanKeluars = document.querySelectorAll('input[name="keadaan_keluar"]');
        const receiptReady = document.getElementById('receipts_ready');
        const actionReady = document.getElementById('actions_ready');
        const laboratoryReady = document.getElementById('laboratories_ready');
        const radiologyReady = document.getElementById('radiologies_ready');
        const modal = document.getElementById('modalScrollable');
        function belumDilayani(element){
            if (element.checked) {
                caraKeluars.forEach(function(caraKeluar){
                    caraKeluar.checked = false;
                    caraKeluar.disabled = true;
                });
                keadaanKeluars.forEach(function(keadaanKeluar){
                    keadaanKeluar.checked = false;
                    keadaanKeluar.disabled = true;
                });
                receiptReady.disabled = true;
                actionReady.disabled = true;
                laboratoryReady.disabled = true;
                radiologyReady.disabled = true;
            }
        }
        function dalamPerawatan(element){
            if (element.checked) {
                caraKeluars.forEach(function(caraKeluar){
                    caraKeluar.checked = false;
                    caraKeluar.disabled = true;
                });
                keadaanKeluars.forEach(function(keadaanKeluar){
                    keadaanKeluar.checked = false;
                    keadaanKeluar.disabled = true;
                });
                receiptReady.disabled = false;
                actionReady.disabled = false;
                laboratoryReady.disabled = false;
                radiologyReady.disabled = false;
            }
        }
        function sudahDilayani(element){
            if (element.checked) {
                caraKeluars.forEach(function(caraKeluar){
                    caraKeluar.disabled = false;
                });
                keadaanKeluars.forEach(function(keadaanKeluar){
                    keadaanKeluar.disabled = false;
                });
            }
            receiptReady.disabled = false;
            actionReady.disabled = false;
            laboratoryReady.disabled = false;
            radiologyReady.disabled = false;
        }
        function receiptReadyFunc(element){
            if (element.checked) { 
                element.checked = false;
                modal.innerHTML = `
                <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalScrollableTitle">Data Resep</h5>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                                <tr class="text-nowrap bg-primary">
                                    <th>#</th>
                                    <th>Nama Obat</th>
                                    <th>Aturan Pakai</th>
                                    <th>Jumlah</th>
                                    <th>Satuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($item->medicineReceipt->medicineReceiptDetails ?? [] as $detailResep)     
                                    <tr>
                                        <td>
                                            {{ $loop->iteration ?? '' }}
                                        </td>
                                        @if ($detailResep->medicine_id)    
                                            <td>
                                                {{ $detailResep->medicine->name ?? '' }}
                                            </td>
                                            <td>
                                                {{ $detailResep->aturan_pakai ?? '' }}
                                            </td>
                                            <td>
                                                {{ $detailResep->jumlah ?? '' }}
                                            </td>
                                            <td>{{ $detailResep->medicine->small_unit ?? '' }}</td>
                                        @else
                                            <td>
                                                {{ $detailResep->nama_obat_custom ?? '' }}
                                            </td>
                                            <td>
                                                {{ $detailResep->aturan_pakai ?? '' }}
                                            </td>
                                            <td>
                                                {{ $detailResep->jumlah ?? '' }}
                                            </td>
                                            <td>
                                                {{ $detailResep->satuan_obat_custom ?? '' }}
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <p class="mt-4 mb-0 text-white text-center fst-italic text-uppercase p-4 bg-warning">
                        *) Hati-hati dalam mengkonfirmasi data resep obat, setelah dikonfirmasi resep tidak akan bisa diedit kembali kecuali apoteker menolak permintaan resep 
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-outline-primary" value="resep" onclick="hideModalWithConfirm(this.value)">Konfirmasi</button>
                    </div>
                    </div>
                </div>
                `;
                $(modal).modal('show');
            }
        }
        function actionReadyFunc(element){
            if (element.checked) { 
                element.checked = false;
                modal.innerHTML = `
                <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalScrollableTitle">Data Tindakan Medis Pasien</h5>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                                <tr class="text-nowrap bg-primary">
                                    <th>#</th>
                                    <th>Nama Tindakan</th>
                                    <th>Jumlah</th>
                                    <th>Tarif</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($item->patientActionReport->patientActionReportDetails ?? [] as $detailTindakan)     
                                    <tr>
                                        <td>{{ $loop->iteration ?? '' }}</td>
                                        <td>{{ $detailTindakan->action->name ?? '' }}</td>
                                        <td>{{ $detailTindakan->jumlah ?? 0 }}</td>
                                        <td>{{ number_format($detailTindakan->harga_satuan ?? 0) }}</td>
                                        <td>{{ number_format($detail->sub_total ?? 0) }}</td>
                                    </tr>
                                @endforeach
                                <tr class="fw-bold">
                                    <td colspan="4" class="text-center">Total Akhir</td>
                                    <td>{{ $item->patientActionReport ? (number_format($item->patientActionReport->patientActionReportDetails->sum('sub_total') ?? 0)) : '0' }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <p class="mt-4 mb-0 text-white text-center fst-italic text-uppercase p-4 bg-warning">
                        *) hati-hati dalam mengkonfirmasi data tindakan !!, setelah dikonfirmasi data tindakan akan masuk ke billing pasien dan tidak bisa diedit kembali 
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-outline-primary" value="tindakan" onclick="hideModalWithConfirm(this.value)">Konfirmasi</button>
                    </div>
                    </div>
                </div>
                `;
                $(modal).modal('show');
            }
        }
        function radiologiReadyFunc(element){
            if (element.checked) { 
                element.checked = false;
                modal.innerHTML = `
                <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalScrollableTitle">Data Permintaan Pemeriksaan Radiologi</h5>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                                <tr class="text-nowrap bg-primary">
                                    <th>#</th>
                                    <th>Nama Tindakan</th>
                                    <th>Jumlah</th>
                                    <th>Tarif</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($item->patientActionReport->patientActionReportDetails ?? [] as $detailTindakan)     
                                    <tr>
                                        <td>{{ $loop->iteration ?? '' }}</td>
                                        <td>{{ $detailTindakan->action->name ?? '' }}</td>
                                        <td>{{ $detailTindakan->jumlah ?? 0 }}</td>
                                        <td>{{ number_format($detailTindakan->harga_satuan ?? 0) }}</td>
                                        <td>{{ number_format($detail->sub_total ?? 0) }}</td>
                                    </tr>
                                @endforeach
                                <tr class="fw-bold">
                                    <td colspan="4" class="text-center">Total Akhir</td>
                                    <td>{{ $item->patientActionReport ? (number_format($item->patientActionReport->patientActionReportDetails->sum('sub_total') ?? 0)) : '0' }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <p class="mt-4 mb-0 text-white text-center fst-italic text-uppercase p-4 bg-warning">
                        *) hati-hati dalam mengkonfirmasi data pemeriksaan radiologi !!! <br>setelah dikonfirmasi data permintaan akan diterima oleh petugas radiologi dan tidak bisa diedit kembali kecuali petugas radiologi menolak permintaan 
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-outline-primary" value="radiologi" onclick="hideModalWithConfirm(this.value)">Konfirmasi</button>
                    </div>
                    </div>
                </div>
                `;
                $(modal).modal('show');
            }
        }
        function laborReadyFunc(element){
            if (element.checked) { 
                element.checked = false;
                modal.innerHTML = `
                <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalScrollableTitle">Data Permintaan Pemeriksaan Laboratorium</h5>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                                <tr class="text-nowrap bg-primary">
                                    <th>#</th>
                                    <th>Nama Tindakan</th>
                                    <th>Jumlah</th>
                                    <th>Tarif</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($item->patientActionReport->patientActionReportDetails ?? [] as $detailTindakan)     
                                    <tr>
                                        <td>{{ $loop->iteration ?? '' }}</td>
                                        <td>{{ $detailTindakan->action->name ?? '' }}</td>
                                        <td>{{ $detailTindakan->jumlah ?? 0 }}</td>
                                        <td>{{ number_format($detailTindakan->harga_satuan ?? 0) }}</td>
                                        <td>{{ number_format($detail->sub_total ?? 0) }}</td>
                                    </tr>
                                @endforeach
                                <tr class="fw-bold">
                                    <td colspan="4" class="text-center">Total Akhir</td>
                                    <td>{{ $item->patientActionReport ? (number_format($item->patientActionReport->patientActionReportDetails->sum('sub_total') ?? 0)) : '0' }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <p class="mt-4 mb-0 text-white text-center fst-italic text-uppercase p-4 bg-warning">
                        *) hati-hati dalam mengkonfirmasi data pemeriksaan Laboratorium !!! <br>setelah dikonfirmasi data permintaan akan diterima oleh petugas Laboratorium dan tidak bisa diedit kembali kecuali petugas Laboratorium menolak permintaan 
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-outline-primary" value="laboratorium" onclick="hideModalWithConfirm(this.value)">Konfirmasi</button>
                    </div>
                    </div>
                </div>
                `;
                $(modal).modal('show');
            }
        }
        // end function untuk status peayanan

        // function untuk menutup modal
        function hideModalWithConfirm(identifier){
            if (identifier == 'resep') {
                receiptReady.checked = true;
            }else if(identifier == 'tindakan'){
                actionReady.checked = true;
            }else if(identifier == 'radiologi'){
                radiologyReady.checked = true;
            }else if(identifier == 'laboratorium'){
                laboratoryReady.checked = true;
            }
            $(modal).modal('hide');
        }

        function autoFillSOAP(element){
            let targetElement, contentTarget;
            if (element.value == 'sub') {
                const keluhan = `{{ "Keluhan: " . ($item->doctorInitialAssesment->keluhan_utama ?? '') }}`;
                
                targetElement = element.closest('.row').querySelector('#subjective');
                contentTarget = keluhan;
            } else if(element.value == 'obj') {
                const objective = `{{ "Keadaan Umum: " . ($item->doctorInitialAssesment->keadaan_umum ?? '') . "\r\n" . "Nadi: " . ($item->doctorInitialAssesment->nadi ?? '') . " bpm\r\n" . "Tekanan Darah: " . ($item->doctorInitialAssesment->td_sistolik ?? '') . " / " . ($item->doctorInitialAssesment->td_diastolik ?? '') . " mmHg\r\n" . "Suhu: " . ($item->doctorInitialAssesment->suhu ?? '') . " °C\r\n" . "Nafas: " . ($item->doctorInitialAssesment->nafas ?? '') . " x/menit\r\n" . "Tinggi Badan: " . ($item->doctorInitialAssesment->tb ?? '') . " cm\r\n" . "Berat Badan: " . ($item->doctorInitialAssesment->bb ?? '') . " kg" }}`;
                
                targetElement = element.closest('.row').querySelector('#objective');
                contentTarget = objective;
            } else if(element.value == 'ases'){
                const diagnosaPrimer = `{{ "Diagnosa Primer: \r\n" . (($item->diagnosticProcedurePatient->diagnostic_id ?? '') ? "[" . ($item->diagnosticProcedurePatient->diagnostic->icd_x_code ?? '') . "] " . ($item->diagnosticProcedurePatient->diagnostic->name ?? '') : ($item->diagnosticProcedurePatient->desc_diagnosa_primer ?? '')) }}`;
                let diagnosaSekunder = '';
                const dataJson = @json($item->diagnosticProcedurePatient->diagnosticSecondary ?? '');
                if (dataJson.length > 0) {
                    diagnosaSekunder = '\r\n\nDiagnosa Sekunder:';
                    dataJson.forEach(function(item){
                        diagnosaSekunder += '\r\n-[' + (item.diagnostic.icd_x_code ?? '') + '] ' + (item.diagnostic.name ?? '');
                    });
                }
                diagnosaSekunder += '\r\n' + '{{ $item->diagnosticProcedurePatient->desc_diagnosa_sekunder ?? '' }}' ;

                targetElement = element.closest('.row').querySelector('#asesmen');
                contentTarget = diagnosaPrimer + "" + diagnosaSekunder;
            } else if(element.value == 'resep'){
                let dataResep = '\r\n\nPemberian Obat : ';
                const dataResepAwal = @json($item->medicineReceipt->medicineReceiptDetails ?? '');
                dataResepAwal.forEach(function(item){
                    dataResep += '\r\n# ' + (item.medicine_id ? (item.medicine.name ?? '') : (item.nama_obat_custom ?? '')) + ' - ' + item.aturan_pakai ?? '';
                });

                let plann = element.closest('.row').querySelector('#planning');
                plann.value += dataResep;
            } else if(element.value == 'tindakan'){
                let dataTindakan = '\r\n\nTindakan Medis : ';
                const dataTindakanAwal = @json($item->patientActionReport->patientActionReportDetails ?? '');
                dataTindakanAwal.forEach(function(item){
                    dataTindakan += '\r\n- ' + item.action.name ?? '';
                });

                let plann = element.closest('.row').querySelector('#planning');
                plann.value += dataTindakan;
            } else if(element.value == 'kontrolUlang'){
                const checkDataKontrol = @json($item->planControlPatient ?? '');
                if (checkDataKontrol) {                    
                    const dataKontrol = `{{ "\r\n\nPasien Diminta Kontrol Pada " . ($item->planControlPatient->tgl_kontrol ?? '') }}`;
                    let plann = element.closest('.row').querySelector('#planning');
                    plann.value += dataKontrol;
                }else{
                    alertShow('Not Found !!', 'Data kontrol tidak ditemukan', elementAlert);
                }
            }
            $(targetElement).val(contentTarget);

        }
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
        document.addEventListener('DOMContentLoaded', function(){
            // {{-- aturan pakai --}}
            var intMedicine = document.getElementById('interval_medicine');
            var medium = document.getElementById('medium_makan');
            var waktuMakan = document.getElementById('waktu_medicine');
            var aturanPakai = document.getElementById('aturan_pakai');
            
            var intVal = '', medVal = '', waktuVal = '';
            intMedicine.addEventListener('change', function(){
                intVal = intMedicine.value;
                aturanPakai.value = intVal + ' ' + medVal + ' ' + waktuVal;
            });
            medium.addEventListener('change', function(){
                medVal = `(${medium.value})`;
                aturanPakai.value = intVal + ' ' + medVal + ' ' + waktuVal;
            });
            waktuMakan.addEventListener('change', function(){
                waktuVal = waktuMakan.value;
                aturanPakai.value = intVal + ' ' + medVal + ' ' + waktuVal;
            });

            // satuan otomatis
            var inputSatuan = document.getElementById('medicine_satuan');
            var satuanJumlahObat = document.getElementById('satuan_jumlah_obat');
            var selectMedicine = document.getElementById('medicine_id');
            
            inputSatuan.addEventListener('keyup', function(){
                satuanJumlahObat.textContent = inputSatuan.value;
            });
            $(selectMedicine).on('change', function(){
                const selectedOption = $(this).select2('data')[0];
                const satuan = selectedOption.element.dataset.satuan;
                satuanJumlahObat.textContent = satuan;
            });

            // enable input tanggal kontrol
            const checkBoxIsKontrol = document.getElementById('isKontrol');
            const tglKontrolInput = document.querySelector('input[name="tgl_kontrol"]');
            checkBoxIsKontrol.addEventListener('click', function(){
                if(checkBoxIsKontrol.checked){
                    tglKontrolInput.disabled = false;
                }else{
                    tglKontrolInput.value = '';
                    tglKontrolInput.disabled = true;
                }
            });

            //untuk enable form konsul poli lain
            const kontrol = document.getElementById('isKonsul');
            const selectDokter = document.getElementById('dokter_id');
            const ketKonsul = document.getElementById('keterangan_konsul');
            if (kontrol.checked) {
                selectDokter.disabled = false;
                ketKonsul.disabled = false;
            }
            kontrol.addEventListener('click', function(){
                if (kontrol.checked) {
                    selectDokter.disabled = false;
                    ketKonsul.disabled = false;
                }else{
                    selectDokter.disabled = true;
                    ketKonsul.disabled = true;
                }
            });

            //set awal atribut disabled untuk status pelayanan
            const checkBelumDilayani = document.querySelector('#belum_dilayani');
            const checkDalamPerawatan = document.querySelector('#dalam_perawatan');
            const checkSudahDilayani = document.querySelector('#sudah_dilayani');
            if (checkBelumDilayani.checked) {
               belumDilayani(checkBelumDilayani);
            } else if(checkDalamPerawatan.checked){
                dalamPerawatan(checkDalamPerawatan);
            } else if(checkSudahDilayani.checked){
                sudahDilayani(checkSudahDilayani);
            }

            // start trigger element dengan class card-block
            $(".card-block").block({ 
                message:
                    `<div class="block-message"><h5 class="text-white">{{ $item->rajalFarmasiPatient ? ($item->rajalFarmasiPatient->status == 'WAITING' ? 'Menunggu Konfirmasi Apoteker' : ($item->rajalFarmasiPatient->status == 'ONGOING' ? 'Diterima Oleh Apoteker, Menunggu Penyerahan Obat' : 'Obat Telah Diserahkan Ke Pasien')) : '' }} ....</h5></div>`,
                css: {
                    backgroundColor: "transparent",
                    border:"0",
                    width:'50%',
                    height:'100%',
                    textAlign:'center',
                    position: 'absolute',
                    transform: 'translate(50%, 40%)',
                },
                overlayCSS: {
                    backgroundColor: "#000",
                    opacity: 0.6,
                },
            });
            // end trigger element dengan class card-block
        });
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
                    elementJumlah.value = 0;
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
    <script>
        function transferDietPasien(value){
            const dietPasien = document.getElementById('diet_pasien');
            dietPasien.value += value + "\r\n";
        }
    </script>
    
    
@endsection
