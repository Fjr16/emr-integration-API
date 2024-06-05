@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif
  <div class="card">
    <div class="card-header">
      <h5 class="m-0">Input Hasil Pemeriksaan</h5>
    </div>
    <form action="{{ route('laboratorium/patient/hasil.store', $item->id) }}" method="POST">
    @csrf
      <div class="card-body">
        <div class="row">
          <div class="col-6">
            <div class="row mb-3">
              <label for="name" class="col-form-label col-3">Name</label>
              <div class="col-9">
                <input type="text" id="name" value="{{ $item->queue->patient->name ?? '' }}" class="form-control" disabled>
              </div>
            </div>
            <div class="row mb-3">
              <label for="tgl_lhr" class="col-form-label col-3">Tanggal Lahir</label>
              <div class="col-9">
                <input type="date" id="tgl_lhr" value="{{ $item->queue->patient->tanggal_lhr  ?? ''}}" class="form-control" disabled>
              </div>
            </div>
            <div class="row mb-3">
              <label for="norm" class="col-form-label col-3">No RM</label>
              <div class="col-9">
                <input type="text" id="norm" value="{{ implode('-', str_split(str_pad($item->queue->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}" class="form-control" disabled>
              </div>
            </div>
            <div class="row mb-3">
              <label for="nik" class="col-form-label col-3">NIK</label>
              <div class="col-9">
                <input type="text" id="nik" value="{{ $item->queue->patient->nik ?? '' }}" class="form-control" disabled>
              </div>
            </div>
            <div class="row mb-3">
              <label for="diagnosa" class="col-form-label col-3">Diagnosa</label>
              <div class="col-9">
                <input type="text" id="diagnosa" value="{{ $item->laboratoriumRequest->diagnosa ?? '' }}" class="form-control" disabled>
              </div>
            </div>
    
          </div>
          <div class="col-6">
            <div class="row mb-3">
              <label for="nolabor" class="col-form-label col-3">No. Reg. Labor</label>
              <div class="col-9">
                <input type="text" id="nolabor" class="form-control" name="nomor" value="{{ $noRegLab }}" readonly>
              </div>
            </div>
            <div class="row mb-3">
              <label for="tanggal" class="col-form-label col-3">Tanggal Periksa</label>
              <div class="col-9">
                <input type="date" id="tanggal" value="{{ $item->tanggal_periksa ?? '' }}" class="form-control" disabled>
              </div>
            </div>
            <div class="row mb-3">
              <label for="exampleFormControlSelect1" class="col-form-label col-3">Tanggungan</label>
              <div class="col-sm-9">
                <input type="text" id="tanggungan" value="{{ $item->queue->patientCategory->name ?? '' }}" class="form-control" disabled>
              </div>
            </div>
            <div class="row mb-3">
              <label for="exampleFormControlSelect2" class="col-form-label col-3">Ruangan</label>
              <div class="col-sm-9">
                <input type="text" id="ruang" value="{{ $item->laboratoriumRequest->ruang ?? '' }}" class="form-control" disabled>
              </div>
            </div>
            <div class="row mb-3">
              <label for="exampleFormControlSelect2" class="col-form-label col-3">Detail Ruangan</label>
              <div class="col-sm-9">
                <input type="text" id="ruang" value="{{ $item->laboratoriumRequest->roomDetail->name ?? '' }}" class="form-control" disabled>
              </div>
            </div>
            <div class="row mb-3">
              <label for="exampleFormControlSelect2" class="col-form-label col-3">Tipe Permintaan</label>
              <div class="col-sm-9">
                <input type="text" id="ruang" value="{{ $item->laboratoriumRequest->laboratoriumRequestTypeMaster->name ?? '' }}" class="form-control" disabled>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-4">
          @foreach ($dataKategori as $itemCategory)
            @if (in_array($itemCategory->id, $categoryIds))    
              <div class="col-6 mb-5">
                <h6 class="m-0">{{ $itemCategory->name ?? '' }}</h6>
                <table class="table">
                  <tbody>
                    @foreach ($item->laboratoriumRequest->laboratoriumRequestDetails as $index => $detail)
                        @if ($detail->laboratoriumRequestMasterVariable->laboratoriumRequestCategoryMaster)
                          @if ($detail->laboratoriumRequestMasterVariable->laboratoriumRequestCategoryMaster->id == $itemCategory->id)
                            <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $detail->laboratoriumRequestMasterVariable->name ?? '' }}</td>
                              @if ($detail->laboratoriumRequestMasterVariable->laboratoriumRequestMasterDetails->isEmpty())    
                                <td colspan="2">
                                  <input type="hidden" class="form-control form-control-sm"  name="data[{{ $index }}][laboratorium_request_master_variable_id]" value="{{ $detail->laboratoriumRequestMasterVariable->id }}">
                                  <textarea class="form-control form-control-sm" name="data[{{ $index }}][hasil]" rows="1"></textarea>
                                </td>
                              @else
                                <td>
                                  <input type="hidden" class="form-control form-control-sm"  name="data[{{ $index }}][laboratorium_request_master_variable_id]" value="{{ $detail->laboratoriumRequestMasterVariable->id }}">
                                  <input type="text" id="hasil{{ $detail->laboratoriumRequestMasterVariable->id }}" class="form-control form-control-sm" name="data[{{ $index }}][hasil]" onchange="checkKondisiKritis({{ $detail->laboratoriumRequestMasterVariable->id }}, '{{ $item->queue->patient->jenis_kelamin }}')">
                                </td>
                                <td>
                                    @foreach ($detail->laboratoriumRequestMasterVariable->laboratoriumRequestMasterDetails as $detailMaster)
                                    @php
                                      $from = $detailMaster->from ?? '';
                                      $to = $detailMaster->to ?? '';
                                      $digitFrom = strlen((string) $detailMaster->from);
                                      $digitTo = strlen((string) $detailMaster->to);
                                      if ($digitFrom >= 4){
                                        $from = number_format($detailMaster->from);
                                      }
                                      if ($digitTo >= 4){
                                        $to = number_format($detailMaster->to);
                                      }
                                    @endphp
                                      <small>
                                        ({{ $detailMaster->alias ? $detailMaster->alias .':' : '' }}{{ $from ?? '' }}-{{ $to ?? '' }} {{ $detailMaster->unit ?? '' }})
                                      </small> <br>
                                    @endforeach
                                </td>
                              @endif
                            </tr>
                          @endif
                        @endif
                    @endforeach
                  </tbody>
                </table>
              </div>
            @endif
          @endforeach
          <div class="col-6">
            <table class="table table-bordered mt-0">
              <tbody>
                <tr>
                  <td colspan="2">Kesan</td>
                  <td colspan="2">
                    <textarea name="kesan" class="form-control form-control-sm" cols="5" rows="1"></textarea>
                  </td>
                </tr>
                <tr>
                  <td colspan="2">Anjuran</td>
                  <td colspan="2">
                    <textarea name="anjuran" class="form-control form-control-sm" cols="5" rows="1"></textarea>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="col-6">
            <table class="table table-bordered mt-0">
              <tbody>
                <tr>
                  <td>Tanggal Pengambilan Sampel</td>
                  <td>
                    <input type="datetime-local" id="tgl-pengambilan-sampel" class="form-control form-control-sm" name="tgl_ambil_sampel" value="{{ $item->laboratoriumRequest->tanggal ?? '' }}" >
                  </td>
                </tr>
                <tr>
                  <td>Tanggal Pemeriksaan Selesai</td>
                  <td>
                    <input type="datetime-local" id="tgl-pemeriksaan-selsai" class="form-control form-control-sm" name="tgl_periksa_selesai" >
                  </td>
                </tr>
              </tbody>
            </table>
            <h6 class="mt-3 mb-2 fst-underline">CATATAN PELAPORAN NILAI KRITIS</h6>
            <table class="table">
              <tbody id="kondisi-kritis">
                <tr>
                  <td>Nilai Kritis</td>
                  <td colspan="4">
                    <input type="text" id="nilai-kritis" class="form-control form-control-sm" disabled >
                  </td>
                </tr>
                <tr>
                  <td>Dilaporkan ke DPJP / Dokter Yang Membuat Permintaan</td>
                  <td>Jam</td>
                  <td>
                    <input type="time" id="jam" class="form-control form-control-sm" value="{{ $today->format('H:i') }}" name="jam_pelaporan_kritis" >
                  </td>
                  <td>Nama</td>
                  <td>
                    <input type="text" id="nama" class="form-control form-control-sm" value="{{ $item->laboratoriumRequest->user->name ?? '' }}" disabled>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="mt-4 text-end">
          <button type="submit" class="btn btn-success btn-sm">Simpan</button>
        </div>
      </div>
    </form>
  </div>


  <script>
    function checkKondisiKritis(id, jk){
      var laboratorium_request_master_variable_id = id;
      var hasil = $('#hasil' + id).val();
      var nilaiKritis = $('#nilai-kritis').val();
      var separator = ', ';
      if(jk == 'Pria'){
        var jkPatient = 'Laki-Laki';
      }else if(jk == 'Wanita'){
        var jkPatient = 'Perempuan';
      }
      
      $.ajax({
        type : 'get',
        url : "{{ route('laboratorium/patient/queue.show', '') }}/"+id,
        success:function(item){
          var tbody = $('#kondisi-kritis');
          var findTr = $('#tr'+item.id) ?? '';
          var count = item.laboratorium_request_master_details.length;
          if(count == 1){
            var from = item.laboratorium_request_master_details[0].from;
            var to = item.laboratorium_request_master_details[0].to;
            if(hasil >= from && hasil <= to){
              if(findTr.length !== 0){
                //delete list id variabel nilai kritis
                $('#tr'+item.id).remove();
  
                //delete list name nilai kritis
                $('#hasil' + item.id).removeClass('border border-danger');
                if(nilaiKritis.includes(separator + item.name)){
                  nilaiKritis = nilaiKritis.replace(separator + item.name, '');
                }else if (nilaiKritis.includes(item.name + separator)){
                  nilaiKritis = nilaiKritis.replace(item.name + separator, '');
                }else if (nilaiKritis.includes(item.name)){
                  nilaiKritis = nilaiKritis.replace(item.name, '');
                }
                $('#nilai-kritis').val(nilaiKritis);
              }
            }else{
              if(findTr.length === 0){
                //create list id variabel nilai kritis
                var tr = document.createElement('tr');
                tr.id = 'tr' + item.id;
                tr.innerHTML = `<input type="hidden" id="nilai_kritis_variabel_id${item.id}" name="nilai_kritis_variabel_id[]" value="${item.id}"></input>`;
                tbody.append(tr);
  
                //create list name nilai kritis
                $('#hasil' + item.id).addClass('border border-danger');
                if(nilaiKritis){
                  nilaiKritis += separator + item.name;
                }else{
                  nilaiKritis += item.name;
                }
                $('#nilai-kritis').val(nilaiKritis);
              }
            }
          }else if(count >= 1){
            item.laboratorium_request_master_details.forEach(detail => {
              if(detail.name == jkPatient){
                var from = detail.from;
                var to = detail.to;
                if(hasil >= from && hasil <= to){
                  if(findTr.length !== 0){
                    //delete list id variabel nilai kritis
                    $('#tr'+item.id).remove();
  
                    //delete list name nilai kritis
                    $('#hasil' + item.id).removeClass('border border-danger');
                    if(nilaiKritis.includes(separator + item.name)) {
                        nilaiKritis = nilaiKritis.replace(separator + item.name, '');
                    }else if(nilaiKritis.includes(item.name + separator)){
                      nilaiKritis = nilaiKritis.replace(item.name + separator, '');
                    }else if(nilaiKritis.includes(item.name)){
                        nilaiKritis = nilaiKritis.replace(item.name, '');
                    }
                    $('#nilai-kritis').val(nilaiKritis);
                  }
                }else{
                  if(findTr.length === 0){
                    //create list id variabel nilai kritis
                    var tr = document.createElement('tr');
                    tr.id = 'tr' + item.id;
                    tr.innerHTML = `<input type="hidden" id="nilai_kritis_variabel_id${item.id}" name="nilai_kritis_variabel_id[]" value="${item.id}"></input>`;
                    tbody.append(tr);
  
                    //create list name nilai kritis
                    $('#hasil' + item.id).addClass('border border-danger');
                    if(nilaiKritis){
                      nilaiKritis += separator + item.name;
                    }else{
                      nilaiKritis += item.name;
                    }
                    $('#nilai-kritis').val(nilaiKritis);
                  }
                } 
              }
            });
          }
        }
      });      
    }
  </script>
@endsection