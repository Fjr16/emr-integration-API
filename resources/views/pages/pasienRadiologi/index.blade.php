@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif
<div class="card p-3 mt-5">
    <div class="col-md-12">
        <h4 class="align-self-center m-0">
            Daftar Permintaan Radiologi
        </h4>
    </div>
  <hr class="m-0 mt-2 mb-3">
  <div class="table-responsive text-nowrap">
    <table id="example" class="table">
      <thead>
        <tr class="text-nowrap bg-dark">
          <th>No Rekam Medis</th>
          <th>Nama</th>
          <th>Kategori Pasien</th>
          <th>Jenis Kelamin</th>
          <th>Diagnosa Klinis</th>
          <th>Tanggal / Jam Permintaan</th>
          <th>Nama Pemeriksaan</th>
          <th>Dokter</th>
          @can('atur jadwal pemeriksaan radiologi')
          <th class="text-center">Action</th>
          @endcan
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $item)
          <tr>
            <td>{{ implode('-', str_split(str_pad($item->queue->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}</td>
            <td>{{ $item->queue->patient->name ?? '' }}</td>
            <td>{{ $item->queue->patientCategory->name ?? '' }}</td>
            <td>{{ $item->queue->patient->jenis_kelamin ?? '' }}</td>
            @if ($item->radiologiFormRequest)          
            <td>{!! $item->radiologiFormRequest->diagnosa_klinis ?? '' !!}</td>
            <td>{{ ($item->radiologiFormRequest->created_at != null) ?  $item->radiologiFormRequest->created_at->format('Y-m-d / H:i:s') : '' }}</td>
            @endif
            <td>
              @foreach ($item->radiologiPatientRequestDetails as $detail)
              {{ $detail->radiologiFormRequestDetail->radiologiFormRequestMaster->name ?? '' }} {{ $detail->radiologiFormRequestDetail->value ?? '' }} <br>
              @endforeach
            </td>
            <td>{{ $item->queue->doctorPatient->user->name ?? '' }}</td>
            @can('atur jadwal pemeriksaan radiologi')   
            <td>
              @if ($item->radiologiFormRequest->radiologiFormRequestMasters->isNotEmpty())    
                @if ($item->tanggal_periksa)    
                  <button type="button" class="btn btn-success btn-sm" disabled>
                    Terdaftar
                  </button>
                @else
                  <button type="button" class="btn btn-success btn-sm" onclick="createAntrian({{ $item->id }})">
                    Daftarkan
                  </button>
                @endif
              @else
                <a class="btn btn-success btn-sm" href="{{ route('radiologi/request.create', $item->radiologiFormRequest->id) }}">Edit Data</a>
              @endif
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