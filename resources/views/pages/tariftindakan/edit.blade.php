@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif
<div class="card p-3 mt-5">
    <h4 class="">Daftar Tarif Tindakan <span class="text-primary">{{ $item->name }}</span></h4>
  </div>
<div class="card p-3 mt-3">
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr class="text-nowrap bg-dark">
            <th>No</th>
            <th>Status Pasien</th>
            <th>Tarif</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($item->actionRates as $rate)
          <form action="{{ route('action/rates.update', $rate->id) }}" method="POST">
            @method('PUT')
            @csrf
            <tr>
              <th scope="row" class="text-dark">{{ $loop->iteration }}</th>
              <td>{{ $rate->patientCategory->name }}</td>
              <td style="min-width: 150px"><input type="number" name="tarif" value="{{ $rate->tarif }}" class="form-control form-control-sm" id="basic-default-name" /></td>
              <td><button class="btn btn-dark btn-sm"><i class='bx bx-up-arrow-alt' ></i></button></td>
            </tr>
          </form>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection