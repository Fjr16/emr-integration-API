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
                INFEKSI DAERAH OPERASI (IDO) -- {{ $data->rawatInapPatient->queue->patient->name }}
            </h4>
            {{-- <div class="ms-auto">
                <a href="{{ route('farmasi/obat/konversi.create') }}" class="btn btn-success btn-sm m-0">+ Tambah Konversi</a>
                <a href="{{ route('farmasi/obat/master/konversi.create') }}" class="btn btn-success btn-sm m-0 mx-2">+ Tambah
                    Satuan</a>
            </div> --}}
        </div>
        <hr class="m-0 mt-2 mb-3">
        <form action="{{ route('hais/ido.update', $data->id) }}" method="POST"
            onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
            @csrf
            @method('PUT')
            <div class="card-body table-responsive">
                <input type="hidden" name="rawat_inap_patient_id" value="{{ $data->rawat_inap_patient_id }}">
                <div class="row mb-2 justify-items-stretch">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-3">Tanggal</div>
                            <div class="col-6">
                                <input class="form-control" id="tanggal" name="tanggal" type="date"
                                    value="{{ $data->tanggal }}" required />
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row ">
                            <div class="col-6">Ruangan/ Instalasi/ Satuan Kerja</div>
                            <div class="col-6">
                                <select name="room_detail_id" id="room_detail_id"
                                    class="form-select form-control form-control-sm select2">
                                    <option selected value="{{ $data->room_detail_id }}">{{ $data->roomDetail->name }}
                                    </option>
                                    @foreach ($roomDetails as $roomDetail)
                                        <option value="{{ $roomDetail->id }}">{{ $roomDetail->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <table class="w-100  mt-5 ">
                    <tr class="text-center">
                        <td class="pb-3" style="min-width: 300px">Komponen</td>
                        <td class="pb-3" style="min-width: 100px">Ya</td>
                        <td class="pb-3" style="min-width: 100px">Tidak</td>
                        <td class="pb-3" style="min-width: 150px">Tidak Dapat Dinilai</td>
                        <td class="pb-3" style="min-width: 100px;">Keterangan</td>
                    </tr>


                    <tr class="bg-primary text-white fw-semibold">
                        <td colspan="5" class="py-2 ps-2">PRE OPERASI</td>
                    </tr>

                    @foreach ($details as $detail)
                        @if ($detail->kategori == 'Pre Operasi')
                            <tr class="text-center">
                                <td class="pt-3 text-start">{{ $detail->nama }}</td>
                                <input type="hidden" name="id_akhir" value="{{ $detail->id }}">
                                <input type="hidden" name="id[{{ $detail->id }}]" value="{{ $detail->id }}">
                                <input type="hidden" name="nama[{{ $detail->id }}]" value="{{ $detail->nama }}">
                                <input type="hidden" name="kategori[{{ $detail->id }}]" value="Pre Operasi">
                                @if ($detail->status == 'Y')
                                    <td class="p-0 pt-3"> <input class="form-check-input"
                                            name="status[{{ $detail->id }}]" type="radio" value="Y" checked />
                                    </td>
                                    <td class="p-0 pt-3"> <input class="form-check-input"
                                            name="status[{{ $detail->id }}]" type="radio" value="T" /></td>
                                    <td class="p-0 pt-3 "> <input class="form-check-input"
                                            name="status[{{ $detail->id }}]" type="radio" value="TDD" /></td>
                                @elseif ($detail->status == 'T')
                                    <td class="p-0 pt-3"> <input class="form-check-input"
                                            name="status[{{ $detail->id }}]" type="radio" value="Y" /></td>
                                    <td class="p-0 pt-3"> <input class="form-check-input"
                                            name="status[{{ $detail->id }}]" type="radio" value="T" checked />
                                    </td>
                                    <td class="p-0 pt-3 "> <input class="form-check-input"
                                            name="status[{{ $detail->id }}]" type="radio" value="TDD" /></td>
                                @elseif ($detail->status == 'TDD')
                                    <td class="p-0 pt-3"> <input class="form-check-input"
                                            name="status[{{ $detail->id }}]" type="radio" value="Y" /></td>
                                    <td class="p-0 pt-3"> <input class="form-check-input"
                                            name="status[{{ $detail->id }}]" type="radio" value="T" /></td>
                                    <td class="p-0 pt-3 "> <input class="form-check-input"
                                            name="status[{{ $detail->id }}]" type="radio" value="TDD" checked />
                                    </td>
                                @endif
                                <td class="p-1 pt-3">
                                    <textarea class="form-control form-control-sm" rows="" name="ket[{{ $detail->id }}]">{{ $detail->ket }}</textarea>
                                </td>
                            </tr>
                        @endif
                    @endforeach

                    <tr class="bg-primary text-white fw-semibold">
                        <td colspan="5" class="py-2 ps-2">INTRA OPERASI</td>
                    </tr>

                    @foreach ($details as $detail)
                        @if ($detail->kategori == 'Intra Operasi')
                            <tr class="text-center">
                                <td class="pt-3 text-start">{{ $detail->nama }}</td>
                                <input type="hidden" name="id_akhir" value="{{ $detail->id }}">
                                <input type="hidden" name="id[{{ $detail->id }}]" value="{{ $detail->id }}">
                                <input type="hidden" name="nama[{{ $detail->id }}]" value="{{ $detail->nama }}">
                                <input type="hidden" name="kategori[{{ $detail->id }}]" value="Intra Operasi">
                                @if ($detail->status == 'Y')
                                    <td class="p-0 pt-3"> <input class="form-check-input"
                                            name="status[{{ $detail->id }}]" type="radio" value="Y" checked />
                                    </td>
                                    <td class="p-0 pt-3"> <input class="form-check-input"
                                            name="status[{{ $detail->id }}]" type="radio" value="T" /></td>
                                    <td class="p-0 pt-3 "> <input class="form-check-input"
                                            name="status[{{ $detail->id }}]" type="radio" value="TDD" /></td>
                                @elseif ($detail->status == 'T')
                                    <td class="p-0 pt-3"> <input class="form-check-input"
                                            name="status[{{ $detail->id }}]" type="radio" value="Y" /></td>
                                    <td class="p-0 pt-3"> <input class="form-check-input"
                                            name="status[{{ $detail->id }}]" type="radio" value="T" checked />
                                    </td>
                                    <td class="p-0 pt-3 "> <input class="form-check-input"
                                            name="status[{{ $detail->id }}]" type="radio" value="TDD" /></td>
                                @elseif ($detail->status == 'TDD')
                                    <td class="p-0 pt-3"> <input class="form-check-input"
                                            name="status[{{ $detail->id }}]" type="radio" value="Y" /></td>
                                    <td class="p-0 pt-3"> <input class="form-check-input"
                                            name="status[{{ $detail->id }}]" type="radio" value="T" /></td>
                                    <td class="p-0 pt-3 "> <input class="form-check-input"
                                            name="status[{{ $detail->id }}]" type="radio" value="TDD" checked />
                                    </td>
                                @endif
                                <td class="p-1 pt-3">
                                    <textarea class="form-control form-control-sm" rows="" name="ket[{{ $detail->id }}]">{{ $detail->ket }}</textarea>
                                </td>
                            </tr>
                        @endif
                    @endforeach

                    <tr class="bg-primary text-light fw-semibold">
                        <td colspan="27" class="py-3 ps-2 text-white">
                            <p class="m-0">POST OPERASI</p>
                            <p class="m-0">Perawatan luka setelah operasi </p>
                        </td>
                    </tr>

                    @foreach ($details as $detail)
                        @if ($detail->kategori == 'Post Operasi')
                            <tr class="text-center">
                                <td class="pt-3 text-start">{{ $detail->nama }}</td>
                                <input type="hidden" name="id_akhir" value="{{ $detail->id }}">
                                <input type="hidden" name="id[{{ $detail->id }}]" value="{{ $detail->id }}">
                                <input type="hidden" name="nama[{{ $detail->id }}]" value="{{ $detail->nama }}">
                                <input type="hidden" name="kategori[{{ $detail->id }}]" value="Post Operasi">
                                @if ($detail->status == 'Y')
                                    <td class="p-0 pt-3"> <input class="form-check-input"
                                            name="status[{{ $detail->id }}]" type="radio" value="Y" checked />
                                    </td>
                                    <td class="p-0 pt-3"> <input class="form-check-input"
                                            name="status[{{ $detail->id }}]" type="radio" value="T" /></td>
                                    <td class="p-0 pt-3 "> <input class="form-check-input"
                                            name="status[{{ $detail->id }}]" type="radio" value="TDD" /></td>
                                @elseif ($detail->status == 'T')
                                    <td class="p-0 pt-3"> <input class="form-check-input"
                                            name="status[{{ $detail->id }}]" type="radio" value="Y" /></td>
                                    <td class="p-0 pt-3"> <input class="form-check-input"
                                            name="status[{{ $detail->id }}]" type="radio" value="T" checked />
                                    </td>
                                    <td class="p-0 pt-3 "> <input class="form-check-input"
                                            name="status[{{ $detail->id }}]" type="radio" value="TDD" /></td>
                                @elseif ($detail->status == 'TDD')
                                    <td class="p-0 pt-3"> <input class="form-check-input"
                                            name="status[{{ $detail->id }}]" type="radio" value="Y" /></td>
                                    <td class="p-0 pt-3"> <input class="form-check-input"
                                            name="status[{{ $detail->id }}]" type="radio" value="T" /></td>
                                    <td class="p-0 pt-3 "> <input class="form-check-input"
                                            name="status[{{ $detail->id }}]" type="radio" value="TDD" checked />
                                    </td>
                                @endif
                                <td class="p-1 pt-3">
                                    <textarea class="form-control form-control-sm" rows="" name="ket[{{ $detail->id }}]">{{ $detail->ket }}</textarea>
                                </td>
                            </tr>
                        @endif
                    @endforeach

                    <tr>
                        <td>Inisial Perawat</td>
                        <td colspan="5"><input type="text" class=" form-control form-control-sm"
                                value="{{ Auth::user()->name }}" disabled></td>
                    </tr>
                </table>

                <input type="hidden" name="jenis" value="Infeksi Daerah Operasi">

                <div class="mb-3 mt-5  text-end">
                    <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                </div>
            </div>
        </form>
    </div>
@endsection
