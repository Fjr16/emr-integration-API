@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif
  <div class="card mb-4">
    <div class="card-header m-0">
        <div class="row">
        <div class="col-9">
            <h5 class="mb-0 m-0">Asesmen Perawat <span class="fs-4 fw-bold text-primary">{{ $item->patient->name ?? '' }}</span></h5>
        </div>
        <div class="col-3 m-0 text-end">
          <a href="{{ route('ranap/assesmen/awal/keperawatan.detail', $item->patient_id) }}" class="btn btn-success btn-sm">Kembali</a>
        </div>
        </div>
        <div class="row m-auto mt-2">
          <a href="{{ route('ranap/assesmen/awal/keperawatan.edit', $item->id) }}" class="btn {{ Route::is('ranap/assesmen/awal/keperawatan.edit*') ? 'btn-primary' : '' }} border btn-sm col-3">Status Fisik</a>
          <a href="{{ route('ranap/asesmen/skrining/resiko/jatuh.edit', $item->id) }}" class="btn {{ Route::is('ranap/asesmen/skrining/resiko/jatuh.edit*') ? 'btn-primary' : '' }} border btn-sm col-3">Skrining Resiko Jatuh</a>
          <a href="{{ route('ranap/asesmen/diagnosis/keperawatan.edit', $item->id) }}" class="btn {{ Route::is('ranap/asesmen/diagnosis/keperawatan.edit*') ? 'btn-primary' : '' }} border btn-sm col-3">Diagnosis Keperawatan</a>
          <a href="{{ route('ranap/asesmen/rencana/asuhan.edit', $item->id) }}" class="btn {{ Route::is('ranap/asesmen/rencana/asuhan.edit*') ? 'btn-primary' : '' }} border btn-sm col-3">Rencana Asuhan</a>
        </div>
    </div>

    <div class="card-body">
        <h6 class="text-center bg-dark text-white py-2">SKRINING DAN ASESMEN RESIKO JATUH</h6>
        <form action="{{ route('ranap/asesmen/skrining/resiko/jatuh.store', $item->queue_id) }}" method="POST">
          @csrf
          <p class="m-0">Skrining Risiko Jatuh</p>
            <div class="mx-3 row">
                @foreach ($komponenPenilaian1 as $komponen1)
                    <div class="form-check col-md-6">
                        <input class="form-check-input" {{ $skrining->usia ?? '' == $komponen1 ? 'checked' : '' }} name="usia" id="komponen1{{ $loop->iteration }}" type="radio" value="{{$komponen1}}" />
                        <label class="form-check-label" for="komponen1{{ $loop->iteration }}">
                            {{ $komponen1 }}
                        </label>
                    </div>
                @endforeach
            </div>
            <p class="m-0 mt-2">Asesmen Risiko Jatuh Gunakan Sesuai Dengan Usia Pasien</p>
            <div class="mx-3">
            <ol>
              <li class="mt-1">
                <p class="m-0 d-flex">Total skor
                <span class="mx-2"><input type="text" name="skor" value="{{$skrining->skor ?? ''}}" class="form-control form-control-sm" id="skor" placeholder="" aria-describedby="floatingInputHelp" /></span>
                </p>
              </li>
              <li class="mt-1">
                <div class="row">
                  <div class="col-sm-auto">
                    Pasien termasuk kategori risiko jatuh :
                  </div>
                  <div class="col-sm-1">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" name="kategori" type="radio" id="inlineCheckbox1" value="Rendah" {{$skrining->kategori ?? '' == 'Rendah' ? 'checked' : ''}} />
                      <label class="form-check-label" for="inlineCheckbox1">Rendah</label>
                    </div>
                  </div>
                  <div class="col-sm-1">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" name="kategori" type="radio" id="inlineCheckbox2" value="Sedang" {{$skrining->kategori ?? '' == 'Sedang' ? 'checked' : ''}} />
                      <label class="form-check-label" for="inlineCheckbox2">Sedang</label>
                    </div>
                  </div>
                  <div class="col-sm-1">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" name="kategori" type="radio" id="inlineCheckbox2" value="Tinggi" {{$skrining->kategori ?? '' == 'Tinggi' ? 'checked' : ''}} />
                      <label class="form-check-label" for="inlineCheckbox2">Tinggi</label>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" name="kategori" type="radio" id="inlineCheckbox2" value="Pasang Kancing Kuning (jika risiko tinggi)" {{$skrining->kategori ?? '' == 'Pasang Kancing Kuning (jika risiko tinggi)' ? 'checked' : ''}} />
                      <label class="form-check-label" for="inlineCheckbox2">Pasang Kancing Kuning (jika risiko tinggi)</label>
                    </div>
                  </div>
                </div>
              </li>
            </ol>
          </div>

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
                    $values = [0,5,10];
                    }else if($loop->iteration > 3 && $loop->iteration < 6){
                    $bantuan = '0';
                    $mandiri = '5';
                    $values = [0,5];
                    } else{
                    $bantuan = '5-10';
                    $mandiri = '15';
                    $values = [0,5,10,15];
                    }
                $detail = $detailStatusFungsional->where('name', $fungsional)->first();
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $fungsional }}</td>
                    <td>{{ $bantuan }}</td>
                    <td>{{ $mandiri }}</td>
                    <td>
                    {{-- <input type="number" name="kriteria[]" value="0" class="form-control form-control-sm" id="" placeholder="" /> --}}
                    <select name="kriteria[]" id="" class="form-control">
                        @foreach ($values as $vl)
                        <option value="{{ $vl }}" {{$vl == $detail->nilai ? 'selected' : ''}}>{{ $vl }}</option>
                        @endforeach
                        {{-- <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option> --}}
                    </select>
                    </td>
                </tr>
              @endforeach
                <td colspan="5">Total</td>
                <td><input type="number" name="total" class="form-control form-control-sm" id="" placeholder="" /></td>
              </tr>
            </tbody>
          </table>

          <h6 class="text-center bg-dark text-white py-2">SKRINING RISIKO NUTRISIONAL</h6>
          <input id="usia" type="hidden" value="{{ $usia }}">
          <table class="table table-bordered mb-3" >
            <thead class="text-center">
              <tr>
                @if ($usia < 18)
                    <td>Skrining Gizi Pada Anak <br> Berdasarkan Metode Strong Kids (usia < 18)</td>
                @else
                    <td>Skrining Gizi Pada Dewasa <br> Berdasarkan Metode MST (usia > 18)</td>
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
                        @php
                            $detail = $detailRisikoNutrisional->where('category', 'anak')->where('name', 'Apakah pasien tampak kurus?')->first();
                            if ($detail != null) {
                                $checked = $detail->nilai;
                            } else {
                                $checked = null;
                            }
                        @endphp
                      <tr>
                        <td>1</td>
                        <td>Apakah pasien tampak kurus?</td>
                        <td>
                          <div class="form-check">
                            <input class="form-check-input" name="anak-satu" type="radio" {{$checked == 1 ? 'checked' : ''}} value="1" id="defaultCheck1" />
                            <label class="form-check-label" for="defaultCheck1">
                              Ya
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" name="anak-satu" type="radio" {{$checked == 0 ? 'checked' : ''}} value="0" id="defaultCheck2" />
                            <label class="form-check-label" for="defaultCheck2">
                              Tidak
                            </label>
                          </div>
                        </td>
                        <td class="fw-bold text-center">1 <br> 0</td>
                      </tr>
                      @php
                            $detail = $detailRisikoNutrisional->where('category', 'anak')->where('name', 'Apakah terdapat penurunan BB selama 1 bulan terakhir? Berdasarkan penilaian objectif')->first();
                            if ($detail != null) {
                                $checked = $detail->nilai;
                            } else {
                                $checked = null;
                            }
                        @endphp
                      <tr>
                        <td>2</td>
                        <td>Apakah terdapat penurunan BB selama 1 bulan terakhir? Berdasarkan penilaian objectif</td>
                        <td>
                          <div class="form-check">
                            <input class="form-check-input" name="anak-dua" type="radio" {{$checked == 1 ? 'checked' : ''}} value="1" id="defaultCheck1" />
                            <label class="form-check-label" for="defaultCheck1">
                              Ya
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" name="anak-dua" type="radio" {{$checked == 0 ? 'checked' : ''}} value="0" id="defaultCheck2" />
                            <label class="form-check-label" for="defaultCheck2">
                              Tidak
                            </label>
                          </div>
                        </td>
                        <td class="fw-bold text-center">1 <br> 0</td>
                      </tr>
                      @php
                            $detail = $detailRisikoNutrisional->where('category', 'anak')->where('name', 'Apakah terdapat salah satu kondisi berikut? - Diare ≥ 5 kali/hari dan atau muntah > 3 kali/hari dalam seminggu terakhir - Asupan makanan kurang selama 1 minggu terakhir')->first();
                            if ($detail != null) {
                                $checked = $detail->nilai;
                            } else {
                                $checked = null;
                            }
                        @endphp
                      <tr>
                        <td>3</td>
                        <td>
                          Apakah terdapat salah satu kondisi berikut?
                          <ul>
                            <li>Diare ≥ 5 kali/hari dan atau muntah > 3 kali/hari dalam seminggu terakhir</li>
                            <li>Asupan makanan kurang selama 1 minggu terakhir</li>
                          </ul>
                        </td>
                        <td>
                          <div class="form-check">
                            <input class="form-check-input" name="anak-tiga" type="radio" {{$checked == 1 ? 'checked' : ''}} value="1" id="defaultCheck1" />
                            <label class="form-check-label" for="defaultCheck1">
                              Ya
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" name="anak-tiga" type="radio" {{$checked == 0 ? 'checked' : ''}} value="0" id="defaultCheck2" />
                            <label class="form-check-label" for="defaultCheck2">
                              Tidak
                            </label>
                          </div>
                        </td>
                        <td class="fw-bold text-center">1 <br> 0</td>
                      </tr>
                      @php
                            $detail = $detailRisikoNutrisional->where('category', 'anak')->where('name', 'Apakah terdapat penyakit atau keadaan yang mangakibatkan pasien beresiko malnutrisi dan sudah malnutrisi (Gizi buruk)?')->first();
                            if ($detail != null) {
                                $checked = $detail->nilai;
                            } else {
                                $checked = null;
                            }
                        @endphp
                      <tr>
                        <td>4</td>
                        <td>Apakah terdapat penyakit atau keadaan yang mangakibatkan pasien beresiko malnutrisi dan sudah malnutrisi (Gizi buruk)?</td>
                        <td>
                          <div class="form-check">
                            <input class="form-check-input" name="anak-empat" type="radio" {{$checked == 2 ? 'checked' : ''}} value="2" id="defaultCheck1" />
                            <label class="form-check-label" for="defaultCheck1">
                              Ya
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" name="anak-empat" type="radio" {{$checked == 0 ? 'checked' : ''}} value="0" id="defaultCheck2" />
                            <label class="form-check-label" for="defaultCheck2">
                              Tidak
                            </label>
                          </div>
                        </td>
                        <td class="fw-bold text-center">2 <br> 0</td>
                      </tr>
                    </tbody>
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
                        <td>Apakah mengalami penurunan berat badan yang tidak direncanakan/tidak diinginkan dalam 6 bulan terakhir?</td>
                        <td></td>
                      </tr>
                        @php
                        if ($detailRisikoNutrisional) {
                          $detail = $detailRisikoNutrisional->where('category', 'dewasa')->where('name', 'Apakah mengalami penurunan berat badan yang tidak direncanakan/tidak diinginkan dalam 6 bulan terakhir? - Tidak')->first();
                          if ($detail != null) {
                              $checked = 'checked';
                          } else {
                              $checked = null;
                          }
                        }
                        @endphp
                      <tr>
                        <td><li>Tidak</li></td>
                        <td class="fw-bold text-center">
                          <input class="form-check-input" type="radio" name="dewasa-satu" {{$checked ?? ''}} value="Tidak" id="defaultCheck3" />
                          <label class="form-check-label" for="defaultCheck3">
                            0
                          </label>
                        </td>
                      </tr>
                      @php
                        if ($detailRisikoNutrisional) {
                          $detail = $detailRisikoNutrisional->where('category', 'dewasa')->where('name', 'Apakah mengalami penurunan berat badan yang tidak direncanakan/tidak diinginkan dalam 6 bulan terakhir? - Tidak yakin (tanda-tanda : baju menjadi longgar)')->first();
                          if ($detail != null) {
                              $checked = 'checked';
                          } else {
                              $checked = null;
                          }
                        }
                      @endphp
                      <tr>
                        <td><li>Tidak yakin (tanda-tanda : baju menjadi longgar)</li></td>
                        <td class="fw-bold text-center">
                          <input class="form-check-input" type="radio" name="dewasa-satu" {{$checked ?? ''}} value="Tidak yakin (tanda-tanda : baju menjadi longgar)" id="defaultCheck3" />
                          <label class="form-check-label" for="defaultCheck3">
                            2
                          </label>
                        </td>
                      </tr>
                      <tr>
                        <td><li>Ya, ada penurunan BB sebanyak :</li></td>
                        <td></td>
                      </tr>
                      @php
                        if ($detailRisikoNutrisional) {
                          $detail = $detailRisikoNutrisional->where('category', 'dewasa')->where('name', 'Apakah mengalami penurunan berat badan yang tidak direncanakan/tidak diinginkan dalam 6 bulan terakhir? - Ya, ada penurunan BB sebanyak 1-5 Kg')->first();
                          if ($detail != null) {
                              $checked = 'checked';
                          } else {
                              $checked = null;
                          }
                        }
                        @endphp
                      <tr>
                        <td>
                          <span class="mx-4">1-5 Kg</span>
                        </td>
                        <td class="fw-bold text-center">
                          <input class="form-check-input" type="radio" name="dewasa-satu" {{$checked ?? ''}} value="1-5 Kg" id="defaultCheck3" />
                          <label class="form-check-label" for="defaultCheck3">
                            1
                          </label>
                        </td>
                      </tr>
                      @php
                        if ($detailRisikoNutrisional) {
                          $detail = $detailRisikoNutrisional->where('category', 'dewasa')->where('name', 'Apakah mengalami penurunan berat badan yang tidak direncanakan/tidak diinginkan dalam 6 bulan terakhir? - Ya, ada penurunan BB sebanyak 6-10 Kg')->first();
                          if ($detail != null) {
                              $checked = 'checked';
                          } else {
                              $checked = null;
                          }
                        }
                        @endphp
                      <tr>
                        <td>
                          <span class="mx-4">6-10 Kg</span>
                        </td>
                        <td class="fw-bold text-center">
                          <input class="form-check-input" type="radio" {{$checked ?? ''}} name="dewasa-satu" value="6-10 Kg" id="defaultCheck3" />
                          <label class="form-check-label" for="defaultCheck3">
                            2
                          </label>
                        </td>
                      </tr>
                      @php
                        if ($detailRisikoNutrisional) {
                          $detail = $detailRisikoNutrisional->where('category', 'dewasa')->where('name', 'Apakah mengalami penurunan berat badan yang tidak direncanakan/tidak diinginkan dalam 6 bulan terakhir? - Ya, ada penurunan BB sebanyak 11-15 Kg')->first();
                          if ($detail != null) {
                              $checked = 'checked';
                          } else {
                              $checked = null;
                          }
                        }
                        @endphp
                      <tr>
                        <td>
                          <span class="mx-4">11-15 Kg</span>
                        </td>
                        <td class="fw-bold text-center">
                          <input class="form-check-input" type="radio" {{$checked ?? ''}} name="dewasa-satu" value="11-15 Kg" id="defaultCheck3" />
                          <label class="form-check-label" for="defaultCheck3">
                            3
                          </label>
                        </td>
                      </tr>
                      @php
                        if ($detailRisikoNutrisional) {
                          $detail = $detailRisikoNutrisional->where('category', 'dewasa')->where('name', 'Apakah mengalami penurunan berat badan yang tidak direncanakan/tidak diinginkan dalam 6 bulan terakhir? - Ya, ada penurunan BB sebanyak >15 Kg')->first();
                          if ($detail != null) {
                              $checked = 'checked';
                          } else {
                              $checked = null;
                          }
                        }
                        @endphp
                      <tr>
                        <td>
                          <span class="mx-4">>15 Kg</span>
                        </td>
                        <td class="fw-bold text-center">
                          <input class="form-check-input" type="radio" {{$checked ?? ''}} name="dewasa-satu" value=">15 Kg" id="defaultCheck3" />
                          <label class="form-check-label" for="defaultCheck3">
                            4
                          </label>
                        </td>
                      </tr>
                      @php
                        if ($detailRisikoNutrisional) {
                          $detail = $detailRisikoNutrisional->where('category', 'dewasa')->where('name', 'Apakah mengalami penurunan berat badan yang tidak direncanakan/tidak diinginkan dalam 6 bulan terakhir? - Ya, ada penurunan BB sebanyak Tidak tahu berapa kg penurunan')->first();
                          if ($detail != null) {
                              $checked = 'checked';
                          } else {
                              $checked = null;
                          }
                        }
                        @endphp
                      <tr>
                        <td>
                          <span class="mx-4">Tidak tahu berapa kg penurunan</span>
                        </td>
                        <td class="fw-bold text-center">
                          <input class="form-check-input" type="radio" {{$checked ?? ''}} name="dewasa-satu" value="Tidak tahu berapa kg penurunan" id="defaultCheck3" />
                          <label class="form-check-label" for="defaultCheck3">
                            2
                          </label>
                        </td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>Apakah asupan makanan pasien berkurang karena penurunan nafsu makan/kesulitan menerima makanan
                          <ul>
                            <li>Tidak</li>
                            <li>Ya</li>
                          </ul>
                        </td>
                        @php
                        if ($detailRisikoNutrisional) {
                          $detail = $detailRisikoNutrisional->where('category', 'dewasa')->where('name', 'Apakah terdapat penurunan BB selama 1 bulan terakhir? Berdasarkan penilaian objectif ? Tidak')->first();
                          if ($detail != null) {
                              $checked = 'checked';
                          } else {
                              $checked = null;
                          }
                        }
                        @endphp
                        <td class="fw-bold text-center">
                          <input class="form-check-input" type="radio" {{$checked ?? '' == 'checked' ? 'checked' : ''}} name="dewasa-dua" value="0" id="defaultCheck3" />
                          <label class="form-check-label" for="defaultCheck3">
                            0
                          </label>
                          <br>
                          <input class="form-check-input" type="radio" {{$checked ?? '' != 'checked' ? 'checked' : ''}} name="dewasa-dua" value="1" id="defaultCheck3" />
                          <label class="form-check-label" for="defaultCheck3">
                            1
                          </label>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </td>
                @endif
              </tr>
              <tr>
                <td>
                    <div class="row">
                        <div class="col-sm-auto">
                            Pasien dengan diagnosa/kondisi khusus
                        </div>
                        <div class="col-sm-1">
                            <div class="form-check form-check-inline">
                            <input class="form-check-input" name="diagnosa" type="radio" id="inlineCheckbox5" value="Tidak" {{$risikoNutrisional->diagnosa ?? '' == 'Tidak' ? 'checked' : ''}} />
                            <label class="form-check-label" for="inlineCheckbox5">Tidak</label>
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <div class="form-check form-check-inline">
                            <input class="form-check-input" name="diagnosa" type="radio" id="inlineCheckbox6" value="Ya" {{$risikoNutrisional->diagnosa ?? '' == 'Ya' ? 'checked' : ''}} />
                            <label class="form-check-label" for="inlineCheckbox6">Ya</label>
                            </div>
                        </div>
                    </div>
                    <p class="pt-2">Kondisi khusus : DM/ CKD/ CVD/ Hipertensi/ Hemodialisa/ Radioterapi/ Geriatri/ Penurunan Imunitas/ Tuberkulosis/ Penyakit Hati Kronis/ Penyakit Jantung Bawaan/ Kanker/ Diare Persisten/ Penyakit Jantung Kronis/ Hyperuricemia</p>
                </td>
              </tr>
              <tr>
                <td class="text-justify anak">Bila skor 4-5 dan atau pasien dengan diagnosa/kondisi khusus rujuk ke ahli gizi untuk dilakukan skrining lanjutan dan pengkajian gizi lebih lanjut dengan PAGT (Proses Asuhan Gizi Terstandar - ADIME)</td>
                <td class="text-justify dewasa">Bila skor MST ≥2 dan atau pasien dengan diagnosa/kondisi khusus rujuk ke ahli gizi untuk dilakukan skrining lanjutan dan pengkajian gizi lebih lanjut dengan PAGT (Proses Asuhan Gizi Terstandar - ADIME)</td>
              </tr>
            </tbody>
          </table>

            <p class="m-0 mt-2">Sudah dibaca dan diketahui oleh dietiisien (diisi oleh dietisien)</p>
            @php
              $checked = '';
              $date = null;
              $time = null;
            if ($skrining) {
              $detail = $skrining->where('status', 'Ya')->first();
              if ($detail != null) {
                  $checked = $detail->status;
                  $format = Carbon\Carbon::parse($detail->tanggal);
                  $date = $format->format('Y-m-d');
                  $time = $format->format('H:i');
              } else {
                  $checked = '';
                  $date = null;
                  $time = null;
              }
            }
            @endphp
            <div class="mb-2">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" name="status" type="radio" id="inlineCheckbox7" value="Ya" onclick="enableTanggal()" {{$checked ?? '' == 'Ya' ? 'checked' : ''}} />
                    <label class="form-check-label" for="inlineCheckbox7">Ya, tanggal <input type="date" name="date" {{$checked ?? '' == 'Ya' ? 'enable' : 'disabled'}} value="{{$date ?? ''}}" id="date" class="form-control form-control-sm"> dan jam <input type="time" name="time" {{$checked == 'Ya' ? 'enable' : 'disabled'}} value="{{$time}}" id="time" class="form-control form-control-sm"></label>

                </div>
                <br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" name="status" type="radio" id="inlineCheckbox8" value="Tidak" onclick="disableTanggal()" {{$checked ?? '' == '' ? 'checked' : ''}} />
                    <label class="form-check-label" for="inlineCheckbox8">Tidak</label>
                </div>
            </div>
                <div class="row mb-5">
                    <div class="col-4"></div>
                    <div class="col-4"></div>
                    <div class="col-4 text-center">Dietisien</div>
                </div>
                <div class="row mb-5">
                    <div class="col-4 text-center">

                    </div>
                    <div class="col-4 text-center">

                    </div>
                    <div class="col-4 text-center">
                        <img src="{{Storage::url($skrining->ttd ?? '')}}" alt="" id="ImgTtdDietisien">
                        <textarea id="ttdDietisien" name="ttdDietisien" style="display: none;"></textarea>
                        <button type="button" class="col-12 btn btn-sm btn-dark"
                            onclick="openModalTtdBottom(this, 'ImgTtdDietisien', 'ttdDietisien')">Tanda
                            Tangan</button>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-4 text-center"></div>
                    <div class="col-4 text-center"></div>
                    <div class="col-4 text-center">
                        <input type="text" class="form-control form-control-sm" value="{{$skrining->name ?? ''}}" name="dietisien"
                            placeholder="Nama Lengkap">
                    </div>
                </div>
                <div class="mb-3 text-end">
                    <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                </div>
        </form>
    </div>

