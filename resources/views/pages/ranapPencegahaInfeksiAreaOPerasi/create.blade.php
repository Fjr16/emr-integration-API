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
            <h4 class="align-self-center m-0">PENERAPAN BUNDLES PENCEGAHAN INFEKSI RUMAH SAKIT (HAIs)
                INFEKSI DAERAH OPERASI (IDO)
            </h4>
            {{-- <div class="ms-auto">
                <a href="{{ route('farmasi/obat/konversi.create') }}" class="btn btn-success btn-sm m-0">+ Tambah Konversi</a>
                <a href="{{ route('farmasi/obat/master/konversi.create') }}" class="btn btn-success btn-sm m-0 mx-2">+ Tambah
                    Satuan</a>
            </div> --}}
        </div>
        <hr class="m-0 mt-2 mb-3">
        <form action="" method="POST" onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
            @csrf
            <div class="card-body table-responsive">





                <div class="row mb-2 justify-items-stretch">
                    <div class="col-4">
                        <div class="row">
                            <div class="col-4">Bulan</div>
                            <div class="col-6"> <input class="form-control form-control-sm" type="text"
                                    value="" /></div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="row ">
                            <div class="col-4">Ruangan/ Instalasi/ Satuan Kerja</div>
                            <div class="col-6"> <input class="form-control form-control-sm" type="text"
                                    value="" /></div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="row">
                            <div class="col-4">Tanggal</div>
                            <div class="col-6"> <input class="form-control form-control-sm" type="text"
                                    value="" /></div>
                        </div>
                    </div>
                </div>


                <table class="w-100  mt-5 ">


                    <tr class="text-center">
                        <td class="pb-3" style="min-width: 50px"></td>
                        <td class="pb-3" style="min-width: 300px">Komponen</td>
                        <td class="pb-3" style="min-width: 100px">Ya</td>
                        <td class="pb-3" style="min-width: 100px">Tidak</td>
                        <td class="pb-3" style="min-width: 150px">Tidak Dapat Dinilai</td>
                        <td class="pb-3" style="min-width: 100px;">Keterangan</td>
                    </tr>


                    <tr class="bg-primary text-white fw-semibold">
                        <td class="text-center text-white py-2">1</td>
                        <td colspan="5" class="py-2">PRE OPERASI</td>
                    </tr>

                    <tr class="text-center">
                        <td>a</td>
                        <td class="text-start">Melakukan kebersihan tangan</td>
                        <td class="p-0"> <input class="form-check-input" type="checkbox" /></td>
                        <td class="p-0"> <input class="form-check-input" type="checkbox" /></td>
                        <td class="p-0"> <input class="form-check-input" type="checkbox" /></td>
                        <td class="p-1">
                            <textarea class="form-control form-control-sm" rows=""></textarea>
                        </td>
                    </tr>

                    <tr class="text-center">
                        <td>b</td>
                        <td class="text-start">Kadar gula darah < 200 mg/dl</td>
                        <td class="p-0"> <input class="form-check-input" type="checkbox" /></td>
                        <td class="p-0"> <input class="form-check-input" type="checkbox" /></td>
                        <td class="p-0"> <input class="form-check-input" type="checkbox" /></td>
                        <td class="p-1">
                            <textarea class="form-control form-control-sm" rows=""></textarea>
                        </td>
                    </tr>

                    <tr class="text-center">
                        <td>c</td>
                        <td class="text-start">Melakukan pencukuran jika
                            mengganggu jalannya operasi
                            dengan menggunakan pencukur
                            listrik ( cliper) jika tidak tersedia
                            cliper gunakan silet baru
                        </td>
                        <td class="p-0"> <input class="form-check-input" type="checkbox" /></td>
                        <td class="p-0"> <input class="form-check-input" type="checkbox" /></td>
                        <td class="p-0"> <input class="form-check-input" type="checkbox" /></td>
                        <td class="p-1">
                            <textarea class="form-control form-control-sm" rows=""></textarea>
                        </td>
                    </tr>

                    <tr class="text-center">
                        <td>d</td>
                        <td class="text-start">Mengukur suhu tubuh dalam
                            kondisi normal
                        </td>
                        <td class="p-0"> <input class="form-check-input" type="checkbox" /></td>
                        <td class="p-0"> <input class="form-check-input" type="checkbox" /></td>
                        <td class="p-0"> <input class="form-check-input" type="checkbox" /></td>

                        <td class="p-1">
                            <textarea class="form-control form-control-sm" rows=""></textarea>
                        </td>
                    </tr>


                    <tr class="text-center">
                        <td>e</td>
                        <td class="text-start">Mandi dengan menggunakan
                            sabun antimikroba atau nonantimikroba
                        </td>
                        <td class="p-0"> <input class="form-check-input" type="checkbox" /></td>
                        <td class="p-0"> <input class="form-check-input" type="checkbox" /></td>
                        <td class="p-0"> <input class="form-check-input" type="checkbox" /></td>

                        <td class="p-1">
                            <textarea class="form-control form-control-sm" rows=""></textarea>
                        </td>
                    </tr>

                    <tr class="text-center">
                        <td>f</td>
                        <td class="text-start">Antibiotik profilaksis harus di
                            berikan 1 jam sebelum insisi
                            untuk semua antimikroba
                            kecuali vankomisin dan
                            fluoroquinolone yang harus di
                            berikan 2 jam sebelum nya
                        </td>
                        <td class="p-0"> <input class="form-check-input" type="checkbox" /></td>
                        <td class="p-0"> <input class="form-check-input" type="checkbox" /></td>
                        <td class="p-0"> <input class="form-check-input" type="checkbox" /></td>

                        <td class="p-1">
                            <textarea class="form-control form-control-sm" rows=""></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td class="pb-3"></td>
                        <td class="pb-3">Inisial Perawat</td>
                        <td class="pb-3" colspan="4"><input type="text" class=" form-control form-control-sm">
                        </td>

                    </tr>



                    <tr class="bg-primary text-white fw-semibold">
                        <td class="text-center py-2">2</td>
                        <td colspan="5 pt-2">INTRA OPERAS</td>
                    </tr>

                    <tr class="text-center">
                        <td class="pt-3 ">a</td>
                        <td class="pt-3 text-start">Cuci tangan prabedah dengan
                            Klorhexidine 4 % (5 menit)</td>
                        <td class="pt-3 p-0"> <input class="form-check-input" type="checkbox" /></td>
                        <td class="pt-3 p-0"> <input class="form-check-input" type="checkbox" /></td>
                        <td class="pt-3 p-0"> <input class="form-check-input" type="checkbox" /></td>
                        <td class="pt-3 p-1">
                            <textarea class="form-control form-control-sm" rows=""></textarea>
                        </td>
                    </tr>

                    <tr class="text-center">
                        <td>b</td>
                        <td class="text-start">Mempertahankan tekanan positif dalam kamar bedah</td>
                        <td class="p-0"> <input class="form-check-input" type="checkbox" /></td>
                        <td class="p-0"> <input class="form-check-input" type="checkbox" /></td>
                        <td class="p-0"> <input class="form-check-input" type="checkbox" /></td>

                        <td class="p-1">
                            <textarea class="form-control form-control-sm" rows=""></textarea>
                        </td>
                    </tr>

                    <tr class="text-center">
                        <td>c</td>
                        <td class="text-start">Jumlah petugas maksimal 10
                            orang </td>
                        <td class="p-0"> <input class="form-check-input" type="checkbox" /></td>
                        <td class="p-0"> <input class="form-check-input" type="checkbox" /></td>
                        <td class="p-0"> <input class="form-check-input" type="checkbox" /></td>

                        <td class="p-1">
                            <textarea class="form-control form-control-sm" rows=""></textarea>
                        </td>
                    </tr>

                    <tr class="text-center">
                        <td>d</td>
                        <td class="text-start">Menjaga pintu kamar bedah
                            harus selalu tertutup, kecuali
                            bila di butuhkan untuk
                            lewatnya peralatan, petugas
                            dan pasien </td>
                        <td class="p-0"> <input class="form-check-input" type="checkbox" /></td>
                        <td class="p-0"> <input class="form-check-input" type="checkbox" /></td>
                        <td class="p-0"> <input class="form-check-input" type="checkbox" /></td>

                        <td class="p-1">
                            <textarea class="form-control form-control-sm" rows=""></textarea>
                        </td>
                    </tr>


                    <tr class="text-center">
                        <td>e</td>
                        <td class="text-start">Membersihkan dan
                            mendesinfeksi permukaan
                            lingkungan ruangan </td>
                        <td class="p-0"> <input class="form-check-input" type="checkbox" /></td>
                        <td class="p-0"> <input class="form-check-input" type="checkbox" /></td>
                        <td class="p-0"> <input class="form-check-input" type="checkbox" /></td>

                        <td class="p-1">
                            <textarea class="form-control form-control-sm" rows=""></textarea>
                        </td>
                    </tr>


                    <tr class="text-center">
                        <td>f</td>
                        <td class="text-start">Sterilisasi instrumen kamar bedah </td>
                        <td class="p-0"> <input class="form-check-input" type="checkbox" /></td>
                        <td class="p-0"> <input class="form-check-input" type="checkbox" /></td>
                        <td class="p-0"> <input class="form-check-input" type="checkbox" /></td>

                        <td class="p-1">
                            <textarea class="form-control form-control-sm" rows=""></textarea>
                        </td>
                    </tr>



                    <tr class="text-center">
                        <td>g</td>
                        <td class="text-start">Menggunakan apd yang benar</td>
                        <td class="p-0"> <input class="form-check-input" type="checkbox" /></td>
                        <td class="p-0"> <input class="form-check-input" type="checkbox" /></td>
                        <td class="p-0"> <input class="form-check-input" type="checkbox" /></td>

                        <td class="p-1">
                            <textarea class="form-control form-control-sm" rows=""></textarea>
                        </td>
                    </tr>



                    <tr class="text-center">
                        <td>h</td>
                        <td class="text-start">Mempertahankan teknik aseptik</td>
                        <td class="p-0"> <input class="form-check-input" type="checkbox" /></td>
                        <td class="p-0"> <input class="form-check-input" type="checkbox" /></td>
                        <td class="p-0"> <input class="form-check-input" type="checkbox" /></td>

                        <td class="p-1">
                            <textarea class="form-control form-control-sm" rows=""></textarea>
                        </td>
                    </tr>




                    <tr>
                        <td class="pb-3"></td>
                        <td class="pb-3">Inisial Perawat</td>
                        <td class="pb-3" colspan="4"><input type="text" class=" form-control form-control-sm">
                        </td>

                    </tr>



                    <tr class="bg-primary text-light fw-semibold">
                        <td class="py-3 text-white text-center">3</td>
                        <td colspan="27" class="py-3 text-white">
                            <p class="m-0">POST OPERAS</p>
                            <p class="m-0">Perawatan luka setelah operasi </p>
                        </td>
                    </tr>

                    <tr class="text-center">
                        <td class="pt-3">a</td>
                        <td class="pt-3 text-start">Menjaga luka yang sudah di
                            jahit dengan verban steril
                            selama 48 jam paska bedah
                        </td>
                        <td class="pt-3 p-0"> <input class="form-check-input" type="checkbox" /></td>
                        <td class="pt-3 p-0"> <input class="form-check-input" type="checkbox" /></td>
                        <td class="pt-3 p-0"> <input class="form-check-input" type="checkbox" /></td>
                        <td class="pt-3 p-1">
                            <textarea class="form-control form-control-sm" rows=""></textarea>
                        </td>
                    </tr>

                    <tr class="text-center">
                        <td>b</td>
                        <td class="text-start">Melakukan kebersihan tangan
                            sebelum dan sesudah
                            menggganti verban atau
                            bersentuhan dengan luka
                            operasi</td>
                        <td class="p-0"> <input class="form-check-input" type="checkbox" /></td>
                        <td class="p-0"> <input class="form-check-input" type="checkbox" /></td>
                        <td class="p-0"> <input class="form-check-input" type="checkbox" /></td>
                        <td class="p-1">
                            <textarea class="form-control form-control-sm" rows=""></textarea>
                        </td>
                    </tr>

                    <tr class="text-center">
                        <td>c</td>
                        <td class="text-start">Melakukan edukasi pada pasien
                            dan keluarga mengenai
                            perawatan luka operasi yang
                            benar, gejala IDO dan
                            pentingnya melaporkan gejala
                            tersebut</td>
                        <td class="p-0"> <input class="form-check-input" type="checkbox" /></td>
                        <td class="p-0"> <input class="form-check-input" type="checkbox" /></td>
                        <td class="p-0"> <input class="form-check-input" type="checkbox" /></td>

                        <td class="p-1">
                            <textarea class="form-control form-control-sm" rows=""></textarea>
                        </td>
                    </tr>
                    <tr class="text-center">
                        <td>d</td>
                        <td class="text-start">Merawat luka operasi dengan teknik aseptik</td>
                        <td class="p-0"> <input class="form-check-input" type="checkbox" /></td>
                        <td class="p-0"> <input class="form-check-input" type="checkbox" /></td>
                        <td class="p-0"> <input class="form-check-input" type="checkbox" /></td>
                        <td class="p-1">
                            <textarea class="form-control form-control-sm" rows=""></textarea>
                        </td>
                    </tr>


                    <tr>
                        <td></td>
                        <td>Inisial Perawat</td>
                        <td colspan="4"><input type="text" class=" form-control form-control-sm"></td>

                    </tr>

                </table>



















                <div class="mb-3 mt-5  text-end">
                    <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                </div>


            </div>
        </form>
    </div>
@endsection
