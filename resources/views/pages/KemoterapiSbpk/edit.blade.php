@extends('layouts.backend.main')

@section('content')

  @if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif

  <form action="{{ route('kemoterapi/sbpk.update', $item->id) }}" method="POST">
    @csrf
    <div class="card mb-4">
      <div class="card-header m-0">
          <h5 class="mb-0 m-0">Surat  Bukti Pelayanan Kesehatan</h5>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-8">
            {{-- <div class="row mb-3">
              <label for="defaultFormControlInput" class="col-md-3 col-form-label">No Rekam Medis</label>
              <div class="col-md-9">
                <select class="form-control select2" id="patient_id" name="patient_id" onchange="getPatient()">
                  <option value="" selected>Pilih</option>
sbpkKemoterapi                  <option value="si anu">Si Anu</option>
                  <option value="si anu">ssi annu</option>
                </select>
              </div>
            </div>  --}}
            <div class="mb-3 row">
              <label for="no_rm" class="col-md-3 col-form-label">No Rekam Medis</label>
              <div class="col-md-9">
                <input class="form-control" type="text" value="{{ implode('-', str_split(str_pad($item->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}" id="no_rm" disabled/>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="nama-pasien" class="col-md-3 col-form-label">Nama Pasien</label>
              <div class="col-md-9">
                <input class="form-control" type="text" value="{{ $item->patient->name ?? '' }}" id="nama-pasien" disabled/>
              </div>
            </div>

            <div class="mb-3 row">
              <label for="html5-date-input" class="col-md-3 col-form-label">Jenis Kelamin</label>
              <div class="col-md-9">
                <input class="form-control" type="text" name="jenis_kelamin" value="{{$item->patient->jenis_kelamin}}" id="html5-date-input" disabled />
              </div>
            </div>
            <div class="mb-3 row">
              <label for="html5-date-input" class="col-md-3 col-form-label">Tanggal Masuk RS</label>
              <div class="col-md-9">
                <input class="form-control" type="date" value="{{$kemoterapiSbpkPatient->tanggal_masuk}}" name="tanggal_masuk" id="html5-date-input" />
              </div>
            </div>
          </div>
          <div class="col-4">
            <div class="mx-3">
                <div class="form-check">
                    <input name="default-radio-1" class="form-check-input" type="radio" value="Kunjungan Awal"
                        id="defaultRadio1"
                        {{ $kemoterapiSbpkPatient->keterangan == 'Kunjungan Awal' ? 'checked' : '' }} />
                    <label class="form-check-label" for="defaultRadio1">
                        Kunjungan Awal
                    </label>
                </div>
                <div class="form-check">
                    <input name="default-radio-1" class="form-check-input" type="radio"
                        value="Kunjungan Lanjutan" id="defaultRadio2"
                        {{ $kemoterapiSbpkPatient->keterangan == 'Kunjungan Lanjutan' ? 'checked' : '' }} />
                    <label class="form-check-label" for="defaultRadio2">
                        Kunjungan Lanjutan
                    </label>
                </div>
                <div class="form-check">
                    <input name="default-radio-1" class="form-check-input" type="radio" value="Observasi"
                        id="defaultRadio3"
                        {{ $kemoterapiSbpkPatient->keterangan == 'Observasi' ? 'checked' : '' }} />
                    <label class="form-check-label" for="defaultRadio3">
                        Observasi
                    </label>
                </div>
                <div class="form-check">
                    <input name="default-radio-1" class="form-check-input" type="radio" value="Post Operasi"
                        id="defaultRadio4"
                        {{ $kemoterapiSbpkPatient->keterangan == 'Post Operasi' ? 'checked' : '' }} />
                    <label class="form-check-label" for="defaultRadio4">
                        Post Operasi
                    </label>
                </div>
            </div>
          </div>
          <div class="col-12">
            <div class="mb-3">
              <label for="editor" class="form-label">Anamnesa</label>
              <textarea class="form-control" id="editor" value="asd" name="anamnesa"></textarea>
            </div>
          </div>
        </div>
      <table class="table table-bordered mb-3">
        <thead>
          <tr class="text-center">
            {{-- <th class="text-body">Poliklinik / Penunjang</th> --}}
            <th class="text-body">Diagnosa</th>
            <th class="text-body">ICDX</th>
            <th class="text-body">Tindakan / Pemberi Penunjang</th>
            <th class="text-body">action</th>
          </tr>
        </thead>
        <tbody id="detailSbpk">
            <tr>
              {{-- <td>
                <select class="form-control select3" id="poliklinik-penunjang" name="poliklinik-penunjang" style="width: 100%">
                  <option value="" selected>Pilih</option>
                  <option value="si anu">Si Anu</option>
                  <option value="si anu">ssi annu</option>
                </select>
              </td> --}}
              {{-- <td>
                <input class="form-control" type="text" value="{{ $item->patient->name ?? '' }}" disabled/>
              </td> --}}
              <td>
                <input class="form-control" type="text" name="diagnosa[]" value="" id="diagnosa" />
              </td>
              <td>
                <input class="form-control" type="text" name="icd[]" value="" id="icd" />
              </td>
              <td>
                <input class="form-control" type="text" name="nama_tindakan[]" value="" id="nama_tindakan" />
              </td>
              <td class="text-center">
                <button type="button" class="btn btn-dark btn-sm" id="tambah_detail">+</button>
              </td>
            </tr>
        </tbody>
      </table>
      <table class="table table-bordered mb-3">
        <thead>
          <tr class="text-center">
            <th class="text-body" colspan="2">Diagnosis</th>
            <th class="text-body">Kode ICDX</th>
            <th class="text-body">action</th>
          </tr>
        </thead>
        <tbody id="diagnosaTambahan">
          <tr>
            <td>
              Diagnosis Utama
            </td>
            <td>
              <input class="form-control" type="text" value="" name="diagnosis_utama" id="diagnosis_utama" />
            </td>
            <td>
              <input class="form-control" type="number" value="" name="icdx" id="icdx" />
            </td>
            <td class="text-center">
            </td>
          </tr>
          <tr>
            <td>
              Diagnosis Tambahan
            </td>
            <td>
              <input class="form-control" type="text" value="" name="diagnosa_name[]"/>
            </td>
            <td>
              <input class="form-control" type="number" value="" name="diagnosa_icdx[]"/>
            </td>
            <td class="text-center">
              <button type="button" class="btn btn-dark btn-sm" id="tambah_diagnosa">+</button>
            </td>
          </tr>
        </tbody>
      </table>
      <table class="table table-bordered mb-3">
        <thead>
          <tr class="text-center">
            <th class="text-body" colspan="2">Tindakan / Prosedur</th>
            <th class="text-body">Kode ICD-G</th>
            <th class="text-body">action</th>
          </tr>
        </thead>
        <tbody id="tindakanTambahan">
          <tr>
            <td>
              Tindakan Utama
            </td>
            <td>
              <input class="form-control" type="text" value="" name="tindakan_utama" id="tindakan_utama" />
            </td>
            <td>
              <input class="form-control" type="number" value="" name="icdg" id="icdg" />
            </td>
            <td class="text-center">
            </td>
          </tr>
          <tr>
            <td>
              Tindakan Tambahan
            </td>
            <td>
              <input class="form-control" type="text" name="action_name[]"/>
            </td>
            <td>
              <input class="form-control" type="number" name="action_icdg[]"/>
            </td>
            <td class="text-center">
              <button type="button" class="btn btn-dark btn-sm" id="tambah_tindakan">+</button>
            </td>
          </tr>
        </tbody>
      </table>
      <div class="mb-3">
        <div class="text-end">
          <button type="submit" class="btn btn-sm btn-dark">Simpan</button>
          <button type="button" class="btn btn-sm btn-secondary" onclick="history.back()">Batal</button>
        </div>
      </div>
    </div>
  </form>

  <script>
    document.getElementById("tambah_detail").addEventListener("click", tambahDetail);

    function tambahDetail(){
      var tBody = document.getElementById('detailSbpk');

      var newTr = document.createElement('tr');
      newTr.innerHTML = `
                <td>
                  <input class="form-control" type="text" name="diagnosa[]"/>
                </td>
                <td>
                  <input class="form-control" type="text" name="icd[]"/>
                </td>
                <td>
                  <input class="form-control" type="text" name="nama_tindakan[]" />
                </td>
                <td class="text-center">
                  <button type="button" class="btn btn-danger btn-sm" onclick="removeElement(this)">-</button>
                </td>
            `;

      tBody.appendChild(newTr);

    }
  </script>
  <script>
    document.getElementById("tambah_tindakan").addEventListener("click", tambahTindakan);

    function tambahTindakan(){
      var tBody = document.getElementById('tindakanTambahan');
      var newTr = document.createElement('tr');
      newTr.innerHTML = `
                <tr>
                  <td>
                  </td>
                  <td>
                    <input class="form-control" type="text" value="" name="action_name[]"/>
                  </td>
                  <td>
                    <input class="form-control" type="number" value="" name="action_icdg[]"/>
                  </td>
                  <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeElement(this)">-</button>
                  </td>
                </tr>
              `;
      tBody.appendChild(newTr);
    }

  </script>
  <script>
    document.getElementById("tambah_diagnosa").addEventListener("click", tambahDiagnosa);

    function tambahDiagnosa(){
      var tBody = document.getElementById('diagnosaTambahan');
      var newTr = document.createElement('tr');
      newTr.innerHTML = `
                <tr>
                  <td>
                  </td>
                  <td>
                    <input class="form-control" type="text" value="" name="diagnosa_name[]"/>
                  </td>
                  <td>
                    <input class="form-control" type="number" value="" name="diagnosa_icdx[]"/>
                  </td>
                  <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeElement(this)">-</button>
                  </td>
                </tr>
              `;
      tBody.appendChild(newTr);
    }

  </script>
  <script>
    function removeElement(element){
      element.parentNode.parentNode.remove();
    }
  </script>
@endsection
