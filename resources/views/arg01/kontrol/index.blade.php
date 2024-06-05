@extends('layouts.backend.main')

@section('content')

<div class="card p-3 mb-5">
  <div class="d-flex">
    <h4 class="align-self-center m-0">{{ $title === "SPRI" ? "List SPRI" : "List Surat Kontrol" }}</h4>
    <a href="{{ $title === 'SPRI' ? route('spri.create') : route('kontrol.create') }}"
      class="btn btn-success ms-auto btn-sm m-0 mx-3">+ Tambah Surat</a>
  </div>
  <hr class="m-0 mt-2 mb-3">
  <div class="table-responsive text-wrap mb-5">
    <table class="table mb-5" id="example">
      <thead>
        <tr class="text-wrap bg-dark">
          <th>No</th>
          <th>{{ $title === "SPRI" ? "No. Surat" : "No. Surat Kontrol" }}</th>
          <th>No. Kartu</th>
          <th>Nama Pasien</th>
          <th>Tanggal Kontrol</th>
          <th>Jenis Kelamin</th>
          <th>Nama Dokter</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($models as $key => $val)
        <tr>
          <td>{{ $key+1 }}</td>
          <td>{{ $val->no_surat }}</td>
          <td>{{ $val->noka ?? '-'}}</td>
          <td>{{ $val->nama_pasien ?? '-' }}</td>
          <td>{{ $val->tgl_kontrol}}</td>
          <td>{{ $val->jns_kelamin ?? '-'}}</td>
          <td>{{ $val->nama_dokter ?? '-'}}</td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                <i class="bx bx-brightness"></i>
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item"
                  href="{{ $title === 'SPRI' ? route('spri.update', ['id' => $val->id]) : route('kontrol.edit', ['id' => encrypt($val->id)]) }}">
                  <i class='bx bx-edit-alt me-1'></i>
                  Edit
                </a>
                <button type="button" class="dropdown-item delete-button" data-nomor="{{ encrypt($val->no_surat) }}"
                  onclick="return confirm('Yakin ingin menghapus data?')">
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
    var url = "{{ route('kontrol.delete', ':nomor') }}".replace(':nomor', nomor);

    $.ajax({
      url: url,
      type: 'DELETE',
      data: {
        _token: '{{ csrf_token() }}'
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