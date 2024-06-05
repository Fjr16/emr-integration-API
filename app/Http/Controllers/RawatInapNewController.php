<?php

namespace App\Http\Controllers;

use App\Models\AnestesiReport;
use App\Models\CpptRanap;
use App\Models\GeneralConsentPatient;
use App\Models\LaporanOperasiPatient;
use App\Models\RanapInitialAssesment;
use App\Models\RawatInapPatient;
use App\Models\Queue;
use App\Models\RanapHaisPatient;
use App\Models\RanapMppPatient;
use App\Models\RanapPermintaanKonsulPenyakitDalamPatient;
use App\Models\RanapPersetujuanTindakanAnestesiPatient;
use App\Models\RanapPersetujuanTindakanBedahPatient;
use App\Models\RingkasanMasukDanKeluarPatient;
use App\Models\SuratPernyataanPersetujuanPatient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class RawatInapNewController extends Controller
{
    // protected $id;

    // public function __construct()
    // {
    //     $this->id = Route::current()->parameter('id');
    // }


    public function assesmen($id)
    {
        // $id = $this->id;
        session(['idPatient'=>$id]);
        $item = RawatInapPatient::find($id);
        $data = RanapInitialAssesment::where('rawat_inap_patient_id', $id)->get();
        return view('pages.rawatInapNew.assesmen', [
            'title' => 'Assesmen',
            'menu' => 'Rawat Inap',
            'item' => $item,
            'data' => $data,
            'id' => $id,
        ]);
    }

    public function catatanPerjalananAdministrasi()
    {
        $id = session('idPatient');
        // dd($id);die;
        $item = RawatInapPatient::find($id);
        // dd($item) ;
        return view('pages.rawatInapNew.catatanPerjalananAdministrasi', [
            'title' => 'Catatan Perjalanan Administrasi',
            'menu' => 'Rawat Inap',
            'item' => $item,
        ]);
    }

    public function cppt()
    {
        // $id = $this->id;
        $id = session('idPatient');
        $item = RawatInapPatient::find($id);
        $findUserInDpjp = $item->ranapDpjpPatientDetails->where('user_id', auth()->user()->id)->first();
        $isNotNull = $findUserInDpjp->end ?? null;
        if ($isNotNull) {
            $limited_date = date('Y-m-d', strtotime($findUserInDpjp->end));
        } else {
            $limited_date = date('Y-m-d');
        }
        $cpptRanaps = CpptRanap::where('patient_id', $item->queue->patient->id)
            ->whereDate('created_at', '<=', $limited_date)
            ->get();
        return view('pages.rawatInapNew.cpptRanap', [
            'title' => 'Cppt Ranap',
            'menu' => 'Rawat Inap',
            'item' => $item,
            'cpptRanaps' => $cpptRanaps,
        ]);
    }
    public function daftarTilik()
    {
        $id = session('idPatient');
        $item = RawatInapPatient::find($id);
        // return $item;
        return view('pages.rawatInapNew.daftarTilik', [
            'title' => 'Daftar Tilik',
            'menu' => 'Rawat Inap',
            'item' => $item,
        ]);
    }

    public function discharge()
    {
        $id = session('idPatient');
        $item = RawatInapPatient::find($id);
        return view('pages.rawatInapNew.discharge', [
            'title' => 'Discharge',
            'menu' => 'Rawat Inap',
            'item' => $item,
        ]);
    }

    public function edukasiPasienPraAnestesi()
    {
        // perbaikan
        $id = session('idPatient');
        $item = RawatInapPatient::find($id);
        $data = Queue::whereHas('rawatInapPatient', function($query){
            $query->whereNot('status', 'WAITING')->whereNot('status', 'BATAL');
        })->get();        // return $data;
        return view('pages.rawatInapNew.edukasiPasienPraAnestesi', [
            'title' => 'Edukasi Pasien Pra Anestesi',
            'menu' => 'Rawat Inap',
            'data' => $data,
            'item' => $item,
        ]);
    }

    public function ews()
    {
        $id = session('idPatient');
        $item = RawatInapPatient::find($id);
        return view('pages.rawatInapNew.ews', [
            'title' => 'EWS',
            'menu' => 'Rawat Inap',
            'item' => $item,
        ]);
    }

    public function formulirRekonsiliasiObat()
    {
        $id = session('idPatient');
        $item = RawatInapPatient::find($id);
        $data = Queue::whereHas('rawatInapPatient', function ($query) {
            $query->whereNot('status', 'WAITING')->whereNot('status', 'BATAL');
        })->get();
        return view('pages.rawatInapNew.formulirRekonsiliasiObat', [
            'title' => 'Formulir Rekonsiliasi Obat',
            'menu' => 'Rawat Inap',
            'item' => $item,
            'data' => $data,
        ]);
    }

    public function generalConsent()
    {
        $id = session('idPatient');
        $item = RawatInapPatient::find($id);
        $generalConsents = GeneralConsentPatient::where('rawat_inap_patient_id', $id)->get();
        return view('pages.rawatInapNew.generalConsent', [
            'title' => 'General Consent',
            'menu' => 'Rawat Inap',
            'generalConsents' => $generalConsents,
            'item' => $item,
        ]);
    }

    public function hais()
    {
        $id = session('idPatient');
        $item = RawatInapPatient::find($id);
        $data = RanapHaisPatient::where('rawat_inap_patient_id', $id)->get();
        return view('pages.rawatInapNew.hais', [
            'title' => 'HAIs',
            'menu' => 'Rawat Inap',
            'item' => $item,
            'data' => $data,
        ]);
    }

    public function konsultasiPenyakitDalam()
    {
        $id = session('idPatient');
        $item = RawatInapPatient::find($id);
        $konsultasi = RanapPermintaanKonsulPenyakitDalamPatient::where('rawat_inap_patient_id', $id)->get();
        return view('pages.rawatInapNew.konsultasiPenyakitDalam', [
            'title' => 'Konsultasi Penyakit Dalam',
            'menu' => 'Rawat Inap',
            'item' => $item,
            'konsultasi' => $konsultasi,
        ]);
    }

    public function laporan()
    {
        $id = session('idPatient');
        $item = RawatInapPatient::find($id);
        $data = LaporanOperasiPatient::where('rawat_inap_patient_id', $id)->get();
        $data2 = AnestesiReport::where('queue_id', $item->queue_id)->get();

        return view('pages.rawatInapNew.laporan', [
            'title' => 'Laporan',
            'menu' => 'Rawat Inap',
            'item' => $item,
            'data' => $data,
            'data2' => $data2,
        ]);
    }

    public function managerPelayananPasien()
    {
        $id = session('idPatient');
        $item = RawatInapPatient::find($id);
        $data = RanapMppPatient::where('rawat_inap_patient_id', $id)->get();
        return view('pages.rawatInapNew.managerPelayananPasien', [
            'title' => 'Manager Pelayanan Pasien',
            'menu' => 'Rawat Inap',
            'item' => $item,
            'data' => $data,
        ]);
    }

    public function monitoring()
    {
        // perbaikan dan penambahan
        $id = session('idPatient');
        $item = RawatInapPatient::find($id);
        $data = Queue::whereHas('rawatInapPatient', function ($query) {
            $query->whereNot('status', 'WAITING')->whereNot('status', 'BATAL');
        })->get();
        return view('pages.rawatInapNew.monitoring', [
            'title' => 'Monitoring',
            'menu' => 'Rawat Inap',
            'item' => $item,
            'data' => $data,
        ]);
    }

    public function persetujuan()
    {
        $id = session('idPatient');
        $item = RawatInapPatient::find($id);
        $data = SuratPernyataanPersetujuanPatient::where('rawat_inap_patient_id', $id)->get();
        $data2 = RanapPersetujuanTindakanBedahPatient::where('rawat_inap_patient_id', $item->id)->get();
        $data3 = RanapPersetujuanTindakanAnestesiPatient::where('rawat_inap_patient_id', $id)->get();
        return view('pages.rawatInapNew.persetujuan', [
            'title' => 'Persetujuan',
            'menu' => 'Rawat Inap',
            'item' => $item,
            'data' => $data,
            'data2' => $data2,
            'data3' => $data3,
        ]);
    }

    public function resepDokter()
    {
        $id = session('idPatient');
        $item = RawatInapPatient::find($id);
        return view('pages.rawatInapNew.resepDokter', [
            'title' => 'Resep Dokter',
            'menu' => 'Rawat Inap',
            'item' => $item,
        ]);
    }

    public function ringkasanMasukDanKeluar()
    {
        $id = session('idPatient');
        $item = RawatInapPatient::find($id);
        $data = RingkasanMasukDanKeluarPatient::where('rawat_inap_patient_id', $id)->get();
        return view('pages.rawatInapNew.ringkasanMasukDanKeluar', [
            'title' => 'Ringkasan Masuk Dan Keluar',
            'menu' => 'Rawat Inap',
            'item' => $item,
            'data' => $data,
        ]);
    }

    public function skriningCovid()
    {
        $id = session('idPatient');
        $item = RawatInapPatient::find($id);
        return view('pages.rawatInapNew.skriningCovid', [
            'title' => 'SKRINING COVID',
            'menu' => 'Rawat Inap',
            'item' => $item,
        ]);
    }

    public function tindakanPelayanan()
    {
        $id = session('idPatient');
        $item = RawatInapPatient::find($id);
        return view('pages.rawatInapNew.tindakanPelayanan', [
            'title' => 'Tindakan Pelayanan',
            'menu' => 'Rawat Inap',
            'item' => $item,
        ]);
    }
}
