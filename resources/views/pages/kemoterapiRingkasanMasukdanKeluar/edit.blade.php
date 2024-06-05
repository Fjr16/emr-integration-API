@extends('layouts.backend.main')

@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Buat Ringkasan Masuk Dan Keluar Kemoterapi</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('kemoterapi/ringkasan-masuk-keluar.update', $data->id) }}">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Pilih Pasien</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ $data->patient->name }}" class="form-control"
                            @disabled(true)>
                    </div>
                </div>
                <div class="row">
                    {{-- kiri --}}
                    <div class="col-md-6">
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Tanggal Masuk</label>
                            <div class="col-sm-7">
                                <input type="date" name="tanggal_masuk" class="form-control" id="basic-default-name"
                                    value="{{ $data->tanggal_masuk }}" @required(true)>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Jam Masuk</label>
                            <div class="col-sm-7">
                                <input type="time" name="jam_masuk"value="{{ $data->jam_masuk }}" class="form-control"
                                    id="basic-default-name" @required(true)>
                            </div>
                        </div>
                        <hr>
                        {{-- Pendidikan Terakhir --}}
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Pendidikan Terakhir :</label>
                            <table>
                                <tr>
                                    <td><input type="radio" name="pendidikan_terakhir" id="sd" class="mx-2"
                                            value="{{ $data->pendidikan_terakhir }}"
                                            checked>{{ $data->pendidikan_terakhir }}</td>
                                </tr>
                            </table>

                        </div>
                        {{-- alamat --}}
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Alamat Sesuai KTP</label>
                            <div class="col-sm-7">
                                <input type="text" name="alamat_sesuai_ktp" class="form-control" id="basic-default-name"
                                    value="{{ $data->alamat_sesuai_ktp }}" placeholder="Alamat Seusai KTP"
                                    @required(true)>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Alamat Sesuai Domisili</label>
                            <div class="col-sm-7">
                                <input type="text" name="alamat_sesuai_domisili" class="form-control"
                                    value="{{ $data->alamat_sesuai_domisili }}" placeholder="Alamat Sesuai Domisili"
                                    id="basic-default-name" @required(true)>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Keyakinan</label>
                            <div class="col-sm-7">
                                <input type="text" name="keyakinan" class="form-control" id="basic-default-name"
                                    value="{{ $data->keyakinan }}" placeholder="Keyakinan" @required(true)>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Nilai Nilai Pribadi</label>
                            <div class="col-sm-7">
                                <input type="text" name="nilai_nilai_pribadi" class="form-control"
                                    value="{{ $data->nilai_nilai_pribadi }}" id="basic-default-name"
                                    placeholder="Nilai Nilai Pribadi" @required(true)>
                            </div>
                        </div>
                        {{-- Suku Bangsa --}}
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Suku Bangsa :</label>
                            <div>
                                <table>
                                    <tr>
                                        <td>
                                            <input type="radio" name="suku_bangsa" id="Minang" class="mx-2"
                                                value="{{ $data->suku_bangsa }}" checked required>{{ $data->suku_bangsa }}
                                        </td>
                                    </tr>
                                </table>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="sukubangsa_lainnya"
                                        value="{{ $data->suku_bangsa }}" style="display: none;" id="sukubangsa_lainnya"
                                        placeholder="Ketik Suku Bangsa Lainnya">
                                </div>
                            </div>
                        </div>


                        {{-- pekerjaan --}}
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Pekerjaan :</label>
                            <div>
                                <table>
                                    <tr>
                                        <td>
                                            <input type="radio" name="pekerjaan" id="PNS" class="mx-2"
                                                value="{{ $data->kemoterapiPatient->queue->patient->job->name }}" checked
                                                required>{{ $data->kemoterapiPatient->queue->patient->job->name }}
                                        </td>
                                    </tr>
                                </table>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="pekerjaan_lainnya"
                                        value="{{ $data->pekerjaan }}" style="display: none;" id="pekerjaan_lainnya"
                                        placeholder="Ketik Nama Pekerjaan disini">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- kanan --}}
                    <div class="col-md-6">
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Tanggal Keluar</label>
                            <div class="col-sm-7">
                                <input type="date" name="tanggal_keluar" class="form-control" id="basic-default-name"
                                    value="{{ $data->tanggal_keluar }}" @required(true)>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Jam Keluar</label>
                            <div class="col-sm-7">
                                <input type="time" name="jam_keluar" class="form-control" id="basic-default-name"
                                    value="{{ $data->jam_keluar }}" @required(true)>
                            </div>
                        </div>
                        <hr>

                        {{-- Ruang Rawat --}}
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Ruang Rawat</label>
                            <div>
                                <table>
                                    <tr>
                                        <td><input type="radio" name="ruang_rawat" id="vip" class="mx-2"
                                                value="VIP" {{ $data->ruang_rawat == 'VIP' ? 'checked' : '' }}>VIP</td>
                                        <td><input type="radio" name="ruang_rawat" id="kelas_iii" class="mx-2"
                                                value="Kelas II"
                                                {{ $data->ruang_rawat == 'Kelas II' ? 'checked' : '' }}>Kelas II</td>
                                    </tr>
                                    <tr>
                                        <td><input type="radio" name="ruang_rawat" id="kelas_i" class="mx-2"
                                                value="Kelas I"
                                                {{ $data->ruang_rawat == 'Kelas I' ? 'checked' : '' }}>Kelas I</td>
                                        <td><input type="radio" name="ruang_rawat" id="kelas_div" class="mx-2"
                                                value="Kelas III"
                                                {{ $data->ruang_rawat == 'Kelas III' ? 'checked' : '' }}>Kelas III</td>
                                    </tr>
                                </table>

                            </div>
                        </div>

                        {{-- lama dirawat --}}
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Lama Dirawat</label>
                            <div class="col-sm-7">
                                <input type="number" name="lama_dirawat" class="form-control d-inline"
                                    id="basic-default-name" value="{{ $data->lama_dirawat }}" @required(true)
                                    style="width:200px"> Hari
                            </div>
                        </div>


                        {{-- tahun Kunjungan --}}
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Tahun Kunjungan</label>
                            <div class="col-sm-7">
                                <input type="number" name="tahun_kunjungan" class="form-control"
                                    id="basic-default-name" value="{{ $data->tahun_kunjungan }}" @required(true)>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Dirawat Ke</label>
                            <div class="col-sm-7">
                                <input type="text" name="dirawat_ke" class="form-control" id="basic-default-name"
                                    value="{{ $data->dirawat_ke }}" @required(true)>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Nomor Telepon/HP</label>
                            <div class="col-sm-7">
                                <input type="number" name="nomor_telephone" class="form-control"
                                    value="{{ $data->no_telphone }}" placeholder="Nomor Telephone"
                                    id="basic-default-name" @required(true)>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Email</label>
                            <div class="col-sm-7">
                                <input type="text" name="email" class="form-control" placeholder="@email"
                                    value="{{ $data->email }}" id="basic-default-name" @required(true)>
                            </div>
                        </div>
                        {{-- agama --}}
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Agama :</label>
                            <table>
                                <tr>
                                    <td><input type="radio" name="agama" id="Islam" class="mx-2"
                                            value="{{ $data->agama }}" checked required>{{ $data->agama }}
                                    </td>
                                </tr>
                            </table>

                        </div>

                    </div>
                    <hr>
                    {{-- kiri --}}
                    <div class="col-md-6">
                        {{-- Bahasa Yang digunakan --}}
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Bahasa Yang Digunakan
                                :</label>
                            <div>
                                <table>
                                    <tr>
                                        <td>
                                            <input type="radio" name="bahasa" @required(true) class="mx-2"
                                                value="Indonesia"
                                                {{ $data->bahasa == 'Indonesia' ? 'checked' : '' }}>Indonesia
                                        </td>
                                        <td>
                                            <input type="radio" name="bahasa" @required(true) class="mx-2"
                                                value="Daerah" {{ $data->bahasa == 'Daerah' ? 'checked' : '' }}>Daerah
                                        </td>
                                        <td>
                                            <input type="radio" name="bahasa" @required(true) class="mx-2"
                                                value="Isyarat" {{ $data->bahasa == 'Isyarat' ? 'checked' : '' }}>Isyarat
                                        </td>
                                        <td>
                                            <input type="radio" name="bahasa" @required(true) id="bahasa_lainnya"
                                                class="mx-2" value="bahasa_lainnya"
                                                {{ $data->bahasa == 'bahasa_lainnya' ? 'checked' : '' }}>Lainnya
                                        </td>
                                    </tr>
                                </table>

                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="lainnya_bahasa"
                                        value="{{ $data->bahasa }}" style="display: none;" id="lainnya_bahasa"
                                        placeholder="Ketik Bahasa Yang Digunakan">
                                </div>
                            </div>
                        </div>
                        <hr>

                        {{-- hambatan_bahasa --}}
                        <div class="row mb-3">
                            <div>
                                <table>
                                    <tr>
                                        <td>
                                            Hambatan Bahasa
                                        </td>
                                        <td>
                                            <input type="radio" @required(true) name="hambatan_bahasa"
                                                class="mx-2" value="Tidak"
                                                {{ $data->hambatan_bahasa == 'Tidak' ? 'checked' : '' }}>Tidak
                                            <input type="radio" @required(true) name="hambatan_bahasa"
                                                class="mx-2" value="Ya"
                                                {{ $data->hambatan_bahasa == 'Ya' ? 'checked' : '' }}>Ya
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Kebutuhan Penerjemah
                                        </td>
                                        <td>
                                            <input type="radio" @required(true) name="kebutuhan_penerjemah"
                                                class="mx-2" value="Tidak"
                                                {{ $data->kebutuhan_penerjemah == 'Tidak' ? 'checked' : '' }}>Tidak
                                            <input type="radio" @required(true) name="kebutuhan_penerjemah"
                                                class="mx-2" value="Ya"
                                                {{ $data->kebutuhan_penerjemah == 'Ya' ? 'checked' : '' }}>Ya
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Kebutuhan Disabilitas
                                        </td>
                                        <td>
                                            <input type="radio" @required(true) name="kebutuhan_disabilitas"
                                                class="mx-2" value="Tidak"
                                                {{ $data->kebutuhan_disabilitas == 'Tidak' ? 'checked' : '' }}>Tidak
                                            <input type="radio" @required(true) name="kebutuhan_disabilitas"
                                                class="mx-2" value="Ya"
                                                {{ $data->kebutuhan_disabilitas == 'Ya' ? 'checked' : '' }}>Ya
                                        </td>
                                    </tr>
                                </table>

                            </div>
                        </div>

                        {{-- Riwayat Mutasi --}}
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Riwayat Mutasi :</label>
                            <div>
                                <table>
                                    <tr>
                                        <td>1. Pindah Dari Bangsal : <input type="text" class="d-inline form-control"
                                                name="mutasi_bangsal_1" placeholder="Bangsal 1..."
                                                value="{{ $data->mutasi_bangsal_1 }}"></td>
                                        <td>Ke :
                                            <input type="text" class="d-inline form-control"
                                                name="mutasi_pindah_bangsal_1" placeholder="....."
                                                value="{{ $data->mutasi_pindah_bangsal_1 }}">
                                        </td>
                                        <td>Tanggal :<input type="date" class="d-inline form-control"
                                                name="tanggal_bangsal_1" value="{{ $data->tanggal_bangsal_1 }}"></td>
                                    </tr>
                                    <tr>
                                        <td>2. Pindah Dari Bangsal : <input type="text" class="d-inline form-control"
                                                name="mutasi_bangsal_2" placeholder="Bangsal 2"
                                                value="{{ $data->mutasi_bangsal_2 }}"></td>
                                        <td>Ke :
                                            <input type="text" class="d-inline form-control"
                                                name="mutasi_pindah_bangsal_2" placeholder="...."
                                                value="{{ $data->mutasi_pindah_bangsal_2 }}">
                                        </td>
                                        <td>Tanggal :<input type="date" class="d-inline form-control"
                                                name="tanggal_bangsal_2" value="{{ $data->tanggal_bangsal_2 }}"></td>
                                    </tr>
                                </table>

                            </div>
                        </div>

                    </div>

                    {{-- kanan --}}
                    <div class="col-md-6">
                        {{-- kedatangan pasien --}}
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Kedatangan Pasien</label>
                            <div>
                                <table>
                                    <tr>
                                        <td>
                                            <input type="radio" name="kedatangan_pasien" class="mx-2"
                                                value="Datang Sendiri" required
                                                {{ $data->kedatangan_pasien == 'Datang Sendiri' ? 'checked' : '' }}>
                                            Datang Sendiri
                                        </td>
                                        <td>
                                            <input type="radio" name="kedatangan_pasien" id="kedatangan_pasienlainnya"
                                                class="mx-2" value="Dirujuk Oleh" required
                                                {{ $data->kedatangan_pasien == 'Dirujuk Oleh' ? 'checked' : '' }}>
                                            Dirujuk Oleh....
                                        </td>
                                    </tr>
                                </table>


                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="kedatangan_rujukan"
                                        value="{{ $data->kedatangan_pasien }}" style="display: none;"
                                        id="kedatangan_rujukan" placeholder="Dirujuk Oleh">
                                </div>
                            </div>
                        </div>
                        <hr>
                        {{-- jalur masuk rumah sakit --}}
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Masuk Rumah Sakit
                                Melalui :</label>
                            <div>
                                <input type="radio" class="mx-2" name="jalur_masuk_rs" @required(true)
                                    value="Poliklinik"
                                    {{ $data->jalur_masuk_rumahsakit == 'Poliklinik' ? 'checked' : '' }}>Poliklinik
                                <input type="radio" class="mx-2" name="jalur_masuk_rs"
                                    {{ $data->jalur_masuk_rumahsakit == 'IGD' ? 'checked' : '' }} @required(true)
                                    value="IGD">IGD
                            </div>
                        </div>

                        {{-- Keadaan Keluar --}}
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Keadaan Keluar</label>
                            <div>
                                <table>
                                    <tr>
                                        <td>
                                            <input type="radio" class="mx-2" required name="keadaan_keluar"
                                                value="Sembuh" {{ $data->keadaan_keluar == 'Sembuh' ? 'checked' : '' }}>
                                            Sembuh
                                        </td>
                                        <td>
                                            <input type="radio" class="mx-2" required name="keadaan_keluar"
                                                value="Perbaikan"
                                                {{ $data->keadaan_keluar == 'Perbaikan' ? 'checked' : '' }}>
                                            Perbaikan
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="radio" class="mx-2" required name="keadaan_keluar"
                                                value="Menetap/Memburuk"
                                                {{ $data->keadaan_keluar == 'Menetap/Memburuk' ? 'checked' : '' }}>
                                            Menetap/Memburuk
                                        </td>
                                        <td>
                                            <input type="radio" class="mx-2" required name="keadaan_keluar"
                                                value="Cacat" {{ $data->keadaan_keluar == 'Cacat' ? 'checked' : '' }}>
                                            Cacat
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="radio" class="mx-2" required name="keadaan_keluar"
                                                value="Meninggal < 48 Jam"
                                                {{ $data->keadaan_keluar == 'Meninggal < 48 Jam' ? 'checked' : '' }}>
                                            Meninggal < 48 Jam </td>
                                        <td>
                                            <input type="radio" class="mx-2" required name="keadaan_keluar"
                                                value="Meninggal > 48 jam"
                                                {{ $data->keadaan_keluar == 'Meninggal > 48 jam' ? 'checked' : '' }}>
                                            Meninggal > 48 jam
                                        </td>
                                    </tr>
                                </table>

                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="col-md-6">
                        {{-- cara keluar --}}
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Cara Keluar :</label>
                            <div>
                                <table>
                                    <tr>
                                        <td>
                                            <input type="radio" required name="cara_keluar" class="mx-2"
                                                value="Atas Persetujuan"
                                                {{ $data->cara_keluar == 'Atas Persetujuan' ? 'checked' : '' }}>
                                            Atas Persetujuan
                                        </td>
                                        <td>
                                            <input type="radio" required name="cara_keluar" class="mx-2"
                                                value="Lari" {{ $data->cara_keluar == 'Lari' ? 'checked' : '' }}>
                                            Lari
                                        </td>
                                        <td>
                                            <input type="radio" required name="cara_keluar" class="mx-2"
                                                value="Meninggal"
                                                {{ $data->cara_keluar == 'Meninggal' ? 'checked' : '' }}>
                                            Meninggal
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="radio" required name="cara_keluar" class="mx-2"
                                                value="Pulang APS"
                                                {{ $data->cara_keluar == 'Pulang APS' ? 'checked' : '' }}>
                                            Pulang APS
                                        </td>
                                        <td>
                                            <input type="radio" required name="cara_keluar" class="mx-2"
                                                value="Pindah RS Lain"
                                                {{ $data->cara_keluar == 'Pindah RS Lain' ? 'checked' : '' }}>
                                            Pindah RS Lain
                                        </td>
                                    </tr>
                                </table>


                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="col-md-6">
                        {{-- cara keluar --}}
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Meninggal</label>
                            <div>
                                <table>
                                    <tr>
                                        <td>
                                            <input type="radio" name="meninggal" class="mx-2" value="Autopsi"
                                                {{ $data->meninggal == 'Autopsi' ? 'checked' : '' }}>Autopsi
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="radio" name="meninggal" class="mx-2" value="Tanpa Autopsi"
                                                {{ $data->meninggal == 'Tanpa Autopsi' ? 'checked' : '' }}>Tanpa Autopsi
                                        </td>
                                    </tr>
                                </table>

                            </div>
                        </div>
                        <hr>
                    </div>

                    {{-- table Diagnosis --}}
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr class="text-nowrap bg-dark">
                                    <th>Diagnosis (Dengan Huruf Cetak, Jangan Disingkat)</th>
                                    <th>Kode Diagnosa Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        Diagnosa Utama
                                    </td>

                                    <td>ICD X : <input type="text" name="diagnosa_utama" id=""
                                            value="{{ $data->diagnosa_utama }}" @required(true)
                                            class=" d-inline form-control" style="width:320px">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Diagnosa Sekunder
                                    </td>

                                    <td>ICD X : <input type="text" name="diagnosa_sekunder" id=""
                                            value="{{ $data->diagnosa_sekunder }}" @required(true)
                                            class=" d-inline form-control" style="width:320px">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Diagnosa Kompikasi dan Resiko Yang Muncul
                                    </td>

                                    <td>ICD X : <input type="text" name="komplikasi_dan_resiko" id=""
                                            value="{{ $data->komplikasi_dan_resiko }}" @required(true)
                                            class=" d-inline form-control" style="width:320px">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Tindakan Operasi
                                    </td>
                                    <td>ICD X : <input type="text" name="tindakan_operasi" id=""
                                            value="{{ $data->tindakan_operasi }}" @required(true)
                                            class=" d-inline form-control" style="width:320px">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Riwayat Alergi
                                        <input type="radio" required name="riwayat_alergi" id=""
                                            value="Tidak" {{ $data->riwayat_alergi == 'Tidak' ? 'checked' : '' }}
                                            class="ms-2 d-inline">
                                        Tidak
                                        <input type="radio" required name="riwayat_alergi" id=""
                                            value="Ada" {{ $data->riwayat_alergi == 'Ada' ? 'checked' : '' }}
                                            class="ms-2 d-inline">
                                        Ada
                                    </td>
                                    <td>
                                        Riwayat Tranfusi
                                        <input type="radio" required name="riwayat_transfusi" id=""
                                            value="Tidak" {{ $data->riwayat_transfusi == 'Tidak' ? 'checked' : '' }}
                                            class="ms-2 d-inline">
                                        Tidak
                                        <input type="radio" required name="riwayat_transfusi" id=""
                                            value="Ada" {{ $data->riwayat_transfusi == 'Ada' ? 'checked' : '' }}
                                            class="ms-2 d-inline">
                                        Ada
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Boleh Pulang / APS / Meninggal :
                                        <input type="date" required name="tanggal_aps" id=""
                                            value="{{ $data->tanggal_aps }}" class="form-control d-inline"
                                            style="width: 120px">
                                        <input type="time" required name="jam_aps" id=""
                                            value="{{ $data->jam_aps }}" class="form-control d-inline"
                                            style="width: 120px">
                                    </td>
                                    <td>
                                        Kontrol Kembali :
                                        <input type="date" required name="tanggal_kontrol" id=""
                                            value="{{ $data->tanggal_kontrol }}" class="form-control d-inline"
                                            style="width: 120px">
                                        <input type="time" required name="jam_kontrol" id=""
                                            value="{{ $data->jam_kontrol }}" class="form-control d-inline"
                                            style="width: 120px">
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-10 mt-4">
                        <button type="submit" class="btn btn-sm btn-dark">Update Ringkasan</button>
                    </div>


            </form>
        </div>
    </div>
