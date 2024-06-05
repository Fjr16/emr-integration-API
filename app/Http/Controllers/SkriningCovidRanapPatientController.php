<?php

namespace App\Http\Controllers;

use App\Models\DetailParameterSkriningCovidRanapPatient;
use App\Models\DetailSkriningCovidRanapPatient;
use App\Models\Patient;
use App\Models\RawatInapPatient;
use App\Models\SkriningCovidRanapPatient;
use Illuminate\Http\Request;

class SkriningCovidRanapPatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = SkriningCovidRanapPatient::with('pasien')->get();
        return view('pages.skriningCovid.index', [
            "title" => "Skrining Covid",
            "menu" => "Poliklinik",
            "data" => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $item = RawatInapPatient::find($id);
        $patients = Patient::get()->all();
        return view('pages.skriningCovid.create', [
            "title" => "Skrining Covid",
            "menu" => "Poliklinik",
            "patients" => $patients,
            "item" => $item,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $item = RawatInapPatient::find($id);
        // Validasi data
        $request->validate(
            [
                'no' => 'required',
                'name' => 'required',
                // 'score' => 'array',
                // 'ket' => 'array',
                // 'score.*' => 'required',
            ]
        );

        $check1 = $request->input('check1');
        $check2 = $request->input('check2');
        $check3 = $request->input('check3');
        $check4 = $request->input('check4');
        $check5 = $request->input('check5');
        $check6 = $request->input('check6');
        $scores = [
            $check1,
            $check2,
            $check3,
            $check4,
            $check5,
            $check6,
        ];
        $nos = $request->input('no', []);
        $names = $request->input('name', []);
        $kets = $request->input('ket', []);
        $detailNames = $request->input('detail-name', []);
        $detailKets = $request->input('detail-ket', []);
        $totalSkor = $request->input('total_skor', 0);

        $skriningCovid = SkriningCovidRanapPatient::create([
            'patient_id' => $item->queue->patient->id,
            'rawat_inap_patient_id' => $id,
            'total_skor' => $totalSkor,
        ]);

        foreach ($scores as $key => $score) {
            $name = $names[$key];
            $no = $nos[$key];
            $ket = $kets[$key];
            $check = '';
            if ($key == 0 || $key == 1) {
                if ($score == '5') {
                    $check = 'Ya';
                } else {
                    $check = 'Tidak';
                }
            }

            if ($key == 2 || $key == 3 || $key == 4 || $key == 5) {
                if ($score == '1') {
                    $check = 'Ya';
                } else {
                    $check = 'Tidak';
                }
            }

            $detailskriningCovidRanapPatient = DetailSkriningCovidRanapPatient::create([
                'skrining_covid_ranap_patient_id' => $skriningCovid->id,
                'no' => $no,
                'name' => $name,
                'check' => $check,
                'score' => $score,
                'ket' => $ket,
            ]);
            if ($key == 1 && $check == 'Ya') {
                foreach ($detailNames as $k => $detail) {
                    if ($detailKets[$k] == null) {
                        $detailKet = '-';
                    } else {
                        $detailKet = $detailKets[$k];
                        // dd($detailKet);
                    }

                    DetailParameterSkriningCovidRanapPatient::create([
                        'detail_skrining_covid_ranap_patient_id' => $detailskriningCovidRanapPatient->id,
                        'name'   => $detail,
                        'ket'   => $detailKet,
                    ]);
                }
            }
        }

        return redirect()->route('rawat/inap.show', $item->id)->with('success', 'Berhasil Di Tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = SkriningCovidRanapPatient::find($id);
        $patients = Patient::get()->all();
        $data = $item->id;
        $datas = DetailSkriningCovidRanapPatient::where('skrining_covid_ranap_patient_id', $data)->get();

        return view('pages.skriningCovid.edit', [
            "title" => "Skrining Covid",
            "menu" => "Poliklinik",
            "item" => $item,
            "datas" => $datas,
            "patients" => $patients,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = SkriningCovidRanapPatient::find($id);
        $detailIds = DetailSkriningCovidRanapPatient::where('skrining_covid_ranap_patient_id', $item->id)->pluck('id');


        // dd($detailIds[]);
        $check1 = $request->input('check1');
        $check2 = $request->input('check2');
        $check3 = $request->input('check3');
        $check4 = $request->input('check4');
        $check5 = $request->input('check5');
        $check6 = $request->input('check6');
        $checks = [
            $check1,
            $check2,
            $check3,
            $check4,
            $check5,
            $check6,
        ];

        $nos = $request->input('no', []);
        $names = $request->input('name', []);
        $kets = $request->input('ket', []);
        $detailNames = $request->input('detail-name', []);
        $detailKets = $request->input('detail-ket', []);

        foreach ($detailIds as $key => $detailId) {
            $detailSkrining = DetailSkriningCovidRanapPatient::find($detailId);
            $no = $nos[$key];
            $name = $names[$key];
            $check = $checks[$key];
            $ket = $kets[$key];
            $score = 0; // Default score

            if ($key == 0 || $key == 1) {
                if ($check == 'Ya') {
                    $score = '5';
                } else {
                    $score = '0';
                }
            }
            if ($key >= 2 && $key <= 5) {
                if ($check == 'Ya') {
                    $score = '1';
                } else {
                    $score = '0';
                }
            }

            $detailSkrining->update([
                'skrining_covid_ranap_patient_id' => $item->id,
                'no' => $no,
                'name' => $name,
                'check' => $check,
                'score' => $score,
                'ket' => $ket,
            ]);
            if ($key == 1 && $check == 'Ya') {

                $detailSkriningCheck = DetailSkriningCovidRanapPatient::where('skrining_covid_ranap_patient_id', $id)->where('name', 'Apakah Anda atau siapapun dirumah sedang mengalami :')->first();

                $detailParameterSkriningCovid = DetailParameterSkriningCovidRanapPatient::where('detail_skrining_covid_ranap_patient_id', $detailSkriningCheck->id)->get();
                foreach ($detailParameterSkriningCovid as $detailCovid) {
                    $detailCovid->delete();
                }
                if ($key == 1 && $check == 'Ya') {
                    foreach ($detailNames as $k => $detail) {
                        if ($detailKets[$k] == null) {
                            $detailKet = '-';
                        } else {
                            $detailKet = $detailKets[$k];
                        }

                        DetailParameterSkriningCovidRanapPatient::create([
                            'detail_skrining_covid_ranap_patient_id' => $detailSkrining->id,
                            'name'   => $detail,
                            'ket'   => $detailKet,
                        ]);
                    }
                }
            }
        }
        return redirect()->route('rawat/inap.show', $item->rawatInapPatient->id)->with('success', 'Berhasil Di Tambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = SkriningCovidRanapPatient::find($id);
        $item->delete();

        return redirect()->route('skrining/covid.index', $item->rawatInapPatient->id)->with('success', 'Berhasil Dihapus');
    }
}
