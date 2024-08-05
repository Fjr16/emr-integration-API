<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\RequiredIf;

class PermintaanLaborRequest extends FormRequest
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
            'tipe_permintaan' => 'required|in:Reguler,Urgent',
            'tanggal_sampel' => 'required|date',
            'diagnosa' => 'required|string',
            'catatan' => 'nullable',
            'ttd_dokter' => 'required',
            'action_id' => 'required|array',
            'action_id.*' => 'required|integer|exists:actions,id',
            'name' => 'required_if:generate_template,on',
        ];
    }

    public function messages()
    {
        return [
            'tipe_permintaan.required' => 'Kategori Permintaan Tidak Boleh Kosong',
            'tipe_permintaan.in' => 'Kategori Permintaan Tidak Ditemukan',
            'diagnosa.required' => 'Diagnosa klinis Tidak Boleh Kosong',
            'diagnosa.date' => 'Diagnosa klinis Harus dalam format tanggal DDDD/MMMM/YYYY',
            'ttd_dokter.required' => 'Tanda Tangan Dokter Tidak Boleh Kosong',
            'action_id.required' => 'Tindakan Tidak Boleh Kosong',
            'action_id.array' => 'Tindakan Yang Dipilih Tidak Valid',
            'action_id.*.required' => 'Tindakan dengan ID {X} tidak Boleh kosong',
            'action_id.*.integer' => 'Tindakan dengan ID {X} tidak Valid',
            'action_id.*.exists' => 'Tindakan dengan ID {X} tidak Ditemukan',
            'name.required_if' => 'Nama template harus diisi jika ingin membuat template',
        ];
    }
}
