@extends('layouts.backend.main')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content; left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="card p-3 mt-5 ">

        <div class="d-flex">
            <h4 class="align-self-center m-0">ASESMEN DAN MONITORING RISIKO JATUH</h4>
        </div>
        <hr class="m-0 mt-2 mb-3">
        <form action="{{ route('kemoterapi/monitoring/resiko/jatuh.update', $monitoring->id) }}" method="POST" onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
            @csrf
            @method('PUT')
            <div class="card-body table-responsive">
                <table class="table table-bordered ">
                    <tr class="text-center">
                        <td colspan="8">
                            <div>
                                @if ($usia > 12 && $usia <= 65)
                                {{-- usia > 12 && usia <= 65 tahun --}}
                                    <p class="text-center">ASESMEN RISIKO JATUH MORSE FALL SCALE
                                        PADA PASIEN DEWASA USIA > 12 SAMPAI USIA 65 TAHUN
                                    </p>
                                    <div class="text-start mt-2">
                                        <p class="m-0"><em>Keterangan</em></p>
                                        <ol>
                                            <li>Resiko Rendah : 0 - 24</li>
                                            <li>Resiko Sedang : 25 - 44</li>
                                            <li>Resiko tinggi : >= 45</li>
                                        </ol>
                                    </div>
                                @elseif ($usia > 65)
                                    {{-- usia > 65 tahun --}}
                                    <p class="text-center">ASESMEN RISIKO JATUH HENDRICH SCALE
                                        PADA PASIEN USIA > 65 TAHUN
                                    </p>
                                    <div class="text-start mt-2">
                                        <p class="m-0"><em>Keterangan</em></p>
                                        <ol>
                                            <li>Resiko Rendah : 0 - 7</li>
                                            <li>Resiko Sedang : 8 - 13</li>
                                            <li>Resiko tinggi : >= 14</li>
                                        </ol>
                                    </div>
                                @elseif ($usia <= 12)
                                    {{-- usia <=12 tahun --}}
                                    <p class="text-center">ASESMEN RISIKO JATUH HUMTY DUMPTY SCALE
                                        PADA PASIEN USIA <= 12 TAHUN </p>
                                    <div class="text-start mt-2">
                                        <p class="m-0"><em>Keterangan</em></p>
                                        <ol>
                                            <li>Skor minimum 7, maksimum 23</li>
                                            <li>Resiko rendah : 7 - 11 </li>
                                            <li>Resiko tinggi : >= 12</li>
                                        </ol>
                                    </div>
                                @endif
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td rowspan="3" class="text-center" style="min-width: 150px">{{ $usia <= 12 ? 'PARAMETER' : 'FAKTOR RISIKO'}}</td>
                        <td rowspan="3" class="text-center" style="min-width: 300px">SKALA</td>
                        <td>Tanggal</td>
                        <td style="min-width: 300px"><input type="date" name="tanggal" value="{{ $monitoring->tanggal }}" class="form-control form-control-sm"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <select name="tipe" id="tipe" class="form-select form-control">
                                <option value="Awal Masuk Pasien (A)" {{$monitoring->tipe == 'Awal Masuk Pasien (A)' ? 'selected' : ''}}>Awal Masuk Pasien (A)</option>
                                <option value="Perubahan Kondisi Pasien (PK)" {{$monitoring->tipe == 'Perubahan Kondisi Pasien (PK)' ? 'selected' : ''}}>Perubahan Kondisi Pasien (PK)</option>
                                <option value="Transfer Pasien (T)" {{$monitoring->tipe == 'Transfer Pasien (T)' ? 'selected' : ''}}>Transfer Pasien (T)</option>
                                <option value="Setelah Jatuh (SJ)" {{$monitoring->tipe == 'Setelah Jatuh (SJ)' ? 'selected' : ''}}>Setelah Jatuh (SJ)</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="text-center">
                        <td colspan="2">
                            <p class="m-0">SKOR</p>
                        </td>
                    </tr>

                    @foreach ($data as $index => $item)
                    @php
                        $d = $details[$index];
                    @endphp
                        <tr>
                            <td>
                                {{ $item['faktor_resiko'] }}
                                <input type="hidden" name="data[{{ $index }}][id]" value="{{ $d->id }}">
                                <input type="hidden" name="data[{{ $index }}][name]" value="{{ $item['faktor_resiko'] }}">
                            </td>
                            <td>
                                @foreach ($item['skala'] as $skala)
                                <p class="m-0 {{ $loop->first ? '' : 'mt-3' }}">{{ $skala }}</p>
                                @endforeach
                            </td>
                            <td colspan="2">
                                <div class="d-grid cols-1 justify-content-center">
                                    @foreach ($item['skor'] as $skor)
                                    <div class="form-check form-check-inline {{ $loop->first ? '' : 'mt-3' }}">
                                        @if ($usia <= 12)
                                            <input class="form-check-input" name="data[{{ $index }}][skor]" value="{{ $skor }}" type="radio" id="{{ $item['faktor_resiko'] }}{{ $loop->iteration }}" onclick="hitungTotalSkor()" {{ $skor == $d->skor ? 'checked' : '' }}/>
                                        @else
                                            <input class="form-check-input" name="data[{{ $index }}][skor]" value="{{ $skor }}" type="radio" id="{{ $item['faktor_resiko'] }}{{ $loop->iteration }}" onclick="hitungTotalSkor()" {{ $skor == $d->skor ? 'checked' : '' }}/>
                                        @endif
                                            <label class="form-check-label" for="{{ $item['faktor_resiko'] }}{{ $loop->iteration }}">{{ $skor }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3">
                            <h6 class="m-0">TOTAL SKOR</h6>
                        </td>
                        <td><input type="text" name="total_skor" id="totalSkor" value="{{ $monitoring->total_skor }}" class=" form-control form-control-sm" @readonly(true)></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <h6 class="m-0">Nilai Skor (RR/RS/RT)</h6>
                        </td>
                        <td><input type="text" name="nilai_skor" id="nilaiSkor"  value="{{$monitoring->nilai_skor}}" class="form-control form-control-sm" @readonly(true)></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <h6 class="m-0">Nama Perawat (Inisial) </h6>
                        </td>
                        <td colspan="2"><input type="text" class="form-control form-control-sm" value="{{ Auth::user()->name ?? '' }}" disabled></td>

                    </tr>
                </table>

                <div class="mb-3 mt-5  text-end">
                    <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        function hitungTotalSkor(){
            var radios = document.querySelectorAll('input[type="radio"]:checked');

            var totalSkor = 0;
            radios.forEach(function(radio){
                totalSkor += parseInt(radio.value);
            });

            var inputTotal = document.getElementById('totalSkor');
            inputTotal.value = totalSkor;

            var nilai_skor = '';
            if({{ $usia }} > 12 && {{ $usia }} <=65){
                nilai_skor = nilaiSkor1(totalSkor);
            }
            if({{ $usia }} > 65){
                nilai_skor = nilaiSkor2(totalSkor);
            }
            if({{ $usia }} <= 12){
                nilai_skor = nilaiSkor3(totalSkor);
            }

            var inputNilai = document.getElementById('nilaiSkor');
            inputNilai.value = nilai_skor;
        }

        //pasien usia > 12 - <= 65 tahun
        function nilaiSkor1(totalSkor){
            if(totalSkor >= 0 && totalSkor <= 24){
                return 'RR';
            }else if (totalSkor >= 25 && totalSkor <= 44){
                return 'RS';
            }else if(totalSkor >= 45){
                return 'RT';
            }
        }

        //pasien usia > 65 tahun
        function nilaiSkor2(totalSkor){
            if(totalSkor >= 0 && totalSkor <= 7){
                return 'RR';
            }else if (totalSkor >= 8 && totalSkor <= 13){
                return 'RS';
            }else if(totalSkor >= 14){
                return 'RT';
            }
        }

        //pasien usia <= 12 tahun
        function nilaiSkor3(totalSkor){
            if(totalSkor >= 7 && totalSkor <= 11){
                return 'RR';
            }else if(totalSkor >= 12){
                return 'RT';
            }
        }
    </script>
@endsection
