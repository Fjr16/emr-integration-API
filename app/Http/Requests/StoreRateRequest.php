<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'bedroom_id' => ['required'],
            'patient_category_id' => 'required',
            'rawatan' => 'required|integer',
            'tindakan' =>  'required|integer',
            'adm' => 'required|integer',
            'visite' => 'required|integer',
            'labor' => 'required|integer',
            'bhp' => 'required|integer',
            'coshering' => 'required|integer',
        ];
    }
}
