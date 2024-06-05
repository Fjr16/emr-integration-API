@extends('layouts.backend.main')

@section('content')
    @if (session()->has('success'))
        <div class="mb-5 border alert alert-success w-100 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div id="success-message"></div>
    <div class="mb-4 card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Surat Pernyataan Persetujuan Status Pelayanan Pasien
                {{ $data->rawatInapPatient->queue->patient->name }}
            </h5>
        </div>
        <form action="{{ route('surat/pernyataan/persetujuan/status/pelayanan.update', $data->id) }}" method="POST"
            onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="mb-3 col">
                    <p>Saya yang bertanda tangan di bawah ini
                        :</p>
                    <div class="mb-3 ms-5 row">
                        <label for="nmDkr" class="col-form-label col-2">Nama
                        </label>
                        <input class="ml-1 form-control form-control-sm col" type="text" name="name"
                            value="{{ $data->name }}" />
                    </div>
                    <div class="mb-3 ms-5 row">
                        <label for="umurDkr" class="col-form-label col-2">Umur
                        </label>
                        <input class="ml-1 form-control form-control-sm col" type="number" name="umur"
                            value="{{ $data->umur }}" />
                    </div>
                    <div class="ms-5 row">
                        <label for="almDkr" class="col-form-label col-2">Alamat
                        </label>
                        <input class="ml-1 form-control form-control-sm col" type="text" name="alamat"
                            value="{{ $data->alamat }}" />
                    </div>
                </div>
                <div class="mb-3 col">
                    <div class="d-flex align-items-center">
                        <label for="adlhPasien" class="p-2 col-form-label align-items-center">Adalah</label>
                        <div class="p-2 w-25">
                            <select name="hubungan" class="form-select form-select-sm" id="">
                                <option value="{{ $data->hubungan }}" @checked(true)>{{ $data->hubungan }}
                                </option>
                                @foreach ($hubs as $hub)
                                    <option value="{{ $hub }}">{{ $hub }}</option>
                                @endforeach
                            </select>
                        </div>
                        <label for="pihak-rumahsakit" class="col-form-label align-items-center">dari Pasien:</label>
                    </div>

                    <div class="mb-3 ms-5 row">
                        <label for="psnNama" class="col-form-label col-2">Nama
                        </label>
                        <input class="ml-1 form-control form-control-sm col" type="text"
                            value="{{ $data->rawatInapPatient->queue->patient->name }}" disabled />
                    </div>
                    <div class="mb-3 ms-5 row">
                        <label for="psnUmur" class="col-form-label col-2">Umur</label>
                        <input class="ml-1 form-control form-control-sm col" type="number" value="{{ $umur }}"
                            disabled />
                    </div>
                    <div class="mb-3 ms-5 row">
                        <label for="psnAlm" class="col-form-label col-2">Alamat</label>
                        <input class="ml-1 form-control form-control-sm col" type="text"
                            value="{{ $data->rawatInapPatient->queue->patient->alamat }}" disabled />
                    </div>
                    <div class="ms-5 row">
                        <label for="psnAlm" class="col-form-label col-2">Kelas Rawatan</label>
                        <input class="ml-1 form-control form-control-sm col" type="text"
                            value="{{ $data->rawatInapPatient->queue->patientCategory->name }}" disabled />
                    </div>
                </div>
                <div class="mb-3 col">
                    <div class="row">
                        <div class="col-10">
                            <label for="pihak-rumahsakit" class="col-form-label">Menyatakan bahwa: (Ceklis salah
                                satu)</label>
                        </div>
                        <div class="col-2 text-center">
                            <label for="pihak-rumahsakit" class="col-form-label">Paraf</label>
                        </div>
                    </div>
                    <div class="mb-3 row align-items-center">
                        <div class="col-10">
                            <div class="d-flex">
                                <div class="me-3">
                                    <input class="form-check-input" type="radio" name="header" value="KHUSUS PASIEN UMUM"
                                        id="umum" onclick="enableElement(this)"
                                        {{ $data->header == 'KHUSUS PASIEN UMUM' ? 'checked' : '' }} />
                                </div>
                                <div class="col">
                                    <label class="fw-bold text-decoration-underline form-check-label" for="umum">
                                        KHUSUS PASIEN UMUM
                                    </label>
                                    <p>Pasien yang tersebut diatas tidak akan menggunakan jaminan kesehatan / asuransi
                                        apapun. Dan bersedia
                                        dilayani sebagai pasien umum yang akan dikenakan biaya sesuai dengan ketentuan RSK
                                        Bedah Ropanasuri.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            @if ($data->header == 'KHUSUS PASIEN UMUM')
                                <img src="{{ Storage::url($data->paraf) }}" alt="" id="ImgParafKeluargaPasien">
                                <textarea id="paraf" name="paraf[]" style="display: none;"></textarea>
                                <button type="button" class="col-12 btn btn-sm btn-dark" id="btnUmum"
                                    onclick="openModalTtdBottom(this, 'ImgParafKeluargaPasien', 'paraf')">Paraf</button>
                            @else
                                <img src="" alt="" id="ImgParafKeluargaPasien">
                                <textarea id="paraf" name="paraf[]" style="display: none;"></textarea>
                                <button type="button" class="col-12 btn btn-sm btn-dark" id="btnUmum" disabled
                                    onclick="openModalTtdBottom(this, 'ImgParafKeluargaPasien', 'paraf')">Paraf</button>
                            @endif
                        </div>
                    </div>

                    @if ($data->header == 'KHUSUS PASIEN BPJS')
                        <div class="mb-4 col align-items-center">
                            <div class="row">
                                <div class="col-10">
                                    <div class="d-flex">
                                        <div class="me-3">
                                            <input name="header" class="form-check-input" type="radio"
                                                value="KHUSUS PASIEN BPJS" id="bpjs" onclick="enableElement(this)"
                                                checked />
                                        </div>
                                        <div class="col">
                                            <div class="">

                                                <label class="fw-bold text-decoration-underline form-check-label"
                                                    for="bpjs">
                                                    KHUSUS PASIEN BPJS
                                                </label>
                                                <p>Akan menggunakan Jaminan Kesehatan Nasional / JKN (BPJS) dan akan
                                                    menyerahkan
                                                    kelengkapan
                                                    administrasi sampai batas waktu yang ditentukan / sebelum pasien pulang.
                                                    Jika
                                                    tidak
                                                    dapat melengkapi
                                                    administrasi sampai batas waktu yang ditentukan, saya bersedia membayar
                                                    biaya
                                                    pelayanan sesuai tarif
                                                    umum RSK Bedah Ropanasuri.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    @if ($data->header == 'KHUSUS PASIEN BPJS')
                                        <img src="{{ Storage::url($data->paraf) }}" alt=""
                                            id="ImgParafKeluargaPasien">
                                        <textarea id="paraf" name="paraf[]" style="display: none;"></textarea>
                                        <button type="button" class="col-12 btn btn-sm btn-dark" id="btnBpjs"
                                            onclick="openModalTtdBottom(this, 'ImgParafKeluargaPasien', 'paraf')">Paraf</button>
                                    @else
                                        <img src="" alt="" id="ImgParafKeluargaPasien">
                                        <textarea id="paraf" name="paraf[]" style="display: none;"></textarea>
                                        <button type="button" class="col-12 btn btn-sm btn-dark" id="btnBpjs" disabled
                                            onclick="openModalTtdBottom(this, 'ImgParafKeluargaPasien', 'paraf')">Paraf</button>
                                    @endif
                                </div>
                            </div>

                            <div class="ms-5">
                                <p>Kelengkapan Administrasi </p>
                                <div class="row">
                                    <div class="col-6 ms-4">
                                        @foreach ($kelAdm as $kel)
                                            <div class="mb-3 col-9">
                                                <div class="row align-items-center">
                                                    <label class="col-form-label col-1"
                                                        for="klngAdm1">{{ $loop->iteration }}. </label>
                                                    <input class="form-control form-control-sm col" type="text"
                                                        value="{{ $kel->name }}" name="kelAdm[]"
                                                        id="klngAdm{{ $loop->iteration }}" readonly />
                                                    @if ($loop->iteration == 2 && $kel->name == 'Kartu BPJS')
                                                        <div class="col-auto">
                                                            <button type="button" class="btn btn-sm btn-dark" disabled
                                                                id="tambah">
                                                                <i class="bi bi-plus"></i> lainnya
                                                            </button>
                                                        </div>
                                                    @elseif ($loop->iteration != 1)
                                                        <div class="col-auto">
                                                            <button type="button"
                                                                class="btn btn-sm btn-danger btn-remove" disabled
                                                                id="hapus{{ $loop->iteration }}">
                                                                <i class="bi bi-plus"></i> Hapus
                                                            </button>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="col">
                                        <div class="mb-2 form-check col">
                                            <input class="form-check-input" type="radio" value="1"
                                                name="statusAdm" id="klngAdmYa" disabled
                                                {{ $data->statusAdm == 1 ? 'checked' : '' }} />
                                            <label class="form-check-label" for="klngAdmYa">
                                                Lengkap
                                            </label>
                                        </div>
                                        <div class="mb-2 form-check col">
                                            <input name="statusAdm" class="form-check-input" type="radio"
                                                value="0" id="klngAdmTidak" disabled
                                                {{ $data->statusAdm == 0 ? 'checked' : '' }} />
                                            <label class="form-check-label" for="klngAdmTidak">
                                                Belum Lengkap
                                            </label>
                                        </div>
                                        <div class="col">
                                            <p>(Batas melengkapi: X 24 jam/Sebelum pulang)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="mb-4 col align-items-center">
                            <div class="row">
                                <div class="col-10">
                                    <div class="d-flex">
                                        <div class="me-3">
                                            <input name="header" class="form-check-input" type="radio"
                                                value="KHUSUS PASIEN BPJS" id="bpjs"
                                                onclick="enableElement(this)" />
                                        </div>
                                        <div class="col">
                                            <div class="">

                                                <label class="fw-bold text-decoration-underline form-check-label"
                                                    for="bpjs">
                                                    KHUSUS PASIEN BPJS
                                                </label>
                                                <p>Akan menggunakan Jaminan Kesehatan Nasional / JKN (BPJS) dan akan
                                                    menyerahkan
                                                    kelengkapan
                                                    administrasi sampai batas waktu yang ditentukan / sebelum pasien pulang.
                                                    Jika
                                                    tidak
                                                    dapat melengkapi
                                                    administrasi sampai batas waktu yang ditentukan, saya bersedia membayar
                                                    biaya
                                                    pelayanan sesuai tarif
                                                    umum RSK Bedah Ropanasuri.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    @if ($data->header == 'KHUSUS PASIEN BPJS')
                                        <img src="{{ Storage::url($data->paraf) }}" alt=""
                                            id="ImgParafKeluargaPasien">
                                        <textarea id="paraf" name="paraf[]" style="display: none;"></textarea>
                                        <button type="button" class="col-12 btn btn-sm btn-dark" id="btnBpjs" disabled
                                            onclick="openModalTtdBottom(this, 'ImgParafKeluargaPasien', 'paraf')">Paraf</button>
                                    @else
                                        <img src="" alt="" id="ImgParafKeluargaPasien">
                                        <textarea id="paraf" name="paraf[]" style="display: none;"></textarea>
                                        <button type="button" class="col-12 btn btn-sm btn-dark" id="btnBpjs" disabled
                                            onclick="openModalTtdBottom(this, 'ImgParafKeluargaPasien', 'paraf')">Paraf</button>
                                    @endif
                                </div>
                            </div>

                            <div class="ms-5">
                                <p>Kelengkapan Administrasi </p>
                                <div class="row">
                                    <div class="col-6 ms-4">
                                        <div class="mb-3 col-9">
                                            <div class="row align-items-center">
                                                <label class="col-form-label col-1" for="klngAdm1">1.</label>
                                                <input class="form-control form-control-sm col" type="text"
                                                    value="" name="kelAdm[]" id="klngAdm1" disabled />
                                            </div>
                                        </div>
                                        <div class="mb-3 col-9">
                                            <div class="row align-items-center">
                                                <label class="col-form-label col-1" for="klngAdm2">2.</label>
                                                <input class="form-control form-control-sm col" type="text"
                                                    value="" name="kelAdm[]" id="klngAdm2" disabled />
                                            </div>
                                        </div>
                                        <div class="col-9">
                                            <div class="row align-items-center">
                                                <label class="col-form-label col-1" for="klngAdm3">3.</label>
                                                <input class="form-control form-control-sm col" type="text"
                                                    value="" name="kelAdm[]" id="klngAdm3" disabled />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-2 form-check col">
                                            <input class="form-check-input" type="radio" value="1"
                                                name="statusAdm" id="klngAdmYa" disabled />
                                            <label class="form-check-label" for="klngAdmYa">
                                                Lengkap
                                            </label>
                                        </div>
                                        <div class="mb-2 form-check col">
                                            <input name="statusAdm" class="form-check-input" type="radio"
                                                value="0" id="klngAdmTidak" disabled />
                                            <label class="form-check-label" for="klngAdmTidak">
                                                Belum Lengkap
                                            </label>
                                        </div>
                                        <div class="col">
                                            <p>(Batas melengkapi: X 24 jam/Sebelum pulang)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="mb-3 col">
                        <div class="mb-3 row align-items-center">
                            <div class="col-10">
                                <div class="d-flex">
                                    <div class="me-3">
                                        <input name="header" class="form-check-input" type="radio"
                                            value="KHUSUS PASIEN JAMINAN KESEHATAN LAIN / ASURANSI LAIN / PERUSAHAAN"
                                            id="asuransi" onclick="enableElement(this)"
                                            {{ $data->header == 'KHUSUS PASIEN JAMINAN KESEHATAN LAIN / ASURANSI LAIN / PERUSAHAAN' ? 'checked' : '' }} />
                                    </div>
                                    <div class="col">
                                        <label class="fw-bold text-decoration-underline form-check-label" for="asuransi">
                                            KHUSUS PASIEN JAMINAN KESEHATAN LAIN / ASURANSI LAIN / PERUSAHAAN
                                        </label>
                                        <div>
                                            <p class="m-0 mb-3 d-flex">
                                                <span>
                                                    Akan menggunakan jaminan Kesehatan Lain / Asuransi lain /
                                                    Perusahaan yaitu :
                                                </span>
                                                <input style="max-width: 150px;" type="text"
                                                    class="mx-3 form-control form-control-sm" name="jaminan"
                                                    id="jaminan" disabled>
                                                <span>dan bersedia mengikuti</span>
                                            </p>
                                            <p class="m-0">
                                                aturan yang berlaku sesuai dengan
                                                kontrak kerjasama dengan pihak RSK Bedah Ropanasuri
                                            </p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                @if ($data->header == 'KHUSUS PASIEN JAMINAN KESEHATAN LAIN / ASURANSI LAIN / PERUSAHAAN')
                                    <img src="{{ Storage::url($data->paraf) }}" alt=""
                                        id="ImgParafKeluargaPasien">
                                    <textarea id="paraf" name="paraf[]" style="display: none;"></textarea>
                                    <button type="button" class="col-12 btn btn-sm btn-dark" id="btnJaminan"
                                        onclick="openModalTtdBottom(this, 'ImgParafKeluargaPasien', 'paraf')">Paraf</button>
                                @else
                                    <img src="" alt="" id="ImgParafKeluargaPasien">
                                    <textarea id="paraf" name="paraf[]" style="display: none;"></textarea>
                                    <button type="button" class="col-12 btn btn-sm btn-dark" id="btnJaminan" disabled
                                        onclick="openModalTtdBottom(this, 'ImgParafKeluargaPasien', 'paraf')">Paraf</button>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 col">
                        <div class="mb-3 row align-items-center">
                            <div class="col-10">
                                <div class="d-flex">
                                    <div class="me-3">
                                        <input name="header" class="form-check-input" type="radio"
                                            value="KHUSUS PASIEN NAIK KELAS RAWATAN" id="rawatan"
                                            onclick="enableElement(this)"
                                            {{ $data->header == 'KHUSUS PASIEN NAIK KELAS RAWATAN' ? 'checked' : '' }} />
                                    </div>
                                    <div class="col">
                                        <label class="fw-bold text-decoration-underline form-check-label" for="rawatan">
                                            KHUSUS PASIEN NAIK KELAS RAWATAN
                                        </label>
                                        <p class="m-0 d-flex">Saya meminta pihak rumah sakit untuk dipindahkan kelas
                                            rawatan
                                            dari ( kelas : <input type="text" class="mx-1 form-control form-control-sm"
                                                name="dariKelas" id="dariKelas" disabled style="max-width: 100px"> )

                                            <span>ke ( kelas :</span>
                                            <input type="text" class="mx-1 form-control form-control-sm "
                                                name="keKelas" id="keKelas" disabled style="max-width: 150px;"> )
                                        </p>

                                        <span>
                                            Dan
                                            bersedia
                                            menanggung segala biaya yang diakibatkan oleh perpindahan kelas tersebut
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                @if ($data->header == 'KHUSUS PASIEN NAIK KELAS RAWATAN')
                                    <img src="{{ Storage::url($data->paraf) }}" alt=""
                                        id="ImgParafKeluargaPasien">
                                    <textarea id="paraf" name="paraf[]" style="display: none;"></textarea>
                                    <button type="button" class="col-12 btn btn-sm btn-dark" id="btnKelas"
                                        onclick="openModalTtdBottom(this, 'ImgParafKeluargaPasien', 'paraf')">Paraf</button>
                                @else
                                    <img src="" alt="" id="ImgParafKeluargaPasien">
                                    <textarea id="paraf" name="paraf[]" style="display: none;"></textarea>
                                    <button type="button" class="col-12 btn btn-sm btn-dark" id="btnKelas" disabled
                                        onclick="openModalTtdBottom(this, 'ImgParafKeluargaPasien', 'paraf')">Paraf</button>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 col align-items-center">
                        <div class="row align-items-center">
                            <div class="col-10">
                                <div class="d-flex">
                                    <div class="me-3">
                                        <input name="header" class="form-check-input" type="radio"
                                            value="KHUSUS PASIEN KECELAKAAN LALU LINTAS (JASA RAHARJA)" id="jasa_raharja"
                                            onclick="enableElement(this)"
                                            {{ $data->header == 'KHUSUS PASIEN KECELAKAAN LALU LINTAS (JASA RAHARJA)' ? 'checked' : '' }} />
                                    </div>
                                    <div class="col">
                                        <label class="fw-bold text-decoration-underline form-check-label"
                                            for="jasa_raharja">
                                            KHUSUS PASIEN KECELAKAAN LALU LINTAS (JASA RAHARJA)
                                        </label>
                                        <p>Setelah mendapat informasi yang cukup mengenai peraturan
                                            pelayanan pasien
                                            kecelakaan lalu lintas, maka saya menyatakan bahwa :</p>
                                        <p class="px-3">Akan mengurus Jasa Raharja dan bersedia melengkapi semua
                                            kelengkapaan
                                            klaim (BAP / Berita Acara Pemeriksaan Kepolisian) selama dalam perawatan
                                            dan bersedia memberikan kuasa terhadap rumah sakit untuk mengklaim ke
                                            pigak Jasa Raharja. <br>
                                            jika saya tidak melengkapi, maka bersedia dilayani sebgai pasien umum.
                                        </p>

                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                @if ($data->header == 'KHUSUS PASIEN KECELAKAAN LALU LINTAS (JASA RAHARJA)')
                                    <img src="{{ Storage::url($data->paraf) }}" alt=""
                                        id="ImgParafKeluargaPasien">
                                    <textarea id="paraf" name="paraf[]" style="display: none;"></textarea>
                                    <button type="button" class="col-12 btn btn-sm btn-dark" id="btnAnsuransi"
                                        onclick="openModalTtdBottom(this, 'ImgParafKeluargaPasien', 'paraf')">Paraf</button>
                                @else
                                    <img src="" alt="" id="ImgParafKeluargaPasien">
                                    <textarea id="paraf" name="paraf[]" style="display: none;"></textarea>
                                    <button type="button" class="col-12 btn btn-sm btn-dark" id="btnAnsuransi" disabled
                                        onclick="openModalTtdBottom(this, 'ImgParafKeluargaPasien', 'paraf')">Paraf</button>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-2">
                            <p class="fw-bold text-decoration-underline">
                                CATATAN KHUSUS
                            </p>
                        </div>
                        <div class="col-10">
                            <textarea class="form-control" id="editor" rows="4" name="ctt_khusus">{!! $data->ctt_khusus !!}</textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-10">

                        </div>
                    </div>
                    <div class="mb-3 col">
                        <div class="px-4">
                            Demikianlah pernyataan ini saya buat dengan penuh kesadaran dan telah mendapatkan informasi yang
                            selengkap-lengkapnya.
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-4 text-center">
                            <img src="{{ Storage::url($data->ttd) }}" alt="" id="ImgTtdKeluargaPasien">
                            <textarea id="ttd" name="ttd" style="display: none;"></textarea>
                            <button type="button" class="col-12 btn btn-sm btn-dark"
                                onclick="openModalTtdBottom(this, 'ImgTtdKeluargaPasien', 'ttd')">Tanda
                                Tangan Keluarga Pasien</button>
                        </div>
                    </div>

                    <div class="mb-3 text-end">
                        <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- modal create ttd --}}
    <div class="modal fade" id="signaturePadModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalScrollableTitle">Signature Pad</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div id="signature-pad" class="m-signature-pad">
                        <div class="m-signature-pad--body">
                            <canvas style="border: 3px dashed #ccc"></canvas>
                        </div>

                        <div class="m-signature-pad--footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-action="clear">Clear</button>
                            <button type="button" class="btn btn-sm btn-primary" data-action="save">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let tempElementImage;
        let tempTextArea;

        function openModal(element, iteration) {
            tempElementImage = $(element).closest('#row-ttd-pasien').find('#parafImage' + iteration);
            tempTextArea = $(element).closest('#row-ttd-pasien').find('#paraf' + iteration);
            $('#signaturePadModal').modal('show');
        }

        function openModalTtdBottom(element, elementImg, elementTextArea) {
            console.log(element.closest('td'));
            tempElementImage = $(element).closest('.row').find('#' + elementImg);
            tempTextArea = $(element).closest('.row').find('#' + elementTextArea);
            $('#signaturePadModal').modal('show');
        }

        document.addEventListener("DOMContentLoaded", function() {
            var wrapper = document.getElementById("signaturePadModal");
            var clearButton = wrapper.querySelector("[data-action=clear]");
            var saveButton = wrapper.querySelector("[data-action=save]");
            var canvas = wrapper.querySelector("canvas");
            var signaturePad;

            // Fungsi untuk mengatur ukuran canvas
            // function resizeCanvas() {
            //     var ratio = window.devicePixelRatio || 1;
            //     canvas.width = canvas.offsetWidth * ratio;
            //     canvas.height = canvas.offsetHeight * ratio;
            //     canvas.getContext("2d").scale(ratio, ratio);

            //     // Reinitialize SignaturePad setelah meresize canvas
            //     signaturePad = new SignaturePad(canvas);
            // }

            // resizeCanvas();

            // Initialize SignaturePad
            // agar library signature pad dapat digunakan pada modal
            signaturePad = new SignaturePad(canvas);

            // Event handler untuk tombol clear
            clearButton.addEventListener("click", function(e) {
                e.preventDefault();
                signaturePad.clear();
            });

            // Event handler untuk tombol save
            // var ttd = document.getElementById('ttd1');
            saveButton.addEventListener("click", function(e) {
                e.preventDefault();
                var signatureData = signaturePad.toDataURL();
                tempElementImage.attr('src', signatureData);
                tempTextArea.val(signatureData);
                // document.getElementById("signature64").value = signatureData;
                signaturePad.clear();

                //close modal
                $('#signaturePadModal').modal('hide');
            });


            // Event listener untuk meresize canvas saat window diubah ukurannya
            // window.addEventListener("resize", resizeCanvas);
        });
    </script>

    <script>
        function enableElement(element) {

            var allParaf = document.querySelectorAll('.paraf');
            allParaf.forEach(function(item) {
                item.disabled = true;
            });


            var paraf = $(element).closest('.row').find('.paraf');
            paraf.prop('disabled', false);


            var adm1 = document.getElementById('klngAdm1');
            var adm2 = document.getElementById('klngAdm2');
            var adm3 = document.getElementById('klngAdm3');
            var admYa = document.getElementById('klngAdmYa');
            var admNo = document.getElementById('klngAdmTidak');
            var jaminan = document.getElementById('jaminan');
            var dari = document.getElementById('dariKelas');
            var ke = document.getElementById('keKelas');
            var btnUmum = document.getElementById('btnUmum');
            var btnBpjs = document.getElementById('btnBpjs');
            var btnJaminan = document.getElementById('btnJaminan');
            var btnKelas = document.getElementById('btnKelas');
            var btnAnsuransi = document.getElementById('btnAnsuransi');
            var imgParaf = document.getElementById('ImgParafKeluargaPasien');
            var btnTambah = document.getElementById('tambah');

            // mengambil semua id  yang di foreach
            var kelAdmInputs = document.querySelectorAll('[id^="klngAdm"]');
            var btnHapus = document.querySelectorAll('[id^="hapus"]');
            if (element.value == 'KHUSUS PASIEN UMUM') {

                kelAdmInputs.forEach(function(input, index) {
                    input.readOnly = true;
                    input.value = '';
                });

                btnHapus.forEach(function(hapus, index) {
                    hapus.disabled = true;


                });
                btnTambah.disabled = true;
                admYa.checked = false;
                admNo.checked = false;
                admYa.disabled = false;
                admNo.disabled = false;
                jaminan.disabled = true;
                dari.disabled = true;
                ke.disabled = true;
                jaminan.value = '';
                dari.value = '';
                ke.value = '';

                btnUmum.disabled = false;
                btnBpjs.disabled = true;
                btnJaminan.disabled = true;
                btnKelas.disabled = true;
                btnAnsuransi.disabled = true;
            } else if (element.value == 'KHUSUS PASIEN BPJS') {

                kelAdmInputs.forEach(function(input, index) {
                    if (input.id === "klngAdm1" || input.id === "klngAdm2") {
                        if (input.id === "klngAdm1") {
                            input.value = 'KTP / KK';
                        }
                        if (input.id === "klngAdm2") {
                            input.value = 'Kartu BPJS';
                        }

                        input.readOnly = true;

                    } else {
                        input.readOnly = false;

                    }
                });

                btnHapus.forEach(function(hapus, index) {
                    hapus.disabled = false;


                });
                btnTambah.disabled = false;
                admYa.checked = false;
                admNo.checked = false;
                jaminan.disabled = true;
                dari.disabled = true;
                ke.disabled = true;
                jaminan.value = '';
                dari.value = '';
                ke.value = '';

                btnUmum.disabled = true;
                btnBpjs.disabled = false;
                btnJaminan.disabled = true;
                btnKelas.disabled = true;
                btnAnsuransi.disabled = true;
            } else if (element.value == 'KHUSUS PASIEN JAMINAN KESEHATAN LAIN / ASURANSI LAIN / PERUSAHAAN') {
                kelAdmInputs.forEach(function(input, index) {
                    input.readOnly = true;
                    input.value = '';
                });

                btnHapus.forEach(function(hapus, index) {
                    hapus.disabled = true;
                });

                btnTambah.disabled = true;
                admYa.checked = false;
                admNo.checked = false;
                jaminan.disabled = false;
                admYa.disabled = true;
                admNo.disabled = true;

                dari.disabled = true;
                ke.disabled = true;
                dari.value = '';
                ke.value = '';

                btnUmum.disabled = true;
                btnBpjs.disabled = true;
                btnJaminan.disabled = false;
                btnKelas.disabled = true;
                btnAnsuransi.disabled = true;
            } else if (element.value == 'KHUSUS PASIEN NAIK KELAS RAWATAN') {
                dari.disabled = false;
                ke.disabled = false;


                kelAdmInputs.forEach(function(input, index) {
                    input.readOnly = true;
                    input.value = '';
                });

                btnTambah.disabled = true;
                admYa.checked = false;
                admNo.checked = false;

                jaminan.disabled = true;
                jaminan.value = '';

                btnUmum.disabled = true;
                btnBpjs.disabled = true;
                btnJaminan.disabled = true;
                btnKelas.disabled = false;
                btnAnsuransi.disabled = true;
            } else {
                kelAdmInputs.forEach(function(input, index) {
                    input.readOnly = true;
                    input.value = '';
                });

                btnTambah.disabled = true;

                admYa.checked = false;
                admNo.checked = false;

                jaminan.disabled = true;
                dari.disabled = true;
                ke.disabled = true;
                jaminan.value = '';
                dari.value = '';
                ke.value = '';

                btnUmum.disabled = true;
                btnBpjs.disabled = true;
                btnJaminan.disabled = true;
                btnKelas.disabled = true;
                btnAnsuransi.disabled = false;
            }
        }
    </script>


    <script>
        // tambah kelengkapan administrasi
        function tambah() {
            var kelAdmInputs = document.querySelectorAll('[id^="klngAdm"]');
            var lastKelAdmInput = kelAdmInputs[kelAdmInputs.length - 1];

            var inputGroup = document.createElement("div");
            inputGroup.className = "input-group mb-2";

            var input = document.createElement("input");
            input.type = "text";
            input.name = "kelAdm[]";
            input.className = "form-control form-control-sm col";

            var inputGroupAddon = document.createElement("div");
            inputGroupAddon.className = "input-group-addon";

            var button = document.createElement("button");
            button.type = "button";
            button.className = "btn btn-danger btn-remove";
            button.innerText = "Hapus";

            // Attach a click event to the remove button to remove the input group.
            button.addEventListener("click", function() {
                inputGroup.remove();
            });

            inputGroupAddon.appendChild(button);
            inputGroup.appendChild(input);
            inputGroup.appendChild(inputGroupAddon);

            lastKelAdmInput.parentNode.parentNode.appendChild(inputGroup);
        }


        // Attach the click event handler to the "Tambah" button.
        document.getElementById("tambah").addEventListener("click", tambah);
    </script>
    <script>
        // hapus kelengkapan administrasi
        function hapus() {
            var kelAdmInputs = document.querySelectorAll('.btn-remove');
            var lastKelAdmInput = kelAdmInputs[kelAdmInputs.length - 1];

            // Menghapus elemen terakhir
            lastKelAdmInput.parentNode.parentNode.parentNode.remove();
        }

        // Attach the click event handler to the "Hapus" buttons.
        var removeButtons = document.querySelectorAll('.btn-remove');
        removeButtons.forEach(function(button) {
            button.addEventListener("click", hapus);
        });
    </script>

@endsection
