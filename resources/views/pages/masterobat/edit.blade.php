@extends('layouts.backend.main')

@section('content')
<div class="card mb-4">
  <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0">Tambah Master Obat</h5>
  </div>
  <div class="card-body">
      <form method="POST" action="{{ route('farmasi/obat.update', $item->id) }}">
        @method('PUT')
        @csrf
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Kode</label>
            <div class="col-sm-10 d-flex">
                <input type="text" name="kode" class="form-control" id="basic-default-name" value="{{ old('kode', $item->kode) }}" required />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Obat</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control" id="basic-default-name" value="{{ old('name', $item->name) }}" required />
            </div>
          </div>
          {{-- <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Alkes</label>
            <div class="col-sm-10">
              <div class="form-check form-check-inline mt-2">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" />
                <label class="form-check-label" for="inlineRadio1">Yes</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" />
                <label class="form-check-label" for="inlineRadio2">No</label>
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Paket</label>
            <div class="col-sm-10">
              <div class="form-check form-check-inline mt-2">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" />
                <label class="form-check-label" for="inlineRadio1">Yes</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" />
                <label class="form-check-label" for="inlineRadio2">No</label>
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Kelompok Obat / Alkes</label>
            <div class="col-sm-10">
              <div class="form-check form-check-inline mt-2">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" />
                <label class="form-check-label" for="inlineRadio1">Fast Moving</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" />
                <label class="form-check-label" for="inlineRadio2">Slow Moving</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3" />
                <label class="form-check-label" for="inlineRadio3">Dead Moving</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio4" value="option4" />
                <label class="form-check-label" for="inlineRadio4">Khusus</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio5" value="option5" />
                <label class="form-check-label" for="inlineRadio5">Beli Keluar</label>
              </div>
            </div>
          </div> --}}
          {{-- <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Obat Dianggap Habis</label>
            <div class="col-sm-10">
              <div class="form-check form-check-inline mt-2">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" />
                <label class="form-check-label" for="inlineRadio1">Yes</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" />
                <label class="form-check-label" for="inlineRadio2">No</label>
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Obat Dianggap Habis</label>
            <div class="col-sm-10">
              <div class="form-check form-check-inline mt-2">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1" />
                <label class="form-check-label" for="inlineCheckbox1">Medical Record</label>
              </div>
              <div class="form-check form-check-inline mt-2">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2" />
                <label class="form-check-label" for="inlineCheckbox2">Pembayaran</label>
              </div>
              <div class="form-check form-check-inline mt-2">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3" />
                <label class="form-check-label" for="inlineCheckbox3">Apotik</label>
              </div>
            </div>
          </div> --}}

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Jenis Obat</label>
            <div class="col-sm-10">
              <select class="form-select" name="medicine_type_id" aria-label="Default select example">
                  <option selected disabled>Pilih</option>
                  @foreach ($jenis as $type)
                  @if (old('medicine_type_id', $item->medicine_type_id) == $type->id)
                    <option value="{{ $type->id }}" selected>{{ $type->name }}</option>
                  @else
                    <option value="{{ $type->id }}">{{ $type->name }}</option>    
                  @endif
              @endforeach
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Golongan Obat</label>
            <div class="col-sm-10">
              <select class="form-select" name="medicine_category_id" aria-label="Default select example">
                  <option selected disabled>Pilih</option>
                  @foreach ($golongan as $category)
                      @if (old('medicine_category_id', $item->medicine_category_id) == $category->id)
                        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                      @else
                        <option value="{{ $category->id }}">{{ $category->name }}</option>    
                      @endif
                  @endforeach
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label for="select2Basic" class="col-sm-2 col-form-label">Jenis Sediaan</label>
            <div class="col-sm-10">
              <select id="select2Basic" class="select2 form-select" name="medicine_form_id" data-allow-clear="true">
                <option selected disabled>Pilih</option>
                @foreach ($sediaan as $form)
                @if (old('medicine_form_id', $item->medicine_form_id) == $form->id)
                  <option value="{{ $form->id }}" selected>{{ $form->name }}</option>
                @else
                  <option value="{{ $form->id }}">{{ $form->name }}</option>    
                @endif
                @endforeach
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label for="select2Basic" class="col-sm-2 col-form-label">Satuan Obat</label>
            <div class="col-sm-10">
              <select id="select2Basic" class="select2 form-select" name="unit_conversion_master_id" data-allow-clear="true">
                <option selected disabled>Pilih</option>
                  @foreach ($satuan as $unit)
                  @if (old('unit_conversion_master_id', $item->unit_conversion_master_id) == $unit->id)
                    <option value="{{ $unit->id }}" selected>{{ $unit->name }}</option>
                  @else
                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>    
                  @endif
              @endforeach
              </select>
            </div>
          </div>
          {{-- <div class="row mb-3">
            <label for="select5Basic" class="col-sm-2 col-form-label">Konversi Satuan</label>
            <div class="col-sm-10">
              <select id="select5Basic" class="select2 form-select form-select-lg" data-allow-clear="true">
                <option selected disabled>Pilih</option>
                  <option value="1">Tunggal</option>
                  <option value="2">Box 100</option>
                  <option value="3">Box 30</option>
                  <option value="4">Botol</option>
              </select>
            </div>
          </div> --}}
          {{-- <h6 class="text-center">Harga Obat</h6>
          <div class="table-responsive text-nowrap mb-3">
            <table class="table">
              <thead>
                <tr class="text-nowrap bg-dark">
                  <th>Umum</th>
                  <th>Harga</th>
                  <th>Discount</th>
                  <th>Type Discount</th>
                  <th>PPN</th>
                  <th>Harga Akhir</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>PICIS</td>
                  <td><input type="number" name="name" class="form-control form-control-sm" id="basic-default-name" value="" required /></td>
                  <td><input type="number" name="name" class="form-control form-control-sm" id="basic-default-name" value="" required /></td>
                  <td>
                    <select class="form-select form-select-sm" name="action_id" aria-label="Default select example">
                      <option selected disabled>Pilih</option>
                      <option value="1">%</option>
                      <option value="2">Rupiah</option>
                    </select>
                  </td>
                  <td>
                    <select class="form-select form-select-sm" name="action_id" aria-label="Default select example">
                      <option selected value="1">None</option>
                      <option value="2">10%</option>
                      <option value="3">11%</option>
                    </select>
                  </td>
                  <td>329.27</td>
                </tr>
                </tbody>
            </table>
          </div> --}}
          <div class="row justify-content-end">
              <div class="col-sm-10">
                  <button type="submit" class="btn btn-sm btn-dark">Simpan</button>
              </div>
          </div>
      </form>
  </div>
</div>
@endsection