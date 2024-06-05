@extends('layouts.backend.main')

@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Buat Kemoterapi Ringkasan Masuk Dan Keluar</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('kemoterapi/ringkasan-masuk-keluar.store', $item->id) }}">
                @csrf
                {{-- <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Pilih Pasien</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" name="patient_id" @required(true)>
                                <option value="{{ $item->queue->patient->id }}">{{ $item->queue->patient->name }}</option>
                        </select>
                    </div>
                </div> --}}
                <div class="row">
                    {{-- kiri --}}
                    <div class="col-md-6">
                        {{-- @role('Admin') --}}
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Tanggal Masuk</label>
                            <div class="col-sm-7">
                                <input type="date" name="tanggal_masuk" class="form-control" id="basic-default-name"
                                    @required(true)>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Jam Masuk</label>
                            <div class="col-sm-7">
                                <input type="time" name="jam_masuk" class="form-control" id="basic-default-name"
                                    @required(true)>
                            </div>
                        </div>
                        {{-- @else
                            <div class="row mb-3">
                                <label class="col-sm-5 col-form-label" for="basic-default-name">Tanggal Masuk</label>
                                <div class="col-sm-7">
                                    <input type="date" class="form-control" id="basic-default-name" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-5 col-form-label" for="basic-default-name">Jam Masuk</label>
                                <div class="col-sm-7">
                                    <input type="time" class="form-control" id="basic-default-name" disabled>
                                </div>
                            </div>
                        @endrole --}}
                        <hr>
                        {{-- @role('Admin') --}}
                        {{-- patient_id --}}
                        <input type="hidden" name="patient_id" value="{{ $item->queue->patient_id }}">
                        {{-- Pendidikan Terakhir --}}
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Pendidikan Terakhir :</label>
                            <table>
                                <tr>
                                    <td><input type="radio" name="pendidikan_terakhir" id="sd" class="mx-2"
                                            checked
                                            value="{{ $item->queue->patient->pendidikan }}">{{ $item->queue->patient->pendidikan }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                        {{-- alamat --}}
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Alamat Sesuai KTP</label>
                            <div class="col-sm-7">
                                <input type="text" name="alamat_sesuai_ktp" value="{{ $item->queue->patient->alamat }}"
                                    class="form-control" id="basic-default-name" placeholder="Alamat Seusai KTP"
                                    @required(true)>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Alamat Sesuai Domisili</label>
                            <div class="col-sm-7">
                                <input type="text" name="alamat_sesuai_domisili" class="form-control"
                                    value="{{ $item->queue->patient->alamat }}" placeholder="Alamat Sesuai Domisili"
                                    id="basic-default-name" @required(true)>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Keyakinan</label>
                            <div class="col-sm-7">
                                <input type="text" name="keyakinan" class="form-control" id="basic-default-name"
                                    value="{{ $item->queue->patient->agama }}" placeholder="Keyakinan" @required(true)>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Nilai Nilai Pribadi</label>
                            <div class="col-sm-7">
                                <input type="text" name="nilai_nilai_pribadi" class="form-control"
                                    id="basic-default-name" placeholder="Nilai Nilai Pribadi" @required(true)>
                            </div>
                        </div>
                        {{-- Suku Bangsa --}}
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Suku Bangsa :</label>
                            <div>
                                <table>
                                    <tr>
                                        <td>
                                            <input type="radio" name="suku_bangsa" id="Minang" class="mx-2" checked
                                                value="{{ $item->queue->patient->suku }}"
                                                required>{{ $item->queue->patient->suku }}
                                        </td>
                                    </tr>
                                </table>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="sukubangsa_lainnya"
                                        style="display: none;" id="sukubangsa_lainnya"
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
                                            <input type="radio" name="pekerjaan" @required(true) id="PNS" checked
                                                class="mx-2"
                                                value="{{ $item->queue->patient->job->name }}">{{ $item->queue->patient->job->name }}
                                        </td>
                                    </tr>
                                </table>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="pekerjaan_lainnya"
                                        style="display: none;" id="pekerjaan_lainnya"
                                        placeholder="Ketik Nama Pekerjaan disini">
                                </div>
                            </div>
                        </div>


                        {{-- @else --}}
                        {{-- Pendidikan Terakhir --}}
                        {{-- <div class="row mb-3">
                                <label class="col-sm-5 col-form-label" for="basic-default-name">Pendidikan Terakhir :</label>
                                <table>
                                    <tr>
                                        <td><input type="radio" class="mx-2" checked
                                                value="{{ $item->queue->patient->pendidikan }}"
                                                disabled>{{ $item->queue->patient->pendidikan }}
                                        </td>
                                    </tr>
                                </table>
                            </div> --}}
                        {{-- alamat --}}
                        {{-- <div class="row mb-3">
                                <label class="col-sm-5 col-form-label" for="basic-default-name">Alamat Sesuai KTP</label>
                                <div class="col-sm-7">
                                    <input type="text" value="{{ $item->queue->patient->alamat }}" class="form-control"
                                        id="basic-default-name" placeholder="Alamat Seusai KTP" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-5 col-form-label" for="basic-default-name">Alamat Sesuai Domisili</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" value="{{ $item->queue->patient->alamat }}"
                                        placeholder="Alamat Sesuai Domisili" id="basic-default-name" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-5 col-form-label" for="basic-default-name">Keyakinan</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="basic-default-name"
                                        value="{{ $item->queue->patient->agama }}" placeholder="Keyakinan" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-5 col-form-label" for="basic-default-name">Nilai Nilai Pribadi</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="basic-default-name"
                                        placeholder="Nilai Nilai Pribadi" disabled>
                                </div>
                            </div> --}}
                        {{-- Suku Bangsa --}}
                        {{-- <div class="row mb-3">
                                <label class="col-sm-5 col-form-label" for="basic-default-name">Suku Bangsa :</label>
                                <div>
                                    <table>
                                        <tr>
                                            <td>
                                                <input type="radio" class="mx-2" checked
                                                    value="{{ $item->queue->patient->suku }}"
                                                    disabled>{{ $item->queue->patient->suku }}
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div> --}}

                        {{-- pekerjaan --}}
                        {{-- <div class="row mb-3">
                                <label class="col-sm-5 col-form-label" for="basic-default-name">Pekerjaan :</label>
                                <div>
                                    <table>
                                        <tr>
                                            <td>
                                                <input type="radio" checked class="mx-2"
                                                    value="{{ $item->queue->patient->job->name }}"
                                                    disabled>{{ $item->queue->patient->job->name }}
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        @endrole --}}
                    </div>

                    {{-- kanan --}}
                    <div class="col-md-6">
                        {{-- @role('Admin') --}}
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Tanggal Keluar</label>
                            <div class="col-sm-7">
                                <input type="date" name="tanggal_keluar" class="form-control" id="basic-default-name"
                                    @required(true)>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Jam Keluar</label>
                            <div class="col-sm-7">
                                <input type="time" name="jam_keluar" class="form-control" id="basic-default-name"
                                    @required(true)>
                            </div>
                        </div>
                        {{-- @else
                            <div class="row mb-3">
                                <label class="col-sm-5 col-form-label" for="basic-default-name">Tanggal Keluar</label>
                                <div class="col-sm-7">
                                    <input type="date" class="form-control" id="basic-default-name" @required(true)
                                        disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-5 col-form-label" for="basic-default-name">Jam Keluar</label>
                                <div class="col-sm-7">
                                    <input type="time" class="form-control" id="basic-default-name" @required(true)
                                        disabled>
                                </div>
                            </div>
                        @endrole --}}
                        <hr>

                        {{-- @role('Admin') --}}
                        {{-- Ruang Rawat --}}
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Ruang Rawat</label>
                            <div>
                                <table>
                                    <tr>
                                        <td><input type="radio" name="ruang_rawat" id="vip" class="mx-2"
                                                checked value="VIP">VIP</td>
                                        <td><input type="radio" name="ruang_rawat" id="kelas_iii" class="mx-2"
                                                value="Kelas II">Kelas II</td>
                                    </tr>
                                    <tr>
                                        <td><input type="radio" name="ruang_rawat" id="kelas_i" class="mx-2"
                                                value="Kelas I">Kelas I</td>
                                        <td><input type="radio" name="ruang_rawat" id="kelas_div" class="mx-2"
                                                value="Kelas III">Kelas III</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        {{-- lama dirawat --}}
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Lama Dirawat</label>
                            <div class="col-sm-7">
                                <input type="number" name="lama_dirawat" class="form-control d-inline"
                                    id="basic-default-name" value="1" @required(true) style="width:200px"> Hari
                            </div>
                        </div>
                        {{-- tahun Kunjungan --}}
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Tahun Kunjungan</label>
                            <div class="col-sm-7">
                                <input type="number" name="tahun_kunjungan" class="form-control"
                                    id="basic-default-name" value="{{ $tahun }}" @required(true)>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Dirawat Ke</label>
                            <div class="col-sm-7">
                                <input type="text" name="dirawat_ke" class="form-control" id="basic-default-name"
                                    placeholder="Dirawat Ke.." @required(true)>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Nomor Telepon/HP</label>
                            <div class="col-sm-7">
                                <input type="number" name="nomor_telephone" class="form-control"
                                    placeholder="Nomor Telephone" id="basic-default-name"
                                    value="{{ $item->queue->patient->telp }}" @required(true)>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Email</label>
                            <div class="col-sm-7">
                                <input type="text" name="email" class="form-control" placeholder="@email"
                                    id="basic-default-name" @required(true)>
                            </div>
                        </div>
                        {{-- agama --}}
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Agama :</label>
                            <table>
                                <tr>
                                    <td><input type="radio" name="agama" id="Islam" class="mx-2" checked
                                            value="{{ $item->queue->patient->agama }}"
                                            required>{{ $item->queue->patient->agama }}
                                    </td>
                                </tr>
                            </table>
                        </div>


                        {{-- @else --}}
                        {{-- Ruang Rawat --}}
                        {{-- <div class="row mb-3">
                                <label class="col-sm-5 col-form-label" for="basic-default-name">Ruang Rawat</label>
                                <div>
                                    <table>
                                        <tr>
                                            <td><input type="radio" class="mx-2" value="VIP" checked disabled>VIP</td>
                                            <td><input type="radio" class="mx-2" value="Kelas II" disabled>Kelas II</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" class="mx-2" value="Kelas I" disabled>Kelas I</td>
                                            <td><input type="radio" class="mx-2" value="Kelas III" disabled>Kelas III
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div> --}}
                        {{-- lama dirawat --}}
                        {{-- <div class="row mb-3">
                                <label class="col-sm-5 col-form-label" for="basic-default-name">Lama Dirawat</label>
                                <div class="col-sm-7">
                                    <input type="number" class="form-control d-inline" value="" style="width:200px"
                                        disabled> Hari
                                </div>
                            </div> --}}
                        {{-- tahun Kunjungan --}}
                        {{-- <div class="row mb-3">
                                <label class="col-sm-5 col-form-label" for="basic-default-name">Tahun Kunjungan</label>
                                <div class="col-sm-7">
                                    <input type="number" class="form-control" id="basic-default-name"
                                        value="{{ $tahun }}" @readonly(true)>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-5 col-form-label" for="basic-default-name">Dirawat Ke</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="basic-default-name"
                                        placeholder="Dirawat Ke.." disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-5 col-form-label" for="basic-default-name">Nomor Telepon/HP</label>
                                <div class="col-sm-7">
                                    <input type="number" class="form-control" placeholder="Nomor Telephone"
                                        value="{{ $item->queue->patient->telp }}" @readonly(true)>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-5 col-form-label" for="basic-default-name">Email</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" placeholder="@email" id="basic-default-name"
                                        value="" readonly>
                                </div>
                            </div> --}}
                        {{-- agama --}}
                        {{-- <div class="row mb-3">
                                <label class="col-sm-5 col-form-label" for="basic-default-name">Agama :</label>
                                <table>
                                    <tr>
                                        <td><input type="radio" class="mx-2" checked
                                                value="{{ $item->queue->patient->agama }}"
                                                disabled>{{ $item->queue->patient->agama }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        @endrole --}}

                    </div>
                    <hr>
                    {{-- @role('Admin') --}}
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
                                                checked value="Indonesia">Indonesia
                                        </td>
                                        <td>
                                            <input type="radio" name="bahasa" @required(true) class="mx-2"
                                                value="Daerah">Daerah
                                        </td>
                                        <td>
                                            <input type="radio" name="bahasa" @required(true) class="mx-2"
                                                value="Isyarat">Isyarat
                                        </td>
                                        <td>
                                            <input type="radio" name="bahasa" @required(true) id="bahasa_lainnya"
                                                class="mx-2" value="bahasa_lainnya">Lainnya
                                        </td>
                                    </tr>
                                </table>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="lainnya_bahasa"
                                        style="display: none;" id="lainnya_bahasa"
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
                                            <input type="radio" @required(true) name="hambatan_bahasa"class="mx-2"
                                                checked value="Tidak">
                                            Tidak
                                            <input type="radio" @required(true) name="hambatan_bahasa"class="mx-2"
                                                value="Ya">Ya
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Kebutuhan Penerjemah
                                        </td>
                                        <td>
                                            <input type="radio" @required(true) checked
                                                name="kebutuhan_penerjemah"class="mx-2" value="Tidak">
                                            Tidak
                                            <input type="radio" @required(true)
                                                name="kebutuhan_penerjemah"class="mx-2" value="Ya">Ya
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Kebutuhan Disabilitas
                                        </td>
                                        <td>
                                            <input type="radio" @required(true) checked
                                                name="kebutuhan_disabilitas"class="mx-2" value="Tidak">
                                            Tidak
                                            <input type="radio" @required(true)
                                                name="kebutuhan_disabilitas"class="mx-2" value="Ya">Ya
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
                                        <td>1. Pindah Dari Bangsal : <input type="text" class=" d-inline  form-control"
                                                name="mutasi_bangsal_1" placeholder="Bangsal 1..."></td>
                                        <td>Ke :
                                            <input type="text" class=" d-inline  form-control"
                                                name="mutasi_pindah_bangsal_1" placeholder=".....">
                                        </td>
                                        <td>Tanggal :<input type="date" class=" d-inline  form-control"
                                                name="tanggal_bangsal_1"></td>
                                    </tr>
                                    <tr>
                                        <td>2. Pindah Dari Bangsal : <input type="text" class=" d-inline  form-control"
                                                name="mutasi_bangsal_2" placeholder="Bangsal 2"></td>
                                        <td>Ke :
                                            <input type="text" class=" d-inline  form-control"
                                                name="mutasi_pindah_bangsal_2" placeholder="....">
                                        </td>
                                        <td>Tanggal :<input type="date" class=" d-inline  form-control"
                                                name="tanggal_bangsal_2"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                    </div>


                    {{-- @else --}}
                    {{-- kiri --}}
                    {{-- <div class="col-md-6"> --}}
                    {{-- Bahasa Yang digunakan --}}
                    {{-- <div class="row mb-3">
                                <label class="col-sm-5 col-form-label" for="basic-default-name">Bahasa Yang Digunakan
                                    :</label>
                                <div>
                                    <table>
                                        <tr>
                                            <td>
                                                <input type="radio" class="mx-2" checked disabled>Indonesia
                                            </td>
                                            <td>
                                                <input type="radio" class="mx-2" disabled>Daerah
                                            </td>
                                            <td>
                                                <input type="radio" class="mx-2" disabled>Isyarat
                                            </td>
                                            <td>
                                                <input type="radio" class="mx-2" disabled>Lainnya
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <hr> --}}

                    {{-- hambatan_bahasa --}}
                    {{-- <div class="row mb-3">
                                <div>
                                    <table>
                                        <tr>
                                            <td>
                                                Hambatan Bahasa
                                            </td>
                                            <td>
                                                <input type="radio" class="mx-2" checked value="Tidak" disabled>Tidak
                                                <input type="radio" class="mx-2" value="Ya" disabled>Ya
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Kebutuhan Penerjemah
                                            </td>
                                            <td>
                                                <input type="radio" checked class="mx-2" value="Tidak" disabled>Tidak
                                                <input type="radio" class="mx-2" value="Ya" disabled>Ya
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Kebutuhan Disabilitas
                                            </td>
                                            <td>
                                                <input type="radio" checked class="mx-2" value="Tidak" disabled>Tidak
                                                <input type="radio" class="mx-2" value="Ya" disabled>Ya
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div> --}}

                    {{-- Riwayat Mutasi --}}
                    {{-- <div class="row mb-3">
                                <label class="col-sm-5 col-form-label" for="basic-default-name">Riwayat Mutasi :</label>
                                <div>
                                    <table>
                                        <tr>
                                            <td>1. Pindah Dari Bangsal : <input type="text" class="d-inline form-control"
                                                    placeholder="Bangsal 1..." disabled></td>
                                            <td>Ke :
                                                <input type="text" class="d-inline form-control" placeholder="....."
                                                    disabled>
                                            </td>
                                            <td>Tanggal :<input type="date" class=" d-inline  form-control" disabled></td>
                                        </tr>
                                        <tr>
                                            <td>2. Pindah Dari Bangsal : <input type="text" class=" d-inline  form-control"
                                                    placeholder="Bangsal 2" disabled></td>
                                            <td>Ke :
                                                <input type="text" class=" d-inline  form-control" placeholder="...."
                                                    disabled>
                                            </td>
                                            <td>Tanggal :<input type="date" class=" d-inline  form-control" disabled></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endrole --}}

                    {{-- @role('Admin') --}}
                    {{-- kanan --}}
                    <div class="col-md-6">
                        {{-- kedatangan pasien --}}
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Kedatangan Pasien</label>
                            <div>
                                <table>
                                    <tr>
                                        <td>
                                            <input type="radio" name="kedatangan_pasien" class="mx-2" checked
                                                value="Datang Sendiri" @required(true)>Datang Sendiri
                                        </td>
                                        <td>
                                            <input type="radio" name="kedatangan_pasien" id="kedatangan_pasienlainnya"
                                                class="mx-2" value="Dirujuk Oleh" @required(true)>Dirujuk Oleh....
                                        </td>
                                    </tr>
                                </table>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="kedatangan_rujukan"
                                        style="display: none;" id="kedatangan_rujukan" placeholder="Dirujuk Oleh">
                                </div>
                            </div>
                        </div>
                        <hr>
                        {{-- jalur masuk rumah sakit --}}
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Masuk Rumah Sakit
                                Melalui :</label>
                            <div>
                                <input type="radio" class="mx-2" name="jalur_masuk_rs" @required(true) checked
                                    value="Poliklinik">Poliklinik
                                <input type="radio" class="mx-2" name="jalur_masuk_rs" @required(true)
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
                                            <input type="radio" class="mx-2" @required(true) name="keadaan_keluar"
                                                checked value="Sembuh">Sembuh
                                        </td>
                                        <td>
                                            <input type="radio" class="mx-2" @required(true) name="keadaan_keluar"
                                                value="Perbaikan">Perbaikan
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="radio" class="mx-2" @required(true) name="keadaan_keluar"
                                                value="Menetap/Memburuk">Menetap/Memburuk
                                        </td>
                                        <td>
                                            <input type="radio" class="mx-2" @required(true) name="keadaan_keluar"
                                                value="Cacat">Cacat
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="radio" class="mx-2" @required(true) name="keadaan_keluar"
                                                value="Meninggal < 48 Jam">Meninggal < 48 Jam </td>
                                        <td>
                                            <input type="radio" class="mx-2" @required(true) name="keadaan_keluar"
                                                value="Meninggal > 48 jam">Meninggal > 48 jam
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>


                    {{-- @else --}}
                    {{-- kanan --}}
                    {{-- <div class="col-md-6"> --}}
                    {{-- kedatangan pasien --}}
                    {{-- <div class="row mb-3">
                                <label class="col-sm-5 col-form-label" for="basic-default-name">Kedatangan Pasien</label>
                                <div>
                                    <table>
                                        <tr>
                                            <td>
                                                <input type="radio" class="mx-2" checked value="Datang Sendiri"
                                                    disabled>Datang Sendiri
                                            </td>
                                            <td>
                                                <input type="radio" class="mx-2" value="Dirujuk Oleh" disabled>Dirujuk
                                                Oleh....
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <hr> --}}
                    {{-- jalur masuk rumah sakit --}}
                    {{-- <div class="row mb-3">
                                <label class="col-sm-5 col-form-label" for="basic-default-name">Masuk Rumah Sakit
                                    Melalui :</label>
                                <div>
                                    <input type="radio" class="mx-2" checked value="Poliklinik" disabled>Poliklinik
                                    <input type="radio" class="mx-2" value="IGD" disabled>IGD
                                </div>
                            </div> --}}

                    {{-- Keadaan Keluar --}}
                    {{-- <div class="row mb-3">
                                <label class="col-sm-5 col-form-label" for="basic-default-name">Keadaan Keluar</label>
                                <div>
                                    <table>
                                        <tr>
                                            <td>
                                                <input type="radio" class="mx-2" checked value="Sembuh" disabled>Sembuh
                                            </td>
                                            <td>
                                                <input type="radio" class="mx-2" value="Perbaikan" disabled>Perbaikan
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="radio" class="mx-2" value="Menetap/Memburuk"
                                                    disabled>Menetap/Memburuk
                                            </td>
                                            <td>
                                                <input type="radio" class="mx-2" value="Cacat" disabled>Cacat
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="radio" class="mx-2" value="Meninggal < 48 Jam"
                                                    disabled>Meninggal < 48 Jam </td>
                                            <td>
                                                <input type="radio" class="mx-2" value="Meninggal > 48 jam"
                                                    disabled>Meninggal > 48 jam
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endrole --}}

                    <hr>
                    <div class="col-md-6">
                        {{-- cara keluar --}}
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="cara-keluar">Cara Keluar :</label>
                            <div>
                                {{-- @role('Admin') --}}
                                <table>
                                    <tr>
                                        <td>
                                            <input type="radio" @required(true) name="cara_keluar" class="mx-2"
                                                checked value="Atas Persetujuan">Atas Persetujuan
                                        </td>
                                        <td>
                                            <input type="radio" @required(true) name="cara_keluar" class="mx-2"
                                                value="Lari">Lari
                                        </td>
                                        <td>
                                            <input type="radio" @required(true) name="cara_keluar" class="mx-2"
                                                value="Meninggal">Meninggal
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="radio" @required(true) name="cara_keluar" class="mx-2"
                                                value="Pulang APS">Pulang APS
                                        </td>
                                        <td>
                                            <input type="radio" @required(true) name="cara_keluar" class="mx-2"
                                                value="Pindah RS Lain">Pindah RS Lain
                                        </td>
                                    </tr>
                                </table>

                                {{-- @else
                                    <table>
                                        <tr>
                                            <td>
                                                <input type="radio" class="mx-2" value="Atas Persetujuan" disabled>
                                                Atas Persetujuan
                                            </td>
                                            <td>
                                                <input type="radio" class="mx-2" value="Lari" disabled>
                                                Lari
                                            </td>
                                            <td>
                                                <input type="radio" class="mx-2" value="Meninggal" disabled>
                                                Meninggal
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="radio" class="mx-2" value="Pulang APS" disabled>
                                                Pulang APS
                                            </td>
                                            <td>
                                                <input type="radio" class="mx-2" value="Pindah RS Lain" disabled>
                                                Pindah RS Lain
                                            </td>
                                        </tr>
                                    </table>
                                @endhasanyrole --}}

                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="col-md-6">
                        {{-- cara keluar --}}
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Meninggal</label>
                            {{-- @role('Admin') --}}
                            <div>
                                <table>
                                    <tr>
                                        <td>
                                            <input type="radio" name="meninggal" class="mx-2" checked
                                                value="Autopsi">Autopsi
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="radio" name="meninggal" class="mx-2"
                                                value="Tanpa Autopsi">Tanpa Autopsi
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            {{-- @else
                                <div>
                                    <table>
                                        <tr>
                                            <td>
                                                <input type="radio" class="mx-2" checked value="Autopsi" disabled>Autopsi
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="radio" class="mx-2" value="Tanpa Autopsi" disabled>Tanpa
                                                Autopsi
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            @endrole --}}
                        </div>
                        <hr>
                    </div>

                    {{-- table Diagnosis --}}
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr class="text-nowrap bg-dark">
                                    <th>Diagnosis (Dengan Huruf Cetak, Jangan Disingkat)</th>
                                    <th></th>
                                    <th>Kode Diagnosa Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        Diagnosa Utama
                                    </td>
                                    {{-- @hasanyrole('Admin') --}}
                                    <td>
                                        <input type="text" name="diagnosa_utama" id="diagnosa_utama"
                                            @required(true) class="d-inline form-control">
                                    </td>
                                    {{-- @else
                                        <td>
                                            <input type="text" class="d-inline form-control" disabled>
                                        </td>
                                    @endhasanyrole --}}

                                    {{-- @role('Admin') --}}
                                    <td>ICD X : <input type="text" name="icd_diagnosa_utama" id=""
                                            @required(true) class="d-inline form-control" style="width:320px"></td>
                                    {{-- @else
                                        <td>ICD X : <input type="text" class="d-inline form-control" style="width:320px"
                                                disabled></td>
                                    @endrole --}}
                                </tr>
                                <tr>
                                    <td>
                                        Diagnosa Sekunder
                                    </td>

                                    {{-- @hasanyrole('Admin') --}}
                                    <td>
                                        <input type="text" name="diagnosa_sekunder" id="diagnosa_sekunder"
                                            @required(true) class="d-inline form-control">
                                    </td>
                                    {{-- @else
                                        <td>
                                            <input type="text" class="d-inline form-control" disabled>
                                        </td>
                                    @endhasanyrole --}}

                                    {{-- @role('Admin') --}}
                                    <td>ICD X : <input type="text" name="icd_diagnosa_sekunder" @required(true)
                                            class=" d-inline form-control" style="width:320px"></td>
                                    {{-- @else
                                        <td>ICD X : <input type="text" class="d-inline form-control" style="width:320px"
                                                disabled></td>
                                    @endrole --}}
                                </tr>
                                <tr>
                                    <td>
                                        Diagnosa Kompikasi dan Resiko Yang Muncul
                                    </td>

                                    {{-- @hasanyrole('Admin') --}}
                                    <td>
                                        <input type="text" name="komplikasi_dan_resiko" id="komplikasi_dan_resiko"
                                            @required(true) class="d-inline form-control">
                                    </td>
                                    {{-- @else
                                        <td>
                                            <input type="text" class="d-inline form-control" disabled>
                                        </td>
                                    @endhasanyrole --}}

                                    {{-- @role('Admin') --}}
                                    <td>ICD X : <input type="text" name="icd_komplikasi_dan_resiko" id=""
                                            @required(true) class=" d-inline form-control" style="width:320px"></td>
                                    {{-- @else
                                        <td>ICD X : <input type="text" class="d-inline form-control" style="width:320px"
                                                disabled></td>
                                    @endrole --}}
                                </tr>
                                <tr>
                                    <td>
                                        Tindakan Operasi
                                    </td>

                                    {{-- @hasanyrole('Admin') --}}
                                    <td>
                                        <input type="text" name="tindakan_operasi" @required(true)
                                            class="d-inline form-control">
                                    </td>
                                    {{-- @else
                                        <td>
                                            <input type="text" class="d-inline form-control" disabled>
                                        </td>
                                    @endhasanyrole --}}

                                    {{-- @role('Admin') --}}
                                    <td>ICD X : <input type="text" name="icd_tindakan_operasi" @required(true)
                                            class=" d-inline form-control" style="width:320px"></td>
                                    {{-- @else
                                        <td>ICD X : <input type="text" class=" d-inline form-control" style="width:320px"
                                                disabled></td>
                                    @endrole --}}
                                </tr>
                                {{-- @role('Admin') --}}
                                <tr>
                                    <td>
                                        Riwayat Alergi
                                        <input type="radio" name="riwayat_alergi" id="" value="Tidak"
                                            checked @required(true) class="ms-2 d-inline">
                                        Tidak
                                        <input type="radio" name="riwayat_alergi" id="" value="Ada"
                                            @required(true) class="ms-2 d-inline">
                                        Ada
                                    </td>
                                    <td colspan="2">
                                        Riwayat Tranfusi
                                        <input type="radio" name="riwayat_transfusi" id="" value="Tidak"
                                            checked @required(true) class="ms-2 d-inline">
                                        Tidak
                                        <input type="radio" name="riwayat_transfusi" id="" value="Ada"
                                            @required(true) class="ms-2 d-inline">
                                        Ada
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Boleh Pulang /APS/Meninggal :
                                        <input type="date" name="tanggal_aps" id="" value="Tidak"
                                            @required(true) class="form-control d-inline" style="width:120px">
                                        <input type="time" name="jam_aps" id="" value="Tidak"
                                            @required(true) class="form-control d-inline" style="width:120px">
                                    </td>
                                    <td colspan="2">
                                        Kontrol Kembali :
                                        <input type="date" name="tanggal_kontrol" id="" value="Tidak"
                                            @required(true) class="form-control d-inline" style="width:120px">

                                        <input type="time" name="jam_kontrol" id="" value="Tidak"
                                            @required(true) class="form-control d-inline" style="width:120px">
                                    </td>
                                </tr>

                                {{-- @else
                                    <tr>
                                        <td>
                                            Riwayat Alergi
                                            <input type="radio" id="" value="Tidak" checked
                                                class="ms-2 d-inline" disabled>
                                            Tidak
                                            <input type="radio" id="" value="Ada" class="ms-2 d-inline"
                                                disabled>
                                            Ada
                                        </td>
                                        <td colspan="2">
                                            Riwayat Tranfusi
                                            <input type="radio" id="" value="Tidak" checked
                                                class="ms-2 d-inline" disabled>
                                            Tidak
                                            <input type="radio" id="" value="Ada" class="ms-2 d-inline"
                                                disabled>
                                            Ada
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Boleh Pulang /APS/Meninggal :
                                            <input type="date" value="Tidak" class="form-control d-inline"
                                                style="width:120px" disabled>
                                            <input type="time" value="Tidak" class="form-control d-inline"
                                                style="width:120px" disabled>
                                        </td>
                                        <td colspan="2">
                                            Kontrol Kembali :
                                            <input type="date" value="Tidak" class="form-control d-inline"
                                                style="width:120px" disabled>

                                            <input type="time" value="Tidak" class="form-control d-inline"
                                                style="width:120px" disabled>
                                        </td>
                                    </tr>
                                @endrole --}}
                            </tbody>
                        </table>
                    </div>

                    {{-- ttd --}}
                    {{-- <div class="col-12 mt-5">
                        <div class="row mb-3">
                            <div class="col-4 text-center">
                                DPJP Tambahan 1
                            </div>
                            <div class="col-4 text-center">
                                DPJP Tambahan 2
                            </div>
                            <div class="col-4 text-center">
                                DPJP Utama
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4 text-center">
                                <img src="" alt="" id="ImgTtdPenerimaInformasi">
                                <textarea id="ttdPenerimaInformasi" name="ttdPenerimaInformasi" style="display: none;"></textarea>
                                <button type="button" class="col-12 btn btn-sm btn-dark"
                                    onclick="openModalTtdBottom(this, 'ImgTtdPenerimaInformasi', 'ttdPenerimaInformasi')">Tanda
                                    Tangan</button>
                            </div>
                            <div class="col-4 text-center">
                                <img src="" alt="" id="ImgTtdHub1">
                                <textarea id="ttdHub1" name="ttdHub1" style="display: none;"></textarea>
                                <button type="button" class="col-12 btn btn-sm btn-dark"
                                    onclick="openModalTtdBottom(this, 'ImgTtdHub1', 'ttdHub1')">Tanda Tangan</button>
                            </div>
                            <div class="col-4 text-center">
                                <img src="" alt="" id="ImgTtdPpj">
                                <textarea id="ttdPpj" name="ttd_admisi" style="display: none;"></textarea>
                                <button type="button" class="col-12 btn btn-sm btn-dark" onclick="openModal(this)">Tanda
                                    Tangan</button>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-4 text-center">
                                <input type="text" class="form-control form-control-sm" name="namaPenerimaInformasi"
                                    placeholder="Nama Lengkap" id="namaPenerimaInformasi">
                            </div>
                            <div class="col-4 text-center">
                                <input type="text" class="form-control form-control-sm" name="namaHub1"
                                    placeholder="Nama Lengkap">
                            </div>
                            <div class="col-4 text-center">
                                <input type="text" class="form-control form-control-sm" name="namaHub2"
                                    placeholder="Nama Lengkap">
                            </div>

                        </div>
                    </div> --}}

                    <div class="col-sm-10 mt-4">
                        <button type="submit" class="btn btn-sm btn-dark">Buat Ringkasan</button>
                    </div>
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
