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
            <h5 class="mb-0">Assesmen PRA Sedasi
            </h5>
        </div>
        <form action="{{ route('assesmen/pra/sedasi.update', $item->id) }}" method="POST"
            onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
            @method('PUT')
            @csrf
            <div class="card-body">
                <div class="mb-4 row align-items-center">
                    <div class="col">
                        <div class="row align-items-center">
                            <label class="col-form-label col-4" for="tanggalOperasi">Tanggal Operasi</label>
                            <div class="col-5">
                                <input type="date" value="{{ $tgl_operasi }}" name="tanggal_operasi"
                                    class="form-control form-control-sm col" id="tanggalOperasi" />
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row align-items-center">
                            <label class="col-form-label col-4" for="dokterAnestesi">Dokter Anestesi</label>
                            <div class="col-5">
                                <select class="form-control form-control-sm col select2" id="dokterAnestesi"
                                    name="dokter_anestesi" onchange="getPatient()" required>
                                    <option value="">Pilih Dokter Anestesi</option>
                                    @foreach ($dokter as $dokters)
                                        <option value="{{ $dokters->name }}"
                                            {{ $dokters->name == $item->dokter_anestesi ? 'selected' : '' }}>
                                            {{ $dokters->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row align-items-center">
                            <label class="col-form-label col-4" for="dokterBedah">Dokter Bedah</label>
                            <div class="col-5">
                                <select class="form-control form-control-sm col select2" id="dokterBedah"
                                    name="dokter_bedah" onchange="getPatient()" required>
                                    <option value="">Pilih Dokter Bedah</option>
                                    @foreach ($dokter as $dokters)
                                        <option value="{{ $dokters->name }}"
                                            {{ $dokters->name == $item->dokter_bedah ? 'selected' : '' }}>
                                            {{ $dokters->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-5 col align-items-center">
                    <div class="mb-3 row">
                        <label class="col-form-label col-2" for="keluargaPasien">Pemeriksaan</label>
                        <div class="col">
                            <div class="row">
                                <label class="col-form-label col-2" for="pemeriksaanTanggal">Tanggal / Jam</label>
                                <div class="col-3">
                                    <input type="datetime-local" name="tanggal_pemeriksaan"
                                        value="{{ $item->tanggal_pemeriksaan ?? '' }}"
                                        class="form-control form-control-sm col" id="pemeriksaanTanggal" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-form-label col-2" for="pemeriksaanDiagnosis">Diagnosis</label>
                        <input class="form-control form-control-sm col" name="diagnosis"
                            value="{{ $item->diagnosis ?? '' }}" type="text" id="pemeriksaanDiagnosis" />
                    </div>
                    <div class="mb-3 row">
                        <label class="col-form-label col-2" for="pemeriksaanRencanaOperasi">Rencana Operasi</label>
                        <input class="form-control form-control-sm col" name="rencana_operasi"
                            value="{{ $item->rencana_operasi ?? '' }}" id="pemeriksaanRencanaOperasi" type="text" />
                    </div>
                </div>
                <div class="mb-4 row">
                    <div class="col-6">
                        <p>Anamesa dari :</p>
                        <div class="mb-1 form-check">
                            <input name="anamnesa" class="form-check-input" type="radio" value="pasien"
                                id="anamnesaPasien" onclick="clearValueInput()"
                                {{ $item->anamnesa == 'pasien' ? 'checked' : '' }} />
                            <label class="form-check-label" for="anamnesaPasien">
                                Pasien
                            </label>
                        </div>
                        <div class="mb-1 form-check">
                            <input name="anamnesa" class="form-check-input" type="radio" value="keluarga"
                                id="anamnesaKeluarga" onclick="clearValueInput()"
                                {{ $item->anamnesa == 'keluarga' ? 'checked' : '' }} />
                            <label class="form-check-label" for="anamnesaKeluarga">
                                Keluarga
                            </label>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <div class="row align-items-center">
                                    <input type="text"
                                        value="{{ in_array($item->anamnesa, ['pasien', 'keluarga']) ? '' : $item->anamnesa }}"
                                        id="inputAnamnesa" class="form-control form-control-sm col"
                                        style="max-width: 200px;" onchange="inputAnamnesaLain(this)">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <p>Obat yang sedang dikonsumsi</p>
                        <div class="mb-3 col">
                            <div class="row">
                                <div class="col-3">
                                    <div class="mb-1 form-check">
                                        <input name="is_konsumsi" class="form-check-input" type="radio" value="0"
                                            id="obatKonsumsiTidak" {{ $item->isKonsumsi ? '' : 'checked' }} />
                                        <label class="form-check-label" for="obatKonsumsiTidak">
                                            Tidak ada
                                        </label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-1 form-check">
                                        <input name="is_konsumsi" class="form-check-input" type="radio" value="1"
                                            id="obatKonsumsiAda" {{ $item->isKonsumsi ? 'checked' : '' }} />
                                        <label class="form-check-label" for="obatKonsumsiAda">
                                            Ada
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 col">
                            <div class="row">
                                <div class="col-6">
                                    <div class="row align-items-center">
                                        <label class="form-check-label col-7" for="makan_terakhir">
                                            Makan / Terakhir Jam
                                        </label>
                                        <input name="makan_terakhir" value="{{ $item->makan_terakhir ?? '' }}"
                                            class="form-control form-control-sm col" type="time"
                                            id="makan_terakhir" />
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row align-items-center">
                                        <label class="form-check-label col-7" for="minum_terakhir">
                                            Minum / Terakhir Jam
                                        </label>
                                        <input name="minum_terakhir" value="{{ $item->minum_terakhir ?? '' }}"
                                            class="form-control form-control-sm col" type="time"
                                            id="minum_terakhir" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-2 col">
                            <div class="row align-items-center">
                                <label class="form-check-label col-3" for="riwayat_alergi">
                                    Riwayat Alergi
                                </label>
                                <input name="riwayat_alergi" value="{{ $item->riwayat_alergi ?? '' }}"
                                    class="form-control form-control-sm col" type="text" id="riwayat_alergi"
                                    style="max-width: 200px;" />
                            </div>
                        </div>
                    </div>
                </div>

                {{-- riwayat Penyakit --}}
                <div class="mb-4 col">
                    <p>Riwayat Penyakit</p>
                    <div class="row row-cols-3">
                        @foreach ($dataRiwayatPenyakit as $itemRiwayat)
                            <div class="col-4">
                                <div class="form-check">
                                    <input name="riwayat_penyakit[]" class="form-check-input" type="checkbox"
                                        value="{{ $itemRiwayat }}" id="{{ $itemRiwayat }}"
                                        {{ in_array($itemRiwayat, $item->ranapAssesmenPraSedationRiwayatDiseases->pluck('name')->toArray()) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="{{ $itemRiwayat }}">
                                        {{ $itemRiwayat }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                        @foreach ($item->ranapAssesmenPraSedationRiwayatDiseases as $riwPenya)
                            @if (!in_array($riwPenya->name, $dataRiwayatPenyakit))
                                <div class="col-4">
                                    <input name="riwayat_penyakit[]" class="form-control form-control-sm" type="text"
                                        value="{{ $riwPenya->name ?? '' }}" id="riwayat_penyakit_lain" />
                                </div>
                            @endif
                        @endforeach
                        <div class="col-4 d-flex">
                            <input name="riwayat_penyakit[]" class="form-control form-control-sm" type="text"
                                value="" id="riwayat_penyakit_lain" />
                            <button type="button" class="btn btn-dark btn-sm mx-2" onclick="addInputLain(this)"><i
                                    class="bx bx-plus"></i></button>
                        </div>
                    </div>
                </div>
                {{-- pemeriksaan fisik --}}
                <div class="mb-4 col">
                    <p>Pemeriksaan Fisik</p>
                    <div class="p-3 border-2 rounded col">
                        <p>Tanda - tanda vital sebelum tindakan</p>
                        <div class="px-3 row row-cols-2">
                            @foreach ($dataPemeriksaanFisik as $itemFisik)
                                @if (in_array($itemFisik['name'], $item->ranapAssesmenPraSedationPemeriksaanPhysicals->pluck('name')->toArray()))
                                    @foreach ($item->ranapAssesmenPraSedationPemeriksaanPhysicals as $fisik)
                                        @if ($itemFisik['name'] == $fisik->name)
                                            <div class="col">
                                                <div class="mb-3 row">
                                                    <label class="col-form-label col-2"
                                                        for="{{ $itemFisik['name'] }}">{{ $itemFisik['name'] }}</label>
                                                    <input class="form-control col" id="{{ $itemFisik['name'] }}"
                                                        name="pemeriksaan_fisik[]" type="number"
                                                        value="{{ $fisik->value ?? '' }}" style="max-width: 50px;" />
                                                    <label class="col-form-label col-2"
                                                        for="{{ $itemFisik['name'] }}">{{ $itemFisik['satuan'] }}</label>
                                                </div>
                                            </div>
                                        @break
                                    @endif
                                @endforeach
                            @else
                                <div class="col">
                                    <div class="mb-3 row">
                                        <label class="col-form-label col-2"
                                            for="{{ $itemFisik['name'] }}">{{ $itemFisik['name'] }}</label>
                                        <input class="form-control col" id="{{ $itemFisik['name'] }}"
                                            name="pemeriksaan_fisik[]" type="number" value=""
                                            style="max-width: 50px;" />
                                        <label class="col-form-label col-2"
                                            for="{{ $itemFisik['name'] }}">{{ $itemFisik['satuan'] }}</label>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="mb-4 col">
                <div class="row row-cols-2">
                    {{-- evaluasi jalan nafas --}}
                    <div class="col">
                        <div class="p-3 border">
                            <table class="w-100">
                                <tr class="border-bottom">
                                    <td colspan="2">Evaluasi Jalan Nafas</td>
                                </tr>
                                <tr>
                                    <td>Bebas</td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="form-check me-2">
                                                <input name="bebas" class="form-check-input" type="radio"
                                                    value="1" id="bbsYa"
                                                    {{ $item->ranapAssesmenPraSedationNafasEvaluations->bebas === 1 ? 'checked' : '' }} />
                                                <label class="form-check-label" for="bbsYa">
                                                    Ya
                                                </label>
                                            </div>
                                            <span class="me-2">/</span>
                                            <div class="form-check">
                                                <input name="bebas" class="form-check-input" type="radio"
                                                    value="0" id="bbsTidak"
                                                    {{ $item->ranapAssesmenPraSedationNafasEvaluations->bebas === 0 ? 'checked' : '' }} />
                                                <label class="form-check-label" for="bbsTidak">
                                                    Tidak
                                                </label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Buka Mulut</td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="form-check me-2">
                                                <input name="buka_mulut" class="form-check-input" type="radio"
                                                    value="Lebih dari 3 jari" id="bkMlYa"
                                                    {{ $item->ranapAssesmenPraSedationNafasEvaluations->buka_mulut == 'Lebih dari 3 jari' ? 'checked' : '' }} />
                                                <label class="form-check-label" for="bkMlYa">
                                                    Lebih dari 3 jari
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input name="buka_mulut" class="form-check-input" type="radio"
                                                    value="Tidak" id="bkMlTidak"
                                                    {{ $item->ranapAssesmenPraSedationNafasEvaluations->buka_mulut == 'Tidak' ? 'checked' : '' }} />
                                                <label class="form-check-label" for="bkMlTidak">
                                                    Tidak
                                                </label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Malampathy</td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="form-check me-3">
                                                <input class="form-check-input" type="radio" name="malampathy"
                                                    value="1" id="ml1"
                                                    {{ $item->ranapAssesmenPraSedationNafasEvaluations->malampathy == '1' ? 'checked' : '' }} />
                                                <label class="form-check-label" for="ml1">
                                                    1
                                                </label>
                                            </div>
                                            <div class="form-check me-3">
                                                <input class="form-check-input" type="radio" name="malampathy"
                                                    value="2" id="ml2"
                                                    {{ $item->ranapAssesmenPraSedationNafasEvaluations->malampathy == '2' ? 'checked' : '' }} />
                                                <label class="form-check-label" for="ml2">
                                                    2
                                                </label>
                                            </div>
                                            <div class="form-check me-3">
                                                <input class="form-check-input" type="radio" name="malampathy"
                                                    value="3" id="ml3"
                                                    {{ $item->ranapAssesmenPraSedationNafasEvaluations->malampathy == '3' ? 'checked' : '' }} />
                                                <label class="form-check-label" for="ml3">
                                                    3
                                                </label>
                                            </div>
                                            <div class="form-check me-3">
                                                <input class="form-check-input" type="radio" name="malampathy"
                                                    value="4" id="ml4"
                                                    {{ $item->ranapAssesmenPraSedationNafasEvaluations->malampathy == '4' ? 'checked' : '' }} />
                                                <label class="form-check-label" for="ml4">
                                                    4
                                                </label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Jarak Mentohyoid</td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="form-check me-2">
                                                <input name="jarak_mentohyoid" class="form-check-input"
                                                    type="radio" value="Lebih dari 4 jari" id="jrkMtidYa"
                                                    {{ $item->ranapAssesmenPraSedationNafasEvaluations->jarak_mentohyoid == 'Lebih dari 4 jari' ? 'checked' : '' }} />
                                                <label class="form-check-label" for="jrkMtidYa">
                                                    Lebih dari 4 jari
                                                </label>
                                            </div>
                                            <span class="me-2">/</span>
                                            <div class="form-check">
                                                <input name="jarak_mentohyoid" class="form-check-input"
                                                    type="radio" value="Tidak" id="jrkMtidTidak"
                                                    {{ $item->ranapAssesmenPraSedationNafasEvaluations->jarak_mentohyoid == 'Tidak' ? 'checked' : '' }} />
                                                <label class="form-check-label" for="jrkMtidTidak">
                                                    Tidak
                                                </label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Leher</td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="form-check me-2">
                                                <input name="leher" class="form-check-input" type="radio"
                                                    value="Pendek" id="lhrPndkYa"
                                                    {{ $item->ranapAssesmenPraSedationNafasEvaluations->leher == 'Pendek' ? 'checked' : '' }} />
                                                <label class="form-check-label" for="lhrPndkYa">
                                                    Pendek
                                                </label>
                                            </div>
                                            <span class="me-2">/</span>
                                            <div class="form-check">
                                                <input name="leher" class="form-check-input" type="radio"
                                                    value="Tidak" id="lhrPndkTidak"
                                                    {{ $item->ranapAssesmenPraSedationNafasEvaluations->leher == 'Tidak' ? 'checked' : '' }} />
                                                <label class="form-check-label" for="lhrPndkTidak">
                                                    Tidak
                                                </label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Gerak leher</td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="form-check me-2">
                                                <input name="gerak_leher" class="form-check-input" type="radio"
                                                    value="Bebas" id="grkLhrBbsYa"
                                                    {{ $item->ranapAssesmenPraSedationNafasEvaluations->gerak_leher == 'Bebas' ? 'checked' : '' }} />
                                                <label class="form-check-label" for="grkLhrBbsYa">
                                                    Bebas
                                                </label>
                                            </div>
                                            <span class="me-2">/</span>
                                            <div class="form-check">
                                                <input name="gerak_leher" class="form-check-input" type="radio"
                                                    value="Tidak" id="grkLhrBbsTidak"
                                                    {{ $item->ranapAssesmenPraSedationNafasEvaluations->gerak_leher == 'Tidak' ? 'checked' : '' }} />
                                                <label class="form-check-label" for="grkLhrBbsTidak">
                                                    Tidak
                                                </label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Gigi palsu</td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="form-check me-2">
                                                <input name="gigi_palsu" class="form-check-input" type="radio"
                                                    value="1" id="ggPlsYa"
                                                    {{ $item->ranapAssesmenPraSedationNafasEvaluations->gigi_palsu === 1 ? 'checked' : '' }} />
                                                <label class="form-check-label" for="ggPlsYa">
                                                    Ada
                                                </label>
                                            </div>
                                            <span class="me-2">/</span>
                                            <div class="form-check">
                                                <input name="gigi_palsu" class="form-check-input" type="radio"
                                                    value="0" id="ggPlsTidak"
                                                    {{ $item->ranapAssesmenPraSedationNafasEvaluations->gigi_palsu === 0 ? 'checked' : '' }} />
                                                <label class="form-check-label" for="ggPlsTidak">
                                                    Tidak
                                                </label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Lainnya</td>
                                    <td>

                                        <div class="flex-column">
                                            @foreach ($jalanNafas as $evaluasiJalanNafas)
                                                <div class="col-12 d-flex mt-1">
                                                    <input name="evaluasiJalanNafas[]"
                                                        class="form-control form-control-sm" type="text"
                                                        value="{{ $evaluasiJalanNafas->keterangan }}"
                                                        id="evaluasiJalanNafas_lain" />
                                                    <button type="button" class="btn btn-danger btn-sm mx-2"
                                                        onclick="evaluasiJalanNafasDelete(this)"><i
                                                            class="bx bx-minus"></i></button>
                                                </div>
                                            @endforeach

                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <div class="flex-column">
                                            <div class="col-12 d-flex">
                                                <input name="evaluasiJalanNafas[]"
                                                    class="form-control form-control-sm" type="text"
                                                    value="" id="evaluasiJalanNafas_lain" />
                                                <button type="button" class="btn btn-dark btn-sm mx-2"
                                                    onclick="evaluasiJalanNafas(this)"><i
                                                        class="bx bx-plus"></i></button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                {{-- <tr>
                                        <td>Lain - lain</td>
                                        <td><input type="text" class="form-control form-control-sm"></td>
                                    </tr> --}}
                            </table>
                        </div>
                    </div>
                    {{-- pemeriksaan fisik lainnya --}}
                    <div class="border rounded col">
                        <div class="p-3">
                            @foreach ($dataPemeriksaanLainnya as $pemeriksaanLainnya)
                                @if (in_array($pemeriksaanLainnya, $item->ranapAssesmenPraSedationOtherExaminations->pluck('name')->toArray()))
                                    @foreach ($item->ranapAssesmenPraSedationOtherExaminations as $lainnya)
                                        @if ($pemeriksaanLainnya == $lainnya->name)
                                            <div class="mb-3 col">
                                                <div class="row align-items-center">
                                                    <label class="col-form-label col-3"
                                                        for="{{ $pemeriksaanLainnya }}">{{ $pemeriksaanLainnya }}</label>
                                                    <textarea class="form-control col" type="text" name="other_examination[]" id="{{ $pemeriksaanLainnya }}">{!! $lainnya->value !!}</textarea>
                                                </div>
                                            </div>
                                        @break
                                    @endif
                                @endforeach
                            @else
                                <div class="mb-3 col">
                                    <div class="row align-items-center">
                                        <label class="col-form-label col-3"
                                            for="{{ $pemeriksaanLainnya }}">{{ $pemeriksaanLainnya }}</label>
                                        <textarea class="form-control col" type="text" name="other_examination[]" id="{{ $pemeriksaanLainnya }}"
                                            value=""></textarea>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- normal result --}}
        <div class="mb-4 col">
            <p>Hasil Pemeriksaan lab yang normal</p>
            <div class="row row-cols-4">
                @foreach ($dataNormalResults as $normalResult)
                    @if (in_array($normalResult, $item->ranapAssesmenPraSedationNormalResults->pluck('name')->toArray()))
                        @foreach ($item->ranapAssesmenPraSedationNormalResults as $normalRes)
                            @if ($normalResult == $normalRes->name)
                                <div class="col">
                                    <div class="mb-3 row align-items-center">
                                        <label class="form-check-label col-4" for="{{ $normalResult }}">
                                            {{ $normalResult }}
                                        </label>
                                        <input name="normal_result[]" class="form-control form-control-sm col"
                                            type="text" value="{{ $normalRes->value ?? '' }}"
                                            id="{{ $normalResult }}" />
                                    </div>
                                </div>
                            @break
                        @endif
                    @endforeach
                @else
                    <div class="col">
                        <div class="mb-3 row align-items-center">
                            <label class="form-check-label col-4" for="{{ $normalResult }}">
                                {{ $normalResult }}
                            </label>
                            <input name="normal_result[]" class="form-control form-control-sm col"
                                type="text" value="" id="{{ $normalResult }}" />
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    <div class="mb-4 col">
        <label for="exampleFormControlTextarea1" class="form-label">Hasil Pemeriksaan Lain : (X-Ray, ECG,
            ECHO, CT SCAN, MRI, IVP)</label>
        <textarea class="form-control" name="hasil_pemeriksaan_lain" id="editor" rows="3">{!! $item->hasil_pemeriksaan_lain ?? '' !!}</textarea>
    </div>

    <div class="mb-4 col">
        <div class="row row-cols-2">
            <div class="col">
                <p>Kesimpulan Assesment Pra / Sedasi :</p>
                <div class="row">
                    <div class="col-2">
                        <label for="editor2" class="form-label">Penyulit</label>
                    </div>
                    <div class="col-10">
                        <textarea class="form-control form-control-sm col" name="penyulit" id="editor2" rows="3">{!! $item->penyulit ?? '' !!}</textarea>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="d-flex">
                    <div class="form-check me-2">
                        <input name="asa[]" class="form-check-input" type="checkbox" value="ASA"
                            id="statusFisikASA" {{ in_array('ASA', $statusFisik) ? 'checked' : '' }} />
                        <label class="form-check-label" for="statusFisikASA">
                            ASA
                        </label>
                    </div>
                    <div class="form-check me-2">
                        <input name="asa[]" class="form-check-input" type="checkbox" value="1"
                            id="statusFisik1" {{ in_array('ASA', $statusFisik) ? '1' : '' }} />
                        <label class="form-check-label" for="statusFisik1">
                            1
                        </label>
                    </div>
                    <div class="form-check me-2">
                        <input name="asa[]" class="form-check-input" type="checkbox" value="2"
                            id="statusFisik2" {{ in_array('2', $statusFisik) ? 'checked' : '' }} />
                        <label class="form-check-label" for="statusFisik2">
                            2
                        </label>
                    </div>
                    <div class="form-check me-2">
                        <input name="asa[]" class="form-check-input" type="checkbox" value="3"
                            id="statusFisik3" {{ in_array('3', $statusFisik) ? 'checked' : '' }} />
                        <label class="form-check-label" for="statusFisik3">
                            3
                        </label>
                    </div>
                    <div class="form-check me-2">
                        <input name="asa[]" class="form-check-input" type="checkbox" value="4"
                            id="statusFisik4" {{ in_array('4', $statusFisik) ? 'checked' : '' }} />
                        <label class="form-check-label" for="statusFisik4">
                            4
                        </label>
                    </div>
                    <div class="form-check me-2">
                        <input name="asa[]" class="form-check-input" type="checkbox" value="5"
                            id="statusFisik5" {{ in_array('5', $statusFisik) ? 'checked' : '' }} />
                        <label class="form-check-label" for="statusFisik5">
                            5
                        </label>
                    </div>
                    <div class="form-check me-2">
                        <input name="asa[]" class="form-check-input" type="checkbox" value="E"
                            id="statusFisikE" {{ in_array('E', $statusFisik) ? 'checked' : '' }} />
                        <label class="form-check-label" for="statusFisikE">
                            E
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <label for="editor3" class="form-label">Antisipasi</label>
                    </div>
                    <div class="col-10">
                        <textarea class="form-control form-control-sm" name="antisipasi" id="editor3" rows="3">{!! $item->antisipasi ?? '' !!}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-3 row">
            @foreach ($dataIsCanOperasi as $operasi)
                <div class="col-3">
                    <div class="form-check">
                        <input name="is_can_operasi" class="form-check-input" type="radio"
                            value="{{ $operasi }}" id="{{ $operasi }}"
                            {{ $item->is_can_operasi == $operasi ? 'checked' : '' }} />
                        <label class="form-check-label" for="{{ $operasi }}">
                            {{ $operasi }}
                        </label>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-3 row">
            <p>Rencana Sedasi :</p>
            @foreach ($dataRencanaSedasi as $rencanaSedasi)
                <div class="col-2">
                    <div class="form-check">
                        <input name="rencana_sedasi" class="form-check-input" type="radio"
                            id="{{ $rencanaSedasi }}" value="{{ $rencanaSedasi }}"
                            {{ $item->rencana_sedasi == $rencanaSedasi ? 'checked' : '' }} />
                        <label class="form-check-label" for="{{ $rencanaSedasi }}">
                            {{ $rencanaSedasi }}
                        </label>
                    </div>
                </div>
            @endforeach
        </div>
        {{-- anestesi plan --}}
        <div class="mt-4 col">
            <p>Rencana Anestesi :</p>
            <div class="row row-cols-5 ">
                @foreach ($dataRencanaAnestesi as $rencanaAnestesi)
                    <div class="col">
                        <div class="form-check">
                            <input name="anestesi_plan[]" class="form-check-input" type="checkbox"
                                value="{{ $rencanaAnestesi }}" id="{{ $rencanaAnestesi }}"
                                {{ in_array($rencanaAnestesi, $item->ranapAssesmenPraSedationAnestesiPlans->pluck('name')->toArray()) ? 'checked' : '' }} />
                            <label class="form-check-label" for="{{ $rencanaAnestesi }}">
                                {{ $rencanaAnestesi }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- intruksi pra anestesi --}}
    <div class="mb-4 col">
        <div class="p-3 border rounded">
            <p>INSTRUKSI PRA ANESTESI</p>
            <div class="px-3 pb-5 col">
                <div class="row">
                    <div class="col-2">
                        <p>Puasa</p>
                    </div>
                    <div class="col">
                        <div class="row">
                            @foreach ($dataPuasa as $puasa)
                                <div class="form-check col">
                                    <input name="puasa" class="form-check-input" type="radio"
                                        value="{{ $puasa }}" id="{{ $puasa }}"
                                        {{ $item->ranapAssesmenPraSedationAnestesiInstructions->puasa == $puasa ? 'checked' : '' }} />
                                    <label class="form-check-label" for="{{ $puasa }}">
                                        {{ $puasa }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <p>Obat - obatan diberikan terus</p>
                    </div>
                    <div class="col">
                        <div class="row">
                            <div class="form-check col-2">
                                <input name="obat_diberikan" class="form-check-input" type="radio"
                                    value="1" id="obatObatanDiberikanTerusYa"
                                    {{ $item->ranapAssesmenPraSedationAnestesiInstructions->obat_diberikan === 1 ? 'checked' : '' }} />
                                <label class="form-check-label" for="obatObatanDiberikanTerusYa">
                                    Ya
                                </label>
                            </div>
                            <div class="form-check col">
                                <input name="obat_diberikan" class="form-check-input" type="radio"
                                    value="0" id="obatObatanDiberikanTerusTidak"
                                    {{ $item->ranapAssesmenPraSedationAnestesiInstructions->obat_diberikan === 0 ? 'checked' : '' }} />
                                <label class="form-check-label" for="obatObatanDiberikanTerusTidak">
                                    Tidak
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-2">
                        <label class="form-check-label" for="obatYangDihentikan">Obat yang
                            dihentikan</label>
                    </div>
                    <div class="col">
                        <textarea class="form-control" id="editor4" rows="3" name="obat_diberhentikan">{!! $item->ranapAssesmenPraSedationAnestesiInstructions->obat_diberhentikan ?? '' !!}</textarea>
                    </div>
                </div>

                <div class="mt-4 row">
                    <div class="col-2">
                        <p>Persiapan darah</p>
                    </div>
                    <div class="col">
                        <div class="row">
                            {{-- persiapan darah --}}
                            <div class="col-3">
                                <div class="form-check col">
                                    <input name="persiapan_darah" class="form-check-input" type="radio"
                                        value="1" id="persiapanDarahYa"
                                        onclick="enableDetailPersiapanDarah()"
                                        {{ $item->ranapAssesmenPraSedationAnestesiInstructions->persiapan_darah === 1 ? 'checked' : '' }} />
                                    <label class="form-check-label" for="persiapanDarahYa">
                                        Ya
                                    </label>
                                </div>
                                <div class="form-check col">
                                    <input name="persiapan_darah" class="form-check-input" type="radio"
                                        value="0" id="persiapanDarahTidak"
                                        onclick="disableDetailPersiapanDarah()"
                                        {{ $item->ranapAssesmenPraSedationAnestesiInstructions->persiapan_darah === 0 ? 'checked' : '' }} />
                                    <label class="form-check-label" for="persiapanDarahTidak">
                                        Tidak
                                    </label>
                                </div>
                            </div>
                            {{-- detail persiapan darah --}}
                            @if ($item->ranapAssesmenPraSedationAnestesiInstructions->ranapAssesmenPraSedationPersiapanBloods->isNotEmpty())
                                @foreach ($dataPersiapanDarah as $persiapanDarah)
                                    @if (in_array(
                                            $persiapanDarah['name'],
                                            $item->ranapAssesmenPraSedationAnestesiInstructions->ranapAssesmenPraSedationPersiapanBloods->pluck('name')->toArray()))
                                        @foreach ($item->ranapAssesmenPraSedationAnestesiInstructions->ranapAssesmenPraSedationPersiapanBloods as $blood)
                                            @if ($persiapanDarah['name'] == $blood->name)
                                                <div class="col-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="me-2 form-check">
                                                            <input name="detail_persiapan_darah_name[]"
                                                                class="form-check-input" type="checkbox"
                                                                value="{{ $blood->value ?? '' }}"
                                                                id="{{ $persiapanDarah['name'] }}"
                                                                @checked(true) />
                                                            <label class="form-check-label"
                                                                for="{{ $persiapanDarah['name'] }}">
                                                                {{ $persiapanDarah['name'] }}
                                                            </label>
                                                        </div>
                                                        <input type="number"
                                                            class="form-control form-control-sm"
                                                            value="{{ $blood->value ?? '' }}"
                                                            name="detail_persiapan_darah_value[]"
                                                            style="max-width: 100px;">
                                                        <p class="m-0 mx-2">{{ $persiapanDarah['satuan'] }}
                                                        </p>
                                                    </div>
                                                </div>
                                            @break
                                        @endif
                                    @endforeach
                                @else
                                    <div class="col-3">
                                        <div class="d-flex align-items-center">
                                            <div class="me-2 form-check">
                                                <input name="detail_persiapan_darah_name[]"
                                                    class="form-check-input" type="checkbox"
                                                    value="{{ $persiapanDarah['name'] }}"
                                                    id="{{ $persiapanDarah['name'] }}" />
                                                <label class="form-check-label"
                                                    for="{{ $persiapanDarah['name'] }}">
                                                    {{ $persiapanDarah['name'] }}
                                                </label>
                                            </div>
                                            <input type="number" class="form-control form-control-sm"
                                                name="detail_persiapan_darah_value[]"
                                                style="max-width: 100px;">
                                            <p class="m-0 mx-2">{{ $persiapanDarah['satuan'] }}</p>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @else
                            @foreach ($dataPersiapanDarah as $persiapanDarah)
                                <div class="col-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-2 form-check">
                                            <input name="detail_persiapan_darah_name[]"
                                                class="form-check-input" type="checkbox"
                                                value="{{ $persiapanDarah['name'] }}"
                                                id="{{ $persiapanDarah['name'] }}"
                                                @disabled(true) />
                                            <label class="form-check-label"
                                                for="{{ $persiapanDarah['name'] }}">
                                                {{ $persiapanDarah['name'] }}
                                            </label>
                                        </div>
                                        <input type="number" class="form-control form-control-sm"
                                            name="detail_persiapan_darah_value[]"
                                            style="max-width: 100px;" @disabled(true)>
                                        <p class="m-0 mx-2">{{ $persiapanDarah['satuan'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mb-4 col">
    <p class="m-0">Perencanaan Pasca Anestesi : </p>
    <div class="row">
        @foreach ($dataPascaAnestesi as $pascaAnestesi)
            <div class="col-2">
                <div class="form-check ">
                    <input name="pasca_anestesi" class="form-check-input" type="radio"
                        value="{{ $pascaAnestesi }}" id="{{ $pascaAnestesi }}"
                        {{ $item->pasca_anestesi == $pascaAnestesi ? 'checked' : '' }} />
                    <label class="form-check-label" for="{{ $pascaAnestesi }}">
                        {{ $pascaAnestesi }}
                    </label>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="mb-3 col">
    <p class="m-0">Rencana Pemberian Obat analgesia pasca
        operasi</p>
    <textarea class="form-control" name="obat_analgesia" id="editor5" rows="3">{!! $item->obat_analgesia ?? '' !!}</textarea>
</div>

{{-- tanda tangan --}}
<div class="row mb-5 mt-4">
    <div class="col-3 text-center">DPJP Anestesi</div>
</div>
<div class="row mb-3">
    <div class="col-3 text-center">
        <img src="{{ Storage::Url($item->ttd_dpjp_anestesi ?? '') }}" alt="" id="ttdImage"
            class="border">
        <textarea id="ttdTextArea" name="ttd_dpjp_anestesi" style="display: none;"></textarea>
        <button type="button" class="col-12 btn btn-sm btn-dark" onclick="openModal(this)">Tanda
            Tangan</button>
    </div>
</div>
<div class="row mb-5">
    <div class="col-3 text-center">
        <input type="text" class="form-control form-control-sm text-center" id="nama_user"
            value="" name="nama_dpjp_anestesi" placeholder="Nama Lengkap" @readonly(true)>
    </div>
</div>

<div class="mb-3 text-end">
    <button type="submit" class="btn btn-success btn-sm">Simpan</button>
</div>
</div>
</form>
</div>

{{-- modal create ttd --}}
<div class="modal fade" id="getTtdModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
    <h5 class="modal-title" id="modalScrollableTitle">Masukkan Password Akun Anda</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
    </button>
</div>
<div class="modal-body">
    <div id="signature-pad" class="m-signature-pad">
        <div class="m-signature-pad--body mb-3">
            <input type="password" class="form-control form-control-sm" name="password_user">
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
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
    function evaluasiJalanNafas(element) {
        var row = element.parentNode.parentNode;
        var newDiv = document.createElement('div');
        newDiv.className = 'col-12 d-flex mt-1';
        newDiv.innerHTML = `    <input name="evaluasiJalanNafas[]" class="form-control form-control-sm" type="text" value="" id="evaluasiJalanNafas_lain"/>
                            <button type="button" class="btn btn-danger btn-sm mx-2" onclick="deleteInputLain(this)"><i class="bx bx-minus"></i></button>
                        `;
        row.append(newDiv);
    }

    function evaluasiJalanNafasDelete(element) {
        var parent = element.parentNode;
        parent.remove();
    }
</script>
<script>
    function inputAnamnesaLain(element) {
        var checkboxPasien = document.getElementById('anamnesaPasien');
        var checkboxKeluarga = document.getElementById('anamnesaKeluarga');

        checkboxPasien.checked = false;
        checkboxKeluarga.checked = false;

        element.name = 'anamnesa';
    }

    function clearValueInput() {
        var input = document.getElementById('inputAnamnesa');
        input.value = '';
        input.removeAttribute('name');
    }
</script>

<script>
    function addInputLain(element) {
        var row = element.parentNode.parentNode;
        var newDiv = document.createElement('div');
        newDiv.className = 'col-4 d-flex mt-1';
        newDiv.innerHTML = `    <input name="riwayat_penyakit[]" class="form-control form-control-sm" type="text" value="" id="riwayat_penyakit_lain"/>
                                    <button type="button" class="btn btn-danger btn-sm mx-2" onclick="deleteInputLain(this)"><i class="bx bx-minus"></i></button>
                                `;
        row.append(newDiv);
    }

    function deleteInputLain(element) {
        var parent = element.parentNode;
        parent.remove();
    }
</script>
<script type="text/javascript">
    function enableDetailPersiapanDarah() {
        var inputNames = document.querySelectorAll('input[name="detail_persiapan_darah_name[]"]');
        var inputValues = document.querySelectorAll('input[name="detail_persiapan_darah_value[]"]');
        inputNames.forEach(function(name) {
            name.disabled = false;
        });
        inputValues.forEach(function(value) {
            value.disabled = false;
        });
    }

    function disableDetailPersiapanDarah() {
        var inputNames = document.querySelectorAll('input[name="detail_persiapan_darah_name[]"]');
        var inputValues = document.querySelectorAll('input[name="detail_persiapan_darah_value[]"]');
        inputNames.forEach(function(name) {
            name.disabled = true;
            name.checked = false;
        });
        inputValues.forEach(function(nilai) {
            nilai.disabled = true;
            nilai.value = '';
        });
    }
</script>
<script>
    function openModal(element) {
        $('#getTtdModal').modal('show');
    }

    document.addEventListener("DOMContentLoaded", function() {
        var modal = document.getElementById("getTtdModal");
        var clearButton = modal.querySelector("[data-action=clear]");
        var saveButton = modal.querySelector("[data-action=save]");
        var inputPass = modal.querySelector('input[name="password_user"]');
        var inputUserId = modal.querySelector('input[name="user_id"]');

        clearButton.addEventListener('click', function(e) {
            e.preventDefault();
            signaturePad.clear();
        });

        saveButton.addEventListener("click", function(e) {
            e.preventDefault();
            $.ajax({
                type: 'get',
                url: "{{ route('ranap/cppt.getTtd') }}",
                data: {
                    user_id: inputUserId.value,
                    password: inputPass.value,
                },
                success: function(data) {
                    var newSrc = `{{ Storage::url('${data}') }}`;
                    $('#ttdImage').attr('src', newSrc);
                    $('#ttdTextArea').val(data);
                    $('#nama_user').val(`{{ auth()->user()->name }}`);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log();
                    var errorResponse = jqXHR.responseJSON;
                    if (errorResponse && errorResponse.error) {
                        alert(errorResponse.error)
                    } else {
                        alert('Terjadi Kesalahan Dalam Pengambilan Data');
                    }
                }
            });

            inputPass.value = '';

            $('#getTtdModal').modal('hide');
        });
    });
</script>
@endsection
