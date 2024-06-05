@extends('layouts.backend.main')

@section('content')

<div class="card mb-4">
  <div class="card-header d-flex align-items-center justify-content-between">
    <h5 class="mb-0">{{ $title === "SPRI" ? "Edit SPRI" : "Edit Surat Kontrol" }}</h5>
  </div>
  <div class="card-body">
    <div class="row mb-3 justify-content-center">
      <div class="col-md-12">
        <div class="row mb-3">
          <div class="col-md-6">
            <label class="col-form-label" for="no_sep">{{ $title === "SPRI" ? "Nomor SPRI" : "Nomor SEP" }}</label>
            <input type="text" class="form-control col-7" id="no_sep" name="no_sep"
              placeholder="{{ $title === 'SPRI' ? 'Masukkan nomor kartu' : 'Masukkan nomor SEP' }}"
              aria-describedby="defaultFormControlHelp"
              value="{{ $title === 'SPRI' ? $model->no_surat : $model->no_sep }}" />
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-6">
            <label class="col-form-label" for="tgl_kunjungan">Tanggal Kunjungan</label>
            <input type="date" class="form-control col-7" id="tgl_kunjungan" name="tgl_kunjungan"
              placeholder="Masukkan tanggal kujungan" aria-describedby="defaultFormControlHelp"
              value="{{ $model->tgl_kontrol }}" required />
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
          <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-dark ml-auto editDataSurat">Update</button>
            <a href="{{ $title === 'SPRI' ? route('kontrol.spri') : route('kontrol.rawatJalan') }}"
              class="btn btn-warning">Kembali</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

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
var title = "{{ $title }}";
var nomor = "{{ $model->noka }}";
var noSep = "{{ $model->no_sep }}";
var tglKunjungan = $('#tgl_kunjungan').val();
var jenis = title === 'SPRI' ? 1 : 2;
var selectedValue = "{{ $model->kd_poli }}";
var selectedCokter = "{{ $model->kd_dokter }}";
var kodePoli = selectedValue;

function loadPoliData() {
  $.ajax({
    url: '{{ route("kontrol.poli") }}',
    method: 'POST',
    data: {
      "_token": "{{ csrf_token() }}",
      "nomor": title === 'SPRI' ? nomor : noSep,
      "tgl": tglKunjungan,
      "jenis": jenis,
    },
    success: function(response) {
      if (response?.data?.metaData?.code == 200) {
        const res = response?.data?.response?.list;
        $('#poli_tujuan').empty();
        $('#poli_tujuan').append('<option value="">Pilih</option>');
        $.each(res, function(key, item) {
          var option = $('<option>', {
            value: item.kodePoli,
            namaValue: item.namaPoli,
            text: item.kodePoli + ' - ' + item.namaPoli
          });
          if (selectedValue && selectedValue === item.kodePoli) {
            option.attr('selected', 'selected');
          }
          $('#poli_tujuan').append(option);
        });
      } else {
        $('#poli_tujuan').empty();
        $('#poli_tujuan').append('<option value="">Pilih</option>');
        $('#poli_tujuan').append('<option value="" disabled>Data tidak ditemukan</option>');
      }
    },
    error: function(xhr, status, error) {
      console.error(error);
    }
  });
}

