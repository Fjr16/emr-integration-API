@extends('layouts.backend.main')

@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Early Warning System (EWS) Anak - Anak</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <table class="table table-bordered" style="font-size: 8pt;">
                        <thead>
                            <tr>
                                <th class="text-body text-center" colspan="5">NEWSS PADA ANAK</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center">0</td>
                                <td class="text-center">1</td>
                                <td class="text-center">2</td>
                                <td class="text-center">3</td>
                            </tr>
                            <tr>
                                <td>Perilaku</td>
                                <td>Sesuai</td>
                                <td>Cenderung Murung / Diam</td>
                                <td>Sensitif</td>
                                <td>Letargik / Bingung / Penurunan Respon Terhadap Nyeri</td>
                            </tr>
                            <tr>
                                <td>Kardiovaskular</td>
                                <td>Pink atau CRT 1-2 Detik</td>
                                <td>Pucat atau CRT 3 Detik Tekanan Darah Sistolik 10 mmHg diatas atau dibawah nilai norma</td>
                                <td>Abu abu / biru CRT 4 detik Takikardia : Nadi lebih tinggi/rendah 10 kali / menit</td>
                                <td>Abu - abu / biru, mottled atau
                                    CRT ≥ 5 atau takikardia, nadi
                                    lebih tinggi atau lebih rendah
                                    30 kali / menit</td>
                            </tr>
                            <tr>
                                <td>Respirasi</td>
                                <td>Normal tidak ada retraksi</td>
                                <td>RR > 10 diatas normal menggunakan
                                    otot-otot aksesoris pernafasan</td>
                                <td>RR > 20 diatas normal, terdapat
                                    retraksi dinding dada
                                    </td>
                                <td>RR : 5 Di bawah normal dengan
                                    retraksi atau grunting
                                    (mendengkur)
                                    </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered w-100 text-dark mt-3" style="font-size: 8pt;">
                        <thead>
                            <tr>
                                <th class="text-dark text-center " colspan="8">NILAI NORMAL SESUAI USIA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Usia</td>
                                <td>Frekuensi Nadi (x/menit)</td>
                                <td>Tekanan Darah Sistolik (mmHg)</td>
                                <td>Frekuensi Nafas (x/menit)</td>
                            </tr>
                            <tr>
                                <td>0-3 bulan</td>
                                <td>100-180</td>
                                <td>50</td>
                                <td>50</td>
                            </tr>
                            <tr>
                                <td>4-12 bulan</td>
                                <td>100-180</td>
                                <td>60</td>
                                <td>60</td>
                            </tr>
                            <tr>
                                <td>1-4 tahun</td>
                                <td>90-160</td>
                                <td>70</td>
                                <td>40</td>
                            </tr>
                            <tr>
                                <td>5-12 tahun</td>
                                <td>80-140</td>
                                <td>80</td>
                                <td>30</td>
                            </tr>
                            <tr>
                                <td>>12 tahun</td>
                                <td>60-130</td>
                                <td>90</td>
                                <td>30</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-6">
                    <table class="table table-bordered text-center mb-3">
                        <thead>
                            <tr>
                                <th class="text-dark bg-success">HIJAU</th>
                                <th class="text-dark bg-warning">KUNING</th>
                                <th class="text-dark" style="background-color: rgb(219, 143, 0)">ORANGE</th>
                                <th class="text-dark bg-danger">MERAH</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-dark bg-success">0-2</td>
                                <td class="text-dark bg-warning">3</td>
                                <td class="text-dark " style="background-color: rgb(219, 143, 0)">4</td>
                                <td class="text-dark bg-danger">≥5</td>
                            </tr>
                        </tbody>
                    </table>
                    <form method="POST" action="{{ route('ews/anak.store', $item->id) }}">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="basic-default-name">Tanggal</label>
                            <div class="col-sm-9">
                                <input type="date" name="tanggal" class="form-control" id="basic-default-name"
                                    @required(true)>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="basic-default-name">Waktu</label>
                            <div class="col-sm-9">
                                <input type="time" name="jam" class="form-control" id="basic-default-name"
                                    @required(true)>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="basic-default-name">Perilaku</label>
                            <div class="col-sm-9">
                                <select name="perilaku" id="perilaku" class="form-control form-select" @required(true) onchange="hitungTotal()">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                                {{-- <input type="number" name="perilaku" value="0" class="form-control" id="basic-default-name" onchange="hitungTotal()"
                                    @required(true)> --}}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="basic-default-name">Kardiovaskular</label>
                            <div class="col-sm-9">
                                <select name="kardiovaskular" id="kardiovaskular" class="form-control form-select" @required(true) onchange="hitungTotal()">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="basic-default-name">Respirasi</label>
                            <div class="col-sm-9">
                                <select name="respirasi" id="respirasi" class="form-control form-select" @required(true) onchange="hitungTotal()">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="basic-default-name">Jumlah Skor</label>
                            <div class="col-sm-9">
                                <input type="number" name="total_skor" id="total_skor" class="form-control" id="basic-default-name"
                                    readonly>
                            </div>
                            <div class="text-end">
                                <button class="btn btn-success btn-sm">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
@endsection

<script>
    function hitungTotal(){
        var perilaku = document.getElementById('perilaku');
        var kardio = document.getElementById('kardiovaskular');
        var respirasi = document.getElementById('respirasi');
        
        var totalSkor = parseInt(perilaku.value) + parseInt(kardio.value) + parseInt(respirasi.value);
        var total = document.getElementById('total_skor');
        total.value = totalSkor;
    }
</script>
