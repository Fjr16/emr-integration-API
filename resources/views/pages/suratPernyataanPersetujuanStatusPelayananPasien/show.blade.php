<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SURAT PERSETUJUAN STATUS PELAYANAN PASIEN</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css" />
    <style>
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #fafafa;
        }

        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .page {
            width: 210mm;
            /* height: 330mm; */
            font-size: 10pt;
            min-height: 13.97cm;
            padding: 13mm;
            padding-top: 35px;
            margin: 10mm auto;
            border: 1px #d3d3d3 solid;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .subpage {
            padding: 1cm;
            border: 5px red solid;
            height: 257mm;
            outline: 2cm #ffeaea solid;
        }

        tr th {
            font-size: 10pt;
        }

        tr td {
            font-size: 10pt;
        }

        /* td {
                padding-top: 5px;
            } */
        th {
            font-size: 10pt !important;
        }

        ol li {
            margin: none;
            margin-top: 0px;
        }

        .borderhr {
            color: black;
            background-color: black;
            border-color: black;
            height: 5px;
            opacity: 100;
        }

        .header h1 {
            margin: 0;
            font-size: 20px;
            font-weight: bold;
        }

        @page {
            size: A4;
            margin: 0;
        }

        @media print {

            html,
            body {
                width: 215mm;
                height: 330mm;
            }

            .page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
        }
    </style>
</head>

