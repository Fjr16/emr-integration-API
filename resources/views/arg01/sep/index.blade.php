@extends('layouts.backend.main')

@section('content')
@php
$today = \Carbon\Carbon::now()->toDateString();
@endphp

<div class="card mb-4">
  <div class="card-body">
    <div class="row mb-3 justify-content-center">
      <label class="col-sm-2 col-form-label" for="pencarian">Pencarian</label>
      <div class="col-sm-4">
        <select name="jenis_pencarian" id="jenis_pencarian" class="form-select select2">
          <option disabled selected>Pilih</option>
          @foreach ($jenisPencarian as $val)
          <option value="{{ $val['id'] }}" role="{{ $val['role'] }}">{{ $val['nama']}}</option>
          @endforeach
        </select>
      </div>
      <div class="col-sm-4">
        <input type="text" class="form-control col-7" id="nomor_pencarian" name="nomor_pencarian" placeholder="Masukkan nomor" aria-describedby="defaultFormControlHelp" required />
        <small id="error-message" class="text-danger" style="display: none;font-size">Nomor harus diisi sebelum
          melakukan pencarian.</small>
      </div>
      <div class="col-sm-2">
        <button type="submit" class="btn btn-dark btnPencarian">Cari</button>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-5">
    <div class="card mb-4">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Data Pasien</h5>
      </div>
      <div class="card-body card-data-pasien"></div>
    </div>
  </div>
  <div class="col-md-7">
    <div class="card mb-4">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Data SEP</h5>
      </div>
      <div class="card-body">
        <div class="card-data-sep">
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="jenis_pelayanan">Jenis Pelayanan</label>
            <div class="col-sm-10">
              <select name="jenis_pelayanan" id="jenis_pelayanan" class="form-select select2">
                <option value="" selected>Pilih</option>
                @foreach ($jenisPelayanan as $jp)
                <option value="{{ $jp['id'] }}" namaValue="{{ $jp['nama']}}">{{ $jp['nama']}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="tgl_sep">Tanggal SEP</label>
            <div class="col-sm-10">
              <input type="text" class="form-control col-7" id="tanggal-lahir" name="tgl_sep" placeholder="Masukkan tanggal SEP" aria-describedby="defaultFormControlHelp" required />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="asal_rujukan">Asal Rujukan</label>
            <div class="col-sm-10">
              <select name="asal_rujukan" id="asal_rujukan" class="form-select select2">
                <option value="" selected>Pilih</option>
                @foreach ($asalRujukan as $ar)
                <option value="{{ $ar['id'] }}" {{ $ar['id'] == 1 ? 'selected' : '' }} namavalue="{{ $ar['nama']}}">
                  {{ $ar['nama']}}
                </option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="ppk_asal_rujukan">PPK Asal Rujukan</label>
            <div class="col-sm-8">
              <div class="input-group">
                <input type="text" class="form-control col-7" id="ppk_asal_rujukan" name="ppk_asal_rujukan" placeholder="Faskes Rujukan" aria-describedby="defaultFormControlHelp" disabled />
                <button class="btn btn-secondary" id="rujukanClearInput">x</button>
              </div>
            </div>
            <div class="col-sm-2">
              <button type="button" id="btnPpkAsalRujukan" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#dataFaskes">Cari</button>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="tgl_rujukan">Tanggal Rujukan</label>
            <div class="col-sm-10">
              <input type="text" class="form-control col-7" id="tanggal-lahir" name="tgl_rujukan" placeholder="Masukkan tanggal rujukan" aria-describedby="defaultFormControlHelp" />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="nomor_rujukan">Nomor Rujukan</label>
            <div class="col-sm-10">
              <input type="text" class="form-control col-7" id="nomor_rujukan" name="nomor_rujukan" placeholder="Masukkan nomor rujukan" aria-describedby="defaultFormControlHelp" />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="kelas_rawat_naik">Kelas Rawat Naik</label>
            <div class="col-sm-10">
              <select name="kelas_rawat_naik" id="kelas_rawat_naik" class="form-select select2">
                <option value="" selected>Pilih</option>
                @foreach ($kelasRawatNaik as $rawatNaik)
                <option value="{{ $rawatNaik['id'] }}" namaValue="{{ $rawatNaik['nama'] }}">{{ $rawatNaik['nama']}}
                </option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="pembiayaan">Pembiayaan</label>
            <div class="col-sm-10">
              <select name="pembiayaan" id="pembiayaan" class="form-select select2">
                <option value="" selected>Pilih</option>
                @foreach ($kelasPembiayaan as $biaya)
                <option value="{{ $biaya['id'] }}" namaValue="{{ $biaya['nama'] }}">{{ $biaya['nama']}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="penanggung_jawab">Penanggung Jawab</label>
            <div class="col-sm-10">
              <input type="text" class="form-control col-7" id="penanggung_jawab" name="penanggung_jawab" placeholder="Masukkan penanggung jawab" aria-describedby="defaultFormControlHelp" />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="catatan">Catatan</label>
            <div class="col-sm-10">
              <textarea id="catatan" name="catatan" class="form-control"></textarea>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="diagnosa_awal">Diagnosa Awal</label>
            <div class="col-sm-8">
              <div class="input-group">
                <input type="text" class="form-control col-7" id="diagnosa_awal" name="diagnosa_awal" placeholder="Diagnosa" aria-describedby="defaultFormControlHelp" disabled />
                <button class="btn btn-secondary" id="diagnosaClearInput">x</button>
              </div>
            </div>
            <div class="col-sm-2">
              <button type="button" id="btnDiagnosaAwal" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#dataDiagnosa">Cari</button>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="poli_tujuan">Poli Tujuan</label>
            <div class="col-sm-8">
              <div class="input-group">
                <input type="text" class="form-control col-7" id="poli_tujuan" name="poli_tujuan" placeholder="Poli Tujuan" aria-describedby="defaultFormControlHelp" disabled />
                <button class="btn btn-secondary" id="poliClearInput">x</button>
              </div>
            </div>
            <div class="col-sm-2">
              <button type="button" id="btnPoliTujuan" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#dataPoli">Cari</button>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="cob">COB</label>
            <div class="col-sm-10">
              <div class="row">
                @foreach ($yaTidak as $choice)
                <div class="mr-2">
                  <input type="radio" id="cob" name="cob" value="{{ $choice['id'] }}" {{ $choice['id'] == 0 ? 'checked' : '' }} />
                  <label for="{{ $choice['id'] }}">{{ $choice['nama'] }}</label>
                </div>
                @endforeach
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="katarak">Katarak</label>
            <div class="col-sm-10">
              <div class="row">
                @foreach ($yaTidak as $vals)
                <div class="mr-2">
                  <input type="radio" id="katarak" name="katarak" value="{{ $vals['id'] }}" {{ $vals['id'] == 0 ? 'checked' : '' }} />
                  <label for="{{ $vals['id'] }}">{{ $vals['nama'] }}</label>
                </div>
                @endforeach
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="laka_lantas">Laka</label>
            <div class="col-sm-10">
              <div class="row">
                @foreach ($yaTidak as $laka)
                <div class="mr-2">
                  <input type="radio" id="laka_lantas" name="laka_lantas" value="{{ $laka['id'] }}" {{ $laka['id'] == 0 ? 'checked' : '' }} />
                  <label for="{{ $laka['id'] }}">{{ $laka['nama'] }}</label>
                </div>
                @endforeach
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="tujuan_kunj">Tujuan Kunjungan</label>
            <div class="col-sm-10">
              <select name="tujuan_kunj" id="tujuan_kunj" class="form-select select2">
                <option value="" selected>Pilih</option>
                @foreach ($tujuanKunjungan as $kunj)
                <option value="{{ $kunj['id'] }}" {{ $kunj['id'] == 0 ? 'selected' : '' }} namaValue="{{ $kunj['nama']}}">{{ $kunj['nama']}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="flag_prosedur">Flag Prosedur</label>
            <div class="col-sm-10">
              <select name="flag_prosedur" id="flag_prosedur" class="form-select select2">
                <option value="" selected>Pilih</option>
                @foreach ($flagProsedur as $flag)
                <option value="{{ $flag['id'] }}" namaValue="{{ $flag['nama']}}">{{ $flag['nama']}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="penunjang">Penunjang</label>
            <div class="col-sm-10">
              <select name="penunjang" id="penunjang" class="form-select select2">
                <option value="" selected>Pilih</option>
                @foreach ($kdPenunjang as $penunjang)
                <option value="{{ $penunjang['id'] }}" namaValue="{{ $penunjang['nama']}}">{{ $penunjang['nama']}}
                </option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="asessment_pel">Assessment Pelayanan</label>
            <div class="col-sm-10">
              <select name="asessment_pel" id="asessment_pel" class="form-select select2">
                <option value="" selected>Pilih</option>
                @foreach ($asesmentPel as $asesmen)
                <option value="{{ $asesmen['id'] }}" namaValue="{{ $asesmen['nama']}}">{{ $asesmen['nama']}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="no_skdp">Nomor Surat Kontrol</label>
            <div class="col-sm-10">
              <input type="text" class="form-control col-7" id="no_skdp" name="no_skdp" placeholder="Masukkan nomor surat kontrol" aria-describedby="defaultFormControlHelp" />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="dpjp_skdp">DPJP</label>
            <div class="col-sm-10">
              <input type="text" class="form-control col-7" id="dpjp_skdp" name="dpjp_skdp" placeholder="DPJP " aria-describedby="defaultFormControlHelp" />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="dpjp_layanan">DPJP Melayani</label>
            <div class="col-sm-10">
              <select name="dpjp_layanan" id="dpjp_layanan" class="form-select select2">
                <option value="">Pilih</option>
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="sumber_sep">Sumber Terbitan SEP</label>
            <div class="col-sm-10">
              <div class="row">
                @foreach ($sumberSEP as $sumber)
                <div class="mr-2">
                  <input type="radio" id="sumber_sep" name="sumber_sep" value="{{ $sumber['id'] }}" namaValue="{{ $sumber['nama'] }}" />
                  <label for="{{ $sumber['id'] }}">{{ $sumber['nama'] }}</label>
                </div>
                @endforeach
              </div>
            </div>
          </div>
          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="button" class="btn btn-dark simpanSEP">Simpan</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Modal untuk mencari faskes rujukan begin -->
<div class="modal fade" id="dataFaskes" tabindex="-1" aria-labelledby="dataFaskesLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="dataFaskesLabel">Cari Faskes Rujukan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row mb-3">
          <div class="col-sm-10">
            <input type="text" class="form-control col-7" id="faskes_rujukan" name="faskes_rujukan" placeholder="Masukkan kode atau nama faskes" aria-describedby="defaultFormControlHelp" />
          </div>
          <div class="col-sm-2">
            <button type="button" class="btn btn-dark btnCariFaskes">Cari</button>
          </div>
        </div>

        <div class="table-responsive">
          <table class="table">
            <thead style="background-color: #296c91">
              <tr>
                <th scope="col">Kode Faskes</th>
                <th scope="col">Nama Faskes</th>
                <th scope="col">Pilih</th>
              </tr>
            </thead>
            <tbody id="hasilPencarianFaskes">
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal untuk mencari faskes rujukan end -->

<!-- Modal untuk mencari diagnosa awal begin -->
<div class="modal fade" id="dataDiagnosa" tabindex="-1" aria-labelledby="dataDiagnosaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="dataDiagnosaLabel">Cari Diagnosa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row mb-3">
          <div class="col-sm-10">
            <input type="text" class="form-control col-7" id="diagnosa" name="diagnosa" placeholder="Masukkan kode atau nama diagnosa" aria-describedby="defaultFormControlHelp" />
          </div>
          <div class="col-sm-2">
            <button type="button" class="btn btn-dark btnCariDiagnosa">Cari</button>
          </div>
        </div>

        <div class="table-responsive">
          <table class="table">
            <thead style="background-color: #296c91">
              <tr>
                <th scope="col">Kode</th>
                <th scope="col">Diagnosa</th>
                <th scope="col">Pilih</th>
              </tr>
            </thead>
            <tbody id="hasilPencarianDiagnosa">
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal untuk mencari diagnosa awal end -->

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
            <input type="text" class="form-control col-7" id="poli" name="poli" placeholder="Masukkan kode atau nama poli" aria-describedby="defaultFormControlHelp" />
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

<!-- Modal menmpilkan succes create SEP begin -->
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
          <a id="printLink" href="#" class="btn btn-dark" target="_blank">Cetak SEP</a>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal menmpilkan succes create SEP end -->


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    /** inisialisasi variabel */
    var nomorKartu, nikPeserta, namaSKDPKontrol;
    var hakKelas, kodeFaskes, namaFaskes, noHpDb;
    var kodeDiagnosa, kodePpkAsal, namaPpkAsal;
    var kodePoli, namaPoli, kodeDPJP, namaDPJP;
    var namaHakKelas, formatted_no_rm, noRM, noHp;
    var rolePencarian, spriYes, idSuratKontrol;
    var tglSep;
    let jenis;

    /** fungsi yang digunakan untuk membersihkan form nomor pencarian jika select berubah */
    $('#jenis_pencarian').change(function() {
      $('#nomor_pencarian').val('');
    });

    /** menampilkan tanggal hari ini pada inputan tanggal SEP */
    $('#tanggal-lahir').val('{{ $today }}');

    $('.card-data-sep').hide(); /** hidden form sep */

    /** saat asal_rujukan kosong, maka tombol cari faskes rujukan disabled */
    if ($('#asal_rujukan option:selected').val() == '') {
      $('#btnPpkAsalRujukan').prop('disabled', true);
    }

    /** function ketika tombol cari di klik */
    $('.btnPencarian').click(function(e) {
      e.preventDefault();

      var jenisPencarian = $('#jenis_pencarian').val();
      var nomorPencarian = $('#nomor_pencarian').val();
      rolePencarian = $('#jenis_pencarian option:selected').attr('role');
      tglSep = $('input[name="tgl_sep"]').val();

      /** Periksa apakah form nomor_pencarian telah diisi */
      if (nomorPencarian.trim() === '') {
        $('#error-message').show(); // Tampilkan pesan kesalahan
        return; // Jangan lanjutkan aksi pencarian jika nomor tidak diisi
      } else {
        $('#error-message').hide(); // Sembunyikan pesan kesalahan jika nomor telah diisi
      }

      if (rolePencarian == "noka" || rolePencarian == "nik") {
        /** pencarian data berdasrkan NOKA dan NIK saja */
        $.ajax({
          url: '{{ route("sep.cek-peserta") }}',
          method: 'POST',
          data: {
            "_token": "{{ csrf_token() }}",
            "jenisPencarian": jenisPencarian,
            "nomorPencarian": nomorPencarian,
            // "role": rolePencarian
          },
          success: function(response) {
            if (response?.data?.metaData?.code == 200) {
              const value = response?.data?.response?.peserta;
              nomorKartu = value?.noKartu;
              hakKelas = value?.hakKelas?.kode;
              namaHakKelas = value?.hakKelas?.keterangan;
              noHp = value?.mr?.noTelepon;
              noHpDb = response?.pasien?.telp;
              nikPeserta = value?.nik;

              var no_rm = response?.pasien?.no_rm || '';
              formatted_no_rm = String(no_rm).padStart(6, '0').match(/.{1,2}/g).join('-');
              noRM = String(response?.pasien?.no_rm).padStart(6, '0').replace(/-/g, '');

              html = `
              <div>
                <div class="row mb-3">
                  <span class="col-md-5">Nomor Rekam Medis</span>
                  <span class="col-md-7">${formatted_no_rm}</span>
                </div>
                <div class="row mb-3">
                  <span class="col-md-5">Nama Pasien</span>
                  <span class="col-md-7">${value?.nama}</span>
                </div>
                <div class="row mb-3">
                  <span class="col-md-5">Status Pasien</span>
                  <span class="col-md-7">${value?.statusPeserta?.keterangan}</span>
                </div>
                <div class=" row mb-3">
                  <span class="col-md-5">NIK</span>
                  <span class="col-md-7">${value?.nik}</span>
                </div>
                <div class="row mb-3">
                  <span class="col-md-5">Tanggal Lahir</span>
                  <span class="col-md-7">${value?.tglLahir}</span>
                </div>
                <div class="row mb-3">
                  <span class="col-md-5">Tanggal Daftar</span>
                  <span class="col-md-7">${value?.tglTMT}</span>
                </div>
                <div class="row mb-3">
                  <span class="col-md-5">No. Telepon</span>
                  <span class="col-md-7">${value?.mr?.noTelepon  ?? noHpDb}</span>
                </div>
                <div class="row mb-3">
                  <span class="col-md-5">No. Kartu</span>
                  <span class="col-md-7">${value?.noKartu}</span>
                </div>
              </div>
            `;

              $('.card-data-pasien').html(html);
              $('.card-data-sep').show(); /** show form sep */

              $('#jenis_pelayanan').val("").change();
              $('#ppk_asal_rujukan').val("").change();
              $('input[name="tgl_rujukan"]').val("").change();
              $('#nomor_rujukan').val("").change();
              $('#diagnosa_awal').val("").change();
              $('#poli_tujuan').val("").change();
              $('#no_skdp').val("").change();
              $('#dpjp_skdp').val("").change();
              $('#catatan').val("").change();
            } else {
              // Jika tidak ada data, tampilkan pesan
              $('.card-data-pasien').html('<div>Data pasien tidak ditemukan</div>');
            }
          },
          error: function(xhr, status, error) {
            // Tangani galat jika terjadi
            console.error(error);
            // console.log(xhr.responseJSON.error)
            alert(error);
          }
        });
      } else if (rolePencarian == "rujukan" || rolePencarian == "rujukanrs") {
        $.ajax({
          url: '{{ route("sep.cek-rujukan") }}',
          method: 'POST',
          data: {
            "_token": "{{ csrf_token() }}",
            "jenisPencarian": jenisPencarian,
            "nomorPencarian": nomorPencarian,
            "role": rolePencarian,
          },
          success: function(response) {
            if (response?.data?.metaData?.code == 200) {
              const value = response?.data?.response?.rujukan;
              nomorKartu = value?.peserta?.noKartu;
              hakKelas = value?.peserta?.hakKelas?.kode;
              namaHakKelas = value?.peserta?.hakKelas?.keterangan;
              noHp = value?.peserta?.mr?.noTelepon;
              nikPeserta = value?.peserta?.nik;
              noHpDb = response?.pasien?.telp;

              var no_rm = response?.pasien?.no_rm || '';
              formatted_no_rm = String(no_rm).padStart(6, '0').match(/.{1,2}/g).join('-');
              noRM = String(response?.pasien?.no_rm).padStart(6, '0').replace(/-/g, '');

              html = `
              <div>
                <div class="row mb-3">
                  <span class="col-md-5">Nomor Rekam Medis</span>
                  <span class="col-md-7">${formatted_no_rm}</span>
                </div>
                <div class="row mb-3">
                  <span class="col-md-5">Nama Pasien</span>
                  <span class="col-md-7">${value?.peserta?.nama}</span>
                </div>
                <div class="row mb-3">
                  <span class="col-md-5">Status Pasien</span>
                  <span class="col-md-7">${value?.peserta?.statusPeserta?.keterangan}</span>
                </div>
                <div class=" row mb-3">
                  <span class="col-md-5">NIK</span>
                  <span class="col-md-7">${value?.peserta?.nik}</span>
                </div>
                <div class="row mb-3">
                  <span class="col-md-5">Tanggal Lahir</span>
                  <span class="col-md-7">${value?.peserta?.tglLahir}</span>
                </div>
                <div class="row mb-3">
                  <span class="col-md-5">Tanggal Daftar</span>
                  <span class="col-md-7">${value?.peserta?.tglTMT}</span>
                </div>
                <div class="row mb-3">
                  <span class="col-md-5">No. Telepon</span>
                  <span class="col-md-7">${value?.peserta?.mr?.noTelepon ?? noHpDb}</span>
                </div>
                <div class="row mb-3">
                  <span class="col-md-5">No. Kartu</span>
                  <span class="col-md-7">${value?.peserta?.noKartu}</span>
                </div>
              </div>
            `;

              $('.card-data-pasien').html(html);
              $('.card-data-sep').show(); /** show form sep */

              /** mengambil data untuk di sesuaikan pada inputan secara otomatis */
              var ppkAsal = value?.provPerujuk?.kode + ' - ' + value?.provPerujuk?.nama;
              var diagnosa = value?.diagnosa?.kode + ' - ' + value?.diagnosa?.nama;
              var poliTujuan = value?.poliRujukan?.kode + ' - ' + value?.poliRujukan?.nama;
              kodeDiagnosa = value?.diagnosa?.kode;
              kodePoli = value?.poliRujukan?.kode;
              namaPoli = value?.poliRujukan?.nama;
              kodePpkAsal = value?.provPerujuk?.kode;
              namaPpkAsal = value?.provPerujuk?.nama;
              $('#jenis_pelayanan').val(value?.pelayanan?.kode).change();
              $('#asal_rujukan').val(response?.data?.response?.asalFaskes).change();
              $('#ppk_asal_rujukan').val(ppkAsal).change();
              $('input[name="tgl_rujukan"]').val(value?.tglKunjungan).change();
              $('#nomor_rujukan').val(value?.noKunjungan).change();
              $('#catatan').val(value?.keluhan).change();
              $('#diagnosa_awal').val(diagnosa).change();
              $('#poli_tujuan').val(poliTujuan).change();
            } else {
              // Jika tidak ada data, tampilkan pesan
              $('.card-data-pasien').html('<div>Data pasien tidak ditemukan</div>');
            }
          },
          error: function(xhr, status, error) {
            // Tangani galat jika terjadi
            console.error(error);
            alert(error);
          }
        });
      } else if (rolePencarian == "kontrol") {
        $.ajax({
          url: '{{ route("sep.cek-kontrol") }}',
          method: 'POST',
          data: {
            "_token": "{{ csrf_token() }}",
            "jenisPencarian": jenisPencarian,
            "nomorPencarian": nomorPencarian,
            "role": rolePencarian,
          },
          success: function(response) {
            if (response?.data?.metaData?.code == 200) {
              const value = response?.peserta?.response?.peserta;
              nomorKartu = value?.noKartu;
              hakKelas = value?.hakKelas?.kode;
              namaHakKelas = value?.hakKelas?.keterangan;
              noHp = value?.mr?.noTelepon;
              nikPeserta = value?.nik;
              namaSKDPKontrol = response?.dataKontrol?.nama_dokter;
              idSuratKontrol = response?.dataKontrol?.id;
              noHpDb = response?.pasien?.telp;

              var no_rm = response?.pasien?.no_rm || '';
              formatted_no_rm = String(no_rm).padStart(6, '0').match(/.{1,2}/g).join('-');
              noRM = String(response?.pasien?.no_rm).padStart(6, '0').replace(/-/g, '');

              html = `
              <div>
                <div class="row mb-3">
                  <span class="col-md-5">Nomor Rekam Medis</span>
                  <span class="col-md-7">${formatted_no_rm}</span>
                </div>
                <div class="row mb-3">
                  <span class="col-md-5">Nama Pasien</span>
                  <span class="col-md-7">${value?.nama}</span>
                </div>
                <div class="row mb-3">
                  <span class="col-md-5">Status Pasien</span>
                  <span class="col-md-7">${value?.statusPeserta?.keterangan}</span>
                </div>
                <div class=" row mb-3">
                  <span class="col-md-5">NIK</span>
                  <span class="col-md-7">${value?.nik}</span>
                </div>
                <div class="row mb-3">
                  <span class="col-md-5">Tanggal Lahir</span>
                  <span class="col-md-7">${value?.tglLahir}</span>
                </div>
                <div class="row mb-3">
                  <span class="col-md-5">Tanggal Daftar</span>
                  <span class="col-md-7">${value?.tglTMT}</span>
                </div>
                <div class="row mb-3">
                  <span class="col-md-5">No. Telepon</span>
                  <span class="col-md-7">${value?.mr?.noTelepon ?? noHpDb}</span>
                </div>
                <div class="row mb-3">
                  <span class="col-md-5">No. Kartu</span>
                  <span class="col-md-7">${value?.noKartu}</span>
                </div>
              </div>
            `;

              $('.card-data-pasien').html(html);
              $('.card-data-sep').show(); /** show form sep */

              if (response?.data?.response?.jnsKontrol === "1" && response?.data?.response
                ?.namaJnsKontrol ===
                "Inap") {
                /** mengambil data untuk di sesuaikan pada inputan secara otomatis */
                const dataKontrol = response?.dataKontrol;
                kodeDPJP = response?.data?.response?.kodeDokter;
                spriYes = 1;
                jenis = 1;

                $('#jenis_pelayanan').val(jenis).change();
                $('#no_skdp').val(response?.data?.response?.noSuratKontrol).change();
                $('#dpjp_skdp').val(response?.data?.response?.namaDokter).change();
                $('#asal_rujukan').val(2).change();
              } else {
                const dataSep = response?.data?.response?.sep;
                /** mengambil data untuk di sesuaikan pada inputan secara otomatis */
                var ppkAsal = dataSep?.provPerujuk?.kdProviderPerujuk + ' - ' + dataSep?.provPerujuk
                  ?.nmProviderPerujuk;
                var kode = dataSep?.diagnosa?.split(' - ');
                kodeDiagnosa = kode[0];
                kodePoli = response?.data?.response?.poliTujuan;
                namaPoli = response?.data?.response?.namaPoliTujuan;
                kodePpkAsal = dataSep?.provPerujuk?.kdProviderPerujuk;
                namaPpkAsal = dataSep?.provPerujuk?.nmProviderPerujuk;
                kodeDPJP = response?.data?.response?.kodeDokter;
                jenis = 2;

                $('#jenis_pelayanan').val(jenis).change();
                $('#asal_rujukan').val(dataSep?.provPerujuk?.asalRujukan).change();
                $('#ppk_asal_rujukan').val(ppkAsal).change();
                // $('input[name="tgl_rujukan"]').val(dataSep?.provPerujuk?.tglRujukan).change();
                // $('#nomor_rujukan').val(dataSep?.provPerujuk?.noRujukan).change();
                $('input[name="tgl_rujukan"]').val(dataSep?.tglSep).change();
                $('#nomor_rujukan').val(dataSep?.noSep).change();
                $('#diagnosa_awal').val(dataSep?.diagnosa).change();
                $('#poli_tujuan').val(kodePoli).change();
                $('#no_skdp').val(response?.data?.response?.noSuratKontrol).change();
                $('#dpjp_skdp').val(response?.data?.response?.namaDokter).change();
              }

              /** 
               * pencarian data dokter DPJP
               * VClaim > Referensi > Dokter DPJP
               */
              $.ajax({
                url: '{{ route("sep.dpjp-layanan") }}',
                method: 'POST',
                data: {
                  "_token": "{{ csrf_token() }}",
                  "tgl": tglSep,
                  "jenis": jenis,
                  "kodePoli": kodePoli,
                },
                success: function(response) {
                  if (response?.data?.metaData?.code == 200) {
                    const res = response?.data?.response?.list;
                    $('#dpjp_layanan').empty();
                    $('#dpjp_layanan').append(
                      '<option value="">Pilih</option>');
                    $.each(res, function(key, item) {
                      $('#dpjp_layanan').append('<option value="' +
                        item.kode +
                        '" namaValue="' + item.nama + '">' + item.kode + ' - ' + item
                        .nama +
                        '</option>');
                    });
                  } else {
                    $('#dpjp_layanan').empty();
                    $('#dpjp_layanan').append(
                      '<option value="">Pilih</option>');
                    $('#dpjp_layanan').append(
                      '<option value="" disabled>Data tidak ditemukan</option>');
                  }
                },
                error: function(xhr, status, error) {
                  console.error(error);
                }
              });

            } else {
              // Jika tidak ada data, tampilkan pesan
              $('.card-data-pasien').html('<div>Data pasien tidak ditemukan</div>');
            }
          },
          error: function(xhr, status, error) {
            // Tangani galat jika terjadi
            console.error(error);
            alert(error);
          }
        });
      }
    });

    /** function untuk pencarian faskes dan menampilkan data faskes */
    $('.btnCariFaskes').click(function() {
      var keyword = $('#faskes_rujukan').val();
      var jenisFaskes = $('#asal_rujukan').val();

      /** untuk mengecek jika keyword ada mengandung spasi */
      if (keyword.includes(' ')) {
        keyword = keyword.replace(/\s+/g, '-');
      } else {
        keyword = $('#faskes_rujukan').val();
      }

      $.ajax({
        url: '{{ route("sep.faskes") }}',
        method: 'POST',
        data: {
          "_token": "{{ csrf_token() }}",
          "faskes": keyword,
          'jenisFaskes': jenisFaskes,
        },
        success: function(response) {
          $('#hasilPencarianFaskes').empty(); /** Kosongkan hasil pencarian sebelumnya  */

          if (response?.data?.metaData?.code == 200) {
            const res = response?.data?.response?.faskes;
            /** Tampilkan hasil pencarian dalam tabel  */
            $.each(res, function(index, vals) {
              var row = '<tr>' +
                '<td>' + vals.kode + '</td>' +
                '<td>' + vals.nama + '</td>' +
                '<td><input type="radio" name="radioFaskes" value="' + vals.kode + '" namaFaskes="' +
                vals.nama + '"></td>' +
                '</tr>';
              $('#hasilPencarianFaskes').append(row);
            });
          } else {
            var row = '<tr>' +
              '<td colspan="3">Faskes tidak ditemukan</td>' +
              '</tr>';
            $('#hasilPencarianFaskes').append(row);
          }
        },
        error: function(xhr, status, error) {
          console.error(error);
        }
      });
    });

    /** function ketika klik radio button ketika pilih faskes */
    $(document).on('click', 'input[name="radioFaskes"]', function() {
      kodeFaskes = $(this).val();
      namaFaskes = $(this).attr('namaFaskes');
      var kodeDanNamaFaskes = kodeFaskes + ' - ' + namaFaskes;

      $('#ppk_asal_rujukan').val(kodeDanNamaFaskes);

      /** Menutup modal faskes */
      $('#dataFaskes').modal('hide');

      if (spriYes === 1) {
        kodePpkAsal = kodeFaskes;
        namaPpkAsal = namaFaskes;
      }
    });

    /** function untuk pencarian diagnosa dan menampilkan data diagnosa */
    $('.btnCariDiagnosa').click(function() {
      var keyword = $('#diagnosa').val();

      /** untuk mengecek jika keyword ada mengandung spasi */
      if (keyword.includes(' ')) {
        keyword = keyword.replace(/\s+/g, '-');
      } else {
        keyword = $('#diagnosa').val();
      }

      $.ajax({
        url: '{{ route("sep.diagnosa") }}',
        method: 'POST',
        data: {
          "_token": "{{ csrf_token() }}",
          "keyword": keyword,
        },
        success: function(response) {
          $('#hasilPencarianDiagnosa').empty(); /** Kosongkan hasil pencarian sebelumnya  */

          if (response?.data?.metaData?.code == 200) {
            const res = response?.data?.response?.diagnosa;
            /** Tampilkan hasil pencarian dalam tabel  */
            $.each(res, function(index, vals) {
              var row = '<tr>' +
                '<td>' + vals.kode + '</td>' +
                '<td>' + vals.nama + '</td>' +
                '<td><input type="radio" name="radioDiagnosa" value="' + vals.kode +
                '" namaDiagnosa="' +
                vals.nama + '"></td>' +
                '</tr>';
              $('#hasilPencarianDiagnosa').append(row);
            });
          } else {
            var row = '<tr>' +
              '<td colspan="3">Diagnosa tidak ditemukan</td>' +
              '</tr>';
            $('#hasilPencarianDiagnosa').append(row);
          }
        },
        error: function(xhr, status, error) {
          console.error(error);
        }
      });
    });

    /** function ketika klik radio button diagnosa ketika pilih diagnosa */
    $(document).on('click', 'input[name="radioDiagnosa"]', function() {
      kodeDiagnosa = $(this).val();
      var namaDiagnosa = $(this).attr('namaDiagnosa');
      $('#diagnosa_awal').val(namaDiagnosa);

      /** Menutup modal diagnosa */
      $('#dataDiagnosa').modal('hide');
    });

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

      jenis = $('#jenis_pelayanan').val();

      /** 
       * pencarian data dokter DPJP
       * VClaim > Referensi > Dokter DPJP
       */
      if (kodePoli === 'IGD') {
        $.ajax({
          url: '{{ route("sep.dokter") }}',
          method: 'GET',
          success: function(response) {
            if (response?.data?.metadata?.code == 1) {
              const res = response?.data?.response;
              $('#dpjp_layanan').empty();
              $('#dpjp_layanan').append(
                '<option value="">Pilih</option>');
              $.each(res, function(key, item) {
                $('#dpjp_layanan').append('<option value="' +
                  item.kodedokter +
                  '" namaValue="' + item.namadokter + '">' + item.kodedokter + ' - ' + item
                  .namadokter +
                  '</option>');
              });
            } else {
              $('#dpjp_layanan').empty();
              $('#dpjp_layanan').append(
                '<option value="">Pilih</option>');
              $('#dpjp_layanan').append(
                '<option value="" disabled>Data tidak ditemukan</option>');
            }
          },
          error: function(xhr, status, error) {
            console.error(error);
          }
        });
      } else {
        $.ajax({
          url: '{{ route("sep.dpjp-layanan") }}',
          method: 'POST',
          data: {
            "_token": "{{ csrf_token() }}",
            "tgl": tglSep,
            "jenis": jenis,
            "kodePoli": kodePoli,
          },
          success: function(response) {
            if (response?.data?.metaData?.code == 200) {
              const res = response?.data?.response?.list;
              $('#dpjp_layanan').empty();
              $('#dpjp_layanan').append(
                '<option value="">Pilih</option>');
              $.each(res, function(key, item) {
                $('#dpjp_layanan').append('<option value="' +
                  item.kode +
                  '" namaValue="' + item.nama + '">' + item.kode + ' - ' + item
                  .nama +
                  '</option>');
              });
            } else {
              $('#dpjp_layanan').empty();
              $('#dpjp_layanan').append(
                '<option value="">Pilih</option>');
              $('#dpjp_layanan').append(
                '<option value="" disabled>Data tidak ditemukan</option>');
            }
          },
          error: function(xhr, status, error) {
            console.error(error);
          }
        });
      }

      /** Menutup modal */
      $('#dataPoli').modal('hide');
    });

    /** Fungsi untuk mengatur status tombol "Cari" saat pengguna memilih opsi pada elemen select */
    $('#asal_rujukan').change(function() {
      if ($(this).val() != '') {
        $('#btnPpkAsalRujukan').prop('disabled', false);
      } else {
        $('#btnPpkAsalRujukan').prop('disabled', true);
      }
    });


    /** function simpan/create SEP */
    $('.simpanSEP').click(function() {
      /** Atur data sesuai dengan format yang diharapkan oleh API */
      var requestSistem = {
        "noKartu": nomorKartu,
        "tglSep": $('#tanggal-lahir').val(),
        "ppkPelayanan": "0301R021",
        "jnsPelayanan": $('#jenis_pelayanan').val(),
        "klsRawatHak": hakKelas,
        "klsRawatNaik": $('#kelas_rawat_naik').val(),
        "pembiayaan": $('#pembiayaan').val(),
        "penanggungJawab": $('#penanggung_jawab').val(),
        "noMR": noRM,
        "asalRujukan": $('#asal_rujukan').val(),
        "tglRujukan": $('input[name="tgl_rujukan"]').val(),
        "noRujukan": $('#nomor_rujukan').val(),
        "ppkRujukan": kodePpkAsal ?? "",
        "catatan": $('#catatan').val(),
        "diagAwal": kodeDiagnosa ?? "",
        "tujuan": kodePoli ?? "",
        "eksekutif": "0",
        "cob": $('#cob').val(),
        "katarak": $('#katarak').val(),
        "lakaLantas": $('#laka_lantas').val(),
        "penjamin": "",
        "noLP": "",
        "tglKejadian": "",
        "keterangan": "",
        "suplesi": "0" ?? "",
        "noSepSuplesi": "",
        "kdPropinsi": "",
        "kdKabupaten": "",
        "kdKecamatan": "",
        "tujuanKunj": $('#tujuan_kunj').val() ?? "",
        "flagProcedure": $('#flag_prosedur').val() ?? "",
        "kdPenunjang": $('#penunjang').val() ?? "",
        "assesmentPel": $('#asessment_pel').val() ?? "",
        "noSurat": $('#no_skdp').val(),
        "kodeDPJP": rolePencarian === 'kontrol' ? kodeDPJP : $('#dpjp_skdp').val(),
        "dpjpLayan": $('#dpjp_layanan').val() ?? "",
        "noTelp": noHp ?? noHpDb,

        "nama_jns_pelayanan": $('#jenis_pelayanan option:selected').attr('namaValue') ?? "",
        "nm_kelas_rawat_hak": namaHakKelas ?? "",
        "nm_asal_rujukan": $('#asal_rujukan option:selected').attr('namaValue') ?? "",
        "nm_diag_awal": $('#diagnosa_awal').val() ?? "",
        "nm_poli_tujuan": namaPoli ?? "",
        "nm_tujuan_kunj": $('#tujuan_kunj option:selected').attr('namaValue') ?? "",
        "nm_flag_procedur": $('#flag_prosedur option:selected').attr('namaValue') ?? "",
        "nama_penunjang": $('#penunjang option:selected').attr('namaValue') ?? "",
        "nama_assesment": $('#asessment_pel option:selected').attr('namaValue') ?? "",
        "nama_dpjp_layanan": $('#dpjp_layanan option:selected').attr('namaValue') ?? "",
        "sumber_sep": $('input[name="sumber_sep"]:checked').attr('namaValue'),
        "nama_ppk_asal_rujukan": namaPpkAsal ?? "",
        "nik": nikPeserta,
        "nama_skdp_kontrol": namaSKDPKontrol ?? "",
        'idSuratKontrol': idSuratKontrol ?? "",
        'nama_kelas_naik': $('#kelas_rawat_naik option:selected').attr('namaValue'),
        "nama_pembiayaan": $('#pembiayaan option:selected').attr('namaValue') ?? "",
      }

      $.ajax({
        url: '{{ route("sep.create-sep") }}',
        method: 'POST',
        data: {
          "_token": "{{ csrf_token() }}",
          "dataRequestSistem": requestSistem,
        },
        success: function(response) {
          console.log(response);
          if (response?.data?.metaData?.code == 200) {
            /** menampilkan modal sukses */
            $('#modalSuccess').modal('show');

            var noSep = response?.sep_encrypt;

            /** Membuat URL untuk cetak SEP dengan nomor SEP yang diperoleh */
            var printUrl = "{{ route('sep.cetak-sep', ['noSep' => ':noSep']) }}".replace(':noSep', noSep);

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

    /** Menambahkan event listener ke ikon "x" untuk menghapus nilai input */
    document.getElementById('poliClearInput').addEventListener('click', function() {
      document.getElementById('poli_tujuan').value = '';
      kodePoli = '';
      namaPoli = '';
    });

    document.getElementById('rujukanClearInput').addEventListener('click', function() {
      document.getElementById('ppk_asal_rujukan').value = '';
      kodeFaskes = '';
      namaFaskes = '';
    });

    document.getElementById('diagnosaClearInput').addEventListener('click', function() {
      document.getElementById('diagnosa_awal').value = '';
      kodeDiagnosa = '';
      namaDiagnosa = '';
    });

    /** Menambahkan event listener ke input untuk menampilkan ikon "x" saat input tidak kosong */
    document.getElementById('poli_tujuan').addEventListener('input', function() {
      const clearInputIcon = document.getElementById('poliClearInput');
      if (this.value.trim() !== '') {
        clearInputIcon.style.visibility = 'visible';
      } else {
        clearInputIcon.style.visibility = 'hidden';
      }
    });

    document.getElementById('ppk_asal_rujukan').addEventListener('input', function() {
      const clearInputIcon = document.getElementById('rujukanClearInput');
      if (this.value.trim() !== '') {
        clearInputIcon.style.visibility = 'visible';
      } else {
        clearInputIcon.style.visibility = 'hidden';
      }
    });

    document.getElementById('diagnosa_awal').addEventListener('input', function() {
      const clearInputIcon = document.getElementById('diagnosaClearInput');
      if (this.value.trim() !== '') {
        clearInputIcon.style.visibility = 'visible';
      } else {
        clearInputIcon.style.visibility = 'hidden';
      }
    });

  });
</script>

@endsection