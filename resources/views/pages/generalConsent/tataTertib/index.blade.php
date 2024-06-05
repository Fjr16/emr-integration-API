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
          <a href="{{ route('general-consent-ranap.tataTertib', $item->id) }}" class="btn {{ Route::is('general-consent-ranap.tataTertib*') ? 'btn-primary' : '' }} border btn-sm col-3">Tata Tertib RS </a>
        </div>
    </div>

    <div class="card-body">
      <div class="">
        <h6 class="text-center bg-dark text-white py-2">
          KEBIJAKAN PELAYANAN
        </h6>
        <p>
            1. Pelayanan IGD 24 Jam
        </p>
        <div class="">
          <p>
            2. Pelayanan Rawat jalan
          </p>
          <ul>
            <li>
              Pendaftaran Online 24 jam
            </li>
            <li>
              Pendaftaran di Admisi : Senin-Minggu (kecuali hari libur nasional): jam 08.00 sampai 15 menit sebelum poliklinik di mulal
            </li>
            <li>
              Pelayanan Senin-Minggu (kecuali hari libur nasional): Jam 08.00 sampai 15 menit sebelum poliklinik dimulai.
            </li>
          </ul>
        </div>
        <p>
          3. Pelayanan Kemoterapi
        </p>
        <div class="">
          <ul>
            <li>
              Pendaftaran di Admisi : Senin-Sabtu: jam 08.00 WIB
            </li>
            <li>
              Pelayanan Kemoterapi Senin - Sabtu: Jam 10.00 Minggu dan libur nasional tutup
            </li>
          </ul>
        </div>
        <p>
          4. Pelayanan Rawat Inap 24 jam
        </p>
        <div class="">
          <ul>
            <li>
              Waktu Berkunjung Rawat Inap : Pagi: Jam 09:30 WIB sampai dengan 11:30 WIB Sore: Jam 18:00 WIB sampai dengan 21:00 WIB 
            </li>
            <li>
              Penunggu pasien rawat inap wajib memakai kartu penunggu.
            </li>
          </ul>
        </div>
        <p>
          Setiap pasien / pengunjung wajib mematuhi tata tertib yang berlaku di RSK Bedah Ropanasuri dan wajib melakukan screening sebelum memasuki Rumah Sakit.
        </p>
        <p>
          Anak-anak dibawah usia 12 (duabelas) tahun dilarang memasuki Rumah Sakit kecuali untuk berobat.
        </p>
        <p>
          Pasien yang ditunggu keluarga (dibatasi hanya 1 (satu) orang penunggu) dalam ruang perawatan.
        </p>
        <p>
          Pasien dalam kondisi terminal, penunggu dan pengunjung diizinkan lebih dari 1 (satu) orang dan didampingi tenaga kerohanian (sesuai permintaan pasien).
        </p>
        <p>
          Menjaga kebersihan dan ketertiban ruangan.
        </p>
        <p>
          Dilarang keras merokok di lingkungan RSK Bedah Ropanasuri bagi pasien, pengunjung dan penunggu pasien.
        </p>
        <p>
          Dilarang mengunjungi pasien di luar waktu yang telah ditentukan.
        </p>
        <p>
          Diperkenankan sebanyak 2 (dua) orang secara bergantian untuk membesuk pasien.
        </p>
        <p>
          Pihak RSK Bedah Ropanasuri melarang kepada pasien dan keluarga untuk tidak membawa barang berharga ke rumah sakit, akan tetapi untuk pasien dengan kondisi tertentu RSK Bedah Ropanasuri menyediakan tempat penyimpanan harta sementara.
        </p>
        <p>
          Pihak RSK Bedah Ropanasuri tidak bertanggung jawab apabila terjadi kehilangan uang/barang berharga selama masa perawatan atau kunjungan.
        </p>
      </div>
      <div class="">
        <h6 class="text-center bg-dark text-white py-2">
          PASIEN
        </h6>
        <p>
          Pasien harus mematuhi dan menaati peraturan dan tata tertib yang berlaku.
        </p>
        <p>
          Pasien tidak diperkenankan membawa barang elektronik (Ex: lainnya, rice cooker, kipas angin, dll.) barang berharga minuman keras, dan senjata tajam atau alat yang dapat dijadikan senjata
        </p>
        <p>
          Pasien rawat inap harus membawa perlengkapan pribadi pasien, pakaian, sabun mandi, sikat gigi, pasta gigi, dan alat makan.
        </p>
        <p>
          Pasien tidak diperkenankan membawa obat-obatan tanpa sepengetahuan dokter / perawat ruangan selama perawatan.
        </p>
        <p>
          Pasien tidak diperkenankan untuk keluar ruangan rawatan kecuali sudah diizinkan pulang oleh dokter yang merawat serta sudah menyelesaikan administrasi.
        </p>
      </div>
      <div class="">
        <h6 class="text-center bg-dark text-white py-2">
          PENDAMPING
        </h6>
        <p>
          Pendamping pasien harus memiliki kartu pendamping name min khusus yang diberikan oleh RSK Bedah Ropanasuri
        </p>
        <p>
          Pasien anak-anak usia dibawah 18 tahun ditunggu oleh orang tuanya atau orang yang ditunjuk untuk mewakiti orang tuanya
        </p>
        <p>
          Pendamping pasien hanya diperkenankan 1 (satu) orang kecuali ruang rawat VIP 2 (dua) orang dan pendamping adalah yang memiliki hubungan kekerabatan atau muhrim
        </p>
        <p>
          Keluarga diperkenankan ke ruang rawat apabila diperlukan sesuai dengan kebutuhan, sesuai permintaan dokter/perawat ruangan,
        </p>
        <p>
          Makanan yang dibawa oleh keluarga sebaiknya segera dikonsumsi agar tidak terjadi kontaminasi dan pembusukan makanan kecuali makanan yang memiliki daya simpan (seperti biskuit, roti, susu kemasan karena Rumah Sakit tidak menyediakan fasilitas untuk penyimpanan makanan
        </p>
        <p>
          Bagi pasien yang mendapatkan diet/pengaturan makanan khusus dari Rumah Sakit, maka makanan yang dikonsumsi tidak bebas diberikan dan adanya pembatasan makanan/diet agar tidak terjadi kontraindikas dietnya kecuali jika pasien tidak mau mengkonsumsi makanan Rumah Sakit harus konfirmasi terlebin dahulu ke petugas.
        </p>
        <p>
          Pendamping dilarang mencuci pakalan di kamar mandi pasien dan menjamur pakalan di lingkungan RSK Bedah Ropanasuri.
        </p>
      </div>
      <div class="">
        <h6 class="text-center bg-dark text-white py-2">
          LAIN-LAIN
        </h6>
        <p>
          Pasien dan keluarga bertanggungjawab atas kerusakan dan kehilangan barang atau alat inventaris yang ditimbulkan pasien dan keluarga.
        </p>
        <p>
          Pasien dan keluarga tidak diperkenankan membawa fasilitas Rumah Sakit keluar dari Rumah Sakit.
        </p>
        <p>
          Keluarga dan pendamping pasien dilarang tidur, berbaring dan duduk di tempat tidur pasien lain
        </p>
      </div>
    </div> 
</div>

@endsection