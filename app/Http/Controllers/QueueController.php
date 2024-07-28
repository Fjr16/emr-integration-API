<?php

namespace App\Http\Controllers;

use App\Models\DoctorPoli;
use App\Models\Queue;
use App\Models\DoctorsSchedule;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Models\PatientCategory;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;

class QueueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = date('Y-m-d');
        $data = Queue::where('status_antrian', 'WAITING')
            ->orWhere('status_antrian', 'CANCEL')
            ->whereDate('tgl_antrian', $today)
            ->whereDoesntHave('rawatJalanPoliPatient')
            ->orderByRaw("CASE WHEN status_antrian = 'WAITING' THEN 0 
                        WHEN status_antrian = 'CANCEL' THEN 1 
                        ELSE 2 END")
            ->get();


        return view('pages.antrian.index', [
            'title' => 'Daftar Antrian',
            'menu' => 'Antrian',
            'data' => $data,
        ]);
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

        $antrians = Queue::where(function ($query) use ($search) {
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
        })->orderBy('tgl_antrian')->get();

        $categories = PatientCategory::all();
        // $doctorSchedules = DoctorsSchedule::whereHas('poli', function($query){
        //     $query->where('isActive', true);
        // })->get();
        $doctorPolis = DoctorPoli::where('isActive', true)->whereHas('doctorSchedules')->get();
        $patients = Patient::orderBy('no_rm', 'asc')->get();
        $jk = ['Pria', 'Wanita'];
        $status = ['Belum Kawin', 'Kawin', 'Janda', 'Duda'];
        return view('pages.antrian.create', [
            'title' => 'Entri Antrian',
            'menu' => 'Antrian',
            'doctorPolis' => $doctorPolis,
            'categories' => $categories,
            'patients' => $patients,
            'antrians' => $antrians,
            'jk' => $jk,
            'status' => $status,
            'now' => $now,
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
        dd($request->all());
        $item = DoctorPoli::find($request->doctor_poli_id);
        $today = now();
        $doctors = User::find($request->doctor_id);

        $roomCode = $item->poli->kode_antrian ?? '';
        if ($roomCode) {
            $lastQueue = Queue::whereDate('created_at', $today)
                ->where('no_antrian', 'like', $roomCode . '%')
                ->orderBy('no_antrian', 'desc')
                ->first();
            // mengambil antrian terakhir yang awalannya A
            $nextNumber = $lastQueue ? (int) substr($lastQueue->no_antrian, 1) + 1 : 1;
            // Format nomor antrian sesuai aturan
            $queueNumber = $roomCode . ($nextNumber <= 9 ? sprintf('%02d', $nextNumber) : $nextNumber);
        }else{
            return back()->with('error', 'Mohon Lengkapi Data Master kode Dokter Anda !!');
        }
        
        $data['no_antrian'] = $queueNumber;
        $data['patient_id'] = $request['patient_id'] ?? '';
        $data['patient_category_id'] = $request['patient_category_id'];
        // $data['dokter_id'] = $item->user_id;
        // $data['poliklinik_id'] = $item->poliklinik_id;
        $data['dokter_poli_id'] = $item->id;
        $data['tgl_antrian'] = $request['tgl_antrian'];
        $data['no_rujukan'] = $request['no_rujukan'];
        $data['last_diagnostic'] = $request['last_diagnostic'];
        $data['status_antrian'] = 'WAITING';
        $data['user_id'] = Auth::user()->id;
        $data['kuota'] = $request['kuota'];

        $new = Queue::create($data);

        session()->flash('queue_id', $new->id);
        return redirect()->route('antrian.create')->with('success', 'Antrian Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Queue::find($id);
        $tgl_berobat = Carbon::parse($item->tgl_antrian);
        $jadwalDokterPilih = $item->dpjp->doctorSchedules->where('day', $tgl_berobat->locale('id')->dayName)->first();
        $jamKedatangan = Carbon::createFromTimeString($jadwalDokterPilih->start_at)->subHour();
        $jamAwal = Carbon::createFromTimeString($jadwalDokterPilih->start_at);
        $jamAkhir = Carbon::createFromTimeString($jadwalDokterPilih->ends_at);
        return view('pages.antrian.show', [
            'item' => $item,
            'tgl_berobat' => $tgl_berobat,
            'jadwalDokterPilih' => $jadwalDokterPilih,
            'jamKedatangan' => $jamKedatangan,
            'jamAwal' => $jamAwal,
            'jamAkhir' => $jamAkhir,
        ]);
        // return response()->json($item);
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
        $dokterPoli = DoctorPoli::find($request->doctor_poli_id);
        $patient_category = PatientCategory::find($request->patient_category_id);
        return view('pages.antrian.edit', [
            'item' => $item,
            'data' => $data,
            'dokterPoli' => $dokterPoli,
            'patient_category' => $patient_category,
        ]);
    }

    public function getPasien(Request $request)
    {
        $item = Patient::find($request->patient_id);
        return response()->json($item);
    }

    public function jadwalDokter($dokterPoliId)
    {
        try {
            $item = DoctorPoli::findOrFail($dokterPoliId);
            $data = DoctorsSchedule::where('doctor_poli_id', $item->id)->get();

            
            if ($data->isEmpty()) {
                return response()->json([
                    'message' => 'Jadwal Tidak Ditemukan',
                ], 404);
            }

            $repeatedData = [];
    
            $dayMapping = [
                'Senin' => 'Monday',
                'Selasa' => 'Tuesday',
                'Rabu' => 'Wednesday',
                'Kamis' => 'Thursday',
                'Jumat' => 'Friday',
                'Sabtu' => 'Saturday',
                'Minggu' => 'Sunday'
            ];
    
            $currentDate = Carbon::now(); // Inisialisasi tanggal saat ini di luar loop
    
            while (count($repeatedData) < 6) {
                foreach ($data as $entry) {
                    
                    if (count($repeatedData) < 6) {
                        $desiredDay = isset($dayMapping[$entry->day]) ? $dayMapping[$entry->day] : $entry->day;
                        
                        // Set tanggal saat ini ke hari pertama dalam minggu berikutnya yang sesuai dengan harinya
                        while ($currentDate->format('l') !== $desiredDay) {
                            $currentDate->addDay();
                        }
                        
                        $date = $currentDate->copy()->toDateString();
                        
                        // Tambahkan satu hari ke tanggal saat ini
                        $currentDate->addDay();
    
    
                        $totalAntrian = Queue::whereIn('status_antrian', ['WAITING', 'ARRIVED', 'FINISHED'])
                        ->whereDate('tgl_antrian', $date)
                        ->where('dokter_id', $item->user->id)
                        ->count();
    
                        // respon data
                        $repeatedData[] = [
                            'created_at' => $date,
                            'ends_at' => $entry->ends_at,
                            'day' => $entry->day,
                            'totalAntrian' => $totalAntrian ?? 0
                        ];
                    } else {
                        break;
                    }
                }
            }
    
            return response()->json($repeatedData);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Terjadi Kesalahan Saat Mencari Data Jadwal',
            ], 500);
        }

    }
}
