@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
<div class="alert alert-success d-flex" role="alert">
    <span class="alert-icon rounded-circle"><i class='bx bxs-check-circle' style="font-size: 40px"></i></span>
    <div class="d-flex flex-column ps-1">
        <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">BERHASIL !!</h6>
        <span>{{ session('success') }}</span>
    </div>
</div>
@endif
@if (session()->has('error'))
<div class="alert alert-danger d-flex" role="alert">
    <span class="alert-icon rounded-circle"><i class='bx bxs-x-circle' style="font-size: 40px"></i></span>
    <div class="d-flex flex-column ps-1">
        <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">ERROR !!</h6>
        <span>{{ session('error') }}</span>
    </div>
</div>
@endif
@if (session()->has('exceptions'))
<div class="alert alert-danger d-flex" role="alert">
<span class="alert-icon rounded-circle"><i class='bx bxs-x-circle' style="font-size: 40px"></i></span>
<div class="d-flex flex-column ps-1">
    <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">ERROR !!</h6>
    <span>
    @foreach (session('exceptions') as $error)
        <li>{{ $error }}</li>
    @endforeach
    </span>
</div>
</div>
@endif
@if ($errors->any())
<div class="alert alert-danger d-flex" role="alert">
<span class="alert-icon rounded-circle"><i class='bx bxs-x-circle' style="font-size: 40px"></i></span>
<div class="d-flex flex-column ps-1">
    <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">ERROR !!</h6>
    <span>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
    </span>
</div>
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
          <th>Tanggal Periksa</th>
          <th>No Reg</th>
          <th>Kategori</th>
          <th>Diagnosa</th>
          <th>No RM / Nama</th>
          <th>Tanggungan</th>
          <th>Petugas</th>
          <th>Validator</th>
          <th class="text-center">Status</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $item)    
        <tr class="{{ $item->tipe_permintaan == 'Urgent' ? 'text-danger' : '' }}">
          <td>
            @if ($item->status == 'ACCEPTED' || $item->status == 'UNVALIDATE')
              <div class="btn-group dropend">
                <button type="button" class="btn btn-dark btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class='bx bx-info-circle me-2'></i>Action
                </button>
                <div class="dropdown-menu">      
                  @if ($item->status == 'ACCEPTED')
                    <li>
                      <button class="dropdown-item text-warning" onclick="createAntrian({{ $item->id }})">
                        <i class='bx bx-edit-alt'></i>
                        Reschedule
                      </button>
                    </li>
                  @elseif ($item->status == 'UNVALIDATE')         
                    <li>
                      <form action="{{ route('laboratorium/patient/queue.update', $item->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <button type="submit" class="dropdown-item text-success" value="FINISHED">
                          <i class='bx bx-check'></i> Validasi
                        </button>
                      </form>
                    </li>       
                  @endif
                  <li>
                    <a class="dropdown-item text-primary" href="{{ route('laboratorium/patient/hasil.create', encrypt($item->id)) }}">
                      <i class="bx bx-cloud-upload"></i>
                      Edit / input Hasil
                    </a>
                  </li>
                </div>
              </div>
            @elseif ($item->status == 'FINISHED')
              <a class="btn btn-sm btn-dark pt-2 ms-1" target="blank" href="{{ route('laboratorium/patient/hasil.show', encrypt($item->id)) }}">
                <i class="bx bx-printer me-1"></i>
                Print
              </a>
            @else
              <span class="badge bg-danger">{{ $item->status ?? 'TIDAK DIKETAHUI' }}</span>
            @endif
          </td>
          @php
            $waktu = new Carbon\Carbon($item->jadwal_periksa);
          @endphp
          <td>{{ $waktu->format('Y-m-d') ?? '-' }}</td>
          <td>{{ $item->no_reg ?? '-' }}</td>
          <td>{{ $item->tipe_permintaan ?? '-' }}</td>
          <td>{!! $item->diagnosa ?? '-' !!}</td>
          <td>{{ implode('-', str_split(str_pad($item->queue->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }} / {{ $item->queue->patient->name ?? '-' }}</td>
          <td>{{ $item->queue->patientCategory->name ?? '-' }}</td>
          <td>{{ $item->petugas->name ?? '-' }}</td>
          <td>{{ $item->validator->name ?? '-' }}</td>
          <td>
            @if ($item->status == 'ACCEPTED')
              <span class="badge bg-primary ms-1">DITERIMA</span>
            @elseif($item->status == 'UNVALIDATE')
              <span class="badge bg-danger ms-1">BELUM DIVALIDASI</span>
            @else
              <span class="badge bg-success ms-1">SELESAI</span>
            @endif
          </td>
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
                <input type="hidden" name="status" value="RESCHEDULE">
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

