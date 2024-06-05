<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use App\Models\User;
use App\Models\RoomDetail;
use App\Models\Specialist;
use App\Models\UnitCategory;
use Illuminate\Http\Request;
use App\Models\ConsultingRates;
use App\Models\DoctorsSchedule;
use App\Models\PatientCategory;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::all();
        return view('pages.user.index', [
            "title" => "User",
            "menu" => "Setting",
            "data" => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unitCategories = UnitCategory::all();
        $role = Role::all();
        $polis = RoomDetail::where('room_id', 1)->get();
        $jk = ['Pria', 'Wanita'];
        $stts = ['Single', 'Menikah', 'Janda', 'Duda', 'Cerai', 'Dll'];
        $specialists = Specialist::all();
        $pendidikan = ['SD', 'SMP / MTS / SLTP SEDERAJAT', 'SMA / SMK / SLTA SEDERAJAT', 'S1', 'S2', 'S3'];
        return view('pages.user.create', [
            "title" => "User",
            "menu" => "Setting",
            "role" => $role,
            "polis" => $polis,
            "unitCategories" => $unitCategories,
            "jk" => $jk,
            "stts" => $stts,
            "specialists" => $specialists,
            "pendidikan" => $pendidikan
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
        $data = $request->all();

        $folder_path = 'assets/paraf-petugas/';
        Storage::makeDirectory('public/' . $folder_path);

        $ttdImage = base64_decode(str_replace('data:image/png;base64,', '', $request->input('tanda_tangan')));
        $file_name = $folder_path . uniqid() . '.png';
        Storage::put('public/' . $file_name, $ttdImage);
        $data['paraf'] = $file_name;

        if ($data['unit_category_id'] == 'kosong') {
            $data['unit_category_id'] = null;
        }
        $data['password'] = Hash::make($request->password);
        if ($data['room_detail_id'] == 'kosong') {
            $data['room_detail_id'] = null;
        }
        if ($new = User::create($data)) {
            $new->assignRole($request->role_name);
            // $role = Role::where('name', $request->role_name)->first();
            // $role->givePermissionTo($request->permission_id);
        }
        if (preg_match('/Dokter/i', $new->roles->first()->name)) {
            $new->specialists()->sync($request->specialist_id);
            if ($new->room_detail_id) {
                $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                foreach ($days as $day) {
                    $jadwal['user_id'] = $new->id;
                    $jadwal['day'] = $day;
                    DoctorsSchedule::create($jadwal);
                }
            }
            if ($new->consultingRates->isEmpty()) {
                $dataTanggungan = PatientCategory::all();
                foreach ($dataTanggungan as $itemTanggungan) {
                    ConsultingRates::create([
                        'user_id' => $new->id,
                        'patient_category_id' => $itemTanggungan->id,
                    ]);
                }
            }
        }
        return redirect()->route('user.index')->with('success', 'User Berhasil Ditambahkan');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unitCategories = UnitCategory::all();
        $item = User::find($id);
        $role = Role::all();
        $jk = ['Pria', 'Wanita'];
        $stts = ['Single', 'Menikah', 'Janda', 'Duda', 'Cerai', 'Dll'];
        $status = ['AKTIF', 'OFF'];
        $polis = RoomDetail::where('room_id', 1)->get();
        $specialists = Specialist::all();
        $pendidikan = ['SD', 'SMP / MTS / SLTP SEDERAJAT', 'SMA / SMK / SLTA SEDERAJAT', 'S1', 'S2', 'S3'];
        return view('pages.user.edit', [
            "title" => "User",
            "menu" => "Setting",
            "item" => $item,
            "role" => $role,
            "status" => $status,
            "unitCategories" => $unitCategories,
            "specialists" => $specialists,
            "jk" => $jk,
            "stts" => $stts,
            "polis" => $polis,
            "pendidikan" => $pendidikan,
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
        $item = User::find($id);
        $data = $request->all();
        if ($data['password'] == null) {
            $data['password'] = $item['password'];
        } else {
            $data['password'] = Hash::make($request->password);
        }
        if ($data['unit_category_id'] == 'kosong') {
            $data['unit_category_id'] = null;
        }
        if ($data['room_detail_id'] == 'kosong') {
            $data['room_detail_id'] = null;
        }


        if ($request->input('tanda_tangan')) {
            $ttdImage = base64_decode(str_replace('data:image/png;base64,', '', $request->input('tanda_tangan')));

            $folder_path = 'assets/paraf-petugas/';
            $file_name = $folder_path . uniqid() . '.png';
            Storage::makeDirectory('public/', $folder_path);
            Storage::put('public/' . $file_name, $ttdImage);

            $ttdImage = base64_decode(str_replace('data:image/png;base64,', '', $request->input('tanda_tangan')));
            $file_name = $folder_path . uniqid() . '.png';
            Storage::put('public/' . $file_name, $ttdImage);
            $data['paraf'] = $file_name;
        }

        if ($item->update($data)) {
            $item->syncRoles($request->role_name);

            if (preg_match('/Dokter/i', $item->roles->first()->name)) {
                $item->specialists()->sync($request->specialist_id);
                $checkSchedules = $item->doctorSchedules()->count();
                if ($item->room_detail_id && $checkSchedules == 0) {
                    $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                    foreach ($days as $day) {
                        $jadwal['user_id'] = $item->id;
                        $jadwal['day'] = $day;
                        DoctorsSchedule::create($jadwal);
                    }
                }
                if ($item->consultingRates->isEmpty()) {
                    $dataTanggungan = PatientCategory::all();
                    foreach ($dataTanggungan as $itemTanggungan) {
                        ConsultingRates::create([
                            'user_id' => $item->id,
                            'patient_category_id' => $itemTanggungan->id,
                        ]);
                    }
                }
            } else {
                $item->specialists()->detach();
            }
        }
        return redirect()->route('user.index')->with('success', 'User Berhasil di Perbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = User::find($id);
        if ($item->delete()) {
            $item->specialists()->detach();
        }
        return redirect()->route('user.index')->with('success', 'User Berhasil di Hapus');
    }
}
