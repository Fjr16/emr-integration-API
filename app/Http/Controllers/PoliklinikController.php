<?php

namespace App\Http\Controllers;

use App\Http\Requests\PoliklinikStoreRequest;
use App\Http\Requests\PoliklinikUpdateRequest;
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
        $data = Poliklinik::where('isActive', true)->get();
        return view('pages.poli.index', [
            "title" => "Poliklinik",
            "menu" => "Setting",
            "data" => $data
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
            $days = $request->input('day', []);
            $startAts = $request->input('start_at', []);
            $endsAts = $request->input('ends_at', []);

            foreach ($dokterIds as $key => $dokterId) {
                // untuk check ada atau tidak jadwal yang bentrok di poli yang sama, dengan hari, jam mulai hingga jam selesai yang sama
                $checkAnotherSameItem = DoctorsSchedule::where('poliklinik_id', $newPoli->id)
                                                    ->where('day', $days[$key])
                                                    ->where('start_at', $startAts[$key])
                                                    ->where('ends_at', $endsAts[$key])
                                                    ->exists();
                if ($checkAnotherSameItem) {
                    $errors[] = 'Data Baris ke {' . $key+1 . '} Bentrok dengan Jadwal Dokter Lain Pada Poli '.$newPoli->name;
                }

                DoctorsSchedule::create([
                    'user_id' => $dokterId,
                    'poliklinik_id' => $newPoli->id,
                    'tarif' => $tarifs[$key],
                    'day' => $days[$key],
                    'start_at' => $startAts[$key],
                    'ends_at' => $endsAts[$key],
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
            $item->jadwalDokter()->delete();

            $dokterIds = $request->input('user_id', []);
            $tarifs = $request->input('tarif', []);
            $days = $request->input('day', []);
            $startAts = $request->input('start_at', []);
            $endsAts = $request->input('ends_at', []);

            foreach ($dokterIds as $key => $dokterId) {
                // untuk check ada atau tidak jadwal yang bentrok di poli yang sama, dengan hari, jam mulai hingga jam selesai yang sama
                $checkAnotherSameItem = DoctorsSchedule::where('poliklinik_id', $item->id)
                                                    ->where('day', $days[$key])
                                                    ->where('start_at', $startAts[$key])
                                                    ->where('ends_at', $endsAts[$key])
                                                    ->exists();
                if ($checkAnotherSameItem) {
                    $errors[] = 'Data Baris ke {' . $key+1 . '} Bentrok dengan Jadwal Dokter Lain Pada Poli '.$item->name;
                }

                DoctorsSchedule::create([
                    'user_id' => $dokterId,
                    'poliklinik_id' => $item->id,
                    'tarif' => $tarifs[$key],
                    'day' => $days[$key],
                    'start_at' => $startAts[$key],
                    'ends_at' => $endsAts[$key],
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
}
