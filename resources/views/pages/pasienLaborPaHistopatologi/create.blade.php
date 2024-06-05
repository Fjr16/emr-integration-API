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
            <h5 class="mb-0">Input Bacaan Histopatologi</h5>
            <button type="button" class="btn btn-sm btn-success" onclick="history.back()" >Kembali</button>
        </div>
        <form action="{{ route('permintaan/laboratorium/patologi/anatomik.storeHasilHispatologi', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
            @csrf
            <div class="card-body">
                <div class="row mb-3">
                    <label for="no_pendaftaran" class="col-form-label col-2">No. Pendaftaran</label>
                    <div class="col-9">
                        <input class="form-control" type="text"  name="no_pend" value="{{ $noHisto }}" readonly/>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="no_rm" class="col-form-label col-2">No. RM</label>
                    <div class="col-9">
                        <input class="form-control" type="text" value="{{ $item->antrianLaboratoriumPatologiAnatomiPatient->permintaanLaboratoriumPatologiAnatomikPatient->queue->patient->no_rm }}" disabled/>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nama_pasien" class="col-form-label col-2">Nama Pasien</label>
                    <div class="col-9">
                        <input class="form-control" type="text" value="{{ $item->antrianLaboratoriumPatologiAnatomiPatient->permintaanLaboratoriumPatologiAnatomikPatient->queue->patient->name }}" disabled/>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="tanggal_jawaban" class="col-form-label col-2">Tanggal Jawaban</label>
                    <div class="col-9">
                        <input class="form-control" type="date" value="" disabled/>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="item_pemeriksaan" class="col-form-label col-2">Item Pemeriksaan</label>
                    <div class="col-9">
                        <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="pemeriksaan">
                            <option selected disabled>Pilih</option>
                            <option value="pa kecil">PA Kecil</option>
                            <option value="pa besar">PA Besar</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="makroskopik" class="col-form-label col-2">Makroskopik</label>
                    <div class="col-9">
                        <textarea class="form-control" type="text" id="editor" name="makroskopik" value=""> </textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="mikroskopik" class="col-form-label col-2">Mikroskopik</label>
                    <div class="col-9">
                        <textarea class="form-control" type="text" id="editor1" value="" name="mikroskopik"> </textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="diagnosa" class="col-form-label col-2">Diagnosa</label>
                    <div class="col-9">
                        <textarea class="form-control" type="text" id="editor2" value="" name="diagnosis"> </textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="diagnosa" class="col-form-label col-2">Kesan</label>
                    <div class="col-9">
                        <textarea class="form-control" type="text" id="editor3" value="" name="kesan"> </textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="dokter_pa" class="col-form-label col-2">Dokter PA</label>
                    <div class="col-9">
                        <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="dokterpa">
                            <option selected disabled>Pilih</option>
                            <option value="dr ucok">Dr. Ucok</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3 text-end">
                    <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                </div>
            </div>
        </form>
    </div>
@endsection

