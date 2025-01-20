<table class="table">
  <tbody>
      <tr>
          <td colspan="4">
              Riwayat Kunjungan Pasien
          </td>
      </tr>
      <tr></tr>
      <tr>
          <td>Nama / No rm : </td>
          <td>{{ $item->queue->patient->name ?? '' }} / {{ $item->queue->patient->no_rm ?? '' }}</td>
          <td>Tanggal Kunjungan : </td>
          <td>{{ $item->queue->tgl_antrian ?? '' }}</td>
      </tr>
      <tr>
          <td>No Antrian : </td>
          <td>{{ $item->queue->no_antrian ?? '' }}</td>
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
          Tindakan Pasien
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
    @foreach ($item->billingDoctorActions as $detail)
    <tr>
      <td colspan="2">{{ $detail->nama_tindakan ?? '' }}</td>
      <td>{{ date('Y/m/d H:i', strtotime($detail->tanggal ?? '')) }}</td>
      <td>{{ number_format($detail->tarif ?? '') }}</td>
    </tr>
    @endforeach
    @foreach ($item->billingDoctorConsultations as $detail)
    <tr>
      <td colspan="2">Konsul Dokter : {{ $detail->nama_dokter ?? '' }}</td>
      <td>{{ date('Y/m/d H:i', strtotime($detail->tanggal ?? '')) }}</td>
      <td>{{ number_format($detail->tarif ?? '') }}</td>
    </tr>
    @endforeach
  </tbody>
  <tfoot>
    <tr>
      <td colspan="3" class="text-center"><b></b> Total</td>
      @php
          $totalAction = $item->billingDoctorActions->sum('tarif');
          $totalKonsultasi = $item->billingDoctorConsultations->sum('tarif');
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
    @foreach ($item->billingRadiologies as $detail)
    <tr>
      <td colspan="2">{{ $detail->kode_tindakan ?? '-' }} / {{ $detail->nama_tindakan ?? '-' }}</td>
      <td>{{ date('Y/m/d H:i', strtotime($detail->tanggal ?? '')) }}</td>
      <td>{{ number_format($detail->tarif ?? '') }}</td>
    </tr>
    @endforeach
  </tbody>
  <tfoot>
    <tr>
      <td colspan="3" class="text-center"><b></b>Total</td>
      <td><b></b>{{ number_format($item->billingRadiologies->sum('tarif')) }}</td>
    </tr>
  </tfoot>
  {{-- labor PK --}}
  <thead>
    <tr>
      <td colspan="4">
        <b>
          Pemeriksaan Laboratorium
        </b>
      </td>
    </tr>
    <tr class="text-nowrap bg-dark">
      <th colspan="2"><b></b>Pemeriksaan Labor</th>
      <th><b></b>Tanggal / Jam</th>
      <th><b></b>Tarif</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($item->billingLaboratories as $detailPk)
    <tr>
      <td>{{ $detailPk->kode_tindakan ?? '-' }} / {{ $detailPk->nama_tindakan ?? '-' }}</td>
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
      <td><b></b>{{ number_format($item->billingLaboratories->sum('tarif')) }}</td>
    </tr>
  </tfoot>
  {{-- Pengambilan Obat --}}
  <thead>
    <tr>
      <td colspan="4">
        <b>
          Obat Pasien
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
    @foreach ($item->billingOfMedicineFees as $detailMedicine)
    <tr>
      <td>{{ $detailMedicine->nama_obat ?? '-' }}</td>
      <td>{{ number_format($detailMedicine->jumlah ?? '') }} &nbsp; &nbsp; <span class="fw-bold"><b> {{ $detailMedicine->satuan_obat ?? '-' }}</b></span></td>
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
    <tr>
      <td colspan="3" class="text-center"><b></b>Total Akhir</td>
      <td><b></b>Rp. {{ number_format($item->total ?? '-') }}</td>
    </tr>
  </tfoot>
</table>

