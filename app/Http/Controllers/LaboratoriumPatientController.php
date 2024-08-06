<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaboratoriumRequest;
use App\Models\LaboratoriumRequestDetail;
use DateTime;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class LaboratoriumPatientController extends Controller
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
        $data = LaboratoriumRequest::whereDate('created_at', $filter)->get();
        return view('pages.pasienLaboratoriumList.index', [
            "title" => "Laboratorium PK",
            "menu" => "Laboratorium PK",
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $today = new DateTime(date('Y-m-d H:i:s'));
        $item = LaboratoriumRequest::find(decrypt($id));
        return view('pages.pasienLaboratorium.create', [
            "title" => "Antrian Laboratorium PK",
            "menu" => "Laboratorium PK",
            'item' => $item,
            'today' => $today,
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
        DB::beginTransaction();
        try {
            $this->validate($request, [
                'detail_id' => 'required|array',
                'detail_id.*' => 'required|integer|exists:laboratorium_request_details,id',
                'hasil' => 'required|array',
                'hasil.*' => 'required|numeric|min:0',
                'satuan' => 'required|array',
                'satuan.*' => 'required|string',
                'kritis' => 'required|array',
                'kritis.*' => 'required|boolean',
            ], [
                'detail_id.required' => 'Indikator pemeriksaan Tidak Ditemukan',
                'detail_id.array' => 'Terjadi Kesalahan, Indikator pemeriksaan Tidak Valid',
                'detail_id.*.required' => 'Indikator pemeriksaan Tidak ditemukan',
                'detail_id.*.exists' => 'Indikator pemeriksaan Tidak ditemukan pada Database',
                'hasil.required' => 'Hasil pemeriksan Tidak Boleh Kosong',
                'hasil.array' => 'Hasil Pemeriksaan Tidak valid',
                'hasil.*.required' => 'Hasil Pemeriksaan dengan ID {X} Tidak Boleh Kosong',
                'hasil.*.numeric' => 'Hasil Pemeriksaan dengan ID {X} tidak Valid, harus berupa bilangan bulat atau berkoma',
                'hasil.*.min' => 'Hasil Pemeriksaan dengan ID {X} tidak Valid, tidak boleh kecil dari 0',
                'satuan.required' => 'Satuan Tidak Boleh Kosong',
                'satuan.array' => 'Satuan Tidak valid',
                'satuan.*.required' => 'Satuan dengan ID {X} Tidak boleh Kosong',
                'satuan.*.string' => 'Satuan dengan ID {X} Harus berupa string',
                'kritis.required' => 'Pilih Kondisi Kritis Ya Atau Tidak ',
                'kritis.array' => 'Kondisi Kritis Tidak valid, harus berupa array',
                'kritis.*.required' => 'kondisi kritis dengan ID {X} Tidak Boleh Kosong',
                'kritis.*.boolean' => 'Pilih ya atau tidak untuk kondisi kritis dengan ID {X}',
            ]); 

            // update request detail
            $detail_ids = $request->input('detail_id');
            $hasilArr = $request->input('hasil', []);
            $satuanArr = $request->input('satuan', []);
            $kritisArr = $request->input('kritis', []);
            foreach ($detail_ids as $key => $detail_id) {
                LaboratoriumRequestDetail::findOrFail($detail_id)->update([
                    'hasil' => $hasilArr[$key],
                    'satuan' => $satuanArr[$key],
                    'kritis' => $kritisArr[$key],
                ]);
            }
            // update data labor request
            $item = LaboratoriumRequest::find($id);
            $item->update([
                'petugas_id' => auth()->user()->id,
                'kesan_anjuran' => $request->input('kesan_anjuran'),
                'status' => 'UNVALIDATE',
                'tanggal_periksa_selesai' => $request->input('tanggal_periksa', date('Y-m-d')),
            ]);

            DB::commit();
            return redirect()->route('laboratorium/patient/queue.index')->with('success', 'Berhasil Membuat Hasil Pemeriksaan');

        } catch (ValidationException $mn) {
            DB::rollBack();
            return back()->with('error', $mn->getMessage())->withInput();
        } catch (Exception $e){
            DB::rollBack();
            return back()->with('error', $e->getMessage())->withInput();
        } catch (ModelNotFoundException $mnf){
            DB::rollBack();
            return back()->with('error', $mnf->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = LaboratoriumRequest::find(decrypt($id));
        return view('pages.surat.hasilpemeriksaanlabor', [
            "title" => "Laboratorium PK",
            "menu" => "Laboratorium PK",
            'item' => $item,
        ]);
    }
}
