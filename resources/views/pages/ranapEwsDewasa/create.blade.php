@extends('layouts.backend.main')

@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Early Warning System (EWS) Dewasa</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <table class="table table-bordered" style="font-size: 10pt;">
                        <thead>
                            <tr>
                                <th class="text-body">Total Skor</th>
                                <th class="text-body">Frekuensi Observasi</th>
                                <th class="text-body">Alert</th>
                                <th class="text-body">Respon</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Setiap 12 jam</td>
                                <td>Perawat yang bertugas</td>
                                <td>Perawat yang bertugas mereview kondisi pasien</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Setiap 6 jam</td>
                                <td>Perawat yang bertugas</td>
                                <td>Perawat yang bertugas mereview kondisi pasien</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Setiap 4 jam</td>
                                <td>Perawat yang bertugas dan tim pengkajian kritis</td>
                                <td>PPA/PJ shift untuk meninjau dalam waktu satu jam</td>
                            </tr>
                            <tr>
                                <td>4-6</td>
                                <td>Setiap 1 jam</td>
                                <td>Perawat yang bertugas dan tim pengkajian kritis</td>
                                <td>
                                    <ul>
                                        <li>PPA/PJ shift untuk meninjau dalam waktu setengah jam</li>
                                        <li>Screening untuk Septis</li>
                                        <li>Jika tidak ada respon terhadap pengobatan dalam 1 jam hubungi dokter</li>
                                        <li>Jika tidak ada respon terhadap pengobatan dalam 1 jam hubungi dokter</li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>≥ 7</td>
                                <td>Setiap ½ jam</td>
                                <td>Perawat yang bertugas dan tim pengkajian kritis</td>
                                <td>
                                    <ul>
                                        <li>Dokter segera meninjau</li>
                                        <li>Pemantauan pasien terus menerus</li>
                                        <li>Rencanakan untuk pindah ke tingkat perawatan yang lebih tinggi</li>
                                        <li>Mengaktifkan sistem tanggap darurat (Emergency Response System/ERS)(sesuai model rumah sakit)</li>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered w-100 text-dark" style="font-size: 8pt;">
                        <thead>
                            <tr>
                                <th class="text-dark text-center bg-primary " colspan="8">NEWSS PASIEN DEWASA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <td></td>
                                <td class="bg-danger"></td>
                                <td style="background-color: rgb(219, 143, 0)"></td>
                                <td class="bg-warning">1</td>
                                <td class="bg-success">0</td>
                                <td class="bg-warning">1</td>
                                <td class="bg-success">2</td>
                                <td class="bg-danger">3</td>
                            </tr>
                            <tr class="text-center">
                                <td>Frekuensi Pernapasan (x/menit)</td>
                                <td class="bg-danger p-0"></td>
                                <td class="p-0" style="background-color: rgb(219, 143, 0)">< 8</td>
                                <td class="bg-warning p-0">8</td>
                                <td class="bg-success p-0">9-17</td>
                                <td class="bg-warning p-0">18-20</td>
                                <td class="bg-success p-0">21-29</td>
                                <td class="bg-danger p-0">≥ 30</td>
                            </tr>
                            <tr class="text-center">
                                <td>Frekuensi Nadi (x/menit)</td>
                                <td class="bg-danger p-0"></td>
                                <td class="p-0" style="background-color: rgb(219, 143, 0)">< 40</td>
                                <td class="bg-warning p-0">40-50</td>
                                <td class="bg-success p-0">51-100</td>
                                <td class="bg-warning p-0">101-110</td>
                                <td class="bg-success p-0">111-129</td>
                                <td class="bg-danger p-0">≥ 130</td>
                            </tr>
                            <tr class="text-center">
                                <td>CRT</td>
                                <td class="bg-danger p-0"></td>
                                <td class="p-0" style="background-color: rgb(219, 143, 0)"></td>
                                <td class="bg-warning p-0"></td>
                                <td class="bg-success p-0">Kulit normal CRT 1,2 detik</td>
                                <td class="bg-warning p-0">Pucat, CRT 3 detik</td>
                                <td class="bg-success p-0">Abu-abu/ Kebiruan CRT 4 detik</td>
                                <td class="bg-danger p-0">Biru CRT 5 detik</td>
                            </tr>
                            <tr class="text-center">
                                <td>Tekanan Darah Sistolik (mmHg)</td>
                                <td class="bg-danger p-0">± 70</td>
                                <td class="p-0" style="background-color: rgb(219, 143, 0)">71-80</td>
                                <td class="bg-warning p-0">81-100</td>
                                <td class="bg-success p-0">101-159</td>
                                <td class="bg-warning p-0">160-199</td>
                                <td class="bg-success p-0">200-220</td>
                                <td class="bg-danger p-0">> 220</td>
                            </tr>
                            <tr class="text-center">
                                <td>Tingkat Kesadaran</td>
                                <td class="bg-danger">Coma</td>
                                <td class="" style="background-color: rgb(219, 143, 0)">Stupor</td>
                                <td class="bg-warning">Somnolen</td>
                                <td class="bg-success">Compos Mentis</td>
                                <td class="bg-warning">Apatis</td>
                                <td class="bg-success">Acute Confusional / Delirium</td>
                                <td class="bg-danger"></td>
                            </tr>
                            <tr class="text-center">
                                <td>Suhu Tubuh (°C)</td>
                                <td class="bg-danger p-0"></td>
                                <td class="p-0" style="background-color: rgb(219, 143, 0)">< 35°C</td>
                                <td class="bg-warning p-0">35,05°C - 36°C</td>
                                <td class="bg-success p-0">36,5°C - 38°C</td>
                                <td class="bg-warning p-0">38,05°C - 38,5°C</td>
                                <td class="bg-success p-0">>38,5°C</td>
                                <td class="bg-danger p-0"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-6">
                    <form method="POST" action="{{ route('ews/dewasa.store', $item->id) }}">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <table class="table" style="font-size: 9pt;">
                                    <tbody>
                                        <tr>
                                            <td class="bg-success">Hijau (0-1)</td>
                                            <td>Stabil</td>
                                        </tr>
                                        <tr>
                                            <td class="bg-warning">Kuning (2-3)</td>
                                            <td>Resiko Ringan</td>
                                        </tr>
                                        <tr>
                                            <td style="background-color: rgb(219, 143, 0)">Orange (4-5)</td>
                                            <td>Resiko Sedang</td>
                                        </tr>
                                        <tr>
                                            <td class="bg-danger">Merah (≥6)</td>
                                            <td>Resiko Tinggi</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-6" style="font-size: 9pt;">
                                <p class="m-0">Catatan :</p>
                                <p class="m-0">Observasi dan pencatatan Early Warning System (EWS) dilakukan :</p>
                                <ol type="a">
                                    <li>Pada saat pasien masuk</li>
                                    <li>Sesuai dengan total skor (frekuensi observasi)</li>
                                    <li>Pada saat pasien mengalami perubahan kondisi</li>
                                    <li>Jika petugas khawatir dengan perubahan kondisi pasien</li>
                                </ol>
                            </div>
                        </div>
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="basic-default-name">Tanggal</label>
                            <div class="col-sm-9">
                                <input type="date" name="tanggal" class="form-control" id="basic-default-name"
                                    @required(true)>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="basic-default-name">Waktu</label>
                            <div class="col-sm-9">
                                <input type="time" name="jam" class="form-control" id="basic-default-name"
                                    @required(true)>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="basic-default-name">frekuensi napas</label>
                            <div class="col-sm-9">
                                <input type="number" name="frekuensi_napas" class="form-control" id="basic-default-name" onchange="hitungSkor()"
                                    @required(true)>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="basic-default-name">Frekuensi Nadi</label>
                            <div class="col-sm-9">
                                <input type="number" name="frekuensi_nadi" class="form-control" id="basic-default-name" onchange="hitungSkor()"
                                    @required(true)>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="basic-default-name">Tekanan Sistolik</label>
                            <div class="col-sm-9">
                                <input type="number" name="tekanan_sistolik" class="form-control" id="basic-default-name" onchange="hitungSkor()"
                                    @required(true)>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="basic-default-name">Suhu</label>
                            <div class="col-sm-9">
                                <input type="number" name="suhu" step="any" class="form-control" id="basic-default-name" onchange="hitungSkor()"
                                    @required(true)>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="basic-default-name">Jumlah Skor</label>
                            <div class="col-sm-9">
                                <input type="number" name="total_skor" class="form-control" id="jumlah_skor"
                                    readonly>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-success btn-sm">Submit</button>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
