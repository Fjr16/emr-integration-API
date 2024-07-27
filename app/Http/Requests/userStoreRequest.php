<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'name' => 'required',
            'nik' => 'required|integer|max_digits:16',
            'email' => 'required',
            'gender' => 'required|in:Pria,Wanita',
            'status_kawin' => 'required|in:Single,Menikah,Janda,Duda,Cerai,Dll',
            'jumlah_anak' => 'required|integer',
            'tgl_lahir' => 'required|date',
            'tgl_masuk' => 'required|date',
            'alamat_ktp' => 'required',
            'alamat_domisili' => 'required',
            'pendidikan' => 'required|in:SD,SMP / MTS / SLTP SEDERAJAT,SMA / SMK / SLTA SEDERAJAT,S1,S2,S3',
            'nama_rekening' => 'required',
            'no_rekening' => 'required|integer',
            'staff_id' => 'required|unique:users',
            'unit_id' => 'required',
            'password' => 'required|min_digits:4|max_digits:10',
            // 'isDokter' => 'required|boolean',
            'tanda_tangan' => 'required',
            'telp' => 'required',
            'role_name' => 'required',
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
