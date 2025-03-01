    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title text-white" id="backDropModalTitle">Detail Data Pasien</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row mb-3">
          <label class="col-sm-3 col-form-label" for="basic-default-name">No Rekam Medis</label>
          <div class="col-sm-9">
            <input type="text" value="{{ $item->patient->no_rm }}" class="form-control form-control-sm" id="basic-default-name" disabled />
          </div>
        </div>
        <div class="row mb-3">
          <label for="basic-default-name" class="col-sm-3 col-form-label">Nama Pasien</label>
          <div class="col-sm-9">
            <input type="text" value="{{ $item->patient->name }}" class="form-control form-control-sm" id="basic-default-name" disabled /> 
          </div>
        </div>
        <div class="row mb-3">
          <div class="row">
            <label for="basic-default-name" class="col-sm-3 col-form-label">Tempat / Tanggal Lahir</label>
            <div class="col-sm-6">
              <input type="text" value="{{ $item->patient->tanggal_lhr }}" class="form-control form-control-sm" id="basic-default-name" disabled /> 
            </div>
            /
            <div class="col-sm-3">
              <input type="text" value="{{ $item->patient->tanggal_lhr }}" class="form-control form-control-sm" id="basic-default-name" disabled /> 
            </div>
          </div>
        </div>
        <div class="row mb-3">
          <label for="basic-default-name" class="col-sm-3 col-form-label">Jenis Kelamin</label>
          <div class="col-sm-9">
            <input type="text" value="{{ $item->patient->telp }}" class="form-control form-control-sm" id="basic-default-name" disabled /> 
          </div>
        </div>
        <div class="row mb-3">
          <label for="basic-default-name" class="col-sm-3 col-form-label">Status</label>
          <div class="col-sm-9">
            <input type="text" value="{{ $item->status ?? '' }}" class="form-control form-control-sm" id="basic-default-name" disabled /> 
          </div>
        </div>
        <div class="row mb-3">
          <label for="basic-default-name" class="col-sm-3 col-form-label">No Telp</label>
          <div class="col-sm-9">
            <input type="text" value="{{ $item->patient->telp }}" class="form-control form-control-sm" id="basic-default-name" disabled /> 
          </div>
        </div>
        <div class="row mb-3">
          <label for="basic-default-name" class="col-sm-3 col-form-label">Daftar Alergi Pasien</label>
          <div class="col-sm-9">
            <input type="text" value="{{ $item->patient->telp }}" class="form-control form-control-sm" id="basic-default-name" disabled /> 
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
            <input type="text" value="{{ $item->doctor->poli->name ?? '' }} / {{ $item->doctor->name ?? ''}}" class="form-control form-control-sm" id="basic-default-name" disabled /> 
          </div>
        </div>
        
        <div class="card bg-warning p-1">
          <div>
            <textarea class="form-control" id="text-area1" rows="9">
              Pasien Yth, {{ $item->patient->name }} sudah terdaftar di RSK Bedah Ropanasuri dengan:

              Nomor RM : {{ $item->patient->no_rm }}
              di Poli : {{ $item->doctor->poli->name ?? '' }}
              Tanggal : {{ $item->tgl_antrian }}
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
  
