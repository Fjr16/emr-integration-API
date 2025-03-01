@extends('layouts.backend.main')

@section('content')
<div class="row">
    <div class="col col-12">
        <div class="row">
            <div class="col col-12">
                <div class="card">
                    <div class="card-body">
                        <h4>Data Pasien</h4>
                        <div class="row mt-4 px-5">
                            <div class="col-12 col-lg-9">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="pb-3">Nama</td>
                                            <td class="pb-3 px-2">:</td>
                                            <td class="pb-3">{{ $item->name ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="pb-3">Tempat lahir</td>
                                            <td class="pb-3 px-2">:</td>
                                            <td class="pb-3">{{ $item->tempat_lhr ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="pb-3">Tanggal Lahir</td>
                                            <td class="pb-3 px-2">:</td>
                                            <td class="pb-3">{{ $item->tanggal_lhr ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="pb-3">Jenis Kelamin</td>
                                            <td class="pb-3 px-2">:</td>
                                            <td class="pb-3">{{ $item->jenis_kelamin ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="pb-3">Status Kawin</td>
                                            <td class="pb-3 px-2">:</td>
                                            <td class="pb-3">{{ $item->status ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="pb-3">No. Hp</td>
                                            <td class="pb-3 px-2">:</td>
                                            <td class="pb-3">{{ $item->telp ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td>:</td>
                                            <td>{{ $item->district->name ?? '' }}, {{ $item->village->name ?? '' }},
                                                {{ $item->city->name ?? '' }},
                                                {{ $item->province->name ?? '' }},{{ $item->alamat ?? '' }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12 col-lg-3 text-center">
                                <img class="img-fluid" src="{{ asset('assets/img/illustrations/profilerme.png') }}" alt="" style="max-width: 10rem">
                                <div class="mx-auto border border-5 border-success w-75 rounded-pill">
                                    <div class="display-4 text-center py-2">
                                        {{ $item->no_rm ?? '' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link bg-success text-white" aria-current="page" href="#" id="all"><i class="menu-icon tf-icons bx bx-hotel"></i> All</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" id="tab-rawat-jalan"><i class="menu-icon tf-icons bx bx-accessibility"></i>
                                    Rawat Jalan</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col col-12 mt-2">
        <div class="card">
            <div class="card-body">
                <h4>Rekam Medis Elektronik</h4>
                {{-- All --}}
                <div class="table-responsive" id="table-all">
                    <table class="table" id="example4">
                        <thead>
                            <tr class="text-nowrap bg-dark">
                                <th>No</th>
                                <th>No. Antrian</th>
                                <th>Tanggal Antrian</th>
                                <th>Nama</th>
                                <th>Category</th>
                                <th>Status Antrian</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($item->queues as $queue)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $queue->no_antrian ?? '' }}</td>
                                <td>{{ $queue->tgl_antrian ?? '' }}</td>
                                <td>{{ $queue->patient->name ?? '' }}</td>
                                <td>{{ $queue->category ?? '' }}</td>
                                <td>{{ $queue->status_antrian ?? '' }}</td>
                                <td><a href="{{ route('rajal/show', [encrypt($queue->id), encrypt('Rawat Jalan')]) }}" class="btn btn-sm btn-success">Show</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Rawat Jalan --}}
                <div class="table-responsive" id="table-rawat-jalan">
                    <table class="table" id="example1">
                        <thead>
                            <tr class="text-nowrap bg-dark">
                                <th>No</th>
                                <th>No. Antrian</th>
                                <th>Tanggal Antrian</th>
                                <th>Nama</th>
                                <th>Category</th>
                                <th>Status Antrian</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($item->queues as $queue)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $queue->no_antrian ?? '' }}</td>
                                <td>{{ $queue->tgl_antrian ?? '' }}</td>
                                <td>{{ $queue->patient->name ?? '' }}</td>
                                <td>{{ $queue->category ?? '' }}</td>
                                <td>{{ $queue->status_antrian ?? '' }}</td>
                                <td><a href="{{ route('rajal/show', [encrypt($queue->id), encrypt('Rawat Jalan')]) }}" class="btn btn-sm btn-success">Show</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Sembunyikan semua tabel kecuali tabel all saat halaman dimuat
        $("#table-igd, #table-rawat-jalan, #table-rawat-inap, #table-kemoterapi, #table-sep").hide();

        // Ketika tab ALl diklik
        $("#all").click(function() {
            // Hapus kelas active dari semua tab
            $(".nav-link").removeClass("active bg-success text-white shadow");
            // Tambahkan kelas active ke tab IGD
            $(this).addClass("shadow bg-success text-white");
            // Sembunyikan semua tabel kecuali tabel IGD
            $("#table-igd, #table-rawat-jalan, #table-rawat-inap, #table-kemoterapi").hide();
            $("#table-all").show();
        });
        $("#tab-igd").click(function() {
            // Hapus kelas active dari semua tab
            $(".nav-link").removeClass("active bg-success text-white shadow");
            // Tambahkan kelas active ke tab IGD
            $(this).addClass("shadow bg-success text-white");
            // Sembunyikan semua tabel kecuali tabel IGD
            $("#table-all, #table-rawat-jalan, #table-rawat-inap, #table-kemoterapi").hide();
            $("#table-igd").show();
        });

        // Lakukan hal yang sama untuk tab lainnya
        $("#tab-rawat-jalan").click(function() {
            $(".nav-link").removeClass("active bg-success text-white shadow");
            $(this).addClass("shadow bg-success text-white");
            $("#table-all, #table-igd, #table-rawat-inap, #table-kemoterapi").hide();
            $("#table-rawat-jalan").show();
        });

        $("#tab-rawat-inap").click(function() {
            $(".nav-link").removeClass("active bg-success text-white shadow");
            $(this).addClass("shadow bg-success text-white");
            $("#table-all, #table-igd, #table-rawat-jalan, #table-kemoterapi").hide();
            $("#table-rawat-inap").show();
        });

        $("#tab-kemoterapi").click(function() {
            $(".nav-link").removeClass("active bg-success text-white shadow");
            $(this).addClass("shadow bg-success text-white");
            $("#table-all, #table-igd, #table-rawat-jalan, #table-rawat-inap").hide();
            $("#table-kemoterapi").show();
        });
    });
</script>
@endsection