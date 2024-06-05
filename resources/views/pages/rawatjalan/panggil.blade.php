<form class="modal-content" action="{{ route('rajal/update/panggil', $item->id) }}" method="POST">
    @method('PUT')
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="backDropModalTitle">Panggil Pasien Rawat Jalan a/n <span
                class="text-primary">{{ $item->patient->name }}</span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="basic-default-name">No Antrian</label>
            <div class="col-sm-9">
                <input type="text" value="{{ $item->no_antrian ?? '' }}" class="form-control form-control-sm"
                    id="basic-default-name" disabled />
            </div>
        </div>
        <div class="row mb-3">
            <label for="basic-default-name" class="col-sm-3 col-form-label">No RM</label>
            <div class="col-sm-9">
                <input type="text"
                    value="{{ implode('-', str_split(str_pad($item->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}"
                    class="form-control form-control-sm" id="basic-default-name" disabled />
            </div>
        </div>
        <div class="row mb-3">
            <label for="basic-default-name" class="col-sm-3 col-form-label">Nama</label>
            <div class="col-sm-9">
                <input type="text" value="{{ $item->patient->name ?? '' }}" class="form-control form-control-sm"
                    id="basic-default-name" disabled />
            </div>
        </div>
        <div class="row mb-3">
            <label for="basic-default-name" class="col-sm-3 col-form-label">Poli</label>
            <div class="col-sm-9">
                <input type="text" value="{{ $item->doctorPatient->user->roomDetail->name ?? '' }}"
                    class="form-control form-control-sm" id="basic-default-name" disabled />
            </div>
        </div>
        <div class="row mb-3">
            <label for="basic-default-name" class="col-sm-3 col-form-label">Telp</label>
            <div class="col-sm-9">
                <input type="number" value="{{ $item->patient->telp ?? '' }}" class="form-control form-control-sm"
                    id="basic-default-name" disabled />
            </div>
        </div>
        <div class="row mb-3">
            <label for="basic-default-name" class="col-sm-3 col-form-label">Penjamin</label>
            <div class="col-sm-9">
                <input type="text" value="{{ $item->patientCategory->name ?? '' }}"
                    class="form-control form-control-sm" id="basic-default-name" disabled />
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
                <input type="text" value="{{ $tglBerobat->format('d-m-Y') ?? '' }}"
                    class="form-control form-control-sm" id="basic-default-name" disabled />
            </div>
        </div>
        <div class="row mb-3">
            <label for="basic-default-name" class="col-sm-3 col-form-label">No Kartu BPJS</label>
            <div class="col-sm-9">
                <input type="number" value="{{ $item->patient->noka ?? '' }}" class="form-control form-control-sm" id="basic-default-name"
                    disabled />
            </div>
        </div>
        <div class="row mb-3">
            <label for="basic-default-name" class="col-sm-3 col-form-label">No Rujukan</label>
            <div class="col-sm-9">
                <input type="text" value="{{ $item->no_rujukan ?? '' }}" class="form-control form-control-sm"
                    id="basic-default-name" disabled />
            </div>
        </div>
        <div class="row mb-3">
            <label for="basic-default-name" class="col-sm-3 col-form-label">Diagnosa</label>
            <div class="col-sm-9">
                <input type="text" value="{{ $item->last_diagnostic ?? '' }}" class="form-control form-control-sm"
                    id="basic-default-name" disabled />
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="{{ route('rajal/gagal/panggil', $item->id) }}" class="btn btn-secondary btn-sm">Tidak Hadir</a>
        <button type="submit" class="btn btn-warning btn-sm">Panggil</button>
    </div>
</form>
