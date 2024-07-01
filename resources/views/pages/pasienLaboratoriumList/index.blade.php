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
          @can('atur jadwal pemeriksaan laboratorium pk')
          <th class="text-center">Action</th>
          @endcan
          <th>Kategori Permintaan</th>
          <th>No Rekam Medis</th>
          <th>Nama</th>
          <th>Tanggungan</th>
          <th>Diagnosa Klinis</th>
          <th>Tanggal / Jam Permintaan</th>
          <th>Dokter</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $item)    
        <tr class="{{ $item->tipe_permintaan == 'Urgent' ? 'text-danger' : '' }}">
          <td>
            @if ($item->laboratoriumRequestDetails)    
              @if ($item->status == 'WAITING')    
                <div class="dropdown">
                  <button type="button" class="btn bth-sm btn-dark dropdown-toggle hide-arrow"
                      data-bs-toggle="dropdown">
                      Action
                      <i class='bx bx-dots-vertical'></i>
                  </button>
                  <div class="dropdown-menu">
                    <button type="button" class="dropdown-item btn-success" onclick="createAntrian({{ $item->id }})">
                      Terima
                    </button>
                    <form action="{{ route('laboratorium/patient/queue.store', $item->id) }}" method="POST">
                      @csrf
                      <button type="submit" class="dropdown-item btn-danger" name="status" value="CANCEL" onclick="return confirm('Yakin Ingin Membatalkan Permintaan Radiologi ?')">
                        Batal
                      </button>
                      <button type="submit" class="dropdown-item btn-warning" name="status" value="DENIED" onclick="return confirm('Yakin Ingin Menolak Permintaan Radiologi ?')">
                        Tolak
                      </button>
                    </form>
                  </div>
                </div>
              @else
                @php
                  if ($item->status == 'DENIED') {
                    $classBg = 'warning';
                  } elseif($item->status == 'CANCEL') {
                    $classBg = 'danger';
                  } else {
                    $classBg = 'success';
                  }
                @endphp
                <button type="button" class="btn btn-{{ $classBg }} btn-sm" disabled>
                  {{ $item->status }}
                </button>
              @endif
            @else
              <a class="btn btn-success btn-sm" href="{{ route('laboratorium/PK/request.create', $item->laboratoriumRequest->id) }}">Edit Data</a>
            @endif
          </td>
          <td>{{ $item->tipe_permintaan ?? '-' }}</td>
          <td>{{ implode('-', str_split(str_pad($item->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}</td>
          <td>{{ $item->patient->name ?? '-' }}</td>
          <td>{{ $item->queue->patientCategory->name ?? '-' }}</td>
          <td>{!! $item->diagnosa ?? '-' !!}</td>
          <td>{{ $item->created_at->format('Y-m-d / H:i:s') ?? '-' }}</td>
          <td>{{ $item->user->name ?? '-' }}</td>
        </tr>
        @endforeach

        </tbody>
    </table>
  </div>
</div>

{{-- modal --}}
  <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
    <form action="" method="POST">
      @csrf
      <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel1">Atur Jadwal Pemeriksaan</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col mb-3">
                  <label for="tanggal" class="form-label">Tanggal</label>
                  <input type="date" id="tanggal" name="tanggal" value="{{ date('Y-m-d') }}" class="form-control">
                  <input type="hidden" name="status" value="ACCEPTED">
                </div>
              </div>
              
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-dark btn-sm">Simpan</button>
            </div>
          </div>
      </div>
    </form>
  </div>
{{-- /modal --}}

<script>
  function createAntrian(id){
    var modalCreate = document.getElementById('basicModal');
    var form = modalCreate.querySelector('form');
    var url = "{{ route('laboratorium/patient/queue.store', '') }}/"+id;
    form.setAttribute('action', url);

    $(modalCreate).modal('show');
  }
</script>
@endsection

