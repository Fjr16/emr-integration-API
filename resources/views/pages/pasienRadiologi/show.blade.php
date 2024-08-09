@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif
@if (session()->has('error'))
      <div class="alert alert-danger w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('error') }}
      </div>
  @endif
  <div class="card">
    <div class="card-header">
      <div class="d-flex justify-content-between">
        <div class="">
          <h5 class="m-0">Hasil Permintaan Radiologi Pasien
            <span class="text text-primary text-uppercase fw-bold fs-7">{{ $item->queue->patient->name ?? ''}} ({{ $item->queue->patient->no_rm ?? }})</span>
          </h5>
          <h6 class="fw-bold mt-2">
            Status: 
            @if ($item->status == 'ACCEPTED')
              <span class="badge bg-primary ms-1">MENUNGGU HASIL</span>
            @elseif($item->status == 'ONGOING')
              <span class="badge bg-danger ms-1">BELUM DIVALIDASI</span>
            @else
              <span class="badge bg-success ms-1">SUDAH VALIDASI</span>
            @endif
          </h6>
        </div>
        <div class="">
          <a href="{{ route('radiologi/patient/queue.index') }}" class="btn btn-sm btn-outline-danger"><i class="bx bx-left-arrow"></i> Kembali</a>
        </div>
      </div>
    </div>
    <div class="card-body">
      <table class="table">
        <thead>
          <tr class="text-nowrap bg-dark">
            <th>Action</th>
            <th>Tanggal / Jam</th>
            <th>Petugas</th>
            <th>Nama Pemeriksaan</th>
            <th>Hasil Gambar</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($item->radiologiFormRequestDetails as $detail)    
          <tr>
            <td>
              <div class="btn-group dropdown">
                <button type="button" class="btn btn-dark btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class='bx bx-info-circle me-2'></i>Action
                </button>
                <div class="dropdown-menu">
                  @if ($item->status != 'FINISHED') 
                    <li>
                      <button class="dropdown-item" onclick="createHasil({{ $detail->id }})">
                          <i class="bx bx-cloud-upload me-1"></i>
                          Input / Edit Hasil
                      </button>
                    </li>
                  @endif
                  <a class="dropdown-item" target="_blank" href="{{ route('radiologi/patient/hasil.show', $detail->id) }}">
                      <i class="bx bx-printer me-1"></i>
                      Print
                  </a>
                </div>
              </div>
            </td>
            <td>{{ $detail->tanggal_periksa ?? '-' }}</td>
            <td>{{ $detail->user->name ?? '-' }}</td>
            <td>{{ $detail->action->name ?? '' }}</td>
            <td>
              @if ($detail->image)
                <a href="{{ Storage::url($detail->image) }}" target="_blank">
                  <img src="{{ Storage::url($detail->image) }}" alt="{{ $detail->image ?? '' }}" width="100" height="100">
                </a>
              @else
                <img src="{{ asset('assets/img/exception_icon/photo.png') }}" alt="" width="50" height="50">
              @endif
            </td>           
          </tr>

          {{-- modal input hasil --}}
          <div class="modal fade" id="largeModal_{{ $detail->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <form action="" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Input Hasil Pemeriksaan <span class="text-primary">({{ $detail->action->name ?? '' }})</span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="row mb-3">
                      <label for="name" class="col-form-label col-3">No. RM / Name</label>
                      <div class="col-9">
                        <input type="text" id="name" value="{{ $item->queue->patient->no_rm ?? }} / {{ $item->queue->patient->name ?? '' }}" class="form-control" disabled>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="jenis-kelamin" class="col-form-label col-3">Jenis Kelamin</label>
                      <div class="col-9">
                        <input type="text" id="jenis-kelamin" value="{{ $item->queue->patient->jenis_kelamin ?? '' }}" class="form-control" disabled>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col">
                        <label for="" class="form-label">Hasil Pemeriksaan</label>
                        <textarea class="form-control ckeditor" id="ckeditor1" rows="2" name="hasil">{!! $detail->hasil ?? '' !!}</textarea>
                      </div>
                    </div>
                      <div class="mb-3">
                        <label for="formFileMultiple" class="form-label">Upload Gambar Pemeriksaan</label>
                        <input class="form-control" type="file" name="image" id="formFileMultiple" multiple>
                        
                        @if ($detail->status == 'UNVALIDATE')      
                        <div class="mt-3 col-sm-12">
                          <h6>Gambar Saat Ini:</h6>
                          @if ($detail->image)
                              <img src="{{ Storage::url($detail->image) }}" alt="{{ $detail->image }}" width="200" height="200">
                          @else
                            <img src="{{ asset('assets/img/exception_icon/photo.png') }}" alt="" width="100" height="100">
                          @endif
                        </div>
                        @endif
                      </div>
                  </div>
                  <div class="modal-footer">
                    <input type="hidden" name="status" value="UNVALIDATE">
                    <button type="submit" class="btn btn-primary btn-sm">{{ $detail->status == 'WAITING' ? 'Submit' : 'Update' }}</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          {{-- /modal input hasil --}}

          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  
  <script>
    function createHasil(id){
      var popUp = document.getElementById('largeModal_'+id);
      var form = popUp.querySelector('form');
      form.setAttribute('action', "{{ route('radiologi/patient/hasil.update', '') }}/"+id);
      $(popUp).modal('show');
    }
  </script>

  @section('script')    
    <script>
      editorIds = document.querySelectorAll('.ckeditor');
      editorIds.forEach(function(editorId){
        ClassicEditor
          .create(editorId, {
            toolbar: {
              items: ['|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList'],
            },
            language: 'en',
          })
          .catch(function(error) {
            console.error(error);
          });
      })
  </script>
  @endsection

@endsection