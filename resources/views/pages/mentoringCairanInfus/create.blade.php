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
            <h4 class="align-self-center m-0">MONITORING CAIRAN INFUS

            </h4>
            {{-- <div class="ms-auto">
                <a href="{{ route('farmasi/obat/konversi.create') }}" class="btn btn-success btn-sm m-0">+ Tambah Konversi</a>
                <a href="{{ route('farmasi/obat/master/konversi.create') }}" class="btn btn-success btn-sm m-0 mx-2">+ Tambah
                    Satuan</a>
            </div> --}}
        </div>
        <hr class="m-0 mt-2 mb-3">
        <form action="{{ route('monitoring/cairan/infus.store', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
            @csrf
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <td>Tanggal & jam</td>
                            <td>Order Dokter</td>
                            <td>Jenis Cairan</td>
                            <td>Botol Ke</td>
                            <td>Tetes/ Menit</td>
                            <td>Dimulai Jam</td>
                            <td>Habis Jam</td>
                            <td>Nama Perawat</td>
                            <td>Keterangan</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="datetime-local" class="form-control form-control-sm" value="{{ date('Y-m-d H:i:s') }}" name="tanggal[]" required></td>
                            <td><input type="text" class="form-control form-control-sm" name="order_dokter[]" required></td>
                            <td><input type="text" class="form-control form-control-sm" name="jenis[]" required></td>
                            <td><input type="number" class="form-control form-control-sm" name="botol_ke[]" required></td>
                            <td><input type="number" class="form-control form-control-sm" name="tetes[]" required></td>
                            <td><input type="time" class="form-control form-control-sm" name="mulai[]" value="{{ date('H:i') }}" required></td>
                            <td><input type="time" class="form-control form-control-sm" name="habis[]" value="{{ date('H:i') }}" required></td>
                            <td><input type="text" class="form-control form-control-sm" value="{{ auth()->user()->name ?? '' }}" disabled></td>
                            <td><input type="text" class="form-control form-control-sm" name="keterangan[]"></td>
                            <td><button type="button" class="btn btn-sm btn-dark" onclick="tambahInputInfus(this)"><i class="bx bx-plus"></i></button></td>
                        </tr>
                    </tbody>
                </table>
                <div class="mb-3 mt-5  text-end">
                    <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        function tambahInputInfus(element){
            var tbody = element.parentNode.parentNode.parentNode;

            var tr = document.createElement('tr');
            tr.innerHTML = `
                <td><input type="datetime-local" class="form-control form-control-sm" value="{{ date('Y-m-d H:i:s') }}" name="tanggal[]" required></td>
                <td><input type="text" class="form-control form-control-sm" name="order_dokter[]" required></td>
                <td><input type="text" class="form-control form-control-sm" name="jenis[]" required></td>
                <td><input type="number" class="form-control form-control-sm" name="botol_ke[]" required></td>
                <td><input type="number" class="form-control form-control-sm" name="tetes[]" required></td>
                <td><input type="time" class="form-control form-control-sm" name="mulai[]" value="{{ date('H:i') }}" required></td>
                <td><input type="time" class="form-control form-control-sm" name="habis[]" value="{{ date('H:i') }}" required></td>
                <td><input type="text" class="form-control form-control-sm" value="{{ auth()->user()->name ?? '' }}" disabled></td>
                <td><input type="text" class="form-control form-control-sm" name="keterangan[]"></td>
                <td><button type="button" class="btn btn-sm btn-danger" onclick="hapusInputInfus(this)"><i class="bx bx-minus"></i></button></td>
            `;
            tbody.appendChild(tr);
        }

        function hapusInputInfus(element){
            var tr = element.parentNode.parentNode;
            tr.remove();
        }
    </script>
@endsection
