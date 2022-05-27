<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MatriculaStoreRequest extends FormRequest
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
            'periodo_id' => 'required',
            'alumno_id' => 'required',
            'curso_id' => 'required',
            'seccion_id' => 'required',
            'feins_matri' => 'required',
        ];
    }

    public function messages()
    {
        return [

            'periodo_id.required'    => 'Seleccione una opción',
            'alumno_id.required' => 'Seleccione una opción',
            'curso_id.required' => 'Seleccione una opción',
            'seccion_id.required' => 'Seleccione una opción',
            'feins_matri.required'   => 'Seleccione una fecha',
        ];
    }
}
