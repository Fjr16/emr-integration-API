@extends('layouts.backend.main')

@section('content') 
    @if (session()->has('success'))
        <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="card p-3 mt-5">
        <h5 class="m-0 my-2 text-uppercase fs-6 fw-bold">
            surgical safety checklist
        </h5>
        <div class="content">
            <form action="">

                <table class="w-50">
                    <tr>
                        <td>Tanggal</td>
                        <td>:</td>
                        <td>
                        <input type="text" class="form-control form-control-sm" />
                        </td>
                    </tr>

                    <tr>
                        <td>Nama Operator</td>
                        <td>:</td>
                        <td>
                        <input type="text" class="form-control form-control-sm" />
                        </td>
                    </tr>

                    <tr>
                        <td>Nama Tindakan</td>
                        <td>:</td>
                        <td>
                        <input type="text" class="form-control form-control-sm" />
                        </td>
                    </tr>

                    <tr>
                        <td>Diagnosa</td>
                        <td>:</td>
                        <td>
                        <input type="text" class="form-control form-control-sm" />
                        </td>
                    </tr>


                </table> 

                <table class="table-bordered w-100 mb-3 mt-2">
                    <tr>
                        <td class="p-2">
                        <p class="fw-bold d-flex align-items-center">SIGN IN (pukul : <span class="mx-2"><input type="text"
                                class="form-control form-control-sm"></span> )</p>
                        <p style="font-size: 13px; margin-top: -15px; max-width: 70%;">(Dilakukan sebelum induksi anastesi di
                            ruang persiapan / ruang. prosedur minimalnya oleh perawat & dokter anestesi</p>
                        </td>

                        <td class="w-25">
                        </td>
                    </tr>

                    <!-- 1 -->
                    <tr style="border-bottom: transparent; " class="">
                        <td class="px-2">
                        <p>1.pasien telah dikonfirmasikan</p>
                        </td>
                        <td>
                        <div class="row   text-capitalize" style="margin: 0px 0 0;">
                            <div class="col">sudah</div>
                            <div class="col">belum</div>
                            <div class="col">N/A</div>
                        </div>
                        </td>
                    </tr>

                    <!-- in 1 -->
                    <tr style="border-block: transparent;">
                        <td class="px-2">
                        <ul type="disc" class="text-capitalize">
                            <li>identifikasi dan gelang pasien</li>
                            <li>lokasi operasi</li>
                            <li>prosedur operasi</li>
                            <li>informed consent</li>
                            <li>foto hasil pemeriksaan radiologi</li>
                            <li>persiapan produk darah</li>
                        </ul>
                        </td>



                        <td>
                        <!-- checkbox for identifikasi dan gelang pasien-->
                        <div class="row m-0 text-center ">
                            <div class="col"><input type="checkbox" class="form-check-input "></div>
                            <div class="col"><input type="checkbox" class="form-check-input"></div>
                            <div class="col"></div>
                        </div>

                        <!-- checkbox for  lokasi operasi-->
                        <div class="row m-0 text-center">
                            <div class="col"><input type="checkbox" class="form-check-input "></div>
                            <div class="col"><input type="checkbox" class="form-check-input"></div>
                            <div class="col"><input type="checkbox" class="form-check-input"></div>
                        </div>


                        <!-- checkbox for  prosedur operasi-->
                        <div class="row m-0 text-center">
                            <div class="col"><input type="checkbox" class="form-check-input "></div>
                            <div class="col"><input type="checkbox" class="form-check-input"></div>
                            <div class="col"></div>
                        </div>


                        <!-- checkbox for  informed consent-->
                        <div class="row m-0 text-center">
                            <div class="col"><input type="checkbox" class="form-check-input "></div>
                            <div class="col"><input type="checkbox" class="form-check-input"></div>
                            <div class="col"></div>
                        </div>

                        <!-- checkbox for  foto hasil pemeriksaan radiologi-->
                        <div class="row m-0 text-center">
                            <div class="col"><input type="checkbox" class="form-check-input "></div>
                            <div class="col"><input type="checkbox" class="form-check-input"></div>
                            <div class="col"><input type="checkbox" class="form-check-input"></div>
                        </div>


                        <!-- checkbox for  persiapan produk darah-->
                        <div class="row m-0 text-center">
                            <div class="col"><input type="checkbox" class="form-check-input "></div>
                            <div class="col"><input type="checkbox" class="form-check-input"></div>
                            <div class="col"><input type="checkbox" class="form-check-input"></div>
                        </div>


                        </td>
                    </tr>


                    <!-- 2 -->
                    <tr style="border-block: transparent; " class="">
                        <td class="px-2">
                        <p>2. lokasi operasi sudah diberi tanda oleh anggota tim</p>
                        </td>
                        <td>
                        <div class="row   text-capitalize">
                            <div class="row m-0 text-center ">
                            <div class="col"><input type="checkbox" class="form-check-input "></div>
                            <div class="col"><input type="checkbox" class="form-check-input"></div>
                            <div class="col"><input type="checkbox" class="form-check-input"></div>

                            </div>
                        </div>
                        </td>
                    </tr>


                    <!-- 3 -->
                    <tr style="border-block: transparent; " class="">
                        <td class="px-2">
                        <p>3. masin dan obat-obatan anestesi sudah di cek lengkap</p>
                        </td>
                        <td>
                        <div class="row   text-capitalize">
                            <div class="row m-0 text-center ">
                            <div class="col"><input type="checkbox" class="form-check-input "></div>
                            <div class="col"><input type="checkbox" class="form-check-input"></div>
                            <div class="col"></div>

                            </div>
                        </div>
                        </td>
                    </tr>


                    <!-- 4 -->
                    <tr style="border-block: transparent; " class="">
                        <td class="px-2">
                        <p>4.pulse oximeter sudah terpasang dan berfungsi</p>
                        </td>
                        <td>
                        <div class="row   text-capitalize">
                            <div class="row m-0 text-center ">
                            <div class="col"><input type="checkbox" class="form-check-input "></div>
                            <div class="col"><input type="checkbox" class="form-check-input"></div>
                            <div class="col"></div>

                            </div>
                        </div>
                        </td>
                    </tr>



                    <!-- kosong-->
                    <tr style="border-block: transparent; " class="">
                        <td class="px-2">

                        </td>
                        <td>
                        <div class="row   text-capitalize">
                            <div class="row m-0 text-center ">
                            <div class="col">Ya</div>
                            <div class="col">Tidak</div>
                            <div class="col">N/A</div>

                            </div>
                        </div>
                        </td>
                    </tr>



                    <!-- 5 -->
                    <tr style="border-block: transparent; " class="">
                        <td class="px-2">
                        <p>5. Apakah Pasien memiliki riwayat asma?</p>
                        </td>
                        <td>
                        <div class="row   text-capitalize">
                            <div class="row m-0 text-center ">
                            <div class="col"><input type="checkbox" class="form-check-input "></div>
                            <div class="col"><input type="checkbox" class="form-check-input"></div>
                            <div class="col"></div>

                            </div>
                        </div>
                        </td>
                    </tr>



                    <!-- 6 -->
                    <tr style="border-block: transparent; " class="">
                        <td class="px-2">
                        <p>6. Apakah pasien punya riwayat alergi?</p>
                        </td>
                        <td>
                        <div class="row   text-capitalize">
                            <div class="row m-0 text-center ">
                            <div class="col"><input type="checkbox" class="form-check-input "></div>
                            <div class="col"><input type="checkbox" class="form-check-input"></div>
                            <div class="col"></div>

                            </div>
                        </div>
                        </td>
                    </tr>



                    <!-- 7 -->
                    <tr style="border-block: transparent; " class="">
                        <td class="px-2">
                        <p>7. Kesulitan bernafas/risiko aspirasi? dan menggunakan peralatan/bantuan?</p>
                        </td>
                        <td>
                        <div class="row   text-capitalize">
                            <div class="row m-0 text-center ">
                            <div class="col"><input type="checkbox" class="form-check-input "></div>
                            <div class="col"><input type="checkbox" class="form-check-input"></div>
                            <div class="col"></div>

                            </div>
                        </div>
                        </td>
                    </tr>


                    <!-- 8 -->
                    <tr style="border-block: transparent; " class="">
                        <td class="px-2">
                        <p>8. Risiko kehilagan darah >500 ml (7 ml/Kg BB pada anak)?</p>
                        </td>
                        <td>
                        <div class="row   text-capitalize">
                            <div class="row m-0 text-center ">
                            <div class="col"><input type="checkbox" class="form-check-input "></div>
                            <div class="col"><input type="checkbox" class="form-check-input"></div>
                            <div class="col"></div>

                            </div>
                        </div>
                        </td>
                    </tr>


                    <!-- 9 -->
                    <tr style="border-block: transparent; " class="">
                        <td class="px-2">
                        <p>9. Dua akses intravena/akses sentral dan rencana terapi cairan?</p>
                        </td>
                        <td>
                        <div class="row   text-capitalize">
                            <div class="row m-0 text-center ">
                            <div class="col"><input type="checkbox" class="form-check-input "></div>
                            <div class="col"><input type="checkbox" class="form-check-input"></div>
                            <div class="col"><input type="checkbox" class="form-check-input"></div>
                            </div>
                        </div>
                        </td>
                    </tr>


                    <!-- 10 -->
                    <tr style="border-top: transparent; " class="">
                        <td class="px-2">
                        <p>10. Rencana Pemasangan Implant</p>
                        </td>
                        <td>
                        <div class="row   text-capitalize">
                            <div class="row m-0 text-center ">
                            <div class="col"><input type="checkbox" class="form-check-input "></div>
                            <div class="col"><input type="checkbox" class="form-check-input"></div>
                            <div class="col"></div>
                            </div>
                        </div>
                        </td>
                    </tr>



                    <!--   <tr style="border-top: transparent; ">
                        <td class="text-center">
                        <p>Nama Dan Tanda Tangan</p>
                        </td>
                        <td></td>
                    </tr> -->




                </table>


                <table class="table-bordered w-100 mt-2 ">

                    <!-- header no 2 time out -->
                    <tr>
                        <td class="p-2">
                        <p class="fw-bold d-flex align-items-center">TIME OUT (pukul : <span class="mx-2"><input type="text"
                                class="form-control form-control-sm"></span> )</p>
                        <p style="font-size: 13px; margin-top: -15px; max-width: 70%;">(Dilakukan sebelum insisi kulit di ruang
                            prosedur, dipandu oleh perawat sirkuler dan diikuti oleh perawat, dokter anestesi, dan operator)</p>
                        </td>

                        <td class="w-25">
                        </td>
                    </tr>



                    <!-- kosong -->
                    <tr style="border-bottom: transparent; " class="">
                        <td class="px-2">
                        </td>
                        <td>
                        <div class="row  text-center text-capitalize m-0">
                            <div class="col">sudah</div>
                            <div class="col">belum</div>
                        </div>
                        </td>
                    </tr>



                    <!-- 1 -->
                    <tr style="border-block: transparent; " class="">
                        <td class="px-2">
                        <p>1. Konfirmasi seluruh anggota tim memperkenalkan nama perannya masing masing</p>
                        </td>
                        <td>
                        <div class="row  text-center text-capitalize m-0 ">
                            <div class="col"><input type="checkbox" class="form-check-input "></div>
                            <div class="col"><input type="checkbox" class="form-check-input"></div>
                        </div>
                        </td>
                    </tr>


                    <!-- 2 -->
                    <tr style="border-block: transparent; " class="">
                        <td class="px-2">
                        <p>2. Dokter bedah, dokter anestesi dan perawat melakukan konfirmasi secara verbal</p>
                        </td>
                        <td>
                        <div class="row   text-capitalize" style="margin: 0px 0 0;">
                            <div class="col"></div>
                            <div class="col"></div>
                            <div class="col"></div>
                        </div>
                        </td>
                    </tr>

                    <!-- in 2 -->
                    <tr style="border-block: transparent;">
                        <td class="px-2">
                        <ul type="disc" class="text-capitalize">
                            <li>Nama Pasien</li>
                            <li>Prosedur</li>
                            <li>Lokasi dimana insisi akan dibuat</li>
                        </ul>
                        </td>



                        <td>
                        <!-- checkbox for identifikasi dan gelang pasien-->
                        <div class="row m-0 text-center ">
                            <div class="col"><input type="checkbox" class="form-check-input "></div>
                            <div class="col"><input type="checkbox" class="form-check-input"></div>
                        </div>

                        <!-- checkbox for  lokasi operasi-->
                        <div class="row m-0 text-center">
                            <div class="col"><input type="checkbox" class="form-check-input "></div>
                            <div class="col"><input type="checkbox" class="form-check-input"></div>

                        </div>


                        <!-- checkbox for  prosedur operasi-->
                        <div class="row m-0 text-center">
                            <div class="col"><input type="checkbox" class="form-check-input "></div>
                            <div class="col"><input type="checkbox" class="form-check-input"></div>

                        </div>

                        </td>
                    </tr>

                    <!-- 3 -->
                    <tr style="border-block: transparent; " class="">
                        <td class="px-2">
                        <p>3. antibiotik profilaksis sudah diberikan ?</p>
                        </td>
                        <td>
                        <div class="row  text-center  text-capitalize m-0">
                            <div class="col">sudah</div>
                            <div class="col">belum</div>
                        </div>
                        </td>
                    </tr>

                    <!-- in 3 -->
                    <tr style="border-block: transparent;">
                        <td class="px-2">
                        <ul type="disc" class="text-capitalize">
                            <li class="d-flex">Nama : <span class="mx-2"><input type="text"
                                class="form-control form-control-sm"></span></li>
                            <li class="d-flex">Dosis : <span class="mx-2"><input type="text"
                                class="form-control form-control-sm"></span></li>
                        </ul>
                        </td>



                        <td>


                        <!-- checkbox for  antibotik diberikan-->
                        <div class="row m-0 text-center">
                            <div class="col"><input type="checkbox" class="form-check-input "></div>
                            <div class="col"><input type="checkbox" class="form-check-input"></div>

                        </div>




                        </td>
                    </tr>

                    <!-- 4 -->
                    <tr style="border-block: transparent; " class="">
                        <td class="px-2">
                        <p>4. Antisipasi Kejadian Kritis: </p>
                        </td>
                        <td>
                        </td>
                    </tr>

                    <!-- in 4 -->
                    <tr style="border-block: transparent;">



                        <td class="px-2">
                        <ol type="a" class="text-capitalize">
                            <li class="">Review dokter bedah: langkah apa yang dilakukan bila kondisi kritis atau kejadian yang
                            tidak diharapkan, pemanjangan lamanya operasi, antisipasi kehilangan darah ? : <span
                                class="mx-2"><input type="text" class="form-control form-control-sm"></span></li>
                            <li class="">

                            <div>
                                Review tim anestesi: apakah ada hal khusus yang perlu diperhatikan pada pasien. <span
                                class="mx-2"><input type="text" class="form-control form-control-sm"></span>
                            </li>
                            <div style="margin: -10px 0 0 ;">
                            Jika diperlukan CVC, kapan akan dipasang? <span class="mx-2"><input type="text"
                                class="form-control form-control-sm"></span></li>
                            </div>

                            <li>
                            <ul type="disc">
                                <li>Review tim Perawat: apakah peralatan sudah steril?</li>
                                <li>Instrumen, kasa, dan jarum telah dihitung dengan benar</li>
                                <li>Adalah alat alat yang perlu diperhatikan khusus atau dalam masalah?</li>
                            </ul>
                            </li>
                        </ol>
                        </td>



                        <td>
                        <!-- checkbox for  antibotik diberikan ,  4-->
                        <div class="row m-0 text-center text-capitalize">
                            <div class="col">ada</div>
                            <div class="col">tidak</div>

                        </div>
                        <div class="row m-0 text-center">
                            <div class="col"><input type="checkbox" class="form-check-input "></div>
                            <div class="col"><input type="checkbox" class="form-check-input"></div>

                        </div>




                        <!-- checkbox for  c-->
                        <div class="row mt-5 text-center text-capitalize">
                            <div class="col"></div>

                        </div>
                        <div class="row m-0 text-center">
                            <div class="col"></div>

                        </div>


                        <!-- label checkbox for  c 1-->
                        <div class="row mt-5 pt-5 text-center text-capitalize">
                            <div class="col">Sudah</div>
                            <div class="col">belum</div>
                        </div>

                        <!-- chekbox for c 1 -->
                        <div class="row m-0 text-center">
                            <div class="col"><input type="checkbox" class="form-check-input "></div>
                            <div class="col"><input type="checkbox" class="form-check-input"></div>
                        </div>


                        <!-- label checkbox for  c 2-->
                        <div class="row text-center text-capitalize">
                            <div class="col">ada</div>
                            <div class="col">tidak</div>
                        </div>

                        <!-- chekbox for c 2 -->
                        <div class="row m-0 text-center">
                            <div class="col"><input type="checkbox" class="form-check-input "></div>
                            <div class="col"><input type="checkbox" class="form-check-input"></div>
                        </div>
                        <!-- chekbox for c 3 -->
                        <div class="row m-0 text-center">
                            <div class="col"><input type="checkbox" class="form-check-input "></div>
                            <div class="col"><input type="checkbox" class="form-check-input"></div>
                        </div>
                        </td>
                    </tr>


                    <!-- 5 -->
                    <tr style="border-top: transparent; " class="">
                        <td class="px-2">
                        <p>5. Apakah foto Rontgen/CT-Scan dan telah ditayangkan?</p>
                        </td>
                        <td>
                        <div class="row  text-center text-capitalize m-0 ">
                            <div class="col"><input type="checkbox" class="form-check-input "></div>
                            <div class="col"><input type="checkbox" class="form-check-input"></div>
                        </div>
                        </td>
                    </tr>



                    <!--  <tr style="border-top: transparent; ">
                        <td class="text-center">
                        <p>Nama Dan Tanda Tangan</p>
                        </td>
                        <td></td>
                    </tr> -->





                </table>

                <table class="table-bordered w-100 mt-2 ">

                    <!-- header no 2 time out -->
                    <tr>
                        <td class="p-2">
                        <p class="fw-bold d-flex align-items-center">SIGN OUT (pukul : <span class="mx-2"><input type="text"
                                class="form-control form-control-sm"></span> )</p>
                        <p style="font-size: 13px; margin-top: -15px; max-width: 70%;">(Dilakukan sebelum insisi kulit di ruang
                            prosedur, dipandu oleh perawat sirkuler dan diikuti oleh perawat, dokter anestesi, dan operator)</p>
                        </td>

                        <td class="w-25">
                        </td>
                    </tr>






                    <!-- 1 -->
                    <tr style="border-block: transparent; " class="">
                        <td class="px-2">
                        <p>1. Perawat melakukan konfirmasi secara verbal dengan tim</p>
                        </td>
                        <td>
                        <div class="row m-0 text-center text-capitalize">
                            <div class="col">sudah</div>
                            <div class="col">belum</div>
                        </div>
                        </td>
                    </tr>

                    <!-- in 1 -->
                    <tr style="border-block: transparent;">
                        <td class="px-2 text-start">
                        <ol type="a" class="text-capitalize">
                            <li>Nama prosedur tindakan telah dicatat</li>
                            <li>Instrumen, kasa, dan jarum telah dihitung dengan benar</li>
                            <li>Spesimen telah diberikan label (termasuk nama pasien asl jaringan spesimen)</li>
                            <li class="mt-5">Adakah masalah dengan peralatan selama operasi.</li>
                        </ol>
                        </td>



                        <td>
                        <!-- checkbox for Nama prosedur tindakan telah dicatat-->
                        <div class="row m-0 text-center ">
                            <div class="col"><input type="checkbox" class="form-check-input "></div>
                            <div class="col"><input type="checkbox" class="form-check-input"></div>
                        </div>

                        <!-- checkbox for  nstrumen, kasa, dan jarum-->
                        <div class="row m-0 text-center">
                            <div class="col"><input type="checkbox" class="form-check-input "></div>
                            <div class="col"><input type="checkbox" class="form-check-input"></div>

                        </div>


                        <!-- checkbox for  Spesimen telah diberikan label-->
                        <div class="row m-0 text-center">
                            <div class="col"><input type="checkbox" class="form-check-input "></div>
                            <div class="col"><input type="checkbox" class="form-check-input"></div>
                        </div>



                        <div class="row m-0 mt-2 text-center">
                            <div class="col">Ya</div>
                            <div class="col">Tidak</div>
                        </div>



                        <!-- checkbox for  Adakah masalah dengan peralatan selama -->
                        <div class="row m-0 mt-1  text-center">
                            <div class="col"><input type="checkbox" class="form-check-input "></div>
                            <div class="col"><input type="checkbox" class="form-check-input"></div>
                        </div>

                        </td>
                    </tr>



                    <tr style="border-top: transparent; " class="">
                        <td class="px-2">
                        <p class="d-flex flex-column">
                            <span>
                            2.
                            Operator / dokter bedah, dokter anestesi,, dan perawat melakukan review / masalah utama apa yang harus
                            diperhatikan untuk penyembuhan dan manajemen pasien selanjutnya.
                            </span>
                            <strong class="mt-2">Hal yang harus diperhatikan :</strong>
                            <span class="">
                            <div class="form-floating">
                                <textarea class="form-control" style="height: 30px"></textarea>
                            </div>
                            </span>
                        </p>
                        </td>



                        <td>
                        </td>
                    </tr>



                    <!-- <tr style="border-block: transparent; ">
                        <td class="text-center">
                        <p>Nama Dan Tanda Tangan</p>
                        </td>
                        <td></td>
                    </tr> -->


                    <tr  style="border-top:transparent">
                        <td>

                        <div>
                            <p class="px-2  fw-bold">Catatan</p>
                            <p class="px-2 my-0">- <span class="fst-italic">N/A</span> (Not Applicable): Tidak diindikasikan</p>
                            <p class="px-2 ">- jam verifikasi diisi sesuai waktu tanda tangan oleh operator, dokter anestesi , dan perawat sirkuler</p>
                        </div>
                        </td>

                        <td></td>
                    </tr>


                </table>
            </form>
        </div>
    </div>
@endsection
