@extends('layouts.backend.main')

@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">CATATAN PERJALANAN ADMINISTRASI PASIERN RAWAT INAP</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('perjalananadministrasi-ranap.store') }}">
                @csrf
                <div class="row mb-3 container">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Pilih Pasien</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" name="patient_id">
                            @foreach ($data as $patient)
                                <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-sm btn-dark">Tambah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
