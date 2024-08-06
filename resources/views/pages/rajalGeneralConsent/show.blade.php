<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GENERAL CONSENT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
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
            margin: 0 10mm;
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
                    <h1>PERSETUJUAN UMUM <br />(GENERAL CONSENT)</h1>
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
                                <td class="fs-8">{{ implode('-', str_split(str_pad($item->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}
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
                    <!--  -->
                    <tr>
                        <td>
                            <p class="m-0 fw-bold">
                                Persetujuan Umum (General Consent) diisi
                                oleh pasien atau keluarga yang berusia &ge;
                                18 tahun. <br />
                                Pasien, Keluarga dan atau Wali selaku kuasa
                                dari pasien diminta untuk membaca, memahami
                                dan mengisi informasi berikut:
                            </p>

                            <p>Yang bertanda tangan di bawah ini:</p>
                            <div style="margin: -2mm 4mm">
                                <div class="d-flex">
                                    <p style="width: 25mm">Nama</p>
                                    <p style="margin: 0 1mm">:</p>
                                    <p>
                                        {{ $item->name ?? '....................................................................................................' }}
                                    </p>
                                </div>
                                <!--  -->
                                <div class="d-flex" style="margin-top: -5mm">
                                    <p style="width: 25mm">Tanggal Lahir</p>
                                    <p style="margin: 0 1mm">:</p>
                                    @php
                                        if (isset($item->tgl_lhr)) {
                                            $formatId = Carbon\Carbon::parse($item->tgl_lhr ?? '');
                                            $tglLhr = $formatId->isoformat('D MMM Y');
                                        } else {
                                            $tglLhr = null;
                                        }
                                    @endphp
                                    <p>
                                        {{ $tglLhr ?? '....................................................................................................' }}
                                    </p>
                                </div>

                                <!--  -->
                                <div class="d-flex" style="margin-top: -5mm">
                                    <p style="width: 25mm">Jenis Kelamin</p>
                                    <p style="margin: 0 1mm">:</p>
                                    <p>
                                        {{ $item->kelamin ?? '....................................................................................................' }}
                                    </p>
                                </div>

                                <!--  -->
                                <div class="d-flex" style="margin-top: -5mm">
                                    <p style="width: 25mm">Alamat</p>
                                    <p style="margin: 0 1mm">:</p>
                                    <p>
                                        {{ $item->alamat ?? '....................................................................................................' }}
                                    </p>
                                </div>

                                <!--  -->
                                <div class="d-flex" style="margin-top: -5mm">
                                    <p style="width: 25mm">No. Telp / HP</p>
                                    <p style="margin: 0 1mm">:</p>
                                    <p>
                                        {{ $item->phone ?? '....................................................................................................' }}
                                    </p>
                                </div>

                                <!--  -->
                            </div>

                            <div class="px-1">
                                <p style="margin-bottom: -1mm" class="d-flex justify-content-start align-items-center">
                                    <span style="margin-right: 2mm">Hubungan dengan pasien :
                                        {{ $item->hubungan ?? '..............................' }}</span>
                                </p>
                                <p>dengan ini menyatakan persetujuan :</p>
                            </div>
                        </td>
                    </tr>

                    <!-- persetujuan -->
                    <tr class="bg-secondary">
                        <td class="fw-bold text-center text-uppercase">
                            persetujuan untuk perawatan dan pengobatan
                        </td>
                    </tr>

                    <!-- conten persetujuan -->
                    <tr>
                        <td>
                            <ol class="m-0">
                                <li>
                                    Saya menyetujui untuk perawatan di RS **** **** sebagai pasien rawat
                                    inap tergantung kepada rencana asuhan
                                    sesuai dengan kebutuhan pasien.
                                </li>
                                <li>
                                    Saya mengetahui bahwa saya memiliki
                                    kondisi yang membutuhkan perawatan
                                    medis, saya mengizinkan dokter dan
                                    profesional kesehatan lainnya untuk
                                    melakukan prosedur diagnostik dan untuk
                                    memberikan pengobatan medis seperti yang
                                    diperlukan dalam profesional mereka.
                                    Prosedur diagnostik dan perawatan medis
                                    termasuk terapi tidak terbatas pada
                                    electrocardiogram, x-ray (radiologi),
                                    tes darah, terapi fisik, pemberian obat
                                    (kecuali yang membutuhkan persetujuan
                                    khusus / tertulis), perawatan rutin dan
                                    prosedur seperti pemasangan infus,
                                    pemasangan kateter, spalak, pemberian
                                    oksigen, dan suntikan.
                                </li>
                                <li>
                                    Saya sadar bahwa praktik kedokteran
                                    bukanlah ilmu pasti dan saya mengakui
                                    bahwa tidak ada jaminan atas hasil
                                    apapun, terhadap perawatan prosedur atau
                                    pemeriksaan apapun yang dilakukan kepada
                                    saya.
                                </li>
                                <li>
                                    Persetujuan yang saya berikan tidak
                                    termasuk prosedur pembedahan atau
                                    tindakan invasif, anestesi, sedasi,
                                    penggunaan darah dan produk darah,
                                    perataan atau tindakan berisiko tinggi
                                    maka diperlukan persetujuan tindakan
                                    secara terpisah (informed consent).
                                </li>
                                <li>
                                    saya mengerti dan memahami bahwa :
                                    <ol type="a">
                                        <li>
                                            Saya memiliki hak untuk
                                            mendapatkan akses terhadap
                                            informasi kesehatan saya dan
                                            mengajukan pertanyaan tentang
                                            pengobatan yang diusulkan
                                            (termasuk identitas setiap orang
                                            yang memberikan atau mengamati
                                            pengobatan) setiap saat.
                                        </li>

                                        <li>
                                            Saya mengerti dan memahami bahwa
                                            saya memiliki hak untuk
                                            menyetujui atau menolak
                                            persetujuan, untuk setiap
                                            prosedur/terapi dan saya
                                            memahami dan menyadari bahwa RS **** **** atau dokter
                                            tidak bertanggung jawab atas
                                            hasil yang merugikan saya.
                                        </li>
                                    </ol>
                                </li>
                            </ol>
                        </td>
                    </tr>

                    <!-- hak dan tanggung jawab  -->
                    <tr class="bg-secondary">
                        <td class="fw-bold text-center">
                            HAK DAN TANGGUNG JAWAB PASIEN
                        </td>
                    </tr>

                    <!-- content hak dan tanggung jawab  -->
                    <tr>
                        <td>
                            <p>
                                Saya memiliki hak untuk mengambil bagian
                                dalam keputusan mengenai penyakit saya dan
                                dalam hal perawatan medis dan rencana
                                pengobatan.
                            </p>
                            <p style="margin-top: -4mm">
                                Saya telah mendapat informasi tentang "Hak
                                dan Tanggung Jawab Pasien" di RS **** **** melalui banner, leaflet,
                                dan form tertulis yang disediakan oleh
                                petugas
                            </p>
                        </td>
                    </tr>

                    <!-- kebutuhan dan privasi-->
                    <tr class="bg-secondary">
                        <td class="fw-bold text-center text-uppercase">
                            kebutuhan privasi
                        </td>
                    </tr>

                    <!-- isi kkebutuhn dan privasi  -->
                    <tr>
                        <td>
                            <ol>
                                <li>
                                    Saya {{ $item->kebutuhan_privasi1 ?? '.........' }}
                                    RS **** **** untuk difoto /
                                    direkam dan diikutsertakan dalam survei.
                                </li>
                                <li class="mb-3">
                                    Saya {{ $item->kebutuhan_privasi2 ?? '.........' }}
                                    privasi khusus sebutkan bila ada permintaan privasi khusus
                                </li>
                                <p style="margin-top: -4mm">
                                    {{ $item->kebutuhan_privasi_khusus ?? '...........................................................................................................................................................................................................................' }}
                                </p>
                            </ol>
                        </td>
                    </tr>

                    <!-- harta benda milik pasien-->
                    <tr class="bg-secondary">
                        <td class="fw-bold text-center text-uppercase">
                            harta benda milik pasien
                        </td>
                    </tr>

                    <!-- isi harta benda milik pasien  -->
                    <tr>
                        <td>
                            <p>
                                {{ $item->harta_benda ?? '' }}
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>

            {{-- Footer --}}
            <div class="d-flex flex-row justify-content-between mt-4">
                <div class="d-flex flex-row text-center" style="font-size: 5pt">
                    <div class="col col-3 text-center">
                        <i class="bi bi-geo-alt-fill"></i>
                        <p>Jl. Air Tawar Barat No. 8, Padang Timur, Kota Padang, Sumatera Barat</p>
                    </div>
                    <div class="col col-3 text-center">
                        <i class="bi bi-envelope-at-fill"></i>
                        <p>RS*******ar@gmail.com</p>
                    </div>
                    <div class="col col-3 text-center">
                        <i class="bi bi-telephone-fill"></i>
                        <p>(0751) 31938 - ***** - ***** - ****</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page">
        <div class="header">
            <div class="d-flex flex-row align-items-center justify-content-center">
                <div class="col-1">
                    <img src="{{ asset('/assets/img/logo.png') }}" alt="" />
                </div>
                <div class="text-center mx-2 col-6">
                    <h1>PERSETUJUAN UMUM <br />(GENERAL CONSENT)</h1>
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
                    <!-- persetujua pelepasan informasi-->
                    <tr class="bg-secondary">
                        <td class="fw-bold text-center text-uppercase">
                            persetujuan pelepasan informasi
                        </td>
                    </tr>

                    <!-- isi persetujua pelepasan informasi  -->
                    <tr>
                        <td>
                            <ol>
                                <li>
                                    Saya memahami informasi yang ada di
                                    dalam diri saya, termasuk diagnosis,
                                    hasil laboratorium, dan hasil tes
                                    diagnostik yang akan digunakan untuk
                                    perawatan medis, RS **** ****
                                    akan menjamin kerahasiaannya.
                                </li>
                                <li>
                                    Saya memberi wewenang kepada RS **** **** untuk memberikan informasi
                                    tentang rahasia kedokteran saya bila
                                    diperlukan untuk memproses klaim
                                    Asuransi termasuk namun tidak terbatas
                                    pada BPJS Kesehatan, BPJS
                                    Ketenagakerjaan, asuransi kesehatan
                                    lainnya, Perusahaan, Dinas Kesehatan,
                                    atau Lembaga Pemerintah lainnya.
                                </li>
                                <li class="mb-3">
                                    Saya
                                    {{ $item->persetujuan_pelepasan_informasi ?? '' == 'ya' ? 'menyetujui' : 'tidak menyetujui' }}
                                    pelepasan informasi (diagnosis, hasil
                                    pelayanan, dan pengobatan) terkait
                                    perawatan saya kepada anggota keluarga
                                    saya (termasuk kondisi kritis atau
                                    situasi tertentu), sebutkan nama atau
                                    hubungan dengan pasien
                                </li>
                                @if ($item->rajalGeneralConsentDetails->isNotEmpty())                                    
                                    @foreach ($item->rajalGeneralConsentDetails as $detail)                                        
                                    <p style="margin-top: -4mm">
                                        nama : {{ $detail->name ?? '.....................' }}, hubungan dengan pasien :
                                        {{ $detail->hub ?? '......................................' }}
                                    </p>
                                    @endforeach
                                @else
                                    <p style="margin-top: -4mm">
                                        nama : ....................., hubungan dengan pasien : ......................................
                                    </p>
                                @endif
                            </ol>
                        </td>
                    </tr>

                    <!-- PENDAPAT KEDUA  -->
                    <tr class="bg-secondary">
                        <td class="fw-bold text-center">
                            PENDAPAT KEDUA (SECOND OPINION)
                        </td>
                    </tr>

                    <!-- content PENDAPAT KEDUA  -->
                    <tr>
                        <td>
                            <p>
                                RS **** **** memfasilitasi
                                permintaan pasien untuk mencari pendapat
                                kedua (second opinion) tanpa perlu khawatir
                                akan mempengaruhi perawatannya selama di
                                dalam/luar Rumah Sakit.
                            </p>
                        </td>
                    </tr>

                    <!-- pENYAMPAIAN KELUHAN / PENDAPAT SELAMA PERAWATAN  -->
                    <tr class="bg-secondary">
                        <td class="fw-bold text-center">
                            PENYAMPAIAN KELUHAN / PENDAPAT SELAMA PERAWATAN
                        </td>
                    </tr>

                    <!-- content pENYAMPAIAN KELUHAN / PENDAPAT SELAMA PERAWATAN  -->
                    <tr>
                        <td>
                            <p>
                                RS **** **** meneydiakan fasilitas
                                kepada pasien dan keluarga untuk
                                menyampaikan keluhan pendapat sejak pasien
                                mengakses pelayanan, selama menjalani masa
                                perawatan dan pada proses pemulangan
                                melalui:
                            </p>
                            <ol type="a" style="margin-top: -4mm">
                                <li>
                                    Pengisian kotak saran yang berada di
                                    IGD/Rawat Jalan/Rawat Inap
                                </li>
                                <li>
                                    Melalui layanan pengaduan di Aplikasi
                                    WhatsApp : 0812-6729-2974
                                </li>
                            </ol>
                        </td>
                    </tr>

                    <!-- informasi tata tertip bagi pasien dan keluarga -->
                    <tr class="bg-secondary">
                        <td class="fw-bold text-center text-uppercase">
                            informasi tata tertip bagi pasien dan keluarga
                        </td>
                    </tr>

                    <!-- content informasi tata tertip bagi pasien dan keluarga -->
                    <tr>
                        <td>
                            <p>
                                Saya telah menerima informasi tentang tata tertib
                                yang diberlakukan oleh RS **** **** dan saya beserta keluarga bersedia untuk
                                mematuhinya.
                            </p>
                        </td>
                    </tr>

                    <!-- informasi biaya -->
                    <tr class="bg-secondary">
                        <td class="fw-bold text-center text-uppercase">
                            informasi biaya
                        </td>
                    </tr>

                    <!-- content informasi biaya -->
                    <tr>
                        <td>
                            <p>
                                Pasien umum / pribadi pembiayaan yang
                                dikenakan mengacu kepada tarif pelayanan yang
                                ada di RS **** ****.
                            </p>
                        </td>
                    </tr>

                    <!-- PERSETUJUAN UMUM (GENERAL CONSENT)-->
                    <tr class="bg-secondary">
                        <td class="fw-bold text-center text-uppercase">
                            PERSETUJUAN UMUM (GENERAL CONSENT)
                        </td>
                    </tr>

                    <!-- content PERSETUJUAN UMUM (GENERAL CONSENT)-->
                    <tr>
                        <td>
                            <p class="fw-bold fst-italic">
                                Dengan tanda tangan saya di bawah ini, saya
                                menyatakan bahwa saya telah menerima
                                informasi, membaca. dan memahami item pada
                                Persetujuan Umum/General Consent.
                            </p>

                            <div class="row">
                                <div class="col-5 text-center">
                                    <p class="m-0 fw-bold mt-3">
                                        Petugas Admisi
                                    </p>
                                    <img src="{{ Storage::url($item->ttd_admisi ?? '') }}" alt=""
                                        height="70px">
                                    <p class="m-0">
                                        {{ $item->user->name ?? '(...................................................................)' }}
                                    </p>
                                </div>
                                <div class="col-1"></div>
                                <div class="col-1"></div>
                                <div class="col-5">
                                    @php
                                        $formatId = Carbon\Carbon::parse($item->created_at ?? '');
                                    @endphp
                                    <p class="m-0 fw-bold text-center">
                                        Padang,
                                        {{ $formatId->isoformat('D MMM Y') ?? '....................... 20......' }}
                                    </p>
                                    <p class="m-0 fw-bold text-center">
                                        @isset($item->hubungan)
                                            @if ($item->hubungan ?? '' == 'Diri Sendiri')
                                                Pasien
                                            @elseif($item->hubungan ?? ('' == 'Teman' || $item->hubungan ?? '' == 'Lainnya'))
                                                Wali
                                            @else
                                                Keluarga Pasien
                                            @endif
                                        @endisset
                                    </p>
                                    {{-- <br /><br /><br /> --}}
                                    <img class="ms-5 ps-5" src="{{ Storage::url($item->ttd ?? '') }}" alt=""
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
        <div class="d-flex flex-row justify-content-between mt-5 PT-5">
            <div class="d-flex flex-row text-center" style="font-size: 5pt">
                <div class="col col-3 text-center">
                    <i class="bi bi-geo-alt-fill"></i>
                    <p>Jl. Air Tawar Barat No. 8, Padang Timur, Kota Padang, Sumatera Barat</p>
                </div>
                <div class="col col-3 text-center">
                    <i class="bi bi-envelope-at-fill"></i>
                    <p>RS*******ar@gmail.com</p>
                </div>
                <div class="col col-3 text-center">
                    <i class="bi bi-telephone-fill"></i>
                    <p>(0751) 31938 - ***** - ***** - ****</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
