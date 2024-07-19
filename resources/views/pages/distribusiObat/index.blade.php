@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
<div class="alert alert-success d-flex" role="alert">
    <span class="alert-icon rounded-circle"><i class='bx bxs-check-circle' style="font-size: 40px"></i></span>
    <div class="d-flex flex-column ps-1">
        <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">BERHASIL !!</h6>
        <span>{{ session('success') }}</span>
    </div>
</div>
@endif
@if (session()->has('error'))
<div class="alert alert-danger d-flex" role="alert">
    <span class="alert-icon rounded-circle"><i class='bx bxs-x-circle' style="font-size: 40px"></i></span>
    <div class="d-flex flex-column ps-1">
        <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">ERROR !!</h6>
        <span>{{ session('error') }}</span>
    </div>
</div>
@endif
@if (session()->has('errors'))
<div class="alert alert-danger d-flex" role="alert">
    <span class="alert-icon rounded-circle"><i class='bx bxs-x-circle' style="font-size: 40px"></i></span>
    <div class="d-flex flex-column ps-1">
        <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">ERROR !!</h6>
        <span>
          @foreach (session('errors') as $err)
            {{ $err ?? '' }} <br>
          @endforeach
        </span>
    </div>
</div>
@endif
<div class="card-body">
  {{-- alert --}}
  <div id="show-alert" class="row mb-0 mt-0">
  </div>
  {{-- end alert --}}

    <div class="accordion" id="accordionExample">
      <div class="card accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="true" aria-controls="accordionOne" role="tabpanel">
            <i class="bx bx-plus me-1"></i> Tambah Amprahan 
          </button>
        </h2>
    
        <div id="accordionOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <form method="POST" action="{{ route('farmasi/obat/amprahan.store') }}">
              @csrf
                <hr class="m-0 mb-3">
                <div class="row mb-3">
                  <div class="col-sm-6">
                    <label class="form-label form-label-sm" for="unit_asal_id">Dari Unit</label>
                    <select class="form-select form-select select2" name="unit_asal_id" id="unit_asal_id" aria-label="Default select example" style="width: 100%">
                      @foreach ($units as $unt)
                          @if (old('unit_asal_id', $unitAsal->id) == $unt->id)
                            <option selected value="{{ $unt->id }}">{{ $unt->name ?? '-' }}</option>
                          @else
                            <option value="{{ $unt->id }}">{{ $unt->name ?? '-' }}</option>
                          @endif
                      @endforeach
                    </select>
                  </div>
                  <div class="col-sm-6">
                    <label class="form-label form-label-sm" for="unit_tujuan_id">Ke Unit</label>
                    <select class="form-select form-select select2" name="unit_tujuan_id" id="unit_tujuan_id" aria-label="Default select example" style="width: 100%">
                      @foreach ($units as $unt)
                      @if (old('unit_tujuan_id') == $unt->id)
                        <option selected value="{{ $unt->id }}">{{ $unt->name ?? '-' }}</option>
                      @else
                        <option value="{{ $unt->id }}">{{ $unt->name ?? '-' }}</option>
                      @endif
                      @endforeach
                    </select>
                  </div>
                </div>
                <h6>Data Obat Amprahan</h6>
                  <div class="dinamic-input row mb-3">
                    <div class="col-sm-3">
                      <label class="form-label">Nama Obat</label>
                      <select id="medicine_id" class="select2 form-select select2" name="medicine_id[]" data-allow-clear="true" style="width: 100%" onchange="generateStokAndConverter(this)">
                        <option selected disabled>Pilih</option>
                          @foreach ($medicines as $medicine)
                          @if (old('medicine_id') == $medicine->id)
                            <option value="{{ $medicine->id }}" selected>{{ $medicine->name }}</option>
                          @else
                            <option value="{{ $medicine->id }}">{{ $medicine->name }}</option>    
                          @endif
                          @endforeach
                      </select>
                    </div>
                    <div class="col-sm-4">
                      <label class="form-label">Stok</label>
                      <select id="medicine_stok_id" class="form-select form-select-sm select2-w-placeholder-medicine" name="medicine_stok_id[]" data-allow-clear="true" style="width: 100%">
                        {{-- isi dari js --}}
                      </select>
                    </div>
                    <div class="col-sm-2">
                      <label class="form-label form-label-sm">Konverter (Opsional)</label>
                      <div class="input-group">
                        <input type="number" name="jumlah_awal[]" class="form-control" placeholder="0" onkeyup="satuanInputChange(this)"/>
                        <select name="satuan_awal[]" class="form-select" onchange="satuanSelectChange(this)">
                          {{-- isi dari js --}}
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <label class="form-label form-label-sm" for="basic-default-name">Jumlah Pengiriman</label>
                      <div class="input-group">
                        <input type="text" class="form-control" name="jumlah[]" placeholder="Jumlah Dikirim" aria-describedby="satuan_obat"/>
                        <span class="input-group-text bg-secondary text-white satuan_obat"></span>
                      </div>
                    </div>
                    <div class="col-sm-1">
                      <label class="form-label"></label>
                      <div class="mt-1 d-flex">
                        <button type="button" class="btn btn-icon me-1 btn-primary" onclick="addDinamicInputAmprahan(this)">
                          <span class="bx bx-plus bx-22px"></span>
                        </button>
                        <button type="button" class="btn btn-icon btn-danger" onclick="removeInputDinamic(this)">
                          <span class="bx bx-x bx-22px"></span>
                        </button>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="row mt-4 text-start">
                    <div class="col-sm-12 mt-4">
                      <button class="btn btn-md btn-outline-success">Submit</button>
                    </div>
                  </div>
            </form>
          </div>
        </div>
      </div>
  </div>
