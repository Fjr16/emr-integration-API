<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TATA TERTIB RAWAT INAP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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

        .fs-8 {
            font-size: 8pt;
        }

        @page {
            size: A4;
            margin: 0;
        }

        @media print {

            *,
            *:before,
            *:after {
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }

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
            <div class="d-flex flex-row align-items-center justify-content-center">
                <div class="col-1">
                    <img src="{{ asset('/assets/img/logo.png') }}" alt="" />
                </div>
                <div class="text-center mx-2 col-6">
                    <h1>TATA TERTIB RUMAH SAKIT</h1>
                </div>
                <div class="">
                    <div class="border border-dark py-1 px-1" style="border-radius: 15px">
                        <table class="small small-table">
                            <tr>
                                <td class="fs-8">Nama</td>
                                <td class="px-2 fs-8">:</td>
                                <td class="fs-8">{{ $item->patient->name }}</td>
                            </tr>
                            <tr>
                                <td class="fs-8">Tanggal Lahir</td>
                                <td class="px-2 fs-8">:</td>
                                @php
                                    $tanggalLahir = new DateTime($item->patient->tanggal_lhr);
                                    $now = new DateTime();
                                    $ageDiff = $now->diff($tanggalLahir);
                                    $ageString = $ageDiff->format('%y tahun %m bulan');
                                @endphp
                                <td class="fs-8">{{ $tanggalLahir->format('d-m-Y') ?? '....' }}
                                    <span>({{ $ageString ?? '....' }})</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="fs-8">No Rekam Medis</td>
                                <td class="px-2 fs-8">:</td>
                                <td class="fs-8">
                                    {{ implode('-', str_split(str_pad($item->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}
                                </td>
                            </tr>
                            <tr>
                                <td class="fs-8">NIK</td>
                                <td class="px-2 fs-8">:</td>
                                <td class="fs-8">{{ $item->patient->nik }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <table class="table-bordered w-100 mt-2">
                <tbody>
                    <tr class="bg-secondary">
                        <td class="fw-bold text-center">
                            KEBIJAKAN PELAYANAN
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <ol class="m-0">
                                <li>Pelayanan IGD 24 Jam</li>
                                <li>
                                    Pelayanan Rawat Jalan
                                    <ul>
                                        <li>Pendaftaran Online 24 Jam</li>
                                        <li>
                                            Pendaftaran di Admisi <br />
                                            Senin – Minggu (kecuali hari
                                            libur nasional) : Jam 08.00
                                            sampai 15 menit sebelum
                                            poliklinik di mulai
                                        </li>
                                        <li>
                                            Pelayanan <br />
                                            Senin – Minggu (kecuali hari
                                            libur nasional) : Jam 08.00
                                            sampai 15 menit sebelum
                                            poliklinik dimulai.
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    Pelayanan Kemoterapi
                                    <ul>
                                        <li>
                                            Pendaftaran di Admisi <br />
                                            Senin – Sabtu : Jam 08.00 WIB
                                        </li>
                                        <li>
                                            Pelayanan Kemoterapi <br />
                                            Senin – Sabtu : Jam 10.00 <br />
                                            Minggu dan libur nasional tutup
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    Pelayanan Rawat Inap 24 Jam
                                    <ul>
                                        <li>
                                            Waktu Berkunjung Rawat Inap
                                            <br />
                                            Pagi : Jam 09:30 WIB sampai
                                            dengan 11:30 WIB <br />
                                            Sore : Jam 18:00 WIB sampai
                                            dengan 21:00 WIB
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    Setiap pasien / pengunjung wajib
                                    mematuhi tata tertib yang berlaku di RSK
                                    Bedah Ropanasuri dan wajib melakukan
                                    screening sebelum memasuki Rumah Sakit
                                </li>
                                <li>
                                    Pasien tidak diperkenankan membawa obat-obatan tanpa sepengetahuan dokter / perawat
                                    selama
                                    perawatan.
                                </li>
                                <li>
                                    Pasien dan keluarga tidak diperkenankan membawa fasilitas Rumah Sakit keluar dari
                                    Rumah Sakit.
                                </li>
                                <li>
                                    Pasien berhak didampingi oleh 1 (satu) orang anggota keluarga pada saat konsultasi.
                                </li>
                                <li>
                                    Anak-anak dibawah usia 12 (duabelas) tahun dilarang memasuki Rumah Sakit kecuali
                                    untuk berobat.
                                </li>
                                <li>
                                    Menjaga kebersihan dan ketertiban
                                    ruangan.
                                </li>
                                <li>
                                    Dilarang keras merokok di lingkungan RSK
                                    Bedah Ropanasuri bagi pasien,
                                    dan keluarga.
                                </li>
                                <li>
                                    Pihak RSK Bedah Ropanasuri melarang
                                    kepada pasien dan keluarga untuk tidak
                                    membawa barang berharga ke rumah sakit,
                                    akan tetapi untuk pasien dengan kondisi
                                    tertentu RSK Bedah Ropanasuri
                                    menyediakan tempat penyimpanan harta
                                    sementara.
                                </li>
                                <li>
                                    Pihak RSK Bedah Ropanasuri tidak
                                    bertanggung jawab apabila terjadi
                                    kehilangan uang / barang berharga selama
                                    masa perawatan atau kunjungan.
                                </li>
                                <li>
                                    Segala pembiayaan yang ada terkait dengan
                                    tatalaksana pelayanan mengacu kepada tarif
                                    yang berlaku di RSK Bedah Ropanasuri.
                                </li>
                            </ol>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="m-0 fw-bold">
                                Dengan tanda tangan saya dibawah ini, saya
                                menyatakan bahwa saya telah menerima
                                informasi, membaca, dan memahami item pada
                                Tata Tertib RSK Bedah
                                Ropanasuri.
                            </p>
                            <div class="row">
                                <div class="col-5 text-center">
                                    <p class="m-0 fw-bold mt-3">
                                        Petugas Admisi
                                    </p>
                                    <img src="{{ Storage::url($item->ttd_admisi) }}" alt="" height="70px">
                                    <p class="m-0">
                                        {{ $item->user->name ?? '(...................................................................)' }}
                                    </p>
                                </div>
                                <div class="col-1"></div>
                                <div class="col-1"></div>
                                <div class="col-5">
                                    @php
                                        $formatId = Carbon\Carbon::parse($item->created_at);
                                    @endphp
                                    <p class="m-0 fw-bold text-center">
                                        Padang,
                                        {{ $formatId->isoformat('D MMM Y') ?? '....................... 20......' }}
                                    </p>
                                    <p class="m-0 fw-bold text-center">
                                        @if ($item->hubungan == 'Diri Sendiri')
                                            Pasien
                                        @elseif($item->hubungan == 'Teman' || $item->hubungan == 'Lainnya')
                                            Wali
                                        @else
                                            Keluarga Pasien
                                        @endif
                                    </p>
                                    <img class="ms-5 ps-5" src="{{ Storage::url($item->ttd) }}" alt=""
                                        height="70px">
                                    <p class="m-0 text-center">
                                        {{ $item->name ?? '(...................................................................)' }}
                                    </p>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Footer --}}
        <div class="d-flex flex-row justify-content-between mt-5">
            <div class="d-flex flex-row text-center" style="font-size: 5pt">
                <div class="col col-3 text-center">
                    <i class="bi bi-geo-alt-fill"></i>
                    <p>Jl. Aur No. 8, Ujung Gurun, Padang Barat, Kota Padang, Sumatera Barat</p>
                </div>
                <div class="col col-3 text-center">
                    <i class="bi bi-envelope-at-fill"></i>
                    <p>rskbropanasuripadang@gmail.com</p>
                </div>
                <div class="col col-3 text-center">
                    <i class="bi bi-telephone-fill"></i>
                    <p>(0751) 31938 - 33854 - 25735 - 8955227</p>
                </div>
            </div>
            <p class="mt-2"><span class="border border-dark">RM 03.RJ.PM</span></p>
        </div>
    </div>

    <script>
        // Mendapatkan tanggal saat ini
        var today = new Date();
        var options = {
            year: "numeric",
            month: "long",
            day: "numeric"
        };
        document.getElementById("tanggal").innerText =
            today.toLocaleDateString("id-ID", options);
    </script>
</body>

</html>
