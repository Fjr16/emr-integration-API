@extends('layouts.backend.main')

@section('content')

<div class="card mb-4">
  <div class="card-header d-flex align-items-center justify-content-between">
    <h5 class="mb-0">Update Tanggal Pulang</h5>
  </div>
  <div class="card-body">
    <div class="row mb-3 justify-content-center">
      <div class="col-md-12">
        <div class="row mb-3">
          <div class="col-md-6">
            <label class="col-form-label" for="no_sep">Nomor SEP</label>
            <input type="text" class="form-control col-7" id="no_sep" name="no_sep" placeholder="Masukkan nomor SEP"
              aria-describedby="defaultFormControlHelp" autocomplete="off" value="{{ $dataSep->no_sep }}" disabled />
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-6">
                <label class="col-form-label" for="nama_peserta">Nama Pasien</label>
                <input type="text" class="form-control col-7" id="nama_peserta" name="nama_peserta"
                  placeholder="Masukkan nama pasien" aria-describedby="defaultFormControlHelp" autocomplete="off"
                  value="{{ $dataSep->nama_peserta }}" disabled />
              </div>
              <div class="col-md-6">
                <label class="col-form-label" for="noka">Nomor Kartu</label>
                <input type="text" class="form-control col-7" id="noka" name="noka" placeholder="Masukkan nomor kartu"
                  aria-describedby="defaultFormControlHelp" autocomplete="off" value="{{ $dataSep->noka }}" disabled />
              </div>
            </div>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-6">
            <label class="col-form-label" for="status_pulang">Status Pulang</label>
            <select name="status_pulang" id="status_pulang" class="form-select select2">
              <option value="" selected>Pilih</option>
              @foreach ($status as $st)
              <option value="{{ $st['id'] }}" namaValue="{{ $st['nama']}}">{{ $st['nama']}}</option>
              @endforeach
            </select>
            </select>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-6">
                <label class="col-form-label" for="no_surat">Nomor Surat Meninggal</label>
                <input type="text" class="form-control col-7" id="no_surat" name="no_surat"
                  placeholder="Masukkan nomor surat meninggal" aria-describedby="defaultFormControlHelp"
                  autocomplete="off" />
              </div>
              <div class="col-md-6">
                <label class="col-form-label" for="tgl_meninggal">Tanggal Meninggal</label>
                <input type="date" class="form-control col-7" id="tgl_meninggal" name="tgl_meninggal"
                  placeholder="Masukkan tanggal meninggal" aria-describedby="defaultFormControlHelp" autocomplete="off"
                  required />
              </div>
            </div>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-6">
            <label class="col-form-label" for="tgl_pulang">Tanggal Pulang</label>
            <input type="date" class="form-control col-7" id="tgl_pulang" name="tgl_pulang"
              placeholder="Masukkan tanggal pulang" aria-describedby="defaultFormControlHelp" autocomplete="off"
              required />
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-6">
            <label class="col-form-label" for="no_lp">Nomor Laporan Polisi (LP)</label>
            <input type="text" class="form-control col-7" id="no_lp" name="no_lp"
              placeholder="Masukkan nomor laporan polisi" aria-describedby="defaultFormControlHelp" autocomplete="off"
              required />
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <div class="d-flex justify-content-end">
              <button type="button" class="btn btn-dark ml-auto simpanDataPulang">Update</button>
              <a href="{{ route('sep.beranda') }}" class="btn btn-warning">Kembali</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Modal menmpilkan succes begin -->
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
<!-- Modal menmpilkan succes end -->


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
  /** function simpan/create SEP */
  $('.simpanDataPulang').click(function() {
    /** Atur data sesuai dengan format yang diharapkan oleh API */
    var requestSistem = {
      "idSeps": "{{ $dataSep->id }}",
      "noSep": "{{ $dataSep->no_sep }}",
      "kdStatusPulang": $('#status_pulang').val(),
      "namaStatusPulang": $('#status_pulang option:selected').attr('namaValue'),
      "noSuratMeninggal": $('#no_surat').val(),
      "tglMeninggal": $('#tgl_meninggal').val(),
      "tglPulang": $('#tgl_pulang').val(),
      "noLPManual": $('#no_lp').val(),
      "user": "Ropanasuri",
    }

    $.ajax({
      url: '{{ route("pulang.update-tanggal") }}',
      method: 'PUT',
      data: {
        "_token": "{{ csrf_token() }}",
        "dataRequestSistem": requestSistem,
      },
      success: function(response) {
        console.log(response);
        if (response?.data?.metaData?.code == 200) {
          /** menampilkan modal sukses */
          $('#modalSuccess').modal('show');

          /** Membuat URL untuk cetak SEP dengan nomor SEP yang diperoleh */
          var printUrl = "{{ route('sep.beranda') }}";

          /** Memperbarui atribut href dari tautan cetak SEP di dalam modal */
          $('#printLink').attr('href', printUrl);
        } else {
          alert(response?.data?.metaData?.message);
        }
      },
      error: function(xhr, status, error) {
        console.error(error);
        alert(error);
      }
    });
  });
});
</script>
@endsection