<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class QueueStoreRequest extends FormRequest
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
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:users,id',
            'patient_category_id' => 'required|exists:patient_categories,id',
            'tgl_antrian' => 'required|date|after_or_equal:' . $today->format('Y-m-d'),
        ];
    }

    public function messages()
    {
        return [
            'patient_id.required' => 'Nomor rekam medis Tidak Boleh Kosong',
            'patient_id.exists' => 'Pasien Tidak ditemukan',
            'doctor_id.required' => 'Poli / Dokter tidak Boleh kosong',
            'doctor_id.exists' => 'Poli / Dokter Tidak Ditemukan',
            'patient_category_id.required' => 'Penjamin Tidak Boleh Kosong',
            'patient_category_id.exists' => 'Penjamin Tidak Ditemukan',
            'tgl_antrian.required' => 'Tanggal Berobat Tidak Boleh Kosong',
            'tgl_antrian.date' => 'Tanggal berobat Tidak Valid, harus dalam format tanggal DDDD/MMMM/YYYY',
            'tgl_antrian.after_or_equal' => 'Tanggal Berobat Adalah Tanggal Hari ini atau Setelah Hari ini',
        ];
    }
}