function loadDataDokter() {
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
      if (response?.data?.metaData?.code == 200) {
        const res = response?.data?.response?.list;
        $('#dokter').empty();
        $('#dokter').append(
          '<option value="">Pilih</option>');
        $.each(res, function(key, item) {
          var option = $('<option>', {
            value: item.kodeDokter,
            namaValue: item.namaDokter,
            text: item.kodeDokter + ' - ' + item.namaDokter
          });
          if (selectedCokter && selectedCokter === item.kodeDokter) {
            option.attr('selected', 'selected');
          }
          $('#dokter').append(option);
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
}

$(document).ready(function() {
  /** Memuat data poli saat halaman dimuat untuk pertama kalinya  */
  loadPoliData();
  loadDataDokter();

  /** Menangani event input untuk nomor dan tanggal kunjungan */
  $('#no_sep, #tgl_kunjungan').on('input', function() {
    /** Update inputan saat value berubah */
    tglKunjungan = $('#tgl_kunjungan').val();
    loadPoliData(); /** Panggil fungsi untuk memuat data poli saat input berubah */
  });

  $('#no_sep, #tgl_kunjungan, #poli_tujuan').on('input', function() {
    /** Update inputan saat value berubah */
    tglKunjungan = $('#tgl_kunjungan').val();
    kodePoli = $('#poli_tujuan').val();

    loadDataDokter(); /** Panggil fungsi untuk memuat data poli saat input berubah */
  });

  /** function edit/update surat kontrol rawat jalan */
  $('.editDataSurat').click(function() {
    /** Atur data sesuai dengan format yang diharapkan oleh API */
    var requestSistem = {
      "id": "{{ $model->id }}",
      "noSuratKontrol": "{{ $model->no_surat }}",
      "noSEP": $('#no_sep').val(),
      "kodeDokter": $('#dokter').val(),
      "poliKontrol": $('#poli_tujuan').val(),
      "tglRencanaKontrol": $('#tgl_kunjungan').val(),

      "nm_poli_tujuan": $('#poli_tujuan option:selected').attr('namaValue'),
      "nama_dokter": $('#dokter option:selected').attr('namaValue'),
    }

    if (title === "SPRI") {
      $.ajax({
        url: '{{ route("spri.update-data") }}',
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
            var printUrl = "{{ route('kontrol.spri') }}";

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
    } else {
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
    }
  });
});

// $(document).ready(function() {
//   /** inisialisasi variabel */
//   var kodePoli, namaPoli;
//   var title = "{{ $title }}";
//   var nomor = $('#no_sep').val();
//   var tglKunjungan = $('#tgl_kunjungan').val();
//   var jenis = title === 'SPRI' ? 1 : 2;
//   var selectedValue = "{{ $model->kd_poli }}";

//   // console.log({
//   //   nomor,
//   //   tglKunjungan
//   // })


//   var kodeDanNamaPoli = "{{ $model->kd_poli }} - {{ $model->poli_kontrol }}";
//   $('#poli_tujuan').val(kodeDanNamaPoli);
//   kodePoli = "{{ $model->kd_poli }}";
//   namaPoli = "{{ $model->poli_kontrol }}";

//   // /** function untuk pencarian poli tujuan */
//   // $('.btnCariDataPoli').click(function() {
//   //   var keyword = $('#poli').val();

//   //   /** untuk mengecek jika keyword ada mengandung spasi */
//   //   if (keyword.includes(' ')) {
//   //     keyword = keyword.replace(/\s+/g, '-');
//   //   } else {
//   //     keyword = $('#poli').val();
//   //   }

//   //   $.ajax({
//   //     url: '{{ route("sep.poli") }}',
//   //     method: 'POST',
//   //     data: {
//   //       "_token": "{{ csrf_token() }}",
//   //       "keyword": keyword,
//   //     },
//   //     success: function(response) {
//   //       $('#hasilPencarianPoli').empty(); /** Kosongkan hasil pencarian sebelumnya  */

//   //       if (response?.data?.metaData?.code == 200) {
//   //         const res = response?.data?.response?.poli;
//   //         /** Tampilkan hasil pencarian dalam tabel  */
//   //         $.each(res, function(index, vals) {
//   //           var row = '<tr>' +
//   //             '<td>' + vals.kode + '</td>' +
//   //             '<td>' + vals.nama + '</td>' +
//   //             '<td><input type="radio" name="radioPoli" value="' + vals.kode +
//   //             '" namaPoli="' +
//   //             vals.nama + '"></td>' +
//   //             '</tr>';
//   //           $('#hasilPencarianPoli').append(row);
//   //         });
//   //       } else {
//   //         var row = '<tr>' +
//   //           '<td colspan="3">Poli tidak ditemukan</td>' +
//   //           '</tr>';
//   //         $('#hasilPencarianPoli').append(row);
//   //       }
//   //     },
//   //     error: function(xhr, status, error) {
//   //       console.error(error);
//   //     }
//   //   });
//   // });

//   // /** function ketika klik radio button poli ketika pilih poli */
//   // $(document).on('click', 'input[name="radioPoli"]', function() {
//   //   kodePoli = $(this).val();
//   //   namaPoli = $(this).attr('namaPoli');
//   //   var kodeDanNamaPoli = kodePoli + ' - ' + namaPoli;
//   //   $('#poli_tujuan').val(kodeDanNamaPoli);

//   //   /** Menutup modal */
//   //   $('#dataPoli').modal('hide');
//   // });


//   /** 
//    * pencarian data poli tujuan kontrol
//    * dengan nomor kartu/sep dan tgl tidak boleh kosong
//    */
//   // $('#no_sep, #tgl_kunjungan').on('input', function() {
//   //   if (nomor.trim() !== '' && tglKunjungan.trim() !== '') {
//   //     $.ajax({
//   //       url: '{{ route("kontrol.poli") }}',
//   //       method: 'POST',
//   //       data: {
//   //         "_token": "{{ csrf_token() }}",
//   //         "nomor": nomor,
//   //         "tgl": tglKunjungan,
//   //         "jenis": jenis,
//   //       },
//   //       success: function(response) {
//   //         if (response?.data?.metaData?.code == 200) {
//   //           const res = response?.data?.response?.list;
//   //           $('#poli_tujuan').empty();
//   //           $('#poli_tujuan').append(
//   //             '<option value="">Pilih</option>');
//   //           $.each(res, function(key, item) {
//   //             //
//   //             var option = $('<option>', {
//   //               value: item.kodePoli,
//   //               namaValue: item.namaPoli,
//   //               text: item.kodePoli + ' - ' + item.namaPoli
//   //             });

//   //             if (selectedValue && selectedValue === item.kodePoli) {
//   //               option.attr('selected', 'selected');
//   //             }

//   //             $('#poli_tujuan').append(option);
//   //             //
//   //             // $('#poli_tujuan').append('<option value="' +
//   //             //   item.kodePoli +
//   //             //   '" namaValue="' + item.namaPoli + '">' + item.kodePoli + ' - ' + item.namaPoli +
//   //             //   '</option>');
//   //           });
//   //         } else {
//   //           $('#poli_tujuan').empty();
//   //           $('#poli_tujuan').append(
//   //             '<option value="">Pilih</option>');
//   //           $('#poli_tujuan').append(
//   //             '<option value="" disabled>Data tidak ditemukan</option>');
//   //         }
//   //       },
//   //       error: function(xhr, status, error) {
//   //         console.error(error);
//   //       }
//   //     });
//   //   } else {
//   //     /** Jika salah satu atau kedua input kosong, tampilkan pesan "tidak ada poli tersedia" */
//   //     $('#poli_tujuan').empty();
//   //     $('#poli_tujuan').append(
//   //       '<option value="">Pilih</option>');
//   //     $('#poli_tujuan').append(
//   //       '<option value="" disabled>Data tidak ditemukan</option>');
//   //   }
//   // });

//   $('#no_sep, #tgl_kunjungan').on('input', function() {
//     nomor = $('#no_sep').val(); // Update nilai nomor saat input berubah
//     tglKunjungan = $('#tgl_kunjungan').val(); // Update nilai tglKunjungan saat input berubah
//     console.log("Nomor:", nomor);
//     loadPoliData(); // Panggil fungsi untuk memuat data poli saat input berubah
//   });

//   function loadPoliData() {
//     if (nomor.trim() !== '' && tglKunjungan.trim() !== '') {
//       $.ajax({
//         url: '{{ route("kontrol.poli") }}',
//         method: 'POST',
//         data: {
//           "_token": "{{ csrf_token() }}",
//           "nomor": nomor,
//           "tgl": tglKunjungan,
//           "jenis": jenis,
//         },
//         success: function(response) {
//           if (response?.data?.metaData?.code == 200) {
//             const res = response?.data?.response?.list;
//             $('#poli_tujuan').empty();
//             $('#poli_tujuan').append('<option value="">Pilih</option>');
//             $.each(res, function(key, item) {
//               var option = $('<option>', {
//                 value: item.kodePoli,
//                 namaValue: item.namaPoli,
//                 text: item.kodePoli + ' - ' + item.namaPoli
//               });

//               if (selectedValue && selectedValue === item.kodePoli) {
//                 option.attr('selected', 'selected');
//               }

//               $('#poli_tujuan').append(option);
//             });
//           } else {
//             $('#poli_tujuan').empty();
//             $('#poli_tujuan').append('<option value="">Pilih</option>');
//             $('#poli_tujuan').append('<option value="" disabled>Data tidak ditemukan</option>');
//           }
//         },
//         error: function(xhr, status, error) {
//           console.error(error);
//         }
//       });
//     } else {
//       $('#poli_tujuan').empty();
//       $('#poli_tujuan').append('<option value="">Pilih</option>');
//       $('#poli_tujuan').append('<option value="" disabled>Data tidak ditemukan</option>');
//     }
//   }


//   /** function edit/update surat kontrol rawat jalan */
//   $('.editDataSurat').click(function() {
//     /** Atur data sesuai dengan format yang diharapkan oleh API */
//     var requestSistem = {
//       "id": "{{ $model->id }}",
//       "noSuratKontrol": "{{ $model->no_surat }}",
//       "noSEP": $('#no_sep').val(),
//       "kodeDokter": $('#dokter').val(),
//       "poliKontrol": kodePoli,
//       "tglRencanaKontrol": $('#tgl_kunjungan').val(),

//       "nm_poli_tujuan": namaPoli,
//       "nama_dokter": $('#dokter option:selected').attr('namaValue'),
//     }

//     if (title === "SPRI") {
//       $.ajax({
//         url: '{{ route("spri.update-data") }}',
//         method: 'PUT',
//         data: {
//           "_token": "{{ csrf_token() }}",
//           "dataRequest": requestSistem,
//         },
//         success: function(response) {
//           console.log(response);
//           if (response?.data?.metaData?.code == 200) {
//             /** menampilkan modal sukses */
//             $('#modalSuccess').modal('show');

//             var noSep = response?.data?.response?.sep?.noSep;

//             /** Membuat URL untuk cetak SEP dengan nomor SEP yang diperoleh */
//             var printUrl = "{{ route('kontrol.spri') }}";

//             /** Memperbarui atribut href dari tautan cetak SEP di dalam modal */
//             $('#printLink').attr('href', printUrl);
//           } else {
//             alert(response?.data?.metaData?.message);
//           }
//         },
//         error: function(xhr, status, error) {
//           console.error(error);
//         }
//       });
//     } else {
//       $.ajax({
//         url: '{{ route("kontrol.update-data") }}',
//         method: 'PUT',
//         data: {
//           "_token": "{{ csrf_token() }}",
//           "dataRequest": requestSistem,
//         },
//         success: function(response) {
//           console.log(response);
//           if (response?.data?.metaData?.code == 200) {
//             /** menampilkan modal sukses */
//             $('#modalSuccess').modal('show');

//             var noSep = response?.data?.response?.sep?.noSep;

//             /** Membuat URL untuk cetak SEP dengan nomor SEP yang diperoleh */
//             var printUrl = "{{ route('kontrol.rawatJalan') }}";

//             /** Memperbarui atribut href dari tautan cetak SEP di dalam modal */
//             $('#printLink').attr('href', printUrl);
//           } else {
//             alert(response?.data?.metaData?.message);
//           }
//         },
//         error: function(xhr, status, error) {
//           console.error(error);
//         }
//       });
//     }
//   });
// });
</script>

@endsection