<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermintaanRadiologiRequest extends FormRequest
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
            'diagnosa_klinis' => 'required',
            'ttd_user' => 'required',
            'action_id' => 'required|array',
            'action_id.*' => 'required|integer|exists:actions,id',
        ];
    }

    public function messages()
    {
        return [
            'diagnosa_klinis.required' => 'Diagnosa klinis Tidak Boleh Kosong',
            'ttd_user.required' => 'Tanda Tangan Dokter Tidak Boleh Kosong',
            'action_id.required' => 'Tindakan Tidak Boleh Kosong',
            'action_id.array' => 'Tindakan Yang Dipilih Tidak Valid',
            'action_id.*.required' => 'Tindakan dengan ID {X} tidak Boleh kosong',
            'action_id.*.integer' => 'Tindakan dengan ID {X} tidak Valid',
            'action_id.*.exists' => 'Tindakan dengan ID {X} tidak Ditemukan',
        ];
    }
}
