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
            <form action="{{ route('kulit.store') }}" method="POST">
                @csrf

                <table class="table table-light" id="input-table">
                    <tbody>
                        <tr>
                            <td class="fw-bold row">Data</td>
                            <td class="fw-bold row">Tanda & Gejala Mayor</td>
                            <td class="fw-bold row">Data Subjektif</td>
                            <td id="input-container1" class="row">
                                <input class="form-control form-control-sm mx-2" style="max-width: 300px"
                                    name="majorSubjektif[]" type="text" placeholder="Skala nyeri meliputi"
                                    aria-label=".form-control-sm example">
                                <a class="btn btn-sm btn-success mx-2" style="max-width: 30px"
                                    onclick="addInput('input-container1')">+</a>
                            </td>
                            <td class="fw-bold row">Data Objektif</td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="kerusakan jaringan / lapisan kulit" name="majorObjektif[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        kerusakan jaringan / lapisan kulit
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="majorObjektif[]"
                                        value="terpasang stent" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        terpasang stent
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
                                    <input class="form-check-input" type="checkbox" name="minorObjektif[]" value="nyeri"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        nyeri
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="minorObjektif[]"
                                        value="pendarahan" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        pendarahan
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="minorObjektif[]" value="kemerahan"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        kemerahan
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="minorObjektif[]"
                                        value="hematoma" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        hematoma
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
                            <td class="fw-bold row">Gangguan integritas kulit / jaringan</td>
                            <td class="fw-bold row fst-italic">Berhubungan dengan</td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="dkbd[]"
                                        value="perubahan sirkulasi" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        perubahan sirkulasi
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="dkbd[]"
                                        value="faktor mekanis (penekanan pada tonjolan tulang, gesekan atau luka operasi), faktor elektris(energi listrik tinggi)"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        faktor mekanis (penekanan pada tonjolan tulang, gesekan atau luka operasi), faktor
                                        elektris(energi listrik tinggi)
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="dkbd[]"
                                        value="efek samping terapi radiasi" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        efek samping terapi radiasi
                                    </label>
                                </div>
                            </td>
                            <td class="fw-bold row fst-italic">Dibuktikan dengan</td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="kerusakan jaraingan / lapisan kulit" name="dkdd[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        kerusakan jaraingan / lapisan kulit
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="nyeri" name="dkdd[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        nyeri
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="pendarahan" name="dkdd[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        pendarahan
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="kemerahan" name="dkdd[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        kemerahan
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="hermatoma" name="dkdd[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        hermatoma
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
                                <p>maka penyembuhan luka meningkat, dengan kriteria hasil : </p>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="penyatuan kulit meningkat"
                                        name="luaran[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        penyatuan kulit meningkat
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="penyatuan tepi luka meningkat"
                                        name="luaran[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        penyatuan tepi luka meningkat
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="jaringan granulasi mengingkat"
                                        name="luaran[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        jaringan granulasi mengingkat
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="pembentukan jaringan perut meningkat" name="luaran[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        pembentukan jaringan perut meningkat
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="edema pada sisi luka menurun"
                                        name="luaran[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        edema pada sisi luka menurun
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="peradangan luka menurun"
                                        name="luaran[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        peradangan luka menurun
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="nyeri menurun"
                                        name="luaran[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        nyeri menurun
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="nekrosis menurun"
                                        name="luaran[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        nekrosis menurun
                                    </label>
                                </div>
                            </td>
                            <td id="input-container11" class="row">
                                <input class="form-control form-control-sm mx-2" style="max-width: 300px" name="luaran[]"
                                    type="text" placeholder="Mengeluh Sulit Menggerakkan"
                                    aria-label=".form-control-sm example">
                                <a class="btn btn-sm btn-success mx-2" style="max-width: 30px"
                                    onclick="addInput('input-container11')">+</a>
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
                            <td class="fw-bold row">Perawatan Luka</td>
                            <td class="fw-bold row">Tindakan</td>
                            <td class="fw-bold row">Observasi</td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="monitor karakteristik luka (drainase, warna, ukuran, bau)"
                                        name="observasi[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        monitor karakteristik luka (drainase, warna, ukuran, bau)
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="monitor tanda tanda infeksi pada luka" name="observasi[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        monitor tanda tanda infeksi pada luka
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
                                        value="Pertahankan teknik steril pada saat perawatan" name="terapeutik[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Pertahankan teknik steril pada saat perawatan
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="bersihkan jaraingan nekrotik"
                                        name="terapeutik[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        bersihkan jaraingan nekrotik
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
                                        value="jelaskan tanda dan gejala infeksi" name="edukasi[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        jelaskan tanda dan gejala infeksi
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="ajarkan perawatan luka secara mandiri" name="edukasi[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        ajarkan perawatan luka secara mandiri
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
                                        value="kolaborasi prosedur debridement" name="kolaborasi[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        kolaborasi prosedur debridement
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="kolaborasi pemberian antibiotik, jika perlu" name="kolaborasi[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        kolaborasi pemberian antibiotik, jika perlu
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
                                        value="memonitor karakteristik luka" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        memonitor karakteristik luka
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="memonitor tanda tanda infeksi luka" name="implementasi[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        memonitor tanda tanda infeksi luka
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="melakukan perawatan luka (tukar verban)" name="implementasi[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        melakukan perawatan luka (tukar verban)
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="memberikan edukasi tentang perawatan luka secara mandiri"
                                        name="implementasi[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        memberikan edukasi tentang perawatan luka secara mandiri
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="mengedukasi pasien untuk menjaga luka tetap bersih dan kering"
                                        name="implementasi[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        mengedukasi pasien untuk menjaga luka tetap bersih dan kering
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="mempertahankan teknik steril saat perawatan luka" name="implementasi[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        mempertahankan teknik steril saat perawatan luka
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="meng aff stent (kolaborasi dokter)" name="implementasi[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        meng aff stent (kolaborasi dokter)
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
            let counter11 = 1;

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
                } else if (inputContainerId === 'input-container11') {
                    counter11++;
                    inputName = `luaran[]`;
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
        <form action="{{ route('kulit.store') }}" method="POST">
            @csrf

            <table class="table table-light" id="input-table">
                <tbody>
                    <tr>
                        <td class="fw-bold row">Data</td>
                        <td class="fw-bold row">Tanda & Gejala Mayor</td>
                        <td class="fw-bold row">Data Subjektif</td>
                        <td id="input-container1" class="row">
                            <input class="form-control form-control-sm mx-2" style="max-width: 300px"
                                name="majorSubjektif[]" type="text" placeholder="Skala nyeri meliputi"
                                aria-label=".form-control-sm example">
                            <a class="btn btn-sm btn-success mx-2" style="max-width: 30px"
                                onclick="addInput('input-container1')">+</a>
                        </td>
                        <td class="fw-bold row">Data Objektif</td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="kerusakan jaringan / lapisan kulit" name="majorObjektif[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    kerusakan jaringan / lapisan kulit
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="majorObjektif[]"
                                    value="terpasang stent" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    terpasang stent
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
                                <input class="form-check-input" type="checkbox" name="minorObjektif[]"
                                    value="nyeri" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    nyeri
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="minorObjektif[]"
                                    value="pendarahan" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    pendarahan
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="minorObjektif[]"
                                    value="kemerahan" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    kemerahan
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="minorObjektif[]"
                                    value="hematoma" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    hematoma
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
                        <td class="fw-bold row">Gangguan integritas kulit / jaringan</td>
                        <td class="fw-bold row fst-italic">Berhubungan dengan</td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="dkbd[]"
                                    value="perubahan sirkulasi" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    perubahan sirkulasi
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="dkbd[]"
                                    value="faktor mekanis (penekanan pada tonjolan tulang, gesekan atau luka operasi), faktor elektris(energi listrik tinggi)"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    faktor mekanis (penekanan pada tonjolan tulang, gesekan atau luka operasi), faktor
                                    elektris(energi listrik tinggi)
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="dkbd[]"
                                    value="efek samping terapi radiasi" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    efek samping terapi radiasi
                                </label>
                            </div>
                        </td>
                        <td class="fw-bold row fst-italic">Dibuktikan dengan</td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="kerusakan jaraingan / lapisan kulit" name="dkdd[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    kerusakan jaraingan / lapisan kulit
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="nyeri" name="dkdd[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    nyeri
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="pendarahan" name="dkdd[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    pendarahan
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="kemerahan" name="dkdd[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    kemerahan
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="hermatoma" name="dkdd[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    hermatoma
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
                            <p>maka penyembuhan luka meningkat, dengan kriteria hasil : </p>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="penyatuan kulit meningkat"
                                    name="luaran[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    penyatuan kulit meningkat
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="penyatuan tepi luka meningkat"
                                    name="luaran[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    penyatuan tepi luka meningkat
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="jaringan granulasi mengingkat"
                                    name="luaran[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    jaringan granulasi mengingkat
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="pembentukan jaringan perut meningkat" name="luaran[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    pembentukan jaringan perut meningkat
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="edema pada sisi luka menurun"
                                    name="luaran[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    edema pada sisi luka menurun
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="peradangan luka menurun"
                                    name="luaran[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    peradangan luka menurun
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="nyeri menurun"
                                    name="luaran[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    nyeri menurun
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="nekrosis menurun"
                                    name="luaran[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    nekrosis menurun
                                </label>
                            </div>
                        </td>
                        <td id="input-container11" class="row">
                            <input class="form-control form-control-sm mx-2" style="max-width: 300px" name="luaran[]"
                                type="text" placeholder="Mengeluh Sulit Menggerakkan"
                                aria-label=".form-control-sm example">
                            <a class="btn btn-sm btn-success mx-2" style="max-width: 30px"
                                onclick="addInput('input-container11')">+</a>
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
                        <td class="fw-bold row">Perawatan Luka</td>
                        <td class="fw-bold row">Tindakan</td>
                        <td class="fw-bold row">Observasi</td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="monitor karakteristik luka (drainase, warna, ukuran, bau)"
                                    name="observasi[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    monitor karakteristik luka (drainase, warna, ukuran, bau)
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="monitor tanda tanda infeksi pada luka" name="observasi[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    monitor tanda tanda infeksi pada luka
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
                                    value="Pertahankan teknik steril pada saat perawatan" name="terapeutik[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Pertahankan teknik steril pada saat perawatan
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="bersihkan jaraingan nekrotik"
                                    name="terapeutik[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    bersihkan jaraingan nekrotik
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
                                    value="jelaskan tanda dan gejala infeksi" name="edukasi[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    jelaskan tanda dan gejala infeksi
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="ajarkan perawatan luka secara mandiri" name="edukasi[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    ajarkan perawatan luka secara mandiri
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
                                    value="kolaborasi prosedur debridement" name="kolaborasi[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    kolaborasi prosedur debridement
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="kolaborasi pemberian antibiotik, jika perlu" name="kolaborasi[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    kolaborasi pemberian antibiotik, jika perlu
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
                                    value="memonitor karakteristik luka" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    memonitor karakteristik luka
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="memonitor tanda tanda infeksi luka" name="implementasi[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    memonitor tanda tanda infeksi luka
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="melakukan perawatan luka (tukar verban)" name="implementasi[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    melakukan perawatan luka (tukar verban)
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="memberikan edukasi tentang perawatan luka secara mandiri"
                                    name="implementasi[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    memberikan edukasi tentang perawatan luka secara mandiri
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="mengedukasi pasien untuk menjaga luka tetap bersih dan kering"
                                    name="implementasi[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    mengedukasi pasien untuk menjaga luka tetap bersih dan kering
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="mempertahankan teknik steril saat perawatan luka" name="implementasi[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    mempertahankan teknik steril saat perawatan luka
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="meng aff stent (kolaborasi dokter)" name="implementasi[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    meng aff stent (kolaborasi dokter)
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
        let counter11 = 1;

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
            } else if (inputContainerId === 'input-container11') {
                counter11++;
                inputName = `luaran[]`;
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
