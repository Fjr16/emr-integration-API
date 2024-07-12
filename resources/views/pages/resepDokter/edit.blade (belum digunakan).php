@extends('layouts.backend.main')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('rajal/resep/dokter.update', $item->id) }}" method="POST"
        onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
        @method('PUT')
        @csrf
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Edit Resep Dokter</h5>
                <div class="mx-4 px-3">
                    <button type="button" class="btn btn-success btn-sm" onclick="history.back()">Kembali</button>
                </div>
            </div>
            <div class="card-body">
                @foreach ($item->medicineReceiptDetails as $index => $detail)
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="medicine_id" class="form-label">Nama Obat</label>
                            <select id="medicine_id_{{ $index }}" name="medicine_id[]"
                                class="form-select form-select-sm" data-allow-clear="true" required>
                                <option selected disabled>Pilih</option>
                                @foreach ($dataObat as $obat)
                                    @if (old('medicine_id', $detail->medicine_id) == $obat->id)
                                        <option value="{{ $obat->id }}" selected>
                                            {{ $obat->kode ?? '' }}/{{ $obat->name ?? '' }}</option>
                                    @else
                                        <option value="{{ $obat->id }}">{{ $obat->kode ?? '' }}/{{ $obat->name ?? '' }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <label class="form-label" for="basic-default-name">Jumlah</label>
                            <input type="number" class="form-control" value="{{ $detail->jumlah ?? '' }}" name="jumlah[]"
                                id="jumlah" required />
                        </div>
                        <div class="col-sm-2">
                            <label class="form-label" for="basic-default-name">Aturan Penggunaan</label>
                            <input type="text" class="form-control" value="{{ $detail->aturan_pakai ?? '' }}"
                                name="aturan_pakai[]" id="aturan_pakai" required />
                        </div>
                        <div class="col-sm-2">
                            <label for="keterangan" class="form-label">Keterangan Penggunaan</label>
                            <select name="keterangan[]" class="form-select form-select-md" data-allow-clear="true" required>
                                <option value="Sebelum Makan"
                                    {{ $detail->keterangan == 'Sebelum Makan' ? 'selected' : '' }}>Sebelum Makan</option>
                                <option value="Sesudah Makan"
                                    {{ $detail->keterangan == 'Sesudah Makan' ? 'selected' : '' }}>Sesudah Makan</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label for="other" class="form-label">Keterangan Lainnya</label>
                            <textarea name="other[]" class="form-control" id="other" cols="30" rows="1">{{ $detail->other ?? '' }}</textarea>
                        </div>
                        <div class="col-sm-1 d-flex align-self-center mt-4">
                            <button type="button" class="btn btn-sm btn-dark" onclick="tambahResep(this)"><i
                                    class="bx bx-plus"></i></button>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="card-footer">
                <div class="mt-3 mx-4 text-end">
                    <button type="submit" class="btn btn-success btn-sm mx-3">Simpan</button>
                </div>
            </div>
        </div>
        </div>
    </form>

    <script>
        let clickCount = 80;

        function tambahResep(element) {
            var row = element.closest('.row').parentNode;

            var div = document.createElement('div');
            div.className = 'row';
            div.innerHTML = `
        <div class="col-sm-3">
          <label for="medicine_id" class="form-label">Nama Obat</label>
          <select id="medicine_id_${clickCount}" name="medicine_id[]" class="form-select form-select-sm" data-allow-clear="true" required>
            <option selected disabled>Pilih</option>
            @foreach ($dataObat as $obat)
                @if (old('medicine_id') == $obat->id)
                  <option value="{{ $obat->id }}" selected>{{ $obat->kode ?? '' }}/{{ $obat->name ?? '' }}</option>
                @else
                  <option value="{{ $obat->id }}">{{ $obat->kode ?? '' }}/{{ $obat->name ?? '' }}</option>
                @endif
            @endforeach
          </select>
        </div>
        <div class="col-sm-1">
          <label class="form-label" for="basic-default-name">Jumlah</label>
          <input type="number" class="form-control" name="jumlah[]" id="jumlah" required />
        </div>
        <div class="col-sm-2">
          <label class="form-label" for="basic-default-name">Aturan Penggunaan</label>
          <input type="text" class="form-control" name="aturan_pakai[]" id="aturan_pakai" required />
        </div>
        <div class="col-sm-2">
            <label for="keterangan" class="form-label">Keterangan Penggunaan</label>
            <select name="keterangan[]" class="form-select form-select-md" data-allow-clear="true" required>
              <option value="Sebelum Makan" {{ $detail->keterangan == 'Sebelum Makan' ? 'selected' : '' }}>Sebelum Makan</option>
              <option value="Sesudah Makan" {{ $detail->keterangan == 'Sesudah Makan' ? 'selected' : '' }}>Sesudah Makan</option>
            </select>
        </div>
        <div class="col-sm-3">
          <label for="other" class="form-label">Keterangan Lainnya</label>
          <textarea name="other[]" class="form-control" id="other" cols="30" rows="1"></textarea>
        </div>
        <div class="col-sm-1 d-flex align-self-center mt-4">
          <button type="button" class="btn btn-sm btn-danger" onclick="hapusResep(this)"><i class="bx bx-minus"></i></button>
        </div>`;

            row.appendChild(div);
            $('#medicine_id_' + clickCount).select2();
            clickCount++;
        }

        function hapusResep(element) {
            var root = element.closest('.row');
            root.remove();
        }
    </script>
@endsection
