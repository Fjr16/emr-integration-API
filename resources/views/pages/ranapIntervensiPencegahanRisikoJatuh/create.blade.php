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
            <h5 class="mb-0">Tambah Intervensi Pencegahan Risiko Jatuh
            </h5>
        </div>
        <form action="{{ route('intervensi/pencegahan/resiko/jatuh.store', $item->id) }}" method="POST"
            onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
            @csrf
            <div class="card-body">
                <div class="mb-3 row">
                    <label class="col-10 col-form-label">Tanggal dan jam</label>
                    <div class="col-2">
                        <input class="form-control" type="datetime-local" value="{{ $today->format('Y-m-d H:i') }}"
                            name="tanggal" />
                    </div>
                </div>
                <div class="mb-3">
                    @if ($item->ranapMonitoringResikoJatuhPatient->nilai_skor == 'RR')
                        <p class="m-0 fw-bold">Intervensi risiko jatuh rendah (RR)</p>
                        @foreach ($dataRR as $tindakan1)
                            <div class="mb-3 row">
                                <label class="col-11 col-form-label">{{ $loop->iteration }}. {{ $tindakan1 }}</label>
                                <div class="col-1">
                                    <div class="form-check">
                                        <input class="text-center form-check-input" name="tindakan[]" type="checkbox"
                                            value="{{ $tindakan1 }}" />
                                    </div>
                                </div>
                            </div>
                            @if ($loop->first)
                                <div class="row">
                                    <div class="col"></div>
                                    <label class="col-10 col-form-label">a. Orientasikan tempat menghidupkan
                                        lampu</label>
                                    <div class="col-1">
                                        <div class="form-check">
                                            <input class="text-center form-check-input" name="tindakan[]" type="checkbox"
                                                value="Orientasikan tempat menghidupkan lampu" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col"></div>
                                    <label class="col-10 col-form-label">b. Orientasikan tempat bel dan cara
                                        penggunaannnya
                                        di kamar dan di kamar mandi</label>
                                    <div class="col-1">
                                        <div class="form-check">
                                            <input class="text-center form-check-input" name="tindakan[]" type="checkbox"
                                                value="Orientasikan tempat bel dan cara penggunaannnya di kamar dan di kamar mandi" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col"></div>
                                    <label class="col-10 col-form-label">c. Orientasikan lokasi kamar mandi dan lantai
                                        kamar
                                        mandi tidak plicin</label>
                                    <div class="col-1">
                                        <div class="form-check">
                                            <input class="text-center form-check-input" name="tindakan[]" type="checkbox"
                                                value="Orientasikan lokasi kamar mandi dan lantai kamar mandi tidak plicin" />
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col"></div>
                                    <label class="col-10 col-form-label">d. Memberitahukan waktu pembersihan kamar dan
                                        rutinitas pekerjaan</label>
                                    <div class="col-1">
                                        <div class="form-check">
                                            <input class="text-center form-check-input" name="tindakan[]" type="checkbox"
                                                value="Memberitahukan waktu pembersihan kamar dan rutinitas pekerjaan" />
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @elseif ($item->ranapMonitoringResikoJatuhPatient->nilai_skor == 'RS')
                        <p class="m-0 fw-bold">Intervensi risiko jatuh sedang (RS)</p>
                        @foreach ($dataRR as $tindakan1)
                            <div class="mb-3 row">
                                <label class="col-11 col-form-label">{{ $loop->iteration }}. {{ $tindakan1 }}</label>
                                <div class="col-1">
                                    <div class="form-check">
                                        <input class="text-center form-check-input" name="tindakan[]" type="checkbox"
                                            value="{{ $tindakan1 }}" />
                                    </div>
                                </div>
                            </div>
                            @if ($loop->first)
                                <div class="row">
                                    <div class="col"></div>
                                    <label class="col-10 col-form-label">a. Orientasikan tempat menghidupkan
                                        lampu</label>
                                    <div class="col-1">
                                        <div class="form-check">
                                            <input class="text-center form-check-input" name="tindakan[]" type="checkbox"
                                                value="Orientasikan tempat menghidupkan lampu" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col"></div>
                                    <label class="col-10 col-form-label">b. Orientasikan tempat bel dan cara
                                        penggunaannnya
                                        di kamar dan di kamar mandi</label>
                                    <div class="col-1">
                                        <div class="form-check">
                                            <input class="text-center form-check-input" name="tindakan[]" type="checkbox"
                                                value="Orientasikan tempat bel dan cara penggunaannnya di kamar dan di kamar mandi" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col"></div>
                                    <label class="col-10 col-form-label">c. Orientasikan lokasi kamar mandi dan lantai
                                        kamar
                                        mandi tidak plicin</label>
                                    <div class="col-1">
                                        <div class="form-check">
                                            <input class="text-center form-check-input" name="tindakan[]" type="checkbox"
                                                value="Orientasikan lokasi kamar mandi dan lantai kamar mandi tidak plicin" />
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col"></div>
                                    <label class="col-10 col-form-label">d. Memberitahukan waktu pembersihan kamar dan
                                        rutinitas pekerjaan</label>
                                    <div class="col-1">
                                        <div class="form-check">
                                            <input class="text-center form-check-input" name="tindakan[]" type="checkbox"
                                                value="Memberitahukan waktu pembersihan kamar dan rutinitas pekerjaan" />
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        <p class="m-0 mt-5 fw-bold">Intervensi risiko jatuh sedang (RS)</p>
                        @foreach ($dataRS as $tindakan2)
                            <div class="mb-3 row">
                                <label class="col-11 col-form-label">{{ $loop->iteration }}. {{ $tindakan2 }}</label>
                                <div class="col-1">
                                    <div class="form-check">
                                        <input class="text-center form-check-input" name="tindakan[]" type="checkbox"
                                            value="{{ $tindakan2 }}" />
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @elseif ($item->ranapMonitoringResikoJatuhPatient->nilai_skor == 'RT')
                        <p class="m-0 fw-bold">Intervensi risiko jatuh rendah (RR)</p>
                        @foreach ($dataRR as $tindakan1)
                            <div class="mb-3 row">
                                <label class="col-11 col-form-label">{{ $loop->iteration }}. {{ $tindakan1 }}</label>
                                <div class="col-1">
                                    <div class="form-check">
                                        <input class="text-center form-check-input" name="tindakan[]" type="checkbox"
                                            value="{{ $tindakan1 }}" />
                                    </div>
                                </div>
                            </div>
                            @if ($loop->first)
                                <div class="row">
                                    <div class="col"></div>
                                    <label class="col-10 col-form-label">a. Orientasikan tempat menghidupkan
                                        lampu</label>
                                    <div class="col-1">
                                        <div class="form-check">
                                            <input class="text-center form-check-input" name="tindakan[]" type="checkbox"
                                                value="Orientasikan tempat menghidupkan lampu" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col"></div>
                                    <label class="col-10 col-form-label">b. Orientasikan tempat bel dan cara
                                        penggunaannnya
                                        di kamar dan di kamar mandi</label>
                                    <div class="col-1">
                                        <div class="form-check">
                                            <input class="text-center form-check-input" name="tindakan[]" type="checkbox"
                                                value="Orientasikan tempat bel dan cara penggunaannnya di kamar dan di kamar mandi" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col"></div>
                                    <label class="col-10 col-form-label">c. Orientasikan lokasi kamar mandi dan lantai
                                        kamar
                                        mandi tidak plicin</label>
                                    <div class="col-1">
                                        <div class="form-check">
                                            <input class="text-center form-check-input" name="tindakan[]" type="checkbox"
                                                value="Orientasikan lokasi kamar mandi dan lantai kamar mandi tidak plicin" />
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col"></div>
                                    <label class="col-10 col-form-label">d. Memberitahukan waktu pembersihan kamar dan
                                        rutinitas pekerjaan</label>
                                    <div class="col-1">
                                        <div class="form-check">
                                            <input class="text-center form-check-input" name="tindakan[]" type="checkbox"
                                                value="Memberitahukan waktu pembersihan kamar dan rutinitas pekerjaan" />
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        <p class="m-0 mt-5 fw-bold">Intervensi risiko jatuh sedang (RS)</p>
                        @foreach ($dataRS as $tindakan2)
                            <div class="mb-3 row">
                                <label class="col-11 col-form-label">{{ $loop->iteration }}. {{ $tindakan2 }}</label>
                                <div class="col-1">
                                    <div class="form-check">
                                        <input class="text-center form-check-input" name="tindakan[]" type="checkbox"
                                            value="{{ $tindakan2 }}" />
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <p class="m-0 mt-5 fw-bold">Intervensi risiko jatuh tinggi (RT)</p>
                        @foreach ($dataRT as $tindakan3)
                            <div class="mb-3 row">
                                <label class="col-11 col-form-label">{{ $loop->iteration }}. {{ $tindakan3 }}</label>
                                <div class="col-1">
                                    <div class="form-check">
                                        <input class="text-center form-check-input" name="tindakan[]" type="checkbox"
                                            value="{{ $tindakan3 }}" />
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>
                <div class="row">
                    <label class="col-3 col-form-label fw-bold">Paraf dan Nama Perawat (Inisial)</label>
                    <div class="col-9">
                        <input class="text-center form-control" type="text" value="{{ Auth::user()->name }}"
                            disabled />
                    </div>
                </div>
                <div class="mb-3 mt-5 text-end">
                    <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                </div>
            </div>
        </form>
    </div>
@endsection
