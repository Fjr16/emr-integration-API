<form class="modal-content" action="{{ route('antrian/konfirmasi.store', $item->id) }}" method="POST">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="backDropModalTitle">Detail Data Antrian</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="basic-default-name">No Antrian</label>
            <div class="col-sm-5">
                <input type="text" class="form-control form-control-sm" id="basic-default-name"
                    value="{{ $item->no_antrian ?? '' }}" disabled />
            </div>
            <div class="col-sm-4">
                <input type="text" class="form-control form-control-sm" id="basic-default-name"
                    value="{{ \Carbon\Carbon::parse($item->tgl_antrian)->format('d-m-Y') ?? '' }}" disabled />
            </div>
        </div>
        <div class="row mb-3">
            <label for="basic-default-name" class="col-sm-3 col-form-label">Nama</label>
            <div class="col-sm-9">
                <input type="text" class="form-control form-control-sm" id="basic-default-name"
                    value="{{ $item->patient->name ?? '' }}" disabled />
            </div>
        </div>
        <div class="row mb-3">
            <label for="basic-default-name" class="col-sm-3 col-form-label">No RM</label>
            <div class="col-sm-9">
                <input type="text" class="form-control form-control-sm" id="basic-default-name"
                    value="{{ implode('-', str_split(str_pad($item->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}"
                    disabled />
            </div>
        </div>
        <div class="row mb-3">
            <label for="basic-default-name" class="col-sm-3 col-form-label">Alamat</label>
            <div class="col-sm-9">
                <input type="text" value="{{ $item->patient->alamat ?? '' }}" class="form-control form-control-sm"
                    id="basic-default-name" disabled />
            </div>
        </div>
        <div class="row mb-3">
            <label for="basic-default-name" class="col-sm-3 col-form-label">Poli</label>
            <div class="col-sm-9">
                <input type="text" value="{{ $item->dpjp->roomDetail->name ?? '' }}"
                    class="form-control form-control-sm" id="basic-default-name" disabled />
            </div>
        </div>
        <div class="row mb-3">
            <label for="basic-default-name" class="col-sm-3 col-form-label">Dokter</label>
            <div class="col-sm-9">
                <input type="text" value="{{ $item->dpjp->name ?? '' }}"
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
            <label for="basic-default-name" class="col-sm-3 col-form-label">Petugas</label>
            <div class="col-sm-9">
                <input type="text" value="{{ $item->user->name ?? '' }}" class="form-control form-control-sm"
                    id="basic-default-name" disabled />
            </div>
        </div>
        <div class="row mb-3">
            <label for="basic-default-name" class="col-sm-3 col-form-label">Kuota</label>
            <div class="col-sm-9">
                <input type="text" value="{{ $item->kuota ?? '' }}" class="form-control form-control-sm"
                    id="basic-default-name" disabled />
            </div>
        </div>
    </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-warning btn-sm" name="status_antrian" value="GAGAL CHECKIN">Tidak
            Hadir</button>
        <button type="submit" class="btn btn-warning btn-sm" name="status_antrian"
            value="CHECKIN">Lanjutkan</button>
    </div>
</form>
