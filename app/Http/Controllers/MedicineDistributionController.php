<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Medicine;
use Illuminate\Support\Str;
use App\Models\MedicineStok;
use Illuminate\Http\Request;
use App\Models\MedicineDistribution;
use App\Models\MedicineDistributionDetail;
use Illuminate\Support\Facades\Auth;
use App\Models\MedicineDistributionRequest;
use App\Models\MedicineDistributionResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class MedicineDistributionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = MedicineDistribution::latest()->get();
        // untuk tambah amprahan
        $units = Unit::all();
        $unitAsal = Unit::find(auth()->user()->unit->id ?? '');
        $medicines = Medicine::all();
        $medicineStokAll = MedicineStok::all();
        return view('pages.distribusiObat.index', [
            'title' => 'Amprahan',
            'menu' => 'Farmasi',
            'data' => $data,
            'units' => $units,
            'unitAsal' => $unitAsal,
            'medicines' => $medicines,
            'medicineStokAll' => $medicineStokAll,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    private function generateAmprahanNumber($current_no)
    {
        //format AMP-24-06-27/01
        $initial = 'AMP';
        $currentDate = date('Y-m-d');

        $no = 1;
        if ($current_no) {
            $no = $current_no + 1;
        }

        if (strlen($no) == 1) {
            $number = '0' . $no;
        }else{
            $number = $no;
        }

        $nextNumber = $initial . '-' . $currentDate . '/' . $number;
        return $nextNumber;
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'unit_asal_id' => 'required|integer|exists:units,id',
                'unit_tujuan_id' => 'required|integer|exists:units,id',
                'medicine_id' => 'required|array',
                'medicine_id.*' => 'required|integer|exists:medicines,id',
                'medicine_stok_id' => 'required|array',
                'medicine_stok_id.*' => 'required|integer|exists:medicine_stoks,id',
                'jumlah' => 'required|array',
                'jumlah.*' => 'required',
            ], [
                'unit_asal_id.required' => 'Unit Asal Tidak Boleh Kosong',
                'unit_tujuan_id.required' => 'Unit Tujuan Tidak Boleh Kosong',
                'medicine_id.required' => 'Nama Obat Tidak Boleh Kosong',
                'medicine_id.*.required' => 'Tidak Boleh satu pun Nama Obat Yang Kosong',
                'medicine_id.*.integer' => 'Nama Obat Tidak valid',
                'medicine_id.*.exists' => 'Nama Obat dengan ID {1} Tidak Ditemukan, mohon pilih dengan benar',
                'medicine_stok_id.required' => 'Stok Obat Belum Dipilih',
                'medicine_stok_id.array' => 'Stok Obat Belum Dipilih',
                'medicine_stok_id.*.required' => 'Pastikan Semua Stok Obat Sudah Dipilih',
                'medicine_stok_id.*.integer' => 'Terdapat Stok Obat Yang Tidak Valid',
                'medicine_stok_id.*.exists' => 'Stok Obat dengan ID {1} Tidak Ditemukan',
                'jumlah.required' => 'Jumlah Pengiriman Tidak Boleh Kosong',
                'jumlah.array' => 'Jumlah Pengiriman Tidak Boleh Kosong',
                'jumlah.*.required' => 'Jumlah Pengiriman dengan ID {1} Tidak Boleh Kosong',
            ]);
        } catch (ValidationException $th) {
            return back()->with('error', $th->getMessage())->withInput();
        }

        $medicineIds = $request->input('medicine_id', []);
        $medicineStokIds = $request->input('medicine_stok_id', []);
        $jumlahs = $request->input('jumlah', []);

        //check stok
        DB::beginTransaction();
        try {
            $errors = [];
            foreach ($medicineStokIds as $key => $medicineStokId) {
                $medicine = Medicine::find($medicineIds[$key]);
                $medicineStokAsal = MedicineStok::find($medicineStokId);
                
                $stok = $medicineStokAsal->stok;
                if($stok < $jumlahs[$key]){
                    $errors[] = 'Stok '. ($medicineStokAsal->medicine->name ?? '...') .' Tidak Mencukupi';
                    continue;
                }
                $stokResponse = $stok - $jumlahs[$key];
                $medicineStokAsal->update([
                    'stok' => $stokResponse
                ]);
            }
            if (!empty($errors)) {
                DB::rollBack();
                return back()->with('errors', $errors);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('errors', $e->getMessage());
        }

        //generate AMP number
        $lastAmprahanNumber = MedicineDistribution::whereDate('created_at', date('Y-m-d'))->orderBy('no_distribusi', 'desc')->pluck('no_distribusi')->first();
        if ($lastAmprahanNumber) {
            $arrSplit = explode('/', $lastAmprahanNumber);
            $lastAmprahanNumber = $arrSplit[1];
        }
        $nextAmprahanNumber = $this->generateAmprahanNumber($lastAmprahanNumber ?? 0);

        // store Data amprahan
        $item = MedicineDistribution::create([
            'user_id' => Auth::user()->id,
            'unit_asal_id' => $request->unit_asal_id,
            'unit_tujuan_id' => $request->unit_tujuan_id,
            'no_distribusi' => $nextAmprahanNumber ?? '',
            'status' => 'SUCCESS',
        ]);
        //dataDetail
        foreach ($medicineStokIds as $index => $medicineStokId) {
            $medicine = Medicine::find($medicineIds[$index]);
            $detail = MedicineDistributionDetail::create([
                'medicine_distribution_id' => $item->id,
                'medicine_id' => $medicineIds[$index],
                'medicine_stok_id' => $medicineStokId,
                'satuan' => $medicine->small_unit,
                'jumlah' => $jumlahs[$index],
            ]);

            //update or create stok tujuan
            $medicineStokTujuan = MedicineStok::where('unit_id', $item->unit_tujuan_id)->where('medicine_id', $detail->medicine_id)->where('no_batch', $detail->medicineStok->no_batch)->first();
            if($medicineStokTujuan){
                $stok = $medicineStokTujuan->stok;
                $stokRequest = $stok+$detail->jumlah;
                $medicineStokTujuan->update([
                    'stok' => $stokRequest
                ]);
            }else{
                MedicineStok::create([
                    'unit_id' => $item->unit_tujuan_id,
                    'medicine_id' => $medicine->id,
                    'stok' => $detail->jumlah,
                    'base_harga' => $detail->medicineStok->base_harga ?? null,
                    'diskon_satuan' => $detail->medicineStok->diskon_satuan ?? null,
                    'pajak_satuan' => $detail->medicineStok->pajak_satuan ?? null,
                    'no_batch' => $detail->medicineStok->no_batch ?? null,
                    'production_date' => $detail->medicineStok->production_date ?? null,
                    'exp_date' => $detail->medicineStok->exp_date ?? null,
                    'satuan' => $detail->medicineStok->satuan ?? null,
                ]);
            }
        }

        return back()->with('success', 'Amprahan Berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $unit = Unit::find($id);
        $data = MedicineDistribution::where('status', 'SELESAI')->where('unit_tujuan_id', $id)->get();
        return view('pages.distribusiObat.show', [
            'title' => 'Amprahan',
            'menu' => 'Farmasi',
            'unit' => $unit,
            'data' => $data,
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
        $distribusi = MedicineDistribution::find($id);
        $res = MedicineDistributionResponse::find($distribusi->medicine_distribution_response_id);
        $req = MedicineDistributionRequest::find($res->medicine_distribution_request_id);

        $stokReq = MedicineStok::where('unit_category_id', $req->unit_category_id)->first();
        $stokRes = MedicineStok::where('unit_category_id', $res->unit_category_id)->first();
        if($stokReq){
            $newStokReq = $stokReq->stok - $req->jumlah;
            $stokReq->update([
                'stok' => $newStokReq,
            ]);
        } if($stokRes){
            $newStokRes = $stokRes->stok + $req->jumlah;
            $stokRes->update([
                'stok' => $newStokRes,
            ]);
        }

        
        $distribusi->delete();
        $res->delete();
        $req->delete();
        
        return back()->with('success', 'Berhasil Dihapus');
    }
}
