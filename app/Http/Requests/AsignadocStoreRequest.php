<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AsignadocStoreRequest extends FormRequest
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
        return []
        +($this->isMethod('POST') ? $this->store() : $this->update()) ;
    }

    protected function store()
    {
        return [

            'docente_id'             => 'required',
            'seccion_id'             => 'required',
            'aula_id'                => 'required',
            'periodo_id'             => 'required',
            'seccion_id'             => 'required',
            'materia_id'             => 'required',
            'curso_id'               => 'required',
            'porcentaje_individual'  => 'required',
            'porcentaje_grupal'      => 'required',
            'porcentaje_actitudinal' => 'required',
            'estado'                 => 'required',
        ];
    }

    protected function update()
    {
        return [

            'docente_id'             => 'required',
            'seccion_id'             => 'required',
            'aula_id'                => 'required',
            'periodo_id'             => 'required',
            'seccion_id'             => 'required',
            'materia_id'             => 'required',
            'curso_id'               => 'required',
        ];
    }

    public function messages()
    {
        return [

            'aula_id.required'    => 'Seleccione una opción',
            'periodo_id.required' => 'Seleccione una opción',
            'seccion_id.required' => 'Seleccione una opción',
            'materia_id.required' => 'Seleccione una opción',
            'curso_id.required'   => 'Seleccione una opción',
        ];
    }
}