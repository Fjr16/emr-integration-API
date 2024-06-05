@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif
@if (session()->has('error'))
      <div class="alert alert-danger w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('error') }}
      </div>
  @endif
<div class="card p-3 mt-5">
  
  <div class="d-flex">
    <h4 class="align-self-center m-0">Konsultasi</h4>
    <a href="{{ route('konsultasi.create') }}" class="btn btn-success ms-auto btn-sm m-0 mx-3">+ Tambah Konsultasi</a>
  </div>
  <hr class="m-0 mt-2 mb-3">
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr class="text-nowrap bg-dark">
          <th>No</th>
          <th>Dokter</th>
          <th>Poli</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($data as $item)
            <tr>
              <th class="text-dark" scope="row">{{ $loop->iteration }}</th>
              <td>{{ $item->name ?? '' }}</td>
              <td>{{ $item->roomDetail->name ?? '' }}</td>
              <td>
                <a class="btn btn-sm btn-dark" href="{{ route('konsultasi.show', $item->id) }}">
                    <i class="bx bx-show"></i>
                    Show
                </a>
            </td>
            </tr>
          @endforeach
        </tbody>
    </table>
  </div>
</div>
@endsection