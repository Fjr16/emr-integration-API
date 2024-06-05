<?php

namespace App\Http\Controllers;

use App\Models\KebutuhanSuratPengantarRawatJalanPatient;
use App\Models\LaboratoriumRequest;
use App\Models\OperasiSuratPengantarRawatJalanPatient;
use App\Models\Queue;
use App\Models\RadiologiFormRequest;
use App\Models\RmeCppt;
use App\Models\SekunderSuratPengantarRawatJalanPatient;
use App\Models\SuratPengantarRawatJalanPatient;
use App\Models\TerapiSuratPengantarRawatJalanPatient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class SuratPengantarRawatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = SuratPengantarRawatJalanPatient::all();
        return view('pages.suratPengantar.index', [
            "title" => "Surat Pengantar",
            'menu' => 'suratPengantar',
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $item = Queue::find($id);
        //item request Labor PK
        $itemReqLab = LaboratoriumRequest::where('queue_id', $item->id)->latest()->first();
        //item request Radiologi
        $itemReqRadio = RadiologiFormRequest::where('queue_id', $item->id)->latest()->first();

        $cpptLast = RmeCppt::where('rawat_jalan_poli_patient_id', $item->rawatJalanPatient->rawatJalanPoliPatient->id ?? '')->latest()->first();
        $diagnosa = [];
        if ($cpptLast) {
            if ($cpptLast->soap) {
                $explode = explode('|', $cpptLast->soap);
                $soap = '';
                foreach ($explode as $new) {
                    if (preg_match('/ASSESMEN/', $new)) {
                        $soap = $new;
                        break;
                    }
                }

                $pattern = '~<p><strong>.*?</strong></p>~';
                $replacement = '';
                $deleteHeading = preg_replace($pattern, $replacement, $soap);
                $deleteTags = strip_tags($deleteHeading);
                $diagnosa = explode(',', $deleteTags);
            }
        }
        $diagnosaSekunder = array_splice($diagnosa, 1) ?? '';
        $isset = $item->suratPengantarRawatJalanPatient->id ?? 'kosong';
        if ($isset !== 'kosong') {
            return redirect()->route('suratpengantar.edit', $item->suratPengantarRawatJalanPatient->id);
        } else {
            return view('pages.suratPengantar.create', [
                'item' => $item,
                "title" => "Surat Pengantar",
                'menu' => 'suratPengantar',
                'diagnosa' => $diagnosa,
                'diagnosaSekunder' => $diagnosaSekunder,
                'itemReqLab' => $itemReqLab,
                'itemReqRadio' => $itemReqRadio,
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'alat' => 'required',
            'prioritas_kebutuhan' => 'required',
            'ruangan' => 'required',
            // 'persiapan_operasi' => 'required',
        ]);

        $item = Queue::find($id);

        //dd($item->id);
        // save data surat
        $data = SuratPengantarRawatJalanPatient::create([
            'queue_id'  => $item->id,
            'patient_id' => $item->patient->id,
            'user_id' => Auth::user()->id,
            'primer' => $request->diagnosa_primer,
            'alat' => $request->alat,
            'ruangan' => $request->ruangan,
            'tgl_operasi' => $request->tgl_operasi,
        ]);


        // save data pemeriksaan sekunder
        $diagnosaSekunder = $request->diagnosa_sekunder;
        foreach ($diagnosaSekunder as $save1) {
            if ($save1) {
                SekunderSuratPengantarRawatJalanPatient::create([
                    'surat_pengantar_rawat_jalan_patient_id' => $data->id,
                    'name' => $save1,
                ]);
            }
        }

        // save persiapan Operasi
        $persiapanOperasi = $request->input('persiapan_operasi', []);
        foreach ($persiapanOperasi as $save2) {
            OperasiSuratPengantarRawatJalanPatient::create([
                'surat_pengantar_rawat_jalan_patient_id' => $data->id,
                'name' => $save2,
            ]);
        };
        // save  terapi
        $dataterapi = $request->input('terapi', []);
        foreach ($dataterapi as $save3) {
            if ($save3) {
                TerapiSuratPengantarRawatJalanPatient::create([
                    'surat_pengantar_rawat_jalan_patient_id' => $data->id,
                    'name' => $save3,
                ]);
            }
        };

        //save prioritas Kebutuhan

        $prioritasKebutuhan = $request->input('prioritas_kebutuhan', []);
        foreach ($prioritasKebutuhan as $save4) {
            KebutuhanSuratPengantarRawatJalanPatient::create([
                'surat_pengantar_rawat_jalan_patient_id' => $data->id,
                'name' => $save4,
            ]);
        };
        return redirect()->route('rajal/show', ['id' => $item->id, 'title' => 'Rawat Jalan'])->with([
            'success' => 'Sukses.',
            'btn' => 'pengantar ranap',
        ]);
        // return redirect()->route('rawat/inap.index', ['title' => 'Rawat Jalan'])->with([
        //     'success' => 'Sukses.',
        //     'btn' => 'pengantar ranap',
        // ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = SuratPengantarRawatJalanPatient::where('id', $id)->first();
        $sekunderSurat = $data->sekunderSuratPengantarRawatJalanPatients;
        $operasiSurat = $data->operasiSuratPengantarRawatJalanPatient;
        $terapiSurat = $data->terapiSuratPengantarRawatJalanPatients;
        $kebutuhanSurat = $data->kebutuhanSuratPengantarRawatJalanPatients;

        // return $kebutuhanSurat;
        // die;
        return view('pages.suratPengantar.show', compact('data', 'sekunderSurat', 'operasiSurat', 'terapiSurat', 'kebutuhanSurat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $previousUrl = url()->previous();
        $data = SuratPengantarRawatJalanPatient::find($id);
        // $data2 = OperasiSuratPengantarRawatJalanPatient::where('surat_pengantar_rawat_jalan_patient_id', $id)->pluck('name')->toArray();
        $data3 = TerapiSuratPengantarRawatJalanPatient::where('surat_pengantar_rawat_jalan_patient_id', $id)->get();
        $data4 = SekunderSuratPengantarRawatJalanPatient::where('surat_pengantar_rawat_jalan_patient_id', $id)->get();
        $data5 = KebutuhanSuratPengantarRawatJalanPatient::where('surat_pengantar_rawat_jalan_patient_id', $id)->pluck('name')->toArray();
        return view('pages.suratPengantar.edit', [
            'data' => $data,
            'data3' => $data3,
            'data4' => $data4,
            'data5' => $data5,
            "title" => "Surat Pengantar",
            'menu' => 'suratPengantar',
            'previousUrl' => $previousUrl,
        ]);
        //
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
        $item = SuratPengantarRawatJalanPatient::find($id);
        // save data surat
        $item->update([
            'primer'  => $request->diagnosa_primer,
            'alat'    => $request->alat,
            'ruangan' => $request->ruangan,
        ]);


        // save data pemeriksaan sekunder
        SekunderSuratPengantarRawatJalanPatient::where('surat_pengantar_rawat_jalan_patient_id', $id)->delete();
        $diagnosaSekunder = $request->diagnosa_sekunder;
        foreach ($diagnosaSekunder as $save1) {
            if ($save1) {
                SekunderSuratPengantarRawatJalanPatient::create([
                    'surat_pengantar_rawat_jalan_patient_id' => $id,
                    'name' => $save1,
                ]);
            }
        }

        // save persiapan Operasi
        OperasiSuratPengantarRawatJalanPatient::where('surat_pengantar_rawat_jalan_patient_id', $id)->delete();
        $persiapanOperasi = $request->input('persiapan_operasi');
        if ($persiapanOperasi) {
            foreach ($persiapanOperasi as $save2) {
                OperasiSuratPengantarRawatJalanPatient::create([
                    'surat_pengantar_rawat_jalan_patient_id' => $id,
                    'name' => $save2,
                ]);
            };
        }
        // save  terapi
        TerapiSuratPengantarRawatJalanPatient::where('surat_pengantar_rawat_jalan_patient_id', $id)->delete();
        $dataterapi = $request->terapi;
        foreach ($dataterapi as $save3) {
            if ($save3) {
                TerapiSuratPengantarRawatJalanPatient::create([
                    'surat_pengantar_rawat_jalan_patient_id' => $id,
                    'name' => $save3,
                ]);
            }
        };

        //save prioritas Kebutuhan
        KebutuhanSuratPengantarRawatJalanPatient::where('surat_pengantar_rawat_jalan_patient_id', $id)->delete();
        $prioritasKebutuhan = $request->input('prioritas_kebutuhan', []);
        foreach ($prioritasKebutuhan as $save4) {
            if($save4){
                KebutuhanSuratPengantarRawatJalanPatient::create([
                    'surat_pengantar_rawat_jalan_patient_id' => $id,
                    'name' => $save4,
                ]);
            }
        };
        return redirect($request->previous_url)->with([
            'success' => 'Sukses',
            'btn' => 'pengantar ranap',
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
        SekunderSuratPengantarRawatJalanPatient::where('surat_pengantar_rawat_jalan_patient_id', $id)->delete();
        OperasiSuratPengantarRawatJalanPatient::where('surat_pengantar_rawat_jalan_patient_id', $id)->delete();
        TerapiSuratPengantarRawatJalanPatient::where('surat_pengantar_rawat_jalan_patient_id', $id)->delete();
        KebutuhanSuratPengantarRawatJalanPatient::where('surat_pengantar_rawat_jalan_patient_id', $id)->delete();
        $item = SuratPengantarRawatJalanPatient::find($id);
        $item->delete();
        return back()->with([
            'success' => 'Sukses.',
            'btn' => 'pengantar ranap',
        ]);
    }
}
