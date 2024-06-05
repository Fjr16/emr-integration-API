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
            <form action="{{ route('fisik.store') }}" method="POST">
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
                                        value="Mengeluh sulit menggerakkan ekstremitas" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Mengeluh sulit menggerakkan ekstremitas
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
                                    <input class="form-check-input" type="checkbox" value="Kekuatan Otot Menurun"
                                        name="majorObjektif[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Kekuatan Otot Menurun
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="majorObjektif[]"
                                        value="Rentang Gerak (ROM) menurun" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Rentang Gerak (ROM) menurun
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
                                        value="Nyeri Saat Bergerak" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Nyeri Saat Bergerak
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Enggan Melakukan Pergerakan"
                                        name="minorSubjektif[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Enggan Melakukan Pergerakan
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Merasa Cemas Saat Bergerak"
                                        name="minorSubjektif[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Merasa Cemas Saat Bergerak
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
                                    <input class="form-check-input" type="checkbox" name="minorObjektif[]"
                                        value="Nyeri Saat Bergerak" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Nyeri Saat Bergerak
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="minorObjektif[]"
                                        value="Enggan Melakukan Pergerakan" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Enggan Melakukan Pergerakan
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Merasa Cemas Saat Bergerak"
                                        name="minorObjektif[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Merasa Cemas Saat Bergerak
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
                            <td class="fw-bold row">Gangguan Mobilitas Fisik</td>
                            <td class="fw-bold row fst-italic">Berhubungan dengan</td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="Kerusakan integritas struktur tulang" name="dkbd[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Kerusakan integritas struktur tulang
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kontraktur" name="dkbd[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Kontraktur
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Penurunan Kekuatan Otot"
                                        name="dkbd[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Penurunan Kekuatan Otot
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kekakuan Sendi"
                                        name="dkbd[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Kekakuan Sendi
                                    </label>
                                </div>
                            </td>
                            <td class="fw-bold row fst-italic">Dibuktikan dengan</td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="Mengeluh sulit menggerakkan ekstremitas" name="dkdd[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Mengeluh sulit menggerakkan ekstremitas
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kekuatan otot menurun"
                                        name="dkdd[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Kekuatan otot menurun
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Rentang Gerak (ROM) menurun"
                                        name="dkdd[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Rentang Gerak (ROM) menurun
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Nyeri saat bergerak"
                                        name="dkdd[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Nyeri saat bergerak
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Sendi Kaku" name="dkdd[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Sendi Kaku
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Gerakan terbatas"
                                        name="dkdd[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Gerakan terbatas
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Fisik Lemah" name="dkdd[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Fisik Lemah
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
                            <td class="fw-bold row">Luaran</td>
                            <td class="row">
                                <p>Setelah dilakukan intervensi keperawatan selama</p>
                                <div class="input-group input-group-sm mb-3" style="max-width: 150px">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Jam</span>
                                    <input type="text" class="form-control" name="jam"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                </div>
                                <p>Mobilitas fisik meningkat dengan kriteria hasil : </p>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="Pergerakan ekstriminitas meningkat" name="luaran[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Pergerakan ekstriminitas meningkat
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kekuatan otot meningkat"
                                        name="luaran[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Kekuatan otot meningkat
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Rentang gerak (ROM) meningkat"
                                        name="luaran[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Rentang gerak (ROM) meningkat
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
                                        value="Identifikasi adanya nyeri atau keluhan fisik lainnya" name="observasi[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Identifikasi adanya nyeri atau keluhan fisik lainnya
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="Identifikasi toleransi fisik melakukan pergerakan" name="observasi[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Identifikasi toleransi fisik melakukan pergerakan
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="Monitor Kondisi umum selama melakukan mobilisasi" name="observasi[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Monitor Kondisi umum selama melakukan mobilisasi
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
                                        value="Fasilitasi aktifitas mobilisasi dengan alat bantu (kruk, walker, dll)"
                                        name="terapeutik[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Fasilitasi aktifitas mobilisasi dengan alat bantu (kruk, walker, dll)
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="Fasilitasi melakukan pergerakan jika perlu" name="terapeutik[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Fasilitasi melakukan pergerakan jika perlu
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="Libatkan keluaga untuk membantu pasien dalam pergerakan"
                                        name="terapeutik[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Libatkan keluaga untuk membantu pasien dalam pergerakan
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
                                        value="Jelaskan tujuan dan prosedur mobilisasi" name="edukasi[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Jelaskan tujuan dan prosedur mobilisasi
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Ajarkan mobilisasi sederhana"
                                        name="edukasi[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Ajarkan mobilisasi sederhana
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
                                        value="Memonitoring keadaan umum pasien" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Memonitoring keadaan umum pasien
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="Mengidentifikasi keluhan fisik lainnya" name="implementasi[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Mengidentifikasi keluhan fisik lainnya
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="Mengidentifikasi toleransi fisik melakukan pergerakan"
                                        name="implementasi[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Mengidentifikasi toleransi fisik melakukan pergerakan
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="Memfasilitasi alat bantu yang di perlukan untuk mobilisasi"
                                        name="implementasi[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Memfasilitasi alat bantu yang di perlukan untuk mobilisasi
                                    </label>
                                </div>
                            </td>
                            <td class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="Melibatkan keluarga dalam membantu mobilisasi" name="implementasi[]"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Melibatkan keluarga dalam membantu mobilisasi
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
                            <td class="row">Gangguan mobilitas fisik : </td>
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
        <form action="{{ route('fisik.store') }}" method="POST">
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
                                    value="Mengeluh sulit menggerakkan ekstremitas" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Mengeluh sulit menggerakkan ekstremitas
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
                                <input class="form-check-input" type="checkbox" value="Kekuatan Otot Menurun"
                                    name="majorObjektif[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Kekuatan Otot Menurun
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="majorObjektif[]"
                                    value="Rentang Gerak (ROM) menurun" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Rentang Gerak (ROM) menurun
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
                                    value="Nyeri Saat Bergerak" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Nyeri Saat Bergerak
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Enggan Melakukan Pergerakan"
                                    name="minorSubjektif[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Enggan Melakukan Pergerakan
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Merasa Cemas Saat Bergerak"
                                    name="minorSubjektif[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Merasa Cemas Saat Bergerak
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
                                <input class="form-check-input" type="checkbox" name="minorObjektif[]"
                                    value="Nyeri Saat Bergerak" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Nyeri Saat Bergerak
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="minorObjektif[]"
                                    value="Enggan Melakukan Pergerakan" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Enggan Melakukan Pergerakan
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Merasa Cemas Saat Bergerak"
                                    name="minorObjektif[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Merasa Cemas Saat Bergerak
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
                        <td class="fw-bold row">Gangguan Mobilitas Fisik</td>
                        <td class="fw-bold row fst-italic">Berhubungan dengan</td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="Kerusakan integritas struktur tulang" name="dkbd[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Kerusakan integritas struktur tulang
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Kontraktur" name="dkbd[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Kontraktur
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Penurunan Kekuatan Otot"
                                    name="dkbd[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Penurunan Kekuatan Otot
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Kekakuan Sendi"
                                    name="dkbd[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Kekakuan Sendi
                                </label>
                            </div>
                        </td>
                        <td class="fw-bold row fst-italic">Dibuktikan dengan</td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="Mengeluh sulit menggerakkan ekstremitas" name="dkdd[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Mengeluh sulit menggerakkan ekstremitas
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Kekuatan otot menurun"
                                    name="dkdd[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Kekuatan otot menurun
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Rentang Gerak (ROM) menurun"
                                    name="dkdd[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Rentang Gerak (ROM) menurun
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Nyeri saat bergerak"
                                    name="dkdd[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Nyeri saat bergerak
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Sendi Kaku" name="dkdd[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Sendi Kaku
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Gerakan terbatas"
                                    name="dkdd[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Gerakan terbatas
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Fisik Lemah" name="dkdd[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Fisik Lemah
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
                        <td class="fw-bold row">Luaran</td>
                        <td class="row">
                            <p>Setelah dilakukan intervensi keperawatan selama</p>
                            <div class="input-group input-group-sm mb-3" style="max-width: 150px">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Jam</span>
                                <input type="text" class="form-control" name="jam"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                            </div>
                            <p>Mobilitas fisik meningkat dengan kriteria hasil : </p>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="Pergerakan ekstriminitas meningkat" name="luaran[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Pergerakan ekstriminitas meningkat
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Kekuatan otot meningkat"
                                    name="luaran[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Kekuatan otot meningkat
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Rentang gerak (ROM) meningkat"
                                    name="luaran[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Rentang gerak (ROM) meningkat
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
                                    value="Identifikasi adanya nyeri atau keluhan fisik lainnya" name="observasi[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Identifikasi adanya nyeri atau keluhan fisik lainnya
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="Identifikasi toleransi fisik melakukan pergerakan" name="observasi[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Identifikasi toleransi fisik melakukan pergerakan
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="Monitor Kondisi umum selama melakukan mobilisasi" name="observasi[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Monitor Kondisi umum selama melakukan mobilisasi
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
                                    value="Fasilitasi aktifitas mobilisasi dengan alat bantu (kruk, walker, dll)"
                                    name="terapeutik[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Fasilitasi aktifitas mobilisasi dengan alat bantu (kruk, walker, dll)
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="Fasilitasi melakukan pergerakan jika perlu" name="terapeutik[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Fasilitasi melakukan pergerakan jika perlu
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="Libatkan keluaga untuk membantu pasien dalam pergerakan"
                                    name="terapeutik[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Libatkan keluaga untuk membantu pasien dalam pergerakan
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
                                    value="Jelaskan tujuan dan prosedur mobilisasi" name="edukasi[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Jelaskan tujuan dan prosedur mobilisasi
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Ajarkan mobilisasi sederhana"
                                    name="edukasi[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Ajarkan mobilisasi sederhana
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
                                    value="Memonitoring keadaan umum pasien" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Memonitoring keadaan umum pasien
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="Mengidentifikasi keluhan fisik lainnya" name="implementasi[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Mengidentifikasi keluhan fisik lainnya
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="Mengidentifikasi toleransi fisik melakukan pergerakan"
                                    name="implementasi[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Mengidentifikasi toleransi fisik melakukan pergerakan
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="Memfasilitasi alat bantu yang di perlukan untuk mobilisasi"
                                    name="implementasi[]" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Memfasilitasi alat bantu yang di perlukan untuk mobilisasi
                                </label>
                            </div>
                        </td>
                        <td class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="Melibatkan keluarga dalam membantu mobilisasi" name="implementasi[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Melibatkan keluarga dalam membantu mobilisasi
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
                        <td class="row">Gangguan mobilitas fisik : </td>
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
