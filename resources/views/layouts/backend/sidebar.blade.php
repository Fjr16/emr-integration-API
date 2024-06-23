<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="/" class="app-brand-link">
            <span class="app-brand-logo demo">
                {{-- <img src="{{ asset('/assets/img/logo.png') }}" alt=""> --}}
            </span>
            <span class="app-brand-text menu-text fw-bolder text-white fs-4 ms-2 mt-1">E Medical Record</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">

        {{-- Main --}}
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text text-white">Main</span>
        </li>
        <!-- Dashboard -->
        <li class="menu-item {{ $title === 'Dashboard' ? 'active' : '' }}">
            <a href="/" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>
        @hasanyrole(['Admin', 'Dokter Poli', 'Dokter Ranap', 'Dokter Jaga', 'Petugas Informasi', 'Rekam Medis Rajal',
            'Perawat Rajal', 'Apoteker', 'Kasir', 'DPJP Radiologi', 'DPJP Labor PK', 'DPJP Labor PA'])
            {{-- RME --}}
            <li class="menu-item {{ $title == 'RME' ? 'active' : '' }}">
                <a href="{{ route('rekam/medis/elektronik.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-notepad"></i>
                    <div>RME Pasien</div>
                </a>
            </li>
        @endhasanyrole
        {{-- end Main --}}


        {{-- Registrasi --}}
        @hasanyrole(['Admin', 'Petugas Informasi', 'Rekam Medis Rajal'])
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text text-white">Registrasi</span>
            </li>
            {{-- pasien --}}
            {{-- @canany('daftar pasien rumah sakit') --}}
            <li class="menu-item {{ $title == 'Pasien' ? 'active' : '' }}">
                <a href="{{ route('pasien.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-male"></i>
                    <div>Daftar Pasien</div>
                </a>
            </li>
            {{-- @endcanany --}}
            {{-- end pasien --}}

            {{-- Antrian --}}
            {{-- @canany(['daftar antrian', 'registrasi ulang antrian']) --}}
            <li class="menu-item {{ $menu == 'Antrian' ? 'open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-add-to-queue"></i>
                    <div>Antrian</div>
                </a>
                <ul class="menu-sub">
                    {{-- @can('tambah antrian') --}}
                    @hasanyrole(['Admin', 'Petugas Informasi'])
                        <li class="menu-item {{ $title == 'Entri Antrian' ? 'active' : '' }}">
                            <a href="{{ route('antrian.create') }}" class="menu-link">
                                <div>Antrian</div>
                            </a>
                        </li>
                        {{-- <li class="menu-item {{ $title == 'Entri Antrian Urologi' ? 'active' : '' }}">
                                    <a href="{{ route('antrian-urologi.create') }}" class="menu-link">
                                        <div>Antrian Urologi</div>
                                    </a>
                                </li> --}}
                    @endhasanyrole
                    {{-- @endcan --}}
                    {{-- @can('registrasi ulang antrian') --}}
                    @hasanyrole(['Admin', 'Rekam Medis Rajal'])
                        <li class="menu-item {{ $title == 'Daftar Antrian' ? 'active' : '' }}">
                            <a href="{{ route('antrian.index') }}" class="menu-link">
                                <div>Daftar Antrian (Registrasi Ulang)</div>
                            </a>
                        </li>
                    @endhasanyrole
                    {{-- @endcan --}}
                </ul>
            </li>
            {{-- @endcanany --}}
            {{-- end Antrian --}}
        @endhasanyrole
        {{-- end Registrasi --}}


        {{-- Rawatan --}}
        @hasanyrole([
            'Admin',
            'Dokter Poli',
            'Dokter Ranap',
            'Dokter Jaga',
            'DPJP Radiologi',
            'DPJP Labor PK',
            'DPJP
            Labor PA',
            'Rekam Medis Rajal',
            'Perawat Rajal',
            'Apoteker',
            'Kasir',
            ])
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text text-white">Rawatan</span>
            </li>

            @hasanyrole([
                'Admin',
                'DPJP Radiologi',
                'DPJP Labor PK',
                'DPJP Labor PA',
                'Dokter Poli',
                'Dokter Ranap',
                'Dokter
                Jaga',
                ])
            @endhasanyrole

            @hasanyrole(['Admin', 'Dokter Poli', 'Dokter Ranap', 'Dokter Jaga', 'Rekam Medis Rajal', 'Perawat Rajal',
                'Apoteker', 'Kasir', 'DPJP Radiologi', 'DPJP Labor PK', 'DPJP Labor PA'])
                {{-- Rawat Jalan --}}
                {{-- @canany(['daftar pasien poli', 'daftar pasien rekam medis', 'daftar pasien farmasi rajal', 'daftar pembayaran']) --}}
                <li class="menu-item {{ $menu == 'In Patient' ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-accessibility"></i>
                        <div>Rawat Jalan</div>
                    </a>

                    <ul class="menu-sub">
                        {{-- @can('daftar pasien poli') --}}
                        <li class="menu-item {{ $title == 'Rawat Jalan' ? 'active' : '' }}">
                            <a href="{{ route('rajal/index') }}" class="menu-link">
                                <div>Poli Rawat Jalan</div>
                            </a>
                        </li>
                        {{-- @endcan --}}
                        {{-- @can('daftar pasien rekam medis') --}}
                        <li class="menu-item {{ $title == 'Rekam Medis' ? 'active' : '' }}">
                            <a href="{{ route('rajal/rekammedis.index') }}" class="menu-link">
                                <div>Rekam Medis</div>
                            </a>
                        </li>
                        {{-- @endcan --}}
                        {{-- @can('daftar pasien farmasi rajal') --}}
                        <li class="menu-item {{ $title == 'Farmasi' ? 'active' : '' }}">
                            <a href="{{ route('rajal/farmasi/index') }}" class="menu-link">
                                <div>Farmasi Rawat Jalan</div>
                            </a>
                        </li>
                        {{-- @endcan --}}
                        {{-- @can('daftar pembayaran') --}}
                        <li class="menu-item {{ $title == 'Pembayaran' ? 'active' : '' }}">
                            <a href="{{ route('rajal/kasir/pembayaran/index') }}" class="menu-link">
                                <div>Pembayaran</div>
                            </a>
                        </li>
                        {{-- @endcan --}}
                    </ul>
                </li>
                {{-- @endcanany --}}
                {{-- end Rawat Jalan --}}
            @endhasanyrole

        @endhasanyrole
        {{-- end Rawatan --}}

        {{-- Additional --}}
        {{-- @hasanyrole(['Admin', 'Perawat Rajal', 'Rekam Medis Rajal', 'Dokter Poli', 'Dokter Ranap', 'Dokter Jaga'])
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text text-white">Additional</span>
            </li> --}}
            {{-- start kontrol  --}}
            {{-- <li class="menu-item {{ $menu == 'Kontrol' ? 'open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-file"></i>
                    <div>Surat Kontrol</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ $title == 'Kontrol Rawat Jalan' ? 'active' : '' }}">
                        <a href="{{ route('kontrol.rawatJalan') }}" class="menu-link">
                            <div>Rawat Jalan</div>
                        </a>
                    </li>
                    <li class="menu-item {{ $title == 'SPRI' ? 'active' : '' }}">
                        <a href="{{ route('kontrol.spri') }}" class="menu-link">
                            <div>SPRI</div>
                        </a>
                    </li>
                </ul>
            </li> --}}
            {{-- end kontrol  --}}
        {{-- @endhasanyrole --}}
        {{-- end Additional --}}


        {{-- Penunjang --}}
        @hasanyrole([
            'Admin',
            'Petugas Radiologi',
            'Petugas Labor PK',
            'Petugas Labor PA',
            'DPJP Radiologi',
            'DPJP Labor
            PK',
            'DPJP Labor PA',
            ])
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text text-white">Penunjang</span>
            </li>
            @hasanyrole(['Admin', 'Petugas Radiologi', 'DPJP Radiologi'])
                {{-- Radiologi --}}
                {{-- @canany(['list permintaan pemeriksaan radiologi', 'daftar jadwal pemeriksaan radiologi']) --}}
                <li class="menu-item {{ $menu == 'Radiologi' ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-bone"></i>
                        <div>Radiologi</div>
                    </a>

                    <ul class="menu-sub">
                        {{-- @can('list permintaan pemeriksaan radiologi') --}}
                        <li class="menu-item {{ $title == 'Radiologi' ? 'active' : '' }}">
                            <a href="{{ route('radiologi/patient.index') }}" class="menu-link">
                                <div>Daftar Permintaan Radiologi</div>
                            </a>
                        </li>
                        {{-- @endcan --}}
                        {{-- @can('daftar jadwal pemeriksaan radiologi') --}}
                        <li class="menu-item {{ $title == 'Antrian Radiologi' ? 'active' : '' }}">
                            <a href="{{ route('radiologi/patient/queue.index') }}" class="menu-link">
                                <div>Antrian Radiologi</div>
                            </a>
                        </li>
                        {{-- @endcan --}}
                    </ul>
                </li>
                {{-- @endcanany --}}
                {{-- end Radiologi --}}
            @endhasanyrole

            @hasanyrole(['Admin', 'Petugas Labor PK', 'DPJP Labor PK'])
                {{-- Laboratorium PK --}}
                {{-- @canany(['daftar jadwal pemeriksaan laboratorium pk', 'list permintaan pemeriksaan laboratorium pk']) --}}
                <li class="menu-item {{ $menu == 'Laboratorium PK' ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bxs-flask"></i>
                        <div>Laboratorium PK</div>
                    </a>

                    <ul class="menu-sub">
                        {{-- @can('list permintaan pemeriksaan laboratorium pk') --}}
                        <li class="menu-item {{ $title == 'Laboratorium PK' ? 'active' : '' }}">
                            <a href="{{ route('laboratorium/patient.index') }}" class="menu-link">
                                <div>Daftar Permintaan Laboratorium PK</div>
                            </a>
                        </li>
                        {{-- @endcan --}}
                        {{-- @can('daftar jadwal pemeriksaan laboratorium pk') --}}
                        <li class="menu-item {{ $title == 'Antrian Laboratorium PK' ? 'active' : '' }}">
                            <a href="{{ route('laboratorium/patient/queue.index') }}" class="menu-link">
                                <div>Antrian Laboratorium PK</div>
                            </a>
                        </li>
                        {{-- @endcan --}}
                    </ul>
                </li>
                {{-- @endcanany --}}
                {{-- end Laboratorium PK --}}
            @endhasanyrole

            @hasanyrole(['Admin', 'Petugas Labor PA', 'DPJP Labor PA'])
                {{-- laboratorium PA --}}
                {{-- @canany(['daftar jadwal pemeriksaan laboratorium pa', 'list permintaan pemeriksaan laboratorium pa']) --}}
                <li class="menu-item {{ $menu == 'Laboratorium PA' ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-cut"></i>
                        <div>Laboratorium PA</div>
                    </a>

                    <ul class="menu-sub">
                        {{-- @can('list permintaan pemeriksaan laboratorium pa') --}}
                        <li class="menu-item {{ $title == 'Laboratorium PA' ? 'active' : '' }}">
                            <a href="{{ route('permintaan/laboratorium/patologi/anatomik.index') }}" class="menu-link">
                                <div>Daftar Permintaan Laboratorium PA</div>
                            </a>
                        </li>
                        {{-- @endcan --}}
                        {{-- @can('daftar jadwal pemeriksaan laboratorium pa') --}}
                        <li class="menu-item {{ $title == 'Antrian Laboratorium PA' ? 'active' : '' }}">
                            <a href="{{ route('permintaan/laboratorium/patologi/anatomik.indexAntrian') }}"
                                class="menu-link">
                                <div>Antrian Laboratorium PA</div>
                            </a>
                        </li>
                        {{-- @endcan --}}
                    </ul>
                </li>
                {{-- @endcanany --}}
                {{-- end Laboratorium PA --}}
            @endhasanyrole
        @endhasanyrole
        {{-- end Penunjang --}}

        @role('Admin')
            {{-- Instalasi --}}
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text text-white">Instalasi</span>
            </li>

            {{-- Casemix --}}
            <li class="menu-item {{ $title == 'Casemix' ? 'active' : '' }}">
                <a href="{{ route('casemix') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-male"></i>
                    <div>Casemix</div>
                </a>
            </li>
            {{-- end Casemix --}}

            {{-- Farmasi --}}
            <?php $permisGudang = ['menu pembelian obat gudang farmasi', 'menu daftar stok obat di rumah sakit', 'menu daftar total stok obat di rumah sakit'];
            ?>
            @canany($permisGudang)
                {{-- farmasi --}}
                <li class="menu-item {{ $menu == 'Farmasi' ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bxs-capsule"></i>
                        <div>Farmasi</div>
                    </a>
                    <ul class="menu-sub">
                        {{-- Transaksi --}}
                        @can('menu pembelian obat gudang farmasi')
                            <li class="menu-item {{ $title == 'Pembelian' ? 'active' : '' }}">
                                <a href="{{ route('farmasi/obat/pembelian.index') }}" class="menu-link">
                                    <div>Pembelian</div>
                                </a>
                            </li>
                        @endcan
                        @can('menu daftar stok obat di rumah sakit')
                            <li class="menu-item {{ $title == 'Stock Obat' ? 'active' : '' }}">
                                <a href="{{ route('farmasi/obat/stock.index') }}" class="menu-link">
                                    <div>Stock</div>
                                </a>
                            </li>
                        @endcan
                        @can('menu daftar total stok obat di rumah sakit')
                            <li class="menu-item {{ $title == 'Total Stock Obat' ? 'active' : '' }}">
                                <a href="{{ route('farmasi/obat/stock.all') }}" class="menu-link">
                                    <div>Total Stock Obat</div>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcanany
            {{-- end Farmasi --}}
            {{-- end Instalasi --}}



            {{-- Master Data --}}
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text text-white">Master Data</span>
            </li>
            {{-- Settings --}}
            @php
                $arrPermissions = [
                    'master user simrs',
                    'master radiologi',
                    'master laboratorium pk',
                    'master tanggungan pasien',
                    'master konsultasi',
                    'master jenis tindakan',
                    'master tindakan',
                    'master ruangan',
                    'master unit',
                    'master spesialis',
                    'master role',
                    'master pekerjaan',
                    'master diagnosa',
                    'master daftar icd',
                    'master supplier',
                    'master pabrik',
                    'master obat',
                    'master jenis obat',
                    'master golongan obat',
                    'master bentuk sediaan obat',
                    'master tabel konversi',
                ];
            @endphp
            @canany($arrPermissions)
                <li class="menu-item {{ $menu == 'Setting' ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bxs-cog"></i>
                        <div>Setting</div>
                    </a>

                    <ul class="menu-sub">
                        @can('master user simrs')
                            <li class="menu-item {{ $title == 'User' ? 'active' : '' }}">
                                <a href="{{ route('user.index') }}" class="menu-link">
                                    <div>Daftar Staff</div>
                                </a>
                            </li>
                        @endcan
                        @can('master laboratorium pk')
                            <li class="menu-item {{ $title == 'Master Labor PK' ? 'active' : '' }}">
                                <a href="{{ route('laboratorium/pk/variabel/pemeriksaan.create') }}" class="menu-link">
                                    <div>Master Labor PK</div>
                                </a>
                            </li>
                        @endcan
                        @can('master radiologi')
                            <li class="menu-item {{ $title == 'Master Radiologi' ? 'active' : '' }}">
                                <a href="{{ route('rajal/master/radiologi.index') }}" class="menu-link">
                                    <div>Master Radiologi</div>
                                </a>
                            </li>
                        @endcan
                        @can('master tanggungan pasien')
                            <li class="menu-item {{ $title == 'Kategori Pasien' ? 'active' : '' }}">
                                <a href="{{ route('pasien/category') }}" class="menu-link">
                                    <div>Kategori Pasien</div>
                                </a>
                            </li>
                        @endcan
                        @can('master konsultasi')
                            <li class="menu-item {{ $title == 'Konsultasi' ? 'active' : '' }}">
                                <a href="{{ route('konsultasi') }}" class="menu-link">
                                    <div>Konsultasi</div>
                                </a>
                            </li>
                        @endcan
                        @can('master jenis tindakan')
                            <li class="menu-item {{ $title == 'Jenis Tindakan' ? 'active' : '' }}">
                                <a href="{{ route('tindakan/category') }}" class="menu-link">
                                    <div>Jenis Tindakan</div>
                                </a>
                            </li>
                        @endcan
                        @can('master tindakan')
                            <li class="menu-item {{ $title == 'Tindakan' ? 'active' : '' }}">
                                <a href="{{ route('action/members.index') }}" class="menu-link">
                                    <div>Tindakan</div>
                                </a>
                            </li>
                        @endcan
                        @can('master ruangan')
                            <li class="menu-item {{ $title == 'Ruang' ? 'active' : '' }}">
                                <a href="{{ route('ruang.index') }}" class="menu-link">
                                    <div>Ruangan</div>
                                </a>
                            </li>
                        @endcan
                        @can('master unit')
                            <li class="menu-item {{ $title == 'Unit' ? 'active' : '' }}">
                                <a href="{{ route('unit.index') }}" class="menu-link">
                                    <div>Unit / Departemen</div>
                                </a>
                            </li>
                        @endcan
                        @can('master spesialis')
                            <li class="menu-item {{ $title == 'Specialist' ? 'active' : '' }}">
                                <a href="{{ route('user/specialist.index') }}" class="menu-link">
                                    <div>Spesialis</div>
                                </a>
                            </li>
                        @endcan
                        @can('master role')
                            <li class="menu-item {{ $title == 'Role' ? 'active' : '' }}">
                                <a href="{{ route('user/role.index') }}" class="menu-link">
                                    <div>Role</div>
                                </a>
                            </li>
                        @endcan
                        @can('master pekerjaan')
                            <li class="menu-item {{ $title == 'Pekerjaan' ? 'active' : '' }}">
                                <a href="{{ route('job.index') }}" class="menu-link">
                                    <div>List Pekerjaan</div>
                                </a>
                            </li>
                        @endcan
                        @can('master diagnosa')
                            <li class="menu-item {{ $title == 'Diagnosa' ? 'active' : '' }}">
                                <a href="{{ route('diagnosa.index') }}" class="menu-link">
                                    <div>Diagnosa</div>
                                </a>
                            </li>
                        @endcan
                        @can('master daftar icd')
                            <li class="menu-item {{ $title == 'ICD' ? 'active' : '' }}">
                                <a href="{{ route('icd.index') }}" class="menu-link">
                                    <div>Daftar ICD</div>
                                </a>
                            </li>
                        @endcan
                        {{-- Konfigurasi Farmasi --}}
                        @can('master obat')
                            <li class="menu-item {{ $title == 'Master Obat' ? 'active' : '' }}">
                                <a href="{{ route('farmasi/obat.index') }}" class="menu-link">
                                    <div>Manajemen Obat</div>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcanany
            {{-- end Settings --}}

            {{-- Poliklinik --}}
            @canany(['edit jadwal dokter poli', 'jadwal poli'])
                {{-- Poli --}}
                <li class="menu-item {{ $menu == 'Poliklinik' ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-clinic"></i>
                        <div>Poliklinik</div>
                    </a>
                    <ul class="menu-sub">
                        @can('edit jadwal dokter poli')
                            <li class="menu-item {{ $title == 'Jadwal Dokter' ? 'active' : '' }}">
                                <a href="{{ route('dokter/jadwal.index') }}" class="menu-link">
                                    <div>Edit Jadwal Dokter Poli</div>
                                </a>
                            </li>
                        @endcan
                        @can('jadwal poli')
                            <li class="menu-item {{ $title == 'Informasi Jadwal Dokter' ? 'active' : '' }}">
                                <a href="{{ route('dokter/jadwal.all') }}" class="menu-link">
                                    <div>Info Jadwal Poli</div>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcanany
            {{-- end Poliklinik --}}

            {{-- Keuangan --}}
            <li class="menu-item {{ $menu == 'KEUANGAN' ? 'open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-add-to-queue"></i>
                    <div>Keuangan</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ $title == 'TARIF LAYANAN' ? 'active' : '' }}">
                        <a href="{{ route('tarif/layanan.index') }}" class="menu-link">
                            <div>Master Tarif RS</div>
                        </a>
                    </li>
                </ul>
            </li>
            {{-- end Keuangan --}}
            {{-- end Master Data --}}



            {{-- Report --}}
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text text-white">Report</span>
            </li>
            {{-- Laporan --}}
            {{-- @canany() --}}
            <li class="menu-item {{ $menu == 'Laporan' ? 'open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bxs-report"></i>
                    <div>Laporan</div>
                </a>
                <ul class="menu-sub">
                    {{-- @can('master user simrs') --}}
                    <li class="menu-item {{ $title == 'Laporan Penggunaan Obat' ? 'active' : '' }}">
                        <a href="{{ route('laporan/penggunaan/obat.index') }}" class="menu-link">
                            <div>Penggunaan Obat Pasien</div>
                        </a>
                    </li>
                    {{-- @endcan --}}
                    {{-- @can('master laboratorium pk') --}}
                    <li class="menu-item {{ $title == 'Laporan Kasir' ? 'active' : '' }}">
                        <a href="{{ route('laporan/kasir.index') }}" class="menu-link">
                            <div>Kasir Report</div>
                        </a>
                    </li>
                    {{-- @endcan --}}
                    {{-- @can('master radiologi') --}}
                    <li class="menu-item {{ $title == 'Laporan Lab Pk' ? 'active' : '' }}">
                        <a href="{{ route('laporan/lab/patologi/klinik.index') }}" class="menu-link">
                            <div>Lab Patologi Klinik</div>
                        </a>
                    </li>
                    {{-- @endcan --}}
                    {{-- @can('master tanggungan pasien') --}}
                    <li class="menu-item {{ $title == 'Laporan Lab PA' ? 'active' : '' }}">
                        <a href="{{ route('laporan/lab/patologi/anatomi.index') }}" class="menu-link">
                            <div>Lab Patologi Anatomi</div>
                        </a>
                    </li>
                    {{-- @endcan --}}
                    {{-- @can('master konsultasi') --}}
                    <li class="menu-item {{ $title == 'Laporan Radiologi' ? 'active' : '' }}">
                        <a href="{{ route('laporan/lab/radiologi.index') }}" class="menu-link">
                            <div>Radiologi</div>
                        </a>
                    </li>
                </ul>
            </li>
            {{-- @endcanany --}}
            {{-- end Laporan --}}
            {{-- end Report --}}
        @endrole
    </ul>
</aside>
