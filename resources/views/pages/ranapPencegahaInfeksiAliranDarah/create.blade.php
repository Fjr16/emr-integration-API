@extends('layouts.backend.main')

<style>
    tr {
        border: none
    }
</style>

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
                INFEKSI SALURAN DARAH (IAD) PERIPER / PLEBITIS -- {{ $item->queue->patient->name }}</h4>
            {{-- <div class="ms-auto">
                <a href="{{ route('farmasi/obat/konversi.create') }}" class="btn btn-success btn-sm m-0">+ Tambah Konversi</a>
                <a href="{{ route('farmasi/obat/master/konversi.create') }}" class="btn btn-success btn-sm m-0 mx-2">+ Tambah
                    Satuan</a>
            </div> --}}
        </div>
        <hr class="m-0 mt-2 mb-3">
        <form action="{{ route('hais/iad.store', $item->id) }}" method="POST"
            onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
            @csrf
            <div class="card-body table-responsive">
                <input type="hidden" name="rawat_inap_patient_id" value="{{ $item->id }}">
                <div class="row mb-2 justify-items-stretch">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-3">Tanggal</div>
                            <div class="col-6">
                                <input class="form-control" id="tanggal" name="tanggal" type="date"
                                    value="{{ $today->format('Y-m-d') }}" required />
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row ">
                            <div class="col-6">Ruangan/ Instalasi/ Satuan Kerja</div>
                            <div class="col-6">
                                <select name="room_detail_id" id="room_detail_id"
                                    class="form-select form-control form-control-sm select2" required>
                                    <option value="" selected disabled>Pilih</option>
                                    @foreach ($roomDetails as $roomDetail)
                                        <option value="{{ $roomDetail->id }}">{{ $roomDetail->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <table class="w-100 mt-5">

                    <tr class="text-center">
                        <td class="pb-3" style="min-width: 10px;">No</td>
                        <td class="pb-3" style="min-width: 300px">PERIPHERAL LINE</td>
                        <td class="pb-3" style="min-width: 100px;">Ya</td>
                        <td class="pb-3" style="min-width: 100px;">Tidak</td>
                        <td class="pb-3" style="min-width: 100px;">Tidak Dapat Dinilai</td>
                        <td class="pb-3" style="min-width: 100px;">Keterangan</td>
                    </tr>

                    @foreach ($kategoris as $indeks => $kategori)
                        <tr class="text-center">
                            <td class="pt-3" style="min-width: 50px">{{ $loop->iteration }}</td>
                            <td class="pt-3 text-start">{{ $kategori }}</td>
                            <input type="hidden" name="nama[{{ $indeks }}]" value="{{ $kategori }}">
                            <input type="hidden" name="kategori[{{ $indeks }}]" value="Peripheral">
                            <td class="p-0 pt-3"> <input class="form-check-input" name="status[{{ $indeks }}]"
                                    type="radio" value="Y" checked /></td>
                            <td class="p-0 pt-3"> <input class="form-check-input" name="status[{{ $indeks }}]"
                                    type="radio" value="T" /></td>
                            <td class="p-0 pt-3 "> <input class="form-check-input" name="status[{{ $indeks }}]"
                                    type="radio" value="TDD" /></td>
                            <td class="p-1 pt-3">
                                <textarea class="form-control form-control-sm" rows="" name="ket[{{ $indeks }}]"></textarea>
                            </td>
                        </tr>
                    @endforeach

                    <tr>
                        <td colspan="2">Inisial Perawat</td>
                        <td colspan="4"><input type="text" class=" form-control form-control-sm"
                                value="{{ Auth::user()->name }}" disabled></td>

                    </tr>
                </table>

                <input type="hidden" name="jenis" value="Infeksi Aliran Darah">

                <div class="mb-3 mt-5  text-end">
                    <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                </div>
            </div>
        </form>
    </div>
@endsection
