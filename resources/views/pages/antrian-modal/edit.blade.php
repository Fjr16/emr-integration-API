<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="backDropModalTitle">Registrasi Ulang Antrian a/n <span class="text-primary">{{ $item->patient->name }}</span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="basic-default-name">No Antrian</label>
            <div class="col-sm-9">
                <input type="text" value="{{ $item->no_antrian ?? '' }}" class="form-control form-control-sm" id="basic-default-name" disabled />
            </div>
            {{-- <div class="col-sm-4">
          <button class="btn btn-warning btn-sm" disabled>Pasien Belum Datang</button>
        </div> --}}
        </div>
        {{-- <div class="row mb-3">
        <label for="basic-default-name" class="col-sm-3 col-form-label">Kode Booking</label>
        <div class="col-sm-9">
          <input type="number" name="name" class="form-control form-control-sm" id="basic-default-name" disabled />
        </div>
      </div> --}}
        <div class="row mb-3">
            <label for="basic-default-name" class="col-sm-3 col-form-label">No RM</label>
            <div class="col-sm-9">
                <input type="text" value="{{ implode('-', str_split(str_pad($item->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}" class="form-control form-control-sm" id="basic-default-name" disabled />
            </div>
        </div>
        <div class="row mb-3">
            <label for="basic-default-name" class="col-sm-3 col-form-label">Nama</label>
            <div class="col-sm-9">
                <input type="text" value="{{ $item->patient->name ?? '' }}" class="form-control form-control-sm" id="basic-default-name" disabled />
            </div>
        </div>
        <div class="row mb-3">
            <label for="basic-default-name" class="col-sm-3 col-form-label">Poli</label>
            <div class="col-sm-9">
                <input type="text" value="{{ $item->doctorPatient->user->roomDetail->name ?? '' }}" class="form-control form-control-sm" id="basic-default-name" disabled />
            </div>
        </div>
        <div class="row mb-3">
            <label for="basic-default-name" class="col-sm-3 col-form-label">Telp</label>
            <div class="col-sm-9">
                <input type="number" value="{{ $item->patient->telp ?? '' }}" class="form-control form-control-sm" id="basic-default-name" disabled />
            </div>
        </div>
        <div class="row mb-3">
            <label for="basic-default-name" class="col-sm-3 col-form-label">Penjamin</label>
            <div class="col-sm-9">
                <input type="text" value="{{ $item->patientCategory->name ?? '' }}" class="form-control form-control-sm" id="basic-default-name" disabled />
            </div>
        </div>
        <div class="row mb-3">
            <label for="basic-default-name" class="col-sm-3 col-form-label">Tanggal Berobat</label>
            <div class="col-sm-9">
                @php
                    $tglBerobatUnix = strtotime($item->tgl_antrian);
                    $tglBerobat = new DateTime();
                    $tglBerobat->setTimestamp($tglBerobatUnix);
                @endphp
                <input type="text" value="{{ $tglBerobat->format('d-m-Y') ?? '' }}" class="form-control form-control-sm" id="basic-default-name" disabled />
            </div>
        </div>
        <div class="row mb-3">
            <label for="basic-default-name" class="col-sm-3 col-form-label">No Kartu BPJS</label>
            <div class="col-sm-9">
                <input type="number" value="{{ $item->patient->noka ?? '' }}" class="form-control form-control-sm" id="basic-default-name" disabled />
            </div>
        </div>
        <div class="row mb-3">
            <label for="basic-default-name" class="col-sm-3 col-form-label">No Rujukan</label>
            <div class="col-sm-9">
                <input type="text" value="{{ $item->no_rujukan ?? '' }}" class="form-control form-control-sm" id="basic-default-name" disabled />
            </div>
        </div>
        <div class="row mb-3">
            <label for="basic-default-name" class="col-sm-3 col-form-label">Diagnosa</label>
            <div class="col-sm-9">
                <input type="text" value="{{ $item->last_diagnostic ?? '' }}" class="form-control form-control-sm" id="basic-default-name" disabled />
            </div>
        </div>
        {{-- <div class="card bg-warning text-white p-3">
        Hati-hati dalam membatalkan antrian ini, jika pasien datang, maka antrian harus diambil baru
      </div> --}}
    </div>
    <div class="modal-footer">
        @if ($item->patientCategory->name == 'BPJS')
        <a href="{{ route('sep.rajal', [$item->id, 'rajal', encrypt($item->patient->noka), $item->no_rujukan ? encrypt($item->no_rujukan) : null ]) }}" class="btn btn-warning btn-sm">Lanjutkan</a>
        @else
        <a href="{{ route('antrian/konfirmasi.update', $item->id) }}" class="btn btn-warning btn-sm">Lanjutkan</a>
        @endif
    </div>
</div>