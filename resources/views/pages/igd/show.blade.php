    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title text-white" id="backDropModalTitle">Detail Data Pasien</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row mb-3">
          <label class="col-sm-3 col-form-label" for="basic-default-name">No Rekam Medis</label>
          <div class="col-sm-9">
            <input type="text" value="{{ implode('-', str_split(str_pad($item->queue->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2))}}" class="form-control form-control-sm" id="basic-default-name" disabled />
          </div>
        </div>
        <div class="row mb-3">
          <label for="basic-default-name" class="col-sm-3 col-form-label">Nama</label>
          <div class="col-sm-9">
            <input type="text" value="{{ $item->queue->patient->name ?? ''}}" class="form-control form-control-sm" id="basic-default-name" disabled /> 
          </div>
        </div>
        <div class="row mb-3">
          <label for="basic-default-name" class="col-sm-3 col-form-label">Penjamin</label>
          <div class="col-sm-9">
            <input type="text" value="{{ $item->queue->patientCategory->name ?? ''}}" class="form-control form-control-sm" id="basic-default-name" disabled /> 
          </div>
        </div>
        <div class="row mb-3">
          <label for="basic-default-name" class="col-sm-3 col-form-label">tanggal Lahir</label>
          <div class="col-sm-9">
            <input type="text" value="{{ $item->queue->patient->tanggal_lhr ?? '' }}" class="form-control form-control-sm" id="basic-default-name" disabled /> 
          </div>
        </div>
        <div class="row mb-3">
          <label for="basic-default-name" class="col-sm-3 col-form-label">No Telp</label>
          <div class="col-sm-9">
            <input type="text" value="{{ $item->queue->patient->telp ?? ''}}" class="form-control form-control-sm" id="basic-default-name" disabled /> 
          </div>
        </div>
        <div class="row mb-3">
          <label for="basic-default-name" class="col-sm-3 col-form-label">Tanggal Berobat</label>
          <div class="col-sm-9">
            <input type="text" value="{{ $item->queue->tgl_antrian ?? ''}}" class="form-control form-control-sm" id="basic-default-name" disabled /> 
          </div>
        </div>
        <div class="row mb-3">
          <label for="basic-default-name" class="col-sm-3 col-form-label">Poli / Dokter</label>
          <div class="col-sm-9">
            <input type="text" value="{{ $item->user->roomDetail->name ?? '' }} / {{ $item->user->name ?? ''}}" class="form-control form-control-sm" id="basic-default-name" disabled /> 
          </div>
        </div>
        <div class="row mb-3">
          <label for="basic-default-name" class="col-sm-3 col-form-label">Status</label>
          <div class="col-sm-9">
            <input type="text" value="{{ $item->queue->status_antrian ?? '' }}" class="form-control form-control-sm" id="basic-default-name" disabled /> 
          </div>
        </div>
        <div class="card bg-warning p-1">
          <div>
            <textarea class="form-control" id="text-area1" rows="9">
              Pasien Yth, {{ $item->queue->patient->name ?? ''}} sudah terdaftar di RSK Bedah Ropanasuri dengan:

              Nomor RM : {{ implode('-', str_split(str_pad($item->queue->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2))}}
              di Poli : {{ $item->user->roomDetail->name ?? '' }}
              Tanggal : {{ $item->queue->tgl_antrian ?? '' }}
              Jadwal Dokter : 
              
              Mohon melakukan pendaftaran ulang kebagian PENDAFTARAN dimulai pukul 08:00 sampai minimal 15 menit sebelum poliklinik dimulai.
              Dengan membawa KTP/KK, Kartu BPJS/Asuransi, dan Jaminan Lainnya.
              
            </textarea>
          </div>
          <button type="button" class="btn btn-warning btn-sm mt-2" onclick="copyToClipboard()">Copy</button>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning btn-sm" data-bs-dismiss="modal">Tutup</button>
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
  