<div class="card px-2 mt-2">
  <div class="card-header">
      <h4 class="align-self-center m-0">Riwayat Amprahan</h4>
  </div>
  <hr class="m-0 my-0">
  <div class="card-body">
    <div class="table-responsive text-nowrap">
      <table class="table" id="example">
        <thead>
          <tr class="text-nowrap bg-dark">
            <th>No. Distribusi</th>
            <th>Nama Unit Asal</th>
            <th>Nama Unit Tujuan</th>
            <th>Tanggal</th>
            <th>Pengirim</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $item)
            <tr>
              <td>{{ $item->no_distribusi ?? '' }}</td>
              <td>{{ $item->unitAsal->name ?? '' }}</td>
              <td>{{ $item->unitTujuan->name ?? '' }}</td>
              <td>{{ $item->created_at->format('d M Y') }}</td>
              <td>{{ $item->user->name ?? '' }}</td>
              <td>{{ $item->status ?? '' }}</td>
              <td>
                <div class="btn-group">
                  <a class="btn btn-primary" href="{{ route('farmasi/obat/amprahan.show', $item->id) }}">Detail</a>
                  <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="visually-hidden">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href=""><i class="bx bx-edit me-1"></i>Edit</a></li>
                    <li>
                      <form action="{{ route('farmasi/obat/amprahan.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="dropdown-item"><i class="bx bx-x me-1"></i>Batal</button>
                    </form>
                    </li>
                  </ul>
                </div>
              </td>
            </tr>
          @endforeach
          </tbody>
      </table>
    </div>
  </div>
</div>

<script>
const elementAlert = document.getElementById('show-alert');
const dataStok = @json($medicineStokAll);
const dataMedicine = @json($medicines);
//generate data stok, satuan terkecil obat, dan generate konverter
function generateStokAndConverter(element){
    let unitId = document.getElementById('unit_asal_id').value;
    let selectStok = element.parentNode.parentNode.querySelector('select[name="medicine_stok_id[]"]');
    let satuanSelect = element.parentNode.parentNode.querySelector('select[name="satuan_awal[]"]');
    if (!unitId) {
      alertShow('Error !!', 'Unit Asal Obat Harus Diisi', elementAlert);
    }
    // get data stok berdasarkan unit_id dan id obat
    let dataSelectStok = dataStok.filter(function(item){
      return item.unit_id == unitId && item.medicine.id == element.value;
    });

    if (dataSelectStok.length == 0) {
      $(selectStok).html(`<option value="null" selected>Tidak Ada Stok</option>`);
    }else{
      let temp;
      dataSelectStok.forEach(function(item){
        temp += `<option value="${item.id}" data-foo="harga satuan : ${item.base_harga ?? '...'} Rp | Stok : ${item.stok ?? '...'} ${item.medicine.small_unit ?? '...'} | Batch : ${item.no_batch ?? '...'} (${item.production_date ?? '...'} / ${item.exp_date ?? '...'})" data-satuan="${item.medicine.small_unit ?? ''}">${item.medicine.kode ?? '...'} / ${item.medicine.name ?? '...'}</option>`;
      });
      $(selectStok).html(temp);
    }

    // render satuan terkecil obat dan satuan yang lainnya
    let itemMedicine = dataMedicine.find(function(itm){
      return itm.id == element.value;
    });
    $(element).closest('.dinamic-input').find('.satuan_obat').text(itemMedicine.small_unit);
    let dataSelectSatuan;
    if (!itemMedicine.big_unit && !itemMedicine.medium_to_big && !itemMedicine.medium_unit && !itemMedicine.small_to_medium) {
      dataSelectSatuan = '<option value="" selected disabled>Tidak Tersedia</option>';
    }else{
      if (itemMedicine.medium_unit && itemMedicine.small_to_medium) {
        dataSelectSatuan +=`<option value="${itemMedicine.small_to_medium ?? 0}">${itemMedicine.medium_unit ?? ''}</option>`; 
      }
      if (itemMedicine.big_unit && itemMedicine.medium_to_big) {
        dataSelectSatuan +=`<option value="${itemMedicine.medium_to_big ?? 0}">${itemMedicine.big_unit ?? ''}</option>`; 
      }
    }
    $(satuanSelect).html(dataSelectSatuan);
}
//event ketika select satuan berubah atau jumlah konverter berubah
function satuanSelectChange(element){
  const jumlahAwal = element.closest('.dinamic-input').querySelector('input[name="jumlah_awal[]"]');
  const konvertingRes = jumlahAwal.value * element.value;
  $(element).closest('.dinamic-input').find('input[name="jumlah[]"]').val(konvertingRes);
}

