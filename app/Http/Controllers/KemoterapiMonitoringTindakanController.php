<?php

namespace App\Http\Controllers;

use App\Models\KemoterapiIntrakemo;
use App\Models\KemoterapiMonitoringTindakanPatient;
use App\Models\KemoterapiPatient;
use App\Models\KemoterapiPostkemo;
use App\Models\KemoterapiPrekemo;
use App\Models\KemoterapiRegimen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class KemoterapiMonitoringTindakanController extends Controller
{
    public function create($id)
    {
        $item = KemoterapiPatient::find($id);
        return view('pages.monitoringTindakanKemoterapi.create', [
            'title' => 'Pasien Kemo',
            'menu' => 'Kemoterapi',
            'item' => $item,
        ]);
    }

    public function store(Request $request, $id)
    {
        $item = KemoterapiPatient::find($id);
        // $folder_path = 'assets/paraf-perawat/';
        // Storage::makeDirectory('public/' . $folder_path);
        // // paraf perawat
        // $ttd = base64_decode(str_replace('data:image/png;base64,', '', $request->input('ttd')));
        // $file_name_ttd = $folder_path . uniqid() . '.png';
        // Storage::put('public/' . $file_name_ttd, $ttd);

        $data['kemoterapi_patient_id'] = $item->id;
        $data['patient_id'] = $item->queue->patient->id;
        $data['user_id'] = Auth::user()->id; //$dpjp->user->id
        $data['ttd_perawat'] = Auth::user()->paraf;

        $data['alergi'] = $request->input('alergi');

        if ($request->input('alergi') == 'Ya') {
            $data['keterangan_alergi'] = $request->input('alergiKeterangan');
        } else {
            $data['keterangan_alergi'] = null;
        }

        $data['ekstravasasi'] = $request->input('ekstravasasi');
        if ($request->input('ekstravasasi') == 'Ya') {
            $data['keterangan_ekstravasasi'] = $request->input('ekstravasasiKeterangan');
        } else {
            $data['keterangan_ekstravasasi'] = null;
        }

        // $data['ttd_perawat'] = $file_name_ttd;

        if ($monitoring = KemoterapiMonitoringTindakanPatient::create($data)) {
            // prekemo
            $prekemo['kemoterapi_monitoring_tindakan_patient_id'] = $monitoring->id;
            $prekemo['td'] = $request->input('prekemoTD');
            $prekemo['nadi'] = $request->input('prekemoNadi');
            $prekemo['rr'] = $request->input('prekemoRR');
            $prekemo['suhu'] = $request->input('prekemoSuhu');
            $prekemo['nama_perawat'] = $request->input('prekemoNamaPerawat');

            $dataPrekemo = KemoterapiPrekemo::create($prekemo);

            //intrakemo
            $intrakemo['kemoterapi_monitoring_tindakan_patient_id'] = $monitoring->id;
            $intrakemo['td'] = $request->input('intrakemoTD');
            $intrakemo['nadi'] = $request->input('intrakemoNadi');
            $intrakemo['rr'] = $request->input('intrakemoRR');
            $intrakemo['suhu'] = $request->input('intrakemoSuhu');
            $intrakemo['nama_perawat'] = $request->input('intrakemoNamaPerawat');

            $dataIntrakemo = KemoterapiIntrakemo::create($intrakemo);

            // postkemo
            $postkemo['kemoterapi_monitoring_tindakan_patient_id'] = $monitoring->id;
            $postkemo['td'] = $request->input('postkemoTD');
            $postkemo['nadi'] = $request->input('postkemoNadi');
            $postkemo['rr'] = $request->input('postkemoRR');
            $postkemo['suhu'] = $request->input('postkemoSuhu');
            $postkemo['nama_perawat'] = $request->input('postkemoNamaPerawat');

            $dataPostkemo = KemoterapiPostkemo::create($postkemo);

            // $dataPrekemo = KemoterapiPrekemo::create($prekemo);
            // $dataIntrakemo = KemoterapiIntrakemo::create($intrakemo);
            // $dataPostkemo = KemoterapiPostkemo::create($postkemo);

            // Regimen
            if ($dataPrekemo || $dataIntrakemo || $dataPostkemo) {
                // Cek kondisi dan buat baris baru jika ada data yang terisi
                if ($dataPrekemo) {
                    $prekemoCheck = $request->input('prekemoCheck', []);
                    $prekemoInput = $request->input('prekemoInput', []);
                    $prekemoMulai = $request->input('prekemoCheckMulai', []);
                    $prekemoSelesai = $request->input('prekemoCheckSelesai', []);
                    // dd($prekemoMulai);
                    // die;
                    foreach ($prekemoCheck as $key => $value) {
                        KemoterapiRegimen::create([
                            'kemoterapi_prekemo_id' => $dataPrekemo->id,
                            'kemoterapi_intrakemo_id' => null,
                            'kemoterapi_postkemo_id' => null,
                            'name' => $value,
                            'keterangan' => isset($prekemoInput[$key]) ? $prekemoInput[$key] : null,
                            'jam_mulai' => $prekemoMulai[$key],
                            'jam_selesai' => $prekemoSelesai[$key],
                        ]);
                    }
                }
                if ($dataIntrakemo) {
                    $intrakemoCheck = $request->input('intrakemoCheck', []);
                    $intrakemoInput = $request->input('intrakemoInput', []);
                    $intrakemoMulai = $request->input('intrakemoCheckMulai', []);
                    $intrakemoSelesai = $request->input('intrakemoCheckSelesai', []);
                    foreach ($intrakemoCheck as $key => $value) {
                        KemoterapiRegimen::create([
                            'kemoterapi_prekemo_id' => null,
                            'kemoterapi_intrakemo_id' => $dataIntrakemo->id,
                            'kemoterapi_postkemo_id' => null,
                            'name' => $value,
                            'keterangan' => isset($intrakemoInput[$key]) ? $intrakemoInput[$key] : null,
                            'jam_mulai' => $intrakemoMulai[$key],
                            'jam_selesai' => $intrakemoSelesai[$key],
                        ]);
                    }

                    // $regimenIntrakemo['kemoterapi_prekemo_id'] = null;
                    // $regimenIntrakemo['kemoterapi_intrakemo_id'] = $dataIntrakemo->id;
                    // $regimenIntrakemo['kemoterapi_postkemo_id'] = null;
                    // KemoterapiRegimen::create($regimenIntrakemo);
                }
                if ($dataPostkemo) {
                    $postkemoCheck = $request->input('postkemoCheck', []);
                    $postkemoInput = $request->input('postkemoInput', []);
                    $postkemoMulai = $request->input('postkemoCheckMulai', []);
                    $postkemoSelesai = $request->input('postkemoCheckSelesai', []);
                    foreach ($postkemoCheck as $key => $value) {
                        KemoterapiRegimen::create([
                            'kemoterapi_prekemo_id' => null,
                            'kemoterapi_intrakemo_id' => null,
                            'kemoterapi_postkemo_id' => $dataPostkemo->id,
                            'name' => $value,
                            'keterangan' => isset($postkemoInput[$key]) ? $postkemoInput[$key] : null,
                            'jam_mulai' => $postkemoMulai[$key],
                            'jam_selesai' => $postkemoSelesai[$key],
                        ]);
                    }
                    // $regimenPostkemo['kemoterapi_prekemo_id'] = null;
                    // $regimenPostkemo['kemoterapi_intrakemo_id'] = null;
                    // $regimenPostkemo['kemoterapi_postkemo_id'] = $dataPostkemo->id;
                    // KemoterapiRegimen::create($regimenPostkemo);
                }
            }
        }

        return redirect()->route('kemoterapi/patient.show', $item->id)->with([
            'success' => 'Berhasil Ditambahkan',
            'active' => 'monitoringTindakanKemoterapi',
        ]);
    }

    public function show($id)
    {
        $item = KemoterapiMonitoringTindakanPatient::find($id);

        return view('pages.monitoringTindakanKemoterapi.index', [
            'item' => $item,
        ]);
    }

    public function edit($id)
    {
        $item = KemoterapiMonitoringTindakanPatient::find($id);

        // dd($item->prekemo->first()->kemoterapiRegimen->first()->keterangan);
        // die;
        return view('pages.monitoringTindakanKemoterapi.edit', [
            'title' => 'Pasien Kemo',
            'menu' => 'Kemoterapi',
            'item' => $item,
        ]);
    }

    public function update(Request $request, $id)
    {
        $monitoring = KemoterapiMonitoringTindakanPatient::find($id);

        // Pastikan data yang ditemukan untuk diupdate
        if ($monitoring) {
            $monitoring->alergi = $request->input('alergi');
            if ($request->input('alergi') == 'Ya') {
                $monitoring->keterangan_alergi = $request->input('alergiKeterangan');
            } else {
                $monitoring->keterangan_alergi = null;
            }

            $monitoring->ekstravasasi = $request->input('ekstravasasi');
            if ($request->input('ekstravasasi') == 'Ya') {
                $monitoring->keterangan_ekstravasasi = $request->input('ekstravasasiKeterangan');
            } else {
                $monitoring->keterangan_ekstravasasi = null;
            }

            // Update data prekemo
            $prekemo = KemoterapiPrekemo::where('kemoterapi_monitoring_tindakan_patient_id', $id)->first();
            if ($prekemo) {
                $prekemo->td = $request->input('prekemoTD');
                $prekemo->nadi = $request->input('prekemoNadi');
                $prekemo->rr = $request->input('prekemoRR');
                $prekemo->suhu = $request->input('prekemoSuhu');
                $prekemo->nama_perawat = $request->input('prekemoNamaPerawat');
                $prekemo->save();
            }

            // Update data intrakemo
            $intrakemo = KemoterapiIntrakemo::where('kemoterapi_monitoring_tindakan_patient_id', $id)->first();
            if ($intrakemo) {
                $intrakemo->td = $request->input('intrakemoTD');
                $intrakemo->nadi = $request->input('intrakemoNadi');
                $intrakemo->rr = $request->input('intrakemoRR');
                $intrakemo->suhu = $request->input('intrakemoSuhu');
                $intrakemo->nama_perawat = $request->input('intrakemoNamaPerawat');
                $intrakemo->save();
            }

            // Update data postkemo
            $postkemo = KemoterapiPostkemo::where('kemoterapi_monitoring_tindakan_patient_id', $id)->first();
            if ($postkemo) {
                $postkemo->td = $request->input('postkemoTD');
                $postkemo->nadi = $request->input('postkemoNadi');
                $postkemo->rr = $request->input('postkemoRR');
                $postkemo->suhu = $request->input('postkemoSuhu');
                $postkemo->nama_perawat = $request->input('postkemoNamaPerawat');
                $postkemo->save();
            }

            // Regimen
            if ($prekemo || $intrakemo || $postkemo) {
                // Cek kondisi dan buat baris baru jika ada data yang terisi
                if ($prekemo) {
                    $prekemoCheck = $request->input('prekemoCheck', []);
                    $prekemoInput = $request->input('prekemoInput', []);
                    $prekemoMulai = $request->input('prekemoCheckMulai', []);
                    $prekemoSelesai = $request->input('prekemoCheckSelesai', []);
                    // dd($prekemoMulai);
                    // die;
                    foreach ($prekemoCheck as $key => $value) {
                        KemoterapiRegimen::create([
                            'kemoterapi_prekemo_id' => $prekemo->id,
                            'kemoterapi_intrakemo_id' => null,
                            'kemoterapi_postkemo_id' => null,
                            'name' => $value,
                            'keterangan' => isset($prekemoInput[$key]) ? $prekemoInput[$key] : null,
                            'jam_mulai' => $prekemoMulai[$key],
                            'jam_selesai' => $prekemoSelesai[$key],
                        ]);
                    }
                }
                if ($intrakemo) {
                    $intrakemoCheck = $request->input('intrakemoCheck', []);
                    $intrakemoInput = $request->input('intrakemoInput', []);
                    $intrakemoMulai = $request->input('intrakemoCheckMulai', []);
                    $intrakemoSelesai = $request->input('intrakemoCheckSelesai', []);
                    foreach ($intrakemoCheck as $key => $value) {
                        KemoterapiRegimen::create([
                            'kemoterapi_prekemo_id' => null,
                            'kemoterapi_intrakemo_id' => $intrakemo->id,
                            'kemoterapi_postkemo_id' => null,
                            'name' => $value,
                            'keterangan' => isset($intrakemoInput[$key]) ? $intrakemoInput[$key] : null,
                            'jam_mulai' => $intrakemoMulai[$key],
                            'jam_selesai' => $intrakemoSelesai[$key],
                        ]);
                    }
                }
                if ($postkemo) {
                    $postkemoCheck = $request->input('postkemoCheck', []);
                    $postkemoInput = $request->input('postkemoInput', []);
                    $postkemoMulai = $request->input('postkemoCheckMulai', []);
                    $postkemoSelesai = $request->input('postkemoCheckSelesai', []);
                    foreach ($postkemoCheck as $key => $value) {
                        KemoterapiRegimen::create([
                            'kemoterapi_prekemo_id' => null,
                            'kemoterapi_intrakemo_id' => null,
                            'kemoterapi_postkemo_id' => $postkemo->id,
                            'name' => $value,
                            'keterangan' => isset($postkemoInput[$key]) ? $postkemoInput[$key] : null,
                            'jam_mulai' => $postkemoMulai[$key],
                            'jam_selesai' => $postkemoSelesai[$key],
                        ]);
                    }
                }
            }

            // Redirect ke halaman yang sesuai
            return redirect()->route('kemoterapi/patient.show', $monitoring->kemoterapi_patient_id)->with([
                'success' => 'Data Berhasil Diperbarui',
                'active' => 'monitoringTindakanKemoterapi',
            ]);
        }

        // Jika data tidak ditemukan, redirect dengan pesan error
        return redirect()->route('kemoterapi/patient.show', $id)->with([
            'error' => 'Data Tidak Ditemukan',
            'active' => 'monitoringTindakanKemoterapi',
        ]);
    }

    public function destroy($id)
    {
        $item = KemoterapiMonitoringTindakanPatient::find($id);
        $item->delete();

        return back()->with([
            'success' => 'Berhasil Dihapus',
            'active' => 'monitoringTindakanKemoterapi',
        ]);
    }
}
