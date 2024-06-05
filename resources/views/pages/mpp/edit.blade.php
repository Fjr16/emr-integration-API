@extends('layouts.backend.main')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content; left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="card p-3 mt-5 ">
        <form action="{{ route('evaluasi/awal/MPP.update', $item->id) }}" method="POST"
            onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
            @csrf
            @method('PUT')
            <div class="card-body">
                <h3 class="py-2 bg-dark text-center text-white">FORMULIR A : EVALUASI AWAL
                    MANAGER PELAYANAN PASIEN (MPP)</h3>
                <div class="row">
                    <div class="col-4">
                        <div class="row">
                            <div class="col-4">Tanggal Masuk</div>
                            <div class="col-6"> <input class="form-control form-control-sm" name="tanggal_masuk"
                                    type="date" value="{{ $item->tanggal_masuk }}" readonly /></div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="row">
                            <div class="col-4">Ruangan</div>
                            <div class="col-6">
                                <select name="room_detail_id" id="room_detail_id"
                                    class="form-select form-control form-control-sm select2" disabled>
                                    <option selected disabled>Pilih</option>
                                    @foreach ($roomDetails as $room)
                                        <option value="{{ $room->id }}"
                                            {{ $room->id == $item->room_detail_id ? 'selected' : '' }}>{{ $room->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="row">
                            <div class="col-4">Tindakan</div>
                            <div class="col-6">
                                <input class="form-control form-control-sm" type="text" name="tindakan"
                                    value="{{ $item->tindakan ?? '' }}" rea />
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row mt-2">
                    <div class="col-4">
                        <div class="row">
                            <div class="col-4">Tanggal Keluar</div>
                            <div class="col-6">
                                <input class="form-control form-control-sm" name="tanggal_keluar" type="date"
                                    value="{{ $item->tanggal_keluar ?? '' }}" readonly />
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="row">
                            <div class="col-4">Kelas Rawatan</div>
                            <div class="col-6">
                                <input class="form-control form-control-sm" type="text" name="kelas_rawatan"
                                    value="{{ $item->kelas_rawatan ?? '' }}" readonly />
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="row">
                            <div class="col-4">Diagnosa</div>
                            <div class="col-6">
                                <input class="form-control form-control-sm" type="text" name="diagnosa"
                                    value="{{ $item->primer ?? '' }}" readonly />
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered mt-3">
                    <tr class="text-center">
                        <td class="w-25">
                            Tanggal / Jam
                        </td>
                        <td><input class="form-control form-control-sm" name="tanggal_masuk" type="datetime-local"
                                value="{{ \Carbon\Carbon::parse($item->tanggal_masuk)->format('Y-m-d') }}T00:00"
                                readonly />
                        </td>
                        <td colspan="8">Catatan
                        </td>
                    </tr>
                    <tr class="text-center">
                        <td colspan="9">Identifikasi /Skrining Pasien Kategori Mayor</td>
                    </tr>

                    <tr>
                        <td rowspan="19">Bila skor
                            ditemukan
                            1 pada kriteria
                            mayor dan total
                            skor ≥15 pada
                            kriteria minor
                            Maka dilakukan
                            asesmen
                            Management
                            Pelayanan
                            Pasien
                        </td>

                        <td class="text-center" style="width: 50px">NO</td>
                        <td class="text-center">Kriteria Penilaian</td>
                        <td class="text-center">Nilai Acuan</td>
                        <td class="text-center">Skor</td>
                    </tr>

                    @foreach ($arrKategoriMajor as $major)
                        @php
                            $detailMajor = App\Models\RanapMppSkriningPatient::where('ranap_mpp_patient_id', $item->id)
                                ->where('kategori', 'MAJOR')
                                ->where('kriteria', $major['kriteria'])
                                ->first();
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $major['kriteria'] }}</td>
                            <td class="text-center">{{ $major['acuan'] }}</td>
                            <td>
                                <select name="major_skor[]" id="major_skor" class="form-select form-select-sm form-control"
                                    disabled>
                                    <option value="0"{{ $detailMajor->skor == 0 ? 'selected' : '' }}>
                                        0</option>
                                    <option value="1" {{ $detailMajor->skor == 1 ? 'selected' : '' }}>
                                        1</option>
                                </select>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3" class="text-center">TOTAL SKOR</td>
                        <td><input type="number" name="total_skor_major" value="0"
                                class="form-control form-control-sm text-center" readonly></td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-center">Identifikasi /Skrining Pasien Kategori Minor</td>
                    </tr>
                    <tr class="text-center">
                        <td>NO</td>
                        <td>Kriteria Penilaian</td>
                        <td>Nilai Acuan</td>
                        <td>Skor</td>
                    </tr>
                    @foreach ($arrKategoriMinor as $minor)
                        @php
                            $detailMinor = App\Models\RanapMppSkriningPatient::where('ranap_mpp_patient_id', $item->id)
                                ->where('kategori', 'MINOR')
                                ->where('kriteria', $minor['kriteria'])
                                ->first();
                        @endphp
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-start">{{ $minor['kriteria'] }}</td>
                            <td>{{ $minor['acuan'] }}</td>
                            <td>
                                <select name="minor_skor[]" id="minor_skor" class="form-select form-select-sm form-control"
                                    disabled>
                                    <option value="0"{{ $detailMinor->skor == 0 ? 'selected' : '' }}>0</option>
                                    <option value="1"{{ $detailMinor->skor == 1 ? 'selected' : '' }}>1</option>
                                    <option value="2"{{ $detailMinor->skor == 2 ? 'selected' : '' }}>2</option>
                                    <option value="3"{{ $detailMinor->skor == 3 ? 'selected' : '' }}>3</option>
                                </select>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3" class="text-center">TOTAL SKOR</td>
                        <td><input type="number" name="total_skor_minor" value="0"
                                class="form-control form-control-sm text-center" readonly></td>
                    </tr>
                </table>

                <h3 class="py-2 bg-dark text-center text-white">ASESMEN UNTUK MANAGER PELAYANAN PASIEN</h3>
                {{-- <div class="row mb-4 px-3">
                    @foreach ($arrAssManager as $key => $assManager)
                        <div class="col-sm-6 border">
                            <div class="row">
                                <div class="col-12">{{ $assManager }}
        </div>
        @foreach ($arrAssManagerPilihan as $index => $assManagerPilihans)
        @if ($index == $key)
        @foreach ($assManagerPilihans as $itemAss)
        <div class="col-6">
            <div class="form-check form-check-inline mt-3 ">
                <input class="form-check-input" name="manager_value[{{ $key }}][]" type="radio" id="{{ $itemAss }}" value="{{ $itemAss }}" />
                <label class="form-check-label" for="{{ $itemAss }}">{{ $itemAss }}</label>
            </div>
        </div>
        @endforeach
        @endif
        @endforeach

</div>
</div>
@endforeach
</div> --}}
                <table class="table table-bordered " style="margin-top: -4mm">
                    <tr>
                        <td class="p-1">
                            <div class="row">
                                <div class="col-12">Fisik, Fungsional, Kognitif, Kemandirian</div>
                                <div class="col-6">
                                    <div class="form-check form-check-inline mt-3 ">
                                        <input class="form-check-input" name="fisik_kognitif" value="Tidak sadar"
                                            type="radio" id="tidakSadar" disabled />
                                        <label class="form-check-label" for="tidakSadar">Tidak Sadar</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check form-check-inline mt-3 ">
                                        <input class="form-check-input" name="fisik_kognitif" value="Ada gangguan fisik"
                                            type="radio" id="ada_gangguan_fisik" disabled />
                                        <label class="form-check-label" for="ada_gangguan_fisik">Ada gangguan
                                            fisik</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check form-check-inline mt-3 ">
                                        <input class="form-check-input" name="fisik_kognitif" value="Dibantu sebagian"
                                            type="radio" id="dibantu_sebagian" disabled />
                                        <label class="form-check-label" for="dibantu_sebagian">Dibantu sebagian</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check form-check-inline mt-3 ">
                                        <input class="form-check-input" name="fisik_kognitif" value="Dibantu penuh"
                                            type="radio" id="dibantu_penuh" disabled />
                                        <label class="form-check-label" for="dibantu_penuh">Dibantu penuh</label>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="p-1">
                            <div class="row">
                                <div class="col-12">Pemahaman Tentang Kesehatan</div>
                                <div class="col-6">
                                    <div class="form-check form-check-inline mt-3 ">
                                        <input class="form-check-input" name="pemahaman_kesehatan" value="Paham & patuh"
                                            type="radio" id="paham_patuh" disabled />
                                        <label class="form-check-label" for="paham_patuh">Paham & patuh
                                        </label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check form-check-inline mt-3 ">
                                        <input class="form-check-input" name="pemahaman_kesehatan"
                                            value="Paham & tidak patuh" type="radio" id="paham_tidak_patuh" disabled />
                                        <label class="form-check-label" for="paham_tidak_patuh">Paham & tidak
                                            patuh</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check form-check-inline mt-3 ">
                                        <input class="form-check-input" name="pemahaman_kesehatan" value="Tidak paham"
                                            type="radio" id="tidak_paham" disabled />
                                        <label class="form-check-label" for="tidak_paham">Tidak paham</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check form-check-inline mt-3 ">
                                        <input class="form-check-input" name="pemahaman_kesehatan" value="Tidak patuh"
                                            type="radio" id="tidak_patuh" disabled />
                                        <label class="form-check-label" for="tidak_patuh">Tidak patuh</label>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <div class="row">
                                <div class="col-12">Riwayat Kesehatan</div>
                                <div class="col-6">
                                    <div class="form-check form-check-inline mt-3 ">
                                        <input class="form-check-input" name="riwayat_kesehatan" value="Sering masuk RS"
                                            type="radio" id="seringMasukRS" disabled />
                                        <label class="form-check-label" for="seringMasukRS">Sering masuk RS</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check form-check-inline mt-3 ">
                                        <input class="form-check-input" name="riwayat_kesehatan" value="Penyakit kronis"
                                            type="radio" id="Penyakit_kronis" disabled />
                                        <label class="form-check-label" for="Penyakit_kronis">Penyakit kronis</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check form-check-inline mt-3 d-flex">
                                        <input class="form-check-input" value="Riwayat" type="radio"
                                            id="radio_riwayat_kes" style="min-width: 20px;" disabled />
                                        <label class=" form-check-label ms-3 me-5" for="radio_riwayat_kes">Riwayat</label>
                                        <input type="text" id="input_riwayat_kes" class="form-control form-control-sm"
                                            @disabled(true)>
                                        <input type="hidden" name="riwayat_kesehatan" id="input_riwayat_kes_hidden"
                                            disabled>
                                    </div>
                                </div>

                            </div>
                        </td>
                        <td class="p-1">
                            <div class="row">
                                <div class="col-12">Riwayat Penggunaan Obat (Alternatif/NAPZA)</div>
                                <div class="col-6">
                                    <div class="form-check form-check-inline mt-3 ">
                                        <input class="form-check-input" name="riwayat_penggunaan_obat" value="Tidak"
                                            type="radio" id="napzaTidak" disabled />
                                        <label class="form-check-label" for="napzaTidak">Tidak
                                        </label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check form-check-inline mt-3 d-flex ">
                                        <input class="form-check-input" value="Ya, jenis" type="radio"
                                            style="max-width: 30px" id="jenis_obat_radio" disabled />
                                        <label class="form-check-label mx-2" for="jenis_obat_radio">Ya, jenis</label>
                                        <input type="text" id="jenis_obat_input" class="form-control form-control-sm"
                                            @disabled(true)>
                                        <input type="hidden" name="riwayat_penggunaan_obat" id="jenis_obat_input_hidden"
                                            @disabled(true)>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <div class="row">
                                <div class="col-12">Perilaku Psiko - Spiritual - Sosio - Kultural</div>
                                <div class="col-3">
                                    <div class="form-check form-check-inline mt-3 ">
                                        <input class="form-check-input" name="perilaku" value="Tenang" type="radio"
                                            id="Tenang" disabled />
                                        <label class="form-check-label" for="Tenang">Tenang</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-check form-check-inline mt-3 ">
                                        <input class="form-check-input" name="perilaku" value="Cemas" type="radio"
                                            id="Cemas" disabled />
                                        <label class="form-check-label" for="Cemas">Cemas</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-check form-check-inline mt-3 d-flex">
                                        <input class=" form-check-input" name="perilaku" value="Depresi" type="radio"
                                            id="Depresi" style="min-width: 20px;" disabled />
                                        <label class=" form-check-label ms-3 me-5" for="Depresi">Depresi</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-check form-check-inline mt-3 d-flex">
                                        <input class=" form-check-input" name="perilaku" value="Marah" type="radio"
                                            id="Marah" style="min-width: 20px;" disabled />
                                        <label class=" form-check-label ms-3 me-5" for="Marah">Marah</label>
                                    </div>
                                </div>


                                <div class="col-7  mt-1">
                                    <div class="form-check form-check-inline  d-flex">
                                        <input class="form-check-input" value="Keyakinan tertentu terhadap makanan/obat"
                                            type="radio" id="keyakinan_obat_radio" style="min-width: 20px;" disabled />
                                        <label class=" form-check-label ms-3 me-5" for="keyakinan_obat_radio">Keyakinan
                                            tertentu
                                            terhadap makanan/obat</label>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <input type="text" id="keyakinan_obat_input" class="form-control form-control-sm"
                                        @disabled(true)>
                                    <input type="hidden" name="perilaku" id="keyakinan_obat_input_hidden"
                                        @disabled(true)>
                                </div>

                            </div>
                        </td>
                        <td class="p-1">
                            <div class="row">
                                <div class="col-12">Finansial / Sumber Keuangan
                                </div>
                                <div class="col-3">
                                    <div class="form-check form-check-inline mt-3 ">
                                        <input class="form-check-input" name="pekerjaan" type="radio" id="ASN"
                                            value="ASN" disabled />
                                        <label class="form-check-label" for="ASN">ASN </label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-check form-check-inline mt-3 ">
                                        <input class="form-check-input" name="pekerjaan" type="radio" id="Buruh"
                                            value="Buruh" disabled />
                                        <label class="form-check-label" for="Buruh">Buruh</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-check form-check-inline mt-3 ">
                                        <input class="form-check-input" name="pekerjaan" type="radio" id="Swasta"
                                            value="Swasta" disabled />
                                        <label class="form-check-label" for="Swasta">Swasta</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-check form-check-inline mt-3 ">
                                        <input class="form-check-input" name="pekerjaan" type="radio" id="Wiraswasta"
                                            value="Wiraswasta" disabled />
                                        <label class="form-check-label" for="Wiraswasta">Wiraswasta</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-check form-check-inline mt-3 ">
                                        <input class="form-check-input" name="pekerjaan" type="radio" id="Pensiunan"
                                            value="Pensiunan" disabled />
                                        <label class="form-check-label" for="Pensiunan">Pensiunan</label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-check form-check-inline mt-3 ">
                                        <input class="form-check-input" name="pekerjaan" type="radio"
                                            id="Tidak_bekerja" value="Tidak bekerja" disabled />
                                        <label class="form-check-label" for="Tidak_bekerja">Tidak Bekerja</label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-check form-check-inline mt-3 ">
                                        <input class="form-check-input" name="pekerjaan" type="radio"
                                            id="radio_pekerjaan" disabled />
                                        <input type="text" id="input_pekerjaan" class="form-control form-control-sm"
                                            @disabled(true)>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <div class="row">
                                <div class="col-12">Kesehatan Mental & Kognitif</div>
                                <div class="col-6">
                                    <div class="form-check form-check-inline mt-3 ">
                                        <input class="form-check-input" name="kesehatan_mental" type="radio"
                                            id="no_paham_merawat" value="Tidak paham cara merawat" disabled />
                                        <label class="form-check-label" for="no_paham_merawat">Tidak paham cara
                                            merawat</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check form-check-inline mt-3 ">
                                        <input class="form-check-input" name="kesehatan_mental" type="radio"
                                            id="Gangguan_mental" value="Gangguan mental" disabled />
                                        <label class="form-check-label" for="Gangguan_mental">Gangguan mental</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check form-check-inline mt-3 ">
                                        <input class="form-check-input" name="kesehatan_mental" type="radio"
                                            id="Tidak_paham_pengobatan_lanjut" value="Tidak paham pengobatan lanjut"
                                            disabled />
                                        <label class="form-check-label" for="Tidak_paham_pengobatan_lanjut">Tidak paham
                                            pengobatan lanjut</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check form-check-inline mt-3 ">
                                        <input class="form-check-input" name="kesehatan_mental" type="radio"
                                            id="Gagal_pengobatan" value="Gagal pengobatan" disabled />
                                        <label class="form-check-label" for="Gagal_pengobatan">Gagal pengobatan</label>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="p-1">
                            <div class="row">
                                <div class="col-12">Kemampuan Menerima Perubahan </div>
                                <div class="col-12">
                                    <div class="form-check form-check-inline mt-3 ">
                                        <input class="form-check-input" name="adaptasi" type="radio"
                                            id="Mampu_beradaptasi" value="Mampu beradaptasi" disabled />
                                        <label class="form-check-label" for="Mampu_beradaptasi">Mampu beradaptasi</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check form-check-inline mt-3 ">
                                        <input class="form-check-input" name="adaptasi" type="radio"
                                            id="Tidak_mampu_beradaptasi" value="Tidak mampu beradaptasi" disabled />
                                        <label class="form-check-label" for="Tidak_mampu_beradaptasi">Tidak mampu
                                            beradaptasi
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <div class="row">
                                <div class="col-12">Tersedia dukungan keluarga / kemampuan merawat</div>
                                <div class="col-6">
                                    <div class="form-check form-check-inline mt-3 ">
                                        <input class="form-check-input" name="dukungan_keluarga" type="radio"
                                            id="Handal" value="Handal" disabled />
                                        <label class="form-check-label" for="Handal">Handal</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check form-check-inline mt-3 ">
                                        <input class="form-check-input" name="dukungan_keluarga" type="radio"
                                            id="Dipertanyakan" value="Dipertanyakan" disabled />
                                        <label class="form-check-label" for="Dipertanyakan">Dipertanyakan</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check form-check-inline mt-3 ">
                                        <input class="form-check-input" name="dukungan_keluarga" type="radio"
                                            id="Krisis" value="Krisis" disabled />
                                        <label class="form-check-label" for="Krisis">Krisis</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check form-check-inline mt-3 ">
                                        <input class="form-check-input" name="dukungan_keluarga" type="radio"
                                            id="Tidak_ada_dukungan" value="Tidak ada" disabled />
                                        <label class="form-check-label" for="Tidak_ada_dukungan">Tidak ada</label>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="p-1">
                            <div class="row">
                                <div class="col-12">Asuransi / Penjamin </div>
                                <div class="col-4">
                                    <div class="form-check form-check-inline mt-3 ">
                                        <input class="form-check-input" name="asuransi" type="radio" id="ada_aktif"
                                            value="Ada, aktif" disabled />
                                        <label class="form-check-label" for="ada_aktif">Ada, aktif </label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-check form-check-inline mt-3 ">
                                        <input class="form-check-input" name="asuransi" type="radio"
                                            id="ada_tidak_aktif" value="Ada, tidak aktif" disabled />
                                        <label class="form-check-label" for="ada_tidak_aktif"> Ada, tidak aktif</label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-check form-check-inline mt-3 ">
                                        <input class="form-check-input" name="asuransi" type="radio" id="Tidak ada"
                                            value="Tidak ada" disabled />
                                        <label class="form-check-label" for="Tidak ada"> Tidak ada</label>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <div class="row">
                                <div class="col-12">Lingkungan & tempat tinggal</div>
                                <div class="col-4">
                                    <div class="form-check form-check-inline mt-3 ">
                                        <input class="form-check-input" name="lingkungan" type="radio"
                                            id="tidak_lingkungan" value="Sanitasi Buruk" disabled />
                                        <label class="form-check-label" for="tidak_lingkungan">Sanitasi Buruk</label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-check form-check-inline mt-3 ">
                                        <input class="form-check-input" name="lingkungan" type="radio"
                                            id="Jauh_faskes" value="Jauh dari faskes" disabled />
                                        <label class="form-check-label" for="Jauh_faskes">Jauh dari faskes</label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-check form-check-inline mt-3 ">
                                        <input class="form-check-input" name="lingkungan" type="radio"
                                            id="radio_lingkungan" disabled />
                                        <input type="text" id="input_lingkungan" class="form-control form-control-sm"
                                            disabled>
                                    </div>
                                </div>


                            </div>
                        </td>
                        <td class="p-1">
                            <div class="row">
                                <div class="col-12">Perencanaan Lanjutan </div>
                                <div class="col-6">
                                    <div class="form-check form-check-inline mt-3 ">
                                        <input class="form-check-input" name="perencanaan_lanjutan" type="radio"
                                            id="Discharge_Planning" value="Discharge Planning" disabled />
                                        <label class="form-check-label" for="Discharge_Planning">Discharge
                                            Planning</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check form-check-inline mt-3 ">
                                        <input class="form-check-input" name="perencanaan_lanjutan" type="radio"
                                            id="Kontrol" value="Kontrol" disabled />
                                        <label class="form-check-label" for="Kontrol"> Kontrol</label>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <div class="row">
                                <div class="col-12">Riwayat Trauma / Kekerasan</div>
                                <div class="col-3">
                                    <div class="form-check form-check-inline mt-3 ">
                                        <input class="form-check-input" name="riwayat_trauma" type="radio"
                                            id="tidak_trauma" value="Tidak" disabled />
                                        <label class="form-check-label" for="tidak_trauma">Tidak</label>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="form-check form-check-inline mt-3 d-flex align-items-center">
                                        <input class="form-check-input" type="radio" id="trauma_radio"
                                            value="iya,jenis" style="max-width: 30px ; aspect-ratio:1/1" disabled />
                                        <label class="form-check-label mx-3" for="trauma_radio">iya,jenis</label>
                                        <input type="text" id="trauma_input" class="form-control form-control-sm"
                                            @disabled(true)>
                                        <input type="hidden" name="riwayat_trauma" id="trauma_input_hidden"
                                            @disabled(true)>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="p-1">
                            <div class="row">
                                <div class="col-12">Aspek legal </div>
                                <div class="col-4">
                                    <div class="form-check form-check-inline mt-3 ">
                                        <input class="form-check-input" name="aspek_legal" type="radio"
                                            id="no_aspek_legal" value="Tidak ada" disabled />
                                        <label class="form-check-label" for="no_aspek_legal">Tidak ada</label>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="form-check form-check-inline mt-3 d-flex ">
                                        <input class="form-check-input" type="radio" style="max-width: 30px"
                                            id="aspek_legal_radio" value="ada," disabled />
                                        <label class="form-check-label mx-2" for="aspek_legal_radio">ada,</label>
                                        <input type="text" id="aspek_legal_input" class="form-control form-control-sm"
                                            @disabled(true)>
                                        <input type="hidden" name="aspek_legal" id="aspek_legal_input_hidden"
                                            @disabled(true)>
                                    </div>
                                </div>

                            </div>
                        </td>
                    </tr>
                </table>

                <h3 class="py-2 bg-dark text-center text-white">IDENTIFIKASI MASALAH - RISIKO - KESEMPATAN </h3>
                <div class="row mb-4 px-3">
                    @foreach ($arrProbRiskChance as $key => $chanceName)
                        <div class="col-sm-6 border">
                            <div class="row mb-2">
                                <div class="col-12">{{ $chanceName }}</div>
                                @foreach ($arrProbRiskChancePilihan as $indexPilihan => $pilihans)
                                    @if ($indexPilihan == $key)
                                        @foreach ($pilihans as $itemPilihan)
                                            @php
                                                if (count($pilihans) == 3) {
                                                    $col = 4;
                                                } elseif (count($pilihans) == 2) {
                                                    $col = 6;
                                                } else {
                                                    $col = 12;
                                                }
                                            @endphp
                                            <div class="col-{{ $col }}">
                                                <div class="form-check form-check-inline mt-3">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="{{ $itemPilihan }}" name="value[{{ $key }}][]"
                                                        value="{{ $itemPilihan }}" disabled />
                                                    <label class="form-check-label"
                                                        for="{{ $itemPilihan }}">{{ $itemPilihan }}</label>
                                                </div>
                                                @if ($itemPilihan == 'Menolak rencana asuhan')
                                                    <input type="text" class="form-control form-control-sm"
                                                        name="keterangan_rencana_asuhan" id="keterangan_rencana_asuhan">
                                                @endif
                                            </div>
                                        @endforeach
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                <h3 class="py-2 bg-dark text-center text-white">PERENCANAAN MANAGER PELAYANAN PASIEN </h3>
                <table class="table table-bordered " style="margin-top: -5mm">
                    <tr>
                        <td>
                            <textarea class="form-control form-control-sm" id="##editor" readonly name="ket_manager_plan" rows="3"></textarea>
                        </td>
                    </tr>
                </table>
                <h3 class="py-2 bg-dark text-center text-white">FORMULIR B : KELANJUTAN PELAYANAN PASIEN </h3>
                <table class="table table-bordered " style="margin-top: -5mm">
                    <thead>
                        <tr class="text-center">
                            <th class="text-dark">Tanggal / Jam</th>
                            <th class="text-dark">Kelanjutan Pelayanan Pasien</th>
                            <th class="text-dark">Tambah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kelanjutanPelayanan as $pelayanan)
                            <tr>
                                <td class="col-4">
                                    <input class="form-control form-control-sm" name="tanggal[]" id="tanggal"
                                        type="datetime-local" value="{{ $pelayanan->tanggal }}" />
                                </td>
                                <td class="col-7">
                                    <textarea class="form-control form-control-sm" id="editor3" name="kelanjutan_keterangan[]" rows="3">
                                        {{ $pelayanan->keterangan }}
                                    </textarea>
                                </td>
                                <td class="text-center col-1">
                                    <button type="button" class="btn btn-sm btn-danger"
                                        onclick="removeInputMPP(this)"><i class="bx bx-minus"></i></button>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td class="col-4">
                                <input class="form-control form-control-sm" name="tanggal[]" id="tanggal"
                                    type="datetime-local" value="{{ \Carbon\Carbon::now()->toDateTimeString() }}" />
                            </td>
                            <td class="col-7">
                                <textarea class="form-control form-control-sm" id="editor3" name="kelanjutan_keterangan[]" rows="3"></textarea>
                            </td>
                            <td class="text-center col-1">
                                <button type="button" class="btn btn-sm btn-dark" onclick="tambahInput(this)"><i
                                        class="bx bx-plus"></i></button>
                            </td>
                        </tr>

                    </tbody>
                </table>

                <div class="my-5 mx-5">
                    <div class="row mb-5 mt-5">
                        <div class="col-6 text-center">
                            Petugas
                        </div>

                    </div>
                    <div class="row mb-5">

                        <div class="col-6 text-center">
                            <img src="" alt="" id="ImgTtdDietisien">
                            <textarea id="ttdDietisien" name="ttd_petugas" style="display: none;"></textarea>
                            <button type="button" class="col-12 btn btn-sm btn-dark"
                                onclick="openModal(this, 'ImgTtdDietisien', 'ttdDietisien', 'nama_petugas')">Tanda
                                Tangan</button>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-6 text-center">
                            <input type="text" class="form-control" name="nama_petugas" id="nama_petugas"
                                placeholder="Nama Dietisien" @readonly(true)>
                        </div>
                    </div>

                </div>
                <div class="mb-3 mt-5  text-end">
                    <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                </div>
            </div>
        </form>
    </div>


    {{-- modal create ttd --}}
    <div class="modal fade" id="signaturePadModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalScrollableTitle">Signature Pad</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div id="signature-pad" class="m-signature-pad">
                        <div class="m-signature-pad--body">
                            <canvas style="border: 3px dashed #ccc"></canvas>
                        </div>

                        <div class="m-signature-pad--footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-action="clear">Clear</button>
                            <button type="button" class="btn btn-sm btn-primary" data-action="save">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal get ttd --}}
    <div class="modal fade" id="getTtdModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalScrollableTitle">Masukkan Password Akun Anda</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div id="signature-pad" class="m-signature-pad">
                        <div class="m-signature-pad--body mb-3">
                            <input type="password" class="form-control form-control-sm" name="password_user">
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        </div>

                        <div class="m-signature-pad--footer">
                            <button type="button" class="btn btn-sm btn-secondary"
                                data-action="clearInput">Clear</button>
                            <button type="button" class="btn btn-sm btn-primary" data-action="saveInput">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- ttd js --}}

    <script>
        let tempElementImage;
        let tempTextArea;
        let tempPetugasName;

        function openModal(element, elementImg, elementTextArea, elementPetugasName) {
            tempElementImage = $(element).closest('.row').find('#' + elementImg);
            tempTextArea = $(element).closest('.row').find('#' + elementTextArea);
            tempPetugasName = $('#' + elementPetugasName);
            $('#getTtdModal').modal('show');
        }

        function openModalTtdBottom(element, elementImg, elementTextArea) {
            tempElementImage = $(element).closest('.row').find('#' + elementImg);
            tempTextArea = $(element).closest('.row').find('#' + elementTextArea);
            $('#signaturePadModal').modal('show');
        }

        // start create new ttd
        document.addEventListener("DOMContentLoaded", function() {
            var wrapper = document.getElementById("signaturePadModal");
            var clearButton = wrapper.querySelector("[data-action=clear]");
            var saveButton = wrapper.querySelector("[data-action=save]");
            var canvas = wrapper.querySelector("canvas");
            var signaturePad;

            // Initialize SignaturePad
            // agar library signature pad dapat digunakan pada modal
            signaturePad = new SignaturePad(canvas);

            // Event handler untuk tombol clear
            clearButton.addEventListener("click", function(e) {
                e.preventDefault();
                signaturePad.clear();
            });

            // Event handler untuk tombol save
            saveButton.addEventListener("click", function(e) {
                e.preventDefault();
                var signatureData = signaturePad.toDataURL();
                tempElementImage.attr('src', signatureData);
                tempTextArea.val(signatureData);
                signaturePad.clear();

                //close modal
                $('#signaturePadModal').modal('hide');
            });
            //  end create new ttd

            // start get ttd from user table
            var modal = document.getElementById("getTtdModal");
            var clearButtonInput = modal.querySelector("[data-action=clearInput]");
            var saveButtonInput = modal.querySelector("[data-action=saveInput]");
            var inputPass = modal.querySelector('input[name="password_user"]');
            var inputUserId = modal.querySelector('input[name="user_id"]');

            clearButtonInput.addEventListener('click', function(e) {
                e.preventDefault();
                signaturePad.clear();
            });

            saveButtonInput.addEventListener("click", function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'get',
                    url: "{{ route('evaluasi/awal/MPP.ttd') }}",
                    data: {
                        user_id: inputUserId.value,
                        password: inputPass.value,
                    },
                    success: function(data) {
                        var newSrc = `{{ Storage::url('${data}') }}`;
                        tempElementImage.attr('src', newSrc);
                        tempTextArea.val(data);
                        tempPetugasName.val(`{{ auth()->user()->name }}`);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log();
                        var errorResponse = jqXHR.responseJSON;
                        if (errorResponse && errorResponse.error) {
                            alert(errorResponse.error)
                        } else {
                            alert('Terjadi Kesalahan Dalam Pengambilan Data');
                        }
                    }
                });

                inputPass.value = '';

                $('#getTtdModal').modal('hide');
            });
        });
    </script>

    <script>
        let count = 4;

        function tambahInput(element) {
            // console.log(element);
            var tr = element.parentNode.parentNode.parentNode;

            var newTr = document.createElement('tr');
            newTr.innerHTML = `
                            <td class="col-4">
                                <input class="form-control form-control-sm" id="tanggal${count}" name="tanggal[]" type="datetime-local"
                                    value="{{ \Carbon\Carbon::now()->toDateTimeString() }}" />
                            </td>
                            <td class="col-7">
                                <textarea class="form-control form-control-sm" id="editor${count+1}" name="kelanjutan_keterangan[]" rows="3"></textarea>
                            </td>
                            <td class="text-center col-1">
                                <button type="button" class="btn btn-sm btn-danger" onclick="removeInputMPP(this)"><i class="bx bx-minus"></i></button>
                            </td>
            `;
            tr.appendChild(newTr);

            for (var i = count; i <= count + 2; i++) {
                ClassicEditor.create(document.querySelector('#editor' + i), {
                        toolbar: {
                            items: ['|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList'],
                        },
                        language: 'en',
                    })
                    .catch(function(error) {
                        console.error(error);
                    });
            }
            count = count + 2;
        }

        function removeInputMPP(element) {
            var tr = element.parentNode.parentNode;
            tr.remove();
        }
    </script>
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            // major kategori
            var selectMajors = document.querySelectorAll('select[name="major_skor[]"]');
            var totalSkorMajor = document.querySelector('input[name="total_skor_major"]');
            var totalMajor = 0;

            selectMajors.forEach(function(selectMajor) {
                var skor = parseInt(selectMajor.value) || 0;
                totalMajor += skor;
                selectMajor.addEventListener('change', function() {
                    totalMajor = 0;
                    selectMajors.forEach(function(selectMajor) {
                        var skor = parseInt(selectMajor.value) || 0;
                        totalMajor += skor;
                    });
                    totalSkorMajor.value = totalMajor;
                });
            });

            totalSkorMajor.value = totalMajor; // Set initial total

            // minor Kategori
            var selectMinors = document.querySelectorAll('select[name="minor_skor[]"]');
            var totalSkorMinor = document.querySelector('input[name="total_skor_minor"]');
            var totalMinor = 0;

            selectMinors.forEach(function(selectMinor) {
                var skor = parseInt(selectMinor.value) || 0;
                totalMinor += skor;
                selectMinor.addEventListener('change', function() {
                    totalMinor = 0;
                    selectMinors.forEach(function(selectMinor) {
                        var skor = parseInt(selectMinor.value) || 0;
                        totalMinor += skor;
                    });
                    totalSkorMinor.value = totalMinor;
                });
            });

            totalSkorMinor.value = totalMinor; // Set initial total
        });
    </script>

    <script type="text/javascript">
        // menangani input job
        var radioJobs = document.querySelectorAll('input[name="pekerjaan"]');
        var inputJob = document.getElementById('input_pekerjaan');
        var radioJobInput = document.getElementById('radio_pekerjaan');

        radioJobs.forEach(function(radioJob) {
            radioJob.addEventListener('click', function() {
                if (radioJob.id == 'radio_pekerjaan') {
                    inputJob.disabled = false;
                } else {
                    inputJob.disabled = true;
                    inputJob.value = '';
                    radioJobInput.value = '';
                }
            });
        });

        inputJob.addEventListener('change', function() {
            radioJobInput.value = inputJob.value;
        });

        // menangani input lingkungan
        var radioEnvs = document.querySelectorAll('input[name="lingkungan"]');
        var inputEnv = document.getElementById('input_lingkungan');
        var radioEnvInput = document.getElementById('radio_lingkungan');

        radioEnvs.forEach(function(radioEnv) {
            radioEnv.addEventListener('click', function() {
                if (radioEnv.id == 'radio_lingkungan') {
                    inputEnv.disabled = false;
                } else {
                    inputEnv.disabled = true;
                    inputEnv.value = '';
                    radioEnvInput.value = '';
                }
            });
        });

        inputEnv.addEventListener('change', function() {
            radioEnvInput.value = inputEnv.value;
        });


        // menangani input riwayat kesehatan
        var radioRiwayats = document.querySelectorAll('input[name="riwayat_kesehatan"]');
        var radioRiwayatInput = document.getElementById('radio_riwayat_kes');
        var inputRiwayat = document.getElementById('input_riwayat_kes');
        var inputRiwayatHidden = document.getElementById('input_riwayat_kes_hidden');

        radioRiwayats.forEach(function(radioRiwayat) {
            radioRiwayat.addEventListener('click', function() {
                inputRiwayat.disabled = true;
                radioRiwayatInput.checked = false;
                inputRiwayat.value = '';
                inputRiwayatHidden.value = '';
                inputRiwayatHidden.disabled = true;
            });
        });

        radioRiwayatInput.addEventListener('click', function() {
            radioRiwayats.forEach(function(radioRiwayat) {
                radioRiwayat.checked = false;
            });
            inputRiwayat.disabled = false;
        });

        inputRiwayat.addEventListener('change', function() {
            inputRiwayatHidden.value = '' + radioRiwayatInput.value + ' ' + inputRiwayat.value;
            inputRiwayatHidden.disabled = false;
        });

        // menangani input jenis obat
        var radioJenisObats = document.querySelectorAll('input[name="riwayat_penggunaan_obat"]');
        var radioJenisObatInput = document.getElementById('jenis_obat_radio');
        var inputJenisObat = document.getElementById('jenis_obat_input');
        var inputJenisObatHidden = document.getElementById('jenis_obat_input_hidden');

        radioJenisObats.forEach(function(radioJenisObat) {
            radioJenisObat.addEventListener('click', function() {
                inputJenisObat.disabled = true;
                radioJenisObatInput.checked = false;
                inputJenisObat.value = '';
                inputJenisObatHidden.value = '';
                inputJenisObatHidden.disabled = true;
            });
        });

        radioJenisObatInput.addEventListener('click', function() {
            radioJenisObats.forEach(function(radioJenisObat) {
                radioJenisObat.checked = false;
            });
            inputJenisObat.disabled = false;
        });

        inputJenisObat.addEventListener('change', function() {
            inputJenisObatHidden.disabled = false;
            inputJenisObatHidden.value = '' + radioJenisObatInput.value + ' ' + inputJenisObat.value;
        });

        // menangani input keyakinan obat
        var radioKeyakinanObats = document.querySelectorAll('input[name="perilaku"]');
        var radioKeyakinanObatInput = document.getElementById('keyakinan_obat_radio');
        var inputKeyakinanObat = document.getElementById('keyakinan_obat_input');
        var inputKeyakinanObatHidden = document.getElementById('keyakinan_obat_input_hidden');

        radioKeyakinanObats.forEach(function(radioKeyakinanObat) {
            radioKeyakinanObat.addEventListener('click', function() {
                inputKeyakinanObat.disabled = true;
                inputKeyakinanObat.value = '';
                radioKeyakinanObatInput.checked = false;
                inputKeyakinanObatHidden.value = '';
                inputKeyakinanObatHidden.disabled = true;
            });
        });

        radioKeyakinanObatInput.addEventListener('click', function() {
            radioKeyakinanObats.forEach(function(radioKeyakinanObat) {
                radioKeyakinanObat.checked = false;
            });
            inputKeyakinanObat.disabled = false;
        });

        inputKeyakinanObat.addEventListener('change', function() {
            inputKeyakinanObatHidden.disabled = false;
            inputKeyakinanObatHidden.value = '' + radioKeyakinanObatInput.value + ' ' + inputKeyakinanObat.value;
        });

        // menangani input riwayat trauma
        var radioTraumas = document.querySelectorAll('input[name="riwayat_trauma"]');
        var radioTraumaInput = document.getElementById('trauma_radio');
        var inputTrauma = document.getElementById('trauma_input');
        var inputTraumaHidden = document.getElementById('trauma_input_hidden');

        radioTraumas.forEach(function(radioTrauma) {
            radioTrauma.addEventListener('click', function() {
                inputTrauma.disabled = true;
                inputTrauma.value = '';
                radioTraumaInput.checked = false;
                inputTraumaHidden.value = '';
                inputTraumaHidden.disabled = true;
            });
        });

        radioTraumaInput.addEventListener('click', function() {
            radioTraumas.forEach(function(radioTrauma) {
                radioTrauma.checked = false;
            });
            inputTrauma.disabled = false;
        });

        inputTrauma.addEventListener('change', function() {
            inputTraumaHidden.disabled = false;
            inputTraumaHidden.value = '' + radioTraumaInput.value + ' ' + inputTrauma.value;
        });

        // menangani input aspek legal
        var radioAspekLegals = document.querySelectorAll('input[name="aspek_legal"]');
        var radioAspekLegalInput = document.getElementById('aspek_legal_radio');
        var inputAspekLegal = document.getElementById('aspek_legal_input');
        var inputAspekLegalHidden = document.getElementById('aspek_legal_input_hidden');

        radioAspekLegals.forEach(function(radioAspekLegal) {
            radioAspekLegal.addEventListener('click', function() {
                inputAspekLegal.disabled = true;
                inputAspekLegal.value = '';
                radioAspekLegalInput.checked = false;
                inputAspekLegalHidden.value = '';
                inputAspekLegalHidden.disabled = true;
            });
        });

        radioAspekLegalInput.addEventListener('click', function() {
            radioAspekLegals.forEach(function(radioAspekLegal) {
                radioAspekLegal.checked = false;
            });
            inputAspekLegal.disabled = false;
        });

        inputAspekLegal.addEventListener('change', function() {
            inputAspekLegalHidden.disabled = false;
            inputAspekLegalHidden.value = '' + radioAspekLegalInput.value + ' ' + inputAspekLegal.value;
        });
    </script>
@endsection


{{-- membuat input --}}
