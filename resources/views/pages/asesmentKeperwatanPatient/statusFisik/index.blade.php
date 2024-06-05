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
            <h6 class="text-center bg-dark text-white py-2">STATUS FISIK</h6>
            <form action="{{ route('rajal/asesmen/status/fisik.store', $item->id) }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-sm-4 ">
                        <p class="fw-bold m-0">Kondisi Umum :</p>
                        <div class="mb-3 mx-3">
                            <div class="mb-3 mx-3">
                                @foreach ($kondisiUmum as $umum)
                                    @php
                                        $checked = null;
                                        if ($statusFisik) {
                                            $detail = $statusFisik->detailStatusFisikDiagnosaKeperawatanPatient
                                                ->where('name', $umum)
                                                ->first();
                                            if ($detail) {
                                                $checked = 'checked';
                                            }
                                        }
                                    @endphp
                                    <div class="form-check">
                                        <input class="form-check-input kondisi-umum-checkbox" type="checkbox"
                                            name="kondisi-umum[]" value="{{ $umum }}" id="{{ $umum }}"
                                            {{ $checked }} />
                                        <label class="form-check-label" for="{{ $umum }}">
                                            {{ $umum }}
                                        </label>
                                    </div>
                                @endforeach
                                <div class="form-group">
                                    @php
                                        $lainnyaCheckboxChecked = false;
                                        // Periksa apakah variabel $statusFisik tidak null dan memiliki properti yang diinginkan
                                        if ($statusFisik && $statusFisik->detailStatusFisikDiagnosaKeperawatanPatient) {
                                            // Lakukan iterasi dan periksa properti yang diinginkan
                                            foreach (
                                                $statusFisik->detailStatusFisikDiagnosaKeperawatanPatient
                                                as $detail
                                            ) {
                                                if (
                                                    $detail->category === 'Kondisi Umum' &&
                                                    !in_array($detail->name, $kondisiUmum)
                                                ) {
                                                    $lainnyaCheckboxChecked = true;
                                                    break; // Hentikan perulangan jika sudah ditemukan
                                                }
                                            }
                                        }
                                    @endphp



                                    <div class="form-check">
                                        <input class="form-check-input lainnya-checkbox" type="checkbox"
                                            name="lainnya-checkbox" id="lainnya-checkbox"
                                            {{ $lainnyaCheckboxChecked ? 'checked' : '' }} />
                                        <div class="d-flex flex-row">
                                            <label class="form-check-label" for="lainnya-checkbox">
                                                Lainnya
                                            </label>
                                            <input type="text" class="form-control form-control-sm lainnya-input ms-1"
                                                id="lainnya" name="kondisi-umum[]"
                                                value="{{ optional($statusFisik)->detailStatusFisikDiagnosaKeperawatanPatient
                                                    ? $statusFisik->detailStatusFisikDiagnosaKeperawatanPatient->where('category', 'Kondisi Umum')->whereNotIn('name', $kondisiUmum)->pluck('name')->first()
                                                    : '' }}"
                                                placeholder="Deskripsi Lainnya" aria-describedby="floatingInputHelp"
                                                disabled />
                                        </div>
                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>

                    <div class="col-sm-4 ">
                        <p class="fw-bold m-0">Kesadaran :</p>
                        <div class="mb-3 mx-3">
                            @foreach ($kesadaran as $sadar)
                                @php
                                    $checked = null;
                                    if ($statusFisik) {
                                        $detail = $statusFisik->detailStatusFisikDiagnosaKeperawatanPatient
                                            ->where('name', $sadar)
                                            ->first();
                                        if ($detail) {
                                            $checked = 'checked';
                                        }
                                    }
                                @endphp
                                <div class="form-check">
                                    <input class="form-check-input disabled" type="checkbox" name="kesadaran[]"
                                        value="{{ $sadar }}" id="{{ $sadar }}" {{ $checked }} />
                                    <label class="form-check-label" for="{{ $sadar }}">
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
                                    $checked = null;
                                    if ($statusFisik) {
                                        $detail = $statusFisik->detailStatusFisikDiagnosaKeperawatanPatient
                                            ->where('name', $khusus)
                                            ->first();
                                        if ($detail) {
                                            $checked = 'checked';
                                        }
                                    }
                                @endphp
                                <div class="form-check">
                                    <input class="form-check-input disabled" type="checkbox" name="kebutuhan-khusus[]"
                                        value="{{ $khusus }}" id="{{ $khusus }}" {{ $checked }} />
                                    <label class="form-check-label" for="{{ $khusus }}">
                                        {{ $khusus }}
                                    </label>
                                </div>
                            @endforeach
                            <div class="form-group">
                                @php
                                    $khususCheckboxChecked = false;
                                    // Periksa apakah $statusFisik tidak null dan apakah ada data dengan kategori "Kebutuhan Khusus" dan nilai yang tidak ada dalam array kebutuhan khusus
                                    if ($statusFisik) {
                                        foreach ($statusFisik->detailStatusFisikDiagnosaKeperawatanPatient as $detail) {
                                            if (
                                                $detail->category === 'Kebutuhan Khusus' &&
                                                !in_array($detail->name, $kebutuhanKhusus)
                                            ) {
                                                $khususCheckboxChecked = true;
                                                break; // Hentikan perulangan jika sudah ditemukan
                                            }
                                        }
                                    }
                                @endphp



                                <div class="form-check">
                                    <input class="form-check-input khusus-checkbox" type="checkbox" name="khusus-checkbox"
                                        id="khusus-checkbox" {{ $khususCheckboxChecked ? 'checked' : '' }} />
                                    <div class="d-flex flex-row">
                                        <label class="form-check-label" for="khusus-checkbox">
                                            Lainnya
                                        </label>
                                        <input type="text" class="form-control form-control-sm khusus-input ms-1"
                                            id="khusus" name="kebutuhan-khusus[]"
                                            value="{{ $statusFisik ? $statusFisik->detailStatusFisikDiagnosaKeperawatanPatient->where('category', 'Kebutuhan Khusus')->whereNotIn('name', $kebutuhanKhusus)->pluck('name')->first() : '' }}"
                                            placeholder="Deskripsi Lainnya" aria-describedby="floatingInputHelp" disabled />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row mb-3">
                    <div class="col-4 col-lg-2">
                        <div class="row">
                            <label class="form-control-label col-sm-12 fw-bold" for="lainya">Tekanan Darah</label>
                            <div class="d-flex flex-row">
                                <input type="text" class="form-control form-control-sm" name="darah" id="lainnya"
                                    value="{{ $statusFisik->darah ?? '0' }}" aria-describedby="floatingInputHelp" />
                                <p class="m-0 ps-1">mmhg</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 col-lg-2">
                        <div class="row">
                            <label class="form-control-label col-sm-12 fw-bold" for="lainya">Nadi</label>
                            <div class="d-flex flex-row">
                                <input type="number" class="form-control form-control-sm" name="nadi" id="lainnya"
                                    value="{{ $statusFisik->nadi ?? '0' }}" aria-describedby="floatingInputHelp" />
                                <p class="m-0 ps-1">x/menit</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 col-lg-2">

                        <div class="row">
                            <label class="form-control-label col-sm-12 fw-bold" for="lainnya">Suhu</label>
                            <div class="d-flex flex-row">
                                <input type="text" class="form-control form-control-sm" name="suhu" id="lainnya"
                                    value="{{ $statusFisik->suhu ?? '0' }}" aria-describedby="floatingInputHelp"
                                    oninput="validateTemperatureInput(this)" />
                                <p class="m-0 ps-1">°C</p>
                            </div>
                        </div>

                    </div>
                    <div class="col-4 col-lg-2">
                        <div class="row">
                            <label class="form-control-label col-sm-12 fw-bold" for="lainya">Pernafasan</label>
                            <div class="d-flex flex-row">
                                <input type="number" class="form-control form-control-sm" name="pernafasan"
                                    id="lainnya" value="{{ $statusFisik->pernafasan ?? '0' }}"
                                    aria-describedby="floatingInputHelp" />
                                <p class="m-0 ps-1">x/menit</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 col-lg-2">
                        <div class="row">
                            <label class="form-control-label col-sm-12 fw-bold" for="lainya">Tinggi Badan</label>
                            <div class="d-flex flex-row">
                                <input type="number" class="form-control form-control-sm" id="lainnya" name="tb"
                                    value="{{ $statusFisik->tb ?? '0' }}" aria-describedby="floatingInputHelp" />
                                <p class="m-0 ps-1">CM</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 col-lg-2">
                        <div class="row">
                            <label class="form-control-label col-sm-12 fw-bold" for="lainya">Berat Badan</label>
                            <div class="d-flex flex-row">
                                <input type="number" class="form-control form-control-sm" id="lainnya" name="bb"
                                    value="{{ $statusFisik->bb ?? '0' }}" aria-describedby="floatingInputHelp" />
                                <p class="m-0 ps-1">Kg</p>
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
                                <div class="form-check">
                                    <input class="form-check-input disabled" type="checkbox" name="psikologis[]"
                                        value="{{ $psiko }}" id="{{ $psiko }}"
                                        {{ in_array($psiko, $psikos) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="{{ $psiko }}">
                                        {{ $psiko }}
                                    </label>
                                </div>
                            @endforeach
                            <div class="form-group">
                                @php
                                    $khususCheckboxChecked = false;
                                    // Periksa apakah ada data dengan kategori "Kondisi Umum" dan nilai yang tidak ada dalam array kondisi umum
                                    foreach ($dbpsiko->detailPsikoSosioSpritualDiagnosaKeperawatanPatient as $detail) {
                                        if (
                                            $detail->category === 'psikologis' &&
                                            !in_array($detail->name, $psikologis)
                                        ) {
                                            $khususCheckboxChecked = true;
                                            break; // Hentikan perulangan jika sudah ditemukan
                                        }
                                    }
                                @endphp
                                <div class="form-check">
                                    <input class="form-check-input psikologis-checkbox" type="checkbox"
                                        name="psikologis-checkbox" id="psikologis-checkbox"
                                        {{ $khususCheckboxChecked ? 'checked' : '' }} />
                                    <div class="d-flex flex-row">
                                        <label class="form-check-label" for="psikologis-checkbox">
                                            Lainnya
                                        </label>
                                        <input type="text" class="form-control form-control-sm psikologis-input ms-1"
                                            id="psikologis" name="psikologis[]"
                                            value="{{ $dbpsiko->detailPsikoSosioSpritualDiagnosaKeperawatanPatient->where('category', 'psikologis')->whereNotIn('name', $psikologis)->pluck('name')->first() }}"
                                            placeholder="Deskripsi Lainnya" aria-describedby="floatingInputHelp"
                                            disabled />
                                    </div>
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
                                        <span class="mx-2"><input type="text" name="pasien"
                                                value="{{ $sosials->where('name', 'Pasien tinggal dirumah dengan siapa')->pluck('value')->first() ?? '' }}"
                                                class="form-control form-control-sm" id="lainnya" placeholder=""
                                                aria-describedby="floatingInputHelp" /></span>
                                    </p>
                                </li>
                                <li class="mt-1">
                                    <div class="row">
                                        <div class="col-sm-auto">
                                            Interaksi dengan lingkungan sekitar
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="d-flex flex-row">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" name="interaksi" type="radio"
                                                        id="inlineCheckbox1" value="Baik"
                                                        {{ $sosials->where('name', 'Interaksi dengan lingkungan sekitar')->pluck('value')->first() == 'Baik' ? 'checked' : '' }} />
                                                    <label class="form-check-label" for="inlineCheckbox1">Baik</label>
                                                </div>
                                                <div class="form-check form-check-inline col-12">
                                                    <input class="form-check-input" name="interaksi" type="radio"
                                                        id="inlineCheckbox2" value="Tidak Baik"
                                                        {{ $sosials->where('name', 'Interaksi dengan lingkungan sekitar')->pluck('value')->first() == 'Tidak Baik' ? 'checked' : '' }} />
                                                    <label class="form-check-label" for="inlineCheckbox2">Tidak
                                                        Baik</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="mt-1">
                                    @php
                                        $name = '';
                                        $hub = '';
                                        if (
                                            $string = $sosials
                                                ->where('name', 'Datang kerumah sakit dengan siapa')
                                                ->pluck('value')
                                                ->first()
                                        ) {
                                            $arr = explode('/ Hubungan : ', $string);
                                            $name = $arr[0];
                                            $hub = $arr[1];
                                        }
                                    @endphp
                                    <p class="m-0 d-flex">Datang kerumah sakit dengan siapa
                                        <span class="mx-2"><input type="text" name="datang"
                                                value="{{ $name }}" class="form-control form-control-sm"
                                                id="lainnya" placeholder=""
                                                aria-describedby="floatingInputHelp" /></span>
                                        Hubungan
                                        <span class="mx-2"><input type="text" name="hubungan"
                                                value="{{ $hub }}" class="form-control form-control-sm"
                                                id="lainnya" placeholder=""
                                                aria-describedby="floatingInputHelp" /></span>
                                    </p>
                                </li>
                                <li class="mt-1">

                                    @php
                                        $name = '';
                                        $hub = '';
                                        $telp = '';

                                        if (
                                            $string = $sosials
                                                ->where('name', 'Kerabat terdekat yang bisa dihubungi : ')
                                                ->pluck('value')
                                                ->first()
                                        ) {
                                            $arr1 = explode('Nama : ', $string);
                                            if (isset($arr1[1])) {
                                                $arr2 = explode(' Hubungan ', $arr1[1]);
                                                if (isset($arr2[1])) {
                                                    $arr3 = explode(' Telepon ', $arr2[1]);
                                                    $name = trim($arr2[0]);
                                                    if (isset($arr3[1])) {
                                                        $hub = trim($arr3[0]);
                                                        $telp = trim($arr3[1]);
                                                    } else {
                                                        $hub = trim($arr2[1]);
                                                    }
                                                } else {
                                                    $name = trim($arr2[0]);
                                                }
                                            }
                                        }
                                    @endphp

                                    <p class="m-0">Kerabat terdekat yang bisa dihubungi : <br>
                                    <div class="d-flex">
                                        Nama
                                        <span class="mx-2"><input type="text" name="kerabat-nama"
                                                value="{{ $name }}" class="form-control form-control-sm"
                                                id="lainnya" placeholder=""
                                                aria-describedby="floatingInputHelp" /></span>
                                        Hubungan
                                        <span class="mx-2"><input type="text" name="kerabat-hubungan"
                                                value="{{ $hub }}" class="form-control form-control-sm"
                                                id="lainnya" placeholder=""
                                                aria-describedby="floatingInputHelp" /></span>
                                        Telepon
                                        <span class="mx-2"><input type="number" name="kerabat-hp"
                                                value="{{ $telp }}" class="form-control form-control-sm"
                                                id="lainnya" placeholder=""
                                                aria-describedby="floatingInputHelp" /></span>
                                    </div>
                                    </p>
                                </li>
                                <li>
                                    @php
                                        // Ambil data dari database
                                        $record = $sosials
                                            ->where('category', 'sosial')
                                            ->where('name', 'Hambatan Sosial')
                                            ->pluck('value')
                                            ->first();

                                        // Inisialisasi variabel
                                        $hambatanSosial = '';
                                        $keteranganHambatanSosial = '';

                                        // Parsing nilai jika ada data
                                        if ($record) {
                                            if (strpos($record, ' Keterangan : ') !== false) {
                                                [$hambatanSosial, $keteranganHambatanSosial] = explode(
                                                    ' Keterangan : ',
                                                    $record,
                                                );
                                            } else {
                                                $hambatanSosial = $record;
                                            }
                                        }
                                    @endphp

                                    <div class="row">
                                        <div class="d-flex flex-row">
                                            <span>Hambatan Sosial</span>
                                            <div class="ms-2">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="hambatan-sosial"
                                                        id="inlineCheckbox1" onclick="disableHambatanSosial()"
                                                        value="Tidak Ada"
                                                        {{ $hambatanSosial === 'Tidak Ada' ? 'checked' : '' }} />
                                                    <label class="form-check-label" for="inlineCheckbox1">Tidak
                                                        Ada</label>
                                                </div>
                                            </div>
                                            <div class="">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="hambatan-sosial"
                                                        id="inlineCheckbox2" onclick="enableHambatanSosial()"
                                                        value="Ada" {{ $hambatanSosial === 'Ada' ? 'checked' : '' }} />
                                                    <label class="form-check-label d-flex" for="inlineCheckbox2">
                                                        Ada, sebutkan
                                                        <span class="mx-2">
                                                            <input type="text" name="ket-hambatan-sosial"
                                                                class="form-control form-control-sm"
                                                                id="input-hambatan-sosial" placeholder=""
                                                                aria-describedby="floatingInputHelp"
                                                                value="{{ $keteranganHambatanSosial ?? '' }}"
                                                                {{ $hambatanSosial === 'Ada' ? '' : 'disabled' }} />
                                                        </span>
                                                    </label>
                                                </div>
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
                                <div class="mb-2 col-sm-1">
                                    <input class="form-check-input" type="checkbox" value="Sehat"
                                        name="spiritual_sehat" id="SpiritualSehat"
                                        onclick="toggleInput('SpiritualSehat', 'input-sehat')"
                                        {{ $spirituals->where('name', 'Sehat')->first() ? 'checked' : '' }} />
                                    <label for="SpiritualSehat" class="form-check-label">
                                        <p class="m-0">Sehat</p>
                                    </label>
                                </div>
                                <div class="mb-2 col-sm-2">
                                    <input type="text" name="ket-sehat"
                                        value="{{ $spirituals->where('name', 'Sehat')->pluck('value')->first() }}"
                                        class="form-control form-control-sm" id="input-sehat" placeholder=""
                                        aria-describedby="floatingInputHelp"
                                        {{ $spirituals->where('name', 'Sehat')->first() ? '' : 'disabled' }} />
                                </div>
                                <div class="mb-2 col-sm-9"></div>
                                <div class="mb-2 col-sm-1">
                                    <input class="form-check-input" type="checkbox" value="Sakit"
                                        name="spiritual_sakit" id="SpiritualSakit"
                                        onclick="toggleInput('SpiritualSakit', 'input-sakit')"
                                        {{ $spirituals->where('name', 'Sakit')->first() ? 'checked' : '' }} />
                                    <label for="SpiritualSakit" class="form-check-label">
                                        <p class="m-0">Sakit</p>
                                    </label>
                                </div>
                                <div class="mb-2 col-sm-2">
                                    <input type="text" name="ket-sakit"
                                        value="{{ $spirituals->where('name', 'Sakit')->pluck('value')->first() ?? '' }}"
                                        class="form-control form-control-sm" id="input-sakit" placeholder=""
                                        aria-describedby="floatingInputHelp"
                                        {{ $spirituals->where('name', 'Sakit')->first() ? '' : 'disabled' }} />
                                </div>
                                <div class="mb-2 col-sm-9"></div>
                                <div class="mb-2 col-sm-auto">
                                    <input class="form-check-input" type="checkbox" value="Hambatan Spiritual"
                                        name="spiritual_hamSpiritual" id="hamSpiritual"
                                        onclick="toggleInputs()" 
                                        {{ $spirituals->where('name', 'Hambatan Spiritual')->isNotEmpty() ? 'checked' : '' }} />
                                    <label class="form-check-label" for="hamSpiritual">Hambatan Spiritual</label>
                                </div>
                                <div class="mb-2 col-sm-auto">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="hambatan-spiritual"
                                            id="tidakAdaH" value="Tidak Ada" onclick="toggleInputDetail()"
                                            {{ $spirituals->where('name', 'Hambatan Spiritual')->pluck('value')->first() == 'Tidak Ada' ? 'checked' : '' }}
                                            {{ $spirituals->where('name', 'Hambatan Spiritual')->isEmpty() ? 'disabled' : '' }} />
                                        <label class="form-check-label" for="tidakAdaH">Tidak Ada</label>
                                    </div>
                                </div>
                                <div class="mb-2 col-sm-auto">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="hambatan-spiritual"
                                            id="AdaH" value="Ada" onclick="toggleInputDetail()"
                                            {{ $spirituals->where('name', 'Hambatan Spiritual')->isNotEmpty() && $spirituals->where('name', 'Hambatan Spiritual')->pluck('value')->first() != 'Tidak Ada' ? 'checked' : '' }}
                                            {{ $spirituals->where('name', 'Hambatan Spiritual')->isEmpty() ? 'disabled' : '' }} />
                                        <label class="form-check-label d-flex" for="AdaH">
                                            Ada, sebutkan
                                            <span class="mx-2">
                                                <input type="text" name="ket-hambatan-spiritual"
                                                    value="{{ $spirituals->where('name', 'Hambatan Spiritual')->pluck('value')->first() != 'Tidak Ada' ? $spirituals->where('name', 'Hambatan Spiritual')->pluck('value')->first() : '' }}"
                                                    class="form-control form-control-sm" id="input-hamSpiritual" placeholder=""
                                                    aria-describedby="floatingInputHelp"
                                                    {{ $spirituals->where('name', 'Hambatan Spiritual')->isNotEmpty() && $spirituals->where('name', 'Hambatan Spiritual')->pluck('value')->first() != 'Tidak Ada' ? '' : 'disabled' }} />
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                
                                
                                
                            </div>



                            <div class="row">
                                <div class="col-sm-auto">
                                    Kultural / Nilai Kepercayaan :
                                </div>
                                @php
                                    // Ambil data dari database
                                    $record = $spirituals
                                        ->where('category', 'spritual')
                                        ->where('name', 'Kultular / Nilai kepercayaan')
                                        ->pluck('value')
                                        ->first();

                                    // Inisialisasi variabel
                                    $nilaiKepercayaan = '';
                                    $ketNilaiKepercayaan = '';

                                    // Parsing nilai jika ada data
                                    if ($record) {
                                        if (strpos($record, ' Keterangan : ') !== false) {
                                            [$nilaiKepercayaan, $ketNilaiKepercayaan] = explode(
                                                ' Keterangan : ',
                                                $record,
                                            );
                                        } else {
                                            $nilaiKepercayaan = $record;
                                        }
                                    }
                                @endphp
                                <div class="col-sm-auto">
                                    <div class="form-check form-check-inline">

                                        <input class="form-check-input" type="radio" name="nilai-kepercayaan"
                                            id="inlineCheckbox1" onclick="disableKepercayaan()" value="Tidak Ada"
                                            {{ $nilaiKepercayaan === 'Tidak Ada' ? 'checked' : '' }} />
                                        <label class="form-check-label" for="inlineCheckbox1">Tidak Ada</label>

                                    </div>
                                </div>
                                <div class="col-sm-auto">
                                    <div class="form-check form-check-inline">

                                        <input class="form-check-input" type="radio" name="nilai-kepercayaan"
                                            id="inlineCheckbox2" onclick="enableKepercayaan()" value="Ada"
                                            {{ $nilaiKepercayaan === 'Ada' ? 'checked' : '' }} />
                                        <label class="form-check-label d-flex" for="inlineCheckbox2">
                                            Ada, sebutkan
                                            <span class="mx-2">
                                                <input type="text" name="ket-nilai-kepercayaan"
                                                    class="form-control form-control-sm" id="input-ket-nilai-kepercayaan"
                                                    placeholder="" aria-describedby="floatingInputHelp"
                                                    value="{{ $ketNilaiKepercayaan ?? '' }}"
                                                    {{ $nilaiKepercayaan === 'Ada' ? '' : 'disabled' }} />
                                            </span>
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
                                        <input class="form-check-input" name="rohani" type="radio" id="rohani1"
                                            onclick="disableRohani()" value="Tidak"
                                            {{ $spirituals->where('name', 'Apakah pasien memerlukan pelayanan / bimbingan rohani')->pluck('value')->first() == 'Tidak' ? 'checked' : '' }} />
                                        <label class="form-check-label" for="rohani1">Tidak</label>
                                    </div>
                                </div>
                                <div class="col-sm-auto">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="rohani" type="radio" id="rohani2"
                                            onclick="enableRohani()" value="Ya"
                                            {{ $spirituals->where('name', 'Apakah pasien memerlukan pelayanan / bimbingan rohani')->pluck('value')->first() != 'Tidak' ? 'checked' : '' }} />
                                        <label class="form-check-label d-flex" for="rohani2">
                                            Ya
                                            <span class="mx-2"><input type="text"
                                                    value="{{ $spirituals->where('name', 'Apakah pasien memerlukan pelayanan / bimbingan rohani')->pluck('value')->first() != 'Tidak' ? $spirituals->where('name', 'Apakah pasien memerlukan pelayanan / bimbingan rohani')->pluck('value')->first() : '' }}"
                                                    name="ket-rohani" class="form-control form-control-sm"
                                                    id="input-ket-rohani"
                                                    {{ $spirituals->where('name', 'Apakah pasien memerlukan pelayanan / bimbingan rohani')->pluck('value')->first() != 'Tidak' ? '' : 'disabled' }}
                                                    placeholder="" aria-describedby="floatingInputHelp" /></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <h6 class="text-center bg-dark text-white py-2">EKONOMI</h6>
                    <div class="row border">
                        <div class="col-sm-6">
                            <div class="d-flex flex-column mb-3">
                                <div class="">
                                    Pasien menggunakan :
                                </div>
                                <div class="col-6">
                                    <select class="form-control form-control-sm select2" id="" name="status">
                                        <option value="{{ $item->patientCategory->name }}" selected>
                                            {{ $item->patientCategory->name }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 d-flex align-self-center">
                            <div class="row">
                                <div class="col-sm-auto">
                                    Hambatan Ekonomi
                                </div>

                                <div class="d-flex flex-row">
                                    <div class="">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="hambatan-ekonomi"
                                                id="hambatan-ekonomi1" onclick="disableHambatanEkonomi()" value="Tidak"
                                                {{ ($ekonomi->hambatan ?? '') == 'Tidak Ada' ? 'checked' : '' }} />
                                            <label class="form-check-label" for="hambatan-ekonomi1">Tidak</label>
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="hambatan-ekonomi"
                                                id="hambatan-ekonomi2" onclick="enableHambatanEkonomi()" value="Ada"
                                                {{ ($ekonomi->hambatan ?? '') != 'Tidak Ada' ? 'checked' : '' }} />
                                            <label class="form-check-label d-flex" for="hambatan-ekonomi2">
                                                Ada, sebutkan
                                                <span class="mx-2">
                                                    <input type="text" name="ket-hambatan-ekonomi"
                                                        value="{{ optional($ekonomi)->hambatan != 'Tidak Ada' ? optional($ekonomi)->hambatan : '' }}"
                                                        class="form-control form-control-sm"
                                                        id="input-ket-hambatan-ekonomi"
                                                        {{ ($ekonomi->hambatan ?? '') == 'Tidak Ada' ? 'disabled' : '' }}
                                                        placeholder="" aria-describedby="floatingInputHelp" />
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h6 class="text-center bg-dark text-white py-2">RIWAYAT ALERGI</h6>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="alergi" value="Tidak Ada"
                                onclick="disableRiwayatAlergi()" value="Tidak Ada" id="alergi1"
                                {{ ($alergi->status ?? '') == 'Tidak Ada' ? 'checked' : '' }} />
                            <label class="form-check-label" for="defaultCheck1">
                                Tidak Ada
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="alergi" value="Tidak Diketahui"
                                onclick="disableRiwayatAlergi()" value="Tidak Diketahui" id="alergi2"
                                {{ ($alergi->status ?? '') == 'Tidak Diketahui' ? 'checked' : '' }} />
                            <label class="form-check-label" for="defaultCheck2">
                                Tidak Diketahui
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="alergi" value="Ada"
                                onclick="enableRiwayatAlergi()" value="Ada" id="alergi3"
                                {{ ($alergi->status ?? '') == 'Ada' ? 'checked' : '' }} />
                            <label class="form-check-label" for="defaultCheck3">
                                Ada
                            </label>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-2">
                                <p class="m-0">Alergi Obat</p>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" name="ket-alergi[]" class="form-control form-control-sm"
                                    value="{{ $alergiArray[0]['alergi'] ?? '' }}" id="input-riwayat-alergi-1"
                                    {{ $alergi->status ?? '' == 'Ada' ? '' : 'disabled' }} placeholder=""
                                    aria-describedby="floatingInputHelp" />
                            </div>
                            <div class="col-sm-1">
                                <p class="m-0">Reaksi</p>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" name="reaksi[]" value="{{ $alergiArray[0]['reaksi'] ?? '' }}"
                                    class="form-control form-control-sm" id="input-riwayat-alergi-2"
                                    {{ $alergi->status ?? '' == 'Ada' ? '' : 'disabled' }} placeholder=""
                                    aria-describedby="floatingInputHelp" />
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-2">
                                <p class="m-0">Alergi Makanan</p>
                            </div>
                            <div class="col-sm-4">

                                <input type="text" name="ket-alergi[]" class="form-control form-control-sm"
                                    value="{{ $alergiArray[1]['alergi'] ?? '' }}" id="input-riwayat-alergi-3"
                                    {{ $alergi->status ?? '' == 'Ada' ? '' : 'disabled' }} placeholder=""
                                    aria-describedby="floatingInputHelp" />
                            </div>
                            <div class="col-sm-1">
                                <p class="m-0">Reaksi</p>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" name="reaksi[]" value="{{ $alergiArray[1]['reaksi'] ?? '' }}"
                                    class="form-control form-control-sm" id="input-riwayat-alergi-4"
                                    {{ $alergi->status ?? '' == 'Ada' ? '' : 'disabled' }} placeholder=""
                                    aria-describedby="floatingInputHelp" />
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-2">
                                <p class="m-0">Alergi Lainnya</p>
                            </div>
                            <div class="col-sm-4">

                                <input type="text" name="ket-alergi[]" value="{{ $alergiArray[2]['alergi'] ?? '' }}"
                                    class="form-control form-control-sm" id="input-riwayat-alergi-5"
                                    {{ $alergi->status ?? '' == 'Ada' ? '' : 'disabled' }} placeholder=""
                                    aria-describedby="floatingInputHelp" />

                            </div>
                            <div class="col-sm-1">
                                <p class="m-0">Reaksi</p>
                            </div>
                            <div class="col-sm-4">

                                <input type="text" name="reaksi[]" value="{{ $alergiArray[2]['reaksi'] ?? '' }}"
                                    class="form-control form-control-sm" id="input-riwayat-alergi-6"
                                    {{ $alergi->status ?? '' == 'Ada' ? '' : 'disabled' }} placeholder=""
                                    aria-describedby="floatingInputHelp" />

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
                                    <input class="form-check-input" name="rasa-nyeri" type="radio" id="rasa-nyeri1"
                                        onclick="disableNyeri()" value="Tidak"
                                        {{ ($skrinAsesmenNyeri->status ?? '') == 'Tidak' ? 'checked' : '' }} />
                                    <label class="form-check-label" for="rasa-nyeri1">Tidak</label>
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="rasa-nyeri" type="radio" id="rasa-nyeri2"
                                        onclick="enableNyeri()" value="Ya"
                                        {{ ($skrinAsesmenNyeri->status ?? '') == 'Ya' ? 'checked' : '' }} />
                                    <label class="form-check-label d-flex" for="rasa-nyeri2">
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
                                    <input class="form-check-input" name="kategori-nyeri" type="radio" id="akut"
                                        value="Akut"
                                        {{ ($skrinAsesmenNyeri->category ?? '') == 'Akut' ? 'checked' : '' }}
                                        {{ ($skrinAsesmenNyeri->status ?? '') == 'Ya' ? '' : 'disabled' }} />
                                    <label class="form-check-label" for="akut">Akut</label>
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="kategori-nyeri" type="radio" id="kronis"
                                        value="Kronis"
                                        {{ ($skrinAsesmenNyeri->category ?? '') == 'Kronis' ? 'checked' : '' }}
                                        {{ ($skrinAsesmenNyeri->status ?? '') == 'Ya' ? '' : 'disabled' }} />
                                    <label class="form-check-label d-flex" for="kronis">Kronis</label>
                                </div>
                            </div>

                        </div>
                    </div>
                    <p class="m-0">Jika Ya, lakukan pengkajian nyeri lebih lanjut dengan format sesuai dengan usia
                        pasien</p>
                    <table class="table-bordered w-100 mb-3">
                        <tbody>
                            <tr>
                                <th class="text-center">DEWASA (NUMERIC SCALE)</th>
                                <td rowspan="3">
                                    <table class="w-100">
                                        <tr>
                                            <td>Provocation (Pencetus)</td>
                                            <td>:</td>
                                            <td>
                                                <input type="text" name="provocation"
                                                    value="{{ $skrinAsesmenNyeri->provocation ?? '' }}"
                                                    placeholder="Provocation (Pencetus)" class="form-control "
                                                    id="lainnya" aria-describedby="floatingInputHelp" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Quality (Karakteristik)</td>
                                            <td>:</td>
                                            <td>
                                                <input type="text" name="quality"
                                                    value="{{ $skrinAsesmenNyeri->quality ?? '' }}"
                                                    placeholder="Quality (Karakteristik)" class="form-control "
                                                    id="lainnya" aria-describedby="floatingInputHelp" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Region (Lokasi/Penjalaran)</td>
                                            <td>:</td>
                                            <td>
                                                <input type="text" name="region"
                                                    placeholder="Region (Lokasi/Penjalaran)" class="form-control "
                                                    value="{{ $skrinAsesmenNyeri->region ?? '' }}" id="lainnya"
                                                    aria-describedby="floatingInputHelp" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Severity (Keparahan)</td>
                                            <td>:</td>
                                            <td>
                                                <input type="text" name="severity"
                                                    value="{{ $skrinAsesmenNyeri->severity ?? '' }}"
                                                    placeholder="Severity (Keparahan)" class="form-control "
                                                    id="lainnya" aria-describedby="floatingInputHelp" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Time (Durasi dan Frekuensi)</td>
                                            <td>:</td>
                                            <td>
                                                <input type="text" name="time"
                                                    value="{{ $skrinAsesmenNyeri->time ?? '' }}"
                                                    placeholder="Time (Durasi dan Frekuensi)" class="form-control "
                                                    id="lainnya" aria-describedby="floatingInputHelp" />
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <img src="{{ asset('/assets/img/aakprj1.jpg') }}" alt="" class="img-fluid"
                                        style="max-width: 350px">
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <img src="{{ asset('/assets/img/aakprj2.jpg') }}" alt="" class="img-fluid"
                                        style="max-width: 350px">
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
                                        $checked = null;
                                        if ($nyeriHilang) {
                                            $detail = $nyeriHilang->where('name', $nyeri)->first();
                                            if ($detail) {
                                                $checked = 'checked';
                                            }
                                        }
                                    @endphp
                                    <div class="form-check">
                                        <input class="form-check-input" name="nyeri-hilang[]" type="checkbox"
                                            value="{{ $nyeri }}" id="defaultCheck1" id="{{ $nyeri }}"
                                            {{ $checked }} />
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

            inputHambatanSosial.disabled = true;
            inputHambatanSosial.value = '';
        }

        function enableHambatanSosial() {
            var inputHambatanSosial = document.getElementById('input-hambatan-sosial');

            inputHambatanSosial.disabled = false;
        }

                                    function toggleInputs() {
                                        const checkbox = document.getElementById('hamSpiritual');
                                        const radioTidakAda = document.getElementById('tidakAdaH');
                                        const radioAda = document.getElementById('AdaH');
                                        const inputDetail = document.getElementById('input-hamSpiritual');
                                
                                        const isChecked = checkbox.checked;
                                
                                        radioTidakAda.disabled = !isChecked;
                                        radioAda.disabled = !isChecked;
                                
                                        if (!isChecked) {
                                            radioTidakAda.checked = false;
                                            radioAda.checked = false;
                                            inputDetail.value = '';
                                            inputDetail.disabled = true;
                                        }
                                    }
                                
                                    function toggleInputDetail() {
                                        const radioTidakAda = document.getElementById('tidakAdaH');
                                        const radioAda = document.getElementById('AdaH');
                                        const inputDetail = document.getElementById('input-hamSpiritual');
                                
                                        if (radioAda.checked) {
                                            inputDetail.disabled = false;
                                        } else {
                                            inputDetail.value = '';
                                            inputDetail.disabled = true;
                                        }
                                    }
                                
                                    // Call toggleInputs on page load to set the initial state
                                    document.addEventListener('DOMContentLoaded', function () {
                                        toggleInputs();
                                    });
                                
        // spiritual
        function enableSehat() {
            var inputSehat = document.getElementById('input-sehat');
            var inputSakit = document.getElementById('input-sakit');
            var tidakAda = document.getElementById('tidakAdaH');
            var Ada = document.getElementById('AdaH');
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
            var tidakAda = document.getElementById('tidakAdaH');
            var Ada = document.getElementById('AdaH');
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
            var tidakAda = document.getElementById('tidakAdaH');
            var Ada = document.getElementById('AdaH');

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
    <script>
        function validateTemperatureInput(input) {
            // Gantikan koma dengan titik
            input.value = input.value.replace(',', '.');
            // Hanya izinkan angka dan satu titik desimal
            input.value = input.value.replace(/[^0-9.]/g, '');
    
            // Cari posisi titik desimal
            var dotIndex = input.value.indexOf('.');
            if (dotIndex !== -1) {
                // Jika terdapat lebih dari satu digit setelah titik desimal, potong menjadi satu digit
                var decimalPart = input.value.substring(dotIndex + 1);
                if (decimalPart.length > 1) {
                    input.value = input.value.substring(0, dotIndex + 2);
                }
            }
        }
    </script>
    <script>
        function toggleInput(checkboxId, inputId) {
            var checkbox = document.getElementById(checkboxId);
            var input = document.getElementById(inputId);
            input.disabled = !checkbox.checked;
        }

        function disableHambatanSpiritual() {
            document.getElementById('input-hamSpiritual').disabled = true;
        }

        function enableHambatanSpiritual() {
            document.getElementById('input-hamSpiritual').disabled = false;
        }
    </script>
    <script>
        // Mengambil elemen checkbox dan input teks
        const lainnyaCheckbox = document.getElementById('lainnya-checkbox');
        const lainnyaInput = document.getElementById('lainnya');
        const khususCheckbox = document.getElementById('khusus-checkbox');
        const khususInput = document.getElementById('khusus');
        const psikologisCheckbox = document.getElementById('psikologis-checkbox');
        const psikologisInput = document.getElementById('psikologis');

        // Menambahkan event listener untuk perubahan pada checkbox "Lainnya"
        lainnyaCheckbox.addEventListener('change', function() {
            // Mengaktifkan atau menonaktifkan input "Deskripsi Lainnya" berdasarkan status checkbox "Lainnya"
            lainnyaInput.disabled = !this.checked;
            if (!this.checked) {
                lainnyaInput.value = ''; // Mengosongkan nilai input saat checkbox tidak dicentang
            }
        });

        // Menambahkan event listener untuk perubahan pada checkbox "Khusus"
        khususCheckbox.addEventListener('change', function() {
            // Mengaktifkan atau menonaktifkan input "Deskripsi Khusus" berdasarkan status checkbox "Khusus"
            khususInput.disabled = !this.checked;
            if (!this.checked) {
                khususInput.value = ''; // Mengosongkan nilai input saat checkbox tidak dicentang
            }
        });

        // Menambahkan event listener untuk perubahan pada checkbox "Psikologis"
        psikologisCheckbox.addEventListener('change', function() {
            // Mengaktifkan atau menonaktifkan input "Deskripsi Psikologis" berdasarkan status checkbox "Psikologis"
            psikologisInput.disabled = !this.checked;
            if (!this.checked) {
                psikologisInput.value = ''; // Mengosongkan nilai input saat checkbox tidak dicentang
            }
        });

        // Memastikan status awal input sesuai dengan status checkbox saat halaman dimuat
        lainnyaInput.disabled = !lainnyaCheckbox.checked;
        khususInput.disabled = !khususCheckbox.checked;
        psikologisInput.disabled = !psikologisCheckbox.checked;
    </script>
@endsection
