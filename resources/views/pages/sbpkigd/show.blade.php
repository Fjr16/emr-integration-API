@extends('layouts.backend.main')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="card mb-4">
        <div class="card-header m-0">
            <h5 class="mb-0 m-0">Triase</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <h6 class="m-0">Tanggal / Jam Masuk : </h6>
                </div>
                <div class="col-6 text-end">
                    <h6 class="m-0">Jam Respon : ................</h6>
                </div>
            </div>
            <hr class="m-0 mt-3">
            <div class="row">
                <div class="col-4">
                    <p class="fw-bold m-0 mt-2">Cara Masuk IGD :</p>
                    <div class="mb-3 mx-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                            <label class="form-check-label" for="defaultCheck1">
                                Jalan Kaki
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck2" />
                            <label class="form-check-label" for="defaultCheck2">
                                Brankar
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck3" />
                            <label class="form-check-label" for="defaultCheck3">
                                Kursi Roda
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck4" />
                            <label class="form-check-label" for="defaultCheck4">
                                Kendaraan / Ambulance
                            </label>
                        </div>
                        <div class="row mb-3">
                            <label class="form-control-label col-sm-12" for="lainya">Lainnya</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" id="lainnya" placeholder=""
                                    aria-describedby="floatingInputHelp" />
                            </div>
                            <div class="col-sm-2">
                                <button class="btn btn-dark btn-sm">+</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <p class="fw-bold m-0 mt-2">Asal Masuk :</p>
                    <div class="mb-3 mx-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                            <label class="form-check-label" for="defaultCheck1">
                                Datang Sendiri
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck2" />
                            <label class="form-check-label" for="defaultCheck2">
                                Poliklinik
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck3" />
                            <label class="form-check-label" for="defaultCheck3">
                                Diantar Polisi
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck4" />
                            <label class="form-check-label" for="defaultCheck4">
                                Rujukan
                            </label>
                        </div>
                        <div class="row mb-3">
                            <label class="form-control-label col-sm-12" for="lainya">Lainnya</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" id="lainnya" placeholder=""
                                    aria-describedby="floatingInputHelp" />
                            </div>
                            <div class="col-sm-2">
                                <button class="btn btn-dark btn-sm">+</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <p class="fw-bold m-0 mt-2">Jenis Kasue :</p>
                    <div class="mb-3 mx-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                            <label class="form-check-label" for="defaultCheck1">
                                Trauma
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck2" />
                            <label class="form-check-label" for="defaultCheck2">
                                Non Trauma
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="m-0">
            <p class="fw-bold m-0 mt-2">Keluhan Utama :</p>
            <table class="table table-bordered">
                <tr>
                    <td rowspan="2">PEMERIKSAAN</td>
                    <td colspan="10" class="text-center">SKALA</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="6" class="bg-danger text-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                <span class="fw-bold text-black">TRIASE 1 <br />
                                    (RESUSITASI) <br />0 MENIT</span>
                            </label>
                        </div>
                    </td>
                    <td class="bg-warning text-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                <span class="fw-bold text-black">TRIASE 2 <br />
                                    (EMERGENCY) <br />10 MENIT</span>
                            </label>
                        </div>
                    </td>
                    <td class="bg-success text-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                <span class="fw-bold text-black">TRIASE 3 <br />
                                    (URGENT) <br />30 MENIT</span>
                            </label>
                        </div>
                    </td>
                    <td class="bg-primary text-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                <span class="fw-bold text-black">TRIASE 4 <br />
                                    (LESS URGENT) <br />60 MENIT</span>
                            </label>
                        </div>
                    </td>
                    <td class="text-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                <span class="fw-bold text-black">TRIASE 5 <br />
                                    (NON URGENT) <br />120 MENIT</span>
                            </label>
                        </div>
                    </td>
                    <td class="bg-dark text-light text-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                <span class="fw-bold text-black">DEATH ON ARRIVAL <br> (DOA)</span>
                            </label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">JALAN NAFAS</td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                sumbatan
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                Bebas
                            </label>
                            <br />
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                ancaman
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                bebas
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                bebas
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                bebas
                            </label>
                        </div>
                    </td>
                    <td rowspan="6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                tidak ada <br />
                                tanda kehidupan</label><br />
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                tidak ada enyut nadi</label><br />
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                reflek cahaya (-/-)</label><br />
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                ekg flat</label><br />
                            <p>jam doa .......</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">PERNAFASAN</td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                henti nafas </label><br />
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                bradipnea </label><br />
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                sianosi
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                takipnea>32x
                            </label>
                            <br />
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                mengi/wheezing
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                normal </label><br />
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                mengi/wheezing
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                frekuensi <br />nafas normal
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                freksuensi <br />nafas normal
                            </label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">SIRKULASI</td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                henti jantung </label><br />
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                nadi tidak teraba</label><br />
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                akral dingin </label><br />
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                pucat <br />
                                (ctr > 2 detik)
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                nadi lemah
                            </label>
                            <br />
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                bradikardi <br />
                                50>x </label><br />
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                takikardi < 50x </label>
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault" />
                                    <label class="form-check-label" for="flexCheckDefault">
                                        pucat </label><br />
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault" />
                                    <label class="form-check-label" for="flexCheckDefault">
                                        akral dingin
                                    </label>
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault" />
                                    <label class="form-check-label" for="flexCheckDefault">
                                        crt > 2 detik
                                    </label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                nadi kuat</label><br />
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                takikardi 120-150x/mnt </label><br />
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                tds > 160mmhg </label><br />
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                tds > 160 mmhg
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                nadi kuat
                            </label>
                            <br />
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                frekuensi nadi <br />normal </label><br />
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                tds 140 140-160mmhg
                            </label>
                            <br />
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                tdd 90-100mmhg
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                nadi kuat </label><br />
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                frekuensi nadi <br />
                                normal </label><br />
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                td normal
                            </label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">KESADARAN</td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                gcs <= 8</label><br />
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault" />
                                    <label class="form-check-label" for="flexCheckDefault">
                                        kejang </label><br />
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault" />
                                    <label class="form-check-label" for="flexCheckDefault">
                                        tidak ada <br />
                                        respon
                                    </label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                gc 9-12
                            </label>
                            <br />
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                gelisah
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                gcs >= 12 </label><br />
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                apatis </label><br />

                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                somnolen
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                gcs 15
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                gcs 15
                            </label>
                        </div>
                    </td>
                </tr>
            </table>
            <p class="fw-bold">Ket : Pada tingkat kegawatan, berikan tanda centang (√) , pada kolom yang tersedia</p>
            <p class="text-uppercase fw-bold">intervensi dan responsnya <br>tindakan/medikamentosa</p>
            <table class="fw-bold text-uppercase w-100 table table-bordered">
                <tr class="border border-1">
                    <td style="width: 20%;">jalan nafas</td>
                    <td><input type="text" class="form-control"></td>
                </tr>
                <tr class="border border-1">
                    <td style="width: 20%;">pernapasan</td>
                    <td><input type="text" class="form-control"></td>
                </tr>
                <tr class="border border-1">
                    <td style="width: 20%;">sirkulasi</td>
                    <td><input type="text" class="form-control"></td>
                </tr>
                <tr class="border border-1">
                    <td style="width: 20%;">disabilitas</td>
                    <td><input type="text" class="form-control"></td>
                </tr>
                <tr class="border border-1">
                    <td style="width: 20%;">lain-lain</td>
                    <td><input type="text" class="form-control"></td>
                </tr>
            </table>

        </div>
    </div>
@endsection