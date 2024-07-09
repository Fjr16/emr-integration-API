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
    <div class="d-flex justify-content-end mb-3 mt-0">
        @can(['finish pasien poli', 'show pasien poli'])
            <form action="{{ route('rajal/update', $item->rawatJalanPoliPatient->id) }}" method="POST"
                onsubmit="return confirm('Sebelum melanjutkan, Pastikan data telah diisi dengan benar dan lengkap !!!. Apakah anda yakin untuk melanjutkan ? ')">
                @method('PUT')
                @csrf
                <input type="hidden" name="title" value="{{ $title }}">
                <button type="submit" class="btn btn-success btn-sm" name="status" value="SELESAI">Selesai</button>
            </form>
        @endcan
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
                    <h6>{{ $item->dpjp->name }} ({{ $item->dpjp->staff_id }})</h6>
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
                      Data & Riwayat Medis Pasien
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
                                                    {{ $kunj->dpjp->roomDetail->name ?? '' }} - {{ $kunj->dpjp->name ?? '' }}
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
                                                                @if ($item->soapDokter)     
                                                                    <tr>
                                                                        <td>{{ $item->soapDokter->created_at->format('d M Y') ?? '' }}</td>
                                                                        <td>{{ $item->soapDokter->user->name ?? '' }}</td>
                                                                        <td>
                                                                            <p class="multi-line-text">{{ $item->soapDokter->subjective ?? '' }}</p>
                                                                            <p class="multi-line-text">{{ $item->soapDokter->objective ?? '' }}</p>
                                                                            <p class="multi-line-text">{{ $item->soapDokter->asesment ?? '' }}</p>
                                                                            <p class="multi-line-text">{{ $item->soapDokter->planning ?? '' }}</p>
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
                            <i class="tf-icons bx bx-bookmark-alt-plus"></i>
                            <p class="m-0">Riwayat</p>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button id="btn-link" type="button"
                            class="nav-link {{ session('btn') == 'asesmen' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-asesmen"
                            aria-controls="navs-justified-asesmen" aria-selected="false">
                            <i class="tf-icons bx bx-bookmark-alt-plus"></i>
                            <p class="m-0">Asesmen</p>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button id="btn-link" type="button"
                            class="nav-link {{ session('btn') == 'penunjang' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-profile"
                            aria-controls="navs-justified-profile" aria-selected="false">
                            <i class="tf-icons bx bx-bookmark-alt-plus"></i>
                            <p class="m-0">Penunjang</p>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button id="btn-link" type="button"
                            class="nav-link {{ session('btn') == 'cppt' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-cppt"
                            aria-controls="navs-justified-cppt" aria-selected="false">
                            <i class="tf-icons bx bx-message-alt-add"></i>
                            <p class="m-0">CPPT</p>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button id="btn-link" type="button"
                            class="nav-link {{ session('btn') == 'prmrj' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-prmrj"
                            aria-controls="navs-justified-prmrj" aria-selected="false">
                            <i class="tf-icons bx bx-message-alt-add"></i>
                            <p class="m-0">PRMRJ</p>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button"
                            class="nav-link d-flex justify-content-center {{ session('btn') == 'tindakan' ? 'active' : '' }}"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-tindakan"
                            aria-controls="navs-justified-tindakan" aria-selected="false">
                            <i class="tf-icons bx bx-sitemap"></i>
                            <p class="m-0">Laporan Tindakan</p>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button"
                            class="nav-link d-flex justify-content-center {{ session('btn') == 'resep dokter' ? 'active' : '' }}"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-resep"
                            aria-controls="navs-justified-resep" aria-selected="false">
                            <i class="tf-icons bx bx-list-ul"></i>
                            <p class="m-0">Resep Obat</p>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button"
                            class="nav-link d-flex justify-content-center {{ session('btn') == 'sbpk' ? 'active' : '' }}"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-sbpk"
                            aria-controls="navs-justified-sbpk" aria-selected="false">
                            <i class="tf-icons bx bx-mail-send"></i>
                            <p class="m-0">SBPK</p>
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade {{ session('btn') == 'riwayat' ? 'show active' : '' }}"
                        id="navs-justified-riwayat" role="tabpanel">
                        <div class="row">
                            <div class="col-md-2 col-12 mb-3 mb-md-0">
                              <div class="list-group">
                                <a class="list-group-item list-group-item-action active" id="list-kunj-terakhir-list" data-bs-toggle="list" href="#list-kunj-terakhir">Kunjungan Terakhir</a>
                                <a class="list-group-item list-group-item-action" id="list-rencana-kontrol-list" data-bs-toggle="list" href="#list-rencana-kontrol">Rencana Kontrol</a>
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
                                                            {{ $itemAss->keluhan_utama }}
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
                                                            <p class="multi-line-text">{!! $itemAss->riw_penyakit_pasien !!}</p>
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
                                                            <h1>{{ $itemAss->skor_ass_gizi_1 ?? 0 + $itemAss->skor_ass_gizi_2 ?? 0  }}</h1>
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
                                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" style="pointer-events: none;" {{ $itemAss->skor_nyeri == '0' ? 'checked' : '' }} />
                                                                </div>
                                                                <div class="form-check form-check-inline mx-5 ps-4">
                                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" style="pointer-events: none;" {{ $itemAss->skor_nyeri == '2' ? 'checked' : '' }} />
                                                                </div>
                                                                <div class="form-check form-check-inline mx-5">
                                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" style="pointer-events: none;" {{ $itemAss->skor_nyeri == '4' ? 'checked' : '' }}/>
                                                                </div>
                                                                <div class="form-check form-check-inline mx-5 ps-4">
                                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" style="pointer-events: none;" {{ $itemAss->skor_nyeri == '6' ? 'checked' : '' }}/>
                                                                </div>
                                                                <div class="form-check form-check-inline mx-5 ps-4">
                                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" style="pointer-events: none;" {{ $itemAss->skor_nyeri == '8' ? 'checked' : '' }}/>
                                                                </div>
                                                                <div class="form-check form-check-inline mx-5 ps-5">
                                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" style="pointer-events: none;" {{ $itemAss->skor_nyeri == '10' ? 'checked' : '' }}/>
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
                                                                    <p class="mb-4">{{ ($itemAss->resiko_jatuh_a ? 'YA' : 'TIDAK') ?? '...' }}</p>
                                                                    <p>{{ ($itemAss->resiko_jatuh_b ? 'YA' : 'TIDAK') ?? '...' }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-4 align-self-center">
                                                            <div class="card bg-transparent border border-primary">
                                                                <div class="card-body text-center p-2 align-self-center">
                                                                    <h2 class="text-uppercase mb-1 text-primary">
                                                                        {{ $itemAss->resiko_jatuh_result ?? '' }}
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
                                                                @foreach ($itemAss->detailPsikologis as $detail)
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
                                                            <p class="mb-0">Padang, {{ $itemAss->created_at->format('d M Y') ?? 'Unknown' }}</p>
                                                            <p class="mb-1 fw-bold">Perawat,</p>
                                                            <img src="{{ asset('storage/' . $itemAss->ttd ?? '') }}" width="150" alt="">
                                                            <p class="fw-bold">{{ $itemAss->user->name ?? '' }}</p>
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
                                                            <td>{{ $radiologi->roomDetail->name ?? '' }}</td>
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
                                                            <td>{{ $labor->roomDetail->name ?? '' }}</td>
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
                    <div class="tab-pane fade {{ session('btn') == 'cppt' ? 'show active' : '' }}"
                        id="navs-justified-cppt" role="tabpanel">
                        <div class="text-end mb-3">
                            @can('print cppt')
                                <a href="{{ route('rajal/cppt.print', $item->id) }}" target="blank"
                                    class="btn btn-dark btn-sm"><i class='bx bx-printer'></i></a>
                                <a href="{{ route('rajal/cppt.show', $item->id) }}" target="blank"
                                    class="btn btn-dark btn-sm"><i class='bx bx-low-vision'></i></a>
                            @endcan
                            @can('tambah cppt')
                                @if ($title == 'Rawat Jalan')
                                    <a class="btn btn-success btn-sm"
                                        href="{{ route('rajal/cppt.create', $item->id) }}">+Tambah
                                        CPPT</a>
                                @endif
                            @endcan
                        </div>
                        <table class="table" id="example">
                            <thead>
                                <tr class="text-nowrap">
                                    <th class="text-body">No</th>
                                    <th class="text-body">PPA (Profesional Pemberi Asuhan)</th>
                                    <th class="text-body">Tanggal / Jam</th>
                                    @canany(['edit cppt', 'delete cppt'])
                                        @if ($title == 'Rawat Jalan')
                                            <th class="text-body">Action</th>
                                        @endif
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($item->patient->rmeCppts->sortDesc() as $cppt)
                                    <tr class="{{ $item->id == $cppt->queue_id ? 'text-success' : '' }}">
                                        <td>{{ $loop->iteration ?? '' }}</td>
                                        <td>{{ $cppt->user->name ?? '' }}</td>
                                        <td>{{ $cppt->created_at->format('Y-m-d H:i') ?? '' }}</td>
                                        @canany(['edit cppt', 'delete cppt'])
                                            @if ($title == 'Rawat Jalan')
                                                <td class="d-flex">
                                                    @can('edit cppt')
                                                        <a href="{{ route('rajal/cppt.edit', $cppt->id) }}"
                                                            class="btn btn-warning btn-sm"><i class='bx bx-edit'></i></a>
                                                    @endcan
                                                    @can('delete cppt')
                                                        <form action="{{ route('rajal/cppt.destroy', $cppt->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm mx-2"
                                                                onclick="return confirm('Yakin Ingin Menghapus Data ?')"><i
                                                                    class='bx bx-trash'></i></button>
                                                        </form>
                                                    @endcan
                                                </td>
                                            @endif
                                        @endcanany
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade {{ session('btn') == 'prmrj' ? 'show active' : '' }}"
                        id="navs-justified-prmrj" role="tabpanel">
                        <div class="text-end mb-3">
                            @can('print prmrj')
                                <a href="{{ route('rajal/prmrj.show', $item->patient_id) }}" target="blank"
                                    class="btn btn-dark btn-sm"><i class='bx bx-printer'></i></a>
                            @endcan
                        </div>
                        <table class="table" id="example">
                            <thead>
                                <tr class="text-nowrap">
                                    <th class="text-body">No</th>
                                    <th class="text-body">Tanggal</th>
                                    <th class="text-body">Jam</th>
                                    <th class="text-body">DPJP</th>
                                    <th class="text-body">Diagnosa Penting</th>
                                    <th class="text-body">Uraian Klinis Penting</th>
                                    <th class="text-body">Rencana Penting</th>
                                    <th class="text-body">Paraf</th>
                                    @canany(['edit prmrj', 'delete prmrj'])
                                        @if ($title == 'Rawat Jalan')
                                            <th class="text-body">Action</th>
                                        @endif
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($item->patient->prmrjs as $prmrj)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ date('Y-m-d', strtotime($prmrj->tanggal ?? '')) }}</td>
                                        <td>{{ date('H:i', strtotime($prmrj->tanggal ?? '')) }}</td>
                                        <td>
                                            {{ $prmrj->user->name ?? '' }} <br>
                                        </td>
                                        <td>{!! $prmrj->diagnosa_penting ?? '' !!}</td>
                                        <td>{!! $prmrj->uraian_klinis ?? '' !!}</td>
                                        <td>{!! $prmrj->rencana_penting ?? '' !!}</td>
                                        <td>
                                            <a href="{{ Storage::url($prmrj->paraf) }}"><img
                                                    src="{{ Storage::url($prmrj->paraf) }}" alt=""></a>
                                        </td>
                                        @canany(['edit prmrj', 'delete prmrj'])
                                            @if ($title == 'Rawat Jalan')
                                                <td>
                                                    <div class="d-flex align-self-center">
                                                        @can('edit prmrj')
                                                            <button class="btn btn-warning btn-sm mx-2"
                                                                onclick="editPrmrj({{ $prmrj->id }})"><i
                                                                    class='bx bx-edit'></i></button>
                                                        @endcan
                                                        @can('delete prmrj')
                                                            <form action="{{ route('rajal/prmrj.destroy', $prmrj->id) }}"
                                                                method="POST">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button class="btn btn-danger btn-sm" type="submit"
                                                                    onclick="return confirm('Yakin Ingin Menghapus Data ?')"><i
                                                                        class='bx bx-trash'></i></button>
                                                            </form>
                                                        @endcan
                                                    </div>
                                                </td>
                                            @endif
                                        @endcanany
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div class="tab-pane fade {{ session('btn') == 'tindakan' ? 'show active' : '' }}"
                        id="navs-justified-tindakan" role="tabpanel">
                        @can('tambah laporan tindakan')
                            @if ($title == 'Rawat Jalan')
                                <div class="text-end mb-3">
                                    <button class="btn btn-success btn-sm"
                                        onclick="createTindakan({{ $item->id }})">+Tambah
                                        Tindakan</button>
                                </div>
                            @endif
                        @endcan
                        <table class="table" id="example">
                            <thead>
                                <tr class="">
                                    <th class="text-body">Tanggal / Jam</th>
                                    <th class="text-body">Dokter</th>
                                    <th class="text-body">Diagnosa</th>
                                    <th class="text-body">Tindakan</th>
                                    <th class="text-body">Lokasi</th>
                                    <th class="text-body">Laporan</th>
                                    <th class="text-body">Intruksi</th>
                                    <th class="text-body">Paraf</th>
                                    @canany(['edit laporan tindakan', 'delete laporan tindakan'])
                                        <th class="text-body">Action</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reportActions as $action)
                                    <tr>
                                        <td>{{ date('Y-m-d H:i', strtotime($action->tgl_tindakan ?? '')) }}</td>
                                        <td>{{ $action->user->name ?? '' }}</td>
                                        <td>{{ $action->diagnosa ?? '' }}</td>
                                        <td>{{ $action->jenis_tindakan ?? '' }}</td>
                                        <td>{{ $action->lokasi ?? '' }}</td>
                                        <td>{{ $action->laporan_tindakan ?? '' }}</td>
                                        <td>{{ $action->intruksi ?? '' }}</td>
                                        <td>
                                            <a href="{{ Storage::url($item->paraf) }}"><img src="{{ Storage::url($item->paraf) }}" alt=""></a>
                                            
                                        </td>
                                        @canany(['edit laporan tindakan', 'delete laporan tindakan'])
                                            <td>
                                                <div class="d-flex">
                                                    @can('print laporan tindakan')
                                                        <a href="{{ route('rajal/laporan/tindakan.show', $action->id) }}"
                                                            target="blank" class="btn btn-dark btn-sm"><i
                                                                class='bx bx-printer'></i></a>
                                                    @endcan
                                                    @if ($title == 'Rawat Jalan')
                                                        @can('edit laporan tindakan')
                                                            <button class="btn btn-warning btn-sm mx-2"
                                                                onclick="editTindakan({{ $action->id }})"><i
                                                                    class='bx bx-edit'></i></button>
                                                        @endcan
                                                        @can('delete laporan tindakan')
                                                            <form
                                                                action="{{ route('rajal/laporan/tindakan.destroy', $action->id) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button type = "submit" class="btn btn-danger btn-sm">
                                                                    <i class='bx bx-trash'></i>
                                                                </button>
                                                            </form>
                                                        @endcan
                                                    @endif
                                                </div>
                                            </td>
                                        @endcanany
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div class="tab-pane fade {{ session('btn') == 'resep dokter' ? 'show active' : '' }}"
                        id="navs-justified-resep" role="tabpanel">
                        <table class="table" id="example">
                            <thead>
                                <tr class="text-nowrap">
                                    <th class="text-body">No</th>
                                    <th class="text-body">Tanggal / Jam</th>
                                    <th class="text-body">Dokter</th>
                                    @canany(['edit resep dokter', 'hapus resep dokter', 'print resep dokter'])
                                        <th class="text-body">Action</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($receipts as $receipt)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $receipt->created_at->format('Y-m-d H:i') }}</td>
                                        <td>{{ $receipt->user->name ?? '' }}</td>
                                        @canany(['edit resep dokter', 'print resep dokter', 'hapus resep dokter'])
                                            <td>
                                                <div class="d-flex">
                                                    @can('print resep dokter')
                                                        <a href="{{ route('rajal/resep/dokter.show', $receipt->id) }}"
                                                            target="blank" class="btn btn-dark btn-sm"><i
                                                                class='bx bx-printer'></i></a>
                                                    @endcan
                                                    @can('edit resep dokter')
                                                        <a class="btn btn-warning btn-sm mx-2"
                                                            href="{{ route('rajal/resep/dokter.edit', $receipt->id) }}"><i
                                                                class='bx bx-edit'></i></a>
                                                    @endcan
                                                    @can('hapus resep dokter')
                                                        <form action="{{ route('rajal/resep/dokter.destroy', $receipt->id) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type = "submit" class="btn btn-danger btn-sm">
                                                                <i class='bx bx-trash'></i>
                                                            </button>
                                                        </form>
                                                    @endcan
                                                </div>
                                            </td>
                                        @endcanany
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div class="tab-pane fade {{ session('btn') == 'sbpk' ? 'show active' : '' }}"
                        id="navs-justified-sbpk" role="tabpanel">
                        <div class="text-end mb-3">
                            <a href="{{ route('rajal/sbpk.create', $item->id) }}" class="btn btn-success btn-sm">+Tambah
                                SBPK</a>
                        </div>
                        <table class="table">
                            <thead>
                                <tr class="text-nowrap">
                                    <th class="text-body">No</th>
                                    <th class="text-body">Nama Pasien</th>
                                    <th class="text-body">Tanggal Masuk</th>
                                    <th class="text-body">Jam Keluar</th>
                                    <th class="text-body">Keterangan</th>
                                    <th class="text-body">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sbpks as $sbpk)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $sbpk->patient->name ?? '' }}</td>
                                        <td>{{ $sbpk->tanggal_masuk ?? '' }}</td>
                                        <td>{{ $sbpk->jam_keluar ?? '' }}</td>
                                        <td>{{ $sbpk->keterangan ?? '' }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('rajal/sbpk.show', $sbpk->id) }}" target="blank"
                                                    class="btn btn-dark btn-sm"><i class='bx bx-printer'></i></a>
                                                <a href="{{ route('rajal/sbpk.edit', $sbpk->id) }}"
                                                    class="btn btn-warning btn-sm mx-2"><i class='bx bx-edit'></i></a>
                                                <form action="{{ route('rajal/sbpk.destroy', $sbpk->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type = "submit" class="btn btn-danger btn-sm">
                                                        <i class='bx bx-trash'></i>
                                                    </button>
                                                </form>
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
    {{-- end Menu Rajal Dokter --}}

    {{-- Menu Rajal Perawata --}}
    {{-- <div class="card">
        <div class="card-body">
            <div class="nav-align-top mb-2 shadow-sm">
                <ul class="nav nav-tabs nav-sm nav-fill" role="tablist">
                    <li class="nav-item">
                        <button id="btn-link" type="button"
                            class="nav-link {{ session('perawat') == 'anamnesis' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-anamnesis"
                            aria-controls="navs-justified-anamnesis" aria-selected="false">
                            <i class="tf-icons bx bx-bookmark-alt-plus"></i>
                            <p class="m-0">Anamnesis</p>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button id="btn-link" type="button"
                            class="nav-link {{ session('perawat') == 'pemeriksaan' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-pemeriksaan"
                            aria-controls="navs-justified-pemeriksaan" aria-selected="false">
                            <i class="tf-icons bx bx-bookmark-alt-plus"></i>
                            <p class="m-0">Pemeriksaan</p>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button id="btn-link" type="button"
                            class="nav-link {{ session('perawat') == 'psikologis' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-psikologis"
                            aria-controls="navs-justified-psikologis" aria-selected="false">
                            <i class="tf-icons bx bx-message-square-add"></i>
                            <p class="m-0">Psikologis & Sosial Ekonomi</p>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button id="btn-link" type="button"
                            class="nav-link {{ session('perawat') == 'soap' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-soap"
                            aria-controls="navs-justified-soap" aria-selected="false">
                            <i class="tf-icons bx bx-message-alt-add"></i>
                            <p class="m-0">SOAP</p>
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade {{ session('perawat') == 'anamnesis' ? 'show active' : '' }} show active"
                        id="navs-justified-anamnesis" role="tabpanel">                    
                        <form action="{{ route('rajal/rmedokter/assesmenawal.store', $item->id) }}" method="POST">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <label class="form-label fw-bold">Anamnesa / Keluhan Utama</label>
                                            <textarea id="editor5" class="form-control" id="keluhan" name="keluhan" rows="4"></textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <label class="form-label fw-bold">Riwayat Penyakit Pasien</label>
                                            <textarea id="editor1" class="form-control" id="riwayat_penyakit_sekarang" name="riwayat_penyakit_sekarang" rows="3"></textarea>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label fw-bold">Riwayat Penyakit Keluarga</label>
                                            <textarea id="editor4" class="form-control" id="riwayat_penyakit_keluarga" name="riwayat_penyakit_keluarga" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <label class="form-label fw-bold">Alergi Makanan</label>
                                            <textarea id="editor4" class="form-control" id="alergi_makanan" name="alergi_makanan" rows="6"></textarea>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label fw-bold">Alergi Obat</label>
                                            <textarea id="editor4" class="form-control" id="alergi_obat" name="alergi_obat" rows="6"></textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="form-label fw-bold" id="label-kolom">Asesmen Gizi</label>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="asesmen_gizi" class="form-label">Apakah pasien mengalami penurunan berat badan dalam 6 bulan terakhir ?</label>
                                                <div class="input-group">
                                                    <select name="asesmen_gizi" id="asesmen_gizi" class="form-control" aria-describedby="basic-addon1">
                                                        <option value="0">Tidak</option>
                                                        <option value="2">Tidak yakin</option>
                                                        <option value="1">Turun sebanyak 1-5 Kg</option>
                                                        <option value="2">Turun sebanyak 6-10 Kg</option>
                                                        <option value="3">Turun sebanyak 11-15 Kg</option>
                                                        <option value="4">Turun lebih dari 15 Kg</option>
                                                        <option value="2">Tidak tahu berapa kg penurunang</option>
                                                    </select>
                                                    <span class="input-group-text" id="basic-addon1">Skor: 0</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label" for="kurang_nafsu">Apakah memiliki keluhan kurang nafsu makan ?</label>
                                                <div class="input-group">
                                                    <select name="kurang_nafsu" id="kurang_nafsu" class="form-control" aria-describedby="basic-addon2">
                                                        <option value="0">Tidak</option>
                                                        <option value="1">Ya</option>
                                                    </select>
                                                    <span class="input-group-text" id="basic-addon2">Skor: 0</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md">
                                            <p class="m-0 fw-bold">Kondisi Gizi Pasien</p>
                                            <div class="form-check form-check-inline mt-3">
                                              <input class="form-check-input" type="radio" name="kondisi_gizi" id="inlineRadio1" value="Baik" @checked(true)/>
                                              <label class="form-check-label" for="inlineRadio1">Baik</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                              <input class="form-check-input" type="radio" name="kondisi_gizi" id="inlineRadio2" value="Lebih" />
                                              <label class="form-check-label" for="inlineRadio2">Lebih</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                              <input class="form-check-input" type="radio" name="kondisi_gizi" id="inlineRadio3" value="Kurang" />
                                              <label class="form-check-label" for="inlineRadio3">Kurang</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                              <input class="form-check-input" type="radio" name="kondisi_gizi" id="inlineRadio4" value="Buruk" />
                                              <label class="form-check-label" for="inlineRadio4">Buruk</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 text-end">
                                    <button type="submit" class="btn btn-success btn-sm mx-3">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade {{ session('perawat') == 'pemeriksaan' ? 'show active' : '' }}"
                        id="navs-justified-pemeriksaan" role="tabpanel">
                        <form action="" method="POST">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <label class="form-label fw-bold" id="label-kolom">Tanda-tanda Vital</label>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label class="form-label">Nadi</label>
                                                <div class="input-group">
                                                    <input type="text" name="ttv_nadi" class="form-control" aria-describedby="ttv_nadi">
                                                    <span class="input-group-text" id="ttv_nadi">bpm</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Nafas</label>
                                                <div class="input-group">
                                                    <input type="text" name="ttv_td_sistolik" class="form-control" aria-describedby="ttv_td_sistolik">
                                                    <span class="input-group-text" id="ttv_td_sistolik">/</span>
                                                    <input type="text" name="ttv_td_diastolik" class="form-control" aria-describedby="ttv_td_diastolik">
                                                    <span class="input-group-text" id="ttv_td_diastolik">mmHg</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="form-label fw-bold mt-2" id="label-kolom">Pemeriksaan Fisik</label>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label class="form-label my-0">Keadaan Umum</label>
                                                <div class="col-sm">
                                                    <div class="form-check form-check-inline mt-3">
                                                      <input class="form-check-input" type="radio" name="keadaan_umum" id="keadaan-umum1" value="Baik" @checked(true)/>
                                                      <label class="form-check-label" for="keadaan-umum1">Baik</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                      <input class="form-check-input" type="radio" name="keadaan_umum" id="keadaan-umum2" value="Lemas" />
                                                      <label class="form-check-label" for="keadaan-umum2">Lemas</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                      <input class="form-check-input" type="radio" name="keadaan_umum" id="keadaan-umum3" value="Sakit Ringan" />
                                                      <label class="form-check-label" for="keadaan-umum3">Sakit Ringan</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                      <input class="form-check-input" type="radio" name="keadaan_umum" id="keadaan-umum4" value="Sakit Sedang" />
                                                      <label class="form-check-label" for="keadaan-umum4">Sakit Sedang</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                      <input class="form-check-input" type="radio" name="keadaan_umum" id="keadaan-umum5" value="Sakit Berat" />
                                                      <label class="form-check-label" for="keadaan-umum5">Sakit Berat</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Kesadaran</label>
                                                <input type="text" name="kesadaran" class="form-control form-control-sm">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-4">
                                            <label class="form-label fw-bold">Tinggi Badan</label>
                                            <div class="input-group">
                                                <input class="form-control" id="tb" name="tb"></input>
                                                <span class="input-group-text">cm</span>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <label class="form-label fw-bold">Berat Badan</label>
                                            <div class="input-group">
                                                <input class="form-control" id="bb" name="bb"></input>
                                                <span class="input-group-text">kg</span>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <label class="form-label fw-bold">Lingkar Kepala</label>
                                            <div class="input-group">
                                                <input class="form-control" id="lk" name="lk"></input>
                                                <span class="input-group-text">cm</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="form-label fw-bold">Asesmen Nyeri</label>
                                        <div class="col-6">
                                            <img src="{{ asset('/assets/img/aakprj2.jpg') }}" alt="" class="img-fluid" style="max-width: 350px">
                                            <div class="col-md">
                                                <div class="form-check form-check-inline mt-3 ms-4">
                                                  <input class="form-check-input" type="radio" name="ass_nyeri" id="nyeri-1" value="0" />
                                                  <label class="form-check-label" for="nyeri-1">0</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                  <input class="form-check-input" type="radio" name="ass_nyeri" id="nyeri-2" value="2" />
                                                  <label class="form-check-label" for="nyeri-2">2</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                  <input class="form-check-input" type="radio" name="ass_nyeri" id="nyeri-3" value="4"/>
                                                  <label class="form-check-label" for="nyeri-3">4</label>
                                                </div>
                                                <div class="form-check form-check-inline mt-3">
                                                  <input class="form-check-input" type="radio" name="ass_nyeri" id="nyeri-4" value="6" />
                                                  <label class="form-check-label" for="nyeri-4">6</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                  <input class="form-check-input" type="radio" name="ass_nyeri" id="nyeri-5" value="8" />
                                                  <label class="form-check-label" for="nyeri-5">8</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                  <input class="form-check-input" type="radio" name="ass_nyeri" id="nyeri-6" value="10"/>
                                                  <label class="form-check-label" for="nyeri-6">10</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 text-end">
                                    <button type="submit" class="btn btn-success btn-sm mx-3">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade {{ session('perawat') == 'psikologis' ? 'show active' : '' }}"
                        id="navs-justified-psikologis" role="tabpanel">
                        <form action="" method="POST">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <label class="form-label fw-bold" id="label-kolom">Asesmen Gizi</label>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="status_psikologis" class="form-label">Status Psikologis</label>
                                                <select name="status_psikologis" id="status_psikologis" class="form-select form-select-md">
                                                    <option value="Tenang">Tenang</option>
                                                    <option value="Tegang">Tegang</option>
                                                    <option value="Takut">Takut</option>
                                                    <option value="Marah">Marah</option>
                                                    <option value="Senang">Senang</option>
                                                    <option value="Sedih">Sedih</option>
                                                    <option value="Depresi">Depresi</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="status_ekonomi" class="form-label">Status Sosial & Ekonomi</label>
                                                <select name="status_ekonomi" id="status_ekonomi" class="form-select form-select-md">
                                                    <option value="Baik">Baik</option>
                                                    <option value="Cukup">Cukup</option>
                                                    <option value="Kurang">Kurang</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 text-end">
                                    <button type="submit" class="btn btn-success btn-sm mx-3">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade {{ session('perawat') == 'soap' ? 'show active' : '' }}" id="navs-justified-soap" role="tabpanel">
                        <form action="" method="POST">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="row mb-4">
                                            <div class="col-sm-6">
                                                <label for="subjective" class="form-label">Subjective</label>
                                                <textarea name="subjective" id="subjective" class="form-control" rows="10" placeholder="Subjective"></textarea>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="objective" class="form-label">Objective</label>
                                                <textarea name="objective" id="objective" class="form-control" rows="10" placeholder="Objective"></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="asesmen" class="form-label">Assesment</label>
                                                <textarea name="asesmen" id="asesmen" class="form-control" rows="10" placeholder="Assesment"></textarea>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="planning" class="form-label">Planning</label>
                                                <textarea name="planning" id="planning" class="form-control" rows="10" placeholder="Planning"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 text-end">
                                    <button type="submit" class="btn btn-success btn-sm mx-3">Simpan</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- end Menu Rajal Perawat --}}


    {{-- modal --}}
    <div class="modal fade" id="modalScrollable" tabindex="-1" aria-labelledby="modalScrollableTitle"
        aria-hidden="true">

    </div>

    <script>
        function createPrmrj(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url: "{{ URL::route('rajal/prmrj.create') }}",
                data: {
                    queue_id: id,
                },
                success: function(data) {
                    var div = document.createElement('div');
                    div.className = 'modal-dialog modal-lg modal-dialog-scrollable';
                    div.innerHTML = data;
                    $('#modalScrollable').html(div);
                    $('#modalScrollable').modal('show');
                }
            });
        }

        function editPrmrj(id) {
            $.ajax({
                type: 'get',
                url: "{{ route('rajal/prmrj.edit', '') }}/" + id,
                success: function(data) {
                    var div = document.createElement('div');
                    div.className = 'modal-dialog modal-lg modal-dialog-scrollable';
                    div.innerHTML = data;
                    $('#modalScrollable').html(div);
                    $('#modalScrollable').modal('show');
                }
            });
        }

        function createTindakan(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url: "{{ URL::route('rajal/laporan/tindakan.create') }}",
                data: {
                    queue_id: id,
                },
                success: function(data) {
                    var div = document.createElement('div');
                    div.className = 'modal-dialog modal-lg modal-dialog-scrollable';
                    div.innerHTML = data,
                        $('#modalScrollable').html(div);
                    $('#modalScrollable').modal('show');
                }
            });
        }

        function editTindakan(id) {
            $.ajax({
                type: 'get',
                url: "{{ url('rajal/laporan/tindakan/edit') }}/" + id,
                success: function(data) {
                    var div = document.createElement('div');
                    div.className = 'modal-dialog modal-lg modal-dialog-scrollable';
                    div.innerHTML = data;
                    $('#modalScrollable').html(div);
                    $('#modalScrollable').modal('show');
                }
            });
        }

        function showHasil() {
            $('#hasilPemeriksaan').show('content');
        }

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
    
    
@endsection
