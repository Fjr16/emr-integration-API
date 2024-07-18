@extends('layouts.backend.main')

@section('content')
<div class="card mb-4">
  <form method="POST" action="{{ route('user.update', $item->id) }}">
    @csrf
    @method('PUT')
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Edit Staff</h5>
    </div>
    <div class="card-body">
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="basic-default-name">NIK</label>
        <div class="col-sm-10">
          <input type="number" class="form-control" id="defaultFormControlInput"
          name="nik" value="{{ $item->nik }}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="16" />
        </div>
      </div>
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="basic-default-name">Name</label>
        <div class="col-sm-10">
            <input type="text" name="name" class="form-control" id="basic-default-name" value="{{ old('name', $item->name) }}" required />
        </div>
      </div>
      <div class="row mb-3">
        <label for="exampleFormControlSelect1" class="col-sm-2 col-form-label">Jenis Kelamin</label>
        <div class="col-sm-10">
        <select class="form-select form-select-sm select2" id="gender"
            aria-label="Default select example" name="gender">
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
      </div>
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="basic-default-name">Tanggal Lahir</label>
        <div class="col-sm-10">
            <input type="date" name="tgl_lahir" class="form-control" id="basic-default-name" value="{{ old('tgl_lahir', $item->tgl_lahir) }}" required />
        </div>
      </div>
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="basic-default-name">No Telp</label>
          <div class="col-sm-10">
          <input type="number" name="telp" class="form-control" id="basic-default-name" value="{{ old('telp', $item->telp) }}" required />
          </div>
      </div>
      <div class="row mb-3">
        <label for="exampleFormControlSelect1" class="col-sm-2 col-form-label">Status Pernikahan</label>
        <div class="col-sm-10">
          <select class="form-select form-select-sm select2" id="stt"
            aria-label="Default select example" name="status_kawin">
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
      </div>
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="basic-default-name">Jumlah Anak</label>
          <div class="col-sm-10">
          <input type="number" name="jumlah_anak" class="form-control" id="basic-default-name" value="{{ old('jumlah_anak', $item->jumlah_anak) }}" required />
          </div>
      </div>
      <div class="row mb-3">
        <label for="exampleFormControlSelect1" class="col-sm-2 col-form-label">Pendidikan Terakhir</label>
        <div class="col-sm-10">
          <select class="form-select form-select-sm select2"
            aria-label="Default select example" name="pendidikan">
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
      </div>
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="basic-default-name">Alamat Sesuai KTP</label>
          <div class="col-sm-10">
            <textarea name="alamat_ktp" class="form-control">{{ old('alamat_ktp', $item->alamat_ktp) }}</textarea>
          </div>
      </div>
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="basic-default-name">Alamat Domisili</label>
          <div class="col-sm-10">
            <textarea name="alamat_domisili" class="form-control">{{ old('alamat_domisili', $item->alamat_domisili) }}</textarea>
          </div>
      </div>
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Ayah</label>
        <div class="col-sm-10">
            <input type="text" name="ayah" class="form-control" id="basic-default-name" value="{{ old('ayah', $item->ayah) }}" required />
        </div>
      </div>
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Ibu</label>
        <div class="col-sm-10">
            <input type="text" name="ibu" class="form-control" id="basic-default-name" value="{{ old('ibu', $item->ibu) }}" required />
        </div>
      </div>
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Kontak Darurat</label>
          <div class="col-sm-10">
          <input type="text" name="nama_kontak_darurat" class="form-control" id="basic-default-name" value="{{ old('nama_kontak_darurat', $item->nama_kontak_darurat) }}" required />
          </div>
      </div>
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="basic-default-name">No Telp Kontak Darurat</label>
          <div class="col-sm-10">
          <input type="number" name="no_kontak_darurat" class="form-control" id="basic-default-name" value="{{ old('no_kontak_darurat', $item->no_kontak_darurat) }}" required />
          </div>
      </div>
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="basic-default-name">Alamat Kontak Darurat</label>
          <div class="col-sm-10">
            <textarea name="alamat_kontak_darurat" class="form-control">{{ old('alamat_kontak_darurat', $item->alamat_kontak_darurat) }}</textarea>
          </div>
      </div>
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="basic-default-name">Pengalaman Kerja</label>
          <div class="col-sm-10">
            <textarea name="pengalaman" class="form-control">{{ old('pengalaman', $item->pengalaman) }}</textarea>
          </div>
      </div>
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="basic-default-name">Keterangan</label>
          <div class="col-sm-10">
            <textarea name="catatan" class="form-control">{{ old('catatan', $item->catatan) }}</textarea>
          </div>
      </div>
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="basic-default-name">Staff Id</label>
        <div class="col-sm-10">
            <input type="text" name="staff_id" class="form-control" id="basic-default-name" value="{{ old('staff_id', $item->staff_id) }}" required />
        </div>
      </div>
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="basic-default-name">Username</label>
          <div class="col-sm-10">
          <input type="text" name="email" class="form-control" id="basic-default-name" value="{{ old('email', $item->email) }}" required />
          </div>
      </div>
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="basic-default-name">Password</label>
        <div class="col-sm-10">
            <input type="text" name="password" class="form-control" id="basic-default-name"/>
            <small>( catatan: Jika password tidak ingin diubah, biarkan saja kosong )</small>
        </div>
      </div>
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Rekening</label>
        <div class="col-sm-10">
            <input type="text" name="nama_rekening" class="form-control" id="basic-default-name" value="{{ old('nama_rekening', $item->nama_rekening) }}" required />
        </div>
      </div>
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="basic-default-name">Nomor Rekening</label>
        <div class="col-sm-10">
            <input type="number" name="no_rekening" class="form-control" id="basic-default-name" value="{{ old('no_rekening', $item->no_rekening) }}" required />
        </div>
      </div>
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="basic-default-name">Tanggal Gabung</label>
        <div class="col-sm-10">
            <input type="date" name="tgl_masuk" class="form-control" id="basic-default-name" value="{{ old('tgl_masuk', $item->tgl_masuk) }}" required />
        </div>
      </div>        
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="basic-default-name">Role</label>
        <div class="col-sm-10">
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
        <label class="col-sm-2 col-form-label" for="basic-default-name">Spesialis</label>
        <div class="col-sm-10">
          <select id="specialist_id" class="form-select select2 @error('specialist_id') is-invalid @enderror" name="specialist_id[]" multiple="multiple">
            <option value="kosong" {{ $specialists->count() == 0 ? 'selected' : ''}} >Tidak Ada</option>
            @foreach ($specialists as $specialist)
              <?php 
              $isSelected = in_array($specialist->id, old('specialist_id', $item->specialists->pluck('id')->toArray()));
              ?>
              <option value="{{ $specialist->id }}" {{ $isSelected ? 'selected' : '' }}>{{ $specialist->name }}</option>
              @endforeach
          </select>
        </div>
      </div>
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="basic-default-name">Unit / Departemen</label>
        <div class="col-sm-10">
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
        <label class="col-sm-2 col-form-label" for="basic-default-name">Poli</label>
        <div class="col-sm-10">
          <select class="form-select select2 @error('room_detail_id') is-invalid @enderror" name="room_detail_id" aria-label="Default select example">
              <option value="kosong" selected>Tidak Dalam Poli</option>
              @foreach ($polis as $poli)
                  @if (old('room_detail_id', $item->room_detail_id) == $poli->id)
                      <option selected value="{{ $poli->id }}">{{ $poli->name }}</option>
                  @else
                      <option value="{{ $poli->id }}">{{ $poli->name }}</option>
                  @endif
              @endforeach
          </select>
        </div>
      </div>
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="basic-default-name">Status</label>
        <div class="col-sm-10">
          <select class="form-select @error('status') is-invalid @enderror" name="status" aria-label="Default select example">
              <option selected disabled>Pilih</option>
              @foreach ($status as $status)
                  @if (old('status', $item->status) == $status)
                      <option selected value="{{ $status }}">{{ $status }}</option>
                  @else
                      <option value="{{ $status }}">{{ $status }}</option>
                  @endif
              @endforeach
          </select>
        </div>
      </div>
      <div class="row mb-3 mt-4">
        <div class="col-sm-2">
          <button type="button" class="btn btn-sm btn-dark" id="addParaf" onclick="openModal(this)">Tambah Tanda Tangan</button>
        </div>
        <div class="col-sm-10">
          <img src="{{ Storage::url($item->paraf) }}" alt="" id="ttdImage" class="border">
          <textarea name="tanda_tangan" id="ttdTextArea" cols="30" rows="10" style="display: none">{{ $item->paraf ?? '' }} @required(true)</textarea>
        </div>
      </div>
    

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
      <button type="submit" class="btn btn-sm btn-dark">Simpan</button>
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
});
</script>
@endsection