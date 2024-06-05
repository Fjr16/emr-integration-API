<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>HAK DAN KEWAJIBAN PASIEN</title>
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
            height: 330mm;
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
                <div class="col-8 d-flex align-self-center">
                    <h1 class="mx-auto">HAK DAN KEWAJIBAN PASIEN RAWAT INAP</h1>
                </div>
                <div class="col-2">
                    <!-- <div
                            class="border border-3 border-rounded py-4 px-5"
                        ></div> -->
                </div>
            </div>
        </div>

        <div class="content">
            <table class="table-bordered w-100 mt-2">
                <tbody>
                    <tr class="bg-secondary">
                        <td class="fw-bold text-center">
                            HAK PASIEN (UNDANG UNDANG NO. 44 TAHUN 2009
                            PASAL 32 TENTANG RUMAH SAKIT)
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="m-0 fw-bold">
                                SETIAP PASIEN MEMPUNYAI HAK :
                            </p>
                            <ol class="m-0">
                                <li>
                                    Memperoleh informasi mengenai tata
                                    tertib dan peraturan yang berlaku di
                                    Rumah Sakit;
                                </li>
                                <li>
                                    Memperoleh informasi tentang Hak dan
                                    Kewajiban Pasien;
                                </li>
                                <li>
                                    Memperoleh layanan yang manusiawi, adil,
                                    jujur, dan tanpa diskriminasi
                                </li>
                                <li>
                                    Memperoleh layanan kesehatan yang
                                    bermutu sesuai dengan standar profesi
                                    dan standar operasional;
                                </li>
                                <li>
                                    Memperoleh layanan yang efektif dan
                                    efisien sehingga pasien terhindar dari
                                    kerugian fisik dan materi;
                                </li>
                                <li>
                                    Mengajukan pengaduan atas kualitas
                                    pelayanan yang didapatkan
                                </li>
                                <li>
                                    Memilih dokter dan kelas perawatan yang
                                    sesuai dengan keinginannya dan peraturan
                                    yang berlaku di Rumah Sakit;
                                </li>
                                <li>
                                    Meminta konsultasi tentang penyakit yang
                                    dideritanya kepada dokter lain yang
                                    mempunyai Surat Izin Praktek (SIP) baik
                                    di dalam maupun di luar Rumah Sakit;
                                </li>
                                <li>
                                    Mendapatkan privasi dan kerahasiaan
                                    penyakit yang diderita termasuk
                                    data-data medisnya;
                                </li>
                                <li>
                                    Mendapat informasi yang meliputi
                                    diagnosis dan tata cara tindakan medis,
                                    tujuan tindakan medis, alternatif
                                    tindakan, risiko, dan komplikasi yang
                                    mungkin terjadi, dan prognosis terhadap
                                    tindakan yang dilakukan serta perkiraan
                                    biaya pengobatan;
                                </li>
                                <li>
                                    Memberikan persetujuan atau menolak atas
                                    tindakan yang akan dilakukan oleh tenaga
                                    kesehatan terhadap penyakit yang
                                    dideritanya;
                                </li>
                                <li>
                                    Didampingi keluarganya dalam keadaan
                                    kritis;
                                </li>
                                <li>
                                    Menjalankan ibadah sesuai dengan agama
                                    atau kepercayaan yang dianutnya selama
                                    hal itu tidak mengganggu pasien lainnya;
                                </li>
                                <li>
                                    Memperoleh keamanan dan keselamatan
                                    dirinya selama dalam perawatan di Rumah
                                    Sakit;
                                </li>
                                <li>
                                    Mengajukan usul, saran, perbaikan atas
                                    perlakuan Rumah Sakit terhadap dirinya;
                                </li>
                                <li>
                                    Menolak pelayanan bimbingan rohani yang
                                    tidak sesuai dengan agama dan
                                    kepercayaan yang dianut;
                                </li>
                                <li>
                                    Menggugat dan / atau menuntut Rumah
                                    Sakit apabila Rumah Sakit diduga
                                    memberikan pelayanan yang tidak sesuai
                                    dengan standar baik secara perdata
                                    ataupun pidana; dan
                                </li>
                                <li>
                                    Mengeluhkan pelayanan Rumah Sakit yang
                                    tidak sesuai dengan standar pelayanan
                                    media cetak dan elektronik sesuai dengan
                                    ketentuan peraturan perundang-undangan.
                                </li>
                            </ol>
                        </td>
                    </tr>
                    <tr class="bg-secondary">
                        <td class="fw-bold text-center">
                            KEWAJIBAN PASIEN (PERMENKES NOMOR 4 TAHUN 2008
                            TENTANG <br />
                            KEWAJIBAN RUMAH SAKIT DAN KEWAJIBAN PASIEN)
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="m-0 fw-bold">
                                SETIAP PASIEN MEMPUNYAI KEWAJIBAN :
                            </p>
                            <ol class="m-0">
                                <li>
                                    Mematuhi peraturan yang berlaku di Rumah
                                    Sakit;
                                </li>
                                <li>
                                    Menggunakan fasilitas Rumah Sakit secara
                                    bertanggung jawab;
                                </li>
                                <li>
                                    Menghormati hak pasien lain, pengunjung,
                                    dan hak Tenaga Kesehatan, serta petugas
                                    lainnya yang bekerja di Rumah Sakit;
                                </li>
                                <li>
                                    Memberikan informasi yang jujur,
                                    lengkap, dan akurat sesuai dengan
                                    kemampuan dan pengetahuan tentang
                                    masalah kesehatannya;
                                </li>
                                <li>
                                    Memberikan informasi mengenai kemampuan
                                    finansial dan jaminan kesehatan yang
                                    dimilikinya;
                                </li>
                                <li>
                                    Mematuhi rencana terapi yang
                                    direkomendasikan oleh Tenaga Kesehatan
                                    di Rumah Sakit dan disetujui oleh pasien
                                    yang bersangkutan setelah mendapatkan
                                    penjelasan sesuai dengan ketentuan
                                    peraturan perundang- undangan;
                                </li>
                                <li>
                                    Menerima segala konsekuensi atas
                                    keputusan pribadi untuk menolak rencana
                                    terapi yang direkomendasikan oleh Tenaga
                                    Kesehatan dan / atau tidak mematuhi
                                    petunjuk yang diberikan oleh Tenaga
                                    Kesehatan untuk penyembuhuan penyakit
                                    atau masalah kesehatannya; dan
                                </li>
                                <li>
                                    Memberikan imbalan jasa atas pelayanan
                                    yang telah diterima.
                                </li>
                            </ol>
                            <p class="m-0 fw-bold">
                                Dengan tanda saya dibawah ini, saya
                                menyatakan bahwa saya telah menerima
                                informasi, membaca, dan memahami item pada
                                Hak dan Kewajiban Pasien RSK Bedah
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
                                    <img class="ms-5 ps-5" src="{{ Storage::url($item->ttd) }}" alt="" height="70px">
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
