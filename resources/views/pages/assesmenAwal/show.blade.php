@extends('layouts.backend.main')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Assesmen Awal</h5>
            <button type="button" class="btn btn-success btn-sm" onclick="history.back()">Kembali</button>
        </div>
        <div class="card-body">
            <p class="m-0 fw-bold">Anamnesis</p>
            <p class="m-0 fw-bold">Data diperoleh dari</p>
            <div class="form-check">
                <input class="form-check-input" style="pointer-events: none;" type="radio" value=""
                    id="defaultRadio1" {{ $item->isPasien == true ? 'checked' : '' }}>
                <label class="form-check-label" for="defaultRadio1">
                    Pasien
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" style="pointer-events: none;" type="radio" value=""
                    {{ $item->isPasien == false ? 'checked' : '' }} />
                <label class="form-check-label d-flex">
                    Orang Lain(Alloanamnesa)
                    <span class="mx-2"><input type="text" class="form-control form-control-sm"
                            value="{{ $item->name ?? '' }}" disabled /></span>
                    Hubungan dengan pasien
                    <span class="mx-2"><input type="text" class="form-control form-control-sm"
                            value="{{ $item->hubungan ?? '' }}" disabled /></span>
                </label>
            </div>
            <p class="m-0 fw-bold">Keluhan Utama</p>
            <textarea class="form-control" id="editor" rows="2">{{ $item->keluhan ?? '' }}</textarea>
            <p class="m-0 mt-4 fw-bold">Riwayat Penyakit Sekarang</p>
            <textarea class="form-control" id="editor1" rows="2">{{ $item->riwayat_penyakit_sekarang ?? '' }}</textarea>
            <p class="m-0 mt-4 fw-bold">Riwayat Penyakit Dahulu</p>
            <textarea class="form-control" id="editor2" rows="2">{{ $item->riwayat_penyakit_dahulu ?? '' }}</textarea>
            <p class="m-0 mt-4 fw-bold">Riwayat Penggunaan Obat</p>
            <textarea class="form-control" id="editor3" rows="2">{{ $item->riwayat_penggunaan_obat ?? '' }}</textarea>
            <p class="m-0 fw-bold mt-4">Riwayat Penyakit Keluarga</p>
            <textarea id="editor4" class="form-control" id="exampleFormControlTextarea1" name="riwayat_penyakit_keluarga"
                rows="2">{{ $item->riwayat_penyakit_keluarga ?? '' }}</textarea>
            <p class="m-0 mt-4 fw-bold">Pemeriksaan Fisik</p>
            <table class="table">
                <thead>
                    <tr class="text-nowrap">
                        <th class="text-body">Keterangan</th>
                        <th class="text-body">Normal</th>
                        <th class="text-body">Jelaskan jika Tidak Normal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($item->initialAssesmentPhysicalExaminations as $fisik)
                        <tr>
                            <td>{{ $fisik->name ?? '' }}</td>
                            <td>
                                <div class="form-check form-check-sm form-check-inline">
                                    <input class="form-check-input" style="pointer-events: none;" type="radio"
                                        {{ $fisik->isNormal ? 'checked' : '' }} />
                                    <label class="form-check-label">YA</label>
                                </div>
                                <div class="form-check form-check-sm form-check-inline">
                                    <input class="form-check-input" style="pointer-events: none;" type="radio"
                                        {{ !$fisik->isNormal ? 'checked' : '' }} />
                                    <label class="form-check-label">Tidak</label>
                                </div>
                            </td>
                            <td>
                                <input type="text" value="{{ $fisik->keterangan ?? '' }}"
                                    class="form-control form-control-sm" disabled />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <p class="m-0 fw-bold mt-4">Status Lokalis</p>
            <textarea id="editor6" class="form-control" id="exampleFormControlTextarea1" name="status_lokalis" rows="2">{{ $item->status_lokalis ?? '' }}</textarea>
            <p class="m-0 mt-4 fw-bold">Hasil Pemeriksaan Penunjang</p>
            @foreach ($item->initialAssesmentSupportingExaminationResults as $penunjang)
                @if ($penunjang->name == null)
                    @continue
                @endif
                <div class="form-check">
                    <input class="form-check-input" style="pointer-events: none;" type="checkbox" checked />
                    <label class="form-check-label d-flex">
                        {{ $penunjang->name }}
                    </label>
                </div>
            @endforeach

            <p class="m-0 mt-4 fw-bold">Diagnosa Kerja</p>
            <textarea id="editor4" class="form-control" id="exampleFormControlTextarea1" rows="2">{!! strip_tags($item->diagnosa_kerja ?? '') !!}</textarea>
            <p class="m-0 mt-4 fw-bold">Diagnosa Banding</p>
            <textarea id="editor5" class="form-control" id="exampleFormControlTextarea1" rows="2">{{ $item->diagnosa_banding ?? '' }}</textarea>
            <p class="m-0 mt-4 fw-bold">Terapi / Instruksi (Standing Order)</p>
            <textarea id="editor6" class="form-control" id="exampleFormControlTextarea1" rows="2">{!! strip_tags($item->terapi ?? '') !!}</textarea>
            {{-- <div class="row mb-3">
                <label class="form-label col-sm-2 fw-bold mt-2" id="label-kolom">Medical Mentosa:</label>
                @foreach ($medicines as $obat)
                    @foreach ($obat->medicineReceiptDetails as $resep)
                        <div class="row">

                            <div class="col-sm-3">
                                <label for="medicine_id" class="form-label">Nama Obat</label>
                                <input type="text" class="form-control" name="medicine_id[]" value="{{ $resep->medicine->name ?? '' }}" disabled/>

                            </div>
                            <div class="col-sm-1">
                                <label class="form-label" for="basic-default-name">Jumlah</label>
                                <input type="number" class="form-control" name="jumlah[]" id="jumlah" value="{{ $resep->jumlah ?? ''}}" disabled/>
                            </div>
                            <div class="col-sm-2">
                                <label class="form-label" for="basic-default-name">Aturan Penggunaan</label>
                                <input type="text" class="form-control" name="aturan_pakai[]" id="aturan_pakai" value="{{ $resep->aturan_pakai ?? '' }}" disabled/>
                            </div>
                            <div class="col-sm-2">
                                <label for="keterangan" class="form-label">Keterangan Penggunaan</label>
                                <input type="text" class="form-control" name="keterangan[]" id="keterangan_pengguna" value="{{ $resep->keterangan ?? '' }}" disabled/>
                            </div>
                            <div class="col-sm-3">
                                <label for="keterangan" class="form-label">Keterangan Lainnya</label>
                                <textarea name="other[]" class="form-control" id="other" cols="30" rows="1" value="{{ $resep->other ?? '' }}" disabled>{{ $resep->other ?? '' }}</textarea>
                            </div>

                        </div>
                    @endforeach
                @endforeach

            </div> --}}
            <p class="m-0 mt-4 fw-bold">Rencana</p>
            @foreach ($item->initialAssesmentPlan as $plan)
                @if ($plan->name == null)
                    @continue
                @endif
                <div class="form-check">
                    <input class="form-check-input" style="pointer-events: none;" type="checkbox" value=""
                        checked />
                    <label class="form-check-label d-flex">
                        {{ $plan->name ?? '' }}
                    </label>
                </div>
            @endforeach

            <p class="m-0 mt-4 fw-bold">Kebutuhan Edukasi</p>
            @foreach ($item->initialAssesmentEducationalNeeds as $edukasi)
                @if ($edukasi->name == null)
                    @continue
                @endif
                <div class="form-check">
                    <input class="form-check-input" style="pointer-events: none;" type="checkbox" value=""
                        checked />
                    <label class="form-check-label d-flex">
                        {{ $edukasi->name }}
                    </label>
                </div>
            @endforeach
        </div>
    @endsection
