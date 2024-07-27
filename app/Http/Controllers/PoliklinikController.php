<?php

namespace App\Http\Controllers;

use App\Http\Requests\PoliklinikStoreRequest;
use App\Http\Requests\PoliklinikUpdateRequest;
use App\Models\DoctorPoli;
use App\Models\DoctorsSchedule;
use App\Models\Poliklinik;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class PoliklinikController extends Controller
{
    public function index()
    {
        if (session()->has('navPoli')) {
            session(['navPoli' => session('navPoli')]);
        }else{
            session(['navPoli' => 'poliklinik']);
        }

        $data = Poliklinik::where('isActive', true)->get();
        $dataPoliDokter = DoctorPoli::where('isActive', true)->get();
        return view('pages.poli.index', [
            "title" => "Poliklinik",
            "menu" => "Setting",
            "data" => $data,
            "dataPoliDokter" => $dataPoliDokter,
        ]);
    }
    public function create()
    {
        $data = User::where('isDokter', true)->get();
        return view('pages.poli.create', [
            "title" => "Poliklinik",
            "menu" => "Setting",
            "data" => $data
        ]);
    }

    public function store(PoliklinikStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $errors = [];
            $dataPoli = [
                'name' => $request->name,
                'kode' => $request->kode,
                'kode_antrian' => $request->kode_antrian,
            ]; 

            $newPoli = Poliklinik::create($dataPoli);

            $dokterIds = $request->input('user_id', []);
            $tarifs = $request->input('tarif', []);

            foreach ($dokterIds as $key => $dokterId) {

                DoctorPoli::create([
                    'user_id' => $dokterId,
                    'poliklinik_id' => $newPoli->id,
                    'tarif' => $tarifs[$key],
                ]);
            }
            if (!empty($errors)) {
                DB::rollBack();
                return back()->with('exceptions', $errors)->withInput();
            }
            DB::commit();
            return redirect()->route('poliklinik.index')->with('success', 'Berhasil ditambahkan');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage())->withInput();
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $item = Poliklinik::find($id);
        $data = User::where('isDokter', true)->get();
        return view('pages.poli.edit', [
            "title" => "Poliklinik",
            "menu" => "Setting",
            "item" => $item,
            "data" => $data
        ]);
    }

    public function update(PoliklinikUpdateRequest $request, $id)
    {
        dd($request->all());
        DB::beginTransaction();
        try {
            $errors = [];
            $item = Poliklinik::findOrfail($id);
            $dataPoli = [
                'name' => $request->name,
                'kode' => $request->kode,
                'kode_antrian' => $request->kode_antrian,
            ]; 

            $item->update($dataPoli);
            // $item->doctorPolis()->delete();

            $dokterIds = $request->input('user_id', []);
            $tarifs = $request->input('tarif', []);

            foreach ($dokterIds as $key => $dokterId) {
                DoctorPoli::create([
                    'user_id' => $dokterId,
                    'poliklinik_id' => $item->id,
                    'tarif' => $tarifs[$key],
                ]);
            }
            if (!empty($errors)) {
                DB::rollBack();
                return back()->with('exceptions', $errors)->withInput();
            }
            DB::commit();
            return redirect()->route('poliklinik.index')->with('success', 'Berhasil Diperbarui');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage())->withInput();
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function destroy($id){
        DB::beginTransaction();
        try {
            $item = Poliklinik::findOrFail($id);
            $item->update([
                'isActive' => false,
            ]);
            
            DB::commit();
            return back()->with('success', 'Berhasil Dihapus');
        } catch (Exception $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        } catch (ModelNotFoundException $e){
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function activateOrUnactivate($id, $status){
        DB::beginTransaction();
        try {
            $item = DoctorPoli::findOrFail($id);
            if ($status === 'unactivate') {
                $item->update([
                    'isActive' => false,
                ]);
            }
            if ($status === 'activate') {
                $item->update([
                    'isActive' => true,
                ]);
            }
            DB::commit();
            return back()->with('success', 'Berhasil ' . ($status == 'unactivate' ? 'menonaktifkan dokter' : 'mengaktifkan kembali dokter'));
        } catch (Exception $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        } catch (ModelNotFoundException $e){
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}
