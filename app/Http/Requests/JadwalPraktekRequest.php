<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JadwalPraktekRequest extends FormRequest
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
