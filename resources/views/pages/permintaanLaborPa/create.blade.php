@extends('layouts.backend.main')

@section('content')
    <style>
        #faces,
        #neck,
        #breast {
            /* background-color: red; */
            position: relative;
            display: inline-block;
        }

        .checklist-img {
            position: absolute;
            width: 30px;
            height: 30px;
            pointer-events: none;
        }

        .show-checklist .checklist-img {
            visibility: visible;
            display: none;
        }
    </style>
    @if (session()->has('success'))
        <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div id="success-message"></div>
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Tambah Permintaan Laboratorium Patologi Anatomik</h5>
            <button type="button" class="btn btn-sm btn-success" onclick="history.back()">Kembali</button>
        </div>
        <form id="upload-form" action="{{ route('permintaan/laboratorium/patologi/anatomik.store', $item->id) }}"
            method="POST" enctype="multipart/form-data" onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
            @csrf
            <div class="card-body">
                <div class="row mb-3">
                    <label for="nama_dokter" class="col-form-label col-2">Nama Dokter</label>
                    <div class="col-9">
                        <input class="form-control" type="text" value="{{ Auth::user()->name }}" disabled />
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="bagian" class="col-form-label col-2">Bagian</label>
                    <div class="col-9">
                        <input class="form-control" type="text" value="{{ Auth::user()->roomDetail->name ?? '' }}"
                            disabled />
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="no_sediaan" class="col-form-label col-2">No Sediaan</label>
                    <div class="col-9">
                        <input name="no_sediaan" class="form-control" type="text" value="" required />
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nama_pasien" class="col-form-label col-2">Nama Pasien</label>
                    <div class="col-9">
                        <input class="form-control" type="text" value="{{ $item->patient->name }}" disabled />
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="jenis_kelamin" class="col-form-label col-2">Jenis Kelamin</label>
                    <div class="col-9">
                        <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example"
                            name="jenis_kelamin">
                            <option value="{{ $item->patient->jenis_kelamin }}">{{ $item->patient->jenis_kelamin }}</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="usia" class="col-form-label col-2">Usia</label>
                    <div class="col-9">
                        <input class="form-control" type="number" value="{{ $umur }}" disabled />
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="alamat" class="col-form-label col-2">Alamat</label>
                    <div class="col-9">
                        <input class="form-control" type="text" value="{{ $item->patient->alamat }}" disabled />
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="suku_bangsa" class="col-form-label col-2">Suku Bangsa</label>
                    <div class="col-9">
                        <input class="form-control" type="text" value="{{ $item->patient->suku }}" disabled />
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="jaringan_tubuh_didapat_dengan" class="col-form-label col-2">Jaringan tubuh didapat
                        dengan</label>
                    <div class="col-9">
                        <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example"
                            name="jaringanTubuhDiDapat" required>
                            <option selected disabled>Pilih</option>
                            <option value="Biopsi">Biopsi</option>
                            <option value="Operasi">Operasi</option>
                            <option value="Kerokan">Kerokan</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="lokasi_jaringan_yang_diambil" class="col-form-label col-2">Lokasi jaringan yang
                        diambil</label>
                    <div class="col-9">
                        <textarea class="form-control" type="text" name="lokasiJaringanYangDiAmbil" required> </textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="pengobatan_yang_telah_diberikan" class="col-form-label col-2">Pengobatan yang telah
                        diberikan</label>
                    <div class="col-9">
                        <textarea class="form-control" type="text" name="pengobatanYangTelahDiBerikan" required></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="diagnosis_klinik" class="col-form-label col-2">Diagnosis Klinik</label>
                    <div class="col-9">
                        <textarea class="form-control" type="text" name="diagnosisKlinik" required></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="keterangan_klinik" class="col-form-label col-2">Keterangan Klinik</label>
                    <div class="col-9">
                        <textarea class="form-control" type="text" name="keteranganKlinik" required></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="sketsa_lokasi" class="col-form-label col-2">Sketsa Lokasi </label>
                    <div class="col-9">
                        <div class="row mb-4">
                            @foreach (['faces' => 'wajah.png', 'neck' => 'leher.png', 'breast' => 'payudara.png'] as $id => $img)
                                <div class="col-12 col-lg-4 mb-3 mb-lg-0">
                                    <div class="d-flex flex-column">
                                        <div id="{{ $id }}" class="text-center">
                                            <img src="{{ asset('assets/img/' . $img) }}" alt=""
                                                class="img-fluid" style="height: 250px">
                                            <div id="{{ $id }}-check"></div>
                                        </div>
                                        <button id="clear{{ ucfirst($id) }}" class="btn btn-sm btn-warning">Reset
                                            Posisi</button>
                                    </div>
                                </div>
                            @endforeach
                            {{-- <textarea name="" id="wajah-input" name="wajah-input" cols="30" rows="10"></textarea> --}}
                            <input type="text" id="wajah-input" name="wajah-input" hidden>
                            <input type="text" id="leher-input" name="leher-input" hidden>
                            <input type="text" id="dada-input" name="dada-input" hidden>
                        </div>

                        <textarea class="form-control" type="text" name="sketsaLokasi" required></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="status_perkawinan" class="col-form-label col-2">Status Perkawinan</label>
                    <div class="col-9">
                        <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example"
                            name="status_perkawinan" required>
                            <option value="{{ $item->patient->status }}">{{ $item->patient->status }}</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-5">
                    <label for="tanggal_mens" class="col-form-label col-2">Tanggal Mens Terakhir (HP/HT)</label>
                    <div class="col-9">
                        <input class="form-control" type="date" value="" name="hphjt" />
                    </div>
                </div>
                <div class="mb-5 table-responsive">
                    <label for="hasil_laboratorium" class="form-label">Pemeriksaan Terdahulu</label>
                    <table class="table">
                        <thead>
                            <tr class="text-nowrap">
                                <th class="text-body">No</th>
                                <th class="text-body">Tanggal</th>
                                <th class="text-body">Detail</th>
                                <th class="text-body">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($item->patient->permintaanLaboratoriumPatologiAnatomikPatient as $laborPa)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $laborPa->created_at }}</td>
                                    <td></td>
                                    <td class="d-flex">
                                        <a href="" target="blank" class="btn btn-dark btn-sm"><i
                                                class='bx bx-printer'></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mb-5 table-responsive">
                    <label for="hasil_laboratorium" class="form-label">Hasil Laboratorium</label>
                    <table class="table">
                        <thead>
                            <tr class="text-nowrap">
                                <th class="text-body">Tanggal Permintaan</th>
                                <th class="text-body">Petugas Laboratorium</th>
                                <th class="text-body">No. Labor</th>
                                <th class="text-body">Diagnosa Klinis</th>
                                <th class="text-body">Tanggal</th>
                                <th class="text-body">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($laborPkResults as $laborPk)
                                <tr>
                                    <td>{{ $laborPk->laboratoriumRequest->created_at->format('Y-m-d') ?? '' }}
                                    </td>
                                    {{-- <td>{{ $laborPk->user->name ?? '' }}</td> --}}
                                    <td>{{ $laborPk->laboratoriumUserValidator->user->name ?? '' }}</td>
                                    <td>{{ $laborPk->nomor_reg_lab ?? '' }}</td>
                                    <td>{!! $laborPk->laboratoriumRequest->diagnosa ?? '' !!}</td>
                                    <td>{{ $laborPk->tanggal_periksa ?? '' }}</td>
                                    <td>{{ $laborPk->status ?? '' }}</td>
                                    <td>
                                        <a href="{{ route('laboratorium/patient/hasil.show', $laborPk->id) }}"
                                            target="blank" class="btn btn-dark btn-sm"><i class='bx bx-printer'></i></a>
                                        {{-- <button class="btn btn-dark btn-sm" onclick="reviewUlang({{ $laborPk->id }})"><i
                                                class='bx bx-revision'></i></button> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mb-5 table-responsive">
                    <label for="pemeriksaan_radiologi" class="form-label">Pemeriksaan Radiologi</label>
                    <table class="table">
                        <thead>
                            <tr class="text-nowrap">
                                <th class="text-body">Tanggal Permintaan</th>
                                <th class="text-body">Petugas Radiologi</th>
                                <th class="text-body">Jenis Pemeriksaan</th>
                                <th class="text-body">Diagnosa Klinis</th>
                                <th class="text-body">Tanggal Hasil</th>
                                <th class="text-body">Hasil Gambar</th>
                                <th class="text-body">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($radiologiResults as $result)
                                @foreach ($result->radiologiPatientRequestDetails->where('status', 'SELESAI') as $detail)
                                    <tr>
                                        <td>{{ $result->radiologiFormRequest->created_at->format('Y-m-d / H:i:s') ?? '' }}
                                        </td>
                                        <td>{{ $detail->user->name ?? '' }}</td>
                                        <td>{{ $detail->radiologiFormRequestDetail->radiologiFormRequestMaster->name ?? '' }}
                                        </td>
                                        <td>{!! $result->radiologiFormRequest->diagnosa_klinis ?? '' !!}</td>
                                        <td>{{ $result->radiologiFormRequest->updated_at->format('Y-m-d / H:i:s') ?? '' }}
                                        </td>
                                        <td><a href="{{ Storage::url($detail->image ?? '') }}" target="blank">
                                                <img src="{{ Storage::url($detail->image ?? '') }}"
                                                    alt="{{ $detail->image ?? '' }}" width="100" height="100">
                                            </a></td>
                                        <td>
                                            <div class="d-flex flex-row">
                                                <a href="{{ route('radiologi/patient/hasil.show', $detail->id) }}"
                                                    target="blank" class="btn btn-dark btn-sm"><i
                                                        class='bx bx-printer'></i></a>
                                                <a href="{{ route('radiologi/patient/hasil.showChange', $detail->id) }}"
                                                    target="blank" class="btn btn-dark btn-sm ms-2"><i
                                                        class='bx bx-low-vision'></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row mb-3" id="">
                    <label for="sketsa_lokasi" class="col-form-label col-1">Catatan</label>
                    <div class="col-11">
                        <textarea class="form-control" type="text" name="catatan"></textarea>
                    </div>
                </div>
                <div class="mb-3 text-end">
                    <button type="submit" id="btnSave" class="btn btn-success btn-sm">
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        <span class="sr-only">Simpan</span>
                    </button>
                </div>
            </div>
        </form>
    </div>


    <script>
        // Function to initialize the checklist functionality
        function initChecklist(sectionId, checklistImg, storageKey) {
            document.addEventListener('DOMContentLoaded', function() {
                var body = document.getElementById(sectionId);
                var checkmarksContainer = document.getElementById(sectionId + '-check');
                var resetButton = document.getElementById('clear' + sectionId.charAt(0).toUpperCase() + sectionId
                    .slice(1));
                var positions = JSON.parse(localStorage.getItem(storageKey)) || [];

                function addChecklist(position) {
                    var checklist = document.createElement('img');
                    checklist.src = checklistImg;
                    checklist.alt = 'Checklist';
                    checklist.classList.add('checklist-img');
                    checklist.style.left = (position.x - 10) + 'px';
                    checklist.style.top = (position.y - 10) + 'px';
                    checkmarksContainer.appendChild(checklist);
                }

                positions.forEach(function(pos) {
                    addChecklist(pos);
                });

                body.addEventListener('click', function(event) {
                    var rect = body.getBoundingClientRect();
                    var position = {
                        x: event.clientX - rect.left,
                        y: event.clientY - rect.top
                    };
                    positions.push(position);
                    localStorage.setItem(storageKey, JSON.stringify(positions));
                    addChecklist(position);
                });

                window.addEventListener('beforeunload', function() {
                    localStorage.removeItem(storageKey);
                });

                resetButton.addEventListener('click', function() {
                    positions = [];
                    localStorage.removeItem(storageKey);
                    while (checkmarksContainer.firstChild) {
                        checkmarksContainer.removeChild(checkmarksContainer.firstChild);
                    }
                });

            });
        }

        // Call the initChecklist function for each section with the appropriate parameters
        initChecklist('faces', "{{ asset('assets/img/checklist.png') }}", 'positions');
        initChecklist('neck', "{{ asset('assets/img/checklist (2).png') }}", 'neck-positions');
        initChecklist('breast', "{{ asset('assets/img/checklist (3).png') }}", 'breast-positions');

        // Function to convert the div to an image and store it in the input field
        document.getElementById('btnSave').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the form from submitting immediately
            const button = document.getElementById('btnSave');
            const spinner = button.querySelector('.spinner-border');
            const buttonText = button.querySelector('.sr-only');

            // Show the spinner
            spinner.classList.remove('d-none');

            // Disable the button
            button.disabled = true;

            // Get the button and spinner elements
            const button = document.getElementById('btnSave');
            const spinner = button.querySelector('.spinner-border');
            const buttonText = button.querySelector('.sr-only');

            // Show the spinner
            spinner.classList.remove('d-none');

            // Disable the button
            button.disabled = true;

            var elements = [{
                    id: 'faces',
                    input: 'wajah-input'
                },
                {
                    id: 'neck',
                    input: 'leher-input'
                },
                {
                    id: 'breast',
                    input: 'dada-input'
                }
            ];

            var promises = elements.map(function(element) {
                var node = document.getElementById(element.id);
                var checkmarksContainer = document.getElementById(element.id + '-check');

                if (node && checkmarksContainer && checkmarksContainer.children.length > 0) {
                    return domtoimage.toPng(node)
                        .then(function(dataUrl) {
                            document.getElementById(element.input).value = dataUrl;
                        })
                        .catch(function(error) {
                            console.error('oops, something went wrong with ' + element.id, error);
                            return null;
                        });
                } else {
                    console.log('No checklist found in element with ID ' + element.id +
                        ', skipping conversion.');
                    return Promise.resolve(null);
                }
            });

            Promise.all(promises).then(function() {
                document.getElementById('upload-form').submit();
            });
        });
    </script>
@endsection
