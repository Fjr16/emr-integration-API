<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User;
use App\Models\DoctorPoli;
use App\Models\DoctorsSchedule;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\JadwalPraktekRequest;
use App\Models\Poliklinik;

class DoctorScheduleController extends Controller
{
    public function all()
    {
        $dokters = User::where('isDokter', true)->get();
        $polikliniks = Poliklinik::where('isActive', true)->get();
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        return view('pages.informasijadwaldokter.index', [
            'title' => 'Informasi Jadwal Dokter',
            'menu' => 'Poliklinik',
            'dokters' => $dokters,
            'polikliniks' => $polikliniks,
            'days' => $days,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = User::find($id);
        return response()->json($item);
    }

    // new Controller

    public function create($id)
    {
        $item = DoctorPoli::find($id);
        $data = User::where('isDokter', true)->get();
        // $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        return view('pages.jadwalDokter.create', [
            "title" => "Poliklinik",
            "menu" => "Setting",
            "item" => $item,
            "data" => $data,
            // "days" => $days
        ]);
    }

    public function store(JadwalPraktekRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $errors = [];
            $item = DoctorPoli::findOrFail($id);

            // remove all current schedules
            $item->doctorSchedules()->delete();

            $days = $request->input('day', []);
            $startAts = $request->input('start_at', []);
            $endsAts = $request->input('ends_at', []);

            foreach ($days as $key => $day) {
                // untuk check ada atau tidak jadwal yang bentrok di poli yang sama, dengan hari, jam mulai hingga jam selesai yang sama
                $checkAnotherSameItem = DoctorsSchedule::where('doctor_poli_id', $item->id)
                                                    ->where('day', $days[$key])
                                                    ->where('start_at', $startAts[$key])
                                                    ->where('ends_at', $endsAts[$key])
                                                    ->exists();
                if ($checkAnotherSameItem) {
                    $errors[] = 'Data Jadwal Baris ke {' . $key+1 . '} Bentrok';
                }

                DoctorsSchedule::create([
                    'doctor_poli_id' => $item->id,
                    'day' => $day,
                    'start_at' => $startAts[$key],
                    'ends_at' => $endsAts[$key],
                ]);
            }
            if (!empty($errors)) {
                DB::rollBack();
                return back()->with('exceptions', $errors)->withInput();
            }
            DB::commit();
            return redirect()->route('poliklinik.index')->with([
                'success' => 'Jadwal Berhasil ditambahkan',
                'navPoli' => 'jadwal'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage())->withInput();
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage())->withInput();
        }
    }
}
