<?php

namespace App\Http\Requests;

use App\Models\Poliklinik;
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
            'name' => 'required',
            'kode' => 'required',
            'kode_antrian' => ['required', Rule::unique('polikliniks')->ignore($this->id)],
            'user_id' => 'required|array',
            'user_id.*' => 'required|exists:users,id',
            'tarif' => 'required|array',
            'tarif.*' => 'required|integer',
            'day' => 'required|array',
            'day.*' => 'required',
            'start_at' => 'required|array',
            'start_at.*' => 'required|date_format:H:i',
            'ends_at' => 'required|array',
            'ends_at.*' => 'required|date_format:H:i',
        ];
    }

    public function messages()
    {
        return [
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
            'day.required' => 'Hari Praktek Dokter tidak boleh kosong',
            'day.array' => 'Format Hari Praktek Dokter tidak valid',
            'day.*.required' => 'Hari Praktek Dokter dengan ID {1} tidak Boleh Kosong',
            'start_at.required' => 'Jam Mulai Praktek Tidak Boleh Kosong',
            'start_at.array' => 'Format Jam Mulai Praktek Tidak Valid',
            'start_at.*.required' => 'Jam Mulai Praktek dengan ID {1} Tidak Boleh Kosong',
            'start_at.*.time' => 'Jam Mulai Praktek dengan ID {1} Harus dalam Format Jam dan Menit',
            'ends_at.date' => 'Jam Berakhir Praktek Tidak Boleh Kosong',
            'ends_at.array' => 'Format Jam Berakhir Praktek Tidak Valid',
            'ends_at.*.required' => 'Jam Berakhir Praktek dengan ID {1} Tidak Boleh Kosong',
            'ends_at.*.time' => 'Jam Berakhir Praktek dengan ID {1} Harus dalam Format Jam dan Menit',
        ];
    }
}
