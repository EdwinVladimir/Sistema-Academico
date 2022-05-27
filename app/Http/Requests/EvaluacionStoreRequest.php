<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EvaluacionStoreRequest extends FormRequest
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

            'fecreg_eval' => 'required',
            'nota_deteva' => 'required',
            'detalplaneva_id' => 'required', 
            'alumno_id' => 'required',
            'materia_id' => 'required',
            'periodo_id' => 'required',

        ];
    }
}
