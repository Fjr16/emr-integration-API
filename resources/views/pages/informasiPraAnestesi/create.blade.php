@extends('layouts.backend.main')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content; left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="card p-3 mt-5 ">

        <div class="d-flex">
            <h4 class="align-self-center m-0">EDUKASI PASIEN PRA ANESTESI INFORMASI TENTANG ANESTESI DAN SEDASI MENENGAH
                DALAM



            </h4>
            {{-- <div class="ms-auto">
                <a href="{{ route('farmasi/obat/konversi.create') }}" class="btn btn-success btn-sm m-0">+ Tambah Konversi</a>
                <a href="{{ route('farmasi/obat/master/konversi.create') }}" class="btn btn-success btn-sm m-0 mx-2">+ Tambah
                    Satuan</a>
            </div> --}}
        </div>
        <hr class="m-0 mt-2 mb-3">
        <form action="{{ route('edukasi/pasien/pra/anestesi.store', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
            @csrf
            <div class="card-body">



                <h3 class="py-1 bg-dark text-white fw-bold text-center">INFORMASI TENTANG ANESTESI</h3>

                <h5 class="fw-bold">Pilih / Check kotak yang tersedia, sesuai kondisi pasien</h5>



                <div>
                    <div class="form-check form-check-inline mt-3 ">
                        <input class="form-check-input" type="checkbox" id="Anestesi_umum" value="ANESTESI UMUM" name="anestesiCheck[]" />
                        <div class="px-2">
                            <label class="form-check-label fw-bold fs-6" for="Anestesi_umum">ANESTESI UMUM</label>
                            <p class="text-justify">Anestesi umum adalah teknik pembiusan dengan bius total dimana pasien
                                tidak sadar, tidak dapat dirangsang
                                dan tidak merasakan sakit. Obat anestesi untuk anestesi umum berupa obat suntik dan votile
                                agent, terutama
                                pada bayi / anak. Lama kerja obat disesuaikan dengan lama operasi. Sesuai dengan kebutuhan
                                operasi dan
                                kondisi pasien, teknik ini akan mempengaruhi untuk mempertahankan patensi jalan napas,
                                terjadi depresi
                                fungsi pernapasan spontan atau depresi fungsi otot. Sehingga, pasien sering memerlukan
                                pemasangan alat
                                pernapasan patensi jalan napas dan pemberian napas bantuan
                            </p>


                            <ol type="1">
                                <li>
                                    <span class="fw-semibold">Kelebihan Teknik Anestesi Umum :</span>
                                    <ol type="a">
                                        <li>Sedasi, analgesik dan relaksasi bisa tercapai dengan baik</li>
                                        <li>Teknik dan lama pembiusan bias disesuaikan dengan prosedur bedah</li>
                                    </ol>
                                </li>
                                <li class="mt-2">
                                    <span class="fw-semibold">Kekurangan Teknik Anestesi Umum :</span>
                                    <ol type="a">
                                        <li>Pasca bedah, pasien harus sadar penuh sebelum bisa diberi minum</li>
                                        <li> Obat bius yang diberikan dapat memiliki efek keseluruh tubuh termasuk ke aliran
                                            pembuluh janin
                                            dalam kandungan </li>
                                    </ol>
                                </li>
                                <li class="mt-2">
                                    <span class="fw-semibold">Komplikasi / efek samping Teknik Anestesi Umum : :</span>
                                    <ol type="a">
                                        <li>Efek samping pasca bedah berupa <em>nausea / vomitus</em>, menggigil, pusing,
                                            mengantuk, sakit tenggorokan
                                            yang bisa diatas dengan obat-obatan</li>
                                        <li> Beresiko pada pasien yang tidak puasa, bisa terjadi aspirasi yaitu masuknya isi
                                            lambung kejalan nafas /
                                            paru</li>
                                        <li>Kesulitan ventilasi dan intubasi yang tidak terduga sebelumnya</li>
                                        <li>Alergi / hipersensitif terhadap obat (sangat jarang), mulai derajat ringan
                                            hingga berat/fatal</li>
                                    </ol>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>



                <div class="mt-3">
                    <div class="form-check form-check-inline mt-3 ">
                        <input class="form-check-input" type="checkbox" id="Anestesi_spinal" value="ANESTESI SPINAL / EPIDURAL" name="anestesiCheck[]" />
                        <div class="px-2">
                            <label class="form-check-label fw-bold fs-6" for="Anestesi_spinal">ANESTESI SPINAL /
                                EPIDURAL</label>
                            <ul type="disc">
                                <li class="text-justify">
                                    Anastesi spinal / epidural adalah pembiusan yang hanya meliputi daerah perut ke bawah
                                    (perut sampai
                                    ujung kaki) dengan pasien tetap sadar tanpa merasakan nyeri. Bila pasien menginginkan
                                    untuk tidur maka
                                    dokter dapat memberi obat tidur/penenang melalui suntikan. Obat bius yang dipakai adalah
                                    obat bius lokal
                                    (anestesi lokal) dan bisa ditambah dengan obat lain yang bisa menambah kekuatan obat
                                    maupun menambah
                                    lama kerja obat bius lokal. Untuk anestesi spinal, obat bius lokal tersebut disuntikkan
                                    dengan jarum spinal
                                    melalui celah intervertebrata di daerah punggung.
                                </li>
                                <li class="text-justify mt-2">
                                    Untuk anestesi epidural di daerah punggung , penyuntikkan didahului dengan pemberian
                                    obat bius lokal dan
                                    melalui jarum epidural yang disuntikkan dengan pemberian obat bius lokal dan melalui
                                    jarum epidural yang
                                    disuntikkan <em>intervertebre</em> dicelah dan akan dimasukkan kateter epidural yang
                                    berfungsi untuk menyalurkan
                                    obat ke sekitar saraf yang ada dipinggir tulang belakang.
                                </li>
                            </ul>
                            <div class="ms-3">
                                <p class="text-justify">
                                    Pada kedua teknik diatas, penyuntikkan dilakukan pada pasien dalam keadaan posisi duduk
                                    membungkuk atau
                                    miring ke salah satu sisi dengan kudua tungkai dilipat ke perut dan kepala menunduk.
                                    Pada waktu penyuntikkan
                                    obat, akan terasa hangat dipunggung. Setelah obat masuk, pada awalnya akan merasakan
                                    kesemutan pada
                                    tungkai dan pada akhirnya kedua tungkai tidak dapat digerakkkan, seolah-olah tungkainya
                                    hilang. Pada awalnya
                                    dibagian perut pasien masih bisa merasakan sentuhan, gosokan, dan tarikan, tapi lama
                                    kelamaan akan tidak
                                    merasakan apa-apa lagi. Hilang rasa ini berlangsung kira-kira 2 sampai 3 jam sesuai
                                    jenis obat anestesi lokal yang
                                    digunakan.

                                </p>
                            </div>


                            <ol type="1">
                                <li>
                                    <span class="fw-semibold"> Kelebihan Teknik Anestesi Spinal / Epidural :</span>
                                    <ol type="a">
                                        <li>Jumlah obat yang diberikan sedikit sekali (untuk epidural jumlah obat lebih
                                            banyak</li>
                                        <li>Obat bius tidak masuk ke dalam sirkulasi ari-ari /rahim sehingga baik untuk
                                            operasi cesar</li>
                                        <li> Obat bius tidak memperngaruhi organ lain dalam tubuh </li>
                                        <li> Bisa ditambahkan obat menghilangkan rasa sakit yang bisa bertahan hingga 24 jam
                                            pasca bedah (untuk
                                            epidural bisa ditambah terus obat anti sakit sesuai kebutuhan)
                                        </li>
                                        <li>Bila tidak mual / muntah pasca bedah bisa langsung minum tanpa menunggu flatus
                                            (buang angin)</li>
                                        <li> Lebih aman untuk pasien yang tidak puasa / operasi darurat. </li>
                                    </ol>
                                </li>
                                <li>
                                    Kelemahan teknik Anestesi Spinal / Epidural : pasca bedah harus berbaring, tidak boleh
                                    duduk / bangun
                                    selama 6 jam.
                                </li>
                                <li>
                                    <span>Komplikasi / efek samping Teknik Anestesi Spinal / Epidural :</span>
                                    <ol type="a">
                                        <li>
                                            Efek samping pasca bedah yang sering adalah nausea / vomitus, gatal di area
                                            wajah, semua bisa diatasi
                                            dengan obat-obatan.
                                        </li>
                                        <li>
                                            Efek samping yang jarang adalah sakit kepala dibagian depan atau belakang kepala
                                            pada hari ke 2 / ke 3
                                            terutama pada waktu mengangkat kepala dan menghilang 5 sampai 7 hari.
                                        </li>
                                        <li>
                                            Efek samping lain berupa kesulitan buang air kecil.
                                        </li>
                                        <li>
                                            Alergi hipersensitif terhadap obat (sangat jarang), mulai derajat ringan hingga
                                            berat / fatal.
                                        </li>
                                        <li>
                                            Gangguan pernapasan mulai dari ringan (terasa pernapasannya agak berat) sampai
                                            berat (henti napas).
                                        </li>
                                        <li>
                                            Kelumpuhan atau kesemutan / rasa baal ditungkai yang memanjang bersifat
                                            sementara dan bisa sembuh
                                            kembali.
                                        </li>
                                        <li>
                                            Untuk epidural bisa terjadi kejang bila obat masuk kedalam pembuluh darah
                                            (jarang terjadi) dan dapat
                                            ditangani sesuai prosedur tanpa gejelas sisa.
                                        </li>
                                    </ol>
                                </li>

                            </ol>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="form-check form-check-inline mt-3 ">
                        <input class="form-check-input" type="checkbox" id="BLOK_PERIFER" value="BLOK PERIFER" name="anestesiCheck[]" />
                        <div class="px-2">
                            <label class="form-check-label fw-bold fs-6" for="BLOK_PERIFER">BLOK PERIFER</label>
                            <p class="text-justify">Blok perifer adalah teknik pembiusan yang hanya melibatkan sebagian
                                tubuh saja (misalnya lengan atau bawah,
                                tungkai, kaki dan sebagainya). Teknik ini dilakukan dengan menyuntikkan obat bius lokal di
                                daerah sekitar saraf
                                yang mensarafi bagian tubuh yang akan dioperasi. Pada saat mencari lokasi saraf yang akan
                                disuntik mungkin
                                akan merasakan sedikit nyeri. Kadang bila saraf sudah terkena maka akan terasa seperti
                                kesetrum di bagian
                                tubuh yang akan dioperasi. Demikian juga pada saat penyuntikkan obat bius lokal akan terasa
                                nyeri, tapi lama
                                kelamaan bagian tubuh yang dioperasi akan terasa kesemutan dan akhirnya terasa berat sampai
                                tidak bisa
                                digerakkan. Efek bius berlangsung antara 2 - 4 jam tergantung jenis obat yang dipakai.


                            <p>Komplikasi / efek samping teknik anestesi Blok Perifer :</p>
                            <ol type="a">
                                <li>
                                    Parestesia dan atau gangguna motorik yang berkepanjangan tetapi reversibel
                                </li>
                                <li>Hematom</li>
                                <li>Pneumothoraks</li>
                                <li>Pembiusan yang tidak komplit (sebagian tubuh terbius)</li>
                                <li>Reaksi alergi atau hipersensitif yang ringan hingga berat (fatal)
                                </li>
                                <li> Kejang bila obat masuk kedalam pembuluh darah yang dapat ditangani sesuai prosedur
                                    tanpa gejala sisa.
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>





                <div>
                    <div class="form-check form-check-inline mt-3 ">
                        <input class="form-check-input" type="checkbox" id="NESTESI_TOPIKAL" value="ANESTESI TOPIKAL"  name="anestesiCheck[]"/>
                        <div class="px-2">
                            <label class="form-check-label fw-bold fs-6" for="NESTESI_TOPIKAL">ANESTESI TOPIKAL</label>
                            <p class="text-justify">Anestesi topikal adalah teknik pembiusan yang hanya melibatkan bagian
                                tubuh tertentu saja (misalnya mata,
                                gusi, dll). Teknik pembiusan dilakukan dengan memberikan obat bius tetes / spray / jelly
                                pada bagian yang akan
                                dibius. Efek bius berlangsung kira-kira 15 - 30 menit tergantung jenis obat yang dipakai.
                            <p>Komplikasi / efek samping teknik anestesi Topikal hampir tidak pernah ditemukan.</p>
                        </div>
                    </div>
                </div>


                <div>
                    <ul type="disc">
                        <li>
                            <span class="fw-bold">Sedasi ringan :</span>
                            <span>adalah teknik pembiusan dengan penyuntikan obat yang dapat menyebabkan pasien mengantuk,
                                tetapi masih memiliki respon normal terhadap rangsangan verbal dan tetap dapat
                                mempertahankan patensi dari
                                jalan nafasnya, sedang fungsi pernapasan dan kerja jantung serta pembuluh dara tidak
                                dipengaruhi.</span>
                        </li>
                        <li>
                            <span class="fw-bold">Sedasi sedang :</span>
                            <span>adalah teknik pembiusan dengan penyuntikan obat yang dapat menyebabkan pasien mengantuk,
                                tetapi masih memiliki respon terhadap rangsangan verbal, dapat diikuti atau tidak diikuti
                                oleh rangsangan tekan
                                yang ringan dan pasien masih dapat menjaga patensi jalan napasnya sendiri. Pada sedasi
                                moderat terjadi
                                perubahan ringan dari respon pernapasan namun fungsi kerja jantung serta pembuluh darah
                                masih tetap
                                dipertahankan dalam keadaan normal. Pada sedasi moderat dapat diikuti gangguan orientasi
                                lingkungan serta
                                gangguan fungsi motorik ringan sampai sedang</span>
                        </li>
                        <li>
                            <span class="fw-bold">Sedasi dalam :</span>
                            <span>adalah teknik pembiusan dengan penyuntikan obat yang dapat menyebabkan pasien mengantuk,
                                tidur, serta tidak mudah dibangunkan tetapi masih memberikan respon terhadap rangsangan
                                berulang atau
                                rangsangan nyeri. Respon pernapasan sudah mulai terganggu dimana napas spontan sudah mulai
                                tidak adekuat
                                dan pasien tidak dapat mempertahankan patensi dari jalan napasnya (mengakibatkan hilangnya
                                sebagian atau
                                seluruh refleksi proteksi jalan napas). Sedasi dalam dapat berpengaruh terhadap fungsi kerja
                                jantung dan
                                pembuluh darah terutama pada pasien sakit berat, sehingga tindakan sedasi dalam membutuhkan
                                alat
                                monitoring yang lebih lengkap dari sedasi ringan maupun sedasi moderat.</span>
                        </li>
                        <li>
                            <span>Kelebihan Teknik Sedasi :</span>
                            <ol type="a">
                                <li>Obat diberikan secara bertahap
                                </li>
                                <li>Selama tindakan pasien dalam keadaan mengantuk dan tidur</li>
                                <li>Obat yang diberikan dapat memberikan efek amnesia.</li>
                            </ol>
                        </li>
                        <li>
                            <span>Kelemahan Teknik Sedasi :</span>
                            <ol type="a">
                                <li>Pasca sedasi pasien harus sadar penuh sebelum bisa diberi minum
                                </li>
                                <li>Sampai 24 jam pasca sedasi pasien tidak diperbolehkan mengendarai mobil,
                                    mengoperasikan mesin dan
                                    menandatangani dokumen penting yang bersifat legal.</li>
                            </ol>
                        </li>
                        <li>
                            <span>Komplikasi Sedasi :</span>
                            <ol type="a">
                                <li>Oleh karena tindakan sedasi merupakan rangkaian proses dinamika dan berubah, maka
                                    sedasi ringan ataupun
                                    moderat bisa bergeser menjadi sedasi dalam.
                                </li>
                                <li>Efek samping pasca sedasi dapat berupa mual/muntah, menggigil, pusing, mengantuk,
                                    yang bisa diatasi dengan
                                    obat-obatan</li>
                                <li>Alergi / hipersensitif terhadap obat (sangat jarang), mulai derajat ringan hingga
                                    berat / fatal</li>
                                <li>Berisiko pada pasien yang tidak puasa, bisa terjadi aspirasi yaitu masuknya isi
                                    lambung ke jalan napas / paru.</li>
                                <li>Pada sedasi dalam terdapat kemungkinan pemasangan alat atau pipa pernapasan.</li>
                            </ol>
                        </li>
                    </ul>
                </div>


                <div>
                    <p>Saya yang bertanda tangan dibawah ini telah membaca atau dibacakan keterangan diatas dan telah
                        dijelaskan
                        terkait dengan prosedur anestesi dan sedasi yang akan dilakukan terhadap : diri
                        sendiri/istri/suami/ayah/ibu/anak *
                    </p>
                </div>

                <div>


                    <div class="row">
                        <div class="col-2">Nama</div>
                        <div class="col-10">
                            <input type="text" class="form-control form-control-sm" value="{{ $item->queue->patient->name ?? '' }}" disabled>
                        </div>
                    </div>

                    <div class="row align-items-center mt-3">
                        <div class="col-2">Umur</div>
                        <div class="col-2">
                            <input type="number" class="form-control form-control-sm" value="{{ $umur }}" disabled>
                        </div>
                        <div class="col-8 d-flex justify-center  align-items-center">
                            <span class="me-3">Tahun </span>
                        </div>
                    </div>


                    <div class="row mt-3">
                        <div class="col-2">Jenis Kelamin</div>
                        <div class="col-10">
                            <input type="text" class="form-control form-control-sm" value="{{ $item->queue->patient->jenis_kelamin ?? '' }}" disabled>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-2">No. Telp</div>
                        <div class="col-10">
                            <input type="tel" class="form-control form-control-sm" value="{{ $item->queue->patient->telp ?? '' }}" disabled>
                        </div>
                    </div>


                    <div class="row mt-3">
                        <div class="col-2">Rencana Tindakan</div>
                        <div class="col-10">
                            <input type="text" class="form-control form-control-sm" name="rencana_tindakan">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-2">Jenis Anestesi</div>
                        <div class="col-10">
                            <input type="text" class="form-control form-control-sm" name="jenis_anestesi">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-2">Tanggal / Jam</div>
                        <div class="col-10">
                            <input type="datetime-local" class="form-control form-control-sm" name="tanggal" value="{{ date('Y-m-d H:i:s') }}">
                        </div>
                    </div>

                </div>


                <div class="mb-3 mt-5  text-end">
                    <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                </div>


            </div>
        </form>
    </div>
@endsection
