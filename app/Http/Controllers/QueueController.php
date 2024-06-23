<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use App\Models\DoctorPatient;
use App\Models\DoctorsSchedule;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Models\PatientCategory;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;

use function Pest\Laravel\json;

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
        $data = Queue::where('status_antrian', 'CHECKIN')
            ->orWhere('status_antrian', 'DIPANGGIL')
            ->orWhere('status_antrian', 'TIDAK HADIR')
            ->orWhere('status_antrian', 'BATAL')
            ->whereDate('tgl_antrian', $today)
            ->whereDoesntHave('rawatJalanPatient')
            // ->orderByRaw("CASE WHEN category = 'UROLOGI' THEN 0 ELSE 1 END")
            ->orderByRaw("CASE WHEN status_antrian = 'DIPANGGIL' THEN 0 
                        WHEN status_antrian = 'CHECKIN' THEN 1 
                        ELSE 2 END")
            ->get();

        // dd($data);

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
        })
            ->orderBy('tgl_antrian')
            ->get();

        $categories = PatientCategory::all();
        // $doctors = User::where('isDokter', true)/*->whereHas('roles', function($query){
        //     $query->where('name', 'LIKE','%'. 'Dokter' .'%');
        // })*/->get();
        $doctors = User::where('isDokter', true)->whereHas('specialists')->get();
        // return $doctors;
        $patients = Patient::orderBy('no_rm', 'asc')->get();
        $jk = ['Pria', 'Wanita'];
        $status = ['Belum Kawin', 'Kawin', 'Janda', 'Duda'];
        $kuotas = ['Tersedia', 'Penuh'];
        return view('pages.antrian.create', [
            'title' => 'Entri Antrian',
            'menu' => 'Antrian',
            'doctors' => $doctors,
            'categories' => $categories,
            'patients' => $patients,
            'antrians' => $antrians,
            'jk' => $jk,
            'status' => $status,
            'now' => $now,
            'kuotas' => $kuotas,
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
        $doctors = User::find($request->doctor_id);


        // cek apakah dia adalah pasien baru
        $patient = Patient::where('id', $request->patient_id)->first();
        if ($patient && $patient->created_at->toDateString() == $today->toDateString()) {
            if ($doctors->roomDetail->kode_dokter_poli == 'I') {
                $lastQueue = Queue::whereDate('created_at', $today)
                    ->where('category', 'NON UROLOGI')
                    ->where('no_antrian', 'like', 'I%')
                    ->orderBy('no_antrian', 'desc')
                    ->first(); // jika dia adalah pasien urologi maka antrian dari 1-10
                $nextNumber = $lastQueue ? (int) substr($lastQueue->no_antrian, 1) + 1 : 1;
                if ($nextNumber >= 10) {
                    // cek dulu antrian terakhir dari urologi
                    $lastQueue = Queue::whereDate('created_at', $today)
                        ->where('category', 'UROLOGI')
                        ->where('no_antrian', 'like', 'I%')
                        ->orderBy('no_antrian', 'desc')
                        ->first();
                    $nextNumber = $lastQueue ? (int) substr($lastQueue->no_antrian, 1) + 1 : 1;
                }
                $category = 'UROLOGI';
                $data['no_antrian'] = 'I' . $nextNumber;
            } else {
                if ($doctors->roomDetail->kode_dokter_poli == 'A') {
                    $roomCode = $doctors->roomDetail->kode_dokter_poli;
                    $lastQueue = Queue::whereDate('created_at', $today)
                        ->where('category', 'NON UROLOGI')
                        ->where('no_antrian', 'like', $roomCode . '%')
                        ->orderBy('no_antrian', 'desc')
                        ->first();
                    // mengambil antrian terakhir yang awalannya A
                    $nextNumber = $lastQueue ? (int) substr($lastQueue->no_antrian, 1) + 1 : 1;
                    // Format nomor antrian sesuai aturan
                    $queueNumber = $roomCode . ($nextNumber <= 9 ? sprintf('%02d', $nextNumber) : $nextNumber);
                    $data['no_antrian'] = $queueNumber;


                    // jika dia adalah poli Jantung
                } elseif ($doctors->roomDetail->kode_dokter_poli == 'B') {
                    $roomCode = $doctors->roomDetail->kode_dokter_poli;
                    $lastQueue = Queue::whereDate('created_at', $today)
                        ->where('category', 'NON UROLOGI')
                        ->where('no_antrian', 'like', $roomCode . '%')
                        ->orderBy('no_antrian', 'desc')
                        ->first();
                    // mengambil antrian terakhir yang awalannya A
                    $nextNumber = $lastQueue ? (int) substr($lastQueue->no_antrian, 1) + 1 : 1;
                    // Format nomor antrian sesuai aturan
                    $queueNumber = $roomCode . ($nextNumber <= 9 ? sprintf('%02d', $nextNumber) : $nextNumber);
                    $data['no_antrian'] = $queueNumber;
                    // jika dia adalahh poli penyakit dalam
                } elseif ($doctors->roomDetail->kode_dokter_poli == 'C') {
                    $roomCode = $doctors->roomDetail->kode_dokter_poli;
                    $lastQueue = Queue::whereDate('created_at', $today)
                        ->where('category', 'NON UROLOGI')
                        ->where('no_antrian', 'like', $roomCode . '%')
                        ->orderBy('no_antrian', 'desc')
                        ->first();
                    // mengambil antrian terakhir yang awalannya A
                    $nextNumber = $lastQueue ? (int) substr($lastQueue->no_antrian, 1) + 1 : 1;
                    // Format nomor antrian sesuai aturan
                    $queueNumber = $roomCode . ($nextNumber <= 9 ? sprintf('%02d', $nextNumber) : $nextNumber);
                    $data['no_antrian'] = $queueNumber;

                    // jika dia adalah poli Penyakit Dalam
                } elseif ($doctors->roomDetail->kode_dokter_poli == 'D') {
                    $roomCode = $doctors->roomDetail->kode_dokter_poli;
                    $lastQueue = Queue::whereDate('created_at', $today)
                        ->where('category', 'NON UROLOGI')
                        ->where('no_antrian', 'like', $roomCode . '%')
                        ->orderBy('no_antrian', 'desc')
                        ->first();
                    // mengambil antrian terakhir yang awalannya A
                    $nextNumber = $lastQueue ? (int) substr($lastQueue->no_antrian, 1) + 1 : 1;
                    // Format nomor antrian sesuai aturan
                    $queueNumber = $roomCode . ($nextNumber <= 9 ? sprintf('%02d', $nextNumber) : $nextNumber);
                    $data['no_antrian'] = $queueNumber;
                    // jika dia adalah poli onkologi
                } elseif ($doctors->roomDetail->kode_dokter_poli == 'E') {
                    $roomCode = $doctors->roomDetail->kode_dokter_poli;
                    $lastQueue = Queue::whereDate('created_at', $today)
                        ->where('category', 'NON UROLOGI')
                        ->where('no_antrian', 'like', $roomCode . '%')
                        ->orderBy('no_antrian', 'desc')
                        ->first();
                    // mengambil antrian terakhir yang awalannya A
                    $nextNumber = $lastQueue ? (int) substr($lastQueue->no_antrian, 1) + 1 : 1;
                    // Format nomor antrian sesuai aturan
                    $queueNumber = $roomCode . ($nextNumber <= 9 ? sprintf('%02d', $nextNumber) : $nextNumber);
                    $data['no_antrian'] = $queueNumber;

                    // jika dia poli PenyakitDalam
                } elseif ($doctors->roomDetail->kode_dokter_poli == 'F') {
                    $roomCode = $doctors->roomDetail->kode_dokter_poli;
                    $lastQueue = Queue::whereDate('created_at', $today)
                        ->where('category', 'NON UROLOGI')
                        ->where('no_antrian', 'like', $roomCode . '%')
                        ->orderBy('no_antrian', 'desc')
                        ->first();
                    // mengambil antrian terakhir yang awalannya A
                    $nextNumber = $lastQueue ? (int) substr($lastQueue->no_antrian, 1) + 1 : 1;
                    // Format nomor antrian sesuai aturan
                    $queueNumber = $roomCode . ($nextNumber <= 9 ? sprintf('%02d', $nextNumber) : $nextNumber);
                    $data['no_antrian'] = $queueNumber;

                    // jika dia adalah poli Orthopedi
                } elseif ($doctors->roomDetail->kode_dokter_poli == 'G') {
                    $roomCode = $doctors->roomDetail->kode_dokter_poli;
                    $lastQueue = Queue::whereDate('created_at', $today)
                        ->where('category', 'NON UROLOGI')
                        ->where('no_antrian', 'like', $roomCode . '%')
                        ->orderBy('no_antrian', 'desc')
                        ->first();
                    // mengambil antrian terakhir yang awalannya A
                    $nextNumber = $lastQueue ? (int) substr($lastQueue->no_antrian, 1) + 1 : 1;
                    // Format nomor antrian sesuai aturan
                    $queueNumber = $roomCode . ($nextNumber <= 9 ? sprintf('%02d', $nextNumber) : $nextNumber);
                    $data['no_antrian'] = $queueNumber;

                    // jika dia adalah poli beda umum
                } elseif ($doctors->roomDetail->kode_dokter_poli == 'H') {
                    $roomCode = $doctors->roomDetail->kode_dokter_poli;
                    $lastQueue = Queue::whereDate('created_at', $today)
                        ->where('category', 'NON UROLOGI')
                        ->where('no_antrian', 'like', $roomCode . '%')
                        ->orderBy('no_antrian', 'desc')
                        ->first();
                    // mengambil antrian terakhir yang awalannya A
                    $nextNumber = $lastQueue ? (int) substr($lastQueue->no_antrian, 1) + 1 : 1;
                    // Format nomor antrian sesuai aturan
                    $queueNumber = $roomCode . ($nextNumber <= 9 ? sprintf('%02d', $nextNumber) : $nextNumber);
                    $data['no_antrian'] = $queueNumber;

                    // jika dia adalah poli Orthopedi
                } elseif ($doctors->roomDetail->kode_dokter_poli == 'J') {
                    $roomCode = $doctors->roomDetail->kode_dokter_poli;
                    $lastQueue = Queue::whereDate('created_at', $today)
                        ->where('category', 'NON UROLOGI')
                        ->where('no_antrian', 'like', $roomCode . '%')
                        ->orderBy('no_antrian', 'desc')
                        ->first();
                    // mengambil antrian terakhir yang awalannya A
                    $nextNumber = $lastQueue ? (int) substr($lastQueue->no_antrian, 1) + 1 : 1;
                    // Format nomor antrian sesuai aturan
                    $queueNumber = $roomCode . ($nextNumber <= 9 ? sprintf('%02d', $nextNumber) : $nextNumber);
                    $data['no_antrian'] = $queueNumber;

                    // jika dia adalah poli Bedah Umum
                } elseif ($doctors->roomDetail->kode_dokter_poli == 'K') {
                    $roomCode = $doctors->roomDetail->kode_dokter_poli;
                    $lastQueue = Queue::whereDate('created_at', $today)
                        ->where('category', 'NON UROLOGI')
                        ->where('no_antrian', 'like', $roomCode . '%')
                        ->orderBy('no_antrian', 'desc')
                        ->first();
                    // mengambil antrian terakhir yang awalannya A
                    $nextNumber = $lastQueue ? (int) substr($lastQueue->no_antrian, 1) + 1 : 1;
                    // Format nomor antrian sesuai aturan
                    $queueNumber = $roomCode . ($nextNumber <= 9 ? sprintf('%02d', $nextNumber) : $nextNumber);
                    $data['no_antrian'] = $queueNumber;
                }
                $category = 'NON UROLOGI';
            }


            // jika bukan pasien baru
        } else {
            // jika dia adalah poli THT
            // dd($doctors->roomDetail);
            // die;
            if ($doctors->roomDetail->kode_dokter_poli == 'A') {
                $roomCode = $doctors->roomDetail->kode_dokter_poli;
                $lastQueue = Queue::whereDate('created_at', $today)
                    ->where('category', 'NON UROLOGI')
                    ->where('no_antrian', 'like', $roomCode . '%')
                    ->orderBy('no_antrian', 'desc')
                    ->first();
                // mengambil antrian terakhir yang awalannya A
                $nextNumber = $lastQueue ? (int) substr($lastQueue->no_antrian, 1) + 1 : 1;
                // Format nomor antrian sesuai aturan
                $queueNumber = $roomCode . ($nextNumber <= 9 ? sprintf('%02d', $nextNumber) : $nextNumber);
                $data['no_antrian'] = $queueNumber;
                // jika dia adalah poli Jantung
            } elseif ($doctors->roomDetail->kode_dokter_poli == 'B') {
                $roomCode = $doctors->roomDetail->kode_dokter_poli;
                $lastQueue = Queue::whereDate('created_at', $today)
                    ->where('category', 'NON UROLOGI')
                    ->where('no_antrian', 'like', $roomCode . '%')
                    ->orderBy('no_antrian', 'desc')
                    ->first();
                // mengambil antrian terakhir yang awalannya A
                $nextNumber = $lastQueue ? (int) substr($lastQueue->no_antrian, 1) + 1 : 1;
                // Format nomor antrian sesuai aturan
                $queueNumber = $roomCode . ($nextNumber <= 9 ? sprintf('%02d', $nextNumber) : $nextNumber);
                $data['no_antrian'] = $queueNumber;

                // jika dia adalahh poli penyakit dalam
            } elseif ($doctors->roomDetail->kode_dokter_poli == 'C') {
                $roomCode = $doctors->roomDetail->kode_dokter_poli;
                $lastQueue = Queue::whereDate('created_at', $today)
                    ->where('category', 'NON UROLOGI')
                    ->where('no_antrian', 'like', $roomCode . '%')
                    ->orderBy('no_antrian', 'desc')
                    ->first();
                // mengambil antrian terakhir yang awalannya A
                $nextNumber = $lastQueue ? (int) substr($lastQueue->no_antrian, 1) + 1 : 1;
                // Format nomor antrian sesuai aturan
                $queueNumber = $roomCode . ($nextNumber <= 9 ? sprintf('%02d', $nextNumber) : $nextNumber);
                $data['no_antrian'] = $queueNumber;

                // jika dia adalah poli Penyakit Dalam
            } elseif ($doctors->roomDetail->kode_dokter_poli == 'D') {
                $roomCode = $doctors->roomDetail->kode_dokter_poli;
                $lastQueue = Queue::whereDate('created_at', $today)
                    ->where('category', 'NON UROLOGI')
                    ->where('no_antrian', 'like', $roomCode . '%')
                    ->orderBy('no_antrian', 'desc')
                    ->first();
                // mengambil antrian terakhir yang awalannya A
                $nextNumber = $lastQueue ? (int) substr($lastQueue->no_antrian, 1) + 1 : 1;
                // Format nomor antrian sesuai aturan
                $queueNumber = $roomCode . ($nextNumber <= 9 ? sprintf('%02d', $nextNumber) : $nextNumber);
                $data['no_antrian'] = $queueNumber;

                // jika dia adalah poli onkologi
            } elseif ($doctors->roomDetail->kode_dokter_poli == 'E') {
                $roomCode = $doctors->roomDetail->kode_dokter_poli;
                $lastQueue = Queue::whereDate('created_at', $today)
                    ->where('category', 'NON UROLOGI')
                    ->where('no_antrian', 'like', $roomCode . '%')
                    ->orderBy('no_antrian', 'desc')
                    ->first();
                // mengambil antrian terakhir yang awalannya A
                $nextNumber = $lastQueue ? (int) substr($lastQueue->no_antrian, 1) + 1 : 1;
                // Format nomor antrian sesuai aturan
                $queueNumber = $roomCode . ($nextNumber <= 9 ? sprintf('%02d', $nextNumber) : $nextNumber);
                $data['no_antrian'] = $queueNumber;

                // jika dia poli PenyakitDalam
            } elseif ($doctors->roomDetail->kode_dokter_poli == 'F') {
                $roomCode = $doctors->roomDetail->kode_dokter_poli;
                $lastQueue = Queue::whereDate('created_at', $today)
                    ->where('category', 'NON UROLOGI')
                    ->where('no_antrian', 'like', $roomCode . '%')
                    ->orderBy('no_antrian', 'desc')
                    ->first();
                // mengambil antrian terakhir yang awalannya A
                $nextNumber = $lastQueue ? (int) substr($lastQueue->no_antrian, 1) + 1 : 1;
                // Format nomor antrian sesuai aturan
                $queueNumber = $roomCode . ($nextNumber <= 9 ? sprintf('%02d', $nextNumber) : $nextNumber);
                $data['no_antrian'] = $queueNumber;

                // jika dia adalah poli Orthopedi
            } elseif ($doctors->roomDetail->kode_dokter_poli == 'G') {
                $roomCode = $doctors->roomDetail->kode_dokter_poli;
                $lastQueue = Queue::whereDate('created_at', $today)
                    ->where('category', 'NON UROLOGI')
                    ->where('no_antrian', 'like', $roomCode . '%')
                    ->orderBy('no_antrian', 'desc')
                    ->first();
                // mengambil antrian terakhir yang awalannya A
                $nextNumber = $lastQueue ? (int) substr($lastQueue->no_antrian, 1) + 1 : 1;
                // Format nomor antrian sesuai aturan
                $queueNumber = $roomCode . ($nextNumber <= 9 ? sprintf('%02d', $nextNumber) : $nextNumber);
                $data['no_antrian'] = $queueNumber;

                // jika dia adalah poli beda umum
            } elseif ($doctors->roomDetail->kode_dokter_poli == 'H') {
                // jika dia adalah poli THT
                $roomCode = $doctors->roomDetail->kode_dokter_poli;
                $lastQueue = Queue::whereDate('created_at', $today)
                    ->where('category', 'NON UROLOGI')
                    ->where('no_antrian', 'like', $roomCode . '%')
                    ->orderBy('no_antrian', 'desc')
                    ->first();
                // mengambil antrian terakhir yang awalannya A
                $nextNumber = $lastQueue ? (int) substr($lastQueue->no_antrian, 1) + 1 : 1;
                // Format nomor antrian sesuai aturan
                $queueNumber = $roomCode . ($nextNumber <= 9 ? sprintf('%02d', $nextNumber) : $nextNumber);
                $data['no_antrian'] = $queueNumber;

                // jika dia adalah poli urologi
            } elseif ($doctors->roomDetail->kode_dokter_poli == 'I') {
                $roomCode = $doctors->roomDetail->kode_dokter_poli;
                $lastQueue = Queue::whereDate('created_at', $today)
                    ->where('category', 'NON UROLOGI')
                    ->where('no_antrian', 'like', $roomCode . '%')
                    ->orderBy('no_antrian', 'desc')
                    ->first();
                // mengambil antrian terakhir yang awalannya A
                $nextNumber = $lastQueue ? (int) substr($lastQueue->no_antrian, 1) + 1 : 1;
                // Format nomor antrian sesuai aturan
                $queueNumber = $roomCode . ($nextNumber <= 9 ? sprintf('%02d', $nextNumber) : $nextNumber);
                $data['no_antrian'] = $queueNumber;

                // jika dia adalah poli Orthopedi
            } elseif ($doctors->roomDetail->kode_dokter_poli == 'J') {
                $roomCode = $doctors->roomDetail->kode_dokter_poli;
                $lastQueue = Queue::whereDate('created_at', $today)
                    ->where('category', 'NON UROLOGI')
                    ->where('no_antrian', 'like', $roomCode . '%')
                    ->orderBy('no_antrian', 'desc')
                    ->first();
                // mengambil antrian terakhir yang awalannya A
                $nextNumber = $lastQueue ? (int) substr($lastQueue->no_antrian, 1) + 1 : 1;
                // Format nomor antrian sesuai aturan
                $queueNumber = $roomCode . ($nextNumber <= 9 ? sprintf('%02d', $nextNumber) : $nextNumber);
                $data['no_antrian'] = $queueNumber;

                // jika dia adalah poli Bedah Umum
            } elseif ($doctors->roomDetail->kode_dokter_poli == 'K') {
                $roomCode = $doctors->roomDetail->kode_dokter_poli;
                $lastQueue = Queue::whereDate('created_at', $today)
                    ->where('category', 'NON UROLOGI')
                    ->where('no_antrian', 'like', $roomCode . '%')
                    ->orderBy('no_antrian', 'desc')
                    ->first();
                // mengambil antrian terakhir yang awalannya A
                $nextNumber = $lastQueue ? (int) substr($lastQueue->no_antrian, 1) + 1 : 1;
                // Format nomor antrian sesuai aturan
                $queueNumber = $roomCode . ($nextNumber <= 9 ? sprintf('%02d', $nextNumber) : $nextNumber);
                $data['no_antrian'] = $queueNumber;
            }
            $category = 'NON UROLOGI';
        }

        $data['patient_id'] = $request['patient_id'] ?? '';
        $data['patient_category_id'] = $request['patient_category_id'];
        $data['tgl_antrian'] = $request['tgl_antrian'];
        $data['no_rujukan'] = $request['no_rujukan'];
        $data['last_diagnostic'] = $request['last_diagnostic'];
        $data['status_antrian'] = 'WAITING';
        $data['category'] = $category;
        $data['user_id'] = Auth::user()->id;
        $data['kuota'] = $request['kuota'];

        if ($new = Queue::create($data)) {
            $dokterPasien['queue_id'] = $new->id;
            $dokterPasien['user_id'] = $request->doctor_id;
            DoctorPatient::create($dokterPasien);
        }

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
        $jadwalDokterPilih = $item->doctorPatient->user->doctorSchedules->where('day', $tgl_berobat->locale('id')->dayName)->first();
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
        $dokter = User::find($request->doctor_id);
        $patient_category = PatientCategory::find($request->patient_category_id);
        return view('pages.antrian.edit', [
            'item' => $item,
            'data' => $data,
            'dokter' => $dokter,
            'patient_category' => $patient_category,
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
        $item = Queue::find($id);
        $item->delete();

        return redirect()->route('antrian.index')->with('success', 'Antrian Berhasil Dihapus');
    }

    public function getPasien(Request $request)
    {
        $item = Patient::find($request->patient_id);
        return response()->json($item);
    }

    public function jadwalDokter($dokterID)
    {
        
        try {
            $data = DoctorsSchedule::where('user_id', $dokterID)
                ->whereNotNull('start_at')->orWhereNot('start_at', '00:00:00')
                ->whereNotNull('ends_at')->orWhereNot('ends_at', '00:00:00')
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
    
    
                        $totalAntrian = Queue::where('status_antrian', 'WAITING')->whereDate('tgl_antrian', $date)->whereHas('doctorPatient', function ($query) use ($dokterID) {
                            $query->where('user_id', $dokterID);
                        })->count();
    
                        // respon data
                        $repeatedData[] = [
                            'created_at' => $date,
                            'ends_at' => $entry->ends_at,
                            'day' => $entry->day,
                            'totalAntrian' => $totalAntrian
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
