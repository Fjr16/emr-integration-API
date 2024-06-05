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
    <h4 class="align-self-center m-0">Return Obat</h4>
  </div>
  <hr class="m-0 mt-2 mb-3">
  <div class="table-responsive text-nowrap">
    <table class="table" id="example">
      <thead>
        <tr class="text-nowrap bg-dark">
          <th>No</th>
          <th>Nama Suplier</th>
          <th>Alamat</th>
          <th>Telp</th>
          <th>Faktur</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $item)
        <tr>
          <th scope="row">{{ $loop->iteration }}</th>
          <td>{{ $item->name }}</td>
          <td>{{ $item->alamat }}</td>
          <td>{{ $item->telp }}</td>
          <td>
            {{ count($item->invoices->where('status', 'RETURN')) }}
            <a href="{{ route('farmasi/obat/return/faktur.index', $item->id) }}">
              <i class='bx bxs-file-doc' ></i>
            </a>
          </td>
          
        </tr>
        @endforeach
        </tbody>
    </table>
  </div>
</div>
@endsection