@extends('layouts.backend.main')

@section('content')

<div class="card mb-4">
  <div class="card-header d-flex align-items-center justify-content-between">
    <h5 class="mb-0">Edit Surat Kontrol</h5>
  </div>
  <div class="card-body">
    <div class="row mb-3 justify-content-center">
      <div class="col-md-12">
        <div class="row mb-3">
          <div class="col-md-6">
            <label class="col-form-label" for="no_sep">Nomor SEP</label>
            <input type="text" class="form-control col-7" id="no_sep" name="no_sep" placeholder="Masukkan nomor SEP"
              aria-describedby="defaultFormControlHelp" value="{{ $model->no_sep }}" />
          </div>
          <div class="col-md-6">
            <label class="col-form-label" for="poli_tujuan">Poli Tujuan</label>
            <div class="row">
              <div class="col-sm-10">
                <input type="text" class="form-control col-7" id="poli_tujuan" name="poli_tujuan"
                  placeholder="Poli Tujuan" aria-describedby="defaultFormControlHelp" disabled />
              </div>
              <div class="col-sm-2">
                <button type="button" id="btnPoliTujuan" class="btn btn-dark" data-bs-toggle="modal"
                  data-bs-target="#dataPoli">Cari</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="row mb-3">
          <div class="col-md-6">
            <label class="col-form-label" for="tgl_kunjungan">Tanggal Kunjungan</label>
            <input type="date" class="form-control col-7" id="tgl_kunjungan" name="tgl_kunjungan"
              placeholder="Masukkan tanggal kujungan" aria-describedby="defaultFormControlHelp"
              value="{{ $model->tgl_kontrol }}" required />
          </div>
          <div class="col-md-6">
            <label class="col-form-label" for="dokter">Dokter Penanggung Jawab</label>
            <select name="dokter" id="dokter" class="form-select select2">
              <option value="" selected>Pilih</option>
              @foreach ($docters as $doc)
              @if ($doc['kodedokter'] == $model->kd_dokter)
              <option value="{{ $doc['kodedokter'] }}" namaValue="{{ $doc['namadokter']}}" selected>
                {{ $doc['namadokter']}}</option>
              @else
              <option value="{{ $doc['kodedokter'] }}" namaValue="{{ $doc['namadokter']}}">{{ $doc['namadokter']}}
              </option>
              @endif
              @endforeach
            </select>
          </div>
        </div>
      </div>
    </div>
    <div class="d-flex justify-content-end">
      <button type="button" class="btn btn-dark ml-auto editDataSurat">Update</button>
      <a href="{{ route('kontrol.rawatJalan') }}" class="btn btn-warning">Kembali</a>
    </div>
  </div>
</div>

<!-- Modal untuk mencari data poli begin -->
<div class="modal fade" id="dataPoli" tabindex="-1" aria-labelledby="dataPoliLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="dataPoliLabel">Cari Poli</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row mb-3">
          <div class="col-sm-10">
            <input type="text" class="form-control col-7" id="poli" name="poli"
              placeholder="Masukkan kode atau nama poli" aria-describedby="defaultFormControlHelp" />
          </div>
          <div class="col-sm-2">
            <button type="button" class="btn btn-dark btnCariDataPoli">Cari</button>
          </div>
        </div>

        <div class="table-responsive">
          <table class="table">
            <thead style="background-color: #296c91">
              <tr>
                <th scope="col">Kode</th>
                <th scope="col">Nama</th>
                <th scope="col">Pilih</th>
              </tr>
            </thead>
            <tbody id="hasilPencarianPoli">
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal untuk mencari data poli end -->

<!-- Modal menmpilkan succes update surat kontrol begin -->
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
<!-- Modal menmpilkan succes update surat kontrol end -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
  /** inisialisasi variabel */
  var kodePoli, namaPoli;

  var kodeDanNamaPoli = "{{ $model->kd_poli }} - {{ $model->poli_kontrol }}";
  $('#poli_tujuan').val(kodeDanNamaPoli);
  kodePoli = "{{ $model->kd_poli }}";
  namaPoli = "{{ $model->poli_kontrol }}";

  /** function untuk pencarian poli tujuan */
  $('.btnCariDataPoli').click(function() {
    var keyword = $('#poli').val();

    /** untuk mengecek jika keyword ada mengandung spasi */
    if (keyword.includes(' ')) {
      keyword = keyword.replace(/\s+/g, '-');
    } else {
      keyword = $('#poli').val();
    }

    $.ajax({
      url: '{{ route("sep.poli") }}',
      method: 'POST',
      data: {
        "_token": "{{ csrf_token() }}",
        "keyword": keyword,
      },
      success: function(response) {
        $('#hasilPencarianPoli').empty(); /** Kosongkan hasil pencarian sebelumnya  */

        if (response?.data?.metaData?.code == 200) {
          const res = response?.data?.response?.poli;
          /** Tampilkan hasil pencarian dalam tabel  */
          $.each(res, function(index, vals) {
            var row = '<tr>' +
              '<td>' + vals.kode + '</td>' +
              '<td>' + vals.nama + '</td>' +
              '<td><input type="radio" name="radioPoli" value="' + vals.kode +
              '" namaPoli="' +
              vals.nama + '"></td>' +
              '</tr>';
            $('#hasilPencarianPoli').append(row);
          });
        } else {
          var row = '<tr>' +
            '<td colspan="3">Poli tidak ditemukan</td>' +
            '</tr>';
          $('#hasilPencarianPoli').append(row);
        }
      },
      error: function(xhr, status, error) {
        console.error(error);
      }
    });
  });

  /** function ketika klik radio button poli ketika pilih poli */
  $(document).on('click', 'input[name="radioPoli"]', function() {
    kodePoli = $(this).val();
    namaPoli = $(this).attr('namaPoli');
    var kodeDanNamaPoli = kodePoli + ' - ' + namaPoli;
    $('#poli_tujuan').val(kodeDanNamaPoli);

    /** Menutup modal */
    $('#dataPoli').modal('hide');
  });

  /** function edit/update surat kontrol rawat jalan */
  $('.editDataSurat').click(function() {
    /** Atur data sesuai dengan format yang diharapkan oleh API */
    var requestSistem = {
      "id": "{{ $model->id }}",
      "noSuratKontrol": "{{ $model->no_surat }}",
      "noSEP": $('#no_sep').val(),
      "kodeDokter": $('#dokter').val(),
      "poliKontrol": kodePoli,
      "tglRencanaKontrol": $('#tgl_kunjungan').val(),

      "nm_poli_tujuan": namaPoli,
      "nama_dokter": $('#dokter option:selected').attr('namaValue'),
    }

    $.ajax({
      url: '{{ route("kontrol.update-data") }}',
      method: 'PUT',
      data: {
        "_token": "{{ csrf_token() }}",
        "dataRequest": requestSistem,
      },
      success: function(response) {
        console.log(response);
        if (response?.data?.metaData?.code == 200) {
          /** menampilkan modal sukses */
          $('#modalSuccess').modal('show');

          var noSep = response?.data?.response?.sep?.noSep;

          /** Membuat URL untuk cetak SEP dengan nomor SEP yang diperoleh */
          var printUrl = "{{ route('kontrol.rawatJalan') }}";

          /** Memperbarui atribut href dari tautan cetak SEP di dalam modal */
          $('#printLink').attr('href', printUrl);
        } else {
          alert(response?.data?.metaData?.message);
        }
      },
      error: function(xhr, status, error) {
        console.error(error);
      }
    });
  });
});
</script>

@endsection