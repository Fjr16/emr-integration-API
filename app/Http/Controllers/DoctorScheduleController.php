<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DoctorsSchedule;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\JadwalPraktekRequest;

class DoctorScheduleController extends Controller
{
    // new Controller

    public function create($id)
    {
        $item = User::find($id);
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        return view('pages.jadwalDokter.create', [
            "title" => "Poliklinik",
            "menu" => "Poliklinik",
            "item" => $item,
            "days" => $days
        ]);
    }

    public function store(JadwalPraktekRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $errors = [];
            $item = User::findOrFail($id);

            // remove all current schedules
            $item->doctorSchedules()->delete();

            $days = $request->input('day', []);
            $startAts = $request->input('start_at', []);
            $endsAts = $request->input('ends_at', []);

            foreach ($days as $key => $day) {
                // untuk check ada atau tidak jadwal yang bentrok di poli yang sama, dengan hari, jam mulai hingga jam selesai yang sama
                $checkAnotherSameItem = DoctorsSchedule::where('user_id', $item->id)
                                                    ->where('day', $days[$key])
                                                    ->where('start_at', $startAts[$key])
                                                    ->where('ends_at', $endsAts[$key])
                                                    ->exists();
                if ($checkAnotherSameItem) {
                    $errors[] = 'Data Jadwal Baris ke {' . $key+1 . '} Bentrok';
                }

                DoctorsSchedule::create([
                    'user_id' => $item->id,
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
