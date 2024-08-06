<?php

namespace App\Http\Controllers;

use App\Models\BillingOfMedicineFee;
use DateTime;
use App\Models\Unit;
use App\Models\Medicine;
use App\Models\KasirPatient;
use App\Models\MedicineStok;
use App\Models\UnitCategory;
use Illuminate\Http\Request;
use App\Models\PatientCategory;
use App\Models\RawatJalanPatient;
use App\Models\DetailKasirPatient;
use App\Models\LaboratoriumRequest;
use App\Models\PatientActionReport;
use App\Models\RajalFarmasiPatient;
use App\Models\RadiologiFormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\RajalFarmasiObatDetail;
use App\Models\PatientActionReportDetail;
use App\Models\Queue;
use App\Models\RawatJalanPoliPatient;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class RawatJalanFarmasiController extends Controller
{
    /**
     * 
     */
    public function index()
    {
        if (request('filter')) {
            $filter = new DateTime(request('filter'));
        }
        $filterDate = $filter ?? now();
        $data = RajalFarmasiPatient::whereDate('created_at', $filterDate)->latest()->get();
        return view('pages.pasienfarmasi.index', [
            "title" => "Farmasi",
            "menu" => "In Patient",
            'data' => $data,
        ]);
    }

    /**
     * DONE
     */
    public function create($id)
    {
        $unitIdSelected = encrypt(auth()->user()->unit->id ?? '');
        if (request('unit_id')) {
            $unitIdSelected = request('unit_id');
            $unitIdSelected = encrypt($unitIdSelected);
        }
        $item = RajalFarmasiPatient::find(decrypt($id));
        // dd($item->queue->medicineReceipt->medicineReceiptDetails);
        $tanggungans = PatientCategory::all();
        
        $units = Unit::all();
        $medicines = Medicine::all();
        $medicineStokAll = MedicineStok::where('unit_id', decrypt($unitIdSelected))->get();

        return view('pages.pasienfarmasi.create', [
            "title" => "Farmasi",
            "menu" => "In Patient",
            'item' => $item,
            'medicines' => $medicines,
            'medicineStokAll' => $medicineStokAll,
            'tanggungans' => $tanggungans,
            'units' => $units,
            'unitIdSelected' => $unitIdSelected,
        ]);
    }


    private function sumHargaSatuanObat($patientCategory, $medicine){
        $margin = 0; $pajak = 0; $disc = 0;
        if ($patientCategory->include_margin_obt) {
            $margin = ($medicine->base_harga * ($patientCategory->margin/100));
        }
        if ($patientCategory->include_disc_obt) {
            $disc = $medicine->disc;
        }
        if ($patientCategory->include_pajak_obt) {
            $pajak = $medicine->pajak;
        }
        return $hargaJual = $medicine->base_harga + $margin + $pajak - $disc;
    }

    /**
     * DONE
     */
    private function generateReceiptNumber($current_no)
    {
        //format AMP-24-06-27/01
        $initial = 'RCP';
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

    /**
     * DONE
     */
    public function store(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'medicine_id' => 'required|array',
                'medicine_id.*' => 'required|integer|exists:medicines,id',
                'medicine_stok_id' => 'required|array',
                'medicine_stok_id.*' => 'required|integer|exists:medicine_stoks,id',
                'unit_id' => 'required|integer|exists:units,id',
                'aturan_pakai' => 'required|array',
                'aturan_pakai*' => 'required',
                'jumlah' => 'required|array',
                'jumlah.*' => 'required|integer',
            ], [
                'medicine_id.required' => 'Nama Obat Tidak Boleh Kosong',
                'medicine_id.*.required' => 'Tidak Boleh satu pun Nama Obat Yang Kosong',
                'medicine_id.*.integer' => 'Nama Obat Tidak valid',
                'medicine_id.*.exists' => 'Nama Obat dengan ID {1} Tidak Ditemukan, mohon pilih dengan benar',
                'medicine_stok_id.required' => 'Mohon Pilih Stok Obat',
                'medicine_stok_id.array' => 'Mohon Pilih Stok Obat',
                'medicine_stok_id.*.required' => 'Pastikan Semua Stok Obat Sudah Dipilih',
                'medicine_stok_id.*.integer' => 'Terdapat Stok Obat Yang Tidak Valid',
                'medicine_stok_id.*.exists' => 'Stok Obat dengan ID {1} Tidak Ditemukan',
                'unit_id.required' => 'Unit Asal Obat Tidak Boleh Kosong',
                'unit_id.integer' => 'Unit Asal Obat Tidak Valid',
                'unit_id.exists' => 'Unit Asal Obat Tidak Ditemukan',
                'aturan_pakai.required' => 'Aturan Pakai Obat Tidak Boleh Kosong',
                'aturan_pakai.array' => 'Aturan Pakai Obat Tidak Boleh Kosong',
                'aturan_pakai.*.required' => 'Pastikan Semua Aturan Pakai Obat Telah Diisi',
                'jumlah.required' => 'Jumlah Obat Yang Diserahkan Tidak Boleh Kosong',
                'jumlah.array' => 'Jumlah Obat Yang Diserahkan Tidak Boleh Kosong',
                'jumlah.*.required' => 'Pastikan Semua Jumlah Obat Yang Diserahkan Telah Diisi',
                'jumlah.*.integer' => 'Terdapat Jumlah Penyerahan Obat Yang Tidak Valid',
            ]);
        } catch (ValidationException $th) {
            return back()->with('error', $th->getMessage());
        }

        DB::beginTransaction();
        $errors = [];
        try {
            $item = RajalFarmasiPatient::findOrFail(decrypt($id));
            $unit = Unit::findOrFail($request->unit_id) ?? '';

            // create rajal farmasi obat detail untuk obat yang tersedia
            $grandTotal = 0;
            foreach ($request['medicine_id'] as $index => $medicine_id) {
                $medicine = Medicine::findOrFail($medicine_id);
                $medicineStok = MedicineStok::findOrFail($request->medicine_stok_id[$index]);
                // membandingkan semua stok obat pada unit yang dipilih dengan permintaan obat
                $jmlSerah = $request->jumlah[$index];
                if ($medicineStok->stok < $jmlSerah) {
                    $errors[] = 'Stok Obat ' . ($medicine->name ?? '...') . ' Tidak Mencukupi, Hanya Tersedia ' .$medicineStok->stok ?? 0;
                    continue;
                }

                //get darta harga obat plus margin, pajak dan diskon berdasarkan penjamin pasien
                $patientCategory = $item->queue->patientCategory;                
                if ($request->ditanggung_asuransi[$index] == false) {
                    $patientCategory = PatientCategory::where('name', 'Umum')->firstOrFail();
                }
                $hargaPenjualanObat = $this->sumHargaSatuanObat($patientCategory, $medicine);
                $subTotal = ($jmlSerah * ($hargaPenjualanObat ?? 0));
    
                $itemDetail = RajalFarmasiObatDetail::create([
                    'rajal_farmasi_patient_id' => $item->id ?? null,
                    'medicine_id' => $medicine->id ?? null,
                    'medicine_stok_id' => $medicineStok->id ?? null,
                    'unit_id' => $unit->id ?? null,
                    'nama_obat' => $medicine->name ?? null,
                    'aturan_pakai' => $request->aturan_pakai[$index],
                    'jumlah' => $jmlSerah,
                    'satuan_obat' => $medicine->small_unit ?? null,
                    'harga_satuan' => $hargaPenjualanObat ?? 0,
                    'sub_total' => $subTotal,
                    'ditanggung_asuransi' => $request->ditanggung_asuransi[$index],
                ]);

                // membuat billing untuk obat pada kasir
                BillingOfMedicineFee::create([
                    'kasir_patient_id' => $item->queue->kasirPatient->id,
                    'rajal_farmasi_obat_detail_id' => $itemDetail->id,
                    'kode_obat' => $medicine->kode,
                    'nama_obat' => $medicine->name,
                    'satuan_obat' => $itemDetail->satuan_obat,
                    'jumlah' => $itemDetail->jumlah,
                    'tarif' => $itemDetail->harga_satuan,
                    'sub_total' => $itemDetail->sub_total,
                    'ditanggung_asuransi' => $itemDetail->ditanggung_asuransi,
                ]);

                // hitung total akhir untuk obat
                $grandTotal += $itemDetail->sub_total ?? 0;
            }

            // create Rajal farmasi obat detail untuk obat yang tidak ada di rs
            $dataCostumNama = $request->input('nama_obat_custom', []);
            $dataCostumAturan = $request->input('aturan_pakai_custom', []);
            $dataCostumJumlah = $request->input('jumlah_custom', []);
            $dataCostumSatuan = $request->input('satuan_obat_custom', []);
            foreach ($dataCostumNama as $key => $namaObat) {
                if (!$namaObat || !$dataCostumAturan[$key]) {
                    $errors[] = 'Nama dan aturan pakai obat yang akan dibeli di luar tidak boleh kosong';
                    continue;
                }
                RajalFarmasiObatDetail::create([
                    'rajal_farmasi_patient_id' => $item->id,
                    'medicine_id' => null,
                    'medicine_stok_id' => null,
                    'unit_id' => null,
                    'nama_obat' => $dataCostumNama[$key],
                    'aturan_pakai' => $dataCostumAturan[$key],
                    'jumlah' => $dataCostumJumlah[$key] ?? 0,
                    'satuan_obat' => $dataCostumSatuan[$key] ?? '',
                    'harga_satuan' => 0,
                    'sub_total' => 0,
                ]);
            }

            if (!empty($errors)) {
                DB::rollBack();
                return back()->with('errors', $errors);
            }
            DB::commit();
    
            //generate no Resep
            $lastReceiptNumber = RajalFarmasiPatient::WhereDate('created_at', date('Y-m-d'))->orderBy('no_resep', 'desc')->pluck('no_resep')->first();
            if ($lastReceiptNumber) {
                $arrSplit = explode('/', $lastReceiptNumber);
                $lastReceiptNumber = $arrSplit[1];
            }
            $nextReceiptNumber = $this->generateReceiptNumber($lastReceiptNumber ?? 0);
            // update farmasi patient atau tabel utama resep
            $item->update([
                'user_id' => Auth::user()->id,
                'patient_id' => $item->queue->patient->id ?? null,
                'status' => 'ONGOING',
                'no_resep' => $nextReceiptNumber,
                'grand_total' => $grandTotal,
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return back()->with('error', 'Data Tidak Ditemukan: ' . $e->getMessage());
        }

        return redirect()->route('rajal/farmasi/index')->with('success', 'Berhasil Dikonfirmasi');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $item = RajalFarmasiPatient::find($id);
        return view('pages.pasienfarmasi.show', [
            "title" => "Farmasi",
            "menu" => "In Patient",
            'item' => $item,
        ]);
    }
    public function printKwitansi($id)
    {
        $item = RajalFarmasiPatient::find($id);
        return view('pages.surat.kwitansifarmasi', [
            "title" => "Farmasi",
            "menu" => "In Patient",
            'item' => $item,
        ]);
    }
    public function printCopyResep($id)
    {
        $item = RajalFarmasiPatient::find($id);
        return view('pages.surat.kwitansifarmasi', [
            "title" => "Farmasi",
            "menu" => "In Patient",
            'item' => $item,
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
        $item = RajalFarmasiPatient::find($id);

        $tanggungans = PatientCategory::all();

        $dataObat = Medicine::all();

        return view('pages.pasienfarmasi.edit', [
            "title" => "Farmasi",
            "menu" => "In Patient",
            'item' => $item,
            'dataObat' => $dataObat,
            'tanggungans' => $tanggungans,
        ]);
    }

    public function serahkanObat($id)
    {
        $item = RajalFarmasiPatient::find(decrypt($id));
        return view('pages.pasienfarmasi.penyerahan', [
            "title" => "Farmasi",
            "menu" => "In Patient",
            'item' => $item,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * Perlu perbaikan
     */
    public function update(Request $request, $id)
    {
        $itemInvoice = RajalFarmasiPatient::find($id);

        $grandTotal = 0;
        $unit_id = $request->input('unit_id');
        foreach ($request->detail_id as $index => $detail_id) {
            $jumlah = $request->input('jumlah')[$index];
            $medicine = Medicine::find($request->input('medicine_id')[$index]);
            $stokAll = MedicineStok::where('medicine_id', $medicine->id)->where('unit_id', $unit_id)->sum('stok');
            if (!$stokAll || $stokAll < $jumlah) {
                return back()->with('error', 'Maaf Stok Obat ' . $medicine->name . ' Tidak Mencukupi');
            }

            $dataMedicineStoks = MedicineStok::where('medicine_id', $request->input('medicine_id')[$index])->where('unit_id', $unit_id)->where('stok', '>', 0)->orderBy('exp_date', 'asc')->get();

            $stopIteration = false;
            foreach ($dataMedicineStoks as $medicineStok) {
                if ($stopIteration) {
                    break;
                }

                $tanggunganCat = $request->input('patient_category_id')[$index];
                if ($medicineStok->stok >= $jumlah) {
                    $dataDetail = [
                        'unit_id' => $unit_id,
                        'patient_category_id' => $tanggunganCat,
                        'medicine_id' => $medicine->id,
                        'medicine_stok_id' => $medicineStok->id,
                        'harga_satuan' => $request->input('harga')[$index],
                        'jumlah' => $jumlah,
                        'total_harga' => $request->input('total_harga')[$index],
                    ];
                    $itemDetail = RajalFarmasiObatDetail::find($detail_id);
                    $itemDetail->update($dataDetail);
                    $stopIteration = true;
                } else {
                    $jumlah = $request->input('jumlah')[$index] - $medicineStok->stok;

                    $dataDetail = [
                        'rajal_farmasi_patient_id' => $itemInvoice->id,
                        'unit_id' => $unit_id,
                        'patient_category_id' => $tanggunganCat,
                        'medicine_id' => $medicine->id,
                        'medicine_stok_id' => $medicineStok->id,
                        'harga_satuan' => $request->input('harga')[$index],
                        'jumlah' => $medicineStok->stok,
                        'total_harga' => $request->input('total_harga')[$index],
                    ];
                    $itemDetail = RajalFarmasiObatDetail::create($dataDetail);
                }

                $grandTotal += $itemDetail->total_harga;
            }
        }
        $itemInvoice->update([
            'grand_total' => $grandTotal
        ]);

        return redirect()->route('rajal/farmasi/create', $itemInvoice->rajalFarmasiPatient->id)->with('success', 'Berhasil Diperbarui');
    }


    // pengurangan stok Obat
    private function sinkronisasiStok($itemFarmasi) {
        DB::beginTransaction();
        $errors = [];
        try {
            foreach ($itemFarmasi->rajalFarmasiObatDetails->whereNotNull('medicine_id') as $detail) {
                $medicineStok = MedicineStok::findOrFail($detail->medicine_stok_id);
                if ($medicineStok->stok < $detail->jumlah) {
                    $errors[] = 'Stok Obat ' . ($detail->medicine->name ?? '') . ' Tidak Mencukupi';
                    continue;
                }
    
                $newStok = $medicineStok->stok - $detail->jumlah;
                $medicineStok->update([
                    'stok' => $newStok,
                ]);
            }

            if (!empty($errors)) {
                DB::rollBack();
                return response()->json([
                    'messages' => $errors,
                    'code' => 501,
                ], 501);
            }

            DB::commit();
            return response()->json([
                'message' => 'success',
                'code' => 200,
            ], 200);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage(),
                'code' => 500,
            ], 500);
        } catch (ModelNotFoundException $mn){
            DB::rollBack();
            return response()->json([
                'message' => $mn->getMessage(),
                'code' => 500,
            ], 500);
        }
    }

    public function updateStatus(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $this->validate($request, [
                'status' => 'required|in:DENIED,FINISHED',
            ],[
                'status.required' => 'Terjadi Kesalahan, Tidak ada status yang dikirimkan',
                'status.in' => 'Terjadi Kesalahan, Status Tidak Diketahui',
            ]);

            $item = RajalFarmasiPatient::findOrFail(decrypt($id));
            $item->update([
                'status' => $request->status,
            ]);
            if ($request->status == 'DENIED') {
                $poli = RawatJalanPoliPatient::where('queue_id', $item->queue->id)->firstOrFail();
                $poli->update([
                    'receipts_ready' => false,
                ]);
            }

            if ($item->status == 'FINISHED') {
                $res = $this->sinkronisasiStok($item);
                if ($res->getStatusCode() === 501 ) {
                    DB::rollBack();
                    $errors = $res->getOriginalContent()['messages'];
                    return back()->with('exceptions', $errors);
                }elseif($res->getStatusCode() === 500){
                    DB::rollBack();
                    return back()->with('error', $res->getOriginalContent()['messages']);
                }
            }

            DB::commit();
            return redirect()->route('rajal/farmasi/index')->with('success', 'Status Berhasil Diperbarui');

        } catch (ValidationException $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        } catch (Exception $e){
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        } catch (ModelNotFoundException $m){
            DB::rollBack();
            return back()->with('error', 'Data Tidak Ditemukan: ' . $m->getMessage());
        }
    }   
}
