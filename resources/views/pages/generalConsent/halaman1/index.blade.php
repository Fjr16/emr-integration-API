@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif
  <div class="card mb-4">
    <div class="card-header m-0">
        <div class="row">
        <div class="col-9">
            <h5 class="mb-0 m-0">General Consent <span class="fs-4 fw-bold text-primary">{{ $item->rawatInapPaitent->queue->patient->name ?? '' }}</span></h5>
        </div>
        <div class="col-3 m-0 text-end">
            <button class="btn btn-success btn-sm " onclick="history.back()">Kembali</button>
        </div>
        </div>
        <div class="row m-auto mt-2">
          <a href="{{ route('general-consent-ranap.halaman1', $item->id) }}" class="btn {{ Route::is('general-consent-ranap.halaman1*') ? 'btn-primary' : '' }} border btn-sm col-3">Halaman 1</a>
          <a href="{{ route('general-consent-ranap.halaman2', $item->id) }}" class="btn {{ Route::is('general-consent-ranap.halaman2*') ? 'btn-primary' : '' }} border btn-sm col-3">Halaman 2</a>
          <a href="{{ route('general-consent-ranap.tataTertib', $item->id) }}" class="btn {{ Route::is('general-consent-ranap.tataTertib*') ? 'btn-primary' : '' }} border btn-sm col-3">Tata Tertib RS</a>
        </div>
    </div>

    <div class="card-body">
      <div class="">
        <h6 class="text-center bg-dark text-white py-2">Data Penanggung Jawab</h6>
        <p class="fw-bold">Persetujuan Umum (General Consent) diisi oleh pasien atau keluarga yang berusia z 18 tahun. Pasien, Keluarga dan atau Wali selaku kuasa dari pasien diminta untuk membaca, memahami dan mengisi informasi berik Yang bertanda tangan di bawah ini:</p>
        <div class="">
          <p>Yang bertanda tangan di bawah ini:</p>
          <div class="mx-2 row">
            <div class="col col-2">Nama</div>
            <div class="col col-4">: {{ $item->name }}</div>
          </div>
          <div class="mx-2 row">
            <div class="col col-2">Tanggal Lahir</div>
            <div class="col col-4">: {{ $item->tgl_lhr }}</div>
          </div>
          <div class="mx-2 row">
            <div class="col col-2">Jenis Kelamin</div>
            <div class="col col-4">: {{ $item->kelamin }}</div>
          </div>
          <div class="mx-2 row">
            <div class="col col-2">Alamat</div>
            <div class="col col-4">: {{ $item->alamat }}</div>
          </div>
          <div class="mx-2 row">
            <div class="col col-2">No . Telp / HP</div>
            <div class="col col-4">: {{ $item->phone }}</div>
          </div>
          <div class="mx-2 row">
            <div class="col col-2">Hubungan</div>
            <div class="col col-4">: {{ $item->hubungan }}</div>
          </div>
        </div>
        <p class="mt-2">Dengan ini menyatakan persetujuan</p>
      </div>
      <div class="">
        <h6 class="text-center bg-dark text-white py-2">PERSETUJUAN UNTUK PERAWATAN DAN PENGOBATAN</h6>
        <p class="">
          Saya menyetujul untuk perawatan di RSK Bedah Ropanasuri sebagai pasien rawat inap tergantung kepada rencana asuhan sesuai dengan kebutuhan pasien dengan Dokter Penanggung Jawab Pelayanan (DPJP) adalah {{ $item->dpjp }}
        </p>
        <p>
          Saya mengetahui bahwa saya memiliki kondisi yang membutuhkan perawatan medis, saya mengizinkan dokter dan profesional kesehatan lainnya untuk melakukan prosedur diagnostik dan untuk memberikan pengobatan medis seperti yang diperlukan dalam profesional mereka. Prosedur diagnostik dan perawatan medis termasuk terapi tidak terbatas pada electrocardiogram, x-ray (radiologi), tes darah, terapi fisik, pemberian obat (kecuali yang membutuhkan persetujuan khusus / tertulis), perawatan rutin dan prosedur seperti pemasangan infus. pemasangan kateter, spalak, pemberian oksigen, dan suntikan.
        </p>
        <p>
          Saya sadar bahwa praktik kedokteran bukanlah ilmu pasti dan saya mengakui bahwa tidak ada jaminan atas hasil apapun, terhadap perawatan prosedur atau pemeriksaan apapun yang dilakukan kepada saya.
        </p>
        <p>
          Persetujuan yang saya berikan tidak termasuk prosedur pembedahan atau tindakan invasif, anestesi, sedasi, penggunaan darah dan produk darah, perataan atau tindakan berisiko tinggi maka diperlukan persetujuan tindakan secara terpisah (informed consent).
        </p>
        <div class="">
          <p>
            Saya mengerti dan memahami bahwa:
          </p>
          <p class="mx-2">
            Saya memiliki hak untuk mendapatkan akses terhadap informasi kesehatan saya dan mengajukan pertanyaan tentang pengobatan yang diusulkan (termasuk identitas setiap orang yang memberikan atau mengamati pengobatan) setiap saat.
          </p>
          <p class="mx-2">
            Saya mengerti dan memahami bahwa saya memiliki hak untuk menyetujui atau menolak persetujuan, untuk setiap prosedur / terapi dan saya memahami dan menyadari bahwa RSK Bedah Ropanasuri atau dokter tidak bertanggung jawab atas hasil yang merugikan saya.
          </p>
        </div>
      </div>
      <div class="">
        <h6 class="text-center bg-dark text-white py-2">
          HAK DAN TANGGUNG JAWAB PASIEN
        </h6>
        <p>
          Saya memiliki hak untuk mengambil bagian dalam keputusan mengenai penyakit saya dan dalam hal perawatan medis dan rencana pengobatan.
        </p>
        <p>
          Saya telah mendapat informasi tentang "Hak dan Tanggung jawab Pasien di RSK Bedah Ropanasuri Padang melalu banner, leaflet, dan form tertulis yang disediakan oleh petugas.
        </p>
      </div>
      <div class="">
        <h6 class="text-center bg-dark text-white py-2">
          KEBUTUHAN PRIVASI
        </h6>
        <p>
          Saya mengizinkan/tidak mengizinkan RSK Bedah Ropanasuri memberikan akses bagi keluarga serta orang yang akan membesuk/menemui saya.
        </p>
        <p>
          Saya mengizinkan tidak mengizinkan RSK Bedah Ropanasuri untuk difoto/direkam dan dikutsertakan dalam survei.
        </p>
        <div class="">
          <p>
            Saya tidak menginginkan / menginginkan* privasi khusus (sebutkan bila ada privasi khusus, abaikan / kosongkan jika tidak) : 
          </p>
          <form action="{{ route('general-consent-ranap.update', $item->id) }}" method="POST">
          @csrf
          @method('PUT')
            <input type="text" name="kebutuhan_privasi" class="form-control w-50" id="basic-default-name" value="{{ $item->kebutuhan_privasi }}">
            <button class="btn btn-sm btn-primary mt-2" type="submit">Submit</button>
          </form>
        </div>
      </div>
    </div> 
</div>

@endsection