@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif
<div class="card p-3 mt-5">
  
  <div class="d-flex">
    <h4 class="align-self-center m-0">Status Ranjang</h4>
  </div>
  <hr class="m-0 mt-2 mb-3">
  <div class="table-responsive text-nowrap">
    <table class="table" id="example">
      <thead>
        <tr class="text-nowrap bg-dark">
          <th>No</th>
          <th>Nama</th>
          <th>Tipe Ranjang</th>
          <th>Kamar</th>
          <th>Lantai</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($data as $item)
          <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $item->name ?? '' }}</td>
            <td>{{ $item->bedroomType->name ?? '' }}</td>
            <td>{{ $item->bedroom->name ?? ''}}</td>
            <td>{{ $item->bedroom->floor->name ?? '' }}</td>
            <td>{{ $item->isAvailable ? 'Tersedia' : 'Tidak Tersedia' }}</td>
            
          </tr>
          @endforeach
        </tbody>
    </table>
  </div>
</div>
@endsection