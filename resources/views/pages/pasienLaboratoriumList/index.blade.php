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
            Daftar Permintaan <span class="text-primary">{{ $filter ?? '' }}</span>
        </h4>
      </div>
      <div class="col-3">
        <form action="{{ route('laboratorium/patient.index') }}" method="GET">
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
          <th>No. RM / Nama</th>
          <th>Tanggungan</th>
          <th>Kategori Permintaan</th>
          <th>Diagnosa Klinis</th>
          <th>List Tindakan</th>
          <th>Tgl. Permintaan</th>
          <th>Dokter</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $item)    
        <tr class="{{ $item->tipe_permintaan == 'Urgent' ? 'table-danger' : '' }}">
          <td>
            @if ($item->laboratoriumRequestDetails)    
              @if ($item->status == 'WAITING')    
                <div class="btn-group dropend">
                  <button type="button" class="btn btn-dark btn-sm dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class='bx bx-info-circle me-2'></i> Konfirmasi
                  </button>
                  <div class="dropdown-menu">
                    <button type="button" class="dropdown-item text-success" onclick="createAntrian({{ $item->id }})"> <i class="bx bx-check"></i> Terima </button>
                    <form action="{{ route('laboratorium/patient/queue.store', $item->id) }}" method="POST">
                      @csrf
                      <button type="submit" class="dropdown-item text-warning" name="status" value="DENIED" onclick="return confirm('Yakin Ingin Menolak Permintaan Laboratorium ?')"><i class="bx bxs-hand"></i> Tolak</button>
                      <button type="submit" class="dropdown-item text-danger" name="status" value="CANCEL" onclick="return confirm('Yakin Ingin Membatalkan Permintaan Laboratorium ?')"><i class="bx bx-x"></i> Batal
                      </button>
                    </form>
                  </div>
                </div>
              @else
                  @if ($item->status == 'DENIED')
                    <span class="badge bg-warning"><i class='bx bxs-hand'></i> DITOLAK</span>
                  @elseif($item->status == 'CANCEL')
                    <span class="badge bg-danger"><i class="bx bx-x"></i> BATAL</span>
                  @elseif($item->status == 'ACCEPTED')
                    <span class="badge bg-primary"><i class="bx bx-check"></i> DITERIMA</span>
                  @elseif($item->status == 'UNVALIDATE')
                    <span class="badge bg-primary"><i class='bx bx-search-alt-2'></i> SEDANG DIPERIKSA</i> </span>
                  @elseif($item->status == 'FINISHED')
                    <span class="badge bg-success"><i class="bx bx-check"></i> SELESAI</span>
                  @endif
              @endif
            @else
              <span class="badge bg-danger">DATA ERROR !!</span>
            @endif
          </td>
          <td>{{ implode('-', str_split(str_pad($item->queue->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }} / {{ $item->queue->patient->name ?? '-' }}</td>
          <td>{{ $item->queue->patientCategory->name ?? '-' }}</td>
          <td>{{ $item->tipe_permintaan ?? '-' }}</td>
          <td>{!! $item->diagnosa ?? '-' !!}</td>
          <td>
            @foreach ($item->laboratoriumRequestDetails as $detail)
                <li>
                  {{ $detail->action->name ?? '' }}
                </li>
            @endforeach
          </td>
          <td>{{ $item->created_at->format('Y-m-d') ?? '-' }}</td>
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

