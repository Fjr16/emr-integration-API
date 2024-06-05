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
            <a href="{{ route('clear/asesment/perawat') }}" class="btn mt-2 btn-sm btn-primary">Clear</a>
          </div>
          <div class="col-3 m-0 text-end">
            <button class="btn btn-success btn-sm " onclick="history.back()">Kembali</button>
          </div>
        </div>
      </div>
    <div class="card-body">
        {{-- tambahan nav-tab --}}
      <div class="nav-align-top mb-4">
        <ul class="nav nav-pills nav-sm mb-3 nav-fill w-100" role="tablist">
          <li class="nav-item">
            <button
              type="button"
              class="border nav-link {{ session('dokter') == 'Status Fisik' ? 'active':'' }}"
              role="tab"
              data-bs-toggle="tab"
              data-bs-target="#navs-pills-justified-statusfisik"
              aria-controls="navs-pills-justified-statusfisik"
              aria-selected="true"
            >
            Status Fisik
            </button>
          </li>
          <li class="nav-item">
            <button
              type="button"
              class="border nav-link {{ session('dokter') == 'Skrining Resiko Jatuh' ? 'active':'' }}"
              role="tab"
              data-bs-toggle="tab"
              data-bs-target="#navs-pills-justified-skriningresikojatuh"
              aria-controls="navs-pills-justified-skriningresikojatuh"
              aria-selected="true"
            >
            Skrining Resiko Jatuh
            </button>
          </li>
          <li class="nav-item">
            <button
              type="button"
              class="border nav-link {{ session('dokter') == 'Diagnosis Keperawatan' ? 'active':'' }}"
              role="tab"
              data-bs-toggle="tab"
              data-bs-target="#navs-pills-justified-diagnosiskeperawatan"
              aria-controls="navs-pills-justified-diagnosiskeperawatan"
              aria-selected="true"
            >
            Diagnosis Keperawatan
            </button>
          </li>
          <li class="nav-item">
            <button
              type="button"
              class="border nav-link {{ session('dokter') == 'Rencana Asuhan' ? 'active':'' }}"
              role="tab"
              data-bs-toggle="tab"
              data-bs-target="#navs-pills-justified-rencanaasuhan"
              aria-controls="navs-pills-justified-rencanaasuhan"
              aria-selected="true"
            >
            Rencana Asuhan
            </button>
          </li>

        </ul>
        <div class="tab-content">
          <div class="tab-pane fade {{ (session('dokter') == 'Status Fisik') ? 'show active' : '' }}" id="navs-pills-justified-statusfisik" role="tabpanel">
            <form action="{{ route('rajal/asesmen/status/fisik.store', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
                @csrf
                <h6 class="text-center bg-dark text-white py-2">STATUS FISIK</h6>
                <div class="row mb-3">
                <div class="col-sm-4 ">
                    <p class="fw-bold m-0">Kondisi Umum :</p>
                    <div class="mb-3 mx-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="kondisi-umum[]" value="Baik" id="defaultCheck1" />
                        <label class="form-check-label" for="defaultCheck1">
                        Baik
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="kondisi-umum[]" value="Tampak Sakit" id="defaultCheck2" />
                        <label class="form-check-label" for="defaultCheck2">
                        Tampak Sakit
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="kondisi-umum[]" value="Sesak" id="defaultCheck3" />
                        <label class="form-check-label" for="defaultCheck3">
                        Sesak
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="kondisi-umum[]" value="Pucat" id="defaultCheck4" />
                        <label class="form-check-label" for="defaultCheck4">
                        Pucat
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="kondisi-umum[]" value="Lemah" id="defaultCheck5" />
                        <label class="form-check-label" for="defaultCheck5">
                        Lemah
                        </label>
                    </div>
                    <div class="row mb-3">
                        <label class="form-control-label col-sm-12" for="lainya">Lainnya</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" />
                        </div>
                        {{-- <div class="col-sm-2">
                        <button class="btn btn-dark btn-sm">+</button>
                        </div> --}}
                    </div>
                    </div>
                </div>
                <div class="col-sm-4 ">
                    <p class="fw-bold m-0">Kebutuhan Khusus :</p>
                    <div class="mb-3 mx-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="kebutuhan-khusus[]" value="Tidak" id="defaultCheck1" />
                        <label class="form-check-label" for="defaultCheck1">
                        Tidak
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="kebutuhan-khusus[]" value="Ada" id="defaultCheck2" />
                        <label class="form-check-label" for="defaultCheck2">
                        Ada
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="kebutuhan-khusus[]" value="Tongkat" id="defaultCheck3" />
                        <label class="form-check-label" for="defaultCheck3">
                        Tongkat
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="kebutuhan-khusus[]" value="Kacamata" id="defaultCheck4" />
                        <label class="form-check-label" for="defaultCheck4">
                        Kacamata
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="kebutuhan-khusus[]" value="Gigi Palsu" id="defaultCheck5" />
                        <label class="form-check-label" for="defaultCheck5">
                        Gigi Palsu
                        </label>
                    </div>
                    <div class="row mb-3">
                        <label class="form-control-label col-sm-12" for="lainya">Lainnya</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" />
                        </div>
                        {{-- <div class="col-sm-2">
                        <button class="btn btn-dark btn-sm">+</button>
                        </div> --}}
                    </div>
                    </div>
                </div>
                <div class="col-sm-4 ">
                    <p class="fw-bold m-0">Kesadaran :</p>
                    <div class="mb-3 mx-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="kesadaran[]" value="Komposmentis" id="defaultCheck1" />
                        <label class="form-check-label" for="defaultCheck1">
                        Komposmentis
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="kesadaran[]" value="Delirium" id="defaultCheck2" />
                        <label class="form-check-label" for="defaultCheck2">
                        Delirium
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="kesadaran[]" value="Somnolen" id="defaultCheck3" />
                        <label class="form-check-label" for="defaultCheck3">
                        Somnolen
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="kesadaran[]" value="Soporokoma" id="defaultCheck4" />
                        <label class="form-check-label" for="defaultCheck4">
                        Soporokoma
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="kesadaran[]" value="Koma" id="defaultCheck5" />
                        <label class="form-check-label" for="defaultCheck5">
                        Koma
                        </label>
                    </div>
    
                    </div>
                </div>
                </div>
                <div class="row mb-3">
                <div class="col-sm-2">
                    <div class="row">
                    <label class="form-control-label col-sm-12 fw-bold" for="lainya">Tekanan Darah</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" name="darah" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" />
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
                        <input type="text" class="form-control form-control-sm" name="nadi" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" />
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
                        <input type="text" class="form-control form-control-sm" name="suhu" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" />
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
                        <input type="text" class="form-control form-control-sm" name="pernafasan" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" />
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
                        <input type="text" class="form-control form-control-sm" id="lainnya" name="tb" placeholder="" aria-describedby="floatingInputHelp" />
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
                        <input type="text" class="form-control form-control-sm" id="lainnya" name="bb" placeholder="" aria-describedby="floatingInputHelp" />
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
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="psikologis[]" value="Stabil/Tenang" id="defaultCheck1" />
                        <label class="form-check-label" for="defaultCheck1">
                        Stabil/Tenang
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="psikologis[]" value="Cemas/Takut" id="defaultCheck2" />
                        <label class="form-check-label" for="defaultCheck2">
                        Cemas/Takut
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="psikologis[]" value="Marah" id="defaultCheck3" />
                        <label class="form-check-label" for="defaultCheck3">
                        Marah
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="psikologis[]" value="Kecendrungan Bunuh Diri" id="defaultCheck4" />
                        <label class="form-check-label" for="defaultCheck4">
                        Kecendrungan Bunuh Diri
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="psikologis[]" value="Gelisah" id="defaultCheck5" />
                        <label class="form-check-label" for="defaultCheck5">
                        Gelisah
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="psikologis[]" value="Hiperaktif" id="defaultCheck6" />
                        <label class="form-check-label" for="defaultCheck6">
                        Hiperaktif
                        </label>
                    </div>
                    <div class="row mb-3">
                        <label class="form-control-label col-sm-12" for="lainya">Lainnya</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" />
                        </div>
                        {{-- <div class="col-sm-2">
                        <button class="btn btn-dark btn-sm">+</button>
                        </div> --}}
                    </div>
                    </div>
                </div>
                <div class="col-sm-8 ">
                    <p class="fw-bold m-0">Sosial :</p>
                    <div class="mb-3">
                    <ol>
                        <li class="mt-1">
                        <p class="m-0 d-flex">Pasien tinggal dirumah dengan siapa
                        <span class="mx-2"><input type="text" name="pasien" class="form-control form-control-sm" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" /></span>
                        </p>
                        </li>
                        <li class="mt-1">
                        <div class="row">
                            <div class="col-sm-auto">
                            Interaksi dengan lingkungan sekitar
                            </div>
                            <div class="col-sm-2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" checked name="interaksi" type="radio" id="inlineCheckbox1" value="Baik" />
                                <label class="form-check-label" for="inlineCheckbox1">Baik</label>
                            </div>
                            </div>
                            <div class="col-sm-2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="interaksi" type="radio" id="inlineCheckbox2" value="Tidak Baik" />
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
                            <span class="mx-2"><input type="text" name="kerabat-hp" class="form-control form-control-sm" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" /></span>
                            </div>
                        </p>
                        </li>
                        <li>
                        <div class="row">
                            <div class="col-sm-auto">
                            Hambatan Sosial
                            </div>
                            <div class="col-sm-2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="tidak ada" />
                                <label class="form-check-label" for="inlineCheckbox1">Tidak Ada</label>
                            </div>
                            </div>
                            <div class="col-sm-auto">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label d-flex" for="">
                                Ada, sebutkan
                                <span class="mx-2"><input type="text" name="hambatan-sosial" class="form-control form-control-sm" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" /></span>
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
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Sehat" name="sehat" id="defaultCheck1" />
                        <label class="form-check-label" for="defaultCheck1">
                        <p class="m-0 d-flex">Sehat
                            <span class="mx-2"><input type="text" name="ket-sehat" class="form-control form-control-sm" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" /></span>
                        </p>
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Sakit" id="defaultCheck2" />
                        <label class="form-check-label" for="defaultCheck2">
                        <p class="m-0 d-flex">Sakit
                            <span class="mx-2"><input type="text" name="ket-sakit" class="form-control form-control-sm" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" /></span>
                        </p>
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="hambatan-spritual" value="Hambatan Spiritual" id="defaultCheck3" />
                        <label class="form-check-label" for="defaultCheck3">
                        <p class="m-0 d-flex">Hambatan Spiritual
                            <span class="mx-2"><input type="text" name="ket-hambatan-spritual" class="form-control form-control-sm" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" /></span>
                        </p>
                        </label>
                    </div>
                    <div class="row">
                        <div class="col-sm-auto">
                        Kultural / Nilai Kepercayaan :
                        </div>
                        <div class="col-sm-auto">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="nilai-kepercayaan" type="checkbox" id="inlineCheckbox1" value="Tidak Ada" />
                            <label class="form-check-label" for="inlineCheckbox1">Tidak Ada</label>
                        </div>
                        </div>
                        <div class="col-sm-auto">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label d-flex" for="inlineCheckbox2">
                            Ada, sebutkan
                            <span class="mx-2"><input type="text" class="form-control form-control-sm" id="lainnya" placeholder="" name="ket-nilai-kepercayaan" aria-describedby="floatingInputHelp" /></span>
                            </label>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-auto">
                        Apakah pasien memerlukan pelayanan / bimbingan rohani ?
                        </div>
                        <div class="col-sm-auto">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="rohani[]" type="checkbox" id="inlineCheckbox1" value="Tidak" />
                            <label class="form-check-label" for="inlineCheckbox1">Tidak</label>
                        </div>
                        </div>
                        <div class="col-sm-auto">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="rohani[]" type="checkbox" id="inlineCheckbox2" value="Ya" />
                            <label class="form-check-label d-flex" for="inlineCheckbox2">
                            Ya
                            <span class="mx-2"><input type="text" name="ket-rohani" class="form-control form-control-sm" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" /></span>
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
                        <form action="">
                        <select class="form-control form-control-sm select2" id="" name="status">
                            <option value="" selected>Pilih</option>
                            <option value="BPJS" selected>BPJS</option>
                            <option value="UMUM" selected>UMUM</option>
                            <option value="PT" selected>PT</option>
                        </select>
                        </form>
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
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Tidak" />
                        <label class="form-check-label" for="inlineCheckbox1">Tidak</label>
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <div class="form-check form-check-inline">
                        <label class="form-check-label d-flex" for="inlineCheckbox2">
                            Ada, sebutkan
                            <span class="mx-2"><input type="text" name="ket-hambatan" class="form-control form-control-sm" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" /></span>
                        </label>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
    
                <h6 class="text-center bg-dark text-white py-2">RIWAYAT ALERGI</h6>
                <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="alergi" value="Tidak Ada" id="defaultCheck1" />
                    <label class="form-check-label" for="defaultCheck1">
                    Tidak Ada
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="alergi" value="Tidak Diketahui" id="defaultCheck2" />
                    <label class="form-check-label" for="defaultCheck2">
                    Tidak Diketahui
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="alergi" value="Ada" id="defaultCheck3" />
                    <label class="form-check-label" for="defaultCheck3">
                    Ada
                    </label>
                </div>
                <div class="row">
                    <div class="col-sm-1">
                    <p class="m-0">Alergi</p>
                    </div>
                    <div class="col-sm-4">
                    <input type="text" name="ket-alergi" class="form-control form-control-sm" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" />
                    </div>
                    <div class="col-sm-1">
                    <p class="m-0">Reaksi</p>
                    </div>
                    <div class="col-sm-4">
                    <input type="text" name="reaksi" class="form-control form-control-sm" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" />
                    </div>
                    {{-- <div class="col-sm-2">
                    <button class="btn btn-dark btn-sm">+</button>
                    </div> --}}
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
                        <input class="form-check-input" checked name="rasa-nyeri" type="radio" id="inlineCheckbox1" value="tidak" />
                        <label class="form-check-label" for="inlineCheckbox1">Tidak</label>
                    </div>
                    </div>
                    <div class="col-sm-auto">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="rasa-nyeri" type="radio" id="inlineCheckbox2" value="ya" />
                        <label class="form-check-label d-flex" for="inlineCheckbox2">
                        Ya
                        <span class=" mx-2">
                            <a href="/permintaaan-pelayanan-kerohanian" class="btn btn-success btn-sm">+ Kerohanian</a>
                        </span>
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
                        <input class="form-check-input" name="kategori-nyeri" type="radio" id="inlineCheckbox1" value="akut" />
                        <label class="form-check-label" for="inlineCheckbox1">Akut</label>
                    </div>
                    </div>
                    <div class="col-sm-auto">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="kategori-nyeri" type="radio" id="inlineCheckbox2" value="kronis" />
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
                                <input type="text" name="provocation" placeholder="Provocation (Pencetus)" class="form-control " id="lainnya" aria-describedby="floatingInputHelp" />
                            </td>
                            </tr>
                            <tr>
                            <td>Quality (Karakteristik)</td>
                            <td>:</td>
                            <td>
                                <input type="text" name="quality" placeholder="Quality (Karakteristik)" class="form-control " id="lainnya" aria-describedby="floatingInputHelp" />
                            </td>
                            </tr>
                            <tr>
                            <td>Region (Lokasi/Penjalaran)</td>
                            <td>:</td>
                            <td>
                                <input type="text" name="region" placeholder="Region (Lokasi/Penjalaran)" class="form-control " id="lainnya" aria-describedby="floatingInputHelp" />
                            </td>
                            </tr>
                            <tr>
                            <td>Severity (Keparahan)</td>
                            <td>:</td>
                            <td>
                                <input type="text" name="severity" placeholder="Severity (Keparahan)" class="form-control " id="lainnya" aria-describedby="floatingInputHelp" />
                            </td>
                            </tr>
                            <tr>
                            <td>Time (Durasi dan Frekuensi)</td>
                            <td>:</td>
                            <td>
                                <input type="text" name="time" placeholder="Time (Durasi dan Frekuensi)" class="form-control " id="lainnya" aria-describedby="floatingInputHelp" />
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
                        <div class="form-check">
                        <input class="form-check-input" name="nyeri-hilang[]" type="checkbox" value="Minum Obat" id="defaultCheck1" />
                        <label class="form-check-label" for="defaultCheck1">
                            Minum Obat
                        </label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input" name="nyeri-hilang[]" type="checkbox" value="Istirahat" id="defaultCheck2" />
                        <label class="form-check-label" for="defaultCheck2">
                            Istirahat
                        </label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input" name="nyeri-hilang[]" type="checkbox" value="Mendengar Musik" id="defaultCheck3" />
                        <label class="form-check-label" for="defaultCheck3">
                            Mendengar Musik
                        </label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input" name="nyeri-hilang[]" type="checkbox" value="Berubah Posisi Tidur" id="defaultCheck4" />
                        <label class="form-check-label" for="defaultCheck4">
                            Berubah Posisi Tidur
                        </label>
                        </div>
    
                        <div class="row">
                        <label class="form-control-label col-sm-12" for="lainya">Lainnya</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-sm" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" />
                        </div>
                        {{-- <div class="col-sm-2">
                            <button class="btn btn-dark btn-sm">+</button>
                        </div> --}}
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                    <button class="btn btn-success btn-sm">Submit</button>
            </form>
          </div>
          <div class="tab-pane fade {{ (session('dokter') == 'Skrining Resiko Jatuh') ? 'show active' : '' }}" id="navs-pills-justified-skriningresikojatuh" role="tabpanel">
            <h6 class="text-center bg-dark text-white py-2">SKRINING RESIKO JATUH RAWAT JALAN (GET UP AND GO TEST)</h6>
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
                    <input class="form-check-input" name="a" type="radio" value="ya" id="defaultCheck1" checked />
                </td>
                <td class="text-center">
                    <input class="form-check-input" name="a" type="radio" value="tidak" id="defaultCheck1" />
                </td>
                </tr>
                <tr>
                <td colspan="2">b. Apakah pasien memegang pinggiran kursi atau meja atau benda lain sebagai penopang saat akan duduk?</td>
                <td class="text-center">
                    <input class="form-check-input" name="b" type="radio" value="ya" id="defaultCheck1" checked />
                </td>
                <td class="text-center">
                    <input class="form-check-input" name="b" type="radio" value="tidak" id="defaultCheck1" />
                </td>
                </tr>
                <tr>
                <td style="width: 500px">
                    <p class="m-0">Kategori :</p>
                    <div class="mx-3">
                    <div class="form-check">
                        <input class="form-check-input" name="kategori-skrining-rajal[]" type="checkbox" value="Tidak berisiko (tidak ditemukan a dan b)" id="defaultCheck1" />
                        <label class="form-check-label" for="defaultCheck1">
                        Tidak berisiko (tidak ditemukan a dan b)
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="kategori-skrining-rajal[]" type="checkbox" value="Resiko Rendah (ditemukan a atau b)" id="defaultCheck2" />
                        <label class="form-check-label" for="defaultCheck2">
                        Resiko Rendah (ditemukan a atau b)
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="kategori-skrining-rajal[]" type="checkbox" value="Resiko Tinggi (ditemukan a atau b)" id="defaultCheck3" />
                        <label class="form-check-label" for="defaultCheck3">
                        Resiko Tinggi (ditemukan a atau b)
                        </label>
                    </div>
                    </div>
                </td>
                <td colspan="3">
                    <div class="form-check">
                    <input class="form-check-input" name="kategori-skrining-rajal[]" type="checkbox" value="Tidak ada tindakan" id="defaultCheck1" />
                    <label class="form-check-label" for="defaultCheck1">
                        Tidak ada tindakan
                    </label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" name="kategori-skrining-rajal[]" type="checkbox" value="Bila resiko rendah ; pasien diberi edukasi pencegahan resiko jatuh" id="defaultCheck2" />
                    <label class="form-check-label" for="defaultCheck2">
                        Bila resiko rendah ; pasien diberi edukasi pencegahan resiko jatuh
                    </label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" name="kategori-skrining-rajal[]" type="checkbox" value="Bila resiko tinggi ; pasien dipasan kalung resiko jatuh warna kuning dan diberi edukasi pencegahan resiko jatuh" id="defaultCheck3" />
                    <label class="form-check-label" for="defaultCheck3">
                        Bila resiko tinggi ; pasien dipasan kalung resiko jatuh warna kuning dan diberi edukasi pencegahan resiko jatuh
                    </label>
                    </div>
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
                    <tr>
                        <td>Mandiri</td>
                        <td>:</td>
                        <td>100</td>
                    </tr>
                    <tr>
                        <td>Ketergantungan Ringan</td>
                        <td>:</td>
                        <td>91-99</td>
                    </tr>
                    <tr>
                        <td>Ketergantungan Sedang</td>
                        <td>:</td>
                        <td>62-90</td>
                    </tr>
                    <tr>
                        <td>Ketergantungan Berat</td>
                        <td>:</td>
                        <td>21-61</td>
                    </tr>
                    <tr>
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
                <tr>
                <td>1</td>
                <td>Makan</td>
                <td>5</td>
                <td>10</td>
                <td>
                    <input type="number" value="0" name="kriteria[]" class="form-control form-control-sm" id="" placeholder="" />
                </td>
                </tr>
                <tr>
                <td>2</td>
                <td>Aktifitas/Toilet</td>
                <td>5</td>
                <td>10</td>
                <td>
                    <input type="number" value="0" name="kriteria[]" class="form-control form-control-sm" id="" placeholder="" />
                </td>
                </tr>
                <tr>
                <td>3</td>
                <td>Berpindah dari kursi roda ke tempat</td>
                <td>5-10</td>
                <td>15</td>
                <td>
                    <input type="number" value="0" name="kriteria[]" class="form-control form-control-sm" id="" placeholder="" />
                </td>
                </tr>
                <tr>
                <td>4</td>
                <td>Kebersihan diri, mencuci muka, menyisir rambut, menggosok gigi</td>
                <td>0</td>
                <td>5</td>
                <td>
                    <input type="number" value="0" name="kriteria[]" class="form-control form-control-sm" id="" placeholder="" />
                </td>
                </tr>
                <tr>
                <td>5</td>
                <td>Mandi</td>
                <td>0</td>
                <td>5</td>
                <td>
                    <input type="number" value="0" name="kriteria[]" class="form-control form-control-sm" id="" placeholder="" />
                </td>
                </tr>
                <tr>
                <td>6</td>
                <td>Berjalan di permukaan datar</td>
                <td>5-10</td>
                <td>15</td>
                <td>
                    <input type="number" value="0" name="kriteria[]" class="form-control form-control-sm" id="" placeholder="" />
                </td>
                </tr>
                <tr>
                <td>7</td>
                <td>Naik Turun Tangga</td>
                <td>5</td>
                <td>10</td>
                <td>
                    <input type="number" value="0" name="kriteria[]" class="form-control form-control-sm" id="" placeholder="" />
                </td>
                </tr>
                <tr>
                <td>8</td>
                <td>Berpakaian</td>
                <td>5</td>
                <td>10</td>
                <td>
                    <input type="number" value="0" name="kriteria[]" class="form-control form-control-sm" id="" placeholder="" />
                </td>
                </tr>
                <tr>
                <td>9</td>
                <td>Mengontrol defekasi</td>
                <td>5</td>
                <td>10</td>
                <td>
                    <input type="number" value="0" name="kriteria[]" class="form-control form-control-sm" id="" placeholder="" />
                </td>
                </tr>
                <tr>
                <td>10</td>
                <td>Mengontrol berkemih</td>
                <td>5</td>
                <td>10</td>
                <td>
                    <input type="number" value="0" name="kriteria[]" class="form-control form-control-sm" id="" placeholder="" />
                </td>
                </tr>
                <tr>
                <td></td>
                <td colspan="4">Total</td>
                <td><input type="number" class="form-control form-control-sm" id="" placeholder="" /></td>
                </tr>
            </tbody>
            </table>

            <h6 class="text-center bg-dark text-white py-2">SKRINING RISIKO NUTRISIONAL</h6>
            <table class="table table-bordered mb-3">
            <thead class="text-center">
                <tr>
                <td class="w-50">Skrining Gizi Pada Anak <br> Berdasarkan Metode Strong Kids (usia < 18)</td>
                <td>Skrining Gizi Pada Dewasa <br> Berdasarkan Metode MST (usia > 18)</td>
                </tr>
            </thead>
            <tbody>
                <tr>
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
                            <input class="form-check-input" name="anak-empat" type="radio" value="1" id="defaultCheck1" />
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
                        <td colspan="2" class="text-center">Total</td>
                        <td><input type="number" class="form-control form-control-sm" id="" placeholder="" /></td>
                        </tr>
                    </tbody>
                    </table>
                </td>
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
                            <input class="form-check-input" type="radio" name="dewasa-satu" value="Tidak" checked id="defaultCheck3" />
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
                            <input class="form-check-input" type="radio" name="dewasa-satu" value="15 Kg" id="defaultCheck3" />
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
                            <input class="form-check-input" type="radio" name="dewasa-dua" checked value="0" id="defaultCheck3" />
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
                        <td class="text-center">Total</td>
                        <td><input type="number" class="form-control form-control-sm" id="" placeholder="" /></td>
                        </tr>
                    </tbody>
                    </table>
                </td>
                </tr>
                <tr>
                <td class="text-center">Bila skor : 4-5 dilakukan pengkajian lebih lanjut oleh dietisen</td>
                <td class="text-center">Bila skor MST ≥2 dilakukan pengkajian lebih lanjut oleh dietisen</td>
                </tr>
            </tbody>
            </table>
          </div>
          <div class="tab-pane fade {{ (session('dokter') == 'Diagnosis Keperawartan') ? 'show active' : '' }}" id="navs-pills-justified-diagnosiskeperawatan" role="tabpanel">
            <h6 class="text-center bg-dark text-white py-2">DIAGNOSIS KEPERAWATAN</h6>
                <div class="row mb-3">
                <div class="col-sm-3 form-check mx-4">
                    <input class="form-check-input" type="checkbox" name="diagnosis-keperawatan[]" value="Ansietas" id="defaultCheck1" />
                    <label class="form-check-label" for="defaultCheck1">
                    Ansietas
                    </label>
                </div>
                <div class="col-sm-1">
                    <p class="m-0 fw-bold">b.d.</p>
                </div>
                <div class="col-sm-7">
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Kurang rerpapar informasi" name="ansietas[]" id="defaultCheck2" />
                    <label class="form-check-label" for="defaultCheck2">
                        Kurang rerpapar informasi
                    </label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Kurang mengalami kegagalan" name="ansietas[]" id="defaultCheck2" />
                    <label class="form-check-label" for="defaultCheck2">
                        Kurang mengalami kegagalan
                    </label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Ancaman terhadap konsep diri" name="ansietas[]" id="defaultCheck2" />
                    <label class="form-check-label" for="defaultCheck2">
                        Ancaman terhadap konsep diri
                    </label>
                    </div>
                </div>
                <div class="col-sm-3 form-check mx-4">
                    <input class="form-check-input" type="checkbox" value="Nyeri Akut" name="diagnosis-keperawatan[]" id="defaultCheck1" />
                    <label class="form-check-label" for="defaultCheck1">
                    Nyeri Akut
                    </label>
                </div>
                <div class="col-sm-1">
                    <p class="m-0 fw-bold">b.d.</p>
                </div>
                <div class="col-sm-7">
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Agen pencedera fisiologis *(Inflamasi/Iskemia/Neoplasma)" name="nyeri-akut[]" id="defaultCheck2" />
                    <label class="form-check-label" for="defaultCheck2">
                        Agen pencedera fisiologis *(Inflamasi/Iskemia/Neoplasma)
                    </label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Agen pencedera fisik" name="nyeri-akut[]" id="defaultCheck2" />
                    <label class="form-check-label" for="defaultCheck2">
                        Agen pencedera fisik *(Abses/Amputasi/Terpotong/Trauma/Fraktur/ Prosedur Operasi/Latihan Fisik berlebihan/Mengangkat Berat)
                    </label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Agen pencedera kimia" name="nyeri-akut[]" id="defaultCheck2" />
                    <label class="form-check-label" for="defaultCheck2">
                        Agen pencedera kimia *(terbakar/bahan kimia iritan)
                    </label>
                    </div>
                </div>
                <div class="col-sm-3 form-check mx-4">
                    <input class="form-check-input" type="checkbox" value="Nyeri Kronis" name="diagnosis-keperawatan[]" id="defaultCheck1" />
                    <label class="form-check-label" for="defaultCheck1">
                    Nyeri Kronis
                    </label>
                </div>
                <div class="col-sm-1">
                    <p class="m-0 fw-bold">b.d.</p>
                </div>
                <div class="col-sm-7">
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Agen pencedera fisiologis *(Inflamasi/Iskemia/Neoplasma)" name="nyeri-kronis[]" id="defaultCheck2" />
                    <label class="form-check-label" for="defaultCheck2">
                        Agen pencedera fisiologis *(Inflamasi/Iskemia/Neoplasma)
                    </label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Agen pencedera fisik" name="nyeri-kronis[]" id="defaultCheck2" />
                    <label class="form-check-label" for="defaultCheck2">
                        Agen pencedera fisik *(Abses/Amputasi/Terpotong/Trauma/Fraktur/ Prosedur Operasi/Latihan Fisik berlebihan/Mengangkat Berat)
                    </label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Agen pencedera kimia" name="nyeri-kronis[]" id="defaultCheck2" />
                    <label class="form-check-label" for="defaultCheck2">
                        Agen pencedera kimia *(terbakar/bahan kimia iritan)
                    </label>
                    </div>
                </div>
                <div class="col-sm-3 form-check mx-4">
                    <input class="form-check-input" type="checkbox" value="Gangguan Mobilitas Fisik" name="diagnosis-keperawatan[]" id="defaultCheck1" />
                    <label class="form-check-label" for="defaultCheck1">
                    Gangguan Mobilitas Fisik
                    </label>
                </div>
                <div class="col-sm-1">
                    <p class="m-0 fw-bold">b.d.</p>
                </div>
                <div class="col-sm-7">
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Kerusakan Struktur Tulang" name="gangguan-mobilitas-fisik[]" id="defaultCheck2" />
                    <label class="form-check-label" for="defaultCheck2">
                        Kerusakan Struktur Tulang
                    </label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Kontraktur" name="gangguan-mobilitas-fisik[]" id="defaultCheck2" />
                    <label class="form-check-label" for="defaultCheck2">
                        Kontraktur
                    </label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Penurunan kekuatan otot" name="gangguan-mobilitas-fisik[]" id="defaultCheck2" />
                    <label class="form-check-label" for="defaultCheck2">
                        Penurunan kekuatan otot
                    </label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Kekakuan Sendi" name="gangguan-mobilitas-fisik[]" id="defaultCheck2" />
                    <label class="form-check-label" for="defaultCheck2">
                        Kekakuan Sendi
                    </label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Program Pembatasan Gerak" name="gangguan-mobilitas-fisik[]" id="defaultCheck2" />
                    <label class="form-check-label" for="defaultCheck2">
                        Program Pembatasan Gerak
                    </label>
                    </div>
                </div>
                <div class="col-sm-3 form-check mx-4">
                    <input class="form-check-input" type="checkbox" value="Gangguan Integritas Kulit / Jaringan" name="diagnosis-keperawatan[]" id="defaultCheck1" />
                    <label class="form-check-label" for="defaultCheck1">
                    Gangguan Integritas Kulit / Jaringan
                    </label>
                </div>
                <div class="col-sm-1">
                    <p class="m-0 fw-bold">b.d.</p>
                </div>
                <div class="col-sm-7">
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Faktor Mekanis" name="gangguan-integritas-kulit[]" id="defaultCheck2" />
                    <label class="form-check-label" for="defaultCheck2">
                        Faktor Mekanis *(Penekanan pada Tonjolan Tulang/Luka Operasi)
                    </label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Faktor elektris" name="gangguan-integritas-kulit[]" id="defaultCheck2" />
                    <label class="form-check-label" for="defaultCheck2">
                        Faktor elektris (energi listrik tinggi)
                    </label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Perubahan Sirkulasi" name="gangguan-integritas-kulit[]" id="defaultCheck2" />
                    <label class="form-check-label" for="defaultCheck2">
                        Perubahan Sirkulasi
                    </label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Efek Samping Terapi Radiasi" name="gangguan-integritas-kulit[]" id="defaultCheck2" />
                    <label class="form-check-label" for="defaultCheck2">
                        Efek Samping Terapi Radiasi
                    </label>
                    </div>
                </div>
                <div class="col-sm-3 form-check mx-4">
                    <input class="form-check-input" type="checkbox" value="Retensi Urine" name="diagnosis-keperawatan[]" id="defaultCheck1" />
                    <label class="form-check-label" for="defaultCheck1">
                    Retensi Urine
                    </label>
                </div>
                <div class="col-sm-1">
                    <p class="m-0 fw-bold">b.d.</p>
                </div>
                <div class="col-sm-7">
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Peningkatan Tekanan Uretra" name="retensi-urine[]" id="defaultCheck2" />
                    <label class="form-check-label" for="defaultCheck2">
                        Peningkatan Tekanan Uretra
                    </label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Disfungsi Neurologis" name="retensi-urine[]" id="defaultCheck2" />
                    <label class="form-check-label" for="defaultCheck2">
                        Disfungsi Neurologis *(Trauma / Penyakit Syaraf)
                    </label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Efek Agen Farmakologis" name="retensi-urine[]" id="defaultCheck2" />
                    <label class="form-check-label" for="defaultCheck2">
                        Efek Agen Farmakologis
                    </label>
                    </div>
                </div>
                <div class="col-sm-3 form-check">
                    <div class="d-flex align-items-center">
                    <label class="form-control-label col-sm-4" for="lainnya">Lainnya</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" />
                    </div>
                    </div>
                </div>
                <div class="col-sm-1 mx-4">
                    <p class="fw-bold mx-4">b.d.</p>
                </div>
                <div class="col-sm-4">
                    <div id="input-container1" class="row">
                        <input class="form-control form-control-sm mx-3" style="max-width: 300px" name="lainnya[]" type="text" aria-label=".form-control-sm example">
                        <a class="btn btn-sm btn-dark text-white" style="max-width: 40px" onclick="addInput('input-container1')">+</a>
                    </div>
                </div>
                </div>
                <h6 class="text-center bg-dark text-white py-2">MASALAH KEPERAWATAN</h6>
                <div class="row mb-3">
                <div class="col-sm-4 ">
                    <div class="mx-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Ansietas" name="masalah-keperawatan[]" id="defaultCheck1" />
                        <label class="form-check-label" for="defaultCheck1">
                        Ansietas
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Nyeri Akut / Kronis" name="masalah-keperawatan[]" id="defaultCheck2" />
                        <label class="form-check-label" for="defaultCheck2">
                        Nyeri Akut / Kronis
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Retensi Urine" name="masalah-keperawatan[]" id="defaultCheck3" />
                        <label class="form-check-label" for="defaultCheck3">
                        Retensi Urine
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Gangguan Mobilitas Fisik" name="masalah-keperawatan[]" id="defaultCheck4" />
                        <label class="form-check-label" for="defaultCheck4">
                        Gangguan Mobilitas Fisik
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Gangguan Integritas Kulit" name="masalah-keperawatan[]" id="defaultCheck5" />
                        <label class="form-check-label" for="defaultCheck5">
                        Gangguan Integritas Kulit
                        </label>
                    </div>

                    <div class="row">
                        <label class="form-control-label col-sm-12" for="lainya">Lainnya</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" />
                        </div>
                        <div class="col-sm-2">
                        <button class="btn btn-dark btn-sm">+</button>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
          </div>
          <div class="tab-pane fade {{ (session('dokter') == 'Rencana Asuhan') ? 'show active' : '' }}" id="navs-pills-justified-rencanaasuhan" role="tabpanel">
            <h6 class="text-center bg-dark text-white py-2">RENCANA ASUHAN</h6>
            <div class="row mb-3">
            <div class="col-sm-4 ">
                <div class="mx-2">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Reduksi Ansietas" name="rencana-asuhan[]" id="defaultCheck1" />
                    <label class="form-check-label" for="defaultCheck1">
                    Reduksi Ansietas
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Manajemen Nyeri" name="rencana-asuhan[]" id="defaultCheck2" />
                    <label class="form-check-label" for="defaultCheck2">
                    Manajemen Nyeri
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Dukungan Mobilitas" name="rencana-asuhan[]" id="defaultCheck3" />
                    <label class="form-check-label" for="defaultCheck3">
                    Dukungan Mobilitas
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Perawatan Luka" name="rencana-asuhan[]" id="defaultCheck4" />
                    <label class="form-check-label" for="defaultCheck4">
                    Perawatan Luka
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Perawatan Retensi Urine" name="rencana-asuhan[]" id="defaultCheck5" />
                    <label class="form-check-label" for="defaultCheck5">
                    Perawatan Retensi Urine
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Perawatan Kateter Urine" name="rencana-asuhan[]" id="defaultCheck6" />
                    <label class="form-check-label" for="defaultCheck6">
                    Perawatan Kateter Urine
                    </label>
                </div>

                <div class="row">
                    <label class="form-control-label col-sm-12" for="lainya">Lainnya</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control form-control-sm" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" />
                    </div>
                    <div class="col-sm-2">
                    <button class="btn btn-dark btn-sm">+</button>
                    </div>
                </div>
                </div>
            </div>
            </div>
          </div>

        </div>
      </div>
      {{-- /tambahan nav-tab --}}
    </div>

  </div>


@endsection
