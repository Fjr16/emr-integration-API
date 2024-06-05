@extends('layouts.backend.main')

@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Tindakan Pelayanan Pasien</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('kemoterapi/tindakan/pelayanan/pasien.store', $item->id) }}">
                @csrf
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Tanggal</label>
                    <div class="col-sm-10">
                        <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" class="form-control" id="basic-default-name">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">lab</label>
                    <div class="col-sm-10">
                        <input type="text" name="lab" class="form-control" id="basic-default-name">
                    </div>
                </div>
                <hr>
                <p class="m-0 mb-1">RONTGENT</p>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">jenis tindakan</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" name="action_members_id" onchange="getBiayaTindakan(this.value, {{ $item->kemoterapiPatient->queue->patientCategory->id }})">
                            <option selected disabled>Pilih</option>
                            @foreach ($tindakans as $tindakan)
                                <option value="{{ $tindakan->id }}">{{ $tindakan->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">biaya</label>
                    <div class="col-sm-10">
                        <input type="text" name="biaya_tindakan" id="biaya_tindakan" class="form-control" id="basic-default-name" readonly >
                    </div>
                </div>
                <hr>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">ecg</label>
                    <div class="col-sm-10">
                        <input type="text" name="ecg" class="form-control" id="basic-default-name">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">tindakan</label>
                    <div class="col-sm-10">
                        <input type="text" name="tindakan" class="form-control" id="basic-default-name">
                    </div>
                </div>
                <hr>
                <p class="m-0 mb-1">KONSUL</p>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Dokter</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" name="user_id" onchange="getBiayaKonsul(this.value, {{ $item->kemoterapiPatient->queue->patientCategory->id }})">
                            <option selected disabled>Pilih</option>
                            @foreach ($dokters as $dokter)
                                <option value="{{ $dokter->id }}">{{ $dokter->staff_id }} / {{ $dokter->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">biaya</label>
                    <div class="col-sm-10">
                        <input type="text" name="biaya_konsul" id="biaya_konsul" class="form-control" id="basic-default-name" readonly >
                    </div>
                </div>
                <hr>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">pa</label>
                    <div class="col-sm-10">
                        <input type="text" name="pa" class="form-control" id="basic-default-name">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">oksigen (O2)</label>
                    <div class="col-sm-10">
                        <input type="text" name="oksigen" class="form-control" id="basic-default-name">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">lain - lain</label>
                    <div class="col-sm-10">
                        <textarea name="lain" class="form-control" id="editor"></textarea>
                    </div>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-success btn-sm">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection

<script>
    function getBiayaTindakan(action_member_id, patient_category_id){
        var inputBiayaTindakan = document.getElementById('biaya_tindakan');
        $.ajax({
            method : 'get',
            url : "{{ route('rekapitulasi/tindakan/pelayanan/pasien.getBiayaTindakan', '') }}/" + action_member_id,
            data : {
                patient_category_id : patient_category_id,
            }, success:function(data){
                if (JSON.stringify(data) !== '{}') {
                    $(inputBiayaTindakan).val(data);
                }else{
                    $(inputBiayaTindakan).val('');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Ajax request failed:', textStatus, errorThrown);
            }
        });
    }
    function getBiayaKonsul(user_id, patient_category_id){
        var inputBiayaKonsul = document.getElementById('biaya_konsul');
        $.ajax({
            method : 'get',
            url : "{{ route('rekapitulasi/tindakan/pelayanan/pasien.getBiayaKonsul', '') }}/" + user_id,
            data : {
                patient_category_id : patient_category_id,
            }, success:function(data){
                if (JSON.stringify(data) !== '{}') {
                    $(inputBiayaKonsul).val(data);
                }else{
                    $(inputBiayaKonsul).val('');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Ajax request failed:', textStatus, errorThrown);
            }
        });
    }
</script>
