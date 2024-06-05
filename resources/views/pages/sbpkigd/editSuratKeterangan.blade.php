@extends('layouts.backend.main')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('rajal/keterangan-sbpk.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card mb-4">
            <div class="card-header m-0">
                <h5 class="mb-0 m-0">Surat Keterangan</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3 row">
                            <label for="nama-pasien" class="col-md-3 col-form-label">Nama Pasien</label>
                            <div class="col-md-9">
                                <input class="form-control" type="text" value="{{ $item->patient->name ?? '' }}"
                                    id="nama-pasien" disabled />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="html5-date-input" class="col-md-3 col-form-label">Umur</label>
                            <div class="col-md-9">
                                @php
                                    $tanggal_lahir = $item->patient->tanggal_lhr ?? null;
                                    $umur = '';
                                    if ($tanggal_lahir) {
                                        $tanggal_lahir = \Carbon\Carbon::parse($tanggal_lahir);
                                        $sekarang = \Carbon\Carbon::now();
                                        $tahun = $sekarang->diffInYears($tanggal_lahir);
                                        $bulan = $sekarang->copy()->subYears($tahun)->diffInMonths($tanggal_lahir);
                                        $umur = $tahun . ' tahun ' . $bulan . ' bulan';
                                    }
                                @endphp
                                <input class="form-control" type="text" name="umur" value="{{ $umur }}"
                                    id="html5-date-input" readonly />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="no_rm" class="col-md-3 col-form-label">No Rekam Medis</label>
                            <div class="col-md-9">
                                <input class="form-control" type="text"
                                    value="{{ implode('-', str_split(str_pad($item->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}"
                                    id="no_rm" disabled />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="html5-date-input" class="col-md-3 col-form-label">Diagnosa</label>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="diagnosa"
                                    value="{{ $item->diagnosa ?? '' }}" id="html5-date-input" placeholder="Diagnosa" />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="html5-date-input" class="col-md-3 col-form-label">Terapi</label>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="terapi" value="{{ $item->terapi ?? '' }}"
                                    id="html5-date-input" placeholder="Terapi" />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="html5-date-input" class="col-md-3 col-form-label">Tanggal Surat Rujukan</label>
                            <div class="col-md-9">
                                <input class="form-control" type="date" name="tgl_surat_rujukan"
                                    value="{{ $item->tgl_surat_rujukan ?? '' }}" id="html5-date-input" required />
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <p class="h5">Alasan Belum Dapat Dikembalikan ke Fasilitas Perujuk:</p>
                            <div class="d-flex align-items-center mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="fasilitas_rujukan"
                                        value="Butuh Pengobatan Lanjut" id="pengobatanLanjut"
                                        {{ $item->fasilitas_rujukan == 'Butuh Pengobatan Lanjut' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="pengobatanLanjut">
                                        Butuh Pengobatan Lanjut
                                    </label>
                                </div>
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Alasan Lain:</label>
                                <input class="form-control" type="text" name="fasilitas_rujukan_lainnya"
                                    placeholder="Masukkan alasan lain" value="{{ $item->fasilitas_rujukan_lainnya ?? '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <p class="h5">Rencana tindak lanjut akan dilakukan pada kunjungan selanjutnya</p>
                            <div class="mb-2">
                                <div class="form-check">
                                    <input class="form-check-input single-select-checkbox" type="checkbox"
                                        name="tindak_lanjut" value="Evaluasi Terapi" id="evaluasiTerapi"
                                        {{ $item->tindak_lanjut == 'Evaluasi Terapi' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="evaluasiTerapi">
                                        Evaluasi Terapi
                                    </label>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div class="form-check">
                                    <input class="form-check-input single-select-checkbox" type="checkbox"
                                        name="tindak_lanjut" value="Kontrol Luka" id="kontrolLuka"
                                        {{ $item->tindak_lanjut == 'Kontrol Luka' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="kontrolLuka">
                                        Kontrol Luka
                                    </label>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div class="form-check">
                                    <input class="form-check-input single-select-checkbox" type="checkbox"
                                        name="tindak_lanjut" value="Obat Bulanan" id="obatBulanan"
                                        {{ $item->tindak_lanjut == 'Obat Bulanan' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="obatBulanan">
                                        Obat Bulanan
                                    </label>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div class="form-check">
                                    <input class="form-check-input single-select-checkbox" type="checkbox"
                                        name="tindak_lanjut" value="Melihatkan Hasil" id="melihatkanHasil"
                                        {{ $item->tindak_lanjut == 'Melihatkan Hasil' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="melihatkanHasil">
                                        Melihatkan Hasil
                                    </label>
                                </div>
                            </div>

                            <div class="mb-2">
                                <label class="form-label">Tindak Lanjut Lain:</label>
                                <input class="form-control" type="text" name="tindak_lanjut_lainnya"
                                    placeholder="Masukkan alasan lain" value="{{ $item->tindak_lanjut_lainnya ?? '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <p class="h5">Surat keterangan ini digunakan untuk 1 (Satu) kali kunjungan dengan diagnosa
                                diatas pada :</p>
                            <div class="mb-2">
                                <label class="form-label">Pada Tanggal : </label>
                                <input class="form-control" type="date" name="tgl_kunjungan"
                                    placeholder="Masukkan alasan lain" value="{{ $item->tgl_kunjungan ?? '' }}" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="text-end">
                        <button type="submit" class="btn btn-sm btn-dark">Update Data</button>
                    </div>
                </div>
            </div>
    </form>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const checkboxes = document.querySelectorAll('.single-select-checkbox');

            checkboxes.forEach((checkbox) => {
                checkbox.addEventListener('change', () => {
                    checkboxes.forEach((cb) => {
                        if (cb !== checkbox) {
                            cb.checked = false;
                        }
                    });
                });
            });
        });
    </script>
@endsection
