<?php

namespace App\Http\Controllers;

use App\Http\Requests\userStoreRequest;
use App\Models\User;
use App\Models\RoomDetail;
use App\Models\Specialist;
use Illuminate\Http\Request;
use App\Models\ConsultingRates;
use App\Models\DoctorsSchedule;
use App\Models\PatientCategory;
use App\Models\Poliklinik;
use App\Models\Unit;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function index()
    {
        if (session()->has('navUser')) {
            session(['navUser' => session('navUser')]);
        }else{
            session(['navUser' => 'dokter']);
        }
        $data = User::whereNot('isDokter', true)->get();
        $dataDokter = User::where('isDokter', true)->get();
        $dataRole = Role::all();
        return view('pages.user.index', [
            "title" => "User",
            "menu" => "Setting",
            "data" => $data,
            "dataDokter" => $dataDokter,
            "dataRole" => $dataRole
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $units = Unit::all();
        $role = Role::all();
        $jk = ['Pria', 'Wanita'];
        $stts = ['Single', 'Menikah', 'Janda', 'Duda', 'Cerai', 'Dll'];
        $specialists = Specialist::all();
        $pendidikan = ['SD', 'SMP / MTS / SLTP SEDERAJAT', 'SMA / SMK / SLTA SEDERAJAT', 'S1', 'S2', 'S3'];
        $polikliniks = Poliklinik::where('isActive', true)->get();
        return view('pages.user.create', [
            "title" => "User",
            "menu" => "Setting",
            "role" => $role,
            "units" => $units,
            "jk" => $jk,
            "stts" => $stts,
            "specialists" => $specialists,
            "pendidikan" => $pendidikan,
            "polikliniks" => $polikliniks
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(userStoreRequest $request)
    {
        // get all request
        $data = $request->validated();

        // store ttd dokter
        $folder_path = 'assets/paraf-petugas/';
        Storage::makeDirectory('public/' . $folder_path);
        $ttdImage = base64_decode(str_replace('data:image/png;base64,', '', $request->input('tanda_tangan')));
        $file_name = $folder_path . uniqid() . '.png';
        Storage::put('public/' . $file_name, $ttdImage);
        $data['paraf'] = $file_name;
        //end store ttd 

        if ($data['unit_id'] == 'kosong') {
            $data['unit_id'] = null;
        }
        // untuk dokter
        if ($request->isDokter == true) {
            $data['poliklinik_id'] = $request->poliklinik_id;
            if ($data['poliklinik_id'] == 'kosong') {
                $data['poliklinik_id'] = null;
            }
            $data['tarif'] = $request->tarif;
            $data['sip'] = $request->sip;
            // session tab
            $navTab = 'dokter';
        }else{
            $data['poliklinik_id'] = null;
            $data['tarif'] = null;
            $data['sip'] = null;
        }
        // end untuk dokter

        $data['password'] = Hash::make($request->password);

        if ($new = User::create($data)) {
            $new->assignRole($request->role_name);
            // $role = Role::where('name', $request->role_name)->first();
            // $role->givePermissionTo($request->permission_id);
        }
        if ($request->isDokter == true && !empty($request->specialist_id)) {
            $new->specialists()->sync($request->specialist_id);
        }
        return redirect()->route('user.index')->with([
            'success' => 'User Berhasil Ditambahkan',
            'navUser' => $navTab ?? 'all',
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
        $units = Unit::all();
        $item = User::find($id);
        $role = Role::all();
        $jk = ['Pria', 'Wanita'];
        $stts = ['Single', 'Menikah', 'Janda', 'Duda', 'Cerai', 'Dll'];
        $status = ['AKTIF', 'TIDAK AKTIF'];
        $polikliniks = Poliklinik::where('isActive', true)->get();
        $specialists = Specialist::all();
        $pendidikan = ['SD', 'SMP / MTS / SLTP SEDERAJAT', 'SMA / SMK / SLTA SEDERAJAT', 'S1', 'S2', 'S3'];
        return view('pages.user.edit', [
            "title" => "User",
            "menu" => "Setting",
            "item" => $item,
            "role" => $role,
            "status" => $status,
            "units" => $units,
            "specialists" => $specialists,
            "jk" => $jk,
            "stts" => $stts,
            "polikliniks" => $polikliniks,
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
        if ($data['unit_id'] == 'kosong') {
            $data['unit_id'] = null;
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
        return redirect()->route('user.index')->with([
            'success' => 'User Berhasil Diperbarui',
            'navUser' => 'all',
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
        $item = User::find($id);
        if ($item->delete()) {
            $item->specialists()->detach();
        }
        return redirect()->route('user.index')->with([
            'success' => 'User Berhasil Dihapus',
            'navUser' => 'all',
        ]);
    }
}
