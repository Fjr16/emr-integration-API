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
use App\Models\SatuSehatPatient;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

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
        $data = Queue::whereIn('status_antrian', ['FINISHED', 'ARRIVED'])
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
    public function verifikasiDokter($id){
        $item = Queue::findOrFail(decrypt($id));
        $userActive = Auth::user();
        if ($item->ttd_verif) {
            return back()->with('error', 'Data Pasien Telah Diverifikasi');
        }
        if ($item->dokter_id !== Auth::user()->id) {
            return back()->with('error', 'Hanya Dapat Diverifikasi oleh Dokter Penanggung Jawab Pasien');
        }
        if ($item->status_antrian != 'ARRIVED' && $item->status_antrian != 'FINISHED') {
            return back()->with('error', 'Status pelayanan pasien tidak memenuhi kriteria untuk diverifikasi');
        }
        if (!$userActive->paraf) {
            return back()->with('error', 'Data Tanda Tangan Dokter Tidak Ditemukan Mohon lengkapi data');
        }
        
        $item->update([
            'ttd_verif' => $userActive->paraf,
        ]);

        return redirect()->route('verifikasi/data/pasien.indexVerif')->with('success', 'Berhasil Memverifikasi Data Pasien');

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
    public function showSatuSehat($id){
        $item = Queue::findOrFail(decrypt($id));
        $usiaSaatBerkunjung = $this->getUsia($item->patient->tanggal_lhr);
        $itemAss = PerawatInitialAsesment::where('queue_id', $item->id)->first();
         return view('pages.manageSatuSehat.show' ,[
             'item' => $item,
             'itemAss' => $itemAss,
             'usiaSaatBerkunjung' => $usiaSaatBerkunjung,
             'title' => 'Satu Sehat',
             'menu' => 'Satu Sehat',
         ]);
    }
    public function postBridging($id){
        DB::beginTransaction();
        try {

            $item = Queue::findOrFail(decrypt($id));
            if (!$item->ttd_verif) {
                DB::rollBack();
                return back()->with('error', 'Data Pasien Belum Diverifikasi');
            }
            if ($item->status_antrian != 'FINISHED') {
                DB::rollBack();
                return back()->with('error', 'Status pelayanan pasien belum selesai');
            }
            
            // diagnosa sekunder
            $diagnosaSekunder = null;
            if ($item->diagnosticProcedurePatient->diagnosticSecondary->isNotEmpty()) {
                $diagnosaSekunderData = [];
                foreach ($item->diagnosticProcedurePatient->diagnosticSecondary as $sekunder) {
                    $diagnosaSekunderData[] = $sekunder->diagnostic->name;
                }
                $diagnosaSekunder = implode(', ', $diagnosaSekunderData);
            }

            // radiologi
            $radiologi = null;
            if ($item->radiologiFormRequests->isNotEmpty()) {
                $radiologiData = [];
                foreach ($item->radiologiFormRequests as $reqRad) {                    
                    foreach ($reqRad->radiologiFormRequestDetails as $rad) {
                        $radiologiData[] = $rad->action->name;
                    }
                }
                $radiologi = implode(', ', $radiologiData);
            }
            // labor
            $labor = null;
            if ($item->laboratoriumRequests->isNotEmpty()) {
                $labData = [];
                foreach ($item->radiologiFormRequests as $reqLab) {                    
                    foreach ($reqLab->laboratoriumRequestDetails as $lab) {
                        $labData[] = $lab->action->name;
                    }
                }
                $labor = implode(', ', $labData);
            }

            // tindakan pelayanan medis
            $tindakan = null;
            if ($item->patientActionReport && $item->patientActionReport->patientActionReportDetails->isNotEmpty()) {
                $tindData = [];
                foreach ($item->patientActionReport->patientActionReportDetails as $tind) {
                    $tindData[] = $tind->action->name;
                }
                $tindakan = implode(', ', $tindData);
            }

            SatuSehatPatient::create([
                'queue_id' => $item->id,
                'no_rm' => $item->patient->no_rm,
                'nama_pasien' => $item->patient->name,
                'tgl_lhr' => $item->patient->tanggal_lhr,
                'nik' => $item->patient->nik,
                'tanggal_pelayanan' => $item->tgl_antrian,
                'kode_dpjp' => $item->dpjp->staff_id,
                'sip' => $item->dpjp->sip,
                'nama_dpjp' => $item->name,
                'poliklinik' => $item->dpjp->poliklinik->name,
                'anamnesa' => $item->doctorInitialAssesment->keluhan_utama,
                'kesadaran' => $item->doctorInitialAssesment->kesadaran,
                'tinggi_badan' => $item->doctorInitialAssesment->tb,
                'berat_badan' => $item->doctorInitialAssesment->bb,
                'nadi' => $item->doctorInitialAssesment->nadi,
                'tekanan_darah' => $item->doctorInitialAssesment->td_sistolik . ' / ' . $item->doctorInitialAssesment->td_diastolik,
                'suhu' => $item->doctorInitialAssesment->suhu,
                'nafas' => $item->doctorInitialAssesment->nafas,
                'kode_diagnosa_utama' => $item->diagnosticProcedurePatient->diagnostic->icd_x_code,
                'nama_diagnosa_utama' => $item->diagnosticProcedurePatient->diagnostic->name,
                'diagnosa_sekunder' => $diagnosaSekunder ?? null,
                'kode_prosedur' => $item->diagnosticProcedurePatient->procedure->icd_ix_code,
                'nama_prosedur' => $item->diagnosticProcedurePatient->procedure->name,
                'radiologi' => $radiologi ?? null,
                'laboratorium' => $labor ?? null,
                'tindakan' => $tindakan,
                'resep_obat' => $item->rajalFarmasiPatient->rajalFarmasiObatDetails,
                'intruksi_pulang' => $item->rawatJalanPoliPatient->intruksi,
                'keadaan_keluar' => $item->rawatJalanPoliPatient->keadaan_keluar,
                'cara_keluar' => $item->rawatJalanPoliPatient->cara_keluar,
            ]);

            if ($item->stts_satu_sehat == 'FINISHED') {
                DB::rollBack();
                return back()->with('error', 'Data Telah Dikirim');
            }
            $item->update([
                'stts_satu_sehat' => 'FINISHED',
            ]);
    
            DB::commit();
            return back()->with('success', 'Berhasil Mengirim Data');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        } catch (ModelNotFoundException $mn) {
            DB::rollBack();
            return back()->with('error', $mn->getMessage());
        }
    }
}