function satuanInputChange(element){
  const satuanSelect = element.closest('.dinamic-input').querySelector('select[name="satuan_awal[]"]');
  const konvertingRes = satuanSelect.value * element.value;
  $(element).closest('.dinamic-input').find('input[name="jumlah[]"]').val(konvertingRes);
}

</script>
<script>
  let countInput = 0;
  function addDinamicInputAmprahan(element){
    countInput = countInput+1;
    let content = `
    <div class="col-sm-3">
      <label class="form-label">Nama Obat</label>
      <select id="medicine_id_${countInput}" class="select2 form-select select2" name="medicine_id[]" data-allow-clear="true" style="width: 100%" onchange="generateStokAndConverter(this)">
        <option selected disabled>Pilih</option>
          @foreach ($medicines as $medicine)
          @if (old('medicine_id') == $medicine->id)
            <option value="{{ $medicine->id }}" selected>{{ $medicine->name }}</option>
          @else
            <option value="{{ $medicine->id }}">{{ $medicine->name }}</option>    
          @endif
          @endforeach
      </select>
    </div>
    <div class="col-sm-4">
      <label class="form-label">Stok</label>
      <select id="medicine_stok_id_${countInput}" class="form-select form-select-sm select2-w-placeholder-medicine" name="medicine_stok_id[]" data-allow-clear="true" style="width: 100%">
        {{-- isi dari js --}}
      </select>
    </div>
    <div class="col-sm-2">
      <label class="form-label form-label-sm">Konverter (Opsional)</label>
      <div class="input-group">
        <input type="number" name="jumlah_awal[]" class="form-control" placeholder="0" onkeyup="satuanInputChange(this)"/>
        <select name="satuan_awal[]" class="form-select" onchange="satuanSelectChange(this)">
          {{-- isi dari js --}}
        </select>
      </div>
    </div>
    <div class="col-sm-2">
      <label class="form-label form-label-sm" for="basic-default-name">Jumlah Pengiriman</label>
      <div class="input-group">
        <input type="text" class="form-control" name="jumlah[]" placeholder="Jumlah Dikirim" aria-describedby="satuan_obat" required/>
        <span class="input-group-text bg-secondary text-white satuan_obat"></span>
      </div>
    </div>
    <div class="col-sm-1">
      <label class="form-label"></label>
      <div class="mt-1 d-flex">
        <button type="button" class="btn btn-icon me-1 btn-primary" onclick="addDinamicInputAmprahan(this)">
          <span class="bx bx-plus bx-22px"></span>
        </button>
        <button type="button" class="btn btn-icon btn-danger" onclick="removeInputDinamic(this)">
          <span class="bx bx-x bx-22px"></span>
        </button>
      </div>
    </div>`;

    dinamicInput(element, content, `medicine_id_${countInput}`, 'Pilih', true);
    regenerateSelect('select2-w-placeholder-medicine');
  }
</script>
@endsection