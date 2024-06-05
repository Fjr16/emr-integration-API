<?php

namespace App\Http\Controllers;

use App\Models\LaporanOperasiPatient;
use App\Models\Queue;
use App\Models\RanapAssesmenPraAnestesiChecklist;
use App\Models\RanapAssesmenPraAnestesiInduction;
use App\Models\RanapAssesmenPraAnestesiMonitoring;
use App\Models\RanapAssesmenPraAnestesiSpecialTool;
use App\Models\RanapAssesmenPraAnestesiTechnique;
use App\Models\RanapAssesmenPraAnesthesia;
use App\Models\RanapDpjpPatientDetail;
use App\Models\RawatInapPatient;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RanapAssesmenPraAnestesiPraInduksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Queue::whereHas('rawatInapPatient')->get();
        return view('pages.asesmenPraAnestesiPraInduksi.index', [
            "title" => "Assesmen PRA Anestesi Pra Induksi",
            "menu" => "Rawat Inap",
            'data' => $data,
        ]);
    }


    public function detail($id)
    {

        $item = RawatInapPatient::find($id);
        $data = RanapAssesmenPraAnesthesia::where('rawat_inap_patient_id', $id)->get();
        return view('pages.asesmenPraAnestesiPraInduksi.detail', [
            "title" => "Assesmen PRA Anestesi Pra Induksi",
            "menu" => "Rawat Inap",
            "item" => $item,
            "data" => $data,
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
        $dataCeklist = [
            'Informed Consent',
            'Obat-obatan Anestesi',
            'Tata Laksana Jalan Nafas',
            'Mesin Anestesi',
            'Monitoring',
            'Obat-obatan Emergensi',
            'Sunction Apparatus',
        ];
        $dataTeknik = [
            'Anestesi Umum',
            'Spinal',
            'Blok Perifer',
            'Epidural',
            //'Kaudal',
        ];
        $dataMonitoring = [
            'EKG lead',
            'NIBP',
            'Temp',
            'Kateter Urin',
            'NGT',
            'CVP',
            'SpO2',
            'FiO',
            'BLS',
        ];
        $dokter = User::where('isDokter', '1')->get();
        $dokterBedah = RanapDpjpPatientDetail::where('rawat_inap_patient_id', $item->id)->where('status', '1')->first();
        $laporanOperasi = LaporanOperasiPatient::where('rawat_inap_patient_id', $item->id)->first();
        return view('pages.asesmenPraAnestesiPraInduksi.create', [
            "title" => "Assesmen PRA Anestesi Pra Induksi",
            "menu" => "Rawat Inap",
            "item" => $item,
            "dataCeklist" => $dataCeklist,
            "dataTeknik" => $dataTeknik,
            "dataMonitoring" => $dataMonitoring,
            "dokter" => $dokter,
            "dokterBedah" => $dokterBedah,
            "laporanOperasi" => $laporanOperasi
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
        //ass pra anestesi main tb
        $statusFisikTemp = $request->input('status_fisik', []);
        $statusFisik = implode(', ', $statusFisikTemp);
        $dataAssAnestesi = [
            'rawat_inap_patient_id' => $item->id,
            'patient_id' => $item->queue->patient->id,
            'user_id' => Auth::user()->id,
            'tanggal' => $request->input('tanggal'),
            'dokter_anestesi' => $request->input('dokter_anestesi'),
            'asisten_anestesi' => $request->input('asisten_anestesi'),
            'dokter_bedah' => $request->input('dokter_bedah'),
            'diagnosis_pra_bedah' => $request->input('diagnosis_pra_bedah'),
            'jenis_pembedahan' => $request->input('jenis_pembedahan'),
            'diagnosis_pasca_bedah' => $request->input('diagnosis_pasca_bedah'),
            'jam_operasi' => $request->input('jam_operasi'),
            'puasa_jam' => $request->input('puasa_jam'),
            'status_fisik' => $statusFisik,
            'isAlergi' => $request->input('isAlergi'),
            'penyulit_pra_anestesi' => $request->input('penyulit_pra_anestesi'),
            'ttd_dokter_anestesi' => $request->input('ttd_dokter_anestesi'),
        ];
        $mainTb = RanapAssesmenPraAnesthesia::create($dataAssAnestesi);

        //ceklist
        $dataAnestesiChecklist = $request->input('anestesi_checklist', []);
        foreach ($dataAnestesiChecklist as $ceklis) {
            RanapAssesmenPraAnestesiChecklist::create([
                'ranap_assesmen_pra_anesthesia_id' => $mainTb->id,
                'name' => $ceklis,
            ]);
        }

        //teknik
        $tempAnestesiTeknikName = $request->input('anestesi_teknik_temp_name', []);
        $tempAnestesiTeknikValue = $request->input('anestesi_teknik_temp_value', []);
        foreach ($tempAnestesiTeknikName as $key => $name) {
            RanapAssesmenPraAnestesiTechnique::create([
                'ranap_assesmen_pra_anesthesia_id' => $mainTb->id,
                'name' => $name,
                'value' => $tempAnestesiTeknikValue[$key],
            ]);
        }
        $dataAnestesiTeknik = $request->input('anestesi_technique', []);
        foreach ($dataAnestesiTeknik as $teknik) {
            RanapAssesmenPraAnestesiTechnique::create([
                'ranap_assesmen_pra_anesthesia_id' => $mainTb->id,
                'name' => $teknik,
            ]);
        }

        // special tools
        $dataAnestesiSpecialTools = $request->input('special_tool', []);
        foreach ($dataAnestesiSpecialTools as $specialTool) {
            if ($specialTool) {
                RanapAssesmenPraAnestesiSpecialTool::create([
                    'ranap_assesmen_pra_anesthesia_id' => $mainTb->id,
                    'name' => $specialTool,
                ]);
            }
        }

        // monitoring
        $dataAnestesiMonitoring = $request->input('monitoring', []);
        foreach ($dataAnestesiMonitoring as $monitoring) {
            if ($monitoring) {
                RanapAssesmenPraAnestesiMonitoring::create([
                    'ranap_assesmen_pra_anesthesia_id' => $mainTb->id,
                    'name' => $monitoring,
                ]);
            }
        }

        // pra induksi
        RanapAssesmenPraAnestesiInduction::create([
            'ranap_assesmen_pra_anesthesia_id' => $mainTb->id,
            'keluhan' => $request->input('keluhan'),
            'kesadaran' => $request->input('kesadaran'),
            'td' => $request->input('td'),
            'hr' => $request->input('hr'),
            'rr' => $request->input('rr'),
            'temperature' => $request->input('temperature'),
            'saturasi' => $request->input('saturasi'),
            'lainnya' => $request->input('lainnya'),
        ]);

        return redirect()->route('assesmen/pra/anestesi/pra/induksi.detail', $item->id)->with([
            'success' => 'Berhasil Ditambahkan',
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
        $item = RanapAssesmenPraAnesthesia::find($id);
        $dataCeklist = [
            'Informed Consent',
            'Obat-obatan Anestesi',
            'Tata Laksana Jalan Nafas',
            'Mesin Anestesi',
            'Monitoring',
            'Obat-obatan Emergensi',
            'Sunction Apparatus',
        ];
        $dataTeknik = [
            'Anestesi Umum',
            'Spinal',
            'Blok Perifer',
            'Epidural',
            // 'Kaudal',
        ];
        $dataMonitoring = [
            'EKG lead',
            'NIBP',
            'Temp',
            'Kateter Urin',
            'NGT',
            'CVP',
            'SpO2',
            'FiO',
            'BLS',
        ];
        $today = date('Y-m-d');
        $tanggal_asesment = new DateTime($item->tanggal ?? $today);
        $statusFisikArr = explode(', ', $item->status_fisik ?? '');
        $dokter = User::where('isDokter', '1')->get();
        return view('pages.asesmenPraAnestesiPraInduksi.edit', [
            'title' => 'Rawat Inap',
            'menu' => 'Rawat Inap',
            'item' => $item,
            'tanggal_asesment' => $tanggal_asesment,
            'statusFisikArr' => $statusFisikArr,
            'dataCeklist' => $dataCeklist,
            'dataTeknik' => $dataTeknik,
            'dataMonitoring' => $dataMonitoring,
            'dokter' => $dokter,
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
        $item = RanapAssesmenPraAnesthesia::find($id);
        //ass pra anestesi main tb
        $statusFisikTemp = $request->input('status_fisik', []);
        $statusFisik = implode(', ', $statusFisikTemp);
        $dataAssAnestesi = [
            'tanggal' => $request->input('tanggal'),
            'dokter_anestesi' => $request->input('dokter_anestesi'),
            'asisten_anestesi' => $request->input('asisten_anestesi'),
            'dokter_bedah' => $request->input('dokter_bedah'),
            'diagnosis_pra_bedah' => $request->input('diagnosis_pra_bedah'),
            'jenis_pembedahan' => $request->input('jenis_pembedahan'),
            'diagnosis_pasca_bedah' => $request->input('diagnosis_pasca_bedah'),
            'jam_operasi' => $request->input('jam_operasi'),
            'puasa_jam' => $request->input('puasa_jam'),
            'status_fisik' => $statusFisik,
            'isAlergi' => $request->input('isAlergi'),
            'penyulit_pra_anestesi' => $request->input('penyulit_pra_anestesi'),
        ];
        if ($item->ttd_dokter_anestesi != $request->input('ttd_dokter_anestesi')) {
            $dataAssAnestesi['ttd_dokter_anestesi'] = $request->input('ttd_dokter_anestesi');
        }
        $item->update($dataAssAnestesi);

        //ceklist
        $dataAnestesiChecklist = $request->input('anestesi_checklist', []);
        $item->ranapAssesmenPraAnestesiChecklists()->delete();
        foreach ($dataAnestesiChecklist as $ceklis) {
            RanapAssesmenPraAnestesiChecklist::create([
                'ranap_assesmen_pra_anesthesia_id' => $item->id,
                'name' => $ceklis,
            ]);
        }

        //teknik
        $item->ranapAssesmenPraAnestesiTechniques()->delete();
        $tempAnestesiTeknikName = $request->input('anestesi_teknik_temp_name', []);
        $tempAnestesiTeknikValue = $request->input('anestesi_teknik_temp_value', []);
        foreach ($tempAnestesiTeknikName as $key => $name) {
            RanapAssesmenPraAnestesiTechnique::create([
                'ranap_assesmen_pra_anesthesia_id' => $item->id,
                'name' => $name,
                'value' => $tempAnestesiTeknikValue[$key],
            ]);
        }
        $dataAnestesiTeknik = $request->input('anestesi_technique', []);
        foreach ($dataAnestesiTeknik as $teknik) {
            RanapAssesmenPraAnestesiTechnique::create([
                'ranap_assesmen_pra_anesthesia_id' => $item->id,
                'name' => $teknik,
            ]);
        }

        // special tools
        $item->ranapAssesmenPraAnestesiSpecialTools()->delete();
        $dataAnestesiSpecialTools = $request->input('special_tool', []);
        foreach ($dataAnestesiSpecialTools as $specialTool) {
            if ($specialTool) {
                RanapAssesmenPraAnestesiSpecialTool::create([
                    'ranap_assesmen_pra_anesthesia_id' => $item->id,
                    'name' => $specialTool,
                ]);
            }
        }

        // monitoring
        $item->ranapAssesmenPraAnestesiMonitorings()->delete();
        $dataAnestesiMonitoring = $request->input('monitoring', []);
        foreach ($dataAnestesiMonitoring as $monitoring) {
            if ($monitoring) {
                RanapAssesmenPraAnestesiMonitoring::create([
                    'ranap_assesmen_pra_anesthesia_id' => $item->id,
                    'name' => $monitoring,
                ]);
            }
        }

        // pra induksi
        $item->ranapAssesmenPraAnestesiInductions->delete();
        RanapAssesmenPraAnestesiInduction::create([
            'ranap_assesmen_pra_anesthesia_id' => $item->id,
            'keluhan' => $request->input('keluhan'),
            'kesadaran' => $request->input('kesadaran'),
            'td' => $request->input('td'),
            'hr' => $request->input('hr'),
            'rr' => $request->input('rr'),
            'temperature' => $request->input('temperature'),
            'saturasi' => $request->input('saturasi'),
            'lainnya' => $request->input('lainnya'),
        ]);

        return redirect()->route('assesmen/pra/anestesi/pra/induksi.detail', $id)->with([
            'success' => 'Berhasil Diperbarui',
            'btn' => 'asesmenpraanestesi-induksi',
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
        $item = RanapAssesmenPraAnesthesia::find($id);
        $item->ranapAssesmenPraAnestesiChecklists()->delete();
        $item->ranapAssesmenPraAnestesiTechniques()->delete();
        $item->ranapAssesmenPraAnestesiSpecialTools()->delete();
        $item->ranapAssesmenPraAnestesiMonitorings()->delete();
        $item->ranapAssesmenPraAnestesiInductions->delete();
        $item->delete();

        return back()->with([
            'success' => 'Berhasil Dihapus',
            'btn' => 'asesmenpraanestesi-induksi',
        ]);
    }
}
