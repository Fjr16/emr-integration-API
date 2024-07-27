<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PoliklinikUpdateRequest extends FormRequest
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
            'doctor_poli_id' => 'required|array',
            'doctor_poli_id.*' => 'required|integer|exists:doctor_polis,id',
            'name' => 'required',
            'kode' => 'required',
            'kode_antrian' => ['required', Rule::unique('polikliniks')->ignore($this->id)],
            'user_id' => 'required|array',
            'user_id.*' => 'required|exists:users,id',
            'tarif' => 'required|array',
            'tarif.*' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'doctor_poli_id.required' => 'Data Dokter Poli Tidak Ditemukan',
            'doctor_poli_id.array' => 'Data Dokter Poli Tidak Valid',
            'doctor_poli_id.*.integer' => 'Data Dokter Poli dengan ID {1} Tidak Valid',
            'doctor_poli_id.*.exists' => 'Data Dokter Poli dengan ID {1} Tidak ditemukan',
            'name.required' => 'Nama Poliklinik Tidak Boleh kosong',
            'kode.required' => 'Kode Poliklinik Tidak Boleh kosong',
            'kode_antrian.required' => 'Kode Antrian Poliklinik Tidak Boleh Kosong',
            'kode_antrian.unique' => 'Kode Antrian Telah Digunakan',
            'user_id.required' => 'Dokter belum dipilih',
            'user_id.array' => 'Nama Dokter Tidak Valid',
            'user_id.*.required' => 'Dokter dengan ID {1} belum Dipilih',
            'user_id.*.integer' => 'Dokter dengan ID {1} tidak valid',
            'user_id.*.exists' => 'Dokter dengan ID {1} tidak ditemukan',
            'tarif.required' => 'Tarif Pemeriksaan Dokter Tidak Boleh Kosong',
            'tarif.array' => 'Format Tarif Pemeriksaan Dokter Tidak Valid',
            'tarif.*.required' => 'Tarif Pemeriksaan Dokter ID {1} Tidak Boleh Kosong',
            'tarif.*.integer' => 'Tarif Pemeriksaan Dokter ID {1} Tidak Valid',
        ];
    }
}
