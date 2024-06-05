@extends('layouts.backend.main')

@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Tindakan Pelayanan Pasien</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('kemoterapi/tindakan/pelayanan/pasien.storeIndex', $item->id) }}">
                @csrf
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Tanggal Masuk / Jam</label>
                    <div class="col-sm-10">
                        <input type="datetime-local" name="tanggal_masuk" value="{{ date('Y-m-d H:i') }}" class="form-control" id="basic-default-name">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Tanggal Keluar / Jam</label>
                    <div class="col-sm-10">
                        <input type="datetime-local" name="tanggal_keluar" class="form-control" id="basic-default-name">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Dokter Pengirim</label>
                    <div class="col-sm-10">
                        <select name="user_id" id="user_id" class="form-select form-control select2">
                            <option value="" selected disabled>Pilih</option>
                            @foreach ($dokters as $dokter)
                                <option value="{{ $dokter->id }}">{{ $dokter->staff_id }} / {{ $dokter->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <hr>
                <div class="text-end">
                    <button class="btn btn-success btn-sm">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection

<script>

</script>
