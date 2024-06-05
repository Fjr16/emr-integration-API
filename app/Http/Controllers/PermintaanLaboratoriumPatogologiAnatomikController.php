<?php

namespace App\Http\Controllers;

use App\Models\AntrianLaboratoriumPatologiAnatomiPatient;
use App\Models\DetailAntrianLaboratoriumPatologiAnatomiPatient;
use App\Models\HasilHistopatologiPatient;
use App\Models\HasilSitopatologiPatient;
use App\Models\LaboratoriumPatientResult;
use App\Models\Patient;
use App\Models\PermintaanLaboratoriumPatologiAnatomikPatient;
use App\Models\Queue;
use App\Models\RadiologiPatient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PermintaanLaboratoriumPatogologiAnatomikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = PermintaanLaboratoriumPatologiAnatomikPatient::all();
        return view('pages.pasienLaborPaList.index', [
            'title' => 'Laboratorium PA',
            'menu' => 'Laboratorium PA',
            'data' => $data,
        ]);
    }

    public function indexAntrian()
    {
        $data = AntrianLaboratoriumPatologiAnatomiPatient::all();
        return view('pages.pasienLaborPa.index', [
            'title' => 'Antrian Laboratorium PA',
            'menu' => 'Laboratorium PA',
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $menu = 'In Patient';
        if (session()->has('currentMenu')) {
            $menu = session('currentMenu');
        }
        $item = Queue::find($id);
        $patien = Patient::find($item->patient_id);
        $tanggal_lahir = Carbon::parse($patien->tanggal_lhr);
        $umur = $tanggal_lahir->diff(Carbon::now())->format('%y');
        $radiologiResults = RadiologiPatient::where('patient_id', $item->patient->id)
            ->where('status', 'VALIDATED')
            ->orWhere('status', 'UNVALIDATED')
            ->latest()
            ->get();
        $laborPkResults = LaboratoriumPatientResult::where('patient_id', $item->patient->id)
            ->where('status', 'VALIDATED')
            ->orWhere('status', 'UNVALIDATED')
            ->latest()
            ->get();

        // dd($radiologiResults->radiologiFormRequest->diagnosa_klinis);
        return view('pages.permintaanLaborPa.create', [
            'title' => 'Permintaan Laboratorium PA',
            'menu' => $menu,
            'item' => $item,
            'umur' => $umur,
            'laborPkResults' => $laborPkResults,
            'radiologiResults' => $radiologiResults,
        ]);
    }

    public function createAntrian($id)
    {
        $item = PermintaanLaboratoriumPatologiAnatomikPatient::find($id);
        $tindakan = [
            [
                'name' => 'Tindakan satu',
                'category' => 'HISTOPATOLOGI',
            ],
            [
                'name' => 'Tindakan dua',
                'category' => 'HISTOPATOLOGI',
            ],
            [
                'name' => 'Tindakan tiga',
                'category' => 'SITOPATOLOGI',
            ],
        ];
        return view('pages.pasienLaborPa.create', [
            'title' => 'Laboratorium PA',
            'menu' => 'Laboratorium PA',
            'tindakan' => $tindakan,
            'item' => $item,
        ]);
    }

    public function createHistopatologi($id)
    {
        $lastItem = HasilHistopatologiPatient::latest()->first();
        $format = 'PRPS';
        $currentYear = date('Y');

        $lastNoPend = $lastItem->no_pend ?? '';
        if ($lastNoPend) {
            $temp = explode('.', $lastNoPend) ?? '';
            $temp2 = explode('-', $temp[1] ?? '') ?? '';
            $lastNumber = $temp2[0] ?? '';
            $lastYear = $temp2[1] ?? '';

            if ($lastYear == $currentYear) {
                $nextNumber = $lastNumber + 1;
                if (strlen($nextNumber) == 1) {
                    $newNumber = '00' . $nextNumber;
                } elseif (strlen($nextNumber) == 2) {
                    $newNumber = '0' . $nextNumber;
                } elseif (strlen($nextNumber) == 3) {
                    $newNumber = $nextNumber;
                } else {
                    return 'OVERFLOW';
                }
            } else {
                $newNumber = '001';
            }
        } else {
            $newNumber = '001';
        }

        $noHisto = $format . '.' . $newNumber . '-' . $currentYear;

        $item = DetailAntrianLaboratoriumPatologiAnatomiPatient::find($id);
        return view('pages.pasienLaborPaHistopatologi.create', [
            'title' => 'Antrian Laboratorium PA',
            'menu' => 'Laboratorium PA',
            'item' => $item,
            'noHisto' => $noHisto,
        ]);
    }

    public function editHistopatologi($id)
    {
        $item = DetailAntrianLaboratoriumPatologiAnatomiPatient::find($id);
        $hasil = HasilHistopatologiPatient::find($item->hasilHistopatologiPatient->id);
        return view('pages.pasienLaborPaHistopatologi.edit', [
            'title' => 'Antrian Laboratorium PA',
            'menu' => 'Laboratorium PA',
            'item' => $item,
            'hasil' => $hasil,
        ]);
    }

    public function createSitopatologi($id)
    {
        $lastItem = HasilSitopatologiPatient::latest()->first();
        $format = 'SRPS';
        $currentYear = date('Y');

        $lastNoPend = $lastItem->no_pend ?? '';
        if ($lastNoPend) {
            $temp = explode('.', $lastNoPend) ?? '';
            $temp2 = explode('-', $temp[1] ?? '') ?? '';
            $lastNumber = $temp2[0] ?? '';
            $lastYear = $temp2[1] ?? '';

            if ($lastYear == $currentYear) {
                $nextNumber = $lastNumber + 1;
                if (strlen($nextNumber) == 1) {
                    $newNumber = '00' . $nextNumber;
                } elseif (strlen($nextNumber) == 2) {
                    $newNumber = '0' . $nextNumber;
                } elseif (strlen($nextNumber) == 3) {
                    $newNumber = $nextNumber;
                } else {
                    return 'OVERFLOW';
                }
            } else {
                $newNumber = '001';
            }
        } else {
            $newNumber = '001';
        }

        $noSito = $format . '.' . $newNumber . '-' . $currentYear;

        $item = DetailAntrianLaboratoriumPatologiAnatomiPatient::find($id);
        return view('pages.pasienLaborPaSitopatologi.create', [
            'title' => 'Antrian Laboratorium PA',
            'menu' => 'Laboratorium PA',
            'item' => $item,
            'noSito' => $noSito,
        ]);
    }

    public function editSitopatologi($id)
    {
        $item = DetailAntrianLaboratoriumPatologiAnatomiPatient::find($id);
        $hasil = HasilSitopatologiPatient::find($item->hasilSitopatologiPatient->id);
        dd($hasil);
        return view('pages.pasienLaborPaHistopatologi.edit', [
            'title' => 'Antrian Laboratorium PA',
            'menu' => 'Laboratorium PA',
            'item' => $item,
            'hasil' => $hasil,
        ]);
    }

    public function storeAntrian(Request $request, $id)
    {
        $tindakan = $request->input('tindakan', []);
        $item = PermintaanLaboratoriumPatologiAnatomikPatient::find($id);
        $antrianLaboratoriumPatologiAnatomiPatient = AntrianLaboratoriumPatologiAnatomiPatient::create([
            'permintaan_laboratorium_patologi_anatomik_patient_id' => $item->id,
            'user_id' => Auth::user()->id,
            'tgl_diperiksa' => $request->tgl_diperiksa,
        ]);

        foreach ($tindakan as $tindak) {
            DetailAntrianLaboratoriumPatologiAnatomiPatient::create([
                'antrian_laboratorium_patologi_anatomi_patient_id' => $antrianLaboratoriumPatologiAnatomiPatient->id,
                'name' => $tindak,
            ]);
        }

        return redirect()
            ->route('permintaan/laboratorium/patologi/anatomik.index', $item->queue->id)
            ->with([
                'success' => 'SUKSES BERHASIL DI TAMBAHKAN',
                'menu' => 'Laboratorium PA',
                'title' => 'Permintaan Laboratorium PA',
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
        $item = Queue::find($id);
        $data = $request->all();
        $data['queue_id'] = $item->id;
        $data['user_id'] = Auth::user()->id;
        $data['patient_id'] = $item->patient->id;

        $item2 = PermintaanLaboratoriumPatologiAnatomikPatient::create($data);

        if ($request->has('wajah-input')) {
            $filePathWajah = $this->saveBase64Image($request->input('wajah-input'), 'wajah', $item2->id, $item->patient->name);
            $data['gambarLokasiMuka'] = $filePathWajah;
        }

        if ($request->has('leher-input')) {
            $filePathLeher = $this->saveBase64Image($request->input('leher-input'), 'leher', $item2->id, $item->patient->name);
            $data['gambarLokasiLeher'] = $filePathLeher;
        }

        if ($request->has('dada-input')) {
            $filePathDada = $this->saveBase64Image($request->input('dada-input'), 'dada', $item2->id, $item->patient->name);
            $data['gambarLokasiDada'] = $filePathDada;
        }
        $data2 = PermintaanLaboratoriumPatologiAnatomikPatient::where('id', $item2->id)->first();
        $data2->update($data);

        return redirect()
            ->route('rajal/show', ['title' => 'Rawat Jalan', 'id' => $id])
            ->with([
                'success' => 'SUKSES BERHASIL DI TAMBAHKAN',
                'btn' => 'dokter',
                'dokter' => 'laboratorium PA',
            ]);
    }

    private function saveBase64Image($dataBase64, $prefix, $id, $patientName)
    {
        if ($dataBase64) {
            $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $dataBase64));
            $fileName = $prefix . '_' . uniqid() . '.png';
            $filePath = 'assets/sketsa-lokasi/' . $patientName . '/' . $id . '/' . $fileName;
            Storage::disk('public')->put($filePath, $image);
            return $filePath; // Return the file path after saving the image
        }
        return null; // Return null if there's no data
    }

    public function edit($id)
    {
        $menu = 'In Patient';
        if (session()->has('currentMenu')) {
            $menu = session('currentMenu');
        }
        $item = PermintaanLaboratoriumPatologiAnatomikPatient::find($id);
        $patien = Patient::find($item->patient_id);
        $tanggal_lahir = Carbon::parse($patien->tanggal_lhr);
        $umur = $tanggal_lahir->diff(Carbon::now())->format('%y');
        $radiologiResults = RadiologiPatient::where('patient_id', $item->patient->id)
            ->where('status', 'VALIDATED')
            ->orWhere('status', 'UNVALIDATED')
            ->latest()
            ->get();
        $laborPkResults = LaboratoriumPatientResult::where('patient_id', $item->patient->id)
            ->where('status', 'VALIDATED')
            ->orWhere('status', 'UNVALIDATED')
            ->latest()
            ->get();

        // dd($radiologiResults->radiologiFormRequest->diagnosa_klinis);
        return view('pages.permintaanLaborPa.edit', [
            'title' => 'Permintaan Laboratorium PA',
            'menu' => $menu,
            'item' => $item,
            'umur' => $umur,
            'laborPkResults' => $laborPkResults,
            'radiologiResults' => $radiologiResults,
        ]);
    }

    public function update(Request $request, $id)
    {
        $item = PermintaanLaboratoriumPatologiAnatomikPatient::find($id);
        $data = $request->all();
        $data['queue_id'] = $item->queue_id;
        $data['user_id'] = Auth::user()->id;
        $data['patient_id'] = $item->patient->id;

        // Cek apakah ada input gambar untuk wajah
        if ($request->has('wajah-input') && !empty($request->input('wajah-input'))) {
            if ($item->gambarLokasiMuka) {
                Storage::delete($item->gambarLokasiMuka);
            }
            $filePathWajah = $this->saveBase64Image($request->input('wajah-input'), 'wajah', $id, $item->patient->name);
            $data['gambarLokasiMuka'] = $filePathWajah;
        }

        // Cek apakah ada input gambar untuk leher
        if ($request->has('leher-input') && !empty($request->input('leher-input'))) {
            if ($item->gambarLokasiLeher) {
                Storage::delete($item->gambarLokasiLeher);
            }
            $filePathLeher = $this->saveBase64Image($request->input('leher-input'), 'leher', $id, $item->patient->name);
            $data['gambarLokasiLeher'] = $filePathLeher;
        }

        // Cek apakah ada input gambar untuk dada
        if ($request->has('dada-input') && !empty($request->input('dada-input'))) {
            if ($item->gambarLokasiDada) {
                Storage::delete($item->gambarLokasiDada);
            }
            $filePathDada = $this->saveBase64Image($request->input('dada-input'), 'dada', $id, $item->patient->name);
            $data['gambarLokasiDada'] = $filePathDada;
        }

        // Perbarui data pada instance model $item
        $item->update($data);

        return redirect()
            ->route('rajal/show', ['title' => 'Rawat Jalan', 'id' => $item->queue_id])
            ->with([
                'success' => 'SUKSES BERHASIL DI EDIT',
                'btn' => 'dokter',
                'dokter' => 'laboratorium PA',
            ]);
    }

    public function delete($id)
    {
        $item = PermintaanLaboratoriumPatologiAnatomikPatient::find($id);
        $folderPath = 'storage/assets/sketsa-lokasi/' . $item->patient->name . '/' . $item->id;
        File::deleteDirectory($folderPath);
        $item->delete();

        return redirect()
            ->back()
            ->with([
                'success' => 'SUKSES BERHASIL DI EDIT',
                'btn' => 'dokter',
                'dokter' => 'laboratorium PA',
            ]);
    }

    public function storeHasilHispatologi(Request $request, $id)
    {
        $item = DetailAntrianLaboratoriumPatologiAnatomiPatient::find($id);
        $data = $request->all();
        $data['detail_antrian_laboratorium_patologi_anatomi_patient_id'] = $item->id;
        $data['user_id'] = Auth::user()->id;
        HasilHistopatologiPatient::create($data);
        return redirect()
            ->route('permintaan/laboratorium/patologi/anatomik.show', $item->antrianLaboratoriumPatologiAnatomiPatient->id)
            ->with('success', 'Berhasil Ditambahkan');
        // return redirect()->route('rajal/show', ['title' => 'Rawat Jalan', 'id' => $item->antrianLaboratoriumPatologiAnatomiPatient->permintaanLaboratoriumPatologiAnatomikPatient->queue->id])->with([
        //     'success' => 'SUKSES BERHASIL DI TAMBAHKAN',
        //     'btn' => 'dokter',
        //     'dokter' => 'laboratorium PA',
        // ]);
    }

    public function updateHasilHispatologi(Request $request, $id)
    {
        $item = HasilHistopatologiPatient::find($id);
        $data = $request->all();
        $item->update($data);
        return redirect()
            ->route('permintaan/laboratorium/patologi/anatomik.show', $item->detailAntrianLaboratoriumPatologiAnatomiPatient->antrianLaboratoriumPatologiAnatomiPatient->id)
            ->with('success', 'Berhasil Diperbarui');
        // return redirect()->route('rajal/show', ['title' => 'Rawat Jalan', 'id' => $item->detailAntrianLaboratoriumPatologiAnatomiPatient->antrianLaboratoriumPatologiAnatomiPatient->permintaanLaboratoriumPatologiAnatomikPatient->queue->id])->with([
        //     'success' => 'SUKSES BERHASIL DI TAMBAHKAN',
        //     'btn' => 'dokter',
        //     'dokter' => 'laboratorium PA',
        // ]);
    }

    public function storeHasilSitopatologi(Request $request, $id)
    {
        $item = DetailAntrianLaboratoriumPatologiAnatomiPatient::find($id);
        $data = $request->all();
        $data['detail_antrian_laboratorium_patologi_anatomi_patient_id'] = $item->id;
        $data['user_id'] = Auth::user()->id;
        HasilSitopatologiPatient::create($data);
        return redirect()
            ->route('permintaan/laboratorium/patologi/anatomik.show', $item->antrianLaboratoriumPatologiAnatomiPatient->id)
            ->with('success', 'SUKSES BERHASIL DI TAMBAHKAN');
    }

    public function updateHasilSitopatologi(Request $request, $id)
    {
        $item = HasilSitopatologiPatient::find($id);
        $data = $request->all();
        $item->update($data);
        return redirect()
            ->route('permintaan/laboratorium/patologi/anatomik.show', $item->detailAntrianLaboratoriumPatologiAnatomiPatient->antrianLaboratoriumPatologiAnatomiPatient->id)
            ->with('success', 'SUKSES BERHASIL DI PERBARUI');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = AntrianLaboratoriumPatologiAnatomiPatient::find($id);
        return view('pages.pasienLaborPa.show', [
            'title' => 'Antrian Laboratorium PA',
            'menu' => 'Laboratorium PA',
            'item' => $item,
        ]);
    }

    public function showHistopatologi($id)
    {
        $detailAntrian = DetailAntrianLaboratoriumPatologiAnatomiPatient::find($id);
        $item = HasilHistopatologiPatient::find($detailAntrian->hasilHistopatologiPatient->id);
        return view('pages.pasienLaborPaHistopatologi.show', [
            'title' => 'Antrian Laboratorium PA',
            'menu' => 'Laboratorium PA',
            'item' => $item,
        ]);
    }

    public function showSitopatologi($id)
    {
        $detailAntrian = DetailAntrianLaboratoriumPatologiAnatomiPatient::find($id);
        $item = HasilSitopatologiPatient::find($detailAntrian->hasilSitopatologiPatient->id);
        dd($item);
        return view('pages.pasienLaborPaSitopatologi.show', [
            'title' => 'Antrian Laboratorium PA',
            'menu' => 'Laboratorium PA',
            'item' => $item,
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $item = DetailAntrianLaboratoriumPatologiAnatomiPatient::find($id);
        $item->update([
            'status' => $request->status,
        ]);
        return back()->with('success', 'SUKSES');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
