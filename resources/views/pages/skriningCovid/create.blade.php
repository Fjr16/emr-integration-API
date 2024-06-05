@extends('layouts.backend.main')

@section('content')

@if ($errors->any())
<div class="alert alert-danger w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index: 99; max-width: max-content; left: 50%; transform: translate(-50%, -50%);" role="alert">
    Gagal menyimpan. Pastikan semua data terisi dengan benar
</div>
@endif
<div class="card p-3 mt-5">
    <!-- <div class="card mb-4"> -->
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0 text-center">Form Skrining COVID Untuk Pasien Rawat Inap : {{ $item->queue->patient->name }}</h5>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('skrining/covid.store', $item->id) }}">
            @csrf
            <table class="table">
                <thead>
                    <tr class="text-nowrap bg-dark">
                        <th rowspan="2" class="align-middle" scope="col">No</th>
                        <th rowspan="2" class="align-middle" scope="col">Parameter</th>
                        <th colspan="2" scope="colgroup" class="text-center">Skor</th>
                        <th rowspan="2" class="align-middle" scope="col">Keterangan</th>
                    </tr>
                    <tr class="text-nowrap bg-dark">
                        <th scope="col" class="text-center">Ya</th>
                        <th scope="col" class="text-center">Tidak</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="width: 50px;">
                            1
                            <input type="hidden" name="no[]" value="1">
                        </td>
                        <td style="width: 400px;">
                            Apakah Anda atau siapapun dirumah Anda saat ini menderita COVID-19?
                            <input type="hidden" name="name[]" value="Apakah Anda atau siapapun dirumah Anda saat ini menderita COVID-19?">
                        </td>
                        <td class="text-center">
                            (5)
                            <input type="radio" name="check1" value="5">
                        </td>
                        <td class="text-center">
                            <input type="radio" name="check1" value="0" checked="true">
                        </td>
                        <td>
                            <input type="text" name="ket[]" class="form-control">
                        </td>
                    </tr>
                    <!-- <script>
                        function updateScore(scoreValue) {
                            var scoreInput = document.querySelector('input[name="score[]"]');
                            scoreInput.value = scoreValue;
                        }
                    </script> -->
                    <tr>
                        <td style="width: 50px;">
                            2
                            <input type="hidden" name="no[]" value="2">
                        </td>
                        <td style="width: 400px;">
                            Apakah Anda atau siapapun dirumah sedang mengalami :
                            <input type="hidden" name="name[]" value="Apakah Anda atau siapapun dirumah sedang mengalami :">
                        </td>

                        <td class="text-center">
                            (5)
                            <input type="radio" name="check2" value="5">
                        </td>
                        <td class="text-center">
                            <input type="radio" name="check2" value="0" checked="true">
                        </td>
                        <td>
                            <input type="text" name="ket[]" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 50px;">
                        </td>
                        <td style="width: 400px;">
                            <ul>Demam atau suhu tubuh tinggi (T>37,5)</ul>
                        </td>

                        <td class="text-center">
                            <input type="checkbox" name="detail-name[]" value="Demam atau suhu tubuh tinggi (T>37,5)" onchange="handleCheckboxChange(this)">
                        </td>
                        <td class="text-center">
                        </td>
                        <td>
                            <input type="text" name="detail-ket[]" class="form-control" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 50px;">
                            <!-- <input type="hidden" name="no[]" value="2"> -->
                        </td>
                        <td style="width: 400px;">
                            <ul>Batuk dan pilek disertai anosmia</ul>
                        </td>

                        <td class="text-center">
                            <input type="checkbox" name="detail-name[]" value="Batuk dan pilek disertai anosmia" onchange="handleCheckboxChange(this)">
                        </td>
                        <td class="text-center">
                        </td>

                        <td>
                            <input type="text" name="detail-ket[]" class="form-control" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 50px;">
                            <!-- <input type="hidden" name="no[]" value="2"> -->
                        </td>
                        <td style="width: 400px;">
                            <ul>Sesak napas (RR>25x/menit dan/atau saturasi O2<90%) dan nyeri tenggorokan</ul>
                        </td>
                        <td class="text-center">
                            <input type="checkbox" name="detail-name[]" value="Sesak napas (RR>25x/menit dan/atau saturasi O2<90%) dan nyeri tenggorokan" onchange="handleCheckboxChange(this)">
                        </td>
                        <td class="text-center">
                        </td>

                        <td>
                            <input type="text" name="detail-ket[]" class="form-control" disabled>
                        </td>
                    </tr>
                    <script>
                        function handleCheckboxChange(checkbox) {
                            var ketInput = checkbox.parentElement.nextElementSibling.nextElementSibling.querySelector('input[name="detail-ket[]"]');
                            ketInput.disabled = !checkbox.checked;
                        }
                    </script>

                    <tr>
                        <td style="width: 50px;">
                            3
                            <input type="hidden" name="no[]" value="3">
                        </td>
                        <td style="width: 400px;">
                            Apakah anda memiliki riwayat kontak dengan pasien COVID-19?
                            <input type="hidden" name="name[]" value="Apakah anda memiliki riwayat kontak dengan pasien COVID-19?">
                        </td>
                        <td class="text-center">
                            (1)
                            <input type="radio" name="check3" value="1">
                        </td>
                        <td class="text-center">
                            <input type="radio" name="check3" value="0" checked="true">
                        </td>
                        <td>
                            <input type="text" name="ket[]" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 50px;">
                            4
                            <input type="hidden" name="no[]" value="4">
                        </td>
                        <td style="width: 400px;">
                            Apakah Anda melakukan perjalanan jauh keluar kota/luar negeri dalam waktu 14 hari terakhir?
                            <input type="hidden" name="name[]" value="Apakah Anda melakukan perjalanan jauh keluar kota/luar negeri dalam waktu 14 hari terakhir?">
                        </td>
                        <td class="text-center">
                            (1)
                            <input type="radio" name="check4" value="1">
                        </td>
                        <td class="text-center">
                            <input type="radio" name="check4" value="0" checked="true">
                        </td>
                        <td>
                            <input type="text" name="ket[]" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 50px;">
                            5
                            <input type="hidden" name="no[]" value="5">
                        </td>
                        <td style="width: 400px;">
                            Apakah Anda mengikuti kegiatan yang melibatkan banyak orang?
                            <input type="hidden" name="name[]" value="Apakah Anda mengikuti kegiatan yang melibatkan banyak orang?">
                        </td>
                        <td class="text-center">
                            (1)
                            <input type="radio" name="check5" value="1">
                        </td>
                        <td class="text-center">
                            <input type="radio" name="check5" value="0" checked="true">
                        </td>
                        <td>
                            <input type="text" name="ket[]" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 50px;">
                            6
                            <input type="hidden" name="no[]" value="6">
                        </td>
                        <td style="width: 400px;">
                            Apakah Anda menggunakan transportasi umum?
                            <input type="hidden" name="name[]" value="Apakah Anda menggunakan transportasi umum?">
                        </td>
                        <td class="text-center">
                            (1)
                            <input type="radio" name="check6" value="1">
                        </td>
                        <td class="text-center">
                            <input type="radio" name="check6" value="0" checked="true">
                        </td>
                        <td>
                            <input type="text" name="ket[]" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 50px;">
                        </td>
                        <td style="width: 400px;">
                            Total Skor
                        </td>
                        <td colspan="2" class="text-center">
                            <input type="number" name="total_skor" id="total_skor" value="0" class="form-control" readonly>
                        </td>
                        <td>
                            <span class="btn btn-danger form-control" id="resiko_tinggi" hidden>Resiko Tinggi : Skor > 4 Dilakukan rapid / antigen</span>
                            <span class="btn btn-warning form-control" id="resiko_sedang" hidden>Resiko Sedang : Skor 1 - 4 Tidak Dilakukan rapid / antigen</span>
                            <span class="btn btn-success form-control" id="resiko_rendah">Resiko Rendah : Skor 0 Tidak Dilakukan rapid / antigen</span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <br>
            <div class="row justify-content-end text-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-sm btn-dark">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    var totalSkor = document.getElementById('total_skor');
    var radios = document.querySelectorAll('input[type="radio"]');
    radios.forEach(function(radio){
        radio.addEventListener('change', function(){
            var total = 0;

            for(var i = 0; i < radios.length; i++){
                if (radios[i].checked) {                    
                    var nilai = parseInt(radios[i].value);
                    total += nilai;
                }
            }

            jumlahSkor(total);
            totalSkor.value = total;
        });
    });
    function jumlahSkor(total){
        var resikoTinggi = document.getElementById('resiko_tinggi');
        var resikoSedang = document.getElementById('resiko_sedang');
        var resikoRendah = document.getElementById('resiko_rendah');
        if(total > 4){
            resikoTinggi.hidden = false;
            resikoSedang.hidden = true;
            resikoRendah.hidden = true;
        }else if(total >= 1 && total <= 4){
            resikoSedang.hidden = false;
            resikoTinggi.hidden = true;
            resikoRendah.hidden = true;
        }else if(total == 0){
            resikoRendah.hidden = false;
            resikoTinggi.hidden = true;
            resikoSedang.hidden = true;
        }
    }
</script>
@endsection