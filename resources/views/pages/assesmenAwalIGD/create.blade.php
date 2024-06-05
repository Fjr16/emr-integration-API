@extends('layouts.backend.main')

@section('content')
  @if (session()->has('success'))
  <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
      {{ session('success') }}
  </div>
@endif

  <form action="{{ route('igd/assesmenawal.store', $item->id) }}" method="POST">
    @csrf
    <div class="card">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Tambah Assesmen Awal</h5>
        <button type="button" class="btn btn-success btn-sm" onclick="history.back()">Kembali</button>
      </div>
      <div class="card-body">
        <p class="m-0 fw-bold">Anamnesis</p>
        <p class="m-0 fw-bold">Data diperoleh dari</p>
        <div class="form-check">
          <input name="isPasien" class="form-check-input" type="radio" value="1" id="pasien" onclick="disabledForm()" checked/>
          <label class="form-check-label" for="pasien">
            Pasien
          </label>
        </div>
        <div class="form-check">
          <input name="isPasien" class="form-check-input" type="radio" value="0" id="notPasien" onclick="enableForm()" />
          <label class="form-check-label d-flex" for="notPasien">
            Orang Lain(Alloanamnesa)
            <span class="mx-2"><input type="text" class="form-control form-control-sm" value="{{ old('name') }}" name="name" id="name" aria-describedby="floatingInputHelp" disabled /></span>
            Hubungan dengan pasien 
            <span class="mx-2"><input type="text" class="form-control form-control-sm" value="{{ old('hubungan') }}" name="hubungan" id="hubungan" aria-describedby="floatingInputHelp" disabled /></span>
          </label>
        </div>
        <p class="m-0 fw-bold">Keluhan Utama</p>
        <textarea id="editor5" class="form-control" id="exampleFormControlTextarea1" name="keluhan" rows="2"></textarea>
        <p class="m-0 fw-bold mt-4">Riwayat Penyakit Sekarang</p>
        <textarea id="editor1" class="form-control" id="exampleFormControlTextarea1" name="riwayat_penyakit_sekarang" rows="2"></textarea>
        <p class="m-0 fw-bold mt-4">Riwayat Penyakit Dahulu</p>
        <textarea id="editor2" class="form-control" id="exampleFormControlTextarea1" name="riwayat_penyakit_dahulu" rows="2"></textarea>
        <p class="m-0 fw-bold mt-4">Riwayat Penggunaan Obat</p>
        <textarea id="editor3" class="form-control" id="exampleFormControlTextarea1" name="riwayat_penggunaan_obat" rows="2"></textarea>
        <p class="m-0 fw-bold mt-4">Riwayat Penyakit Keluarga</p>
        <textarea id="editor4" class="form-control" id="exampleFormControlTextarea1" name="riwayat_penyakit_keluarga" rows="2"></textarea>
        <p class="m-0 fw-bold mt-4">Pemeriksaan Fisik</p>
        <table class="table"> 
          <thead>
            <tr class="text-nowrap">
              <th class="text-body fw-bold">Keterangan</th>
              <th class="text-body fw-bold">Normal</th>
              <th class="text-body fw-bold">Jelaskan jika Tidak Normal</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($arrPemeriksaan as $index => $pemeriksaan) 
            <tr id="row">
              <td>
                {{ $pemeriksaan }}
                <input type="hidden" name="fisik[{{ $index }}][name]" value="{{ $pemeriksaan }}">
              </td>
              <td>
                <div class="form-check form-check-sm form-check-inline">
                  <input class="form-check-input" type="radio" name="fisik[{{ $index }}][isNormal]" id="fisik[{{ $index }}]1" value="1" checked onclick="disabledInputAlasan(this)"/>
                  <label class="form-check-label" for="fisik[{{ $index }}]1">YA</label>
                </div>
                <div class="form-check form-check-sm form-check-inline">
                  <input class="form-check-input" type="radio" name="fisik[{{ $index }}][isNormal]" id="fisik[{{ $index }}]2" value="0" onclick="enableInputAlasan(this)"/>
                  <label class="form-check-label" for="fisik[{{ $index }}]2">Tidak</label>
                </div>
              </td>
              <td>
                <input type="text" name="fisik[{{ $index }}][alasan]" id="alasan" class="form-control form-control-sm" id="floatingInput" aria-describedby="floatingInputHelp" disabled/>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <p class="m-0 fw-bold mt-4">Status Lokalis</p>
        <textarea id="editor6" class="form-control" id="exampleFormControlTextarea1" name="status_lokalis" rows="2"></textarea>
        <p class="m-0 fw-bold my-4">Hasil Pemeriksaan Penunjang</p>
        <div class="row mb-3">
          <label for="" class="form-label col-sm-2 fw-bold" id="label-kolom">Labor</label>
          <input type="hidden" name="nama_hasil_pemeriksaan[]" value="Labor">
          <div class="col-sm-10">
            <textarea class="form-control w-100" rows="2" name="hasil_pemeriksaan[]"></textarea>
          </div>
        </div>
        <div class="row mb-3">
          <label for="" class="form-label col-sm-2 fw-bold" id="label-kolom">Radiologi</label>
          <input type="hidden" name="nama_hasil_pemeriksaan[]" value="Radiologi">
          <div class="col-sm-10">
            <textarea class="form-control w-100" rows="2" name="hasil_pemeriksaan[]"></textarea>
          </div>
        </div>
        <div class="row mb-3">
          <div class="row mb-2">
            <div class="col-sm-2">
              <input type="text" name="nama_hasil_pemeriksaan[]" class="form-control form-control-md" value="">
            </div>
            <div class="col-sm-9">
              <textarea class="form-control w-100" rows="1" name="hasil_pemeriksaan[]"></textarea>
            </div>
            <div class="col-1 d-flex align-self-center">
              <button type="button" class="btn btn-dark btn-sm" onclick="tambahInputPemeriksaan(this)">+</button>
            </div>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-sm-2"></div>
          <div class="col-sm-10 text-start text-white">
            <a href="{{ route('rajal/permintaan/radiologi.create', $item->id) }}" target="blank" class="btn btn-sm btn-success">Tambah Permintaan Radiologi</a>
            <a href="{{ route('permintaan/laboratorium/patologi/anatomik.create', $item->id) }}" target="blank" class="btn btn-sm btn-success">Tambah Permintaan Labor PA</a>
            <a href="{{ route('rajal/laboratorium/request.index', $item->id) }}" target="blank" class="btn btn-sm btn-success">Tambah Permintaan Labor PK</a>
          </div>
        </div>
        <div class="col-sm-12">
          <div class="nav-align-top mb-4">
            <ul class="nav nav-pills nav-sm mb-3 nav-fill w-100" role="tablist">
              @can('print hasil pemeriksaan radiologi')
              <li class="nav-item">
                <button
                  type="button"
                  class="border nav-link {{ session('penunjang') == 'radiologi' ? 'active':'' }}"
                  role="tab"
                  data-bs-toggle="tab"
                  data-bs-target="#navs-pills-justified-hasilradiologi"
                  aria-controls="navs-pills-justified-hasilradiologi"
                  aria-selected="true"
                >
                Hasil Pemeriksaan Radiologi
                </button>
              </li>
              @endcan
              @can('print hasil pemeriksaan laboratorium')
              <li class="nav-item">
                <button
                  type="button"
                  class="border nav-link {{ session('penunjang') == 'laboratorium PA' ? 'active':'' }}"
                  role="tab"
                  data-bs-toggle="tab"
                  data-bs-target="#navs-pills-justified-hasillaboratorium-pa"
                  aria-controls="navs-pills-justified-hasillaboratorium-pa"
                  aria-selected="true"
                >
                Hasil Pemeriksaan Laboratorium PA
                </button>
              </li>
              @endcan
              @can('print hasil pemeriksaan laboratorium')
              <li class="nav-item">
                <button
                  type="button"
                  class="border nav-link {{ session('penunjang') == 'laboratorium PK' ? 'active':'' }}"
                  role="tab"
                  data-bs-toggle="tab"
                  data-bs-target="#navs-pills-justified-hasillaboratorium-pk"
                  aria-controls="navs-pills-justified-hasillaboratorium-pk"
                  aria-selected="true"
                >
                Hasil Pemeriksaan Laboratorium PK
                </button>
              </li>
              @endcan
    
            </ul>
            <div class="tab-content">
              @can('print hasil pemeriksaan radiologi')
              <div class="tab-pane fade {{ (session('penunjang') == 'radiologi') ? 'show active' : '' }}" id="navs-pills-justified-hasilradiologi" role="tabpanel">
                <table class="table">
                  <thead>
                    <tr class="text-nowrap">
                      <th class="text-body">Tanggal Permintaan</th>
                      <th class="text-body">Petugas Radiologi</th>
                      <th class="text-body">Jenis Pemeriksaan</th>
                      <th class="text-body">Diagnosa Klinis</th>
                      <th class="text-body">Tanggal Hasil</th>
                      <th class="text-body">Hasil Gambar</th>
                      <th class="text-body">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    {{-- @foreach ($radiologiResults as $result)
                      @foreach ($result->radiologiPatientRequestDetails->where('status', 'SELESAI') as $detail)
                        <tr>
                        <td>{{ $result->radiologiFormRequest->created_at->format('Y-m-d / H:i:s') ?? '' }}</td>
                        <td>{{ $detail->user->name ?? '' }}</td>
                        <td>{{ $detail->radiologiFormRequestDetail->radiologiFormRequestMaster->name ?? '' }}</td>
                        <td>{{ $result->radiologiFormRequest->diagnosa_klinis ?? '' }}</td>
                        <td>{{ $detail->tanggal ?? '' }}</td>
                        <td><a href="{{ Storage::url($detail->image ?? '') }}" target="blank">Tampilkan</a></td>
                        <td class="d-flex">
                          <a href="{{ route('radiologi/patient/hasil.show', $detail->id) }}" target="blank" class="btn btn-dark btn-sm"><i class='bx bx-printer'></i></a>
                        </td>
                        </tr>
                      @endforeach
                    @endforeach --}}
                  </tbody>
                </table>
              </div>
              @endcan
              @can('print hasil pemeriksaan laboratorium')
              <div class="tab-pane fade {{ (session('penunjang') == 'laboratorium PA') ? 'show active' : '' }}" id="navs-pills-justified-hasillaboratorium-pa" role="tabpanel">
                <table class="table">
                  <thead>
                    <tr class="text-nowrap">
                      <th class="text-body">Tanggal Permintaan</th>
                      <th class="text-body">Petugas Laboratorium</th>
                      <th class="text-body">No. Labor</th>
                      <th class="text-body">Diagnosa Klinis</th>
                      <th class="text-body">Tanggal</th>
                      <th class="text-body">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    {{-- @foreach ($laborResults as $labor)
                    <tr>
                     <td>{{ $labor->laboratoriumRequest->created_at->format('Y-m-d') ?? '' }}</td>
                     <td>{{ $labor->user->name ?? '' }}</td>
                     <td>{{ $labor->nomor_reg_lab ?? '' }}</td>
                     <td>{{ $labor->laboratoriumRequest->diagnosa ?? '' }}</td>
                     <td>{{ $labor->tanggal_periksa ?? '' }}</td>
                     <td class="d-flex">
                       <a href="{{ route('laboratorium/patient/hasil.show', $labor->id) }}" target="blank" class="btn btn-dark btn-sm"><i class='bx bx-printer'></i></a>
                     </td>
                    </tr>
                    @endforeach --}}
                  </tbody>
                </table>
              </div>
              @endcan
              @can('print hasil pemeriksaan laboratorium')
              <div class="tab-pane fade {{ (session('penunjang') == 'laboratorium PK') ? 'show active' : '' }}" id="navs-pills-justified-hasillaboratorium-pk" role="tabpanel">
                <table class="table">
                  <thead>
                    <tr class="text-nowrap">
                      <th class="text-body">Tanggal Permintaan</th>
                      <th class="text-body">Petugas Laboratorium</th>
                      <th class="text-body">No. Labor</th>
                      <th class="text-body">Diagnosa Klinis</th>
                      <th class="text-body">Tanggal</th>
                      <th class="text-body">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    {{-- @foreach ($laborResults as $labor)
                    <tr>
                     <td>{{ $labor->laboratoriumRequest->created_at->format('Y-m-d') ?? '' }}</td>
                     <td>{{ $labor->user->name ?? '' }}</td>
                     <td>{{ $labor->nomor_reg_lab ?? '' }}</td>
                     <td>{{ $labor->laboratoriumRequest->diagnosa ?? '' }}</td>
                     <td>{{ $labor->tanggal_periksa ?? '' }}</td>
                     <td class="d-flex">
                       <a href="{{ route('laboratorium/patient/hasil.show', $labor->id) }}" target="blank" class="btn btn-dark btn-sm"><i class='bx bx-printer'></i></a>
                     </td>
                    </tr>
                    @endforeach --}}
                  </tbody>
                </table>
              </div>
              @endcan
    
            </div>
          </div>
        </div>
        
        <p class="m-0 fw-bold mt-4">Diagnosa Kerja</p>
        <textarea id="editor7" class="form-control" id="exampleFormControlTextarea1" name="diagnosa_kerja" rows="2"></textarea>
        <p class="m-0 fw-bold mt-4">Diagnosa Banding</p>
        <textarea id="editor8" class="form-control" id="exampleFormControlTextarea1" name="diagnosa_banding" rows="2"></textarea>
        <p class="m-0 fw-bold mt-4 mb-3">Terapi / Instruksi (Standing Order)</p>
        {{-- <textarea class="form-control" id="exampleFormControlTextarea1" name="terapi" rows="2"></textarea> --}}
        <div class="row mb-3">
          <label class="form-label col-sm-2 fw-bold" id="label-kolom">Medical Mentosa:</label>
          <div class="row">
            <div class="col-sm-3">
              <label for="medicine_id" class="form-label">Nama Obat</label>
              <select id="medicine_id_1" name="medicine_id[]" class="form-select form-select-sm" data-allow-clear="true">
                <option selected disabled>Pilih</option>
                @foreach ($dataObat as $obat)
                    @if (old('medicine_id') == $obat->id)
                      <option value="{{ $obat->id }}" selected>{{ $obat->kode ?? '' }}/{{ $obat->name ?? '' }}</option>
                    @else
                      <option value="{{ $obat->id }}">{{ $obat->kode ?? '' }}/{{ $obat->name ?? '' }}</option>
                    @endif
                @endforeach
              </select>
            </div>
            <div class="col-sm-1">
              <label class="form-label" for="basic-default-name">Jumlah</label>
              <input type="number" class="form-control" name="jumlah[]" id="jumlah"/>
            </div>
            <div class="col-sm-2">
              <label class="form-label" for="basic-default-name">Aturan Penggunaan</label>
              <input type="text" class="form-control" name="aturan_pakai[]" id="aturan_pakai"/>
            </div>
            <div class="col-sm-2">
              <label for="keterangan" class="form-label">Keterangan Penggunaan</label>
              <select name="keterangan[]" class="form-select form-select-md" data-allow-clear="true">
                <option selected disabled>Pilih</option>
                <option value="Sebelum Makan">Sebelum Makan</option>
                <option value="Sesudah Makan">Sesudah Makan</option>
              </select>
            </div>
            <div class="col-sm-3">
              <label for="keterangan" class="form-label">Keterangan Lainnya</label>
              <textarea name="other[]" class="form-control" id="other" cols="30" rows="1"></textarea>
            </div>
            <div class="col-sm-1 d-flex align-self-center mt-4">
              <button type="button" class="btn btn-sm btn-dark" onclick="tambahResep(this)"><i class="bx bx-plus"></i></button>
            </div>
          </div>
        </div>
        <div class="row mb-3">
          <label class="form-label col-sm-2 fw-bold" id="label-kolom" >Non Medical Mentosa:</label>
          <div class="col-sm-12">
            <textarea id="editor" name="terapi" class="form-control"></textarea> 
          </div>
        </div>
        <p class="m-0 fw-bold mb-3">Rencana</p>
        @foreach ($arrRencana as $rencana)    
        <div class="row mb-3">
          <label class="form-label col-sm-2 fw-bold" id="label-kolom">{{ $rencana }}</label>
          <div class="col-sm-10">
            <textarea class="form-control" rows="2" oninput="concatLabel(this)"></textarea> 
            <textarea class="form-control" id="value-kolom" name="rencana[]" rows="2" hidden></textarea> 
          </div>
        </div>
        @endforeach
        <div class="row mb-3" id="tambah">
          <div class="col-sm-2"></div>
          <div class="col-sm-9">
            <textarea class="form-control" cols="50" rows="2" name="rencana[]"></textarea>
          </div>
          <div class="col-1 d-flex align-self-center">
            <button type="button" class="btn btn-dark btn-sm" onclick="tambahInput(this)">+</button>
          </div>
        </div>
        <p class="m-0 fw-bold">Kebutuhan Edukasi</p>
        @foreach ($arrEdukasi as $edukasi)    
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="{{ $edukasi }}" id="{{ $edukasi }}" name="edukasi[]" />
          <label class="form-check-label d-flex" for="{{ $edukasi }}">
            {{ $edukasi }}
          </label>
        </div>
        @endforeach
        <div class="row mb-3">
          <div class="col-sm-4">
            <input type="text" class="form-control form-control-sm" name="edukasi[]">
          </div>
          <div class="col-8 d-flex align-self-center">
            <button type="button" class="btn btn-dark btn-sm" onclick="tambahEdukasi([this, 'edukasi[]'])">+</button>
          </div>
        </div>
        <p class="mt-4 mb-0 fw-bold">KONDISI PASIEN SAAT PULANG (STATUS PRESENT):</p>
        @foreach ($arrPemulangan as $index => $pemulangan)
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="{{ $pemulangan }}" id="{{ $pemulangan }}" name="stts_present[]" />
            <label class="form-check-label d-flex" for="{{ $pemulangan }}">
              {{ $pemulangan }}
            </label>
          </div>
        @endforeach
        <div class="row mb-3">
          <div class="col-sm-4">
            <input type="text" class="form-control form-control-sm" name="stts_present[]">
          </div>
          <div class="col-8 d-flex align-self-center">
            <button type="button" class="btn btn-dark btn-sm" onclick="tambahEdukasi([this, 'stts_present[]'])">+</button>
          </div>
        </div>
      </div>

          {{-- ttd --}}
          <div class="row mb-3">
            <div class="col-4 text-center">
                Pasien / Wali Pasien
            </div>
            <div class="col-4"></div>
            <div class="col-4 text-center">
                Dokter Penanggung Jawab Pelayanan
            </div>
        </div>
        <div class="row mb-3">
            
          <div class="col-4 text-center">
              <img src="" alt="" id="ImgTtdKeluargaPasien">
              <textarea id="ttd" name="ttd" style="display: none;"></textarea>
              <button type="button" class="col-12 btn btn-sm btn-dark"
                  onclick="openModalTtdBottom(this, 'ImgTtdKeluargaPasien', 'ttd')">Tanda
                  Tangan</button>
          </div>
            <div class="col-4"></div>
            <div class="col-4 text-center">
              <img src="" alt="" id="imgTtdDpjp">
              <textarea id="ttdDpjp" name="ttd_dpjp" style="display: none;"></textarea>
              <button type="button" class="col-12 btn btn-sm btn-dark"
                  onclick="openModal(this)">Tanda
                  Tangan</button>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-4 text-center">
                <input type="text" class="form-control form-control-sm text-center" id="nameTtd" value="{{ $item->queue->patient->name ?? '' }}" disabled>
            </div>
            <div class="col-4"></div>
            <div class="col-4 text-center">
                <input type="text" class="form-control form-control-sm text-center" value="{{ auth()->user()->name ?? '' }}" id="petugas_name" disabled>
            </div>
        </div>

      <div class="mb-3 text-end">
        <button type="submit" class="btn btn-success btn-sm mx-3">Simpan</button>
      </div>
    </div>
  </form>

      {{-- modal create ttd --}}
    <div class="modal fade" id="signaturePadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="modalScrollableTitle">Signature Pad</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  </button>
              </div>
              <div class="modal-body">
                  <div id="signature-pad" class="m-signature-pad">
                      <div class="m-signature-pad--body">
                          <canvas style="border: 3px dashed #ccc"></canvas>
                      </div>

                      <div class="m-signature-pad--footer">
                          <button type="button" class="btn btn-sm btn-secondary" data-action="clear">Clear</button>
                          <button type="button" class="btn btn-sm btn-primary" data-action="save">Save</button>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

    {{--modal get ttd --}}
    <div class="modal fade" id="getTtdModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
              <div class="modal-header">
              <h5 class="modal-title" id="modalScrollableTitle">Masukkan Password Akun Anda</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
              </button>
              </div>
              <div class="modal-body">
                  <div id="signature-pad" class="m-signature-pad">
                      <div class="m-signature-pad--body mb-3">
                      <input type="password" class="form-control form-control-sm" name="password_user">
                      <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                      </div>
                  
                      <div class="m-signature-pad--footer">
                      <button type="button" class="btn btn-sm btn-secondary" data-action="clearInput">Clear</button>
                      <button type="button" class="btn btn-sm btn-primary" data-action="saveInput">Save</button>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </div>

  <script>
    function concatLabel(input){
      var label = input.closest('.row').querySelector('#label-kolom').textContent;
      var newValue = label + ' ' + input.value;
      input.closest('.row').querySelector('#value-kolom').value = newValue;
    }

    function tambahInput(add){
      var row = add.closest('.row');
      
      var newDiv = document.createElement('div');
      newDiv.className = 'col-sm-2';
      var divText = document.createElement('div');
      divText.className = 'col-sm-9';
      divText.innerHTML = `
            <textarea class="form-control" cols="50" rows="2" name="rencana[]"></textarea>
      `;
      var divButton = document.createElement('div');
      divButton.className = 'col-1 d-flex align-self-center';
      divButton.innerHTML = `
            <button type="button" class="btn btn-danger btn-sm" onclick="hapusInput(this)">-</button>
      `;

      elements = [newDiv, divText, divButton];
      row.append(...elements);
    }

    function tambahInputPemeriksaan(add){
      var i = 2;
      var row = add.closest('.row').parentNode;

      var newRow = document.createElement('div');
      newRow.className = 'row mb-2';
      
      var newDiv = document.createElement('div');
      newDiv.className = 'col-sm-2';
      newDiv.innerHTML = `<input type="text" name="nama_hasil_pemeriksaan[]" class="form-control form-control-md" value="">`;
      var divText = document.createElement('div');
      divText.className = 'col-sm-9';
      divText.innerHTML = `
            <textarea class="form-control w-100" rows="1" name="hasil_pemeriksaan[]"></textarea>
      `;
      var divButton = document.createElement('div');
      divButton.className = 'col-1 d-flex align-self-center';
      divButton.innerHTML = `
            <button type="button" class="btn btn-danger btn-sm" onclick="hapusInput(this)">-</button>
      `;

      elements = [newDiv, divText, divButton];
      newRow.append(...elements);
      row.appendChild(newRow);
    }

    function tambahEdukasi([add, name]){
      var row = add.closest('.row');

      var divText = document.createElement('div');
      divText.className = 'col-sm-4 mt-1';
      divText.innerHTML = `
        <input type="text" class="form-control form-control-sm" name="${name}">
      `;
      var divButton = document.createElement('div');
      divButton.className = 'col-8 d-flex align-self-center';
      divButton.innerHTML = `
            <button type="button" class="btn btn-danger btn-sm" onclick="hapusInputEdukasi(this)">-</button>
      `;

      elements = [divText, divButton];
      row.append(...elements);
    }

    let clickCount = 2;
    function tambahResep(element){
      var row = element.closest('.row').parentNode;

      var div = document.createElement('div');
      div.className = 'row';
      div.innerHTML = `
          <div class="col-sm-3">
            <label for="medicine_id" class="form-label">Nama Obat</label>
            <select id="medicine_id_${clickCount}" name="medicine_id[]" class="form-select form-select-sm" data-allow-clear="true">
              <option selected disabled>Pilih</option>
              @foreach ($dataObat as $obat)
                  @if (old('medicine_id') == $obat->id)
                    <option value="{{ $obat->id }}" selected>{{ $obat->kode ?? '' }}/{{ $obat->name ?? '' }}</option>
                  @else
                    <option value="{{ $obat->id }}">{{ $obat->kode ?? '' }}/{{ $obat->name ?? '' }}</option>
                  @endif
              @endforeach
            </select>
          </div>
          <div class="col-sm-1">
            <label class="form-label" for="basic-default-name">Jumlah</label>
            <input type="number" class="form-control" name="jumlah[]" id="jumlah" />
          </div>
          <div class="col-sm-2">
            <label class="form-label" for="basic-default-name">Aturan Pakai</label>
            <input type="text" class="form-control" name="aturan_pakai[]" id="aturan_pakai" />
          </div>
          <div class="col-sm-2">
              <label for="keterangan" class="form-label">Keterangan Penggunaan</label>
              <select name="keterangan[]" class="form-select form-select-md" data-allow-clear="true">
                <option selected disabled>Pilih</option>
                <option value="Sebelum Makan">Sebelum Makan</option>
                <option value="Sesudah Makan">Sesudah Makan</option>
              </select>
            </div>
            <div class="col-sm-3">
              <label for="keterangan" class="form-label">Keterangan Lainnya</label>
              <textarea name="other[]" class="form-control" id="other" cols="30" rows="1"></textarea>
            </div>
          <div class="col-sm-1 d-flex align-self-center mt-4">
            <button type="button" class="btn btn-sm btn-danger" onclick="hapusResep(this)"><i class="bx bx-minus"></i></button>
          </div>`;

          row.appendChild(div);
          $('#medicine_id_' + clickCount).select2();
          clickCount++;
    }

    function hapusInput(input){
      var row = input.parentNode.parentNode;
      row.remove()
    }
    function hapusInputEdukasi(input){
      var divButton = input.parentNode;
      var divText = divButton.previousElementSibling;

      divButton.remove()
      divText.remove()
    }

    function hapusResep(element){
      var root = element.closest('.row');
      root.remove();
    }

    function enableForm(){
      $('#name').attr('disabled', false);
      $('#hubungan').attr('disabled', false);
    }
    function disabledForm(){
      $('#name').attr('disabled', true);
      $('#hubungan').attr('disabled', true);
    }

    function enableInputAlasan(element){
      $(element).closest('#row').find('#alasan').attr('disabled', false);
    }
    function disabledInputAlasan(element){
      $(element).closest('#row').find('#alasan').attr('disabled', true);
    }
  </script>
  <script>
        let tempElementImage;
        let tempTextArea;

        function openModal(element) {
            $('#getTtdModal').modal('show');
        }

        function openModalTtdBottom(element, elementImg, elementTextArea) {
            console.log(element.closest('td'));
            tempElementImage = $(element).closest('.row').find('#' + elementImg);
            tempTextArea = $(element).closest('.row').find('#' + elementTextArea);
            $('#signaturePadModal').modal('show');
        }

        document.addEventListener("DOMContentLoaded", function() {
            var wrapper = document.getElementById("signaturePadModal");
            var clearButton = wrapper.querySelector("[data-action=clear]");
            var saveButton = wrapper.querySelector("[data-action=save]");
            var canvas = wrapper.querySelector("canvas");
            var signaturePad;

            // Initialize SignaturePad
            // agar library signature pad dapat digunakan pada modal
            signaturePad = new SignaturePad(canvas);

            // Event handler untuk tombol clear
            clearButton.addEventListener("click", function(e) {
                e.preventDefault();
                signaturePad.clear();
            });

            // Event handler untuk tombol save
            // var ttd = document.getElementById('ttd1');
            saveButton.addEventListener("click", function(e) {
                e.preventDefault();
                var signatureData = signaturePad.toDataURL();
                tempElementImage.attr('src', signatureData);
                tempTextArea.val(signatureData);
                // document.getElementById("signature64").value = signatureData;
                signaturePad.clear();

                //close modal
                $('#signaturePadModal').modal('hide');
            });

            
            // start get ttd from user table
            var modal = document.getElementById("getTtdModal");
            var clearButtonInput = modal.querySelector("[data-action=clearInput]");
            var saveButtonInput = modal.querySelector("[data-action=saveInput]");
            var inputPass = modal.querySelector('input[name="password_user"]');
            var inputUserId = modal.querySelector('input[name="user_id"]');
        
            saveButtonInput.addEventListener("click", function (e) {
                e.preventDefault();
                $.ajax({
                    type : 'get',
                    url : "{{ route('ranap/cppt.getTtd') }}",
                    data : {
                        user_id : inputUserId.value,
                        password : inputPass.value,
                    }, success: function(data){
                        var newSrc = `{{ Storage::url('${data}') }}`;
                        $('#imgTtdDpjp').attr('src', newSrc);
                        $('#ttdDpjp').val(data);
                        $('#petugas_name').val(`{{ auth()->user()->name }}`);
                    }, error: function(jqXHR, textStatus, errorThrown){
                        console.log();
                        var errorResponse = jqXHR.responseJSON;
                        if (errorResponse && errorResponse.error) {
                            alert(errorResponse.error)
                        }else{
                            alert('Terjadi Kesalahan Dalam Pengambilan Data');
                        }
                    }
                });

                inputPass.value = '';

                $('#getTtdModal').modal('hide');
            });
        });

        document.addEventListener('DOMContentLoaded', function(){
            var name = document.querySelector('input[name="name"]');
            // var namaDis = document.getElementById('nama');
            var nameTtd = document.getElementById('nameTtd');

            name.addEventListener('change', function(){
                // namaDis.value = name.value;
                nameTtd.value = name.value;
            });
        });
  </script>

@endsection
  