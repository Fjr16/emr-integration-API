@extends('layouts.backend.main')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div id="success-message"></div>
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Tambah Permintaan Laboratorium</h5>
            <button type="button" class="btn btn-sm btn-success" onclick="history.back()" >Kembali</button>
        </div>
        <form action="{{ route($routeStore, $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="row mb-3">
                            <label for="nama_pasien" class="col-form-label col-3">Nama Pasien</label>
                            <div class="col-9">
                                <input class="form-control" type="text" value="{{ $item->patient->name ?? '' }}" disabled />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="tanggal_lahir" class="col-form-label col-3">Tanggal Lahir</label>
                            <div class="col-9">
                                <input class="form-control" type="date" value="{{ $item->patient->tanggal_lhr ?? '' }}" disabled />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="no_rm" class="col-form-label col-3">No RM</label>
                            <div class="col-9">
                                <input class="form-control" type="text" value="{{ implode('-', str_split(str_pad($item->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}" disabled />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="diagnosa" class="col-form-label col-3">Diagnosa</label>
                            <div class="col-9">
                                <textarea class="form-control" type="text" name="diagnosa" id="editor">{!! $diagnosa !!}</textarea>
                                {{-- <textarea class="form-control" name="diagnosa" id="editor">{!! $diagnosa ?? '' !!}</textarea> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row mb-3">
                            <label for="tanggungan" class="col-form-label col-3">Tanggungan</label>
                            <div class="col-9">
                                <input class="form-control" type="text" value="{{ $item->patientCategory->name ?? '' }}" disabled />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="ruang" class="col-form-label col-3">Ruangan</label>
                            <div class="col-9">
                                @if ($currentRouteName == 'rajal/laboratorium/request.index')
                                    <input class="form-control" type="text" name="ruang" value="{{ $item->doctorPatient->user->roomDetail->room->name ?? '' }}" readonly/>
                                @else
                                    <input class="form-control" type="text" name="ruang" value="{{ $room->name ?? '' }}" readonly/>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="detail-ruang" class="col-form-label col-3">Detail Ruangan</label>
                            <div class="col-9">
                                <select name="room_detail_id" class="form-select" id="">
                                    <option disabled selected>Pilih</option>
                                    @foreach ($roomDetails as $detail)
                                    @if (old('room_detail_id', $item->doctorPatient->user->roomDetail->id) == $detail->id)
                                        <option value="{{ $detail->id }}" selected>{{ $detail->name ?? '' }}</option>
                                    @else
                                        <option value="{{ $detail->id }}">{{ $detail->name ?? '' }}</option>
                                    @endif
                                        
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="laboratorium_request_type_master_id-ruang" class="col-form-label col-3">Kategori Permintaan</label>
                            <div class="col-9">
                                <select name="laboratorium_request_type_master_id" class="form-select" id="">
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}" {{ $type->name == 'Reguler' ? 'selected' : '' }}>{{ $type->name ?? '' }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="tanggal" class="col-form-label col-3">Tanggal Pengambilan Sampel</label>
                            <div class="col-9">
                                <input class="form-control" type="date" value="{{ date('Y-m-d') }}" name="tanggal" id="tanggal" />
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row mb-3 mt-4">
                    @foreach ($data as $item)    
                    <div class="col-3">
                        <input type="checkbox" id="laboratorium_request_category_master_{{ $item->id }}" class="m-0 form-check-input" onclick="checkAllVariables({{ $item->id }})"/>
                        <label for="laboratorium_request_category_master_{{ $item->id }}"><h6 class="mb-3 fw-bold text-center">{{ $item->name ?? '' }}</h6></label>
                        <div class="mb-3 mx-2">
                            @if ($item->laboratoriumRequestMasterVariables)
                                @foreach ($item->laboratoriumRequestMasterVariables as $variabel)
                                <div class="form-check mt-1">
                                    <input type="checkbox" name="laboratorium_request_master_variable_id[]" id="{{ $variabel->id ?? '' }}" value="{{ $variabel->id }}" class="form-check-input" onclick="removeCheckCategory({{ $variabel->id }})"/>
                                    <label class="form-check-label m-0" for="{{ $variabel->id ?? '' }}">
                                    {{ $variabel->name ?? '' }}
                                    </label>
                                </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="row mb-3">
                    <label for="catatan" class="col-form-label col-1">Catatan</label>
                    <div class="col-11">
                        <textarea class="form-control" type="text" name="catatan" id="editor">{!! $catatan ?? '' !!}</textarea>
                        {{-- <textarea class="form-control" name="diagnosa" id="editor">{!! $diagnosa ?? '' !!}</textarea> --}}
                    </div>
                </div>
                <div class="mb-3 text-end">
                    <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                </div>
               
            </div>
        </form>
    </div>

    <script>
        function checkAllVariables(category_id){
            $.ajax({
                type : 'get',
                url : "{{ route('rajal/laboratorium/request.edit', '') }}/"+category_id,
                success:function(data){
                    if($('#laboratorium_request_category_master_'+category_id).prop('checked')){
                        data.forEach(variable_id => {
                            $('#'+variable_id).prop('checked', true);
                        });
                    }else{
                        data.forEach(variable_id => {
                            $('#'+variable_id).prop('checked', false);
                        });
                    }
                    
                }
            });
        }

        function removeCheckCategory(variabel_id){
            $.ajax({
                type : 'get',
                url : "{{ route('rajal/laboratorium/request.uncheckCategory', '') }}/"+variabel_id,
                success:function(category_id){
                    if(!$('#'+variabel_id).prop('checked')){
                        $('#laboratorium_request_category_master_'+category_id).prop('checked', false);
                    }
                }
            });
        }
    </script>
@endsection

