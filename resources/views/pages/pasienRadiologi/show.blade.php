@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif
  <div class="card">
    <div class="card-header">
      <h5 class="m-0">Hasil Permintaan Radiologi Pasien
        <span class="text text-primary text-uppercase fw-bold fs-7">{{ $item->queue->patient->name ?? ''}} ({{ implode('-', str_split(str_pad($item->queue->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }})</span>
      </h5>
    </div>
    <div class="card-body">
      <table class="table">
        <thead>
          <tr class="text-nowrap bg-dark">
            <th>No</th>
            <th>Jenis Pemeriksaan</th>
            <th>Nama Pemeriksaan</th>
            <th>Tanggal / Jam</th>
            <th>Status</th>
            <th>Hasil Gambar</th>
            @canany(['input hasil pemeriksaan radiologi', 'print hasil pemeriksaan radiologi'])
            <th>Action</th>
            @endcanany
          </tr>
        </thead>
        <tbody>
          @foreach ($item->radiologiPatientRequestDetails as $detail)    
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $detail->radiologiFormRequestDetail->radiologiFormRequestMaster->radiologiFormRequestMasterCategory->name ?? '' }}</td>
            <td>{{ $detail->radiologiFormRequestDetail->radiologiFormRequestMaster->name ?? '' }} {{ $detail->radiologiFormRequestDetail->value ?? '' }}</td>
            <td>{{ $detail->tanggal ?? '-' }}</td>
            <td>{{ $detail->status ?? '-' }}</td>
            <td>
              <a href="{{ Storage::url($detail->image) }}" target="_blank">
                <img src="{{ Storage::url($detail->image) }}" alt="{{ $detail->image ?? '' }}" width="100" height="100">
              </a>
            </td>
            @canany(['input hasil pemeriksaan radiologi', 'print hasil pemeriksaan radiologi'])
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                    data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                  @can('input hasil pemeriksaan radiologi')  
                  <button class="dropdown-item" onclick="createHasil({{ $detail->id }})">
                      <i class="bx bx-cloud-upload me-1"></i>
                      Edit
                  </button>
                  @endcan
                  @can('print hasil pemeriksaan radiologi')  
                  <a class="dropdown-item" href="{{ route('radiologi/patient/hasil.show', $detail->id) }}">
                      <i class="bx bx-printer me-1"></i>
                      Print
                  </a>
                  @endcan
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

  {{-- modal input hasil --}}
  <div class="modal fade" id="largeModal" tabindex="-1" aria-hidden="true">

  </div>
  {{-- /modal input hasil --}}
  
  <script>
    function createHasil(id){
      $.ajax({
        type : 'get',
        url : "{{ route('radiologi/patient/hasil.edit', '') }}/"+id,
        success : function(data){
          var div = document.createElement('div');
          div.className = 'modal-dialog modal-lg';
          div.innerHTML = data;

          $('#largeModal').html(div);
          $('#largeModal').modal('show');
        }
      });
    }
  </script>

@endsection