@extends('layouts.backend.main')

@section('content')

<div class="card p-3 mb-5">
  <div class="d-flex">
    <h4 class="align-self-center m-0">List Data SEP</h4>
    <!-- <a href="{{ route('sep.index') }}" class="btn btn-success ms-auto btn-sm m-0 mx-3">+ Tambah Sep</a> -->
  </div>
  <hr class="m-0 mt-2 mb-3">
  <div class="table-responsive text-wrap mb-5">
    <table class="table mb-5" id="example">
      <thead>
        <tr class="text-wrap bg-dark">
          <th>No</th>
          <th>No RM</th>
          <th>Nama Pasien</th>
          <th>No. SEP</th>
          <th>Tanggal SEP</th>
          <th>Sumber SEP</th>
          <th>Tanggal Pulang</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($dataSep as $key => $val)
        @php
        $dataPulang = App\Models\arg01\SepUpdatePulangs::where('id_seps', $val->id)->first();
        @endphp
        <tr>
          <td>{{ $key+1 }}</td>
          <td>{{ implode("-", str_split($val->no_mr, 2)) }}</td>
          <td>{{ $val->nama_peserta ?? '-' }}</td>
          <td>{{ $val->no_sep ?? '-'}}</td>
          <td>{{ Carbon\Carbon::parse($val->tgl_sep)->translatedFormat('d F Y')  ?? '-'}}</td>
          <td>{{ $val->sumber_sep ?? '-'}}</td>
          <td>
            @if($dataPulang)
            {{ Carbon\Carbon::parse($dataPulang->tgl_pulang)->translatedFormat('d F Y') }}
            @else
            @if($val->sumber_sep === 'Sudi Merawat')
            <a href="{{ route('update-pulang.create', ['idSep' => encrypt($val->id)]) }}"
              class="btn btn-success ms-auto btn-sm m-0 mx-1">Update</a>
            @endif
            @endif
          </td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                <i class="bx bx-brightness"></i>
              </button>
              <div class="dropdown-menu">
                @if($dataPulang && $val->sumber_sep === 'Sudi Merawat')
                <a class="dropdown-item" href="{{ route('update-pulang.create', ['idSep' => encrypt($val->id)]) }}">
                  <i class='bx bx-edit-alt me-1'></i>
                  Update Tanggal Pulang
                </a>
                @endif
                <a class="dropdown-item" href="{{ route('sep.view', ['idSep' => encrypt($val->id)]) }}">
                  <i class='bx bx-show me-1'></i>
                  View
                </a>
                <a class="dropdown-item" href="{{ route('sep.form-update', ['id' => encrypt($val->id)]) }}">
                  <i class='bx bx-edit-alt me-1'></i>
                  Edit
                </a>
                <button type="button" class="dropdown-item delete-button" data-id="{{ encrypt($val->id) }}"
                  data-nomor="{{ encrypt($val->no_sep) }}" onclick="return confirm('Yakin ingin menghapus data?')">
                  <i class="bx bx-trash me-1"></i>Hapus
                </button>
              </div>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
  /** handle delete data */
  $('.delete-button').on('click', function(e) {
    e.preventDefault();

    var nomor = $(this).data('nomor');
    var idSep = $(this).data('id');

    $.ajax({
      url: "{{ route('sep.delete-sep') }}",
      type: 'DELETE',
      data: {
        _token: '{{ csrf_token() }}',
        "noSep": nomor,
        "idSep": idSep,
      },
      success: function(response) {
        alert('Data berhasil dihapus');
        location.reload(); // Refresh page or remove the item from DOM
      },
      error: function(xhr) {
        alert('Terjadi kesalahan saat menghapus data');
      }
    });
  });
});
</script>

@endsection