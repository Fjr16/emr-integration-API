@extends('layouts.backend.main')

@section('content')
    @if (session()->has('success'))
        <div class="mb-5 border alert alert-success w-100 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div id="success-message"></div>
    <div class="mb-4 card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Asesmen Monitoring Status Fungsional (<em>BARTHEL INDEX</em>)
            </h5>
        </div>
        <form action="{{ route('monitoring/status/fungsional.store', $item->id) }}" method="POST"
            onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
            @csrf
            <div class="card-body">
                <div class="mt-3 mb-3 row align-items-center">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-2">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="Selama Perawatan" name="isPulang"
                                id="selamaperawatan" checked>
                            <label class="form-check-label" for="selamaperawatan">
                                Selama Perawatan
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="Saat Pulang" name="isPulang"
                                id="saatpulang">
                            <label class="form-check-label" for="saatpulang">
                                Saat Pulang
                            </label>
                        </div>
                    </div>
                </div>
                <div class="mt-3 mb-3 row align-items-center">
                    <label class="col-sm-2 col-form-label" for="tanggal">Tanggal</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="date" name="tanggal" id="tanggal"
                            value="{{ $today->format('Y-m-d') }}" />
                    </div>
                </div>
                <div id="pelaksananAsesmen" style="display: none">
                    <div class="mt-3 mb-3 row align-items-center">
                        <label class="col-sm-2 col-form-label" for="makan">Asesmen Dilaksankan</label>
                        <div class="col-sm-10">
                            <select name="pelaksanaan_asesmen" class="form-select form-control" id="">
                                <option value="">Pilih Pelaksanaan Asesmen</option>
                                <option value="Awal Masuk (A)">Awal Masuk (A)</option>
                                <option value="Perubahan Kondisi (PK)">Perubahan Kondisi (PK)</option>
                                <option value="Shift Pagi (SP)">Shift Pagi (SP)</option>
                            </select>
                            <div class="text-dark">
                                <small>
                                    {{ '*Pilih Pelaksanaan Asesmen' }}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3 mb-3 row align-items-center">
                    <label class="col-sm-2 col-form-label" for="makan">Makan</label>
                    <div class="col-sm-10">
                        <select name="nilai[]" class="form-select form-control" id="">
                            <option value="5">5</option>
                            <option value="5">10</option>
                        </select>
                        <div class="text-dark">
                            <small>
                                {{ '*Skor dengan bantuan 5, mandiri 10' }}
                            </small>
                        </div>
                    </div>
                </div>
                <div class="mt-3 mb-3 row align-items-center">
                    <label class="col-sm-2 col-form-label" for="toilet">Toilet (Aktivitas BAB & BAK)</label>
                    <div class="col-sm-10">
                        <select name="nilai[]" class="form-select form-control" id="">
                            <option value="5">5</option>
                            <option value="10">10</option>
                        </select>
                        <div class="text-dark">
                            <small>
                                {{ '*Skor dengan bantuan 5, mandiri 10' }}
                            </small>
                        </div>
                    </div>
                </div>
                <div class="mt-3 mb-3 row align-items-center">
                    <label class="col-sm-2 col-form-label" for="berpindah">Berpindah dari kursi roda ke tempat
                        tidur/sebaliknya</label>
                    <div class="col-sm-10">
                        <select name="nilai[]" class="form-select form-control" id="">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                        </select>
                        <div class="text-dark">
                            <small>
                                {{ '*Skor dengan bantuan 5-10, mandiri 15' }}
                            </small>
                        </div>
                    </div>
                </div>
                <div class="mt-3 mb-3 row align-items-center">
                    <label class="col-sm-2 col-form-label" for="kebersihan">Kebersihan diri, mencuci muka, menyisir
                        rambut,
                        menggosok gigi
                    </label>
                    <div class="col-sm-10">
                        <select name="nilai[]" class="form-select form-control" id="">
                            <option value="0">0</option>
                            <option value="5">5</option>
                        </select>
                        <div class="text-dark">
                            <small>
                                {{ '*Skor dengan bantuan 0, mandiri 5' }}
                            </small>
                        </div>
                    </div>
                </div>
                <div class="mt-3 mb-3 row align-items-center">
                    <label class="col-sm-2 col-form-label" for="mandi">Mandi</label>
                    <div class="col-sm-10">
                        <select name="nilai[]" class="form-select form-control" id="">
                            <option value="0">0</option>
                            <option value="5">5</option>
                        </select>
                        <div class="text-dark">
                            <small>
                                {{ '*Skor dengan bantuan 0, mandiri 5' }}
                            </small>
                        </div>
                    </div>
                </div>
                <div class="mt-3 mb-3 row align-items-center">
                    <label class="col-sm-2 col-form-label" for="berjalan">Berjalan di permukaan datar</label>
                    <div class="col-sm-10">
                        <select name="nilai[]" class="form-select form-control" id="">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                        </select>
                        <div class="text-dark">
                            <small>
                                {{ '*Skor dengan bantuan 5-10, mandiri 15' }}
                            </small>
                        </div>
                    </div>
                </div>
                <div class="mt-3 mb-3 row align-items-center">
                    <label class="col-sm-2 col-form-label" for="turun_tangga">Naik turun tangga</label>
                    <div class="col-sm-10">
                        <select name="nilai[]" class="form-select form-control" id="">
                            <option value="5">5</option>
                            <option value="10">10</option>
                        </select>
                        <div class="text-dark">
                            <small>
                                {{ '*Skor dengan bantuan 5, mandiri 10' }}
                            </small>
                        </div>
                    </div>
                </div>
                <div class="mt-3 mb-3 row align-items-center">
                    <label class="col-sm-2 col-form-label" for="berpakaian">Berpakaian</label>
                    <div class="col-sm-10">
                        <select name="nilai[]" class="form-select form-control" id="">
                            <option value="5">5</option>
                            <option value="10">10</option>
                        </select>
                        <div class="text-dark">
                            <small>
                                {{ '*Skor dengan bantuan 5, mandiri 10' }}
                            </small>
                        </div>
                    </div>
                </div>
                <div class="mt-3 mb-3 row align-items-center">
                    <label class="col-sm-2 col-form-label" for="kontrol_bab">Mengontrol defekasi/BAB</label>
                    <div class="col-sm-10">
                        <select name="nilai[]" class="form-select form-control" id="">
                            <option value="5">5</option>
                            <option value="10">10</option>
                        </select>
                        <div class="text-dark">
                            <small>
                                {{ '*Skor dengan bantuan 5, mandiri 10' }}
                            </small>
                        </div>
                    </div>
                </div>
                <div class="mt-3 mb-3 row align-items-center">
                    <label class="col-sm-2 col-form-label" for="kontrol_bak">Mengontrol berkemih/BAK</label>
                    <div class="col-sm-10">
                        <select name="nilai[]" class="form-select form-control" id="">
                            <option value="5">5</option>
                            <option value="10">10</option>
                        </select>
                        <div class="text-dark">
                            <small>
                                {{ '*Skor dengan bantuan 5, mandiri 10' }}
                            </small>
                        </div>
                    </div>
                </div>

                <hr class="mt-3">

                <div class="mt-3 mb-3 row align-items-center">
                    <label class="col-sm-2 col-form-label" for="total_skor">Total Skor</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="total_skor" id="total_skor" required readonly>
                    </div>
                </div>
                <div class="mt-3 mb-3 row align-items-center">
                    <label class="col-sm-2 col-form-label" for="kategori_skor">Kategori Skor</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="kategori_skor" id="kategori_skor" readonly>
                    </div>
                </div>
                <div class="mt-3 mb-3 row align-items-center">
                    <label class="col-sm-2 col-form-label" for="nama_perawat">Inisial Nama Perawat Yang Mengkaji</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama_perawat"
                            value="{{ auth()->user()->name }}" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <p class="m-0">Catatan :</p>
                        <ul style="list-style: decimal">
                            <li>Asesmen Monitoring status fungsional dilaksanakan setiap hari (Shift Pagi /
                                SP) dan
                                situasional pada saat :
                                <span>
                                    <ol style=" list-style-type:disc">
                                        <li>Awal Masuk (A)</li>
                                        <li>Perubahan Kondisi (PK)</li>
                                    </ol>

                                </span>
                            </li>
                            <li class="m-0">Total Skor ≥ 6 direkomendasikan dengan DPJP untuk konsul ke Rehabilitasi
                                Medik
                            </li>
                        </ul>
                    </div>
                    <div class="col">
                        <table>
                            <tr>
                                <th colspan="3">Kategori Skor</th>
                            </tr>
                            <tr>
                                <td>Mandiri</td>
                                <td>(M)</td>
                                <td>100</td>
                            </tr>
                            <tr>
                                <td>Ketergantungan Ringan</td>
                                <td>(KR)</td>
                                <td>91-99</td>
                            </tr>
                            <tr>
                                <td>Ketergantungan Sedang</td>
                                <td>(KS)</td>
                                <td>62-90</td>
                            </tr>
                            <tr>
                                <td>Ketergantungan Berat</td>
                                <td>(KB)</td>
                                <td>21-61</td>
                            </tr>
                            <tr>
                                <td>Ketergantungan Total</td>
                                <td>(KT)</td>
                                <td>0-20</td>
                            </tr>
                            <tr>
                                <td colspan="3">(Bila Ketergantungan Total, kolaborasi dengan DPJP)</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="mb-3 text-end">
                    <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                </div>
            </div>
        </form>
    </div>

    <script type="text/javascript">
        var selectInputs = document.querySelectorAll('select[name="nilai[]"]');
        var inputTotal = document.getElementById('total_skor');
        selectInputs.forEach(function(item) {
            item.addEventListener('change', function() {
                var totalSkor = 0;

                for (var a = 0; a < selectInputs.length; a++) {
                    var nilai = parseInt(selectInputs[a].value) || 0;
                    totalSkor += nilai;
                }
                inputTotal.value = totalSkor;
                skorCategory(totalSkor);
            });
        });

        function skorCategory(totalSkor) {
            var kategoriSkor = document.getElementById('kategori_skor');
            if (totalSkor == 100) {
                kategoriSkor.value = 'M';
            } else if (totalSkor >= 91 && totalSkor <= 99) {
                kategoriSkor.value = 'KR';
            } else if (totalSkor >= 62 && totalSkor <= 90) {
                kategoriSkor.value = 'KS';
            } else if (totalSkor >= 21 && totalSkor <= 61) {
                kategoriSkor.value = 'KB';
            } else if (totalSkor >= 0 && totalSkor <= 20) {
                kategoriSkor.value = 'KT';
            }
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Mendapatkan elemen radio button
            var selamaPerawatanRadio = document.getElementById("selamaperawatan");
            var saatPulangRadio = document.getElementById("saatpulang");

            // Mendapatkan elemen untuk ditampilkan atau disembunyikan
            var pelaksanaAsesmen = document.getElementById("pelaksananAsesmen");

            // Menambahkan event listener pada setiap perubahan pada radio button
            selamaPerawatanRadio.addEventListener("change", function() {
                // Memeriksa apakah radio button "Selama Perawatan" dipilih
                if (selamaPerawatanRadio.checked) {
                    // Jika dipilih, tampilkan elemen pelaksanaAsesmen
                    pelaksanaAsesmen.style.display = "block";
                }
            });

            saatPulangRadio.addEventListener("change", function() {
                // Memeriksa apakah radio button "Saat Pulang" dipilih
                if (saatPulangRadio.checked) {
                    // Jika dipilih, sembunyikan elemen pelaksanaAsesmen
                    pelaksanaAsesmen.style.display = "none";
                }
            });

            // Set opsi "Selama Perawatan" terpilih secara default saat halaman dimuat
            selamaPerawatanRadio.checked = true;
            // Tampilkan elemen pelaksanaAsesmen saat halaman dimuat
            pelaksanaAsesmen.style.display = "block";
        });
    </script>
@endsection
