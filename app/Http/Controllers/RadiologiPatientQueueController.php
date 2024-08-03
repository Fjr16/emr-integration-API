<?php

namespace App\Http\Controllers;

use App\Models\BillingRadiology;
use App\Models\RadiologiFormRequest;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RadiologiPatientQueueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = date('Y-m-d');
        $filter = request('filter', $today);
        $data = RadiologiFormRequest::whereDate('jadwal_periksa', $filter)->get();
        return view('pages.pasienRadiologiList.index', [
            "title" => "Antrian Radiologi",
            "menu" => "Radiologi",
            'data' => $data,
            'filter' => $filter,
            'today' => $today,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    private function createRegRad($current_no)
    {
        //format RAD/24/06/27/01
        $initial = 'RAD';
        $currentDate = date('Y/m/d');

        $no = 1;
        if ($current_no) {
            $no = $current_no + 1;
        }

        if (strlen($no) == 1) {
            $number = '0' . $no;
        }else{
            $number = $no;
        }

        $nextNumber = $initial . '/' . $currentDate . '/' . $number;
        return $nextNumber;
    }

    public function store(Request $request, $id)
    {
        $item = RadiologiFormRequest::find($id);
        $status = $request->status;
        
        if ($item->status == 'ACCEPTED') {
            $item->update([
                'status' => $status,
            ]);
        }elseif($item->status == 'WAITING'){
            $tanggal = $request->input('tanggal');
    
            $lastRegRad = RadiologiFormRequest::whereDate('jadwal_periksa', $tanggal)->orderBy('no_reg_rad', 'desc')->pluck('no_reg_rad')->first();
            if ($lastRegRad) {
                $arrSplit = explode('/', $lastRegRad);
                $lastRegRad = $arrSplit[4];
            }
            $nextRegRad = $this->createRegRad($lastRegRad ?? 0);

            DB::beginTransaction();
            $errors = [];
            try {
                $item->update([
                    'no_reg_rad' => $nextRegRad,
                    'jadwal_periksa' => $tanggal,
                    'status' => 'ACCEPTED',
                ]);

                foreach ($item->radiologiFormRequestDetails as $key => $detailTindakan) {
    
                    if (!$detailTindakan->action || !$detailTindakan->action->action_code || !$detailTindakan->action->name) {
                        $errors[] = 'Tindakan Yang Dipilih Pada Detail Permintaan Radiologi ID {X} Tidak Valid Mohon periksa Kembali Master Data Tindakan';
                        continue;
                    }
                    $actRate = $detailTindakan->action->actionRates->where('patient_category_id', $item->queue->patientCategory->id)->first();
                    if (!$actRate || $actRate->tarif <= 0) {
                        $errors[] = 'Harga Satuan Tindakan '. $detailTindakan->action->name .' Tidak Valid, mohon periksa data tindakan pasien';
                        continue;
                    }
                    
                    BillingRadiology::create([
                        'kasir_patient_id' => $item->queue->kasirPatient->id,
                        'action_id' => $detailTindakan->action->id ?? null,
                        'patient_category_id' => $item->queue->patientCategory->id ?? null,
                        'kode_tindakan' => $detailTindakan->action->action_code,
                        'nama_tindakan' => $detailTindakan->action->name,
                        'jumlah' => 1,
                        'tarif' => $actRate->tarif,
                        'sub_total' => $actRate->tarif,
                    ]);
                }
                if (!empty($errors)) {
                    DB::rollBack();
                    return back()->with('errors', $errors);
                }

                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                return back()->with('error', $e->getMessage());
            } catch (ModelNotFoundException $mn){
                DB::rollBack();
                return back()->with('error', $mn->getMessage());
            }
        }else{
            return back()->with('error', 'Terjadi Kesalahan, Tidak Dapat Membuat Jadwal');
        }
        return back()->with('success', 'Berhasil Memperbarui Antrian');
    }
}
