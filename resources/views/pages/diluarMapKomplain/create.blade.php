@extends('layouts.backend.main')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div id="success-message"></div>
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Tambah Permintaan Pelaksanaan Pelayanan Kerohanian</h5>
        </div>
        <form action="" method="POST" onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
            @csrf
            <div class="card-body">
                    <!-- PENYAMPAIN KOMPLAIN / KELUHAN -->
                    <div class="text-uppercase text-center text-white fw-bold py-2 mb-3 bg-dark">
                        PENYAMPAIN KOMPLAIN / KELUHAN
                    </div>
                    <div class="row mb-3">
                        <label for="ruangan" class="col-form-label col-2">Masalah</label>
                        <div class="col-10">
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="baru" value="option1" />
                                <label class="form-check-label" for="baru">Baru</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="lama" value="option2" />
                                <label class="form-check-label" for="lama">Lama</label>
                              </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="nama" class="col-form-label col-2">Nama Pasien / Pengunjung</label>
                        <div class="col-10">
                            <input class="form-control" type="text" value="" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="no_telp" class="col-form-label col-2">No. Telp / HP</label>
                        <div class="col-10">
                            <input class="form-control" type="text" value="" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="tanggal" class="col-form-label col-2">tanggal / jam Komplain</label>
                        <div class="col-10">
                            <input class="form-control" type="text" value="" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="ruangan_bagian" class="col-form-label col-2">ruangan / bagian</label>
                        <div class="col-10">
                            <input class="form-control" type="text" value="" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="uraian_komplain" class="col-form-label col-2">uraian peyampaian komplain / keluhan</label>
                        <div class="col-10">
                            <textarea class="form-control" type="text" value="" rows="3"/></textarea>
                        </div>
                    </div>

                    <!-- GRAADING -->
                    <div class="text-uppercase text-center text-white fw-bold py-2 mb-3 bg-dark">
                        Grading
                    </div>

                    <table class="table-bordered w-100 mb-3">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">Tingkat</th>
                                <th scope="col">Kriteria</th>
                                <th scope="col">Grading Komplain(V)</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row" class="p-4 text-center bg-success">Rendah</th>
                                <td class="ps-2">Tidak menimbulkan kerugian berarti baik material maupun immaterial.
                                </td>
                                <td valign="center" class="ps-5">

                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">


                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class="p-4 text-center bg-warning">Tinggi</th>
                                <td class="ps-2">Cenderung berhubungan dengan pemberitaan media, potensi kerugian
                                    immaterial, dan Lain-lain</td>
                                <td valign="center" class="ps-5">

                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">


                                </td>

                            </tr>
                            <tr>
                                <th scope="row " class="p-4 text-center " style="background-color: rgb(238, 70, 70);">
                                    Ekstrim</th>
                                <td class="ps-2">Cenderung berhubungan dengan polisi, pengadilan, kematian, mengancam
                                    sistem/kelangsungan organisasi, potensi kerugian
                                    material, dan lain-lain</td>
                                <td valign="center" class="ps-5">

                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">

                                </td>

                            </tr>
                        </tbody>
                    </table>
                <div class="mb-3 text-end">
                    <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                </div>
            </div>
        </form>
    </div>
@endsection
