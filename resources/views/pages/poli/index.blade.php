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

<div class="card-body">
  <div class="nav-align-top mb-2 shadow-sm">
    <ul class="nav nav-tabs nav-md" role="tablist">
      <li class="nav-item">
        <button id="btn-link" type="button" class="nav-link {{ session('navPoli') == 'poliklinik' ? 'active' : '' }} d-flex justify-content-center"
        role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-poliklinik"
        aria-controls="navs-justified-poliklinik" aria-selected="false">
        <p class="m-0">Daftar Poli & Dokter</p>
        </button>
      </li>
      <li class="nav-item">
        <button id="btn-link" type="button" class="nav-link {{ session('navPoli') == 'jadwal' ? 'active' : '' }} d-flex justify-content-center"
        role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-jadwal"
        aria-controls="navs-justified-jadwal" aria-selected="false">
        <p class="m-0">Jadwal Poli</p>
        </button>
      </li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane fade {{ session('navPoli') == 'poliklinik' ? 'show active' : '' }}" id="navs-justified-poliklinik" role="tabpanel">
        <div class="text-end mb-3">
          <a href="{{ route('poliklinik.create') }}" class="btn btn-success ms-auto btn-sm m-0">+ Tambah Poli</a>
        </div>
        @foreach ($data as $item)    
          <div class="accordion accordion-header-primary" id="accordionStyle{{ $loop->iteration ?? '' }}">
            <div class="accordion-item card border">
                <h2 class="accordion-header">
                    <button type="button" class="accordion-button collapsed text-uppercase" data-bs-toggle="collapse" data-bs-target="#accordionStyle{{ $loop->iteration }}-1" aria-expanded="false">
                    {{ $item->kode ?? '' }} - {{ $item->name ?? '' }} ({{ $item->kode_antrian ?? '' }})
                    </button>
                </h2>
            
                <div id="accordionStyle{{ $loop->iteration }}-1" class="accordion-collapse collapse" data-bs-parent="#accordionStyle1">
                    <div class="accordion-body">
                      <div class="text-end mb-3 d-flex">
                        <a class="btn btn-outline-warning ms-auto btn-sm m-0 p-1 me-2" href="{{ route('poliklinik.edit', $item->id) }}"><i class="bx bx-edit-alt me-1"></i></a>
                        <form action="{{ route('poliklinik.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger ms-auto btn-sm p-1 m-0"
                                onclick="return confirm('Yakin ingin menghapus data?')"><i
                                    class="bx bx-trash me-1"></i></button>
                        </form>
                      </div>
                        <div class="table-responsive">
                            <table class="table">
                              <thead>
                                <tr>
                                  <th class="text-dark">Dokter</th>
                                  <th class="text-dark">Tarif</th>
                                </tr>
                              </thead>
                              <tbody class="table-border-bottom-0">
                                @foreach ($item->doctorPolis as $pivot)    
                                  <tr>
                                      <td>{{ ($pivot->user->staff_id ?? '') . ' / ' . ($pivot->user->name ?? '') }}</td>
                                      <td>{{ $pivot->tarif ?? '0' }}</td>
                                  </tr>
                                @endforeach
                                    
                              </tbody>
                            </table>
                          </div>
                    </div>
                </div>
            </div>
          </div>
        @endforeach
      </div>
      <div class="tab-pane fade {{ session('navPoli') == 'jadwal' ? 'show active' : '' }}" id="navs-justified-jadwal" role="tabpanel">
        <div class="table-responsive text-nowrap">
          <table class="table">
            <thead>
              <tr class="text-nowrap bg-dark">
                <th>No</th>
                <th>Poli / Dokter</th>
                <th>Hari</th>
                <th>Waktu</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($dataPoliDokter as $item)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td style="width: 40%">{{ ($item->poli->name) .' / ' . ($item->user->name ?? '') }}</td>
                <td colspan="2" class="p-0">
                  <table class="table">
                      @foreach ($item->doctorSchedules as $jadwal)
                      <tr>
                        <td style="width: 25%">
                          {{ $jadwal->day ?? '-' }}
                        </td>
                        <td style="width: 20%">
                          {{ ($jadwal->start_at ?? '00:00'). ' - ' . ($jadwal->ends_at ?? '00:00') }}
                        </td>
                      </tr>
                      @endforeach
                  </table>
                </td>
                <td>
                    <a href="{{ route('dokter/jadwal.create', $item->id) }}" class="btn btn-outline-primary btn-sm"><i class='bx bx-calendar-plus'></i></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
</div>

@endsection