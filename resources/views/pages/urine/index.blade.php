@extends('layouts.backend.main')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session()->has('forbidden'))
        <div class="alert alert-danger w-100 border mb-5 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('forbidden') }}
        </div>
    @endif
    <div class="card p-3 mt-5">
        <div class="container bg-light m-5">
            <h4>ASUHAN KEPERAWATAN PASIAN INSTALASI RAWAT JALAN</h4>
            <p>Tanggal : 12-12-2023</p>
            <form action="{{ route('urine.store') }}" method="POST">
                @csrf

                <table class="table table-light" id="input-table">
                    <tbody>
                        <tr>
                            <td class="fw-bold row">Data</td>
                            <td class="fw-bold row">Tanda & Gejala Mayor</td>
                            <td class="fw-bold row">Data Subjektif</td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="majorSubjektif[]"
                                        value="Sensasi penuh pada kandung kemih" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Sensasi penuh pada kandung kemih
                                    </label>
                                </div>
                            </td>
                            <td id="input-container1" class="row">
                                <input class="form-control form-control-sm mx-2" style="max-width: 300px"
                                    name="majorSubjektif[]" type="text" placeholder="Mengeluh Sulit Menggerakkan"
                                    aria-label=".form-control-sm example">
                                <a class="btn btn-sm btn-success mx-2" style="max-width: 30px"
                                    onclick="addInput('input-container1')">+</a>
                            </td>
                            <td class="fw-bold row">Data Objektif</td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="disuria / anuria"
                                        name="majorObjektif[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        disuria / anuria
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="majorObjektif[]"
                                        value="distensi kandung kemih" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        distensi kandung kemih
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="majorObjektif[]"
                                        value="kateter terpasang baik" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        kateter terpasang baik
                                    </label>
                                </div>
                            </td>
                            <td id="input-container2" class="row">
                                <input class="form-control form-control-sm mx-2" style="max-width: 300px"
                                    name="majorObjektif[]" type="text" placeholder="Mengeluh Sulit Menggerakkan"
                                    aria-label=".form-control-sm example">
                                <a class="btn btn-sm btn-success mx-2" style="max-width: 30px"
                                    onclick="addInput('input-container2')">+</a>
                            </td>
                            <td class="fw-bold row">Tanda & Gejala Minor</td>
                            <td class="fw-bold row">Data Subjektif</td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="minorSubjektif[]"
                                        value="dribbling(urine menetes)" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        dribbling(urine menetes)
                                    </label>
                                </div>
                            </td>
                            <td id="input-container3" class="row">
                                <input class="form-control form-control-sm mx-2" style="max-width: 300px"
                                    name="minorSubjektif[]" type="text" placeholder="Mengeluh Sulit Menggerakkan"
                                    aria-label=".form-control-sm example">
                                <a class="btn btn-sm btn-success mx-2" style="max-width: 30px"
                                    onclick="addInput('input-container3')">+</a>
                            </td>
                            <td class="fw-bold row">Data Objektif</td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="minorSubjektif[]"
                                        value="Inkontinensia berlebih" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Inkontinensia berlebih
                                    </label>
                                </div>
                            </td>
                            <td id="input-container4" class="row">
                                <input class="form-control form-control-sm mx-2" style="max-width: 300px"
                                    name="minorObjektif[]" type="text" placeholder="Mengeluh Sulit Menggerakkan"
                                    aria-label=".form-control-sm example">
                                <a class="btn btn-sm btn-success mx-2" style="max-width: 30px"
                                    onclick="addInput('input-container4')">+</a>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <hr class="mt-5">
                <hr class="">
                <hr class="mb-5">
                <table class="table table-light" id="input-table">
                    <tbody>
                        <tr>
                            <td class="fw-bold row">Diagnosis Keperewatan</td>
                            <td class="fw-bold row">Retensi Urine</td>
                            <td class="fw-bold row fst-italic">Berhubungan dengan</td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="peningkatan tekanan uretra"
                                        name="dkbd[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        peningkatan tekanan uretra
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="disfungsi neurologis (mis trauma, penyakit syaraf)" name="dkbd[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        disfungsi neurologis (mis trauma, penyakit syaraf)
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="efek agen farmakologis"
                                        name="dkbd[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        efek agen farmakologis
                                    </label>
                                </div>
                            </td>
                            <td class="fw-bold row fst-italic">Dibuktikan dengan</td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="sensasi penuh pada kandung kemih" name="dkdd[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        sensasi penuh pada kandung kemih
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="disuria / anuria"
                                        name="dkdd[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        disuria / anuria
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="distensi kandung kemih"
                                        name="dkdd[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        distensi kandung kemih
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="dribbling" name="dkdd[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        dribbling
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="inkontinensia berlebih"
                                        name="dkdd[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        inkontinensia berlebih
                                    </label>
                                </div>
                            </td>
                            <td id="input-container8" class="row">
                                <input class="form-control form-control-sm mx-2" style="max-width: 300px" name="dkdd[]"
                                    type="text" placeholder="Mengeluh Sulit Menggerakkan"
                                    aria-label=".form-control-sm example">
                                <a class="btn btn-sm btn-success mx-2" style="max-width: 30px"
                                    onclick="addInput('input-container8')">+</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr class="mt-5">
                <hr class="">
                <hr class="mb-5">
                <table class="table table-light" id="input-table">
                    <tbody>
                        <tr>
                            <td class="fw-bold row">Luaran</td>
                            <td class="row">
                                <p>Setelah dilakukan intervensi keperawatan selama</p>
                                <div class="input-group input-group-sm mb-3" style="max-width: 150px">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Jam</span>
                                    <input type="text" class="form-control" name="jam"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                </div>
                                <p>Maka eliminasi urine membaik, dengan kriteria hasil : </p>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="disuria / anuria menurun"
                                        name="luaran[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        disuria / anuria menurun
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="desakan kemih (urgensi) menurun" name="luaran[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        desakan kemih (urgensi) menurun
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="distensi kandung kemih menurun" name="luaran[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        distensi kandung kemih menurun
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="berkemih tidak tuntas menurun"
                                        name="luaran[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        berkemih tidak tuntas menurun
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="urine menetes (dribbling) menurun" name="luaran[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        urine menetes (dribbling) menurun
                                    </label>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr class="mt-5">
                <hr class="">
                <hr class="mb-5">
                <table class="table table-light" id="input-table">
                    <tbody>
                        <tr>
                            <td class="fw-bold row">Intervensi</td>
                            <td class="fw-bold row">Perawatan retensi urine</td>
                            <td class="fw-bold row">Tindakan</td>
                            <td class="fw-bold row">Observasi</td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="identifikasi penyebab retensi urine" name="observasi[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        identifikasi penyebab retensi urine
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="monitor kepatenan kateter urine" name="observasi[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        monitor kepatenan kateter urine
                                    </label>
                                </div>
                            </td>
                            <td id="input-container5" class="row">
                                <input class="form-control form-control-sm mx-2" style="max-width: 300px"
                                    name="observasi[]" type="text" placeholder="Mengeluh Sulit Menggerakkan"
                                    aria-label=".form-control-sm example">
                                <a class="btn btn-sm btn-success mx-2" style="max-width: 30px"
                                    onclick="addInput('input-container5')">+</a>
                            </td>
                            <td class="fw-bold row">Terapeutik</td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="sediakan privasi untuk berkemih" name="terapeutik[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        sediakan privasi untuk berkemih
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="pasang kateter urine jika perlu" name="terapeutik[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        pasang kateter urine jika perlu
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="gunakan teknik aseptik selama perawatan kateter urine" name="terapeutik[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        gunakan teknik aseptik selama perawatan kateter urine
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="pastikan kantong urine diletakkan dibawah dan tidak dilantai"
                                        name="terapeutik[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        pastikan kantong urine diletakkan dibawah dan tidak dilantai
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="kosongkan kantong urine jika sudah terisi setengahnya" name="terapeutik[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        kosongkan kantong urine jika sudah terisi setengahnya
                                    </label>
                                </div>
                            </td>
                            <td id="input-container6" class="row">
                                <input class="form-control form-control-sm mx-2" style="max-width: 300px"
                                    name="terapeutik[]" type="text" placeholder="Mengeluh Sulit Menggerakkan"
                                    aria-label=".form-control-sm example">
                                <a class="btn btn-sm btn-success mx-2" style="max-width: 30px"
                                    onclick="addInput('input-container6')">+</a>
                            </td>
                            <td class="fw-bold row">Edukasi</td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="ajarkan cara melakukan rangsangan berkemih" name="edukasi[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        ajarkan cara melakukan rangsangan berkemih
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="lakukan perawatan perineal (perineal hygiene) min 1 x sehari"
                                        name="edukasi[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        lakukan perawatan perineal (perineal hygiene) min 1 x sehari
                                    </label>
                                </div>
                            </td>
                            <td id="input-container7" class="row">
                                <input class="form-control form-control-sm mx-2" style="max-width: 300px"
                                    name="edukasi[]" type="text" placeholder="Mengeluh Sulit Menggerakkan"
                                    aria-label=".form-control-sm example">
                                <a class="btn btn-sm btn-success mx-2" style="max-width: 30px"
                                    onclick="addInput('input-container7')">+</a>
                            </td>
                            <td class="fw-bold row">Kolaborasi</td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="lepaskan kateter urine jika perlu" name="kolaborasi[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        lepaskan kateter urine jika perlu
                                    </label>
                                </div>
                            </td>
                            <td id="input-container9" class="row">
                                <input class="form-control form-control-sm mx-2" style="max-width: 300px"
                                    name="kolaborasi[]" type="text" placeholder="Mengeluh Sulit Menggerakkan"
                                    aria-label=".form-control-sm example">
                                <a class="btn btn-sm btn-success mx-2" style="max-width: 30px"
                                    onclick="addInput('input-container9')">+</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr class="mt-5">
                <hr class="">
                <hr class="mb-5">
                <table class="table table-light" id="input-table">
                    <tbody>
                        <tr>
                            <td class="fw-bold row">Implementasi</td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="implementasi[]"
                                        value="mengidentifikasi penyebab retensi urine" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        mengidentifikasi penyebab retensi urine
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="menyediakan privasi untuk berkemih" name="implementasi[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        menyediakan privasi untuk berkemih
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="mengajarkan cara melakukan rangsangan berkemih" name="implementasi[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        mengajarkan cara melakukan rangsangan berkemih
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="memasang keteter urine (kolaborasi)" name="implementasi[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        memasang keteter urine (kolaborasi)
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="memberikan edukasi cara mengosongkan kantong urine" name="implementasi[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        memberikan edukasi cara mengosongkan kantong urine
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="memberikan edukasi kantong urine tidak boleh di letakkan di lantai dan tidak boleh di atas pinggang"
                                        name="implementasi[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        memberikan edukasi kantong urine tidak boleh di letakkan di lantai dan tidak boleh
                                        di atas pinggang
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="memberikan edukasi siang kateter tidak boleh terlipat"
                                        name="implementasi[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        memberikan edukasi siang kateter tidak boleh terlipat
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="memonitoring kepatenan kateter urine" name="implementasi[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        memonitoring kepatenan kateter urine
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="menggunakan teknik asepti selama perawatan kateter urine"
                                        name="implementasi[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        menggunakan teknik asepti selama perawatan kateter urine
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="memastikan kantong urine di letakkan di bawah dan tidak di lantai"
                                        name="implementasi[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        memastikan kantong urine di letakkan di bawah dan tidak di lantai
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="mengosngkan kantong urine di letakkan di bawah dan tidak di lantai"
                                        name="implementasi[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        mengosngkan kantong urine di letakkan di bawah dan tidak di lantai
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="mengosongkan klantong urine jika sudah terisi setengahnya"
                                        name="implementasi[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        mengosongkan klantong urine jika sudah terisi setengahnya
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="memberikan edukasi untuk melakukan perineal higlene" name="implementasi[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        memberikan edukasi untuk melakukan perineal higlene
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="melakukan kolaborasi untuk melepaskan kateter" name="implementasi[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        melakukan kolaborasi untuk melepaskan kateter
                                    </label>
                                </div>
                            </td>
                            <td id="input-container10" class="row">
                                <input class="form-control form-control-sm mx-2" style="max-width: 300px"
                                    name="implementasi[]" type="text" placeholder="Mengeluh Sulit Menggerakkan"
                                    aria-label=".form-control-sm example">
                                <a class="btn btn-sm btn-success mx-2" style="max-width: 30px"
                                    onclick="addInput('input-container10')">+</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr class="mt-5">
                <hr class="">
                <hr class="mb-5">
                <table class="table table-light" id="input-table">
                    <tbody>
                        <tr>
                            <td class="fw-bold row">Evaluasi</td>
                            <td class="row">Ansietas : </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Teratasi" name="evaluasi[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Teratasi
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Teratasi Sebagian"
                                        name="evaluasi[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Teratasi Sebagian
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Belum Teratasi"
                                        name="evaluasi[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Belum Teratasi
                                    </label>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
        <script>
            let counter1 = 1;
            let counter2 = 1;
            let counter3 = 1;
            let counter4 = 1;
            let counter5 = 1;
            let counter6 = 1;
            let counter7 = 1;
            let counter8 = 1;
            let counter9 = 1;
            let counter10 = 1;

            function addInput(inputContainerId) {
                const inputContainer = document.getElementById(inputContainerId);
                const newInput = document.createElement('td');
                newInput.className = 'row tambah-input';
                let inputName = '';
                if (inputContainerId === 'input-container1') {
                    counter1++;
                    inputName = `majorSubjektif[]`;
                } else if (inputContainerId === 'input-container2') {
                    counter2++;
                    inputName = `majorObjektif[]`;
                } else if (inputContainerId === 'input-container3') {
                    counter3++;
                    inputName = `minorSubjektif[]`;
                } else if (inputContainerId === 'input-container4') {
                    counter4++;
                    inputName = `minorObjektif[]`;
                } else if (inputContainerId === 'input-container5') {
                    counter5++;
                    inputName = `observasi[]`;
                } else if (inputContainerId === 'input-container6') {
                    counter6++;
                    inputName = `terapeutik[]`;
                } else if (inputContainerId === 'input-container7') {
                    counter7++;
                    inputName = `edukasi[]`;
                } else if (inputContainerId === 'input-container8') {
                    counter8++;
                    inputName = `dkdd[]`;
                } else if (inputContainerId === 'input-container9') {
                    counter9++;
                    inputName = `kolaborasi[]`;
                } else if (inputContainerId === 'input-container10') {
                    counter10++;
                    inputName = `implementasi[]`;
                }
                newInput.innerHTML = `
          <input class="form-control form-control-sm mx-2" style="max-width: 300px" name="${inputName}" type="text" placeholder="Mengeluh Sulit Menggerakkan" aria-label=".form-control-sm example">
          <button class="btn btn-sm btn-danger" style="max-width: 40px" onclick="removeInput(this)">-</button>
        `;
                inputContainer.parentNode.insertBefore(newInput, inputContainer.nextSibling);
            }

            function removeInput(button) {
                const input = button.parentNode;
                input.parentNode.removeChild(input);
            }
        </script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
            integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
        </script>

    </div>
@endsection

{{-- <!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body class="bg-light">
    <div class="container bg-light mb-5">
        <h1>ASUHAN KEPERAWATAN PASIAN INSTALASI RAWAT JALAN</h1>
        <p>Tanggal : 12-12-2023</p>
        <form action="{{ route('urine.store') }}" method="POST">
            @csrf

            <table class="table table-light" id="input-table">
                <tbody>
                    <tr>
                        <td class="fw-bold row">Data</td>
                        <td class="fw-bold row">Tanda & Gejala Mayor</td>
                        <td class="fw-bold row">Data Subjektif</td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="majorSubjektif[]"
                                    value="Sensasi penuh pada kandung kemih" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Sensasi penuh pada kandung kemih
                                </label>
                            </div>
                        </td>
                        <td id="input-container1" class="row">
                            <input class="form-control form-control-sm mx-2" style="max-width: 300px"
                                name="majorSubjektif[]" type="text" placeholder="Mengeluh Sulit Menggerakkan"
                                aria-label=".form-control-sm example">
                            <a class="btn btn-sm btn-success mx-2" style="max-width: 30px"
                                onclick="addInput('input-container1')">+</a>
                        </td>
                        <td class="fw-bold row">Data Objektif</td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="disuria / anuria"
                                    name="majorObjektif[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    disuria / anuria
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="majorObjektif[]"
                                    value="distensi kandung kemih" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    distensi kandung kemih
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="majorObjektif[]"
                                    value="kateter terpasang baik" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    kateter terpasang baik
                                </label>
                            </div>
                        </td>
                        <td id="input-container2" class="row">
                            <input class="form-control form-control-sm mx-2" style="max-width: 300px"
                                name="majorObjektif[]" type="text" placeholder="Mengeluh Sulit Menggerakkan"
                                aria-label=".form-control-sm example">
                            <a class="btn btn-sm btn-success mx-2" style="max-width: 30px"
                                onclick="addInput('input-container2')">+</a>
                        </td>
                        <td class="fw-bold row">Tanda & Gejala Minor</td>
                        <td class="fw-bold row">Data Subjektif</td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="minorSubjektif[]"
                                    value="dribbling(urine menetes)" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    dribbling(urine menetes)
                                </label>
                            </div>
                        </td>
                        <td id="input-container3" class="row">
                            <input class="form-control form-control-sm mx-2" style="max-width: 300px"
                                name="minorSubjektif[]" type="text" placeholder="Mengeluh Sulit Menggerakkan"
                                aria-label=".form-control-sm example">
                            <a class="btn btn-sm btn-success mx-2" style="max-width: 30px"
                                onclick="addInput('input-container3')">+</a>
                        </td>
                        <td class="fw-bold row">Data Objektif</td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="minorSubjektif[]"
                                    value="Inkontinensia berlebih" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Inkontinensia berlebih
                                </label>
                            </div>
                        </td>
                        <td id="input-container4" class="row">
                            <input class="form-control form-control-sm mx-2" style="max-width: 300px"
                                name="minorObjektif[]" type="text" placeholder="Mengeluh Sulit Menggerakkan"
                                aria-label=".form-control-sm example">
                            <a class="btn btn-sm btn-success mx-2" style="max-width: 30px"
                                onclick="addInput('input-container4')">+</a>
                        </td>
                    </tr>
                </tbody>
            </table>

            <hr class="mt-5">
            <hr class="">
            <hr class="mb-5">
            <table class="table table-light" id="input-table">
                <tbody>
                    <tr>
                        <td class="fw-bold row">Diagnosis Keperewatan</td>
                        <td class="fw-bold row">Retensi Urine</td>
                        <td class="fw-bold row fst-italic">Berhubungan dengan</td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="peningkatan tekanan uretra"
                                    name="dkbd[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    peningkatan tekanan uretra
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="disfungsi neurologis (mis trauma, penyakit syaraf)" name="dkbd[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    disfungsi neurologis (mis trauma, penyakit syaraf)
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="efek agen farmakologis"
                                    name="dkbd[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    efek agen farmakologis
                                </label>
                            </div>
                        </td>
                        <td class="fw-bold row fst-italic">Dibuktikan dengan</td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="sensasi penuh pada kandung kemih" name="dkdd[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    sensasi penuh pada kandung kemih
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="disuria / anuria"
                                    name="dkdd[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    disuria / anuria
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="distensi kandung kemih"
                                    name="dkdd[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    distensi kandung kemih
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="dribbling" name="dkdd[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    dribbling
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="inkontinensia berlebih"
                                    name="dkdd[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    inkontinensia berlebih
                                </label>
                            </div>
                        </td>
                        <td id="input-container8" class="row">
                            <input class="form-control form-control-sm mx-2" style="max-width: 300px" name="dkdd[]"
                                type="text" placeholder="Mengeluh Sulit Menggerakkan"
                                aria-label=".form-control-sm example">
                            <a class="btn btn-sm btn-success mx-2" style="max-width: 30px"
                                onclick="addInput('input-container8')">+</a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <hr class="mt-5">
            <hr class="">
            <hr class="mb-5">
            <table class="table table-light" id="input-table">
                <tbody>
                    <tr>
                        <td class="fw-bold row">Luaran</td>
                        <td class="row">
                            <p>Setelah dilakukan intervensi keperawatan selama</p>
                            <div class="input-group input-group-sm mb-3" style="max-width: 150px">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Jam</span>
                                <input type="text" class="form-control" name="jam"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                            </div>
                            <p>Maka eliminasi urine membaik, dengan kriteria hasil : </p>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="disuria / anuria menurun"
                                    name="luaran[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    disuria / anuria menurun
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="desakan kemih (urgensi) menurun" name="luaran[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    desakan kemih (urgensi) menurun
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="distensi kandung kemih menurun" name="luaran[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    distensi kandung kemih menurun
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="berkemih tidak tuntas menurun"
                                    name="luaran[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    berkemih tidak tuntas menurun
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="urine menetes (dribbling) menurun" name="luaran[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    urine menetes (dribbling) menurun
                                </label>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <hr class="mt-5">
            <hr class="">
            <hr class="mb-5">
            <table class="table table-light" id="input-table">
                <tbody>
                    <tr>
                        <td class="fw-bold row">Intervensi</td>
                        <td class="fw-bold row">Perawatan retensi urine</td>
                        <td class="fw-bold row">Tindakan</td>
                        <td class="fw-bold row">Observasi</td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="identifikasi penyebab retensi urine" name="observasi[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    identifikasi penyebab retensi urine
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="monitor kepatenan kateter urine" name="observasi[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    monitor kepatenan kateter urine
                                </label>
                            </div>
                        </td>
                        <td id="input-container5" class="row">
                            <input class="form-control form-control-sm mx-2" style="max-width: 300px"
                                name="observasi[]" type="text" placeholder="Mengeluh Sulit Menggerakkan"
                                aria-label=".form-control-sm example">
                            <a class="btn btn-sm btn-success mx-2" style="max-width: 30px"
                                onclick="addInput('input-container5')">+</a>
                        </td>
                        <td class="fw-bold row">Terapeutik</td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="sediakan privasi untuk berkemih" name="terapeutik[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    sediakan privasi untuk berkemih
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="pasang kateter urine jika perlu" name="terapeutik[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    pasang kateter urine jika perlu
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="gunakan teknik aseptik selama perawatan kateter urine" name="terapeutik[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    gunakan teknik aseptik selama perawatan kateter urine
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="pastikan kantong urine diletakkan dibawah dan tidak dilantai"
                                    name="terapeutik[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    pastikan kantong urine diletakkan dibawah dan tidak dilantai
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="kosongkan kantong urine jika sudah terisi setengahnya" name="terapeutik[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    kosongkan kantong urine jika sudah terisi setengahnya
                                </label>
                            </div>
                        </td>
                        <td id="input-container6" class="row">
                            <input class="form-control form-control-sm mx-2" style="max-width: 300px"
                                name="terapeutik[]" type="text" placeholder="Mengeluh Sulit Menggerakkan"
                                aria-label=".form-control-sm example">
                            <a class="btn btn-sm btn-success mx-2" style="max-width: 30px"
                                onclick="addInput('input-container6')">+</a>
                        </td>
                        <td class="fw-bold row">Edukasi</td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="ajarkan cara melakukan rangsangan berkemih" name="edukasi[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    ajarkan cara melakukan rangsangan berkemih
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="lakukan perawatan perineal (perineal hygiene) min 1 x sehari"
                                    name="edukasi[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    lakukan perawatan perineal (perineal hygiene) min 1 x sehari
                                </label>
                            </div>
                        </td>
                        <td id="input-container7" class="row">
                            <input class="form-control form-control-sm mx-2" style="max-width: 300px"
                                name="edukasi[]" type="text" placeholder="Mengeluh Sulit Menggerakkan"
                                aria-label=".form-control-sm example">
                            <a class="btn btn-sm btn-success mx-2" style="max-width: 30px"
                                onclick="addInput('input-container7')">+</a>
                        </td>
                        <td class="fw-bold row">Kolaborasi</td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="lepaskan kateter urine jika perlu" name="kolaborasi[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    lepaskan kateter urine jika perlu
                                </label>
                            </div>
                        </td>
                        <td id="input-container9" class="row">
                            <input class="form-control form-control-sm mx-2" style="max-width: 300px"
                                name="kolaborasi[]" type="text" placeholder="Mengeluh Sulit Menggerakkan"
                                aria-label=".form-control-sm example">
                            <a class="btn btn-sm btn-success mx-2" style="max-width: 30px"
                                onclick="addInput('input-container9')">+</a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <hr class="mt-5">
            <hr class="">
            <hr class="mb-5">
            <table class="table table-light" id="input-table">
                <tbody>
                    <tr>
                        <td class="fw-bold row">Implementasi</td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="implementasi[]"
                                    value="mengidentifikasi penyebab retensi urine" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    mengidentifikasi penyebab retensi urine
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="menyediakan privasi untuk berkemih" name="implementasi[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    menyediakan privasi untuk berkemih
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="mengajarkan cara melakukan rangsangan berkemih" name="implementasi[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    mengajarkan cara melakukan rangsangan berkemih
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="memasang keteter urine (kolaborasi)" name="implementasi[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    memasang keteter urine (kolaborasi)
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="memberikan edukasi cara mengosongkan kantong urine" name="implementasi[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    memberikan edukasi cara mengosongkan kantong urine
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="memberikan edukasi kantong urine tidak boleh di letakkan di lantai dan tidak boleh di atas pinggang"
                                    name="implementasi[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    memberikan edukasi kantong urine tidak boleh di letakkan di lantai dan tidak boleh
                                    di atas pinggang
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="memberikan edukasi siang kateter tidak boleh terlipat"
                                    name="implementasi[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    memberikan edukasi siang kateter tidak boleh terlipat
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="memonitoring kepatenan kateter urine" name="implementasi[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    memonitoring kepatenan kateter urine
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="menggunakan teknik asepti selama perawatan kateter urine"
                                    name="implementasi[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    menggunakan teknik asepti selama perawatan kateter urine
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="memastikan kantong urine di letakkan di bawah dan tidak di lantai"
                                    name="implementasi[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    memastikan kantong urine di letakkan di bawah dan tidak di lantai
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="mengosngkan kantong urine di letakkan di bawah dan tidak di lantai"
                                    name="implementasi[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    mengosngkan kantong urine di letakkan di bawah dan tidak di lantai
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="mengosongkan klantong urine jika sudah terisi setengahnya"
                                    name="implementasi[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    mengosongkan klantong urine jika sudah terisi setengahnya
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="memberikan edukasi untuk melakukan perineal higlene"
                                    name="implementasi[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    memberikan edukasi untuk melakukan perineal higlene
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="melakukan kolaborasi untuk melepaskan kateter" name="implementasi[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    melakukan kolaborasi untuk melepaskan kateter
                                </label>
                            </div>
                        </td>
                        <td id="input-container10" class="row">
                            <input class="form-control form-control-sm mx-2" style="max-width: 300px"
                                name="implementasi[]" type="text" placeholder="Mengeluh Sulit Menggerakkan"
                                aria-label=".form-control-sm example">
                            <a class="btn btn-sm btn-success mx-2" style="max-width: 30px"
                                onclick="addInput('input-container10')">+</a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <hr class="mt-5">
            <hr class="">
            <hr class="mb-5">
            <table class="table table-light" id="input-table">
                <tbody>
                    <tr>
                        <td class="fw-bold row">Evaluasi</td>
                        <td class="row">Ansietas : </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Teratasi"
                                    name="evaluasi[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Teratasi
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Teratasi Sebagian"
                                    name="evaluasi[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Teratasi Sebagian
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Belum Teratasi"
                                    name="evaluasi[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Belum Teratasi
                                </label>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
    <script>
        let counter1 = 1;
        let counter2 = 1;
        let counter3 = 1;
        let counter4 = 1;
        let counter5 = 1;
        let counter6 = 1;
        let counter7 = 1;
        let counter8 = 1;
        let counter9 = 1;
        let counter10 = 1;

        function addInput(inputContainerId) {
            const inputContainer = document.getElementById(inputContainerId);
            const newInput = document.createElement('td');
            newInput.className = 'row tambah-input';
            let inputName = '';
            if (inputContainerId === 'input-container1') {
                counter1++;
                inputName = `majorSubjektif[]`;
            } else if (inputContainerId === 'input-container2') {
                counter2++;
                inputName = `majorObjektif[]`;
            } else if (inputContainerId === 'input-container3') {
                counter3++;
                inputName = `minorSubjektif[]`;
            } else if (inputContainerId === 'input-container4') {
                counter4++;
                inputName = `minorObjektif[]`;
            } else if (inputContainerId === 'input-container5') {
                counter5++;
                inputName = `observasi[]`;
            } else if (inputContainerId === 'input-container6') {
                counter6++;
                inputName = `terapeutik[]`;
            } else if (inputContainerId === 'input-container7') {
                counter7++;
                inputName = `edukasi[]`;
            } else if (inputContainerId === 'input-container8') {
                counter8++;
                inputName = `dkdd[]`;
            } else if (inputContainerId === 'input-container9') {
                counter9++;
                inputName = `kolaborasi[]`;
            } else if (inputContainerId === 'input-container10') {
                counter10++;
                inputName = `implementasi[]`;
            }
            newInput.innerHTML = `
          <input class="form-control form-control-sm mx-2" style="max-width: 300px" name="${inputName}" type="text" placeholder="Mengeluh Sulit Menggerakkan" aria-label=".form-control-sm example">
          <button class="btn btn-sm btn-danger" style="max-width: 40px" onclick="removeInput(this)">-</button>
        `;
            inputContainer.parentNode.insertBefore(newInput, inputContainer.nextSibling);
        }

        function removeInput(button) {
            const input = button.parentNode;
            input.parentNode.removeChild(input);
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
        integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html> --}}
