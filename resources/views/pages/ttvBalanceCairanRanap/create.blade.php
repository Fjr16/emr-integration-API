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
        <h5 class="mb-0 text-center">Monitoring Tanda Tanda Vital (TTV) Balance Cairan </h5>
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
                <label class="col-sm-2 col-form-label" for="basic-default-name">Minum</label>
                <div class="col-sm-10 row">
                    <div class="mt-1 col-2">
                        <input class="form-check-input" type="checkbox" value="sekarang" name="diagnosis-keperawatan[]" id="defaultCheck1" />
                        <label class="form-check-label" for="defaultCheck1">
                            Pagi
                        </label>
                    </div>
                    <div class="mt-1 col-2">
                        <input class="form-check-input" type="checkbox" value="sekarang" name="diagnosis-keperawatan[]" id="defaultCheck1" />
                        <label class="form-check-label" for="defaultCheck1">
                            Sore
                        </label>
                    </div>
                    <div class="mt-1 col-2">
                        <input class="form-check-input" type="checkbox" value="sekarang" name="diagnosis-keperawatan[]" id="defaultCheck1" />
                        <label class="form-check-label" for="defaultCheck1">
                            Malam
                        </label>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">MC</label>
                <div class="col-sm-10 row">
                    <div class="mt-1 col-2">
                        <input class="form-check-input" type="checkbox" value="sekarang" name="diagnosis-keperawatan[]" id="defaultCheck1" />
                        <label class="form-check-label" for="defaultCheck1">
                            Pagi
                        </label>
                    </div>
                    <div class="mt-1 col-2">
                        <input class="form-check-input" type="checkbox" value="sekarang" name="diagnosis-keperawatan[]" id="defaultCheck1" />
                        <label class="form-check-label" for="defaultCheck1">
                            Sore
                        </label>
                    </div>
                    <div class="mt-1 col-2">
                        <input class="form-check-input" type="checkbox" value="sekarang" name="diagnosis-keperawatan[]" id="defaultCheck1" />
                        <label class="form-check-label" for="defaultCheck1">
                            Malam
                        </label>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Infus</label>
                <div class="col-sm-10 row">
                    <div class="mt-1 col-2">
                        <input class="form-check-input" type="checkbox" value="sekarang" name="diagnosis-keperawatan[]" id="defaultCheck1" />
                        <label class="form-check-label" for="defaultCheck1">
                            Pagi
                        </label>
                    </div>
                    <div class="mt-1 col-2">
                        <input class="form-check-input" type="checkbox" value="sekarang" name="diagnosis-keperawatan[]" id="defaultCheck1" />
                        <label class="form-check-label" for="defaultCheck1">
                            Sore
                        </label>
                    </div>
                    <div class="mt-1 col-2">
                        <input class="form-check-input" type="checkbox" value="sekarang" name="diagnosis-keperawatan[]" id="defaultCheck1" />
                        <label class="form-check-label" for="defaultCheck1">
                            Malam
                        </label>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Urine / Cath</label>
                <div class="col-sm-10 row">
                    <div class="mt-1 col-2">
                        <input class="form-check-input" type="checkbox" value="sekarang" name="diagnosis-keperawatan[]" id="defaultCheck1" />
                        <label class="form-check-label" for="defaultCheck1">
                            Pagi
                        </label>
                    </div>
                    <div class="mt-1 col-2">
                        <input class="form-check-input" type="checkbox" value="sekarang" name="diagnosis-keperawatan[]" id="defaultCheck1" />
                        <label class="form-check-label" for="defaultCheck1">
                            Sore
                        </label>
                    </div>
                    <div class="mt-1 col-2">
                        <input class="form-check-input" type="checkbox" value="sekarang" name="diagnosis-keperawatan[]" id="defaultCheck1" />
                        <label class="form-check-label" for="defaultCheck1">
                            Malam
                        </label>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">NGT</label>
                <div class="col-sm-10 row">
                    <div class="mt-1 col-2">
                        <input class="form-check-input" type="checkbox" value="sekarang" name="diagnosis-keperawatan[]" id="defaultCheck1" />
                        <label class="form-check-label" for="defaultCheck1">
                            Pagi
                        </label>
                    </div>
                    <div class="mt-1 col-2">
                        <input class="form-check-input" type="checkbox" value="sekarang" name="diagnosis-keperawatan[]" id="defaultCheck1" />
                        <label class="form-check-label" for="defaultCheck1">
                            Sore
                        </label>
                    </div>
                    <div class="mt-1 col-2">
                        <input class="form-check-input" type="checkbox" value="sekarang" name="diagnosis-keperawatan[]" id="defaultCheck1" />
                        <label class="form-check-label" for="defaultCheck1">
                            Malam
                        </label>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">DRAIN</label>
                <div class="col-sm-10 row">
                    <div class="mt-1 col-2">
                        <input class="form-check-input" type="checkbox" value="sekarang" name="diagnosis-keperawatan[]" id="defaultCheck1" />
                        <label class="form-check-label" for="defaultCheck1">
                            Pagi
                        </label>
                    </div>
                    <div class="mt-1 col-2">
                        <input class="form-check-input" type="checkbox" value="sekarang" name="diagnosis-keperawatan[]" id="defaultCheck1" />
                        <label class="form-check-label" for="defaultCheck1">
                            Sore
                        </label>
                    </div>
                    <div class="mt-1 col-2">
                        <input class="form-check-input" type="checkbox" value="sekarang" name="diagnosis-keperawatan[]" id="defaultCheck1" />
                        <label class="form-check-label" for="defaultCheck1">
                            Malam
                        </label>
                    </div>
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