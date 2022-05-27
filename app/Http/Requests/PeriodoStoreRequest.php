<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeriodoStoreRequest extends FormRequest
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
     * @return array
     */

    public function rules()
    {
        return [

            'ano_per' => 'required',
            'peri_per' => 'required',
            'finic_per' => 'required',
            'ffin_per' => 'required',
        ];
    }

    public function messages()
    {
        return [

            'ano_per.required' => 'Campo requerido',
            'peri_per.required' => 'Campo requerido',
            'finic_per.required' => 'Campo requerido',
            'ffin_per.required' => 'Campo requerido',
        ];
    }
}
