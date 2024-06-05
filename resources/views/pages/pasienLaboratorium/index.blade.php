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
          Antrian Pasien Laboratorium PK <span class="text-primary">{{ $filter ?? '' }}</span>
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
    </form>

  </div>
  <hr class="m-0 mt-2 mb-3">
  <div class="table-responsive text-nowrap">
    <table id="example" class="table">
      <thead>
        <tr class="text-nowrap bg-dark">
          <th>Kategori Permintaan</th>
          <th>No Antrian</th>
          <th>No Rekam Medis</th>
          <th>Nama</th>
          <th>Kategori Pasien</th>
          <th>Ruangan</th>
          <th>Detail Ruangan</th>
          <th>Diagnosa</th>
          <th>No. Labor</th>
          <th>Petugas Laboratorium</th>
          <th>Validator Laboratorium</th>
          <th>Tanggal Periksa</th>
          <th>Status</th>
          @can('validasi status pemeriksaan laboratorium pk')
          <th>Validasi</th>
          @endcan
          @canany(['input hasil pemeriksaan laboratorium pk', 'edit hasil pemeriksaan laboratorium pk', 'edit jadwal pemeriksaan laboratorium pk', 'print hasil pemeriksaan laboratorium pk'])
          <th class="text-center">Action</th>
          @endcanany
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $item)    
        <tr class="{{ $item->laboratoriumRequest->laboratoriumRequestTypeMaster->isPrioritas == true ? 'text-danger' : '' }}">
          <td>{{ $item->laboratoriumRequest->laboratoriumRequestTypeMaster->name ?? '-' }}</td>
          <td>{{ $item->nomor_antrian_lab ?? '-' }}</td>
          <td>{{ implode('-', str_split(str_pad($item->queue->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}</td>
          <td>{{ $item->queue->patient->name ?? '-' }}</td>
          <td>{{ $item->queue->patientCategory->name ?? '-' }}</td>
          <td>{{ $item->laboratoriumRequest->ruang ?? '-' }}</td>
          <td>{{ $item->laboratoriumRequest->roomDetail->name ?? '-' }}</td>
          <td>{!! $item->laboratoriumRequest->diagnosa ?? '-' !!}</td>
          <td>{{ $item->nomor_reg_lab ?? '-' }}</td>
          <td>{{ $item->user->name ?? '-' }}</td>
          <td>{{ $item->laboratoriumUserValidator->user->name ?? '-' }}</td>
          <td>{{ $item->tanggal_periksa ?? '-' }}</td>
          <td>{{ $item->status ?? '-' }}</td>
          @can('validasi status pemeriksaan laboratorium pk')  
          <td>
            <form action="{{ route('laboratorium/patient/queue.update', $item->id) }}" method="POST">
              @method('PUT')
              @csrf
              <button type="submit" class="btn btn-success btn-sm" {{ $item->status == 'VALIDATED' ? 'disabled' : '' }}>
                    <i class="bx bx-check"></i>
                    Validasi
              </button>
            </form>
          </td>
          @endcan
          @canany(['input hasil pemeriksaan laboratorium pk', 'edit hasil pemeriksaan laboratorium pk', 'edit jadwal pemeriksaan laboratorium pk', 'print hasil pemeriksaan laboratorium pk'])    
          <td class="text-center">
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                  data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu">
                @if ($item->status == 'WAITING')
                  @can('input hasil pemeriksaan laboratorium pk')                    
                  <a class="dropdown-item" href="{{ route('laboratorium/patient/hasil.create', $item->id) }}">
                      <i class="bx bx-cloud-upload me-1"></i>
                      Input Hasil
                  </a>
                  @endcan
                  @can('edit jadwal pemeriksaan laboratorium pk')  
                  <button class="dropdown-item" onclick="createAntrian({{ $item->id }})">
                      <i class="bx bx-edit-alt me-1"></i>
                      Reschedule
                  </button>
                  @endcan
                @endif
                @if ($item->status == 'UNVALIDATED' || $item->status == 'VALIDATED')
                  @can('edit hasil pemeriksaan laboratorium pk')  
                  <a class="dropdown-item" href="{{ route('laboratorium/patient/hasil.edit', $item->id) }}">
                      <i class="bx bx-edit-alt me-1"></i>
                      Edit
                  </a>
                  @endcan
                  @can('print hasil pemeriksaan laboratorium pk')  
                  <a class="dropdown-item" target="blank" href="{{ route('laboratorium/patient/hasil.show', $item->id) }}">
                      <i class="bx bx-printer me-1"></i>
                      Print
                  </a>
                  @endcan
                @endif
              </div>
            </div>
          </td>
          @endcanany
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