@endsection

<script>

function hitungSkor(){
    var input = document.querySelectorAll('input[type=number]');
    var inputSkor = document.getElementById('jumlah_skor');
    var skorNafas = 0;
    var skorNadi = 0;
    var skorSisto = 0;
    var skorSuhu = 0;
    input.forEach(function(element){
        if(element.name == 'frekuensi_napas'){
            valFN = element.value;
            if (valFN == 8 || valFN >= 18 && valFN <= 20) {
                skorNafas = 1;
            } else if(valFN >= 9 && valFN <= 17) {
                skorNafas = 0;
            } else if(valFN >= 21 && valFN <= 29){
                skorNafas = 2;
            } else if(valFN >= 30){
                skorNafas = 3;
            }
        }
        if(element.name == 'frekuensi_nadi'){
            valFND = element.value;
            if (valFND >= 40 && valFND <= 50 || valFND >= 101 && valFND <= 110) {
                skorNadi = 1;
            } else if(valFND >= 51 && valFND <= 100) {
                skorNadi = 0;
            } else if(valFND >= 111 && valFND <= 129){
                skorNadi = 2;
            } else if(valFND >= 130){
                skorNadi = 3;
            }
        }
        if(element.name == 'tekanan_sistolik'){
            valS = element.value;
            if (valS >= 81 && valS <= 100 || valS >= 160 && valS <= 199) {
                skorSisto = 1;
            } else if(valS >= 101 && valS <= 159) {
                skorSisto = 0;
            } else if(valS >= 200 && valS <= 220){
                skorSisto = 2;
            } else if(valS > 220){
                skorSisto = 3;
            }
        }
        if(element.name == 'suhu'){
            valSH = element.value;
            if (valSH >= 35.05 && valSH <= 36 || valSH >= 38.05 && valSH <= 38.5) {
                skorSuhu = 1;
            } else if(valSH >= 36.5 && valSH <= 38) {
                skorSuhu = 0;
            } else if(valSH > 38.5){
                skorSuhu = 2;
            }
        }
    });
    inputSkor.value = skorNafas + skorNadi + skorSisto + skorSuhu;
}
</script>
