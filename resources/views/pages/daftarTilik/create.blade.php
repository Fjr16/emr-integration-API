@extends('layouts.backend.main')

@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Buat Daftar Tilik Verifikasi Pasien Pra Operasi</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('daftar-tilik.store', $item->id) }}">
                @csrf
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Pilih Pasien</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" name="patient_id" @required(true)>
                                <option value="{{ $item->queue->patient->id }}">{{ $item->queue->patient->name }}</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Jam Tiba
                                Operasi</label>
                            <div class="col-sm-7">
                                <input type="time" name="jam_tiba" class="form-control" id="basic-default-name"
                                    @required(true)>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Ruang Rawat</label>
                            <div class="col-sm-7">
                                <select class="form-control select2" name="ruang_rawat" @required(true)>
                                    @foreach ($rooms as $room)
                                        <option value="{{ $room->name }}">{{ $room->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Tanggal Operasi</label>
                            <div class="col-sm-7">
                                <input type="date" name="tgl_operasi" class="form-control" id="basic-default-name"
                                    @required(true)>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Jam Keluar Operasi</label>
                            <div class="col-sm-7">
                                <input type="time" name="jam_keluar" class="form-control" id="basic-default-name"
                                    @required(true)>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Tindakan Operasi</label>
                            <div class="col-sm-7">
                                <input type="text" name="tindakan" class="form-control" id="basic-default-name"
                                    @required(true)>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Lokasi Sisi Operasi /
                                Tindakan</label>
                            <div class="col-sm-7">
                                <input type="radio" name="sisi_operasi" id="basic-default-name" value="Kanan"
                                    @required(true)> Kanan
                                <input type="radio" name="sisi_operasi" id="basic-default-name" value="Kiri"
                                    @required(true)> Kiri
                                <input type="radio" name="sisi_operasi" id="basic-default-name" value="Bilateral"
                                    @required(true)> Bilateral
                                <input type="radio" name="sisi_operasi" id="basic-default-name" value="Multiple"
                                    @required(true)> Multiple
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-sm btn-dark">Buat Daftar</button>
                </div>


            </form>
        </div>
    </div>
@endsection
