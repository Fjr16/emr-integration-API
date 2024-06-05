<?php

namespace App\Http\Controllers;

use App\Models\AnestesiReport;
use App\Models\AnestesiReportAirway;
use App\Models\AnestesiReportAnasthesia;
use App\Models\AnestesiReportIntubasi;
use App\Models\AnestesiReportMedicine;
use App\Models\AnestesiReportMedicineDetail;
use App\Models\AnestesiReportMonitoring;
use App\Models\AnestesiReportPerifer;
use App\Models\AnestesiReportVentilation;
use App\Models\Medicine;
use App\Models\Queue;
use App\Models\RawatInapPatient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RanapLaporanAnestesiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Queue::whereHas('rawatInapPatient')->get();
        return view('pages.laporanAnestesi.index', [
            "title" => "Laporan Anestesi",
            "menu" => "Rawat Inap",
            'data' => $data,
        ]);
    }

    public function detail($id)
    {
        $item = RawatInapPatient::where('queue_id', $id)->first();
        $data = AnestesiReport::where('queue_id', $id)->get();
        return view('pages.laporanAnestesi.detail', [
            "title" => "Laporan Anestesi",
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
        $medicines = Medicine::all();
        return view('pages.laporanAnestesi.create', [
            "title" => "Laporan Anestesi",
            "menu" => "Rawat Inap",
            'item' => $item,
            'medicines' => $medicines,
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

        $dataAnesReport = [
            'user_id' => Auth::user()->id,
            'queue_id' => $item->queue->id,
            'patient_id' => $item->queue->patient->id,
            'nama_penata_anestesi' => null,
            'ttd_penata_anestesi' => null,
            'nama_dokter_anestesi' => $request->input('nama_dokter_anestesi'),
            'ttd_dokter_anestesi' => $request->input('ttd_dokter_anestesi'),
            'perifer_first' => $request->input('perifer_first'),
            'perifer_second' => $request->input('perifer_second'),
            'perifer_cvc' => $request->input('perifer_cvc'),
            'posisi' => $request->input('posisi'),
            'perlindungan_mata' => $request->input('perlindungan_mata'),
            'pre_oral' => $request->input('premedikasi_oral'),
            'pre_im' => $request->input('premedikasi_im'),
            'pre_iv' => $request->input('premedikasi_iv'),
            'induksi_intravena' => $request->input('induksi_intravena'),
            'induksi_inhalasi' => $request->input('induksi_inhalasi'),
            'lama_pembiusan_jam' => $request->input('lama_pembiusan_jam'),
            'lama_pembiusan_menit' => $request->input('lama_pembiusan_menit'),
            'lama_pembedahan_jam' => $request->input('lama_pembedahan_jam'),
            'lama_pembedahan_menit' => $request->input('lama_pembedahan_menit'),
            'keterangan' => $request->input('keterangan'),
        ];
        $mainTb = AnestesiReport::create($dataAnesReport);

        // jalur Nafas
        $dataAnesAirway = [
            'anestesi_report_id' => $mainTb->id,
            'face_mask_no' => $request->input('face_mask_no'),
            'ett_no' => $request->input('ett_no'),
            'ett_jenis' => $request->input('ett_jenis'),
            'lma_no' => $request->input('lma_no'),
            'lma_jenis' => $request->input('lma_jenis'),
            'trakheostomi_no' => $request->input('trakheostomi_no'),
            'trakheostomi_jenis' => $request->input('trakheostomi_jenis'),
            'glidescope_no' => $request->input('glidescope_no'),
            'glidescope_fiksasi' => $request->input('glidescope_fiksasi'),
            'other_airway' => $request->input('other_airway'),
        ];
        AnestesiReportAirway::create($dataAnesAirway);

        // Intubasi
        $dataAnesIntubasi = [];
        $intubasis = $request->input('intubasi', []);
        foreach ($intubasis as $intubasi) {
            $dataAnesIntubasi[] = [
                'anestesi_report_id' => $mainTb->id,
                'name' => $intubasi,
                'value' => null,
            ];
        }

        $intubasiOtherName = $request->input('intubasi_oth_name', []);
        $intubasiOtherValue = $request->input('intubasi_oth_value', []);
        foreach ($intubasiOtherName as $key => $name) {
            $dataAnesIntubasi[] = [
                'anestesi_report_id' => $mainTb->id,
                'name' => $name,
                'value' => $intubasiOtherValue[$key],
            ];
        }
        foreach ($dataAnesIntubasi as $anesIntubasi) {
            AnestesiReportIntubasi::create($anesIntubasi);
        }

        //Ventilation
        $dataAnesVentilasi = [];
        $ventilasis = $request->input('ventilasi', []);
        foreach ($ventilasis as $ventilasi) {
            if ($ventilasi) {
                $dataAnesVentilasi[] = [
                    'anestesi_report_id' => $mainTb->id,
                    'name' => $ventilasi,
                    'value' => null,
                ];
            }
        }

        $ventilasiOtherName = $request->input('ventilator_name', []);
        $ventilasiOtherValue = $request->input('ventilator_value', []);
        foreach ($ventilasiOtherName as $key => $name) {
            if (isset($ventilasiOtherValue[$key])) {
                $dataAnesVentilasi[] = [
                    'anestesi_report_id' => $mainTb->id,
                    'name' => $name,
                    'value' => $ventilasiOtherValue[$key],
                ];
            }
        }
        foreach ($dataAnesVentilasi as $anesVentilasi) {
            AnestesiReportVentilation::create($anesVentilasi);
        }

        //Perifer
        $dataAnesPerifer = [
            'anestesi_report_id' => $mainTb->id,
            'jenis' => $request->input('jenis'),
            'lokasi' => $request->input('lokasi'),
            'jenis_jarum' => $request->input('jenis_jarum'),
            'kateter' => $request->input('kateter'),
            'kateter_fiksasi' => $request->input('kateter_fiksasi'),
            'obat' => $request->input('obat'),
            'komplikasi' => $request->input('komplikasi'),
            'hasil' => $request->input('hasil'),
        ];
        AnestesiReportPerifer::create($dataAnesPerifer);

        //Obat-obatan - infus
        $anesMedicine = AnestesiReportMedicine::create([
            'anestesi_report_id' => $mainTb->id,
            'nitrogen_oksida' => $request->input('nitrogen_oksida'),
            'oksigen' => $request->input('oksigen'),
            'air' => $request->input('air'),
            'isof' => $request->input('isof'),
            'sevo' => $request->input('sevo'),
            'des' => $request->input('des'),
        ]);

        $medicineIds = $request->input('medicine_id', []);
        $medicineValue = $request->input('medicine_value', []);
        foreach ($medicineIds as $key => $medicineId) {
            if ($medicineId != 'Pilih') {
                AnestesiReportMedicineDetail::create([
                    'anestesi_report_medicine_id' => $anesMedicine->id,
                    'medicine_id' => $medicineId,
                    'medicine_value' => $medicineValue[$key],
                ]);
            }
        }

        //Anestesia
        $respirasi = $request->input('respirasi', []);
        $nadi = $request->input('nadi', []);
        $tdSistolik = $request->input('tekanan_darah_sistolik', []);
        $tdDiastolik = $request->input('tekanan_darah_diastolik', []);
        foreach ($respirasi as $key => $res) {
            if ($res) {
                AnestesiReportAnasthesia::create([
                    'anestesi_report_id' => $mainTb->id,
                    'respirasi' => $res,
                    'nadi' => $nadi[$key],
                    'tekanan_darah_sistolik' => $tdSistolik[$key],
                    'tekanan_darah_diastolik' => $tdDiastolik[$key],
                ]);
            }
        }

        //Pemantauan
        $jenis = $request->input('jenis_pemantauan', []);
        $pemantauan = $request->input('pemantauan', []);
        $satuan = $request->input('satuan', []);
        $nilai = $request->input('nilai', []);
        foreach ($jenis as $key => $jen) {
            if ($key) {
                AnestesiReportMonitoring::create([
                    'anestesi_report_id' => $mainTb->id,
                    'jenis_pemantauan' => $jen,
                    'pemantauan' => $pemantauan[$key],
                    'satuan' => $satuan[$key],
                    'nilai' => $nilai[$key],
                ]);
            }
        }

        return redirect()->route('laporan/anestesi.detail', $item->queue_id)->with([
            'success' => 'Data Berhasil Ditambahkan',
            'btn' => 'laporananestesi',
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
        $item = AnestesiReport::find($id);
        $medicines = Medicine::all();
        $posisis = [
            'Telentang',
            'Prone',
            'Lithotomi',
            'Lateral Kanan',
            'Lateral Kiri',
        ];
        return view('pages.laporanAnestesi.show', [
            "title" => "Laporan Anestesi",
            "menu" => "Rawat Inap",
            'item' => $item,
            'medicines' => $medicines,
            'posisis' => $posisis,
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
        $item = AnestesiReport::find($id);
        $medicines = Medicine::all();
        $posisis = [
            'Telentang',
            'Prone',
            'Lithotomi',
            'Lateral Kanan',
            'Lateral Kiri',
        ];
        return view('pages.laporanAnestesi.edit', [
            "title" => "Laporan Anestesi",
            "menu" => "Rawat Inap",
            'item' => $item,
            'medicines' => $medicines,
            'posisis' => $posisis,
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
        $item = AnestesiReport::find($id);

        $item->update([
            'nama_penata_anestesi' => $request->input('nama_penata_anestesi'),
            'ttd_penata_anestesi' => $request->input('ttd_penata_anestesi'),
            'nama_dokter_anestesi' => $request->input('nama_dokter_anestesi'),
            'ttd_dokter_anestesi' => $request->input('ttd_dokter_anestesi'),
            'perifer_first' => $request->input('perifer_first'),
            'perifer_second' => $request->input('perifer_second'),
            'perifer_cvc' => $request->input('perifer_cvc'),
            'posisi' => $request->input('posisi'),
            'perlindungan_mata' => $request->input('perlindungan_mata'),
            'pre_oral' => $request->input('premedikasi_oral'),
            'pre_im' => $request->input('premedikasi_im'),
            'pre_iv' => $request->input('premedikasi_iv'),
            'induksi_intravena' => $request->input('induksi_intravena'),
            'induksi_inhalasi' => $request->input('induksi_inhalasi'),
            'lama_pembiusan_jam' => $request->input('lama_pembiusan_jam'),
            'lama_pembiusan_menit' => $request->input('lama_pembiusan_menit'),
            'lama_pembedahan_jam' => $request->input('lama_pembedahan_jam'),
            'lama_pembedahan_menit' => $request->input('lama_pembedahan_menit'),
            'keterangan' => $request->input('keterangan'),
        ]);

        // jalur Nafas
        $item->anestesiReportAirway()->update([
            'face_mask_no' => $request->input('face_mask_no'),
            'ett_no' => $request->input('ett_no'),
            'ett_jenis' => $request->input('ett_jenis'),
            'lma_no' => $request->input('lma_no'),
            'lma_jenis' => $request->input('lma_jenis'),
            'trakheostomi_no' => $request->input('trakheostomi_no'),
            'trakheostomi_jenis' => $request->input('trakheostomi_jenis'),
            'glidescope_no' => $request->input('glidescope_no'),
            'glidescope_fiksasi' => $request->input('glidescope_fiksasi'),
            'other_airway' => $request->input('other_airway'),
        ]);

        // Intubasi
        $item->anestesiReportIntubasis()->delete();
        $dataAnesIntubasi = [];
        $intubasis = $request->input('intubasi', []);
        foreach ($intubasis as $intubasi) {
            $dataAnesIntubasi[] = [
                'anestesi_report_id' => $item->id,
                'name' => $intubasi,
                'value' => null,
            ];
        }

        $intubasiOtherName = $request->input('intubasi_oth_name', []);
        $intubasiOtherValue = $request->input('intubasi_oth_value', []);
        foreach ($intubasiOtherName as $key => $name) {
            $dataAnesIntubasi[] = [
                'anestesi_report_id' => $item->id,
                'name' => $name,
                'value' => $intubasiOtherValue[$key],
            ];
        }
        foreach ($dataAnesIntubasi as $anesIntubasi) {
            AnestesiReportIntubasi::create($anesIntubasi);
        }

        //Ventilation
        $item->anestesiReportVentilations()->delete();
        $dataAnesVentilasi = [];
        $ventilasis = $request->input('ventilasi', []);
        foreach ($ventilasis as $ventilasi) {
            if ($ventilasi) {
                $dataAnesVentilasi[] = [
                    'anestesi_report_id' => $item->id,
                    'name' => $ventilasi,
                    'value' => null,
                ];
            }
        }

        $ventilasiOtherName = $request->input('ventilator_name', []);
        $ventilasiOtherValue = $request->input('ventilator_value', []);
        foreach ($ventilasiOtherName as $key => $name) {
            if (isset($ventilasiOtherValue[$key])) {
                $dataAnesVentilasi[] = [
                    'anestesi_report_id' => $item->id,
                    'name' => $name,
                    'value' => $ventilasiOtherValue[$key],
                ];
            }
        }
        foreach ($dataAnesVentilasi as $anesVentilasi) {
            AnestesiReportVentilation::create($anesVentilasi);
        }

        //Perifer
        $item->anestesiReportPerifer()->update([
            'jenis' => $request->input('jenis'),
            'lokasi' => $request->input('lokasi'),
            'jenis_jarum' => $request->input('jenis_jarum'),
            'kateter' => $request->input('kateter'),
            'kateter_fiksasi' => $request->input('kateter_fiksasi'),
            'obat' => $request->input('obat'),
            'komplikasi' => $request->input('komplikasi'),
            'hasil' => $request->input('hasil'),
        ]);

        //Obat-obatan - infus
        $item->anestesiReportMedicine->update([
            'nitrogen_oksida' => $request->input('nitrogen_oksida'),
            'oksigen' => $request->input('oksigen'),
            'air' => $request->input('air'),
            'isof' => $request->input('isof'),
            'sevo' => $request->input('sevo'),
            'des' => $request->input('des'),
        ]);

        $item->anestesiReportMedicine->anestesiReportMedicineDetails()->delete();
        $medicineIds = $request->input('medicine_id', []);
        $medicineValue = $request->input('medicine_value', []);
        foreach ($medicineIds as $key => $medicineId) {
            if ($medicineId != 'Pilih') {
                AnestesiReportMedicineDetail::create([
                    'anestesi_report_medicine_id' => $item->anestesiReportMedicine->id,
                    'medicine_id' => $medicineId,
                    'medicine_value' => $medicineValue[$key],
                ]);
            }
        }

        //Anestesia
        $item->anestesiReportAnasthesias()->delete();
        $respirasi = $request->input('respirasi', []);
        $nadi = $request->input('nadi', []);
        $tdSistolik = $request->input('tekanan_darah_sistolik', []);
        $tdDiastolik = $request->input('tekanan_darah_diastolik', []);
        foreach ($respirasi as $key => $res) {
            AnestesiReportAnasthesia::create([
                'anestesi_report_id' => $item->id,
                'respirasi' => $res,
                'nadi' => $nadi[$key],
                'tekanan_darah_sistolik' => $tdSistolik[$key],
                'tekanan_darah_diastolik' => $tdDiastolik[$key],
            ]);
        }

        //Pemantauan
        $item->anestesiReportMonitorings()->delete();
        $jenis = $request->input('jenis_pemantauan', []);
        $pemantauan = $request->input('pemantauan', []);
        $satuan = $request->input('satuan', []);
        $nilai = $request->input('nilai', []);
        foreach ($jenis as $key => $jen) {
            AnestesiReportMonitoring::create([
                'anestesi_report_id' => $item->id,
                'jenis_pemantauan' => $jen ?? null,
                'pemantauan' => $pemantauan[$key] ?? null,
                'satuan' => $satuan[$key] ?? null,
                'nilai' => $nilai[$key] ?? 0,
            ]);
        }

        return redirect()->route('laporan/anestesi.detail', $item->queue_id)->with([
            'success' => 'Data Berhasil Diperbarui',
            'btn' => 'laporananestesi',
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
        $item = AnestesiReport::find($id);
        $item->anestesiReportAirway()->delete();
        $item->anestesiReportIntubasis()->delete();
        $item->anestesiReportVentilations()->delete();
        $item->anestesiReportPerifer()->delete();
        $item->anestesiReportMedicine->anestesiReportMedicineDetails()->delete();
        $item->anestesiReportMedicine()->delete();
        $item->anestesiReportAnasthesias()->delete();
        $item->anestesiReportMonitorings()->delete();
        $item->delete();

        return back()->with('success', 'Berhasil Dihapus');
    }
}
