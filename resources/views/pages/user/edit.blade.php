@extends('layouts.backend.main')

@section('content')
@if (session()->has('success'))
<div class="alert alert-success d-flex" role="alert">
    <span class="alert-icon rounded-circle"><i class='bx bxs-check-circle' style="font-size: 40px"></i></span>
    <div class="d-flex flex-column ps-1">
        <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">BERHASIL !!</h6>
        <span>{{ session('success') }}</span>
    </div>
</div>
@endif
@if (session()->has('error'))
<div class="alert alert-danger d-flex" role="alert">
    <span class="alert-icon rounded-circle"><i class='bx bxs-x-circle' style="font-size: 40px"></i></span>
    <div class="d-flex flex-column ps-1">
        <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">ERROR !!</h6>
        <span>{{ session('error') }}</span>
    </div>
</div>
@endif
@if ($errors->any())
<div class="alert alert-danger d-flex" role="alert">
    <span class="alert-icon rounded-circle"><i class='bx bxs-x-circle' style="font-size: 40px"></i></span>
    <div class="d-flex flex-column ps-1">
        <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">ERROR !!</h6>
        <span>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </span>
    </div>
</div>
@endif

<div class="card mb-4">
  <form method="POST" action="{{ route('user.update', $item->id) }}">
    @csrf
    @method('PUT')
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Edit Staff</h5>
    </div>
    <div class="card-body">
      <h6 class="fw-bold">Data Diri Petugas</h6>
      <hr>
      <div class="row mb-4">
        <div class="col-sm-4">
          <label class="form-label" for="basic-default-name">Nama Petugas</label>
            <input type="text" name="name" class="form-control" id="basic-default-name" placeholder="Nama Petugas" value="{{ old('name', $item->name) }}" @required(true)/>
        </div>
        {{--  --}}
        <div class="col-sm-4">
            <label class="form-label" for="basic-default-name">NIK</label>
            <input type="number" class="form-control" id="defaultFormControlInput" placeholder="03246234XXX" value="{{ old('nik', $item->nik) }}" name="nik" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="16" @required(true)/>
        </div>
        <div class="col-sm-4">
          <label class="form-label" for="basic-default-name">No Telp</label>
          <input type="number" name="telp" class="form-control" id="basic-default-name" placeholder="0813276XXXX" value="{{ old('telp', $item->telp) }}" @required(true)/>
        </div>
      </div>
      <div class="row mb-4">
        <div class="col-sm-3">
          <label for="exampleFormControlSelect1" class="form-label">Jenis Kelamin</label>
          <select class="form-select form-select-sm select2" id="gender" aria-label="Default select example" name="gender" @required(true)>
            <option selected disabled>Pilih</option>
            @foreach ($jk as $jk)
                @if (old('gender', $item->gender) == $jk)
                    <option value="{{ $jk }}" selected>{{ $jk }}</option>
                @else
                    <option value="{{ $jk }}">{{ $jk }}</option>
                @endif
            @endforeach
          </select>
        </div>
        <div class="col-sm-3">
          <label class="form-label" for="basic-default-name">Tanggal Lahir</label>
          <input type="date" name="tgl_lahir" class="form-control" id="basic-default-name" value="{{ old('tgl_lahir', $item->tgl_lahir) }}" @required(true)/>
        </div>
        <div class="col-sm-3">
          <label for="exampleFormControlSelect1" class="form-label">Status</label>
            <select class="form-select form-select-sm select2" id="stt"
              aria-label="Default select example" name="status_kawin" @required(true)>
              <option selected disabled>Pilih</option>
              @foreach ($stts as $stt)
                  @if (old('status_kawin', $item->status_kawin) == $stt)
                      <option value="{{ $stt }}" selected>{{ $stt }}</option>
                  @else
                      <option value="{{ $stt }}">{{ $stt }}</option>
                  @endif
              @endforeach
          </select>
        </div>
        <div class="col-sm-3">
          <label class="form-label" for="basic-default-name">Jumlah Anak</label>
          <input type="number" name="jumlah_anak" class="form-control" id="basic-default-name" value="{{ old('jumlah_anak', $item->jumlah_anak ?? 0) }}" @required(true)/>
        </div>
      </div>
      <div class="row mb-4">
        <div class="col-sm-4">
          <label for="exampleFormControlSelect1" class="form-label">Pendidikan Terakhir</label>
          <select class="form-select form-select-sm select2"
            aria-label="Default select example" name="pendidikan" @required(true)>
            <option selected disabled>Pilih</option>
            @foreach ($pendidikan as $pend)
                @if (old('pendidikan', $item->pendidikan) == $pend)
                    <option value="{{ $pend }}" selected>{{ $pend }}</option>
                @else
                    <option value="{{ $pend }}">{{ $pend }}</option>
                @endif
            @endforeach
          </select>
        </div>
        <div class="col-sm-4">
          <label class="form-label" for="basic-default-name">Nama Rekening</label>
          <input type="text" name="nama_rekening" class="form-control" placeholder="Bank XXX" id="basic-default-name" value="{{ old('nama_rekening', $item->nama_rekening) }}" @required(true)/>
        </div>
        <div class="col-4">
          <label class="form-label" for="basic-default-name">Nomor Rekening</label>
          <input type="number" name="no_rekening" class="form-control" id="basic-default-name" value="{{ old('no_rekening', $item->no_rekening ?? 0) }}" @required(true)/>
        </div>
      </div>
      <div class="row mb-4">
        <div class="col-sm-4">
          <label class="form-label" for="basic-default-name">Alamat Sesuai KTP</label>
          <textarea name="alamat_ktp" class="form-control" placeholder="Jl. XXX XXX XX, No. XX XXXX" rows="5" @required(true)>{{ old('alamat_ktp', $item->alamat_ktp) }}</textarea>
        </div>
        <div class="col-sm-4">
          <label class="form-label" for="basic-default-name">Alamat Domisili</label>
          <textarea name="alamat_domisili" class="form-control" placeholder="Jl. XXX XXX XX, No. XX XXXX" rows="5" @required(true)>{{ old('alamat_domisili', $item->alamat_domisili) }}</textarea>
        </div>
        <div class="col-sm-4">
          <label class="form-label" for="basic-default-name">Pengalaman Kerja</label>
            <textarea name="pengalaman" class="form-control" placeholder="Tuliskan Pengalaman kerja anda disini jika ada" rows="5">{{ old('pengalaman', $item->pengalaman) }}</textarea>
        </div>
      </div>
      <hr>
      {{--  --}}
      <div class="row mb-3">
        <div class="col-sm-6">
          <h6 class="fw-bold">Data Keluarga / Wali</h6>
          <hr>
          <div class="row mb-3">
            <div class="col-sm-6">
              <label class="form-label" for="basic-default-name">Nama Ayah</label>
              <input type="text" name="ayah" class="form-control" id="basic-default-name" placeholder="Nama Ayah" value="{{ old('ayah', $item->ayah) }}"/>
            </div>
            <div class="col-sm-6">
              <label class="form-label" for="basic-default-name">Nama Ibu</label>
              <input type="text" name="ibu" class="form-control" id="basic-default-name" placeholder="Nama Ibu" value="{{ old('ibu', $item->ibu) }}"/>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-sm-6">
              <label class="form-label" for="basic-default-name">Nama Kontak Darurat</label>
              <input type="text" name="nama_kontak_darurat" class="form-control" id="basic-default-name" placeholder="Nama Kontak Darurat" value="{{ old('nama_kontak_darurat', $item->nama_kontak_darurat) }}"/>
            </div>
            <div class="col-sm-6">
              <label class="form-label" for="basic-default-name">No Telp Kontak Darurat</label>
              <input type="number" name="no_kontak_darurat" class="form-control" placeholder="0813276XXXX" id="basic-default-name" value="{{ old('no_kontak_darurat', $item->no_kontak_darurat) }}"/>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <label class="form-label" for="basic-default-name">Alamat Kontak Darurat</label>
              <textarea name="alamat_kontak_darurat" class="form-control" rows="7" placeholder="Jl. XXX XXX XX, No. XX XXXX">{{ old('alamat_kontak_darurat', $item->alamat_kontak_darurat) }}</textarea>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <h6 class="fw-bold">Data User RS</h6>
          <hr>
          <div class="row mb-3">
            <div class="col-sm-12">
              <label class="form-label" for="basic-default-name">Staff Id</label>
              <input type="text" name="staff_id" class="form-control" id="basic-default-name" placeholder="DRXXXX" value="{{ old('staff_id', $item->staff_id) }}"/>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-4">
              <label class="form-label" for="basic-default-name">Tanggal Gabung</label>
              <input type="date" name="tgl_masuk" class="form-control" id="basic-default-name" value="{{ old('tgl_masuk', $item->tgl_masuk) }}"/>
            </div>
            <div class="col-sm-8">
              <label class="form-label" for="basic-default-name">Unit / Departemen</label>
              <select class="form-select select2 @error('unit_id') is-invalid @enderror" name="unit_id" aria-label="Default select example">
                  <option value="kosong" selected>Tidak Dalam Unit</option>
                  @foreach ($units as $unit)
                      @if (old('unit_id', $item->unit_id) == $unit->id)
                          <option selected value="{{ $unit->id }}">{{ $unit->name }}</option>
                      @else
                          <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                      @endif
                  @endforeach
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-sm-6">
              <label class="form-label" for="basic-default-name">Username</label>
              <input type="text" name="email" class="form-control" placeholder="username" id="basic-default-name" value="{{ old('email', $item->email) }}"/>
            </div>
            <div class="col-sm-6">
              <label class="form-label" for="basic-default-name">Password</label>
              <input type="text" name="password" class="form-control" placeholder="*******" id="basic-default-name"/>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-12">
              <label class="form-label" for="basic-default-name">Jenis Petugas (Role)</label>
              <select class="form-select @error('role_name') is-invalid @enderror select2" name="role_name" aria-label="Default select example">
                  <option selected disabled>Pilih</option>
                  @foreach ($role as $role)
                      @if (old('role_name', $item->roles->first()->name ?? '') == $role->name)
                          <option selected value="{{ $role->name }}">{{ $role->name }}</option>
                      @else
                          <option value="{{ $role->name }}">{{ $role->name }}</option>
                      @endif
                  @endforeach
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-sm-12">
              <label class="form-label" for="basic-default-name">Catatan (opsional)</label>
              <textarea name="catatan" class="form-control" rows="3" placeholder="Tuliskan keterangan tambahan atau catatan untuk user">{{ old('catatan', $item->catatan) }}</textarea>
            </div>
          </div>
          <div class="row">
              <div class="col-sm-4">
                <button type="button" class="btn btn-sm btn-outline-dark" id="addParaf" onclick="openModal(this)">Tanda Tangan</button>
              </div>
              <div class="col-sm-8">
                <img src="{{ Storage::url($item->paraf) }}" alt="" id="ttdImage" class="border">
                <textarea name="tanda_tangan" id="ttdTextArea" cols="30" rows="10" style="display: none">{{ $item->paraf ?? '' }}</textarea>
              </div>
          </div>
        </div>
      </div>
      <hr>
      <div class="row mb-4">
        <div class="col-md">
          <h6 class="fw-medium d-inline me-2">Petugas adalah dokter</h6>
          <div class="form-check form-check-inline mt-4">
            <input class="form-check-input" type="radio" name="isDokter" id="dokter-ya" value="1" onchange="formDokter(this.value)" {{ old('isDokter', $item->isDokter) === 1 ? 'checked' : ''}}/>
            <label class="form-check-label" for="dokter-ya">Ya</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="isDokter" id="dokter-no" value="0" onchange="formDokter(this.value)" {{ old('isDokter', $item->isDokter) === 0 ? 'checked' : ''}} {{ old('isDokter', $item->isDokter) ? '' : 'checked' }}/>
            <label class="form-check-label" for="dokter-no">Tidak</label>
          </div>
        </div>
      </div>
      <div id="dokter-form">
        <div class="row mb-4">
          <label class="col-sm-2 col-form-label" for="basic-default-name">No SIP</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" value="{{ old('sip', $item->sip) }}" name="sip" placeholder="XXX.XXXX/SIPD/DPMPTSP-XXX/XX/XXXX" id="sip" disabled>
          </div>
          <label class="col-sm-1 col-form-label" for="basic-default-name">Tarif</label>
          <div class="col-sm-3">
            <input type="number" class="form-control" name="tarif" value="{{ old('tarif', $item->tarif ?? 0) }}" id="tarif" disabled>
          </div>
        </div>
        <div class="row mb-4">
          <label class="col-sm-2 col-form-label" for="basic-default-name">Poliklinik</label>
          <div class="col-sm-10">
            <select class="form-select select2 @error('poliklinik_id') is-invalid @enderror" name="poliklinik_id" id="poliklinik_id" aria-label="Default select example">
                <option value="kosong" selected>Tidak Dalam Poli</option>
                @foreach ($polikliniks as $poli)
                    @if (old('poliklinik_id', $item->poliklinik_id) == $poli->id)
                        <option selected value="{{ $poli->id }}">{{ $poli->name }}</option>
                    @else
                        <option value="{{ $poli->id }}">{{ $poli->name }}</option>
                    @endif
                @endforeach
            </select>
          </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="basic-default-name">Spesialis</label>
          <div class="col-sm-10">
            <select id="specialist_id" class="form-select select2 @error('specialist_id') is-invalid @enderror" name="specialist_id[]" multiple="multiple" disabled>
              <option value="kosong" {{ $specialists->count() == 0 ? 'selected' : ''}} >Tidak Ada</option>
              @foreach ($specialists as $specialist)
                {{-- <option value="{{ $specialist->id }}" @selected(old('specialist_id') == $specialist->id)>{{ $specialist->name }}</option> --}}
                <?php 
                $isSelected = in_array($specialist->id, old('specialist_id', $item->specialists->pluck('id')->toArray()));
                ?>
                <option value="{{ $specialist->id }}" {{ $isSelected ? 'selected' : '' }}>{{ $specialist->name }}</option>
              @endforeach
            </select>
          </div>
        </div>  
      </div>
      <hr>

      {{--modal create ttd --}}
    <div class="modal fade" id="signaturePadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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

    <div class="text-end">
      <button type="submit" class="btn btn-sm btn-dark">Update</button>
    </div>
  </div>
  </form>
