<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Queue;
use App\Models\DiagnosisKeperawatanPatient;
use App\Models\HubunganDiagnosaAwalPatient;
use App\Models\DetailDiagnosisKeperawatanPatient;
use App\Models\EkonomiDiagnosaKeperawatanPatient;
use App\Models\AsesmentKeperawatanStatusFisikPatient;
use App\Models\ResikoRajalDiagnosaKeperawatanPatient;
use App\Models\AsesmentKeperawatanRencanaAsuhanPatient;
use App\Models\AsesmentNyeriDiagnosaKeperawatanPatient;
use App\Models\DetailMasalahDiagnosisKeperawatanPatient;
use App\Models\DetailResikoRajalDiagnosaKeperawatanPatient;
use App\Models\RisikoNutrisionalDiagnosaKeperawatanPatient;
use App\Models\PsikoSosioSpritualDiagnosaKeperawatanPatient;
use App\Models\AsesmentKeperawatanSkriningResikoJatuhPatient;
use App\Models\DetailAsesmentKeperawatanRencanaAsuhanPatient;
use App\Models\DetailAsesmentNyeriDiagnosaKeperawatanPatient;
use App\Models\DetailRisikoNutrisionalDiagnosaKeperawatanPatient;
use App\Models\AsesmentStatusFungsionalDiagnosaKeperawatanPatient;
use App\Models\DetailPsikoSosioSpritualDiagnosaKeperawatanPatient;
use App\Models\DetailAsesmentStatusFungsionalDiagnosaKeperawatanPatient;
use App\Models\PerawatInitialAsesment;
use App\Models\PerawatInitialAsesmentPsychology;
use App\Models\RmeCppt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AsesmentPerawatController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function print($id)
    {
        $komponenPenilaian1 = [
            'Tidak berisiko (tidak ditemukan a dan b)',
            'Resiko Rendah (ditemukan a atau b)',
            'Resiko Tinggi (ditemukan a dan b)'

        ];
        $item = Queue::find($id);
        $itemAss = $item->perawatInitialAssesment;
        $soapPerawat = $item->rmeCppts->where('category_soap', 'PERAWAT')->first() ?? '';
        return view('pages.asesmentPerawatRawatJalanPrint.print', [
            'title' => 'Print Assesment Perawat',
            'menu' => 'Rawat Jalan',
            'itemAss' => $itemAss,
            'komponenPenilaian1' => $komponenPenilaian1,
            'soapPerawat' => $soapPerawat,
        ]);
    }


    // data baru 
    private function toStoreSession(){
        if (Session::has('data')) {
            $data = Session::get('data');
        }else{
            $data = new PerawatInitialAsesment();
        }
        return $data;
    }

    public function create_step_one($id){
        $item = Queue::find($id);
        $itemAss = $item->perawatInitialAssesment;

        if (!Session::has('perawat')) {
            Session::flash('perawat', 'anamnesis');
        } else {
            Session::flash('perawat', Session::get('perawat'));
        }

        $data = $this->toStoreSession();
        
        Session::put('data', $data);

        $arrResikoJatuh = [
            'Tidak berisiko (tidak ditemukan a dan b)',
            'Resiko Rendah (ditemukan a atau b)',
            'Resiko Tinggi (ditemukan a dan b)',
        ];
        $arrAssGizi = [
            [
                'name' => 'Tidak',
                'value' => '0',
            ],
            [
                'name' => 'Tidak yakin',
                'value' => '2',
            ],
            [
                'name' => 'Turun sebanyak 1-5 Kg',
                'value' => '1',
            ],
            [
                'name' => 'Turun sebanyak 6-10 Kg',
                'value' => '2',
            ],
            [
                'name' => 'Turun sebanyak 11-15 Kg',
                'value' => '3',
            ],
            [
                'name' => 'Turun lebih dari 15 Kg',
                'value' => '4',
            ],
            [
                'name' => 'Tidak tahu berapa kg penurunan',
                'value' => '2',
            ],
        ];

        $soapPerawat = $item->rmeCppts->where('category_soap', 'PERAWAT')->first() ?? '';

        return view('pages.asesmentPerawat.create', [
            'title' => 'Rawat Jalan',
            'menu' => 'Rawat Jalan',
            'item' => $item,
            'arrResikoJatuh' => $arrResikoJatuh,
            'arrAssGizi' => $arrAssGizi,
            'itemAss' => $itemAss,
            'soapPerawat' => $soapPerawat,
        ]);
    }
    public function store_step_one(Request $request, $id){
        $detailPsikologis = $request->input('status_psikologis', []);
        if (!empty($detailPsikologis)) {
            Session::put('detail_psikologis', $detailPsikologis);
        }
        $nextStep = $request->input('next-step', 'anamnesis');
        $reqData = [
            'keluhan_utama' => $request->input('keluhan', Session::get('data.keluhan_utama')),
            'riw_penyakit_pasien' => $request->input('riwayat_penyakit_sekarang', Session::get('data.riw_penyakit_pasien')),
            'riw_penyakit_keluarga' => $request->input('riwayat_penyakit_keluarga', Session::get('data.riw_penyakit_keluarga')),
            'alergi_makanan' => $request->input('alergi_makanan', Session::get('data.alergi_makanan')),
            'alergi_obat' => $request->input('alergi_obat', Session::get('data.alergi_obat')),
            'skor_ass_gizi_1' => $request->input('asesmen_gizi', Session::get('data.skor_ass_gizi_1')),
            'skor_ass_gizi_2' => $request->input('kurang_nafsu', Session::get('data.skor_ass_gizi_2')),
            'kondisi_gizi' => $request->input('kondisi_gizi', Session::get('data.kondisi_gizi')),
            'nadi' => $request->input('ttv_nadi', Session::get('data.nadi')),
            'td_sistolik' => $request->input('ttv_td_sistolik', Session::get('data.td_sistolik')),
            'td_diastolik' => $request->input('ttv_td_diastolik', Session::get('data.td_diastolik')),
            'suhu' => $request->input('ttv_suhu', Session::get('data.suhu')),
            'nafas' => $request->input('ttv_nafas', Session::get('data.nafas')),
            'keadaan_umum' => $request->input('keadaan_umum', Session::get('data.keadaan_umum')),
            'kesadaran' => $request->input('kesadaran', Session::get('data.kesadaran')),
            'tb' => $request->input('tb', Session::get('data.tb')),
            'bb' => $request->input('bb', Session::get('data.bb')),
            'lk' => $request->input('lk', Session::get('data.lk')),
            'skor_nyeri' => $request->input('ass_nyeri', Session::get('data.skor_nyeri')),
            'stts_ekonomi' => $request->input('status_ekonomi', Session::get('data.stts_ekonomi')),
            'resiko_jatuh_a' => $request->input('resiko_jatuh_a', Session::get('data.resiko_jatuh_a')),
            'resiko_jatuh_b' => $request->input('resiko_jatuh_b', Session::get('data.resiko_jatuh_b')),
            'resiko_jatuh_result' => $request->input('resiko_jatuh_result', Session::get('data.resiko_jatuh_result')),
        ];

        $data = $this->toStoreSession();
        $data->fill($reqData);
        Session::put('data', $data);

        return back()->with([
            'perawat' => $nextStep
        ]);
    }
    public function store_step_two(Request $request, $id){
        $item = Queue::find($id);
        $newPerawat = Session::get('data');
        $newPerawat->fill([
            'user_id' => Auth::user()->id,
            'queue_id' => $item->id,
            'patient_id' => $item->patient->id,
        ]);
        if($newPerawat->save()){
            Session::forget('data');
            $detailPsikologis = Session::get('detail_psikologis');
            if (!empty($detailPsikologis)) {
                foreach ($detailPsikologis as $detail) {
                    PerawatInitialAsesmentPsychology::create([
                        'perawat_initial_asesment_id' => $newPerawat->id,
                        'name' => $detail,
                    ]);
                }
                Session::forget('detail_psikologis');
            }
        }else{
            return back()->with([
                'error' => 'Terjadi Kesalahan!! Mohon Submit Ulang !!'
            ]);
        }

        $soap = [
            'queue_id' => $item->id,
            'patient_id' => $item->patient->id,
            'user_id' => auth()->user()->id,
            'subjective' => $request->input('subjective'),
            'objective' => $request->input('objective'),
            'asesment' => $request->input('asesmen'),
            'planning' => $request->input('planning'),
            'ttd_user' => $request->input('ttd_user'),
            'category_soap' => 'PERAWAT',
        ];
        RmeCppt::create($soap);

        return back()->with([
            'success' => 'Data Asesmen Awal Berhasil Disimpan',
            'perawat' => 'anamnesis'
        ]);
    }


    // update dan edit
    private function toUpdateSession($item){
        if (Session::has('dataToUpdate')) {
            $dataToUpdate = Session::get('dataToUpdate');
        }else{
            $dataToUpdate = $item;
        }
        return $dataToUpdate;
    } 
    public function edit($id){
        $item = PerawatInitialAsesment::find($id);

        if (!Session::has('perawat')) {
            Session::flash('perawat', 'anamnesis');
        } else {
            Session::flash('perawat', Session::get('perawat'));
        }

        $data = $this->toUpdateSession($item);
        
        Session::put('dataToUpdate', $data);

        $arrResikoJatuh = [
            'Tidak berisiko (tidak ditemukan a dan b)',
            'Resiko Rendah (ditemukan a atau b)',
            'Resiko Tinggi (ditemukan a dan b)',
        ];
        $arrAssGizi = [
            [
                'name' => 'Tidak',
                'value' => '0',
            ],
            [
                'name' => 'Tidak yakin',
                'value' => '2',
            ],
            [
                'name' => 'Turun sebanyak 1-5 Kg',
                'value' => '1',
            ],
            [
                'name' => 'Turun sebanyak 6-10 Kg',
                'value' => '2',
            ],
            [
                'name' => 'Turun sebanyak 11-15 Kg',
                'value' => '3',
            ],
            [
                'name' => 'Turun lebih dari 15 Kg',
                'value' => '4',
            ],
            [
                'name' => 'Tidak tahu berapa kg penurunan',
                'value' => '2',
            ],
        ];

        $soapPerawat = $item->queue->rmeCppts->where('category_soap', 'PERAWAT')->first() ?? '';

        return view('pages.asesmentPerawat.edit', [
            'title' => 'Rawat Jalan',
            'menu' => 'Rawat Jalan',
            'item' => $item,
            'arrResikoJatuh' => $arrResikoJatuh,
            'arrAssGizi' => $arrAssGizi,
            'soapPerawat' => $soapPerawat,
        ]);
    }
    public function update_step_one(Request $request, $id){
        $detailPsikologis = $request->input('status_psikologis', []);
        if (!empty($detailPsikologis)) {
            Session::put('detail_psikologis', $detailPsikologis);
        }
        $nextStep = $request->input('next-step', 'anamnesis');
        $reqData = [
            'keluhan_utama' => $request->input('keluhan', Session::get('data.keluhan_utama')),
            'riw_penyakit_pasien' => $request->input('riwayat_penyakit_sekarang', Session::get('data.riw_penyakit_pasien')),
            'riw_penyakit_keluarga' => $request->input('riwayat_penyakit_keluarga', Session::get('data.riw_penyakit_keluarga')),
            'alergi_makanan' => $request->input('alergi_makanan', Session::get('data.alergi_makanan')),
            'alergi_obat' => $request->input('alergi_obat', Session::get('data.alergi_obat')),
            'skor_ass_gizi_1' => $request->input('asesmen_gizi', Session::get('data.skor_ass_gizi_1')),
            'skor_ass_gizi_2' => $request->input('kurang_nafsu', Session::get('data.skor_ass_gizi_2')),
            'kondisi_gizi' => $request->input('kondisi_gizi', Session::get('data.kondisi_gizi')),
            'nadi' => $request->input('ttv_nadi', Session::get('data.nadi')),
            'td_sistolik' => $request->input('ttv_td_sistolik', Session::get('data.td_sistolik')),
            'td_diastolik' => $request->input('ttv_td_diastolik', Session::get('data.td_diastolik')),
            'suhu' => $request->input('ttv_suhu', Session::get('data.suhu')),
            'nafas' => $request->input('ttv_nafas', Session::get('data.nafas')),
            'keadaan_umum' => $request->input('keadaan_umum', Session::get('data.keadaan_umum')),
            'kesadaran' => $request->input('kesadaran', Session::get('data.kesadaran')),
            'tb' => $request->input('tb', Session::get('data.tb')),
            'bb' => $request->input('bb', Session::get('data.bb')),
            'lk' => $request->input('lk', Session::get('data.lk')),
            'skor_nyeri' => $request->input('ass_nyeri', Session::get('data.skor_nyeri')),
            'stts_ekonomi' => $request->input('status_ekonomi', Session::get('data.stts_ekonomi')),
            'resiko_jatuh_a' => $request->input('resiko_jatuh_a', Session::get('data.resiko_jatuh_a')),
            'resiko_jatuh_b' => $request->input('resiko_jatuh_b', Session::get('data.resiko_jatuh_b')),
            'resiko_jatuh_result' => $request->input('resiko_jatuh_result', Session::get('data.resiko_jatuh_result')),
        ];

        $item = PerawatInitialAsesment::find($id);
        $data = $this->toUpdateSession($item);
        $data->fill($reqData);
        Session::put('data', $data);

        return back()->with([
            'perawat' => $nextStep
        ]);
    }
    public function update_step_two(Request $request, $id){
        $dataToUpdate = Session::get('dataToUpdate');
        if($dataToUpdate->update()){
            Session::forget('dataToUpdate');
            $detailPsikologis = Session::get('detail_psikologis');
            if (!empty($detailPsikologis)) {
                $dataToUpdate->detailPsikologis()->delete();
                foreach ($detailPsikologis as $detail) {
                    PerawatInitialAsesmentPsychology::create([
                        'perawat_initial_asesment_id' => $dataToUpdate->id,
                        'name' => $detail,
                    ]);
                }
                Session::forget('detail_psikologis');
            }
        }else{
            return back()->with([
                'error' => 'Terjadi Kesalahan!! Mohon Submit Ulang !!'
            ]);
        }

        $soapPerawat = $dataToUpdate->queue->rmeCppts->where('category_soap', 'PERAWAT')->first();

        $soap = [
            'subjective' => $request->input('subjective'),
            'objective' => $request->input('objective'),
            'asesment' => $request->input('asesmen'),
            'planning' => $request->input('planning'),
        ];
        $soapPerawat->update($soap);

        return back()->with([
            'success' => 'Data Asesmen Awal Berhasil Disimpan',
            'perawat' => 'anamnesis'
        ]);
    }

    public function show($id){
        $item = PerawatInitialAsesment::find($id);
        return view('pages.asesmentPerawat.print', [
            'title' => 'Rawat Jalan',
            'menu' => 'Rawat Jalan',
        ]);
    }
}
