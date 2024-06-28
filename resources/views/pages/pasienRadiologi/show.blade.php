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
      <h5 class="m-0">Hasil Permintaan Radiologi Pasien
        <span class="text text-primary text-uppercase fw-bold fs-7">{{ $item->patient->name ?? ''}} ({{ implode('-', str_split(str_pad($item->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }})</span>
      </h5>
    </div>
    <div class="card-body">
      <table class="table">
        <thead>
          <tr class="text-nowrap bg-dark">
            @canany(['input hasil pemeriksaan radiologi', 'print hasil pemeriksaan radiologi'])
            <th>Action</th>
            @endcanany
            <th>Status</th>
            <th>Tanggal / Jam</th>
            <th>Petugas</th>
            <th>Nama Pemeriksaan</th>
            <th>Hasil Gambar</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($item->radiologiFormRequestDetails as $detail)    
          <tr>
            @canany(['input hasil pemeriksaan radiologi', 'print hasil pemeriksaan radiologi'])
            <td>
              <div class="dropdown">
                <button type="button" class="btn bth-sm btn-success dropdown-toggle hide-arrow"
                    data-bs-toggle="dropdown">
                    Action
                    <i class='bx bx-dots-vertical'></i>
                </button>
                <div class="dropdown-menu">
                  @if ($item->status != 'FINISHED')   
                  <button class="dropdown-item" onclick="createHasil({{ $detail->id }})">
                      <i class="bx bx-cloud-upload me-1"></i>
                      Edit
                  </button>
                  @endif
                  @can('print hasil pemeriksaan radiologi')  
                  <a class="dropdown-item" href="{{ route('radiologi/patient/hasil.show', $detail->id) }}">
                      <i class="bx bx-printer me-1"></i>
                      Print
                  </a>
                  @endcan
                </div>
              </div>
            </td>
            @endcanany
            <td>
              <form action="{{ route('radiologi/patient/hasil.update', $detail->id) }}" method="POST">
              @csrf
              @method('PUT')
                @if ($detail->status == 'WAITING')
                  <button class="btn btn-sm btn-dark" disabled>{{ $detail->status }}</button>
                @elseif($detail->status == 'UNVALIDATE')
                  <button type="submit" class="btn btn-sm btn-danger" name="status" value="VALIDATE">{{ $detail->status }}</button>
                @else
                  <button class="btn btn-sm btn-success" disabled>{{ $detail->status }}</button>
                @endif
              </form>
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
                      <label for="name" class="col-form-label col-3">Name</label>
                      <div class="col-9">
                        <input type="text" id="name" value="{{ $item->patient->name ?? '' }}" class="form-control" disabled>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="jenis-kelamin" class="col-form-label col-3">Jenis Kelamin</label>
                      <div class="col-9">
                        <input type="text" id="jenis-kelamin" value="{{ $item->patient->jenis_kelamin ?? '' }}" class="form-control" disabled>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="norm" class="col-form-label col-3">No RM</label>
                      <div class="col-9">
                        <input type="text" id="norm" value="{{ implode('-', str_split(str_pad($item->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}" class="form-control" disabled>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="tanggal" class="col-form-label col-3">Tanggal Pemeriksaan</label>
                      <div class="col-9">
                        <input type="datetime-local" id="tanggal" name="tanggal_periksa" value="{{ $detail->tanggal_periksa ?? $today }}" class="form-control">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col">
                        <label for="" class="form-label">Hasil Pemeriksaan</label>
                        <textarea class="form-control ckeditor" id="ckeditor1" rows="2" name="hasil">{!! $detail->hasil ?? '' !!}</textarea>
                      </div>
                    </div>
                    <div class="mb-3">
                      <label for="formFileMultiple" class="form-label">Upload File Pemeriksaan</label>
                      <input class="form-control" type="file" name="image" id="formFileMultiple" multiple>
                      <div class="mt-3 col-sm-12">
                        <h6>Gambar Saat Ini:</h6>
                        @if ($detail->image)
                            <img src="{{ Storage::url($detail->image) }}" alt="{{ $detail->image }}" width="200" height="200">
                        @else
                          <img src="{{ asset('assets/img/exception_icon/photo.png') }}" alt="" width="100" height="100">
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <input type="hidden" name="status" value="UNVALIDATE">
                    <button type="submit" class="btn btn-success btn-sm">Simpan</button>
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