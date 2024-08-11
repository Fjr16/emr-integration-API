<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use App\Models\RmeCppt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RawatJalanPoliPatient;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class RmeCpptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private function checkCpptVerif($rawatJalanPoliPatientId)
    {
        $item = RawatJalanPoliPatient::find($rawatJalanPoliPatientId);
        $anyVerif = RmeCppt::where('rawat_jalan_poli_patient_id', $rawatJalanPoliPatientId)
                ->where('ttd_dpjp', null)
                ->whereNot('user_id', $item->rawatJalanPatient->queue->doctorPatient->user->id)
                ->exists();

        return $anyVerif;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        DB::beginTransaction();
        try {

            $validatedData = $request->validate([
                'subjective' => 'required|string',
                'objective' => 'required|string',
                'asesmen' => 'required|string',
                'planning' => 'required|string',
            ], [
                'subjective.required' => 'Subjective Tidak Boleh Kosong',
                'subjective.string' => 'Subjective tidak valid, hanya menerima text atau string',
                'objective.required' => 'Objective Tidak Boleh Kosong',
                'objective.string' => 'Objective tidak valid, hanya menerima text atau string',
                'asesmen.required' => 'Asesmen Tidak Boleh Kosong',
                'asesmen.string' => 'Asesmen tidak valid, hanya menerima text atau string',
                'planning.required' => 'Planning Tidak Boleh Kosong',
                'planning.string' => 'Planning tidak valid, hanya menerima text atau string',
            ]);

            $item = Queue::findOrFail($id);
            $data['subjective'] = $validatedData['subjective'];
            $data['objective'] = $validatedData['objective'];
            $data['asesment'] = $validatedData['asesmen'];
            $data['planning'] = $validatedData['planning'];
            if (auth()->user()->id == $item->dpjp->id) {
                $data['ttd'] = $item->dpjp->paraf;
            }

            if ($item->soapDokter) {
                $soap = $item->soapDokter;
                $soap->update($data);
            }else{
                $data['queue_id'] = $item->id;
                $data['patient_id'] = $item->patient->id;
                $data['user_id'] = Auth::user()->id;
                RmeCppt::create($data);
            }
            
            
            DB::commit();
            return back()->with([
                'success' => 'Berhasil Diperbarui',
                'btn' => 'cppt',
            ]);
            
        } catch (ModelNotFoundException $mn) {
            DB::rollBack();
            return back()->with([
                'error' => $mn->getMessage(),
                'btn' => 'cppt',
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with([
                'error' => $e->getMessage(),
                'btn' => 'cppt',
            ]);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     $queue = Queue::find($id);
    //     $item = Patient::find($queue->patient->id);
    //     return view('pages.cppt.show', [
    //         'title' => 'CPPT',
    //         'menu' => 'Rawat Jalan',
    //         'queue' => $queue,
    //         'item' => $item,
    //     ]);
    // }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function print($id)
    // {
    //     $queue = Queue::find($id);
    //     $item = Patient::find($queue->patient->id);
    //     return view('pages.cppt.print', [
    //         'title' => 'CPPT',
    //         'menu' => 'Rawat Jalan',
    //         'item' => $item,
    //         'queue' => $queue,
    //     ]);
    // }

    // public function updateTtd(Request $request)
    // {
    //     try {
    //         $itemCppt = RmeCppt::findOrFail($request->cppt_id);
    //         $item = User::findOrFail($request->user_id);
    //         if (Hash::check($request->password, $item->password)) {
    //             $data[$request->ket_ttd] = $item->paraf;
    //             if ($request->ket_ttd == 'ttd_dpjp') {
    //                 $data['tanggal_dpjp'] = date('Y-m-d H:i:s');
    //                 $data['id_dpjp'] = $item->id;
    //                 $data['tanggal'] = date('Y-m-d H:i:s');
    //             }
    //             $itemCppt->update($data);
    //             $anyVerif = $this->checkCpptVerif($itemCppt->rawat_jalan_poli_patient_id);
    //             if (!$anyVerif) {
    //                 return response()->json(['redirect' => '/rajal/cppt/create/' . $itemCppt->rawatJalanPoliPatient->rawatJalanPatient->queue->id]);
    //             }
    //         } else {
    //             throw new Exception("Terjadi Kesalahan, Mohon Periksa Kembali Password Yang Anda Masukkan", 500);
    //         }
    //     } catch (ModelNotFoundException $e) {
    //         return response()->json(['error' => 'Terjadi Kesalahan, User Tidak Ditemukan'], 404);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => $e->getMessage()], 403);
    //     }
    // }
}
