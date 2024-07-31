@extends('layouts.backend.main')

@section('content')
    @if (session()->has('success'))
    <div class="alert alert-success d-flex" role="alert">
        <span class="alert-icon rounded-circle"><i class='bx bxs-check-circle' style="font-size: 40px"></i></span>
        <div class="d-flex flex-column ps-1">
            <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">BERHASIL !!</h6>
            <span>{{ session('success') }}</span>
        </div>
    </div>
    @endif
    @if (session()->has('error'))
    <div class="alert alert-danger d-flex" role="alert">
        <span class="alert-icon rounded-circle"><i class='bx bxs-x-circle' style="font-size: 40px"></i></span>
        <div class="d-flex flex-column ps-1">
            <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">ERROR !!</h6>
            <span>{{ session('error') }}</span>
        </div>
    </div>
    @endif
    @if (session()->has('errors'))
    <div class="alert alert-danger d-flex" role="alert">
        <span class="alert-icon rounded-circle"><i class='bx bxs-x-circle' style="font-size: 40px"></i></span>
        <div class="d-flex flex-column ps-1">
            <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">ERROR !!</h6>
            <span>
            @foreach (session('errors') as $err)
                {{ $err ?? '' }} <br>
            @endforeach
            </span>
        </div>
    </div>
    @endif
    
    <div class="card p-3 mt-5">
        <div class="d-flex">
            <h4 class="align-self-center m-0">Registrasi Ulang Antrian</h4>
        </div>
        <hr class="m-0 mt-2 mb-3">
        <div class="table-responsive text-wrap py-2">
            <table class="table">
                <thead>
                    <tr class="text-nowrap bg-dark">
                        <th class="text-center">Action</th>
                        <th class="text-center">Status antrian</th>
                        <th>No Antrian</th>
                        <th>Norm</th>
                        <th>Tanggal Berobat</th>
                        <th>Nama</th>
                        <th>Poli / Dokter</th>
                        <th>No Kartu BPJS</th>
                        {{-- <th>Diagnosa Rujukan</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td class="text-center">
                                @if ($item->status_antrian == 'WAITING')
                                    <div class="btn-group dropend">
                                        <button type="button" class="btn btn-dark btn-sm dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class='bx bx-info-circle'></i> Registrasi Ulang</button>
                                        <div class="dropdown-menu">
                                            <button class="dropdown-item text-success" onclick="registerQueue({{ $item->id }})"><i class="bx bx-check"></i> Konfirmasi</button>
                                            <form action="{{ route('antrian/konfirmasi.store', $item->id) }}" class="d-inline"
                                                method="POST">
                                                @csrf
                                                <button class="dropdown-item text-danger" name="status_antrian"
                                                    value="CANCEL"
                                                    onclick="return confirm('Apakah Anda Yakin Ingin Membatalkan Antrian ?')"><i class="bx bx-x"></i> Batal</button>
                                            </form>
                                        </div>
                                    </div>
                                @elseif ($item->status_antrian == 'CANCEL')
                                    <span class="badge bg-danger"><i class="bx bx-x"></i></span>
                                @else     
                                    @if ($item->rajalGeneralConsent)
                                        <div class="d-flex flex-row">
                                        {{-- <a class="btn btn-warning btn-sm" href="{{ route('rajal/general/consent.edit', $item->id) }}">
                                            <i class='bx bx-edit-alt me-1'></i>
                                        </a>
                                        <form action="{{ route('rajal/general/consent.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm mx-2"
                                                onclick="return confirm('Yakin ingin menghapus data?')"><i
                                                    class="bx bx-trash me-1"></i></button>
                                        </form> --}}
                                        <div class="btn-group dropend">
                                            <button type="button" class="btn btn-dark btn-sm dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class='bx bx-info-circle'></i> General Consent
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item text-warning" href="{{ route('rajal/general/consent.edit', $item->id) }}">
                                                    <i class='bx bx-edit-alt me-1'></i> General Consent
                                                </a>
                                                <form action="{{ route('rajal/general/consent.destroy', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger"
                                                        onclick="return confirm('Yakin ingin menghapus data?')"><i
                                                            class="bx bx-trash me-1"></i> General Consent
                                                    </button>
                                                </form>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="{{ route('rajal/general/consent.show', $item->id ?? '') }}" target="_blank">
                                                    <i class='bx bx-printer me-1'></i>
                                                    General Consent
                                                </a>
                                                <a class="dropdown-item" href="{{ route('rajal/general/consent.showtatatertib', $item->id ?? '') }}" target="_blank">
                                                    <i class='bx bx-printer me-1'></i>
                                                    Tata Tertib
                                                </a>
                                                <a class="dropdown-item" href="{{ route('rajal/general/consent.showhakdankewajiban', $item->id) }}" target="_blank">
                                                    <i class='bx bx-printer me-1'></i>
                                                    Hak Dan Kewajiban
                                                </a>
                                            </div>
                                        </div>
                                        </div>
                                    @else
                                        <a class="btn btn-success btn-sm mx-2"
                                            href="{{ route('rajal/general/consent.create', $item->id) }}">
                                            <i class='bx bx-plus me-1'></i>
                                        </a>
                                    @endif
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($item->status_antrian == 'WAITING')
                                    <span class="badge bg-warning">BELUM DILAYANI</span>
                                @elseif ($item->status_antrian == 'CANCEL')
                                    <span class="badge bg-danger">ANTRIAN BATAL</span>
                                @elseif($item->status_antrian == 'ARRIVED')
                                    <span class="badge bg-primary">SEDANG DILAYANI</span>
                                @else
                                    <span class="badge bg-success">SUDAH DILAYANI</span>
                                @endif
                            </td>
                            <td>{{ $item->no_antrian ?? '' }}</td>
                            <td>{{ implode('-', str_split(str_pad($item->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}
                            </td>
                            @php
                                $tglAntrian = new DateTime($item->tgl_antrian);
                            @endphp
                            <td>{{ $tglAntrian->format('d-m-Y') ?? '' }}</td>
                            <td>{{ $item->patient->name }}</td>
                            <td>{{ $item->dpjp->poliklinik->name ?? '' }} /
                                {{ $item->dpjp->name ?? '' }}</td>
                            <td>
                                @if ($item->patient->noka)
                                    {{ $item->patient->noka ?? '---' }}
                                @else 
                                    <span class="badge bg-danger"><i class="bx bx-x"></i></span>
                                @endif
                            </td>
                            {{-- <td>{{ $item->last_diagnostic ?? '-' }}</td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="openModal" data-bs-backdrop="static" tabindex="-1">

    </div>

    <script>
        function registerQueue(id) {
            $.ajax({
                type: 'get',
                url: "{{ route('antrian/konfirmasi.edit', '') }}/" + id,
                success: function(data) {
                    var div = document.createElement('div');
                    div.className = 'modal-dialog modal-lg';
                    div.innerHTML = data;

                    $('#openModal').html(div);
                    $('#openModal').modal('show');
                }
            })
        }
    </script>
@endsection
