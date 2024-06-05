@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif
<div class="card p-3 mt-5">
  
  <div class="d-flex">
    <h4 class="align-self-center m-0">Daftar Variabel Pemeriksaan Radiologi</h4>
    <div class="ms-auto">
      <a href="{{ route('rajal/master/radiologi.index') }}" class="btn btn-success btn-sm m-0">Kembali</a>
    </div>
  </div>
  <hr class="m-0 mt-2 mb-3">
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr class="text-nowrap bg-dark">
          <th>No</th>
          <th>Kategori</th>
          <th>Nama Variabel</th>
          <th>Code ICD</th>
          <th>Tarif UC</th>
          <th>Tarif Umum</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $item)
        <tr>
          <th class="text-dark" scope="row">{{ $loop->iteration }}</th>
          <td>{{ $item->radiologiFormRequestMasterCategory->name ?? '-' }}</td>
          <td>{{ $item->name ?? '-' }}</td>
          <td>{{ $item->icd_code ?? '-' }}</td>
          <td>{{ $item->tarif_uc ?? '-' }}</td>
          <td>{{ $item->tarif_umum ?? '-' }}</td>
          <td>
              <a class="btn btn-sm btn-dark" href="{{ route('rajal/master/tarif/radiologi.edit', $item->id) }}">
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