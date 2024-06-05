<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title></title>
    <script src="https://cdn.tailwindcss.com"></script>
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
            <div class="grid grid-cols-4 gap-4">
                <div class="...">
                    <img src="logo.png" alt="" />
                </div>
                <div class="col-span-2">
                    <h1 class="text-center uppercase">
                        Checklist Rencana Pulang <br>
                        (DISCHARGE PLANNING)
                    </h1>
                </div>
            </div>
        </div>

        <div class="content">
            <section class="pt-5">
                <table class="w-full">
                    <thead>
                        <tr class="border-y border-black text-center font-bold uppercase">
                            <td class="border-x border-black w-1/2">
                                Kegiatan
                            </td>
                            <td class="border-x border-black w-1/2">
                                Catatan
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- bagian 1 -->
                        <div>
                            <tr class="border-t border-black">
                                <td class="border-x border-black font-bold pl-16 uppercase">
                                    Aktifitas, Edukasi, dan Latihan
                                </td>
                                <td rowspan="11" class="border-x border-black">
                                    <p class="font-semibold px-3 pb-3">
                                        {{ $item->ranapDetailDischargePlanningPerawatPatients->where('kegiatan', 'AKTIFITAS, EDUKASI, DAN LATIHAN')->pluck('catatan')->first() ?? '' }}
                                    </p>
                                </td>
                            </tr>
                            <!-- 1 -->
                            <tr>
                                <td class="flex gap-3 border-l border-black pl-4">
                                    <input type="checkbox"
                                        {{ in_array('Jenis aktifitas yang boleh dilakukan', $arrDetail[0]) ? 'checked' : '' }}
                                        style="pointer-events: none;" />
                                    <p class="font-semibold">
                                        Jenis aktifitas yang boleh dilakukan
                                    </p>
                                </td>
                            </tr>
                            <!-- 2 -->
                            <tr>
                                <td class="flex gap-3 border-l border-black pl-4">
                                    <input style="pointer-events: none;" type="checkbox"
                                        {{ in_array('Alat bantu yang bisa digunakan', $arrDetail[0]) ? 'checked' : '' }} />
                                    <p class="font-semibold">
                                        Alat bantu yang bisa digunakan
                                    </p>
                                </td>
                            </tr>
                            <!-- 3 -->
                            <tr>
                                <td class="flex gap-3 border-l border-black pl-4">
                                    <input style="pointer-events: none;" type="checkbox"
                                        {{ in_array('Latihan melakukan aktifitas dan menggunakan alat bantu', $arrDetail[0]) ? 'checked' : '' }} />
                                    <p class="font-semibold">
                                        Latihan melakukan aktifitas dan
                                        menggunakan alat bantu
                                    </p>
                                </td>
                            </tr>
                            <!-- 4 -->
                            <tr>
                                <td class="flex gap-3 border-l border-black pl-4">
                                    <input style="pointer-events: none;" type="checkbox"
                                        {{ in_array('Informasi lain yang diperlukan untuk aktifitas', $arrDetail[0]) ? 'checked' : '' }} />
                                    <p class="font-semibold">
                                        Informasi lain yang diperlukan untuk
                                        aktifitas
                                    </p>
                                </td>
                            </tr>
                            <!-- 5 -->
                            <tr>
                                <td class="flex gap-3 border-l border-black pl-4">
                                    <input style="pointer-events: none;" type="checkbox"
                                        {{ in_array('Hygiene (mandi, bab, bak, dll)', $arrDetail[0]) ? 'checked' : '' }} />
                                    <p class="font-semibold">
                                        Hygiene (mandi, bab, bak, dll)
                                    </p>
                                </td>
                            </tr>
                            <!-- 6 -->
                            <tr>
                                <td class="flex gap-3 border-l border-black pl-4">
                                    <input style="pointer-events: none;" type="checkbox"
                                        {{ in_array('Cara perawatan NGT, Kateter, Colostomi, dll', $arrDetail[0]) ? 'checked' : '' }} />
                                    <p class="font-semibold">
                                        Cara perawatan NGT, Kateter,
                                        Colostomi, dll
                                    </p>
                                </td>
                            </tr>
                            <!-- 7 -->
                            <tr>
                                <td class="flex gap-3 border-l border-black pl-4">
                                    <input style="pointer-events: none;" type="checkbox"
                                        {{ in_array('Cara perawatan luka', $arrDetail[0]) ? 'checked' : '' }} />
                                    <p class="font-semibold">
                                        Cara perawatan luka
                                    </p>
                                </td>
                            </tr>
                            <!-- 8 -->
                            <tr>
                                <td class="flex gap-3 border-l border-black pl-4">
                                    <input style="pointer-events: none;" type="checkbox"
                                        {{ in_array('Cara pencegahan dna kontrol adanya infeksi', $arrDetail[0]) ? 'checked' : '' }} />
                                    <p class="font-semibold">
                                        Cara pencegahan dna kontrol adanya
                                        infeksi
                                    </p>
                                </td>
                            </tr>
                            <!-- 9 -->
                            <tr>
                                <td class="flex gap-3 border-l border-black pl-4">
                                    <input style="pointer-events: none;" type="checkbox"
                                        {{ in_array('Pengobatan yang dapat dilakukan dirumah', $arrDetail[0]) ? 'checked' : '' }} />
                                    <p class="font-semibold">
                                        Pengobatan yang dapat dilakukan
                                        dirumah
                                    </p>
                                </td>
                            </tr>
                            <!-- 10 -->
                            <tr>
                                <td class="flex gap-3 border-l border-black pl-4">
                                    <input style="pointer-events: none;" type="checkbox"
                                        {{ in_array('Sebelum ke rumah sakit', $arrDetail[0]) ? 'checked' : '' }} />
                                    <p class="font-semibold">
                                        Sebelum ke rumah sakit
                                    </p>
                                </td>
                            </tr>
                        </div>
                        <!-- bagian 2 -->
                        <div>
                            <tr class="border-t border-black">
                                <td class="border-x border-black font-bold pl-16 uppercase">
                                    Fasilitas kesehatan yang bisa dihubungi
                                    jika terjadi kedaruratan
                                </td>
                                <td rowspan="3" class="border-x border-black">
                                    <p class="font-semibold px-3 pb-3">
                                        {{ $item->ranapDetailDischargePlanningPerawatPatients->where('kegiatan', 'FASILITAS KESEHATAN YANG BISA DIHUBUNGI JIKA TERJADI KEDARURATAN')->pluck('catatan')->first() ?? '' }}
                                    </p>
                                </td>
                            </tr>
                            <!-- 1 -->
                            <tr>
                                <td class="flex gap-3 border-l border-black pl-4">
                                    <input style="pointer-events: none;" type="checkbox"
                                        {{ in_array('Petugas kesehatan dilingkungan sekitar tempat tinggal pasien', $arrDetail[1]) ? 'checked' : '' }} />
                                    <p class="font-semibold">
                                        Petugas kesehatan yang dilingkungan
                                        sekitar tempat tinggal pasien
                                    </p>
                                </td>
                            </tr>
                            <!-- 2 -->
                            <tr>
                                <td class="flex gap-3 border-l border-black pl-4">
                                    <input style="pointer-events: none;" type="checkbox"
                                        {{ in_array('Puskesmas, klinik, praktek dokter dilingkungan sekitar tempat tinggal pasien', $arrDetail[1]) ? 'checked' : '' }} />
                                    <p class="font-semibold">
                                        Puskesmas, klinik, praktek dokter
                                        lingkungan sekitar tempat tinggal
                                        pasien
                                    </p>
                                </td>
                            </tr>
                            <!-- 10 -->
                            <tr>
                                <td class="flex gap-3 border-l border-black pl-4">
                                    <input style="pointer-events: none;" type="checkbox"
                                        {{ in_array('Rumah sakit yang mudah diakses', $arrDetail[1]) ? 'checked' : '' }} />
                                    <p class="font-semibold">
                                        Rumah sakit yang mudah di akses
                                    </p>
                                </td>
                                <td class="border-x border-black">
                                    <input style="pointer-events: none;" type="text"
                                        class="dotted-input font-semibold placeholder:text-black w-full" />
                                </td>
                            </tr>
                        </div>
                        <!-- bagian 3 -->
                        <div class="border-x border-black">
                            <tr class="border-t border-black">
                                <td class="border-x border-black font-bold pl-16 uppercase">
                                    Rincian pemulangan
                                </td>
                                <td rowspan="10" class="border-x border-black border-l border-b">
                                    @php
                                        $ctt_rincian = explode(
                                            '#*',
                                            $item->ranapDetailDischargePlanningPerawatPatients
                                                ->where('kegiatan', 'RINCIAN PEMULANGAN')
                                                ->pluck('catatan')
                                                ->first(),
                                        );
                                    @endphp

                                    <p class="font-semibold px-3 pb-3">
                                        {{ $ctt_rincian[0] ?? '' }}
                                    </p>
                                    <p class="font-semibold px-3">
                                        pasien / keluarga akan dihubungi oleh petugas labor RS
                                    </p>
                                    <p class="font-semibold px-3 pt-3">
                                        {{ $ctt_rincian[2] ?? '' }}
                                    </p>
                                </td>
                            </tr>
                            <!-- 1 -->
                            <tr>
                                <td class="flex gap-1 border-l border-black pl-4">
                                    <input style="pointer-events: none;" type="checkbox"
                                        {{ in_array('Tanggal Kontrol', $arrDetail[2]) ? 'checked' : '' }} />
                                    <p class="font-semibold">
                                        Tanggal kontrol
                                    </p>
                                </td>
                            </tr>
                            <!-- 2 -->
                            <tr>
                                <td class="border-l border-black w-full grid grid-cols-4 pl-4">
                                    <div class="flex gap-1">
                                        <input style="pointer-events: none;" type="checkbox"
                                            {{ in_array('Pendamping:', $arrDetail[2]) ? 'checked' : '' }} />
                                        <p class="font-semibold">
                                            Pendamping
                                        </p>
                                    </div>
                                    <div class="flex gap-1 pl-4">
                                        <input style="pointer-events: none;" type="radio"
                                            {{ $grandChildPendamping == 'Keluarga' ? 'checked' : '' }} />
                                        <p class="font-semibold">
                                            Keluarga
                                        </p>
                                    </div>
                                    <div class="flex gap-1 pl-2">
                                        <input style="pointer-events: none;" type="radio"
                                            {{ $grandChildPendamping == 'Perawat' ? 'checked' : '' }} />
                                        <p class="font-semibold">Perawat</p>
                                    </div>
                                    <div class="flex gap-1">
                                        <input style="pointer-events: none;" type="radio"
                                            {{ $grandChildPendamping == 'Dokter' ? 'checked' : '' }} />
                                        <p class="font-semibold">Dokter</p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="border-l border-black w-full grid grid-cols-1 pl-4">
                                    <div class="flex gap-1">
                                        <input style="pointer-events: none;" type="checkbox"
                                            {{ in_array('Transportasi Yang Digunakan:', $arrDetail[2]) ? 'checked' : '' }} />
                                        <p class="font-semibold">
                                            Transportasi Yang Digunakan:
                                        </p>
                                    </div>
                            <tr>
                                <td class="border-l border-black w-full grid grid-cols-2 pl-4">
                                    <div class="flex gap-1 pl-4">
                                        <input style="pointer-events: none;" type="radio"
                                            {{ $grandChildTransportasi == 'Mobil Pribadi' ? 'checked' : '' }} />
                                        <p class="font-semibold">
                                            Mobil Pribadi
                                        </p>
                                    </div>
                                    <div class="flex gap-1 pl-2">
                                        <input style="pointer-events: none;" type="radio"
                                            {{ $grandChildTransportasi == 'Ambulance' ? 'checked' : '' }} />
                                        <p class="font-semibold">Ambulance</p>
                                    </div>
                                </td>
                            </tr>
                            </td>
                            </tr>
                            <!-- 4 -->
                            <tr>
                                <td class="flex gap-1 border-l border-black pl-4">
                                    <input style="pointer-events: none;" type="checkbox"
                                        {{ in_array('Keadaan umum saat pemulangan', $arrDetail[2]) ? 'checked' : '' }} />
                                    <p class="font-semibold">
                                        Keadaan umum saat pemulangan
                                    </p>
                                </td>
                            </tr>
                            <!-- 5 -->
                            <tr>
                                <td class="flex gap-1 border-l border-black pl-4">
                                    <input style="pointer-events: none;" type="checkbox"
                                        {{ in_array('Format ringkasan pulang/ resume medis yang sudah terisi', $arrDetail[2]) ? 'checked' : '' }} />
                                    <p class="font-semibold">
                                        Format ringkasan pulang/resume medis
                                        yang sudah terisi
                                    </p>
                                </td>
                            </tr>
                            <!-- 6 -->
                            <tr>
                                <td class="flex gap-1 border-l border-black pl-4">
                                    <input style="pointer-events: none;" type="checkbox"
                                        {{ in_array('Pengambilan Hasil Penunjang (Hasil Penunjang Jaringan)', $arrDetail[2]) ? 'checked' : '' }} />
                                    <p class="font-semibold">
                                        Pengambilan hasil penunjang (hasil
                                        pemeriksaan jaringan)
                                    </p>
                                </td>
                            </tr>
                            <!-- 7 -->
                            <tr>
                                <td class="flex gap-1 border-l border-black pl-4">
                                    <input style="pointer-events: none;" type="checkbox"
                                        {{ in_array('Kelengkapan Administrasi', $arrDetail[2]) ? 'checked' : '' }} />
                                    <p class="font-semibold">
                                        Kelengkapan Administrasi:
                                    </p>
                                </td>
                            </tr>
                            <!-- 7.1 -->
                            <tr>
                                <td class="border-l border-b border-black w-full grid grid-cols-3 pl-10 pb-10">
                                    <div class="flex gap-1">
                                        <input style="pointer-events: none;" type="checkbox"
                                            {{ in_array('SKD', $grandChildKelAdmArr) ? 'checked' : '' }} />
                                        <p class="font-semibold">SKD</p>
                                    </div>
                                    <div class="flex gap-1">
                                        <input style="pointer-events: none;" type="checkbox"
                                            {{ in_array('Laboratorium', $grandChildKelAdmArr) ? 'checked' : '' }} />
                                        <p class="font-semibold">
                                            Laboratorium
                                        </p>
                                    </div>
                                    <div class="flex gap-1">
                                        <input style="pointer-events: none;" type="checkbox"
                                            {{ in_array('ECG', $grandChildKelAdmArr) ? 'checked' : '' }} />
                                        <p class="font-semibold">ECG</p>
                                    </div>
                                    <div class="col-start-1 flex gap-1">
                                        <input style="pointer-events: none;" type="checkbox"
                                            {{ in_array('SKI', $grandChildKelAdmArr) ? 'checked' : '' }} />
                                        <p class="font-semibold">SKI</p>
                                    </div>
                                    <div class="flex gap-1">
                                        <input style="pointer-events: none;" type="checkbox"
                                            {{ in_array('Rontgen', $grandChildKelAdmArr) ? 'checked' : '' }} />
                                        <p class="font-semibold">Rontgen</p>
                                    </div>
                                    <div class="flex gap-1">
                                        <input style="pointer-events: none;" type="checkbox"
                                            {{ in_array('CT Scan', $grandChildKelAdmArr) ? 'checked' : '' }} />
                                        <p class="font-semibold">CT-Scan</p>
                                    </div>
                                </td>
                            </tr>
                        </div>
                    </tbody>
                </table>
            </section>
            <section>
                <div class="flex font-semibold text-sm">
                    <p>NB:</p>
                    <div>
                        <ul>
                            <li>
                                *&#41; <span class="font-bold">SKD</span> :
                                Surat Keterangan Dirawat, SKI : Surat
                                Keterangan Istirahat
                            </li>
                            <li>
                                *&#41; Aktifitas, Edukasi dan Latihan
                                dipilih sesuai dengan kebutuhan pasien
                            </li>
                        </ul>
                    </div>
                </div>
            </section>
            <section class="grid grid-cols-2 justify-items-center pt-10 pb-20 font-semibold">
                <div class="flex col-start-2 gap-x-2">
                    <p>Padang,</p>
                    <input type="text" placeholder="____________________" class="w-32"
                        value="{{ $tgl->format('d F Y') ?? '' }}" />
                    <p>Pukul</p>
                    <input type="text" placeholder="_________" class="w-10"
                        value="{{ $tgl->format('H:i') ?? '' }}" />
                </div>
                <div class="col-start-1 row-start-2">
                    <p>Pasien / Keluarga Pasien</p>
                </div>
                <div>
                    <p>Perawat Penanggung Jawab Pasien</p>
                </div>
                <div class="row-start-4">
                    (<input class="text-center" type="text"
                        placeholder="...................................................."
                        value="{{ $item->pasien_name ?? '' }}" />)
                </div>
                <div class="row-start-4">
                    (<input class="text-center" type="text"
                        placeholder="...................................................."
                        value="{{ $item->petugas_name ?? '' }}" />)
                </div>
                <div class="col-start-1 row-start-3">
                    <img src="{{ asset('storage/' . $item->ttd_pasien) }}" class="img-thumbnail" alt="">
                </div>
                <div class="col-start-2 row-start-3">
                    <img src="{{ asset('storage/' . $item->ttd_petugas) }}" class="img-thumbnail" alt="">
                </div>
            </section>
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
