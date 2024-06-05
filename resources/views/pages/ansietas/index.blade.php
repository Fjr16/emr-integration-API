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
            <form action="{{ route('ansietas.store') }}" method="POST">
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
                                        value="Merasa Bingung" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Merasa Bingung
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="majorSubjektif[]"
                                        value="Merasa Khawatir dengan akibat dari kondisi yang dihadapi"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Merasa Khawatir dengan akibat dari kondisi yang dihadapi
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
                                    <input class="form-check-input" type="checkbox" value="Tampak Cemas"
                                        name="majorObjektif[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Tampak Cemas
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="majorObjektif[]"
                                        value="Tampak Gelisah" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Tampak Gelisah
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
                                        value="Mengeluh Pusing" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Mengeluh Pusing
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Anoreksia"
                                        name="minorSubjektif[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Anoreksia
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
                                <div class="input-group input-group-sm mb-3" style="max-width: 300px">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Frekuensi nafas ...
                                        x/l</span>
                                    <input type="text" class="form-control" name="nafas"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                </div>
                            </td>
                            <td class="row">
                                <div class="input-group input-group-sm mb-3" style="max-width: 300px">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Frekuensi nadi ... x/l</span>
                                    <input type="text" class="form-control" name="nadi"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                </div>
                            </td>
                            <td class="row">
                                <div class="input-group input-group-sm mb-3" style="max-width: 300px">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Tekanan darah ... x/l</span>
                                    <input type="text" class="form-control" name="darah"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
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
                            <td class="fw-bold row">Ansietas</td>
                            <td class="fw-bold row fst-italic">Berhubungan dengan</td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kurang Terpapar informasi"
                                        name="dkbd[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Kurang Terpapar informasi
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="Kekhawatiran mengalami kegagalan" name="dkbd[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Kekhawatiran mengalami kegagalan
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Ancaman terhadap konsep diri"
                                        name="dkbd[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Ancaman terhadap konsep diri
                                    </label>
                                </div>
                            </td>
                            <td class="fw-bold row fst-italic">Dibuktikan dengan</td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Merasa bingung"
                                        name="dkdd[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Merasa bingung
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="Merasa khawatir akibat dari kondisi yang di hadapi" name="dkdd[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Merasa khawatir akibat dari kondisi yang di hadapi
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Sulit berkonsentrasi"
                                        name="dkdd[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Sulit berkonsentrasi
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Tampak cemas" name="dkdd[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Tampak cemas
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Tampak gelisah"
                                        name="dkdd[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Tampak gelisah
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Tampak Tegang" name="dkdd[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Tampak Tegang
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Muka tampak pucat"
                                        name="dkdd[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Muka tampak pucat
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
                                    <input class="form-check-input" type="checkbox"
                                        value="Verbalisasi kebingungan menurun" name="luaran[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Verbalisasi kebingungan menurun
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="Verbalisasi kebingungan akibat kondisi yang di hadapi menurun"
                                        name="luaran[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Verbalisasi kebingungan akibat kondisi yang di hadapi menurun
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Perilaku gelisah menurun"
                                        name="luaran[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Perilaku gelisah menurun
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
                            <td class="fw-bold row">Dukungan Mobilisasi</td>
                            <td class="fw-bold row">Tindakan</td>
                            <td class="fw-bold row">Observasi</td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="Monitor tanda tanda ansietas (verbal dan non verbal)" name="observasi[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Monitor tanda tanda ansietas (verbal dan non verbal)
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="identifikasi kondisi umum pasien" name="observasi[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        identifikasi kondisi umum pasien
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
                                    <input class="form-check-input" type="checkbox" value="Ciptakan suasana terapeutik"
                                        name="terapeutik[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Ciptakan suasana terapeutik
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="dengarkan pasien dengan penuh perhatian" name="terapeutik[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        dengarkan pasien dengan penuh perhatian
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
                                        value="latih kegiatan pengalihan untuk mengurangi ketegangan" name="edukasi[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        latih kegiatan pengalihan untuk mengurangi ketegangan
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="latih teknik relaksasi"
                                        name="edukasi[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        latih teknik relaksasi
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
                                        value="kolaborasi dalam pemberian obat anti anseitas, jika perlu"
                                        name="kolaborasi[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        kolaborasi dalam pemberian obat anti anseitas, jika perlu
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
                                        value="memonitoring tanda tanda ansietas (verbal dan non verbal)"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        memonitoring tanda tanda ansietas (verbal dan non verbal)
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="mengukur TTV pasien"
                                        name="implementasi[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        mengukur TTV pasien
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="mendengarkan keluhan yang disampaikan pasien" name="implementasi[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        mendengarkan keluhan yang disampaikan pasien
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="memberikan edukasi teknis napas dalam" name="implementasi[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        memberikan edukasi teknis napas dalam
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="melakukan kolaborasi dalam pemberian obat" name="implementasi[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        melakukan kolaborasi dalam pemberian obat
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="melakukan kolaborasi dengan dokter menjelaskan tentang penyakitnya"
                                        name="implementasi[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        melakukan kolaborasi dengan dokter menjelaskan tentang penyakitnya
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="menganjurkan keluarga untuk mendapingi pasien" name="implementasi[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        menganjurkan keluarga untuk mendapingi pasien
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
                }
                newInput.innerHTML = `
          <input class="form-control form-control-sm" style="max-width: 300px;" name="${inputName}" type="text" placeholder="Mengeluh Sulit Menggerakkan" aria-label=".form-control-sm example">
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
        <form action="{{ route('ansietas.store') }}" method="POST">
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
                                    value="Merasa Bingung" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Merasa Bingung
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="majorSubjektif[]"
                                    value="Merasa Khawatir dengan akibat dari kondisi yang dihadapi"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Merasa Khawatir dengan akibat dari kondisi yang dihadapi
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
                                <input class="form-check-input" type="checkbox" value="Tampak Cemas"
                                    name="majorObjektif[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Tampak Cemas
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="majorObjektif[]"
                                    value="Tampak Gelisah" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Tampak Gelisah
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
                                    value="Mengeluh Pusing" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Mengeluh Pusing
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Anoreksia"
                                    name="minorSubjektif[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Anoreksia
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
                            <div class="input-group input-group-sm mb-3" style="max-width: 300px">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Frekuensi nafas ...
                                    x/l</span>
                                <input type="text" class="form-control" name="nafas"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                            </div>
                        </td>
                        <td class="row">
                            <div class="input-group input-group-sm mb-3" style="max-width: 300px">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Frekuensi nadi ... x/l</span>
                                <input type="text" class="form-control" name="nadi"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                            </div>
                        </td>
                        <td class="row">
                            <div class="input-group input-group-sm mb-3" style="max-width: 300px">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Tekanan darah ... x/l</span>
                                <input type="text" class="form-control" name="darah"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
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
                        <td class="fw-bold row">Ansietas</td>
                        <td class="fw-bold row fst-italic">Berhubungan dengan</td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Kurang Terpapar informasi"
                                    name="dkbd[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Kurang Terpapar informasi
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="Kekhawatiran mengalami kegagalan" name="dkbd[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Kekhawatiran mengalami kegagalan
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Ancaman terhadap konsep diri"
                                    name="dkbd[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Ancaman terhadap konsep diri
                                </label>
                            </div>
                        </td>
                        <td class="fw-bold row fst-italic">Dibuktikan dengan</td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Merasa bingung"
                                    name="dkdd[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Merasa bingung
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="Merasa khawatir akibat dari kondisi yang di hadapi" name="dkdd[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Merasa khawatir akibat dari kondisi yang di hadapi
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Sulit berkonsentrasi"
                                    name="dkdd[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Sulit berkonsentrasi
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Tampak cemas" name="dkdd[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Tampak cemas
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Tampak gelisah"
                                    name="dkdd[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Tampak gelisah
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Tampak Tegang" name="dkdd[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Tampak Tegang
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Muka tampak pucat"
                                    name="dkdd[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Muka tampak pucat
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
                                <input class="form-check-input" type="checkbox"
                                    value="Verbalisasi kebingungan menurun" name="luaran[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Verbalisasi kebingungan menurun
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="Verbalisasi kebingungan akibat kondisi yang di hadapi menurun"
                                    name="luaran[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Verbalisasi kebingungan akibat kondisi yang di hadapi menurun
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Perilaku gelisah menurun"
                                    name="luaran[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Perilaku gelisah menurun
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
                        <td class="fw-bold row">Dukungan Mobilisasi</td>
                        <td class="fw-bold row">Tindakan</td>
                        <td class="fw-bold row">Observasi</td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="Monitor tanda tanda ansietas (verbal dan non verbal)" name="observasi[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Monitor tanda tanda ansietas (verbal dan non verbal)
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="identifikasi kondisi umum pasien" name="observasi[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    identifikasi kondisi umum pasien
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
                                <input class="form-check-input" type="checkbox" value="Ciptakan suasana terapeutik"
                                    name="terapeutik[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Ciptakan suasana terapeutik
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="dengarkan pasien dengan penuh perhatian" name="terapeutik[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    dengarkan pasien dengan penuh perhatian
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
                                    value="latih kegiatan pengalihan untuk mengurangi ketegangan" name="edukasi[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    latih kegiatan pengalihan untuk mengurangi ketegangan
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="latih teknik relaksasi"
                                    name="edukasi[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    latih teknik relaksasi
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
                                    value="kolaborasi dalam pemberian obat anti anseitas, jika perlu"
                                    name="kolaborasi[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    kolaborasi dalam pemberian obat anti anseitas, jika perlu
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
                                    value="memonitoring tanda tanda ansietas (verbal dan non verbal)"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    memonitoring tanda tanda ansietas (verbal dan non verbal)
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="mengukur TTV pasien"
                                    name="implementasi[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    mengukur TTV pasien
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="mendengarkan keluhan yang disampaikan pasien" name="implementasi[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    mendengarkan keluhan yang disampaikan pasien
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="memberikan edukasi teknis napas dalam" name="implementasi[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    memberikan edukasi teknis napas dalam
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="melakukan kolaborasi dalam pemberian obat" name="implementasi[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    melakukan kolaborasi dalam pemberian obat
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="melakukan kolaborasi dengan dokter menjelaskan tentang penyakitnya"
                                    name="implementasi[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    melakukan kolaborasi dengan dokter menjelaskan tentang penyakitnya
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="menganjurkan keluarga untuk mendapingi pasien" name="implementasi[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    menganjurkan keluarga untuk mendapingi pasien
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
            }
            newInput.innerHTML = `
          <input class="form-control form-control-sm" style="max-width: 300px;" name="${inputName}" type="text" placeholder="Mengeluh Sulit Menggerakkan" aria-label=".form-control-sm example">
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
