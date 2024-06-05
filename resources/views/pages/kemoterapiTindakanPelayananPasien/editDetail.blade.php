@extends('layouts.backend.main')

@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Edit Tindakan Pelayanan Pasien</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('kemoterapi/tindakan/pelayanan/pasien/detail.updateDetail', $item->id) }}">
                @csrf
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Tanggal</label>
                    <div class="col-sm-10">
                        <input type="date" name="tanggal" value="{{ $item->tanggal }}" class="form-control"
                            id="basic-default-name">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">lab</label>
                    <div class="col-sm-10">
                        <input type="text" name="lab" class="form-control" id="basic-default-name"
                            value="{{ $item->lab }}">
                    </div>
                </div>
                <hr>
                <p class="m-0 mb-1">RONTGENT</p>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">jenis tindakan</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" name="action_members_id"
                            onchange="getBiayaTindakan(this.value, {{ $item->kemoterapiTindakanPelayananPatient->kemoterapiPatient->queue->patientCategory->id }})">
                            <option class="hide-option" disabled>Pilih</option>
                            @foreach ($tindakans as $tindakan)
                            <option value="{{ $tindakan->id }}" @if ($item->actionMembers->id == $tindakan->id) selected @endif>{{ $tindakan->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">biaya</label>
                    <div class="col-sm-10">
                        <input type="text" name="biaya_tindakan" id="biaya_tindakan" class="form-control"
                            id="basic-default-name" value="{{ $item->biaya_tindakan }}" readonly>
                    </div>
                </div>
                <hr>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">ecg</label>
                    <div class="col-sm-10">
                        <input type="text" name="ecg" class="form-control" id="basic-default-name"
                            value="{{ $item->ecg }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">tindakan</label>
                    <div class="col-sm-10">
                        <input type="text" name="tindakan" class="form-control" id="basic-default-name"
                            value="{{ $item->tindakan }}">
                    </div>
                </div>
                <hr>
                <p class="m-0 mb-1">KONSUL</p>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Dokter</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" name="user_id"
                            onchange="getBiayaKonsul(this.value, {{ $item->kemoterapiTindakanPelayananPatient->kemoterapiPatient->queue->patientCategory->id }})">
                            <option class="hide-option" disabled>Pilih</option>
                            @foreach ($dokters as $dokter)
                            <option value="{{ $dokter->id }}" @if ($item->user->id == $dokter->id) selected @endif>{{ $dokter->staff_id }} / {{ $dokter->name }}</option>
                        </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">biaya</label>
                    <div class="col-sm-10">
                        <input type="text" name="biaya_konsul" id="biaya_konsul" class="form-control"
                            id="basic-default-name" value="{{ $item->biaya_konsul }}" readonly>
                    </div>
                </div>
                <hr>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">pa</label>
                    <div class="col-sm-10">
                        <input type="text" name="pa" class="form-control" id="basic-default-name"
                            value="{{ $item->pa }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">oksigen (O2)</label>
                    <div class="col-sm-10">
                        <input type="text" name="oksigen" class="form-control" id="basic-default-name"
                            value="{{ $item->oksigen }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">lain - lain</label>
                    <div class="col-sm-10">
                        <textarea name="lain" class="form-control" id="editor" value="">{!! $item->lain !!}</textarea>
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
    function getBiayaTindakan(action_member_id, patient_category_id) {
        var inputBiayaTindakan = document.getElementById('biaya_tindakan');
        $.ajax({
            method: 'get',
            url: "{{ route('rekapitulasi/tindakan/pelayanan/pasien.getBiayaTindakan', '') }}/" +
                action_member_id,
            data: {
                patient_category_id: patient_category_id,
            },
            success: function(data) {
                if (JSON.stringify(data) !== '{}') {
                    $(inputBiayaTindakan).val(data);
                } else {
                    $(inputBiayaTindakan).val('');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Ajax request failed:', textStatus, errorThrown);
            }
        });
    }

    function getBiayaKonsul(user_id, patient_category_id) {
        var inputBiayaKonsul = document.getElementById('biaya_konsul');
        $.ajax({
            method: 'get',
            url: "{{ route('rekapitulasi/tindakan/pelayanan/pasien.getBiayaKonsul', '') }}/" + user_id,
            data: {
                patient_category_id: patient_category_id,
            },
            success: function(data) {
                if (JSON.stringify(data) !== '{}') {
                    $(inputBiayaKonsul).val(data);
                } else {
                    $(inputBiayaKonsul).val('');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Ajax request failed:', textStatus, errorThrown);
            }
        });
    }
</script>
