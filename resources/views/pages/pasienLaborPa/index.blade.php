@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif
<div class="card p-3 mt-5">
  <div class="row">
    <div class="col-8">
      <h4 class="align-self-center m-0">
          Antrian Pasien Laboratorium <span class="text-primary">{{ $filter ?? '' }}</span>
      </h4>
    </div>
    <div class="col-3">
      <form action="{{ route('laboratorium/patient/queue.index') }}" method="GET">
        <div class="row">
          <label class="col-form-label col-3"></label>
          <div class="col-9">
            <input type="date" id="tanggal" name="filter" value="{{ request('filter') }}" class="form-control">
          </div>
        </div>
      </div>
      <div class="col-1">
        <button type="submit" class="btn btn-primary">Filter</button>
      </div>
      <div class="col-1">
        <a class="btn text-white btn-primary btn-sm" href="{{ route('permintaan/laboratorium/patologi/anatomik/clear') }}">Clear</a>
      </div>
    </form>

  </div>
  <hr class="m-0 mt-2 mb-3">
  <div class="table-responsive text-nowrap">
    <table id="example" class="table">
      <thead>
        <tr class="text-nowrap bg-dark">
          <th>No Antrian</th>
          <th>No Rekam Medis</th>
          <th>Nama</th>
          <th>Kategori Pasien</th>
          <th>Ruangan</th>
          <th>No. Labor</th>
          <th>Validator Laboratorium</th>
          <th>Tanggal Periksa</th>
          <th>Status</th>
          <th class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $item)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $item->permintaanLaboratoriumPatologiAnatomikPatient->queue->patient->no_rm }}</td>
          <td>{{ $item->permintaanLaboratoriumPatologiAnatomikPatient->queue->patient->name }}</td>
          <td>{{ $item->permintaanLaboratoriumPatologiAnatomikPatient->queue->patientCategory->name }}</td>
          <td>{{ $item->permintaanLaboratoriumPatologiAnatomikPatient->user->roomDetail->name ?? '' }}</td>
          <td>{{ $item->id }}</td>
          <td>Dr. Ucok Hasibuan, Sp.PA</td>
          <td>{{ $item->permintaanLaboratoriumPatologiAnatomikPatient->antrianLaboratoriumPatologiAnatomiPatient->tgl_diperiksa }}</td>
          @php
              $validate = 'Unvalidate';
              $itemAll = $item->detailAntrianLaboratoriumPatologiAnatomiPatient->count();
              $itemUnvalidate = $item->detailAntrianLaboratoriumPatologiAnatomiPatient->where('status', 'Unvalidate')->count();
              if($itemUnvalidate == 0){
                $validate = 'Validated';
              }
          @endphp
          @if ($validate == 'Unvalidate')
          <td>{{ $itemAll - $itemUnvalidate }} / {{ $itemAll }}</td>
          @else
          <td>{{ $validate }}</td>
          @endif
          <td class="text-center">
            <a class="btn btn-dark btn-sm" href="{{ route('permintaan/laboratorium/patologi/anatomik.show', $item->id) }}">
                <i class='bx bx-show-alt me-1'></i>
                  show
              </a>
          </td>
        </tr>
        @endforeach
        </tbody>
    </table>
  </div>
</div>
{{-- modal --}}
<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">

</div>
@endsection

