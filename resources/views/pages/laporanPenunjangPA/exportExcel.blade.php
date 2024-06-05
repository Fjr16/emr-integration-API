
<table class="table">
    <tbody>
        <tr>
            <td colspan="10">
                Riwayat Pemeriksaan Laboratorium Patologi Anatomi
            </td>
        </tr>
        <tr></tr>
        <tr>
            <td>Nama / No rm : </td>
            <td colspan="2">{{ $item->patient->name ?? '' }} / {{ implode('-', str_split(str_pad($item->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}</td>
            <td>Tanggal Permintaan : </td>
            <td colspan="3">{{ $item->created_at->format('Y/m/d') ?? '' }}</td>
            <td>Diagnosa Klinik : </td>
            <td colspan="2">{!! $item->diagnosisKlinik ?? '' !!}</td>
        </tr>
        <tr>
            <td>Diminta Oleh : </td>
            <td colspan="2">{{ $item->user->name ?? '' }}</td>
            <td>No Sediaan : </td>
            <td colspan="3">{{ $item->no_sediaan ?? '' }}</td>
            <td>Keterangan Klinik : </td>
            <td colspan="2">{!! $item->keteranganKlinik ?? '' !!}</td>
        </tr>
    </tbody>
</table>
<table class="table">
    <thead>
        <tr class="text-nowrap bg-secondary">
            <th class="text-center">Tanggal Periksa</th>
            <th class="text-center">Jenis Pemeriksaan</th>
            <th class="text-center">Kategori</th>
            <th class="text-center">No Pendaftaran</th>
            <th class="text-center">Pemeriksaan</th>
            <th class="text-center">Bacaan</th>
            <th class="text-center">Diagnosis</th>
            <th class="text-center">Kesan</th>
            <th class="text-center">Dokter PA</th>
            {{-- <th class="text-center">Status</th> --}}
        </tr>
    </thead>
    <tbody>
        @foreach ($item->antrianLaboratoriumPatologiAnatomiPatient->detailAntrianLaboratoriumPatologiAnatomiPatient as $detail) 
            <tr>
                @php
                    $status = $detail->name;
                    $splitStatus = explode(' - ', $status);
                    $category = end($splitStatus);
                @endphp
                <td class="text-center">{{ $item->antrianLaboratoriumPatologiAnatomiPatient->tgl_diperiksa ?? '' }}</td>
                <td class="text-center">{{ $splitStatus[0] ?? '' }}</td>
                <td class="text-center">{{ $category ?? '' }}</td>
                <td class="text-center">{{ $category == 'HISTOPATOLOGI' ? $detail->hasilHistopatologiPatient->no_pend ?? '' : $detail->hasilSitopatologiPatient->no_pend ?? '' }}</td>
                <td class="text-center">{{ $category == 'HISTOPATOLOGI' ? $detail->hasilHistopatologiPatient->pemeriksaan ?? '' : $detail->hasilSitopatologiPatient->pemeriksaan ?? '' }}</td>
                @if ($category == 'HISTOPATOLOGI')
                    <td class="text-center">
                        <b>Makroskopik :</b> <br> 
                        {!! $detail->hasilHistopatologiPatient->makroskopik ?? '' !!}
                        <br><b>Mikroskopik :</b> <br> 
                        {!! $detail->hasilHistopatologiPatient->mikroskopik ?? '' !!}
                    </td>
                @else
                    <td class="text-center">
                        {!! $detail->hasilSitopatologiPatient->bacaan ?? '' !!}
                    </td>
                @endif
                <td class="text-center">{!! $category == 'HISTOPATOLOGI' ? $detail->hasilHistopatologiPatient->diagnosis ?? '' : $detail->hasilSitopatologiPatient->diagnosis ?? '' !!}</td>
                <td class="text-center">{!! $category == 'HISTOPATOLOGI' ? $detail->hasilHistopatologiPatient->kesan ?? '' : $detail->hasilSitopatologiPatient->kesan ?? '' !!}</td>
                <td class="text-center">{{ $category == 'HISTOPATOLOGI' ? $detail->hasilHistopatologiPatient->dokterpa ?? '' : $detail->hasilSitopatologiPatient->dokterpa ?? '' }}</td>
                {{-- <td class="text-center">{{ $detail->status ?? '' }}</td> --}}
            </tr>
        @endforeach
    </tbody>
</table>
