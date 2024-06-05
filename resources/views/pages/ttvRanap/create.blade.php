@extends('layouts.backend.main')

@section('content')

@if ($errors->any())
<div class="alert alert-danger w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index: 99; max-width: max-content; left: 50%; transform: translate(-50%, -50%);" role="alert">
    Gagal menyimpan. Pastikan semua data terisi dengan benar
</div>
@endif
<div class="card p-3 mt-5">
    <!-- <div class="card mb-4"> -->
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0 text-center">Monitoring Tanda Tanda Vital (TTV)</h5>
    </div>

    <div class="card-body">
        <form action="">
            @csrf
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Tanggal</label>
                <div class="col-sm-10">
                    <input type="date" name="tgl" class="form-control" id="basic-default-name" />
                    <div class="mt-1">
                        <input class="form-check-input" type="checkbox" value="sekarang" name="diagnosis-keperawatan[]" id="defaultCheck1" />
                        <label class="form-check-label" for="defaultCheck1">
                          Hari ini ?
                        </label>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Hari Rawat ke</label>
                <div class="col-sm-10">
                    <input type="number" name="hari" class="form-control" id="basic-default-name" required />
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Tindakan</label>
                <div class="col-sm-10">
                    <input type="text" name="tindakan" class="form-control" id="basic-default-name" required />
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Jam</label>
                <div class="col-sm-10">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" name="jam" type="radio" id="inlineCheckbox1" value="9" />
                      <label class="form-check-label" for="inlineCheckbox1">9</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" name="jam" type="radio" id="inlineCheckbox1" value="15" />
                      <label class="form-check-label" for="inlineCheckbox1">15</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" name="jam" type="radio" id="inlineCheckbox1" value="21" />
                      <label class="form-check-label" for="inlineCheckbox1">21</label>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">TO</label>
                <div class="col-sm-10">
                    <input type="number" name="to" class="form-control" id="basic-default-name" required />
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">RR</label>
                <div class="col-sm-10">
                    <input type="number" name="rr" class="form-control" id="basic-default-name" required />
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">HR</label>
                <div class="col-sm-10">
                    <input type="number" name="hr" class="form-control" id="basic-default-name" required />
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">T</label>
                <div class="col-sm-10">
                    <input type="number" name="t" class="form-control" id="basic-default-name" required />
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Intervensi Non Farmkologi</label>
                <div class="col-sm-10">
                    @foreach ($farmakologi as $fm)
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" name="jam" type="radio" id="inlineCheckbox1" value="{{ $fm }}" />
                      <label class="form-check-label" for="inlineCheckbox1">{{ $fm }}</label>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Obat</label>
                <div class="col-sm-10">
                    <input type="number" name="t" class="form-control" id="basic-default-name" required />
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Dosis</label>
                <div class="col-sm-10">
                    <input type="number" name="t" class="form-control" id="basic-default-name" required />
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Frek</label>
                <div class="col-sm-10">
                    <input type="number" name="t" class="form-control" id="basic-default-name" required />
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Rute</label>
                <div class="col-sm-10">
                    <input type="number" name="t" class="form-control" id="basic-default-name" required />
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Waktu Kaji Ulang</label>
                <div class="col-sm-10">
                    <input type="number" name="t" class="form-control" id="basic-default-name" required />
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-sm btn-dark">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection