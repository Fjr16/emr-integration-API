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
            <h5 class="mb-0 m-0">Asesmen Perawat {{ $item->patient->no_rm }}</h5>
        </div>
        <div class="card-body">
            <h6 class="text-center bg-dark text-white py-2">STATUS FISIK</h6>
            <div class="row mb-3">
                <div class="col-sm-4 ">
                    <p class="fw-bold m-0">Kondisi Umum :</p>
                    <div class="mb-3 mx-3">
                        @foreach ($kondisiUmum as $umum)
                            @php
                                $isChecked = in_array(
                                    $umum,
                                    $item->statusFisikDiagnosaKeperawatanPatient->detailStatusFisikDiagnosaKeperawatanPatient
                                        ->where('category', 'Kondisi Umum')
                                        ->pluck('name')
                                        ->toArray(),
                                );
                            @endphp
                            <div class="form-check">
                                <input class="form-check-input disabled" type="checkbox" {{ $isChecked ? 'checked' : '' }}
                                    id="defaultCheck1" />
                                <label class="form-check-label" for="defaultCheck1">
                                    {{ $umum }}
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
                                $isChecked = in_array(
                                    $khusus,
                                    $item->statusFisikDiagnosaKeperawatanPatient->detailStatusFisikDiagnosaKeperawatanPatient
                                        ->where('category', 'Kebutuhan Khusus')
                                        ->pluck('name')
                                        ->toArray(),
                                );
                            @endphp
                            <div class="form-check">
                                <input class="form-check-input disabled" type="checkbox" {{ $isChecked ? 'checked' : '' }}
                                    id="defaultCheck1" />
                                <label class="form-check-label" for="defaultCheck1">
                                    {{ $khusus }}
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
                                $isChecked = in_array(
                                    $sadar,
                                    $item->statusFisikDiagnosaKeperawatanPatient->detailStatusFisikDiagnosaKeperawatanPatient
                                        ->where('category', 'Kesadaran')
                                        ->pluck('name')
                                        ->toArray(),
                                );
                            @endphp
                            <div class="form-check">
                                <input class="form-check-input disabled" type="checkbox" {{ $isChecked ? 'checked' : '' }}
                                    id="defaultCheck1" />
                                <label class="form-check-label" for="defaultCheck1">
                                    {{ $sadar }}
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
                            <input type="text" class="form-control form-control-sm" name="darah" disabled
                                id="lainnya" placeholder=""
                                value="{{ $item->statusFisikDiagnosaKeperawatanPatient->darah }}"
                                aria-describedby="floatingInputHelp" />
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
                            <input type="text" class="form-control form-control-sm" name="nadi" id="lainnya"
                                value="{{ $item->statusFisikDiagnosaKeperawatanPatient->nadi }}" disabled placeholder=""
                                aria-describedby="floatingInputHelp" />
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
                            <input type="text" class="form-control form-control-sm" name="suhu" id="lainnya"
                                value="{{ $item->statusFisikDiagnosaKeperawatanPatient->suhu }}" placeholder=""
                                aria-describedby="floatingInputHelp" />
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
                            <input type="text" class="form-control form-control-sm" name="pernafasan"
                                value="{{ $item->statusFisikDiagnosaKeperawatanPatient->pernafasan }}" id="lainnya"
                                placeholder="" aria-describedby="floatingInputHelp" />
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
                            <input type="text" class="form-control form-control-sm" id="lainnya" name="tb"
                                value="{{ $item->statusFisikDiagnosaKeperawatanPatient->tb }}" placeholder=""
                                aria-describedby="floatingInputHelp" />
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
                            <input type="text" class="form-control form-control-sm" id="lainnya" name="bb"
                                placeholder="" value="{{ $item->statusFisikDiagnosaKeperawatanPatient->bb }}"
                                aria-describedby="floatingInputHelp" />
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
                                $isChecked = in_array(
                                    $psiko,
                                    $item->psikoSosioSpritualDiagnosaKeperawatanPatient->detailPsikoSosioSpritualDiagnosaKeperawatanPatient
                                        ->where('category', 'psikologis')
                                        ->pluck('name')
                                        ->toArray(),
                                );
                            @endphp
                            <div class="form-check">
                                <input class="form-check-input disabled" type="checkbox"
                                    {{ $isChecked ? 'checked' : '' }} id="defaultCheck1" />
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
                            @foreach ($item->psikoSosioSpritualDiagnosaKeperawatanPatient->detailPsikoSosioSpritualDiagnosaKeperawatanPatient->where('category', 'sosial')->where('name', 'Pasien tinggal dirumah dengan siapa') as $detailPsiko)
                                <li class="mt-1">
                                    <p class="m-0 d-flex">Pasien tinggal dirumah dengan siapa
                                        <span class="mx-2"><input type="text" name="pasien"
                                                value="{{ $detailPsiko->value }}" class="form-control form-control-sm"
                                                id="lainnya" placeholder=""
                                                aria-describedby="floatingInputHelp" /></span>
                                    </p>
                                </li>
                            @endforeach
                            <li class="mt-1">
                                @foreach ($item->psikoSosioSpritualDiagnosaKeperawatanPatient->detailPsikoSosioSpritualDiagnosaKeperawatanPatient->where('category', 'sosial')->where('name', 'Interaksi dengan lingkungan sekitar') as $detailPsiko)
                                    <div class="row">
                                        <div class="col-sm-auto">
                                            Interaksi dengan lingkungan sekitar
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" name="interaksi" type="radio"
                                                    id="inlineCheckbox1"
                                                    {{ $detailPsiko->value == 'Baik' ? 'checked' : '' }} value="Baik" />
                                                <label class="form-check-label" for="inlineCheckbox1">Baik</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" name="interaksi" type="radio"
                                                    id="inlineCheckbox2"
                                                    {{ $detailPsiko->value == 'Baik' ? '' : 'checked' }}
                                                    value="Tidak Baik" />
                                                <label class="form-check-label" for="inlineCheckbox2">Tidak Baik</label>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </li>
                            <li class="mt-1">
                                @foreach ($item->psikoSosioSpritualDiagnosaKeperawatanPatient->detailPsikoSosioSpritualDiagnosaKeperawatanPatient->where('category', 'sosial')->where('name', 'Datang kerumah sakit dengan siapa') as $detailPsiko)
                                    <p class="m-0 d-flex">Datang kerumah sakit dengan siapa : {{ $detailPsiko->value }}
                                    </p>
                                @endforeach
                            </li>
                            <li class="mt-1">
                                @foreach ($item->psikoSosioSpritualDiagnosaKeperawatanPatient->detailPsikoSosioSpritualDiagnosaKeperawatanPatient->where('category', 'sosial')->where('name', 'Kerabat terdekat yang bisa dihubungi : ') as $detailPsiko)
                                    <p class="m-0">Kerabat terdekat yang bisa dihubungi : {{ $detailPsiko->value }}</p>
                                @endforeach
                                </p>
                            </li>
                            <li>
                                @foreach ($item->psikoSosioSpritualDiagnosaKeperawatanPatient->detailPsikoSosioSpritualDiagnosaKeperawatanPatient->where('category', 'sosial')->where('name', 'Hambatan Sosial') as $detailPsiko)
                                    <div class="row">
                                        <div class="col-sm-auto">
                                            Hambatan Sosial
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1"
                                                    {{ $detailPsiko->value == 'Tidak ada' ? 'checked' : '' }}
                                                    value="tidak ada" />
                                                <label class="form-check-label" for="inlineCheckbox1">Tidak Ada</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-auto">
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label d-flex" for="">
                                                    Ada, sebutkan
                                                    <span class="mx-2"><input type="text"
                                                            @if ($detailPsiko->value !== 'Tidak ada') value="{{ $detailPsiko->value }}" @endif
                                                            name="hambatan-sosial" class="form-control form-control-sm"
                                                            id="lainnya" placeholder=""
                                                            aria-describedby="floatingInputHelp" /></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="col-sm-12 ">
                    <p class="fw-bold m-0">Spiritual :</p>
                    <div class="mb-3 mx-3">
                        @foreach ($spritual as $sprit)
                            @php
                                $isChecked = in_array(
                                    $sprit,
                                    $item->psikoSosioSpritualDiagnosaKeperawatanPatient->detailPsikoSosioSpritualDiagnosaKeperawatanPatient
                                        ->where('category', 'spritual')
                                        ->pluck('name')
                                        ->toArray(),
                                );
                            @endphp
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" {{ $isChecked ? 'checked' : '' }}
                                    value="Sehat" name="sehat" id="defaultCheck1" />
                                <label class="form-check-label" for="defaultCheck1">
                                    <p class="m-0 d-flex">{{ $sprit }}
                                        <span class="mx-2"><input type="text" name="ket-sehat"
                                                class="form-control form-control-sm" id="lainnya" placeholder=""
                                                aria-describedby="floatingInputHelp" /></span>
                                    </p>
                                </label>
                            </div>
                        @endforeach
                        @foreach ($item->psikoSosioSpritualDiagnosaKeperawatanPatient->detailPsikoSosioSpritualDiagnosaKeperawatanPatient->where('category', 'spritual')->where('name', 'Kultular / Nilai kepercayaan') as $detailPsiko)
                            <div class="row">
                                <div class="col-sm-auto">
                                    Kultural / Nilai Kepercayaan :
                                </div>
                                <div class="col-sm-auto">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="nilai-kepercayaan"
                                            {{ $detailPsiko->value == 'Tidak ada' ? 'checked' : '' }} type="checkbox"
                                            id="inlineCheckbox1" value="Tidak Ada" />
                                        <label class="form-check-label" for="inlineCheckbox1">Tidak Ada</label>
                                    </div>
                                </div>
                                <div class="col-sm-auto">
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label d-flex" for="inlineCheckbox2">
                                            Ada, sebutkan
                                            <span class="mx-2"><input type="text"
                                                    class="form-control form-control-sm" id="lainnya"
                                                    @if ($detailPsiko->value !== 'Tidak ada') value="{{ $detailPsiko->value }}" @endif
                                                    placeholder="" name="ket-nilai-kepercayaan"
                                                    aria-describedby="floatingInputHelp" /></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @foreach ($item->psikoSosioSpritualDiagnosaKeperawatanPatient->detailPsikoSosioSpritualDiagnosaKeperawatanPatient->where('category', 'spritual')->where('name', 'Apakah pasien memerlukan pelayanan / bimbingan rohani') as $detailPsiko)
                            <div class="row">
                                <div class="col-sm-auto">
                                    Apakah pasien memerlukan pelayanan / bimbingan rohani ?
                                </div>
                                <div class="col-sm-auto">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="rohani[]"
                                            {{ $detailPsiko->value == 'Tidak ada' ? 'checked' : '' }} type="checkbox"
                                            id="inlineCheckbox1" value="Tidak" />
                                        <label class="form-check-label" for="inlineCheckbox1">Tidak</label>
                                    </div>
                                </div>
                                <div class="col-sm-auto">
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label d-flex" for="inlineCheckbox2">
                                            Ya
                                            <span class="mx-2"><input type="text" name="ket-rohani"
                                                    @if ($detailPsiko->value !== 'Tidak ada') value="{{ $detailPsiko->value }}" @endif
                                                    class="form-control form-control-sm" id="lainnya" placeholder=""
                                                    aria-describedby="floatingInputHelp" /></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
                                    <option value="PT" selected>{{ $item->ekonomiDiagnosaKeperawatanPatient->status }}
                                    </option>
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
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1"
                                    {{ $item->ekonomiDiagnosaKeperawatanPatient->hambatan == 'Tidak ada' ? 'checked' : '' }}
                                    value="Tidak" />
                                <label class="form-check-label" for="inlineCheckbox1">Tidak</label>
                            </div>
                        </div>
                        <div class="col-sm-auto">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label d-flex" for="inlineCheckbox2">
                                    Ada, sebutkan
                                    <span class="mx-2"><input type="text" name="ket-hambatan"
                                            @if ($item->ekonomiDiagnosaKeperawatanPatient->hambatan !== 'Tidak ada') value="{{ $item->ekonomiDiagnosaKeperawatanPatient->hambatan }}" @endif
                                            class="form-control form-control-sm" id="lainnya" placeholder=""
                                            aria-describedby="floatingInputHelp" /></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h6 class="text-center bg-dark text-white py-2">RIWAYAT ALERGI</h6>
            <div class="mb-3">
                @foreach ($item->riwayatAlergiDiagnosaKeperawatanPatient as $index => $riwayatAlergi)
                    @if ($loop->first)
                        <div class="form-check">
                            <input class="form-check-input" {{ $riwayatAlergi->status == 'Tidak ada' ? 'checked' : '' }}
                                type="radio" name="alergi" value="Tidak Ada" id="defaultCheck1" />
                            <label class="form-check-label" for="defaultCheck1">
                                Tidak Ada
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input"
                                {{ $riwayatAlergi->status == 'Tidak Diketahui' ? 'checked' : '' }} type="radio"
                                name="alergi" value="Tidak Diketahui" id="defaultCheck2" />
                            <label class="form-check-label" for="defaultCheck2">
                                Tidak Diketahui
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" {{ $riwayatAlergi->status == 'Ada' ? 'checked' : '' }}
                                type="radio" name="alergi" value="Ada" id="defaultCheck3" />
                            <label class="form-check-label" for="defaultCheck3">
                                Ada
                            </label>
                        </div>
                    @endif
                    <div class="row mb-2">
                        {{-- @foreach ($item->riwayatAlergiDiagnosaKeperawatanPatient as $alergi)     --}}
                        <div class="col-sm-2">
                            <p class="m-0">{{ $arrAlergi[$index] }}</p>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" name="ket-alergi" value="{{ $riwayatAlergi->alergi }}"
                                class="form-control form-control-sm" id="lainnya" placeholder=""
                                aria-describedby="floatingInputHelp" />
                        </div>
                        <div class="col-sm-1">
                            <p class="m-0">Reaksi</p>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" name="reaksi" value="{{ $riwayatAlergi->reaksi }}"
                                class="form-control form-control-sm" id="lainnya" placeholder=""
                                aria-describedby="floatingInputHelp" />
                        </div>
                        {{-- <div class="col-sm-2">
              <button class="btn btn-dark btn-sm">+</button>
            </div> --}}
                        {{-- <div class="col-sm-1">
              <p class="m-0">Alergi</p>
            </div>
            <div class="col-sm-4">
              <input type="text" name="ket-alergi" value="{{ $item->riwayatAlergiDiagnosaKeperawatanPatient->alergi }}" class="form-control form-control-sm" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" />
            </div>
            <div class="col-sm-1">
              <p class="m-0">Reaksi</p>
            </div>
            <div class="col-sm-4">
              <input type="text" name="reaksi" value="{{ $item->riwayatAlergiDiagnosaKeperawatanPatient->reaksi }}" class="form-control form-control-sm" id="lainnya" placeholder="" aria-describedby="floatingInputHelp" />
            </div>
            <div class="col-sm-2">
              <button class="btn btn-dark btn-sm">+</button>
            </div> --}}
                    </div>
                @endforeach
            </div>

            <h6 class="text-center bg-dark text-white py-2">SKRINING DAN ASESMEN NYERI</h6>
            <div class="mb-3">
                <div class="row">
                    <div class="col-sm-auto">
                        Apakah Pasien Merasa Nyeri ?
                    </div>
                    <div class="col-sm-auto">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="rasa-nyeri"
                                {{ $item->asesmentNyeriDiagnosaKeperawatanPatient->status == 'tidak' ? 'checked' : '' }}
                                type="radio" id="inlineCheckbox1" value="tidak" />
                            <label class="form-check-label" for="inlineCheckbox1">Tidak</label>
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="rasa-nyeri" type="radio"
                                {{ $item->asesmentNyeriDiagnosaKeperawatanPatient->status == 'ya' ? 'checked' : '' }}
                                id="inlineCheckbox2" value="ya" />
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
                            <input class="form-check-input" name="kategori-nyeri"
                                {{ $item->asesmentNyeriDiagnosaKeperawatanPatient->category == 'akut' ? 'checked' : '' }}
                                type="radio" id="inlineCheckbox1" value="akut" />
                            <label class="form-check-label" for="inlineCheckbox1">Akut</label>
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="kategori-nyeri" type="radio" id="inlineCheckbox2"
                                {{ $item->asesmentNyeriDiagnosaKeperawatanPatient->category == 'kronis' ? 'checked' : '' }}
                                value="kronis" />
                            <label class="form-check-label d-flex" for="inlineCheckbox2">
                                Kronis
                            </label>
                        </div>
                    </div>
                </div>
                <p class="m-0">Jika Ya, lakukan pengkajian nyeri lebih lanjut dengan format sesuai dengan usia pasien
                </p>
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
                                            <input type="text" name="provocation"
                                                value="{{ $item->asesmentNyeriDiagnosaKeperawatanPatient->provocation }}"
                                                placeholder="Provocation (Pencetus)" class="form-control " id="lainnya"
                                                aria-describedby="floatingInputHelp" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Quality (Karakteristik)</td>
                                        <td>:</td>
                                        <td>
                                            <input type="text" name="quality"
                                                value="{{ $item->asesmentNyeriDiagnosaKeperawatanPatient->quality }}"
                                                placeholder="Quality (Karakteristik)" class="form-control "
                                                id="lainnya" aria-describedby="floatingInputHelp" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Region (Lokasi/Penjalaran)</td>
                                        <td>:</td>
                                        <td>
                                            <input type="text" name="region"
                                                value="{{ $item->asesmentNyeriDiagnosaKeperawatanPatient->region }}"
                                                placeholder="Region (Lokasi/Penjalaran)" class="form-control "
                                                id="lainnya" aria-describedby="floatingInputHelp" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Severity (Keparahan)</td>
                                        <td>:</td>
                                        <td>
                                            <input type="text" name="severity"
                                                value="{{ $item->asesmentNyeriDiagnosaKeperawatanPatient->severity }}"
                                                placeholder="Severity (Keparahan)" class="form-control " id="lainnya"
                                                aria-describedby="floatingInputHelp" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Time (Durasi dan Frekuensi)</td>
                                        <td>:</td>
                                        <td>
                                            <input type="text" name="time"
                                                value="{{ $item->asesmentNyeriDiagnosaKeperawatanPatient->time }}"
                                                placeholder="Time (Durasi dan Frekuensi)" class="form-control "
                                                id="lainnya" aria-describedby="floatingInputHelp" />
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <img src="{{ asset('/assets/img/aakprj1.jpg') }}" alt="" class=""
                                    style="max-width: 650px">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <img src="{{ asset('/assets/img/aakprj2.jpg') }}" alt="" class=""
                                    style="max-width: 650px">
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
                                    $isChecked = in_array(
                                        $nyeri,
                                        $item->asesmentNyeriDiagnosaKeperawatanPatient->detailAsesmentNyeriDiagnosaKeperawatanPatient
                                            ->pluck('name')
                                            ->toArray(),
                                    );
                                @endphp
                                <div class="form-check">
                                    <input class="form-check-input" {{ $isChecked ? 'checked' : '' }}
                                        name="nyeri-hilang[]" type="checkbox" value="Minum Obat" id="defaultCheck1" />
                                    <label class="form-check-label" for="defaultCheck1">
                                        {{ $nyeri }}
                                    </label>
                                </div>
                            @endforeach
                            <div class="row">
                                <label class="form-control-label col-sm-12" for="lainya">Lainnya</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-sm" id="lainnya"
                                        placeholder="" aria-describedby="floatingInputHelp" />
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
                        <td colspan="2">a. Perhatikan cara berjalan pasien saat akan duduk dikursi. Apakah pasien tampak
                            tidak seimbang (sempoyongan / linglung) ?</td>
                        <td class="text-center">
                            <input class="form-check-input" name="a" type="radio"
                                {{ $item->resikoRajalDiagnosaKeperawatanPatient->a == 'ya' ? 'checked' : '' }}
                                value="ya" id="defaultCheck1" />
                        </td>
                        <td class="text-center">
                            <input class="form-check-input" name="a" type="radio"
                                {{ $item->resikoRajalDiagnosaKeperawatanPatient->a == 'tidak' ? 'checked' : '' }}
                                value="tidak" id="defaultCheck1" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">b. Apakah pasien memegang pinggiran kursi atau meja atau benda lain sebagai
                            penopang saat akan duduk?</td>
                        <td class="text-center">
                            <input class="form-check-input" name="b" type="radio"
                                {{ $item->resikoRajalDiagnosaKeperawatanPatient->b == 'ya' ? 'checked' : '' }}
                                value="ya" id="defaultCheck1" />
                        </td>
                        <td class="text-center">
                            <input class="form-check-input" name="b" type="radio"
                                {{ $item->resikoRajalDiagnosaKeperawatanPatient->b == 'tidak' ? 'checked' : '' }}
                                value="tidak" id="defaultCheck1" />
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 500px">
                            <p class="m-0">Kategori :</p>
                            <div class="mx-3">
                                @foreach ($komponenPenilaian1 as $komponen1)
                                    @php
                                        $isChecked = in_array(
                                            $komponen1,
                                            $item->resikoRajalDiagnosaKeperawatanPatient->detailResikoRajalDiagnosaKeperawatanPatient
                                                ->pluck('name')
                                                ->toArray(),
                                        );
                                    @endphp
                                    <div class="form-check">
                                        <input class="form-check-input" name="kategori-skrining-rajal[]"
                                            {{ $isChecked ? 'checked' : '' }} type="checkbox"
                                            value="Tidak berisiko (tidak ditemukan a dan b)" id="defaultCheck1" />
                                        <label class="form-check-label" for="defaultCheck1">
                                            {{ $komponen1 }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </td>
                        <td colspan="3">
                            @foreach ($komponenPenilaian2 as $komponen2)
                                @php
                                    $isChecked = in_array(
                                        $komponen2,
                                        $item->resikoRajalDiagnosaKeperawatanPatient->detailResikoRajalDiagnosaKeperawatanPatient
                                            ->pluck('name')
                                            ->toArray(),
                                    );
                                @endphp
                                <div class="form-check">
                                    <input class="form-check-input" name="kategori-skrining-rajal[]" type="checkbox"
                                        {{ $isChecked ? 'checked' : '' }} value="Tidak ada tindakan"
                                        id="defaultCheck1" />
                                    <label class="form-check-label" for="defaultCheck1">
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
                    @foreach ($item->asesmentStatusFungsionalDiagnosaKeperawatanPatient->detailAsesmentStatusFungsionalDiagnosaKeperawatanPatient as $fungsional)
                        @php
                            $bantuan = '0';
                            $mandiri = '0';
                            if ($loop->iteration < 3 || $loop->iteration > 6) {
                                $bantuan = '5';
                                $mandiri = '10';
                            } elseif ($loop->iteration > 3 && $loop->iteration < 6) {
                                $bantuan = '0';
                                $mandiri = '5';
                            } else {
                                $bantuan = '5-10';
                                $mandiri = '15';
                            }
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $fungsional->name }}</td>
                            <td>{{ $bantuan }}</td>
                            <td>{{ $mandiri }}</td>
                            <td>
                                <input type="number" value="{{ $fungsional->nilai }}" name="kriteria[]"
                                    class="form-control form-control-sm" id="" placeholder="" />
                            </td>
                        </tr>
                    @endforeach
                    {{-- <td></td> --}}
                    <td colspan="5">Total</td>
                    <td><input type="number"
                            value="{{ $item->asesmentStatusFungsionalDiagnosaKeperawatanPatient->detailAsesmentStatusFungsionalDiagnosaKeperawatanPatient->sum('nilai') }}"
                            class="form-control form-control-sm" id="" placeholder="" /></td>
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
                                                @php
                                                    $nilai = $item->risikoNutrisionalDiagnosaKeperawatanPatient->detailRisikoNutrisionalDiagnosaKeperawatanPatient
                                                        ->where('category', 'anak')
                                                        ->where('name', 'Apakah pasien tampak kurus?')
                                                        ->first();
                                                @endphp
                                                <input class="form-check-input" {{ $nilai->nilai == 1 ? 'checked' : '' }}
                                                    name="anak-satu" type="radio" value="1" id="defaultCheck1" />
                                                <label class="form-check-label" for="defaultCheck1">
                                                    Ya
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" {{ $nilai->nilai == 0 ? 'checked' : '' }}
                                                    name="anak-satu" type="radio" value="0" id="defaultCheck2" />
                                                <label class="form-check-label" for="defaultCheck2">
                                                    Tidak
                                                </label>
                                            </div>
                                        </td>
                                        <td class="fw-bold text-center">1 <br> 0</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Apakah terdapat penurunan BB selama 1 bulan terakhir? Berdasarkan penilaian
                                            objectif</td>
                                        <td>
                                            <div class="form-check">
                                                @php
                                                    $nilai = $item->risikoNutrisionalDiagnosaKeperawatanPatient->detailRisikoNutrisionalDiagnosaKeperawatanPatient
                                                        ->where('category', 'anak')
                                                        ->where(
                                                            'name',
                                                            'Apakah terdapat penurunan BB selama 1 bulan terakhir? Berdasarkan penilaian objectif',
                                                        )
                                                        ->first();
                                                @endphp
                                                <input class="form-check-input" {{ $nilai->nilai == 1 ? 'checked' : '' }}
                                                    name="anak-dua" type="radio" value="1" id="defaultCheck1" />
                                                <label class="form-check-label" for="defaultCheck1">
                                                    Ya
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" {{ $nilai->nilai == 0 ? 'checked' : '' }}
                                                    name="anak-dua" type="radio" value="0" id="defaultCheck2" />
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
                                                @php
                                                    $nilai = $item->risikoNutrisionalDiagnosaKeperawatanPatient->detailRisikoNutrisionalDiagnosaKeperawatanPatient
                                                        ->where('category', 'anak')
                                                        ->where(
                                                            'name',
                                                            'Apakah terdapat salah satu kondisi berikut? - Diare ≥ 5 kali/hari dan atau muntah > 3 kali/hari dalam seminggu terakhir - Asupan makanan kurang selama 1 minggu terakhir',
                                                        )
                                                        ->first();
                                                @endphp
                                                <input class="form-check-input" {{ $nilai->nilai == 1 ? 'checked' : '' }}
                                                    name="anak-tiga" type="radio" value="1" id="defaultCheck1" />
                                                <label class="form-check-label" for="defaultCheck1">
                                                    Ya
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" {{ $nilai->nilai == 0 ? 'checked' : '' }}
                                                    name="anak-tiga" type="radio" value="0" id="defaultCheck2" />
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
                                                @php
                                                    $nilai = $item->risikoNutrisionalDiagnosaKeperawatanPatient->detailRisikoNutrisionalDiagnosaKeperawatanPatient
                                                        ->where('category', 'anak')
                                                        ->where(
                                                            'name',
                                                            'Apakah terdapat penyakit atau keadaan yang mangakibatkan pasien beresiko malnutrisi dan sudah malnutrisi (Gizi buruk)?',
                                                        )
                                                        ->first();
                                                @endphp
                                                <input class="form-check-input" {{ $nilai->nilai == 1 ? 'checked' : '' }}
                                                    name="anak-empat" type="radio" value="1"
                                                    id="defaultCheck1" />
                                                <label class="form-check-label" for="defaultCheck1">
                                                    Ya
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" {{ $nilai->nilai == 0 ? 'checked' : '' }}
                                                    name="anak-empat" type="radio" value="0"
                                                    id="defaultCheck2" />
                                                <label class="form-check-label" for="defaultCheck2">
                                                    Tidak
                                                </label>
                                            </div>
                                        </td>
                                        <td class="fw-bold text-center">1 <br> 0</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td colspan="2" class="text-center">Total</td>
                                        <td><input type="number" class="form-control form-control-sm" id=""
                                                placeholder="" /></td>
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
                                        <td>Apakah mengalami penurunan berat badan yang tidak direncanakan/tidak diinginkan
                                            dalam 6 bulan terakhir?</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <li>Tidak</li>
                                        </td>
                                        <td class="fw-bold text-center">
                                            @php
                                                $nilai = $item->risikoNutrisionalDiagnosaKeperawatanPatient->detailRisikoNutrisionalDiagnosaKeperawatanPatient
                                                    ->where('category', 'dewasa')
                                                    ->where(
                                                        'name',
                                                        'Apakah mengalami penurunan berat badan yang tidak direncanakan/tidak diinginkan dalam 6 bulan terakhir? -',
                                                    )
                                                    ->first();
                                            @endphp
                                            <input class="form-check-input" {{ $nilai !== null ? 'checked' : '' }}
                                                type="radio" name="dewasa-satu" value="Tidak" id="defaultCheck3" />
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
                                            @php
                                                $nilai = $item->risikoNutrisionalDiagnosaKeperawatanPatient->detailRisikoNutrisionalDiagnosaKeperawatanPatient
                                                    ->where('category', 'dewasa')
                                                    ->where(
                                                        'name',
                                                        'Apakah mengalami penurunan berat badan yang tidak direncanakan/tidak diinginkan dalam 6 bulan terakhir? -',
                                                    )
                                                    ->where('nilai', 2)
                                                    ->first();
                                            @endphp
                                            <input class="form-check-input" {{ $nilai !== null ? 'checked' : '' }}
                                                type="radio" name="dewasa-satu"
                                                value="Tidak yakin (tanda-tanda : baju menjadi longgar)"
                                                id="defaultCheck3" />
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
                                            @php
                                                $nilai = $item->risikoNutrisionalDiagnosaKeperawatanPatient->detailRisikoNutrisionalDiagnosaKeperawatanPatient
                                                    ->where('category', 'dewasa')
                                                    ->where(
                                                        'name',
                                                        'Apakah mengalami penurunan berat badan yang tidak direncanakan/tidak diinginkan dalam 6 bulan terakhir? - Ya, ada penurunan BB sebanyak 1-5 Kg',
                                                    )
                                                    ->first();
                                            @endphp
                                            <input class="form-check-input" {{ $nilai !== null ? 'checked' : '' }}
                                                type="radio" name="dewasa-satu" value="1-5 Kg" id="defaultCheck3" />
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
                                            @php
                                                $nilai = $item->risikoNutrisionalDiagnosaKeperawatanPatient->detailRisikoNutrisionalDiagnosaKeperawatanPatient
                                                    ->where('category', 'dewasa')
                                                    ->where(
                                                        'name',
                                                        'Apakah mengalami penurunan berat badan yang tidak direncanakan/tidak diinginkan dalam 6 bulan terakhir? - Ya, ada penurunan BB sebanyak 6-10 Kg',
                                                    )
                                                    ->first();
                                            @endphp
                                            <input class="form-check-input" {{ $nilai !== null ? 'checked' : '' }}
                                                type="radio" name="dewasa-satu" value="6-10 Kg" id="defaultCheck3" />
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
                                            @php
                                                $nilai = $item->risikoNutrisionalDiagnosaKeperawatanPatient->detailRisikoNutrisionalDiagnosaKeperawatanPatient
                                                    ->where('category', 'dewasa')
                                                    ->where(
                                                        'name',
                                                        'Apakah mengalami penurunan berat badan yang tidak direncanakan/tidak diinginkan dalam 6 bulan terakhir? - Ya, ada penurunan BB sebanyak 11-15 Kg',
                                                    )
                                                    ->first();
                                            @endphp
                                            <input class="form-check-input" {{ $nilai !== null ? 'checked' : '' }}
                                                type="radio" name="dewasa-satu" value="11-15 Kg" id="defaultCheck3" />
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
                                            @php
                                                $nilai = $item->risikoNutrisionalDiagnosaKeperawatanPatient->detailRisikoNutrisionalDiagnosaKeperawatanPatient
                                                    ->where('category', 'dewasa')
                                                    ->where(
                                                        'name',
                                                        'Apakah mengalami penurunan berat badan yang tidak direncanakan/tidak diinginkan dalam 6 bulan terakhir? - Ya, ada penurunan BB sebanyak >15 Kg',
                                                    )
                                                    ->first();
                                            @endphp
                                            <input class="form-check-input" {{ $nilai !== null ? 'checked' : '' }}
                                                type="radio" name="dewasa-satu" value=">15 Kg" id="defaultCheck3" />
                                            <label class="form-check-label" for="defaultCheck3">
                                                4
                                            </label>
                                        </td>
                                    <tr>
                                        <td>
                                            <span class="mx-4">Tidak tahu berapa kg penurunan</span>
                                        </td>
                                        <td class="fw-bold text-center">
                                            @php
                                                $nilai = $item->risikoNutrisionalDiagnosaKeperawatanPatient->detailRisikoNutrisionalDiagnosaKeperawatanPatient
                                                    ->where('category', 'dewasa')
                                                    ->where(
                                                        'name',
                                                        'Apakah mengalami penurunan berat badan yang tidak direncanakan/tidak diinginkan dalam 6 bulan terakhir? - Tidak tahu berapa kg penurunan',
                                                    )
                                                    ->first();
                                            @endphp
                                            <input class="form-check-input" {{ $nilai !== null ? 'checked' : '' }}
                                                type="radio" name="dewasa-satu" value="Tidak tahu berapa kg penurunan"
                                                id="defaultCheck3" />
                                            <label class="form-check-label" for="defaultCheck3">
                                                2
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Apakah asupan makanan pasien berkurang karena penurunan nafsu makan/kesulitan
                                            menerima makanan
                                            <ul>
                                                <li>Tidak</li>
                                                <li>Ya</li>
                                            </ul>
                                        </td>
                                        <td class="fw-bold text-center">
                                            @php
                                                $nilai = $item->risikoNutrisionalDiagnosaKeperawatanPatient->detailRisikoNutrisionalDiagnosaKeperawatanPatient
                                                    ->where('category', 'dewasa')
                                                    ->where(
                                                        'name',
                                                        'Apakah terdapat penurunan BB selama 1 bulan terakhir? Berdasarkan penilaian objectif ? Ya',
                                                    )
                                                    ->first();
                                            @endphp
                                            <input class="form-check-input" {{ $nilai !== null ? 'checked' : '' }}
                                                type="radio" name="dewasa-dua" checked value="0"
                                                id="defaultCheck3" />
                                            <label class="form-check-label" for="defaultCheck3">
                                                0
                                            </label>
                                            <br>
                                            <input class="form-check-input" {{ $nilai == null ? 'checked' : '' }}
                                                type="radio" name="dewasa-dua" value="1" id="defaultCheck3" />
                                            <label class="form-check-label" for="defaultCheck3">
                                                1
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td class="text-center">Total</td>
                                        <td><input type="number" class="form-control form-control-sm" id=""
                                                placeholder="" /></td>
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
                    @php
                        $ansietas = $item->detailDiagnosisKeperawatanPatient->where('diagnosa', 'Ansietas')->first();
                    @endphp
                    <input class="form-check-input" {{ $ansietas !== null ? 'checked' : '' }} type="checkbox"
                        name="diagnosis-keperawatan[]" value="Ansietas" id="defaultCheck1" />
                    <label class="form-check-label" for="defaultCheck1">
                        Ansietas
                    </label>
                </div>
                <div class="col-sm-1">
                    <p class="m-0 fw-bold">b.d.</p>
                </div>
                <div class="col-sm-7">
                    @foreach ($bdAnsietas as $bd)
                        @php
                            $isChecked = $item
                                ->detailDiagnosisKeperawatanPatient()
                                ->whereHas('hubunganDiagnosaAwalPatient', function ($query) use ($bd) {
                                    $query->where('name', $bd);
                                })
                                ->exists();
                        @endphp
                        <div class="form-check">
                            <input class="form-check-input" {{ $isChecked ? 'checked' : '' }} type="checkbox"
                                value="Kurang rerpapar informasi" name="ansietas[]" id="defaultCheck2" />
                            <label class="form-check-label" for="defaultCheck2">
                                {{ $bd }}
                            </label>
                        </div>
                    @endforeach
                </div>
                <div class="col-sm-3 form-check mx-4">
                    @php
                        $nyeri = $item->detailDiagnosisKeperawatanPatient->where('diagnosa', 'Nyeri Akut')->first();
                    @endphp
                    <input class="form-check-input" type="checkbox" {{ $nyeri !== null ? 'checked' : '' }}
                        value="Nyeri Akut" name="diagnosis-keperawatan[]" id="defaultCheck1" />
                    <label class="form-check-label" for="defaultCheck1">
                        Nyeri Akut
                    </label>
                </div>
                <div class="col-sm-1">
                    <p class="m-0 fw-bold">b.d.</p>
                </div>
                <div class="col-sm-7">
                    @foreach ($bdNyeri as $bd)
                        @php
                            $isChecked = $item
                                ->detailDiagnosisKeperawatanPatient()
                                ->whereHas('hubunganDiagnosaAwalPatient', function ($query) use ($bd) {
                                    $query->where('name', $bd);
                                })
                                ->exists();
                        @endphp
                        <div class="form-check">
                            <input class="form-check-input" {{ $isChecked ? 'checked' : '' }} type="checkbox"
                                value="Agen pencedera fisiologis *(Inflamasi/Iskemia/Neoplasma)" name="nyeri-akut[]"
                                id="defaultCheck2" />
                            <label class="form-check-label" for="defaultCheck2">
                                {{ $bd }}
                            </label>
                        </div>
                    @endforeach

                    <div class="form-check">
                        <input class="form-check-input" {{ $isChecked ? 'checked' : '' }} type="checkbox"
                            value="Agen pencedera fisiologis *(Inflamasi/Iskemia/Neoplasma)" name="agen_pencedera"
                            id="defaultCheck2" />
                        <label class="form-check-label" for="defaultCheck2">
                            "Agen pencedera fisiologis
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" value="test"
                                    id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Inflamasi
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                    id="flexRadioDefault2" checked>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Iskemia
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                    id="flexRadioDefault2" checked>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Neoplasma
                                </label>
                            </div>
                        </label>

                    </div>
                </div>
                <div class="col-sm-3 form-check mx-4">
                    @php
                        $nyeri = $item->detailDiagnosisKeperawatanPatient->where('diagnosa', 'Nyeri Kronis')->first();
                    @endphp
                    <input class="form-check-input" type="checkbox" {{ $nyeri !== null ? 'checked' : '' }}
                        value="Nyeri Kronis" name="diagnosis-keperawatan[]" id="defaultCheck1" />
                    <label class="form-check-label" for="defaultCheck1">
                        Nyeri Kronis
                    </label>
                </div>
                <div class="col-sm-1">
                    <p class="m-0 fw-bold">b.d.</p>
                </div>
                <div class="col-sm-7">
                    @foreach ($bdNyeri as $bd)
                        @php
                            $isChecked = $item
                                ->detailDiagnosisKeperawatanPatient()
                                ->whereHas('hubunganDiagnosaAwalPatient', function ($query) use ($bd) {
                                    $query->where('name', $bd);
                                })
                                ->exists();
                        @endphp
                        <div class="form-check">
                            <input class="form-check-input" {{ $isChecked ? 'checked' : '' }} type="checkbox"
                                value="Agen pencedera fisiologis *(Inflamasi/Iskemia/Neoplasma)" name="nyeri-akut[]"
                                id="defaultCheck2" />
                            <label class="form-check-label" for="defaultCheck2">
                                {{ $bd }}
                            </label>
                        </div>
                    @endforeach
                </div>
                <div class="col-sm-3 form-check mx-4">
                    @php
                        $fisik = $item->detailDiagnosisKeperawatanPatient
                            ->where('diagnosa', 'Gangguan Mobilitas Fisik')
                            ->first();
                    @endphp
                    <input class="form-check-input" type="checkbox" {{ $fisik !== null ? 'checked' : '' }}
                        value="Gangguan Mobilitas Fisik" name="diagnosis-keperawatan[]" id="defaultCheck1" />
                    <label class="form-check-label" for="defaultCheck1">
                        Gangguan Mobilitas Fisik
                    </label>
                </div>
                <div class="col-sm-1">
                    <p class="m-0 fw-bold">b.d.</p>
                </div>
                <div class="col-sm-7">
                    @foreach ($bdFisik as $bd)
                        @php
                            $isChecked = $item
                                ->detailDiagnosisKeperawatanPatient()
                                ->whereHas('hubunganDiagnosaAwalPatient', function ($query) use ($bd) {
                                    $query->where('name', $bd);
                                })
                                ->exists();
                        @endphp
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" {{ $isChecked ? 'checked' : '' }}
                                value="Kerusakan Struktur Tulang" name="gangguan-mobilitas-fisik[]" id="defaultCheck2" />
                            <label class="form-check-label" for="defaultCheck2">
                                {{ $bd }}
                            </label>
                        </div>
                    @endforeach
                </div>
                <div class="col-sm-3 form-check mx-4">
                    @php
                        $kulit = $item->detailDiagnosisKeperawatanPatient
                            ->where('diagnosa', 'Gangguan Integritas Kulit / Jaringan')
                            ->first();
                    @endphp
                    <input class="form-check-input" type="checkbox" {{ $kulit !== null ? 'checked' : '' }}
                        value="Gangguan Integritas Kulit / Jaringan" name="diagnosis-keperawatan[]" id="defaultCheck1" />
                    <label class="form-check-label" for="defaultCheck1">
                        Gangguan Integritas Kulit / Jaringan
                    </label>
                </div>
                <div class="col-sm-1">
                    <p class="m-0 fw-bold">b.d.</p>
                </div>
                <div class="col-sm-7">
                    @foreach ($bdKulit as $bd)
                        @php
                            $isChecked = $item
                                ->detailDiagnosisKeperawatanPatient()
                                ->whereHas('hubunganDiagnosaAwalPatient', function ($query) use ($bd) {
                                    $query->where('name', $bd);
                                })
                                ->exists();
                        @endphp
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" {{ $isChecked ? 'checked' : '' }}
                                value="Faktor Mekanis" name="gangguan-integritas-kulit[]" id="defaultCheck2" />
                            <label class="form-check-label" for="defaultCheck2">
                                {{ $bd }}
                            </label>
                        </div>
                    @endforeach
                </div>
                <div class="col-sm-3 form-check mx-4">
                    @php
                        $urnie = $item->detailDiagnosisKeperawatanPatient->where('diagnosa', 'Retensi Urine')->first();
                    @endphp
                    <input class="form-check-input" type="checkbox" {{ $urnie !== null ? 'checked' : '' }}
                        value="Retensi Urine" name="diagnosis-keperawatan[]" id="defaultCheck1" />
                    <label class="form-check-label" for="defaultCheck1">
                        Retensi Urine
                    </label>
                </div>
                <div class="col-sm-1">
                    <p class="m-0 fw-bold">b.d.</p>
                </div>
                <div class="col-sm-7">
                    @foreach ($bdUrine as $bd)
                        @php
                            $isChecked = $item
                                ->detailDiagnosisKeperawatanPatient()
                                ->whereHas('hubunganDiagnosaAwalPatient', function ($query) use ($bd) {
                                    $query->where('name', $bd);
                                })
                                ->exists();
                        @endphp
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" {{ $isChecked ? 'checked' : '' }}
                                value="Peningkatan Tekanan Uretra" name="retensi-urine[]" id="defaultCheck2" />
                            <label class="form-check-label" for="defaultCheck2">
                                {{ $bd }}
                            </label>
                        </div>
                    @endforeach
                </div>
                <div class="col-sm-3 form-check">
                    <div class="d-flex align-items-center">
                        <label class="form-control-label col-sm-4" for="lainnya">Lainnya</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" id="lainnya" placeholder=""
                                aria-describedby="floatingInputHelp" />
                        </div>
                    </div>
                </div>
                <div class="col-sm-1 mx-4">
                    <p class="fw-bold mx-4">b.d.</p>
                </div>
                <div class="col-sm-4">
                    <div id="input-container1" class="row">
                        <input class="form-control form-control-sm mx-3" style="max-width: 300px" name="lainnya[]"
                            type="text" aria-label=".form-control-sm example">
                        <a class="btn btn-sm btn-dark text-white" style="max-width: 40px"
                            onclick="addInput('input-container1')">+</a>
                    </div>
                </div>
            </div>
            <h6 class="text-center bg-dark text-white py-2">MASALAH KEPERAWATAN</h6>
            <div class="row mb-3">
                <div class="col-sm-4 ">
                    <div class="mx-2">
                        @foreach ($masalahKeperawatan as $keperawatan)
                            @php
                                $isChecked = in_array(
                                    $keperawatan,
                                    $item->detailMasalahDiagnosisKeperawatanPatient->pluck('diagnosa')->toArray(),
                                );
                            @endphp
                            <div class="form-check">
                                <input class="form-check-input" {{ $isChecked ? 'checked' : '' }} type="checkbox"
                                    value="Ansietas" name="masalah-keperawatan[]" id="defaultCheck1" />
                                <label class="form-check-label" for="defaultCheck1">
                                    {{ $keperawatan }}
                                </label>
                            </div>
                        @endforeach
                        <div class="row">
                            <label class="form-control-label col-sm-12" for="lainya">Lainnya</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" id="lainnya" placeholder=""
                                    aria-describedby="floatingInputHelp" />
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
                        @foreach ($rencanaAsuhan as $asuhan)
                            @php
                                $isChecked = in_array(
                                    $asuhan,
                                    $item->detailRencanaDiagnosisKeperawatanPatient->pluck('diagnosa')->toArray(),
                                );
                            @endphp
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" {{ $isChecked ? 'checked' : '' }}
                                    value="Reduksi Ansietas" name="rencana-asuhan[]" id="defaultCheck1" />
                                <label class="form-check-label" for="defaultCheck1">
                                    {{ $asuhan }}
                                </label>
                            </div>
                        @endforeach
                        <div class="row">
                            <label class="form-control-label col-sm-12" for="lainya">Lainnya</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" id="lainnya" placeholder=""
                                    aria-describedby="floatingInputHelp" />
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
