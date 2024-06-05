@extends('layouts.backend.main')

@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Monitoring Pacu</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="">
                @csrf
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">masuk ruang pulih</label>
                    <div class="col-sm-10">
                        <div class="row">
                            <label class="col-sm-1 col-form-label" for="basic-default-name">Jam</label>
                            <div class="col-sm-11">
                                <input type="time" name="jam_masuk" class="form-control" id="basic-default-name"
                                    @required(true)>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-form-label col-sm-2">Tanda Vital</label>
                    <div class="col-sm-10">
                        <div class="row mb-3">
                            <div class="col-sm-2">
                                <div class="row">
                                    <label class="col-form-label col-sm-12" for="tekanan-darah">Tekanan Darah</label>
                                    <div class="col-8">
                                        <input type="text" class="form-control form-control-sm" name="tekanan-darah"
                                            id="tekanan-darah" placeholder="" aria-describedby="floatingInputHelp" />
                                    </div>
                                    <div class="col-4 m-0 p-0">
                                        <p class="m-0">mmHg</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="row">
                                    <label class="col-form-label col-sm-12" for="nadi">Nadi</label>
                                    <div class="col-8">
                                        <input type="text" class="form-control form-control-sm" name="nadi"
                                            id="nadi" placeholder="" aria-describedby="floatingInputHelp" />
                                    </div>
                                    <div class="col-4 m-0 p-0">
                                        <p class="m-0">x/menit</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="row">
                                    <label class="col-form-label col-sm-12" for="nafas">Nafas</label>
                                    <div class="col-8">
                                        <input type="text" class="form-control form-control-sm" name="nafas"
                                            id="nafas" placeholder="" aria-describedby="floatingInputHelp" />
                                    </div>
                                    <div class="col-4 m-0 p-0">
                                        <p class="m-0">x/menit</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="row">
                                    <label class="col-form-label col-sm-12" for="temperatur">Temperatur</label>
                                    <div class="col-10">
                                        <input type="text" class="form-control form-control-sm" name="temperatur"
                                            id="temperatur" placeholder="" aria-describedby="floatingInputHelp" />
                                    </div>
                                    <div class="col-2 m-0 p-0">
                                        <p class="m-0">°C</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="row">
                                    <label class="col-form-label col-sm-12" for="vas">VAS</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control form-control-sm" name="vas"
                                            id="vas" placeholder="" aria-describedby="floatingInputHelp" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="row">
                                    <label class="col-form-label col-sm-12" for="spo2">SPO2</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control form-control-sm" name="spo2"
                                            id="spo2" placeholder="" aria-describedby="floatingInputHelp" />
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-form-label col-sm-2">Kesadaran</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="kesadaran" id="sadar"
                                value="option1" />
                            <label class="form-check-label" for="sadar">Sadar</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="kesadaran" id="belumsadar"
                                value="option2" />
                            <label class="form-check-label" for="belumsadar">Belum Sadar</label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-form-label col-sm-2">Pernafasan</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="pernafasan" id="spontan"
                                value="option1" />
                            <label class="form-check-label" for="spontan">Spontan</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="pernafasan" id="dibantu"
                                value="option2" />
                            <label class="form-check-label" for="dibantu">Dibantu</label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Penyulit Intra Operatif</label>
                    <div class="col-sm-10">
                        <input type="text" name="penyulit-intra-operatif" class="form-control"
                            id="basic-default-name" @required(true)>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Instruksi Khusus</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="editor" rows="3"></textarea>
                    </div>
                </div>
                <h6 class="text-center bg-dark text-white py-2">MONITORING TANDA-TANDA VITAL PASCA ANESTESI</h6>
                <div class="mb-3">
                    <table class="table-bordered w-100 text-center text-body">
                        <thead>
                            <tr>
                                <th style="width: 40px">R</th>
                                <th style="width: 40px">N</th>
                                <th style="width: 40px">TD</th>
                                <th style="width: 40px">T</th>
                                <th style="width: 30px"></th>
                                <th style="width: 30px"></th>
                                <th style="width: 30px"></th>
                                <th style="width: 30px"></th>
                                <th style="width: 30px"></th>
                                <th style="width: 30px"></th>
                                <th style="width: 30px"></th>
                                <th style="width: 30px"></th>
                                <th style="width: 30px"></th>
                                <th style="width: 30px"></th>
                                <th style="width: 30px"></th>
                                <th style="width: 30px"></th>
                                <th style="width: 30px"></th>
                                <th style="width: 30px"></th>
                                <th style="width: 30px"></th>
                                <th style="width: 30px"></th>
                                <th style="width: 30px"></th>
                                <th style="width: 30px"></th>
                                <th style="width: 30px"></th>
                                <th style="width: 30px"></th>
                                <th style="width: 30px"></th>
                                <th style="width: 30px"></th>
                                <th style="width: 30px"></th>
                                <th style="width: 30px"></th>
                                <th style="width: 30px"></th>
                                <th style="width: 30px"></th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>28</td>
                                <td></td>
                                <td>220</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>20</td>
                                <td></td>
                                <td>200</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>16</td>
                                <td></td>
                                <td>160</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>12</td>
                                <td></td>
                                <td>180</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>180</td>
                                <td>140</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>160</td>
                                <td>120</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>140</td>
                                <td>100</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>120</td>
                                <td>80</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>100</td>
                                <td>60</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>80</td>
                                <td>40</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>60</td>
                                <td>20</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>0</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Perkembangan Skor Pemulihan</label>
                    <div class="col-sm-10">
                        <input type="text" name="perkembangan-skor-pemulihan" class="form-control"
                            id="basic-default-name" @required(true)>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Drain</label>
                    <div class="col-sm-10">
                        <input type="text" name="drain" class="form-control" id="basic-default-name"
                            @required(true)>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Infus</label>
                    <div class="col-sm-10">
                        <input type="text" name="infus" class="form-control" id="basic-default-name"
                            @required(true)>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Cateter</label>
                    <div class="col-sm-10">
                        <input type="text" name="cateter" class="form-control" id="basic-default-name"
                            @required(true)>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Haemovac</label>
                    <div class="col-sm-10">
                        <input type="text" name="haemovac" class="form-control" id="basic-default-name"
                            @required(true)>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Perawat</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" name="perawat_id" @required(true)>
                            <option value=""></option>
                        </select>
                    </div>
                </div>
                <h6 class="text-center bg-dark text-white py-2">SKOR PEMULIHAN PASCA ANESTESI</h6>
                <div class="row mb-3">
                    <div class="col-4 border">
                        <h5 class="mt-2 text-center m-0 mb-3">
                            SKOR PEMULIHAN PASCA ANESTESI SPINAL
                            <small>BROMAGE SCORE (DEWASA)</small>
                        </h5>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="basic-default-name">Jam Masuk</label>
                            <div class="col-sm-9">
                                <input type="time" name="jam_masuk" class="form-control form-control-sm"
                                    id="basic-default-name" @required(true)>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="basic-default-name">Jam Keluar</label>
                            <div class="col-sm-9">
                                <input type="time" name="jam_keluar" class="form-control form-control-sm"
                                    id="basic-default-name" @required(true)>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-body text-center" style="width: 320px">Penilaian</th>
                                    <th class="text-body text-center">Skor</th>
                                    <th class="text-body text-center">Skor Pasien</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="m-0 p-0">a. Gerakan penuh tungkai</td>
                                    <td class="text-center">0</td>
                                    <td>
                                        <input type="number" name="skor_pasien_a" class="form-control form-control-sm"
                                            id="basic-default-name">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="m-0 p-0">b. Tidak mampu ekstensi tungkai</td>
                                    <td class="text-center">1</td>
                                    <td>
                                        <input type="number" name="skor_pasien_b" class="form-control form-control-sm"
                                            id="basic-default-name">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="m-0 p-0">c. Tidak mampu fleksi lutut</td>
                                    <td class="text-center">2</td>
                                    <td>
                                        <input type="number" name="skor_pasien_c" class="form-control form-control-sm"
                                            id="basic-default-name">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="m-0 p-0">d. Tidak mampu fleksi pergelangan kaki</td>
                                    <td class="text-center">3</td>
                                    <td>
                                        <input type="number" name="skor_pasien_d" class="form-control form-control-sm"
                                            id="basic-default-name">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-end" colspan="2">
                                        <small>JUMLAH</small>
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                        <small class="mb-5">Jika jumlahnya ≤ 2, pasien boleh pindah keruangan</small>
                        <div class="row mb-3 mt-5">
                            <div class="col-4 text-center">
                                <br>
                                <small>Dokter Anestesi</small>
                                <br><br><br>
                                <small>(.................................)</small>
                            </div>
                            <div class="col-4"></div>
                            <div class="col-4 text-center">
                                <small>Padang, 19-11-2023</small>
                                <small>Perawat PACU</small>
                                <br><br><br>
                                <small>(.................................)</small>
                            </div>
                            <div class="col-12 text-center">
                                <small>Perawat Ruangan</small>
                                <br><br><br>
                                <small>(.................................)</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 border">
                        <h5 class="mt-2 text-center m-0 mb-3">
                            SKOR PEMULIHAN PASCA ANESTESI UMUM
                            <small>STEWARD SCORE (ANAK-ANAK)</small>
                        </h5>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="basic-default-name">Jam Masuk</label>
                            <div class="col-sm-9">
                                <input type="time" name="jam_masuk" class="form-control form-control-sm"
                                    id="basic-default-name" @required(true)>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="basic-default-name">Jam Keluar</label>
                            <div class="col-sm-9">
                                <input type="time" name="jam_keluar" class="form-control form-control-sm"
                                    id="basic-default-name" @required(true)>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-body text-center">No</th>
                                    <th class="text-body text-center" style="width: 300px">Penilaian</th>
                                    <th class="text-body text-center">Skor</th>
                                    <th class="text-body text-center">Skor Pasien</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td class="m-0 p-0">
                                        <small class="m-0">
                                            Pergerakan
                                            <ul class="m-0">
                                                <li>Gerak Bertujuan</li>
                                                <li>Gerak Tak Bertujuan</li>
                                                <li>Tidak Bergerak</li>
                                            </ul>
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        <small>
                                            <br>
                                            2 <br>
                                            1 <br>
                                            0
                                        </small>
                                    </td>
                                    <td>
                                        <input type="number" name="skor_pasien_1" class="form-control form-control-sm"
                                            id="basic-default-name">
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td class="m-0 p-0">
                                        <small class="m-0">
                                            Pernafasan
                                            <ul class="m-0">
                                                <li>Batuk, Menangis</li>
                                                <li>Pertahankan Jalan Nafas</li>
                                                <li>Perlu Bantuan</li>
                                            </ul>
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        <small>
                                            <br>
                                            2 <br>
                                            1 <br>
                                            0
                                        </small>
                                    </td>
                                    <td>
                                        <input type="number" name="skor_pasien_2" class="form-control form-control-sm"
                                            id="basic-default-name">
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td class="m-0 p-0">
                                        <small class="m-0">
                                            Kesadaran
                                            <ul class="m-0">
                                                <li>Menangis</li>
                                                <li>Beraksi Terhadap Rangsangan</li>
                                                <li>Tidak Respon</li>
                                            </ul>
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        <small>
                                            <br>
                                            2 <br>
                                            1 <br>
                                            0
                                        </small>
                                    </td>
                                    <td>
                                        <input type="number" name="skor_pasien_3" class="form-control form-control-sm"
                                            id="basic-default-name">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-end" colspan="3">
                                        <small>JUMLAH</small>
                                    </td>
                                    <td></td>
                                </tr>

                            </tbody>
                        </table>
                        <small class="mb-5">Jika jumlahnya > 5, pasien boleh pindah keruangan</small>
                        <div class="row mb-3 mt-5">
                            <div class="col-4 text-center">
                                <br>
                                <small>Dokter Anestesi</small>
                                <br><br><br>
                                <small>(.................................)</small>
                            </div>
                            <div class="col-4"></div>
                            <div class="col-4 text-center">
                                <small>Padang, 19-11-2023</small>
                                <small>Perawat PACU</small>
                                <br><br><br>
                                <small>(.................................)</small>
                            </div>
                            <div class="col-12 text-center">
                                <small>Perawat Ruangan</small>
                                <br><br><br>
                                <small>(.................................)</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 border">
                        <h5 class="mt-2 text-center m-0 mb-3">
                            SKOR PEMULIHAN PASCA ANESTESI UMUM
                            <small>ALDRETE SCORE (DEWASA)</small>
                        </h5>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="basic-default-name">Jam Masuk</label>
                            <div class="col-sm-9">
                                <input type="time" name="jam_masuk" class="form-control form-control-sm"
                                    id="basic-default-name" @required(true)>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="basic-default-name">Jam Keluar</label>
                            <div class="col-sm-9">
                                <input type="time" name="jam_keluar" class="form-control form-control-sm"
                                    id="basic-default-name" @required(true)>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-body text-center ">No</th>
                                    <th class="text-body text-center" style="width: 500px !important">Penilaian</th>
                                    <th class="text-body text-center">Skor</th>
                                    <th class="text-body text-center">Skor Pasien</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td class="m-0 p-0">
                                        <small class="m-0">
                                            Aktivitas Motorik
                                            <ul class="m-0">
                                                <li>Mampu menggerakkan 4 ekstremitas</li>
                                                <li>Mampu menggerakkan 2 ekstremitas</li>
                                                <li>Tidak mampu menggerakkan ekstremitas</li>
                                            </ul>
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        <small>

                                            2 <br><br>
                                            1 <br><br>
                                            0
                                        </small>
                                    </td>
                                    <td>
                                        <input type="number" name="skor_pasien_1" class="form-control form-control-sm"
                                            id="basic-default-name">
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td class="m-0 p-0">
                                        <small class="m-0">
                                            Respirasi
                                            <ul class="m-0">
                                                <li>Mampu bernafas dalam, batuk & tangis kuat</li>
                                                <li>Dyspnea atau bernafas dangkal</li>
                                                <li>Apnea</li>
                                            </ul>
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        <small>
                                            <br>
                                            2 <br><br>
                                            1 <br><br>
                                            0
                                        </small>
                                    </td>
                                    <td>
                                        <input type="number" name="skor_pasien_2" class="form-control form-control-sm"
                                            id="basic-default-name">
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td class="m-0 p-0">
                                        <small class="m-0">
                                            Sirkulasi
                                            <ul class="m-0">
                                                <li>TD > 20% dari Pra Anestesi</li>
                                                <li>TD 20 - 50% dari Pra Anestesi</li>
                                                <li>TD > 50% dari Pra Anestesi</li>
                                            </ul>
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        <small>

                                            2 <br><br>
                                            1 <br><br>
                                            0
                                        </small>
                                    </td>
                                    <td>
                                        <input type="number" name="skor_pasien_2" class="form-control form-control-sm"
                                            id="basic-default-name">
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td class="m-0 p-0">
                                        <small class="m-0">
                                            Kesadaran
                                            <ul class="m-0">
                                                <li>Sadar Penuh</li>
                                                <li>Terbangun saat dipanggil</li>
                                                <li>Tidak Respon</li>
                                            </ul>
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        <small>
                                            <br>
                                            2 <br>
                                            1 <br>
                                            0
                                        </small>
                                    </td>
                                    <td>
                                        <input type="number" name="skor_pasien_2" class="form-control form-control-sm"
                                            id="basic-default-name">
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td class="m-0 p-0">
                                        <small class="m-0">
                                            Saturasi Oksigen
                                            <ul class="m-0">
                                                <li>> 92% saat bernafas dengan udara ruang</li>
                                                <li>Butuh oksigen tambahan untuk
                                                    mempertahankan saturasi > 90%</li>
                                                <li>
                                                    < 90% bahkan dengan oksigen tambahan</li>
                                            </ul>
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        <small>

                                            2 <br><br>
                                            1 <br><br><br>
                                            0
                                        </small>
                                    </td>
                                    <td>
                                        <input type="number" name="skor_pasien_2" class="form-control form-control-sm"
                                            id="basic-default-name">
                                    </td>
                                </tr>


                            </tbody>
                        </table>
                        <small class="mb-5">Jika jumlahnya > 8 tanpa nilai 0, pasien boleh pindah keruangan</small>
                        <div class="row mb-3">
                            <div class="col-4 text-center">
                                <br>
                                <small>Dokter Anestesi</small>
                                <br><br><br>
                                <small>(.................................)</small>
                            </div>
                            <div class="col-4"></div>
                            <div class="col-4 text-center">
                                <small>Padang, 19-11-2023</small>
                                <small>Perawat PACU</small>
                                <br><br><br>
                                <small>(.................................)</small>
                            </div>
                            <div class="col-12 text-center">
                                <small>Perawat Ruangan</small>
                                <br><br><br>
                                <small>(.................................)</small>
                            </div>
                        </div>
                    </div>
                </div>
                <h5 class="m-0 mb-3">Kriteria Keluar Ruang PACU</h5>
                <div class="row">
                    <div class="col-4">
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">alderete score</label>
                            <div class="col-sm-7">
                                <input type="text" name="alderete_score" class="form-control" id="basic-default-name"
                                    disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Bromage score</label>
                            <div class="col-sm-7">
                                <input type="text" name="bromage_score" class="form-control" id="basic-default-name"
                                    disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">steward score</label>
                            <div class="col-sm-7">
                                <input type="text" name="steward_score" class="form-control" id="basic-default-name"
                                    disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Jam Keluar ruang Pacu</label>
                    <div class="col-sm-10">
                        <input type="time" name="jam_keluar_pacu" class="form-control" id="basic-default-name"
                            @required(true)>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-form-label col-sm-2">Ke Ruang</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="ke-ruang" id="rawat_inap"
                                value="option1" />
                            <label class="form-check-label" for="rawat_inap">Rawat Inap</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="ke-ruang" id="hcu"
                                value="option2" />
                            <label class="form-check-label" for="hcu">HCU</label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Catatan khusus ruang pacu</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="editor1" rows="3"></textarea>
                    </div>
                </div>
                <h5 class="m-0 mb-3">Instruksi Pasca Anestesi</h5>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Infus</label>
                    <div class="col-sm-10">
                        <input type="time" name="infus" class="form-control" id="basic-default-name"
                            @required(true)>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">penangan mual / muntah</label>
                    <div class="col-sm-10">
                        <input type="time" name="penangan_mual_muntah" class="form-control" id="basic-default-name"
                            @required(true)>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Pengelola nyeri</label>
                    <div class="col-sm-10">
                        <input type="time" name="pengelola_nyeri" class="form-control" id="basic-default-name"
                            @required(true)>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Obat - Obat Lain</label>
                    <div class="col-sm-10">
                        <input type="time" name="obat_lain" class="form-control" id="basic-default-name"
                            @required(true)>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Diet dan Nutrisi</label>
                    <div class="col-sm-10">
                        <input type="time" name="diet_nutrisi" class="form-control" id="basic-default-name"
                            @required(true)>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label" for="basic-default-name">Pemantauan Tensi, Nadi dan
                        Nafas</label>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-6">
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-name">Setiap</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="setiap" class="form-control"
                                            id="basic-default-name" @required(true)>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-name">Selama</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="selama" class="form-control"
                                            id="basic-default-name" @required(true)>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h5 class="m-0 mb-3">Khusus Rawat Jalan</h5>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">skor PADSS</label>
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-4">
                                <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label" for="basic-default-name">Tanda Vital</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="tanda_vital" class="form-control"
                                            id="basic-default-name" @required(true)>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label" for="basic-default-name">Mual / Muntah</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="mual_muntah" class="form-control"
                                            id="basic-default-name" @required(true)>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label" for="basic-default-name">Nyeri</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="nyeri" class="form-control"
                                            id="basic-default-name" @required(true)>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label" for="basic-default-name">Aktivitas</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="aktivitas" class="form-control"
                                            id="basic-default-name" @required(true)>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label" for="basic-default-name">pendarahan</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="pendarahan" class="form-control"
                                            id="basic-default-name" @required(true)>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="row mb-3">
                                    <label class="col-sm-5 col-form-label" for="basic-default-name">intake dan
                                        Output</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="intake_output" class="form-control"
                                            id="basic-default-name" @required(true)>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
            <div class="text-end">
                <button class="btn btn-success btn-sm">Submit</button>
            </div>
        </div>
    </div>
@endsection

<script></script>
