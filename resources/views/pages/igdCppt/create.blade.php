<form action="{{ route('igd/cppt.store', $igd_patient->id) }}" method="POST">
    @csrf
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalScrollableTitle">CPPT</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          </button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <h6>Tanggal</h6>
                <div class="col-md-10">
                  <input class="form-control" type="datetime-local" value="{{ $today }}" name="tanggal" id="html5-datetime-local-input" />
                </div>
          </div>
          <div class="mb-3">
            <input type="hidden" value="{{ $item->id }}" name="patient_id">
            <h6>Profesional Pemberi Asuhan (PPA)</h6>
            <input type="text" class="form-control" id="floatingInput" value="{{ Auth::user()->name }} ({{ Auth::user()->staff_id }})" aria-describedby="floatingInputHelp" readonly/>
          </div>
          <div class="mb-3">
            <h6>Hasil Pemerikasaan, Analisa dan Tindak Lanjut Subjective, Objective, Asesmen, Planning (SOAP) / ADIME <br>
            <span class="fs-6">(dituliskan dengan format SOAP, disertai dengan sasaran / target yang terukur, evaluasi hasil tata laksana dituliskan didalam asesmen)</span>
            </h6>
            <textarea class="form-control" id="editor" rows="2" name="soap"></textarea>
          </div>
          <div class="mb-3">
            <h6>Instruksi Tenaga Kesehatan termasuk Bedah / Prosedur<br>
            <span class="fs-6">(Intrusksi ditulis dengan rinci dan jelas)</span>
            </h6>
            <textarea class="form-control" id="editor1" rows="2" name="intruksi"></textarea>
          </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-dark btn-sm">Save changes</button>
        </div>
      </div>
</form>