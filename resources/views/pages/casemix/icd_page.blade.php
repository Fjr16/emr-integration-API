@extends('layouts.backend.main')

@section('content')
    {{-- @include('sweetalert::alert') --}}
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
    
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h4>Data Pasien</h4>
            </div>
            <div class="row mt-3">
                <div class="col-2">
                    <img class="img-fluid" src="{{ asset('assets/img/illustrations/profilerme.png') }}" alt="">
                </div>
                <div class="col-10 col-md-6 row align-items-center">
                    <table>
                        <tbody>
                            <form action="{{ route('casemix/register.claim', $item->id) }}" method="POST">
                                @csrf
                                @method('POST')
                            <tr>
                                <td>Nomor Kartu Bpjs</td>
                                <td>:</td>
                                <td>
                                    <input type="text" class="form-control form-control-sm" name="nomor_kartu" value="{{ $item->patient->noka ?? '' }}">
                                </td>
                            </tr>
                            <tr>
                                <td>Nomor SEP</td>
                                <td>:</td>
                                <td>
                                    <input type="text" class="form-control form-control-sm" name="nomor_sep" value="{{ $itemSep->no_sep ?? '' }}">
                                </td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td>
                                    <input type="text" class="form-control form-control-sm" name="nama_pasien" value="{{ $item->patient->name ?? '' }}">
                                </td>
                            </tr>
                            <tr>
                                <td>Nomor Rekam Medis</td>
                                <td>:</td>
                                <td>
                                    <input type="text" class="form-control form-control-sm" name="nomor_rm" value="{{ implode('-', str_split(str_pad($item->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}">
                                </td>
                            </tr>
                            <tr>
                                <td>Tanggal Lahir</td>
                                <td>:</td>
                                <td>
                                    <input type="date" class="form-control form-control-sm" name="tgl_lahir" value="{{ $item->patient->tanggal_lhr }}">
                                </td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>:</td>
                                <td>
                                    <select name="gender" class="form-select">
                                        <option value="1" {{ $item->patient->jenis_kelamin == 'Pria' ? 'selected' : '' }}>Laki - Laki</option>
                                        <option value="2" {{ $item->patient->jenis_kelamin == 'Wanita' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Tanggal Antrian</td>
                                <td>:</td>
                                <td>{{ $item->tgl_antrian ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>Kategori</td>
                                <td>:</td>
                                <td>{{ $item->category ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>
                                    <button type="submit" class="btn btn-dark btn-sm">Register Claim</button>
                                </td>
                            </tr>
                        </form>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="col col-12 mt-5">
        <div class="row">
            <div class="col col-3">
                <label for="jaminan">Jaminan / Cara Bayar</label>
                <select name="jaminan" class="form-select" id="jaminan">
                    <option value="" disabled selected hidden>Pilih Menu...</option>
                    <option value="1">JKN</option>
                    <option value="2">JAMINAN COVID-19</option>
                    <option value="3">JAMINAN KIPI</option>
                    <option value="3">JAMINAN BAYI BARU LAHIR</option>
                    <option value="4">JAMINAN PERPANJANGAN MASA RAWAT</option>
                </select>
            </div>
            <div class="col col-3">
                <label for="noPeserta">No. Peserta</label>
                <input type="text" class="form-control">
            </div>
            <div class="col col-3">
                <label for="noSEP">No. SEP</label>
                <input type="text" class="form-control">
            </div>
            <div class="col col-3">
                <label for="cob">COB</label>
                <select name="cob" class="form-select" id="cob">
                    <option value="" disabled selected hidden>Pilih Menu...</option>
                    <option value="1">MANDIRI INHEALTH</option>
                    <option value="2">ASURANSI SINAR MAS</option>
                    <option value="3">ASURANSI TUGU MANDIRI</option>
                    <option value="3">ASURANSI MITRA MAPARYA</option>
                    <option value="4">ASURANSI AXA MANDIRI FINANSIAL SERVICE</option>
                </select>
            </div>
        </div>
    </div>

    <div class="col col-12 mt-3">
        <table class="table table-bordered">
            <tr>
                <td class="table-active">Jenis Rawat</td>
                <td>
                    <div class="d-flex flex-row">
                        <div class="">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                    id="jalan">
                                <label class="form-check-label" for="jalan">
                                    Jalan
                                </label>
                            </div>
                        </div>
                        <div class="ms-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                    id="inap">
                                <label class="form-check-label" for="inap">
                                    Inap
                                </label>
                            </div>
                        </div>
                        <div class="ms-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Kelas Eksekutif
                                </label>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="text-end">Kelas Hak</td>
                <td style="min-width: 10rem"></td>
            </tr>
            <tr>
                <td class="table-active">Tanggal Rawat</td>
                <td>
                    <div class="d-flex flex-row">
                        <div class="">
                            Masuk: 15 Mei 2024 16:47
                        </div>
                        <div class="ms-5">
                            Pulang: 15 Mei 2024 16:47
                        </div>
                    </div>
                </td>
                <td class="text-end">Umur</td>
                <td>0 hari</td>
            </tr>
            <tr>
                <td class="table-active">Cara Masuk</td>
                <td colspan="3">
                    <div class="" style="max-width: 40%">
                        <select name="" class="form-select" id="">
                            <option value="" disabled selected hidden>Pilih Menu...</option>
                            <option value="1">Rujukan FKTP</option>
                            <option value="2">Rujukan FKRTL</option>
                            <option value="3">Rujukan Dokter Spesialis</option>
                            <option value="3">Dari Rawat Jalan</option>
                            <option value="4">Dari Rawat Inap</option>
                        </select>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="table-active">LOS</td>
                <td>
                    <div class="d-flex flex-row justify-content-between">
                        <span>1 hari</span>
                        <span>(00:00 jam)</span>
                    </div>
                </td>
                <td class="text-end">Berat Lahir(gram)</td>
                <td>
                    <div class="" style="max-width: 40%">
                        <input type="number" class="form-control">
                    </div>
                </td>
            </tr>
            <tr>
                <td class="table-active">ADL Score</td>
                <td>
                    <div class="d-flex flex-row justify-content-between px-5">
                        <span>Sub Acute: -</span>
                        <span>Chronic: -</span>
                    </div>
                </td>
                <td class="text-end">Cara Pulang</td>
                <td>
                    <div class="">
                        <select name="" class="form-select" id="">
                            <option value="" disabled selected hidden>Pilih Menu...</option>
                            <option value="1">Atas Persetujuan Dokter</option>
                            <option value="2">Dirujuk</option>
                            <option value="3">Atas Permintaan Sendiri</option>
                            <option value="3">Meninggal</option>
                            <option value="4">Lain-lain</option>
                        </select>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="table-active">Pasien TB</td>
                <td colspan="3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="TB">
                        <label class="form-check-label" for="TB">
                            Ya
                        </label>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div class="col col-12 mt-5">
        <p class="text-center">Tarif Rumah Sakit : Rp 0</p>
        <table class="table table-bordered">
            <tr>
                <td>
                    <div class="row">
                        <div class="col col-5 pt-2">
                            Prosedur Non Bedah
                        </div>
                        <div class="col col-6">
                            <input type="number" class="form-control" placeholder="0" name="nonBedah">
                        </div>
                    </div>
                </td>
                <td>
                    <div class="row">
                        <div class="col col-5 pt-2">
                            Prosedur Bedah
                        </div>
                        <div class="col col-6">
                            <input type="number" class="form-control" placeholder="0" name="bedah">
                        </div>
                    </div>
                </td>
                <td>
                    <div class="row">
                        <div class="col col-5 pt-2">
                            Konsultasi
                        </div>
                        <div class="col col-6">
                            <input type="number" class="form-control" placeholder="0" name="konsultasi">
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="row">
                        <div class="col col-5">
                            <p class="mt-2">Tenaga Ahli</p>
                        </div>
                        <div class="col col-6">
                            <input type="number" class="form-control" placeholder="0" name="tenagaAhli">
                        </div>
                    </div>
                </td>
                <td>
                    <div class="row">
                        <div class="col col-5 pt-2">
                            Keperawatan
                        </div>
                        <div class="col col-6">
                            <input type="number" class="form-control" placeholder="0" name="keperawatan">
                        </div>
                    </div>
                </td>
                <td>
                    <div class="row">
                        <div class="col col-5 pt-2">
                            Penunjang
                        </div>
                        <div class="col col-6">
                            <input type="number" class="form-control" placeholder="0" class="penunjang">
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="row">
                        <div class="col col-5 pt-2">
                            Radiologi
                        </div>
                        <div class="col col-6">
                            <input type="number" class="form-control" placeholder="0" name="radiologi">
                        </div>
                    </div>
                </td>
                <td>
                    <div class="row">
                        <div class="col col-5 pt-2">
                            Laboratorium
                        </div>
                        <div class="col col-6">
                            <input type="number" class="form-control" placeholder="0" name="laboratorium">
                        </div>
                    </div>
                </td>
                <td>
                    <div class="row">
                        <div class="col col-5 pt-2">
                            Pelayanan Darah
                        </div>
                        <div class="col col-6">
                            <input type="number" class="form-control" placeholder="0"
                                name="pelayananDarah">
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="row">
                        <div class="col col-5 pt-2">
                            Rehabilitasi
                        </div>
                        <div class="col col-6">
                            <input type="number" class="form-control" placeholder="0" name="rehabilitasi">
                        </div>
                    </div>
                </td>
                <td>
                    <div class="row">
                        <div class="col col-5 pt-2">
                            Kamar / Akomodasi
                        </div>
                        <div class="col col-6">
                            <input type="number" class="form-control" placeholder="0" name="kamar">
                        </div>
                    </div>
                </td>
                <td>
                    <div class="row">
                        <div class="col col-5 pt-2">
                            Rawat Intensif
                        </div>
                        <div class="col col-6">
                            <input type="number" class="form-control" placeholder="0" name="intensif">
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="row">
                        <div class="col col-5 pt-2">
                            Obat
                        </div>
                        <div class="col col-6">
                            <input type="number" class="form-control" placeholder="0" name="obat">
                        </div>
                    </div>
                </td>
                <td>
                    <div class="row">
                        <div class="col col-5 pt-2">
                            Obat Kronis
                        </div>
                        <div class="col col-6">
                            <input type="number" class="form-control" placeholder="0" name="obatKronis">
                        </div>
                    </div>
                </td>
                <td>
                    <div class="row">
                        <div class="col col-5 pt-2">
                            Obat Kemoterapi
                        </div>
                        <div class="col col-6">
                            <input type="number" class="form-control" placeholder="0"
                                name="obatKemoterapi">
                        </div>
                    </div>
                    </< /tr>
            </tr>
            <tr>
                <td>
                    <div class="row">
                        <div class="col col-5 pt-2">
                            Alkes
                        </div>
                        <div class="col col-6">
                            <input type="number" class="form-control" placeholder="0" name="alkes">
                        </div>
                    </div>
                </td>
                <td>
                    <div class="row">
                        <div class="col col-5 pt-2">
                            BMHP
                        </div>
                        <div class="col col-6">
                            <input type="number" class="form-control" placeholder="0" name="bmhp">
                        </div>
                    </div>
                </td>
                <td>
                    <div class="row">
                        <div class="col col-5 pt-2">
                            Sewa Alat
                        </div>
                        <div class="col col-6">
                            <input type="number" class="form-control" placeholder="0" name="sewaAlat">
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div> --}}

    <div class="col col-12 mt-5">
        <div class="card rounded-5 shadow">
            <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 ">
                            <fieldset class="form-section">
                                <legend>
                                    <h6>DIAGNOSA</h6>
                                </legend>
                                <div class="form-repeater" data-component="repeater">
                                    <ol class="form-repeater__rows" data-ref="rows" tabindex="0">
                                        <li class="form-repeater__row">
                                            <div class="row p-1">
                                                <div class="col-10">
                                                    <select class="form-select select2" name="diagnosa[0]">
                                                        <option selected disabled>Pilih</option>
                                                        @foreach ($icd10s as $icd10)
                                                            <option value={{ $icd10->id }}>{{ $icd10->code }} - {{ $icd10->deskripsi }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-2 pt-1">
                                                    <button
                                                        class="button form-repeater__remove-button btn btn-danger btn-sm"
                                                        data-ref="removeButton" type="button">
                                                        Remove
                                                    </button>
                                                </div>
                                            </div>
                                        </li>
                                    </ol>
                                    <button class="button form-repeater__add-button btn btn-dark btn-sm"
                                        data-ref="addButton" type="button">
                                        + tambah
                                    </button>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-6 ">
                            <fieldset class="form-section">
                                <legend>
                                    <h6>TINDAKAN</h6>
                                </legend>
                                <div class="form-repeater" data-component="repeater">
                                    <ol class="form-repeater__rows" data-ref="rows" tabindex="0">
                                        <li class="form-repeater__row">
                                            <div class="row p-1">
                                                <div class="col-10">
                                                    <select class="form-select form-field__input select2" name="tindakan[0]"
                                                        data-kt-repeater="select2" data-placeholder="Select an option">
                                                        <option selected disabled>Pilih</option>
                                                        @foreach ($icd9s as $icd9)
                                                            <option value={{ $icd9->id }}>{{ $icd9->code }}
                                                                -{{ $icd9->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-2 pt-2">
                                                    <button
                                                        class="button form-repeater__remove-button btn btn-danger btn-sm"
                                                        data-ref="removeButton" type="button">
                                                        Remove
                                                    </button>
                                                </div>
                                            </div>
                                        </li>
                                    </ol>
                                    <button class="button form-repeater__add-button btn btn-dark btn-sm"
                                        data-ref="addButton" type="button">
                                        + tambah
                                    </button>
                                </div>
                            </fieldset>
                        </div>
                    </div>
            </div>
        </div>
    </div>

@isset($itemKasirPatient)    
    <div class="card p-3 mt-3">
        <h5>Tarif Rumah Sakit</h5>
        <div class="accordion" id="accordionExample">
            <form class="flz_form" action="{{ route('casemix/update.claim', $item->id) }}" method="POST">
                @csrf
                @method('POST')

                <div class="accordion-item">
                    <h2 class="accordion-header" id="non_bedah">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#non-bedah" aria-expanded="false" aria-controls="non-bedah">
                            Prosedur Non Bedah
                        </button>
                    </h2>
                    <div id="non-bedah" class="accordion-collapse collapse" aria-labelledby="headingThree"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <fieldset>
                                <legend>Pilih Tarif : </legend>
                                @foreach ($itemKasirPatient->detailKasirPatients as $detail)
                                    <div class="form-check">
                                        <input class="form-check-input flz_checkbox" type="checkbox"
                                            value="{{ $detail->tarif }}" id="flexCheckDefault checkbox"
                                            name="non_bedah[]">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $detail->name }} : {{ $detail->tarif }}
                                        </label>
                                    </div>
                                @endforeach
                            </fieldset>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingBedah">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseBedah" aria-expanded="false" aria-controls="collapseBedah">
                            Prosedur Bedah
                        </button>
                    </h2>
                    <div id="collapseBedah" class="accordion-collapse collapse" aria-labelledby="headingBedah"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <fieldset>
                                <legend>Pilih Tarif : </legend>
                                @foreach ($itemKasirPatient->detailKasirPatients as $detail)
                                    <div class="form-check">
                                        <input class="form-check-input flz_checkbox" type="checkbox"
                                            value="{{ $detail->tarif }}" id="flexCheckDefault checkbox"
                                            name="non_bedah[]">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $detail->name }} : {{ $detail->tarif }}
                                        </label>
                                    </div>
                                @endforeach
                            </fieldset>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingKonsultasi">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseKonsultasi" aria-expanded="false"
                            aria-controls="collapseKonsultasi">
                            Konsultasi
                        </button>
                    </h2>
                    <div id="collapseKonsultasi" class="accordion-collapse collapse"
                        aria-labelledby="headingKonsultasi" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <fieldset>
                                <legend>Pilih Tarif : </legend>
                                @foreach ($itemKasirPatient->detailKasirPatients as $detail)
                                    <div class="form-check">
                                        <input class="form-check-input flz_checkbox" type="checkbox"
                                            value="{{ $detail->tarif }}" id="flexCheckDefault checkbox"
                                            name="non_bedah[]">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $detail->name }} : {{ $detail->tarif }}
                                        </label>
                                    </div>
                                @endforeach
                            </fieldset>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTenagaAhli">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTenagaAhli" aria-expanded="false"
                            aria-controls="collapseTenagaAhli">
                            Tenaga Ahli
                        </button>
                    </h2>
                    <div id="collapseTenagaAhli" class="accordion-collapse collapse"
                        aria-labelledby="headingTenagaAhli" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <fieldset>
                                <legend>Pilih Tarif : </legend>
                                @foreach ($itemKasirPatient->detailKasirPatients as $detail)
                                    <div class="form-check">
                                        <input class="form-check-input flz_checkbox" type="checkbox"
                                            value="{{ $detail->tarif }}" id="flexCheckDefault checkbox"
                                            name="non_bedah[]">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $detail->name }} : {{ $detail->tarif }}
                                        </label>
                                    </div>
                                @endforeach
                            </fieldset>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingKeperawatan">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseKeperawatan" aria-expanded="false"
                            aria-controls="collapseKeperawatan">
                            Keperawatan
                        </button>
                    </h2>
                    <div id="collapseKeperawatan" class="accordion-collapse collapse"
                        aria-labelledby="headingKeperawatan" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <fieldset>
                                <legend>Pilih Tarif : </legend>
                                @foreach ($itemKasirPatient->detailKasirPatients as $detail)
                                    <div class="form-check">
                                        <input class="form-check-input flz_checkbox" type="checkbox"
                                            value="{{ $detail->tarif }}" id="flexCheckDefault checkbox"
                                            name="non_bedah[]">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $detail->name }} : {{ $detail->tarif }}
                                        </label>
                                    </div>
                                @endforeach
                            </fieldset>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingPenunjang">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapsePenunjang" aria-expanded="false"
                            aria-controls="collapsePenunjang">
                            Penunjang
                        </button>
                    </h2>
                    <div id="collapsePenunjang" class="accordion-collapse collapse"
                        aria-labelledby="headingPenunjang" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <fieldset>
                                <legend>Pilih Tarif : </legend>
                                @foreach ($itemKasirPatient->detailKasirPatients as $detail)
                                    <div class="form-check">
                                        <input class="form-check-input flz_checkbox" type="checkbox"
                                            value="{{ $detail->tarif }}" id="flexCheckDefault checkbox"
                                            name="non_bedah[]">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $detail->name }} : {{ $detail->tarif }}
                                        </label>
                                    </div>
                                @endforeach
                            </fieldset>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingRadiologi">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseRadiologi" aria-expanded="false"
                            aria-controls="collapseRadiologi">
                            Radiologi
                        </button>
                    </h2>
                    <div id="collapseRadiologi" class="accordion-collapse collapse"
                        aria-labelledby="headingRadiologi" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <fieldset>
                                <legend>Pilih Tarif : </legend>
                                @foreach ($itemKasirPatient->detailKasirPatients as $detail)
                                    <div class="form-check">
                                        <input class="form-check-input flz_checkbox" type="checkbox"
                                            value="{{ $detail->tarif }}" id="flexCheckDefault checkbox"
                                            name="non_bedah[]">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $detail->name }} : {{ $detail->tarif }}
                                        </label>
                                    </div>
                                @endforeach
                            </fieldset>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingLaboratorium">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseLaboratorium" aria-expanded="false"
                            aria-controls="collapseLaboratorium">
                            Laboratorium
                        </button>
                    </h2>
                    <div id="collapseLaboratorium" class="accordion-collapse collapse"
                        aria-labelledby="headingLaboratorium" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <fieldset>
                                <legend>Pilih Tarif : </legend>
                                @foreach ($itemKasirPatient->detailKasirPatients as $detail)
                                    <div class="form-check">
                                        <input class="form-check-input flz_checkbox" type="checkbox"
                                            value="{{ $detail->tarif }}" id="flexCheckDefault checkbox"
                                            name="non_bedah[]">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $detail->name }} : {{ $detail->tarif }}
                                        </label>
                                    </div>
                                @endforeach
                            </fieldset>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingPelayananDarah">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapsePelayananDarah" aria-expanded="false"
                            aria-controls="collapsePelayananDarah">
                            Pelayanan Darah
                        </button>
                    </h2>
                    <div id="collapsePelayananDarah" class="accordion-collapse collapse"
                        aria-labelledby="headingPelayananDarah" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <fieldset>
                                <legend>Pilih Tarif : </legend>
                                @foreach ($itemKasirPatient->detailKasirPatients as $detail)
                                    <div class="form-check">
                                        <input class="form-check-input flz_checkbox" type="checkbox"
                                            value="{{ $detail->tarif }}" id="flexCheckDefault checkbox"
                                            name="non_bedah[]">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $detail->name }} : {{ $detail->tarif }}
                                        </label>
                                    </div>
                                @endforeach
                            </fieldset>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingRehabilitas">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseRehabilitas" aria-expanded="false"
                            aria-controls="collapseRehabilitas">
                            Rehabilitas
                        </button>
                    </h2>
                    <div id="collapseRehabilitas" class="accordion-collapse collapse"
                        aria-labelledby="headingRehabilitas" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <fieldset>
                                <legend>Pilih Tarif : </legend>
                                @foreach ($itemKasirPatient->detailKasirPatients as $detail)
                                    <div class="form-check">
                                        <input class="form-check-input flz_checkbox" type="checkbox"
                                            value="{{ $detail->tarif }}" id="flexCheckDefault checkbox"
                                            name="non_bedah[]">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $detail->name }} : {{ $detail->tarif }}
                                        </label>
                                    </div>
                                @endforeach
                            </fieldset>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingKamar">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseKamar" aria-expanded="false" aria-controls="collapseKamar">
                            Kamar
                        </button>
                    </h2>
                    <div id="collapseKamar" class="accordion-collapse collapse" aria-labelledby="headingKamar"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <fieldset>
                                <legend>Pilih Tarif : </legend>
                                @foreach ($itemKasirPatient->detailKasirPatients as $detail)
                                    <div class="form-check">
                                        <input class="form-check-input flz_checkbox" type="checkbox"
                                            value="{{ $detail->tarif }}" id="flexCheckDefault checkbox"
                                            name="non_bedah[]">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $detail->name }} : {{ $detail->tarif }}
                                        </label>
                                    </div>
                                @endforeach
                            </fieldset>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingSewaAlat">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseSewaAlat" aria-expanded="false"
                            aria-controls="collapseSewaAlat">
                            Sewa Alat
                        </button>
                    </h2>
                    <div id="collapseSewaAlat" class="accordion-collapse collapse" aria-labelledby="headingSewaAlat"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <fieldset>
                                <legend>Pilih Tarif : </legend>
                                @foreach ($itemKasirPatient->detailKasirPatients as $detail)
                                    <div class="form-check">
                                        <input class="form-check-input flz_checkbox" type="checkbox"
                                            value="{{ $detail->tarif }}" id="flexCheckDefault checkbox"
                                            name="non_bedah[]">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $detail->name }} : {{ $detail->tarif }}
                                        </label>
                                    </div>
                                @endforeach
                            </fieldset>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingRawatIntensif">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseRawatIntensif" aria-expanded="false"
                            aria-controls="collapseRawatIntensif">
                            Rawat Intensif
                        </button>
                    </h2>
                    <div id="collapseRawatIntensif" class="accordion-collapse collapse"
                        aria-labelledby="headingRawatIntensif" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <fieldset>
                                <legend>Pilih Tarif : </legend>
                                @foreach ($itemKasirPatient->detailKasirPatients as $detail)
                                    <div class="form-check">
                                        <input class="form-check-input flz_checkbox" type="checkbox"
                                            value="{{ $detail->tarif }}" id="flexCheckDefault checkbox"
                                            name="non_bedah[]">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $detail->name }} : {{ $detail->tarif }}
                                        </label>
                                    </div>
                                @endforeach
                            </fieldset>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingObat">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseObat" aria-expanded="false" aria-controls="collapseObat">
                            Obat
                        </button>
                    </h2>
                    <div id="collapseObat" class="accordion-collapse collapse" aria-labelledby="headingObat"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <fieldset>
                                <legend>Pilih Tarif : </legend>
                                @foreach ($itemKasirPatient->detailKasirPatients as $detail)
                                    <div class="form-check">
                                        <input class="form-check-input flz_checkbox" type="checkbox"
                                            value="{{ $detail->tarif }}" id="flexCheckDefault checkbox"
                                            name="non_bedah[]">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $detail->name }} : {{ $detail->tarif }}
                                        </label>
                                    </div>
                                @endforeach
                            </fieldset>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingObatKronis">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseObatKronis" aria-expanded="false"
                            aria-controls="collapseObatKronis">
                            Obat Kronis
                        </button>
                    </h2>
                    <div id="collapseObatKronis" class="accordion-collapse collapse"
                        aria-labelledby="headingObatKronis" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <fieldset>
                                <legend>Pilih Tarif : </legend>
                                @foreach ($itemKasirPatient->detailKasirPatients as $detail)
                                    <div class="form-check">
                                        <input class="form-check-input flz_checkbox" type="checkbox"
                                            value="{{ $detail->tarif }}" id="flexCheckDefault checkbox"
                                            name="non_bedah[]">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $detail->name }} : {{ $detail->tarif }}
                                        </label>
                                    </div>
                                @endforeach
                            </fieldset>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingObatKemoterapi">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseObatKemoterapi" aria-expanded="false"
                            aria-controls="collapseObatKemoterapi">
                            Obat Kemoterapi
                        </button>
                    </h2>
                    <div id="collapseObatKemoterapi" class="accordion-collapse collapse"
                        aria-labelledby="headingObatKemoterapi" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <fieldset>
                                <legend>Pilih Tarif : </legend>
                                @foreach ($itemKasirPatient->detailKasirPatients as $detail)
                                    <div class="form-check">
                                        <input class="form-check-input flz_checkbox" type="checkbox"
                                            value="{{ $detail->tarif }}" id="flexCheckDefault checkbox"
                                            name="non_bedah[]">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $detail->name }} : {{ $detail->tarif }}
                                        </label>
                                    </div>
                                @endforeach
                            </fieldset>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingAlkes">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseAlkes" aria-expanded="false" aria-controls="collapseAlkes">
                            Alkes
                        </button>
                    </h2>
                    <div id="collapseAlkes" class="accordion-collapse collapse" aria-labelledby="headingAlkes"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <fieldset>
                                <legend>Pilih Tarif : </legend>
                                @foreach ($itemKasirPatient->detailKasirPatients as $detail)
                                    <div class="form-check">
                                        <input class="form-check-input flz_checkbox" type="checkbox"
                                            value="{{ $detail->tarif }}" id="flexCheckDefault checkbox"
                                            name="non_bedah[]">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $detail->name }} : {{ $detail->tarif }}
                                        </label>
                                    </div>
                                @endforeach
                            </fieldset>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingBMHP">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseBMHP" aria-expanded="false" aria-controls="collapseBMHP">
                            BMHP
                        </button>
                    </h2>
                    <div id="collapseBMHP" class="accordion-collapse collapse" aria-labelledby="headingBMHP"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <fieldset>
                                <legend>Pilih Tarif : </legend>
                                @foreach ($itemKasirPatient->detailKasirPatients as $detail)
                                    <div class="form-check">
                                        <input class="form-check-input flz_checkbox" type="checkbox"
                                            value="{{ $detail->tarif }}" id="flexCheckDefault checkbox"
                                            name="non_bedah[]">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $detail->name }} : {{ $detail->tarif }}
                                        </label>
                                    </div>
                                @endforeach
                            </fieldset>
                        </div>
                    </div>
                </div>
                <input type="submit" class="flz_button btn btn-success" value="Save" />
            </form>

        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endisset

