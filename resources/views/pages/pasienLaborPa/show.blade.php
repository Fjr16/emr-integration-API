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
<div class="card mb-4" id="hasilPemeriksaan">
    <div class="card-header">
      <h5 class="mb-0">Hasil Pemeriksaan</h5>
    </div>
    <div class="card-body">
        <table class="w-100 mb-3">
            <tbody>
              <tr>
                <td style="width: 150px">Nama</td>
                <td style="width: 30px">:</td>
                <td>{{ $item->permintaanLaboratoriumPatologiAnatomikPatient->queue->patient->name }}</td>
              </tr>
              <tr>
                <td >No RM</td>
                <td >:</td>
                <td>{{ $item->permintaanLaboratoriumPatologiAnatomikPatient->queue->patient->no_rm }}</td>
              </tr>

            </tbody>
          </table>
          <div class="table-responsive text-nowrap">
            <table class="table">
              <thead>
                <tr class="text-nowrap bg-dark">
                  <th>No</th>
                  <th>Petugas Laboratorium</th>
                  <th>Tanggal Periksa</th>
                  <th>Jenis Pemeriksaan</th>
                  <th>Status</th>
                  <th>Category</th>
                  <th>Hasil</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($item->detailAntrianLaboratoriumPatologiAnatomiPatient as $detail)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $item->user->name }}</td>
                  <td>{{ $item->tgl_diperiksa }}</td>
                  <td>{{ $detail->name }}</td>
                      @php
                          $status = '';  
                          $detail->status == 'Unvalidate' ? $status = 'Validated' : $status = 'Unvalidate' ;
                      @endphp
                  <td>
                    <form action="{{ route('permintaan/laboratorium/patologi/anatomik.updateStatus', $detail->id) }}" method="POST">
                      @csrf
                      @method('PUT')
                      <input type="text" name="status" value="{{ $status }}" hidden>
                      <button type="submit" class="btn btn-sm {{ $detail->status == 'Unvalidate' ? 'btn-danger' : 'btn-success' }}" >
                            {{ $detail->status }}
                      </button>
                    </form>
                  </td>
                  @php
                      $status = $detail->name;
                      $splitStatus = explode(' ', $status);
                      $category = end($splitStatus);
                  @endphp
                  <td>{{ $category }}</td>
                  <td>
                    @php
                        $routeCreate = '';
                        $routeEdit = '';
                        if ($category == 'HISTOPATOLOGI') {
                          $routeCreate = 'permintaan/laboratorium/patologi/anatomik.createHistopatologi';
                          $routeEdit = 'permintaan/laboratorium/patologi/anatomik.editHistopatologi';
                        } else {
                          $routeCreate = 'permintaan/laboratorium/patologi/anatomik.createSitopatologi';
                          $routeEdit = 'permintaan/laboratorium/patologi/anatomik.editSitopatologi';
                        }
                    @endphp
                    <a href="{{ route($routeCreate, $detail->id) }}" class="btn {{ $detail->hasilHistopatologiPatient || $detail->hasilSitopatologiPatient  !== null ? 'disabled' : ''  }} btn-sm btn-success">Input</a>
                    <a href="{{ route($routeEdit, $detail->id) }}" class="btn {{ $detail->hasilHistopatologiPatient || $detail->hasilSitopatologiPatient  !== null ? '' : 'disabled'  }} btn-sm btn-secondary">edit</a>
                    <a href="" class="btn btn-sm btn-primary">Show</a>
                  </td>
                  <td class="text-center">
                    @php
                        $route = '';
                        if ($category == 'HISTOPATOLOGI') {
                          $route = 'permintaan/laboratorium/patologi/anatomik.showHistopatologi';
                        } else {
                          $route = 'permintaan/laboratorium/patologi/anatomik.showSitopatologi';
                        }
                    @endphp
                    <a class="btn btn-dark btn-sm {{ $detail->hasilHistopatologiPatient || $detail->hasilSitopatologiPatient  !== null ? '' : 'disabled'  }}" href="{{ route($route, $detail->id) }}">
                        <i class='bx bx-printer me-1'></i>
                      </a>
                  </td>
                </tr>
                @endforeach
                </tbody>
            </table>
          </div>
    </div>
  </div>
@endsection
