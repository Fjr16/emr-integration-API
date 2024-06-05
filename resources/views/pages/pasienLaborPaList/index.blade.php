@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif
<div class="card p-3 mt-5">
    <div class="d-flex">
        <h4 class="align-self-center m-0">
            Daftar Permintaan Laboratorium
        </h4>
    </div>
  <hr class="m-0 mt-2 mb-3">
  <div class="table-responsive text-nowrap">
    <table id="example" class="table">
      <thead>
        <tr class="text-nowrap bg-dark">
          <th>No Antrian</th>
          <th>No Rekam Medis</th>
          <th>Nama</th>
          <th>Kategori Pasien</th>
          <th>Ruangan</th>
          <th>Tanggal / Jam Permintaan</th>
          <th class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $item)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $item->patient->no_rm }}</td>
          <td>{{ $item->patient->name }}</td>
          <td>{{ $item->queue->patientCategory->name }}</td>
          <td>{{ $item->user->roomDetail->name ?? '' }}</td>
          <td>{{ $item->created_at }}</td>
          <td>
              <button class="btn btn-sm btn-success" {{ $item->antrianLaboratoriumPatologiAnatomiPatient == null ? 'disabled' : '' }}>
                Terdaftar
              </button>
              <a href="{{ route('permintaan/laboratorium/patologi/anatomik.createAntrian', $item->id) }}" class="btn btn-success btn-sm {{ $item->antrianLaboratoriumPatologiAnatomiPatient !== null ? 'disabled' : '' }}">
                Daftarkan
              </a>
          </td>
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

