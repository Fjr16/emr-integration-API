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
    <div class="row">
      <div class="col-8">
        <h4 class="align-self-center m-0">
            Antrian Pasien Radiologi <span class="text text-primary">{{ $filter ?? '' }}</span>
        </h4>
      </div>
      <div class="col-3">
        <form action="{{ route('radiologi/patient/queue.index') }}" method="GET">
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
          <th>Jenis Kelamin</th>
          <th>Diagnosa</th>
          <th>Tanggal Periksa</th>
          <th>Petugas</th>
          <th>Validator</th>
          <th>Status</th>
          @canany(['edit jadwal pemeriksaan radiologi', 'validasi status pemeriksaan radiologi'])
          <th>Action</th>
          @endcanany
          @can('show detail pemeriksaan radiologi')
          <th class="text-center">Detail</th>
          @endcan
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $item)
        <tr>
          <td>{{ $item->no_antrian ?? '' }}</td>
          <td>{{ implode('-', str_split(str_pad($item->queue->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}</td>
          <td>{{ $item->queue->patient->name ?? '' }}</td>
          <td>{{ $item->queue->patientCategory->name ?? '' }}</td>
          <td>{{ $item->queue->patient->jenis_kelamin ?? '' }}</td>
          <td>{!! $item->radiologiFormRequest->diagnosa_klinis ?? '' !!}</td>
          <td>{{ $item->tanggal_periksa ?? '-' }}</td>
          <td>{{ $item->radiologiPatientRequestDetails->first()->user->name ?? '-' }}</td>
          <td>{{ $item->user->name ?? '-' }}</td>
          <td>{{ $item->status ?? '' }}</td>
          @canany(['edit jadwal pemeriksaan radiologi', 'validasi status pemeriksaan radiologi'])
          <td>
            @if ($item->status == 'WAITING')
              <button class="btn btn-success btn-sm" onclick="createAntrian({{ $item->id }})">
                <i class='bx bx-edit-alt me-1'></i>
                Edit Jadwal
              </button>
            @elseif ($item->status == 'UNVALIDATED')                
              <form action="{{ route('radiologi/patient/queue.update', $item->id) }}" method="POST" disabled>
                @method('PUT')
                @csrf
                <button type="submit" class="btn btn-success btn-sm">
                  <i class='bx bx-check'></i>
                  Validasi
                </button>
              </form>
            @else               
              {{ $item->status ?? '' }}
            @endif
          </td>
          @endcanany
          @can('show detail pemeriksaan radiologi')
          <td>
            <a class="btn btn-dark btn-sm" href="{{ route('radiologi/patient.create', $item->id) }}">
              <i class='bx bx-show-alt me-1'></i>
                show
            </a>
          </td>
          @endcan
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
</div>

{{-- modal --}}
<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
  
</div>
{{-- /modal --}}

<script>
  function createAntrian(id){
    $.ajax({
      type : 'GET',
      url : "{{ route('radiologi/patient/queue.create', '') }}/"+id,
      success : function(data){
        $('#basicModal').html(data);
        $('#basicModal').modal('show');
      }
    })
  }
</script>
@endsection



