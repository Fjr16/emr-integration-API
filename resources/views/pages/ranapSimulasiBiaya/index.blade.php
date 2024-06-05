@extends('layouts.backend.main')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger w-100 border mb-5 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('error') }}
        </div>
    @endif

    {{-- nav tab --}}
    <div class="card">
        <div class="card-header">
            <h4 class="m-0">Simulasi Biaya Ranap
              <span class="text-primary">{{ request('kategori', '......') }}</span>
            </h4>
        </div>
        <div class="card-body">
          <form action="{{ route('ranap/simulasi/biaya.index') }}" method="GET">
            <div class="row mb-3 mt-2">
              <label for="input-kelas" class="col-sm-2 col-form-label">Pilih Kategori Kamar</label>
              <div class="col-sm-10">
                <select name="kategori" id="input-kelas" class="form-select form-select-md">
                  <option disabled selected>Pilih</option>
                  <option value="KELAS 3" {{ request('kategori') == 'KELAS 3' ? 'selected' : '' }}>Kelas 3</option>
                  <option value="KELAS 2" {{ request('kategori') == 'KELAS 2' ? 'selected' : '' }}>Kelas 2</option>
                  <option value="KELAS 1" {{ request('kategori') == 'KELAS 1' ? 'selected' : '' }}>Kelas 1</option>
                  <option value="VIP" {{ request('kategori') == 'VIP' ? 'selected' : '' }}>VIP</option>
                </select>
              </div>
            </div>
            <div class="row mb-5">
              <label class="col-sm-2 col-form-label" for="basic-default-name"></label>
              <div class="col-10">
                <button type="submit" class="btn btn-sm btn-success">Generate</button>
              </div>
            </div>
          </form>
            <table class="table">
                <thead>
                    <tr class="text-nowrap bg-dark">
                        <th class="">No</th>
                        <th class="">Nama</th>
                        <th class="">Harga</th>
                        <th class="text-center">(X)</th>
                        <th class="">Total</th>
                        <th class="">Action</th>
                    </tr>
                </thead>
                <tbody>
                  @php
                    $totalAkhir = 0;
                  @endphp
                    @foreach ($data as $item)
                      <tr id="tr_{{ $loop->iteration }}" class="text-dark">
                          <td>{{ $loop->iteration }}</th>
                          <td>{{ $item->name ?? '' }}</td>
                          <td class="col-2">
                            <input type="number" value="{{ $item->harga }}" id="harga_{{ $item->id }}" class="harga form-control" readonly>
                          </td>
                          <td class="col-1">
                            <input type="number" step="1" min="1" value="1" id="typeNumber{{ $item->id }}" class="jumlahX form-control" name="jumlah[]">
                          </td>
                          <td class="col-2">
                            <input type="number" value="{{ $item->harga }}" id="total_{{ $item->id }}" class="total form-control" name="total[]" readonly>
                          </td>
                          <td>
                              <input type="radio" class="true-check btn-check" name="option_{{ $item->name }}" id="activate-btn_{{ $item->id }}" autocomplete="off" checked>
                              <label class="btn btn-outline-success" for="activate-btn_{{ $item->id }}"><i class="bx bx-check"></i></label>

                              <input type="radio" class="false-check btn-check" name="option_{{ $item->name }}" id="deactivate-btn_{{ $item->id }}" autocomplete="off">
                              <label class="btn btn-outline-danger" for="deactivate-btn_{{ $item->id }}"><i class="bx bx-x"></i></label>
                          </td>
                      </tr>
                      @php
                        $totalAkhir += $item->harga;
                      @endphp
                      @endforeach
                      <tr class="text-dark">
                        <td></td>
                        <td colspan="2" class="fw-bold">Total Biaya</td>
                        <td></td>
                        <td class="fw-bold">
                          {{-- Rp.  --}}
                          <input type="text" id="total_akhir" class="form-control" value="{{ number_format($totalAkhir) }}" readonly name="total_akhir">
                        </td>
                        <td><a href="" class="btn btn-dark"><i class="bx bx-printer"></i> Print</a></td>
                      </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
      document.addEventListener('DOMContentLoaded', function(e){
        // radio ceklis
        var radioTrues = document.querySelectorAll('.true-check');
        radioTrues.forEach(radioTrue => {
          radioTrue.addEventListener('change', function(e){
            var getTotalAkhir = document.getElementById('total_akhir');
            var total_akhir = parseInt(getTotalAkhir.value.replace(/,/g, ''));

            if (radioTrue.checked) {
              var tr = radioTrue.parentNode.parentNode;
              tr.className = 'text-dark';
              var total = tr.querySelector('.total');
              total_akhir = total_akhir+parseInt(total.value);
              formatToRupiah = total_akhir.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
              getTotalAkhir.setAttribute('value', formatToRupiah);
            }
          });
        });
        // radio uncheck
        var radioFalses = document.querySelectorAll('.false-check');
        radioFalses.forEach(radioFalse => {
          radioFalse.addEventListener('change', function(e){
            var getTotalAkhir = document.getElementById('total_akhir');
            var total_akhir = parseInt(getTotalAkhir.value.replace(/,/g, ''));

            if (radioFalse.checked) {
              var tr = radioFalse.parentNode.parentNode;
              tr.className = 'text-secondary';
              var total = tr.querySelector('.total');
              console.log(total);
              total_akhir = total_akhir - parseInt(total.value);
              formatToRupiah = total_akhir.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
              getTotalAkhir.setAttribute('value', formatToRupiah);
            }
          });
        });

        // jumlah (x)
        var jumlahXs = document.querySelectorAll('.jumlahX');
        jumlahXs.forEach(jumlahX => {
          jumlahX.addEventListener('change', function(e){
            var tr = jumlahX.parentNode.parentNode;
            var harga = tr.querySelector('.harga').value;
            var total = tr.querySelector('.total');
            temp_total = parseInt(harga) * parseInt(jumlahX.value);
            total.setAttribute("value", temp_total);
            jumlahX.setAttribute('value', jumlahX.value);
            sumAllTotal();
          });
        });
      });

      function sumAllTotal(){
        var temp_total_akhir = 0;
        var getTotalAkhir = document.getElementById('total_akhir');
        var trs = document.querySelectorAll('tr[class="text-dark"]');
        trs.forEach(tr => {
          var totals = tr.querySelectorAll('.total');
          totals.forEach(total => {
            temp_total_akhir += parseInt(total.value);
          });
        });
        formatToRupiah = temp_total_akhir.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        getTotalAkhir.setAttribute('value', formatToRupiah);
      }
    </script>
@endsection
