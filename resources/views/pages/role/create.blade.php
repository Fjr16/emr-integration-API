@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif

<div class="card mb-4 mt-5">
  <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0">Tambah Role</span></h5>
  </div>
  <form method="POST" action="{{ route('user/role.store') }}" class="mb-5">
    @csrf
    <div class="card-body">
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Role</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="basic-default-name" required />
            </div>
        </div>
    </div>
    <div class="card-header d-flex align-items-center justify-content-between">
      <h4 class="mb-0">Roles Permission</h4>
    </div>
    @php
      $transaksiGudangs = array_filter($permission->toArray(), function($arr){
        return strpos($arr['name'], 'obat gudang farmasi') !== false;
      });
      $stokObats = array_filter($permission->toArray(), function($arr){
        return strpos($arr['name'], 'stok obat di rumah sakit') !== false;
      });
      $distribusis = array_filter($permission->toArray(), function($arr){
        return strpos($arr['name'], 'distribusi obat antar unit') !== false;
      });
      $formLuarMaps = array_filter($permission->toArray(), function($arr){
        return strpos($arr['name'], 'luar map') !== false;
      });
      $igds = array_filter($permission->toArray(), function($arr){
        return strpos($arr['name'], 'igd') !== false;
      });
      $statusRanjangs = array_filter($permission->toArray(), function($arr){
        return strpos($arr['name'], 'status penggunaan ranjang') !== false;
      });
      $polis = array_filter($permission->toArray(), function($arr){
        return strpos($arr['name'], 'poli') !== false;
      });
      $assesmenAwal = array_filter($permission->toArray(), function($arr){
        return strpos($arr['name'], 'assesmen awal') !== false;
      });
      $radiologiReqs = array_filter($permission->toArray(), function($arr){
        return strpos($arr['name'], 'permintaan radiologi') !== false;
      });
      $laborReqs = array_filter($permission->toArray(), function($arr){
        return strpos($arr['name'], 'permintaan labor pk') !== false;
      });
      $laborPaReqs = array_filter($permission->toArray(), function($arr){
        return strpos($arr['name'], 'permintaan labor pa') !== false;
      });
      $rmePerawats = array_filter($permission->toArray(), function($arr){
        return strpos($arr['name'], 'rme perawat') !== false;
      });
      $asuhans = array_filter($permission->toArray(), function($arr){
        return strpos($arr['name'], 'asuhan keperawatan') !== false;
      });
      $cppts = array_filter($permission->toArray(), function($arr){
        return strpos($arr['name'], 'cppt') !== false;
      });
      $prmrjs = array_filter($permission->toArray(), function($arr){
        return strpos($arr['name'], 'prmrj') !== false;
      });
      $tindakans = array_filter($permission->toArray(), function($arr){
        return strpos($arr['name'], 'laporan tindakan') !== false;
      });
      $rekamMedis = array_filter($permission->toArray(), function($arr){
        return strpos($arr['name'], 'rekam medis') !== false;
      });
      $queues = array_filter($permission->toArray(), function($arr){
        return strpos($arr['name'], 'antrian') !== false;
      });
      $pasiens = array_filter($permission->toArray(), function($arr){
        return strpos($arr['name'], 'pasien rumah sakit') !== false;
      });
      $farmasiRajals = array_filter($permission->toArray(), function($arr){
        return strpos($arr['name'], 'farmasi rajal') !== false;
      });
      $medicineReceipts = array_filter($permission->toArray(), function($arr){
        return strpos($arr['name'], 'resep obat') !== false;
      });
      $kasirs = array_filter($permission->toArray(), function($arr){
        return strpos($arr['name'], 'pembayaran') !== false;
      });
      $radiologis = array_filter($permission->toArray(), function($arr){
        return strpos($arr['name'], 'pemeriksaan radiologi') !== false;
      });
      $laborPks = array_filter($permission->toArray(), function($arr){
        return strpos($arr['name'], 'pemeriksaan laboratorium pk') !== false;
      });
      $laborPas = array_filter($permission->toArray(), function($arr){
        return strpos($arr['name'], 'pemeriksaan laboratorium pa') !== false;
      });
      $receiptDokters = array_filter($permission->toArray(), function($arr){
        return strpos($arr['name'], 'resep dokter') !== false;
      });
      $suratRanaps = array_filter($permission->toArray(), function($arr){
        return strpos($arr['name'], 'surat pengantar ranap') !== false;
      });
      $ranaps = array_filter($permission->toArray(), function($arr){
        return strpos($arr['name'], 'pasien ranap') !== false;
      });
      $skriningRanaps = array_filter($permission->toArray(), function($arr){
        return strpos($arr['name'], ' skrining covid') !== false;
      });
      $cpaRanaps = array_filter($permission->toArray(), function($arr){
        return strpos($arr['name'], 'catatan perjalanan administrasi') !== false;
      });
      $tilikRanaps = array_filter($permission->toArray(), function($arr){
        return strpos($arr['name'], 'tilik pasien') !== false;
      });
      $assKepRanaps = array_filter($permission->toArray(), function($arr){
        return strpos($arr['name'], 'assesmen keperawatan ranap') !== false;
      });
      $formRekonsiRanaps = array_filter($permission->toArray(), function($arr){
        return strpos($arr['name'], 'formulir rekonsiliasi') !== false;
      });
      $masters = array_filter($permission->toArray(), function($arr){
        return strpos($arr['name'], 'master') !== false;
      });
    @endphp

    <div class="card-body">
      <div class="row mb-3">
        <div class="col-sm-4 mb-3">
          <h5 class="mb-2">Form Diluar Map :</h5>
          @foreach ($formLuarMaps as $formLuarMap)
            <input type="checkbox" id="checkbox[{{ $formLuarMap['id'] }}]" name="permission_id[]" value="{{ $formLuarMap['id'] }}">
            <label for="checkbox[{{ $formLuarMap['id'] }}]">{{ $formLuarMap['name'] }}</label><br>
          @endforeach
        </div> 
        <div class="col-sm-4 mb-3">
          <h5 class="mb-2">Transaksi Obat :</h5>
          @foreach ($transaksiGudangs as $transaksiGudang)
            <input type="checkbox" id="checkbox[{{ $transaksiGudang['id'] }}]" name="permission_id[]" value="{{ $transaksiGudang['id'] }}">
            <label for="checkbox[{{ $transaksiGudang['id'] }}]">{{ $transaksiGudang['name'] }}</label><br>
          @endforeach
        </div> 
        <div class="col-sm-4 mb-3">
          <h5 class="mb-2">Stok Obat :</h5>
          @foreach ($stokObats as $stokObat)
            <input type="checkbox" id="checkbox[{{ $stokObat['id'] }}]" name="permission_id[]" value="{{ $stokObat['id'] }}">
            <label for="checkbox[{{ $stokObat['id'] }}]">{{ $stokObat['name'] }}</label><br>
          @endforeach
        </div> 
        <div class="col-sm-4 mb-3">
          <h5 class="mb-2">Distribusi Obat :</h5>
          @foreach ($distribusis as $distribusi)
            <input type="checkbox" id="checkbox[{{ $distribusi['id'] }}]" name="permission_id[]" value="{{ $distribusi['id'] }}">
            <label for="checkbox[{{ $distribusi['id'] }}]">{{ $distribusi['name'] }}</label><br>
          @endforeach
        </div> 
        <div class="col-sm-4 mb-3">
          <h5 class="mb-2">Poli :</h5>
          @foreach ($polis as $poli)
            <input type="checkbox" id="checkbox[{{ $poli['id'] }}]" name="permission_id[]" value="{{ $poli['id'] }}">
            <label for="checkbox[{{ $poli['id'] }}]">{{ $poli['name'] }}</label><br>
          @endforeach
        </div> 
        <div class="col-sm-4 mb-3">
          <h5 class="mb-2">Assesmen Awal :</h5>
          @foreach ($assesmenAwal as $assesmen)
            <input type="checkbox" id="checkbox[{{ $assesmen['id'] }}]" name="permission_id[]" value="{{ $assesmen['id'] }}">
            <label for="checkbox[{{ $assesmen['id'] }}]">{{ $assesmen['name'] }}</label><br>
          @endforeach
        </div>
        <div class="col-sm-4 mb-3">
          <h5 class="mb-2">Permintaan Radiologi :</h5>
          @foreach ($radiologiReqs as $radiologiReq)
            <input type="checkbox" id="checkbox[{{ $radiologiReq['id'] }}]" name="permission_id[]" value="{{ $radiologiReq['id'] }}">
            <label for="checkbox[{{ $radiologiReq['id'] }}]">{{ $radiologiReq['name'] }}</label><br>
          @endforeach
        </div>
        <div class="col-sm-4 mb-3">
          <h5 class="mb-2">Permintaan Laboratorium PK :</h5>
          @foreach ($laborReqs as $laborReq)
            <input type="checkbox" id="checkbox[{{ $laborReq['id'] }}]" name="permission_id[]" value="{{ $laborReq['id'] }}">
            <label for="checkbox[{{ $laborReq['id'] }}]">{{ $laborReq['name'] }}</label><br>
          @endforeach
        </div>
        <div class="col-sm-4 mb-3">
          <h5 class="mb-2">Permintaan Laboratorium PA :</h5>
          @foreach ($laborPaReqs as $laborPaReq)
            <input type="checkbox" id="checkbox[{{ $laborPaReq['id'] }}]" name="permission_id[]" value="{{ $laborPaReq['id'] }}">
            <label for="checkbox[{{ $laborPaReq['id'] }}]">{{ $laborPaReq['name'] }}</label><br>
          @endforeach
        </div>
        <div class="col-sm-4 mb-3">
          <h5 class="mb-2">RME Perawat :</h5>
          @foreach ($rmePerawats as $rmePerawat)
            <input type="checkbox" id="checkbox[{{ $rmePerawat['id'] }}]" name="permission_id[]" value="{{ $rmePerawat['id'] }}">
            <label for="checkbox[{{ $rmePerawat['id'] }}]">{{ $rmePerawat['name'] }}</label><br>
          @endforeach
        </div>
        <div class="col-sm-4 mb-3">
          <h5 class="mb-2">Asuhan Keperawatan :</h5>
          @foreach ($asuhans as $asuhan)
            <input type="checkbox" id="checkbox[{{ $asuhan['id'] }}]" name="permission_id[]" value="{{ $asuhan['id'] }}">
            <label for="checkbox[{{ $asuhan['id'] }}]">{{ $asuhan['name'] }}</label><br>
          @endforeach
        </div>
        <div class="col-sm-4 mb-3">
          <h5 class="mb-2">CPPT :</h5>
          @foreach ($cppts as $cppt)
            <input type="checkbox" id="checkbox[{{ $cppt['id'] }}]" name="permission_id[]" value="{{ $cppt['id'] }}">
            <label for="checkbox[{{ $cppt['id'] }}]">{{ $cppt['name'] }}</label><br>
          @endforeach
        </div>
        <div class="col-sm-4 mb-3">
          <h5 class="mb-2">PRMRJ :</h5>
          @foreach ($prmrjs as $prmrj)
            <input type="checkbox" id="checkbox[{{ $prmrj['id'] }}]" name="permission_id[]" value="{{ $prmrj['id'] }}">
            <label for="checkbox[{{ $prmrj['id'] }}]">{{ $prmrj['name'] }}</label><br>
          @endforeach
        </div>
        <div class="col-sm-4 mb-3">
          <h5 class="mb-2">Tindakan :</h5>
          @foreach ($tindakans as $tindakan)
            <input type="checkbox" id="checkbox[{{ $tindakan['id'] }}]" name="permission_id[]" value="{{ $tindakan['id'] }}">
            <label for="checkbox[{{ $tindakan['id'] }}]">{{ $tindakan['name'] }}</label><br>
          @endforeach
        </div>
        <div class="col-sm-4 mb-3">
          <h5 class="mb-2">Resep Dokter :</h5>
          @foreach ($receiptDokters as $receipt)
            <input type="checkbox" id="checkbox[{{ $receipt['id'] }}]" name="permission_id[]" value="{{ $receipt['id'] }}">
            <label for="checkbox[{{ $receipt['id'] }}]">{{ $receipt['name'] }}</label><br>
          @endforeach
        </div>
        <div class="col-sm-4 mb-3">
          <h5 class="mb-2">Surat Pengantar Ranap :</h5>
          @foreach ($suratRanaps as $suratRanap)
            <input type="checkbox" id="checkbox[{{ $suratRanap['id'] }}]" name="permission_id[]" value="{{ $suratRanap['id'] }}">
            <label for="checkbox[{{ $suratRanap['id'] }}]">{{ $suratRanap['name'] }}</label><br>
          @endforeach
        </div>
        <div class="col-sm-4 mb-3">
          <h5 class="mb-2">Ranap :</h5>
          @foreach ($ranaps as $ranap)
            <input type="checkbox" id="checkbox[{{ $ranap['id'] }}]" name="permission_id[]" value="{{ $ranap['id'] }}" >
            <label for="checkbox[{{ $ranap['id'] }}]">{{ $ranap['name'] }}</label><br>
          @endforeach
        </div>
        <div class="col-sm-4 mb-3">
          <h5 class="mb-2">Skrining Covid Ranap :</h5>
          @foreach ($skriningRanaps as $skriningRanap)
            <input type="checkbox" id="checkbox[{{ $skriningRanap['id'] }}]" name="permission_id[]" value="{{ $skriningRanap['id'] }}" >
            <label for="checkbox[{{ $skriningRanap['id'] }}]">{{ $skriningRanap['name'] }}</label><br>
          @endforeach
        </div>
        <div class="col-sm-4 mb-3">
          <h5 class="mb-2">Catatan Perjalanan Administrasi Ranap :</h5>
          @foreach ($cpaRanaps as $cpaRanap)
            <input type="checkbox" id="checkbox[{{ $cpaRanap['id'] }}]" name="permission_id[]" value="{{ $cpaRanap['id'] }}" >
            <label for="checkbox[{{ $cpaRanap['id'] }}]">{{ $cpaRanap['name'] }}</label><br>
          @endforeach
        </div>
        <div class="col-sm-4 mb-3">
          <h5 class="mb-2">Daftar Tilik Ranap :</h5>
          @foreach ($tilikRanaps as $tilikRanap)
            <input type="checkbox" id="checkbox[{{ $tilikRanap['id'] }}]" name="permission_id[]" value="{{ $tilikRanap['id'] }}" >
            <label for="checkbox[{{ $tilikRanap['id'] }}]">{{ $tilikRanap['name'] }}</label><br>
          @endforeach
        </div>
        <div class="col-sm-4 mb-3">
          <h5 class="mb-2">Assesmen Keperawatan Ranap :</h5>
          @foreach ($assKepRanaps as $assKepRanap)
            <input type="checkbox" id="checkbox[{{ $assKepRanap['id'] }}]" name="permission_id[]" value="{{ $assKepRanap['id'] }}" >
            <label for="checkbox[{{ $assKepRanap['id'] }}]">{{ $assKepRanap['name'] }}</label><br>
          @endforeach
        </div>
        <div class="col-sm-4 mb-3">
          <h5 class="mb-2">Rekam Medis :</h5>
          @foreach ($rekamMedis as $rm)
            <input type="checkbox" id="checkbox[{{ $rm['id'] }}]" name="permission_id[]" value="{{ $rm['id'] }}">
            <label for="checkbox[{{ $rm['id'] }}]">{{ $rm['name'] }}</label><br>
          @endforeach
        </div>
        <div class="col-sm-4 mb-3">
          <h5 class="mb-2">Antrian :</h5>
          @foreach ($queues as $que)
            <input type="checkbox" id="checkbox[{{ $que['id'] }}]" name="permission_id[]" value="{{ $que['id'] }}">
            <label for="checkbox[{{ $que['id'] }}]">{{ $que['name'] }}</label><br>
          @endforeach
        </div>
        <div class="col-sm-4 mb-3">
          <h5 class="mb-2">Pasien :</h5>
          @foreach ($pasiens as $pasien)
            <input type="checkbox" id="checkbox[{{ $pasien['id'] }}]" name="permission_id[]" value="{{ $pasien['id'] }}">
            <label for="checkbox[{{ $pasien['id'] }}]">{{ $pasien['name'] }}</label><br>
          @endforeach
        </div>
        <div class="col-sm-4 mb-3">
          <h5 class="mb-2">Farmasi Rawat Jalan :</h5>
          @foreach ($farmasiRajals as $farmasiRajal)
            <input type="checkbox" id="checkbox[{{ $farmasiRajal['id'] }}]" name="permission_id[]" value="{{ $farmasiRajal['id'] }}">
            <label for="checkbox[{{ $farmasiRajal['id'] }}]">{{ $farmasiRajal['name'] }}</label><br>
          @endforeach
        </div>
        <div class="col-sm-4 mb-3">
          <h5 class="mb-2">Resep Obat Farmasi :</h5>
          @foreach ($medicineReceipts as $resep)
            <input type="checkbox" id="checkbox[{{ $resep['id'] }}]" name="permission_id[]" value="{{ $resep['id'] }}">
            <label for="checkbox[{{ $resep['id'] }}]">{{ $resep['name'] }}</label><br>
          @endforeach
        </div>
        <div class="col-sm-4 mb-3">
          <h5 class="mb-2">Pembayaran (Kasir) :</h5>
          @foreach ($kasirs as $kasir)
            <input type="checkbox" id="checkbox[{{ $kasir['id'] }}]" name="permission_id[]" value="{{ $kasir['id'] }}">
            <label for="checkbox[{{ $kasir['id'] }}]">{{ $kasir['name'] }}</label><br>
          @endforeach
        </div>
        <div class="col-sm-4 mb-3">
          <h5 class="mb-2">Pemeriksaan Radiologi :</h5>
          @foreach ($radiologis as $radiologi)
            <input type="checkbox" id="checkbox[{{ $radiologi['id'] }}]" name="permission_id[]" value="{{ $radiologi['id'] }}">
            <label for="checkbox[{{ $radiologi['id'] }}]">{{ $radiologi['name'] }}</label><br>
          @endforeach
        </div>
        <div class="col-sm-4 mb-3">
          <h5 class="mb-2">Pemeriksaan Laboratorium PK :</h5>
          @foreach ($laborPks as $laborPk)
            <input type="checkbox" id="checkbox[{{ $laborPk['id'] }}]" name="permission_id[]" value="{{ $laborPk['id'] }}" >
            <label for="checkbox[{{ $laborPk['id'] }}]">{{ $laborPk['name'] }}</label><br>
          @endforeach
        </div>
        <div class="col-sm-4 mb-3">
          <h5 class="mb-2">Pemeriksaan Laboratorium PA :</h5>
          @foreach ($laborPas as $laborPa)
            <input type="checkbox" id="checkbox[{{ $laborPa['id'] }}]" name="permission_id[]" value="{{ $laborPa['id'] }}" >
            <label for="checkbox[{{ $laborPa['id'] }}]">{{ $laborPa['name'] }}</label><br>
          @endforeach
        </div>
        <div class="col-sm-4 mb-3">
          <h5 class="mb-2">Formulir Rekonsiliasi Ranap :</h5>
          @foreach ($formRekonsiRanaps as $formRekonsi)
            <input type="checkbox" id="checkbox[{{ $formRekonsi['id'] }}]" name="permission_id[]" value="{{ $formRekonsi['id'] }}" >
            <label for="checkbox[{{ $formRekonsi['id'] }}]">{{ $formRekonsi['name'] }}</label><br>
          @endforeach
        </div>
        <div class="col-sm-4 mb-3">
          <h5 class="mb-2">IGD :</h5>
          @foreach ($igds as $igd)
            <input type="checkbox" id="checkbox[{{ $igd['id'] }}]" name="permission_id[]" value="{{ $igd['id'] }}">
            <label for="checkbox[{{ $igd['id'] }}]">{{ $igd['name'] }}</label><br>
          @endforeach
        </div> 
        <div class="col-sm-4 mb-3">
          <h5 class="mb-2">Status Ranjang :</h5>
          @foreach ($statusRanjangs as $statusRanjang)
            <input type="checkbox" id="checkbox[{{ $statusRanjang['id'] }}]" name="permission_id[]" value="{{ $statusRanjang['id'] }}">
            <label for="checkbox[{{ $statusRanjang['id'] }}]">{{ $statusRanjang['name'] }}</label><br>
          @endforeach
        </div> 
      </div>
    </div>

    <div class="card-header d-flex align-items-center justify-content-between">
      <h4 class="mb-0">Roles Permission Master :</h4>
    </div>
    
    <div class="card-body">
      <div class="row mb-2">
        @foreach ($masters as $master)
          <div class="col-sm-4 mb-3">
            <input type="checkbox" id="checkbox[{{ $master['id'] }}]" name="permission_id[]" value="{{ $master['id'] }}" >
            <label for="checkbox[{{ $master['id'] }}]">{{ $master['name'] }}</label><br>
          </div>
        @endforeach
      </div>
    </div>
    <div class="row">
      <div class="col-sm-11 text-end">
          <button type="submit" class="btn btn-sm btn-dark">Simpan</button>
      </div>
    </div>
  </form>
</div>
@endsection