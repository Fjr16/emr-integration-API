@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif
  <div class="card mb-4">
    <div class="card-header m-0">
        <h5 class="mb-0 m-0">Asesmen Perawat</h5>
    </div>
    <div class="card-body">
        <h6 class="text-center bg-dark text-white py-2">STATUS FISIK</h6>
        <div class="row mb-3">
          <div class="col-sm-4 ">
            <p class="fw-bold m-0">Kondisi Umum :</p>
            <div class="mb-3 mx-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="baik" id="defaultCheck1" />
                <label class="form-check-label" for="defaultCheck1">
                  Baik
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="tampak sakit" id="defaultCheck2" />
                <label class="form-check-label" for="defaultCheck2">
                  Tampak Sakit
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="sesak" id="defaultCheck3" />
                <label class="form-check-label" for="defaultCheck3">
                  Sesak
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="pucat" id="defaultCheck4" />
                <label class="form-check-label" for="defaultCheck4">
                  Pucat
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="lemah" id="defaultCheck5" />
                <label class="form-check-label" for="defaultCheck5">
                  Lemah
                </label>
              </div>
              <div class="row mb-3">
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
          <div class="col-sm-4 ">
            <p class="fw-bold m-0">Kebutuhan Khusus :</p>
            <div class="mb-3 mx-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="tidak" id="defaultCheck1" />
                <label class="form-check-label" for="defaultCheck1">
                  Tidak
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="ada" id="defaultCheck2" />
                <label class="form-check-label" for="defaultCheck2">
                  Ada
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="tongkat" id="defaultCheck3" />
                <label class="form-check-label" for="defaultCheck3">
                  Tongkat
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="kacamata" id="defaultCheck4" />
                <label class="form-check-label" for="defaultCheck4">
                  Kacamata
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="gigi palsu" id="defaultCheck5" />
                <label class="form-check-label" for="defaultCheck5">
                  Gigi Palsu
                </label>
              </div>
              <div class="row mb-3">
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
          <div class="col-sm-4 ">
            <p class="fw-bold m-0">Kesadaran :</p>
            <div class="mb-3 mx-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="komposmentis" id="defaultCheck1" />
                <label class="form-check-label" for="defaultCheck1">
                  Komposmentis
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="delirium" id="defaultCheck2" />
                <label class="form-check-label" for="defaultCheck2">
                  Delirium
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="somnolen" id="defaultCheck3" />
                <label class="form-check-label" for="defaultCheck3">
                  Somnolen
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="soporokoma" id="defaultCheck4" />
                <label class="form-check-label" for="defaultCheck4">
                  Soporokoma
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="koma" id="defaultCheck5" />
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
                <input type="text" class="form-control form-control-sm" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" />
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
                <input type="text" class="form-control form-control-sm" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" />
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
                <input type="text" class="form-control form-control-sm" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" />
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
                <input type="text" class="form-control form-control-sm" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" />
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
                <input type="text" class="form-control form-control-sm" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" />
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
                <input type="text" class="form-control form-control-sm" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" />
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
                <input class="form-check-input" type="checkbox" value="stabil/tenang" id="defaultCheck1" />
                <label class="form-check-label" for="defaultCheck1">
                  Stabil/Tenang
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="cemas/takut" id="defaultCheck2" />
                <label class="form-check-label" for="defaultCheck2">
                  Cemas/Takut
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="marah" id="defaultCheck3" />
                <label class="form-check-label" for="defaultCheck3">
                  Marah
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="kecendrungan bunuh diri" id="defaultCheck4" />
                <label class="form-check-label" for="defaultCheck4">
                  Kecendrungan Bunuh Diri
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="gelisah" id="defaultCheck5" />
                <label class="form-check-label" for="defaultCheck5">
                  Gelisah
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="hiperaktif" id="defaultCheck6" />
                <label class="form-check-label" for="defaultCheck6">
                  Hiperaktif
                </label>
              </div>
              <div class="row mb-3">
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
          <div class="col-sm-8 ">
            <p class="fw-bold m-0">Sosial :</p>
            <div class="mb-3">
              <ol>
                <li class="mt-1">
                  <p class="m-0 d-flex">Pasien tinggal dirumah dengan siapa 
                  <span class="mx-2"><input type="text" class="form-control form-control-sm" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" /></span>
                  </p>
                </li>
                <li class="mt-1">
                  <div class="row">
                    <div class="col-sm-auto">
                      Interaksi dengan lingkungan sekitar 
                    </div>
                    <div class="col-sm-2">
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="baik " />
                        <label class="form-check-label" for="inlineCheckbox1">Baik</label>
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="tidak baik" />
                        <label class="form-check-label" for="inlineCheckbox2">Tidak Baik</label>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="mt-1">
                  <p class="m-0 d-flex">Datang kerumah sakit dengan siapa
                    <span class="mx-2"><input type="text" class="form-control form-control-sm" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" /></span>
                    Hubungan
                    <span class="mx-2"><input type="text" class="form-control form-control-sm" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" /></span>
                  </p>
                </li>
                <li class="mt-1">
                  <p class="m-0">Kerabat terdekat yang bisa dihubungi : <br> 
                    <div class="d-flex">
                    Nama
                    <span class="mx-2"><input type="text" class="form-control form-control-sm" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" /></span>
                    Hubungan
                    <span class="mx-2"><input type="text" class="form-control form-control-sm" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" /></span>
                    Telepon
                    <span class="mx-2"><input type="text" class="form-control form-control-sm" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" /></span>
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
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="ada" />
                        <label class="form-check-label d-flex" for="inlineCheckbox2">
                          Ada, sebutkan
                          <span class="mx-2"><input type="text" class="form-control form-control-sm" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" /></span>
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
                <input class="form-check-input" type="checkbox" value="sehat" id="defaultCheck1" />
                <label class="form-check-label" for="defaultCheck1">
                  <p class="m-0 d-flex">Sehat
                    <span class="mx-2"><input type="text" class="form-control form-control-sm" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" /></span>
                  </p>
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="sakit" id="defaultCheck2" />
                <label class="form-check-label" for="defaultCheck2">
                  <p class="m-0 d-flex">Sakit
                    <span class="mx-2"><input type="text" class="form-control form-control-sm" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" /></span>
                  </p>
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="hambatan spiritual" id="defaultCheck3" />
                <label class="form-check-label" for="defaultCheck3">
                  <p class="m-0 d-flex">Hambatan Spiritual
                    <span class="mx-2"><input type="text" class="form-control form-control-sm" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" /></span>
                  </p>
                </label>
              </div>
              <div class="row">
                <div class="col-sm-auto">
                  Kultural / Nilai Kepercayaan :  
                </div>
                <div class="col-sm-auto">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="tidak ada" />
                    <label class="form-check-label" for="inlineCheckbox1">Tidak Ada</label>
                  </div>
                </div>
                <div class="col-sm-auto">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="ada" />
                    <label class="form-check-label d-flex" for="inlineCheckbox2">
                      Ada, sebutkan
                      <span class="mx-2"><input type="text" class="form-control form-control-sm" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" /></span>
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
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="tidak" />
                    <label class="form-check-label" for="inlineCheckbox1">Tidak</label>
                  </div>
                </div>
                <div class="col-sm-auto">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="ya" />
                    <label class="form-check-label d-flex" for="inlineCheckbox2">
                      Ya
                      <span class="mx-2"><input type="text" class="form-control form-control-sm" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" /></span>
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
                  <select class="form-control form-control-sm select2" id="" name="" onchange="getPatient()">
                    <option value="" selected>Pilih</option>
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
                  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="tidak" />
                  <label class="form-check-label" for="inlineCheckbox1">Tidak</label>
                </div>
              </div>
              <div class="col-sm-auto">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="ada" />
                  <label class="form-check-label d-flex" for="inlineCheckbox2">
                    Ada, sebutkan
                    <span class="mx-2"><input type="text" class="form-control form-control-sm" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" /></span>
                  </label>
                </div>
              </div>
            </div>
          </div>
        </div>

        <h6 class="text-center bg-dark text-white py-2">RIWAYAT ALERGI</h6>
        <div class="mb-3">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="tidak ada" id="defaultCheck1" />
            <label class="form-check-label" for="defaultCheck1">
              Tidak Ada
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="tidak diketahui" id="defaultCheck2" />
            <label class="form-check-label" for="defaultCheck2">
              Tidak Diketahui
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="ada" id="defaultCheck3" />
            <label class="form-check-label" for="defaultCheck3">
              Ada
            </label>
          </div>
          <div class="row">
            <div class="col-sm-1">
              <p class="m-0">Alergi</p>
            </div>
            <div class="col-sm-4">
              <input type="text" class="form-control form-control-sm" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" />
            </div>
            <div class="col-sm-1">
              <p class="m-0">Reaksi</p>
            </div>
            <div class="col-sm-4">
              <input type="text" class="form-control form-control-sm" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" />
            </div>
            <div class="col-sm-2">
              <button class="btn btn-dark btn-sm">+</button>
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
                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="tidak" />
                <label class="form-check-label" for="inlineCheckbox1">Tidak</label>
              </div>
            </div>
            <div class="col-sm-auto">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="ya" />
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
                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="akut" />
                <label class="form-check-label" for="inlineCheckbox1">Akut</label>
              </div>
            </div>
            <div class="col-sm-auto">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="kronis" />
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
                        <input type="text" class="form-control " id="lainnya" placeholder="" aria-describedby="floatingInputHelp" />
                      </td>
                    </tr>
                    <tr>
                      <td>Quality (Karakteristik)</td>
                      <td>:</td>
                      <td>
                        <input type="text" class="form-control " id="lainnya" placeholder="" aria-describedby="floatingInputHelp" />
                      </td>
                    </tr>
                    <tr>
                      <td>Region (Lokasi/Penjalaran)</td>
                      <td>:</td>
                      <td>
                        <input type="text" class="form-control " id="lainnya" placeholder="" aria-describedby="floatingInputHelp" />
                      </td>
                    </tr>
                    <tr>
                      <td>Severity (Keparahan)</td>
                      <td>:</td>
                      <td>
                        <input type="text" class="form-control " id="lainnya" placeholder="" aria-describedby="floatingInputHelp" />
                      </td>
                    </tr>
                    <tr>
                      <td>Time (Durasi dan Frekuensi)</td>
                      <td>:</td>
                      <td>
                        <input type="text" class="form-control " id="lainnya" placeholder="" aria-describedby="floatingInputHelp" />
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
                  <input class="form-check-input" type="checkbox" value="minum obat" id="defaultCheck1" />
                  <label class="form-check-label" for="defaultCheck1">
                    Minum Obat
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="istirahat" id="defaultCheck2" />
                  <label class="form-check-label" for="defaultCheck2">
                    Istirahat
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="mendengar musik" id="defaultCheck3" />
                  <label class="form-check-label" for="defaultCheck3">
                    Mendengar Musik
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="berubah posisi tidur" id="defaultCheck4" />
                  <label class="form-check-label" for="defaultCheck4">
                    Berubah Posisi Tidur
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
              <td class="text-center"></td>
              <td class="text-center"></td>
            </tr>
            <tr>
              <td colspan="2">b. Apakah pasien memegang pinggiran kursi atau meja atau benda lain sebagai penopang saat akan duduk?</td>
              <td class="text-center"></td>
              <td class="text-center"></td>
            </tr>
            <tr>
              <td style="width: 500px">
                <p class="m-0">Kategori :</p>
                <div class="mx-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="tidak berisiko" id="defaultCheck1" />
                    <label class="form-check-label" for="defaultCheck1">
                      Tidak berisiko (tidak ditemukan a dan b)
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="resiko rendah" id="defaultCheck2" />
                    <label class="form-check-label" for="defaultCheck2">
                      Resiko Rendah (ditemukan a atau b)
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="resiko tinggi" id="defaultCheck3" />
                    <label class="form-check-label" for="defaultCheck3">
                      Resiko Tinggi (ditemukan a atau b)
                    </label>
                  </div>
                </div>
              </td>
              <td colspan="3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="tidak ada tindakan" id="defaultCheck1" />
                  <label class="form-check-label" for="defaultCheck1">
                    Tidak ada tindakan
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="Bila resiko rendah ; pasien diberi edukasi pencegahan resiko jatuh" id="defaultCheck2" />
                  <label class="form-check-label" for="defaultCheck2">
                    Bila resiko rendah ; pasien diberi edukasi pencegahan resiko jatuh
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="Bila resiko tinggi ; pasien dipasan kalung resiko jatuh warna kuning dan diberi edukasi pencegahan resiko jatuh" id="defaultCheck3" />
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
              <td></td>
            </tr>
            <tr>
              <td>2</td>
              <td>Aktifitas/Toilet</td>
              <td>5</td>
              <td>10</td>
              <td></td>
            </tr>
            <tr>
              <td>3</td>
              <td>Berpindah dari kursi roda ke tempat</td>
              <td>5-10</td>
              <td>15</td>
              <td></td>
            </tr>
            <tr>
              <td>4</td>
              <td>Kebersihan diri, mencuci muka, menyisir rambut, menggosok gigi</td>
              <td>0</td>
              <td>5</td>
              <td></td>
            </tr>
            <tr>
              <td>5</td>
              <td>Mandi</td>
              <td>0</td>
              <td>5</td>
              <td></td>
            </tr>
            <tr>
              <td>6</td>
              <td>Berjalan di permukaan datar</td>
              <td>5-10</td>
              <td>15</td>
              <td></td>
            </tr>
            <tr>
              <td>7</td>
              <td>Naik Turun Tangga</td>
              <td>5</td>
              <td>10</td>
              <td></td>
            </tr>
            <tr>
              <td>8</td>
              <td>Berpakaian</td>
              <td>5</td>
              <td>10</td>
              <td></td>
            </tr>
            <tr>
              <td>9</td>
              <td>Mengontrol defekasi</td>
              <td>5</td>
              <td>10</td>
              <td></td>
            </tr>
            <tr>
              <td>10</td>
              <td>Mengontrol berkemih</td>
              <td>5</td>
              <td>10</td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td colspan="4">Total</td>
              <td></td>
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
                          <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                          <label class="form-check-label" for="defaultCheck1">
                            Ya
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="defaultCheck2" />
                          <label class="form-check-label" for="defaultCheck2">
                            Tidak
                          </label>
                        </div>
                      </td>
                      <td class="fw-bold">1 <br> 0</td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>Apakah terdapat penurunan BB selama 1 bulan terakhir? Berdasarkan penilaian objectif</td>
                      <td>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                          <label class="form-check-label" for="defaultCheck1">
                            Ya
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="defaultCheck2" />
                          <label class="form-check-label" for="defaultCheck2">
                            Tidak
                          </label>
                        </div>
                      </td>
                      <td class="fw-bold">1 <br> 0</td>
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
                          <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                          <label class="form-check-label" for="defaultCheck1">
                            Ya
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="defaultCheck2" />
                          <label class="form-check-label" for="defaultCheck2">
                            Tidak
                          </label>
                        </div>
                      </td>
                      <td class="fw-bold">1 <br> 0</td>
                    </tr>
                    <tr>
                      <td>4</td>
                      <td>Apakah terdapat penyakit atau keadaan yang mangakibatkan pasien beresiko malnutrisi dan sudah malnutrisi (Gizi buruk)?</td>
                      <td>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                          <label class="form-check-label" for="defaultCheck1">
                            Ya
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="defaultCheck2" />
                          <label class="form-check-label" for="defaultCheck2">
                            Tidak
                          </label>
                        </div>
                      </td>
                      <td class="fw-bold">1 <br> 0</td>
                    </tr>
                    <tr>
                      <td></td>
                      <td colspan="2" class="text-center">Total</td>
                      <td></td>
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
                      <td class="fw-bold">0</td>
                    </tr>
                    <tr>
                      <td><li>Tidak yakin (tanda-tanda : baju menjadi longgar)</li></td>
                      <td class="fw-bold">2</td>
                    </tr>
                    <tr>
                      <td><li>Ya, ada penurunan BB sebanyak :</li></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>
                        <span class="mx-4">1-5 Kg</span>
                      </td>
                      <td class="fw-bold">1</td>
                    </tr>
                    <tr>
                      <td>
                        <span class="mx-4">6-10 Kg</span>
                      </td>
                      <td class="fw-bold">2</td>
                    </tr>
                    <tr>
                      <td>
                        <span class="mx-4">11-15 Kg</span>
                      </td>
                      <td class="fw-bold">3</td>
                    </tr>
                    <tr>
                      <td>
                        <span class="mx-4">>15 Kg</span>
                      </td>
                      <td class="fw-bold">4</td>
                    <tr>
                      <td>
                        <span class="mx-4">Tidak tahu berapa kg penurunan</span>
                      </td>
                      <td class="fw-bold">2</td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>Apakah asupan makanan pasien berkurang karena penurunan nafsu makan/kesulitan menerima makanan
                        <ul>
                          <li>Tidak</li>
                          <li>Ya</li>
                        </ul>
                      </td>
                      <td class="fw-bold">0 <br> 1</td>
                    </tr>
                    <tr>
                      <td></td>
                      <td class="text-center">Total</td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
              </td>
            </tr>
            <tr>
              <td class="text-center">Bila skor : dilakukan pengkajian lebih lanjut oleh dietisen</td>
              <td class="text-center">Bila skor MST ≥2 dilakukan pengkajian lebih lanjut oleh dietisen</td>
            </tr>
          </tbody>
        </table>


        <h6 class="text-center bg-dark text-white py-2">DIAGNOSIS KEPERAWATAN</h6>
        <div class="row mb-3">
          
          <div class="col-sm-3 form-check mx-4">
            <input class="form-check-input" type="checkbox" value="nyeri akut/kronis" id="defaultCheck1" />
            <label class="form-check-label" for="defaultCheck1">
              *) Nyeri Akut / Kronis
            </label>
          </div>
          <div class="col-sm-1">
            <p class="m-0 fw-bold">b.d.</p>
          </div>
          <div class="col-sm-7">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="Agen pencedera fisiologis *(Inflamasi/Iskemia/Neoplasma)" id="defaultCheck2" />
              <label class="form-check-label" for="defaultCheck2">
                Agen pencedera fisiologis *(Inflamasi/Iskemia/Neoplasma)
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="Agen pencedera fisik *(Abses/Amputasi/Terpotong/Trauma/Fraktur/ Prosedur Operasi/Latihan Fisik berlebihan/Mengangkat Berat)" id="defaultCheck2" />
              <label class="form-check-label" for="defaultCheck2">
                Agen pencedera fisik *(Abses/Amputasi/Terpotong/Trauma/Fraktur/ Prosedur Operasi/Latihan Fisik berlebihan/Mengangkat Berat)
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="Agen pencedera kimia *(terbakar/bahan kimia iritan)" id="defaultCheck2" />
              <label class="form-check-label" for="defaultCheck2">
                Agen pencedera kimia *(terbakar/bahan kimia iritan)
              </label>
            </div>
          </div>
          <div class="col-sm-3 form-check mx-4">
            <input class="form-check-input" type="checkbox" value="Gangguan Mobilitas Fisik" id="defaultCheck1" />
            <label class="form-check-label" for="defaultCheck1">
              Gangguan Mobilitas Fisik
            </label>
          </div>
          <div class="col-sm-1">
            <p class="m-0 fw-bold">b.d.</p>
          </div>
          <div class="col-sm-7">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="Kerusakan Struktur Tulang" id="defaultCheck2" />
              <label class="form-check-label" for="defaultCheck2">
                Kerusakan Struktur Tulang
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="Kontraktur" id="defaultCheck2" />
              <label class="form-check-label" for="defaultCheck2">
                Kontraktur
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="Penurunan kekuatan otot" id="defaultCheck2" />
              <label class="form-check-label" for="defaultCheck2">
                Penurunan kekuatan otot
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="Kekakuan Sendi" id="defaultCheck2" />
              <label class="form-check-label" for="defaultCheck2">
                Kekakuan Sendi
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="Program Pembatasan Gerak" id="defaultCheck2" />
              <label class="form-check-label" for="defaultCheck2">
                Program Pembatasan Gerak
              </label>
            </div>
          </div>
          <div class="col-sm-3 form-check mx-4">
            <input class="form-check-input" type="checkbox" value="Gangguan Integritas Kulit / Jaringan" id="defaultCheck1" />
            <label class="form-check-label" for="defaultCheck1">
              Gangguan Integritas Kulit / Jaringan
            </label>
          </div>
          <div class="col-sm-1">
            <p class="m-0 fw-bold">b.d.</p>
          </div>
          <div class="col-sm-7">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="Faktor Mekanis *(Penekanan pada Tonjolan Tulang/Luka Operasi)" id="defaultCheck2" />
              <label class="form-check-label" for="defaultCheck2">
                Faktor Mekanis *(Penekanan pada Tonjolan Tulang/Luka Operasi)
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="Faktor elektris (energi listrik tinggi)" id="defaultCheck2" />
              <label class="form-check-label" for="defaultCheck2">
                Faktor elektris (energi listrik tinggi)
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="Perubahan Sirkulasi" id="defaultCheck2" />
              <label class="form-check-label" for="defaultCheck2">
                Perubahan Sirkulasi
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="Efek Samping Terapi Radiasi" id="defaultCheck2" />
              <label class="form-check-label" for="defaultCheck2">
                Efek Samping Terapi Radiasi
              </label>
            </div>
          </div>
          <div class="col-sm-3 form-check mx-4">
            <input class="form-check-input" type="checkbox" value="Retensi Urine" id="defaultCheck1" />
            <label class="form-check-label" for="defaultCheck1">
              Retensi Urine
            </label>
          </div>
          <div class="col-sm-1">
            <p class="m-0 fw-bold">b.d.</p>
          </div>
          <div class="col-sm-7">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="Peningkatan Tekanan Uretra" id="defaultCheck2" />
              <label class="form-check-label" for="defaultCheck2">
                Peningkatan Tekanan Uretra
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="Disfungsi Neurologis *(Trauma / Penyakit Syaraf)" id="defaultCheck2" />
              <label class="form-check-label" for="defaultCheck2">
                Disfungsi Neurologis *(Trauma / Penyakit Syaraf)
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="Efek Agen Farmakologis" id="defaultCheck2" />
              <label class="form-check-label" for="defaultCheck2">
                Efek Agen Farmakologis
              </label>
            </div>
          </div>  
          <div class="col-sm-3 form-check mx-4">
            <input class="form-check-input" type="checkbox" value="Bersihan Jalan Napas Tidak Efektif" id="defaultCheck1" />
            <label class="form-check-label" for="defaultCheck1">
              Bersihan Jalan Napas Tidak Efektif
            </label>
          </div>
          <div class="col-sm-1">
            <p class="m-0 fw-bold">b.d.</p>
          </div>
          <div class="col-sm-7">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="spasme jalan napas" id="defaultCheck2" />
              <label class="form-check-label" for="defaultCheck2">
                Spasme Jalan Napas
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="sekresi yang tertahan" id="defaultCheck2" />
              <label class="form-check-label" for="defaultCheck2">
                Sekresi yang tertahan
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="Benda asing dalam jalan napas" id="defaultCheck2" />
              <label class="form-check-label" for="defaultCheck2">
                Benda asing dalam jalan napas
              </label>
            </div>
          </div>
          <div class="col-sm-3 form-check mx-4">
            <input class="form-check-input" type="checkbox" value="Pola Napas Tidak Efektif" id="defaultCheck1" />
            <label class="form-check-label" for="defaultCheck1">
              Pola Napas Tidak Efektif
            </label>
          </div>
          <div class="col-sm-1">
            <p class="m-0 fw-bold">b.d.</p>
          </div>
          <div class="col-sm-7">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="Efek Agen Farmakologis" id="defaultCheck2" />
              <label class="form-check-label" for="defaultCheck2">
                Efek Agen Farmakologis
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="Hambatan Upaya Napas" id="defaultCheck2" />
              <label class="form-check-label" for="defaultCheck2">
                Hambatan Upaya Napas
              </label>
            </div>
          </div>
          <div class="col-sm-3 form-check mx-4">
            {{-- <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" /> --}}
            <label class="form-check-label" for="defaultCheck1">
              <div class="row">
                <div class="col-sm-10">
                  <input type="text" class="form-control form-control-sm" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" />
                </div>
                <div class="col-sm-2">
                  <button class="btn btn-dark btn-sm">+</button>
                </div>
              </div>
            </label>
          </div>
          <div class="col-sm-1">
            <p class="m-0 fw-bold">b.d.</p>
          </div>
          <div class="col-sm-7">
            <div class="form-check">
              <label class="form-check-label" for="defaultCheck2">
                <div class="row">
                  <div class="col-sm-10">
                    <input type="text" class="form-control form-control-sm" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" />
                  </div>
                  <div class="col-sm-2">
                    <button class="btn btn-dark btn-sm">+</button>
                  </div>
                </div>
              </label>
            </div>
          </div>

        </div>
        <h6 class="text-center bg-dark text-white py-2">MASALAH KEPERAWATAN</h6>
        <div class="row mb-3">
          <div class="col-sm-4 ">
            <div class="mx-2">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Nyeri Akut / Kronis" id="defaultCheck2" />
                <label class="form-check-label" for="defaultCheck2">
                  Nyeri Akut / Kronis
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Retensi Urine" id="defaultCheck3" />
                <label class="form-check-label" for="defaultCheck3">
                  Retensi Urine
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Gangguan Mobilitas Fisik" id="defaultCheck4" />
                <label class="form-check-label" for="defaultCheck4">
                  Gangguan Mobilitas Fisik
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Gangguan Integritas Kulit" id="defaultCheck5" />
                <label class="form-check-label" for="defaultCheck5">
                  Gangguan Integritas Kulit
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Bersihan Jalan Napas" id="defaultCheck1" />
                <label class="form-check-label" for="defaultCheck1">
                  Bersihan Jalan Napas
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Pola Napas Tidak Efektif" id="defaultCheck1" />
                <label class="form-check-label" for="defaultCheck1">
                  Pola Napas Tidak Efektif
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

        <h6 class="text-center bg-dark text-white py-2">RENCANA ASUHAN</h6>
        <div class="row mb-3">
          <div class="col-sm-4 ">
            <div class="mx-2">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Manajemen Nyeri" id="defaultCheck2" />
                <label class="form-check-label" for="defaultCheck2">
                  Manajemen Nyeri
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Dukungan Mobilitas" id="defaultCheck3" />
                <label class="form-check-label" for="defaultCheck3">
                  Dukungan Mobilitas
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Perawatan Luka" id="defaultCheck4" />
                <label class="form-check-label" for="defaultCheck4">
                  Perawatan Luka
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Perawatan Retensi Urine" id="defaultCheck5" />
                <label class="form-check-label" for="defaultCheck5">
                  Perawatan Retensi Urine
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Manajemen Jalan Napas" id="defaultCheck6" />
                <label class="form-check-label" for="defaultCheck6">
                  Manajemen Jalan Napas
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
        <div class="mb-3">
          
        </div>
    </div>
  </div>


@endsection