</div>

<script>
  let tempElementImage;
  let tempTextArea;

  function openModal(element){
    tempElementImage = $(element).closest('.row').find('#ttdImage');
    tempTextArea = $(element).closest('.row').find('#ttdTextArea');
    $('#signaturePadModal').modal('show');
  }

  document.addEventListener("DOMContentLoaded", function(){
    var wrapper = document.getElementById("signaturePadModal");
    var clearButton = wrapper.querySelector("[data-action=clear]");
    var saveButton = wrapper.querySelector("[data-action=save]");
    var canvas = wrapper.querySelector("canvas");
    var signaturePad;

    signaturePad = new SignaturePad(canvas);

    clearButton.addEventListener('click', function(e){
      e.preventDefault();
      signaturePad.clear();
    });

  saveButton.addEventListener("click", function (e) {
      e.preventDefault();
      var signatureData = signaturePad.toDataURL();
      tempElementImage.attr('src', signatureData);
      tempTextArea.val(signatureData);
      // document.getElementById("signature64").value = signatureData;
      signaturePad.clear();
      
      //close modal
      $('#signaturePadModal').modal('hide');
  });

  const radioYaDokter = document.getElementById('dokter-ya');
  const radioTidakDokter = document.getElementById('dokter-no');
  if (radioYaDokter.checked) {
    formDokter(radioYaDokter.value);
  } 
  if (radioTidakDokter.checked) {
    formDokter(radioTidakDokter.value);
  }
});

function formDokter(value){
  const sip = document.getElementById('sip');
  const tarif = document.getElementById('tarif');
  const spesialis = document.getElementById('specialist_id');
  const poliklinik = document.getElementById('poliklinik_id');
  if (value == true) {
    sip.disabled = false;
    tarif.disabled = false;
    spesialis.disabled = false;
    poliklinik.disabled = false;
  } else {
    sip.value = null;
    sip.disabled = true;
    tarif.value = 0;
    tarif.disabled = true;
    spesialis.clear = null;
    spesialis.disabled = true;
    poliklinik.disabled = true;
  }
}
</script>
@endsection