<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="/" class="app-brand-link">
            <span class="app-brand-logo demo">
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
        {{-- <li class="menu-header small text-uppercase">
            <span class="menu-header-text text-white">Main</span>
        </li> --}}
        <!-- Dashboard -->
        <li class="menu-item {{ $title === 'Dashboard' ? 'active' : '' }}">
            <a href="/" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>
        {{-- @hasanyrole(['Admin', 'Dokter Poli', 'Dokter Ranap', 'Dokter Jaga', 'Petugas Informasi', 'Rekam Medis Rajal',
            'Perawat Rajal', 'Apoteker', 'Kasir', 'DPJP Radiologi', 'DPJP Labor PK', 'DPJP Labor PA']) --}}
            @unlessrole(['Administrator', 'Petugas Gudang'])
            {{-- RME --}}
            <li class="menu-item {{ $title == 'RME' ? 'active' : '' }}">
                <a href="{{ route('rekam/medis/elektronik.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-notepad"></i>
                    <div>RME Pasien</div>
                </a>
            </li>
            @endunlessrole
        {{-- @endhasanyrole --}}
        {{-- end Main --}}
        @unlessrole(['Petugas Gudang', 'Administrator'])
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text text-white">Pasien</span>
            </li>
            {{-- pasien --}}
            <li class="menu-item {{ $title == 'Pasien' ? 'active' : '' }}">
                <a href="{{ route('pasien.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-male"></i>
                    <div>Daftar Pasien</div>
                </a>
            </li>
            {{-- end pasien --}}

            {{-- Antrian --}}
            @hasanyrole(['Petugas Informasi', 'Rekam Medis dan Casemix'])
            <li class="menu-item {{ $menu == 'Antrian' ? 'open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-add-to-queue"></i>
                    <div>Antrian</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ $title == 'Entri Antrian' ? 'active' : '' }}">
                        <a href="{{ route('antrian.create') }}" class="menu-link">
                            <div>Antrian</div>
                        </a>
                    </li>
                    <li class="menu-item {{ $title == 'Daftar Antrian' ? 'active' : '' }}">
                        <a href="{{ route('antrian.index') }}" class="menu-link">
                            <div>Re-register Antrian</div>
                        </a>
                    </li>
                </ul>
            </li>
            @endhasanyrole
        @endunlessrole

        @hasanyrole(['Perawat', 'Dokter', 'Apoteker', 'Kasir'])
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text text-white">Rawatan</span>
            </li>

            @hasanyrole(['Perawat', 'Dokter'])
            <li class="menu-item {{ $title == 'Rawat Jalan' ? 'active' : '' }}">
                <a href="{{ route('rajal/index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-accessibility"></i>
                    <div>Poliklinik</div>
                </a>
            </li>
            @endhasanyrole
            @role('Apoteker')
            <li class="menu-item {{ $title == 'Farmasi' ? 'active' : '' }}">
                <a href="{{ route('rajal/farmasi/index') }}" class="menu-link">
                    <i class='menu-icon tf-icons bx bxs-capsule'></i>
                    <div>Apotek</div>
                </a>
            </li>
            @endrole
            @role('Kasir')
            <li class="menu-item {{ $title == 'Pembayaran' ? 'active' : '' }}">
                <a href="{{ route('rajal/kasir/pembayaran/index') }}" class="menu-link">
                    <i class='menu-icon tf-icons bx bxs-credit-card'></i>
                    <div>Pembayaran</div>
                </a>
            </li>
            @endrole
        @endhasanyrole

        {{-- Penunjang --}}
        @hasanyrole([
            'Petugas Radiologi',
            'Petugas Laboratorium',
            'Validator Radiologi',
            'Validator Laboratorium',
            ])
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text text-white">Penunjang</span>
            </li>
            @hasanyrole(['Petugas Radiologi', 'Validator Radiologi'])
                <li class="menu-item {{ $menu == 'Radiologi' ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-bone"></i>
                        <div>Radiologi</div>
                    </a>

                    <ul class="menu-sub">
                        <li class="menu-item {{ $title == 'Radiologi' ? 'active' : '' }}">
                            <a href="{{ route('radiologi/patient.index') }}" class="menu-link">
                                <div>Daftar Permintaan Radiologi</div>
                            </a>
                        </li>
                        <li class="menu-item {{ $title == 'Antrian Radiologi' ? 'active' : '' }}">
                            <a href="{{ route('radiologi/patient/queue.index') }}" class="menu-link">
                                <div>Antrian Radiologi</div>
                            </a>
                        </li>
                    </ul>
                </li>
            @endhasanyrole
            @hasanyrole(['Petugas Laboratorium', 'Validator Laboratorium'])
                <li class="menu-item {{ $menu == 'Laboratorium PK' ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bxs-flask"></i>
                        <div>Laboratorium</div>
                    </a>

                    <ul class="menu-sub">
                        <li class="menu-item {{ $title == 'Laboratorium PK' ? 'active' : '' }}">
                            <a href="{{ route('laboratorium/patient.index') }}" class="menu-link">
                                <div>Daftar Permintaan Laboratorium</div>
                            </a>
                        </li>
                        <li class="menu-item {{ $title == 'Antrian Laboratorium PK' ? 'active' : '' }}">
                            <a href="{{ route('laboratorium/patient/queue.index') }}" class="menu-link">
                                <div>Antrian Laboratorium</div>
                            </a>
                        </li>
                    </ul>
                </li>
            @endhasanyrole
        @endhasanyrole
        {{-- end Penunjang --}}

        @hasanyrole([
            'Dokter',
            'Rekam Medis dan Casemix',
            ])
        {{-- Pengelolaan Data Kunjungan Pasien --}}
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text text-white">Pengelolaan Data</span>
            </li>
            @role('Rekam Medis dan Casemix')
                <li class="menu-item {{ $title == 'Monitoring' ? 'active' : '' }}">
                    <a href="{{ route('monitoring/data.index') }}" class="menu-link">
                        <i class='menu-icon tf-icons bx bx-tv'></i>
                        <div>Monitoring</div>
                    </a>
                </li>
                <li class="menu-item {{ $title == 'Satu Sehat' ? 'active' : '' }}">
                    <a href="{{ route('bridging/data/satusehat.indexSatuSehat') }}" class="menu-link">
                        <i class='menu-icon tf-icons bx bx-sync'></i>
                        <div>Bridging Satu Sehat</div>
                    </a>
                </li>
            @endrole
            @role('Dokter')
                <li class="menu-item {{ $title == 'Verifikasi' ? 'active' : '' }}">
                    <a href="{{ route('verifikasi/data/pasien.indexVerif') }}" class="menu-link">
                        <i class='menu-icon tf-icons bx bx-check-shield'></i>
                        <div>Verifikasi</div>
                    </a>
                </li>
            @endrole
            @endhasanyrole

            {{-- Master Data --}}
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text text-white">{{ Auth::user()->hasRole('Administrator') ? 'Pengaturan Awal' : 'Lainnya' }}</span>
            </li>
                @unlessrole(['Petugas Radiologi', 'Petugas Laboratorium', 'Validator Radiologi', 'Validator Laboratorium'])
                @unlessrole('Administrator')
                <li class="menu-item {{ $menu == 'Farmasi' ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bxs-bong"></i>
                        <div>Obat</div>
                    </a>
                    <ul class="menu-sub">
                        {{-- Transaksi --}}
                        @role(['Petugas Gudang'])
                        <li class="menu-item {{ $title == 'Pembelian' ? 'active' : '' }}">
                            <a href="{{ route('farmasi/obat/pembelian.index') }}" class="menu-link">
                                <div>Pembelian</div>
                            </a>
                        </li>
                        <li class="menu-item {{ $title == 'Amprahan' ? 'active' : '' }}">
                            <a href="{{ route('farmasi/obat/amprahan.index') }}" class="menu-link">
                                <div>Amprahan</div>
                            </a>
                        </li>
                        @endrole
                        <li class="menu-item {{ $title == 'Stock Obat' ? 'active' : '' }}">
                            <a href="{{ route('farmasi/obat/stock.index') }}" class="menu-link">
                                <div>Stock</div>
                            </a>
                        </li>
                        <li class="menu-item {{ $title == 'Total Stock Obat' ? 'active' : '' }}">
                            <a href="{{ route('farmasi/obat/stock.all') }}" class="menu-link">
                                <div>Total Stock Obat</div>
                            </a>
                        </li>
                        @hasanyrole(['Petugas Gudang','Administrator', 'Apoteker'])
                        {{-- Konfigurasi Farmasi --}}
                        <li class="menu-item {{ $title == 'Master Obat' ? 'active' : '' }}">
                            <a href="{{ route('farmasi/obat.index') }}" class="menu-link">
                                <div>Manajemen Obat</div>
                            </a>
                        </li>
                        @endhasanyrole
                    </ul>
                </li>
                @endunlessrole
                <li class="menu-item {{ $title == 'Poliklinik' ? 'active' : '' }}">
                    <a href="{{ route('poliklinik.index') }}" class="menu-link">
                        <i class='menu-icon tf-icons bx bxs-clinic'></i>
                        <div>Poli & Dokter</div>
                    </a>
                </li>
                @endunlessrole
                <li class="menu-item {{ $title == 'User' ? 'active' : '' }}">
                    <a href="{{ route('user.index') }}" class="menu-link">
                        <i class='menu-icon tf-icons bx bxs-group'></i>
                        <div>Manajemen User</div>
                    </a>
                </li>
                @unlessrole('Petugas Gudang')
                <li class="menu-item {{ $menu == 'Diagnosa-Tindakan' ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bxs-blanket"></i>
                        <div>Diagnosa Tindakan</div>
                    </a>

                    <ul class="menu-sub">
                        <li class="menu-item {{ $title == 'Diagnosa' ? 'active' : '' }}">
                            <a href="{{ route('diagnosa.index') }}" class="menu-link">
                                <div>Diagnosa</div>
                            </a>
                        </li>
                        <li class="menu-item {{ $title == 'Tindakan' ? 'active' : '' }}">
                            <a href="{{ route('tindakan.index') }}" class="menu-link">
                                <div>Tindakan</div>
                            </a>
                        </li>
                    </ul>
                </li>
                @endunlessrole

            @hasanyrole(['Administrator', 'Petugas Informasi', 'Rekam Medis dan Casemix'])
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text text-white">Master</span>
            </li>
                <li class="menu-item {{ $menu == 'Setting' ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bxs-cog"></i>
                        <div>Master Data</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item {{ $title == 'Kategori Pasien' ? 'active' : '' }}">
                            <a href="{{ route('pasien/category') }}" class="menu-link">
                                <div>Kategori Pasien</div>
                            </a>
                        </li>
                        <li class="menu-item {{ $title == 'Pekerjaan' ? 'active' : '' }}">
                            <a href="{{ route('job.index') }}" class="menu-link">
                                <div>List Pekerjaan</div>
                            </a>
                        </li>
                        @role('Administrator')
                        <li class="menu-item {{ $title == 'Unit' ? 'active' : '' }}">
                            <a href="{{ route('unit.index') }}" class="menu-link">
                                <div>Unit / Departemen</div>
                            </a>
                        </li>
                        <li class="menu-item {{ $title == 'Specialist' ? 'active' : '' }}">
                            <a href="{{ route('user/specialist.index') }}" class="menu-link">
                                <div>Spesialis</div>
                            </a>
                        </li>
                        @endrole
                    </ul>
                </li>
            @endhasanyrole



            {{-- Report --}}
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text text-white">Report</span>
            </li>
            <li class="menu-item {{ $menu == 'Laporan' ? 'open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bxs-report"></i>
                    <div>Laporan</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ $title == 'Laporan Penggunaan Obat' ? 'active' : '' }}">
                        <a href="{{ route('laporan/penggunaan/obat.index') }}" class="menu-link">
                            <div>Penggunaan Obat Pasien</div>
                        </a>
                    </li>
                    <li class="menu-item {{ $title == 'Laporan Kasir' ? 'active' : '' }}">
                        <a href="{{ route('laporan/kasir.index') }}" class="menu-link">
                            <div>Kasir Report</div>
                        </a>
                    </li>
                    <li class="menu-item {{ $title == 'Laporan Lab Pk' ? 'active' : '' }}">
                        <a href="{{ route('laporan/lab/patologi/klinik.index') }}" class="menu-link">
                            <div>Lab Patologi Klinik</div>
                        </a>
                    </li>
                </ul>
            </li>
            {{-- end Report --}}
        {{-- @endrole --}}
    </ul>
</aside>