@endsection

<script>
    // suku bangsa
    document.addEventListener("DOMContentLoaded", function() {
        const sukuLainnyaRadio = document.getElementById("lainnya_suku");
        const sukuLainnyaInput = document.getElementById("sukubangsa_lainnya");

        sukuLainnyaRadio.addEventListener("change", function() {
            if (this.checked) {
                sukuLainnyaInput.style.display = "block";
                sukuLainnyaInput.setAttribute("required", "required");
            } else {
                sukuLainnyaInput.style.display = "none";
                sukuLainnyaInput.removeAttribute("required");
            }
        });

        const otherRadios = document.querySelectorAll('[name="suku_bangsa"]:not(#lainnya_suku)');
        otherRadios.forEach(radio => {
            radio.addEventListener("change", function() {
                sukuLainnyaInput.style.display = "none";
                sukuLainnyaInput.removeAttribute("required");
            });
        });

        sukuLainnyaInput.addEventListener("input", function() {
            sukuLainnyaRadio.checked = true;
            sukuLainnyaInput.style.display = "block";
            sukuLainnyaInput.setAttribute("required", "required");
        });
    });

    // pekerjaan
    document.addEventListener("DOMContentLoaded", function() {
        const pekerjaanLainnyaRadio = document.getElementById("lainnya_pekerjaan");
        const pekerjaanLainnyaInput = document.getElementById("pekerjaan_lainnya");

        pekerjaanLainnyaRadio.addEventListener("change", function() {
            if (this.checked) {
                pekerjaanLainnyaInput.style.display = "block";
                pekerjaanLainnyaInput.setAttribute("required", "required");
            } else {
                pekerjaanLainnyaInput.style.display = "none";
                pekerjaanLainnyaInput.removeAttribute("required");
            }
        });

        const otherRadios = document.querySelectorAll('[name="pekerjaan"]:not(#lainnya_pekerjaan)');
        otherRadios.forEach(radio => {
            radio.addEventListener("change", function() {
                pekerjaanLainnyaInput.style.display = "none";
                pekerjaanLainnyaInput.removeAttribute("required");
            });
        });

        pekerjaanLainnyaInput.addEventListener("input", function() {
            pekerjaanLainnyaRadio.checked = true;
            pekerjaanLainnyaInput.style.display = "block";
            pekerjaanLainnyaInput.setAttribute("required", "required");
        });
    });
    // Bahasa Lainnya
    document.addEventListener("DOMContentLoaded", function() {
        const bahasaLainnyaRadio = document.getElementById("bahasa_lainnya");
        const bahasaLainnyaInput = document.getElementById("lainnya_bahasa");

        bahasaLainnyaRadio.addEventListener("change", function() {
            if (this.checked) {
                bahasaLainnyaInput.style.display = "block";
                bahasaLainnyaInput.setAttribute("required", "required");
            } else {
                bahasaLainnyaInput.style.display = "none";
                bahasaLainnyaInput.removeAttribute("required");
            }
        });

        const otherRadios = document.querySelectorAll('[name="bahasa"]:not(#bahasa_lainnya)');
        otherRadios.forEach(radio => {
            radio.addEventListener("change", function() {
                bahasaLainnyaInput.style.display = "none";
                bahasaLainnyaInput.removeAttribute("required");
            });
        });

        bahasaLainnyaInput.addEventListener("input", function() {
            bahasaLainnyaRadio.checked = true;
            bahasaLainnyaInput.style.display = "block";
            bahasaLainnyaInput.setAttribute("required", "required");
        });
    });

    // Kedatangan Pasien
    document.addEventListener("DOMContentLoaded", function() {
        const kedatanganLainnyaRadio = document.getElementById("kedatangan_pasienlainnya");
        const kedatanganLainnyaInput = document.getElementById("kedatangan_rujukan");

        kedatanganLainnyaRadio.addEventListener("change", function() {
            if (this.checked) {
                kedatanganLainnyaInput.style.display = "block";
                kedatanganLainnyaInput.setAttribute("required", "required");
            } else {
                kedatanganLainnyaInput.style.display = "none";
                kedatanganLainnyaInput.removeAttribute("required");
            }
        });

        const otherRadios = document.querySelectorAll(
            '[name="kedatangan_pasien"]:not(#kedatangan_pasienlainnya)');
        otherRadios.forEach(radio => {
            radio.addEventListener("change", function() {
                kedatanganLainnyaInput.style.display = "none";
                kedatanganLainnyaInput.removeAttribute("required");
            });
        });

        kedatanganLainnyaInput.addEventListener("input", function() {
            kedatanganLainnyaRadio.checked = true;
            kedatanganLainnyaInput.style.display = "block";
            kedatanganLainnyaInput.setAttribute("required", "required");
        });
    });
</script>
