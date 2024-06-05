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
      <h6 class="text-center bg-dark text-white py-2">STATUS FISIK</h6>
      <form action="{{ route('ranap/asesmen/status/fisik.store', $item->queue_id) }}" method="POST">
      @csrf
      <div class="row mb-3">
        <div class="col-sm-4 ">
          <p class="fw-bold m-0">Kondisi Umum :</p>
          <div class="mb-3 mx-3">
            @foreach ($kondisiUmum as $umum)
            @php
                $detail = $umm->where('name', $umum)->first();
                if ($detail != null) {
                    $checked = $detail->name;
                }else{
                    $checked = null;
                }
            @endphp
            <div class="form-check">
                <input class="form-check-input disabled" type="checkbox" name="kondisi-umum[]" value="{{$umum}}" id="defaultCheck1" {{$umum == $checked ? 'checked' : ''}} />
                <label class="form-check-label" for="defaultCheck1">
                    {{ $umum }}
                </label>
            </div>
            @endforeach
          </div>
        </div>
        <div class="col-sm-4 ">
          <p class="fw-bold m-0">Kesadaran :</p>
          <div class="mb-3 mx-3">
            @foreach ($kesadaran as $sadar)
            @php
                $detail = $sdr->where('name', $sadar)->first();
                if ($detail != null) {
                    $checked = $detail->name;
                }else{
                    $checked = null;
                }
            @endphp
            <div class="form-check">
                <input class="form-check-input disabled" type="checkbox" name="kesadaran[]" value="{{$sadar}}" id="defaultCheck1" {{$sadar == $checked ? 'checked' : ''}} />
                <label class="form-check-label" for="defaultCheck1">
                    {{ $sadar }}
                </label>
            </div>
            @endforeach
          </div>
        </div>
        <div class="col-sm-4 ">
          <p class="fw-bold m-0">Kebutuhan Khusus :</p>
          <div class="mb-3 mx-3">
            @foreach ($kebutuhanKhusus as $khusus)
            @php
                $detail = $khss->where('name', $khusus)->first();
                if ($detail != null) {
                    $checked = $detail->name;
                }else{
                    $checked = null;
                }
            @endphp
            <div class="form-check">
                <input class="form-check-input disabled" type="checkbox" name="kebutuhan-khusus[]" value="{{$khusus}}" id="defaultCheck1" {{$khusus == $checked ? 'checked' : ''}} />
                <label class="form-check-label" for="defaultCheck1">
                    {{ $khusus }}
                </label>
            </div>
            @endforeach
          </div>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-sm-2">
          <div class="row">
            <label class="form-control-label col-sm-12 fw-bold" for="lainya">Tekanan Darah</label>
            <div class="col-sm-8">
              <input type="text" value="{{$statusFisik->darah}}" class="form-control form-control-sm" name="darah" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" />
            </div>
            <div class="col-sm-4">
              <p class="m-0">mmhg</p>
            </div>
          </div>
        </div>
        <div class="col-sm-2">
          <div class="row">
            <label class="form-control-label col-sm-12 fw-bold" for="lainya">Nadi</label>
            <div class="col-sm-8">
              <input type="number" value="{{$statusFisik->nadi}}" class="form-control form-control-sm" name="nadi" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" />
            </div>
            <div class="col-sm-4 m-0 p-0">
              <p class="m-0">x/menit</p>
            </div>
          </div>
        </div>
        <div class="col-sm-2">
          <div class="row">
            <label class="form-control-label col-sm-12 fw-bold" for="lainya">Suhu</label>
            <div class="col-sm-8">
              <input type="number" value="{{$statusFisik->suhu}}" class="form-control form-control-sm" name="suhu" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" />
            </div>
            <div class="col-sm-4">
              <p class="m-0">°C</p>
            </div>
          </div>
        </div>
        <div class="col-sm-2">
          <div class="row">
            <label class="form-control-label col-sm-12 fw-bold" for="lainya">Pernafasan</label>
            <div class="col-sm-8">
              <input type="number" value="{{$statusFisik->pernafasan}}" class="form-control form-control-sm" name="pernafasan" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" />
            </div>
            <div class="col-sm-4 m-0 p-0">
              <p class="m-0">x/menit</p>
            </div>
          </div>
        </div>
        <div class="col-sm-2">
          <div class="row">
            <label class="form-control-label col-sm-12 fw-bold" for="lainya">Tinggi Badan</label>
            <div class="col-sm-8">
              <input type="number" value="{{$statusFisik->tb}}" class="form-control form-control-sm" id="lainnya" name="tb" placeholder="" aria-describedby="floatingInputHelp" />
            </div>
            <div class="col-sm-4">
              <p class="m-0">CM</p>
            </div>
          </div>
        </div>
        <div class="col-sm-2">
          <div class="row">
            <label class="form-control-label col-sm-12 fw-bold" for="lainya">Berat Badan</label>
            <div class="col-sm-8">
              <input type="number" value="{{$statusFisik->bb}}" class="form-control form-control-sm" id="lainnya" name="bb" placeholder="" aria-describedby="floatingInputHelp" />
            </div>
            <div class="col-sm-4">
              <p class="m-0">Kg</p>
            </div>
          </div>
        </div>
      </div>

      <h6 class="text-center bg-dark text-white py-2">PSIKO-SOSIO-SPRITUAL</h6>
      <div class="row mb-3">
        <div class="col-sm-4 ">
          <p class="fw-bold m-0">Psikologis :</p>
          <div class="mb-3 mx-3">
            @foreach ($psikologis as $psiko)
            @php
                $detail = $psi->where('name', $psiko)->first();
                if ($detail != null) {
                    $checked = $detail->name;
                }else{
                    $checked = null;
                }
            @endphp
            <div class="form-check">
                <input class="form-check-input disabled" type="checkbox" name="psikologis[]" value="{{$psiko}}" id="defaultCheck1" {{$psiko == $checked ? 'checked' : ''}} />
                <label class="form-check-label" for="defaultCheck1">
                    {{ $psiko }}
                </label>
            </div>
            @endforeach
          </div>
        </div>
        <div class="col-sm-8 ">
          <p class="fw-bold m-0">Sosial :</p>
          <div class="mb-3">
            <ol>
              <li class="mt-1">
                @php
                    $detail = $sos->where('name', 'Pasien tinggal dirumah dengan siapa')->first();
                @endphp
                <p class="m-0 d-flex">Pasien tinggal dirumah dengan siapa
                <span class="mx-2"><input type="text" name="pasien" value="{{$detail->value}}" class="form-control form-control-sm" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" /></span>
                </p>
              </li>
              <li class="mt-1">
                @php
                    $detail = $sos->where('name', 'Interaksi dengan lingkungan sekitar')->first();
                @endphp
                <div class="row">
                  <div class="col-sm-auto">
                    Interaksi dengan lingkungan sekitar
                  </div>
                  <div class="col-sm-2">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" name="interaksi" type="radio" id="inlineCheckbox1" value="Baik" {{$detail->value == 'Baik' ? 'checked' : ''}} />
                      <label class="form-check-label" for="inlineCheckbox1">Baik</label>
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" name="interaksi" type="radio" id="inlineCheckbox2" value="Tidak Baik" {{$detail->value == 'Tidak Baik' ? 'checked' : ''}} />
                      <label class="form-check-label" for="inlineCheckbox2">Tidak Baik</label>
                    </div>
                  </div>
                </div>
              </li>
              <li class="mt-1">
                <p class="m-0 d-flex">Datang kerumah sakit dengan siapa
                  <span class="mx-2"><input type="text" name="datang" class="form-control form-control-sm" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" /></span>
                  Hubungan
                  <span class="mx-2"><input type="text" name="hubungan" class="form-control form-control-sm" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" /></span>
              </p>
              </li>
              <li class="mt-1">
                <p class="m-0">Kerabat terdekat yang bisa dihubungi : <br>
                  <div class="d-flex">
                  Nama
                  <span class="mx-2"><input type="text" name="kerabat-nama" class="form-control form-control-sm" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" /></span>
                  Hubungan
                  <span class="mx-2"><input type="text" name="kerabat-hubungan" class="form-control form-control-sm" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" /></span>
                  Telepon
                  <span class="mx-2"><input type="number" name="kerabat-hp" class="form-control form-control-sm" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" /></span>
                  </div>
              </p>
              </li>
              <li>
                @php
                    $detail = $sos->where('name', 'Hambatan Sosial')->first();
                @endphp
                <div class="row">
                  <div class="col-sm-auto">
                    Hambatan Sosial
                  </div>
                  <div class="col-sm-2">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" {{$detail->value == 'Tidak Ada' ? 'checked' : ''}} name="hambatan-sosial" id="inlineCheckbox1" onclick="disableHambatanSosial()" value="Tidak Ada" />
                      <label class="form-check-label" for="inlineCheckbox1">Tidak Ada</label>
                    </div>
                  </div>
                  <div class="col-sm-auto">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" {{$detail->value != 'Tidak Ada' ? 'checked' : ''}} name="hambatan-sosial" id="inlineCheckbox1" onclick="enableHambatanSosial()" value="Ada" />
                      <label class="form-check-label d-flex" for="">
                        Ada, sebutkan
                        <span class="mx-2"><input type="text" name="ket-hambatan-sosial" value="{{$detail->value}}" class="form-control form-control-sm" id="input-hambatan-sosial" placeholder="" aria-describedby="floatingInputHelp" {{$detail->value != 'Tidak Ada' ? 'enable' : 'disabled'}} /></span>
                      </label>
                    </div>
                  </div>
                </div>
              </li>
            </ol>
          </div>
        </div>
        <div class="col-sm-12 ">
            <p class="fw-bold m-0">Spiritual :</p>
            <div class="mb-3 mx-3">
                <div class="row form-check d-flex">
                    @php
                        $detail = $spi->where('name', 'Sehat')->first();
                        if ($detail != null) {
                            $value = $detail->value;
                            $checked = 'checked';
                        } else {
                            $value = '';
                            $checked = null;
                        }
                    @endphp
                    <div class="mb-2 col-sm-1">
                        <input class="form-check-input" type="radio" value="Sehat" name="spiritual" id="" onclick="enableSehat()" {{$checked}} />
                        <label for="" class="form-check-label"><p class="m-0">Sehat</p></label>
                    </div>
                    <div class="mb-2 col-sm-2">
                        <input type="text" name="ket-sehat" value="{{$value}}" {{$checked == 'checked' ? 'enable' : 'disabled'}} class="form-control form-control-sm" id="input-sehat" placeholder="" aria-describedby="floatingInputHelp" disabled />
                    </div>
                    <div class="mb-2 col-sm-9"></div>
                    @php
                        $detail = $spi->where('name', 'Sakit')->first();
                        if ($detail != null) {
                            $value = $detail->value;
                            $checked = 'checked';
                        } else {
                            $value = '';
                            $checked = null;
                        }
                    @endphp
                    <div class="mb-2 col-sm-1">
                        <input class="form-check-input" type="radio" value="Sakit" name="spiritual" id="" onclick="enableSakit()" {{$checked}} />
                        <label for="" class="form-check-label"><p class="m-0">Sakit</p></label>
                    </div>
                    <div class="mb-2 col-sm-2">
                        <input type="text" name="ket-sakit" value="{{$value}}" {{$checked == 'checked' ? 'enable' : 'disabled'}} class="form-control form-control-sm" id="input-sakit" placeholder="" aria-describedby="floatingInputHelp" disabled />
                    </div>
                    <div class="mb-2 col-sm-9"></div>
                    @php
                        $detail = $spi->where('name', 'Hambatan Spiritual')->first();
                        if ($detail != null) {
                            $value = $detail->value;
                        } else {
                            $value = '';
                        }
                    @endphp
                    <div class="mb-2 col-sm-auto">
                        <input class="form-check-input" type="radio" value="Hambatan Spiritual" name="spiritual" id="" onclick="enableSpiritual()" {{$value != '' ? 'checked' : ''}} />
                        Hambatan Spiritual
                    </div>
                    <div class="mb-2 col-sm-auto">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="hambatan-spiritual" id="tidakAda" onclick="disableHambatanSpiritual()" value="Tidak Ada" {{$value != '' ? 'enable' : 'disabled'}} {{$value == 'Tidak Ada' ? 'checked' : ''}} />
                            <label class="form-check-label" for="inlineCheckbox1">Tidak Ada</label>
                        </div>
                    </div>
                    <div class="mb-2 col-sm-auto">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="hambatan-spiritual" id="Ada" onclick="enableHambatanSpiritual()" value="Ada" {{$value != '' ? 'enable' : 'disabled'}} {{$value != 'Tidak Ada' ? 'checked' : ''}} />
                            <label class="form-check-label d-flex" for="">
                                Ada, sebutkan
                                <span class="mx-2"><input type="text" name="ket-hambatan-spiritual" value="{{$value != 'Tidak Ada' ? $value : ''}}" {{$value != 'Tidak Ada' ? 'enable' : 'disabled'}} class="form-control form-control-sm" id="input-ket-hambatan-spiritual" placeholder="" aria-describedby="floatingInputHelp" /></span>
                            </label>
                        </div>
                    </div>
                </div>

            <div class="row mb-2">
                    @php
                        $detail = $spi->where('name', 'Kultural / Nilai Kepercayaan')->first();
                        if ($detail != null) {
                            $value = $detail->value;
                        } else {
                            $value = '';
                        }
                    @endphp
              <div class="col-sm-auto">
                Kultural / Nilai Kepercayaan :
              </div>
              <div class="col-sm-auto">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="nilai-kepercayaan" {{$value == 'Tidak Ada' ? 'checked' : ''}} type="radio" id="inlineCheckbox1" onclick="disableKepercayaan()" value="Tidak Ada" />
                  <label class="form-check-label" for="inlineCheckbox1" >Tidak Ada</label>
                </div>
              </div>
              <div class="col-sm-auto">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="nilai-kepercayaan" {{$value != 'Tidak Ada' ? 'checked' : ''}} type="radio" id="inlineCheckbox1" onclick="enableKepercayaan()" value="Ada" />
                  <label class="form-check-label d-flex" for="inlineCheckbox2" >
                    Ada, sebutkan
                    <span class="mx-2"><input type="text" value="{{$value != 'Tidak Ada' ? $value : ''}}" {{$value != 'Tidak Ada' ? 'enable' : 'disabled'}} class="form-control form-control-sm" placeholder="" name="ket-nilai-kepercayaan" id="input-ket-nilai-kepercayaan" aria-describedby="floatingInputHelp" /></span>
                  </label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-auto">
                    @php
                        $detail = $spi->where('name', 'Apakah pasien memerlukan pelayanan / bimbingan rohani selama dirawat?')->first();
                        if ($detail != null) {
                            $value = $detail->value;
                        } else {
                            $value = '';
                        }
                    @endphp
                Apakah pasien memerlukan pelayanan / bimbingan rohani ?
              </div>
              <div class="col-sm-auto">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="rohani" {{$value == 'Tidak' ? 'checked' : ''}} type="radio" id="inlineCheckbox1" onclick="disableRohani()" value="Tidak" checked />
                  <label class="form-check-label" for="inlineCheckbox1">Tidak</label>
                </div>
              </div>
              <div class="col-sm-auto">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="rohani" {{$value != 'Tidak' ? 'checked' : ''}} type="radio" id="inlineCheckbox1" onclick="enableRohani()" value="Ya" />
                  <label class="form-check-label d-flex" for="inlineCheckbox2">
                    Ya
                    <span class="mx-2"><input type="text" name="ket-rohani" value="{{$value != 'Tidak' ? $value : ''}}" {{$value != 'Tidak' ? 'enable' : 'disabled'}} class="form-control form-control-sm" id="input-ket-rohani" placeholder="" aria-describedby="floatingInputHelp" /></span>
                  </label>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

      <h6 class="text-center bg-dark text-white py-2">EKONOMI</h6>
      <div class="row">
        <div class="col-sm-6">
          <div class="row mb-3">
            <div class="col-sm-4 d-flex align-self-center">
              Pasien menggunakan :
            </div>
            <div class="col-sm-7">
                <select class="form-control form-control-sm select2" id="" name="status">
                  <option value="{{ $item->queue->patientCategory->name }}" {{$item->queue->patientCategory->name == $ekonomi->status ? 'selected' : ''}}>{{ $item->queue->patientCategory->name }}</option>
                </select>
            </div>
          </div>
        </div>
        <div class="col-sm-6 d-flex align-self-center">
          <div class="row">
            <div class="col-sm-auto">
              Hambatan Ekonomi
            </div>
            <div class="col-sm-auto">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="hambatan-ekonomi" id="inlineCheckbox1" onclick="disableHambatanEkonomi()" value="Tidak" {{$ekonomi->hambatan == 'Tidak' ? 'checked' : ''}} />
                <label class="form-check-label" for="inlineCheckbox1">Tidak</label>
              </div>
            </div>
            <div class="col-sm-auto">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="hambatan-ekonomi" id="inlineCheckbox1" onclick="enableHambatanEkonomi()" value="Ada" {{$ekonomi->hambatan != 'Tidak' ? 'checked' : ''}} />
                <label class="form-check-label d-flex" for="inlineCheckbox2">
                  Ada, sebutkan
                  <span class="mx-2"><input type="text" name="ket-hambatan-ekonomi" value="{{$ekonomi->hambatan != 'Tidak' ? $ekonomi->hambatan : ''}}" {{$ekonomi->hambatan != 'Tidak' ? 'enable' : 'disabled'}} class="form-control form-control-sm" id="input-ket-hambatan-ekonomi" placeholder="" aria-describedby="floatingInputHelp" /></span>
                </label>
              </div>
            </div>
          </div>
        </div>
      </div>

      <h6 class="text-center bg-dark text-white py-2">RIWAYAT ALERGI</h6>
      @php
          $status = $alergis->first()->status;
      @endphp
      <div class="mb-3">
        <div class="form-check">
          <input class="form-check-input"  type="radio" name="alergi" {{$status == 'Tidak Ada' ? 'checked' : ''}} onclick="disableRiwayatAlergi()" value="Tidak Ada" id="defaultCheck1" checked />
          <label class="form-check-label" for="defaultCheck1">
            Tidak Ada
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="alergi" {{$status == 'Tidak Diketahui' ? 'checked' : ''}} onclick="disableRiwayatAlergi()" value="Tidak Diketahui" id="defaultCheck2" />
          <label class="form-check-label" for="defaultCheck2">
            Tidak Diketahui
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="alergi" {{$status == 'Ada' ? 'checked' : ''}} onclick="enableRiwayatAlergi()" value="Ada" id="defaultCheck3" />
          <label class="form-check-label" for="defaultCheck3">
            Ada
          </label>
        </div>
        <div class="row mb-2">
          <div class="col-sm-2">
            <p class="m-0">Alergi Obat</p>
          </div>
          <div class="col-sm-4">
            <input type="text" name="alergi-obat" value="{{ $status == 'Ada' ? $alergis[0]->alergi : ''}}" {{$status == 'Ada' ? 'enable' : 'disabled'}}  class="form-control form-control-sm" id="input-riwayat-alergi-1" placeholder="" aria-describedby="floatingInputHelp" />
          </div>
          <div class="col-sm-1">
            <p class="m-0">Reaksi</p>
          </div>
          <div class="col-sm-4">
            <input type="text" name="reaksi-obat" value="{{ $status == 'Ada' ? $alergis[0]->reaksi : ''}}" {{$status == 'Ada' ? 'enable' : 'disabled'}} class="form-control form-control-sm" id="input-riwayat-alergi-2" placeholder="" aria-describedby="floatingInputHelp" />
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-sm-2">
            <p class="m-0">Alergi Makanan</p>
          </div>
          <div class="col-sm-4">
            <input type="text" name="alergi-makanan" value="{{ $status == 'Ada' ? $alergis[1]->alergi : ''}}" {{$status == 'Ada' ? 'enable' : 'disabled'}}  class="form-control form-control-sm" id="input-riwayat-alergi-3" placeholder="" aria-describedby="floatingInputHelp" />
          </div>
          <div class="col-sm-1">
            <p class="m-0">Reaksi</p>
          </div>
          <div class="col-sm-4">
            <input type="text" name="reaksi-makanan" value="{{ $status == 'Ada' ? $alergis[1]->reaksi : ''}}" {{$status == 'Ada' ? 'enable' : 'disabled'}} class="form-control form-control-sm" id="input-riwayat-alergi-4" placeholder="" aria-describedby="floatingInputHelp" />
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-sm-2">
            <p class="m-0">Alergi Lainnya</p>
          </div>
          <div class="col-sm-4">
            <input type="text" name="alergi-lainnya" value="{{ $status == 'Ada' ? $alergis[2]->alergi : ''}}" {{$status == 'Ada' ? 'enable' : 'disabled'}} class="form-control form-control-sm" id="input-riwayat-alergi-5" placeholder="" aria-describedby="floatingInputHelp" />
          </div>
          <div class="col-sm-1">
            <p class="m-0">Reaksi</p>
          </div>
          <div class="col-sm-4">
            <input type="text" name="reaksi-lainnya" value="{{ $status == 'Ada' ? $alergis[2]->reaksi : ''}}" {{$status == 'Ada' ? 'enable' : 'disabled'}} class="form-control form-control-sm" id="input-riwayat-alergi-6" placeholder="" aria-describedby="floatingInputHelp" />
          </div>
        </div>
      </div>

      <h6 class="text-center bg-dark text-white py-2">SKRINING DAN ASESMEN NYERI</h6>
      <div class="mb-3">
        <div class="row">
          <div class="col-sm-auto">
            Apakah Pasien Merasa Nyeri ?
          </div>
          <div class="col-sm-auto">
            <div class="form-check form-check-inline">
              <input class="form-check-input" name="rasa-nyeri" {{$nyeri->status == 'Tidak' ? 'checked' : ''}} type="radio" id="inlineCheckbox1" onclick="disableNyeri()" value="Tidak" />
              <label class="form-check-label" for="inlineCheckbox1">Tidak</label>
            </div>
          </div>
          <div class="col-sm-auto">
            <div class="form-check form-check-inline">
              <input class="form-check-input" name="rasa-nyeri" {{$nyeri->status == 'Ya' ? 'checked' : ''}} type="radio" id="inlineCheckbox2" onclick="enableNyeri()" value="Ya" />
              <label class="form-check-label d-flex" for="inlineCheckbox2">
                Ya
              </label>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-auto">
            Kategori Nyeri
          </div>
          <div class="col-sm-auto">
            <div class="form-check form-check-inline">
              <input class="form-check-input" name="kategori-nyeri" {{$nyeri->category == 'Akut' ? 'checked' : ''}} {{$nyeri->status == 'Ya' ? 'enable' : 'disabled'}} type="radio" id="akut" value="Akut" />
              <label class="form-check-label" for="inlineCheckbox1">Akut</label>
            </div>
          </div>
          <div class="col-sm-auto">
            <div class="form-check form-check-inline">
              <input class="form-check-input" name="kategori-nyeri" {{$nyeri->category == 'Kronis' ? 'checked' : ''}} {{$nyeri->status == 'Ya' ? 'enable' : 'disabled'}} type="radio" id="kronis" value="Kronis" />
              <label class="form-check-label d-flex" for="inlineCheckbox2">
                Kronis
              </label>
            </div>
          </div>
        </div>
        <p class="m-0">Jika Ya, lakukan pengkajian nyeri lebih lanjut dengan format sesuai dengan usia pasien</p>
        <table class="table-bordered w-100 mb-3">
          <tbody>
            <tr>
              <th class="text-center">DEWASA (NUMERIC SCALE)</th>
              <td rowspan="3" style="width: 650px">
                <table class="w-100">
                  <tr>
                    <td>Provocation (Pencetus)</td>
                    <td>:</td>
                    <td>
                      <input type="text" value="{{$nyeri->provocation}}" name="provocation" placeholder="Provocation (Pencetus)" class="form-control " id="lainnya" aria-describedby="floatingInputHelp" />
                    </td>
                  </tr>
                  <tr>
                    <td>Quality (Karakteristik)</td>
                    <td>:</td>
                    <td>
                      <input type="text" value="{{$nyeri->quality}}" name="quality" placeholder="Quality (Karakteristik)" class="form-control " id="lainnya" aria-describedby="floatingInputHelp" />
                    </td>
                  </tr>
                  <tr>
                    <td>Region (Lokasi/Penjalaran)</td>
                    <td>:</td>
                    <td>
                      <input type="text" value="{{$nyeri->region}}" name="region" placeholder="Region (Lokasi/Penjalaran)" class="form-control " id="lainnya" aria-describedby="floatingInputHelp" />
                    </td>
                  </tr>
                  <tr>
                    <td>Severity (Keparahan)</td>
                    <td>:</td>
                    <td>
                      <input type="text" value="{{$nyeri->severity}}" name="severity" placeholder="Severity (Keparahan)" class="form-control " id="lainnya" aria-describedby="floatingInputHelp" />
                    </td>
                  </tr>
                  <tr>
                    <td>Time (Durasi dan Frekuensi)</td>
                    <td>:</td>
                    <td>
                      <input type="text" value="{{$nyeri->time}}" name="time" placeholder="Time (Durasi dan Frekuensi)" class="form-control " id="lainnya" aria-describedby="floatingInputHelp" />
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <img src="{{ asset('/assets/img/aakprj1.jpg') }}" alt="" class="" style="max-width: 650px">
              </td>
            </tr>
            <tr>
              <td>
                <img src="{{ asset('/assets/img/aakprj2.jpg') }}" alt="" class="" style="max-width: 650px">
              </td>
            </tr>
          </tbody>
        </table>
        <div class="row">
          <div class="col-sm-4 ">
            <p class="fw-bold m-0">Nyeri hilang, dengan :</p>
            <div class="mx-3">
            @foreach ($asesmentNyeri as $nyeri)
            @php
                $detail = $detailNyeri->where('name', $nyeri)->first();
                if ($detail != null) {
                    $checked = $detail->name;
                } else {
                    $checked = null;
                }
            @endphp
              <div class="form-check">
                <input class="form-check-input" name="nyeri-hilang[]" type="checkbox" {{$nyeri == $checked ? 'checked' : ''}} value="{{$nyeri}}" id="defaultCheck1" />
                <label class="form-check-label" for="defaultCheck1">
                  {{ $nyeri }}
                </label>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
        <button class="btn btn-primary btn-sm">Submit</button>
      </form>
    </div>
  </div>

  <script>
    // hambatan sosial
    function disableHambatanSosial() {
        var inputHambatanSosial = document.getElementById('input-hambatan-sosial');

        inputHambatanSosial.readonly = true;
        inputHambatanSosial.value = '';
    }

    function enableHambatanSosial() {
        var inputHambatanSosial = document.getElementById('input-hambatan-sosial');

        inputHambatanSosial.readonly = false;
    }

    // spiritual
    function enableSehat() {
        var inputSehat = document.getElementById('input-sehat');
        var inputSakit = document.getElementById('input-sakit');
        var tidakAda = document.getElementById('tidakAda');
        var Ada = document.getElementById('Ada');
        var inputHambatanSpiritual = document.getElementById('input-ket-hambatan-spiritual');

        inputSehat.disabled = false;
        inputSakit.value = '';
        inputSakit.disabled = true;
        tidakAda.disabled = true;
        tidakAda.checked = false;
        Ada.disabled = true;
        Ada.checked = false;
        inputHambatanSpiritual.value = '';
        inputHambatanSpiritual.disabled = true;
    }

    function enableSakit() {
        var inputSehat = document.getElementById('input-sehat');
        var inputSakit = document.getElementById('input-sakit');
        var tidakAda = document.getElementById('tidakAda');
        var Ada = document.getElementById('Ada');
        var inputHambatanSpiritual = document.getElementById('input-ket-hambatan-spiritual');

        inputSehat.value = '';
        inputSehat.disabled = true;
        inputSakit.disabled = false;
        tidakAda.disabled = true;
        tidakAda.checked = false;
        Ada.disabled = true;
        Ada.checked = false;
        inputHambatanSpiritual.value = '';
        inputHambatanSpiritual.disabled = true;
    }

    function enableSpiritual() {
        var inputSehat = document.getElementById('input-sehat');
        var inputSakit = document.getElementById('input-sakit');
        var tidakAda = document.getElementById('tidakAda');
        var Ada = document.getElementById('Ada');

        inputSehat.value = '';
        inputSehat.disabled = true;
        inputSakit.value = '';
        inputSakit.disabled = true;
        tidakAda.disabled = false;
        tidakAda.checked = false;
        Ada.disabled = false;
        Ada.checked = false;
    }

    // hambatan spiritual
    function disableHambatanSpiritual() {
        var inputHambatanSpiritual = document.getElementById('input-ket-hambatan-spiritual');

        inputHambatanSpiritual.disabled = true;
        inputHambatanSpiritual.value = '';
    }

    function enableHambatanSpiritual() {
        var inputHambatanSpiritual = document.getElementById('input-ket-hambatan-spiritual');

        inputHambatanSpiritual.disabled = false;
    }

    // nilai kepercayaan
    function disableKepercayaan() {
        var inputKepercayaan = document.getElementById('input-ket-nilai-kepercayaan');

        inputKepercayaan.disabled = true;
        inputKepercayaan.value = '';
    }

    function enableKepercayaan() {
        var inputKepercayaan = document.getElementById('input-ket-nilai-kepercayaan');

        inputKepercayaan.disabled = false;
    }

    // bimbingan rohani
    function disableRohani() {
        var inputRohani = document.getElementById('input-ket-rohani');

        inputRohani.disabled = true;
        inputRohani.value = '';
    }

    function enableRohani() {
        var inputRohani = document.getElementById('input-ket-rohani');

        inputRohani.disabled = false;
    }

    // hambatan ekonomi
    function disableHambatanEkonomi() {
        var inputHambatanEkonomi = document.getElementById('input-ket-hambatan-ekonomi');

        inputHambatanEkonomi.disabled = true;
        inputHambatanEkonomi.value = '';
    }

    function enableHambatanEkonomi() {
        var inputHambatanEkonomi = document.getElementById('input-ket-hambatan-ekonomi');

        inputHambatanEkonomi.disabled = false;
    }

    // riwayat alergi
    function disableRiwayatAlergi() {
        var inputRiwayatAlergi1 = document.getElementById('input-riwayat-alergi-1');
        var inputRiwayatAlergi2 = document.getElementById('input-riwayat-alergi-2');
        var inputRiwayatAlergi3 = document.getElementById('input-riwayat-alergi-3');
        var inputRiwayatAlergi4 = document.getElementById('input-riwayat-alergi-4');
        var inputRiwayatAlergi5 = document.getElementById('input-riwayat-alergi-5');
        var inputRiwayatAlergi6 = document.getElementById('input-riwayat-alergi-6');

        inputRiwayatAlergi1.disabled = true;
        inputRiwayatAlergi2.disabled = true;
        inputRiwayatAlergi3.disabled = true;
        inputRiwayatAlergi4.disabled = true;
        inputRiwayatAlergi5.disabled = true;
        inputRiwayatAlergi6.disabled = true;
        inputRiwayatAlergi1.value = '';
        inputRiwayatAlergi2.value = '';
        inputRiwayatAlergi3.value = '';
        inputRiwayatAlergi4.value = '';
        inputRiwayatAlergi5.value = '';
        inputRiwayatAlergi6.value = '';
    }

    function enableRiwayatAlergi() {
        var inputRiwayatAlergi1 = document.getElementById('input-riwayat-alergi-1');
        var inputRiwayatAlergi2 = document.getElementById('input-riwayat-alergi-2');
        var inputRiwayatAlergi3 = document.getElementById('input-riwayat-alergi-3');
        var inputRiwayatAlergi4 = document.getElementById('input-riwayat-alergi-4');
        var inputRiwayatAlergi5 = document.getElementById('input-riwayat-alergi-5');
        var inputRiwayatAlergi6 = document.getElementById('input-riwayat-alergi-6');

        inputRiwayatAlergi1.disabled = false;
        inputRiwayatAlergi2.disabled = false;
        inputRiwayatAlergi3.disabled = false;
        inputRiwayatAlergi4.disabled = false;
        inputRiwayatAlergi5.disabled = false;
        inputRiwayatAlergi6.disabled = false;
    }

    // nyeri
    function disableNyeri() {
        var akut = document.getElementById('akut');
        var kronis = document.getElementById('kronis');

        akut.disabled = true;
        kronis.disabled = true;
        akut.checked = false;
        kronis.checked = false;
    }

    function enableNyeri() {
        var akut = document.getElementById('akut');
        var kronis = document.getElementById('kronis');

        akut.disabled = false;
        kronis.disabled = false;
        akut.checked = true;
        kronis.checked = false;
    }
  </script>

@endsection