</div>
{{-- modal create ttd --}}
    <div class="modal fade" id="signaturePadModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalScrollableTitle">Signature Pad</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div id="signature-pad" class="m-signature-pad">
                        <div class="m-signature-pad--body">
                            <canvas style="border: 3px dashed #ccc"></canvas>
                        </div>

                        <div class="m-signature-pad--footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-action="clear">Clear</button>
                            <button type="button" class="btn btn-sm btn-primary" data-action="save">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function disableTanggal(){
            var inputDate = document.getElementById("date");
            var inputTime = document.getElementById("time");

            inputDate.disabled = true;
            inputTime.disabled = true;
            inputDate.value = '';
            inputTime.value = '';
        }

        function enableTanggal(){
            var inputDate = document.getElementById("date");
            var inputTime = document.getElementById("time");

            inputDate.disabled = false;
            inputTime.disabled = false;
        }

        let tempElementImage;
        let tempTextArea;

        function openModal(element, iteration) {
            tempElementImage = $(element).closest('#row-ttd-pasien').find('#ttdImage' + iteration);
            tempTextArea = $(element).closest('#row-ttd-pasien').find('#ttd' + iteration);
            $('#signaturePadModal').modal('show');
        }

        function openModalTtdBottom(element, elementImg, elementTextArea) {
            console.log(element.closest('td'));
            tempElementImage = $(element).closest('.row').find('#' + elementImg);
            tempTextArea = $(element).closest('.row').find('#' + elementTextArea);
            $('#signaturePadModal').modal('show');
        }

        document.addEventListener("DOMContentLoaded", function() {
            var wrapper = document.getElementById("signaturePadModal");
            var clearButton = wrapper.querySelector("[data-action=clear]");
            var saveButton = wrapper.querySelector("[data-action=save]");
            var canvas = wrapper.querySelector("canvas");
            var signaturePad;

            // Fungsi untuk mengatur ukuran canvas
            // function resizeCanvas() {
            //     var ratio = window.devicePixelRatio || 1;
            //     canvas.width = canvas.offsetWidth * ratio;
            //     canvas.height = canvas.offsetHeight * ratio;
            //     canvas.getContext("2d").scale(ratio, ratio);

            //     // Reinitialize SignaturePad setelah meresize canvas
            //     signaturePad = new SignaturePad(canvas);
            // }

            // resizeCanvas();

            // Initialize SignaturePad
            // agar library signature pad dapat digunakan pada modal
            signaturePad = new SignaturePad(canvas);

            // Event handler untuk tombol clear
            clearButton.addEventListener("click", function(e) {
                e.preventDefault();
                signaturePad.clear();
            });

            // Event handler untuk tombol save
            // var ttd = document.getElementById('ttd1');
            saveButton.addEventListener("click", function(e) {
                e.preventDefault();
                var signatureData = signaturePad.toDataURL();
                tempElementImage.attr('src', signatureData);
                tempTextArea.val(signatureData);
                // document.getElementById("signature64").value = signatureData;
                signaturePad.clear();

                //close modal
                $('#signaturePadModal').modal('hide');
            });


            // Event listener untuk meresize canvas saat window diubah ukurannya
            // window.addEventListener("resize", resizeCanvas);
        });
    </script>

@endsection
