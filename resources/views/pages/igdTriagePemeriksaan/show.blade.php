@foreach ($kategori as $kat)    
    <div class="col-3">
    <p class="fw-bold m-0 mt-2">{{ $kat->name ?? '' }} :</p>
        <div class="mb-3 mx-3">
            @foreach ($kat->igdTriageCheckups->where('igd_triage_scale_id', $item->id) as $periksa)    
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="igd_triage_checkup_id[]" value="{{ $periksa->id }}" id="defaultCheck{{ $periksa->id }}" />
                <label class="form-check-label" for="defaultCheck{{ $periksa->id }}">
                {{ $periksa->name ?? '' }}
                </label>
            </div>
            @endforeach
        </div>
    </div>
@endforeach