<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanestudioStoreRequest extends FormRequest
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
            'tit_pla' => 'required',
            'descrip_pla' => 'required',
            'curso_id' => 'required',
            'archi_pla' => 'required',
        ];
    }
}
