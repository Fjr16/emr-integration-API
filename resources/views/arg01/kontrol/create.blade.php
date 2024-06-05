@extends('layouts.backend.main')

@section('content')

<style>
.error-msg {
  color: red;
  font-size: 12px;
}
</style>

<div class="card mb-4">
  <div class="card-header d-flex align-items-center justify-content-between">
    <h5 class="mb-0">{{ $title === "SPRI" ? "Tambah SPRI" : "Tambah Surat Kontrol" }}</h5>
  </div>
  <div class="card-body">
    <div class="row mb-3 justify-content-center">
      <div class="col-md-12">
        <div class="row mb-3">
          <div class="col-md-6">
            <label class="col-form-label" for="no_sep">{{ $title === "SPRI" ? "Nomor Kartu" : "Nomor SEP" }}</label>
            <input type="text" class="form-control col-7" id="no_sep" name="no_sep"
              placeholder="{{ $title === 'SPRI' ? 'Masukkan nomor kartu' : 'Masukkan nomor SEP' }}"
              aria-describedby="defaultFormControlHelp" autocomplete="off" />
            <div id="no_sep_error" class="error-msg mt-2"></div>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-6">
            <label class="col-form-label" for="tgl_kunjungan">Tanggal Kunjungan</label>
            <input type="date" class="form-control col-7" id="tgl_kunjungan" name="tgl_kunjungan"
              placeholder="Masukkan tanggal kujungan" aria-describedby="defaultFormControlHelp" autocomplete="off"
              required />
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-6">
            <label class="col-form-label" for="poli_tujuan">Poli Tujuan</label>
            <select name="poli_tujuan" id="poli_tujuan" class="form-select select2">
              <option value="">Pilih</option>
            </select>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-6">
            <label class="col-form-label" for="dokter">Dokter Penanggung Jawab</label>
            <select name="dokter" id="dokter" class="form-select select2">
              <option value="">Pilih</option>
            </select>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-6">
            <div class="d-flex justify-content-end">
              <button type="button" class="btn btn-dark ml-auto simpanDataSurat">Simpan</button>
              <a href="{{ $title === 'SPRI' ? route('kontrol.spri') : route('kontrol.rawatJalan') }}"
                class="btn btn-warning">Kembali</a>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- Modal menmpilkan succes create surat kontrol begin -->
