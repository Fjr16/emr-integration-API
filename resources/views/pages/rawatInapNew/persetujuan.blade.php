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
            <form action="" method="POST"
                onsubmit="return confirm('Sebelum melanjutkan, Pastikan data telah diisi dengan benar dan lengkap !!!. Apakah anda yakin untuk melanjutkan ? ')">
                @method('PUT')
                @csrf
                <input type="hidden" name="title" value="{{ $title }}">
                <button type="submit" class="btn btn-success btn-sm" name="status" value="SELESAI">Selesai</button>
            </form>
        @endcan
    </div>

    <div class="card">
        {{-- Informasi Pasien --}}
        <div class="card-body">
            <h4>Data Pasien</h4>
            <div class="row mt-4 px-5">
                <div class="col-12 col-lg-6">
                    <table>
                        <tbody>
                            <tr>
                                <td class="pb-3">Nama</td>
                                <td class="pb-3 px-2">:</td>
                                <td class="pb-3">{{ $item->queue->patient->name ?? '' }}</td>
                            </tr>
                            <tr>
                                <td class="pb-3">Tempat lahir</td>
                                <td class="pb-3 px-2">:</td>
                                <td class="pb-3">{{ $item->queue->patient->tempat_lhr ?? '' }}</td>
                            </tr>
                            <tr>
                                <td class="pb-3">Tanggal Lahir</td>
                                <td class="pb-3 px-2">:</td>
                                <td class="pb-3">{{ $item->queue->patient->tanggal_lhr ?? '' }}</td>
                            </tr>
                            <tr>
                                <td class="pb-3">Jenis Kelamin</td>
                                <td class="pb-3 px-2">:</td>
                                <td class="pb-3">{{ $item->queue->patient->jenis_kelamin ?? '' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-12 col-lg-6">
                    <table>
                        <tbody>
                            <tr>
                                <td class="pb-3">Status Kawin</td>
                                <td class="pb-3 px-2">:</td>
                                <td class="pb-3">{{ $item->queue->patient->status ?? '' }}</td>
                            </tr>
                            <tr>
                                <td class="pb-3">No. Hp</td>
                                <td class="pb-3 px-2">:</td>
                                <td class="pb-3">{{ $item->queue->patient->telp ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td>{{ $item->queue->patient->district->name ?? '' }},
                                    {{ $item->queue->patient->village->name ?? '' }},
                                    {{ $item->queue->patient->city->name ?? '' }},
                                    {{ $item->queue->patient->province->name ?? '' }},{{ $item->queue->patient->alamat ?? '' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- end Informasi Pasien --}}


        {{-- Persetujuan --}}
        <div class="card-body">
            <div class="nav-align-top mb-4 shadow-sm">
                <ul class="nav nav-tabs nav-sm nav-fill" role="tablist">
                    <li class="nav-item">
                        <button id="btn-link" type="button"
                            class="nav-link {{ session('btn') == 'persetujuanpelayanan' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-persetujuanpelayanan"
                            aria-controls="navs-justified-persetujuanpelayanan" aria-selected="true">
                            <i class="tf-icons bx bx-bookmark-alt-plus"></i>
                            <p class="m-0">Persetujuan Pelayanan Pasien</p>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button id="btn-link" type="button"
                            class="nav-link {{ session('btn') == 'persetujuantindakanbedah' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-persetujuantindakanbedah"
                            aria-controls="navs-justified-persetujuantindakanbedah" aria-selected="true">
                            <i class="tf-icons bx bx-bookmark-alt-plus"></i>
                            <p class="m-0">Persetujuan Tindakan Bedah</p>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button id="btn-link" type="button"
                            class="nav-link {{ session('btn') == 'persetujuananestesi' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-persetujuananestesi"
                            aria-controls="navs-justified-persetujuananestesi" aria-selected="true">
                            <i class="tf-icons bx bx-bookmark-alt-plus"></i>
                            <p class="m-0">Persetujuan Anestesi</p>
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade {{ session('btn') == 'persetujuanpelayanan' ? 'show active' : '' }}"
                        id="navs-justified-persetujuanpelayanan" role="tabpanel">
                        <div class="row">
                            <div class="col-sm-12">
                                <h5 class="align-self-center m-0">Surat Pernyataan Persetujuan Status Pelayanan Pasien
                                    {{ $item->queue->patient->name }}
                                </h5>
                                <a href="{{ route('surat/pernyataan/persetujuan/status/pelayanan.create', $item->id) }}"
                                    class="btn btn-dark btn-sm m-0 mx-3">+</a>
                                <div class="card mt-3">
                                    <table class="table">
                                        <thead>
                                            <tr class="text-nowrap bg-dark">
                                                <th>No</th>
                                                <th>Pasien</th>
                                                <th>Nama PJ</th>
                                                <th>Alamat PJ</th>
                                                <th>Kelas Rawatan</th>
                                                <th>Tanggal</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</th>
                                                    <td>{{ $item->patient->name }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->alamat }}</td>
                                                    <td>{{ $item->rawatInapPatient->queue->patientCategory->name }}</td>
                                                    <td>{{ Carbon\Carbon::parse($item->created_at)->isoformat('D MMM Y') }}
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button"
                                                                class="btn p-0 dropdown-toggle hide-arrow"
                                                                data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item"
                                                                    href="{{ route('surat/pernyataan/persetujuan/status/pelayanan.show', $item->id) }}"
                                                                    target="_blank">
                                                                    <i class="bx bx-printer me-1"></i>
                                                                    Print
                                                                </a>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('surat/pernyataan/persetujuan/status/pelayanan.edit', $item->id) }}">
                                                                    <i class="bx bx-edit-alt me-1"></i>
                                                                    Edit
                                                                </a>
                                                                <form
                                                                    action="{{ route('surat/pernyataan/persetujuan/status/pelayanan.destroy', $item->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="dropdown-item"
                                                                        onclick="return confirm('Yakin ingin menghapus data?')"><i
                                                                            class="bx bx-trash me-1"></i>Hapus</button>
                                                                </form>
                                                            </div>
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
                    <div class="tab-pane fade {{ session('btn') == 'persetujuantindakanbedah' ? 'show active' : '' }}"
                        id="navs-justified-persetujuantindakanbedah" role="tabpanel">
                        <div class="row">
                            <div class="col-sm-12">
                                <h5 class="align-self-center m-0">Persetujuan Tindakan Bedah Pasien
                                    {{-- {{ $item->queue->patient->name }}  --}}
                                    <span><a href="{{ route('persetujuan/tindakan/bedah.create', $item->id) }}"
                                            class="btn mx-2 btn-sm btn-primary">+</a></span>
                                </h5>
                                <div class="card mt-3">
                                    <table class="table">
                                        <thead>
                                            <tr class="text-nowrap bg-dark">
                                                <th>No</th>
                                                <th>Pasien</th>
                                                <th>Nama PJ</th>
                                                <th>Umur</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Alamat</th>
                                                <th>Hubungan</th>
                                                <th>Tanggal</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data2 as $ptb)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</th>
                                                    <td>{{ $ptb->rawatInapPatient->queue->patient->name }}</td>
                                                    <td>{{ $ptb->name }}</td>
                                                    <td>{{ $ptb->umur }}</td>
                                                    <td>{{ $ptb->jenis_kelamin }}</td>
                                                    <td>{{ $ptb->alamat }}</td>
                                                    <td>{{ $ptb->hubungan }}</td>
                                                    @php
                                                        $formatId = Carbon\Carbon::parse($ptb->tanggal);
                                                    @endphp
                                                    <td>{{ $formatId->isoformat('D MMM Y') }}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button"
                                                                class="btn p-0 dropdown-toggle hide-arrow"
                                                                data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item"
                                                                    href="{{ route('persetujuan/tindakan/bedah.show', $ptb->id) }}"
                                                                    target="_blank">
                                                                    <i class="bx bx-printer me-1"></i>
                                                                    Print
                                                                </a>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('persetujuan/tindakan/bedah.edit', $ptb->id) }}">
                                                                    <i class="bx bx-edit-alt me-1"></i>
                                                                    Edit
                                                                </a>
                                                                <form
                                                                    action="{{ route('persetujuan/tindakan/bedah.destroy', $ptb->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="dropdown-item"
                                                                        onclick="return confirm('Yakin ingin menghapus data?')"><i
                                                                            class="bx bx-trash me-1"></i>Hapus</button>
                                                                </form>
                                                            </div>
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
                    <div class="tab-pane fade {{ session('btn') == 'persetujuananestesi' ? 'show active' : '' }}"
                        id="navs-justified-persetujuananestesi" role="tabpanel">
                        <div class="row">
                            <div class="col-sm-12">
                                <h5 class="align-self-center m-0">Pemberian Informasi Persetujuan Tindakan Anestesi Pasien
                                    {{-- {{ $item->queue->patient->name }}  --}}
                                    <span><a href="{{ route('pemberian/informasi/persetujuan/tindakan/anestesi.create', $item->id) }}"
                                            class="btn mx-2 btn-sm btn-primary">+</a></span>
                                </h5>
                                <div class="card mt-3">
                                    <table class="table">
                                        <thead>
                                            <tr class="text-nowrap bg-dark">
                                                <th>No</th>
                                                <th>Pasien</th>
                                                <th>Nama PJ</th>
                                                <th>Umur</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Alamat</th>
                                                <th>Hubungan</th>
                                                <th>Jenis Anestesi</th>
                                                <th>Tanggal</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data3 as $d)
                                        <tr>
                                            <td>{{ $loop->iteration }}</th>
                                            <td>{{ $d->rawatInapPatient->queue->patient->name }}</td>
                                            <td>{{ $d->name }}</td>
                                            <td>{{ $d->umur }}</td>
                                            <td>{{ $d->jenis_kelamin }}</td>
                                            <td>{{ $d->alamat }}</td>
                                            <td>{{ $d->hubungan }}</td>
                                            <td>{{ $d->jenis_anestesi }}</td>
                                            @php
                                                $formatId = Carbon\Carbon::parse($d->tanggal);
                                            @endphp
                                            <td>{{ $formatId->isoformat('D MMM Y') }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item"
                                                            href="{{ route('pemberian/informasi/persetujuan/tindakan/anestesi.show', $d->id) }}"
                                                            target="_blank">
                                                            <i class="bx bx-printer me-1"></i>
                                                            Print
                                                        </a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('pemberian/informasi/persetujuan/tindakan/anestesi.edit', $d->id) }}">
                                                            <i class="bx bx-edit-alt me-1"></i>
                                                            Edit
                                                        </a>
                                                        <form
                                                            action="{{ route('pemberian/informasi/persetujuan/tindakan/anestesi.destroy', $d->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item"
                                                                onclick="return confirm('Yakin ingin menghapus data?')"><i
                                                                    class="bx bx-trash me-1"></i>Hapus</button>
                                                        </form>
                                                    </div>
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
        </div>
        {{-- end Persetujuan --}}
    </div>
@endsection
