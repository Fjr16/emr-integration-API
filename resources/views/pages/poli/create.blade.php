@extends('layouts.backend.main')

@section('content')
@if (session()->has('success'))
<div class="alert alert-success d-flex" role="alert">
    <span class="alert-icon rounded-circle"><i class='bx bxs-check-circle' style="font-size: 40px"></i></span>
    <div class="d-flex flex-column ps-1">
        <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">BERHASIL !!</h6>
        <span>{{ session('success') }}</span>
    </div>
</div>
@endif
@if (session()->has('error'))
<div class="alert alert-danger d-flex" role="alert">
    <span class="alert-icon rounded-circle"><i class='bx bxs-x-circle' style="font-size: 40px"></i></span>
    <div class="d-flex flex-column ps-1">
        <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">ERROR !!</h6>
        <span>{{ session('error') }}</span>
    </div>
</div>
@endif
@if (session()->has('exceptions'))
<div class="alert alert-danger d-flex" role="alert">
    <span class="alert-icon rounded-circle"><i class='bx bxs-x-circle' style="font-size: 40px"></i></span>
    <div class="d-flex flex-column ps-1">
        <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">ERROR !!</h6>
        <span>
          @foreach (session('exceptions') as $error)
            <li>{{ $error }}</li>
          @endforeach
        </span>
    </div>
</div>
@endif
@if ($errors->any())
<div class="alert alert-danger d-flex" role="alert">
    <span class="alert-icon rounded-circle"><i class='bx bxs-x-circle' style="font-size: 40px"></i></span>
    <div class="d-flex flex-column ps-1">
        <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">ERROR !!</h6>
        <span>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </span>
    </div>
</div>
@endif
{{-- @dd(session()->all()); --}}
<div class="card mb-4">
  <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0 fw-bold">Tambah Poliklinik</h5>
  </div>
  <div class="card-body">
    <form method="POST" action="{{ route('poliklinik.store') }}">
        @csrf
        <div class="row mb-3">
            <div class="col-sm-12 mb-4">
                <label class="form-label" for="basic-default-name">Nama</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" placeholder="Nama Poli" required />
            </div>
            <div class="col-sm-6">
                <label class="form-label" for="basic-default-name">Kode Poli</label>
                <input type="text" name="kode" class="form-control" id="kode" value="{{ old('kode') }}" placeholder="Kode Poli" required />
            </div>
            <div class="col-sm-6">
                <label class="form-label" for="basic-default-name">Kode Antrian</label>
                <input type="text" name="kode_antrian" class="form-control" id="kode_antrian" value="{{ old('kode_antrian') }}" placeholder="Kode Antrian" required />
            </div>
        </div>
        <hr class="mb-4">
        <div class="row justify-content-start">
            <div class="col-sm-4 text-start">
                <button type="submit" class="btn btn-outline-primary">Submit</button>
            </div>
        </div>
    </form>
  </div>
</div>
@endsection