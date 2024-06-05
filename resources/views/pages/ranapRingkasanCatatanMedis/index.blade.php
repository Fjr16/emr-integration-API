@extends('layouts.backend.main')

@section('content') 
  @if (session()->has('success'))
  <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute"
      style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
      {{ session('success') }}
  </div>
  @endif
  <div class="card p-3 mt-5">
    <h5>
      RINGKASAN CATATAN MEDIS PASIEN KELUAR
      <span class="fst-italic">(DISCHARGE SUMMARY)</span>
    </h5>
    <form action="{{ route('ringkasan/catatan/medis.store', $item->id) }}" method="POST">
      @csrf
      <div class="d-flex mb-3">
          <div class="col-4">
            <label for="defaultFormControlInput" class="form-label">TANGGAL MASUK</label>
            <input type="datetime-local" class="form-control" name="tanggal_masuk" value="{{ date('Y-m-d H:i:s') }}">
          </div>
          <div class="col-4 ms-auto">
            <label for="defaultFormControlInput" class="form-label">TANGGAL KELUAR</label>
            <input type="datetime-local" class="form-control" name="tanggal_keluar" value="{{ date('Y-m-d H:i:s') }}">
          </div>
      </div>
      <div class="row mb-4">
        <div class="col">
          <label for="defaultFormControlInput" class="form-label">DOKTER PENGIRIM</label>
          <input type="text" class="form-control" name="dokter_pengirim" value="{{ $item->queue->doctorPatient->user->name ?? '' }}" readonly>
        </div>
      </div>
      <div class="row mb-5">
        <h6 class="col">INDIKASI PASIEN DIRAWAT</h6>
        <div class="form-floating">
          <textarea
            id="editor"
            class="form-control"
            name="indikasi"
            style="height: 100px"
          ></textarea>
        </div>
      </div>
      <div class="row mb-5">
        <h6 class="col">ANAMNESIS</h6>
        <div class="form-floating">
          <textarea
            id="editor2"
            class="form-control"
            name="anamnesis"
            style="height: 100px"
          ></textarea>
        </div>
      </div>
      <div class="row mb-5">
        <h6 class="col">RIWAYAT PENYAKIT</h6>
        <div class="form-floating">
          <textarea
            id="editor3"
            class="form-control"
            name="riwayat_penyakit"
            style="height: 100px"
          ></textarea>
        </div>
      </div>
      <div class="row mb-5">
        <h6 class="col">PEMERIKSAAN FISIK</h6>
        <div class="form-floating">
          <textarea
            id="editor4"
            class="form-control"
            name="pemeriksaan_fisik"
            style="height: 100px"
          ></textarea>
        </div>
      </div>
      <div class="row mb-5">
        <h6 class="col">PEMERIKSAAN DIAGNOSTIK</h6>
        <div class="form-floating">
          <textarea
            id="editor5"
            class="form-control"
            name="pemeriksaan_diagnostik"
            style="height: 100px"
          ></textarea>
        </div>
      </div>
      <div class="row mb-5">
        <div class="col-10">
          <h6 class="col">DIAGNOSA UTAMA</h6>
          <textarea
            id="editor6"
            name="diagnosa_utama"
            class="form-control"
            style="height: 100px"
          ></textarea>
        </div>
        <div class="col-2">
          <p>ICD 10</p>
          <div class="row">
            <input type="text" name="icdD[]" class="col form-control form-control-sm" />
            <input type="text" name="icdD[]" class="col form-control form-control-sm" />
            <input type="text" name="icdD[]" class="col form-control form-control-sm" />
            <input type="text" name="icdD[]" class="col form-control form-control-sm" />
          </div>
        </div>
      </div>
      <div class="row mb-5">
        <div class="col-10">
          <h6 class="col">KORMODIBITAS LAIN</h6>
          <textarea
            id="editor7"
            name="karmobiditas"
            class="form-control"
            style="height: 100px"
          ></textarea>
        </div>
        <div class="col col-2">
          <p>ICD 10</p>
          <div class="row">
            <input type="text" name="icdK[]" class="col form-control form-control-sm" />
            <input type="text" name="icdK[]" class="col form-control form-control-sm" />
            <input type="text" name="icdK[]" class="col form-control form-control-sm" />
            <input type="text" name="icdK[]" class="col form-control form-control-sm" />
          </div>
          <div class="row">
            <input type="text" name="icdK[]" class="col form-control form-control-sm" />
            <input type="text" name="icdK[]" class="col form-control form-control-sm" />
            <input type="text" name="icdK[]" class="col form-control form-control-sm" />
            <input type="text" name="icdK[]" class="col form-control form-control-sm" />
          </div>
          <div class="row">
            <input type="text" name="icdK[]" class="col form-control form-control-sm" />
            <input type="text" name="icdK[]" class="col form-control form-control-sm" />
            <input type="text" name="icdK[]" class="col form-control form-control-sm" />
            <input type="text" name="icdK[]" class="col form-control form-control-sm" />
          </div>
          <div class="row">
            <input type="text" name="icdK[]" class="col form-control form-control-sm" />
            <input type="text" name="icdK[]" class="col form-control form-control-sm" />
            <input type="text" name="icdK[]" class="col form-control form-control-sm" />
            <input type="text" name="icdK[]" class="col form-control form-control-sm" />
          </div>
          <div class="row">
            <input type="text" name="icdK[]" class="col form-control form-control-sm" />
            <input type="text" name="icdK[]" class="col form-control form-control-sm" />
            <input type="text" name="icdK[]" class="col form-control form-control-sm" />
            <input type="text" name="icdK[]" class="col form-control form-control-sm" />
          </div>
          <div class="row">
            <input type="text" name="icdK[]" class="col form-control form-control-sm" />
            <input type="text" name="icdK[]" class="col form-control form-control-sm" />
            <input type="text" name="icdK[]" class="col form-control form-control-sm" />
            <input type="text" name="icdK[]" class="col form-control form-control-sm" />
          </div>
        </div>
      </div>
      <div class="row mb-5">
        <div class="col-10">
          <h6 class="col">TINDAKAN DIAGNOSTIK / PROSEDUR TERAPI</h6>
          <textarea
            id="editor9"
            name="terapi"
            class="form-control"
            style="height: 100px"
          ></textarea>
        </div>
        <div class="col col-2">
          <p>ICD 9 CM</p>
          <div class="row">
            <input type="text" name="icdT[]" class="col form-control form-control-sm" />
            <input type="text" name="icdT[]" class="col form-control form-control-sm" />
            <input type="text" name="icdT[]" class="col form-control form-control-sm" />
          </div>
          <div class="row">
            <input type="text" name="icdT[]" class="col form-control form-control-sm" />
            <input type="text" name="icdT[]" class="col form-control form-control-sm" />
            <input type="text" name="icdT[]" class="col form-control form-control-sm" />
          </div>
          <div class="row">
            <input type="text" name="icdT[]" class="col form-control form-control-sm" />
            <input type="text" name="icdT[]" class="col form-control form-control-sm" />
            <input type="text" name="icdT[]" class="col form-control form-control-sm" />
          </div>
        </div>
      </div>

      <div class="row mb-5">
        <label class="form-label-md col-sm-3 fw-bold" id="label-kolom">OBAT YANG DIBERIKAN SELAMA RAWAT INAP</label>
        <div class="row">
          <div class="col-sm-3">
            <label for="medicine_id_ranap" class="form-label">Nama Obat</label>
            <select id="medicine_id_ranap_1" name="medicine_id_ranap[]" class="form-select form-select-sm" data-allow-clear="true">
              <option selected disabled>Pilih</option>
              @foreach ($medicines as $obat)
                  @if (old('medicine_id_ranap') == $obat->id)
                    <option value="{{ $obat->id }}" selected>{{ $obat->kode ?? '' }}/{{ $obat->name ?? '' }}</option>
                  @else
                    <option value="{{ $obat->id }}">{{ $obat->kode ?? '' }}/{{ $obat->name ?? '' }}</option>
                  @endif
              @endforeach
            </select>
          </div>
          <div class="col-sm-1">
            <label class="form-label" for="basic-default-name">Jumlah</label>
            <input type="number" class="form-control" name="jumlah_ranap[]"/>
          </div>
          <div class="col-sm-2">
            <label class="form-label" for="basic-default-name">Aturan Penggunaan</label>
            <input type="text" class="form-control" name="aturan_pakai_ranap[]"/>
          </div>
          <div class="col-sm-2">
            <label class="form-label">Keterangan Penggunaan</label>
            <select name="keterangan_ranap[]" class="form-select form-select-md" data-allow-clear="true">
              <option selected disabled>Pilih</option>
              <option value="Sebelum Makan">Sebelum Makan</option>
              <option value="Sesudah Makan">Sesudah Makan</option>
            </select>
          </div>
          <div class="col-sm-3">
            <label class="form-label">Keterangan Lainnya</label>
            <textarea name="other_ranap[]" class="form-control" cols="30" rows="1"></textarea>
          </div>
          <div class="col-sm-1 d-flex align-self-center mt-4">
            <button type="button" class="btn btn-sm btn-dark" onclick="addResepRanap(this)"><i class="bx bx-plus"></i></button>
          </div>
        </div>
      </div>

      <div class="row mb-5">
        <label class="form-label-md col-sm-3 fw-bold" id="label-kolom">OBAT YANG HARUS DIGUNAKAN DIRUMAH</label>
        <div class="row">
          <div class="col-sm-3">
            <label for="medicine_id" class="form-label">Nama Obat</label>
            <select id="medicine_id_1" name="medicine_id[]" class="form-select form-select-sm" data-allow-clear="true">
              <option selected disabled>Pilih</option>
              @foreach ($medicines as $obat)
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
      <div class="row mb-5">
        <h6 class="col">KONDISI PASIEN SAAT PULANG (STATUS PRESENT)</h6>
        <div class="row">
          @foreach ($arrKondisiPasien as $kondisi)      
          <div class="col-6">
            <div class="form-check">
              <input type="radio" class="form-check-input kondisi-check" name="kondisi" value="{{ $kondisi }}" id="{{ $kondisi }}" onclick="removeKondisi()"/>
              <label class="form-check-label" for="{{ $kondisi }}"
                >{{ $kondisi }}</label
              >
            </div>
          </div>
          @if ($loop->last)              
          <div class="col-6" id="kondisi_lainnya">
            <div class="form-check mb-2">
              <label class="form-check-label" for="kondisi">
                <div class="d-flex">
                  <div class="col-sm-12">
                    <input type="text" id="kondisi-input" name="kondisi" class="form-control form-control-sm" onchange="uncheckKondisi()"/>
                  </div>
                </div>
              </label>
            </div>
          </div>
          @endif
          @endforeach
        </div>
      </div>

      <div class="row mb-5">
        <h6 class="col">INTRUKSI TINDAK LANJUT</h6>
        <div class="form-floating">
          <textarea
            id="editor8"
            class="form-control"
            name="intruksi"
            style="height: 100px"
          ></textarea>
        </div>
      </div>

      <div class="row mb-5">
        <h6 class="col">
          Pengobatan dilanjutkan di:
        </h6>
        @foreach ($arrNextPlace as $dilanjutkan) 
        @if ($loop->first)  
        <div class="form-check">
          <input type="radio" class="form-check-input" name="tindak_lanjut" value="{{ $dilanjutkan }}" id="{{ $dilanjutkan }}" onclick="enableForm(this)"/>
          <label class="form-check-label" for="{{ $dilanjutkan }}">
            <div class="d-flex">
              <span>{{ $dilanjutkan }}</span>
              <span class="mx-2">
                <input id="tindak_lanjut_ropana" type="text" class="form-control form-control-sm" onchange="concatValue(this.value)" disabled/>
              </span>
            </div>
          </label>
        </div>
        @else
        <div class="form-check">
          <input type="radio" class="form-check-input" name="tindak_lanjut" value="{{ $dilanjutkan }}" id="{{ $dilanjutkan }}" onclick="removeTindakLanjut()"/>
          <label class="form-check-label" for="{{ $dilanjutkan }}">{{ $dilanjutkan }}</label>
        </div>
        @endif   
        @endforeach
      </div>
      <div class="mb-3 text-end">
        <button type="submit" class="btn btn-success btn-sm mx-3">Simpan</button>
      </div>
    </form>
  </div>

  <script>
    function enableForm(element){
      var input = document.getElementById('tindak_lanjut_ropana');
      if(element.checked == true){
        input.disabled = false;
      }else{
        input.disabled = true;
      }
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
              @foreach ($medicines as $obat)
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

    function hapusResep(element){
      var root = element.closest('.row');
      root.remove();
    }
    
    let newClick = 2;
    function addResepRanap(element){
      var row = element.closest('.row').parentNode;

      var div = document.createElement('div');
      div.className = 'row';
      div.innerHTML = `
          <div class="col-sm-3">
            <label for="medicine_id_ranap" class="form-label">Nama Obat</label>
            <select id="medicine_id_ranap_${newClick}" name="medicine_id_ranap[]" class="form-select form-select-sm" data-allow-clear="true">
              <option selected disabled>Pilih</option>
              @foreach ($medicines as $obat)
                  @if (old('medicine_id_ranap') == $obat->id)
                    <option value="{{ $obat->id }}" selected>{{ $obat->kode ?? '' }}/{{ $obat->name ?? '' }}</option>
                  @else
                    <option value="{{ $obat->id }}">{{ $obat->kode ?? '' }}/{{ $obat->name ?? '' }}</option>
                  @endif
              @endforeach
            </select>
          </div>
          <div class="col-sm-1">
            <label class="form-label" for="basic-default-name">Jumlah</label>
            <input type="number" class="form-control" name="jumlah_ranap[]"/>
          </div>
          <div class="col-sm-2">
            <label class="form-label" for="basic-default-name">Aturan Pakai</label>
            <input type="text" class="form-control" name="aturan_pakai_ranap[]"/>
          </div>
          <div class="col-sm-2">
              <label class="form-label">Keterangan Penggunaan</label>
              <select name="keterangan_ranap[]" class="form-select form-select-md" data-allow-clear="true">
                <option selected disabled>Pilih</option>
                <option value="Sebelum Makan">Sebelum Makan</option>
                <option value="Sesudah Makan">Sesudah Makan</option>
              </select>
            </div>
            <div class="col-sm-3">
              <label class="form-label">Keterangan Lainnya</label>
              <textarea name="other_ranap[]" class="form-control" id="other" cols="30" rows="1"></textarea>
            </div>
          <div class="col-sm-1 d-flex align-self-center mt-4">
            <button type="button" class="btn btn-sm btn-danger" onclick="hapusResep(this)"><i class="bx bx-minus"></i></button>
          </div>`;

          row.appendChild(div);
          $('#medicine_id_ranap_' + newClick).select2();
          newClick++;
    }


    // function tambahInput(element){
    //   // var parent = $(element).closest('#kondisi_lainnya');
    //   var parent = document.getElementById('kondisi_lainnya');
    //   var div = document.createElement('div');
    //   div.className = 'form-check mb-2';
    //   div.innerHTML = `<label class="form-check-label" for="kondis">
    //             <div class="d-flex">
    //               <div class="col-sm-12">
    //                 <input type="text" name="kondisi[]" class="form-control form-control-sm" />
    //               </div>
    //               <div class="mx-1 col-2">
    //                 <button type="button" class="btn btn-danger btn-sm" onclick="hapusInput(this)">-</button>
    //               </div>
    //             </div>
    //           </label>`;
    //   parent.appendChild(div);
    // }

    // function hapusInput(element){
    //   var formCheck = element.parentNode.parentNode.parentNode.parentNode;
    //   formCheck.remove();
    // }

    function concatValue(value){
      var checkTindakLanjutValue = document.getElementById('RSK Bedah Ropanasuri, Poliklinik:');
      var newValue = 'RSK Bedah Ropanasuri, Poliklinik:' + value;
      console.log(newValue);
      checkTindakLanjutValue.value = newValue;
      
    }

    function removeTindakLanjut(){
      var formTindakLanjut = document.getElementById('tindak_lanjut_ropana');
      formTindakLanjut.value = '';
      formTindakLanjut.disabled = true;
    }

    function uncheckKondisi(){
      var kondisiFormChecks = document.querySelectorAll('.kondisi-check');
      kondisiFormChecks.forEach(element => {
        element.checked = false;
      });
    }

    function removeKondisi(){
      var kondisiInput = document.getElementById('kondisi-input');
      kondisiInput.value = '';
    }
  </script>

@endsection
