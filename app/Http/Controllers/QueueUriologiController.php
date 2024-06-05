<?php

namespace App\Http\Controllers;

use App\Models\DoctorPatient;
use App\Models\Patient;
use App\Models\PatientCategory;
use App\Models\Queue;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QueueUriologiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $now = date('Y-m-d');

        $search = request('search', $now);

        $antrians = Queue::where('category', 'UROLOGI')
            ->where(function ($query) use ($search) {
                $query->orWhere('status_antrian', 'like', '%' . $search . '%')
                    ->orWhere('no_antrian', 'like', '%' . $search . '%')
                    ->orWhere('tgl_antrian', 'like', '%' . $search . '%')
                    ->orWhere('no_rujukan', 'like', '%' . $search . '%')
                    ->orWhere('last_diagnostic', 'like', '%' . $search . '%')
                    ->orWhereHas('patient', function ($pasien) use ($search) {
                        $pasien->where('name', 'like', '%' . $search . '%')
                            ->orWhere('no_rm', 'like', '%' . $search . '%')
                            ->orWhere('tanggal_lhr', 'like', '%' . $search . '%')
                            ->orWhere('telp', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('patientCategory', function ($category) use ($search) {
                        $category->where('name', 'like', '%' . $search . '%');
                    });
            })
            ->orderBy('tgl_antrian')
            ->get();

        $categories = PatientCategory::all();
        $doctors = User::where('isDokter', true)->where('room_detail_id', '9')->get();
        $patients = Patient::orderBy('no_rm', 'asc')->get();
        $jk = ['Pria', 'Wanita'];
        $status = ['Belum Kawin', 'Kawin', 'Janda', 'Duda'];
        $kuotas = ['Tersedia', 'Penuh'];
        return view('pages.antrian-urologi.create', [
            "title" => "Entri Antrian Urologi",
            "menu" => "Antrian",
            "doctors" => $doctors,
            "categories" => $categories,
            "patients" => $patients,
            "antrians" => $antrians,
            "jk" => $jk,
            "status" => $status,
            "now" => $now,
            "kuotas" => $kuotas,

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $today = now();
        $lastQueue = Queue::whereDate('created_at', $today)->where('category', 'UROLOGI')->orderBy('no_antrian', 'desc')->first();
        $nextNumber = $lastQueue ? (int) substr($lastQueue->no_antrian, 2) + 1 : 1;

        $data['no_antrian'] = 'FA' . $nextNumber;
        $data['patient_id'] = $request['patient_id'] ?? '';
        $data['patient_category_id'] = $request['patient_category_id'];
        $data['tgl_antrian'] = $request['tgl_antrian'];
        $data['no_rujukan'] = $request['no_rujukan'];
        $data['last_diagnostic'] = $request['last_diagnostic'];
        $data['status_antrian'] = 'WAITING';
        $data['category'] = 'UROLOGI';
        $data['user_id'] = Auth::user()->id;
        $data['kuota'] = $request['kuota'];

        if ($new = Queue::create($data)) {
            $dokterPasien['queue_id'] = $new->id;
            $dokterPasien['user_id'] = $request->doctor_id;
            DoctorPatient::create($dokterPasien);
        }
        return back()->with('success', 'Antrian Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $item = Patient::findOrFail($id);
        $array = $request->all();
        $data = json_decode(json_encode($array), false);
        $dokter = User::find($request->doctor_id);
        $patient_category = PatientCategory::find($request->patient_category_id);
        return view('pages.antrian-urologi.edit', [
            "item" => $item,
            "data" => $data,
            "dokter" => $dokter,
            "patient_category" => $patient_category
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
        //
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
    public function getPasien(Request $request)
    {
        $item = Patient::find($request->patient_id);
        return response()->json($item);
    }
}
