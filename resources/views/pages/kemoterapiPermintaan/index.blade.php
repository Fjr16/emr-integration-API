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
            Daftar Permintaan Kemoterapi
        </h4>
    </div>
  <hr class="m-0 mt-2 mb-3">
  <div class="table-responsive text-nowrap">
    <table id="example" class="table">
      <thead>
        <tr class="text-nowrap bg-dark">
          <th>No</th>
          <th>No Rekam Medis</th>
          <th>Nama</th>
          <th>Kategori Pasien</th>
          <th>Tanggal / Jam Permintaan</th>
          @can('atur jadwal pemeriksaan laboratorium pk')
          <th class="text-center">Action</th>
          @endcan
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $item)    
        <tr>
          <td>{{ $loop->iteration ?? '' }}</td>
          <td>{{ implode('-', str_split(str_pad($item->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}</td>
          <td>{{ $item->patient->name ?? '-' }}</td>
          <td>{{ $item->patientCategory->name ?? '-' }}</td>
          <td>{{ $item->created_at->format('Y-m-d / H:i:s') ?? '-' }}</td>
          <td>
              @if ($item->kemoterapiPatient)
                <button class="btn btn-success btn-sm" disabled>
                  Terdaftar
                </button>
              @else
                <button class="btn btn-success btn-sm" onclick="createAntrian({{ $item->id }})">
                  Daftarkan
                </button>
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
    <form action="" method="POST" id="postModal">
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
    var wrapper = document.getElementById('basicModal');
    var formAct = wrapper.querySelector('#postModal');
    formAct.action = "{{ url('kemoterapi/antrian/store') }}/" + id;
    $(wrapper).modal('show');
  }
</script>
@endsection

