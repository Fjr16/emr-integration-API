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
          Antrian Pasien Laboratorium PK <span class="text-primary">{{ $filter ?? '' }}</span>
      </h4>
    </div>
    <div class="col-3">
      <form action="{{ route('laboratorium/patient/queue.index') }}" method="GET">
        <div class="row">
          <label class="col-form-label col-3"></label>
          <div class="col-9">
            <input type="date" id="tanggal" name="filter" value="{{ request('filter', date('Y-m-d')) }}" class="form-control">
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
          <th class="text-center">Action</th>
          <th class="text-center">Status</th>
          <th>Tanggal Periksa</th>
          <th>No Reg</th>
          <th>Kategori</th>
          <th>Diagnosa</th>
          <th>No RM / Nama</th>
          <th>Tanggungan</th>
          <th>Petugas</th>
          <th>Validator</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $item)    
        <tr class="{{ $item->tipe_permintaan == 'Urgent' ? 'text-danger' : '' }}">
          <td class="text-center d-flex">
            @if ($item->status != 'FINISHED')
              <div class="btn-group dropup">
                <button type="button" class="btn bth-sm btn-dark dropdown-toggle hide-arrow py-1 px-2" data-bs-toggle="dropdown"> <small>Action <i class='bx bx-dots-vertical'></i></small></button>
                <div class="dropdown-menu">      
                  @if ($item->status == 'ACCEPTED')
                    <button class="dropdown-item" onclick="createAntrian({{ $item->id }})">
                      <i class='bx bx-edit-alt'></i>
                      Reschedule
                    </button>
                    <a class="dropdown-item" href="{{ route('laboratorium/patient/hasil.create', $item->id) }}">
                      <i class="bx bx-cloud-upload"></i>
                      Input Hasil
                    </a>
                  @elseif ($item->status == 'UNVALIDATE')                
                    <form action="{{ route('laboratorium/patient/queue.update', $item->id) }}" method="POST">
                      @method('PUT')
                      @csrf
                      <button type="submit" class="dropdown-item" value="FINISHED">
                        <i class='bx bx-check'></i>
                        Validasi
                      </button>
                    </form>
                    <a class="dropdown-item" href="{{ route('laboratorium/patient/hasil.create', $item->id) }}">
                      <i class="bx bx-edit-alt me-1"></i>
                      Edit
                    </a>
                  @endif
                </div>
              </div>
            @else
            <a class="btn btn-sm btn-success pt-2 ms-1" target="blank" href="{{ route('laboratorium/patient/hasil.show', $item->id) }}">
              <i class="bx bx-printer me-1"></i>
              Print
            </a>
            @endif
          </td>
          <td>
            <button class="btn {{ $item->status == 'FINISHED' ? 'btn-success' : 'btn-danger' }} btn-sm" disabled>
              {{ $item->status ?? '' }}
            </button>
          </td>
          @php
            $waktu = new Carbon\Carbon($item->jadwal_periksa);
          @endphp
          <td>{{ $waktu->format('Y-m-d') ?? '-' }}</td>
          <td>{{ $item->no_reg ?? '-' }}</td>
          <td>{{ $item->tipe_permintaan ?? '-' }}</td>
          <td>{!! $item->diagnosa ?? '-' !!}</td>
          <td>{{ implode('-', str_split(str_pad($item->queue->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }} / {{ $item->patient->name ?? '-' }}</td>
          <td>{{ $item->queue->patientCategory->name ?? '-' }}</td>
          <td>{{ $item->petugas->name ?? '-' }}</td>
          <td>{{ $item->validator->name ?? '-' }}</td>
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

