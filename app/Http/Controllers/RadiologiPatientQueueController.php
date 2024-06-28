<?php

namespace App\Http\Controllers;

use App\Models\DetailKasirPatient;
use App\Models\KasirPatient;
use App\Models\RadiologiFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $status = $request->input('status');
        if ($status != 'ACCEPTED') {
            $item->update([
                'status' => $status,
            ]);
        }else{
            $tanggal = $request->input('tanggal');
    
            $lastRegRad = RadiologiFormRequest::whereDate('jadwal_periksa', $tanggal)->orderBy('no_reg_rad', 'desc')->pluck('no_reg_rad')->first();
            if ($lastRegRad) {
                $arrSplit = explode('/', $lastRegRad);
                $lastRegRad = $arrSplit[4];
            }
            $nextRegRad = $this->createRegRad($lastRegRad ?? 0);
            $item->update([
                'no_reg_rad' => $nextRegRad,
                'jadwal_periksa' => $tanggal,
                'status' => 'ACCEPTED',
            ]);
        }


        // $patientCategoryId = $item->queue->patientCategory->id ?? '';
        // if($patientCategoryId){
        //     $kasirPatient = KasirPatient::where('rawat_jalan_patient_id', $item->queue->rawatJalanPatient->id)->first();
        //     if($kasirPatient){
        //         $total = $kasirPatient->total;
        //         foreach ($item->radiologiPatientRequestDetails as $detail) {
        //             $tarif = RadiologiFormRequestMasterRate::where('radiologi_form_request_master_id', $detail->radiologiFormRequestDetail->radiologiFormRequestMaster->id)->where('patient_category_id', $patientCategoryId)->first();
        //             DetailKasirPatient::create([
        //                 'kasir_patient_id' => $kasirPatient->id,
        //                 'name' => $detail->radiologiFormRequestDetail->radiologiFormRequestMaster->name,
        //                 'tanggal' => date('Y-m-d H:i:s'),
        //                 'category' => 'Pemeriksaan Radiologi',
        //                 'jumlah' => 1,
        //                 'tarif' => $tarif->tarif_umum ?? 0,
        //             ]);
        //             $total += $tarif->tarif_umum ?? 0;
        //         }
        //         $kasirPatient->update([
        //             'total' => $total,
        //         ]);
        //     }else{
        //         $total = 0;
        //         $itemKasirPatient =  KasirPatient::create([
        //             'rawat_jalan_patient_id' => $item->queue->rawatJalanPatient->id,
        //             'total' => $total,
        //             'status' => 'PENDING',
        //         ]);
        //         foreach ($item->radiologiPatientRequestDetails as $detail) {
        //             $tarif = RadiologiFormRequestMasterRate::where('radiologi_form_request_master_id', $detail->radiologiFormRequestDetail->radiologiFormRequestMaster->id)->where('patient_category_id', $patientCategoryId)->first();
        //             DetailKasirPatient::create([
        //                 'kasir_patient_id' => $itemKasirPatient->id,
        //                 'name' => $detail->radiologiFormRequestDetail->radiologiFormRequestMaster->name,
        //                 'tanggal' => date('Y-m-d H:i:s'),
        //                 'category' => 'Pemeriksaan Radiologi',
        //                 'jumlah' => 1,
        //                 'tarif' => $tarif->tarif_umum ?? 0,
        //             ]);
        //             $total += $tarif->tarif_umum ?? 0; 
        //         }
        //         $itemKasirPatient->update([
        //             'total' => $total,
        //         ]);
        //     }
        // }

        return back()->with('success', 'Berhasil Memperbarui Antrian');
    }
}
