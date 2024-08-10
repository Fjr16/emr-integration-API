<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicineReceiptRequest extends FormRequest
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
            'medicine_id' => 'required_without:nama_obat_custom|integer|exists:medicines,id',
            'jumlah' => 'required|integer|min:1',
            'aturan_pakai' => 'nullable|string',
            'nama_obat_custom' => 'required_without:medicine_id|string|max:255|nullable',
            'satuan_obat_custom' => 'required_with:nama_obat_custom|string|max:255|nullable',
        ];
    }

    public function messages()
    {
        return [
            'medicine_id.required_without' => 'Silahkan pilih obat dari daftar atau masukkan nama obat secara manual',
            'medicine_id.integer' => 'Obat Yang dipilih Tidak Valid',
            'medicine_id.exists' => 'Obat Yang dipilih Tidak ditemukan',
            'jumlah.required' => 'Jumlah Obat harus Diisi',
            'jumlah.integer' => 'Jumlah Obat Yang diisi Tidak Valid',
            'jumlah.min' => 'Jumlah Obat Tidak Boleh kurang dari 1',
            'aturan_pakai.string' => 'Aturan Pakai obat tidak valid',
            'nama_obat_custom.required_without' => 'Silahkan masukkan nama obat jika obat yang Anda cari tidak ada dalam daftar',
            'nama_obat_custom.string' => 'Nama Obat untuk pembelian diluar tidak valid',
            'nama_obat_custom.max' => 'Nama Obat untuk pembelian diluar Tidak Boleh lebih dari 255 karakter',
            'satuan_obat_custom.required_with' => 'Silahkan masukkan satuan obat untuk obat yang Anda masukkan',
            'satuan_obat_custom.string' => 'Satuan Obat pembelian diluar tidak valid',
            'satuan_obat_custom.max' => 'Satuan Obat Obat pembelian diluar Tidak Boleh lebih dari 255 karakter',
        ];
    }
}
