@extends('layouts.backend.main')

@section('content')
  @if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif
<div class="card p-3 mt-5">
    <h4 class="">Tarif Ranjang</h4>
    <hr class="m-0 mt-2 mb-3">
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr class="text-nowrap bg-dark">
            <th>No</th>
            <th>Status Pasien</th>
            <th>Rawatan</th>
            <th>Tindakan</th>
            <th>Adm</th>
            <th>Visite</th>
            <th>Labor</th>
            <th>BHP</th>
            <th>Coshering</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($bed->bedroomRate as $tarif)
          <form action="{{ route('kamar/ranjang/tarif.update', $tarif->id) }}" method="POST">
            @method('PUT')
            @csrf
            <tr>
              <th scope="row">{{ $loop->iteration }}</th>
              <th>{{ $tarif->patientCategory->name }}</th>
              <td style="min-width: 150px"><input type="number" name="rawatan" class="form-control form-control-sm" id="basic-default-name" value="{{ $tarif->rawatan }}"/></td>
              <td style="min-width: 150px"><input type="number" name="tindakan" class="form-control form-control-sm" id="basic-default-name" value="{{ $tarif->tindakan }}"/></td>
              <td style="min-width: 150px"><input type="number" name="adm" class="form-control form-control-sm" id="basic-default-name" value="{{ $tarif->adm }}"/></td>
              <td style="min-width: 150px"><input type="number" name="visite" class="form-control form-control-sm" id="basic-default-name" value="{{ $tarif->visite }}"/></td>
              <td style="min-width: 150px"><input type="number" name="labor" class="form-control form-control-sm" id="basic-default-name" value="{{ $tarif->labor }}"/></td>
              <td style="min-width: 150px"><input type="number" name="bhp" class="form-control form-control-sm" id="basic-default-name" value="{{ $tarif->bhp }}"/></td>
              <td style="min-width: 150px"><input type="number" name="coshering" class="form-control form-control-sm" id="basic-default-name" value="{{ $tarif->coshering }}"/></td>
              <td><button type="submit" class="btn btn-dark btn-sm"><i class='bx bx-up-arrow-alt'></i></button></td>
            </tr>
          </form>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection