<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\DoctorsSchedule;

class DoctorScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dokters = User::whereNot('room_detail_id', null)
            ->whereHas('roles', function ($query) {
                $query->where('name', 'LIKE', '%' . 'Dokter' . '%');
            })
            ->get();
        $room = Room::where('isActive', true)->where('id', 1)->first();
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        // return $dokters;
        return view('pages.jadwaldokter.index', [
            'title' => 'Jadwal Dokter',
            'menu' => 'Poliklinik',
            'dokters' => $dokters,
            'room' => $room,
            'days' => $days,
        ]);
    }

    public function all()
    {
        $dokters = User::whereNot('room_detail_id', null)
            ->whereHas('roles', function ($query) {
                $query->where('name', 'LIKE', '%' . 'Dokter' . '%');
            })
            ->get();
        $room = Room::where('isActive', true)->where('id', 1)->first();
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        return view('pages.informasijadwaldokter.index', [
            'title' => 'Informasi Jadwal Dokter',
            'menu' => 'Poliklinik',
            'dokters' => $dokters,
            'room' => $room,
            'days' => $days,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $item = new DoctorsSchedule();
        $item->user_id = $id;

        $days = $request->input('days');
        $startTimes = $request->input('start_at');
        $endTimes = $request->input('ends_at');

        foreach ($days as $index => $day) {
            $newItem = new DoctorsSchedule();
            $newItem->user_id = $id;
            $newItem->day = $day;
            $newItem->start_at = $startTimes[$index];
            $newItem->ends_at = $endTimes[$index];
            $newItem->save();
        }

        return back()->with('success', 'Berhasil Di perbarui');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dokters = User::whereNot('room_detail_id', null)
            ->whereHas('roles', function ($query) {
                $query->where('name', 'LIKE', '%' . 'Dokter' . '%');
            })
            ->get();
        $item = User::find($id);
        // return $item->doctorSchedules;
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        $room = Room::where('isActive', true)->where('id', 1)->first();
        return view('pages.jadwaldokter.edit', [
            'title' => 'Jadwal Dokter',
            'menu' => 'Poliklinik',
            'item' => $item,
            'room' => $room,
            'dokters' => $dokters,
            'days' => $days,
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
        $doctorSchedules = DoctorsSchedule::where('user_id', $id)->get();
        foreach ($doctorSchedules as $index => $doctorSchedule) {
            $doctorSchedule->day = $request->input('days')[$index];
            $doctorSchedule->start_at = $request->input('start_at')[$index];
            $doctorSchedule->ends_at = $request->input('ends_at')[$index];
            $doctorSchedule->save();
        }

        // Redirect back with success message
        return back()->with('success', 'Berhasil Di perbarui');
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
}
