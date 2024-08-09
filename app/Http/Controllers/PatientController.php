<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientStoreRequest;
use App\Models\Job;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Patient::latest()->get();
        return view('pages.pasien.index', [
            "title" => "Pasien",
            "menu" => "Pasien",
            "data" => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $previousUrl = url()->previous();
        $provinsi = \Indonesia::allProvinces()->sortBy('name');
        $jk = ['Pria', 'Wanita'];
        $agama = ['Islam', 'Budha', 'Kristen Protestan', 'Kristen Katolik', 'Hindu', 'Konghucu', 'dll'];
        $status = ['Belum Kawin', 'Kawin', 'Janda', 'Duda'];
        $pendidikan = ['TIDAK SEKOLAH', 'PAUD', 'TK', 'SD', 'SMP / MTS / SLTP SEDERAJAT', 'SMA / SMK / SLTA SEDERAJAT', 'D2', 'D3', 'S1', 'S2', 'S3'];
        $jobs = Job::all();
        return view('pages.pasien.create', [
            "title" => "Pasien",
            "menu" => "Pasien",
            "jobs" => $jobs,
            "jk" => $jk,
            "agama" => $agama,
            "status" => $status,
            'pendidikan' => $pendidikan,
            "provinsi" => $provinsi,
            'previousUrl' => $previousUrl
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientStoreRequest $request)
    {
        $data = $request->validated();
        $patient = new Patient($data);
        $patient->save();

        return redirect($request->previous)->with('success', 'Data Pasien Berhasil Disimpan');
    }

    public function detail($id)
    {
        $item = Patient::findOrFail($id);
        $provinsi = \Indonesia::allProvinces()->sortBy('name');
        $jk = ['Pria', 'Wanita'];
        $agama = ['Islam', 'Budha', 'Kristen Protestan', 'Kristen Katolik', 'Hindu', 'Konghucu', 'dll'];
        $status = ['Belum Kawin', 'Kawin', 'Janda', 'Duda'];
        $pendidikan = ['SD', 'SMP / MTS / SLTP SEDERAJAT', 'SMA / SMK / SLTA SEDERAJAT', 'S1', 'S2', 'S3'];
        $jobs = Job::all();
        return view('pages.pasien.detail', [
            "title" => "Pasien",
            "menu" => "Pasien",
            "item" => $item,
            "jobs" => $jobs,
            "jk" => $jk,
            "agama" => $agama,
            "status" => $status,
            'pendidikan' => $pendidikan,
            "provinsi" => $provinsi,
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
        $item = Patient::findOrFail($id);
        $provinsi = \Indonesia::allProvinces()->sortBy('name');
        $jk = ['Pria', 'Wanita'];
        $agama = ['Islam', 'Budha', 'Kristen Protestan', 'Kristen Katolik', 'Hindu', 'Konghucu', 'dll'];
        $status = ['Belum Kawin', 'Kawin', 'Janda', 'Duda'];
        $pendidikan = ['SD', 'SMP / MTS / SLTP SEDERAJAT', 'SMA / SMK / SLTA SEDERAJAT', 'S1', 'S2', 'S3'];
        $jobs = Job::all();
        return view('pages.pasien.edit', [
            "title" => "Pasien",
            "menu" => "Pasien",
            "item" => $item,
            "jobs" => $jobs,
            "jk" => $jk,
            "agama" => $agama,
            "status" => $status,
            'pendidikan' => $pendidikan,
            "provinsi" => $provinsi,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Patient::findOrFail($id);
        $data = $request->all();
        $item->update($data);
        return redirect()->route('pasien.index')->with('success', 'Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Patient::find($id);
        $item->delete();

        return redirect()->route('pasien.index')->with('success', 'Berhasil Di Hapus');
    }
}
