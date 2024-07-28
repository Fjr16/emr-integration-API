<?php

namespace App\Http\Controllers;

use App\Http\Requests\PoliklinikStoreRequest;
use App\Http\Requests\PoliklinikUpdateRequest;
use App\Models\DoctorsSchedule;
use App\Models\Poliklinik;
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
        return view('pages.poli.index', [
            "title" => "Poliklinik",
            "menu" => "Setting",
            "data" => $data,
        ]);
    }
    public function create()
    {
        return view('pages.poli.create', [
            "title" => "Poliklinik",
            "menu" => "Setting",
        ]);
    }

    public function store(PoliklinikStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $dataPoli = $request->validated(); 
            Poliklinik::create($dataPoli);

            DB::commit();
            return redirect()->route('poliklinik.index')->with('success', 'Poliklinik Berhasil Ditambahkan');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $item = Poliklinik::find($id);
        return view('pages.poli.edit', [
            "title" => "Poliklinik",
            "menu" => "Setting",
            "item" => $item,
        ]);
    }

    public function update(PoliklinikUpdateRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $item = Poliklinik::findOrfail($id);
            $dataPoli = $request->validated(); 

            $item->update($dataPoli);

            DB::commit();
            return redirect()->route('poliklinik.index')->with('success', 'Poliklinik Berhasil Diperbarui');
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
