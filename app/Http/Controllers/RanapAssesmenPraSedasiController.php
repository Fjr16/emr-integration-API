<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Queue;
use App\Models\RanapAsesMoniStatusFungsionalDetail;
use App\Models\RanapAssesmenPraSedation;
use App\Models\RanapAssesmenPraSedationAnestesiInstruction;
use App\Models\RanapAssesmenPraSedationAnestesiPlan;
use App\Models\RanapAssesmenPraSedationNafasEvaluation;
use App\Models\RanapAssesmenPraSedationNafasEvaluationDetail;
use App\Models\RanapAssesmenPraSedationNormalResult;
use App\Models\RanapAssesmenPraSedationOtherExamination;
use App\Models\RanapAssesmenPraSedationPemeriksaanPhysical;
use App\Models\RanapAssesmenPraSedationPersiapanBlood;
use App\Models\RanapAssesmenPraSedationRiwayatDisease;
use App\Models\RanapDpjpPatientDetail;
use App\Models\RanapEwsDewasaPatient;
use App\Models\RawatInapPatient;
use App\Models\SuratPengantarRawatJalanPatient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RanapAssesmenPraSedasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Queue::whereHas('rawatInapPatient')->get();
        return view('pages.asesmenPraSedasi.index', [
            "title" => "Assesmen PRA Sedasi",
            "menu" => "Rawat Inap",
            'data' => $data,
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
        $dataRiwayatPenyakit = [
            'Hipertensi',
            'Asthma',
            'COPD',
            'ISPA',
            'TBC',
            'Efusi Pleura',
            'Epilepsi',
            'Kejang',
            'Stroke',
            'Kelainan Tulang Belakang',
            'Parkinson',
            'Thyroid',
            'Diabetes Melitus',
            'Obesitas',
            'Obesitas Moreid',
            'Penyakit Jantung Koroner',
            'Penyakit Katup Jantung',
            'Pacemaker',
            'Gagal Jantung',
            'Gagal Irama Jantung',
            'Penyakit Ginjal',
            'Gastritis',
            'Hepatitis',
            'Sirosis Hepatis',
            'Malignan Hipertemia',
            'Kehamilan',
            'Geriatri',
        ];

        $dataPemeriksaanFisik = [
            [
                'name' => 'TD',
                'satuan' => 'MMHG',
            ],
            [
                'name' => 'BB',
                'satuan' => 'KG',
            ],
            [
                'name' => 'TB',
                'satuan' => 'CM',
            ],
            [
                'name' => 'NADI',
                'satuan' => 'X/MENIT',
            ],
            [
                'name' => 'RR',
                'satuan' => 'X/MENIT',
            ],
            [
                'name' => 'SUHU',
                'satuan' => '°C',
            ],
        ];

        $dataPemeriksaanLainnya = [
            'MATA',
            'LEHER',
            'COR',
            'PULMO',
            'ABDOMEN',
            'EKSTREMITAS',
        ];
        $dataNormalResults = [
            'Hb',
            'GDS',
            'CT',
            'T3',
            'WBC',
            'GD 2 jam pp',
            'BT',
            'T4',
            'Pit',
            'Ureum',
            'SGOT',
            'TSH',
            'Hct',
            'Creatinin',
            'SGPT',
            'Na',
            'Albumin',
            'K',
            'Cl',
            // 'Lain-lain',
        ];

        $dataRencanaAnestesi = [
            'Anestesi Umum',
            'IV',
            'ETT',
            'LM',
            'Sungkup',
            'Anestesi Regional',
            'Spinal',
            'Epidural',
            'Peripheral Nerve Block (PNB)',
        ];
        $dataPuasa = [
            'Air Bening 2 Jam',
            'Asi 4 Jam',
            'Makan Berat / Susu Formula 6 Jam',
        ];
        $dataPersiapanDarah = [
            [
                'name' => 'PRC',
                'satuan' => '°C',
            ],
            [
                'name' => 'FFP',
                'satuan' => 'CC',
            ],
        ];

        $dataIsCanOperasi = [
            'Operasi Dapat Dilakukan',
            'Operasi Tidak Dapat Dilakukan',
        ];
        $dataRencanaSedasi = [
            'Ringan',
            'Sedang',
            'Dalam',
        ];
        $dataPascaAnestesi = [
            'Rawat Inap',
            'Rawat Jalan',
            'HCU',
        ];

        $dokter = User::where('isDokter', '1')->get();
        $dokterBedah = RanapDpjpPatientDetail::where('rawat_inap_patient_id', $item->id)->where('status', '1')->first();
        //dd($dokterBedah->user->name);
        $suratPengantar = SuratPengantarRawatJalanPatient::where('queue_id', $item->queue_id)->first();
        // dd($suratPengantar);
        return view('pages.asesmenPraSedasi.create', [
            "title" => "Assesmen PRA Sedasi",
            "menu" => "Rawat Inap",
            "item" => $item,
            "dataRiwayatPenyakit" => $dataRiwayatPenyakit,
            "dataPemeriksaanFisik" => $dataPemeriksaanFisik,
            "dataPemeriksaanLainnya" => $dataPemeriksaanLainnya,
            "dataNormalResults" => $dataNormalResults,
            "dataRencanaAnestesi" => $dataRencanaAnestesi,
            "dataPuasa" => $dataPuasa,
            "dataPersiapanDarah" => $dataPersiapanDarah,
            "dataIsCanOperasi" => $dataIsCanOperasi,
            "dataRencanaSedasi" => $dataRencanaSedasi,
            "dataPascaAnestesi" => $dataPascaAnestesi,
            'dokter' => $dokter,
            'dokterBedah' => $dokterBedah,
            'suratPengantar' => $suratPengantar
        ]);
    }

    public function detail($id)
    {

        $item = RawatInapPatient::find($id);
        $data = RanapAssesmenPraSedation::where('rawat_inap_patient_id', $id)->get();
        return view('pages.asesmenPraSedasi.detail', [
            "title" => "Assesmen Pra Sedasi",
            "menu" => "Rawat Inap",
            "item" => $item,
            "data" => $data,
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

        // asesmen pra sedasi
        $arrAsa = $request->input('asa', []);
        $asa = implode(', ', $arrAsa);
        $dataAsesmenPraSedasi = [
            'rawat_inap_patient_id' => $item->id,
            'patient_id' => $item->queue->patient->id,
            'user_id' => Auth::user()->id,
            'tanggal_operasi' => $request->input('tanggal_operasi'),
            'dokter_anestesi' => $request->input('dokter_anestesi'),
            'dokter_bedah' => $request->input('dokter_bedah'),
            'tanggal_pemeriksaan' => $request->input('tanggal_pemeriksaan'),
            'diagnosis' => $request->input('diagnosis'),
            'rencana_operasi' => $request->input('rencana_operasi'),
            'anamnesa' => $request->input('anamnesa'),
            'is_konsumsi' => $request->input('is_konsumsi'),
            'makan_terakhir' => $request->input('makan_terakhir'),
            'minum_terakhir' => $request->input('minum_terakhir'),
            'riwayat_alergi' => $request->input('riwayat_alergi'),
            'hasil_pemeriksaan_lain' => $request->input('hasil_pemeriksaan_lain'),
            'penyulit' => $request->input('penyulit'),
            'asa' => $asa,
            'antisipasi' => $request->input('antisipasi'),
            'is_can_operasi' => $request->input('is_can_operasi'),
            'rencana_sedasi' => $request->input('rencana_sedasi'),
            'pasca_anestesi' => $request->input('pasca_anestesi'),
            'obat_analgesia' => $request->input('obat_analgesia'),
            'ttd_dpjp_anestesi' => $request->input('ttd_dpjp_anestesi'),
        ];

        $mainTb = RanapAssesmenPraSedation::create($dataAsesmenPraSedasi);

        //riwayat disease
        $dataRiwayatPenyakit = $request->input('riwayat_penyakit', []);
        foreach ($dataRiwayatPenyakit as $riwayatPenyakit) {
            if ($riwayatPenyakit) {
                RanapAssesmenPraSedationRiwayatDisease::create([
                    'ranap_assesmen_pra_sedation_id' => $mainTb->id,
                    'name' => $riwayatPenyakit
                ]);
            }
        }
        //pemriksaan phisycal
        $arrPemeriksaanFisik = [
            'TD',
            'BB',
            'TB',
            'NADI',
            'RR',
            'SUHU',
        ];
        $reqPemeriksaanFisik = $request->input('pemeriksaan_fisik', []);

        foreach ($reqPemeriksaanFisik as $index => $reqPF) {
            if ($reqPF) {
                RanapAssesmenPraSedationPemeriksaanPhysical::create([
                    'ranap_assesmen_pra_sedation_id' => $mainTb->id,
                    'name' => $arrPemeriksaanFisik[$index],
                    'value' => $reqPF,
                ]);
            }
        }

        //evaluasi Jalan Nafas
        $dataEvaluasiJalanNafas['ranap_assesmen_pra_sedation_id'] = $mainTb->id;
        $dataEvaluasiJalanNafas['bebas'] = $request->input('bebas');
        $dataEvaluasiJalanNafas['buka_mulut'] = $request->input('buka_mulut');
        $dataEvaluasiJalanNafas['malampathy'] = $request->input('malampathy');
        $dataEvaluasiJalanNafas['jarak_mentohyoid'] = $request->input('jarak_mentohyoid');
        $dataEvaluasiJalanNafas['leher'] = $request->input('leher');
        $dataEvaluasiJalanNafas['gerak_leher'] = $request->input('gerak_leher');
        $dataEvaluasiJalanNafas['gigi_palsu'] = $request->input('gigi_palsu');


        $nafas = RanapAssesmenPraSedationNafasEvaluation::create($dataEvaluasiJalanNafas);

        $dataEvaluasiJalanNafas = $request->input('evaluasiJalanNafas');
        if ($dataEvaluasiJalanNafas) {
            foreach ($dataEvaluasiJalanNafas as $evaluasiNafas) {
                if ($evaluasiNafas) {
                    RanapAssesmenPraSedationNafasEvaluationDetail::create([
                        'ranap_assesmen_pra_sedation_nafas_evaluation_id' => $nafas->id,
                        'keterangan' => $evaluasiNafas,
                    ]);
                }
            }
        }
        //pemeriksaan lainnya
        $arrPemeriksaanLainnya = [
            'MATA',
            'LEHER',
            'COR',
            'PULMO',
            'ABDOMEN',
            'EKSTREMITAS',
        ];
        $reqOtherExaminations = $request->input('other_examination', []);
        foreach ($reqOtherExaminations as $key => $reqOE) {
            if ($reqOE) {
                RanapAssesmenPraSedationOtherExamination::create([
                    'ranap_assesmen_pra_sedation_id' => $mainTb->id,
                    'name' => $arrPemeriksaanLainnya[$key],
                    'value' => $reqOE,
                ]);
            }
        }

        //normal Results
        $arrNormalResult = [
            'Hb',
            'GDS',
            'CT',
            'T3',
            'WBC',
            'GD 2 jam pp',
            'BT',
            'T4',
            'Pit',
            'Ureum',
            'SGOT',
            'TSH',
            'Hct',
            'Creatinin',
            'SGPT',
            'Na',
            'Albumin',
            'K',
            'Cl',
        ];
        $reqNormalResult = $request->input('normal_result', []);
        foreach ($reqNormalResult as $key => $reqNR) {
            if ($reqNR) {
                RanapAssesmenPraSedationNormalResult::create([
                    'ranap_assesmen_pra_sedation_id' => $mainTb->id,
                    'name' => $arrNormalResult[$key],
                    'value' => $reqNR,
                ]);
            }
        }

        // anestesi plan
        $dataAnestesiPlan = $request->input('anestesi_plan', []);
        foreach ($dataAnestesiPlan as $anestesiPlan) {
            RanapAssesmenPraSedationAnestesiPlan::create([
                'ranap_assesmen_pra_sedation_id' => $mainTb->id,
                'name' => $anestesiPlan,
            ]);
        }

        // Anestesi Intruksi
        $dataAnestesiIntruksi = [
            'ranap_assesmen_pra_sedation_id' => $mainTb->id,
            'puasa' => $request->input('puasa'),
            'obat_diberikan' => $request->input('obat_diberikan'),
            'obat_diberhentikan' => $request->input('obat_diberhentikan'),
            'persiapan_darah' => $request->input('persiapan_darah'),
        ];

        if ($intruksi = RanapAssesmenPraSedationAnestesiInstruction::create($dataAnestesiIntruksi)) {
            //detail persiapan darah
            $reqPersiapanDarahName = $request->input('detail_persiapan_darah_name', []);
            $reqPersiapanDarahValue = $request->input('detail_persiapan_darah_value', []);
            foreach ($reqPersiapanDarahName as $key => $name) {
                RanapAssesmenPraSedationPersiapanBlood::create([
                    'ranap_assesmen_pra_sedation_anestesi_instruction_id' => $intruksi->id,
                    'name' => $name,
                    'value' => $reqPersiapanDarahValue[$key],
                ]);
            }
        }


        return redirect()->route('assesmen/pra/sedasi.detail', $item->id)->with([
            'success' => 'Berhasil Ditambahkan',
            'btn' => 'asesmenprasedasi',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = RanapAssesmenPraSedation::find($id);
        $dataRiwayatPenyakit = [
            'Hipertensi',
            'Asthma',
            'COPD',
            'ISPA',
            'TBC',
            'Efusi Pleura',
            'Epilepsi',
            'Kejang',
            'Stroke',
            'Kelainan Tulang Belakang',
            'Parkinson',
            'Thyroid',
            'Diabetes Melitus',
            'Obesitas',
            'Obesitas Moreid',
            'Penyakit Jantung Koroner',
            'Penyakit Katup Jantung',
            'Pacemaker',
            'Gagal Jantung',
            'Gagal Irama Jantung',
            'Penyakit Ginjal',
            'Gastritis',
            'Hepatitis',
            'Sirosis Hepatis',
            'Malignan Hipertemia',
            'Kehamilan',
            'Geriatri',
        ];

        $dataPemeriksaanFisik = [
            [
                'name' => 'TD',
                'satuan' => 'MMHG',
            ],
            [
                'name' => 'BB',
                'satuan' => 'KG',
            ],
            [
                'name' => 'TB',
                'satuan' => 'CM',
            ],
            [
                'name' => 'NADI',
                'satuan' => 'X/MENIT',
            ],
            [
                'name' => 'RR',
                'satuan' => 'X/MENIT',
            ],
            [
                'name' => 'SUHU',
                'satuan' => '°C',
            ],
        ];

        $dataPemeriksaanLainnya = [
            'MATA',
            'LEHER',
            'COR',
            'PULMO',
            'ABDOMEN',
            'EKSTREMITAS',
        ];
        $dataNormalResults = [
            'Hb',
            'GDS',
            'CT',
            'T3',
            'WBC',
            'GD 2 jam pp',
            'BT',
            'T4',
            'Pit',
            'Ureum',
            'SGOT',
            'TSH',
            'Hct',
            'Creatinin',
            'SGPT',
            'Na',
            'Albumin',
            'K',
            'Cl',
            // 'Lain-lain',
        ];

        $dataRencanaAnestesi = [
            'Anestesi Umum',
            'IV',
            'ETT',
            'LM',
            'Sungkup',
            'Anestesi Regional',
            'Spinal',
            'Epidural',
            'Peripheral Nerve Block (PNB)',
        ];
        $dataPuasa = [
            'Air Bening 2 Jam',
            'Asi 4 Jam',
            'Makan Berat / Susu Formula 6 Jam',
        ];
        $dataPersiapanDarah = [
            [
                'name' => 'PRC',
                'satuan' => '°C',
            ],
            [
                'name' => 'FFP',
                'satuan' => 'CC',
            ],
        ];

        $dataIsCanOperasi = [
            'Operasi Dapat Dilakukan',
            'Operasi Tidak Dapat Dilakukan',
        ];
        $dataRencanaSedasi = [
            'Ringan',
            'Sedang',
            'Dalam',
        ];
        $dataPascaAnestesi = [
            'Rawat Inap',
            'Rawat Jalan',
            'HCU',
        ];

        $tgl_operasi = date('Y-m-d', strtotime($item->tanggal_operasi));
        $statusFisik = explode(', ', $item->asa);

        $dokter = User::where('isDokter', '1')->get();
        $jalanNafas = RanapAssesmenPraSedationNafasEvaluationDetail::where('ranap_assesmen_pra_sedation_nafas_evaluation_id', $item->ranapAssesmenPraSedationNafasEvaluations->id)->get();
        return view('pages.asesmenPraSedasi.edit', [
            "title" => "Assesmen PRA Sedasi",
            "menu" => "Rawat Inap",
            "item" => $item,
            "tgl_operasi" => $tgl_operasi,
            "statusFisik" => $statusFisik,
            "dataRiwayatPenyakit" => $dataRiwayatPenyakit,
            "dataPemeriksaanFisik" => $dataPemeriksaanFisik,
            "dataPemeriksaanLainnya" => $dataPemeriksaanLainnya,
            "dataNormalResults" => $dataNormalResults,
            "dataRencanaAnestesi" => $dataRencanaAnestesi,
            "dataPuasa" => $dataPuasa,
            "dataPersiapanDarah" => $dataPersiapanDarah,
            "dataIsCanOperasi" => $dataIsCanOperasi,
            "dataRencanaSedasi" => $dataRencanaSedasi,
            "dataPascaAnestesi" => $dataPascaAnestesi,
            "dokter" => $dokter,
            'jalanNafas' => $jalanNafas,
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
        $item = RanapAssesmenPraSedation::find($id);

        // asesmen pra sedasi
        $arrAsa = $request->input('asa', []);
        $asa = implode(', ', $arrAsa);
        $dataAsesmenPraSedasi = [
            'tanggal_operasi' => $request->input('tanggal_operasi'),
            'dokter_anestesi' => $request->input('dokter_anestesi'),
            'dokter_bedah' => $request->input('dokter_bedah'),
            'tanggal_pemeriksaan' => $request->input('tanggal_pemeriksaan'),
            'diagnosis' => $request->input('diagnosis'),
            'rencana_operasi' => $request->input('rencana_operasi'),
            'anamnesa' => $request->input('anamnesa'),
            'is_konsumsi' => $request->input('is_konsumsi'),
            'makan_terakhir' => $request->input('makan_terakhir'),
            'minum_terakhir' => $request->input('minum_terakhir'),
            'riwayat_alergi' => $request->input('riwayat_alergi'),
            'hasil_pemeriksaan_lain' => $request->input('hasil_pemeriksaan_lain'),
            'penyulit' => $request->input('penyulit'),
            'asa' => $asa,
            'antisipasi' => $request->input('antisipasi'),
            'is_can_operasi' => $request->input('is_can_operasi'),
            'rencana_sedasi' => $request->input('rencana_sedasi'),
            'pasca_anestesi' => $request->input('pasca_anestesi'),
            'obat_analgesia' => $request->input('obat_analgesia'),
        ];
        if ($item->ttd_dpjp_anestesi != $request->input('ttd_dpjp_anestesi')) {
            $dataAsesmenPraSedasi['ttd_dpjp_anestesi'] = $request->input('ttd_dpjp_anestesi');
        }

        $item->update($dataAsesmenPraSedasi);

        //riwayat disease
        $item->ranapAssesmenPraSedationRiwayatDiseases()->delete();
        $dataRiwayatPenyakit = $request->input('riwayat_penyakit', []);
        foreach ($dataRiwayatPenyakit as $riwayatPenyakit) {
            if ($riwayatPenyakit) {
                RanapAssesmenPraSedationRiwayatDisease::create([
                    'ranap_assesmen_pra_sedation_id' => $item->id,
                    'name' => $riwayatPenyakit
                ]);
            }
        }

        //pemriksaan phisycal
        $item->ranapAssesmenPraSedationPemeriksaanPhysicals()->delete();
        $arrPemeriksaanFisik = [
            'TD',
            'BB',
            'TB',
            'NADI',
            'RR',
            'SUHU',
        ];
        $reqPemeriksaanFisik = $request->input('pemeriksaan_fisik', []);


        foreach ($reqPemeriksaanFisik as $index => $reqPF) {
            if ($reqPF) {
                RanapAssesmenPraSedationPemeriksaanPhysical::create([
                    'ranap_assesmen_pra_sedation_id' => $item->id,
                    'name' => $arrPemeriksaanFisik[$index],
                    'value' => $reqPF,
                ]);
            }
        }

        //evaluasi Jalan Nafas
        $item->ranapAssesmenPraSedationNafasEvaluations->delete();
        $dataEvaluasiJalanNafas['ranap_assesmen_pra_sedation_id'] = $item->id;
        $dataEvaluasiJalanNafas['bebas'] = $request->input('bebas');
        $dataEvaluasiJalanNafas['buka_mulut'] = $request->input('buka_mulut');
        $dataEvaluasiJalanNafas['malampathy'] = $request->input('malampathy');
        $dataEvaluasiJalanNafas['jarak_mentohyoid'] = $request->input('jarak_mentohyoid');
        $dataEvaluasiJalanNafas['leher'] = $request->input('leher');
        $dataEvaluasiJalanNafas['gerak_leher'] = $request->input('gerak_leher');
        $dataEvaluasiJalanNafas['gigi_palsu'] = $request->input('gigi_palsu');

        $nafas = RanapAssesmenPraSedationNafasEvaluation::create($dataEvaluasiJalanNafas);
        RanapAssesmenPraSedationNafasEvaluationDetail::where('ranap_assesmen_pra_sedation_nafas_evaluation_id', $nafas->id)->delete();
        $dataEvaluasiJalanNafas = $request->input('evaluasiJalanNafas');
        if ($dataEvaluasiJalanNafas) {
            foreach ($dataEvaluasiJalanNafas as $evaluasiNafas) {
                if ($evaluasiNafas) {
                    RanapAssesmenPraSedationNafasEvaluationDetail::create([
                        'ranap_assesmen_pra_sedation_nafas_evaluation_id' => $nafas->id,
                        'keterangan' => $evaluasiNafas,
                    ]);
                }
            }
        }
        //pemeriksaan lainnya
        $item->ranapAssesmenPraSedationOtherExaminations()->delete();
        $arrPemeriksaanLainnya = [
            'MATA',
            'LEHER',
            'COR',
            'PULMO',
            'ABDOMEN',
            'EKSTREMITAS',
        ];
        $reqOtherExaminations = $request->input('other_examination', []);
        foreach ($reqOtherExaminations as $key => $reqOE) {
            if ($reqOE) {
                RanapAssesmenPraSedationOtherExamination::create([
                    'ranap_assesmen_pra_sedation_id' => $item->id,
                    'name' => $arrPemeriksaanLainnya[$key],
                    'value' => $reqOE,
                ]);
            }
        }

        //normal Results
        $item->ranapAssesmenPraSedationNormalResults()->delete();
        $arrNormalResult = [
            'Hb',
            'GDS',
            'CT',
            'T3',
            'WBC',
            'GD 2 jam pp',
            'BT',
            'T4',
            'Pit',
            'Ureum',
            'SGOT',
            'TSH',
            'Hct',
            'Creatinin',
            'SGPT',
            'Na',
            'Albumin',
            'K',
            'Cl',
        ];
        $reqNormalResult = $request->input('normal_result', []);
        foreach ($reqNormalResult as $key => $reqNR) {
            if ($reqNR) {
                RanapAssesmenPraSedationNormalResult::create([
                    'ranap_assesmen_pra_sedation_id' => $item->id,
                    'name' => $arrNormalResult[$key],
                    'value' => $reqNR,
                ]);
            }
        }

        // anestesi plan
        $item->ranapAssesmenPraSedationAnestesiPlans()->delete();
        $dataAnestesiPlan = $request->input('anestesi_plan', []);
        foreach ($dataAnestesiPlan as $anestesiPlan) {
            RanapAssesmenPraSedationAnestesiPlan::create([
                'ranap_assesmen_pra_sedation_id' => $item->id,
                'name' => $anestesiPlan,
            ]);
        }

        // Anestesi Intruksi
        $item->ranapAssesmenPraSedationAnestesiInstructions->ranapAssesmenPraSedationPersiapanBloods()->delete();
        $item->ranapAssesmenPraSedationAnestesiInstructions->delete();
        $dataAnestesiIntruksi = [
            'ranap_assesmen_pra_sedation_id' => $item->id,
            'puasa' => $request->input('puasa'),
            'obat_diberikan' => $request->input('obat_diberikan'),
            'obat_diberhentikan' => $request->input('obat_diberhentikan'),
            'persiapan_darah' => $request->input('persiapan_darah'),
        ];

        if ($intruksi = RanapAssesmenPraSedationAnestesiInstruction::create($dataAnestesiIntruksi)) {
            //detail persiapan darah
            $reqPersiapanDarahName = $request->input('detail_persiapan_darah_name', []);
            $reqPersiapanDarahValue = $request->input('detail_persiapan_darah_value', []);
            foreach ($reqPersiapanDarahName as $key => $name) {
                RanapAssesmenPraSedationPersiapanBlood::create([
                    'ranap_assesmen_pra_sedation_anestesi_instruction_id' => $intruksi->id,
                    'name' => $name,
                    'value' => $reqPersiapanDarahValue[$key],
                ]);
            }
        }


        return redirect()->route('assesmen/pra/sedasi.detail', $item->rawatInapPatient->id)->with([
            'success' => 'Berhasil Diperbarui',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = RanapAssesmenPraSedation::find($id);
        $item->ranapAssesmenPraSedationRiwayatDiseases()->delete();
        $item->ranapAssesmenPraSedationPemeriksaanPhysicals()->delete();
        $item->ranapAssesmenPraSedationNafasEvaluations->delete();
        $item->ranapAssesmenPraSedationOtherExaminations()->delete();
        $item->ranapAssesmenPraSedationNormalResults()->delete();
        $item->ranapAssesmenPraSedationAnestesiPlans()->delete();
        $item->ranapAssesmenPraSedationAnestesiInstructions->ranapAssesmenPraSedationPersiapanBloods()->delete();
        $item->ranapAssesmenPraSedationAnestesiInstructions->delete();
        $item->delete();

        return back()->with([
            'success' => 'Berhasil Dihapus',
            'btn' => 'asesmenprasedasi',
        ]);
    }
}
