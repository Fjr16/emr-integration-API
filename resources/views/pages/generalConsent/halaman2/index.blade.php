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
        <h6 class="text-center bg-dark text-white py-2">
          HARTA BENDA MILIK PASIEN
        </h6>
        <p>
          Saya telah memahami bahwa RSK Bedah Ropanasuri bertanggung jawab atas semua harta benda yang dibawa pasien ODC (Pelayanan Satu Hani) pasien rawat inap, serta untuk pasien yang tidak mampu mengamb keputusan untuk menjaga keamanan harta benda mereka karena tidak sadarkan diri atau tidak didampingi penunggu. Dan apabila saya membutuhkan, maka saya dapat menitipkan barang-barang saya kepada Rumah Sakit
        </p>
        <p>
          Saya secara pribadi bertanggung jawab atas barang-barang berharga yang saya miliki namun tidak terbatas pada uang, perhiasan, buku, kartu ATM, kartu kredit, handphone atau barang lainnya. Dan apabila saya membutuhkan maka saya dapat menitipkan barang-barang saya kepada Rumah Sakit
        </p>
      </div>
      <div class="">
        <h6 class="text-center bg-dark text-white py-2">
          PERSETUJUAN PELEPASAN INFORMASI
        </h6>
        <p>
          Saya memahami informasi yang ada di dalam diri saya, termasuk diagnosis, hasil laboratorium, dan hasil tes diagnostik yang akan digunakan untuk perawatan medis, RSK Bedah Ropanasuri akan menjamin kerahasiaannya.
        </p>
        <p>
          Saya memberi wewenang kepada RSK Bedah Ropanasuri untuk memberikan informasi tentang rahasia kedokteran saya bila diperlukan untuk memproses klaim Asuransi termasuk namun tidak terbatas pada BPJS Kesehatan, BPJS Ketenagakerjaan, asuransi kesehatan lainnya, Perusahaan, Dinas Kesehatan, atau Lembaga Pemerintah lainnya.
        </p>
        <div class="mb-2">
          <form action="{{ route('general-consent-ranap.update', $item->id) }}" method="POST">
          @csrf
          @method('PUT')
          <p>
            Saya <span><input type="radio" {{ $item->persetujuan_pelepasan_informasi == 'ya' ? 'checked' : '' }} class="mx-2" name="persetujuan_pelepasan_informasi" id="basic-default-name" value="ya">menyetujui</span> ATAU<span><input type="radio" class="mx-2" name="persetujuan_pelepasan_informasi" id="basic-default-name" {{ $item->persetujuan_pelepasan_informasi == 'tidak' ? 'checked' : '' }} value="tidak">tidak menyetujui</span>pelepasan informasi (diagnosis, hasil pelayanan, dan pengobatan) terkait perawatan saya kepada anggota keluarga saya (termasuk kondisi kritis atau situasi tertentu), nama : {{ $item->name }}, hubungan dengan pasien : {{ $item->hubungan }}
          </p>
          <button class="btn btn-sm btn-success">Submit</button>
          </form>
        </div>
      </div>
      <div class="">
        <h6 class="text-center bg-dark text-white py-2">
          PENDAPAT KEDUA (SECOND OPINION)
        </h6>
        <p>
          RSK Bedah Ropanasuri memfasilitasi permintaan pasien untuk mencari pendapat kedua (second opinion) tanpa perlu khawatir akan mempengaruhi perawatannya selama di dalam/luar Rumah Sakit
        </p>
      </div>
      <div class="">
        <h6 class="text-center bg-dark text-white py-2">
          PENYAMPAIAN KELUHAN/PENDAPAT SELAMA PERAWATAN
        </h6>
        <p>
          RSK Bedah Ropanasuri meneydiakan fasilitas kepada pasien dan keluarga untuk menyampaikan keluhan/pendapat sejak pasien mengakses pelayanan, selama menjalani masa perawatan dan pada proses pemulangan melalui:
        </p>
        <p>
          a. Pengisian kotak saran yang berada di IGD/Rawat jalan/Rawat Inap
        </p>
        <p>
          b. Melalul layanan pengaduan di Aplikasi WhatsApp: 0812-6729-2974
        </p>
      </div>
      <div class="">
        <h6 class="text-center bg-dark text-white py-2">
          INFORMASI TATA TERTIB BAGI PASIEN, PENGUNJUNG DAN PENUNGGU PASIEN
        </h6>
        <p>
          Saya telah menerima informasi tentang tata tertib yang diberlakukan oleh RSK Bedah Ropanasuri dan saya beserta keluarga bersedia untuk mematuhinya, termasuk akan mematuhi jam berkunjung pasien sesuai dengan aturan di Rumah Sakit.
        </p>
      </div>
      <div class="">
        <h6 class="text-center bg-dark text-white py-2">
          INFORMASI BIAYA
        </h6>
        <p>
          Sebagai peserta JKN dan atau Asuransi lainnya Saya bersedia mengurus jaminan Rawat Inap dalam waktu 3 x 24 jam hari kerja (terhitung pasien masuk) dan atau sebelum pasien pulang. Apabila saya tidak mengurus dalam waktu tersebut diatas, saya bersedia terdaftar sebagai pasien umum / pribadi, Saya memahami tentang informasi biaya pengobatan atau biaya tindakan yang dijelaskan oleh petugas Rumah Sakit. Pasien umum / pribadi pembiayaan yang dikenakan mengacu kepada tarif pelayanan yang ada di RSK Bedah Ropanasuri Padang.
        </p>
      </div>
    </div> 
</div>

@endsection