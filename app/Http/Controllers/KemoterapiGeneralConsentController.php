<?php

namespace App\Http\Controllers;

use App\Models\KemoterapiGeneralConsent;
use App\Models\KemoterapiPatient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class KemoterapiGeneralConsentController extends Controller
{
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
        $item = KemoterapiPatient::find($id);
        return view('pages.kemoterapiGeneralConsent.create', [
            'title' => 'Pasien Kemo',
            'menu' => 'Kemoterapi',
            'item' => $item,
            'status' => $status,
            'kelamin' => $kelamin,
        ]);
    }

    public function store(Request $request, $id)
    {
        $item = KemoterapiPatient::find($id);
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
        $data['kemoterapi_patient_id'] = $id;
        KemoterapiGeneralConsent::create($data);

        return redirect()->route('kemoterapi/patient.show', $item->id)->with(
            [
                'success' => 'Data Berhasil  Ditambahkan',
                'active' => 'general-consent',
            ]
        );
    }

    public function show($id)
    {
        $item = KemoterapiGeneralConsent::find($id);

        return view('pages.kemoterapiGeneralConsent.show', [
            'item' => $item,
        ]);
    }

    public function showTataTertib($id)
    {
        $item = KemoterapiGeneralConsent::find($id);

        return view('pages.kemoterapiGeneralConsent.tatatertib', [
            'item' => $item,
        ]);
    }

    public function showHakDanKewajiban($id)
    {
        $item = KemoterapiGeneralConsent::find($id);

        return view('pages.kemoterapiGeneralConsent.hakdankewajiban', [
            'item' => $item,
        ]);
    }

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

        $item = KemoterapiGeneralConsent::find($id);

        return view('pages.kemoterapiGeneralConsent.edit', [
            'title' => 'Pasien Kemo',
            'menu' => 'Kemoterapi',
            'status' => $status,
            'kelamin' => $kelamin,
            'item' => $item,
        ]);
    }

    public function update(Request $request, $id)
    {
        $item = KemoterapiGeneralConsent::find($id);
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

        return redirect()->route('kemoterapi/patient.show', $item->kemoterapiPatient->id)->with(
            [
                'success' => 'Data Berhasil  Diperbarui',
                'active' => 'general-consent',
            ]
        );
    }

    public function destroy($id)
    {
        $item = KemoterapiGeneralConsent::find($id);
        $item->delete();

        return back()->with([
            'success' => 'Berhasil Dihapus',
            'active' => 'general-consent',
        ]);
    }
}