<div class="modal fade" id="modalSuccess" tabindex="-1" aria-labelledby="modalSuccessLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h3 class="modal-title text-center" id="modalSuccessLabel">Sukses!!</h3>
        <div class="text-center">
          <i class='bx bxs-check-circle bx-tada bx-2 bx-flip-horizontal' style='color:#296c91; font-size: 200px;'></i>
        </div>
        <div class="text-center">
          <a id="printLink" href="#" class="btn btn-dark">Kembali</a>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal menmpilkan succes create surat kontrol end -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
  /** inisialisasi variabel */
  var title = "{{ $title }}";

  $("#btnPoliTujuan").prop("disabled", true); /** disabeld tombol cari poli */

  /** menentukan nomor kartu atau nomor sep jika kosong */
  $("#no_sep").on("input", function() {
    var nomorSEP = $(this).val();
    if (nomorSEP.trim() !== "") {
      $("#btnPoliTujuan").prop("disabled", false);
      $("#no_sep_error").hide();
    } else {
      $("#btnPoliTujuan").prop("disabled", true);
      $("#no_sep_error").html("Nomor SEP/Nomor Kartu harus diisi").show();
    }
  });


  /** 
   * pencarian data poli tujuan kontrol
   * dengan nomor kartu/sep dan tgl tidak boleh kosong
   */
  $('#no_sep, #tgl_kunjungan').on('input', function() {
    var nomor = $('#no_sep').val();
    var tglKunjungan = $('#tgl_kunjungan').val();
    var jenis = title === 'SPRI' ? 1 : 2;

    if (nomor.trim() !== '' && tglKunjungan.trim() !== '') {
      $.ajax({
        url: '{{ route("kontrol.poli") }}',
        method: 'POST',
        data: {
          "_token": "{{ csrf_token() }}",
          "nomor": nomor,
          "tgl": tglKunjungan,
          "jenis": jenis,
        },
        success: function(response) {
          if (response?.data?.metaData?.code == 200) {
            const res = response?.data?.response?.list;
            $('#poli_tujuan').empty();
            $('#poli_tujuan').append(
              '<option value="">Pilih</option>');
            $.each(res, function(key, item) {
              $('#poli_tujuan').append('<option value="' +
                item.kodePoli +
                '" namaValue="' + item.namaPoli + '">' + item.kodePoli + ' - ' + item.namaPoli +
                '</option>');
            });
          } else {
            $('#poli_tujuan').empty();
            $('#poli_tujuan').append(
              '<option value="">Pilih</option>');
            $('#poli_tujuan').append(
              '<option value="" disabled>Data tidak ditemukan</option>');
          }
        },
        error: function(xhr, status, error) {
          console.error(error);
        }
      });
    } else {
      /** Jika salah satu atau kedua input kosong, tampilkan pesan "tidak ada poli tersedia" */
      $('#poli_tujuan').empty();
      $('#poli_tujuan').append(
        '<option value="">Pilih</option>');
      $('#poli_tujuan').append(
        '<option value="" disabled>Data tidak ditemukan</option>');
    }
  });


  /** 
   * pencarian data dokter untuk rencana kontrol
   * dengan nomor kartu/sep, tgl kontrol, dan kode poli tidak boleh kosong
   */
  $('#no_sep, #tgl_kunjungan, #poli_tujuan').on('input', function() {
    var tglKunjungan = $('#tgl_kunjungan').val();
    var kodePoli = $('#poli_tujuan').val();
    var jenis = title === 'SPRI' ? 1 : 2;

    if (tglKunjungan.trim() !== '' && kodePoli.trim !== '') {
      $.ajax({
        url: '{{ route("kontrol.dokter") }}',
        method: 'POST',
        data: {
          "_token": "{{ csrf_token() }}",
          "tgl": tglKunjungan,
          "jenis": jenis,
          "kodePoli": kodePoli,
        },
        success: function(response) {
          console.log(response);
          if (response?.data?.metaData?.code == 200) {
            const res = response?.data?.response?.list;
            $('#dokter').empty();
            $('#dokter').append(
              '<option value="">Pilih</option>');
            $.each(res, function(key, item) {
              $('#dokter').append('<option value="' +
                item.kodeDokter +
                '" namaValue="' + item.namaDokter + '">' + item.kodeDokter + ' - ' + item
                .namaDokter +
                '</option>');
            });
          } else {
            $('#dokter').empty();
            $('#dokter').append(
              '<option value="">Pilih</option>');
            $('#dokter').append(
              '<option value="" disabled>Data tidak ditemukan</option>');
          }
        },
        error: function(xhr, status, error) {
          console.error(error);
        }
      });
    } else {
      /** Jika salah satu atau semua input kosong, tampilkan pesan "tidak ada poli tersedia" */
      $('#dokter').empty();
      $('#dokter').append(
        '<option value="">Pilih</option>');
      $('#dokter').append(
        '<option value="" disabled>Data tidak ditemukan</option>');
    }
  });


  /** function simpan/create surat kontrol rawat jalan */
  $('.simpanDataSurat').click(function() {
    /** Atur data sesuai dengan format yang diharapkan oleh API */
    var requestSistem = {
      "noSEP": $('#no_sep').val(),
      "kodeDokter": $('#dokter').val(),
      "poliKontrol": $('#poli_tujuan').val(),
      "tglRencanaKontrol": $('#tgl_kunjungan').val(),

      "nm_poli_tujuan": $('#poli_tujuan option:selected').attr('namaValue'),
      "nama_dokter": $('#dokter option:selected').attr('namaValue'),
    }

    if (title === "SPRI") {
      $.ajax({
        url: '{{ route("spri.simpan-data") }}',
        method: 'POST',
        data: {
          "_token": "{{ csrf_token() }}",
          "dataRequest": requestSistem,
        },
        success: function(response) {
          if (response?.data?.metaData?.code == 200) {
            /** menampilkan modal sukses */
            $('#modalSuccess').modal('show');

            /** Membuat URL untuk kembali ke halaman index */
            var printUrl = "{{ route('kontrol.spri') }}";

            /** Memperbarui atribut href dari tautan di dalam modal */
            $('#printLink').attr('href', printUrl);
          } else {
            alert(response?.data?.metaData?.message);
          }
        },
        error: function(xhr, status, error) {
          console.error(error);
        }
      });
    } else {
      $.ajax({
        url: '{{ route("kontrol.simpan-data") }}',
        method: 'POST',
        data: {
          "_token": "{{ csrf_token() }}",
          "dataRequest": requestSistem,
        },
        success: function(response) {
          if (response?.data?.metaData?.code == 200) {
            /** menampilkan modal sukses */
            $('#modalSuccess').modal('show');

            /** Membuat URL untuk kembali ke halaman index */
            var printUrl = "{{ route('kontrol.rawatJalan') }}";

            /** Memperbarui atribut href dari tautan di dalam modal */
            $('#printLink').attr('href', printUrl);
          } else {
            alert(response?.data?.metaData?.message);
          }
        },
        error: function(xhr, status, error) {
          console.error(error);
        }
      });
    }
  });
});
</script>

@endsection