<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Queue;
use App\Models\Action;
use App\Models\Procedure;
use App\Models\Diagnostic;
use App\Models\PatientActionReport;
use Illuminate\Support\Facades\Auth;
use App\Models\PerawatInitialAsesment;

class ManagementDataController extends Controller
{
    // menghitung usia
    private function getUsia($tglLhrPasien) {
        if ($tglLhrPasien) {
            $tanggalLahir = new DateTime($tglLhrPasien);
            $now = new DateTime();
            $ageDiff = $now->diff($tanggalLahir);
            return $res = $ageDiff->format('%y tahun %m bulan');
        }else{
            return $res = 'Usia Tidak Diketahui';
        }
    }

    public function index(){
        $data = Queue::where('status_antrian', 'FINISHED')
                    ->whereNull('ttd_verif')
                    ->orWhere('ttd_verif', '')
                    ->whereDoesntHave('soapDokter')
                    ->orWhereDoesntHave('diagnosticProcedurePatient')
                    ->orWhereHas('diagnosticProcedurePatient', function ($dpp){
                        $dpp->where('diagnostic_id', null)
                            ->orWhereNotNull('desc_diagnosa_primer')
                            ->orWhere('procedure_id', null)
                            ->orWhereNotNull('desc_prosedure');
                    })
                    ->get();
        $user = Auth::user();
        return view('pages.manageMonitoringData.index' ,[
            'data' => $data,
            'user' => $user,
            'title' => 'Monitoring',
            'menu' => 'Monitoring',
        ]);
    }
    public function edit($id){
        if (!session('tab')) {
            session(['tab' => 'diagnosa']);
        } else {
            session(['tab' => session('tab')]);
        }
        $item = Queue::findOrFail(decrypt($id));
        $riwKunjungans = Queue::where('patient_id', $item->patient->id)->where('status_antrian', 'ARRIVED')->orWhere('status_antrian', 'FINISHED')->latest()->get();

        $reportActions = PatientActionReport::where('queue_id', $item->id)->first();
        $diagnostics = Diagnostic::orderBy('icd_x_code')->get();
        $procedures = Procedure::get();
        $dataTindakan = Action::where('jenis_tindakan', 'Tindakan Pelayanan Medis')->with('actionRates')->get();
        return view('pages.manageMonitoringData.edit' ,[
            'item' => $item,
            'riwKunjungans' => $riwKunjungans,
            'reportActions' => $reportActions,
            'diagnostics' => $diagnostics,
            'procedures' => $procedures,
            'dataTindakan' => $dataTindakan,
            'title' => 'Monitoring',
            'menu' => 'Monitoring',
        ]);
    }

    public function indexVerif(){
        $data = Queue::where('dokter_id', Auth::user()->id)
                        ->whereIn('status_antrian', ['ARRIVED', 'FINISHED'])
                        ->whereNull('ttd_verif')
                        ->orWhere('ttd_verif', '')
                        ->get();
        $user = Auth::user();
        return view('pages.manageVerifData.index' ,[
            'data' => $data,
            'user' => $user,
            'title' => 'Verifikasi',
            'menu' => 'Verifikasi',
        ]);
    }
    public function showVerif($id){
       $item = Queue::findOrFail(decrypt($id));
       $usiaSaatBerkunjung = $this->getUsia($item->patient->tanggal_lhr);
       $itemAss = PerawatInitialAsesment::where('queue_id', $item->id)->first();
        return view('pages.manageVerifData.show' ,[
            'item' => $item,
            'itemAss' => $itemAss,
            'usiaSaatBerkunjung' => $usiaSaatBerkunjung,
            'title' => 'Verifikasi',
            'menu' => 'Verifikasi',
        ]);
    }

    public function indexSatuSehat(){
        $data = Queue::where('status_antrian', 'FINISHED')
            ->whereNotNull('ttd_verif')
            ->has('soapDokter')
            ->whereHas('diagnosticProcedurePatient', function ($dpp){
                $dpp->whereNotNull('diagnostic_id')
                    ->whereNull('desc_diagnosa_primer')
                    ->whereNotNull('procedure_id')
                    ->whereNull('desc_prosedure');
            })
        ->get();
        $user = Auth::user();
        return view('pages.manageSatuSehat.index' ,[
            'data' => $data,
            'user' => $user,
            'title' => 'Satu Sehat',
            'menu' => 'Satu Sehat',
        ]);
    }
}
