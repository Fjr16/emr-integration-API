@extends('layouts.backend.main')

@section('content')
    {{-- @dd(session()->all()) --}}
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
            <form action="{{ route('igd/patient/rme.updateStatus', $item->id) }}" method="POST"
                onsubmit="return confirm('Sebelum melanjutkan, Pastikan data telah diisi dengan benar dan lengkap !!!. Apakah anda yakin untuk melanjutkan ? ')">
                @method('PUT')
                @csrf
                <button type="submit" class="btn btn-success btn-sm" name="status" value="SELESAI">SELESAI</button>
            </form>
        @endcan
    </div>

    <div class="card">
        {{-- Informasi Pasien --}}
        <div class="card-body">
            <h4>Data Pasien</h4>
            <div class="row mt-4 px-5">
                <div class="col-sm-6">
                    <div class="d-flex">
                        <h6 class="m-0 mt-1">{{ $item->queue->patient->name ?? '' }}
                            ({{ implode('-', str_split(str_pad($item->queue->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }})
                        </h6>
                    </div>
                    <hr class="p-0 mt-2">
                    <table class="w-100">
                        <tbody>
                            <tr>
                                <td style="min-width: 150px">Tanggungan</td>
                                <td style="min-width: 30px">:</td>
                                <td>{{ $item->queue->patientCategory->name ?? '' }}</td>
                            </tr>
                            <tr>
                                <td style="min-width: 150px">Jenis Kelamin</td>
                                <td style="min-width: 30px">:</td>
                                <td>{{ $item->queue->patient->jenis_kelamin ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Lahir</td>
                                <td>:</td>
                                <td>{{ $item->queue->patient->tanggal_lhr ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>Usia</td>
                                <td>:</td>
                                <td>{{ $usia ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>Telepon</td>
                                <td>:</td>
                                <td>{{ $item->queue->patient->telp ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td>{{ $item->queue->patient->alamat ?? '' }}</td>
                            </tr>
                        </tbody>
                    </table>
                    {{-- <hr class="p-0 mt-2">
                                <h6>Registrasi</h6>
                                <table class="w-100">
                                <tr>
                                    <td class="w-25">ID Kasus</td>
                                    <td>2276566567</td>
                                </tr>
                                <tr>
                                    <td>Nomor</td>
                                    <td>4546576675</td>
                                </tr>
                                <tr>
                                    <td>Poli</td>
                                    <td></td>
                                </tr>
                                </table> --}}
                </div>
                <div class="col-sm-6">
                    <h6 class="m-0 mt-1">Dokter</h6>
                    <hr class="p-0 mt-2">
                    <p>{{ $item->user->name ?? '' }} ({{ $item->user->staff_id ?? '' }})</p>
                </div>
            </div>
        </div>
        {{-- end Informasi Pasien --}}


        {{-- Menu IGD --}}
        <div class="card-body">
            <div class="nav-align-top mb-4 shadow-sm">
                <ul class="nav nav-tabs nav-sm nav-fill" role="tablist">
                    <li class="nav-item">
                        <button id="btn-link" type="button"
                            class="nav-link {{ session('active') == 'triase' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-triase"
                            aria-controls="navs-justified-triase" aria-selected="false">
                            <i class="tf-icons bx bx-message-alt-add"></i>
                            <p class="m-0">Triase</p>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button id="btn-link" type="button"
                            class="nav-link {{ session('active') == 'general-consent' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-general-consent"
                            aria-controls="navs-justified-general-consent" aria-selected="false">
                            <i class="tf-icons bx bx-message-alt-add"></i>
                            <p class="m-0">General Consent</p>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button id="btn-link" type="button"
                            class="nav-link {{ session('active') == 'assesmen_medis' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-assesmen-medis"
                            aria-controls="navs-justified-asesmen-medis" aria-selected="false">
                            <i class="tf-icons bx bx-bookmark-alt-plus"></i>
                            <p class="m-0">Asesmen Medis</p>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button id="btn-link" type="button"
                            class="nav-link {{ session('active') == 'asesmenperawat' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-asesmenperawat"
                            aria-controls="navs-justified-asesmenperawat" aria-selected="false">
                            <i class="tf-icons bx bx-message-square-add"></i>
                            <p class="m-0">Asesmen Perawat</p>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button id="btn-link" type="button"
                            class="nav-link {{ session('active') == 'cppt' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-cppt"
                            aria-controls="navs-justified-cppt" aria-selected="false">
                            <i class="tf-icons bx bx-message-alt-add"></i>
                            <p class="m-0">CPPT</p>
                        </button>
                    </li>
                    {{-- <li class="nav-item">
                        <button
                        id="btn-link"
                        type="button"
                        class="nav-link d-flex justify-content-center"
                        role="tab"
                        data-bs-toggle="tab"
                        data-bs-target="#navs-justified-sbpk"
                        aria-controls="navs-justified-sbpk"
                        aria-selected="false"
                        >
                        <i class="tf-icons bx bx-message-alt-add"></i>
                        <p class="m-0">SBPK</p>
                        </button>
                    </li> --}}
                    <li class="nav-item">
                        <button id="btn-link" type="button"
                            class="nav-link {{ session('active') == 'spri' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-spri"
                            aria-controls="navs-justified-spri" aria-selected="false">
                            <i class="tf-icons bx bx-message-alt-add"></i>
                            <p class="m-0">SPRI</p>
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade {{ session('active') == 'triase' ? 'show active' : '' }}"
                        id="navs-justified-triase" role="tabpanel">
                        <div class="text-end mb-3">
                            <a href="{{ route('igd/triase/print.allPrint', $item->id) }}" class="btn btn-dark btn-sm"><i
                                    class='bx bx-printer'></i> Print Semua</a>
                            <a href="{{ route('igd/triase.create', $item->id) }}" class="btn btn-success btn-sm">+Tambah
                                Triase</a>
                        </div>
                        <table class="table" id="example">
                            <thead>
                                <tr class="text-nowrap">
                                    <th class="text-body">No</th>
                                    <th class="text-body">Dokter</th>
                                    <th class="text-body">Petugas Triase</th>
                                    <th class="text-body">Pasien</th>
                                    <th class="text-body">Tanggal</th>
                                    <th class="text-body">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($item->queue->patient->igdTriages->sortByDesc('created_at') as $triase)
                                
                                    <tr  class="{{ $item->queue->id == $triase->igdPatient->queue_id ? 'text-success' : '' }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->user->name ?? '' }}</td>
                                        <td>{{ $triase->user->name ?? '' }}</td>
                                        <td>{{ $triase->patient->name ?? '' }}</td>
                                        <td>{{ $triase->created_at ?? '' }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a href="{{ route('igd/triase.edit', $triase->id) }}"
                                                        class="dropdown-item">
                                                        <i class='bx bx-edit me-1'></i>
                                                        Edit
                                                    </a>
                                                    <a href="{{ route('igd/triase.show', $triase->id) }}"
                                                        class="dropdown-item">
                                                        <i class='bx bx-show-alt me-1'></i>
                                                        Show
                                                    </a>
                                                    <form action="{{ route('igd/triase.destroy', $triase->id) }}"
                                                        method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="dropdown-item"
                                                            onclick="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
                                                            <i class='bx bx-trash me-1'></i>
                                                            Hapus
                                                        </button>
                                                    </form>
                                                    <a href="{{ route('igd/triase.print', ['id' => $triase->id, 'dokter_id' => $item->user->id]) }}"
                                                        class="dropdown-item">
                                                        <i class='bx bx-printer'></i>
                                                        Print
                                                    </a>

                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div class="tab-pane fade {{ session('active') == 'general-consent' ? 'show active' : '' }}"
                        id="navs-justified-general-consent" role="tabpanel">
                        <div class="text-end mb-3">
                            <a href="{{ route('igd/general/consent.create', $item->id) }}"
                                class="btn btn-success btn-sm">+Tambah
                                General Consent</a>
                        </div>
                        <table class="table" id="example">
                            <thead>
                                <tr class="text-nowrap">
                                    <th class="text-body">No</th>
                                    <th class="text-body">Dokter</th>
                                    <th class="text-body">Petugas</th>
                                    <th class="text-body">Pasien</th>
                                    <th class="text-body">Tanggal Kunjungan</th>
                                    <th class="text-body">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($item->queue->patient->igdGeneralConsents->sortByDesc('created_at') as $gc)
                                    <tr class="{{ $item->queue->id == $gc->igdPatient->queue_id ? 'text-success' : '' }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->user->name ?? '' }}</td>
                                        <td>{{ $gc->user->name ?? '' }}</td>
                                        <td>{{ $gc->patient->name ?? '' }}</td>
                                        <td>{{ $item->created_at->format('Y-m-d') ?? '' }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item"
                                                        href="{{ route('igd/general/consent.showtatatertib', $gc->id) }}"
                                                        target="_blank">
                                                        <i class="bx bx-printer me-1"></i>
                                                        Tata Tertib
                                                    </a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('igd/general/consent.showhakdankewajiban', $gc->id) }}"
                                                        target="_blank">
                                                        <i class="bx bx-printer me-1"></i>
                                                        Hak dan Kewajiban
                                                    </a>
                                                    <a href="{{ route('igd/general/consent.show', $gc->id) }}"
                                                        class="dropdown-item">
                                                        <i class='bx bx-printer me-1'></i>
                                                        Print
                                                    </a>
                                                    <a href="{{ route('igd/general/consent.edit', $gc->id) }}"
                                                        class="dropdown-item">
                                                        <i class='bx bx-edit me-1'></i>
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('igd/general/consent.destroy', $gc->id) }}"
                                                        method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="dropdown-item"
                                                            onclick="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
                                                            <i class='bx bx-trash me-1'></i>
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div class="tab-pane fade {{ session('active') == 'assesmen_medis' ? 'show active' : '' }}"
                        id="navs-justified-assesmen-medis" role="tabpanel">
                        <div class="text-end">
                            <a href="{{ route('igd/assesmenawal.create', $item->id) }}"
                                class="btn btn-success btn-sm">+Tambah
                                Assesmen</a>
                        </div>
                        <table class="table">
                            <thead>
                                <tr class="text-nowrap">
                                    <th class="text-body">No</th>
                                    <th class="text-body">Pasien</th>
                                    <th class="text-body">Dokter</th>
                                    <th class="text-body">Keluhan</th>
                                    <th class="text-body">Tanggal</th>
                                    <th class="text-body">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($item->queue->patient->igdInitialAssesments->where('isActive', true)->sortByDesc('created_at') as $itemAssesment)
                                    <tr
                                        class="{{ $item->queue->id == $itemAssesment->igdPatient->queue_id ? 'text-success' : '' }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $itemAssesment->patient->name }}</td>
                                        <td>{{ $itemAssesment->user->name }}</td>
                                        <td>{{ strip_tags($itemAssesment->keluhan ?? '') }}</td>
                                        <td>{{ date('Y-m-d H:i', strtotime($itemAssesment->tanggal_assesment ?? '')) }}
                                        </td>
                                        <td class="d-flex">
                                            {{-- <a href="{{ route('igdass', $askep->igdPatient->id) }}" class="btn btn-warning btn-sm"><i class='bx bx-edit'></i></a> --}}
                                            <a href="{{ route('igd/assesmenawal.show', $itemAssesment->id) }}"
                                                class="btn btn-dark btn-sm mx-2"><i class='bx bx-printer'></i></a>
                                            <form action="{{ route('igd/assesmenawal.destroy', $itemAssesment->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Yakin Ingin Menghapus Data ?')"><i
                                                        class='bx bx-trash'></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade {{ session('active') == 'asesmenperawat' ? 'show active' : '' }}"
                        id="navs-justified-asesmenperawat" role="tabpanel">
                        <div class="text-end">
                            <a href="{{ route('igd/asesmen/status/fisik.index', $item->id) }}" type="button"
                                class="btn btn-{{ $item->igdAseKepPatient ? 'warning' : 'success' }} btn-sm">{{ $item->igdAseKepPatient ? 'Edit' : 'Tambah' }}
                                Asesmen Keperawatan</a>
                        </div>
                        <table class="table">
                            <thead>
                                <tr class="text-nowrap">
                                    <th class="text-body">No</th>
                                    <th class="text-body">Tanggal Kunjungan</th>
                                    <th class="text-body">Pasien</th>
                                    <th class="text-body">Dokter</th>
                                    <th class="text-body">Tanggal Asesmen</th>
                                    <th class="text-body">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($item->queue->patient->igdAseKepPatients->sortByDesc('created_at') as $askep)
                                    <tr
                                        class="{{ $item->queue->id == $askep->igdPatient->queue_id ? 'text-success' : '' }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->created_at->format('Y-m-d') }}</td>
                                        <td>{{ $askep->patient->name }}</td>
                                        <td>{{ $askep->user->name }}</td>
                                        <td>{{ $askep->created_at->format('Y-m-d') }}</td>
                                        <td class="d-flex">
                                            @php
                                                session()->put('current_id', $item->id);
                                            @endphp
                                            <a href="{{ route('igd/asesmen/status/fisik.index', $askep->igdPatient->id) }}"
                                                class="btn btn-warning btn-sm"><i class='bx bx-edit'></i></a>
                                            <a href="{{ route('igd/assesmen/awal/keperawatan.show', $askep->id) }}"
                                                class="btn btn-dark btn-sm mx-2" target="_blank"><i
                                                    class='bx bx-printer'></i></a>
                                            <form
                                                action="{{ route('igd/assesmen/awal/keperawatan.destroy', $askep->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Yakin Ingin Menghapus Data ?')"><i
                                                        class='bx bx-trash'></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade {{ session('active') == 'cppt' ? 'show active' : '' }}"
                        id="navs-justified-cppt" role="tabpanel">
                        <div class="text-end mb-3">
                            <button type="button" class="btn btn-success btn-sm"
                                onclick="createCppt({{ $item->queue->patient->id }})">+Tambah CPPT</button>
                        </div>
                        <table class="table" id="example">
                            <thead>
                                <tr class="text-nowrap">
                                    <th class="text-body">No</th>
                                    <th class="text-body">PPA (Profesional Pemberi Asuhan)</th>
                                    <th class="text-body">Tanggal / Jam</th>
                                    <th class="text-body">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($item->queue->patient->igdRmeCppts->sortByDesc('created_at') as $cppt)
                                    <tr class="{{ $item->queue->id == $cppt->igdPatient->queue_id ? 'text-success' : '' }}">
                                        <td>{{ $loop->iteration ?? '' }}</td>
                                        <td>{{ $cppt->user->name ?? '' }}</td>
                                        <td>{{ $cppt->tanggal ?? '' }}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('igd/cppt.show', $item->queue->patient->id) }}"
                                                target="blank" class="btn btn-dark btn-sm"><i
                                                    class='bx bx-low-vision'></i></a>
                                            <button type="button" class="btn btn-warning btn-sm"
                                                onclick="editCppt({{ $cppt->id }})"><i
                                                    class='bx bx-edit'></i></button>
                                            <form action="{{ route('igd/cppt.destroy', $cppt->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Yakin Ingin Menghapus Data ?')"><i
                                                        class='bx bx-trash'></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- <div class="tab-pane fade " id="navs-justified-sbpk" role="tabpanel">
                    <div class="text-end mb-3">
                    <a href="/tambah-sbpk" type="button" class="btn btn-success btn-sm">+Tambah Surat Bukti Pelayanan Pasien</a>
                    </div>
                    <table class="table" id="example">
                        <thead>
                        <tr class="text-nowrap">
                            <th class="text-body">No</th>
                            <th class="text-body">DPJP</th>
                            <th class="text-body">Tanggal / Jam</th>
                            <th class="text-body">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="d-flex">
                            <a href="" class="btn btn-dark btn-sm"><i class='bx bx-low-vision' ></i></a>
                            <a href="/surat-sbpk" target="blank" class="btn btn-dark btn-sm mx-3"><i class='bx bx-printer' ></i></a>
                            <form action="" method="POST">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Ingin Menghapus Data ?')"><i class='bx bx-trash' ></i></button>
                            </form>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div> --}}
                    <div class="tab-pane fade {{ session('active') == 'spri' ? 'show active' : '' }}"
                        id="navs-justified-spri" role="tabpanel">
                        <div class="text-end mb-3">
                            @isset($item->queue->suratPengantarRawatJalanPatient)
                                <a href="{{ route('igd/suratpengantar.edit', $item->queue->suratPengantarRawatJalanPatient->id) }}"
                                    type="button" class="btn btn-warning btn-sm">Edit Surat Pengantar Rawat Inap</a>
                            @else
                                <a href="{{ route('igd/suratpengantar.create', $item->id) }}" type="button"
                                    class="btn btn-success btn-sm">+Tambah Surat Pengantar Rawat Inap</a>
                                @endif
                            </div>
                            <table class="table" id="example">
                                <thead>
                                    <tr class="text-nowrap">
                                        <th class="text-body">Tanggal Kunjungan</th>
                                        <th class="text-body">Alat</th>
                                        <th class="text-body">Ruangan</th>
                                        <th class="text-body">Status</th>
                                        <th class="text-body">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($item->queue->patient->suratPengantarRawatJalanPatients->sortByDesc('created_at') as $spri)
                                        <tr>
                                            <td>{{ $item->created_at->format('Y-m-d') }}</td>
                                            <td>{{ $spri->alat ?? '' }}</td>
                                            <td>{{ $spri->ruangan ?? '' }}</td>
                                            @php
                                                if ($spri->status == 'terima') {
                                                    $stts = 'DITERIMA';
                                                } elseif ($spri->status == 'waiting') {
                                                    $stts = $spri->status;
                                                } else {
                                                    $stts = 'DITOLAK';
                                                }
                                            @endphp
                                            <td>{{ $stts ?? '' }}</td>
                                            <td class="d-flex">
                                                {{-- <a href="{{ route('') }}" target="blank" class="btn btn-dark btn-sm"><i class='bx bx-printer' ></i></a> --}}
                                                <a href="{{ route('igd/suratpengantar.edit', $spri->id) }}"
                                                    class="btn btn-warning btn-sm mx-2"><i class='bx bx-edit'></i></a>
                                                <form action="{{ route('igd/suratpengantar.destroy', $spri->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Yakin Ingin Menghapus Data ?')"><i
                                                            class='bx bx-trash'></i></button>
                                                </form>
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
        {{-- end Menu IGD --}}
        </div>

        {{-- <div class="nav-align-top mb-4 h-75">
            <ul class="nav nav-tabs nav-sm nav-fill" role="tablist">
                <li class="nav-item">
                    <button id="btn-link" type="button"
                        class="nav-link {{ session('active') == 'dashboard' ? 'active' : '' }} d-flex justify-content-center"
                        role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-home"
                        aria-controls="navs-justified-home" aria-selected="true">
                        <i class="tf-icons bx bx-grid-alt"></i>
                        <p class="m-0">Dashboard</p>
                    </button>
                </li>
                <li class="nav-item">
                    <button id="btn-link" type="button"
                        class="nav-link {{ session('active') == 'triase' ? 'active' : '' }} d-flex justify-content-center"
                        role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-triase"
                        aria-controls="navs-justified-triase" aria-selected="false">
                        <i class="tf-icons bx bx-message-alt-add"></i>
                        <p class="m-0">Triase</p>
                    </button>
                </li>
                <li class="nav-item">
                    <button id="btn-link" type="button"
                        class="nav-link {{ session('active') == 'general-consent' ? 'active' : '' }} d-flex justify-content-center"
                        role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-general-consent"
                        aria-controls="navs-justified-general-consent" aria-selected="false">
                        <i class="tf-icons bx bx-message-alt-add"></i>
                        <p class="m-0">General Consent</p>
                    </button>
                </li>
                <li class="nav-item">
                    <button id="btn-link" type="button"
                        class="nav-link {{ session('active') == 'assesmen_medis' ? 'active' : '' }} d-flex justify-content-center"
                        role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-assesmen-medis"
                        aria-controls="navs-justified-asesmen-medis" aria-selected="false">
                        <i class="tf-icons bx bx-bookmark-alt-plus"></i>
                        <p class="m-0">Asesmen Medis</p>
                    </button>
                </li>
                <li class="nav-item">
                    <button id="btn-link" type="button"
                        class="nav-link {{ session('active') == 'asesmenperawat' ? 'active' : '' }} d-flex justify-content-center"
                        role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-asesmenperawat"
                        aria-controls="navs-justified-asesmenperawat" aria-selected="false">
                        <i class="tf-icons bx bx-message-square-add"></i>
                        <p class="m-0">Asesmen Perawat</p>
                    </button>
                </li>
                <li class="nav-item">
                    <button id="btn-link" type="button"
                        class="nav-link {{ session('active') == 'cppt' ? 'active' : '' }} d-flex justify-content-center"
                        role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-cppt"
                        aria-controls="navs-justified-cppt" aria-selected="false">
                        <i class="tf-icons bx bx-message-alt-add"></i>
                        <p class="m-0">CPPT</p>
                    </button>
                </li>
                <li class="nav-item">
                    <button id="btn-link" type="button" class="nav-link d-flex justify-content-center" role="tab"
                        data-bs-toggle="tab" data-bs-target="#navs-justified-sbpk" aria-controls="navs-justified-sbpk"
                        aria-selected="false">
                        <i class="tf-icons bx bx-message-alt-add"></i>
                        <p class="m-0">SBPK</p>
                    </button>
                </li>
                <li class="nav-item">
                    <button id="btn-link" type="button"
                        class="nav-link {{ session('active') == 'spri' ? 'active' : '' }} d-flex justify-content-center"
                        role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-spri"
                        aria-controls="navs-justified-spri" aria-selected="false">
                        <i class="tf-icons bx bx-message-alt-add"></i>
                        <p class="m-0">SPRI</p>
                    </button>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade {{ session('active') == 'dashboard' ? 'show active' : '' }}"
                    id="navs-justified-home" role="tabpanel">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="d-flex">
                                <h6 class="m-0 mt-1">{{ $item->queue->patient->name ?? '' }}
                                    ({{ implode('-', str_split(str_pad($item->queue->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }})
                                </h6>
                            </div>
                            <hr class="p-0 mt-2">
                            <table class="w-100">
                                <tbody>
                                    <tr>
                                        <td style="min-width: 150px">Tanggungan</td>
                                        <td style="min-width: 30px">:</td>
                                        <td>{{ $item->queue->patientCategory->name ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td style="min-width: 150px">Jenis Kelamin</td>
                                        <td style="min-width: 30px">:</td>
                                        <td>{{ $item->queue->patient->jenis_kelamin ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Lahir</td>
                                        <td>:</td>
                                        <td>{{ $item->queue->patient->tanggal_lhr ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Usia</td>
                                        <td>:</td>
                                        <td>{{ $usia ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Telepon</td>
                                        <td>:</td>
                                        <td>{{ $item->queue->patient->telp ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>:</td>
                                        <td>{{ $item->queue->patient->alamat ?? '' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr class="p-0 mt-2">
                            <h6>Registrasi</h6>
                            <table class="w-100">
                                <tr>
                                    <td class="w-25">ID Kasus</td>
                                    <td>2276566567</td>
                                </tr>
                                <tr>
                                    <td>Nomor</td>
                                    <td>4546576675</td>
                                </tr>
                                <tr>
                                    <td>Poli</td>
                                    <td></td>
                                </tr>
                            </table>
                            <hr class="p-0 mt-2">
                            <h6>Dokter</h6>
                            <p>{{ $item->user->name ?? '' }} ({{ $item->user->staff_id ?? '' }})</p>
                        </div>
                        <div class="col-sm-6">

                        </div>
                    </div>
                </div>
                <div class="tab-pane fade {{ session('active') == 'triase' ? 'show active' : '' }}"
                    id="navs-justified-triase" role="tabpanel">
                    <div class="text-end mb-3">
                        <a href="{{ route('igd/triase/print.allPrint', $item->id) }}" class="btn btn-dark btn-sm"><i
                                class='bx bx-printer'></i> Print Semua</a>
                        <a href="{{ route('igd/triase.create', $item->id) }}" class="btn btn-success btn-sm">+Tambah
                            Triase</a>
                    </div>
                    <table class="table" id="example">
                        <thead>
                            <tr class="text-nowrap">
                                <th class="text-body">No</th>
                                <th class="text-body">Dokter</th>
                                <th class="text-body">Petugas Triase</th>
                                <th class="text-body">Pasien</th>
                                <th class="text-body">Tanggal</th>
                                <th class="text-body">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($item->queue->patient->igdTriages as $triase)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->user->name ?? '' }}</td>
                                    <td>{{ $triase->user->name ?? '' }}</td>
                                    <td>{{ $triase->patient->name ?? '' }}</td>
                                    <td>{{ $triase->created_at ?? '' }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a href="{{ route('igd/triase.edit', $triase->id) }}" class="dropdown-item">
                                                    <i class='bx bx-edit me-1'></i>
                                                    Edit
                                                </a>
                                                <a href="{{ route('igd/triase.show', $triase->id) }}" class="dropdown-item">
                                                    <i class='bx bx-show-alt me-1'></i>
                                                    Show
                                                </a>
                                                <form action="{{ route('igd/triase.destroy', $triase->id) }}"
                                                    method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="dropdown-item"
                                                        onclick="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
                                                        <i class='bx bx-trash me-1'></i>
                                                        Hapus
                                                    </button>
                                                </form>
                                                <a href="{{ route('igd/triase.print', ['id' => $triase->id, 'dokter_id' => $item->user->id]) }}"
                                                    class="dropdown-item">
                                                    <i class='bx bx-printer'></i>
                                                    Print
                                                </a>

                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
                <div class="tab-pane fade {{ session('active') == 'general-consent' ? 'show active' : '' }}"
                    id="navs-justified-general-consent" role="tabpanel">
                    <div class="text-end mb-3">
                        <a href="{{ route('igd/general/consent.create', $item->id) }}"
                            class="btn btn-success btn-sm">+Tambah
                            General Consent</a>
                    </div>
                    <table class="table" id="example">
                        <thead>
                            <tr class="text-nowrap">
                                <th class="text-body">No</th>
                                <th class="text-body">Dokter</th>
                                <th class="text-body">Petugas</th>
                                <th class="text-body">Pasien</th>
                                <th class="text-body">Tanggal Kunjungan</th>
                                <th class="text-body">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($item->queue->patient->igdGeneralConsents as $gc)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->user->name ?? '' }}</td>
                                    <td>{{ $gc->user->name ?? '' }}</td>
                                    <td>{{ $gc->patient->name ?? '' }}</td>
                                    <td>{{ $item->created_at->format('Y-m-d') ?? '' }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="{{ route('igd/general/consent.showtatatertib', $gc->id) }}"
                                                    target="_blank">
                                                    <i class="bx bx-printer me-1"></i>
                                                    Tata Tertib
                                                </a>
                                                <a class="dropdown-item"
                                                    href="{{ route('igd/general/consent.showhakdankewajiban', $gc->id) }}"
                                                    target="_blank">
                                                    <i class="bx bx-printer me-1"></i>
                                                    Hak dan Kewajiban
                                                </a>
                                                <a href="{{ route('igd/general/consent.show', $gc->id) }}"
                                                    class="dropdown-item">
                                                    <i class='bx bx-printer me-1'></i>
                                                    Print
                                                </a>
                                                <a href="{{ route('igd/general/consent.edit', $gc->id) }}"
                                                    class="dropdown-item">
                                                    <i class='bx bx-edit me-1'></i>
                                                    Edit
                                                </a>
                                                <form action="{{ route('igd/general/consent.destroy', $gc->id) }}"
                                                    method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="dropdown-item"
                                                        onclick="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
                                                        <i class='bx bx-trash me-1'></i>
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
                <div class="tab-pane fade {{ session('active') == 'assesmen_medis' ? 'show active' : '' }}"
                    id="navs-justified-assesmen-medis" role="tabpanel">
                    <div class="text-end">
                        <a href="{{ route('igd/assesmenawal.create', $item->id) }}" class="btn btn-success btn-sm">+Tambah
                            Assesmen</a>
                    </div>
                    <table class="table">
                        <thead>
                            <tr class="text-nowrap">
                                <th class="text-body">No</th>
                                <th class="text-body">Pasien</th>
                                <th class="text-body">Dokter</th>
                                <th class="text-body">Keluhan</th>
                                <th class="text-body">Tanggal</th>
                                <th class="text-body">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($item->queue->patient->igdInitialAssesments->where('isActive', true) as $itemAssesment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $itemAssesment->patient->name }}</td>
                                    <td>{{ $itemAssesment->user->name }}</td>
                                    <td>{{ $itemAssesment->keluhan ?? '' }}</td>
                                    <td>{{ date('Y-m-d H:i', strtotime($itemAssesment->tanggal_assesment ?? '')) }}</td>
                                    <td class="d-flex">
                                        <a href="{{ route('igdass', $askep->igdPatient->id) }}"
                                            class="btn btn-warning btn-sm"><i class='bx bx-edit'></i></a>
                                        <a href="{{ route('igd/assesmenawal.show', $itemAssesment->id) }}"
                                            class="btn btn-dark btn-sm mx-2"><i class='bx bx-printer'></i></a>
                                        <form action="{{ route('igd/assesmenawal.destroy', $itemAssesment->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin Ingin Menghapus Data ?')"><i
                                                    class='bx bx-trash'></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade {{ session('active') == 'asesmenperawat' ? 'show active' : '' }}"
                    id="navs-justified-asesmenperawat" role="tabpanel">
                    <div class="text-end">
                        <a href="{{ route('igd/asesmen/status/fisik.index', $item->id) }}" type="button"
                            class="btn btn-{{ $item->igdAseKepPatient ? 'warning' : 'success' }} btn-sm">{{ $item->igdAseKepPatient ? 'Edit' : 'Tambah' }}
                            Asesmen Keperawatan</a>
                    </div>
                    <table class="table">
                        <thead>
                            <tr class="text-nowrap">
                                <th class="text-body">No</th>
                                <th class="text-body">Tanggal Kunjungan</th>
                                <th class="text-body">Pasien</th>
                                <th class="text-body">Dokter</th>
                                <th class="text-body">Tanggal Asesmen</th>
                                <th class="text-body">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($item->queue->patient->igdAseKepPatients as $askep)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $askep->patient->name }}</td>
                                    <td>{{ $askep->user->name }}</td>
                                    <td>{{ $askep->created_at->format('Y-m-d') }}</td>
                                    <td class="d-flex">
                                        @php
                                            session()->put('current_id', $item->id);
                                        @endphp
                                        <a href="{{ route('igd/asesmen/status/fisik.index', $askep->igdPatient->id) }}"
                                            class="btn btn-warning btn-sm"><i class='bx bx-edit'></i></a>
                                        <a href="{{ route('igd/assesmen/awal/keperawatan.show', $askep->id) }}"
                                            class="btn btn-dark btn-sm mx-2" target="_blank"><i
                                                class='bx bx-printer'></i></a>
                                        <form action="{{ route('igd/assesmen/awal/keperawatan.destroy', $askep->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin Ingin Menghapus Data ?')"><i
                                                    class='bx bx-trash'></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade {{ session('active') == 'cppt' ? 'show active' : '' }}" id="navs-justified-cppt"
                    role="tabpanel">
                    <div class="text-end mb-3">
                        <button type="button" class="btn btn-success btn-sm"
                            onclick="createCppt({{ $item->queue->patient->id }})">+Tambah CPPT</button>
                    </div>
                    <table class="table" id="example">
                        <thead>
                            <tr class="text-nowrap">
                                <th class="text-body">No</th>
                                <th class="text-body">PPA (Profesional Pemberi Asuhan)</th>
                                <th class="text-body">Tanggal / Jam</th>
                                <th class="text-body">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($item->queue->patient->igdRmeCppts as $cppt)
                                <tr>
                                    <td>{{ $loop->iteration ?? '' }}</td>
                                    <td>{{ $cppt->user->name ?? '' }}</td>
                                    <td>{{ $cppt->tanggal ?? '' }}</td>
                                    <td class="d-flex">
                                        <a href="{{ route('igd/cppt.show', $item->queue->patient->id) }}" target="blank"
                                            class="btn btn-dark btn-sm"><i class='bx bx-low-vision'></i></a>
                                        <button type="button" class="btn btn-warning btn-sm"
                                            onclick="editCppt({{ $cppt->id }})"><i class='bx bx-edit'></i></button>
                                        <form action="{{ route('igd/cppt.destroy', $cppt->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin Ingin Menghapus Data ?')"><i
                                                    class='bx bx-trash'></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane fade " id="navs-justified-sbpk" role="tabpanel">
                    <div class="text-end mb-3">
                        <a href="/tambah-sbpk" type="button" class="btn btn-success btn-sm">+Tambah Surat Bukti Pelayanan
                            Pasien</a>
                    </div>
                    <table class="table" id="example">
                        <thead>
                            <tr class="text-nowrap">
                                <th class="text-body">No</th>
                                <th class="text-body">DPJP</th>
                                <th class="text-body">Tanggal / Jam</th>
                                <th class="text-body">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="d-flex">
                                    <a href="" class="btn btn-dark btn-sm"><i class='bx bx-low-vision'></i></a>
                                    <a href="/surat-sbpk" target="blank" class="btn btn-dark btn-sm mx-3"><i
                                            class='bx bx-printer'></i></a>
                                    <form action="" method="POST">
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin Ingin Menghapus Data ?')"><i
                                                class='bx bx-trash'></i></button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade {{ session('active') == 'spri' ? 'show active' : '' }}" id="navs-justified-spri"
                    role="tabpanel">
                    <div class="text-end mb-3">
                        @isset($item->queue->suratPengantarRawatJalanPatient)
                            <a href="{{ route('igd/suratpengantar.edit', $item->queue->suratPengantarRawatJalanPatient->id) }}"
                                type="button" class="btn btn-warning btn-sm">Edit Surat Pengantar Rawat Inap</a>
                        @else
                            <a href="{{ route('igd/suratpengantar.create', $item->id) }}" type="button"
                                class="btn btn-success btn-sm">+Tambah Surat Pengantar Rawat Inap</a>
                            @endif
                        </div>
                        <table class="table" id="example">
                            <thead>
                                <tr class="text-nowrap">
                                    <th class="text-body">Tanggal Kunjungan</th>
                                    <th class="text-body">Alat</th>
                                    <th class="text-body">Ruangan</th>
                                    <th class="text-body">Status</th>
                                    <th class="text-body">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($item->queue->patient->suratPengantarRawatJalanPatients as $spri)
                                    <tr>
                                        <td>{{ $item->created_at->format('Y-m-d') }}</td>
                                        <td>{{ $spri->alat ?? '' }}</td>
                                        <td>{{ $spri->ruangan ?? '' }}</td>
                                        @php
                                            if ($spri->status == 'terima') {
                                                $stts = 'DITERIMA';
                                            } elseif ($spri->status == 'waiting') {
                                                $stts = $spri->status;
                                            } else {
                                                $stts = 'DITOLAK';
                                            }
                                        @endphp
                                        <td>{{ $stts ?? '' }}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('') }}" target="blank" class="btn btn-dark btn-sm"><i
                                                    class='bx bx-printer'></i></a>
                                            <a href="{{ route('igd/suratpengantar.edit', $spri->id) }}"
                                                class="btn btn-warning btn-sm mx-2"><i class='bx bx-edit'></i></a>
                                            <form action="{{ route('igd/suratpengantar.destroy', $spri->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Yakin Ingin Menghapus Data ?')"><i
                                                        class='bx bx-trash'></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div> --}}

        {{-- modal --}}
        <div class="modal fade" id="modal_igd" tabindex="-1" aria-labelledby="modalScrollableTitle" aria-hidden="true">

        </div>

        <script>
            function createCppt(id) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'post',
                    url: "{{ URL::route('igd/cppt.create', $item->id) }}",
                    data: {
                        patient_id: id,
                    },
                    success: function(data) {
                        var div = document.createElement('div');
                        div.className = 'modal-dialog modal-lg modal-dialog-scrollable';
                        div.innerHTML = data;

                        $('#modal_igd').html(div);
                        $('#modal_igd').modal('show');
                    }
                });
            }

            function editCppt(id) {
                $.ajax({
                    type: 'get',
                    url: "{{ url('igd/cppt/edit') }}/" + id,
                    success: function(data) {
                        var div = document.createElement('div');
                        div.className = 'modal-dialog modal-lg modal-dialog-scrollable';
                        div.innerHTML = data;

                        $('#modal_igd').html(div);
                        $('#modal_igd').modal('show');
                    }
                });
            }
        </script>
    @endsection
