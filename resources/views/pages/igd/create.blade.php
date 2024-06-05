@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif
  <div class="d-flex mb-3">
    <h5 class="align-self-center m-0">Tambah Pasien IGD</h5>
    <a href="{{ route('pasien.create', $route) }}" class="btn btn-success ms-auto btn-sm m-0">+ Pasien Baru</a>
  </div>
{{-- <form action="{{ route('antrian.store') }}" method="POST">
  @csrf --}}
  <div class="row">
    <div class="col-6">
      <div class="card mb-4">
        <div class="card-body">
          <div class="mb-3">
            <label for="defaultFormControlInput" class="form-label">No Rekam Medis</label>
            <select class="form-control select2" id="patient_id" name="patient_id" onchange="getPatient()">
              <option value="" selected>Pilih</option>
              @foreach ($patients as $patient)
                @if (old('patient_id') == $patient->id)
                  <option value="{{ $patient->id }}" selected>{{ implode('-', str_split(str_pad($patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }} / {{ $patient->name }}</option>
                @else
                  <option value="{{ $patient->id }}">{{ implode('-', str_split(str_pad($patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }} / {{ $patient->name }}</option>    
                @endif  
              @endforeach
            </select>
          </div>  
          <div class="mb-3">
            <label for="defaultFormControlInput" class="form-label">Nama Pasien</label>
            <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="" aria-describedby="defaultFormControlHelp" value="" />
          </div>
          <div class="mb-3">
            <div class="row">
              <div class="col-8">
                  <label for="defaultFormControlInput" class="form-label">Tempat Lahir</label>
                  <input type="text" class="form-control form-control-sm col-7"
                      id="tempat_lhr" name="tempat_lhr" placeholder=""
                      aria-describedby="defaultFormControlHelp"/>
              </div>
              <div class="col-4">
                  <label for="defaultFormControlInput" class="form-label">Tanggal Lahir</label>
                  <input type="date" class="form-control form-control-sm col-5" id="tanggal_lhr" name="tanggal_lhr" placeholder=""
                      aria-describedby="defaultFormControlHelp"/>
              </div>
            </div>
          </div>
          <div class="mb-3">
            <div class="row">
                <div class="col-5">
                    <label for="exampleFormControlSelect1" class="form-label">Jenis Kelamin</label>
                    <select class="form-select form-select-sm" id="jenis_kelamin"
                        aria-label="Default select example" name="jenis_kelamin">
                        <option selected disabled>Pilih</option>
                        @foreach ($jk as $jk)
                            @if (old('jenis_kelamin') == $jk)
                                <option value="{{ $jk }}" selected>{{ $jk }}</option>
                            @else
                                <option value="{{ $jk }}">{{ $jk }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-7">
                    <label for="exampleFormControlSelect1" class="form-label">Status</label>
                    <select class="form-select form-select-sm" id="status"
                        aria-label="Default select example" name="status">
                        <option selected disabled>Pilih</option>
                        @foreach ($status as $status)
                            @if (old('status') == $status)
                                <option value="{{ $status }}" selected>{{ $status }}</option>
                            @else
                                <option value="{{ $status }}">{{ $status }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
          </div>
          <div class="mb-3">
            <label for="defaultFormControlInput" class="form-label">No Telp</label>
            <input type="number" class="form-control form-control-sm" id="telp" name="telp" placeholder="" aria-describedby="defaultFormControlHelp" value=""/>
          </div>
          <div class="mb-3">
            <label for="defaultFormControlInput" class="form-label">Alamat</label>
            <input type="text" class="form-control form-control-sm"
                placeholder="" id="alamat" name="alamat"
                aria-describedby="defaultFormControlHelp" />
          </div>
        </div>
      </div>
    </div>
    <div class="col-6">
      <div class="card mb-4">
        <div class="card-body">
          <div class="mb-3">
            <label for="defaultFormControlInput" class="form-label">NIK</label>
            <input type="number" class="form-control form-control-sm" id="nik" name="nik" placeholder="" aria-describedby="defaultFormControlHelp" value=""/>
          </div>
          <div class="mb-3">
            <label for="defaultFormControlInput" class="form-label">Penjamin</label>
            <select class="form-control select2" name="patient_category_id">
              @foreach ($categories as $category)
                @if (old('patient_category_id') == $category->id)
                  <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                @else
                  <option value="{{ $category->id }}">{{ $category->name }}</option>    
                @endif  
              @endforeach
            </select>
          </div>  
          <div class="mb-3">
            <label for="defaultFormControlInput" class="form-label">Tanggal Berobat</label>
            <input type="date" class="form-control form-control-sm" value="{{ old('tgl', $now) }}" name="tgl" id="tgl" />
          </div>
          <div class="mb-3">
            <label for="defaultFormControlInput" class="form-label">Poli / Dokter</label>
            <select class="form-control select2" id="doctor_id" name="doctor_id">
              <option value="" selected>Pilih</option>
              @foreach ($doctors as $doctor)
                @if (old('patient_category_id') == $doctor->id)
                  <option value="{{ $doctor->id }}" selected>{{ $doctor->poli->name }} / {{ $doctor->name }}</option>
                @else
                  <option value="{{ $doctor->id }}">{{ $doctor->roomDetail->name }} / {{ $doctor->name }}</option>    
                @endif  
              @endforeach
          </select>
          </div> 
          <div class="mb-3">
            <label for="defaultFormControlInput" class="form-label">No Rujukan / No Kontrol</label>
            <input type="number" class="form-control form-control-sm" id="no_rujukan" name="no_rujukan" placeholder="" aria-describedby="defaultFormControlHelp" onkeyup="showDiagnosa()"/>
          </div>
          <div class="mb-3" id="diagnosa">
            
          </div>
          <button type="button" id="storeModal" class="btn btn-sm btn-dark mb-3" onclick="">Simpan</button>
        </div>
      </div>
    </div>
  </div>
{{-- </form> --}}
<div class="card p-3 mt-5">
  <div class="d-flex">
    <h4 class="align-self-center m-0">Daftar Antrian Pasien</h4>
  </div>
  <hr class="m-0 mt-2 mb-3">
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr class="text-nowrap bg-dark">
          <th>No</th>
          <th>Tgl Berobat</th>
          <th>Nama</th>
          <th>Norm</th>
          <th>Tgl Lahir</th>
          <th>Telp</th>
          <th>Poli</th>
          <th>Penjamin</th>
          <th>No Rujukan / Kontrol</th>
          <th>Diagnosa Terakhir</th>
          <th>Petugas</th>
          <th>status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($activePatients as $active) 
          <tr>
            <th scope="row" class="text-dark">{{ $loop->iteration ?? ''}}</th>
            <td>{{ $active->queue->tgl_antrian ?? ''}}</td>
            <td>{{ $active->queue->patient->name ?? ''}}</td>
            <td>{{ implode('-', str_split(str_pad($active->queue->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2))}}</td>
            <td>{{ $active->queue->patient->tanggal_lhr ?? ''}}</td>
            <td>{{ $active->queue->patient->telp ?? ''}}</td>
            <td>{{ $active->user->roomDetail->name ?? ''}}</td>
            <td>{{ $active->queue->patientCategory->name ?? '' }}</td>
            <td>{{ $active->queue->no_rujukan ?? '--'}}</td>
            <td>{{ $active->queue->last_diagnostic ?? '--'}}</td>
            <td>{{ $active->queue->user->name ?? '' }}</td>
            <td>{{ $active->queue->status_antrian ?? '-'}}</td>
            <td>
              <a class="btn btn-success btn-sm text-white" onclick="showPatient({{ $active->id }})">Lihat</a>
            </td>
          </tr>
        @endforeach
        </tbody>
    </table>
  </div>
</div>

{{--Store modal --}}
<div class="modal fade" id="openStoreModal" data-bs-backdrop="static" tabindex="-1">
  <div class="modal-dialog modal-xl" id="showStoreModal">

  </div>
</div>
{{-- modal --}}
<div class="modal fade" id="backDropModal" data-bs-backdrop="static" tabindex="-1">
  <div class="modal-dialog modal-xl" id="showModal">

  </div>
</div>

<script>
  function getPatient() {
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')}
    });
    $.ajax({
      type : 'post',
      url : "{{ URL::route('antrian/get/pasien.getPasien') }}",
      data : {
        patient_id : $('#patient_id').val()
      }, 
      success: function(data){
        $('#name').val(data.name)
        $('#nik').val(data.nik)
        $('#tempat_lhr').val(data.tempat_lhr)
        $('#tanggal_lhr').val(data.tanggal_lhr)
        $('#jenis_kelamin').val(data.jenis_kelamin)
        $('#status').val(data.status)
        $('#telp').val(data.telp)
        $('#alamat').val(data.alamat)
        var button = document.getElementById('storeModal');
        button.setAttribute('onclick', 'openModal("'+data.id+'")');
      }
    })
  }

  function showPatient(id){
    $.ajax({
      type : 'get',
      url : "{{ route('igd/patient.show', '') }}"+"/"+id,
      success: function(data){
        $('#backDropModal').modal('show');
        $('#showModal').html(data);
      }
    })
  }

  function showDiagnosa(){
    let exist = $('#no_rujukan').val();
    if(exist){
      $('#showdiagnosa').remove();
      $('#diagnosa').append('<div id="showdiagnosa"><label for="defaultFormControlInput" class="form-label">Diagnosa Terakhir</label> <input type="text" class="form-control form-control-sm" name="last_diagnostic" id="last_diagnostic" aria-describedby="defaultFormControlHelp"/> </div>')
    }else{
      $('#showdiagnosa').remove();
    }
  }

  function openModal(id){
    if(id){
      $.ajax({
        type : 'get',
        url : "{{ route('igd/patient.edit', '') }}"+"/"+id,
        data : {
          doctor_id : $('#doctor_id').val(),
          tgl : $('#tgl').val(),
          no_rujukan : $('#no_rujukan').val(),
          last_diagnostic : $('#last_diagnostic').val(),
        },
        success: function(data){
          $('#openStoreModal').modal('show');
          $('#showStoreModal').html(data);
        },
        error: function(xhr, status, error){
          console.log(xhr);
          console.log(status);
          console.log(xhr);
        }
      })
    }
  }
</script>
@endsection

