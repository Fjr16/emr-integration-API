    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title text-white" id="backDropModalTitle">Antrian <span class="fst-italic fw-bold">{{ $item->no_antrian ?? ''}}</span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row mb-3">
          <label class="col-sm-3 col-form-label" for="basic-default-name">No Rekam Medis / Nama</label>
          <div class="col-sm-9">
            <input type="text" value="{{ implode('-', str_split(str_pad($item->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2))}} / {{ $item->patient->name }}" class="form-control form-control-sm" id="basic-default-name" disabled />
          </div>
        </div>
        <div class="row mb-3">
          <label for="basic-default-name" class="col-sm-3 col-form-label">tanggal Lahir</label>
          <div class="col-sm-9">
            <input type="text" value="{{ \Carbon\Carbon::parse($item->patient->tanggal_lhr)->format('d-m-Y') }}" class="form-control form-control-sm" id="basic-default-name" disabled />
          </div>
        </div>
        <div class="row mb-3">
          <label for="basic-default-name" class="col-sm-3 col-form-label">No Telp</label>
          <div class="col-sm-9">
            <input type="text" value="{{ $item->patient->telp }}" class="form-control form-control-sm" id="basic-default-name" disabled />
          </div>
        </div>
        <div class="row mb-3">
          <label for="basic-default-name" class="col-sm-3 col-form-label">Penjamin</label>
          <div class="col-sm-9">
            <input type="text" value="{{ $item->patientCategory->name }}" class="form-control form-control-sm" id="basic-default-name" disabled />
          </div>
        </div>
        <div class="row mb-3">
          <label for="basic-default-name" class="col-sm-3 col-form-label">Tanggal Berobat</label>
          <div class="col-sm-9">
            <input type="text" value="{{ $item->tgl_antrian }}" class="form-control form-control-sm" id="basic-default-name" disabled />
          </div>
        </div>
        <div class="row mb-3">
          <label for="basic-default-name" class="col-sm-3 col-form-label">Poli / Dokter</label>
          <div class="col-sm-9">
            <input type="text" value="{{ $item->dpjp->poliklinik->name ?? '' }} / {{ $item->dpjp->name ?? ''}}" class="form-control form-control-sm" id="basic-default-name" disabled />
          </div>
        </div>
        <div class="row mb-3">
          <label for="basic-default-name" class="col-sm-3 col-form-label">Status</label>
          <div class="col-sm-9">
            @if ($antrian->status_antrian == 'FINISHED')
                <span class="badge bg-success">SUDAH DILAYANI</span>
            @elseif ($antrian->status_antrian == 'WAITING')
                <span class="badge bg-warning">BELUM DILAYANI</span>
            @elseif ($antrian->status_antrian == 'ARRIVED')
                <span class="badge bg-primary">SEDANG DILAYANI</span>
            @elseif ($antrian->status_antrian == 'CANCEL')
                <span class="badge bg-danger">ANTRIAN BATAL</span>
            @else
                <span class="badge bg-danger">TIDAK DIKETAHUI</span>
            @endif
          </div>
        </div>
        <div class="card bg-primary p-1">
          <div>
            <textarea class="form-control" id="text-area1" rows="9">
              Pasien Yth, {{ $item->patient->name }} sudah terdaftar di RS ***** ***** dengan:

              Nomor RM : {{ implode('-', str_split(str_pad($item->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2))}}
              di Poli : {{ $item->dpjp->poliklinik->name ?? '' }}
              Tanggal : {{ \Carbon\Carbon::parse($item->tgl_antrian)->format('d-m-Y') ?? ''}}
              Jadwal Dokter : {{ $jamAwal->format('H:i') ?? '' }}-{{ $jamAkhir->format('H:i') ?? '' }} WIB

              Mohon melakukan pendaftaran ulang kebagian PENDAFTARAN dimulai pukul {{ $jamKedatangan->format('H:i') }} sampai minimal 15 menit sebelum poliklinik dimulai.
              Dengan membawa KTP/KK, Kartu BPJS/Asuransi, dan Jaminan Lainnya.

            </textarea>
          </div>
          <button type="button" class="btn btn-primary btn-sm mt-2" onclick="copyToClipboard()">Copy</button>
        </div>
      </div>
    </div>

    <script>
      function copyToClipboard() {
			var copyText = document.getElementById("text-area1");
			copyText.select();
			copyText.setSelectionRange(0, 99999);
			document.execCommand("copy");
			alert("Text copied to clipboard");
		}
    </script>

