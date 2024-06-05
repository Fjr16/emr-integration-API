<?php

namespace App\Http\Controllers;

use App\Models\DetailAdmPernyataanPersetujuanPatient;
use App\Models\Queue;
use App\Models\RawatInapPatient;
use App\Models\SuratPernyataanPersetujuanPatient;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RanapPernyataanPersetujuanStatusPelayananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Queue::whereHas('rawatInapPatient', function($query){
            $query->whereNot('status', 'WAITING')->whereNot('status', 'BATAL');
        })->get();
        return view('pages.suratPernyataanPersetujuanStatusPelayananPasien.index', [
            "title" => "Persetujuan Pelayanan Pasien",
            "menu" => "Rawat Inap",
            "data" => $data,
        ]);
    }

    public function detail($id)
    {
        $item = RawatInapPatient::find($id);
        $data = SuratPernyataanPersetujuanPatient::where('rawat_inap_patient_id', $id)->get();

        return view('pages.suratPernyataanPersetujuanStatusPelayananPasien.detail', [
            "item" => $item,
            "title" => "Persetujuan Pelayanan Pasien",
            "menu" => "Rawat Inap",
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
        $today = new DateTime();
        $tgl_lhr = new DateTime($item->queue->patient->tanggal_lhr);
        $umur = $tgl_lhr->diff($today)->y;
        $hubs = [
            'Pasien',
            'Keluarga',
            'Teman',
        ];
        return view('pages.suratPernyataanPersetujuanStatusPelayananPasien.create', [
            "title" => "Persetujuan Pelayanan Pasien",
            "menu" => "Rawat Inap",
            "item" => $item,
            "umur" => $umur,
            "hubs" => $hubs
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
        $data = $request->all();
        // dd($data);

        $folder_path = 'assets/paraf-pasien/';
        Storage::makeDirectory('public/' . $folder_path);

        $arrParaf = $request->input('paraf', []);
        foreach ($arrParaf as $prf) {
            if ($prf != null) {
                // paraf keluarga pasien
                $paraf = base64_decode(str_replace('data:image/png;base64,', '', $prf));
                $file_name_paraf = $folder_path . uniqid() . '.png';
                Storage::put('public/' . $file_name_paraf, $paraf);

                $data['paraf'] = $file_name_paraf;
            }
        }




        // ttd keluarga pasien
        $ttd = base64_decode(str_replace('data:image/png;base64,', '', $request->input('ttd')));
        $file_name_ttd = $folder_path . uniqid() . '.png';
        Storage::put('public/' . $file_name_ttd, $ttd);


        $sppt = SuratPernyataanPersetujuanPatient::create([
            'name' => $request->name,
            'umur' => $request->umur,
            'hubungan' => $request->hubungan,
            'ctt_khusus' => $request->ctt_khusus,
            'paraf' => $data['paraf'],
            'header' => $request->header,
            'jaminan' => $request->jaminan,
            'dariKelas' => $request->darikelas,
            'keKelas' => $request->keKelas,
            'ttd' => $file_name_ttd,
            'statusAdm' => $request->statusAdm,
            'user_id' => Auth::user()->id,
            'patient_id' => $item->queue->patient->id,
            'rawat_inap_patient_id' => $item->id,
        ]);


        $arrKelAdm = $request->input('kelAdm', []);


        if ($arrKelAdm) {
            foreach ($arrKelAdm as $adm) {
                if ($adm) {
                    DetailAdmPernyataanPersetujuanPatient::create([
                        'surat_pernyataan_persetujuan_patient_id' => $sppt->id,
                        'name' => $adm,
                    ]);
                }
            }
        }

        return redirect()->route('surat/pernyataan/persetujuan/status/pelayanan.detail', $item->id)->with([
            'success' => 'Berhasil Ditambahkan',
            'btn' => 'persetujuanpelayanan'
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
        $data = SuratPernyataanPersetujuanPatient::find($id);
        $kelAdm = DetailAdmPernyataanPersetujuanPatient::where('surat_pernyataan_persetujuan_patient_id', $data->id)->get();
        $today = new DateTime();
        $tgl_lhr = new DateTime($data->rawatInapPatient->queue->patient->tanggal_lhr);
        $umur = $tgl_lhr->diff($today)->y;
        $hubs = [
            'Pasien',
            'Keluarga',
            'Teman',
        ];
        return view('pages.suratPernyataanPersetujuanStatusPelayananPasien.show', [
            "title" => "Persetujuan Pelayanan Pasien",
            "menu" => "Rawat Inap",
            'data' => $data,
            'kelAdm' => $kelAdm,
            'umur' => $umur,
            'hubs' => $hubs,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = SuratPernyataanPersetujuanPatient::find($id);
        $kelAdm = DetailAdmPernyataanPersetujuanPatient::where('surat_pernyataan_persetujuan_patient_id', $data->id)->get();
        $today = new DateTime();
        $tgl_lhr = new DateTime($data->rawatInapPatient->queue->patient->tanggal_lhr);
        $umur = $tgl_lhr->diff($today)->y;
        $hubs = [
            'Pasien',
            'Keluarga',
            'Teman',
        ];
        return view('pages.suratPernyataanPersetujuanStatusPelayananPasien.edit', [
            "title" => "Persetujuan Pelayanan Pasien",
            "menu" => "Rawat Inap",
            'data' => $data,
            'kelAdm' => $kelAdm,
            'umur' => $umur,
            'hubs' => $hubs,
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
        $item = SuratPernyataanPersetujuanPatient::find($id);
        $data = $request->all();

        if ($request->input('jaminan')) {
            $data['jaminan'] = $request->input('jaminan');
        } else {
            $data['jaminan'] = null;
        }

        if ($request->input('dariKelas')) {
            $data['dariKelas'] = $request->input('dariKelas');
        } else {
            $data['dariKelas'] = null;
        }

        if ($request->input('keKelas')) {
            $data['keKelas'] = $request->input('keKelas');
        } else {
            $data['keKelas'] = null;
        }

        if ($request->input('status')) {
            $data['status'] = $request->input('status');
        } else {
            $data['status'] = null;
        }



        $folder_path = 'assets/paraf-pasien/';
        Storage::makeDirectory('public/' . $folder_path);

        $arrParaf = $request->input('paraf', []);

        foreach ($arrParaf as $prf) {
            if ($prf) {
                // paraf keluarga pasien
                $paraf = base64_decode(str_replace('data:image/png;base64,', '', $prf));
                $file_name_paraf = $folder_path . uniqid() . '.png';
                Storage::put('public/' . $file_name_paraf, $paraf);

                $data['paraf'] = $file_name_paraf;
                break;
            } else {
                $data['paraf'] = $item->paraf;
            }
        }

        if ($request->input('ttd')) {
            // ttd keluarga pasien
            $ttd = base64_decode(str_replace('data:image/png;base64,', '', $request->input('ttd')));
            $file_name_ttd = $folder_path . uniqid() . '.png';
            Storage::put('public/' . $file_name_ttd, $ttd);
            $data['ttd'] = $file_name_ttd;
        } else {
            $data['ttd'] = $item->ttd;
        }

        $arrKelAdm = $request->input('kelAdm', []);

        DetailAdmPernyataanPersetujuanPatient::where('surat_pernyataan_persetujuan_patient_id', $item->id)->delete();

        if ($arrKelAdm) {
            foreach ($arrKelAdm as $adm) {
                if ($adm) {
                    DetailAdmPernyataanPersetujuanPatient::create([
                        'surat_pernyataan_persetujuan_patient_id' => $item->id,
                        'name' => $adm,
                    ]);
                }
            }
        }

        $item->update($data);

        return redirect()->route('surat/pernyataan/persetujuan/status/pelayanan.detail', $item->rawat_inap_patient_id)->with('success', 'Data Berhasil  Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = SuratPernyataanPersetujuanPatient::find($id);
        $item->detailAdmPernyataanPersetujuanPatients()->delete();
        $item->delete();
        return back()->with('success', 'Berhasil Dihapus');
    }
}
