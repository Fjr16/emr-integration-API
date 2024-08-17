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
    {{-- end data riwayat pemeriksaan pasien --}}
@endsection
