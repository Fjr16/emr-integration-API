@extends('layouts.backend.main')

@section('content')

<div class="card p-3 mb-5">
  @if($dataSep->sumber_sep === 'Sudi Merawat' || $dataSep->sumber_sep === 'Lembar Kontrol')
  <div class="content">
    <div class="d-flex flex-row">
      <div class="col-3">
        <img src="{{ url('images/bpjs.png') }}" alt="" class="img-fluid my-2" style="max-width: 18rem; height: auto" />
      </div>
      <div class="ms-5 ps-4">
        @if($dataSep->sumber_sep === 'Sudi Merawat')
        <p class="fw-bold fs-4">
          SURAT RENCANA INAP <br />
          RS KHUSUS BEDAH ROPANASURI
        </p>
        @else
        <p class="fw-bold fs-4">
          SURAT RENCANA KONTROL <br />
          RS KHUSUS BEDAH ROPANASURI
        </p>
        @endif
      </div>
      <div class="col-3 ps-4">
        <p class="fs-6 fw-bold pt-2">No. {{ $dataSep->no_sep }}</p>
      </div>
    </div>

    <div class="row mt-5">
      <span class="my-2">Mohon Pemeriksaan dan Penanganan Lebih Lanjut :</span>
      <div class="col col-6">
        <table>
          <tr>
            <td>No. kartu</td>
            <td class="px-2">:</td>
            <td>{{ $dataSep->noka }}</td>
          </tr>
          <tr>
            <td>Nama Peserta</td>
            <td class="px-2">:</td>
            <td>
              <span class="text-uppercase">{{ $dataSep->nama_peserta }}</span>
              ({{ $dataSep->jenis_kelamin }})
            </td>
          </tr>
          <tr>
            <td>Tgl. lahir</td>
            <td class="px-2">:</td>
            <td>{{ Carbon\Carbon::parse($dataSep->tgl_lahir_peserta)->translatedFormat('d F Y') }}</td>
          </tr>
          <tr>
            <td>Diagnosa</td>
            <td class="px-2">:</td>
            <td>{{ $dataSep->diag_awal ?? '-' }}</td>
          </tr>
          <tr>
            <td>Rencana Inap</td>
            <td class="px-2">:</td>
            <td>{{ Carbon\Carbon::parse($dataSep->tgl_sep)->translatedFormat('d F Y') }}</td>
          </tr>
        </table>
      </div>
      <span class="my-2">Demikian atas bantuannya, diucapkan banyak terima
        kasih</span>
    </div>

    <div class="row mt-5">
      <div class="col col-8 small">
        <p class="mt-5 pt-5 text-muted">
          Tgl. Entri: {{ Carbon\Carbon::parse($dataSep->tgl_sep)->translatedFormat('d-m-Y') }} | Tgl. Cetak:
          {{ Carbon\Carbon::now('Asia/Jakarta')->format('d-m-Y H:i') }} WIB
        </p>
      </div>
      <div class="col col-4">
        <p>Mengetahui DPJP,</p>
        <img src="" alt="" />
        <p class="mt-5">{{ $dataSep->skd_dpjp }}</p>
      </div>
    </div>

    <p>
      <a href="{{ route('sep.beranda') }}" class="btn btn-warning shadow">Kembali</a>
      <a href="{{ route('sep.cetak-sep', ['noSep' => encrypt($dataSep->no_sep)]) }}" class="btn btn-dark shadow"
        target="_blank"><i class=" menu-icon tf-icons bx bx-printer"></i>
        Cetak</a>
    </p>
  </div>

  @else
  <div class="content">
    <div class="d-flex flex-row">
      <div class="col-3">
        <img src="{{ url('images/bpjs.png') }}" alt="" class="img-fluid my-2" style="max-width: 19rem; height: auto" />
      </div>
      <div class="ms-5 ps-4">
        <p class="fw-bold fs-4">
          SURAT ELEGIBILITAS PESERTA <br />
          RS KHUSUS BEDAH ROPANASURI
        </p>
      </div>
    </div>

    <div class="row mt-3">
      <div class="col col-6">
        <table>
          <tr>
            <td>No. SEP</td>
            <td class="px-2">:</td>
            <td>{{ $dataSep->no_sep }}</td>
          </tr>
          <tr>
            <td>Tgl. SEP</td>
            <td class="px-2">:</td>
            <td>{{ Carbon\Carbon::parse($dataSep->tgl_sep)->translatedFormat('d F Y') }}</td>
          </tr>
          <tr>
            <td>No. Kartu</td>
            <td class="px-2">:</td>
            <td>{{ $dataSep->noka }}</td>
          </tr>
          <tr>
            <td>Nama Peserta</td>
            <td class="px-2">:</td>
            <td class="text-uppercase">{{ $dataSep->nama_peserta }}</td>
          </tr>
          <tr>
            <td>Tgl. lahir</td>
            <td class="px-2">:</td>
            <td>{{ Carbon\Carbon::parse($dataSep->tgl_lahir_peserta)->translatedFormat('d F Y') }}</td>
          </tr>
          <tr>
            <td>No. Telepon</td>
            <td class="px-2">:</td>
            <td>{{ $dataSep->no_telp }}</td>
          </tr>
          <tr>
            <td>Jenis Kelamin</td>
            <td class="px-2">:</td>
            <td>{{ $dataSep->jenis_kelamin }}</td>
          </tr>
          <tr>
            <td>Poli Tujuan</td>
            <td class="px-2">:</td>
            <td class="text-uppercase">{{ $dataSep->poli_tujuan }}</td>
          </tr>
          <tr>
            <td>Faskes Perujuk</td>
            <td class="px-2">:</td>
            <td>{{ $dataSep->ppk_rujukan ?? '-' }}</td>
          </tr>
          <tr>
            <td>Diagnosa Awal</td>
            <td class="px-2">:</td>
            <td>{{ $dataSep->diag_awal }}</td>
          </tr>
          <tr>
            <td>Catatan</td>
            <td class="px-2">:</td>
            <td>{{ $dataSep->catatan ?? '-' }}</td>
          </tr>
        </table>
      </div>
      <div class="col col-6">
        <table>
          <tr>
            <td>Peserta</td>
            <td class="px-2">:</td>
            <td class="text-uppercase">{{ $dataSep->jenis_peserta }}</td>
          </tr>
          <tr>
            <td>COB</td>
            <td class="px-2">:</td>
            <td>{{ $dataSep->cob === 0 ? '-' : $dataSep->cob}}</td>
          </tr>
          <tr>
            <td>No. MR</td>
            <td class="px-2">:</td>
            <td>{{ implode("-", str_split($dataSep->no_mr, 2)) }}</td>
          </tr>
          <tr>
            <td>Jenis Rawat</td>
            <td class="px-2">:</td>
            <td>{{ $dataSep->jns_pelayanan }}</td>
          </tr>
          <tr>
            <td>Kelas Rawat</td>
            <td class="px-2">:</td>
            <td>{{ $dataSep->kls_rawat_hak }}</td>
          </tr>
          <tr>
            <td>Penjamin</td>
            <td class="px-2">:</td>
            <td>{{ $dataSep->penjamin ?? '-' }}</td>
          </tr>
        </table>
      </div>
    </div>

    <div class="row mt-5">
      <div class="col col-8 small">
        <p>
          *Saya menyetujui BPJS Kesehatan menggunakan informasi
          Medis Pasien jika diperlukan
          <br />
          *SEP bukan sebagai bukti penjaminan peserta
        </p>
        <p>
          <!-- Cetakan ke 0 -->
          <br />
          <!-- Afridayanti -->
        </p>
        <p>
          <a href="{{ route('sep.beranda') }}" class="btn btn-warning shadow">Kembali</a>
          <a href="{{ route('sep.cetak-sep', ['noSep' => encrypt($dataSep->no_sep)]) }}" class="btn btn-dark shadow"
            target="_blank"><i class=" menu-icon tf-icons bx bx-printer"></i>
            Cetak</a>
        </p>
      </div>
      <div class="col col-4">
        <p>Pasien/Keluarga Pasien</p>
        <img src="" alt="" />
        <p class="mt-5">----------------------</p>
      </div>
    </div>
  </div>
  @endif
</div>

@endsection