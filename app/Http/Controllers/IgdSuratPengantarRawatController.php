<?php

namespace App\Http\Controllers;

use App\Models\IgdPatient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SuratPengantarRawatJalanPatient;
use App\Models\TerapiSuratPengantarRawatJalanPatient;
use App\Models\OperasiSuratPengantarRawatJalanPatient;
use App\Models\SekunderSuratPengantarRawatJalanPatient;
use App\Models\KebutuhanSuratPengantarRawatJalanPatient;

class IgdSuratPengantarRawatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $item = IgdPatient::find($id);
        //item request Labor PK
        // $itemReqLab = LaboratoriumRequest::where('queue_id', $item->id)->latest()->first();
        //item request Radiologi
        // $itemReqRadio = RadiologiFormRequest::where('queue_id', $item->id)->latest()->first();
        $itemReqLab = null;
        $itemReqRadio = null;

        // $cpptLast = RmeCppt::where('rawat_jalan_poli_patient_id', $item->rawatJalanPatient->rawatJalanPoliPatient->id ?? '')->latest()->first();
        $diagnosa = [];
        // if($cpptLast){
        //     if($cpptLast->soap){
        //         $explode = explode('|', $cpptLast->soap);
        //         $soap = '';
        //         foreach($explode as $new){
        //             if(preg_match('/ASSESMEN/', $new)){
        //                 $soap = $new;
        //                 break;
        //             }
        //         }
                
        //         $pattern = '~<p><strong>.*?</strong></p>~';
        //         $replacement = '';
        //         $deleteHeading = preg_replace($pattern, $replacement, $soap);
        //         $deleteTags = strip_tags($deleteHeading);
        //         $diagnosa = explode(',', $deleteTags);
        //     }
        // }
        $diagnosaSekunder = array_splice($diagnosa, 1) ?? '';
        // $isset = $item->suratPengantarRawatJalanPatient->id ?? 'kosong';
        // if($isset !== 'kosong'){
        //     return redirect()->route('suratpengantar.edit', $item->suratPengantarRawatJalanPatient->id);
        // }else{
            return view('pages.igdSuratPengantar.create', [
                'item' => $item,
                "title" => "Surat Pengantar",
                'menu' => 'suratPengantar',
                'diagnosa' => $diagnosa,
                'diagnosaSekunder' => $diagnosaSekunder,
                'itemReqLab' => $itemReqLab,
                'itemReqRadio' => $itemReqRadio,
            ]);
        // }
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
            'diagnosa_primer' => 'required',
            'tgl_operasi' => 'required',
            'terapi' => 'required',
            'alat' => 'required',
            'prioritas_kebutuhan' => 'required',
            'ruangan' => 'required',
        ]);
        $item = IgdPatient::find($id);
        // save data surat
        $igdSpri = SuratPengantarRawatJalanPatient::create([
            'queue_id'  => $item->queue->id,
            'patient_id' => $item->queue->patient->id,
            'user_id' => Auth::user()->id,
            'primer' => $request->diagnosa_primer,
            'alat' => $request->alat,
            'ruangan' => $request->ruangan,
            'tgl_operasi' => $request->tgl_operasi,
            // 'status' => 'WAITING',
        ]);


        // save data pemeriksaan sekunder
        $diagnosaSekunder = $request->diagnosa_sekunder;
        foreach ($diagnosaSekunder as $save1) {
            if($save1){
                SekunderSuratPengantarRawatJalanPatient::create([
                    'surat_pengantar_rawat_jalan_patient_id' => $igdSpri->id,
                    'name' => $save1,
                ]);
            }
        }

        // save persiapan Operasi
        $persiapanOperasi = $request->input('persiapan_operasi', []);
        foreach ($persiapanOperasi as $save2) {
                OperasiSuratPengantarRawatJalanPatient::create([
                    'surat_pengantar_rawat_jalan_patient_id' => $igdSpri->id,
                    'name' => $save2,
                ]);
        };
        // save  terapi
        $dataterapi = $request->input('terapi', []);
        foreach ($dataterapi as $save3) {
            if($save3){
                TerapiSuratPengantarRawatJalanPatient::create([
                    'surat_pengantar_rawat_jalan_patient_id' => $igdSpri->id,
                    'name' => $save3,
                ]);
            }
        };

        //save prioritas Kebutuhan

        $prioritasKebutuhan = $request->input('prioritas_kebutuhan', []);
        foreach ($prioritasKebutuhan as $save4) {
            KebutuhanSuratPengantarRawatJalanPatient::create([
                'surat_pengantar_rawat_jalan_patient_id' => $igdSpri->id,
                'name' => $save4,
            ]);
        };
        return redirect()->route('igd/patient/rme.show', $item->id)->with([
            'success' => 'Berhasil Ditambahkan',
            'active' => 'spri',
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
        $previousUrl = url()->previous();
        $item = SuratPengantarRawatJalanPatient::find($id);
        $data2 = OperasiSuratPengantarRawatJalanPatient::where('surat_pengantar_rawat_jalan_patient_id', $item->id)->get();
        $data3 = TerapiSuratPengantarRawatJalanPatient::where('surat_pengantar_rawat_jalan_patient_id', $item->id)->get();
        $data4 = SekunderSuratPengantarRawatJalanPatient::where('surat_pengantar_rawat_jalan_patient_id', $item->id)->get();
        $data5 = KebutuhanSuratPengantarRawatJalanPatient::where('surat_pengantar_rawat_jalan_patient_id', $item->id)->pluck('name')->toArray();
        return view('pages.igdSuratPengantar.edit', [
            'item' => $item,
            'data2' => $data2,
            'data3' => $data3,
            'data4' => $data4,
            'data5' => $data5,
            "title" => "Surat Pengantar",
            'menu' => 'suratPengantar',
            'previousUrl' => $previousUrl,
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
        $this->validate($request, [
            'diagnosa_primer' => 'required',
            'tgl_operasi' => 'required',
            'terapi' => 'required',
            'alat' => 'required',
            'prioritas_kebutuhan' => 'required',
            'ruangan' => 'required',
        ]);
        $item = SuratPengantarRawatJalanPatient::find($id);
        // save data surat
        $status = $item->status;
        if($item->status == 'cancel'){
            $status = 'waiting';
        }
        $item->update([
            'primer'  => $request->diagnosa_primer,
            'alat'    => $request->alat,
            'ruangan' => $request->ruangan,
            'tgl_operasi' => $request->tgl_operasi,
            'status' => $status,
        ]);
        if (isset($item->rawatInapPatient)) {
            if ($item->rawatInapPatient->status == 'BATAL') {
                $item->rawatInapPatient->update([
                    'status' => 'WAITING',
                ]);
            }
        }

        // save data pemeriksaan sekunder
        SekunderSuratPengantarRawatJalanPatient::where('surat_pengantar_rawat_jalan_patient_id', $item->id)->delete();
        $diagnosaSekunder = $request->input('diagnosa_sekunder');
        foreach ($diagnosaSekunder as $save1) {
            if($save1){
                SekunderSuratPengantarRawatJalanPatient::create([
                    'surat_pengantar_rawat_jalan_patient_id' => $id,
                    'name' => $save1,
                ]);
            }
        }

        // save persiapan Operasi
        OperasiSuratPengantarRawatJalanPatient::where('surat_pengantar_rawat_jalan_patient_id', $item->id)->delete();
        $persiapanOperasi = $request->input('persiapan_operasi', []);
        if($persiapanOperasi){
            foreach ($persiapanOperasi as $save2) {
                OperasiSuratPengantarRawatJalanPatient::create([
                    'surat_pengantar_rawat_jalan_patient_id' => $id,
                    'name' => $save2,
                ]);
            };
        }
        // save  terapi
        TerapiSuratPengantarRawatJalanPatient::where('surat_pengantar_rawat_jalan_patient_id', $item->id)->delete();
        $dataterapi = $request->input('terapi', []);
        foreach ($dataterapi as $save3) {
            if($save3){
                TerapiSuratPengantarRawatJalanPatient::create([
                    'surat_pengantar_rawat_jalan_patient_id' => $id,
                    'name' => $save3,
                ]);
            }
        };

        //save prioritas Kebutuhan
        KebutuhanSuratPengantarRawatJalanPatient::where('surat_pengantar_rawat_jalan_patient_id', $item->id)->delete();
        $prioritasKebutuhan = $request->input('prioritas_kebutuhan', []);
        foreach ($prioritasKebutuhan as $save4) {
            KebutuhanSuratPengantarRawatJalanPatient::create([
                'surat_pengantar_rawat_jalan_patient_id' => $id,
                'name' => $save4,
            ]);
        };
        return redirect($request->previous_url)->with([
            'success' => 'Sukses',
            'active' => 'spri',
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
            'success' => 'Berhasil Dihapus',
            'active' => 'spri',
        ]);
    }
}
