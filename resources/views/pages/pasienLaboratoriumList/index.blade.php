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
            Daftar Permintaan Laboratorium PK
        </h4>
    </div>
  <hr class="m-0 mt-2 mb-3">
  <div class="table-responsive text-nowrap">
    <table id="example" class="table">
      <thead>
        <tr class="text-nowrap bg-dark">
          <th>Kategori Permintaan</th>
          <th>No Rekam Medis</th>
          <th>Nama</th>
          <th>Kategori Pasien</th>
          <th>Ruangan</th>
          <th>Detail Ruangan</th>
          <th>Diagnosa Klinis</th>
          <th>Tanggal / Jam Permintaan</th>
          @can('atur jadwal pemeriksaan laboratorium pk')
          <th class="text-center">Action</th>
          @endcan
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $item)    
        <tr class="{{ $item->laboratoriumRequest->laboratoriumRequestTypeMaster->isPrioritas == true ? 'text-danger' : '' }}">
          <td>{{ $item->laboratoriumRequest->laboratoriumRequestTypeMaster->name ?? '-' }}</td>
          <td>{{ implode('-', str_split(str_pad($item->queue->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}</td>
          <td>{{ $item->queue->patient->name ?? '-' }}</td>
          <td>{{ $item->queue->patientCategory->name ?? '-' }}</td>
          <td>{{ $item->laboratoriumRequest->roomDetail->room->name ?? '-' }}</td>
          <td>{{ $item->laboratoriumRequest->roomDetail->name ?? '-' }}</td>
          <td>{!! $item->laboratoriumRequest->diagnosa ?? '-' !!}</td>
          <td>{{ $item->laboratoriumRequest->created_at->format('Y-m-d / H:i:s') ?? '-' }}</td>
          @can('atur jadwal pemeriksaan laboratorium pk')  
          <td>
            @if ($item->laboratoriumRequest->laboratoriumRequestDetails->isNotEmpty())
              @if ($item->tanggal_periksa)
                <button class="btn btn-success btn-sm" disabled>
                  Terdaftar
                </button>
              @else
                <button class="btn btn-success btn-sm" onclick="createAntrian({{ $item->id }})">
                  Daftarkan
                </button>
              @endif
            @else
                <a class="btn btn-success btn-sm" href="{{ route('laboratorium/PK/request.create', $item->laboratoriumRequest->id) }}">Edit Data</a>
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
      url : "{{ route('laboratorium/patient/queue.create', '') }}/"+id,
      success : function(data){
        $('#basicModal').html(data);
        $('#basicModal').modal('show');
      }
    })
  }
</script>
@endsection

