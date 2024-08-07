<div class="modal-content">
    @php
        $tglBerobatUnix = strtotime($item->tgl_antrian);
        $tglBerobat = new DateTime();
        $tglBerobat->setTimestamp($tglBerobatUnix);
    @endphp
    <div class="modal-header">
        <h5 class="col-sm-6 modal-title" id="backDropModalTitle">Antrian No. <span class="fw-bold text-primary">{{ $item->no_antrian ?? '..' }}</span></h5>
        <h5 class="col-sm-6 modal-title text-end">Tgl. <span class="fw-bold small fst-italic text-primary">{{ $tglBerobat->format('d/m/Y') ?? '../../....' }}</span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="row mb-3">
            <label for="basic-default-name" class="col-sm-3 col-form-label">No RM / Nama</label>
            <div class="col-sm-9">
                <input type="text" value="{{ implode('-', str_split(str_pad($item->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }} / {{ $item->patient->name ?? '....' }}" class="form-control form-control-sm" id="basic-default-name" disabled />
            </div>
        </div>
        <div class="row mb-3">
            <label for="basic-default-name" class="col-sm-3 col-form-label">Poli / Dokter</label>
            <div class="col-sm-9">
                <input type="text" value="{{ $item->dpjp->poliklinik->name ?? '' }} / {{ $item->dpjp->name ?? '' }}" class="form-control form-control-sm" id="basic-default-name" disabled />
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
            <label for="basic-default-name" class="col-sm-3 col-form-label">No Kartu BPJS</label>
            <div class="col-sm-9">
                <input type="text" value="{{ $item->patient->noka ?? '-' }}" class="form-control form-control-sm" id="basic-default-name" disabled />
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="{{ route('antrian/konfirmasi.update', encrypt($item->id)) }}" class="btn btn-outline-primary btn-sm">Konfirmasi</a>
    </div>
</div>