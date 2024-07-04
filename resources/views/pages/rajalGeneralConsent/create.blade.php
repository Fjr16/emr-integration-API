@extends('layouts.backend.main')

@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">General Consent Pasien
                <span class="text-primary">{{ $item->patient->name ?? '' }}</span>
            </h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('rajal/general/consent.store', $item->id) }}">
                @csrf
                <div class="row">
                    <div class="col-12 mb-2">
                        Persetujuan Umum (General Consent) diisi oleh pasien atau keluarga yang berusia ≥ 18 tahun.
                        Pasien, Keluarga dan atau Wali selaku kuasa dari pasien diminta untuk membaca, memahami dan mengisi informasi berikut :
                        <p class="pt-2">
                            Yang bertanda tangan di bawah ini :
                        </p>
                    </div>
                    <div class="col-md-6">
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Nama</label>
                            <div class="col-sm-7">
                                <input type="text" name="name" class="form-control" id="basic-default-name"
                                    value="{{ $item->patient->name ?? '' }}" @required(true)>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Tanggal Lahir</label>
                            <div class="col-sm-7">
                                <input type="date" name="tgl_lhr" class="form-control" id="basic-default-name"
                                    value="{{ $item->patient->tanggal_lhr ?? '' }}" @required(true)>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Jenis Kelamin</label>
                            <div class="col-sm-7">
                                <select class="form-control select2" name="kelamin" @required(true)>
                                    @foreach ($kelamin as $sex)
                                        @if ($item->patient->jenis_kelamin == $sex)
                                            <option value="{{ $sex }}" selected>{{ $sex }}</option>
                                        @else
                                            <option value="{{ $sex }}">{{ $sex }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Alamat</label>
                            <div class="col-sm-7">
                                <input type="text" name="alamat" class="form-control" id="basic-default-name"
                                    value="{{ $item->patient->alamat ?? '' }}" @required(true)>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Telpon</label>
                            <div class="col-sm-7">
                                <input type="number" name="phone" class="form-control" id="basic-default-name"
                                    value="{{ $item->patient->telp ?? '' }}" @required(true)>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Hubungan Dengan Pasien</label>
                            <div class="col-sm-7">
                                <select class="form-control select2" name="hubungan" id="hubungan" @required(true)>
                                    @foreach ($status as $stat)
                                        @if ($stat == 'Diri Sendiri')
                                            <option value="{{ $stat }}" selected>{{ $stat }}</option>
                                        @else
                                            <option value="{{ $stat }}">{{ $stat }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <input type="text" class="form-control mt-2" name="lainnya" id="inputLainnya"
                                    style="display: none;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    dengan ini menyatakan persetujuan :
                </div>
                <div class="">
                    <h6 class="text-center bg-dark text-white py-2">PERSETUJUAN UNTUK PERAWATAN DAN PENGOBATAN</h6>
                    <ol>
                        <li> Saya menyetujui untuk perawatan di RSK Bedah Ropanasuri sebagai pasien rawat jalan tergantung
                            kepada rencana asuhan sesuai dengan kebutuhan pasien.</li>
                        <li>
                            Saya mengetahui bahwa saya memiliki kondisi yang membutuhkan perawatan medis, saya mengizinkan
                            dokter dan profesional kesehatan lainnya untuk melakukan prosedur diagnostik dan untuk
                            memberikan
                            pengobatan medis seperti yang diperlukan dalam profesional mereka. Prosedur diagnostik dan
                            perawatan
                            medis termasuk terapi tidak terbatas pada electrocardiogram, x-ray (radiologi), tes darah,
                            terapi
                            fisik, pemberian obat (kecuali yang membutuhkan persetujuan khusus / tertulis), perawatan rutin
                            dan
                            prosedur seperti pemasangan infus. pemasangan kateter, spalak, pemberian oksigen, dan suntikan.
                        </li>
                        <li>Saya sadar bahwa praktik kedokteran bukanlah ilmu pasti dan saya mengakui bahwa tidak ada
                            jaminan
                            atas hasil apapun, terhadap perawatan prosedur atau pemeriksaan apapun yang dilakukan kepada
                            saya.
                        </li>
                        <li>
                            Persetujuan yang saya berikan tidak termasuk prosedur pembedahan atau tindakan invasif,
                            anestesi,
                            sedasi, penggunaan darah dan produk darah, perataan atau tindakan berisiko tinggi maka
                            diperlukan
                            persetujuan tindakan secara terpisah (informed consent).
                        </li>
                        <li>Saya mengerti dan memahami bahwa:</li>


                        <ol type="a">
                            <li>
                                Saya memiliki hak untuk mendapatkan akses terhadap informasi kesehatan saya dan mengajukan
                                pertanyaan tentang pengobatan yang diusulkan (termasuk identitas setiap orang yang
                                memberikan
                                atau mengamati pengobatan) setiap saat.
                            </li>
                            <li>
                                Saya mengerti dan memahami bahwa saya memiliki hak untuk menyetujui atau menolak
                                persetujuan,
                                untuk setiap prosedur / terapi dan saya memahami dan menyadari bahwa RSK Bedah Ropanasuri
                                atau
                                dokter tidak bertanggung jawab atas hasil yang merugikan saya.
                            </li>
                        </ol>
                    </ol>
                </div>
                <div class="">
                    <h6 class="text-center bg-dark text-white py-2">
                        HAK DAN TANGGUNG JAWAB PASIEN
                    </h6>
                    <ol>
                        <li>
                            Saya memiliki hak untuk mengambil bagian dalam keputusan mengenai penyakit saya dan dalam hal
                            perawatan medis dan rencana pengobatan.
                        </li>
                        <li>
                            Saya telah mendapat informasi tentang "Hak dan Tanggung jawab Pasien di RSK Bedah Ropanasuri
                            Padang
                            melalu banner, leaflet, dan form tertulis yang disediakan oleh petugas.
                        </li>
                    </ol>
                </div>
                <div class="">
                    <h6 class="text-center bg-dark text-white py-2">
                        KEBUTUHAN PRIVASI
                    </h6>
                    <p class="d-flex">
                        Saya
                        <span class="col-sm-2 mx-2">
                            <select class="form-control form-control-sm" name="kebutuhan_privasi1" @required(true)>
                                <option value="mengizinkan"
                                    {{ $item->kebutuhan_privasi1 == 'mengizinkan' ? 'selected' : '' }}>mengizinkan</option>
                                <option value="tidak mengizinkan"
                                    {{ $item->kebutuhan_privasi1 == 'tidak mengizinkan' ? 'selected' : '' }}>tidak
                                    mengizinkan</option>
                            </select>
                        </span>
                        RSK Bedah Ropanasuri untuk difoto/direkam dan dikutsertakan dalam survei.
                    </p>
                    <div class="mb-3">
                        <p class="d-flex">
                            Saya
                            <span class="col-2 mx-2">
                                <select class="form-control form-control-sm" name="kebutuhan_privasi2" @required(true)>
                                    <option value="menginginkan"
                                        {{ $item->kebutuhan_privasi2 == 'menginginkan' ? 'selected' : '' }}>menginginkan
                                    </option>
                                    <option value="tidak menginginkan"
                                        {{ $item->kebutuhan_privasi2 == 'tidak menginginkan' ? 'selected' : '' }}>tidak
                                        menginginkan</option>
                                </select>
                            </span>
                            privasi khusus sebutkan bila ada permintaan privasi khusus
                        </p>
                        <input type="text" name="kebutuhan_privasi_khusus" class="form-control" id="basic-default-name"
                            value="{{ $item->kebutuhan_privasi_khusus ?? '' }}">
                    </div>
                </div>
                {{-- page2 --}}
                <div class="">
                    <h6 class="text-center bg-dark text-white py-2">
                        HARTA BENDA MILIK PASIEN
                    </h6>
                    <ol>
                        <li>
                            Saya telah memahami bahwa RSK Bedah Ropanasuri bertanggung jawab atas semua harta benda yang
                            dibawa pasien ODC (Pelayanan Satu Hani) pasien rawat inap, serta untuk pasien yang tidak mampu
                            mengamb keputusan untuk menjaga keamanan harta benda mereka karena tidak sadarkan diri atau
                            tidak didampingi penunggu. Dan apabila saya membutuhkan, maka saya dapat menitipkan
                            barang-barang saya kepada Rumah Sakit
                        </li>
                        <li>
                            Saya secara pribadi bertanggung jawab atas barang-barang berharga yang saya miliki namun tidak
                            terbatas pada uang, perhiasan, buku, kartu ATM, kartu kredit, handphone atau barang lainnya. Dan
                            apabila saya membutuhkan maka saya dapat menitipkan barang-barang saya kepada Rumah Sakit
                        </li>
                    </ol>
                </div>
                <div class="">
                    <h6 class="text-center bg-dark text-white py-2">
                        PERSETUJUAN PELEPASAN INFORMASI
                    </h6>
                    <ol>
                        <li>
                            Saya memahami informasi yang ada di dalam diri saya, termasuk diagnosis, hasil laboratorium, dan
                            hasil tes diagnostik yang akan digunakan untuk perawatan medis, RSK Bedah Ropanasuri akan
                            menjamin
                            kerahasiaannya.
                        </li>
                        <li>
                            Saya memberi wewenang kepada RSK Bedah Ropanasuri untuk memberikan informasi tentang rahasia
                            kedokteran saya bila diperlukan untuk memproses klaim Asuransi termasuk namun tidak terbatas
                            pada
                            BPJS Kesehatan, BPJS Ketenagakerjaan, asuransi kesehatan lainnya, Perusahaan, Dinas Kesehatan,
                            atau
                            Lembaga Pemerintah lainnya.
                        </li>
                        <li>
                            <p class="d-flex mb-1">
                                Saya
                                <span class="mx-1 col-1">
                                    <select class="form-control form-control-sm" name="persetujuan_pelepasan_informasi">
                                        <option value="ya"
                                            {{ $item->persetujuan_pelepasan_informasi == 'ya' ? 'selected' : '' }}>
                                            menyetujui
                                        </option>
                                        <option value="tidak"
                                            {{ $item->persetujuan_pelepasan_informasi == 'tidak' ? 'selected' : '' }}>tidak
                                            menyetujui</option>
                                    </select>
                                </span>
                                pelepasan informasi (diagnosis, hasil pelayanan, dan pengobatan) terkait perawatan saya
                                kepada
                                anggota keluarga saya (termasuk kondisi kritis atau situasi tertentu),
                            </p>

                            <div class="ms-2">
                                {{-- Lainnya --}}
                                <div class="mb-0 mt-2 adime">
                                    <div class="d-flex flex-row mb-1">
                                        <div class="">
                                            {{-- <input type="text" class="form form-control form-control-sm"
                                                id="ekstremitasBawah" name="ekstremitasBawah[]"> --}}
                                            <div class="d-flex flex-row">
                                                nama :
                                                <span class="mx-2">
                                                    <input type="text" class="form-control form-control-sm"
                                                        name="persetujuan_name[]">
                                                </span>
                                                hubungan dengan pasien :
                                                <span class="mx-2">
                                                    <input type="text" class="form-control form-control-sm"
                                                        name="persetujuan_hub[]">
                                                </span>
                                            </div>
                                        </div>
                                        <div class="">
                                            <button type="button" class="btn btn-sm btn-dark"
                                                onclick="addPersetujuan(this)"><i class="bx bx-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                {{-- end Lainnya --}}
                                {{-- <p class="d-flex">
                                    nama :
                                    <span class="col-2 mx-2">
                                        <input type="text" class="form-control form-control-sm" id="nama"
                                            value="{{ $item->name ?? '' }}" disabled>,
                                    </span>
                                    hubungan dengan pasien :
                                    <span class="col-2 mx-2">
                                        <input type="text" class="form-control form-control-sm" id="hub"
                                            value="{{ $item->hubungan ?? '' }}" disabled>
                                    </span>
                                </p> --}}
                            </div>
                        </li>
                    </ol>
                </div>
                <div class="">
                    <h6 class="text-center bg-dark text-white py-2">
                        PENDAPAT KEDUA (SECOND OPINION)
                    </h6>
                    <p>
                        RSK Bedah Ropanasuri memfasilitasi permintaan pasien untuk mencari pendapat kedua (second opinion)
                        tanpa perlu khawatir akan mempengaruhi perawatannya selama di dalam/luar Rumah Sakit
                    </p>
                </div>
                <div class="">
                    <h6 class="text-center bg-dark text-white py-2">
                        PENYAMPAIAN KELUHAN/PENDAPAT SELAMA PERAWATAN
                    </h6>
                    <p>
                        RSK Bedah Ropanasuri meneydiakan fasilitas kepada pasien dan keluarga untuk menyampaikan
                        keluhan/pendapat sejak pasien mengakses pelayanan, selama menjalani masa perawatan dan pada proses
                        pemulangan melalui:
                    </p>
                    <p>
                        a. Pengisian kotak saran yang berada di IGD/Rawat jalan/Rawat Inap
                    </p>
                    <p>
                        b. Melalul layanan pengaduan di Aplikasi WhatsApp: 0812-6729-2974
                    </p>
                </div>
                <div class="">
                    <h6 class="text-center bg-dark text-white py-2">
                        INFORMASI TATA TERTIB BAGI PASIEN, PENGUNJUNG DAN PENUNGGU PASIEN
                    </h6>
                    <p>
                        Saya telah menerima informasi tentang tata tertib yang diberlakukan oleh RSK Bedah Ropanasuri dan
                        saya beserta keluarga bersedia untuk mematuhinya.
                    </p>
                </div>
                <div class="">
                    <h6 class="text-center bg-dark text-white py-2">
                        INFORMASI BIAYA
                    </h6>
                    <p>
                        Pasien umum / pribadi pembiayaan yang dikenakan mengacu kepada tarif pelayanan yang ada di RSK Bedah
                        Ropanasuri Padang.
                    </p>
                </div>
                <div class="">
                    <h6 class="text-center bg-dark text-white py-2">
                        PERSETUJUAN UMUM (GENERAL CONSENT)
                    </h6>
                    <p class="fw-bold">
                        Dengan tanda tangan saya dibawah ini, saya menyatakan bahwa saya telah menerima informasi, membaca,
                        dan memahami item pada Persetujuan Umum / General Consent.
                    </p>
                </div>

                {{-- ttd --}}
                <div class="row mb-3">
                    <div class="col-4 text-center">
                        Petugas Admisi
                    </div>
                    <div class="col-4"></div>
                    <div class="col-4 text-center">
                        Padang, {{ date('d  M  Y') }} <br>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 text-center">
                        <img src="" alt="" id="ImgTtdPpj">
                        <textarea id="ttdPpj" name="ttd_admisi" style="display: none;"></textarea>
                        <button type="button" class="col-12 btn btn-sm btn-dark" onclick="openModal(this)">Tanda
                            Tangan</button>
                    </div>
                    <div class="col-4"></div>
                    <div class="col-4 text-center">
                        <img src="" alt="" id="ImgTtdKeluargaPasien">
                        <textarea id="ttd" name="ttd" style="display: none;"></textarea>
                        <button type="button" class="col-12 btn btn-sm btn-dark"
                            onclick="openModalTtdBottom(this, 'ImgTtdKeluargaPasien', 'ttd')">Tanda
                            Tangan</button>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-4 text-center">
                        <input type="text" class="form-control form-control-sm text-center"
                            value="{{ auth()->user()->name ?? '' }}" disabled>
                    </div>
                    <div class="col-4"></div>
                    <div class="col-4 text-center">
                        <input type="text" class="form-control form-control-sm text-center" id="nameTtd"
                            value="{{ $item->patient->name ?? '' }}" disabled>
                    </div>
                </div>
                <div class="col-sm-10 mt-2">
                    <button type="submit" class="btn btn-sm btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>

    {{-- modal create ttd --}}
    <div class="modal fade" id="signaturePadModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    {{-- <h5 class="modal-title" id="modalScrollableTitle">TATA TERTIB</h5> --}}
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="modal-title" id="modalScrollableTitle">TATA TERTIB RUMAH SAKIT</h5>
                    <table class="table-bordered w-100 mt-2">
                        <tbody>
                            <tr class="bg-secondary">
                                <td class="fw-bold text-center text-white">
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
                                            Pasien tidak diperkenankan membawa obat-obatan tanpa sepengetahuan dokter /
                                            perawat selama
                                            perawatan.
                                        </li>
                                        <li>
                                            Pasien dan keluarga tidak diperkenankan membawa fasilitas Rumah Sakit keluar
                                            dari Rumah Sakit.
                                        </li>
                                        <li>
                                            Pasien berhak didampingi oleh 1 (satu) orang anggota keluarga pada saat
                                            konsultasi.
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
                            {{-- <tr>
                                <td>
                                    <p class="m-0 fw-bold">
                                        Dengan tanda tangan saya dibawah ini, saya
                                        menyatakan bahwa saya telah menerima
                                        informasi, membaca, dan memahami item pada
                                        Tata Tertib RSK Bedah
                                        Ropanasuri.
                                    </p>
                                </td>
                            </tr> --}}
                        </tbody>
                    </table>

                    <h5 class="modal-title mt-3" id="modalScrollableTitle">HAK DAN KEWAJIBAN PASIEN</h5>
                    <table class="table-bordered w-100 mt-2">
                        <tbody>
                            <tr class="bg-secondary">
                                <td class="fw-bold text-center text-white">
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
                                <td class="fw-bold text-center text-white">
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
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <p>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="checkTtd">
                        <label class="form-check-label small fst-italic fw-bold" for="checkTtd">
                            Dengan ini menyatakan bahwa saya telah membaca, memahami tata tertib serta hak dan
                            kewajiban rumah sakit.
                        </label>
                    </div>
                    </p>

                    <div class="d-flex flex-row justify-content-end">
                        <div id="signature-pad" class="m-signature-pad" style="display: none;">
                            <div class="m-signature-pad--body">
                                <canvas style="border: 3px dashed #ccc"></canvas>
                            </div>

                            <div class="m-signature-pad--footer">
                                <button type="button" class="btn btn-sm btn-secondary"
                                    data-action="clear">Clear</button>
                                <button type="button" class="btn btn-sm btn-primary" data-action="save">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="modal-header">
                    <h5 class="modal-title" id="modalScrollableTitle">Signature Pad</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div> --}}
                {{-- <div class="modal-body">
                    <div id="signature-pad" class="m-signature-pad">
                        <div class="m-signature-pad--body">
                            <canvas style="border: 3px dashed #ccc"></canvas>
                        </div>

                        <div class="m-signature-pad--footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-action="clear">Clear</button>
                            <button type="button" class="btn btn-sm btn-primary" data-action="save">Save</button>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>

    {{-- modal get ttd --}}
    <div class="modal fade" id="getTtdModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalScrollableTitle">Masukkan Password Akun Anda</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div id="signature-pad" class="m-signature-pad">
                        <div class="m-signature-pad--body mb-3">
                            <input type="password" class="form-control form-control-sm" name="password_user">
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        </div>

                        <div class="m-signature-pad--footer">
                            <button type="button" class="btn btn-sm btn-secondary"
                                data-action="clearInput">Clear</button>
                            <button type="button" class="btn btn-sm btn-primary" data-action="saveInput">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let tempElementImage;
        let tempTextArea;

        function openModal(element) {
            $('#getTtdModal').modal('show');
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


            // start get ttd from user table
            var modal = document.getElementById("getTtdModal");
            var clearButtonInput = modal.querySelector("[data-action=clearInput]");
            var saveButtonInput = modal.querySelector("[data-action=saveInput]");
            var inputPass = modal.querySelector('input[name="password_user"]');
            var inputUserId = modal.querySelector('input[name="user_id"]');

            saveButtonInput.addEventListener("click", function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'get',
                    url: "{{ route('ranap/cppt.getTtd') }}",
                    data: {
                        user_id: inputUserId.value,
                        password: inputPass.value,
                    },
                    success: function(data) {
                        var newSrc = `{{ Storage::url('${data}') }}`;
                        $('#ImgTtdPpj').attr('src', newSrc);
                        $('#ttdPpj').val(data);
                        $('#petugas_name').val(`{{ auth()->user()->name }}`);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log();
                        var errorResponse = jqXHR.responseJSON;
                        if (errorResponse && errorResponse.error) {
                            alert(errorResponse.error)
                        } else {
                            alert('Terjadi Kesalahan Dalam Pengambilan Data');
                        }
                    }
                });

                inputPass.value = '';

                $('#getTtdModal').modal('hide');
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            var name = document.querySelector('input[name="name"]');
            var namaDis = document.getElementById('nama');
            var nameTtd = document.getElementById('nameTtd');

            name.addEventListener('change', function() {
                namaDis.value = name.value;
                nameTtd.value = name.value;
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            // Inisialisasi elemen select2
            $('.select2').select2();

            const hubunganSelect = document.getElementById('hubungan');
            const inputLainnya = document.getElementById('inputLainnya');

            // Tambahkan event listener pada perubahan nilai di elemen select2
            $('#hubungan').on('change', function() {
                $(this).select2('close');
                // Dapatkan nilai yang terpilih dengan Select2
                var selectedValue = $(this).val();

                // Tampilkan inputLainnya jika nilai yang dipilih adalah 'Lainnya'
                if (selectedValue === 'Lainnya') {
                    inputLainnya.style.display = 'block';
                } else {
                    inputLainnya.style.display = 'none';
                }

                // Tetapkan nilai terpilih ke elemen input dengan id 'hub'
                var hubDis = document.getElementById('hub');
                hubDis.value = selectedValue;

                // Tutup dropdown Select2 setelah memilih nilai
            });
        });
    </script>

    <script>
        function addPersetujuan(element) {
            var adimeClass = element.closest('.adime');
            var div = document.createElement('div');
            div.className = 'd-flex flex-row mb-1';
            div.innerHTML = `
                <div class="">
                    <div class="d-flex flex-row">
                        nama :
                        <span class="mx-2">
                            <input type="text" class="form-control form-control-sm" name="persetujuan_name[]">
                        </span>
                        hubungan dengan pasien :
                        <span class="mx-2">
                            <input type="text" class="form-control form-control-sm" name="persetujuan_hub[]">
                        </span>
                    </div>
                </div>
                <div class="">
                    <button type="button" class="btn btn-sm btn-danger" onclick="deleteForm(this)"><i class="bx bx-minus"></i></button>
                </div>
            `;
            adimeClass.appendChild(div);
        }

        function deleteForm(element) {
            var div = element.closest('.d-flex.flex-row.mb-1');
            div.remove();
        }
    </script>

    <script>
        function deleteForm(element) {
            var row = element.closest('.d-flex');
            row.remove();
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const checkbox = document.getElementById('checkTtd');
            const signatureContainer = document.getElementById('signature-pad');

            checkbox.addEventListener('change', function() {
                if (checkbox.checked) {
                    signatureContainer.style.display = '';
                } else {
                    signatureContainer.style.display = 'none';
                }
            });
        });
    </script>
@endsection
