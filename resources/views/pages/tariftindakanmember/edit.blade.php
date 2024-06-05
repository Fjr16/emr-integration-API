@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif
<div class="card p-3 mt-5">
    <h4 class="">Daftar Tarif</h4>
    <hr class="m-0 mt-2 mb-3">
    <h6 class="">Entri Tarif Tindakan Semua Status Pasien</h6>
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr class="text-nowrap bg-dark">
            <th>No</th>
            <th>Nama Tindakan</th>
            <th>Tarif Umum</th>
            <th>Unit Cost</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <form action="{{ route('action/members.update', $item->id) }}" method="POST">
            @method('PUT')
            @csrf
          <tr>
            <th scope="row">1</th>
            <td>{{ $item->name }}</td>
            <td style="min-width: 150px"><input type="number" name="tarif_umum" class="form-control form-control-sm" id="basic-default-name" value="{{ $item->tarif_umum }}"/></td>
            <td style="min-width: 150px"><input type="number" name="tarif_uc" class="form-control form-control-sm" id="basic-default-name" value="{{ $item->tarif_uc }}"/></td>
            <td><button class="btn btn-dark btn-sm"><i class='bx bx-up-arrow-alt' ></i></button></td>
          </tr>
        </form>
        </tbody>
      </table>
    </div>
  </div>
<div class="card p-3 mt-3">
    <h6 class="">Entri Tarif Tindakan Berdasarkan Status Pasien</h6>
    <h6 class="">Nama Tindakan : <span class="text-primary">{{ $item->name }}</span></h6>
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr class="text-nowrap bg-dark">
            <th>No</th>
            <th>Status Pasien</th>
            <th>Tarif Umum</th>
            <th>Unit Cost</th>
            <th>Jasa Dokter</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($item->actionMemberRates as $rate)
          <form action="{{ route('action/members/rates.update', $rate->id) }}" method="POST">
            @method('PUT')
            @csrf
            <tr>
              <th scope="row">{{ $loop->iteration }}</th>
              <td>{{ $rate->patientCategory->name }}</td>
              <td style="min-width: 150px"><input type="number" name="tarif_umum" value="{{ $rate->tarif_umum }}" class="form-control form-control-sm" id="basic-default-name" /></td>
              <td style="min-width: 150px"><input type="number" name="tarif_uc" value="{{ $rate->tarif_uc }}" class="form-control form-control-sm" id="basic-default-name" /></td>
              <td style="min-width: 150px"><input type="number" name="jasa_dokter" value="{{ $rate->jasa_dokter }}" class="form-control form-control-sm" id="basic-default-name" /></td>
              <td><button class="btn btn-dark btn-sm"><i class='bx bx-up-arrow-alt' ></i></button></td>
            </tr>
          </form>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection