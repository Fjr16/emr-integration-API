@extends('layouts.backend.main')

@section('content')

<div class="card mb-2">
  <div class="card-header d-flex align-items-center justify-content-between">
    <h5 class="mb-0">Update Data SEP</h5>
  </div>
</div>

<div class="row">
  <div class="col-md-5">
    <div class="card mb-4">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Data Pasien</h5>
      </div>
      <div class="card-body">
        <div>
          <div class="row mb-3">
            <span class="col-md-5">Nomor Rekam Medis</span>
            <span
              class="col-md-7">{{ implode('-', str_split(str_pad($dataSep->no_mr, 6, '0', STR_PAD_LEFT), 2)) }}</span>
          </div>
          <div class="row mb-3">
            <span class="col-md-5">Nama Pasien</span>
            <span class="col-md-7">{{ $dataSep->nama_peserta }}</span>
          </div>
          <div class=" row mb-3">
            <span class="col-md-5">NIK</span>
            <span class="col-md-7">{{ $dataSep->nik }}</span>
          </div>
          <div class="row mb-3">
            <span class="col-md-5">Tanggal Lahir</span>
            <span class="col-md-7">{{ $dataSep->tgl_lahir_peserta }}</span>
          </div>
          <div class="row mb-3">
            <span class="col-md-5">No. Telepon</span>
            <span class="col-md-7">{{ $dataSep->no_telp }}</span>
          </div>
          <div class="row mb-3">
            <span class="col-md-5">No. Kartu</span>
            <span class="col-md-7">{{ $dataSep->noka }}</span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-7">
    <div class="card mb-4">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Data SEP</h5>
      </div>
      <div class="card-body">
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="jenis_pelayanan">Jenis Pelayanan</label>
          <div class="col-sm-10">
            <select name="jenis_pelayanan" id="jenis_pelayanan" class="form-select select2" disabled>
              <option value="" selected>Pilih</option>
              @foreach ($jenisPelayanan as $jp)
              @if($dataSep->kd_jns_pelayanan === $jp['id'])
              <option value="{{ $dataSep->kd_jns_pelayanan }}" namaValue="{{ $dataSep->jns_pelayanan }}" selected>
                {{ $dataSep->jns_pelayanan }}
              </option>
              @else
              <option value="{{ $jp['id'] }}" namaValue="{{ $jp['nama']}}">{{ $jp['nama']}}</option>
              @endif
              @endforeach
            </select>
          </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="tgl_sep">Tanggal SEP</label>
          <div class="col-sm-10">
            <input type="text" class="form-control col-7" id="tanggal-lahir" name="tgl_sep"
              placeholder="Masukkan tanggal SEP" aria-describedby="defaultFormControlHelp"
              value="{{ $dataSep->tgl_sep }}" disabled />
          </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="asal_rujukan">Asal Rujukan</label>
          <div class="col-sm-10">
            <select name="asal_rujukan" id="asal_rujukan" class="form-select select2" disabled>
              <option value="" selected>Pilih</option>
              @foreach ($asalRujukan as $ar)
              @if($dataSep->kd_asal_rujukan === $ar['id'])
              <option value="{{ $dataSep->kd_asal_rujukan }}" namavalue="{{ $dataSep->asal_rujukan }}" selected>
                {{ $dataSep->asal_rujukan }}</option>
              @else
              <option value="{{ $ar['id'] }}" {{ $ar['id'] == 1 ? 'selected' : '' }} namavalue="{{ $ar['nama']}}">
                {{ $ar['nama']}}</option>
              @endif
              @endforeach
            </select>
          </div>
        </div>
        <div class="row mb-3">
          @php
          $ppkAsal = null;
          if($dataSep->kd_ppk_rujukan && $dataSep->ppk_rujukan){
          $ppkAsal = $dataSep->kd_ppk_rujukan. ' - ' .$dataSep->ppk_rujukan;
          }
          @endphp
          <label class="col-sm-2 col-form-label" for="ppk_asal_rujukan">PPK Asal Rujukan</label>
          <div class="col-sm-10">
            <input type="text" class="form-control col-7" id="ppk_asal_rujukan" name="ppk_asal_rujukan"
              placeholder="Faskes Rujukan" aria-describedby="defaultFormControlHelp" value="{{ $ppkAsal }}" disabled />
          </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="tgl_rujukan">Tanggal Rujukan</label>
          <div class="col-sm-10">
            <input type="text" class="form-control col-7" id="tanggal-lahir" name="tgl_rujukan"
              placeholder="Masukkan tanggal rujukan" aria-describedby="defaultFormControlHelp"
              value="{{ $dataSep->tgl_rujukan }}" disabled />
          </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="nomor_rujukan">Nomor Rujukan</label>
          <div class="col-sm-10">
            <input type="text" class="form-control col-7" id="nomor_rujukan" name="nomor_rujukan"
              placeholder="Masukkan nomor rujukan" aria-describedby="defaultFormControlHelp"
              value="{{ $dataSep->no_rujukan }}" disabled />
          </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="kelas_rawat_naik">Kelas Rawat Naik</label>
          <div class="col-sm-10">
            <select name="kelas_rawat_naik" id="kelas_rawat_naik" class="form-select select2">
              <option value="" selected>Pilih</option>
              @foreach ($kelasRawatNaik as $rawatNaik)
              @if($dataSep->kd_kls_rawat_naik === $rawatNaik['id'])
              <option value="{{ $dataSep->kd_kls_rawat_naik }}" namaValue="{{ $dataSep->kls_rawat_naik }}" selected>
                {{ $dataSep->kls_rawat_naik }}
              </option>
              @else
              <option value="{{ $rawatNaik['id'] }}" namaValue="{{ $rawatNaik['nama'] }}">{{ $rawatNaik['nama']}}
              </option>
              @endif
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
              @if($dataSep->kd_kls_rawat_pembiayaan === $biaya['id'])
              <option value="{{ $dataSep->kd_kls_rawat_pembiayaan }}" namaValue="{{ $dataSep->kls_rawat_pembiayaan }}"
                selected>
                {{ $dataSep->kls_rawat_pembiayaan}}</option>
              @else
              <option value="{{ $biaya['id'] }}" namaValue="{{ $biaya['nama'] }}">{{ $biaya['nama']}}</option>
              @endif
              @endforeach
            </select>
          </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="penanggung_jawab">Penanggung Jawab</label>
          <div class="col-sm-10">
            <input type="text" class="form-control col-7" id="penanggung_jawab" name="penanggung_jawab"
              placeholder="Masukkan penanggung jawab" aria-describedby="defaultFormControlHelp"
              value="{{ $dataSep->kls_rawat_penanggung_jawab }}" />
          </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="catatan">Catatan*</label>
          <div class="col-sm-10">
            <textarea id="catatan" name="catatan" class="form-control">{{ $dataSep->catatan }}</textarea>
          </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="diagnosa_awal">Diagnosa Awal</label>
          <div class="col-sm-8">
            <div class="input-group">
              <input type="text" class="form-control col-7" id="diagnosa_awal" name="diagnosa_awal"
                placeholder="Diagnosa" aria-describedby="defaultFormControlHelp" disabled
                value="{{ $dataSep->diag_awal }}" />
              <button class="btn btn-secondary" id="diagnosaClearInput">x</button>
            </div>
          </div>
          <div class="col-sm-2">
            <button type="button" id="btnDiagnosaAwal" class="btn btn-dark" data-bs-toggle="modal"
              data-bs-target="#dataDiagnosa">Cari</button>
          </div>
        </div>
        <div class="row mb-3">
          @php
          $poliTujuan = null;
          if($dataSep->kode_poli_tujuan && $dataSep->poli_tujuan){
          $poliTujuan = $dataSep->kode_poli_tujuan. " - " .$dataSep->poli_tujuan;
          }
          @endphp
          <label class="col-sm-2 col-form-label" for="poli_tujuan">Poli Tujuan</label>
          <div class="col-sm-8">
            <div class="input-group">
              <input type="text" class="form-control col-7" id="poli_tujuan" name="poli_tujuan"
                placeholder="Poli Tujuan" aria-describedby="defaultFormControlHelp" disabled
                value="{{ $poliTujuan }}" />
              <button class="btn btn-secondary" id="poliClearInput">x</button>
            </div>
          </div>
          <div class="col-sm-2">
            <button type="button" id="btnPoliTujuan" class="btn btn-dark" data-bs-toggle="modal"
              data-bs-target="#dataPoli">Cari</button>
          </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="cob">COB</label>
          <div class="col-sm-10">
            <div class="row">
              @foreach ($yaTidak as $choice)
              <div class="mr-2">
                @if($dataSep->cob === $choice['id'])
                <input type="radio" id="cob" name="cob" value="{{ $dataSep->cob }}" checked />
                @else
                <input type="radio" id="cob" name="cob" value="{{ $choice['id'] }}"
                  {{ $choice['id'] == 0 ? 'checked' : '' }} />
                @endif
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
                @if($dataSep->katarak === $vals['id'])
                <input type="radio" id="katarak" name="katarak" value="{{ $dataSep->katarak }}" checked />
                @else
                <input type="radio" id="katarak" name="katarak" value="{{ $vals['id'] }}"
                  {{ $vals['id'] == 0 ? 'checked' : '' }} />
                @endif
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
                @if($dataSep->kd_laka_lantas === $laka['id'])
                <input type="radio" id="laka_lantas" name="laka_lantas" value="{{ $dataSep->kd_laka_lantas }}"
                  checked />
                @else
                <input type="radio" id="laka_lantas" name="laka_lantas" value="{{ $laka['id'] }}"
                  {{ $laka['id'] == 0 ? 'checked' : '' }} />
                @endif
                <label for="{{ $laka['id'] }}">{{ $laka['nama'] }}</label>
              </div>
              @endforeach
            </div>
          </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="tujuan_kunj">Tujuan Kunjungan</label>
          <div class="col-sm-10">
            <select name="tujuan_kunj" id="tujuan_kunj" class="form-select select2" disabled>
              <option value="" selected>Pilih</option>
              @foreach ($tujuanKunjungan as $kunj)
              @if($dataSep->kd_tujuan_kunj && $kunj['id'])
              <option value="{{ $dataSep->kd_tujuan_kunj }}" namaValue="{{ $dataSep->tujuan_kunj }}" selected>
                {{ $dataSep->tujuan_kunj }}</option>
              @else
              <option value="{{ $kunj['id'] }}" {{ $kunj['id'] == 0 ? 'selected' : '' }} namaValue="{{ $kunj['nama']}}">
                {{ $kunj['nama']}}</option>
              @endif
              @endforeach
            </select>
          </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="flag_prosedur">Flag Prosedur</label>
          <div class="col-sm-10">
            <select name="flag_prosedur" id="flag_prosedur" class="form-select select2" disabled>
              <option value="" selected>Pilih</option>
              @foreach ($flagProsedur as $flag)
              @if($dataSep->kd_flag_procedur === $flag['id'])
              <option value="{{ $dataSep->kd_flag_procedur }}" namaValue="{{ $dataSep->flag_procedur }}" selected>
                {{ $dataSep->flag_procedur }}</option>
              @else
              <option value="{{ $flag['id'] }}" namaValue="{{ $flag['nama']}}">{{ $flag['nama']}}</option>
              @endif
              @endforeach
            </select>
          </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="penunjang">Penunjang</label>
          <div class="col-sm-10">
            <select name="penunjang" id="penunjang" class="form-select select2" disabled>
              <option value="" selected>Pilih</option>
              @foreach ($kdPenunjang as $penunjang)
              @if($dataSep->kd_penunjang === $penunjang['id'])
              <option value="{{ $dataSep->kd_penunjang }}" namaValue="{{ $dataSep->nama_penunjang }}" selected>
                {{ $dataSep->nama_penunjang }}
              </option>
              @else
              <option value="{{ $penunjang['id'] }}" namaValue="{{ $penunjang['nama']}}">
                {{ $penunjang['nama']}}
              </option>
              @endif
              @endforeach
            </select>
          </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="asessment_pel">Assessment Pelayanan</label>
          <div class="col-sm-10">
            <select name="asessment_pel" id="asessment_pel" class="form-select select2" disabled>
              <option value="" selected>Pilih</option>
              @foreach ($asesmentPel as $asesmen)
              @if($dataSep->kd_assessment_pel === $asesmen['id'])
              <option value="{{ $dataSep->kd_assessment_pel }}" namaValue="{{ $dataSep->assessment_pel }}" selected>
                {{ $dataSep->assessment_pel }}</option>
              @else
              <option value="{{ $asesmen['id'] }}" namaValue="{{ $asesmen['nama']}}">{{ $asesmen['nama']}}
              </option>
              @endif
              @endforeach
            </select>
          </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="no_skdp">Nomor Surat Kontrol</label>
          <div class="col-sm-10">
            <input type="text" class="form-control col-7" id="no_skdp" name="no_skdp"
              placeholder="Masukkan nomor surat kontrol" aria-describedby="defaultFormControlHelp"
              value="{{ $dataSep->no_skdp }}" disabled />
          </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="dpjp_skdp">DPJP</label>
          <div class="col-sm-10">
            <input type="text" class="form-control col-7" id="dpjp_skdp" name="dpjp_skdp" placeholder="DPJP "
              aria-describedby="defaultFormControlHelp" value="{{ $dataSep->kd_skdp_dpjp }}" disabled />
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
                @if($dataSep->sumber_sep === $sumber['nama'])
                <input type="radio" id="sumber_sep" name="sumber_sep" value="{{ $sumber['id'] }}"
                  namaValue="{{ $dataSep->sumber_sep }}" checked />
                @else
                <input type="radio" id="sumber_sep" name="sumber_sep" value="{{ $sumber['id'] }}"
                  namaValue="{{ $sumber['nama'] }}" />
                @endif
                <label for="{{ $sumber['id'] }}">{{ $sumber['nama'] }}</label>
              </div>
              @endforeach
            </div>
          </div>
        </div>
        <div class="row justify-content-end">
          <div class="col-sm-10">
            <button type="button" class="btn btn-dark updateSEP">Update</button>
            <a href="{{ route('sep.beranda') }}" class="btn btn-warning">Kembali</a>
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
          <a id="printLink" href="#" class="btn btn-dark">Lihat SEP</a>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal menmpilkan succes update surat kontrol end -->

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
            <input type="text" class="form-control col-7" id="faskes_rujukan" name="faskes_rujukan"
              placeholder="Masukkan kode atau nama faskes" aria-describedby="defaultFormControlHelp" />
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
            <input type="text" class="form-control col-7" id="diagnosa" name="diagnosa"
              placeholder="Masukkan kode atau nama diagnosa" aria-describedby="defaultFormControlHelp" />
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
/** inisialisasi variabel */
var nomorKartu = "{{ $dataSep->noka }}";
var nikPeserta = "{{ $dataSep->nik }}";
var hakKelas = "{{ $dataSep->kd_kelas_rawat_hak }}";
var kodeDiagnosa = "{{ $dataSep->kd_diag_awal }}";
var kodePoli = "{{ $dataSep->kode_poli_tujuan }}";
var namaPoli = "{{ $dataSep->poli_tujuan }}";
var kodeDPJP = "{{ $dataSep->kd_dpjp_layanan }}";
var namaDPJP = "{{ $dataSep->dpjp_layanan }}";
var namaHakKelas = "{{ $dataSep->kls_rawat_hak }}";
var noRM = "{{ $dataSep->no_mr }}";
var noHp = "{{ $dataSep->no_telp }}";
var tglSep = "{{ $dataSep->tgl_sep }}";
let jenis = "{{ $dataSep->kd_jns_pelayanan }}";
var selectedValue = "{{ $dataSep->kd_dpjp_layanan }}";

/** 
 * pencarian data dokter DPJP
 * VClaim > Referensi > Dokter DPJP
 */
function loadDPJPLayanan() {
  if (kodePoli === 'IGD') {
    $.ajax({
      url: '{{ route("sep.dokter") }}',
      method: 'GET',
      success: function(response) {
        if (response?.data?.metadata?.code == 1) {
          const res = response?.data?.response;
          $('#dpjp_layanan').empty();
          $('#dpjp_layanan').append('<option value="">Pilih</option>');
          $.each(res, function(key, item) {
            var option = $('<option>', {
              value: item.kodedokter,
              namaValue: item.namadokter,
              text: item.kodedokter + ' - ' + item.namadokter
            });
            if (parseInt(selectedValue) && parseInt(selectedValue) === item.kodedokter) {
              option.attr('selected', 'selected');
            }
            $('#dpjp_layanan').append(option);
          });
        } else {
          $('#dpjp_layanan').empty();
          $('#dpjp_layanan').append('<option value="">Pilih</option>');
          $('#dpjp_layanan').append('<option value="" disabled>Data tidak ditemukan</option>');
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
            var option = $('<option>', {
              value: item.kode,
              namaValue: item.nama,
              text: item.kode + ' - ' + item.nama
            });
            if (selectedValue && selectedValue === item.kode) {
              option.attr('selected', 'selected');
            }
            $('#dpjp_layanan').append(option);
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
}

$(document).ready(function() {
  /** Memuat data dpjp layanan saat halaman dimuat untuk pertama kalinya  */
  loadDPJPLayanan();

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
    tglSep = $('input[name="tgl_sep"]').val();

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

      /** Menutup modal */
      $('#dataPoli').modal('hide');
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

      /** Menutup modal */
      $('#dataPoli').modal('hide');
    }
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

  document.getElementById('diagnosa_awal').addEventListener('input', function() {
    const clearInputIcon = document.getElementById('diagnosaClearInput');
    if (this.value.trim() !== '') {
      clearInputIcon.style.visibility = 'visible';
    } else {
      clearInputIcon.style.visibility = 'hidden';
    }
  });


  /** Menambahkan event listener ke ikon "x" untuk menghapus nilai input */
  document.getElementById('poliClearInput').addEventListener('click', function() {
    document.getElementById('poli_tujuan').value = '';
    kodePoli = '';
    namaPoli = '';
  });

  document.getElementById('diagnosaClearInput').addEventListener('click', function() {
    document.getElementById('diagnosa_awal').value = '';
    kodeDiagnosa = '';
    namaDiagnosa = '';
  });

  /** function update SEP */
  $('.updateSEP').click(function() {
    /** Atur data sesuai dengan format yang diharapkan oleh API */
    var noSep = "{{ $dataSep->no_sep }}";
    var idSep = "{{ encrypt($dataSep->id) }}";

    var requestSistem = {
      "idSep": idSep,
      "noSep": noSep,
      "klsRawatHak": hakKelas,
      "klsRawatNaik": $('#kelas_rawat_naik').val(),
      "pembiayaan": $('#pembiayaan').val(),
      "penanggungJawab": $('#penanggung_jawab').val(),
      "noMR": noRM,
      "catatan": $('#catatan').val(),
      "diagAwal": kodeDiagnosa ?? "",
      "tujuan": kodePoli ?? "",
      "eksekutif": "0",
      "cob": $('#cob').val(),
      "katarak": $('#katarak').val(),
      "lakaLantas": $('#laka_lantas').val(),
      "tglKejadian": "",
      "keterangan": "",
      "suplesi": "0" ?? "",
      "noSepSuplesi": "",
      "kdPropinsi": "",
      "kdKabupaten": "",
      "kdKecamatan": "",
      "dpjpLayan": $('#dpjp_layanan').val() ?? "",
      "noTelp": noHp,

      "nm_diag_awal": $('#diagnosa_awal').val() ?? "",
      "nm_poli_tujuan": namaPoli ?? "",
      "nama_dpjp_layanan": $('#dpjp_layanan option:selected').attr('namaValue') ?? "",
      "sumber_sep": $('input[name="sumber_sep"]:checked').attr('namaValue'),
      'nama_kelas_naik': $('#kelas_rawat_naik option:selected').attr('namaValue'),
      "nama_pembiayaan": $('#pembiayaan option:selected').attr('namaValue'),
    }

    $.ajax({
      url: '{{ route("sep.update-sep") }}',
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

          var noSep = response?.sep_encrypt;

          /** Membuat URL untuk cetak SEP dengan nomor SEP yang diperoleh */
          var printUrl = "{{ route('sep.view', ['idSep' => ':idSep']) }}".replace(':idSep', idSep);

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