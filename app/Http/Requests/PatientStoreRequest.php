<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class PatientStoreRequest extends FormRequest
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
            'job_id' => 'nullable|exists:jobs,id',
            'province_id' => 'required',
            'city_id' => 'required',
            'district_id' => 'required',
            'village_id' => 'required',
            'noka' => 'nullable|unique:patients',
            'name' => 'required|max:50',
            'tempat_lhr' => 'required|max:100',
            'tanggal_lhr' => 'required|date|before:' . $today,
            'jenis_kelamin' => 'required|in:Pria,Wanita',
            'telp' => 'required|max:20',
            'agama' => 'nullable|max:20',
            'alamat' => 'nullable|string',
            'rw' => 'nullable',
            'rt' => 'nullable',
            'pendidikan' => 'nullable|in:TIDAK SEKOLAH,PAUD,TK,SD,SMP / MTS / SLTP SEDERAJAT,SMA / SMK / SLTA SEDERAJAT,D2,D3,S1,S2,S3|max:30',
            'status' => 'nullable|in:Belum Kawin,Kawin,Janda,Duda|max:20',
            'nm_ayah' => 'nullable|string|max:50',
            'nm_ibu' => 'nullable|string|max:50',
            'nm_wali' => 'nullable|string|max:50',
            'nik' => 'required|integer|max_digits:16',
            'alergi_makanan' => 'nullable|string',
            'alergi_obat' => 'nullable|string',
            'suku' => 'nullable|string|max:50',
            'bangsa' => 'nullable|string|max:50',
        ];
    }

    public function messages()
    {
        return [
            'job_id.exists' => 'Data Pekerjaan Tidak ditemukan',
            'province_id.required' => 'Provinsi Tidak Boleh Kosong',
            'city_id.required' => 'Kabupaten / Kota Tidak Boleh Kosong',
            'district_id.required' => 'Kecamatan Tidak Boleh Kosong',
            'village_id.required' => 'Desa Tidak Boleh Kosong',
            'noka.unique' => 'No kartu Tidak Valid terdapat duplikat No Kartu',
            'nik.required' => 'Nik Tidak Boleh kosong',
            'name.required' => 'Nama Tidak Boleh kosong',
            'tempat_lhr.required' => 'Tempat Lahir Tidak Boleh Kosong',
            'tempat_lhr.max' => 'Tempat Lahir Tidak Lebih dari 100 karakter',
            'tanggal_lhr.required' => 'Tanggal Lahir Tidak Boleh Kosong',
            'tanggal_lhr.date' => 'Tanggal Lahir Tidak Valid, harus berupa tanggal',
            'tanggal_lhr.before' => 'Tanggal Lahir Tidak Valid, Masukkan tanggal sebelum hari ini',
            'jenis_kelamin.required' => 'Jenis Kelamin Belum Dipilih',
            'jenis_kelamin.in' => 'Jenis Kelamin Tidak Valid',
            'telp.required' => 'Nomor HP/Telpon Tidak Boleh Kosong',
            'telp.max' => 'Nomor HP/Telpon Tidak Boleh Lebih Dari 20 digit',
            'agama.max' => 'Agama tidak lebih dari 20 karakter',
            'alamat.string' => 'Alamat tidak valid',
            'nik.integer' => 'Nik Tidak Valid',
            'nik.max_digits' => 'Nik maksimal Berjumlah 16 digit',
            'pendidikan.in' => 'Pendidikan Tidak Valid',
            'pendidikan.max' => 'Pendidikan Tidak lebih dari 30 karakter',
            'status.in' => 'Status Kawin Tidak Valid',
            'status.max' => 'Status Kawin Tidak lebih dari 20 karakter',
            'nm_ayah.string' => 'Nama Ayah Tidak Valid',
            'nm_ayah.max' => 'Nama Ayah Tidak Lebih dari 50 karakter',
            'nm_ibu.string' => 'Nama Ayah Tidak Valid',
            'nm_ibu.max' => 'Nama Ayah Tidak Lebih dari 50 karakter',
            'nm_wali.string' => 'Nama Ayah Tidak Valid',
            'nm_wali.max' => 'Nama Ayah Tidak Lebih dari 50 karakter',
            'nik.required' => 'NIK Tidak Boleh kosong',
            'nik.integer' => 'NIK Tidak Valid',
            'nik.max_digits' => 'NIK maksimal 16 digit',
            'alergi_makanan.string' => 'Alergi makanan tidak valid',
            'alergi_obat.string' => 'Alergi Obat tidak valid',
            'suku.string' => 'Suku tidak valid',
            'suku.max' => 'Suku tidak lebih dari 50 karakter',
            'bangsa.string' => 'Suku tidak valid',
            'bangsa.max' => 'Suku tidak lebih dari 50 karakter',
        ];   
    }
}
