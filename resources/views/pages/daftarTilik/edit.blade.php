@extends('layouts.backend.main')

@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Tambah Tindakan</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('daftar-tilik.update', $data->id) }}">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Pasien</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="basic-default-name"
                            value="{{ $data->patient->name }}" @disabled(true)>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Jam Tiba
                                Operasi</label>
                            <div class="col-sm-7">
                                <input type="time" value="{{ $data->jam_tiba }}" name="jam_tiba" class="form-control"
                                    id="basic-default-name" @required(true)>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Ruang Rawat</label>
                            <div class="col-sm-7">
                                <select class="form-control select2" name="ruang_rawat" @required(true)>
                                    @foreach ($rooms as $room)
                                        <option {{ $room->name == $data->ruang_rawat ? 'selected' : '' }} value="{{ $room->name }}">{{ $room->name }}</option>
                                        @if ($room->name !== $data->ruang_rawat)
                                        <option value="{{ $room->name }}">{{ $room->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Tanggal Operasi</label>
                            <div class="col-sm-7">
                                <input type="date" name="tgl_operasi"
                                    value="{{ $data->tanggal_operasi }}"class="form-control" id="basic-default-name"
                                    @required(true)>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Jam Keluar Operasi</label>
                            <div class="col-sm-7">
                                <input type="time" name="jam_keluar" value="{{ $data->jam_keluar }}" class="form-control"
                                    id="basic-default-name" @required(true)>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Tindakan Operasi</label>
                            <div class="col-sm-7">
                                <input type="text" name="tindakan" class="form-control"
                                    value="{{ $data->tindakan_operasi }}" id="basic-default-name" @required(true)>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Lokasi Sisi Operasi /
                                Tindakan</label>
                            <div class="col-sm-7">

                                <input type="radio" name="sisi_operasi" id="basic-default-name" value="Kanan"
                                    {{ $data->lokasi_sisi_operasi_tindakan == 'Kanan' ? 'checked' : '' }}>
                                Kanan
                                <input type="radio" name="sisi_operasi" id="basic-default-name" value="Kiri"
                                    {{ $data->lokasi_sisi_operasi_tindakan == 'Kiri' ? 'checked' : '' }}>
                                Kiri
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <p class="text-center fw-bold">PRE OPERASI</p>
                        <table class="table">
                            <thead>
                                <tr class="text-nowrap bg-dark">
                                    <th>No</th>
                                    <th>Kelengkapan</th>
                                    <th>RI</th>
                                    <th>OK</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data2 as $preOperasi)
                                    <tr>
                                        <td>{{ $loop->iteration }}</th>
                                        <td>{{ $preOperasi->name }}</th>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="pre_operasi[{{ $preOperasi->name }}][ri]" {{ $preOperasi->ri == 'check' ? 'checked' : '' }} value="check"  id="flexCheckDefault">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="pre_operasi[{{ $preOperasi->name }}][ok]" {{ $preOperasi->ok == 'check' ? 'checked' : '' }} value="check"  id="flexCheckDefault">
                                            </div>
                                        </td>
                                        {{-- <td>
                                            <input type="radio" name="pre_operasi[{{ $preOperasi->name }}]"
                                                value="RI"{{ $preOperasi->status == 'RI' ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <input type="radio" name="pre_operasi[{{ $preOperasi->name }}]"
                                                value="OK" {{ $preOperasi->status == 'OK' ? 'checked' : '' }}>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <p class="text-center fw-bold">PASCA OPERASI</p>
                        <table class="table">
                            <thead>
                                <tr class="text-nowrap bg-dark">
                                    <th>No</th>
                                    <th>Kelengkapan</th>
                                    <th>OK</th>
                                    <th>PACU</th>
                                    <th>RI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data3 as $pascaOperasi)
                                    <tr>
                                        <td>{{ $loop->iteration }}</th>
                                        <td>{{ $pascaOperasi->name }}</th>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="pasca_operasi[{{ $pascaOperasi->name }}][ok]" {{ $pascaOperasi->ok == 'check' ? 'checked' : '' }} value="check"  id="flexCheckDefault">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="pasca_operasi[{{ $pascaOperasi->name }}][pacu]" {{ $pascaOperasi->pacu == 'check' ? 'checked' : '' }} value="check"  id="flexCheckDefault">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="pasca_operasi[{{ $pascaOperasi->name }}][ri]" {{ $pascaOperasi->ri == 'check' ? 'checked' : '' }} value="check"  id="flexCheckDefault">
                                            </div>
                                        </td>
                                        {{-- <td>
                                            <input type="radio" name="pasca_operasi[{{ $pascaOperasi->name }}]"
                                                value="RI"{{ $pascaOperasi->status == 'OK' ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <input type="radio" name="pasca_operasi[{{ $pascaOperasi->name }}]"
                                                value="PACU"{{ $pascaOperasi->status == 'PACU' ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <input type="radio" name="pasca_operasi[{{ $pascaOperasi->name }}]"
                                                value="OK" {{ $pascaOperasi->status == 'RI' ? 'checked' : '' }}>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <hr>
                <div class="row justify-content-end">
                    <button type="submit" class="btn btn-sm btn-dark">Simpan</button>

                </div>
            </form>
        </div>
    </div>
@endsection
