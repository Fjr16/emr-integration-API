@extends('layouts.backend.main')

<style>
    .min-50 {
        min-width: 50px;
    }

    .min-100 {
        min-width: 100px;
        text-center
    }
</style>



@section('content')
    @if (session()->has('success'))
        <div class="mb-5 border alert alert-success w-100 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content; left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="p-3 mt-5 card ">

        <div class="d-flex">
            <h4 class="m-0 align-self-center">LAPORAN ANESTESI </h4>
            {{-- <div class="ms-auto">
                <a href="{{ route('farmasi/obat/konversi.create') }}" class="m-0 btn btn-success btn-sm">+ Tambah Konversi</a>
                <a href="{{ route('farmasi/obat/master/konversi.create') }}" class="m-0 mx-2 btn btn-success btn-sm">+ Tambah
                    Satuan</a>
            </div> --}}
        </div>
        <hr class="m-0 mt-2 mb-3">
        <form action="" method="POST" onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
            @csrf
            <div class="card-body table-responsive">
                <h5 class="m-0 mb-1">1. Infus Perifer : Tempat dan Ukuran</h5>

                <div class="mb-3 row ms-3">
                    <label for="nama_rohaniawan" class="col-form-label col-1">1.</label>
                    <div class="col-11">
                        <input class="form-control form-control-sm" type="text" value="" />
                    </div>
                </div>
                <div class="mb-3 row ms-3">
                    <label for="umur" class="col-form-label col-1">2.</label>
                    <div class="col-11">
                        <input class="form-control form-control-sm" type="text" value="" />
                    </div>
                </div>
                <div class="mb-3 row ms-3">
                    <label for="agama" class="col-form-label col-1">CVC</label>
                    <div class="col-11 ">
                        <input class="form-control form-control-sm" type="text" value="" />
                    </div>
                </div>




                <h5 class="m-0 mb-1">2. Posisi</h5>


                <table class="ms-4">
                    <tr>
                        <td>
                            <div class="mt-3 form-check form-check-inline ">
                                <input class="form-check-input" type="checkbox" id="Telentang" value="" />
                                <label class="form-check-label" for="Telentang">Telentang</label>
                            </div>
                        </td>
                        <td>
                            <div class="mt-3 form-check form-check-inline ">
                                <input class="form-check-input" type="checkbox" id="Prone" value="" />
                                <label class="form-check-label" for="Prone">Prone</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="mt-3 form-check form-check-inline ">
                                <input class="form-check-input" type="checkbox" id="Lithotomi" value="" />
                                <label class="form-check-label" for="Lithotomi">Lithotomi</label>
                            </div>
                        </td>
                        <td>
                            <div class="mt-3 form-check form-check-inline ">
                                <input class="form-check-input" type="checkbox" id="Lateral" value="" />
                                <label class="form-check-label" for="Lateral">Lateral</label>
                            </div>
                        </td>
                        <td>
                            <div class="mt-3 form-check form-check-inline ">
                                <input class="form-check-input" type="checkbox" id="LateralKanan" value="" />
                                <label class="form-check-label" for="LateralKanan">Kanan</label>
                            </div>
                        </td>
                        <td>
                            <div class="mt-3 form-check form-check-inline ">
                                <input class="form-check-input" type="checkbox" id="LateralKiri" value="" />
                                <label class="form-check-label" for="LateralKiri">Kiri</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="mt-3 form-check form-check-inline ">
                                <input class="form-check-input" type="checkbox" id="LainLainPosisi" value="" />
                                <label class="form-check-label" for="LainLainPosisi">
                                    <p>Lain-lain</p>
                                </label>
                            </div>
                        </td>
                        <td>
                            <input class="form-control form-control-sm" type="text" value="" />
                        </td>
                    </tr>
                </table>







                <div class="mt-4 row">
                    <h5 class="m-0 col-sm-3">3. Perlindungan Mata : </h5>
                    <div class=" col-1 d-flex justify-content-center align-items-center">
                        <div class="form-check form-check-inline ">
                            <input class="form-check-input" type="checkbox" id="Kanan" value="" />
                            <label class="form-check-label" for="Kanan">Kanan</label>
                        </div>

                        <div class="mx-2 form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="Kiri" value="" />
                            <label class="form-check-label" for="Kiri">Kiri</label>
                        </div>
                    </div>
                </div>






                <h5 class="m-0 mt-3 mb-2">4. Premedikasi</h5>
                <div>

                    <div class="mb-2 row">
                        <div class="col-1">
                            <div class="form-check form-check-inline ms-3">
                                <input class="form-check-input" type="checkbox" id="Oral" value="" />
                                <label class="form-check-label ms-2" for="Oral">Oral</label>
                            </div>
                        </div>
                        <span class="text-center col-1">:</span>
                        <div class="col-10">
                            <div class="row ">
                                <div class="col-12">
                                    <input class="form-control form-control-sm" type="text" value="" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <div class="col-1">
                            <div class="form-check form-check-inline ms-3">
                                <input class="form-check-input" type="checkbox" id="I.M" value="" />
                                <label class="form-check-label ms-2" for="I.M">I.M</label>
                            </div>
                        </div>
                        <span class="text-center col-1">:</span>
                        <div class="col-10">
                            <div class="row ">
                                <div class="col-12">
                                    <input class="form-control form-control-sm" type="text" value="" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <div class="col-1">
                            <div class="form-check form-check-inline ms-3">
                                <input class="form-check-input" type="checkbox" id="I.V" value="" />
                                <label class="form-check-label ms-2" for="I.V">I.V</label>
                            </div>
                        </div>
                        <span class="text-center col-1">:</span>
                        <div class="col-10">
                            <div class="row ">
                                <div class="col-12">
                                    <input class="form-control form-control-sm" type="text" value="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>







                <h5 class="m-0 mt-3 mb-2">5. Induksi</h5>
                <div>

                    <div class="mb-2 row">
                        <div class="col-1">
                            <div class="form-check form-check-inline ms-3">
                                <input class="form-check-input" type="checkbox" id="Intravena" value="" />
                                <label class="form-check-label ms-2" for="Intravena">Intravena</label>
                            </div>
                        </div>
                        <span class="text-center col-1">:</span>
                        <div class="col-10">
                            <div class="row ">
                                <div class="col-12">
                                    <input class="form-control form-control-sm" type="text" value="" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <div class="col-1">
                            <div class="form-check form-check-inline ms-3">
                                <input class="form-check-input" type="checkbox" id="Inhalasi" value="" />
                                <label class="form-check-label ms-2" for="Inhalasi">Inhalasi</label>
                            </div>
                        </div>
                        <span class="text-center col-1">:</span>
                        <div class="col-10">
                            <div class="row ">
                                <div class="col-12">
                                    <input class="form-control form-control-sm" type="text" value="" />
                                </div>
                            </div>
                        </div>
                    </div>

                </div>





                <h5 class="m-0 mt-3 mb-2">6. Tata Laksana Jalan Nafas</h5>
                <table>
                    <tr>
                        <td>
                            <div class="py-1 form-check form-check-inline ms-3">
                                <input class="form-check-input" type="checkbox" id="Face_Mask" value="" />
                                <label class="form-check-label ms-2" for="Face_Mask">Face Mask</label>
                            </div>
                        </td>
                        <td>
                            <div class="items-center justify-start d-flex">
                                <span>No </span>
                                <input class="mx-2 form-control form-control-sm" type="text" value="" />
                                <span>Oro/Nasopharing </span>
                            </div>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <div class="py-1 form-check form-check-inline ms-3">
                                <input class="form-check-input " type="checkbox" id="ETT" value="" />
                                <label class="form-check-label ms-2" for="ETT">ETT</label>
                            </div>
                        </td>
                        <td>
                            <div class="items-center justify-start d-flex">
                                <span>No </span>
                                <input class="mx-2 form-control form-control-sm" type="text" value="" />
                                <span>jenis </span>
                                <input class="mx-2 form-control form-control-sm" type="text" value="" />
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="py-1 form-check form-check-inline ms-3">
                                <input class="form-check-input" type="checkbox" id="LMA" value="" />
                                <label class="form-check-label ms-2" for="LMA">LMA</label>
                            </div>
                        </td>
                        <td>
                            <div class="items-center justify-start d-flex">
                                <span>No </span>
                                <input class="mx-2 form-control form-control-sm" type="text" value="" />
                                <span>jenis </span>
                                <input class="mx-2 form-control form-control-sm" type="text" value="" />
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="py-1 form-check form-check-inline ms-3">
                                <input class="form-check-input" type="checkbox" id="Trakheostomi_nafas"
                                    value="" />
                                <label class="form-check-label ms-2" for="Trakheostomi_nafas">Trakheostomi</label>
                            </div>
                        </td>
                        <td>
                            <div class="items-center justify-start d-flex">
                                <span>No </span>
                                <input class="mx-2 form-control form-control-sm" type="text" value="" />
                                <span>jenis </span>
                                <input class="mx-2 form-control form-control-sm" type="text" value="" />
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="py-1 form-check form-check-inline ms-3">
                                <input class="form-check-input" type="checkbox" id="Glidescope" value="" />
                                <label class="form-check-label ms-2" for="Glidescope">Glidescope</label>
                            </div>
                        </td>
                        <td>
                            <div class="items-center justify-start d-flex">
                                <span>No. </span>
                                <input class="mx-2 form-control form-control-sm" type="text" value="" />
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                        </td>
                        <td>
                            <div class="items-center justify-start d-flex">
                                <span>Fiksasi</span>
                                <input class="mx-2 form-control form-control-sm" type="text" value="" />
                                <span>cm</span>
                            </div>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <div class="py-1 form-check form-check-inline ms-3">
                                <input class="form-check-input" type="checkbox" id="lain-lain-jalan-nafas"
                                    value="" />
                                <label class="form-check-label ms-2" for="lain-lain-jalan-nafas">lain-lain</label>
                            </div>
                        </td>
                        <td>
                            <input class="mx-2 form-control form-control-sm" type="text" value="" />
                        </td>
                    </tr>
                </table>




                <h5 class="m-0 mt-3 mb-2">7. Intubasi</h5>
                <table>
                    <tr>
                        <td>
                            <div class="py-1 form-check form-check-inline ms-3">
                                <input class="form-check-input" type="checkbox" id="Sesudah_tidur" value="" />
                                <label class="form-check-label ms-2" for="Sesudah_tidur">Sesudah tidur</label>
                            </div>
                        </td>
                        <td>
                            <div class="py-1 form-check form-check-inline ms-3">
                                <input class="form-check-input" type="checkbox" id="Blind" value="" />
                                <label class="form-check-label ms-2" for="Blind">Blind</label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="py-1 form-check form-check-inline ms-3">
                                <input class="form-check-input" type="checkbox" id="oral" value="" />
                                <label class="form-check-label ms-2" for="oral">Oral</label>
                            </div>
                        </td>
                        <td>
                            <div class="py-1 form-check form-check-inline ms-3">
                                <input class="form-check-input" type="checkbox" id="Nasal" value="" />
                                <label class="form-check-label ms-2" for="Nasal">Nasal</label>
                            </div>
                        </td>
                        <td>
                            <div class="py-1 form-check form-check-inline ms-3">
                                <input class="form-check-input" type="checkbox" id="KananOral" value="" />
                                <label class="form-check-label ms-2" for="KananOral">Kanan</label>
                            </div>
                        </td>
                        <td>
                            <div class="py-1 form-check form-check-inline ms-3">
                                <input class="form-check-input" type="checkbox" id="KiriOral" value="" />
                                <label class="form-check-label ms-2" for="KiriOral">kiri</label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="py-1 form-check form-check-inline ms-3">
                                <input class="form-check-input" type="checkbox" id="Trakheostomi_intubasi"
                                    value="" />
                                <label class="form-check-label ms-2" for="Trakheostomi_intubasi">Trakheostomi</label>
                            </div>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <div class="py-1 form-check form-check-inline ms-3">
                                <input class="form-check-input" type="checkbox" id="Sulit_ventilasi" value="" />
                                <label class="form-check-label ms-2" for="Sulit_ventilasi">Sulit ventilasi</label>
                            </div>
                        </td>
                        <td colspan="4">
                            <input class="form-control form-control-sm " type="text" value="" />
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <div class="py-1 form-check form-check-inline ms-3">
                                <input class="form-check-input" type="checkbox" id="Sulit_intubasi" value="" />
                                <label class="form-check-label ms-2" for="Sulit_intubasi">Sulit intubasi</label>
                            </div>
                        </td>
                        <td colspan="4">
                            <input class="form-control form-control-sm " type="text" value="" />
                        </td>
                    </tr>


                    <tr>
                        <td colspan="2">
                            <div class="py-1 form-check form-check-inline ms-3">
                                <input class="form-check-input" type="checkbox" id="Dengan_Stilet" value="" />
                                <label class="form-check-label ms-2" for="Dengan_Stilet">Dengan Stilet
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="py-1 form-check form-check-inline ms-3">
                                <input class="form-check-input" type="checkbox" id="Level_ETT" value="" />
                                <label class="form-check-label ms-2" for="Level_ETT">Level ETT
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="py-1 form-check form-check-inline ms-3">
                                <input class="form-check-input" type="checkbox" id="Cuff" value="" />
                                <label class="form-check-label ms-2" for="Cuff">Cuff
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="py-1 form-check form-check-inline ms-3">
                                <input class="form-check-input" type="checkbox" id="Pack" value="" />
                                <label class="form-check-label ms-2" for="Pack">Pack
                                </label>
                            </div>
                        </td>
                    </tr>


                </table>



                <h5 class="m-0 mt-3 mb-2">8. Ventilasi</h5>
                <table>
                    <tr>
                        <td>
                            <div class="py-1 form-check form-check-inline ms-3">
                                <input class="form-check-input" type="checkbox" id="Spontan" value="" />
                                <label class="form-check-label ms-2" for="Spontan">Spontan</label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="py-1 form-check form-check-inline ms-3">
                                <input class="form-check-input" type="checkbox" id="Kendali" value="" />
                                <label class="form-check-label ms-2" for="Kendali">Kendali</label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="py-1 form-check form-check-inline ms-3">
                                <input class="form-check-input" type="checkbox" id="ventilator" value="" />
                                <label class="form-check-label ms-2" for="ventilator">Ventilator</label>
                            </div>
                        </td>
                        <td>
                            <div class="items-center justify-start d-flex">
                                <span>TV </span>
                                <input class="mx-2 form-control form-control-sm" type="text" value="" />
                                <span>RP </span>
                                <input class="mx-2 form-control form-control-sm" type="text" value="" />
                                <span>PEP </span>
                                <input class="mx-2 form-control form-control-sm" type="text" value="" />
                            </div>
                        </td>
                    </tr>
                </table>
                <div class="mt-1 row ">
                    <div class="col-2">
                        <div class="py-1 form-check form-check-inline ms-3">
                            <input class="form-check-input" type="checkbox" id="lainlainventilasi" value="" />
                            <label class="form-check-label ms-2" for="lainlainventilasi">Lain Lain</label>
                        </div>
                    </div>
                    <div class="col-10"> <input class="form-control form-control-sm" type="text" value="" />
                    </div>
                </div>








                <h5 class="m-0 mt-3 mb-2">9. Teknik Regional/Blok Perifer
                </h5>



                <div class="row ">
                    <div class="col-2">
                        <div class="py-1 form-check form-check-inline ms-3">
                            <input class="form-check-input" type="checkbox" id="Jenis" value="" />
                            <label class="form-check-label ms-2" for="Jenis">Jenis</label>
                        </div>
                    </div>
                    <div class="col-10">
                        <textarea class="form-control form-control-sm" id="jenis" rows="3"></textarea>
                    </div>
                </div>



                <div class="mt-1 row">
                    <div class="col-2">
                        <div class="py-1 form-check form-check-inline ms-3">
                            <input class="form-check-input" type="checkbox" id="lokasi_teknik_regi" value="" />
                            <label class="form-check-label ms-2" for="lokasi_teknik_regi">Lokasi</label>
                        </div>
                    </div>
                    <div class="col-10"> <input class="form-control form-control-sm" type="text" value="" />
                    </div>
                </div>

                <div class="mt-1 row">
                    <div class="col-2">
                        <div class="py-1 form-check form-check-inline ms-3">
                            <input class="form-check-input" type="checkbox" id="jenis_jarum" value="" />
                            <label class="form-check-label ms-2" for="jenis_jarum">Jenis Jarum / No</label>
                        </div>
                    </div>
                    <div class="col-10"> <input class="form-control form-control-sm" type="text" value="" />
                    </div>
                </div>

                <div class="mt-1 row">
                    <div class="col-2">
                        <div class="py-1 form-check form-check-inline ms-3">
                            <input class="form-check-input" type="checkbox" id="karakter" value="" />
                            <label class="form-check-label ms-2" for="karakter">Karakter</label>
                        </div>
                    </div>
                    <div class="col-1">
                        <div class="py-1 form-check form-check-inline ms-3">
                            <input class="form-check-input" type="checkbox" id="karekter_ya" value="" />
                            <label class="form-check-label ms-2" for="karekter_ya">Ya</label>
                        </div>
                    </div>
                    <div class="col-1">
                        <div class="py-1 form-check form-check-inline ms-3">
                            <input class="form-check-input" type="checkbox" id="karakter_tidak " value="" />
                            <label class="form-check-label ms-2" for="karakter_tidak ">Tidak</label>
                        </div>
                    </div>
                </div>




                <div class="mt-1 row">
                    <div class="col-2">

                    </div>

                    <div class="col-2">
                        <div class="d-flex ">
                            <span>Fiksasi </span>
                            <input class="mx-2 form-control form-control-sm" type="text" value="" />
                            <span>cm</span>
                        </div>
                    </div>
                </div>



                <div class="mt-2 row">
                    <div class="col-2">
                        <div class="py-1 form-check form-check-inline ms-3">
                            <input class="form-check-input" type="checkbox" id="ObatObat" value="" />
                            <label class="form-check-label ms-2" for="ObatObat">Obat - obat</label>
                        </div>
                    </div>
                    <div class="col-10">
                        <textarea class="form-control form-control-sm" id="obet" rows="3"></textarea>
                    </div>
                </div>

                <div class="mt-2 row">
                    <div class="col-2">
                        <div class="py-1 form-check form-check-inline ms-3">
                            <input class="form-check-input" type="checkbox" id="Komplikasi" value="" />
                            <label class="form-check-label ms-2" for="Komplikasi">Komplikasi</label>
                        </div>
                    </div>
                    <div class="col-10">
                        <textarea class="form-control form-control-sm" id="obet" rows="3"></textarea>
                    </div>
                </div>


                <div class="mt-1 row">
                    <div class="col-2">
                        <div class="py-1 form-check form-check-inline ms-3">
                            <input class="form-check-input" type="checkbox" id="HasilTeknik" value="" />
                            <label class="form-check-label ms-2" for="HasilTeknik">Hasil</label>
                        </div>
                    </div>

                    <div class="col-2">
                        <div class="py-1 form-check form-check-inline ms-3">
                            <input class="form-check-input" type="checkbox" id="Total_Blok " value="" />
                            <label class="form-check-label ms-2" for="Total_Blok ">Total Blok</label>
                        </div>
                    </div>
                    <div class="col-1">
                        <div class="py-1 form-check form-check-inline ms-3">
                            <input class="form-check-input" type="checkbox" id="Partial " value="" />
                            <label class="form-check-label ms-2" for="Partial ">Partial</label>
                        </div>
                    </div>
                </div>

                <div class="mt-1 row">
                    <div class="col-2"></div>

                    <div class="col-1">
                        <div class="py-1 form-check form-check-inline ms-3">
                            <input class="form-check-input" type="checkbox" id="Gagal " value="" />
                            <label class="form-check-label ms-2" for="Gagal ">Gagal</label>
                        </div>
                    </div>

                </div>







                {{-- ================== TAMBAHAN BARU PADA LAPORAN ANESTESI (TABEL) ================== --}}
                <div>
                    <h6>Obat - obatan / infus</h6>

                    <div class="row mb-3">
                        <label for="defaultFormControlInput" class="col-form-label col-2">Obat - Obatan</label>
                        <div class="col-9">
                            <select class="form-control select2" id="obat_id" name="obat_id" onchange="getPatient()">
                                <option value="" selected>Pilih</option>
                            </select>
                        </div>
                        <div class="col-1 align-self-center text-center">
                            <button class="btn btn-sm btn-dark"><i class="bx bx-plus"></i></button>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="defaultFormControlInput" class="col-form-label col-2">N20</label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="n20" name="n20" placeholder="" aria-describedby="defaultFormControlHelp" value="" />
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="defaultFormControlInput" class="col-form-label col-2">O2</label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="o2" name="o2" placeholder="" aria-describedby="defaultFormControlHelp" value="" />
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="defaultFormControlInput" class="col-form-label col-2">air</label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="air" name="air" placeholder="" aria-describedby="defaultFormControlHelp" value="" />
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="defaultFormControlInput" class="col-form-label col-2">isof</label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="isof" name="isof" placeholder="" aria-describedby="defaultFormControlHelp" value="" />
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="defaultFormControlInput" class="col-form-label col-2">sevo</label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="sevo" name="sevo" placeholder="" aria-describedby="defaultFormControlHelp" value="" />
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="defaultFormControlInput" class="col-form-label col-2">des</label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="des" name="des" placeholder="" aria-describedby="defaultFormControlHelp" value="" />
                        </div>
                      </div>

                </div>

                <div>
                    <h6>Anestesia</h6>
                    <div class="row">
                        <div class="col-11">
                            <div class="row mb-3">
                              <label for="defaultFormControlInput" class="col-form-label col-2">respirasi</label>
                              <div class="col-10">
                                  <input type="number" class="form-control" id="respirasi" name="respirasi" placeholder="" aria-describedby="defaultFormControlHelp" value="" />
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label for="defaultFormControlInput" class="col-form-label col-2">nadi</label>
                              <div class="col-10">
                                  <input type="number" class="form-control" id="nadi" name="nadi" placeholder="" aria-describedby="defaultFormControlHelp" value="" />
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label for="defaultFormControlInput" class="col-form-label col-2">tekanan darah</label>
                              <div class="col-10">
                                <div class="row">
                                    <label for="defaultFormControlInput" class="col-form-label col-2">sistolik</label>
                                    <div class="col-10">
                                        <input type="number" class="form-control" id="tekanan-darah-sistolik" name="tekanan-darah-sistolik" placeholder="" aria-describedby="defaultFormControlHelp" value="" />
                                    </div>
                                    <label for="defaultFormControlInput" class="col-form-label mt-3 col-2">diastolik</label>
                                    <div class="mt-3 col-10">
                                        <input type="number" class="form-control" id="tekanan-darah-diastolik" name="tekanan-darah-diastolik" placeholder="" aria-describedby="defaultFormControlHelp" value="" />
                                    </div>
                                </div>
                              </div>
                            </div>

                        </div>
                        <div class="col-1 align-self-center text-center">
                            <button class="btn btn-sm btn-dark"><i class="bx bx-plus"></i></button>
                        </div>
                    </div>

                </div>

                <div>
                    <h6>Pemantauan</h6>
                    <div class="row mb-3">
                        <div class="col-3">
                            <label for="defaultFormControlInput" class="form-label">Jenis Pemantauan</label>
                            <input type="text" class="form-control" id="jenis_pemantauan" name="jenis_pemantauan" placeholder="" aria-describedby="defaultFormControlHelp" value="" />
                        </div>
                        <div class="col-3">
                            <label for="defaultFormControlInput" class="form-label">ukuran</label>
                            <input type="text" class="form-control" id="ukuran" name="ukuran" placeholder="" aria-describedby="defaultFormControlHelp" value="" />
                        </div>
                        <div class="col-2">
                            <label for="defaultFormControlInput" class="form-label">satuan</label>
                            <select class="form-control" id="satuan" name="satuan" onchange="getPatient()">
                                <option value="" selected>Pilih</option>
                                <option value="">ml</option>
                                <option value="">%</option>
                                <option value="">mmHg</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <label for="defaultFormControlInput" class="form-label">nilai</label>
                            <input type="text" class="form-control" id="nilai" name="nilai" placeholder="" aria-describedby="defaultFormControlHelp" value="" />
                        </div>
                        <div class="col-1 align-self-center text-center">
                            <button class="btn btn-sm btn-dark"><i class="bx bx-plus"></i></button>
                        </div>
                    </div>
                </div>

            <div class="mb-5 col">
                <div class="row">
                    <p class="m-0 col-2">Lama Pembiusan</p>
                    <div class="col">
                        <div class="gap-3 d-flex align-items-center">
                            <div class="gap-2 d-flex align-items-center">
                                <input type="text" class="form-control form-control-sm" style="max-width: 100px">
                                <label class="m-0 form-label">jam</label>
                            </div>
                            <div class="gap-2 d-flex align-items-center">
                                <input type="text" class="form-control form-control-sm" style="max-width: 100px">
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
                                <input type="text" class="form-control form-control-sm" style="max-width: 100px">
                                <label class="m-0 form-label">jam</label>
                            </div>
                            <div class="gap-2 d-flex align-items-center">
                                <input type="text" class="form-control form-control-sm" style="max-width: 100px">
                                <label class="m-0 form-label">menit</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <p>Keterangan / Catatan Intra Anestesi</p>
                <textarea id="editor" class="form-control" rows="3"></textarea>
            </div>


            {{-- END TAMBAHAN BARU LAPORAN ANESTESI --}}












                <div class="mt-5 mb-3 text-end  ">
                    <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                </div>


            </div>
        </form>
    </div>
@endsection
