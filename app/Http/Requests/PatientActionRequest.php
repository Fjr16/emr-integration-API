<?php

namespace App\Http\Requests;

use Ramsey\Uuid\Type\Decimal;
use Illuminate\Foundation\Http\FormRequest;

class PatientActionRequest extends FormRequest
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
            'action_id' => 'required|array',
            'action_id.*' => 'required|integer|exists:actions,id',
            'jumlah_tindakan' => 'required|array',
            'jumlah_tindakan.*' => 'required|integer|min:1',
            'tarif_tindakan' => 'required|array',
            'tarif_tindakan.*' => ['required', 'numeric', 'min:0.01', 'max:999999.99'],
            'sub_total_tindakan' => 'required|array',
            'sub_total_tindakan.*' => ['required', 'numeric', 'min:0.01', 'max:999999.99'],
        ];
    }
    public function messages()
    {
        return [
            'action_id.required' => 'Tindakan tidak boleh kosong',
            'action_id.array' => 'Data Tindakan Tidak Valid',
            'action_id.*.required' => 'Tindakan Tidak Boleh Kosong',
            'action_id.*.integer' => 'Tindakan Tidak Valid',
            'action_id.*.exists' => 'Tindakan dengan ID {X} Tidak Ditemukan',
            'jumlah_tindakan.required' => 'Jumlah Tidak Boleh Kosong',
            'jumlah_tindakan.array' => 'Data jumlah Tidak Valid',
            'jumlah_tindakan.*.required' => 'jumlah dengan ID {X} Tidak Boleh Kosong',
            'jumlah_tindakan.*.integer' => 'jumlah dengan ID {X} Tidak Valid',
            'jumlah_tindakan.*.min' => 'jumlah dengan ID {X} Minimal 1',
            'tarif_tindakan.required' => 'Harga Satuan Tidak Boleh Kosong',
            'tarif_tindakan.array' => 'Data harga satuan Tidak Valid',
            'tarif_tindakan.*.required' => 'harga satuan dengan ID {X} Tidak boleh kosong',
            'tarif_tindakan.*.numeric' => 'harga satuan dengan ID {X} Tidak Valid',
            'tarif_tindakan.*.min' => 'harga satuan dengan ID {X} Min 0.01 hingga 999999.99',
            'tarif_tindakan.*.max' => 'harga satuan dengan ID {X} Min 0.01 hingga 999999.99',
            'sub_total_tindakan.required' => 'Harga Sub total Tidak Boleh Kosong',
            'sub_total_tindakan.array' => 'Data sub total Tidak Valid',
            'sub_total_tindakan.*.required' => 'sub total dengan ID {X} tidak boleh kosong',
            'sub_total_tindakan.*.numeric' => 'sub total dengan ID {X} tidak valid',
            'sub_total_tindakan.*.min' => 'sub total dengan ID {X} Min 0.01 hingga 999999.99',
            'sub_total_tindakan.*.max' => 'sub total dengan ID {X} Min 0.01 hingga 999999.99',
        ];
    }
}
