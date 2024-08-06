<?php

namespace App\Http\Controllers;

use App\Models\DoctorInitialAsessment;
use App\Models\Queue;
use App\Models\PerawatInitialAsesment;
use App\Models\PerawatInitialAsesmentPsychology;
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
        $item = Queue::find(decrypt($id));
        $itemAss = $item->perawatInitialAssesment;
        return view('pages.asesmentPerawat.print', [
            'title' => 'Print Assesment Perawat',
            'menu' => 'Rawat Jalan',
            'itemAss' => $itemAss,
            'komponenPenilaian1' => $komponenPenilaian1,
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
        $item = Queue::find(decrypt($id));
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

        return view('pages.asesmentPerawat.create', [
            'title' => 'Rawat Jalan',
            'menu' => 'Rawat Jalan',
            'item' => $item,
            'arrResikoJatuh' => $arrResikoJatuh,
            'arrAssGizi' => $arrAssGizi,
            'itemAss' => $itemAss,
        ]);
    }
    public function store_step_one(Request $request, $id){
        $detailPsikologis = $request->input('status_psikologis', []);
        if (!empty($detailPsikologis)) {
            Session::put('detail_psikologis', $detailPsikologis);
        }
        $alergi_makanan = $request->input('alergi_makanan');
        $alergi_obat = $request->input('alergi_obat');
        if ($alergi_makanan || $alergi_obat) {
            Session::put('alergi', [
                'makanan' => $alergi_makanan,
                'obat' => $alergi_obat
            ]);
        }

        $nextStep = $request->input('next-step', 'anamnesis');
        $reqData = [
            'keluhan_utama' => $request->input('keluhan', Session::get('data.keluhan_utama')),
            'riw_penyakit_pasien' => $request->input('riwayat_penyakit_sekarang', Session::get('data.riw_penyakit_pasien')),
            'riw_penyakit_keluarga' => $request->input('riwayat_penyakit_keluarga', Session::get('data.riw_penyakit_keluarga')),
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
        if (empty($newPerawat)) {
            return back()->with('error', 'Mohon isi Data Step By Step mulai dari Anamnesa !!');
        }
        $newPerawat->fill([
            'user_id' => Auth::user()->id,
            'queue_id' => $item->id,
            'patient_id' => $item->patient->id,
            'subjective' => $request->input('subjective'),
            'objective' => $request->input('objective'),
            'asesmen' => $request->input('asesmen'),
            'planning' => $request->input('planning'),
            'ttd' => $request->input('ttd_user')
        ]);
        if($newPerawat->save()){
            $detailPsikologis = Session::get('detail_psikologis');
            if (!empty($detailPsikologis)) {
                foreach ($detailPsikologis as $detail) {
                    PerawatInitialAsesmentPsychology::create([
                        'perawat_initial_asesment_id' => $newPerawat->id,
                        'name' => $detail,
                    ]);
                }
            }

            // update alergi pada tabel pasien
            $alergi_mkn = Session::get('alergi.makanan');
            if ($alergi_mkn && $alergi_mkn != $item->patient->alergi_makanan) {
                $item->patient()->update([
                    'alergi_makanan' => $alergi_mkn,
                ]);
            }

            $alergi_obt = Session::get('alergi.obat');
            if ($alergi_obt && $alergi_obt != $item->patient->alergi_obat) {
                $item->patient()->update([
                    'alergi_obat' => $alergi_obt,
                ]);
            }
            Session::forget(['alergi_makanan', 'alergi_obat', 'detail_psikologis', 'data']);
            
            // create otomatis dokter initial asesmen jika belum ada
            if (!$newPerawat->queue->doctorInitialAssesment) {
                DoctorInitialAsessment::create([
                    'queue_id' => $item->id,
                    'patient_id' => $item->patient->id,
                    'user_id' => $item->dokter_id,
                    'keluhan_utama' => $newPerawat->keluhan_utama ?? '',
                    'keadaan_umum' => $newPerawat->keadaan_umum ?? '',
                    'kesadaran' => $newPerawat->kesadaran ?? '',
                    'tb' => $newPerawat->tb ?? null,
                    'bb' => $newPerawat->bb ?? null,
                    'nadi' => $newPerawat->nadi ?? null,
                    'td_sistolik' => $newPerawat->td_sistolik ?? null,
                    'td_diastolik' => $newPerawat->td_diastolik ?? null,
                    'suhu' => $newPerawat->suhu ?? null,
                    'nafas' => $newPerawat->nafas ?? null,
                ]);
            }
        }else{
            return back()->with([
                'error' => 'Terjadi Kesalahan!! Mohon Submit Ulang !!'
            ]);
        }

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
        $item = PerawatInitialAsesment::find(decrypt($id));

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

        return view('pages.asesmentPerawat.edit', [
            'title' => 'Rawat Jalan',
            'menu' => 'Rawat Jalan',
            'item' => $item,
            'arrResikoJatuh' => $arrResikoJatuh,
            'arrAssGizi' => $arrAssGizi,
        ]);
    }
    public function update_step_one(Request $request, $id){
        $detailPsikologis = $request->input('status_psikologis', []);
        if (!empty($detailPsikologis)) {
            Session::put('detail_psikologis', $detailPsikologis);
        }
        $alergi_makanan = $request->input('alergi_makanan');
        $alergi_obat = $request->input('alergi_obat');
        if ($alergi_makanan || $alergi_obat) {
            Session::put('alergi', [
                'makanan' => $alergi_makanan,
                'obat' => $alergi_obat
            ]);
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
        $item = PerawatInitialAsesment::find($id);
        $dataToUpdate = Session::get('dataToUpdate');
        if (empty($dataToUpdate)) {
            return back()->with('error', 'Mohon Isi Data Secara Bertahap !!');
        }
        $dataToUpdate->fill([
            'subjective' => $request->input('subjective'),
            'objective' => $request->input('objective'),
            'asesmen' => $request->input('asesmen'),
            'planning' => $request->input('planning'),
            'ttd' => $request->input('ttd_user'),
        ]);
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

                // update alergi pada tabel pasien
                $alergi_mkn = Session::get('alergi.makanan');
                if ($alergi_mkn && $alergi_mkn != $item->patient->alergi_makanan) {
                    $item->patient()->update([
                        'alergi_makanan' => $alergi_mkn,
                    ]);
                }

                $alergi_obt = Session::get('alergi.obat');
                if ($alergi_obt && $alergi_obt != $item->patient->alergi_obat) {
                    $item->patient()->update([
                        'alergi_obat' => $alergi_obt,
                    ]);
                }

                // update otomatis dokter initial asesmen jika ttd masih null
                if ($item->queue->doctorInitialAssesment && !$item->queue->doctorInitialAssesment->ttd) {
                    $item->queue->doctorInitialAssesment()->update([
                        'queue_id' => $item->queue->id,
                        'patient_id' => $item->queue->patient->id,
                        'user_id' => $item->queue->dokter_id,
                        'keluhan_utama' => $dataToUpdate->keluhan_utama ?? '',
                        'keadaan_umum' => $dataToUpdate->keadaan_umum ?? '',
                        'kesadaran' => $dataToUpdate->kesadaran ?? '',
                        'tb' => $dataToUpdate->tb ?? null,
                        'bb' => $dataToUpdate->bb ?? null,
                        'nadi' => $dataToUpdate->nadi ?? null,
                        'td_sistolik' => $dataToUpdate->td_sistolik ?? null,
                        'td_diastolik' => $dataToUpdate->td_diastolik ?? null,
                        'suhu' => $dataToUpdate->suhu ?? null,
                        'nafas' => $dataToUpdate->nafas ?? null,
                    ]);
                }elseif (!$item->queue->doctorInitialAssesment){
                    // create otomatis dokter initial asesmen
                    DoctorInitialAsessment::create([
                        'queue_id' => $item->queue->id,
                        'patient_id' => $item->queue->patient->id,
                        'user_id' => $item->queue->dokter_id,
                        'keluhan_utama' => $dataToUpdate->keluhan_utama ?? '',
                        'keadaan_umum' => $dataToUpdate->keadaan_umum ?? '',
                        'kesadaran' => $dataToUpdate->kesadaran ?? '',
                        'tb' => $dataToUpdate->tb ?? null,
                        'bb' => $dataToUpdate->bb ?? null,
                        'nadi' => $dataToUpdate->nadi ?? null,
                        'td_sistolik' => $dataToUpdate->td_sistolik ?? null,
                        'td_diastolik' => $dataToUpdate->td_diastolik ?? null,
                        'suhu' => $dataToUpdate->suhu ?? null,
                        'nafas' => $dataToUpdate->nafas ?? null,
                    ]);
                }
            }
        }else{
            return back()->with([
                'error' => 'Terjadi Kesalahan!! Mohon Submit Ulang !!'
            ]);
        }

        return back()->with([
            'success' => 'Data Asesmen Awal Berhasil Disimpan',
            'perawat' => 'anamnesis'
        ]);
    }
}
