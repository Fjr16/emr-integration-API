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
            <h5 class="mb-0 m-0">Asesmen Awal Keperawatan <span class="fs-4 fw-bold text-primary">{{ $item->queue->patient->name ?? '' }}</span></h5>
        </div>
        <div class="col-3 m-0 text-end">
          @php
            session()->flash('active', 'asesmenperawat');
          @endphp
          <a href="{{ route('igd/patient/rme.show', $currentIgdPatientId ?? $item->id) }}" class="btn btn-success btn-sm">Kembali</a>
        </div>
        </div>
        <div class="row m-auto mt-2">
          <a href="{{ route('igd/asesmen/status/fisik.index', $item->id) }}" class="btn {{ Route::is('igd/asesmen/status/fisik.index*') ? 'btn-primary' : '' }} border btn-sm col-3">Status Fisik</a>
          <a href="{{ route('igd/asesmen/skrining/resiko/jatuh.index', $item->id) }}" class="btn {{ Route::is('igd/asesmen/skrining/resiko/jatuh.index*') ? 'btn-primary' : '' }} border btn-sm col-3">Skrining Resiko Jatuh</a>
          <a href="{{ route('igd/asesmen/diagnosis/keperawatan.index', $item->id) }}" class="btn {{ Route::is('igd/asesmen/diagnosis/keperawatan.index*') ? 'btn-primary' : '' }} border btn-sm col-3">Diagnosis Keperawatan</a>
          <a href="{{ route('igd/asesmen/rencana/asuhan.index', $item->id) }}" class="btn {{ Route::is('igd/asesmen/rencana/asuhan.index*') ? 'btn-primary' : '' }} border btn-sm col-3">Rencana Asuhan</a>
        </div>
    </div>

    <div class="card-body">
        <h6 class="text-center bg-dark text-white py-2">SKRINING RESIKO JATUH RAWAT JALAN (GET UP AND GO TEST)</h6>
        <form action="{{ route('igd/asesmen/skrining/resiko/jatuh.store', $item->id) }}" method="POST">
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
                <td colspan="2">a. Perhatikan cara berjalan pasien saat akan duduk dikursi. Apakah pasien tampak tidak seimbang (sempoyongan / linglung) ?</td>
                <td class="text-center">
                  <input class="form-check-input" name="a" id="radioAya" type="radio" value="ya" id="defaultCheck1" />
                </td>
                <td class="text-center">
                  <input class="form-check-input" name="a" id="radioAtidak" type="radio" checked value="tidak" id="defaultCheck1" />
                </td>
              </tr>
              <tr>
                <td colspan="2">b. Apakah pasien memegang pinggiran kursi atau meja atau benda lain sebagai penopang saat akan duduk?</td>
                <td class="text-center">
                  <input class="form-check-input" name="b" id="radioBya" type="radio" value="ya" id="defaultCheck1" />
                </td>
                <td class="text-center">
                  <input class="form-check-input" name="b" id="radioBtidak" type="radio" checked value="tidak" id="defaultCheck1" />
                </td>
              </tr>
              <tr>
                <td style="width: 500px">
                  <p class="m-0">Kategori :</p>
                  <div class="mx-3">
                    @foreach ($komponenPenilaian1 as $komponen1)
                    <div class="form-check">
                      <input class="form-check-input" {{ $loop->iteration == 1 ? 'checked' : '' }} name="kategori-skrining-rajal[]" value="{{ $komponen1 ?? '' }}" id="komponen1{{ $loop->iteration }}" type="checkbox"/>
                      <label class="form-check-label" for="komponen1{{ $loop->iteration }}">
                        {{ $komponen1 }}
                      </label>
                    </div>
                    @endforeach
                  </div>
                </td>
                <td colspan="3">
                  @foreach ($komponenPenilaian2 as $komponen2)
                  <div class="form-check">
                    <input class="form-check-input" {{ $loop->iteration == 1 ? 'checked' : '' }} name="kategori-skrining-rajal[]" id="komponen2{{ $loop->iteration }}" type="checkbox" value="{{ $komponen2 ?? '' }}" id="defaultCheck1" />
                    <label class="form-check-label" for="defaultCheck1">
                      {{ $komponen2 }}
                    </label>
                  </div>
                  @endforeach
                </td>
              </tr>
            </tbody>
          </table>
          {{-- <p class="m-0">Skrining Risiko Jatuh</p>
            <div class="mx-3 row">
                @foreach ($komponenPenilaian1 as $komponen1)
                    <div class="form-check col-md-6">
                        <input class="form-check-input" {{ $loop->iteration == 1 ? 'checked' : '' }} name="usia" id="komponen1{{ $loop->iteration }}" type="radio" value="{{$komponen1}}" />
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
                <span class="mx-2"><input type="text" name="skor" class="form-control form-control-sm" id="skor" placeholder="" aria-describedby="floatingInputHelp" /></span>
                </p>
              </li>
              <li class="mt-1">
                <div class="row">
                  <div class="col-sm-auto">
                    Pasien termasuk kategori risiko jatuh :
                  </div>
                  <div class="col-sm-1">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" name="kategori" type="radio" id="Rendah" value="Rendah" checked />
                      <label class="form-check-label" for="Rendah">Rendah</label>
                    </div>
                  </div>
                  <div class="col-sm-1">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" name="kategori" type="radio" id="Sedang" value="Sedang" />
                      <label class="form-check-label" for="Sedang">Sedang</label>
                    </div>
                  </div>
                  <div class="col-sm-1">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" name="kategori" type="radio" id="Tinggi" value="Tinggi" />
                      <label class="form-check-label" for="Tinggi">Tinggi</label>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" name="kategori" type="radio" id="Pasang Kancing Kuning (jika risiko tinggi)" value="Pasang Kancing Kuning (jika risiko tinggi)" />
                      <label class="form-check-label" for="Pasang Kancing Kuning (jika risiko tinggi)">Pasang Kancing Kuning (jika risiko tinggi)</label>
                    </div>
                  </div>
                </div>
              </li>
            </ol>
          </div> --}}

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
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $fungsional }}</td>
                    <td>{{ $bantuan }}</td>
                    <td>{{ $mandiri }}</td>
                    <td>
                        <select name="kriteria[]" id="" class="form-control">
                            @foreach ($values as $vl)
                            <option value="{{ $vl }}">{{ $vl  ? 'selected' : '' }}>{{ $vl }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
              @endforeach
                <td></td>
                <td colspan="4">Total</td>
                <td><input type="number" name="total" class="form-control form-control-md" value="0" id="" readonly /></td>
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
                      <tr>
                        <td>1</td>
                        <td>Apakah pasien tampak kurus?</td>
                        <td>
                          <div class="form-check">
                            <input class="form-check-input" name="anak-satu" type="radio" value="1" id="defaultCheck1" />
                            <label class="form-check-label" for="defaultCheck1">
                              Ya
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" name="anak-satu" type="radio" checked value="0" id="defaultCheck2" />
                            <label class="form-check-label" for="defaultCheck2">
                              Tidak
                            </label>
                          </div>
                        </td>
                        <td class="fw-bold text-center">1 <br> 0</td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>Apakah terdapat penurunan BB selama 1 bulan terakhir? Berdasarkan penilaian objectif</td>
                        <td>
                          <div class="form-check">
                            <input class="form-check-input" name="anak-dua" type="radio" value="1" id="defaultCheck1" />
                            <label class="form-check-label" for="defaultCheck1">
                              Ya
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" name="anak-dua" type="radio" checked value="0" id="defaultCheck2" />
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
                            <li>Diare ≥ 5 kali/hari dan atau muntah > 3 kali/hari dalam seminggu terakhir</li>
                            <li>Asupan makanan kurang selama 1 minggu terakhir</li>
                          </ul>
                        </td>
                        <td>
                          <div class="form-check">
                            <input class="form-check-input" name="anak-tiga" type="radio" value="1" id="defaultCheck1" />
                            <label class="form-check-label" for="defaultCheck1">
                              Ya
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" name="anak-tiga" type="radio" checked value="0" id="defaultCheck2" />
                            <label class="form-check-label" for="defaultCheck2">
                              Tidak
                            </label>
                          </div>
                        </td>
                        <td class="fw-bold text-center">1 <br> 0</td>
                      </tr>
                      <tr>
                        <td>4</td>
                        <td>Apakah terdapat penyakit atau keadaan yang mangakibatkan pasien beresiko malnutrisi dan sudah malnutrisi (Gizi buruk)?</td>
                        <td>
                          <div class="form-check">
                            <input class="form-check-input" name="anak-empat" type="radio" value="2" id="defaultCheck1" />
                            <label class="form-check-label" for="defaultCheck1">
                              Ya
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" name="anak-empat" type="radio" checked value="0" id="defaultCheck2" />
                            <label class="form-check-label" for="defaultCheck2">
                              Tidak
                            </label>
                          </div>
                        </td>
                        <td class="fw-bold text-center">2 <br> 0</td>
                      </tr>
                      <tr>
                        <td></td>
                        <td colspan="2" class="fw-bold text-center">Total Skor</td>
                        <td>
                          <input type="number" name="total_skor_anak" class="form-control form-control-md text-center" value="0" readonly />
                        </td>
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
                      <tr>
                        <td><li>Tidak</li></td>
                        <td class="fw-bold text-center">
                          <input class="form-check-input" type="radio" name="dewasa-satu" checked value="Tidak" id="defaultCheck3" />
                          <label class="form-check-label" for="defaultCheck3">
                            0
                          </label>
                        </td>
                      </tr>
                      <tr>
                        <td><li>Tidak yakin (tanda-tanda : baju menjadi longgar)</li></td>
                        <td class="fw-bold text-center">
                          <input class="form-check-input" type="radio" name="dewasa-satu" value="Tidak yakin (tanda-tanda : baju menjadi longgar)" id="defaultCheck3" />
                          <label class="form-check-label" for="defaultCheck3">
                            2
                          </label>
                        </td>
                      </tr>
                      <tr>
                        <td><li>Ya, ada penurunan BB sebanyak :</li></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td>
                          <span class="mx-4">1-5 Kg</span>
                        </td>
                        <td class="fw-bold text-center">
                          <input class="form-check-input" type="radio" name="dewasa-satu" value="1-5 Kg" id="defaultCheck3" />
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
                          <input class="form-check-input" type="radio" name="dewasa-satu" value="6-10 Kg" id="defaultCheck3" />
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
                          <input class="form-check-input" type="radio" name="dewasa-satu" value="11-15 Kg" id="defaultCheck3" />
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
                          <input class="form-check-input" type="radio" name="dewasa-satu" value=">15 Kg" id="defaultCheck3" />
                          <label class="form-check-label" for="defaultCheck3">
                            4
                          </label>
                        </td>
                      <tr>
                        <td>
                          <span class="mx-4">Tidak tahu berapa kg penurunan</span>
                        </td>
                        <td class="fw-bold text-center">
                          <input class="form-check-input" type="radio" name="dewasa-satu" value="Tidak tahu berapa kg penurunan" id="defaultCheck3" />
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
                        <td class="fw-bold text-center">
                          <input class="form-check-input" type="radio" name="dewasa-dua" checked checked value="0" id="defaultCheck3" />
                          <label class="form-check-label" for="defaultCheck3">
                            0
                          </label>
                          <br>
                          <input class="form-check-input" type="radio" name="dewasa-dua" value="1" id="defaultCheck3" />
                          <label class="form-check-label" for="defaultCheck3">
                            1
                          </label>
                        </td>
                      </tr>
                      <tr>
                        <td></td>
                        <td class="fw-bold text-center">Total Skor</td>
                        <td>
                          <input type="number" name="total_skor_dewasa" class="form-control form-control-md text-center" value="0" readonly />
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </td>
                @endif
              </tr>
              <tr>
                <td class="text-justify dewasa">Bila skor 4-5 dilakukan  pengkajian lebih lanjut oleh dietisien</td>
                <td class="text-justify anak">Bila skor MST ≥2 dilakukan pengkajian lebih lanjut oleh dietisien</td>
              </tr>
            </tbody>
          </table>

          <div class="mb-3 text-end">
              <button type="submit" class="btn btn-success btn-sm">Simpan</button>
          </div>
        </form>
    </div>

</div>
@endsection
