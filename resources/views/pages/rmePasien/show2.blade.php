@extends('layouts.backend.main')

@section('content')
    <div class="card">
        <div class="card-body">
            <h4>Data Pasien</h4>
            <div class="row mt-3">
                <div class="col-2">
                    <img class="img-fluid" src="{{ asset('assets/img/illustrations/profilerme.png') }}" alt="">
                </div>
                <div class="col-7">
                    <table>
                        <tbody>
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td>{{ $item->name ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>Tempat lahir</td>
                                <td>:</td>
                                <td>{{ $item->tempat_lhr ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Lahir</td>
                                <td>:</td>
                                <td>{{ $item->tanggal_lhr ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>:</td>
                                <td>{{ $item->jenis_kelamin ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>Status Kawin</td>
                                <td>:</td>
                                <td>{{ $item->status ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>No. Hp</td>
                                <td>:</td>
                                <td>{{ $item->telp ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td>{{ $item->district->name ?? '' }}, {{ $item->village->name ?? '' }},
                                    {{ $item->city->name }}, {{ $item->province->name }},{{ $item->alamat }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-3">
                    <div class="mx-auto border border-5 border-success w-75">
                        <div class="display-4 text-center py-2">
                            {{ $item->no_rm ?? '' }}</div>
                    </div>
                </div>
            </div>
            <hr>
            <h4>Rekam Medis Elektronik</h4>
            <div class="accordion" id="accordionExample">
                <div class="card accordion-item active">
                    <h2 class="accordion-header" id="headingOne">
                        <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                            data-bs-target="#accordionOne" aria-expanded="false" aria-controls="accordionOne"
                            role="tabpanel">
                            IGD
                        </button>
                    </h2>

                    <div id="accordionOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <table class="table" id="example">
                                <thead>
                                    <tr class="text-nowrap bg-dark">
                                        <th>No</th>
                                        <th>No. Antrian</th>
                                        <th>Tanggal Antrian</th>
                                        <th>Nama</th>
                                        <th>Category</th>
                                        <th>Status Antrian</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($igd as $igdItem)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $igdItem->queue->no_antrian ?? '' }}</td>
                                            <td>{{ $igdItem->queue->tgl_antrian ?? '' }}</td>
                                            <td>{{ $igdItem->queue->patient->name ?? '-' }}</td>
                                            <td>{{ $igdItem->queue->category ?? '' }}</td>
                                            <td>{{ $igdItem->queue->status_antrian ?? '' }}</td>
                                            <td><a href="{{ route('igd/patient/rme.show', $igdItem->id) }}"
                                                    class="btn btn-sm btn-success">Show</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                            data-bs-target="#accordionTwo" aria-expanded="false" aria-controls="accordionTwo"
                            role="tabpanel">
                            Rawat Jalan
                        </button>
                    </h2>
                    <div id="accordionTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <table class="table" id="example1">
                                <thead>
                                    <tr class="text-nowrap bg-dark">
                                        <th>No</th>
                                        <th>No. Antrian</th>
                                        <th>Tanggal Antrian</th>
                                        <th>Nama</th>
                                        <th>Category</th>
                                        <th>Status Antrian</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rajal as $dataRajal)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $dataRajal->queue->no_antrian ?? '' }}</td>
                                            <td>{{ $dataRajal->queue->tgl_antrian ?? '' }}</td>
                                            <td>{{ $dataRajal->queue->patient->name ?? '' }}</td>
                                            <td>{{ $dataRajal->queue->category ?? '' }}</td>
                                            <td>{{ $dataRajal->queue->status_antrian ?? '' }}</td>
                                            <td><a href="{{ route('rajal/show', [encrypt($dataRajal->queue->id), encrypt('RAWAT JALAN')]) }}"
                                                    class="btn btn-sm btn-success">Show</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- <div class="card accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                            data-bs-target="#accordionThree" aria-expanded="false" aria-controls="accordionThree"
                            role="tabpanel">
                            Rawat Inap
                        </button>
                    </h2>
                    <div id="accordionThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <table class="table" id="example2">
                                <thead>
                                    <tr class="text-nowrap bg-dark">
                                        <th>No</th>
                                        <th>No. Antrian</th>
                                        <th>Tanggal Antrian</th>
                                        <th>Nama</th>
                                        <th>Category</th>
                                        <th>Status Antrian</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ranap as $dataRanap)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $dataRanap->queue->no_antrian ?? '' }}</td>
                                            <td>{{ $dataRanap->queue->tgl_antrian ?? '' }}</td>
                                            <td>{{ $dataRanap->queue->patient->name ?? '' }}</td>
                                            <td>RAWAT INAP</td>
                                            <td>{{ $dataRanap->queue->status_antrian ?? '' }}</td>
                                            <td><a href="{{ route('rajal/show', [encrypt($dataRanap->queue->id), encrypt('RAWAT INAP')]) }}"
                                                    class="btn btn-sm btn-success">Show</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> --}}

                {{-- <div class="card accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                            data-bs-target="#accordionFour" aria-expanded="false" aria-controls="accordionFour"
                            role="tabpanel">
                            Kemoterapi
                        </button>
                    </h2>
                    <div id="accordionFour" class="accordion-collapse collapse" aria-labelledby="headingThree"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <table class="table" id="example">
                                <thead>
                                    <tr class="text-nowrap bg-dark">
                                        <th>No</th>
                                        <th>No. Antrian</th>
                                        <th>Tanggal Antrian</th>
                                        <th>Nama</th>
                                        <th>Category</th>
                                        <th>Status Antrian</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kemo as $dataKemo)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $dataKemo->queue->no_antrian ?? '' }}</td>
                                            <td>{{ $dataKemo->queue->tgl_antrian ?? '' }}</td>
                                            <td>{{ $dataKemo->queue->patient->name ?? '' }}</td>
                                            <td>RAWAT INAP</td>
                                            <td>{{ $dataKemo->queue->status_antrian ?? '' }}</td>
                                            <td><a href="{{ route('kemoterapi/patient.show', $dataKemo->queue->id) }}"
                                                    class="btn btn-sm btn-success">Show</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> --}}

            </div>




            {{-- V1 --}}
            {{-- <h4>Riwayat Diagnosa</h4>
            <div class="outer-wrapper">
                <div class="table-wrapper">
                    <ol>
                        <li class="border-bottom">
                            <div class="row m-0 p-0">
                                <div class="col-9">
                                    <h5 class="fw-bold mt-1">Kunjungan Tanggal 12 Januari 2023</h5>
                                    <h6 class="m-0">SUBJECTIVE :</h6>
                                    <ol>
                                        <li>sakit</li>
                                    </ol>
                                    <h6 class="m-0">OBJECTIVE :</h6>
                                    <ol>
                                        <li>sakit</li>
                                    </ol>
                                    <h6 class="m-0">ASSESMEN :</h6>
                                    <ol>
                                        <li>sakit</li>
                                    </ol>
                                    <h6 class="m-0">PLANNING :</h6>
                                    <ol>
                                        <li>sakit</li>
                                        <li>sakit</li>
                                        <li>sakit</li>
                                        <li>sakit</li>
                                        <li>sakit</li>
                                        <li>sakit</li>
                                        <li>sakit</li>
                                        <li>sakit</li>
                                        <li>sakit</li>
                                        <li>sakit</li>
                                    </ol>
                                </div>
                                <div class="col-3">
                                    <div class="text-center justify-content-bottom">
                                        <p>Dokter Penanggung Jawab</p>
                                        <br><br><br>
                                        <p class="fw-bold">Dr. Kholid Hasibuan</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="border-bottom">
                            <div class="row m-0 p-0">
                                <div class="col-9">
                                    <h5 class="fw-bold mt-1">Kunjungan Tanggal 12 Januari 2023</h5>
                                    <h6 class="m-0">SUBJECTIVE :</h6>
                                    <ol>
                                        <li>sakit</li>
                                    </ol>
                                    <h6 class="m-0">OBJECTIVE :</h6>
                                    <ol>
                                        <li>sakit</li>
                                    </ol>
                                    <h6 class="m-0">ASSESMEN :</h6>
                                    <ol>
                                        <li>sakit</li>
                                    </ol>
                                    <h6 class="m-0">PLANNING :</h6>
                                    <ol>
                                        <li>sakit</li>
                                        <li>sakit</li>
                                        <li>sakit</li>
                                        <li>sakit</li>
                                        <li>sakit</li>
                                        <li>sakit</li>
                                        <li>sakit</li>
                                        <li>sakit</li>
                                        <li>sakit</li>
                                        <li>sakit</li>
                                    </ol>
                                </div>
                                <div class="col-3">
                                    <div class="text-center justify-content-bottom">
                                        <p>Dokter Penanggung Jawab</p>
                                        <br><br><br>
                                        <p class="fw-bold">Dr. Kholid Hasibuan</p>
                                    </div>
                                </div>
                            </div>
                        </li>

                    </ol>
                </div>
            </div>
            <hr>
            <h4>Hasil Pemeriksaan</h4>
            <div class="accordion" id="accordionExample">
                <div class="card accordion-item active">
                    <h2 class="accordion-header" id="headingOne">
                        <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                            data-bs-target="#accordionOne" aria-expanded="false" aria-controls="accordionOne"
                            role="tabpanel">
                            Laboratorium Patologi Klinik
                        </button>
                    </h2>

                    <div id="accordionOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <table class="table" id="example">
                                <thead>
                                    <tr class="text-nowrap bg-dark">
                                        <th>No</th>
                                        <th>No. Antrian</th>
                                        <th>No. Registrasi Labor PK</th>
                                        <th>Petugas Laboratorium</th>
                                        <th>Tanggal Periksa</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($item->laboratoriumPatientResult->where('status', 'SELESAI') as $pkResult)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $pkResult->queue->no_antrian ?? '' }}</td>
                                            <td>{{ $pkResult->no_reg_lab ?? '' }}</td>
                                            <td>{{ $pkResult->user->name ?? '-' }}</td>
                                            <td>{{ $pkResult->tanggal_periksa ?? '' }}</td>
                                            <td>{{ $pkResult->status ?? '' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                            data-bs-target="#accordionTwo" aria-expanded="false" aria-controls="accordionTwo"
                            role="tabpanel">
                            Laboratorium Patologi Anatomi
                        </button>
                    </h2>
                    <div id="accordionTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <table class="table" id="example1">
                                <thead>
                                    <tr class="text-nowrap bg-dark">
                                        <th>No</th>
                                        <th>Petugas Laboratorium</th>
                                        <th>Tanggal Periksa</th>
                                        <th>Jenis Pemeriksaan</th>
                                        <th>Status</th>
                                        <th>Category</th>
                                        <th>Hasil</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($item->permintaanLaboratoriumPatologiAnatomikPatient as $req)
                                        <tr>{{ $loop->iteration }}</tr>
                                        <tr>{{ $req->no_sedian ?? '' }}</tr>
                                        <tr>{{ $req->jaringanTubuhDiDapat ?? '' }}</tr>
                                        <tr>{{ $req->jaringanTubuhDiDapat ?? '' }}</tr>
                                        <tr>{{ $req->jaringanTubuhDiDapat ?? '' }}</tr>
                                        <tr>{{ $req->jaringanTubuhDiDapat ?? '' }}</tr>
                                        <tr>{{ $req->jaringanTubuhDiDapat ?? '' }}</tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                            data-bs-target="#accordionThree" aria-expanded="false" aria-controls="accordionThree"
                            role="tabpanel">
                            Radiologi
                        </button>
                    </h2>
                    <div id="accordionThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <table class="table" id="example2">
                                <thead>
                                    <tr class="text-nowrap bg-dark">
                                        <th>No</th>
                                        <th>No. Antrian</th>
                                        <th>Petugas Laboratorium</th>
                                        <th>Tanggal Periksa</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($item->radiologiPatient->where('status', 'SELESAI') as $radResult)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $radResult->no_antrian ?? '' }}</td>
                                            <td>{{ $radResult->user->name ?? '-' }}</td>
                                            <td>{{ $radResult->tanggal_periksa ?? '' }}</td>
                                            <td>{{ $radResult->status ?? '' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection
