@extends('layouts.backend.main')

@section('content')

    @if (session()->has('success'))
        <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger w-100 border mb-5 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('error') }}
        </div>
    @endif

    {{-- Informasi Pasien --}}
    <div class="card mb-2">
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <h4 class="mb-1 text-primary d-flex">
                        {{ $item->patient->name }} ({{ implode('-', str_split(str_pad($item->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }})
                        <span class="ms-2 badge {{ $item->patient->jenis_kelamin == 'Wanita' ? 'bg-danger' : 'bg-info' }}">{{ $item->patient->jenis_kelamin == 'Wanita' ? 'P' : 'L' }}</span> 
                    </h4>
                    <h6>{{ $item->dpjp->name }} ({{ $item->dpjp->staff_id }})</h6>
                </div>
                <div class="col-8 text-end">
                    <p class="mb-0">No. Antrian : <span class="fst-italic fw-bold">{{ $item->no_antrian ?? '' }}</span></p>
                    <p class="mb-0">Tanggungan : <span class="fw-bold fst-italic">{{ $item->patientCategory->name }}</span></p>
                    <p class="mb-0">Tgl. Lahir : <span class="fw-bold fst-italic">{{ $item->patient->tanggal_lhr }}</span></p>
                </div>
            </div>
        </div>
    </div>
    {{-- end Informasi Pasien --}}
    @if ($itemAss)
        {{-- show assesmen awal perawat --}}
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('asesmen/awal/perawat.print', encrypt($item->id)) }}" class="btn btn-sm btn-dark me-2" target="_blank"><i class="bx bx-printer"></i></a>
                        <a href="{{ route('asesmen/awal/perawat.edit', encrypt($itemAss->id)) }}" class="btn btn-sm btn-warning"><i class="bx bx-edit"></i></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8 align-self-center ps-4">
                        <h5 class="mb-2">ASESMEN AWAL KEPERAWATAN</h5>
                        <h6>RAWAT JALAN</h6>
                    </div>
                    <div class="col-4">
                        <table class="small small-table">
                            <tr>
                                <td>Nama</td>
                                <td class="px-2">:</td>
                                <td>{{ $item->patient->name }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Lahir</td>
                                <td class="px-2">:</td>
                                @php
                                    $tanggalLahir = new DateTime($item->patient->tanggal_lhr);
                                    $now = new DateTime();
                                    $ageDiff = $now->diff($tanggalLahir);
                                    $ageString = $ageDiff->format('%y tahun %m bulan');
                                @endphp
                                <td>{{ $tanggalLahir->format('d-m-Y') ?? '....' }}
                                    <span>({{ $ageString ?? '....' }})</span>
                                </td>
                            </tr>
                            <tr>
                                <td>No Rekam Medis</td>
                                <td class="px-2">:</td>
                                <td>{{ implode('-', str_split(str_pad($item->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}
                                </td>
                            </tr>
                            <tr>
                                <td>NIK</td>
                                <td class="px-2">:</td>
                                <td>{{ $item->patient->nik }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <hr class="my-2">
            <div class="card-body pt-0">
                <div class="mb-3">
                    <label class="col-form-label fw-bold">Anamnesa / Keluhan Utama :</label>
                    <div class="">
                        {{ $itemAss->keluhan_utama }}
                    </div>
                </div>

                <span class="text-dark fw-bold">STATUS FISIK</span>
                <hr class="my-1">
                <div class="row mb-3">
                    <div class="col-6">
                        <label class="col-form-label fw-bold">Kesadaran :</label>
                        <div class="">
                            {{ $itemAss->kesadaran ?? '' }}
                        </div>
                    </div>
                    <div class="col-6">
                        <label class="col-form-label fw-bold">Keadaan Umum :</label>
                        <div class="">{{ $itemAss->keadaan_umum ?? '' }}</div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-4">
                        <label class="col-form-label fw-bold">Tinggi Badan :</label>
                        <div class="d-flex">
                            <p>{{ $itemAss->tb ?? '...' }}</p>
                            <span class="ms-2 fst-italic">cm</span>
                        </div>
                    </div>
                    <div class="col-4">
                        <label class="col-form-label fw-bold">Berat Badan :</label>
                         <div class="d-flex">
                            <p>{{ $itemAss->bb ?? '...' }}</p>
                            <span class="ms-2 fst-italic">kg</span>
                        </div>
                    </div>
                    <div class="col-4">
                        <label class="col-form-label fw-bold">Lingkar Kepala :</label>
                         <div class="d-flex">
                            <p>{{ $itemAss->lk ?? '...' }}</p>
                            <span class="ms-2 fst-italic">cm</span>
                        </div>
                    </div>
                </div>

                <span class="text-dark fw-bold">TANDA - TANDA VITAL</span>
                <hr class="my-1">
                <div class="row mb-3">
                    <div class="col-6">
                        <label class="col-form-label fw-bold">Nadi</label>
                        <div class="d-flex">
                            <p>{{ $itemAss->nadi ?? '...' }}</p>
                            <span class="ms-2 fst-italic">bpm</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <label class="col-form-label fw-bold">Tekanan Darah</label>
                        <div class="d-flex">
                            <p>{{ $itemAss->td_sistolik ?? '...' }} / {{ $itemAss->td_diastolik ?? '...' }}</p>
                            <span class="ms-2 fst-italic">mmHg</span>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <label class="col-form-label fw-bold">Suhu Badan</label>
                        <div class="d-flex">
                            <p>{{ $itemAss->suhu ?? '...' }}</p>
                            <span class="ms-2 fst-italic">°C</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <label class="col-form-label fw-bold">Nafas</label>
                        <div class="d-flex">
                            <p>{{ $itemAss->nafas ?? '...' }}</p>
                            <span class="ms-2 fst-italic">x/menit</span>
                        </div>
                    </div>
                </div>

                <span class="text-dark fw-bold">RIWAYAT PENYAKIT & ALERGI</span>
                <hr class="my-1">
                <div class="row mb-3">
                    <div class="col-3">
                        <label class="col-form-label fw-bold">Riwayat Penyakit Pasien</label>
                        <p class="multi-line-text">{!! $itemAss->riw_penyakit_pasien !!}</p>
                    </div>
                    <div class="col-3">
                        <label class="col-form-label fw-bold">Riwayat Penyakit Keluarga</label>
                         <p class="multi-line-text">{!! $itemAss->riw_penyakit_keluarga ?? '' !!}</p>   
                    </div>
                    <div class="col-3">
                        <label class="col-form-label fw-bold">Alergi Makanan</label>
                        <p class="multi-line-text">{!! $item->patient->alergi_makanan ?? '' !!}</p>
                    </div>
                    <div class="col-3">
                        <label class="col-form-label fw-bold">Alergi Obat</label>
                        <p class="multi-line-text">{!! $item->patient->alergi_obat ?? '' !!}</p>
                    </div>
                </div>

                <span class="text-dark fw-bold">ASESMEN GIZI</span>
                <hr class="my-1">
                <div class="row mb-3">
                    <div class="col-8">
                        <div class="row mb-3">
                            <label class="col-form-label fw-bold">Apakah pasien mengalami penurunan berat badan dalam 6 bulan terakhir ?</label>
                            <div class="">
                                Ya (skor: {{ $itemAss->skor_ass_gizi_1 ?? '' }})
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-form-label fw-bold">Apakah memiliki keluhan kurang nafsu makan ?</label>
                            <div class="">Tidak juga (skor: {{ $itemAss->skor_ass_gizi_2 ?? '' }})</div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-form-label fw-bold">Kondisi Gizi Pasien</label>
                            <div class="">{{ $itemAss->kondisi_gizi ?? '' }}</div>
                        </div>
                    </div>
                    <div class="col-4 text-center align-self-center">
                        <h3 class="mb-2">SKOR MST</h3>
                        <h1>{{ $itemAss->skor_ass_gizi_1 ?? 0 + $itemAss->skor_ass_gizi_2 ?? 0  }}</h1>
                    </div>
                </div>

                <span class="text-dark fw-bold">ASESMEN NYERI</span>
                <hr class="my-1">
                <div class="row mb-3">
                    <div class="col-12 text-center">
                        <img src="{{ asset('assets/img/aakprj2.jpg') }}" alt="" class="img-fluid" style="max-width: 780px">
                    </div>
                    <div class="row">
                        <div class="col-12 text-center mx-3 ps-4">
                            <div class="form-check form-check-inline mt-3 mx-5 ps-4">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" style="pointer-events: none;" {{ $itemAss->skor_nyeri == '0' ? 'checked' : '' }} />
                            </div>
                            <div class="form-check form-check-inline mx-5 ps-4">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" style="pointer-events: none;" {{ $itemAss->skor_nyeri == '2' ? 'checked' : '' }} />
                            </div>
                            <div class="form-check form-check-inline mx-5">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" style="pointer-events: none;" {{ $itemAss->skor_nyeri == '4' ? 'checked' : '' }}/>
                            </div>
                            <div class="form-check form-check-inline mx-5 ps-4">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" style="pointer-events: none;" {{ $itemAss->skor_nyeri == '6' ? 'checked' : '' }}/>
                            </div>
                            <div class="form-check form-check-inline mx-5 ps-4">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" style="pointer-events: none;" {{ $itemAss->skor_nyeri == '8' ? 'checked' : '' }}/>
                            </div>
                            <div class="form-check form-check-inline mx-5 ps-5">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" style="pointer-events: none;" {{ $itemAss->skor_nyeri == '10' ? 'checked' : '' }}/>
                            </div>
                        </div>

                    </div>
                </div>

                <span class="text-dark fw-bold">ASESMEN RESIKO JATUH</span>
                <hr class="my-1">
                <div class="row mb-3">
                    <div class="col-8">
                        <div class="row">
                            <div class="col-9 mt-4">
                                <p class="mb-4">a. Saat akan duduk dikursi pasien tampak tidak seimbang (sempoyongan / linglung) ?</p>
                                <p>b. Saat akan duduk pasien memegang pinggiran kursi atau benda lain sebagai penopang ?</p>
                            </div>
                            <div class="col-3 mt-4">
                                <p class="mb-4">{{ ($itemAss->resiko_jatuh_a ? 'YA' : 'TIDAK') ?? '...' }}</p>
                                <p>{{ ($itemAss->resiko_jatuh_b ? 'YA' : 'TIDAK') ?? '...' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 align-self-center">
                        <div class="card bg-transparent border border-primary">
                            <div class="card-body text-center p-2 align-self-center">
                                <h2 class="text-uppercase mb-1 text-primary">
                                    {{ $itemAss->resiko_jatuh_result ?? '' }}
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>

                <span class="text-dark fw-bold">PSIKOLOGIS & SOSIAL EKONOMI</span>
                <hr class="my-1">
                <div class="row mb-3">
                    <div class="col-6">
                        <label class="col-form-label fw-bold">Status Psikologis</label>
                        <div class="d-flex">
                            @foreach ($itemAss->detailPsikologis as $detail)
                                <p class="me-1">{{ $detail->name ?? '' }},</p>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-6">
                        <label class="col-form-label fw-bold">Status Ekonomi</label>
                        <div>{{ $itemAss->stts_ekonomi ?? '' }}</div>
                    </div>
                </div>

                <span class="text-dark fw-bold">SOAP KEPERAWATAN</span>
                <hr class="my-1">
                <div class="row mb-3">
                    <div class="col-3">
                        <label class="col-form-label fw-bold">Subjective:</label>
                        <p class="multi-line-text">{!! $itemAss->subjective ?? '' !!}</p>
                    </div>
                    <div class="col-3">
                        <label class="col-form-label fw-bold">Objective:</label>
                        <p class="multi-line-text">{!! $itemAss->objective ?? '' !!}</p>
                    </div>
                    <div class="col-3">
                        <label class="col-form-label fw-bold">Assesment:</label>
                        <p class="multi-line-text">{!! $itemAss->asesmen ?? '' !!}</p>
                    </div>
                    <div class="col-3">
                        <label class="col-form-label fw-bold">Planning:</label>
                        <p class="multi-line-text">{!! $itemAss->planning ?? '' !!}</p>
                    </div>
                </div>
                
                <hr>
                <div class="row mx-4">
                    <div class="text-end align-self-center">
                        <p class="mb-0">Padang, {{ $itemAss->created_at->format('d M Y') ?? 'Unknown' }}</p>
                        <p class="mb-1 fw-bold">Perawat,</p>
                        <img src="{{ asset('storage/' . $itemAss->ttd ?? '') }}" width="150" alt="">
                        <p class="fw-bold">{{ $itemAss->user->name ?? '' }}</p>
                    </div>
                </div>

            </div>
        </div>
        {{-- end show assesmen awal perawat --}}        
    @else
        {{-- Menu Rajal Perawatan --}}
        <div class="card">
            <div class="card-body">
                <div class="nav-align-top mb-2 shadow-sm">
                    <ul class="nav nav-tabs nav-sm nav-fill" role="tablist">
                        <li class="nav-item">
                            <button id="btn-link" type="button"
                                class="nav-link {{ session('perawat') == 'anamnesis' ? 'active' : '' }} d-flex justify-content-center"
                                role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-anamnesis"
                                aria-controls="navs-justified-anamnesis" aria-selected="false">
                                <i class="tf-icons bx bx-bookmark-alt-plus"></i>
                                <p class="m-0">Anamnesis</p>
                            </button>
                        </li>
                        <li class="nav-item">
                            <button id="btn-link" type="button"
                                class="nav-link {{ session('perawat') == 'pemeriksaan' ? 'active' : '' }} d-flex justify-content-center"
                                role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-pemeriksaan"
                                aria-controls="navs-justified-pemeriksaan" aria-selected="false">
                                <i class="tf-icons bx bx-bookmark-alt-plus"></i>
                                <p class="m-0">Pemeriksaan</p>
                            </button>
                        </li>
                        <li class="nav-item">
                            <button id="btn-link" type="button"
                                class="nav-link {{ session('perawat') == 'psikologis' ? 'active' : '' }} d-flex justify-content-center"
                                role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-psikologis"
                                aria-controls="navs-justified-psikologis" aria-selected="false">
                                <i class="tf-icons bx bx-message-square-add"></i>
                                <p class="m-0">Psikologis & Sosial Ekonomi</p>
                            </button>
                        </li>
                        <li class="nav-item">
                            <button id="btn-link" type="button"
                                class="nav-link {{ session('perawat') == 'soap' ? 'active' : '' }} d-flex justify-content-center"
                                role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-soap"
                                aria-controls="navs-justified-soap" aria-selected="false">
                                <i class="tf-icons bx bx-message-alt-add"></i>
                                <p class="m-0">SOAP</p>
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade {{ session('perawat') == 'anamnesis' ? 'show active' : '' }}"
                            id="navs-justified-anamnesis" role="tabpanel">                    
                            <form action="{{ route('asesmen/awal/perawat.store_step_one', $item->id) }}" method="POST">
                                @csrf
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-12">
                                                <label class="form-label fw-bold">Anamnesa / Keluhan Utama</label>
                                                <textarea id="editor5" class="form-control" id="keluhan" name="keluhan" rows="4">{{ session('data.keluhan_utama') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <label class="form-label fw-bold">Riwayat Penyakit Pasien</label>
                                                <textarea id="editor1" class="form-control" id="riwayat_penyakit_sekarang" name="riwayat_penyakit_sekarang" rows="3">{{ session('data.riw_penyakit_pasien') }}</textarea>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label fw-bold">Riwayat Penyakit Keluarga</label>
                                                <textarea id="editor4" class="form-control" id="riwayat_penyakit_keluarga" name="riwayat_penyakit_keluarga" rows="3">{{ session('data.riw_penyakit_keluarga') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <label class="form-label fw-bold">Alergi Makanan</label>
                                                <textarea id="editor4" class="form-control" id="alergi_makanan" name="alergi_makanan" rows="6">{{ session('alergi.makanan', $item->patient->alergi_makanan ?? '') }}</textarea>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label fw-bold">Alergi Obat</label>
                                                <textarea id="editor4" class="form-control" id="alergi_obat" name="alergi_obat" rows="6">{{ session('alergi.obat', $item->patient->alergi_obat ?? '') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="form-label fw-bold" id="label-kolom">Asesmen Gizi</label>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label for="asesmen_gizi" class="form-label">Apakah pasien mengalami penurunan berat badan dalam 6 bulan terakhir ?</label>
                                                    <div class="input-group">
                                                        <select name="asesmen_gizi" id="asesmen_gizi" class="form-control" aria-describedby="basic-addon1" onchange="skorGizi(this)">
                                                            @foreach ($arrAssGizi as $itemGizi)
                                                                @if (session('data.skor_ass_gizi_1') == $itemGizi['value'])
                                                                    <option value="{{ $itemGizi['value'] }}" selected>{{ $itemGizi['name'] }}</option>
                                                                @else
                                                                    <option value="{{ $itemGizi['value'] }}">{{ $itemGizi['name'] }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        <span class="input-group-text skor-gizi" id="skor_gizi_1">Skor: {{ session('data.skor_ass_gizi_1', '0') }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="form-label" for="kurang_nafsu">Apakah memiliki keluhan kurang nafsu makan ?</label>
                                                    <div class="input-group">
                                                        <select name="kurang_nafsu" id="kurang_nafsu" class="form-control" aria-describedby="basic-addon2" onchange="skorGizi(this)">
                                                            <option value="0" {{ session('data.skor_ass_gizi_2') == '0' ? 'selected' : '' }}>Tidak</option>
                                                            <option value="1" {{ session('data.skor_ass_gizi_2') == '1' ? 'selected' : '' }}>Ya</option>
                                                        </select>
                                                        <span class="input-group-text skor-gizi" id="skor_gizi_2">Skor: {{ session('data.skor_ass_gizi_2', '0') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md">
                                                <p class="m-0 fw-bold">Kondisi Gizi Pasien</p>
                                                <div class="form-check form-check-inline mt-3">
                                                <input class="form-check-input" type="radio" name="kondisi_gizi" id="inlineRadio1" value="Baik" {{ session('data.kondisi_gizi') == 'Baik' ? 'checked' : '' }}/>
                                                <label class="form-check-label" for="inlineRadio1">Baik</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="kondisi_gizi" id="inlineRadio2" value="Lebih" {{ session('data.kondisi_gizi') == 'Lebih' ? 'checked' : '' }}/>
                                                <label class="form-check-label" for="inlineRadio2">Lebih</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="kondisi_gizi" id="inlineRadio3" value="Kurang" {{ session('data.kondisi_gizi') == 'Kurang' ? 'checked' : '' }}/>
                                                <label class="form-check-label" for="inlineRadio3">Kurang</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="kondisi_gizi" id="inlineRadio4" value="Buruk" {{ session('data.kondisi_gizi') == 'Buruk' ? 'checked' : '' }}/>
                                                <label class="form-check-label" for="inlineRadio4">Buruk</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 text-end">
                                        <button type="submit" name="next-step" value="pemeriksaan" class="btn btn-primary btn-sm mx-3">Next</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade {{ session('perawat') == 'pemeriksaan' ? 'show active' : '' }}"
                            id="navs-justified-pemeriksaan" role="tabpanel">
                            <form action="{{ route('asesmen/awal/perawat.store_step_one', $item->id) }}" method="POST">
                                @csrf
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <label class="form-label fw-bold" id="label-kolom">Tanda-tanda Vital</label>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label class="form-label">Nadi</label>
                                                    <div class="input-group">
                                                        <input type="number" step="0.01" name="ttv_nadi" class="form-control" aria-describedby="ttv_nadi" placeholder="0.00" value="{{ session('data.nadi') }}">
                                                        <span class="input-group-text" id="ttv_nadi">bpm</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="form-label">Tekanan Darah</label>
                                                    <div class="input-group">
                                                        <input type="number" step="0.01" name="ttv_td_sistolik" class="form-control" aria-describedby="ttv_td_sistolik" placeholder="0.00" value="{{ session('data.td_sistolik') }}">
                                                        <span class="input-group-text" id="ttv_td_sistolik">/</span>
                                                        <input type="number" step="0.01" name="ttv_td_diastolik" class="form-control" aria-describedby="ttv_td_diastolik" placeholder="0.00" value="{{ session('data.td_diastolik') }}">
                                                        <span class="input-group-text" id="ttv_td_diastolik">mmHg</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label class="form-label">Suhu</label>
                                                    <div class="input-group">
                                                        <input type="number" step="0.01" name="ttv_suhu" class="form-control" aria-describedby="ttv_suhu" placeholder="0.00" value="{{ session('data.suhu') }}">
                                                        <span class="input-group-text" id="ttv_suhu">°C</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="form-label">Nafas</label>
                                                    <div class="input-group">
                                                        <input type="number" name="ttv_nafas" class="form-control" aria-describedby="ttv_nafas" placeholder="0" value="{{ session('data.nafas') }}">
                                                        <span class="input-group-text" id="ttv_nafas">x/menit</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="form-label fw-bold mt-2" id="label-kolom">Pemeriksaan Fisik</label>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label class="form-label my-0">Keadaan Umum</label>
                                                    <div class="col-sm">
                                                        <div class="form-check form-check-inline mt-3">
                                                        <input class="form-check-input" type="radio" name="keadaan_umum" id="keadaan-umum1" value="Baik" {{ session('data.keadaan_umum') == 'Baik' ? 'checked' : '' }}/>
                                                        <label class="form-check-label" for="keadaan-umum1">Baik</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="keadaan_umum" id="keadaan-umum2" value="Lemas" {{ session('data.keadaan_umum') == 'Lemas' ? 'checked' : '' }}/>
                                                        <label class="form-check-label" for="keadaan-umum2">Lemas</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="keadaan_umum" id="keadaan-umum3" value="Sakit Ringan" {{ session('data.keadaan_umum') == 'Sakit Ringan' ? 'checked' : '' }}/>
                                                        <label class="form-check-label" for="keadaan-umum3">Sakit Ringan</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="keadaan_umum" id="keadaan-umum4" value="Sakit Sedang" {{ session('data.keadaan_umum') == 'Sakit Sedang' ? 'checked' : '' }}/>
                                                        <label class="form-check-label" for="keadaan-umum4">Sakit Sedang</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="keadaan_umum" id="keadaan-umum5" value="Sakit Berat" {{ session('data.keadaan_umum') == 'Sakit Berat' ? 'checked' : '' }}/>
                                                        <label class="form-check-label" for="keadaan-umum5">Sakit Berat</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="form-label">Kesadaran</label>
                                                    <input type="text" name="kesadaran" class="form-control form-control-md" placeholder="Tingkat Kesadaran" value="{{ session('data.kesadaran') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-4">
                                                <label class="form-label fw-bold">Tinggi Badan</label>
                                                <div class="input-group">
                                                    <input class="form-control" id="tb" name="tb" value="{{ session('data.tb') }}"></input>
                                                    <span class="input-group-text">cm</span>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <label class="form-label fw-bold">Berat Badan</label>
                                                <div class="input-group">
                                                    <input class="form-control" id="bb" name="bb" value="{{ session('data.bb') }}"></input>
                                                    <span class="input-group-text">kg</span>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <label class="form-label fw-bold">Lingkar Kepala</label>
                                                <div class="input-group">
                                                    <input class="form-control" id="lk" name="lk" value="{{ session('data.lk') }}"></input>
                                                    <span class="input-group-text">cm</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="form-label fw-bold">Asesmen Nyeri</label>
                                            <div class="col-6">
                                                <img src="{{ asset('/assets/img/aakprj2.jpg') }}" alt="" class="img-fluid" style="max-width: 350px">
                                                <div class="col-md">
                                                    <div class="form-check form-check-inline mt-3 ms-4">
                                                    <input class="form-check-input" type="radio" name="ass_nyeri" id="nyeri-1" value="0" {{ session('data.skor_nyeri') == '0' ? 'checked' : '' }}/>
                                                    <label class="form-check-label" for="nyeri-1">0</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="ass_nyeri" id="nyeri-2" value="2" {{ session('data.skor_nyeri') == '2' ? 'checked' : '' }}/>
                                                    <label class="form-check-label" for="nyeri-2">2</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="ass_nyeri" id="nyeri-3" value="4" {{ session('data.skor_nyeri') == '4' ? 'checked' : '' }}/>
                                                    <label class="form-check-label" for="nyeri-3">4</label>
                                                    </div>
                                                    <div class="form-check form-check-inline mt-3">
                                                    <input class="form-check-input" type="radio" name="ass_nyeri" id="nyeri-4" value="6" {{ session('data.skor_nyeri') == '6' ? 'checked' : '' }}/>
                                                    <label class="form-check-label" for="nyeri-4">6</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="ass_nyeri" id="nyeri-5" value="8" {{ session('data.skor_nyeri') == '8' ? 'checked' : '' }}/>
                                                    <label class="form-check-label" for="nyeri-5">8</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="ass_nyeri" id="nyeri-6" value="10" {{ session('data.skor_nyeri') == '10' ? 'checked' : '' }}/>
                                                    <label class="form-check-label" for="nyeri-6">10</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="form-label fw-bold mt-2">Asesmen Resiko Jatuh</label>
                                            <div class="col-8">
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
                                                                <input class="form-check-input" name="resiko_jatuh_a" id="radioAya" type="radio" value="1" {{ session('data.resiko_jatuh_a') == '1' ? 'checked' : '' }}/>
                                                            </td>
                                                            <td class="text-center">
                                                                <input class="form-check-input" name="resiko_jatuh_a" id="radioAtidak" value="0" type="radio" {{ session('data.resiko_jatuh_a') == '0' ? 'checked' : '' }}/>
                                                            </td>
                                                        </tr>
                                
                                                        <td colspan="2">b. Apakah pasien memegang pinggiran kursi atau meja atau benda lain sebagai
                                                            penopang saat akan duduk?</td>
                                                        <td class="text-center">
                                                            <input class="form-check-input" name="resiko_jatuh_b" id="radioBya" type="radio" value="1" {{ session('data.resiko_jatuh_b') == '1' ? 'checked' : '' }}/>
                                                        </td>
                                                        <td class="text-center">
                                                            <input class="form-check-input" name="resiko_jatuh_b" id="radioBtidak" type="radio" value="0" {{ session('data.resiko_jatuh_b') == '0' ? 'checked' : '' }}/>
                                                        </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-4 align-self-center">
                                                <div class="card bg-transparent text-primary border border-primary">
                                                    <div class="card-body">
                                                        @foreach ($arrResikoJatuh as $index => $komponen1)
                                                            <div class="form-check mb-2">
                                                                <input class="form-check-input" name="resiko_jatuh_result" value="{{ $komponen1 }}" id="komponen1{{ $index + 1 }}" type="radio" {{ session('data.resiko_jatuh_result') == $komponen1 ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="komponen1{{ $index + 1 }}">
                                                                    {{ $komponen1 }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 text-end">
                                        <button type="submit" name="next-step" value="psikologis" class="btn btn-primary btn-sm mx-3">Next</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade {{ session('perawat') == 'psikologis' ? 'show active' : '' }}"
                            id="navs-justified-psikologis" role="tabpanel">
                            <form action="{{ route('asesmen/awal/perawat.store_step_one', $item->id) }}" method="POST">
                                @csrf
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label for="status_psikologis" class="form-label">Status Psikologis</label>
                                                    <select class="form-select form-select-md select2" id="select2" name="status_psikologis[]" multiple="multiple" style="width: 100%">
                                                        <option value="Tenang" {{ in_array('Tenang', session()->get('detail_psikologis') ?? []) ? 'selected' : '' }}>Tenang</option>
                                                        <option value="Tegang" {{ in_array('Tegang', session()->get('detail_psikologis') ?? []) ? 'selected' : '' }}>Tegang</option>
                                                        <option value="Takut" {{ in_array('Takut', session()->get('detail_psikologis') ?? []) ? 'selected' : '' }}>Takut</option>
                                                        <option value="Marah" {{ in_array('Marah', session()->get('detail_psikologis') ?? []) ? 'selected' : '' }}>Marah</option>
                                                        <option value="Senang" {{ in_array('Senang', session()->get('detail_psikologis') ?? []) ? 'selected' : '' }}>Senang</option>
                                                        <option value="Sedih" {{ in_array('Sedih', session()->get('detail_psikologis') ?? []) ? 'selected' : '' }}>Sedih</option>
                                                        <option value="Depresi" {{ in_array('Depresi', session()->get('detail_psikologis') ?? []) ? 'selected' : '' }}>Depresi</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="status_ekonomi" class="form-label">Status Sosial & Ekonomi</label>
                                                    <select name="status_ekonomi" id="status_ekonomi" class="form-select form-select-md">
                                                        <option value="Baik" {{ session('stts_ekonomi') == 'Baik' ? 'selected' : '' }}>Baik</option>
                                                        <option value="Cukup" {{ session('stts_ekonomi') == 'Cukup' ? 'selected' : '' }}>Cukup</option>
                                                        <option value="Kurang" {{ session('stts_ekonomi') == 'Kurang' ? 'selected' : '' }}>Kurang</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 text-end">
                                        <button type="submit" name="next-step" value="soap" class="btn btn-primary btn-sm mx-3">Next</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade {{ session('perawat') == 'soap' ? 'show active' : '' }}" id="navs-justified-soap" role="tabpanel">
                            <form action="{{ route('asesmen/awal/perawat.store_step_two', $item->id) }}" method="POST" id="formFinal">
                                @csrf
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="row mb-4">
                                                <div class="col-sm-6">
                                                    <label for="subjective" class="form-label">Subjective</label>
                                                    <textarea name="subjective" id="subjective" class="form-control" rows="10" placeholder="Subjective">{{ "Keluhan: " . session('data.keluhan_utama') . "\r\n" . "Riwayat Penyakit: " . session('data.riw_penyakit_pasien') }}</textarea>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="objective" class="form-label">Objective</label>
                                                    <textarea name="objective" id="objective" class="form-control" rows="10" placeholder="Objective">{{ "Keadaan Umum: " . session('data.keadaan_umum') . "\r\n" . "Nadi: " . session('data.nadi') . " bpm\r\n" . "Tekanan Darah: " . session('data.td_sistolik') . " / " . session('data.td_diastolik') . " mmHg\r\n" . "Suhu: " . session('data.suhu') . " °C\r\n" . "Nafas: " . session('data.nafas') . " x/menit\r\n" . "Tinggi Badan: " . session('data.tb') . " cm\r\n" . "Berat Badan: " . session('data.bb') . ' kg' }}</textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label for="asesmen" class="form-label">Assesment</label>
                                                    <textarea name="asesmen" id="asesmen" class="form-control" rows="10" placeholder="Assesment"></textarea>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="planning" class="form-label">Planning</label>
                                                    <textarea name="planning" id="planning" class="form-control" rows="10" placeholder="Planning"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                     {{-- form hidden ttd --}}
                                    <div class="row mx-4 text-end align-self-center" id="formParafUser">
                                        <div class="col-12 text-end mb-0">
                                        <img src="" alt=""  id="imgTtdUser" class="border" width="170" hidden>
                                        </div>
                                        <div class="col-12 text-end mb-0">
                                        <textarea id="ttd_user" name="ttd_user" style="display: none;"></textarea>
                                        </div>
                                    </div>

                                    <div class="mb-3 text-end">
                                        <button type="submit" class="btn btn-success btn-sm mx-3">Submit</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- end Menu Rajal Perawat --}}
    @endif


    {{-- modal --}}
    <div class="modal fade" id="getTtdModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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

    {{-- untuk ttd --}}

    <script>
        document.addEventListener('DOMContentLoaded', function(){
            var formSubmit = document.getElementById("formFinal");
            var modal = document.getElementById("getTtdModal");
            var clearBtn = modal.querySelector("[data-action=clear]");
            var saveBtn = modal.querySelector("[data-action=save]");
            var inputPass = modal.querySelector('input[name="password_user"]');
            var inputUserId = modal.querySelector('input[name="user_id"]');
            var formParaf = document.getElementById('formParafUser');
        
            formSubmit.addEventListener('submit', function(formSub){
                formSub.preventDefault();
                $('#getTtdModal').modal('show');
            });
    
            // function clear input ttd
            clearBtn.addEventListener('click', function(clear){
                inputPass.value = '';
            });
    
            // function save ttd
            saveBtn.addEventListener('click', function(save){
                save.preventDefault();
                $.ajax({
                type : 'get',
                url : "{{ route('ranap/cppt.getTtd') }}",
                data : {
                    user_id : inputUserId.value,
                    password : inputPass.value,
                },
                success: function(data){
                    var newSrc = `{{ Storage::url('${data}') }}`;
                    $('#imgTtdUser').attr('src', newSrc);
                    $('#ttd_user').val(data);
                    formSubmit.submit();
                }, error: function(jqXHR, textStatus, errorThrown){
                    console.log();
                    var errorResponse = jqXHR.responseJSON;
                    if (errorResponse && errorResponse.error) {
                    alert(errorResponse.error)
                    }else{
                    alert('Terjadi Kesalahan Dalam Pengambilan Data');
                    }
                }
                });
        
                inputPass.value = '';
        
                $('#getTtdModal').modal('hide');
            });
        });
    </script>
    <script>
        function skorGizi(element){
            var targetContent = element.closest('.input-group').querySelector('.skor-gizi');
            targetContent.textContent = 'Skor: ' + element.value;
        }
    </script>
@endsection
