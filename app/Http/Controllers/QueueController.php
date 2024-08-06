<?php

namespace App\Http\Controllers;

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
        // $data = Queue::whereIn('status_antrian', ['WAITING', 'CANCEL'])
        $data = Queue::whereDate('tgl_antrian', $today)
            // ->whereDoesntHave('rawatJalanPoliPatient')
            ->orderByRaw("CASE WHEN status_antrian = 'WAITING' THEN 0 
                        WHEN status_antrian = 'ARRIVED' THEN 1 
                        WHEN status_antrian = 'FINISHED' THEN 2 
                        ELSE 3 END")
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
        $dokters = User::where('isDokter', true)->whereHas('poliklinik', function($poli){
            $poli->where('isActive', true);
        })->whereHas('doctorSchedules')->get();

        $patients = Patient::orderBy('no_rm', 'asc')->get();
        $jk = ['Pria', 'Wanita'];
        $status = ['Belum Kawin', 'Kawin', 'Janda', 'Duda'];
        return view('pages.antrian.create', [
            'title' => 'Entri Antrian',
            'menu' => 'Antrian',
            'dokters' => $dokters,
            'categories' => $categories,
            'patients' => $patients,
            'antrians' => $antrians,
            'jk' => $jk,
            'status' => $status,
            'now' => $now,
        ]);
    }

    /**
     * Perlu penambahan request validasi
     */
    public function store(Request $request)
    {
        $item = User::find($request->doctor_id);
        $today = now();
        // $doctors = User::find($request->doctor_id);

        $roomCode = $item->poliklinik->kode_antrian ?? '';
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
            return back()->with('error', 'Mohon Lengkapi Data Master Kode Antrian Dokter Anda !!');
        }
        
        $data['patient_id'] = $request['patient_id'] ?? '';
        $data['user_id'] = Auth::user()->id;
        $data['dokter_id'] = $item->id;
        $data['status_antrian'] = 'WAITING';
        $data['no_antrian'] = $queueNumber;
        $data['tgl_antrian'] = $request['tgl_antrian'];
        $data['patient_category_id'] = $request['patient_category_id'];
        $data['no_rujukan'] = $request['no_rujukan'] ?? null;
        $data['last_diagnostic'] = $request['last_diagnostic'] ?? null;

        $new = Queue::create($data);

        session()->flash('queue_id', $new->id);
        return redirect()->route('antrian.create')->with('success', 'Antrian Berhasil Ditambahkan');
    }

    /**
     * Error ketika jadwal berobat tidak sesuai dengan jadwal dokter
     * Untuk show antrian setelah disubmit dan pada btn lihat
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
    }

    /**
     * DONE , modal konfirmasi sebelum submit
     */
    public function edit(Request $request, $id)
    {
        $item = Patient::findOrFail($id);
        $array = $request->all();
        $data = json_decode(json_encode($array), false);
        $dokter = User::find($request->doctor_id);
        $patient_category = PatientCategory::find($request->patient_category_id);
        return view('pages.antrian.edit', [
            'item' => $item,
            'data' => $data,
            'dokter' => $dokter,
            'patient_category' => $patient_category,
        ]);
    }

    public function getPasien(Request $request)
    {
        $item = Patient::find($request->patient_id);
        return response()->json($item);
    }

    // done untu mendapatkan daftar jadawal dokter 6 kali ke depan
    public function jadwalDokter($dokterId)
    {
        try {
            $item = User::findOrFail($dokterId);
            $data = DoctorsSchedule::where('user_id', $item->id)
                                    ->whereNotNull('day')
                                    ->whereNotNull('start_at')
                                    ->whereNot('start_at', '00:00:00')
                                    ->whereNotNull('ends_at')
                                    ->whereNot('ends_at', '00:00:00')
                                    ->get();

            
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
                        ->where('dokter_id', $item->id)
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
