    <form action="{{ route('antrian.store') }}" method="POST">
    @csrf
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title text-white" id="backDropModalTitle">Anda Membuat Antrian Untuk Pasien: </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <div class="row mb-3">
          <label class="col-sm-3 col-form-label" for="basic-default-name">No Rekam Medis</label>
          <input type="hidden" value="{{ $item->id }}" name="patient_id">
          <div class="col-sm-3">
            <input type="text" value="{{ implode('-', str_split(str_pad($item->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2))}}" class="form-control form-control-sm" id="basic-default-name" disabled />
          </div>
          /
          <div class="col-sm-5">
            <input type="text" value="{{ $item->name }}" class="form-control form-control-sm" id="basic-default-name" disabled />
          </div>
        </div>

        <div class="row mb-3">
          <label for="basic-default-name" class="col-sm-3 col-form-label">Tempat / Tanggal lahir</label>
          <div class="col-sm-3">
            <input type="text" value="{{ $item->tempat_lhr }}" class="form-control form-control-sm" id="basic-default-name" disabled />
          </div>/
          <div class="col-sm-5">
            <input type="text" value="{{ $item->tanggal_lhr }}" class="form-control form-control-sm" id="basic-default-name" disabled />
          </div>
        </div>

        <div class="row mb-3">
            <div class="col col-6">
                <div class="row mb-3">
                    <label for="basic-default-name" class="col-sm-6 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-6">
                      <input type="text" value="{{ $item->jenis_kelamin }}" class="form-control form-control-sm" id="basic-default-name" disabled />
                    </div>
                  </div>
            </div>
            <div class="col col-6">
                <div class="row mb-3">
                    <label for="basic-default-name" class="col-sm-3 col-form-label">Status</label>
                    <div class="col-sm-7">
                      <input type="text" value="{{ $item->status }}" class="form-control form-control-sm" id="basic-default-name" disabled />
                    </div>
                  </div>
            </div>
            <div class="col col-6">
                <div class="row mb-3">
                    <label for="basic-default-name" class="col-sm-6 col-form-label">No Telp</label>
                    <div class="col-sm-6">
                      <input type="text" value="{{ $item->telp }}" class="form-control form-control-sm" id="basic-default-name" disabled />
                    </div>
                  </div>
            </div>
            <div class="col col-6">
                <div class="row mb-3">
                    <label for="basic-default-name" class="col-sm-3 col-form-label">NIK</label>
                    <div class="col-sm-7">
                      <input type="text" value="{{ $item->nik }}" class="form-control form-control-sm" id="basic-default-name" disabled />
                    </div>
                  </div>
            </div>
            <div class="col col-6">
                <div class="row mb-3">
                    <label for="basic-default-name" class="col-sm-6 col-form-label">Tanggal Berobat </label>
                    <div class="col-sm-6">
                      <input type="text" value="{{ $data->tgl_antrian ?? '' }}" class="form-control form-control-sm" name="tgl_antrian" readonly />
                    </div>
                  </div>
            </div>
            <div class="col col-6">
                <div class="row mb-3">
                    <label for="basic-default-name" class="col-sm-3 col-form-label">Poli / Dokter</label>
                    <div class="col-sm-7">
                      <input type="hidden" name="doctor_id" value="{{ $dokter->id ?? '' }}">
                      <input type="text" value="{{ $dokter->poliklinik->name ?? '' }} / {{ $dokter->name ?? ''}}" class="form-control form-control-sm" id="basic-default-name" disabled />
                    </div>
                  </div>
            </div>
            <div class="col col-6">
                <div class="row mb-3">
                    <label for="basic-default-name" class="col-sm-6 col-form-label">Penjamin</label>
                    <div class="col-sm-6">
                      <input type="hidden" value="{{ $patient_category->id ?? '' }}" name="patient_category_id"/>
                      <input type="text" value="{{ $patient_category->name ?? '' }}" class="form-control form-control-sm" readonly />
                    </div>
                  </div>
            </div>
            <div class="col col-6">
                <div class="row mb-3">
                    <label for="basic-default-name" class="col-sm-3 col-form-label">No Rujukan</label>
                    <div class="col-sm-7">
                      <input type="text" value="{{ $data->no_rujukan ?? '' }}" class="form-control form-control-sm" name="no_rujukan" readonly />
                    </div>
                  </div>
            </div>
            <div class="col col-6">
                <div class="row mb-3">
                    <label for="basic-default-name" class="col-sm-6 col-form-label">Diagnosa</label>
                    <div class="col-sm-6">
                      <input type="text" name="last_diagnostic" value="{{ $data->last_diagnostic ?? '' }}" class="form-control form-control-sm" readonly />
                    </div>
                  </div>
            </div>
        </div>

        <div class="row mb-3">
          <label for="basic-default-name" class="col-sm-3 col-form-label">Alamat</label>
          <div class="col-sm-8">
            <textarea class="form-control form-control-sm" disabled>{{ $item->alamat }}</textarea>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-outline-primary btn-sm">Submit</button>
        <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Batal</button>
      </div>
    </div>
  </form>
