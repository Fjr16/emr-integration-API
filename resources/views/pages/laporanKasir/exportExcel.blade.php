<table class="table">
  <tbody>
      <tr>
          <td colspan="4">
              Riwayat Pembayaran Pasien
          </td>
      </tr>
      <tr></tr>
      <tr>
          <td>Nama / No rm : </td>
          <td>{{ $item->rawatJalanPatient->queue->patient->name ?? '' }} / {{ implode('-', str_split(str_pad($item->rawatJalanPatient->queue->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}</td>
          <td>Tanggal Kunjungan : </td>
          <td>{{ $item->rawatJalanPatient->queue->tgl_antrian ?? '' }}</td>
          
      </tr>
      <tr>
          <td>No Antrian : </td>
          <td>{{ $item->rawatJalanPatient->queue->no_antrian ?? '' }}</td>
          <td>Petugas : </td>
          <td>{!! $item->user->name ?? '' !!}</td>
      </tr>
  </tbody>
</table>
<table class="table mb-3" >
  {{-- tindakan --}}
  <thead>
    <tr>
      <td colspan="4">
        <b>
          Data Tindakan Pasien
        </b>
      </td>
    </tr>
    <tr class="text-nowrap bg-dark">
      <th colspan="2"><b></b>Tindakan</th>
      <th><b></b>Tanggal / Jam</th>
      <th><b></b>Tarif</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($item->detailKasirPatients->where('category', 'Action') as $detail)
    <tr>
      <td colspan="2">{{ $detail->name ?? '' }}</td>
      <td>{{ date('Y/m/d H:i', strtotime($detail->tanggal ?? '')) }}</td>
      <td>{{ number_format($detail->tarif ?? '') }}</td>
    </tr>
    @endforeach
    @foreach ($item->detailKasirPatients->where('category', 'Konsultasi') as $detail)
    <tr>
      <td colspan="2">{{ $detail->name ?? '' }}</td>
      <td>{{ date('Y/m/d H:i', strtotime($detail->tanggal ?? '')) }}</td>
      <td>{{ number_format($detail->tarif ?? '') }}</td>
    </tr>
    @endforeach
  </tbody>
  <tfoot>
    <tr>
      <td colspan="3" class="text-center"><b></b> Total</td>
      @php
          $totalAction = $item->detailKasirPatients->where('category', 'Action')->sum('tarif');
          $totalKonsultasi = $item->detailKasirPatients->where('category', 'Konsultasi')->sum('tarif');
          $totalOfBoth = $totalAction + $totalKonsultasi;
      @endphp
      <td><b></b> {{ number_format($totalOfBoth) }}</td>
    </tr>
  </tfoot>
  {{-- radiologi --}}
  <thead>
    <tr>
      <td colspan="4">
        <b>
          Data Pemeriksaan Radiologi Pasien
        </b>
      </td>
    </tr>
    <tr class="text-nowrap bg-dark">
      <th colspan="2"><b></b>Pemeriksaan Radiologi</th>
      <th><b></b>Tanggal / Jam</th>
      <th><b></b>Tarif</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($item->detailKasirPatients->where('category', 'Pemeriksaan Radiologi') as $detail)
    <tr>
      <td colspan="2">{{ $detail->name ?? '' }}</td>
      <td>{{ date('Y/m/d H:i', strtotime($detail->tanggal ?? '')) }}</td>
      <td>{{ number_format($detail->tarif ?? '') }}</td>
    </tr>
    @endforeach
  </tbody>
  <tfoot>
    <tr>
      <td colspan="3" class="text-center"><b></b>Total</td>
      <td><b></b>{{ number_format($item->detailKasirPatients->where('category', 'Pemeriksaan Radiologi')->sum('tarif')) }}</td>
    </tr>
  </tfoot>
  {{-- labor PK --}}
  <thead>
    <tr>
      <td colspan="4">
        <b>
          Data Pemeriksaan Laboratorium Patologi Klinik
        </b>
      </td>
    </tr>
    <tr class="text-nowrap bg-dark">
      <th colspan="2"><b></b>Pemeriksaan Labor PK</th>
      <th><b></b>Tanggal / Jam</th>
      <th><b></b>Tarif</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($item->detailKasirPatients->where('category', 'Pemeriksaan Laboratorium PK') as $detailPk)
    <tr>
      <td colspan="2">{{ $detailPk->name ?? '' }}</td>
      <td>{{ date('Y/m/d H:i', strtotime($detailPk->tanggal ?? '')) }}</td>
      <td>{{ number_format($detailPk->tarif ?? '') }}</td>
    </tr>
    @endforeach
  </tbody>
  <tfoot>
    <tr class="fw-bold">
      <td colspan="3" class="text-center">
        <b>
          Total
        </b>
      </td>
      <td><b></b>{{ number_format($item->detailKasirPatients->where('category', 'Pemeriksaan Laboratorium PK')->sum('tarif')) }}</td>
    </tr>
  </tfoot>
  {{-- Pengambilan Obat --}}
  <thead>
    <tr>
      <td colspan="4">
        <b>
          Data Obat Pasien
        </b>
      </td>
    </tr>
    <tr class="text-nowrap bg-dark"><b></b>
      <th><b></b>Nama Obat</th>
      <th><b></b>Jumlah</th>
      <th><b></b>Harga Satuan</th>
      <th><b></b>Total Harga</th>
    </tr>
  </thead>
  <tbody>
    @php
        $grandTotalMedicine = 0;
    @endphp
    @foreach ($item->detailKasirPatients->where('category', 'Medicine') as $detailMedicine)
    <tr>
      <td>{{ $detailMedicine->name ?? '' }}</td>
      <td>{{ number_format($detailMedicine->jumlah ?? '') }}</td>
      <td>{{ number_format($detailMedicine->tarif ?? '') }}</td>
      @php
          $total_harga = $detailMedicine->jumlah * $detailMedicine->tarif;
          $grandTotalMedicine += $total_harga;
      @endphp
      <td>{{ number_format($total_harga ?? '') }}</td>
    </tr>
    @endforeach
  </tbody>
  <tfoot>
    <tr>
      <td colspan="3" class="text-center"><b></b>Total</td>
      <td><b></b>{{ number_format($grandTotalMedicine ?? '') }}</td>
    </tr>
  </tfoot>
</table>