@endsection

@section('script')
    <script src="{{ asset('assets/js/advanced.js') }}"></script>
    <script>
        "use strict";

        // Class definition
        var KTFormRepeaterAdvanced = function() {
            // Private functions
            var example1 = function() {
                $('.form-repeater').repeater({
                    initEmpty: false,

                    show: function() {
                        $(this).slideDown();

                        // Re-init select2
                        $(this).find('[data-kt-repeater="select2"]').select2();
                    },

                    hide: function(deleteElement) {
                        $(this).slideUp(deleteElement);
                    },

                    ready: function() {
                        // Init select
                        $('[data-kt-repeater="select2"]').select2();
                    }
                });
            }

            return {
                // Public Functions
                init: function() {
                    example1();
                }
            };
        }();

        // On document ready
        $(document).ready(function() {
            KTFormRepeaterAdvanced.init();
            console.log("ffbdcfbd")
        });
        // Load ua-parser and floatz in correct order
        $LAB.script("http://design.humml.eu/toolbox/floatz/latest/scripts/ua-parser-0.7.9.min.js").wait()
            .script("http://design.humml.eu/toolbox/floatz/latest/scripts/floatz.js").wait(function() {
                // Start floatz modules
                floatz.start({
                    debug: true,
                    logLevel: floatz.LOGLEVEL.DEBUG
                });
            });
    </script>
@endsection