<body>
    <div class="page">
        <div class="header">
            <div class="row">
                <div class="col-2">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="" />
                </div>
                <div class="col-7 text-center">
                    <h1>SURAT PERNYATAAN PERSETUJUAN <br>
                        STATUS PELAYANAN PASIEN
                    </h1>
                </div>
                <!-- <div class="col-3">
                        <div class="border border-3 border-rounded py-4 px-5"></div>
                    </div> -->
            </div>
        </div>

        <div class="content mt-4">
            <div class=" ">
                <div class="mb-3 col">
                    <p>Saya yang bertanda tangan di bawah ini :</p>
                </div>

                <div class="ms-5 row mt-2 ">
                    <p class="m-0 col" style="max-width: 80px; ">Nama </p>
                    <p class="m-0 col">:
                        {{ $data->name ?? '....................................................................................' }}
                    </p>
                </div>
                <div class="ms-5 row mt-2 ">
                    <p class="m-0 col" style="max-width: 80px; ">Umur </p>
                    <p class="m-0 col">:
                        {{ $data->umur ?? '....................................................................................' }}
                    </p>
                </div>
                <div class="ms-5 row mt-2 ">
                    <p class="m-0 col" style="max-width: 80px; ">Alamat </p>
                    <p class="m-0 col">:
                        {{ $data->alamat ?? '....................................................................................' }}
                    </p>
                </div>
            </div>
            <div class="mb-3 col">
                <div class="d-flex align-items-center">
                    <p class="m-0 p-2 col-form-label align-items-center">Adalah
                        {{ $data->hubungan ?? '...................................' }}</p>
                    <p class="m-0 ms-3  col-form-label align-items-center">dari
                        Pasien :</p>
                </div>


                <div class="ms-5 row mt-2 ">
                    <p class="m-0 col" style="max-width: 100px; ">Nama </p>
                    <p class="m-0 col">:
                        {{ $data->patient->name ?? '......................................................................................... </p>' }}
                </div>
                <div class="ms-5 row mt-2 ">
                    <p class="m-0 col" style="max-width: 100px; ">Umur </p>
                    <p class="m-0 col">:
                        {{ $umur ?? '......................................................................................... </p>' }}
                </div>
                <div class="ms-5 row mt-2 ">
                    <p class="m-0 col" style="max-width: 100px; ">Alamat </p>
                    <p class="m-0 col">:
                        {{ $data->patient->alamat ?? '......................................................................................... </p>' }}
                </div>
            </div>
            <div class="mb-3 col">
                <label for="pihak-rumahsakit" class="col-form-label">Menyatakan bahwa: (Ceklis salah satu)</label>
                <div class="mb-3 row align-items-center">
                    <div class="col-10">
                        <div class="d-flex">
                            <div class="me-3">

                                <input name="alergi-obat" class="form-check-input" type="checkbox" disabled
                                    value="" id="khsPsnUmum"
                                    {{ $data->header == 'KHUSUS PASIEN UMUM' ? 'checked' : '' }} />
                            </div>
                            <div class="col">
                                <label class="fw-bold text-decoration-underline form-check-label" for="khsPsnUmum">
                                    KHUSUS PASIEN UMUM
                                </label>
                                <p>Pasien yang tersebut diatas tidak akan menggunakan jaminan kesehatan / asuransi
                                    apapun. Dan bersedia
                                    dilayani sebagai pasien umum yang akan dikenakan biaya sesuai dengan ketentuan
                                    RSK
                                    Bedah Ropanasuri.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        @if ($data->header == 'KHUSUS PASIEN UMUM')
                            <img src="{{ $data->paraf }}" alt="" height="70px">
                        @endif
                    </div>
                </div>

                @if ($data->header == 'KHUSUS PASIEN BPJS')
                    <div class="mb-4 col align-items-center">
                        <div class="row">
                            <div class="col-10">
                                <div class="d-flex">
                                    <div class="me-3">

                                        <input name="alergi-obat" class="form-check-input" type="checkbox" disabled
                                            value="" id="khsPsnBPJS"
                                            {{ $data->header == 'KHUSUS PASIEN BPJS' ? 'checked' : '' }} />
                                    </div>
                                    <div class="col">
                                        <div class="">

                                            <label class="fw-bold text-decoration-underline form-check-label"
                                                for="khsPsnBPJS">
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
                                    <p class="text-center fw-bold">Paraf</p>
                                    <img src="{{ $data->paraf }}" alt="" height="70px">
                                @endif
                            </div>
                        </div>

                        <div class="ms-5">
                            <p>Kelengkapan Administrasi </p>
                            <div class="row">
                                <div class="col-6 ms-4">
                                    @foreach ($kelAdm as $kel)
                                        <div class="ms-3 row mt-2 ">
                                            <p class="m-0 col" style="max-width: 10px; ">{{ $loop->iteration }}</p>
                                            <p class="m-0 col">
                                                {{ $kel->name ?? '...................................................' }}
                                            </p>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col">
                                    <div class="mb-2 form-check col">
                                        @php
                                            $lengkap = count($kelAdm);
                                        @endphp
                                        <input name="alergi-obat" class="form-check-input" type="checkbox" disabled
                                            value="" id="klngAdmYa" {{ $lengkap == 3 ? 'checked' : '' }} />
                                        <label class="form-check-label" for="klngAdmYa">
                                            Lengkap
                                        </label>
                                    </div>
                                    <div class="mb-2 form-check col">
                                        <input name="alergi-obat" class="form-check-input" type="checkbox" disabled
                                            value="" id="klngAdmTidak" {{ $lengkap != 3 ? 'checked' : '' }} />
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

                                        <input name="alergi-obat" class="form-check-input" type="checkbox" disabled
                                            value="" id="khsPsnBPJS" />
                                    </div>
                                    <div class="col">
                                        <div class="">

                                            <label class="fw-bold text-decoration-underline form-check-label"
                                                for="khsPsnBPJS">
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
                                    <img src="{{ $data->paraf }}" alt="" height="70px">
                                @endif
                            </div>
                        </div>

                        <div class="ms-5">
                            <p>Kelengkapan Administrasi </p>
                            <div class="row">
                                <div class="col-6 ms-4">
                                    <div class="ms-3 row mt-2 ">
                                        <p class="m-0 col" style="max-width: 10px; ">1. </p>
                                        <p class="m-0 col">................................................... </p>
                                    </div>
                                    <div class="ms-3 row mt-2 ">
                                        <p class="m-0 col" style="max-width: 10px; ">2. </p>
                                        <p class="m-0 col">................................................... </p>
                                    </div>
                                    <div class="ms-3 row mt-2 ">
                                        <p class="m-0 col" style="max-width: 10px; ">3. </p>
                                        <p class="m-0 col">................................................... </p>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-2 form-check col">
                                        <input name="alergi-obat" class="form-check-input" type="checkbox" disabled
                                            value="" id="klngAdmYa" />
                                        <label class="form-check-label" for="klngAdmYa">
                                            Lengkap
                                        </label>
                                    </div>
                                    <div class="mb-2 form-check col">
                                        <input name="alergi-obat" class="form-check-input" type="checkbox" disabled
                                            value="" id="klngAdmTidak" />
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
                                    <input name="alergi-obat" class="form-check-input" type="checkbox" disabled
                                        value="" id="khsPsnJmKshtLain" />
                                </div>
                                <div class="col">
                                    <label class="fw-bold text-decoration-underline form-check-label"
                                        for="khsPsnJmKshtLain">
                                        KHUSUS PASIEN JAMINAN KESEHATAN LAIN / ASURANSI LAIN / PERUSAHAAN
                                    </label>
                                    <div>
                                        <p class="m-0 mb-3 d-flex">
                                            Akan menggunakan jaminan Kesehatan Lain / Asuransi lain /
                                            Perusahaan yaitu
                                            {{ $data->jaminan ?? '.................................' }} dan bersedia
                                            mengikuti
                                            bersedia mengikuti aturan yang berlaku sesuai dengan
                                            kontrak kerjasama dengan pihak RSK Bedah Ropanasuri
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            @if ($data->header == 'KHUSUS PASIEN JAMINAN KESEHATAN LAIN / ASURANSI LAIN / PERUSAHAAN')
                                <p class="text-center fw-bold">Paraf</p>
                                <img src="{{ $data->paraf }}" alt="" height="70px">
                            @endif
                        </div>
                    </div>
                </div>

                <div class="mb-3 col">
                    <div class="mb-3 row align-items-center">
                        <div class="col-10">
                            <div class="d-flex">
                                <div class="me-3">
                                    <input name="alergi-obat" class="form-check-input" type="checkbox" disabled
                                        value="" id="alergi-obat-ya" />
                                </div>
                                <div class="col">
                                    <label class="fw-bold text-decoration-underline form-check-label"
                                        for="alergi-obat-ya">
                                        KHUSUS PASIEN NAIK KELAS RAWATAN
                                    </label>
                                    <p class="m-0 d-flex">Saya meminta pihak rumah sakit untuk dipindahkan kelas
                                        rawatan
                                        dari ( kelas : {{ $data->dariKelas ?? '....................' }} ) ke ( kelas :
                                        {{ $data->keKelas ?? '......................' }} )
                                        Dan bersedia menanggung segala biaya yang diakibatkan oleh
                                        perpindahan kelas tersebut
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            @if ($data->header == 'KHUSUS PASIEN NAIK KELAS RAWATAN')
                                <p class="text-center fw-bold">Paraf</p>
                                <img src="{{ $data->paraf }}" alt="" height="70px">
                            @endif
                        </div>
                    </div>
                </div>

                <div class="mb-3 col align-items-center">
                    <div class="row align-items-center">
                        <div class="col-10">
                            <div class="d-flex">
                                <div class="me-3">
                                    <input name="alergi-obat" class="form-check-input" type="checkbox" disabled
                                        value="" id="khsPsnKclLnts" />
                                </div>
                                <div class="col">
                                    <label class="fw-bold text-decoration-underline form-check-label"
                                        for="khsPsnKclLnts">
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
                                <p class="text-center fw-bold">Paraf</p>
                                <img src="{{ $data->paraf }}" alt="" height="70px">
                            @endif
                        </div>
                    </div>
                </div>

                <div class="mb-3 row">
                    <p class="fw-bold text-decoration-underline">
                        CATATAN KHUSUS
                    </p>
                    <p class="m-0">
                        {!! $data->ctt_khusus ?? '.................................' !!}
                    </p>
                    <p>Demikianlah pernyataan ini saya buat dengan penuh kesadaran dan telah mendapatkan informasi yang
                        selengkap lengkapnya </p>


                    <div class="w-25 ms-auto d-flex justify-content-center align-items-center flex-column">
                        <p>Padang, {{ Carbon\Carbon::parse($data->created_at)->isoformat('D MMM Y') }}</p>
                        <img src="{{ $data->paraf }}" alt="" height="70px">
                        <p>{{ $data->name ?? '(..............................................)' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


</body>

</html>
