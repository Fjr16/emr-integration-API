<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class userStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $today = Carbon::now();
        return [
            'name' => 'required|max:100',
            'nik' => 'required|integer|max_digits:16',
            'email' => 'required|max:50',
            'ayah' => 'max:50',
            'ibu' => 'max:50',
            'gender' => 'required|in:Pria,Wanita',
            'status_kawin' => 'required|in:Single,Menikah,Janda,Duda,Cerai,Dll|max:20',
            'jumlah_anak' => 'required|integer',
            'tgl_lahir' => 'required|date|before:' . $today,
            'tgl_masuk' => 'required|date|before_or_equal:' . $today,
            'telp' => 'required|max:20',
            'nama_kontak_darurat' => 'max:50',
            'no_kontak_darurat' => 'max:20',
            'alamat_ktp' => 'required',
            'alamat_domisili' => 'required',
            'alamat_kontak_darurat' => 'nullable|string',
            'pendidikan' => 'required|in:SD,SMP / MTS / SLTP SEDERAJAT,SMA / SMK / SLTA SEDERAJAT,S1,S2,S3|max:30',
            'pengalaman' => 'nullable|string',
            'nama_rekening' => 'required|max:30',
            'no_rekening' => 'required|integer',
            'catatan' => 'nullable|string',
            'staff_id' => 'required|unique:users|max:20',
            'unit_id' => 'required|exists:units,id',
            'password' => 'required|min_digits:4|max:10',
            'tanda_tangan' => 'required',
            'role_name' => 'required',
            'isDokter' => 'required|boolean',
            'sip' => 'required_if:isDokter,true',
            'tarif' => 'required_if:isDokter,true',
            'poliklinik_id' => 'required_if:isDokter,true',
            // 'specialist_id' => 'required_if:isDokter,true',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama Tidak Boleh kosong',
            'nik.required' => 'Nik Tidak Boleh kosong',
            'nik.integer' => 'Nik Tidak Valid',
            'nik.max_digits' => 'Nik maksimal Berjumlah 16 digit',
            'email.required' => 'Username Tidak Boleh Kosong',
            'gender.required' => 'Jenis Kelamin Belum Dipilih',
            'gender.in' => 'Jenis Kelamin Tidak Valid',
            'status_kawin.required' => 'Status Kawin Belum Dipilih',
            'status_kawin.in' => 'Status Kawin Tidak Valid',
            'jumlah_anak.required' => 'Jumlah Anak Tidak Boleh Kosong',
            'jumlah_anak.integer' => 'Jumlah Anak Tidak Valid',
            'tgl_lahir.required' => 'Tanggal Lahir Tidak Boleh Kosong',
            'tgl_lahir.date' => 'Tanggal Lahir Tidak Valid, harus berupa tanggal',
            'tgl_masuk.required' => 'Tanggal Gabung Tidak Boleh Kosong',
            'tgl_masuk.date' => 'Tanggal Gabung Tidak Valid, harus berupa tanggal',
            'alamat_ktp.required' => 'Alamat sesuai KTP tidak boleh kosong',
            'alamat_domisili.required' => 'Alamat sesuai Domisili tidak boleh kosong',
            'pendidikan.required' => 'Pendidikan Terakhir Belum Dipilih',
            'pendidikan.in' => 'Pendidikan Terakhir Tidak valid',
            'nama_rekening.required' => 'Nama rekening Tidak Boleh kosong',
            'no_rekening.required' => 'Nomor rekening Tidak Boleh kosong',
            'no_rekening.integer' => 'Nomor rekening Tidak valid',
            'staff_id.required' => 'Staff Id Tidak Boleh Kosong',
            'staff_id.unique' => 'Staff Id Telah digunakan',
            'unit_id.required' => 'Unit atau departemen petugas belum dipilih',
            'password.required' => 'Password Tidak Boleh kosong',
            'password.min_digits' => 'Panjang Password minimal 4 digit',
            'password.max_digits' => 'Panjang Password minimal 10 digit',
            'tanda_tangan.required' => 'Paraf petugas belum ditambahkan',
            'telp.required' => 'Nomor HP/Telpon Tidak Boleh Kosong',
            'role_name.required' => 'Role Petugas belum Dipilih',
            // 'isDokter.required' => 'i',
        ];   
    }
}
