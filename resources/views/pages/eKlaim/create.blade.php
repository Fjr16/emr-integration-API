@extends('layouts.backend.main')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="d-flex flex-row justify-content-between">
                <div class="">
                    <h5 class="card-title">E-Klaim</h5>
                </div>
                <div class="">
                    <a href="#" class="btn btn-sm btn-success">Klaim Baru</a>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col col-12">
                    <table class="table">
                        <tr>
                            <td>Tanggal Masuk</td>
                            <td>Tanggal Pulang</td>
                            <td>Jaminan</td>
                            <td>No. SEP</td>
                            <td>Tipe</td>
                            <td>CBG</td>
                            <td>Status</td>
                            <td>Petugas</td>
                        </tr>
                        <tr>
                            <td>15 Mei 2024</td>
                            <td class="border-start">15 Mei 2024</td>
                            <td class="border-start">JKN</td>
                            <td class="border-start"></td>
                            <td class="border-start">RJ</td>
                            <td class="border-start"></td>
                            <td class="border-start"></td>
                            <td>INACBG</td>
                        </tr>
                    </table>
                </div>

                <div class="col col-12 mt-5">
                    <div class="row">
                        <div class="col col-3">
                            <label for="jaminan">Jaminan / Cara Bayar</label>
                            <select name="jaminan" class="form-select" id="jaminan">
                                <option value="" disabled selected hidden>Pilih Menu...</option>
                                <option value="1">JKN</option>
                                <option value="2">JAMINAN COVID-19</option>
                                <option value="3">JAMINAN KIPI</option>
                                <option value="3">JAMINAN BAYI BARU LAHIR</option>
                                <option value="4">JAMINAN PERPANJANGAN MASA RAWAT</option>
                            </select>
                        </div>
                        <div class="col col-3">
                            <label for="noPeserta">No. Peserta</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col col-3">
                            <label for="noSEP">No. SEP</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col col-3">
                            <label for="cob">COB</label>
                            <select name="cob" class="form-select" id="cob">
                                <option value="" disabled selected hidden>Pilih Menu...</option>
                                <option value="1">MANDIRI INHEALTH</option>
                                <option value="2">ASURANSI SINAR MAS</option>
                                <option value="3">ASURANSI TUGU MANDIRI</option>
                                <option value="3">ASURANSI MITRA MAPARYA</option>
                                <option value="4">ASURANSI AXA MANDIRI FINANSIAL SERVICE</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col col-12 mt-3">
                    <table class="table table-bordered">
                        <tr>
                            <td class="table-active">Jenis Rawat</td>
                            <td>
                                <div class="d-flex flex-row">
                                    <div class="">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                id="jalan">
                                            <label class="form-check-label" for="jalan">
                                                Jalan
                                            </label>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                id="inap">
                                            <label class="form-check-label" for="inap">
                                                Inap
                                            </label>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Kelas Eksekutif
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-end">Kelas Hak</td>
                            <td style="min-width: 10rem"></td>
                        </tr>
                        <tr>
                            <td class="table-active">Tanggal Rawat</td>
                            <td>
                                <div class="d-flex flex-row">
                                    <div class="">
                                        Masuk: 15 Mei 2024 16:47
                                    </div>
                                    <div class="ms-5">
                                        Pulang: 15 Mei 2024 16:47
                                    </div>
                                </div>
                            </td>
                            <td class="text-end">Umur</td>
                            <td>0 hari</td>
                        </tr>
                        <tr>
                            <td class="table-active">Cara Masuk</td>
                            <td colspan="3">
                                <div class="" style="max-width: 40%">
                                    <select name="" class="form-select" id="">
                                        <option value="" disabled selected hidden>Pilih Menu...</option>
                                        <option value="1">Rujukan FKTP</option>
                                        <option value="2">Rujukan FKRTL</option>
                                        <option value="3">Rujukan Dokter Spesialis</option>
                                        <option value="3">Dari Rawat Jalan</option>
                                        <option value="4">Dari Rawat Inap</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-active">LOS</td>
                            <td>
                                <div class="d-flex flex-row justify-content-between">
                                    <span>1 hari</span>
                                    <span>(00:00 jam)</span>
                                </div>
                            </td>
                            <td class="text-end">Berat Lahir(gram)</td>
                            <td>
                                <div class="" style="max-width: 40%">
                                    <input type="number" class="form-control">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-active">ADL Score</td>
                            <td>
                                <div class="d-flex flex-row justify-content-between px-5">
                                    <span>Sub Acute: -</span>
                                    <span>Chronic: -</span>
                                </div>
                            </td>
                            <td class="text-end">Cara Pulang</td>
                            <td>
                                <div class="">
                                    <select name="" class="form-select" id="">
                                        <option value="" disabled selected hidden>Pilih Menu...</option>
                                        <option value="1">Atas Persetujuan Dokter</option>
                                        <option value="2">Dirujuk</option>
                                        <option value="3">Atas Permintaan Sendiri</option>
                                        <option value="3">Meninggal</option>
                                        <option value="4">Lain-lain</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-active">Pasien TB</td>
                            <td colspan="3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="TB">
                                    <label class="form-check-label" for="TB">
                                        Ya
                                    </label>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="col col-12 mt-5">
                    <p class="text-center">Tarif Rumah Sakit : Rp 0</p>
                    <table class="table table-bordered">
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col col-5 pt-2">
                                        Prosedur Non Bedah
                                    </div>
                                    <div class="col col-6">
                                        <input type="number" class="form-control" placeholder="0" name="nonBedah">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col col-5 pt-2">
                                        Prosedur Bedah
                                    </div>
                                    <div class="col col-6">
                                        <input type="number" class="form-control" placeholder="0" name="bedah">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col col-5 pt-2">
                                        Konsultasi
                                    </div>
                                    <div class="col col-6">
                                        <input type="number" class="form-control" placeholder="0" name="konsultasi">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col col-5">
                                        <p class="mt-2">Tenaga Ahli</p>
                                    </div>
                                    <div class="col col-6">
                                        <input type="number" class="form-control" placeholder="0" name="tenagaAhli">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col col-5 pt-2">
                                        Keperawatan
                                    </div>
                                    <div class="col col-6">
                                        <input type="number" class="form-control" placeholder="0" name="keperawatan">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col col-5 pt-2">
                                        Penunjang
                                    </div>
                                    <div class="col col-6">
                                        <input type="number" class="form-control" placeholder="0" class="penunjang">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col col-5 pt-2">
                                        Radiologi
                                    </div>
                                    <div class="col col-6">
                                        <input type="number" class="form-control" placeholder="0" name="radiologi">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col col-5 pt-2">
                                        Laboratorium
                                    </div>
                                    <div class="col col-6">
                                        <input type="number" class="form-control" placeholder="0" name="laboratorium">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col col-5 pt-2">
                                        Pelayanan Darah
                                    </div>
                                    <div class="col col-6">
                                        <input type="number" class="form-control" placeholder="0"
                                            name="pelayananDarah">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col col-5 pt-2">
                                        Rehabilitasi
                                    </div>
                                    <div class="col col-6">
                                        <input type="number" class="form-control" placeholder="0" name="rehabilitasi">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col col-5 pt-2">
                                        Kamar / Akomodasi
                                    </div>
                                    <div class="col col-6">
                                        <input type="number" class="form-control" placeholder="0" name="kamar">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col col-5 pt-2">
                                        Rawat Intensif
                                    </div>
                                    <div class="col col-6">
                                        <input type="number" class="form-control" placeholder="0" name="intensif">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col col-5 pt-2">
                                        Obat
                                    </div>
                                    <div class="col col-6">
                                        <input type="number" class="form-control" placeholder="0" name="obat">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col col-5 pt-2">
                                        Obat Kronis
                                    </div>
                                    <div class="col col-6">
                                        <input type="number" class="form-control" placeholder="0" name="obatKronis">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col col-5 pt-2">
                                        Obat Kemoterapi
                                    </div>
                                    <div class="col col-6">
                                        <input type="number" class="form-control" placeholder="0"
                                            name="obatKemoterapi">
                                    </div>
                                </div>
                                </< /tr>
                        </tr>
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col col-5 pt-2">
                                        Alkes
                                    </div>
                                    <div class="col col-6">
                                        <input type="number" class="form-control" placeholder="0" name="alkes">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col col-5 pt-2">
                                        BMHP
                                    </div>
                                    <div class="col col-6">
                                        <input type="number" class="form-control" placeholder="0" name="bmhp">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col col-5 pt-2">
                                        Sewa Alat
                                    </div>
                                    <div class="col col-6">
                                        <input type="number" class="form-control" placeholder="0" name="sewaAlat">
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="col col-12 mt-5">
                    <div class="card rounded-5 shadow">
                        <div class="card-body">
                            <div class="row">
                                <div class="col col-12">
                                    <div class="d-flex flex-row justify-content-between">
                                        <div class="">
                                            Diagnosa (ICD-10)
                                        </div>
                                        <div class="">
                                            <input type="search" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col col-12 mt-3">
                                    <div class="d-flex flex-row justify-content-between">
                                        <div class="">
                                            Diagnosa (ICD-9-CM)
                                        </div>
                                        <div class="">
                                            <input type="search" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col col-12 mt-5">
                    <p class="text-center">Data Klinis</p>
                    <hr>
                    <div class="d-flex flex-row justify-content-center">
                        <div class="row text-center d-flex justify-content-center">
                            <div class="col col-12">
                                <p>Tekanan Darah (mmHg)</p>
                            </div>
                            <div class="col col-3">
                                <input type="number" class="form-control">
                                <p>Sistole</p>
                            </div>
                            <div class="col col-3">
                                <input type="number" class="form-control">
                                <p>Diastole</p>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>

                <div class="col col-12 mt-3">
                    <p class="text-center">APGAR Score</p>
                    <div class="d-flex justify-content-center">
                        <table class="text-center" style="max-width: 40rem">
                            <tr>
                                <td style="min-width: 70px">
                                    1 Menit
                                </td>
                                <td><input type="text" class="form-control"></td>
                                <td><input type="text" class="form-control"></td>
                                <td><input type="text" class="form-control"></td>
                                <td><input type="text" class="form-control"></td>
                                <td><input type="text" class="form-control"></td>
                            </tr>
                            <tr>
                                <td style="min-width: 70px">
                                    5 Menit
                                </td>
                                <td><input type="text" class="form-control"></td>
                                <td><input type="text" class="form-control"></td>
                                <td><input type="text" class="form-control"></td>
                                <td><input type="text" class="form-control"></td>
                                <td><input type="text" class="form-control"></td>
                            </tr>
                            <tr>
                                <td style="min-width: 70px"></td>
                                <td>appear</td>
                                <td>pulse</td>
                                <td>grimace</td>
                                <td>activity</td>
                                <td>resp</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="col col-12 mt-3">
                    <div class="d-flex flex-row justify-content-between py-3">
                        <div class="">
                            <a href="#" class="btn btn-sm btn-danger ms-2">Hapus Klaim</a>
                        </div>
                        <div class="d-flex flex-row">
                            <a href="#" class="btn btn-sm btn-success">Simpan</a>
                            <a href="#" class="btn btn-sm btn-primary ms-2">Grouper</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Function to calculate total from the input fields
        function calculateTotal() {
            let total = 0;
            const inputs = document.querySelectorAll('input[type="number"]');

            inputs.forEach(input => {
                const value = parseFloat(input.value) || 0;
                total += value;
            });

            document.querySelector('.text-center').textContent = 'Tarif Rumah Sakit : Rp ' + total.toLocaleString('id-ID');
        }

        // Add event listeners to all input fields to trigger calculation on input change
        document.querySelectorAll('input[type="number"]').forEach(input => {
            input.addEventListener('input', calculateTotal);
        });

        // Initial calculation to set the total on page load
        calculateTotal();
    </script>
@endsection
