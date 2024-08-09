@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif
<div class="card p-3 mt-5">
  <div class="d-flex">
    <h4 class="align-self-center m-0">Daftar Pasien</h4>
  </div>
  <hr class="m-0 mt-2 mb-3">
  <div class="table-responsive text-nowrap">
    <table class="table" id="example">
      <thead>
        <tr class="text-nowrap bg-dark">
          <th>No</th>
          <th>No Rekam Medis</th>
          <th>NIK</th>
          <th>Nama</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $item)
          <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $item->no_rm ?? ''}}</td>
              <td>{{ $item->nik ?? '' }}</td>
              <td>{{ $item->name ?? '' }}</td>
              <td><a class="btn btn-dark btn-sm" href="{{ route('rekam/medis/elektronik.show', $item->id) }}"><i class="bx bx-show me-1"></i>show</a></td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection

