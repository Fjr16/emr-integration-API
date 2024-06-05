<?php

namespace App\Http\Controllers;

use App\Models\GeneralConsentPatient;
use App\Models\Queue;
use App\Models\RawatInapPatient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GeneralConsentRanap extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Queue::whereHas('rawatInapPatient', function($query){
            $query->whereNot('status', 'WAITING')->whereNot('status', 'BATAL');
        })->get();
        return view('pages.generalConsent.index', [
            "title" => "General Consent",
            "menu" => "Rawat Inap",
            'data' => $data,
        ]);
    }

    public function detail($id)
    {
        $item = RawatInapPatient::find($id);
        $generalConsents = GeneralConsentPatient::where('rawat_inap_patient_id', $id)->get();

        return view('pages.generalConsent.detail', [
            "item" => $item,
            "title" => "General Consent",
            "menu" => "Rawat Inap",
            "generalConsents" => $generalConsents,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $status = [
            'Diri Sendiri',
            'Suami',
            'Istri',
            'Ayah',
            'Ibu',
            'Anak',
            'Teman',
            'Lainnya',
        ];

        $kelamin = [
            'Pria',
            'Wanita',
        ];
        $item = RawatInapPatient::find($id);
        $dpjp = $item->ranapDpjpPatientDetails->where('status', true)->first();
        return view('pages.generalConsent.create', [
            'title' => "General Consent",
            'menu' => 'Rawat Inap',
            'item' => $item,
            'status' => $status,
            'kelamin' => $kelamin,
            'dpjp' => $dpjp,
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
        $item = RawatInapPatient::find($id);
        $dpjp = $item->ranapDpjpPatientDetails->where('status', true)->first();
        $data = $request->all();

        $folder_path = 'assets/paraf-pasien/';
        Storage::makeDirectory('public/' . $folder_path);

        // paraf keluarga pasien
        $ttd = base64_decode(str_replace('data:image/png;base64,', '', $request->input('ttd')));
        $file_name_ttd = $folder_path . uniqid() . '.png';
        Storage::put('public/' . $file_name_ttd, $ttd);
        $data['ttd'] = $file_name_ttd;
        $data['user_id'] = Auth::user()->id;
        $data['dpjp'] = $dpjp->user->name ?? '';
        $data['rawat_inap_patient_id'] = $id;
        GeneralConsentPatient::create($data);

        return redirect()->route('general-consent-ranap.detail', $item->queue->patient_id)->with('success', 'Data Berhasil  Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = GeneralConsentPatient::find($id);

        return view('pages.generalConsent.show', [
            'item' => $item,
        ]);
    }

    public function showtatatertib($id)
    {
        $item = GeneralConsentPatient::find($id);

        return view('pages.generalConsent.tatatertib', [
            'item' => $item,
        ]);
    }

    public function showhakdankewajiban($id)
    {
        $item = GeneralConsentPatient::find($id);

        return view('pages.generalConsent.hakdankewajiban', [
            'item' => $item,
        ]);
    }

    public function halaman1($id)
    {
        $item = GeneralConsentPatient::find($id);
        return view('pages.generalConsent.halaman1.index', [
            'title' => "General Consent",
            'menu' => 'Rawat Inap',
            'item' => $item,
        ]);
    }

    public function halaman2($id)
    {
        $item = GeneralConsentPatient::find($id);
        return view('pages.generalConsent.halaman2.index', [
            'title' => "General Consent",
            'menu' => 'Rawat Inap',
            'item' => $item,
        ]);
    }

    public function tataTertib($id)
    {
        $item = GeneralConsentPatient::find($id);
        return view('pages.generalConsent.tataTertib.index', [
            'title' => "General Consent",
            'menu' => 'Rawat Inap',
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
        $status = [
            'Diri Sendiri',
            'Suami',
            'Istri',
            'Ayah',
            'Ibu',
            'Anak',
            'Teman',
            'Lainnya',
        ];

        $kelamin = [
            'Laki - Laki',
            'Perempuan',
        ];

        $item = GeneralConsentPatient::find($id);

        return view('pages.generalConsent.edit', [
            'title' => 'General Consent',
            'menu' => 'Rawat Inap',
            'status' => $status,
            'kelamin' => $kelamin,
            'item' => $item,
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
        $item = GeneralConsentPatient::find($id);
        $data = $request->all();

        $folder_path = 'assets/paraf-pasien/';
        Storage::makeDirectory('public/' . $folder_path);

        if ($request->input('ttd')) {
            // paraf keluarga pasien
            $ttd = base64_decode(str_replace('data:image/png;base64,', '', $request->input('ttd')));
            $file_name_ttd = $folder_path . uniqid() . '.png';
            Storage::put('public/' . $file_name_ttd, $ttd);
            $data['ttd'] = $file_name_ttd;
        }

        $item->update($data);

        return redirect()->route('general-consent-ranap.detail', $item->rawat_inap_patient_id)->with('success', 'Data Berhasil  Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        GeneralConsentPatient::find($id)->delete();

        return back()->with('success', 'Data Berhasil  Dihapus');
    }
}
