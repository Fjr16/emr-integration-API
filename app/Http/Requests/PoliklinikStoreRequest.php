<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PoliklinikStoreRequest extends FormRequest
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
            'kode' => 'required|unique:polikliniks',
            'kode_antrian' => 'required|unique:polikliniks',
            // 'user_id' => 'required|array',
            // 'user_id.*' => 'required|exists:users,id',
            // 'tarif' => 'required|array',
            // 'tarif.*' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama Poliklinik Tidak Boleh kosong',
            'kode.required' => 'Kode Poliklinik Tidak Boleh kosong',
            'kode.unique' => 'Kode Poliklinik Telah Digunakan',
            'kode_antrian.required' => 'Kode Antrian Poliklinik Tidak Boleh Kosong',
            'kode_antrian.unique' => 'Kode Antrian Telah Digunakan',
            // 'user_id.required' => 'Dokter belum dipilih',
            // 'user_id.array' => 'Nama Dokter Tidak Valid',
            // 'user_id.*.required' => 'Dokter dengan ID {1} belum Dipilih',
            // 'user_id.*.integer' => 'Dokter dengan ID {1} tidak valid',
            // 'user_id.*.exists' => 'Dokter dengan ID {1} tidak ditemukan',
            // 'tarif.required' => 'Tarif Pemeriksaan Dokter Tidak Boleh Kosong',
            // 'tarif.array' => 'Format Tarif Pemeriksaan Dokter Tidak Valid',
            // 'tarif.*.required' => 'Tarif Pemeriksaan Dokter ID {1} Tidak Boleh Kosong',
            // 'tarif.*.integer' => 'Tarif Pemeriksaan Dokter ID {1} Tidak Valid',
        ];
    }
}
