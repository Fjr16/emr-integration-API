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
            lembaran konsultasi penyakit dalam (toleransi operasi)
        </h5>
        <div class="card-body">
            <form action="{{ route('lembar/konsultasi/penyakit/dalam.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-6 m-0 fw-medium">
                        <label for="user_id_1" class="form-label mt-2">Yth. dr</label>
                        <select class="form-control" id="user_id_1" name="user_id" required>
                            <option value="" selected disabled>Pilih</option>
                            <option value="{{ $item->ranapJawabanKonsulPenyakitDalamPatient->user_id }}" selected>
                                {{ $item->ranapJawabanKonsulPenyakitDalamPatient->user->name }}</option>
                            @foreach ($dokters as $dokter)
                                @if (old('user_id') == $dokter->id)
                                    <option value="{{ $dokter->id }}" selected>{{ $dokter->name }}</option>
                                @else
                                    <option value="{{ $dokter->id }}">{{ $dokter->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6">
                        <label for="room_detail_id_1" class="form-label mt-2">Ruangan</label>
                        <select class="form-control" id="room_detail_id_1" name="room_detail_id" required>
                            <option value="{{ $item->room_detail_id }}" selected>{{ $item->roomDetail->name }}</option>
                            @foreach ($roomDetails as $room)
                                @if (old('room_detail_id', Auth::user()->room_detail_id) == $room->id)
                                    <option value="{{ $room->id }}" selected>{{ $room->name }}</option>
                                @else
                                    <option value="{{ $room->id }}">{{ $room->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <p class="fw-bold mt-3 mx-2">Dengan Hormat,</p>
                <p class="fw-semibold mx-2" style="margin-top: -10px;">mohon bantuan sejawat untuk,</p>

                <div class="mx-5">
                    @foreach ($arrPermintaan as $permintaan)
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="permintaan" value="{{ $permintaan }}"
                                id="permintaan_{{ $loop->iteration }}"
                                {{ $permintaan == $item->permintaan ? 'checked' : '' }}>
                            <label for="permintaan_{{ $loop->iteration }}"
                                class="form-check-label">{{ $loop->iteration }}. {{ $permintaan }}</label>
                        </div>
                    @endforeach
                </div>
                <div>
                    <p class="fw-semibold mx-2  mt-5">Atas pasien ini, yang kami rawat dengan : </p>
                    <div class="form-floating">
                        <textarea class="form-control" id="editor" name="ket_pasien" style="height: 50px">{{ $item->ket_pasien }}</textarea>
                    </div>
                </div>
                <div>
                    <p class="fw-semibold mx-2  mt-5">Pemeriksaan yang ditemukan : </p>
                    <div class="form-floating">
                        <textarea class="form-control" id="editor2" name="pemeriksaan_ditemukan" style="height: 125px">{{ $item->pemeriksaan_ditemukan }}</textarea>
                    </div>
                </div>
                <p class="fw-semibold mt-5">Atas perhatian dan kerjasama, kami ucapkan terima kasih. </p>
                <div class="text-end">
                    <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
