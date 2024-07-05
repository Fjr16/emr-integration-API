@extends('layouts.backend.main')

@section('content')

    @if (session()->has('success'))
        <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger w-100 border mb-5 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('error') }}
        </div>
    @endif

    {{-- Informasi Pasien --}}
    <div class="card mb-2">
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <h4 class="mb-1 text-primary d-flex">
                        {{ $item->patient->name }} ({{ implode('-', str_split(str_pad($item->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }})
                        <span class="ms-2 badge {{ $item->patient->jenis_kelamin == 'Wanita' ? 'bg-danger' : 'bg-info' }}">{{ $item->patient->jenis_kelamin == 'Wanita' ? 'P' : 'L' }}</span> 
                    </h4>
                    <h6>{{ $item->doctorPatient->user->name }} ({{ $item->doctorPatient->user->staff_id }})</h6>
                </div>
                <div class="col-8 text-end">
                    <p class="mb-0">No. Antrian : <span class="fst-italic fw-bold">{{ $item->no_antrian ?? '' }}</span></p>
                    <p class="mb-0">Tanggungan : <span class="fw-bold fst-italic">{{ $item->patientCategory->name }}</span></p>
                    <p class="mb-0">Tgl. Lahir : <span class="fw-bold fst-italic">{{ $item->patient->tanggal_lhr }}</span></p>
                </div>
            </div>
        </div>
    </div>
    {{-- end Informasi Pasien --}}

    {{-- data riwayat pemeriksaan pasien --}}
    <div class="card mb-2">
        <div class="card-body">
            <div class="accordion" id="accordionExample">
                <div class="card accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                    <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="true" aria-controls="accordionOne" role="tabpanel">
                      Data & Riwayat Medis Pasien
                    </button>
                  </h2>
                  
                  <div id="accordionOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                        <div class="row">
                            <div class="col-md-4 col-12 mb-3 mb-md-0">
                              <div class="list-group">
                                <a class="list-group-item list-group-item-action active" id="list-identitas-list" data-bs-toggle="list" href="#list-identitas">Identitas Pasien</a>
                                <a class="list-group-item list-group-item-action" id="list-kunjungan-terakhir-list" data-bs-toggle="list" href="#list-kunjungan-terakhir">Kunjungan Terakhir</a>
                                <a class="list-group-item list-group-item-action" id="list-rawat-jalan-list" data-bs-toggle="list" href="#list-rawat-jalan">Rawat Jalan</a>
                                <a class="list-group-item list-group-item-action" id="list-laboratorium-list" data-bs-toggle="list" href="#list-laboratorium">Laboratorium</a>
                                <a class="list-group-item list-group-item-action" id="list-radiologi-list" data-bs-toggle="list" href="#list-radiologi">Radiologi</a>
                              </div>
                            </div>
                            <div class="col-md-8 col-12 border">
                              <div class="tab-content">
                                <div class="tab-pane fade show active" id="list-identitas">
                                  Donut sugar plum sweet roll biscuit. Cake oat cake gummi bears. Tart wafer wafer halvah gummi bears cheesecake. Topping croissant cake sweet roll. Dessert fruitcake gingerbread halvah marshmallow pudding bear claw cheesecake. Bonbon dragée cookie gummies. Pudding marzipan liquorice. Sugar plum dragée cupcake cupcake cake dessert chocolate bar. Pastry lollipop lemon drops lollipop halvah croissant. Pastry sweet gingerbread lemon drops topping ice cream.
                                </div>
                                <div class="tab-pane fade" id="list-kunjungan-terakhir">
                                  Muffin lemon drops chocolate chupa chups jelly beans dessert jelly-o. Soufflé gummies gummies. Ice cream powder marshmallow cotton candy oat cake wafer. Marshmallow gingerbread tootsie roll. Chocolate cake bonbon jelly beans lollipop jelly beans halvah marzipan danish pie. Oat cake chocolate cake pudding bear claw liquorice gingerbread icing sugar plum brownie. Toffee cookie apple pie cheesecake bear claw sugar plum wafer gummi bears fruitcake. 
                                </div>
                                <div class="tab-pane fade" id="list-rawat-jalan">
                                  Ice cream dessert candy sugar plum croissant cupcake tart pie apple pie. Pastry chocolate chupa chups tiramisu. Tiramisu cookie oat cake. Pudding brownie bonbon. Pie carrot cake chocolate macaroon. Halvah jelly jelly beans cake macaroon jelly-o. Danish pastry dessert gingerbread powder halvah. Muffin bonbon fruitcake dragée sweet sesame snaps oat cake marshmallow cheesecake. Cupcake donut sweet bonbon cheesecake soufflé chocolate bar.
                                </div>
                                <div class="tab-pane fade" id="list-laboratorium">
                                  Marzipan cake oat cake. Marshmallow pie chocolate. Liquorice oat cake donut halvah jelly-o. Jelly-o muffin macaroon cake gingerbread candy cupcake. Cake lollipop lollipop jelly brownie cake topping chocolate. Pie oat cake jelly. Lemon drops halvah jelly cookie bonbon cake cupcake ice cream. Donut tart bonbon sweet roll soufflé gummies biscuit. Wafer toffee topping jelly beans icing pie apple pie toffee pudding. Tiramisu powder macaroon tiramisu cake halvah. 
                                </div>
                                <div class="tab-pane fade" id="list-radiologi">
                                  Marzipan cake oat cake. Marshmallow pie chocolate. Liquorice oat cake donut halvah jelly-o. Jelly-o muffin macaroon cake gingerbread candy cupcake. Cake lollipop lollipop jelly brownie cake topping chocolate. Pie oat cake jelly. Lemon drops halvah jelly cookie bonbon cake cupcake ice cream. Donut tart bonbon sweet roll soufflé gummies biscuit. Wafer toffee topping jelly beans icing pie apple pie toffee pudding. Tiramisu powder macaroon tiramisu cake halvah. 
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end data riwayat pemeriksaan pasien --}}
    {{-- Menu Rajal Perawata --}}
    <div class="card">
        <div class="card-body">
            <div class="nav-align-top mb-2 shadow-sm">
                <ul class="nav nav-tabs nav-sm nav-fill" role="tablist">
                    <li class="nav-item">
                        <button id="btn-link" type="button"
                            class="nav-link {{ session('perawat') == 'anamnesis' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-anamnesis"
                            aria-controls="navs-justified-anamnesis" aria-selected="false">
                            <i class="tf-icons bx bx-bookmark-alt-plus"></i>
                            <p class="m-0">Anamnesis</p>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button id="btn-link" type="button"
                            class="nav-link {{ session('perawat') == 'pemeriksaan' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-pemeriksaan"
                            aria-controls="navs-justified-pemeriksaan" aria-selected="false">
                            <i class="tf-icons bx bx-bookmark-alt-plus"></i>
                            <p class="m-0">Pemeriksaan</p>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button id="btn-link" type="button"
                            class="nav-link {{ session('perawat') == 'psikologis' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-psikologis"
                            aria-controls="navs-justified-psikologis" aria-selected="false">
                            <i class="tf-icons bx bx-message-square-add"></i>
                            <p class="m-0">Psikologis & Sosial Ekonomi</p>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button id="btn-link" type="button"
                            class="nav-link {{ session('perawat') == 'soap' ? 'active' : '' }} d-flex justify-content-center"
                            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-soap"
                            aria-controls="navs-justified-soap" aria-selected="false">
                            <i class="tf-icons bx bx-message-alt-add"></i>
                            <p class="m-0">SOAP</p>
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade {{ session('perawat') == 'anamnesis' ? 'show active' : '' }}"
                        id="navs-justified-anamnesis" role="tabpanel">                    
                        <form action="{{ route('asesmen/awal/perawat.store_step_one', $item->id) }}" method="POST">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <label class="form-label fw-bold">Anamnesa / Keluhan Utama</label>
                                            <textarea id="editor5" class="form-control" id="keluhan" name="keluhan" rows="4">{{ session('data.keluhan_utama') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <label class="form-label fw-bold">Riwayat Penyakit Pasien</label>
                                            <textarea id="editor1" class="form-control" id="riwayat_penyakit_sekarang" name="riwayat_penyakit_sekarang" rows="3">{{ session('data.riw_penyakit_pasien') }}</textarea>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label fw-bold">Riwayat Penyakit Keluarga</label>
                                            <textarea id="editor4" class="form-control" id="riwayat_penyakit_keluarga" name="riwayat_penyakit_keluarga" rows="3">{{ session('data.riw_penyakit_keluarga') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <label class="form-label fw-bold">Alergi Makanan</label>
                                            <textarea id="editor4" class="form-control" id="alergi_makanan" name="alergi_makanan" rows="6">{{ session('data.alergi_makanan') }}</textarea>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label fw-bold">Alergi Obat</label>
                                            <textarea id="editor4" class="form-control" id="alergi_obat" name="alergi_obat" rows="6">{{ session('data.alergi_obat') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="form-label fw-bold" id="label-kolom">Asesmen Gizi</label>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="asesmen_gizi" class="form-label">Apakah pasien mengalami penurunan berat badan dalam 6 bulan terakhir ?</label>
                                                <div class="input-group">
                                                    <select name="asesmen_gizi" id="asesmen_gizi" class="form-control" aria-describedby="basic-addon1">
                                                        @foreach ($arrAssGizi as $itemGizi)
                                                            @if (session('data.skor_ass_gizi_1') == $itemGizi['value'])
                                                                <option value="{{ $itemGizi['value'] }}" selected>{{ $itemGizi['name'] }}</option>
                                                            @else
                                                                <option value="{{ $itemGizi['value'] }}">{{ $itemGizi['name'] }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    <span class="input-group-text" id="basic-addon1">Skor: 0</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label" for="kurang_nafsu">Apakah memiliki keluhan kurang nafsu makan ?</label>
                                                <div class="input-group">
                                                    <select name="kurang_nafsu" id="kurang_nafsu" class="form-control" aria-describedby="basic-addon2">
                                                        <option value="0" {{ session('data.skor_ass_gizi_2') == '0' ? 'selected' : '' }}>Tidak</option>
                                                        <option value="1" {{ session('data.skor_ass_gizi_2') == '1' ? 'selected' : '' }}>Ya</option>
                                                    </select>
                                                    <span class="input-group-text" id="basic-addon2">Skor: 0</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md">
                                            <p class="m-0 fw-bold">Kondisi Gizi Pasien</p>
                                            <div class="form-check form-check-inline mt-3">
                                              <input class="form-check-input" type="radio" name="kondisi_gizi" id="inlineRadio1" value="Baik" {{ session('data.kondisi_gizi') == 'Baik' ? 'checked' : '' }}/>
                                              <label class="form-check-label" for="inlineRadio1">Baik</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                              <input class="form-check-input" type="radio" name="kondisi_gizi" id="inlineRadio2" value="Lebih" {{ session('data.kondisi_gizi') == 'Lebih' ? 'checked' : '' }}/>
                                              <label class="form-check-label" for="inlineRadio2">Lebih</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                              <input class="form-check-input" type="radio" name="kondisi_gizi" id="inlineRadio3" value="Kurang" {{ session('data.kondisi_gizi') == 'Kurang' ? 'checked' : '' }}/>
                                              <label class="form-check-label" for="inlineRadio3">Kurang</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                              <input class="form-check-input" type="radio" name="kondisi_gizi" id="inlineRadio4" value="Buruk" {{ session('data.kondisi_gizi') == 'Buruk' ? 'checked' : '' }}/>
                                              <label class="form-check-label" for="inlineRadio4">Buruk</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 text-end">
                                    <button type="submit" name="next-step" value="pemeriksaan" class="btn btn-primary btn-sm mx-3">Next</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade {{ session('perawat') == 'pemeriksaan' ? 'show active' : '' }}"
                        id="navs-justified-pemeriksaan" role="tabpanel">
                        <form action="{{ route('asesmen/awal/perawat.store_step_one', $item->id) }}" method="POST">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <label class="form-label fw-bold" id="label-kolom">Tanda-tanda Vital</label>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label class="form-label">Nadi</label>
                                                <div class="input-group">
                                                    <input type="number" step="0.01" name="ttv_nadi" class="form-control" aria-describedby="ttv_nadi" placeholder="0.00" value="{{ session('data.nadi') }}">
                                                    <span class="input-group-text" id="ttv_nadi">bpm</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Tekanan Darah</label>
                                                <div class="input-group">
                                                    <input type="number" step="0.01" name="ttv_td_sistolik" class="form-control" aria-describedby="ttv_td_sistolik" placeholder="0.00" value="{{ session('data.td_sistolik') }}">
                                                    <span class="input-group-text" id="ttv_td_sistolik">/</span>
                                                    <input type="number" step="0.01" name="ttv_td_diastolik" class="form-control" aria-describedby="ttv_td_diastolik" placeholder="0.00" value="{{ session('data.td_diastolik') }}">
                                                    <span class="input-group-text" id="ttv_td_diastolik">mmHg</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label class="form-label">Suhu</label>
                                                <div class="input-group">
                                                    <input type="number" step="0.01" name="ttv_suhu" class="form-control" aria-describedby="ttv_suhu" placeholder="0.00" value="{{ session('data.suhu') }}">
                                                    <span class="input-group-text" id="ttv_suhu">°C</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Nafas</label>
                                                <div class="input-group">
                                                    <input type="number" name="ttv_nafas" class="form-control" aria-describedby="ttv_nafas" placeholder="0" value="{{ session('data.nafas') }}">
                                                    <span class="input-group-text" id="ttv_nafas">x/menit</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="form-label fw-bold mt-2" id="label-kolom">Pemeriksaan Fisik</label>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label class="form-label my-0">Keadaan Umum</label>
                                                <div class="col-sm">
                                                    <div class="form-check form-check-inline mt-3">
                                                      <input class="form-check-input" type="radio" name="keadaan_umum" id="keadaan-umum1" value="Baik" {{ session('data.keadaan_umum') == 'Baik' ? 'checked' : '' }}/>
                                                      <label class="form-check-label" for="keadaan-umum1">Baik</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                      <input class="form-check-input" type="radio" name="keadaan_umum" id="keadaan-umum2" value="Lemas" {{ session('data.keadaan_umum') == 'Lemas' ? 'checked' : '' }}/>
                                                      <label class="form-check-label" for="keadaan-umum2">Lemas</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                      <input class="form-check-input" type="radio" name="keadaan_umum" id="keadaan-umum3" value="Sakit Ringan" {{ session('data.keadaan_umum') == 'Sakit Ringan' ? 'checked' : '' }}/>
                                                      <label class="form-check-label" for="keadaan-umum3">Sakit Ringan</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                      <input class="form-check-input" type="radio" name="keadaan_umum" id="keadaan-umum4" value="Sakit Sedang" {{ session('data.keadaan_umum') == 'Sakit Sedang' ? 'checked' : '' }}/>
                                                      <label class="form-check-label" for="keadaan-umum4">Sakit Sedang</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                      <input class="form-check-input" type="radio" name="keadaan_umum" id="keadaan-umum5" value="Sakit Berat" {{ session('data.keadaan_umum') == 'Sakit Berat' ? 'checked' : '' }}/>
                                                      <label class="form-check-label" for="keadaan-umum5">Sakit Berat</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Kesadaran</label>
                                                <input type="text" name="kesadaran" class="form-control form-control-md" placeholder="Tingkat Kesadaran" value="{{ session('data.kesadaran') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-4">
                                            <label class="form-label fw-bold">Tinggi Badan</label>
                                            <div class="input-group">
                                                <input class="form-control" id="tb" name="tb" value="{{ session('data.tb') }}"></input>
                                                <span class="input-group-text">cm</span>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <label class="form-label fw-bold">Berat Badan</label>
                                            <div class="input-group">
                                                <input class="form-control" id="bb" name="bb" value="{{ session('data.bb') }}"></input>
                                                <span class="input-group-text">kg</span>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <label class="form-label fw-bold">Lingkar Kepala</label>
                                            <div class="input-group">
                                                <input class="form-control" id="lk" name="lk" value="{{ session('data.lk') }}"></input>
                                                <span class="input-group-text">cm</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="form-label fw-bold">Asesmen Nyeri</label>
                                        <div class="col-6">
                                            <img src="{{ asset('/assets/img/aakprj2.jpg') }}" alt="" class="img-fluid" style="max-width: 350px">
                                            <div class="col-md">
                                                <div class="form-check form-check-inline mt-3 ms-4">
                                                  <input class="form-check-input" type="radio" name="ass_nyeri" id="nyeri-1" value="0" {{ session('data.skor_nyeri') == '0' ? 'checked' : '' }}/>
                                                  <label class="form-check-label" for="nyeri-1">0</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                  <input class="form-check-input" type="radio" name="ass_nyeri" id="nyeri-2" value="2" {{ session('data.skor_nyeri') == '2' ? 'checked' : '' }}/>
                                                  <label class="form-check-label" for="nyeri-2">2</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                  <input class="form-check-input" type="radio" name="ass_nyeri" id="nyeri-3" value="4" {{ session('data.skor_nyeri') == '4' ? 'checked' : '' }}/>
                                                  <label class="form-check-label" for="nyeri-3">4</label>
                                                </div>
                                                <div class="form-check form-check-inline mt-3">
                                                  <input class="form-check-input" type="radio" name="ass_nyeri" id="nyeri-4" value="6" {{ session('data.skor_nyeri') == '6' ? 'checked' : '' }}/>
                                                  <label class="form-check-label" for="nyeri-4">6</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                  <input class="form-check-input" type="radio" name="ass_nyeri" id="nyeri-5" value="8" {{ session('data.skor_nyeri') == '8' ? 'checked' : '' }}/>
                                                  <label class="form-check-label" for="nyeri-5">8</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                  <input class="form-check-input" type="radio" name="ass_nyeri" id="nyeri-6" value="10" {{ session('data.skor_nyeri') == '10' ? 'checked' : '' }}/>
                                                  <label class="form-check-label" for="nyeri-6">10</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="form-label fw-bold mt-2">Asesmen Resiko Jatuh</label>
                                        <div class="col-8">
                                            <table class="table table-bordered w-100 mb-3">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th colspan="2" class="text-body">KOMPONEN PENILAIAN</th>
                                                        <th class="text-body">YA</th>
                                                        <th class="text-body">TIDAK</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td colspan="2">a. Perhatikan cara berjalan pasien saat akan duduk dikursi. Apakah pasien
                                                            tampak tidak seimbang (sempoyongan / linglung) ?</td>
                                                        <td class="text-center">
                                                            <input class="form-check-input" name="resiko_jatuh_a" id="radioAya" type="radio" value="1" {{ session('data.resiko_jatuh_a') == '1' ? 'checked' : '' }}/>
                                                        </td>
                                                        <td class="text-center">
                                                            <input class="form-check-input" name="resiko_jatuh_a" id="radioAtidak" value="0" type="radio" {{ session('data.resiko_jatuh_a') == '0' ? 'checked' : '' }}/>
                                                        </td>
                                                    </tr>
                            
                                                    <td colspan="2">b. Apakah pasien memegang pinggiran kursi atau meja atau benda lain sebagai
                                                        penopang saat akan duduk?</td>
                                                    <td class="text-center">
                                                        <input class="form-check-input" name="resiko_jatuh_b" id="radioBya" type="radio" value="1" {{ session('data.resiko_jatuh_b') == '1' ? 'checked' : '' }}/>
                                                    </td>
                                                    <td class="text-center">
                                                        <input class="form-check-input" name="resiko_jatuh_b" id="radioBtidak" type="radio" value="0" {{ session('data.resiko_jatuh_b') == '0' ? 'checked' : '' }}/>
                                                    </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-4 align-self-center">
                                            <div class="card bg-transparent text-primary border border-primary">
                                                <div class="card-body">
                                                    @foreach ($arrResikoJatuh as $index => $komponen1)
                                                        <div class="form-check mb-2">
                                                            <input class="form-check-input" name="resiko_jatuh_result" value="{{ $komponen1 }}" id="komponen1{{ $index + 1 }}" type="radio" {{ session('data.resiko_jatuh_result') == $komponen1 ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="komponen1{{ $index + 1 }}">
                                                                {{ $komponen1 }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 text-end">
                                    <button type="submit" name="next-step" value="psikologis" class="btn btn-primary btn-sm mx-3">Next</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade {{ session('perawat') == 'psikologis' ? 'show active' : '' }}"
                        id="navs-justified-psikologis" role="tabpanel">
                        <form action="{{ route('asesmen/awal/perawat.store_step_one', $item->id) }}" method="POST">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="status_psikologis" class="form-label">Status Psikologis</label>
                                                <select class="form-select form-select-md select2" id="select2" name="status_psikologis[]" multiple="multiple" style="width: 100%">
                                                    <option value="Tenang">Tenang</option>
                                                    <option value="Tegang">Tegang</option>
                                                    <option value="Takut">Takut</option>
                                                    <option value="Marah">Marah</option>
                                                    <option value="Senang">Senang</option>
                                                    <option value="Sedih">Sedih</option>
                                                    <option value="Depresi">Depresi</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="status_ekonomi" class="form-label">Status Sosial & Ekonomi</label>
                                                <select name="status_ekonomi" id="status_ekonomi" class="form-select form-select-md">
                                                    <option value="Baik" {{ session('stts_ekonomi') == 'Baik' ? 'selected' : '' }}>Baik</option>
                                                    <option value="Cukup" {{ session('stts_ekonomi') == 'Cukup' ? 'selected' : '' }}>Cukup</option>
                                                    <option value="Kurang" {{ session('stts_ekonomi') == 'Kurang' ? 'selected' : '' }}>Kurang</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 text-end">
                                    <button type="submit" name="next-step" value="soap" class="btn btn-primary btn-sm mx-3">Next</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade {{ session('perawat') == 'soap' ? 'show active' : '' }}" id="navs-justified-soap" role="tabpanel">
                        <form action="{{ route('asesmen/awal/perawat.store_step_two', $item->id) }}" method="POST">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="row mb-4">
                                            <div class="col-sm-6">
                                                <label for="subjective" class="form-label">Subjective</label>
                                                <textarea name="subjective" id="subjective" class="form-control" rows="10" placeholder="Subjective">{{ "Keluhan: " . session('data.keluhan_utama') . "\r\n" . "Riwayat Penyakit: " . session('data.riw_penyakit_pasien') }}</textarea>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="objective" class="form-label">Objective</label>
                                                <textarea name="objective" id="objective" class="form-control" rows="10" placeholder="Objective">{{ "Keadaan Umum: " . session('data.keadaan_umum') . "\r\n" . "Nadi: " . session('data.nadi') . " bpm\r\n" . "Tekanan Darah: " . session('data.td_sistolik') . " / " . session('data.td_diastolik') . " mmHg\r\n" . "Suhu: " . session('data.suhu') . " °C\r\n" . "Nafas: " . session('data.nafas') . " x/menit\r\n" . "Tinggi Badan: " . session('data.tb') . "\r\n" . "Berat Badan: " . session('data.bb') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="asesmen" class="form-label">Assesment</label>
                                                <textarea name="asesmen" id="asesmen" class="form-control" rows="10" placeholder="Assesment"></textarea>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="planning" class="form-label">Planning</label>
                                                <textarea name="planning" id="planning" class="form-control" rows="10" placeholder="Planning"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 text-end">
                                    <button type="submit" class="btn btn-success btn-sm mx-3">Submit</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end Menu Rajal Perawat --}}

    {{-- modal --}}
    <div class="modal fade" id="modalScrollable" tabindex="-1" aria-labelledby="modalScrollableTitle" aria-hidden="true">
    </div>    

    {{-- untuk ttd --}}
    {{-- <div class="mb-3 mt-2 mx-3 parent row d-flex justify-content-between">
        @php
            $ttd_dokter = '';
            $ttd_pasien = '';
            $nama_dokter = '';
            $nama_pasien = '';
        @endphp
        <div class="col-md-5 row d-flex justify-content-center">
            <h6 class="fw-bold text-center mb-4">Tanda Tangan Dokter</h6>
            <div class="text-center">
                <img src="{{ asset('storage/' . $ttd_dokter) }}" alt="" id="ImgTtdDokter" style="max-width: 200px">
                <textarea id="ttdDokter" name="ttd_dokter" style="display: none;">{{ $ttd_dokter }}</textarea>
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <button type="button" class="col-12 btn btn-sm btn-dark"
                                onclick="openModal(this, 'ImgTtdDokter', 'ttdDokter', 'nm_dokter')">Tanda
                                Tangan</button>
                        </div>
                        <div class="col">
                            <button type="button" class="col-12 btn btn-sm btn-secondary"
                                id="clearImgDokter">Clear</button>
                        </div>
                        <div class="col-12 mt-2">
                            <input type="text" class="form-control form-control-sm text-center"
                                name="nm_dokter" id="nm_dokter" value="{{ $nama_dokter }}"
                                placeholder="Nama Lengkap" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5 row d-flex justify-content-center">
            <h6 class="fw-bold text-center mb-4">Tanda tangan Pasien/Wali</h6>
            <div class="text-center">
                <img src="{{ asset('storage/' . $ttd_pasien) }}" alt="" id="ImgTtdKeluargaPasien" style="max-width: 200px">
                <textarea id="ttd" name="ttd" style="display: none;">{{ $item->patient->name }}</textarea>
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <button type="button" class="col-12 btn btn-sm btn-dark"
                                onclick="openModalTtdBottom(this, 'ImgTtdKeluargaPasien', 'ttd')">Tanda
                                Tangan</button>
                        </div>
                        <div class="col">
                            <button type="button" class="col-12 btn btn-sm btn-secondary"
                                id="clearImgPerawat">Clear</button>
                        </div>
                        <div class="col-12 mt-2">
                            <input type="text" class="form-control form-control-sm text-center"
                                name="nm_pasien" id="nm_pasien" value="{{ $item->patient->name }}"
                                placeholder="Nama Lengkap" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
