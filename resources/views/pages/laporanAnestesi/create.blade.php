@extends('layouts.backend.main')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content; left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="card p-3 mt-5 ">

        <div class="d-flex">
            <h4 class="align-self-center m-0">LAPORAN ANESTESI </h4>
        </div>
        <hr class="m-0 mt-2 mb-3">
        <form action="{{ route('laporan/anestesi.store', $item->id) }}" method="POST"
            onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
            @csrf
            <div class="card-body">
                <h5 class="m-0 mb-1">1. Infus Perifer : Tempat dan Ukuran</h5>

                <div class="row mb-3 ms-3">
                    <label for="nama_rohaniawan" class="col-form-label   col-1">1.</label>
                    <div class="col-11">
                        <input class="form-control form-control-sm" type="text" name="perifer_first" value="" />
                    </div>
                </div>
                <div class="row mb-3 ms-3">
                    <label for="umur" class="col-form-label   col-1">2.</label>
                    <div class="col-11">
                        <input class="form-control form-control-sm" type="text" name="perifer_second" value="" />
                    </div>
                </div>
                <div class="row mb-3 ms-3">
                    <label for="agama" class="col-form-label   col-1">CVC</label>
                    <div class="col-11 ">
                        <input class="form-control form-control-sm" type="text" name="perifer_cvc" value="" />
                    </div>
                </div>

                {{--  --}}
                <h5 class="m-0 mb-1">2. Posisi</h5>
                <table class="ms-4">
                    <tr>
                        <td>
                            <div class="form-check form-check-inline mt-3 ">
                                <input class="form-check-input" type="radio" name="posisi" id="Telentang"
                                    value="Telentang" />
                                <label class="form-check-label" for="Telentang">Telentang</label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check form-check-inline mt-3 ">
                                <input class="form-check-input" type="radio" name="posisi" id="Prone"
                                    value="Prone" />
                                <label class="form-check-label" for="Prone">Prone</label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check form-check-inline mt-3 ">
                                <input class="form-check-input" type="radio" name="posisi" id="Lithotomi"
                                    value="Lithotomi" />
                                <label class="form-check-label" for="Lithotomi">Lithotomi</label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check form-check-inline mt-3 ">
                                <input class="form-check-input" type="radio" name="posisi" id="Lateral"
                                    value="Lateral Kanan" />
                                <label class="form-check-label" for="Lateral">Lateral Kanan</label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check form-check-inline mt-3 ">
                                <input class="form-check-input" type="radio" name="posisi" id="Lateral_kiri"
                                    value="Lateral Kiri" />
                                <label class="form-check-label" for="Lateral_kiri">Lateral Kiri</label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check form-check-inline mt-3 ">
                                <input class="form-check-input" type="radio" id="posisi_other_radio"
                                    onchange="enableInputPosisi(this)" />
                                <label class="form-check-label" for="LainLainPosisi">
                                    <input class="form-control form-control-sm" id="posisi_other_input" type="text"
                                        name="posisi" value="" disabled />
                                </label>
                            </div>
                        </td>
                    </tr>
                </table>

                {{--  --}}
                <div class="row mt-4">
                    <h5 class="m-0  col-sm-3">3. Perlindungan Mata : </h5>
                    <div class=" col-1  d-flex justify-content-center   align-items-center">
                        <div class="form-check form-check-inline ">
                            <input class="form-check-input" type="radio" id="Kanan" name="perlindungan_mata"
                                value="Kanan" />
                            <label class="form-check-label" for="Kanan">Kanan</label>
                        </div>

                        <div class="form-check form-check-inline mx-2">
                            <input class="form-check-input" type="radio" id="Kiri" name="perlindungan_mata"
                                value="Kiri" />
                            <label class="form-check-label" for="Kiri">Kiri</label>
                        </div>
                    </div>
                </div>

                {{--  --}}
                <h5 class="m-0 mb-2 mt-3">4. Premedikasi</h5>
                <div id="premedikasi">
                    <div class="row mb-2">
                        <div class="col-1">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label ms-2" for="Oral">Oral</label>
                            </div>
                        </div>
                        <div class="col-11">
                            <div class="row ">
                                <div class="col-12">
                                    <input class="form-control form-control-sm" name="premedikasi_oral" type="text"
                                        value="" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-1">
                            <div class="form-check">
                                <label class="form-check-label ms-2" for="I.M">I.M</label>
                            </div>
                        </div>
                        <div class="col-11">
                            <div class="row ">
                                <div class="col-12">
                                    <input class="form-control form-control-sm" name="premedikasi_im" type="text"
                                        value="" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-1">
                            <div class="form-check">
                                <label class="form-check-label ms-2" for="I.V">I.V</label>
                            </div>
                        </div>
                        <div class="col-11">
                            <div class="row ">
                                <div class="col-12">
                                    <input class="form-control form-control-sm" name="premedikasi_iv" type="text"
                                        value="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{--  --}}
                <h5 class="m-0 mb-2 mt-3">5. Induksi</h5>
                <div>
                    <div class="row mb-2">
                        <div class="col-1">
                            <div class="form-check">
                                <label class="form-check-label ms-2" for="Intravena">Intravena</label>
                            </div>
                        </div>
                        <div class="col-11">
                            <div class="row ">
                                <div class="col-12">
                                    <input class="form-control form-control-sm" name="induksi_intravena" type="text"
                                        value="" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-1">
                            <div class="form-check">
                                <label class="form-check-label ms-2" for="Inhalasi">Inhalasi</label>
                            </div>
                        </div>
                        <div class="col-11">
                            <div class="row ">
                                <div class="col-12">
                                    <input class="form-control form-control-sm" type="text" name="induksi_inhalasi"
                                        value="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{--  --}}
                <h5 class="m-0 mb-2 mt-3">6. Tata Laksana Jalan Nafas</h5>
                <table>
                    <tr>
                        <td>
                            <div class="form-check form-check-inline py-1">
                                <label class="form-check-label ms-2" for="Face_Mask">Face Mask</label>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex items-center justify-start">
                                <span>No </span>
                                <input class="mx-2 form-control form-control-sm" type="text" name="face_mask_no"
                                    value="" />
                                <span>Oro/Nasopharing </span>
                            </div>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <div class="form-check form-check-inline py-1">
                                <label class="form-check-label ms-2" for="ETT">ETT</label>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex items-center justify-start">
                                <span>No </span>
                                <input class="mx-2 form-control form-control-sm" type="text" name="ett_no"
                                    value="" />
                                <span>jenis </span>
                                <input class="mx-2 form-control form-control-sm" type="text" name="ett_jenis"
                                    value="" />
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="form-check form-check-inline py-1">
                                <label class="form-check-label ms-2" for="LMA">LMA</label>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex items-center justify-start">
                                <span>No </span>
                                <input class="mx-2 form-control form-control-sm" type="text" name="lma_no"
                                    value="" />
                                <span>jenis </span>
                                <input class="mx-2 form-control form-control-sm" type="text" name="lma_jenis"
                                    value="" />
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="form-check form-check-inline py-1">
                                <label class="form-check-label ms-2" for="Trakheostomi_nafas">Trakheostomi</label>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex items-center justify-start">
                                <span>No </span>
                                <input class="mx-2 form-control form-control-sm" type="text" name="trakheostomi_no"
                                    value="" />
                                <span>jenis </span>
                                <input class="mx-2 form-control form-control-sm" type="text" name="trakheostomi_jenis"
                                    value="" />
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="form-check form-check-inline py-1">
                                <label class="form-check-label ms-2" for="Glidescope">Glidescope</label>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex items-center justify-start">
                                <span>No. </span>
                                <input class="mx-2 form-control form-control-sm" type="text" name="glidescope_no"
                                    value="" />
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                        </td>
                        <td>
                            <div class="d-flex items-center justify-start">
                                <span>Fiksasi</span>
                                <input class="mx-2 form-control form-control-sm" type="text" name="glidescope_fiksasi"
                                    value="" />
                                <span>cm</span>
                            </div>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <div class="form-check form-check-inline py-1 d-flex">
                                <label class="form-check-label ms-2" for="lainnya">Lainnya</label>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex items-center justify-start">
                                <input class="mx-2 form-control form-control-sm" type="text" name="other_airway"
                                    value="" />
                            </div>
                        </td>
                    </tr>
                </table>

                {{--  --}}
                <h5 class="m-0 mb-2 mt-3">7. Intubasi</h5>
                <table>
                    <tr>
                        <td>
                            <div class="form-check form-check-inline py-1 ms-3">
                                <input class="form-check-input" type="checkbox" id="Sesudah_tidur" name="intubasi[]"
                                    value="Sesudah Tidur" />
                                <label class="form-check-label ms-2" for="Sesudah_tidur">Sesudah Tidur</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-check form-check-inline py-1 ms-3">
                                <input class="form-check-input" type="checkbox" id="Blind" name="intubasi[]"
                                    value="Blind" />
                                <label class="form-check-label ms-2" for="Blind">Blind</label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="form-check form-check-inline py-1 ms-3">
                                <input class="form-check-input" type="checkbox" id="oral" name="intubasi[]"
                                    value="Oral" />
                                <label class="form-check-label ms-2" for="oral">Oral</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-check form-check-inline py-1 ms-3">
                                <input class="form-check-input" type="checkbox" id="Nasal_kanan" name="intubasi[]"
                                    value="Nasal Kanan" />
                                <label class="form-check-label ms-2" for="Nasal_kanan">Nasal Kanan</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-check form-check-inline py-1 ms-3">
                                <input class="form-check-input" type="checkbox" id="nasal_kirir" name="intubasi[]"
                                    value="Nasal Kiri" />
                                <label class="form-check-label ms-2" for="nasal_kirir">Nasal Kiri</label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="form-check form-check-inline py-1 ms-3">
                                <input class="form-check-input" type="checkbox" id="Trakheostomi_intubasi"
                                    name="intubasi[]" value="Trakheostomi" />
                                <label class="form-check-label ms-2" for="Trakheostomi_intubasi">Trakheostomi</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="form-check form-check-inline py-1  ms-3">
                                <input class="form-check-input" type="checkbox" id="Cuff" name="intubasi[]"
                                    value="Cuff" />
                                <label class="form-check-label ms-2" for="Cuff">Cuff</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-check form-check-inline py-1  ms-3">
                                <input class="form-check-input" type="checkbox" id="Pack" name="intubasi[]"
                                    value="Pack" />
                                <label class="form-check-label ms-2" for="Pack">Pack</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="form-check form-check-inline py-1  ms-3">
                                <input class="form-check-input" type="checkbox" id="Dengan_Stilet" name="intubasi[]"
                                    value="Dengan Stilet" />
                                <label class="form-check-label ms-2" for="Dengan_Stilet">Dengan Stilet</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-check form-check-inline py-1  ms-3">
                                <input class="form-check-input" type="checkbox" id="Level_ETT" name="intubasi[]"
                                    value="Level ETT" />
                                <label class="form-check-label ms-2" for="Level_ETT">Level ETT</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-check form-check-inline py-1  ms-3">
                                <input class="form-check-input" type="checkbox" id="Sulit_intubasi"
                                    name="intubasi_oth_name[]" value="Sulit intubasi"
                                    onchange="enableInputIntubasi('input_sulit_intubasi', this)" />
                                <label class="form-check-label ms-2" for="Sulit_intubasi">Sulit intubasi</label>
                            </div>
                        </td>
                        <td colspan="4">
                            <input class="form-control form-control-sm " type="text" id="input_sulit_intubasi"
                                value="" name="intubasi_oth_value[]" disabled />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-check form-check-inline py-1  ms-3">
                                <input class="form-check-input" type="checkbox" id="Sulit_ventilasi"
                                    name="intubasi_oth_name[]" value="Sulit ventilasi"
                                    onchange="enableInputIntubasi('input_sulit_ventilasi', this)" />
                                <label class="form-check-label ms-2" for="Sulit_ventilasi">Sulit ventilasi</label>
                            </div>
                        </td>
                        <td colspan="4">
                            <input class="form-control form-control-sm" id="input_sulit_ventilasi" type="text"
                                value="" name="intubasi_oth_value[]" disabled />
                        </td>
                    </tr>


                </table>

                {{--  --}}
                <h5 class="m-0 mb-2 mt-3">8. Ventilasi</h5>
                <table>
                    <tr>
                        <td>
                            <div class="form-check form-check-inline py-1 ms-3">
                                <input class="form-check-input" type="checkbox" id="Spontan" name="ventilasi[]"
                                    value="Spontan" />
                                <label class="form-check-label ms-2" for="Spontan">Spontan</label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="form-check form-check-inline py-1 ms-3">
                                <input class="form-check-input" type="checkbox" id="Kendali" name="ventilasi[]"
                                    value="Kendali" />
                                <label class="form-check-label ms-2" for="Kendali">Kendali</label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="form-check form-check-inline py-1 ms-3">
                                <input class="form-check-input" type="checkbox" id="ventilator" />
                                <label class="form-check-label ms-2" for="ventilator">Ventilator</label>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex items-center justify-start">
                                <input type="hidden" value="TV" name="ventilator_name[]" />
                                <span>TV </span>
                                <input class="mx-2 form-control form-control-sm" type="text" value=""
                                    name="ventilator_value[]" disabled />

                                <input type="hidden" value="RR" name="ventilator_name[]" />
                                <span>RR </span>
                                <input class="mx-2 form-control form-control-sm" type="text" value=""
                                    name="ventilator_value[]" disabled />

                                <input type="hidden" value="PEEP" name="ventilator_name[]" />
                                <span>PEEP </span>
                                <input class="mx-2 form-control form-control-sm" type="text" value=""
                                    name="ventilator_value[]" disabled />
                            </div>
                        </td>
                    </tr>
                </table>
                <div class="row mt-1 ">
                    <div class="col-12 mx-2 mb-1">
                        <label class="form-check-label ms-2" for="ventilator">Lainnya</label>
                    </div>
                    <div class="col-12 mx-3">
                        <input class="form-control form-control-sm" type="text" value="" name="ventilasi[]" />
                    </div>
                </div>

                {{--  --}}
                <h5 class="m-0 mb-2 mt-3">9. Teknik Regional/Blok Perifer
                </h5>
                <div class="row">
                    <div class="col-2">
                        <div class="form-check">
                            <label class="form-check-label ms-2" for="Jenis">Jenis</label>
                        </div>
                    </div>
                    <div class="col-10">
                        <textarea class="form-control form-control-sm" name="jenis" id="editor" rows="3"></textarea>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-2">
                        <div class="form-check">
                            <label class="form-check-label ms-2" for="lokasi_teknik_regi">Lokasi</label>
                        </div>
                    </div>
                    <div class="col-10"> <input class="form-control form-control-sm" type="text" name="lokasi"
                            value="" />
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-2">
                        <div class="form-check">
                            <label class="form-check-label ms-2" for="jenis_jarum">Jenis Jarum / No</label>
                        </div>
                    </div>
                    <div class="col-10"> <input class="form-control form-control-sm" type="text" name="jenis_jarum"
                            value="" />
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-2">
                        <div class="form-check">
                            <label class="form-check-label ms-2" for="karakter">Kateter</label>
                        </div>
                    </div>
                    <div class="col-1">
                        <div class="form-check form-check-inline py-1 ms-3">
                            <input class="form-check-input" type="radio" id="karekter_ya" value="1"
                                name="kateter" />
                            <label class="form-check-label ms-2" for="karekter_ya">Ya</label>
                        </div>
                    </div>
                    <div class="col-1">
                        <div class="form-check form-check-inline py-1 ms-3">
                            <input class="form-check-input" type="radio" id="karakter_tidak " value="0"
                                name="kateter" />
                            <label class="form-check-label ms-2" for="karakter_tidak ">Tidak</label>
                        </div>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-2">
                    </div>
                    <div class="col-2">
                        <div class="d-flex ">
                            <span>Fiksasi </span>
                            <input class="mx-2 form-control form-control-sm" type="text" value=""
                                name="kateter_fiksasi" />
                            <span>cm</span>
                        </div>
                    </div>
                </div>
                <div class="row  mt-2">
                    <div class="col-2">
                        <div class="form-check">
                            <label class="form-check-label ms-2" for="ObatObat">Obat - obat</label>
                        </div>
                    </div>
                    <div class="col-10">
                        <textarea class="form-control form-control-sm" id="editor2" name="obat" rows="3"></textarea>
                    </div>
                </div>
                <div class="row  mt-2">
                    <div class="col-2">
                        <div class="form-check">
                            <label class="form-check-label ms-2" for="Komplikasi">Komplikasi</label>
                        </div>
                    </div>
                    <div class="col-10">
                        <textarea class="form-control form-control-sm" id="editor3" name="komplikasi" rows="3"></textarea>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-2">
                        <div class="form-check">
                            <label class="form-check-label ms-2" for="HasilTeknik">Hasil</label>
                        </div>
                    </div>

                    <div class="col-2">
                        <div class="form-check form-check-inline py-1 ms-3">
                            <input class="form-check-input" type="radio" id="Total_Blok" value="Total Blok"
                                name="hasil" />
                            <label class="form-check-label ms-2" for="Total_Blok">Total Blok</label>
                        </div>
                    </div>
                    <div class="col-1">
                        <div class="form-check form-check-inline py-1 ms-3">
                            <input class="form-check-input" type="radio" id="Partial" value="Partial"
                                name="hasil" />
                            <label class="form-check-label ms-2" for="Partial">Partial</label>
                        </div>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-2"></div>
                    <div class="col-1">
                        <div class="form-check form-check-inline py-1 ms-3">
                            <input class="form-check-input" type="radio" id="gagal" value="Gagal"
                                name="hasil" />
                            <label class="form-check-label ms-2" for="gagal">Gagal</label>
                        </div>
                    </div>
                </div>

                {{-- laporan anestesi page 2 --}}
                <div>
                    <h5>Obat - obatan / infus</h5>
                    <div class="row mb-3">
                        <div class="col-4">
                            <select class="form-control select2" id="medicine_id" name="medicine_id[]">
                                <option selected>Pilih</option>
                                @foreach ($medicines as $medicine)
                                    <option value="{{ $medicine->id ?? '' }}">{{ $medicine->name ?? '' }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-7">
                            <input type="text" class="form-control" name="medicine_value[]">
                        </div>
                        <div class="col-1 align-self-center text-center">
                            <button type="button" class="btn btn-sm btn-dark" onclick="tambahInputObat(this)"><i
                                    class="bx bx-plus"></i></button>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="defaultFormControlInput" class="col-form-label col-4">N20</label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="n20" name="nitrogen_oksida"
                                placeholder="" aria-describedby="defaultFormControlHelp" value="" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="defaultFormControlInput" class="col-form-label col-4">O2</label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="o2" name="oksigen" placeholder=""
                                aria-describedby="defaultFormControlHelp" value="" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="defaultFormControlInput" class="col-form-label col-4">air</label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="air" name="air" placeholder=""
                                aria-describedby="defaultFormControlHelp" value="" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="defaultFormControlInput" class="col-form-label col-4">isof</label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="isof" name="isof" placeholder=""
                                aria-describedby="defaultFormControlHelp" value="" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="defaultFormControlInput" class="col-form-label col-4">sevo</label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="sevo" name="sevo" placeholder=""
                                aria-describedby="defaultFormControlHelp" value="" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="defaultFormControlInput" class="col-form-label col-4">des</label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="des" name="des" placeholder=""
                                aria-describedby="defaultFormControlHelp" value="" />
                        </div>
                    </div>
                </div>

                {{--  --}}
                <div id="anestesi">
                    <h5 class="mt-5">Anestesia</h5>
                    <div class="row">
                        <div class="col-11">
                            <div class="row mb-3">
                                <label for="defaultFormControlInput" class="col-form-label col-2">respirasi</label>
                                <div class="col-10">
                                    <input type="number" class="form-control" id="respirasi" name="respirasi[]"
                                        placeholder="" aria-describedby="defaultFormControlHelp" value="" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="defaultFormControlInput" class="col-form-label col-2">nadi</label>
                                <div class="col-10">
                                    <input type="number" class="form-control" id="nadi" name="nadi[]"
                                        placeholder="" aria-describedby="defaultFormControlHelp" value="" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="defaultFormControlInput" class="col-form-label col-2">tekanan darah</label>
                                <div class="col-10">
                                    <div class="row">
                                        <label for="defaultFormControlInput" class="col-form-label col-2">sistolik</label>
                                        <div class="col-10">
                                            <input type="number" class="form-control" id="tekanan-darah-sistolik"
                                                name="tekanan_darah_sistolik[]" placeholder=""
                                                aria-describedby="defaultFormControlHelp" value="" />
                                        </div>
                                        <label for="defaultFormControlInput"
                                            class="col-form-label mt-3 col-2">diastolik</label>
                                        <div class="mt-3 col-10">
                                            <input type="number" class="form-control" id="tekanan-darah-diastolik"
                                                name="tekanan_darah_diastolik[]" placeholder=""
                                                aria-describedby="defaultFormControlHelp" value="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                {{--  --}}
                <div id="pemantauan">
                    <h5 class="mt-5">Pemantauan</h5>
                    <div class="row mb-3">
                        <div class="col-3">
                            <label for="defaultFormControlInput" class="form-label">Jenis</label>
                            <select name="jenis_pemantauan[]" class="form-select form-control" id="jenis_pemantauan">
                                <option value="Intubasi">Intubasi</option>
                                <option value="Ekstubasi">Ekstubasi</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <label for="defaultFormControlInput" class="form-label">Pemantauan</label>
                            <input type="text" class="form-control" id="pemantauan" name="pemantauan[]"
                                placeholder="" aria-describedby="defaultFormControlHelp" value="" />
                        </div>
                        <div class="col-2">
                            <label for="defaultFormControlInput" class="form-label">satuan</label>
                            <select class="form-control" id="satuan" name="satuan[]">
                                <option selected disabled>Pilih</option>
                                <option value="ml">ml</option>
                                <option value="%">%</option>
                                <option value="mmHg">mmHg</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <label for="defaultFormControlInput" class="form-label">nilai</label>
                            <input type="number" class="form-control" id="nilai" name="nilai[]" placeholder=""
                                aria-describedby="defaultFormControlHelp" value="" />
                        </div>
                        <div class="col-1 align-self-center text-center">
                            <button type="button" class="btn btn-sm btn-dark" onclick="tambahInputPemantauan()"><i
                                    class="bx bx-plus"></i></button>
                        </div>
                    </div>
                </div>

                {{--  --}}
                <div class="mb-5 col">
                    <div class="row">
                        <p class="m-0 col-2">Lama Pembiusan</p>
                        <div class="col">
                            <div class="gap-3 d-flex align-items-center">
                                <div class="gap-2 d-flex align-items-center">
                                    <input type="number" class="form-control form-control-sm" name="lama_pembiusan_jam"
                                        style="max-width: 100px">
                                    <label class="m-0 form-label">jam</label>
                                </div>
                                <div class="gap-2 d-flex align-items-center">
                                    <input type="number" class="form-control form-control-sm"
                                        name="lama_pembiusan_menit" style="max-width: 100px">
                                    <label class="m-0 form-label">menit</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2 row">
                        <p class="m-0 col-2">Lama Pembedahan</p>
                        <div class="col">
                            <div class="gap-3 d-flex align-items-center">
                                <div class="gap-2 d-flex align-items-center">
                                    <input type="number" class="form-control form-control-sm" name="lama_pembedahan_jam"
                                        style="max-width: 100px">
                                    <label class="m-0 form-label">jam</label>
                                </div>
                                <div class="gap-2 d-flex align-items-center">
                                    <input type="number" class="form-control form-control-sm"
                                        name="lama_pembedahan_menit" style="max-width: 100px">
                                    <label class="m-0 form-label">menit</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <p>Keterangan / Catatan Intra Anestesi</p>
                    <textarea id="editor4" class="form-control" rows="3" name="keterangan"></textarea>
                </div>

                <div class="row mt-5 mb-5">
                    <div class="col-3 text-center">
                        Penata Anestesi
                    </div>
                    <div class="col-3 text-center">
                        Dokter Anestesi
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-3 text-center">
                        <img src="{{ asset('storage/' . $item->ttd_penata_anestesi) }}" alt="" id="ImgTtdPenata">
                        <textarea id="ttdPenata" name="ttd_penata_anestesi" style="display: none;">{{ $item->ttd_penata_anestesi ?? '' }}</textarea>
                        <button type="button" class="col-12 btn btn-sm btn-dark"
                            onclick="openModal(this, 'ImgTtdPenata', 'ttdPenata', 'penata_name')">Tanda
                            Tangan</button>
                    </div>
                    <div class="col-3 text-center">
                        <img src="{{ asset('storage/' . $item->ttd_dokter_anestesi) }}" alt="" id="ImgTtdDokter">
                        <textarea id="ttdDokter" name="ttd_dokter_anestesi" style="display: none;">{{ $item->ttd_dokter_anestesi ?? '' }}</textarea>
                        <button type="button" class="col-12 btn btn-sm btn-dark"
                            onclick="openModal(this, 'ImgTtdDokter', 'ttdDokter', 'dokter_name')">Tanda
                            Tangan</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3 text-center">
                        <input type="text" class="form-control text-center" name="nama_penata_anestesi"
                            id="penata_name" value="{{ $item->nama_penata_anestesi ?? '' }}"
                            placeholder="Nama Penata Anestesi" @readonly(true)>
                    </div>
                    <div class="col-3 text-center">
                        <input type="text" class="form-control text-center" name="nama_dokter_anestesi"
                            id="dokter_name" value="{{ $item->nama_dokter_anestesi ?? '' }}"
                            placeholder="Nama Dokter Anestesi" @readonly(true)>
                    </div>
                </div>

                <div class="mt-5 mb-3 text-end">
                    <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                </div>
            </div>
        </form>
    </div>

    {{-- modal get ttd --}}
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
                            <button type="button" class="btn btn-sm btn-secondary"
                                data-action="clearInput">Clear</button>
                            <button type="button" class="btn btn-sm btn-primary" data-action="saveInput">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>
        let tempElementImage;
        let tempTextArea;
        let tempPetugasName;

        function openModal(element, elementImage, elementTextArea, petugasName) {
            tempElementImage = $(element).closest('.row').find('#' + elementImage);
            tempTextArea = $(element).closest('.row').find('#' + elementTextArea);
            tempPetugasName = petugasName;
            $('#getTtdModal').modal('show');
        }
        document.addEventListener('DOMContentLoaded', function() {
            var posisiOtherRadio = document.getElementById('posisi_other_radio');
            var posisiOtherInput = document.getElementById('posisi_other_input');
            var radioPosisi = document.querySelectorAll('input[type="radio"][name="posisi"]');
            radioPosisi.forEach(function(radio) {
                radio.addEventListener('change', function() {
                    if (radio.checked == true) {
                        posisiOtherRadio.checked = false;
                        posisiOtherInput.value = '';
                        posisiOtherInput.disabled = true;
                    }
                });
            });


            // enable disable input ventilator
            var ventilator = document.getElementById('ventilator');
            var inputElement = document.querySelectorAll('input[name="ventilator_value[]"]');
            ventilator.addEventListener('change', function() {
                if (ventilator.checked == true) {
                    enableAll(inputElement);
                } else {
                    disableAll(inputElement);
                }
            });

            // start get ttd from user table
            var modal = document.getElementById("getTtdModal");
            var clearButtonInput = modal.querySelector("[data-action=clearInput]");
            var saveButtonInput = modal.querySelector("[data-action=saveInput]");
            var inputPass = modal.querySelector('input[name="password_user"]');
            var inputUserId = modal.querySelector('input[name="user_id"]');

            clearButtonInput.addEventListener('click', function(e) {
                e.preventDefault();
                signaturePad.clear();
            });

            saveButtonInput.addEventListener("click", function(e) {
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
                        tempElementImage.attr('src', newSrc);
                        tempTextArea.val(data);
                        $('#' + tempPetugasName).val(`{{ auth()->user()->name }}`);
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

        function enableAll(elements) {
            elements.forEach(function(input) {
                input.disabled = false;
            });
        }

        function disableAll(elements) {
            elements.forEach(function(input) {
                input.value = '';
                input.disabled = true;
            });
        }
    </script>
    {{-- <script>
        function openModal(element) {
            $('#getTtdModal').modal('show');
        }
        document.addEventListener('DOMContentLoaded', function() {
            var posisiOtherRadio = document.getElementById('posisi_other_radio');
            var posisiOtherInput = document.getElementById('posisi_other_input');
            var radioPosisi = document.querySelectorAll('input[type="radio"][name="posisi"]');
            radioPosisi.forEach(function(radio) {
                radio.addEventListener('change', function() {
                    if (radio.checked == true) {
                        posisiOtherRadio.checked = false;
                        posisiOtherInput.value = '';
                        posisiOtherInput.disabled = true;
                    }
                });
            });


            // enable disable input ventilator
            var ventilator = document.getElementById('ventilator');
            var inputElement = document.querySelectorAll('input[name="ventilator_value[]"]');
            ventilator.addEventListener('change', function() {
                if (ventilator.checked == true) {
                    enableAll(inputElement);
                } else {
                    disableAll(inputElement);
                }
            });


            // start get ttd from user table
            var modal = document.getElementById("getTtdModal");
            var clearButtonInput = modal.querySelector("[data-action=clearInput]");
            var saveButtonInput = modal.querySelector("[data-action=saveInput]");
            var inputPass = modal.querySelector('input[name="password_user"]');
            var inputUserId = modal.querySelector('input[name="user_id"]');

            clearButtonInput.addEventListener('click', function(e) {
                e.preventDefault();
                signaturePad.clear();
            });

            saveButtonInput.addEventListener("click", function(e) {
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
                        $('#ImgTtdPpj').attr('src', newSrc);
                        $('#ttdPpj').val(data);
                        $('#petugas_name').val(`{{ auth()->user()->name }}`);
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

        function enableAll(elements) {
            elements.forEach(function(input) {
                input.disabled = false;
            });
        }

        function disableAll(elements) {
            elements.forEach(function(input) {
                input.value = '';
                input.disabled = true;
            });
        }
    </script> --}}
    <script>
        function enableInputPosisi(element) {
            var radioPosisi = document.querySelectorAll('input[type="radio"][name="posisi"]');
            var posisiOtherInput = document.getElementById('posisi_other_input');
            if (element.checked == true) {
                posisiOtherInput.disabled = false;
                radioPosisi.forEach(function(radio) {
                    radio.checked = false;
                });
            } else {
                posisiOtherInput.disabled = true;
            }
        }
    </script>
    <script>
        function enableInputIntubasi(idName, element) {
            var targetElement = document.getElementById(idName);
            if (element.checked == true) {
                targetElement.disabled = false;
            } else {
                targetElement.value = '';
                targetElement.disabled = true;
            }
        }
    </script>
    <script>
        let countIdObat = 1;

        function tambahInputObat(element) {
            var parent = element.parentNode.parentNode;
            var newDiv = document.createElement('div');
            newDiv.className = 'row mb-3';
            newDiv.innerHTML = `
                    <div class="col-4">
                        <select class="form-control select2" id="medicine_id_${countIdObat}" name="medicine_id[]">
                            <option selected>Pilih</option>
                            @foreach ($medicines as $medicine)
                                <option value="{{ $medicine->id ?? '' }}">{{ $medicine->name ?? '' }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-7">
                        <input type="text" class="form-control" name="medicine_value[]">
                    </div>
                    <div class="col-1 align-self-center text-center">
                        <button type="button" class="btn btn-sm btn-danger" onclick="hapusInputObat(this)"><i class="bx bx-minus"></i></button>
                    </div>
            `;
            parent.insertAdjacentElement('afterend', newDiv);
            $('#medicine_id_' + countIdObat).select2();
            countIdObat = countIdObat + 1;
        }

        function hapusInputObat(element) {
            var parent = element.parentNode.parentNode;
            parent.remove();
        }
    </script>
    <script>
        function tambahInputAnestesi(element) {
            var parent = document.getElementById('anestesi');
            var newDiv = document.createElement('div');
            newDiv.className = 'row';
            newDiv.innerHTML = `
                    <hr>
                    <div class="col-11">
                    <div class="row mb-3">
                        <label for="defaultFormControlInput" class="col-form-label col-2">respirasi</label>
                        <div class="col-10">
                            <input type="number" class="form-control" id="respirasi" name="respirasi[]" placeholder="" aria-describedby="defaultFormControlHelp" value="" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="defaultFormControlInput" class="col-form-label col-2">nadi</label>
                        <div class="col-10">
                            <input type="number" class="form-control" id="nadi" name="nadi[]" placeholder="" aria-describedby="defaultFormControlHelp" value="" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="defaultFormControlInput" class="col-form-label col-2">tekanan darah</label>
                        <div class="col-10">
                        <div class="row">
                            <label for="defaultFormControlInput" class="col-form-label col-2">sistolik</label>
                            <div class="col-10">
                                <input type="number" class="form-control" id="tekanan-darah-sistolik" name="tekanan_darah_sistolik[]" placeholder="" aria-describedby="defaultFormControlHelp" value="" />
                            </div>
                            <label for="defaultFormControlInput" class="col-form-label mt-3 col-2">diastolik</label>
                            <div class="mt-3 col-10">
                                <input type="number" class="form-control" id="tekanan-darah-diastolik" name="tekanan_darah_diastolik[]" placeholder="" aria-describedby="defaultFormControlHelp" value="" />
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-1 align-self-center text-center">
                    <button type="button" class="btn btn-sm btn-danger" onclick="hapusInputAnestesi(this)"><i class="bx bx-minus"></i></button>
                </div>
            `;
            parent.appendChild(newDiv);
        }

        function hapusInputAnestesi(element) {
            var parent = element.parentNode.parentNode;
            parent.remove();
        }
    </script>
    <script>
        function tambahInputPemantauan(element) {
            var parent = document.getElementById('pemantauan');
            var newDiv = document.createElement('div');
            newDiv.className = 'row mb-3';
            newDiv.innerHTML = `
                    <hr>
                    <div class="col-3">
                        <label for="defaultFormControlInput" class="form-label">Jenis</label>
                        <select name="jenis_pemantauan[]" class="form-select form-control" id="jenis_pemantauan">
                            <option value="Intubasi">Intubasi</option>
                            <option value="Ekstubasi">Ekstubasi</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <label for="defaultFormControlInput" class="form-label">Pemantauan</label>
                        <input type="text" class="form-control" id="pemantauan" name="pemantauan[]" placeholder="" aria-describedby="defaultFormControlHelp" value="" />
                    </div>
                    <div class="col-2">
                        <label for="defaultFormControlInput" class="form-label">satuan</label>
                        <select class="form-control" id="satuan" name="satuan[]">
                            <option selected disabled>Pilih</option>
                            <option value="ml">ml</option>
                            <option value="%">%</option>
                            <option value="mmHg">mmHg</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <label for="defaultFormControlInput" class="form-label">nilai</label>
                        <input type="number" class="form-control" id="nilai" name="nilai[]" placeholder="" aria-describedby="defaultFormControlHelp" value="" />
                    </div>
                    <div class="col-1 align-self-center text-center">
                        <button type="button" class="btn btn-sm btn-danger" onclick="hapusInputPemantauan(this)"><i class="bx bx-minus"></i></button>
                    </div>
            `;
            parent.appendChild(newDiv);
        }

        function hapusInputPemantauan(element) {
            var parent = element.parentNode.parentNode;
            parent.remove();
        }
    </script>
@endsection
