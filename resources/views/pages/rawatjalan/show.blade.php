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
                    <h6>{{ $item->doctorPatient->user->name }} ({{ $item->doctorPatient->user->staff_id }})</h6>
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
                            <div class="col-md-4 col-12 mb-3 mb-md-0">
                              <div class="list-group">
                                <a class="list-group-item list-group-item-action active" id="list-identitas-list" data-bs-toggle="list" href="#list-identitas">Identitas Pasien</a>
                                <a class="list-group-item list-group-item-action" id="list-kunjungan-terakhir-list" data-bs-toggle="list" href="#list-kunjungan-terakhir">Kunjungan Terakhir</a>
                                <a class="list-group-item list-group-item-action" id="list-rawat-jalan-list" data-bs-toggle="list" href="#list-rawat-jalan">Rawat Jalan</a>
                                <a class="list-group-item list-group-item-action" id="list-laboratorium-list" data-bs-toggle="list" href="#list-laboratorium">Laboratorium</a>
                                <a class="list-group-item list-group-item-action" id="list-radiologi-list" data-bs-toggle="list" href="#list-radiologi">Radiologi</a>
                              </div>
                            </div>
                            <div class="col-md-8 col-12 border">
                              <div class="tab-content">
                                <div class="tab-pane fade show active" id="list-identitas">
                                  Donut sugar plum sweet roll biscuit. Cake oat cake gummi bears. Tart wafer wafer halvah gummi bears cheesecake. Topping croissant cake sweet roll. Dessert fruitcake gingerbread halvah marshmallow pudding bear claw cheesecake. Bonbon dragée cookie gummies. Pudding marzipan liquorice. Sugar plum dragée cupcake cupcake cake dessert chocolate bar. Pastry lollipop lemon drops lollipop halvah croissant. Pastry sweet gingerbread lemon drops topping ice cream.
                                </div>
                                <div class="tab-pane fade" id="list-kunjungan-terakhir">
                                  Muffin lemon drops chocolate chupa chups jelly beans dessert jelly-o. Soufflé gummies gummies. Ice cream powder marshmallow cotton candy oat cake wafer. Marshmallow gingerbread tootsie roll. Chocolate cake bonbon jelly beans lollipop jelly beans halvah marzipan danish pie. Oat cake chocolate cake pudding bear claw liquorice gingerbread icing sugar plum brownie. Toffee cookie apple pie cheesecake bear claw sugar plum wafer gummi bears fruitcake. 
                                </div>
                                <div class="tab-pane fade" id="list-rawat-jalan">
                                  Ice cream dessert candy sugar plum croissant cupcake tart pie apple pie. Pastry chocolate chupa chups tiramisu. Tiramisu cookie oat cake. Pudding brownie bonbon. Pie carrot cake chocolate macaroon. Halvah jelly jelly beans cake macaroon jelly-o. Danish pastry dessert gingerbread powder halvah. Muffin bonbon fruitcake dragée sweet sesame snaps oat cake marshmallow cheesecake. Cupcake donut sweet bonbon cheesecake soufflé chocolate bar.
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

    @role('Dokter Poli')
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
                            class="nav-link {{ session('btn') == 'dokter' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-profile"
                            aria-controls="navs-justified-profile" aria-selected="false" onclick="showHasil()">
                            <i class="tf-icons bx bx-bookmark-alt-plus"></i>
                            <p class="m-0">RME Dokter</p>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button id="btn-link" type="button"
                            class="nav-link {{ session('btn') == 'perawat' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-messages"
                            aria-controls="navs-justified-messages" aria-selected="false">
                            <i class="tf-icons bx bx-message-square-add"></i>
                            <p class="m-0">Asesmen Keperawatan</p>
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
                    <div class="tab-pane fade {{ session('btn') == 'dokter' ? 'show active' : '' }}"
                        id="navs-justified-profile" role="tabpanel">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="nav-align-top w-100 mb-4">
                                    <ul class="nav nav-pills nav-sm mb-3 nav-fill" role="tablist">
                                        <li class="nav-item">
                                            <button type="button"
                                                class="border  nav-link {{ session('dokter') == 'assesmen' ? 'active' : '' }}"
                                                role="tab" data-bs-toggle="tab"
                                                data-bs-target="#navs-pills-justified-asesmen"
                                                aria-controls="navs-pills-justified-asesmen" aria-selected="true">
                                                Asesmen Awal
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button type="button"
                                                class="border nav-link {{ session('dokter') == 'radiologi' ? 'active' : '' }}"
                                                role="tab" data-bs-toggle="tab"
                                                data-bs-target="#navs-pills-justified-radiologi"
                                                aria-controls="navs-pills-justified-radiologi" aria-selected="true">
                                                Permintaan Radiologi
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button type="button"
                                                class="border nav-link {{ session('dokter') == 'laboratorium' ? 'active' : '' }}"
                                                role="tab" data-bs-toggle="tab"
                                                data-bs-target="#navs-pills-justified-laboratorium"
                                                aria-controls="navs-pills-justified-laboratorium" aria-selected="true">
                                                Permintaan Laboratorium
                                            </button>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade {{ session('dokter') == 'assesmen' ? 'show active' : '' }}"
                                            id="navs-pills-justified-asesmen" role="tabpanel">
                                                <div class="text-end">
                                                    <a href="{{ route('rajal/rmedokter/assesmenawal.create', $item->id) }}"
                                                        class="btn btn-success btn-sm">+Tambah Assesmen</a>
                                                </div>
                                            <table class="table">
                                                <thead>
                                                    <tr class="text-nowrap">
                                                        <th class="text-body">No</th>
                                                        <th class="text-body">Dokter</th>
                                                        <th class="text-body">Tanggal</th>
                                                        <th class="text-body">Action</th>
                                                    </tr>
                                                </thead>
                                                @php
                                                    $sortedAssessments = $item->patient->initialAssesments->sortByDesc(
                                                        'created_at',
                                                    );
                                                @endphp
                                                <tbody>
                                                    @foreach ($sortedAssessments as $itemAssesment)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $itemAssesment->user->name }}</td>
                                                            <td>{{ $itemAssesment->created_at ?? '' }}</td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <button type="button"
                                                                        class="btn p-0 dropdown-toggle hide-arrow"
                                                                        data-bs-toggle="dropdown">
                                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu">
                                                                        <a href="{{ route('rajal/rmedokter/assesmenawal.print', $itemAssesment->id) }}"
                                                                            target="blank" class="dropdown-item">
                                                                            <i class='bx bx-printer'></i>
                                                                            Print
                                                                        </a>
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('rajal/rmedokter/assesmenawal.edit', $itemAssesment->id) }}">
                                                                            <i class="bx bx-edit-alt me-1"></i>
                                                                            Edit
                                                                        </a>
                                                                        {{-- <a href="{{  route('rajal/rmedokter/assesmenawal.show', $itemAssesment->id) }}"
                                                                            target="blank" class="dropdown-item">
                                                                            <i class='bx bx-printer'></i>
                                                                            Show
                                                                        </a> --}}

                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade {{ session('dokter') == 'radiologi' ? 'show active' : '' }}"
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
                                        <div class="tab-pane fade {{ session('dokter') == 'laboratorium' ? 'show active' : '' }}"
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
                    <div class="tab-pane fade {{ session('btn') == 'perawat' ? 'show active' : '' }}"
                        id="navs-justified-messages" role="tabpanel">
                        @can('tambah rme perawat')
                            <div class="text-end mb-3">
                                @if (!$diagnosisPatient)
                                    <form id="keperawatan-form-{{ $item->id }}"
                                        action="{{ route('rajal/asesmen/status/fisik.save', $item->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="no_rm" value="{{ $item->id }}">
                                        <input type="hidden" name="patient_id" value="{{ $item->patient->id }}">
                                        <input type="hidden" name="queue_id" value="{{ $item->id }}">
                                        <button type="submit" class="btn btn-success btn-sm">
                                            Tambah Asesmen Keperawatan
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('rajal/asesmen/status/fisik.index', $item->id) }}" type="button"
                                        class="btn btn-warning btn-sm">
                                        Edit Asesmen Keperawatan
                                    </a>
                                @endif



                                {{-- <a href="{{ route('clear/asesment/perawat') }}" class="btn btn-success btn-sm">Unit Test Hapus</a> --}}
                            </div>
                            {{-- @endif --}}
                        @endcan
                        <table class="table" id="example">
                            <thead>
                                <tr class="text-nowrap">
                                    <th class="text-body">No</th>
                                    <th class="text-body">Nama Pasien</th>
                                    <th class="text-body">Petugas</th>
                                    <th class="text-body">Tanggal</th>
                                    @canany(['lihat rme perawat'])
                                        <th class="text-body">Action</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($asesmentPatient as $asesment)
                                    <tr class="{{ $asesment->queue_id == $item->id ? 'text-success' : '' }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $asesment->patient->name }}</td>
                                        <td>{{ $asesment->user->name }}</td>
                                        <td>{{ date_format($asesment->created_at, 'd - m - Y') }}</td>
                                        @canany(['lihat rme perawat'])
                                            <td>
                                                @can('lihat rme perawat')
                                                    <div class="d-flex flex-row">
                                                        <a href="{{ route('rajal/asesmen.print', $asesment->id) }}"
                                                            class="btn btn-dark btn-sm" target="blank"><i
                                                                class='bx bx-printer'></i></a>
                                                        <a href="{{ route('rajal/asesmen/status/fisik.index', $asesment->queue) }}"
                                                            class="btn btn-warning btn-sm ms-1"><i class='bx bx-edit-alt'></i></a>
                                                    </div>
                                                @endcan
                                            </td>
                                        @endcanany
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
                                    <tr
                                        class="{{ $item->id == $cppt->rawatJalanPoliPatient->rawatJalanPatient->queue_id ? 'text-success' : '' }}">
                                        <td>{{ $loop->iteration ?? '' }}</td>
                                        <td>{{ $cppt->user->name ?? '' }}</td>
                                        <td>{{ $cppt->tanggal ?? '' }}</td>
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
    @endrole

    @role('Perawat Rajal')     
    {{-- Menu Rajal Perawata --}}
    <div class="card">
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
                                {{-- <div class="mb-3 mt-2 mx-3 parent row d-flex justify-content-between">
                                    @php
                                        $ttd_dokter = '';
                                        $ttd_pasien = '';
                                        $nama_dokter = '';
                                        $nama_pasien = '';
                                    @endphp
                                    <div class="col-md-5 row d-flex justify-content-center">
                                        <h6 class="fw-bold text-center mb-4">Tanda Tangan Dokter</h6>
                                        <div class="text-center">
                                            <img src="{{ asset('storage/' . $ttd_dokter) }}" alt="" id="ImgTtdDokter" style="max-width: 200px">
                                            <textarea id="ttdDokter" name="ttd_dokter" style="display: none;">{{ $ttd_dokter }}</textarea>
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col">
                                                        <button type="button" class="col-12 btn btn-sm btn-dark"
                                                            onclick="openModal(this, 'ImgTtdDokter', 'ttdDokter', 'nm_dokter')">Tanda
                                                            Tangan</button>
                                                    </div>
                                                    <div class="col">
                                                        <button type="button" class="col-12 btn btn-sm btn-secondary"
                                                            id="clearImgDokter">Clear</button>
                                                    </div>
                                                    <div class="col-12 mt-2">
                                                        <input type="text" class="form-control form-control-sm text-center"
                                                            name="nm_dokter" id="nm_dokter" value="{{ $nama_dokter }}"
                                                            placeholder="Nama Lengkap" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 row d-flex justify-content-center">
                                        <h6 class="fw-bold text-center mb-4">Tanda tangan Pasien/Wali</h6>
                                        <div class="text-center">
                                            <img src="{{ asset('storage/' . $ttd_pasien) }}" alt="" id="ImgTtdKeluargaPasien" style="max-width: 200px">
                                            <textarea id="ttd" name="ttd" style="display: none;">{{ $item->patient->name }}</textarea>
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col">
                                                        <button type="button" class="col-12 btn btn-sm btn-dark"
                                                            onclick="openModalTtdBottom(this, 'ImgTtdKeluargaPasien', 'ttd')">Tanda
                                                            Tangan</button>
                                                    </div>
                                                    <div class="col">
                                                        <button type="button" class="col-12 btn btn-sm btn-secondary"
                                                            id="clearImgPerawat">Clear</button>
                                                    </div>
                                                    <div class="col-12 mt-2">
                                                        <input type="text" class="form-control form-control-sm text-center"
                                                            name="nm_pasien" id="nm_pasien" value="{{ $item->patient->name }}"
                                                            placeholder="Nama Lengkap" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="mb-3 text-end">
                                    <button type="submit" class="btn btn-success btn-sm mx-3">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade {{ session('perawat') == 'pemeriksaan' ? 'show active' : '' }}"
                        id="navs-justified-pemeriksaan" role="tabpanel">
                        <form action="{{ route('rajal/asesmen/status/fisik.store', $item->id) }}" method="POST">
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
                        <form action="{{ route('rajal/asesmen/status/fisik.store', $item->id) }}" method="POST">
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
                        <form action="{{ route('rajal/asesmen/status/fisik.store', $item->id) }}" method="POST">
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
    </div>
    {{-- end Menu Rajal Perawat --}}
    @endrole


    

    {{-- Hasil Pemeriksaan --}}
    {{-- <div class="card overflow-hidden mb-4 mt-3" style="height: 500px;">
        <h5 class="card-title px-4 mt-3 m-0">
            Hasil Pemeriksaan
        </h5>
        <hr class="mb-0">
        <div class="card-body mt-0" id="vertical-example">
          <p>Sweet roll I love I love. Tiramisu I love soufflé cake tart sweet roll cotton candy cookie. Macaroon biscuit dessert. Bonbon cake soufflé jelly gummi bears lemon drops. Chocolate bar I love macaroon danish candy pudding. Jelly carrot cake I love tart cake bear claw macaroon candy candy canes. Muffin gingerbread sweet jujubes croissant sweet roll. Topping muffin carrot cake sweet. Toffee chocolate muffin I love croissant. Donut carrot cake ice cream ice cream. Wafer I love pie danish marshmallow cheesecake oat cake pie I love. Icing pie chocolate marzipan jelly ice cream cake.</p>
          <p>Marzipan oat cake caramels chocolate. Lemon drops cheesecake jelly beans sweet icing pudding croissant. Donut candy canes carrot cake soufflé. Croissant candy wafer pie I love oat cake lemon drops caramels jujubes. I love macaroon halvah liquorice cake. Danish sweet roll pudding cookie sweet roll I love. Jelly cake I love bear claw jujubes dragée gingerbread. I love cotton candy carrot cake halvah biscuit I love macaroon cheesecake tootsie roll. Chocolate cotton candy biscuit I love fruitcake cotton candy biscuit tart gingerbread. Powder oat cake I love. Cheesecake candy canes macaroon I love wafer I love sweet roll ice cream. Toffee cookie macaroon lemon drops tart candy canes. Gummies gummies pie tiramisu I love bear claw cheesecake.</p>
          <p>Marzipan oat cake caramels chocolate. Lemon drops cheesecake jelly beans sweet icing pudding croissant. Donut candy canes carrot cake soufflé. Croissant candy wafer pie I love oat cake lemon drops caramels jujubes. I love macaroon halvah liquorice cake. Danish sweet roll pudding cookie sweet roll I love. Jelly cake I love bear claw jujubes dragée gingerbread. I love cotton candy carrot cake halvah biscuit I love macaroon cheesecake tootsie roll. Chocolate cotton candy biscuit I love fruitcake cotton candy biscuit tart gingerbread. Powder oat cake I love. Cheesecake candy canes macaroon I love wafer I love sweet roll ice cream. Toffee cookie macaroon lemon drops tart candy canes. Gummies gummies pie tiramisu I love bear claw cheesecake.</p>
          <p>Sweet roll I love I love. Tiramisu I love soufflé cake tart sweet roll cotton candy cookie. Macaroon biscuit dessert. Bonbon cake soufflé jelly gummi bears lemon drops. Chocolate bar I love macaroon danish candy pudding. Jelly carrot cake I love tart cake bear claw macaroon candy candy canes. Muffin gingerbread sweet jujubes croissant sweet roll. Topping muffin carrot cake sweet. Toffee chocolate muffin I love croissant. Donut carrot cake ice cream ice cream. Wafer I love pie danish marshmallow cheesecake oat cake pie I love. Icing pie chocolate marzipan jelly ice cream cake.</p>
          <p>Sweet roll I love I love. Tiramisu I love soufflé cake tart sweet roll cotton candy cookie. Macaroon biscuit dessert. Bonbon cake soufflé jelly gummi bears lemon drops. Chocolate bar I love macaroon danish candy pudding. Jelly carrot cake I love tart cake bear claw macaroon candy candy canes. Muffin gingerbread sweet jujubes croissant sweet roll. Topping muffin carrot cake sweet. Toffee chocolate muffin I love croissant. Donut carrot cake ice cream ice cream. Wafer I love pie danish marshmallow cheesecake oat cake pie I love. Icing pie chocolate marzipan jelly ice cream cake.</p>
          <p class="mb-0">Sweet roll I love I love. Tiramisu I love soufflé cake tart sweet roll cotton candy cookie. Macaroon biscuit dessert. Bonbon cake soufflé jelly gummi bears lemon drops. Chocolate bar I love macaroon danish candy pudding. Jelly carrot cake I love tart cake bear claw macaroon candy candy canes. Muffin gingerbread sweet jujubes croissant sweet roll. Topping muffin carrot cake sweet. Toffee chocolate muffin I love croissant. Donut carrot cake ice cream ice cream. Wafer I love pie danish marshmallow cheesecake oat cake pie I love. Icing pie chocolate marzipan jelly ice cream cake.</p>
        </div>
      </div> --}}
    {{-- end Hasil Pemeriksaan --}}

    {{-- form input --}}


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
