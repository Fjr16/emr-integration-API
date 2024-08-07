<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use Illuminate\Http\Request;
use App\Models\RajalGeneralConsent;
use App\Models\RajalGeneralConsentDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RajalGeneralConsentController extends Controller
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
        $item = Queue::find(decrypt($id));
        return view('pages.rajalGeneralConsent.create', [
            'title' => "General Consent",
            'menu' => 'Rawat Jalan',
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
        $item = Queue::find($id);
        $data = $request->all();

        if ($data['hubungan'] == 'Lainnya') {
            $data['hubungan'] = $data['lainnya'];
        }

        $folder_path = 'assets/paraf-pasien/general-consent-rajal';
        Storage::makeDirectory('public/' . $folder_path);

        // paraf keluarga pasien
        $ttd = base64_decode(str_replace('data:image/png;base64,', '', $request->input('ttd')));
        $file_name_ttd = $folder_path . uniqid() . '.png';
        Storage::put('public/' . $file_name_ttd, $ttd);
        $data['ttd'] = $file_name_ttd;
        $data['user_id'] = Auth::user()->id;
        $data['patient_id'] = $item->patient->id;
        $data['queue_id'] = $id;
        $gc = RajalGeneralConsent::create($data);

          // rajal gc detail
        foreach ($data['persetujuan_name'] as $key => $name) {
            RajalGeneralConsentDetail::create([
                'rajal_general_consent_id' => $gc->id,
                'name' => $name,
                'hub' => $data['persetujuan_hub'][$key],
            ]);
        }


        return redirect()->route('antrian.index')->with(
            [
                'success' => 'Data Berhasil Ditambahkan',
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
        $queue = Queue::find(decrypt($id));
        $item = RajalGeneralConsent::firstwhere('queue_id', $queue->id);

        return view('pages.rajalGeneralConsent.show', [
            'item' => $item,
        ]);
    }

    public function showTataTertib($id)
    {
        $queue = Queue::find(decrypt($id));
        $item = RajalGeneralConsent::firstwhere('queue_id', $queue->id);

        return view('pages.rajalGeneralConsent.tatatertib', [
            'item' => $item,
        ]);
    }

    public function showHakDanKewajiban($id)
    {
        $queue = Queue::find(decrypt($id));
        $item = RajalGeneralConsent::firstwhere('queue_id', $queue->id);

        return view('pages.rajalGeneralConsent.hakdankewajiban', [
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

        $queue = Queue::find(decrypt($id));
        $item = RajalGeneralConsent::firstwhere('queue_id', $queue->id);

        return view('pages.rajalGeneralConsent.edit', [
            'title' => 'Rekam Medis',
            'menu' => 'Rawat Jalan',
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
        $item = RajalGeneralConsent::find($id);
        $data = $request->all();

        $folder_path = 'assets/paraf-pasien/general-consent-rajal';
        Storage::makeDirectory('public/' . $folder_path);

        if ($data['hubungan'] == 'Lainnya') {
            $data['hubungan'] = $data['lainnya'];
        }

        if ($request->input('ttd')) {
            // paraf keluarga pasien
            $ttd = base64_decode(str_replace('data:image/png;base64,', '', $request->input('ttd')));
            $file_name_ttd = $folder_path . uniqid() . '.png';
            Storage::put('public/' . $file_name_ttd, $ttd);
            $data['ttd'] = $file_name_ttd;
        }else{
            $data['ttd'] = $item->ttd;
        }
        if (!$request->input('ttd_admisi')) {
            $data['ttd_admisi'] = $item->ttd_admisi;
        }

        if ($item->update($data)) {
            $item->rajalGeneralConsentDetails()->delete();
    
            // rajal gc detail
            foreach ($data['persetujuan_name'] as $key => $name) {
                RajalGeneralConsentDetail::create([
                    'rajal_general_consent_id' => $item->id,
                    'name' => $name,
                    'hub' => $data['persetujuan_hub'][$key],
                ]);
            }
        };

        return redirect()->route('antrian.index')->with(
            [
                'success' => 'Data Berhasil Diperbarui',
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
        $queue = Queue::find($id);
        $item = RajalGeneralConsent::firstwhere('queue_id', $queue->id);
        if($item->delete()){
            $item->rajalGeneralConsentDetails()->delete();
        };

        return back()->with([
            'success' => 'Berhasil Dihapus',
        ]);
    }
}
