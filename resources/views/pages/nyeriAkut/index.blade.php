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
            <form action="{{ route('nyeri.store') }}" method="POST">
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
                                        value="Mengeluh nyeri" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Mengeluh nyeri
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="input-group input-group-sm mb-3" style="max-width: 500px">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Skala nyeri meliputi : </span>
                                    <input type="text" class="form-control" name="nyeri"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                                        placeholder="nyeri1, nyeri2, nyeri3">
                                </div>
                            </td>
                            <td id="input-container1" class="row">
                                <input class="form-control form-control-sm mx-2" style="max-width: 300px"
                                    name="majorSubjektif[]" type="text" placeholder="Mengeluh nyeri"
                                    aria-label=".form-control-sm example">
                                <a class="btn btn-sm btn-success mx-2" style="max-width: 30px"
                                    onclick="addInput('input-container1')">+</a>
                            </td>
                            <td class="fw-bold row">Data Objektif</td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="tampak meringis"
                                        name="majorObjektif[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        tampak meringis
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="majorObjektif[]"
                                        value="pasien sulit tidur" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        pasien sulit tidur
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="input-group input-group-sm mb-3" style="max-width: 300px">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Frekuensi nadi ... x/l</span>
                                    <input type="text" class="form-control" name="nadi"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
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
                                <div class="input-group input-group-sm mb-3" style="max-width: 300px">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Tekanan darah ... mmHg</span>
                                    <input type="text" class="form-control" name="darah"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="minorObjektif[]"
                                        value="pola napas pasien berubah" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        pola napas pasien berubah
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="minorObjektif[]"
                                        value="nafsu makan pasien berubah" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        nafsu makan pasien berubah
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
                            <td class="fw-bold row">Nyeri Akut/Kronis*</td>
                            <td class="fw-bold row fst-italic">Berhubungan dengan</td>
                            <td class="row">
                                <div class="input-group input-group-sm mb-3" style="max-width: 500px">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Agen pencendera
                                        fisilologi</span>
                                    <input type="text" class="form-control" name="fisiologi"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                                        placeholder="Inflamasi, iskemia, neoplasma">
                                </div>
                            </td>
                            <td class="row">
                                <div class="input-group input-group-sm mb-3" style="max-width: 500px">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Agen pencendera
                                        kimiawi</span>
                                    <input type="text" class="form-control" name="kimiawi"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                                        placeholder="terbakar, bahan kimia iritan">
                                </div>
                            </td>
                            <td class="row">
                                <div class="input-group input-group-sm mb-3" style="max-width: 500px">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Agen pencendera fisik</span>
                                    <input type="text" class="form-control" name="fisik"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                                        placeholder="terpotong, mengangkat berat. prosedur operasi, dll">
                                </div>
                            </td>
                            <td class="fw-bold row fst-italic">Dibuktikan dengan</td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="pasien mengeluh nyeri"
                                        name="dkdd[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        pasien mengeluh nyeri
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="pasien tampak meringis"
                                        name="dkdd[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        pasien tampak meringis
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="input-group input-group-sm mb-3" style="max-width: 300px">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Frekuensi nadi ... x/l</span>
                                    <input type="text" class="form-control" name="dkddnadi"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                </div>
                            </td>
                            <td class="row">
                                <div class="input-group input-group-sm mb-3" style="max-width: 300px">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Tekanan darah ... mmHg</span>
                                    <input type="text" class="form-control" name="dkdddarah"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                </div>
                            </td>
                            <td class="row">
                                <div class="input-group input-group-sm mb-3" style="max-width: 300px">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Skala nyeri yang di katakan
                                        pasien</span>
                                    <input type="text" class="form-control" name="dkddnyeri"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="pasien mengatakan sulit tidur"
                                        name="dkdd[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        pasien mengatakan sulit tidur
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
                                <p>Maka tingkat ansietas menurun dengan kriteria hasil : </p>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="keluhan nyeri pasien menurun"
                                        name="luaran[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        keluhan nyeri pasien menurun
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="meringis menurun"
                                        name="luaran[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        meringis menurun
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
                            <td class="fw-bold row">Dukungan Mobilisasi</td>
                            <td class="fw-bold row">Tindakan</td>
                            <td class="fw-bold row">Observasi</td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="identifikasi lokasi, karakteristik, durasi, frekuensi, kualitas, intensitas nyeri"
                                        name="observasi[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        identifikasi lokasi, karakteristik, durasi, frekuensi, kualitas, intensitas nyeri
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="identifikasi skala nyeri yang dirasakan pasien" name="observasi[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        identifikasi skala nyeri yang dirasakan pasien
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
                                        value="Cberikan teknik nonfarmakologis untuk mengurangi rasa nyeri"
                                        name="terapeutik[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Cberikan teknik nonfarmakologis untuk mengurangi rasa nyeri
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
                                        value="anjurkan memonitor nyerise cara mandiri" name="edukasi[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        anjurkan memonitor nyerise cara mandiri
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="ajarkan teknik nonfarmakologis untuk mengurangi rasa nyeri"
                                        name="edukasi[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        ajarkan teknik nonfarmakologis untuk mengurangi rasa nyeri
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
                                        value="kolaborasi pemberian analgetik, jika perlu" name="kolaborasi[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        kolaborasi pemberian analgetik, jika perlu
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
                                        value="mengidentifikasi nyeri" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        mengidentifikasi nyeri
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="mengukur skala nyeri"
                                        name="implementasi[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        mengukur skala nyeri
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="mengedukasi untuk memonitor nyeri secara mandiri" name="implementasi[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        mengedukasi untuk memonitor nyeri secara mandiri
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="memberikan edukasi teknik relaksasi napas dalam" name="implementasi[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        memberikan edukasi teknik relaksasi napas dalam
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="menganjurkan minum obat sesuai instruksi dokter" name="implementasi[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        menganjurkan minum obat sesuai instruksi dokter
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="input-group input-group-sm mb-3" style="max-width: 800px">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Memberikan obat ... sesuai
                                        instruksi dokter (SC / IV / IM / Supositoria)</span>
                                    <input type="text" class="form-control" name="obat"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                                        placeholder="obat1, obat2, obat3">
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
    <title>Nyeri Akut / Kronis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body class="bg-light">
    <div class="container bg-light mb-5">
        <h1>ASUHAN KEPERAWATAN PASIAN INSTALASI RAWAT JALAN</h1>
        <p>Tanggal : 12-12-2023</p>
        <form action="{{ route('nyeri.store') }}" method="POST">
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
                                    value="Mengeluh nyeri" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Mengeluh nyeri
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="input-group input-group-sm mb-3" style="max-width: 500px">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Skala nyeri meliputi : </span>
                                <input type="text" class="form-control" name="nyeri"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                                    placeholder="nyeri1, nyeri2, nyeri3">
                            </div>
                        </td>
                        <td id="input-container1" class="row">
                            <input class="form-control form-control-sm mx-2" style="max-width: 300px"
                                name="majorSubjektif[]" type="text" placeholder="Mengeluh nyeri"
                                aria-label=".form-control-sm example">
                            <a class="btn btn-sm btn-success mx-2" style="max-width: 30px"
                                onclick="addInput('input-container1')">+</a>
                        </td>
                        <td class="fw-bold row">Data Objektif</td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="tampak meringis"
                                    name="majorObjektif[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    tampak meringis
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="majorObjektif[]"
                                    value="pasien sulit tidur" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    pasien sulit tidur
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="input-group input-group-sm mb-3" style="max-width: 300px">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Frekuensi nadi ... x/l</span>
                                <input type="text" class="form-control" name="nadi"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
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
                            <div class="input-group input-group-sm mb-3" style="max-width: 300px">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Tekanan darah ... mmHg</span>
                                <input type="text" class="form-control" name="darah"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="minorObjektif[]"
                                    value="pola napas pasien berubah" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    pola napas pasien berubah
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="minorObjektif[]"
                                    value="nafsu makan pasien berubah" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    nafsu makan pasien berubah
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
                        <td class="fw-bold row">Nyeri Akut/Kronis*</td>
                        <td class="fw-bold row fst-italic">Berhubungan dengan</td>
                        <td class="row">
                            <div class="input-group input-group-sm mb-3" style="max-width: 500px">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Agen pencendera
                                    fisilologi</span>
                                <input type="text" class="form-control" name="fisiologi"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                                    placeholder="Inflamasi, iskemia, neoplasma">
                            </div>
                        </td>
                        <td class="row">
                            <div class="input-group input-group-sm mb-3" style="max-width: 500px">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Agen pencendera
                                    kimiawi</span>
                                <input type="text" class="form-control" name="kimiawi"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                                    placeholder="terbakar, bahan kimia iritan">
                            </div>
                        </td>
                        <td class="row">
                            <div class="input-group input-group-sm mb-3" style="max-width: 500px">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Agen pencendera fisik</span>
                                <input type="text" class="form-control" name="fisik"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                                    placeholder="terpotong, mengangkat berat. prosedur operasi, dll">
                            </div>
                        </td>
                        <td class="fw-bold row fst-italic">Dibuktikan dengan</td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="pasien mengeluh nyeri"
                                    name="dkdd[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    pasien mengeluh nyeri
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="pasien tampak meringis"
                                    name="dkdd[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    pasien tampak meringis
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="input-group input-group-sm mb-3" style="max-width: 300px">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Frekuensi nadi ... x/l</span>
                                <input type="text" class="form-control" name="dkddnadi"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                            </div>
                        </td>
                        <td class="row">
                            <div class="input-group input-group-sm mb-3" style="max-width: 300px">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Tekanan darah ... mmHg</span>
                                <input type="text" class="form-control" name="dkdddarah"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                            </div>
                        </td>
                        <td class="row">
                            <div class="input-group input-group-sm mb-3" style="max-width: 300px">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Skala nyeri yang di katakan
                                    pasien</span>
                                <input type="text" class="form-control" name="dkddnyeri"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="pasien mengatakan sulit tidur"
                                    name="dkdd[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    pasien mengatakan sulit tidur
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
                            <p>Maka tingkat ansietas menurun dengan kriteria hasil : </p>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="keluhan nyeri pasien menurun"
                                    name="luaran[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    keluhan nyeri pasien menurun
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="meringis menurun"
                                    name="luaran[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    meringis menurun
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
                        <td class="fw-bold row">Dukungan Mobilisasi</td>
                        <td class="fw-bold row">Tindakan</td>
                        <td class="fw-bold row">Observasi</td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="identifikasi lokasi, karakteristik, durasi, frekuensi, kualitas, intensitas nyeri"
                                    name="observasi[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    identifikasi lokasi, karakteristik, durasi, frekuensi, kualitas, intensitas nyeri
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="identifikasi skala nyeri yang dirasakan pasien" name="observasi[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    identifikasi skala nyeri yang dirasakan pasien
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
                                    value="Cberikan teknik nonfarmakologis untuk mengurangi rasa nyeri"
                                    name="terapeutik[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Cberikan teknik nonfarmakologis untuk mengurangi rasa nyeri
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
                                    value="anjurkan memonitor nyerise cara mandiri" name="edukasi[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    anjurkan memonitor nyerise cara mandiri
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="ajarkan teknik nonfarmakologis untuk mengurangi rasa nyeri"
                                    name="edukasi[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    ajarkan teknik nonfarmakologis untuk mengurangi rasa nyeri
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
                                    value="kolaborasi pemberian analgetik, jika perlu" name="kolaborasi[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    kolaborasi pemberian analgetik, jika perlu
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
                                    value="mengidentifikasi nyeri" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    mengidentifikasi nyeri
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="mengukur skala nyeri"
                                    name="implementasi[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    mengukur skala nyeri
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="mengedukasi untuk memonitor nyeri secara mandiri" name="implementasi[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    mengedukasi untuk memonitor nyeri secara mandiri
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="memberikan edukasi teknik relaksasi napas dalam" name="implementasi[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    memberikan edukasi teknik relaksasi napas dalam
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="menganjurkan minum obat sesuai instruksi dokter" name="implementasi[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    menganjurkan minum obat sesuai instruksi dokter
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="input-group input-group-sm mb-3" style="max-width: 800px">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Memberikan obat ... sesuai
                                    instruksi dokter (SC / IV / IM / Supositoria)</span>
                                <input type="text" class="form-control" name="obat"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                                    placeholder="obat1, obat2, obat3">
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
