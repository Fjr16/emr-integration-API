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
            <h5 class="mb-0">Asesmen Monitoring Status Fungsional (<span>BARTHEL INDEX</span>)
            </h5>
        </div>
        <form action="" method="POST" onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
            @csrf
            <div class="card-body table-responsive">
                <table class="table mb-3 table-bordered text-nowrap">
                    <thead class="align-middle">
                        <tr>
                            <th class="text-body" rowspan="5">No</th>
                            <th class="text-center text-body" rowspan="5">Kriteria <span>Barthel Index</span></th>
                            <th class="text-body" rowspan="5">Dengan bantuan</th>
                            <th class="text-body" rowspan="5">Mandiri</th>
                        </tr>
                        <tr>
                            <th class="text-center text-body" colspan="13">Nilai Skor</th>
                        </tr>
                        <tr>
                            <th class="text-center text-body" colspan="12">Selama Perawatan (Tanggal)</th>
                            <th class="text-body" rowspan="3">Saat Pulang</th>
                        </tr>

                        <tr>
                            <td> <input class="form-control" type="date" name="" /></td>
                            <td> <input class="form-control" type="date" name="" /></td>
                            <td> <input class="form-control" type="date" name="" /></td>
                            <td> <input class="form-control" type="date" name="" /></td>
                            <td> <input class="form-control" type="date" name="" /></td>
                            <td> <input class="form-control" type="date" name="" /></td>
                            <td> <input class="form-control" type="date" name="" /></td>
                            <td> <input class="form-control" type="date" name="" /></td>
                            <td> <input class="form-control" type="date" name="" /></td>
                            <td> <input class="form-control" type="date" name="" /></td>
                            <td> <input class="form-control" type="date" name="" /></td>
                            <td> <input class="form-control" type="date" name="" /></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">1</td>
                            <td>Makan</td>
                            <td class="text-center">5</td>
                            <td class="text-center">10</td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                        </tr>
                        <tr>
                            <td class="text-center">2</td>
                            <td>Toilet (Aktivitas BAB & BAK)</td>
                            <td class="text-center">5</td>
                            <td class="text-center">10</td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                        </tr>
                        <tr>
                            <td class="text-center">3</td>
                            <td>Berpindah dari kursi roda ke tempat tidur/sebaliknya</td>
                            <td class="text-center">5 - 10</td>
                            <td class="text-center">15</td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                        </tr>
                        <tr>
                            <td class="text-center">4</td>
                            <td>Kebersihan diri, mencuci muka, menyisir rambut,
                                menggosok gigi
                            </td>
                            <td class="text-center">0</td>
                            <td class="text-center">5</td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                        </tr>
                        <tr>
                            <td class="text-center">5</td>
                            <td>Mandi</td>
                            <td class="text-center">0</td>
                            <td class="text-center">5</td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                        </tr>
                        <tr>
                            <td class="text-center">6</td>
                            <td>Berjalan di permukaan datar</td>
                            <td class="text-center">5 - 10</td>
                            <td class="text-center">15</td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                        </tr>
                        <tr>
                            <td class="text-center">7</td>
                            <td>Naik turun tangga</td>
                            <td class="text-center">5</td>
                            <td class="text-center">10</td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                        </tr>
                        <tr>
                            <td class="text-center">8</td>
                            <td>Berpakaian</td>
                            <td class="text-center">5</td>
                            <td class="text-center">10</td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                        </tr>
                        <tr>
                            <td class="text-center">9</td>
                            <td>Mengontrol defekasi/BAB</td>
                            <td class="text-center">5</td>
                            <td class="text-center">10</td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                        </tr>
                        <tr>
                            <td class="text-center">10</td>
                            <td>Mengontrol berkemih/BAK</td>
                            <td class="text-center">5</td>
                            <td class="text-center">10</td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4">
                                Total Skor
                            </td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                Kategori Skor
                            </td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                            <td> <input class="form-control" type="number" name="" /></td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                Inisial nama perawat yang mengkaji
                            </td>
                            <td> <input class="form-control" type="text" name="" /></td>
                            <td> <input class="form-control" type="text" name="" /></td>
                            <td> <input class="form-control" type="text" name="" /></td>
                            <td> <input class="form-control" type="text" name="" /></td>
                            <td> <input class="form-control" type="text" name="" /></td>
                            <td> <input class="form-control" type="text" name="" /></td>
                            <td> <input class="form-control" type="text" name="" /></td>
                            <td> <input class="form-control" type="text" name="" /></td>
                            <td> <input class="form-control" type="text" name="" /></td>
                            <td> <input class="form-control" type="text" name="" /></td>
                            <td> <input class="form-control" type="text" name="" /></td>
                            <td> <input class="form-control" type="text" name="" /></td>
                            <td> <input class="form-control" type="text" name="" /></td>
                        </tr>
                    </tfoot>
                </table>
                <div class="row">
                    <div class="col-6">
                        <p class="m-0">Catatan :</p>
                        <ul style="list-style: decimal">
                            <li>Asesmen Monitoring status fungsional dilaksanakan setiap hari (Shift Pagi /
                                SP) dan
                                situasional pada saat :
                                <span>
                                    <ol style=" list-style-type:disc">
                                        <li>Awal Masuk (A)</li>
                                        <li>Perubahan Kondisi (PK)</li>
                                    </ol>

                                </span>
                            </li>
                            <li class="m-0">Total Skor ≥ 6 direkomendasikan dengan DPJP untuk konsul ke Rehabilitasi
                                Medik
                            </li>
                        </ul>
                    </div>
                    <div class="col">
                        <table>
                            <tr>
                                <th colspan="3">Kategori Skor</th>
                            </tr>
                            <tr>
                                <td>Mandiri</td>
                                <td>(M)</td>
                                <td>100</td>
                            </tr>
                            <tr>
                                <td>Ketergantungan Ringan</td>
                                <td>(KR)</td>
                                <td>91-99</td>
                            </tr>
                            <tr>
                                <td>Ketergantungan Sedang</td>
                                <td>(KS)</td>
                                <td>62-90</td>
                            </tr>
                            <tr>
                                <td>Ketergantungan Berat</td>
                                <td>(KB)</td>
                                <td>21-61</td>
                            </tr>
                            <tr>
                                <td>Ketergantungan Total</td>
                                <td>(KT)</td>
                                <td>0-20</td>
                            </tr>
                            <tr>
                                <td colspan="3">(Bila Ketergantungan Total, kolaborasi dengan DPJP)</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
