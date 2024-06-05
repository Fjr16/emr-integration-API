<?php

namespace App\Http\Controllers;

use App\Models\KemoterapiKarnofskyStatusPerformance;
use DateTime;
use Carbon\Carbon;
use App\Models\KemoterapiEducationNeedDetail;
use App\Models\KemoterapiInitialAssesment;
use App\Models\KemoterapiPatient;
use App\Models\KemoterapiPhysicalExaminationDetail;
use App\Models\KemoterapiPlanDetail;
use App\Models\KemoterapiSupportingExaminationDetail;
use Illuminate\Http\Request;
use App\Models\Medicine;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class KemoterapiInitialAssesmentController extends Controller
{
    public function create($id)
    {
        if (!session('penunjang')) {
            session(['penunjang' => 'radiologi']);
        } else {
            session(['penunjang' => session('penunjang')]);
        }
        $item = KemoterapiPatient::findOrFail($id);
        $arrPemeriksaan = ['KEPALA', 'MATA', 'THT', 'MULUT', 'LEHER', 'THORAKS', 'ABDOMEN', 'UROGENITAL & ANUS', 'EKSTREMITAS', 'NEUROLOGIS'];
        $arrDeskripsi = ['Normal, tak ada keluhan', 'Dapat mengerjakan aktivitas normal, mempunyai keluhan minor atau tanda dari suatu penyakit', 'Dapat melakukan aktivitas normal dengan effort', 'Dapat melakukan / melayani diri sendiri, tak dapat melakukan aktivitas normal atau
kerja akti', 'Ambulatory, membutuhkan bantuan untuk melakukan atau melayani diri sendiri pada kondisi tertentu', 'Lebih sering membutuhkan bantuan dan perlu perawatan', 'Membutuhkan bantuan khusus dan disable', 'Severly Disabled, perlu perawatan RS tetapi tidak mengancam kematian', 'Sakit berat, perlu perawatan RS, memerlukan bantuan terapi aktif', 'Terancam kematian', 'Mati'];
        $arrSkor = ['100', '90', '80', '70', '60', '50', '40', '30', '20', '10', '0'];
        $arrRencana = ['Kemoterapi ke'];
        $arrEdukasi = ['Penggunaan obat secara efektif dan aman', 'Penggunaan peralatan alat medis yang aman', 'Potensi interaksi obat dan makanan', 'Teknik rehabilitasi'];
        $dataObat = Medicine::all();

        // $radiologiResults = RadiologiPatient::where('queue_id', $item->id)->where('status', 'SELESAI')->get();
        // $laborResults = LaboratoriumPatientResult::where('queue_id', $item->id)->where('status', 'SELESAI')->get();
        return view('pages.assesmenAwalKemoterapi.create', [
            'title' => 'Pasien Kemo',
            'menu' => 'Kemoterapi',
            'item' => $item,
            'arrPemeriksaan' => $arrPemeriksaan,
            'arrDeskripsi' => $arrDeskripsi,
            'arrSkor' => $arrSkor,
            'arrRencana' => $arrRencana,
            'arrEdukasi' => $arrEdukasi,
            'dataObat' => $dataObat,
            // 'radiologiResults' => $radiologiResults,
            // 'laborResults' => $laborResults,
        ]);
    }

    public function store(Request $request, $id)
    {
        dd($request);
        $item = KemoterapiPatient::find($id);

        // $dpjp = $item->ranapDpjpPatientDetails->where('status', true)->first();

        $folder_path = 'assets/paraf-pasien/';
        Storage::makeDirectory('public/' . $folder_path);
        // paraf keluarga pasien
        $ttd = base64_decode(str_replace('data:image/png;base64,', '', $request->input('ttd')));
        $file_name_ttd = $folder_path . uniqid() . '.png';
        Storage::put('public/' . $file_name_ttd, $ttd);

        $data['kemoterapi_patient_id'] = $item->id;
        $data['patient_id'] = $item->queue->patient->id;
        $data['user_id'] = Auth::user()->id; //$dpjp->user->id
        $data['tanggal'] = date('Y-m-d H:i:s');
        $data['isPasien'] = $request->input('isPasien');
        $data['name'] = $request->input('name');
        $data['hubungan'] = $request->input('hubungan');
        $data['keluhan'] = $request->input('keluhan');
        $data['riwayat_penyakit_sekarang'] = $request->input('riwayat_penyakit_sekarang');
        $data['riwayat_penyakit_dahulu'] = $request->input('riwayat_penyakit_dahulu');
        $data['riwayat_penyakit_keluarga'] = $request->input('riwayat_penyakit_keluarga');
        $data['diagnosa_kerja'] = $request->input('diagnosa_kerja');
        $data['diagnosa_banding'] = $request->input('diagnosa_banding');
        $data['terapi'] = $request->input('terapi');
        if ($data['isPasien'] == 1) {
            $data['dijelaskan_kepada'] = 'Pasien';
        } else {
            $data['dijelaskan_kepada'] = 'Keluarga, hubungan ' . $data['hubungan'] ?? '';
        }
        $data['ttd_penerima_info'] = $file_name_ttd;
        $data['nama_dpjp'] = auth()->user()->name; //$dpjp->user->name
        $data['ttd_dpjp'] = auth()->user()->paraf; //$dpjp->user->paraf



        if ($assesmen = KemoterapiInitialAssesment::create($data)) {
            //pemeriksaan fisik
            $dataFisik = $request->input('fisik', []);
            foreach ($dataFisik as $index => $new) {
                if (isset($new['isNormal'])) {
                    $pemeriksaan['kemoterapi_initial_assesment_id'] = $assesmen->id;
                    $pemeriksaan['name'] = $new['name'];
                    $pemeriksaan['isNormal'] = $new['isNormal'];
                    if (isset($new['alasan'])) {
                        $pemeriksaan['keterangan'] = $new['alasan'];
                    } else {
                        $pemeriksaan['keterangan'] = null;
                    }
                    KemoterapiPhysicalExaminationDetail::create($pemeriksaan);
                }
            }

            //Hasil Pemeriksaan Penunjang
            $dataHasilPemeriksaanName = $request->input('nama_hasil_pemeriksaan', []);
            $dataHasilPemeriksaanValue = $request->input('hasil_pemeriksaan', []);
            foreach ($dataHasilPemeriksaanName as $index => $name) {
                if ($name) {
                    KemoterapiSupportingExaminationDetail::create([
                        'kemoterapi_initial_assesment_id' => $assesmen->id,
                        'name' => $name,
                        'hasil' => $dataHasilPemeriksaanValue[$index],
                    ]);
                }
            }

            //Rencana
            $dataRencana = $request->input('rencana', []);
            foreach ($dataRencana as $plan) {
                if ($plan == null) {
                    continue;
                }
                $newPlan = [
                    'kemoterapi_initial_assesment_id' => $assesmen->id,
                    'name' => $plan,
                ];
                KemoterapiPlanDetail::create($newPlan);
            }

            //edukasi
            $dataEdukasi = $request->input('edukasi', []);
            foreach ($dataEdukasi as $edukasi) {
                if ($edukasi == null) {
                    continue;
                }
                $newEdukasi = [
                    'kemoterapi_initial_assesment_id' => $assesmen->id,
                    'name' => $edukasi,
                ];
                KemoterapiEducationNeedDetail::create($newEdukasi);
            }

            // karnofsky
            $dataDeskripsi = $request->input('deskripsi', []);
            $dataSkor = $request->input('skor', []);

            foreach ($dataSkor as $index => $skor) {
                if (isset($skor['isChecked']) && $skor['isChecked']) {
                    $karnofsky = new KemoterapiKarnofskyStatusPerformance();
                    $karnofsky->kemoterapi_initial_assesment_id = $assesmen->id;
                    // dd($karnofsky->kemoterapi_initial_assesment_id);
                    // die;
                    $karnofsky->name = $dataDeskripsi[$index]['name'];
                    $karnofsky->hasil = (int)$skor['score']; // Ubah 'skor' menjadi 'score' sesuai dengan input yang Anda atur di view
                    $karnofsky->save();
                }
            }
        }
        return redirect()->route('kemoterapi/patient.show', $item->id)->with([
            'success' => 'Berhasil Ditambahkan',
            'active' => 'assesmen_medis',
        ]);
    }

    public function show($id)
    {
        $item = KemoterapiInitialAssesment::findOrFail($id);
        $waktu = new DateTime($item->tanggal);
        $formatId = Carbon::parse($item->tanggal);
        return view('pages.assesmenAwalKemoterapi.show', [
            'title' => 'Pasien Kemo',
            'menu' => 'Kemoterapi',
            'item' => $item,
            'waktu' => $waktu,
            'formatId' => $formatId
        ]);
    }

    public function destroy($id)
    {
        $item = KemoterapiInitialAssesment::find($id);
        $item->update([
            'isActive' => false
        ]);
        return back()->with([
            'success' => 'Berhasil Dihapus',
            'active' => 'assesmen_medis',
        ]);
    }
}
