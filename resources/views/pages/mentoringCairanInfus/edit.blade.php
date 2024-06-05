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
            <h4 class="align-self-center m-0">EDIT MONITORING CAIRAN INFUS</h4>
        </div>
        <hr class="m-0 mt-2 mb-3">
        <form action="{{ route('monitoring/cairan/infus.update', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
            @method('PUT')
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
                        @foreach ($item->ranapMonitoringCairanInfusPatients as $infus)      
                            <tr>
                                <input type="hidden" name="monitoring_infus_id[]" value="{{ $infus->id }}">
                                <td><input type="datetime-local" class="form-control form-control-sm" value="{{ date('Y-m-d H:i:s') }}" name="tanggal[]" value="{{ $infus->tanggal ?? '' }}" required></td>
                                <td><input type="text" class="form-control form-control-sm" name="order_dokter[]" value="{{ $infus->order_dokter ?? '' }}" required></td>
                                <td><input type="text" class="form-control form-control-sm" name="jenis[]" value="{{ $infus->jenis ?? '' }}" required></td>
                                <td><input type="number" class="form-control form-control-sm" name="botol_ke[]" value="{{ $infus->botol_ke ?? '' }}" required></td>
                                <td><input type="number" class="form-control form-control-sm" name="tetes[]" value="{{ $infus->tetes ?? '' }}" required></td>
                                <td><input type="time" class="form-control form-control-sm" name="mulai[]" value="{{ $infus->mulai ?? date('H:i') }}" required></td>
                                <td><input type="time" class="form-control form-control-sm" name="habis[]" value="{{ $infus->habis ?? date('H:i') }}" required></td>
                                <td><input type="text" class="form-control form-control-sm" value="{{ $infus->user->name ?? '' }}" disabled></td>
                                <td><input type="text" class="form-control form-control-sm" name="keterangan[]" value="{{ $infus->keterangan ?? '' }}"></td>
                                {{-- <form action="{{ route('monitoring/cairan/infus.destroy', $infus->id) }}" method="POST"> --}}
                                    {{-- @method('DELETE') --}}
                                    {{-- @csrf --}}
                                    <td>
                                        <button type="button" class="btn btn-sm btn-danger" onclick="deleteInfus({{ $infus->id }})"><i class="bx bx-trash"></i></button>
                                    </td>
                                {{-- </form> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mb-3 mt-5  text-end">
                    <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                </div>
            </div>
        </form>
        <form id="formDelete"></form>
    </div>

    <script>
        function deleteInfus(id){
            if (confirm('Yakin Ingin Menghapus')) {
                var form = document.getElementById('formDelete');
                form.action = '{{ route("monitoring/cairan/infus.destroy", '') }}/' + id;
                form.method = 'POST';
                form.innerHTML = 
                `
                @method('DELETE')
                @csrf 
                `;
                form.submit();
            }
        }
    </script>
@endsection
