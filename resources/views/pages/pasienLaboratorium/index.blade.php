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
          <th>No Reg Lab PK</th>
          <th>Kategori Permintaan</th>
          <th>No Rekam Medis</th>
          <th>Nama</th>
          <th>Tanggungan</th>
          <th>Diagnosa</th>
          <th>Tanggal Periksa</th>
          <th>Petugas</th>
          <th>Validator</th>
          {{-- <th>Validasi</th> --}}
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $item)    
        <tr class="{{ $item->tipe_permintaan == 'Urgent' ? 'text-danger' : '' }}">
          <td class="text-center">
            @if ($item->status == 'ACCEPTED')
              <button class="btn btn-warning btn-sm" onclick="createAntrian({{ $item->id }})">
                <i class='bx bx-edit-alt me-1'></i>
                Edit Jadwal
              </button>
              <a class="btn btn-success btn-sm" href="{{ route('laboratorium/patient/hasil.create', $item->id) }}">
                <i class="bx bx-cloud-upload me-1"></i>
                Input Hasil
              </a>
            @elseif ($item->status == 'UNVALIDATED')                
              <form action="{{ route('laboratorium/patient/queue.update', $item->id) }}" method="POST" disabled>
                @method('PUT')
                @csrf
                <button type="submit" class="btn btn-success btn-sm">
                  <i class='bx bx-check'></i>
                  Validasi
                </button>
              </form>
              <a class="dropdown-item" href="{{ route('laboratorium/patient/hasil.edit', $item->id) }}">
                <i class="bx bx-edit-alt me-1"></i>
                Edit
              </a>
            @else  
              <button class="btn btn-success btn-sm" disabled>
                {{ $item->status ?? '' }}
              </button>
            @endif
            <a class="btn btn-sm btn-dark" target="blank" href="{{ route('laboratorium/patient/hasil.show', $item->id) }}">
              <i class="bx bx-printer me-1"></i>
              Print
            </a>
          </td>
          <td>{{ $item->no_reg ?? '-' }}</td>
          <td>{{ $item->tipe_permintaan ?? '-' }}</td>
          <td>{{ implode('-', str_split(str_pad($item->queue->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}</td>
          <td>{{ $item->patient->name ?? '-' }}</td>
          <td>{{ $item->queue->patientCategory->name ?? '-' }}</td>
          <td>{!! $item->diagnosa ?? '-' !!}</td>
          @php
            $waktu = new Carbon\Carbon($item->jadwal_periksa);
          @endphp
          <td>{{ $waktu->format('Y-m-d') ?? '-' }}</td>
          <td>{{ $item->user->name ?? '-' }}</td>
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

