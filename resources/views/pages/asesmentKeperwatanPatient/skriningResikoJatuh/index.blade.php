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
            <div class="row">
                <div class="col-9">
                    <h5 class="mb-0 m-0">Asesmen Perawat <span
                            class="fs-4 fw-bold text-primary">{{ $item->patient->name ?? '' }}</span></h5>
                </div>
                <div class="col-3 m-0 text-end">
                    <a href="{{ route('rajal/show', ['id' => $item->id, 'title' => 'Rawat Jalan']) }}"
                        class="btn btn-success btn-sm">Kembali</a>
                </div>
            </div>
            <div class="row m-auto mt-2">
                <a href="{{ route('rajal/asesmen/status/fisik.index', $item->id) }}"
                    class="btn {{ Route::is('rajal/asesmen/status/fisik.index*') ? 'btn-primary' : '' }} border btn-sm col-3">Status
                    Fisik</a>
                <a href="{{ route('rajal/asesmen/skrining/resiko/jatuh.index', $item->id) }}"
                    class="btn {{ Route::is('rajal/asesmen/skrining/resiko/jatuh.index*') ? 'btn-primary' : '' }} border btn-sm col-3">Skrining
                    Resiko Jatuh</a>
                <a href="{{ route('rajal/asesmen/diagnosis/keperawatan.index', $item->id) }}"
                    class="btn {{ Route::is('rajal/asesmen/diagnosis/keperawatan.index*') ? 'btn-primary' : '' }} border btn-sm col-3">Diagnosis
                    Keperawatan</a>
                <a href="{{ route('rajal/asesmen/rencana/asuhan.index', $item->id) }}"
                    class="btn {{ Route::is('rajal/asesmen/rencana/asuhan.index*') ? 'btn-primary' : '' }} border btn-sm col-3">Rencana
                    Asuhan</a>
            </div>
        </div>

        <div class="card-body">
            <h6 class="text-center bg-dark text-white py-2">SKRINING RESIKO JATUH RAWAT JALAN (GET UP AND GO TEST)</h6>
            <form action="{{ route('rajal/asesmen/skrining/resiko/jatuh.store', $item->id) }}" method="POST">
                @csrf
                <table class="table table-bordered w-100 mb-3">
                    <thead>
                        <tr class="text-center">
                            <th colspan="2" class="text-body">KOMPONEN PENILAIAN</th>
                            <th class="text-body">YA</th>
                            <th class="text-body">TIDAK</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="2">a. Perhatikan cara berjalan pasien saat akan duduk dikursi. Apakah pasien
                                tampak tidak seimbang (sempoyongan / linglung) ?</td>
                            <td class="text-center">
                                <input class="form-check-input" name="a" id="radioAya" type="radio" value="ya"
                                    {{ $resikorajal && $resikorajal->a == 'ya' ? 'checked' : '' }} />
                            </td>
                            <td class="text-center">
                                <input class="form-check-input" name="a" id="radioAtidak" type="radio"
                                    value="tidak" {{ $resikorajal && $resikorajal->a == 'tidak' ? 'checked' : '' }} />
                            </td>
                        </tr>

                        <td colspan="2">b. Apakah pasien memegang pinggiran kursi atau meja atau benda lain sebagai
                            penopang saat akan duduk?</td>
                        <td class="text-center">
                            <input class="form-check-input" name="b" id="radioBya" type="radio" value="ya"
                                {{ $resikorajal && $resikorajal->b == 'ya' ? 'checked' : '' }} id="defaultCheck1" />
                        </td>
                        <td class="text-center">

                            <input class="form-check-input" name="b" id="radioBtidak" type="radio" value="tidak"
                                {{ $resikorajal && $resikorajal->b == 'tidak' ? 'checked' : '' }} />

                        </td>
                        </tr>
                        <tr>
                            <td style="width: 500px">
                                <p class="m-0">Kategori :</p>
                                <div class="mx-3">
                                    @foreach ($komponenPenilaian1 as $index => $komponen1)
                                        @php

                                            $checked = null;

                                            // Periksa apakah $resikorajal sudah diinisialisasi dan tidak bernilai null
                                            if (
                                                $resikorajal &&
                                                $resikorajal->detailResikoRajalDiagnosaKeperawatanPatient
                                            ) {
                                                $detail = $resikorajal->detailResikoRajalDiagnosaKeperawatanPatient
                                                    ->where('name', $komponen1)
                                                    ->first();

                                                // Periksa apakah $detail tidak null
                                                if ($detail) {
                                                    $checked = 'checked';
                                                }
                                            }

                                            // Menetapkan bagian pertama dari array sebagai terceklis jika tidak ada data dalam database

                                        @endphp
                                        <div class="form-check">
                                            <input class="form-check-input" name="kategori-skrining-rajal[]"
                                                value="{{ $komponen1 }}" id="komponen1{{ $index + 1 }}"
                                                type="checkbox" {{ $checked }}>
                                            <label class="form-check-label" for="komponen1{{ $index + 1 }}">
                                                {{ $komponen1 }}
                                            </label>
                                        </div>
                                    @endforeach

                                </div>
                            </td>
                            <td colspan="3">
                                @foreach ($komponenPenilaian2 as $index => $komponen2)
                                    @php
                                        $checked = null;

                                        // Periksa apakah $resikorajal sudah diinisialisasi dan tidak bernilai null
                                        if ($resikorajal && $resikorajal->detailResikoRajalDiagnosaKeperawatanPatient) {
                                            $detail = $resikorajal->detailResikoRajalDiagnosaKeperawatanPatient
                                                ->where('name', $komponen2)
                                                ->first();

                                            // Periksa apakah $detail tidak null
                                            if ($detail) {
                                                $checked = 'checked';
                                            }
                                        }

                                        // Menetapkan bagian pertama dari array sebagai terceklis jika tidak ada data dalam database

                                    @endphp
                                    <div class="form-check">
                                        <input class="form-check-input" name="kategori-skrining-rajal[]"
                                            value="{{ $komponen2 }}" id="komponen2{{ $index + 1 }}" type="checkbox"
                                            {{ $checked }}>
                                        <label class="form-check-label" for="komponen2{{ $index + 1 }}">
                                            {{ $komponen2 }}
                                        </label>
                                    </div>
                                @endforeach
                            </td>
                        </tr>
                    </tbody>
                </table>

                <h6 class="text-center bg-dark text-white py-2">ASESMEN STATUS FUNGSIONAL</h6>

                <table class="table table-bordered mb-3">
                    <thead>
                        <tr class="text-center">
                            <td>Kategori & Skor</td>
                            <td>No</td>
                            <td>Kriteria Barthel Index</td>
                            <td>Dengan Bantuan</td>
                            <td>Mandiri</td>
                            <td>Nilai</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td rowspan="11">
                                <table>
                                    <tr id="mandiri">
                                        <td>Mandiri</td>
                                        <td>:</td>
                                        <td>100</td>
                                    </tr>
                                    <tr id="ketergantungan-ringan">
                                        <td>Ketergantungan Ringan</td>
                                        <td>:</td>
                                        <td>91-99</td>
                                    </tr>
                                    <tr id="ketergantungan-sedang">
                                        <td>Ketergantungan Sedang</td>
                                        <td>:</td>
                                        <td>62-90</td>
                                    </tr>
                                    <tr id="ketergantungan-berat">
                                        <td>Ketergantungan Berat</td>
                                        <td>:</td>
                                        <td>21-61</td>
                                    </tr>
                                    <tr id="ketergantungan-total">
                                        <td>Ketergantungan Total</td>
                                        <td>:</td>
                                        <td>0-20</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">Bila Ketergantungan Total, kolaborasi dengan DPJP</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        @foreach ($kriteriaNames as $fungsional)
                        @php
                        $bantuan = '0';
                        $mandiri = '0';
                        $values = [];
                        if ($loop->iteration < 3 || $loop->iteration > 6) {
                            $bantuan = '5';
                            $mandiri = '10';
                            $values = [0, 5, 10];
                        } elseif ($loop->iteration > 3 && $loop->iteration < 6) {
                            $bantuan = '0';
                            $mandiri = '5';
                            $values = [0, 5];
                        } else {
                            $bantuan = '5-10';
                            $mandiri = '15';
                            $values = [0, 5, 10, 15];
                        }
                    
                        // Ambil nilai yang tersimpan dari database jika tersedia untuk setiap kriteria
                        $selectedValue = null;
                        if ($detailstatusfungsional->isNotEmpty()) {
                            $detail = $detailstatusfungsional->where('name', $fungsional)->first();
                            if ($detail) {
                                $selectedValue = $detail->nilai;
                            }
                        }
                    
                        // Jika tidak ada nilai tersimpan, gunakan nilai tertinggi dari $values sebagai default
                        if (is_null($selectedValue) && !empty($values)) {
                            $selectedValue = max($values);
                        }
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $fungsional }}</td>
                        <td>{{ $bantuan }}</td>
                        <td>{{ $mandiri }}</td>
                        <td>
                            <select name="kriteria[]" id="" class="form-control">
                                @foreach ($values as $vl)
                                    <option value="{{ $vl }}"
                                        {{ $vl == $selectedValue ? 'selected' : '' }}>{{ $vl }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    @endforeach
                    
                        <td colspan="5">Total</td>
                        <td><input type="number" name="total" class="form-control form-control-sm" id="total"
                                placeholder="" readonly /></td>
                        </tr>
                    </tbody>
                </table>

                <h6 class="text-center bg-dark text-white py-2">SKRINING RISIKO NUTRISIONAL</h6>
                <input id="usia" type="hidden" value="{{ $usia }}">
                <table class="table table-bordered mb-3">
                    <thead class="text-center">
                        <tr>
                            @if ($usia < 18)
                                <td class="w-50">Skrining Gizi Pada Anak <br> Berdasarkan Metode Strong Kids (usia <
                                        18)</td>
                                    @else
                                <td class="anak">Skrining Gizi Pada Dewasa <br> Berdasarkan Metode MST (usia > 18)</td>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @if ($usia < 18)
                                <td class="p-0">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <td>No</td>
                                                <td>Parameter</td>
                                                <td>Jawaban</td>
                                                <td>Nilai</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Apakah pasien tampak kurus?</td>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="anak-satu" type="radio"
                                                            value="1" id="defaultCheck1"
                                                            {{ $anak->where('name', 'Apakah pasien tampak kurus?')->pluck('nilai')->first() == '1' ? 'checked' : '' }}
                                                            data-score="1" />

                                                        <label class="form-check-label" for="defaultCheck1">
                                                            Ya
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="anak-satu" type="radio"
                                                            value="0" id="defaultCheck2"
                                                            {{ $anak->where('name', 'Apakah pasien tampak kurus?')->pluck('nilai')->first() == '0' ? 'checked' : '' }}
                                                            data-score="0" />
                                                        <label class="form-check-label" for="defaultCheck2">
                                                            Tidak
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="fw-bold text-center">1 <br> 0</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Apakah terdapat penurunan BB selama 1 bulan terakhir? Berdasarkan
                                                    penilaian objectif</td>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="anak-dua" type="radio"
                                                            value="1" id="defaultCheck1"
                                                            {{ $anak->where('name', 'Apakah terdapat penurunan BB selama 1 bulan terakhir? Berdasarkan penilaian objectif')->pluck('nilai')->first() == '1' ? 'checked' : '' }}
                                                            data-score="1" />
                                                        <label class="form-check-label" for="defaultCheck1">
                                                            Ya
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="anak-dua" type="radio"
                                                            value="0" id="defaultCheck2"
                                                            {{ $anak->where('name', 'Apakah terdapat penurunan BB selama 1 bulan terakhir? Berdasarkan penilaian objectif')->pluck('nilai')->first() == '0' ? 'checked' : '' }}
                                                            data-score="0" />
                                                        <label class="form-check-label" for="defaultCheck2">
                                                            Tidak
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="fw-bold text-center">1 <br> 0</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>
                                                    Apakah terdapat salah satu kondisi berikut?
                                                    <ul>
                                                        <li>Diare ≥ 5 kali/hari dan atau muntah > 3 kali/hari dalam seminggu
                                                            terakhir</li>
                                                        <li>Asupan makanan kurang selama 1 minggu terakhir</li>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="anak-tiga" type="radio"
                                                            value="1" id="defaultCheck1"
                                                            {{ $anak->where('name', 'Apakah terdapat salah satu kondisi berikut? - Diare ≥ 5 kali/hari dan atau muntah > 3 kali/hari dalam seminggu terakhir - Asupan makanan kurang selama 1 minggu terakhir')->pluck('nilai')->first() == '1' ? 'checked' : '' }}
                                                            data-score="1" />
                                                        <label class="form-check-label" for="defaultCheck1">
                                                            Ya
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="anak-tiga" type="radio"
                                                            value="0" id="defaultCheck2"
                                                            {{ $anak->where('name', 'Apakah terdapat salah satu kondisi berikut? - Diare ≥ 5 kali/hari dan atau muntah > 3 kali/hari dalam seminggu terakhir - Asupan makanan kurang selama 1 minggu terakhir')->pluck('nilai')->first() == '0' ? 'checked' : '' }}
                                                            data-score="0" />
                                                        <label class="form-check-label" for="defaultCheck2">
                                                            Tidak
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="fw-bold text-center">1 <br> 0</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Apakah terdapat penyakit atau keadaan yang mangakibatkan pasien beresiko
                                                    malnutrisi dan sudah malnutrisi (Gizi buruk)?</td>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="anak-empat" type="radio"
                                                            value="2" id="defaultCheck1"
                                                            {{ $anak->where('name', 'Apakah terdapat penyakit atau keadaan yang mangakibatkan pasien beresiko malnutrisi dan sudah malnutrisi (Gizi buruk)?')->pluck('nilai')->first() == '2' ? 'checked' : '' }}
                                                            data-score="2" />
                                                        <label class="form-check-label" for="defaultCheck1">
                                                            Ya
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="anak-empat" type="radio"
                                                            value="0" id="defaultCheck2"
                                                            {{ $anak->where('name', 'Apakah terdapat penyakit atau keadaan yang mangakibatkan pasien beresiko malnutrisi dan sudah malnutrisi (Gizi buruk)?')->pluck('nilai')->first() == '0' ? 'checked' : '' }}
                                                            data-score="0" />
                                                        <label class="form-check-label" for="defaultCheck2">
                                                            Tidak
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="fw-bold text-center">2 <br> 0</td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="3">Total Skor</td>
                                                <td class="fw-bold text-center" id="total-score">0</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </td>
                            @else
                                <td class="p-0">
                                    <table class="table table-bordered fs-sm">
                                        <thead>
                                            <tr>
                                                <td>No</td>
                                                <td>Parameter</td>
                                                <td>Nilai</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td rowspan="9">1</td>
                                                <td>Apakah mengalami penurunan berat badan yang tidak direncanakan/tidak
                                                    diinginkan dalam 6 bulan terakhir?</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <li>Tidak</li>
                                                </td>
                                                <td class="fw-bold text-center">
                                                    <input class="form-check-input" type="radio" name="dewasa-satu"
                                                        checked value="Tidak" id="defaultCheck3"
                                                        {{ $dewasaDua->where('name', 'Apakah mengalami penurunan berat badan yang tidak direncanakan/tidak diinginkan dalam 6 bulan terakhir? - Tidak')->pluck('nilai')->first() == '0' ? 'checked' : '' }}
                                                        data-score="0" />

                                                    <label class="form-check-label" for="defaultCheck3">
                                                        0
                                                    </label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <li>Tidak yakin (tanda-tanda : baju menjadi longgar)</li>
                                                </td>
                                                <td class="fw-bold text-center">
                                                    <input class="form-check-input" type="radio" name="dewasa-satu"
                                                        value="Tidak yakin (tanda-tanda : baju menjadi longgar)"
                                                        id="defaultCheck3"
                                                        {{ $dewasaDua->where('name', 'Apakah mengalami penurunan berat badan yang tidak direncanakan/tidak diinginkan dalam 6 bulan terakhir? - Tidak yakin (tanda-tanda : baju menjadi longgar)')->pluck('nilai')->first() == '2' ? 'checked' : '' }}
                                                        data-score="2" />

                                                    <label class="form-check-label" for="defaultCheck3">
                                                        2
                                                    </label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <li>Ya, ada penurunan BB sebanyak :</li>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="mx-4">1-5 Kg</span>
                                                </td>
                                                <td class="fw-bold text-center">
                                                    <input class="form-check-input" type="radio" name="dewasa-satu"
                                                        value="1-5 Kg" id="defaultCheck3"
                                                        {{ $dewasaDua->where('name', 'Apakah mengalami penurunan berat badan yang tidak direncanakan/tidak diinginkan dalam 6 bulan terakhir? - Ya, ada penurunan BB sebanyak 1-5 Kg')->pluck('nilai')->first() == '1' ? 'checked' : '' }}
                                                        data-score="1" />

                                                    <label class="form-check-label" for="defaultCheck3">
                                                        1
                                                    </label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="mx-4">6-10 Kg</span>
                                                </td>
                                                <td class="fw-bold text-center">
                                                    <input class="form-check-input" type="radio" name="dewasa-satu"
                                                        value="6-10 Kg" id="defaultCheck3"
                                                        {{ $dewasaDua->where('name', 'Apakah mengalami penurunan berat badan yang tidak direncanakan/tidak diinginkan dalam 6 bulan terakhir? - Ya, ada penurunan BB sebanyak 6-10 Kg')->pluck('nilai')->first() == '2' ? 'checked' : '' }}
                                                        data-score="2" />

                                                    <label class="form-check-label" for="defaultCheck3">
                                                        2
                                                    </label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="mx-4">11-15 Kg</span>
                                                </td>
                                                <td class="fw-bold text-center">
                                                    <input class="form-check-input" type="radio" name="dewasa-satu"
                                                        value="11-15 Kg" id="defaultCheck3"
                                                        {{ $dewasaDua->where('name', 'Apakah mengalami penurunan berat badan yang tidak direncanakan/tidak diinginkan dalam 6 bulan terakhir? - Ya, ada penurunan BB sebanyak 11-15 Kg')->pluck('nilai')->first() == '3' ? 'checked' : '' }}
                                                        data-score="3" />

                                                    <label class="form-check-label" for="defaultCheck3">
                                                        3
                                                    </label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="mx-4">>15 Kg</span>
                                                </td>
                                                <td class="fw-bold text-center">
                                                    <input class="form-check-input" type="radio" name="dewasa-satu"
                                                        value=">15 Kg" id="defaultCheck3"
                                                        {{ $dewasaDua->where('name', 'Apakah mengalami penurunan berat badan yang tidak direncanakan/tidak diinginkan dalam 6 bulan terakhir? - Ya, ada penurunan BB sebanyak >15 Kg')->pluck('nilai')->first() == '4' ? 'checked' : '' }}
                                                        data-score="4" />

                                                    <label class="form-check-label" for="defaultCheck3">
                                                        4
                                                    </label>
                                                </td>
                                            <tr>
                                                <td>
                                                    <span class="mx-4">Tidak tahu berapa kg penurunan</span>
                                                </td>
                                                <td class="fw-bold text-center">
                                                    <input class="form-check-input" type="radio" name="dewasa-satu"
                                                        value="Tidak tahu berapa kg penurunan" id="defaultCheck3"
                                                        {{ $dewasaDua->where('name', 'Apakah mengalami penurunan berat badan yang tidak direncanakan/tidak diinginkan dalam 6 bulan terakhir? - Ya, ada penurunan BB sebanyak Tidak tahu berapa kg penurunan')->pluck('nilai')->first() == '2' ? 'checked' : '' }}
                                                        data-score="2" />

                                                    <label class="form-check-label" for="defaultCheck3">
                                                        2
                                                    </label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Apakah asupan makanan pasien berkurang karena penurunan nafsu
                                                    makan/kesulitan menerima makanan
                                                    <ul>
                                                        <li>Tidak</li>
                                                        <li>Ya</li>
                                                    </ul>
                                                </td>
                                                <td class="fw-bold text-center">
                                                    <input class="form-check-input" type="radio" name="dewasa-dua"
                                                        value="0" id="defaultCheck3"
                                                        {{ $dewasaDua->where('name', 'Apakah terdapat penurunan BB selama 1 bulan terakhir? Berdasarkan penilaian objectif ? Tidak')->pluck('nilai')->first() == '0' ? 'checked' : '' }}
                                                        data-score="0" />
                                                    <label class="form-check-label" for="defaultCheck3">
                                                        0
                                                    </label>
                                                    <br>
                                                    <input class="form-check-input" type="radio" name="dewasa-dua"
                                                        value="1" id="defaultCheck4"
                                                        {{ $dewasaDua->where('name', 'Apakah terdapat penurunan BB selama 1 bulan terakhir? Berdasarkan penilaian objectif ? Ya')->pluck('nilai')->first() == '1' ? 'checked' : '' }}
                                                        data-score="1" />
                                                    <label class="form-check-label" for="defaultCheck4">
                                                        1
                                                    </label>
                                                </td>

                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="2">Total Skor</td>
                                                <td class="fw-bold text-center" id="total-score">0</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </td>
                            @endif
                        </tr>
                        <tr>
                            @if ($usia < 18)
                                <td class="text-center">Bila skor : 4-5 dilakukan pengkajian lebih lanjut oleh dietisen
                                </td>
                            @else
                                <td class="text-center">Bila skor MST ≥2 dilakukan pengkajian lebih lanjut oleh dietisen
                                </td>
                            @endif
                        </tr>
                    </tbody>
                </table>
                <button class="btn btn-primary btn-sm" type="submit">Submit</button>
            </form>
        </div>

    </div>


    <script>
        // Ambil semua input nilai
        var nilaiInputs = document.querySelectorAll('select[name="kriteria[]"]');

        // Inisialisasi total awal
        var total = 0;

        // Loop melalui setiap input nilai dan tambahkan nilainya ke total
        nilaiInputs.forEach(function(input) {
            total += parseInt(input.value); // Menggunakan parseInt untuk memastikan nilai input adalah angka
        });

        // Setel nilai total ke input total
        document.getElementById('total').value = total;
        var mandiri = document.getElementById('mandiri');
        var kRingan = document.getElementById('ketergantungan-ringan');
        var kSedang = document.getElementById('ketergantungan-sedang');
        var kBerat = document.getElementById('ketergantungan-berat');
        var kTotal = document.getElementById('ketergantungan-total');

        mandiri.classList.remove('bg-success');
        kRingan.classList.remove('bg-success');
        kSedang.classList.remove('bg-warning');
        kBerat.classList.remove('bg-danger');
        kTotal.classList.remove('bg-danger');

        if (total >= 0 && total <= 20) {
            kTotal.className = 'bg-danger';
        } else if (total > 20 && total <= 61) {
            kBerat.className = 'bg-danger';
        } else if (total > 61 && total <= 90) {
            kSedang.className = 'bg-warning';
        } else if (total > 90 && total <= 99) {
            kRingan.className = 'bg-success';
        } else if (total == 100) {
            mandiri.className = 'bg-success';
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const radioButtons = document.querySelectorAll('.form-check-input');
            const totalScoreElement = document.getElementById('total-score');

            function calculateTotalScore() {
                let totalScore = 0;
                radioButtons.forEach(radio => {
                    if (radio.checked) {
                        const score = parseInt(radio.getAttribute('data-score'));
                        if (!isNaN(score)) {
                            totalScore += score;
                        } else {
                            console.error(`Invalid score value: ${radio.getAttribute('data-score')}`);
                        }
                    }
                });
                totalScoreElement.textContent = totalScore;
            }

            radioButtons.forEach(radio => {
                radio.addEventListener('change', calculateTotalScore);
            });

            // Initial calculation on page load
            calculateTotalScore();
        });
    </script>
@endsection
