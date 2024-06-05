<?php

namespace App\Http\Controllers;

use App\Models\IgdPatient;
use Illuminate\Http\Request;
use App\Models\IgdGeneralConsent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class IgdGeneralConsentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $item = IgdPatient::find($id);
        return view('pages.igdGeneralConsent.create', [
            'title' => "General Consent",
            'menu' => 'Rawat Inap',
            'item' => $item,
            'status' => $status,
            'kelamin' => $kelamin,
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
        $item = IgdPatient::find($id);
        $data = $request->all();

        $folder_path = 'assets/paraf-pasien/general-consent-igd';
        Storage::makeDirectory('public/' . $folder_path);

        // paraf keluarga pasien
        $ttd = base64_decode(str_replace('data:image/png;base64,', '', $request->input('ttd')));
        $file_name_ttd = $folder_path . uniqid() . '.png';
        Storage::put('public/' . $file_name_ttd, $ttd);
        $data['ttd'] = $file_name_ttd;
        $data['user_id'] = Auth::user()->id;
        $data['patient_id'] = $item->queue->patient->id;
        $data['igd_patient_id'] = $id;
        IgdGeneralConsent::create($data);

        return redirect()->route('igd/patient/rme.show', $item->id)->with(
            [
                'success' => 'Data Berhasil  Ditambahkan',
                'active' => 'general-consent',
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = IgdGeneralConsent::find($id);

        return view('pages.igdGeneralConsent.show', [
            'item' => $item,
        ]);
    }

    public function showTataTertib($id)
    {
        $item = IgdGeneralConsent::find($id);

        return view('pages.igdGeneralConsent.tatatertib', [
            'item' => $item,
        ]);
    }

    public function showHakDanKewajiban($id)
    {
        $item = IgdGeneralConsent::find($id);

        return view('pages.igdGeneralConsent.hakdankewajiban', [
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

        $item = IgdGeneralConsent::find($id);

        return view('pages.igdGeneralConsent.edit', [
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
        $item = IgdGeneralConsent::find($id);
        $data = $request->all();

        $folder_path = 'assets/paraf-pasien/general-consent-igd';
        Storage::makeDirectory('public/' . $folder_path);

        if ($request->input('ttd')) {
            // paraf keluarga pasien
            $ttd = base64_decode(str_replace('data:image/png;base64,', '', $request->input('ttd')));
            $file_name_ttd = $folder_path . uniqid() . '.png';
            Storage::put('public/' . $file_name_ttd, $ttd);
            $data['ttd'] = $file_name_ttd;
        } else {
            $data['ttd_admisi'] = $item->ttd_admisi;
            $data['ttd'] = $item->ttd;
        }

        $item->update($data);

        return redirect()->route('igd/patient/rme.show', $item->igdPatient->id)->with(
            [
                'success' => 'Data Berhasil  Diperbarui',
                'active' => 'general-consent',
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = IgdGeneralConsent::find($id);
        $item->delete();

        return back()->with([
            'success' => 'Berhasil Dihapus',
            'active' => 'general-consent',
        ]);
    }
}
