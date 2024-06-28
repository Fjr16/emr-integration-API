<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\ActionCategory;
use App\Models\Queue;
use Illuminate\Http\Request;
use App\Models\InitialAssesment;
use App\Models\NewRadiologiRequest;
use App\Models\PatientActionReport;
use Illuminate\Support\Facades\URL;
use App\Models\RadiologiFormRequest;
use App\Models\RadiologiFormRequestDetail;
use Illuminate\Support\Facades\Auth;

class RadiologiFormRequestController extends Controller
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
        $title = 'Rawat Jalan';
        $menu = 'In Patient';
        $urlParent = URL::previous();

        $categoryActionRadiologi = ActionCategory::where('name', 'Radiologi')->first(); 
        $data = Action::where('action_category_id', $categoryActionRadiologi->id)->get();
        $item = Queue::findOrFail($id);

        $diagnosa = null;
        $rawat_jalan_poli_patient_id = $item->rawatJalanPatient->rawatJalanPoliPatient->id ?? '';
        if ($rawat_jalan_poli_patient_id) {
            $assesmenAwalMedis = InitialAssesment::where('rawat_jalan_poli_patient_id', $rawat_jalan_poli_patient_id)->latest()->first();
            $patientActionReport = PatientActionReport::where('rawat_jalan_poli_patient_id', $rawat_jalan_poli_patient_id)->latest()->first();

            if ($assesmenAwalMedis && $patientActionReport) {
                if ($assesmenAwalMedis->created_at->isBefore($patientActionReport->created_at)) {
                    $diagnosa = $patientActionReport->diagnosa;
                } else {
                    $diagnosa = $assesmenAwalMedis->diagnosa_kerja;
                }
            } elseif ($assesmenAwalMedis && !$patientActionReport) {
                $diagnosa = $assesmenAwalMedis->diagnosa_kerja;
            } elseif (!$assesmenAwalMedis && $patientActionReport) {
                $diagnosa = $patientActionReport->diagnosa;
            }
        }
        return view('pages.permintaanRadiologi.create', [
            'title' => $title,
            'menu' => $menu,
            'item' => $item,
            'data' => $data,
            'diagnosa' => $diagnosa,
            'urlParent' => $urlParent,
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
        // $this->validate($request, [
        //     'patient_id' => 'required',
        //     'room_detail_id' => 'required',
        //     'ttd_dokter' => 'required',
        //     'action_id' => 'required',
        // ]);
        $queue = Queue::find($id);

        // Create new radiology request
        $data = [
            'user_id' => Auth::user()->id,
            'patient_id' => $request->patient_id,
            'queue_id' => $queue->id,
            'room_detail_id' => $request->room_detail_id,
            'diagnosa_klinis' => $request->diagnosa_klinis,
            'catatan' => $request->catatan,
            'ttd_dokter' => $request->ttd_user,
            'ttd_dokter' => $request->ttd_user,
        ];

        $item = RadiologiFormRequest::create($data);
        $details = $request->input('action_id', []);
        foreach ($details as $detail) {
            RadiologiFormRequestDetail::create([
                'radiologi_form_request_id' => $item->id,
                'action_id' => $detail,
            ]);
        }

        return redirect()
            ->route('rajal/show', ['id' => $id, 'title' => 'Rawat Jalan'])
            ->with([
                'success' => 'Berhasil Ditambahkan',
                'btn' => 'dokter',
                'dokter' => 'radiologi',
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($queue_id, $radiologi_id)
    {
        // code baru
        $itemQueue = Queue::find($queue_id);
        $itemRadiologi = NewRadiologiRequest::find($radiologi_id);
        // return $itemRadiologi->newEkstremitasBawah;
        return view('pages.permintaanRadiologi.show2', [
            'title' => 'Rawat Jalan',
            'menu' => 'In Patient',
            'itemQueue' => $itemQueue,
            'itemRadiologi' => $itemRadiologi,
        ]);

        // code lama
        // $data = RadiologiFormRequestMaster::where('isActive', true)->get();
        // $itemQueue = Queue::find($queue_id);
        // $itemRadiologi = RadiologiFormRequest::find($radiologi_id);
        // // dd($itemRadiologi->radiologiFormRequestMasters()->where('radiologi_form_request_master_id', 19)->pluck('value'));
        // return view('pages.permintaanRadiologi.show', [
        //     "title" => "Rawat Jalan",
        //     "menu" => "In Patient",
        //     "itemQueue" => $itemQueue,
        //     "itemRadiologi" => $itemRadiologi,
        //     "data" => $data,
        // ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $id2)
    {
        // code netral
        // $currentRouteName = Route::currentRouteName();
        $title = 'Rawat Jalan';
        $menu = 'In Patient';
        $urlParent = URL::previous();
        $item = Queue::findOrFail($id);

        // code baru
        $dataRadiologi = NewRadiologiRequest::findOrFail($id2);

        $dataEkstrimitasAtas = NewEkstremitasAtas::where('new_radiologi_request_id', $id2)->get()->keyBy('name')->toArray();
        $dataEkstrimitasBawah = NewEkstremitasBawah::where('new_radiologi_request_id', $id2)->get()->keyBy('name')->toArray();
        $dataLainLain = NewLainLain::where('new_radiologi_request_id', $id2)->get();
        $dataLainLain2 = NewLainLain::where('new_radiologi_request_id', $id2)->get()->keyBy('name')->toArray();
        $nameValuePairs = $dataLainLain->pluck('value', 'name');
        $dataUsg = NewUSG::where('new_radiologi_request_id', $id2)->get();
        $dataUsg2 = NewUSG::where('new_radiologi_request_id', $id2)->get()->keyBy('name')->toArray();
        $nameValuePairsUsg = $dataUsg->pluck('value', 'name');
        $dataKontras = NewKontras::where('new_radiologi_request_id', $id2)->get();
        $dataKontras2 = NewKontras::where('new_radiologi_request_id', $id2)->get()->keyBy('name')->toArray();
        $nameValuePairsKontras = $dataKontras->pluck('value', 'name');
        $dataPemeriksaLainnya = NewPemeriksaanLainnya::where('new_radiologi_request_id', $id2)->get();
        $dataPemeriksaLainnya2 = NewPemeriksaanLainnya::where('new_radiologi_request_id', $id2)->get()->keyBy('name')->toArray();
        $nameValuePairsPemeriksaLainnya = $dataPemeriksaLainnya->pluck('value', 'name');
        // return $nameValuePairsPemeriksaLainnya;

        return view('pages.permintaanRadiologi.edit', [
            'title' => $title,
            'menu' => $menu,
            'item' => $item,
            'urlParent' => $urlParent,
            'dataRadiologi' => $dataRadiologi,
            'dataEkstrimitasAtas' => $dataEkstrimitasAtas,
            'dataEkstrimitasBawah' => $dataEkstrimitasBawah,
            'nameValuePairs' => $nameValuePairs,
            'dataLainLain2' => $dataLainLain2,
            'nameValuePairsUsg' => $nameValuePairsUsg,
            'dataUsg2' => $dataUsg2,
            'nameValuePairsKontras' => $nameValuePairsKontras,
            'dataKontras2' => $dataKontras2,
            'nameValuePairsPemeriksaLainnya' => $nameValuePairsPemeriksaLainnya,
            'dataPemeriksaLainnya2' => $dataPemeriksaLainnya2,
        ]);

        // code lama
        // $data = RadiologiFormRequestMasterCategory::where('isActive', true)->get();
        // $details = RadiologiFormRequestMasterDetail::where('isActive', true)->get();

        // $diagnosa = null;
        // if ($currentRouteName == 'rajal/permintaan/radiologi.create') {
        //     $rawat_jalan_poli_patient_id = $item->rawatJalanPatient->rawatJalanPoliPatient->id ?? '';
        //     if ($rawat_jalan_poli_patient_id) {
        //         $assesmenAwalMedis = InitialAssesment::where('rawat_jalan_poli_patient_id', $rawat_jalan_poli_patient_id)->latest()->first();
        //         $patientActionReport = PatientActionReport::where('rawat_jalan_poli_patient_id', $rawat_jalan_poli_patient_id)->latest()->first();

        //         if ($assesmenAwalMedis && $patientActionReport) {
        //             if ($assesmenAwalMedis->created_at->isBefore($patientActionReport->created_at)) {
        //                 $diagnosa = $patientActionReport->diagnosa;
        //             } else {
        //                 $diagnosa = $assesmenAwalMedis->diagnosa_kerja;
        //             }
        //         } elseif ($assesmenAwalMedis && !$patientActionReport) {
        //             $diagnosa = $assesmenAwalMedis->diagnosa_kerja;
        //         } elseif (!$assesmenAwalMedis && $patientActionReport) {
        //             $diagnosa = $patientActionReport->diagnosa;
        //         }
        //     }
        // } else if ($currentRouteName == 'ranap/permintaan/radiologi.create') {
        //     $title = 'Rawat Inap';
        //     $menu = 'Rawat Inap';
        //     $ranap_id = $item->rawatInapPatient->id ?? '';
        //     if ($ranap_id) {
        //         $assesmenAwalMedis = RanapInitialAssesment::where('rawat_inap_patient_id', $ranap_id)->latest()->first();
        //         if ($assesmenAwalMedis) {
        //             $diagnosa = $assesmenAwalMedis->diagnosa_kerja;
        //         }
        //     }
        // }
        // return view('pages.permintaanRadiologi.edit', [
        //     'title' => $title,
        //     'menu' => $menu,
        //     'item' => $item,
        //     'data' => $data,
        //     'details' => $details,
        //     'diagnosa' => $diagnosa,
        //     'urlParent' => $urlParent,
        // ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $id2)
    {
        $newRadiologiRequest = NewRadiologiRequest::find($id2);

        // start ekstrimitasAtas
        $ekstrimitasAtas = ['Clavicula', 'Shoulder', 'Humerus', 'Elbow-Joint', 'Antebrachii', 'Wrist-Joint', 'Manus'];
        NewEkstremitasAtas::where('new_radiologi_request_id', $newRadiologiRequest->id)->delete();
        foreach ($ekstrimitasAtas as $field) {
            $checkboxValue = $request->input($field);
            $radioValue = $request->input($field . '-Radio');

            // Cari record yang ada berdasarkan nama field

            if ($request->has($field) && $request->input($field)) {
                $checkboxValue = $request->input($field);
                $radioValue = $request->input($field . '-Radio');
                if ($radioValue) {
                    NewEkstremitasAtas::create([
                        'name' => $checkboxValue,
                        'new_radiologi_request_id' => $newRadiologiRequest->id,
                        'value' => $radioValue,
                    ]);
                }
            }
        }

        // Handle dynamic "Lainnya" inputs
        if ($request->has('ekstremitasAtas') && is_array($request->input('ekstremitasAtas'))) {
            $ekstrimitasAtas2 = ['Clavicula', 'Shoulder', 'Humerus', 'Elbow Joint', 'Antebrachii', 'Wrist Joint', 'Manus'];

            NewEkstremitasAtas::where('new_radiologi_request_id', $newRadiologiRequest->id)
                ->whereNotIn('name', $ekstrimitasAtas2)
                ->delete();

            foreach ($request->input('ekstremitasAtas') as $lainnya) {
                if (!empty($lainnya)) {
                    NewEkstremitasAtas::updateOrCreate(
                        [
                            'new_radiologi_request_id' => $newRadiologiRequest->id,
                            'name' => $lainnya,
                        ],
                        ['value' => null],
                    );
                }
            }
        }
        // end ekstrimitasAtas

        // start ekstrimitasBawah
        $ekstrimitasBawah = ['Femur', 'Genu', 'Cruris', 'Ankle-Joint', 'Calcaneus', 'Pedis'];
        NewEkstremitasBawah::where('new_radiologi_request_id', $newRadiologiRequest->id)->delete();
        foreach ($ekstrimitasBawah as $field) {
            if ($request->has($field) && $request->input($field)) {
                $checkboxValue = $request->input($field);
                $radioValue = $request->input($field . '-Radio');
                if ($radioValue) {
                    NewEkstremitasBawah::create([
                        'name' => $checkboxValue,
                        'new_radiologi_request_id' => $newRadiologiRequest->id,
                        'value' => $radioValue,
                    ]);
                }
            }
        }
        // Handle dynamic "Lainnya" inputs
        if ($request->has('ekstremitasBawah') && is_array($request->input('ekstremitasBawah'))) {
            $ekstrimitasBawah2 = ['Femur', 'Genu', 'Cruris', 'Ankle Joint', 'Calcaneus', 'Pedis'];

            NewEkstremitasBawah::where('new_radiologi_request_id', $newRadiologiRequest->id)
                ->whereNotIn('name', $ekstrimitasBawah2)
                ->delete();

            foreach ($request->input('ekstremitasBawah') as $lainnya) {
                if (!empty($lainnya)) {
                    NewEkstremitasBawah::updateOrCreate(
                        [
                            'new_radiologi_request_id' => $newRadiologiRequest->id,
                            'name' => $lainnya,
                        ],
                        ['value' => null],
                    );
                }
            }
        }
        // end ekstrimitasBawah

        // start lain lain
        $lainLain = ['Thorax', 'Foto-Polos-Abdomen', 'Abdomen', 'Pelvic', 'Schedel', 'Waters', 'SPN-2-Posisi', 'Vertebrae-Cervical', 'Vertebrae-Thoracal', 'Vertebrae-Thoracolumbal', 'Vertebrae-Lumbosacral', 'Sacrum', 'Coccygeus', 'Mastoid', 'TMJ', 'Nasal', 'Maxila', 'Mandibula'];
        NewLainLain::where('new_radiologi_request_id', $newRadiologiRequest->id)->delete();
        foreach ($lainLain as $field) {
            $checkboxValue = $request->input($field);
            if ($request->has($field)) {
                NewLainLain::create([
                    'name' => $checkboxValue,
                    'new_radiologi_request_id' => $newRadiologiRequest->id,
                    'value' => $request->input($field . '-Radio'),
                ]);
            }
        }
        // Handle dynamic "Lainnya" inputs
        if ($request->has('lain-lain') && is_array($request->input('lain-lain'))) {
            $lainlain2 = ['Thorax', 'Foto Polos Abdomen', 'Abdomen', 'Pelvic', 'Schedel', 'Waters', 'SPN 2 Posisi', 'Vertebrae Cervical', 'Vertebrae Thoracal', 'Vertebrae Thoracolumbal', 'Vertebrae Lumbosacral', 'Sacrum', 'Coccygeus', 'Mastoid', 'TMJ', 'Nasal', 'Maxila', 'Mandibula'];

            NewLainLain::where('new_radiologi_request_id', $newRadiologiRequest->id)
                ->whereNotIn('name', $lainlain2)
                ->delete();

            foreach ($request->input('lain-lain') as $lainnya) {
                if (!empty($lainnya)) {
                    NewLainLain::updateOrCreate(
                        [
                            'new_radiologi_request_id' => $newRadiologiRequest->id,
                            'name' => $lainnya,
                        ],
                        ['value' => null],
                    );
                }
            }
        }
        // end lain lain

        //start usg
        // Daftar nama-nama input yang diharapkan
        $usg = ['Thorax', 'Mammae', 'Abdomen-Atas', 'Abdomen-2', 'Urologi', 'Prostat', 'Testis', 'Testis-Dople'];
        // return $request->input('Abdomen-Atas');
        NewUSG::where('new_radiologi_request_id', $newRadiologiRequest->id)->delete();
        foreach ($usg as $field) {
            $checkboxValue = $request->input($field);
            if ($request->has($field)) {
                NewUSG::create([
                    'name' => $checkboxValue,
                    'new_radiologi_request_id' => $newRadiologiRequest->id,
                    'value' => $request->input($field . '-Radio'),
                ]);
            }
        }
        // return NewUSG::where('new_radiologi_request_id',$newRadiologiRequest->id)->get();

        if ($request->has('Leher/Thyroid-Radio')) {
            NewUSG::create([
                'name' => $request->input('Leher/Thyroid-Radio'),
                'new_radiologi_request_id' => $newRadiologiRequest->id,
                'value' => null,
            ]);
        }
        // Check for additional 'usg' entries
        if ($request->has('usg') && is_array($request->input('usg'))) {
            foreach ($request->input('usg') as $lainnya) {
                // Pastikan input tambahan tidak kosong
                if (!empty($lainnya)) {
                    NewUSG::create([
                        'new_radiologi_request_id' => $newRadiologiRequest->id,
                        'name' => $lainnya,
                        'value' => null,
                    ]);
                }
            }
        }
        //end usg

        // start kontras
        // Daftar nama-nama input yang diharapkan
        $kontras = ['Appendicogram', 'Cystography'];
        NewKontras::where('new_radiologi_request_id', $newRadiologiRequest->id)->delete();
        foreach ($kontras as $field) {
            $checkboxValue = $request->input($field);

            if ($request->has($field)) {
                NewKontras::create([
                    'name' => $checkboxValue,
                    'new_radiologi_request_id' => $newRadiologiRequest->id,
                    'value' => $request->input($field . '-Radio'),
                ]);
            }
        }
        if ($request->has('BNO/IVP-Radio')) {
            NewKontras::create([
                'name' => $request->input('BNO/IVP-Radio'),
                'new_radiologi_request_id' => $newRadiologiRequest->id,
                'value' => null,
            ]);
        }
        // Check for additional 'kontras' entries
        if ($request->has('kontras') && is_array($request->input('kontras'))) {
            foreach ($request->input('kontras') as $lainnya) {
                // Pastikan input tambahan tidak kosong
                if (!empty($lainnya)) {
                    NewKontras::create([
                        'new_radiologi_request_id' => $newRadiologiRequest->id,
                        'name' => $lainnya,
                        'value' => null,
                    ]);
                }
            }
        }

        // end kontras

        //start pemeriksaan lainnya
        // Daftar nama-nama input yang diharapkan
        $pemeriksaanLainnya = ['CT-Scan', 'MRI'];
        NewPemeriksaanLainnya::where('new_radiologi_request_id', $newRadiologiRequest->id)->delete();
        foreach ($pemeriksaanLainnya as $field) {
            $checkboxValue = $request->input($field);
            if ($request->has($field)) {
                NewPemeriksaanLainnya::create([
                    'name' => $checkboxValue,
                    'new_radiologi_request_id' => $newRadiologiRequest->id,
                    'value' => $request->input($field . '-input'),
                ]);
            }
        }
        // Check for additional 'pemeriksaanLainnya' entries
        if ($request->has('pemeriksaanLainnya') && is_array($request->input('pemeriksaanLainnya'))) {
            foreach ($request->input('pemeriksaanLainnya') as $lainnya) {
                // Pastikan input tambahan tidak kosong
                if (!empty($lainnya)) {
                    NewPemeriksaanLainnya::create([
                        'new_radiologi_request_id' => $newRadiologiRequest->id,
                        'name' => $lainnya,
                        'value' => null,
                    ]);
                }
            }
        }

        //end pemeriksaan lainnya

        $newDataRadiologi = [
            'user_id' => Auth::user()->id,
            'patient_id' => $request->patient_id,
            'queue_id' => $newRadiologiRequest->queue_id,
            'room_detail_id' => $request->room_detail_id,
            'diagnosa_klinis' => $request->diagnosa_klinis,
            'catatan' => $request->catatan,
            'ttd_dokter' => $request->ttd_user,
        ];

        $newRadiologiRequest->update($newDataRadiologi);

        return redirect()
            ->route('rajal/show', ['id' => $id, 'title' => 'Rawat Jalan'])
            ->with([
                'success' => 'Berhasil Diubah',
                'btn' => 'dokter',
                'dokter' => 'radiologi',
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // code baru
        $item = RadiologiFormRequest::find($id);
        $item->radiologiFormRequestDetails()->delete();
        $item->delete();
        return back()
            ->with([
                'success' => 'Berhasil Dihapus',
                'btn' => 'dokter',
                'dokter' => 'radiologi',
            ]);
    }
}
