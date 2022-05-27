<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlumnoStoreRequest extends FormRequest
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

            'dni_al' => 'required|unique:alumnos',
            'nom_al' => 'required',
            'ape_al' => 'required', 
            'fnac_al' => 'required',
            'lnac_al' => 'required',
            'especialidad_id' => 'required',
            'reparto_id' => 'required',
            'tipogrado_id' => 'required',
            'tiposangre_id' => 'required',
        ];
    }

    protected function update()
    {
        return [

            'dni_al' => 'required|unique:alumnos,dni_al,'. $this->id,
            'nom_al' => 'required',
            'ape_al' => 'required', 
            'fnac_al' => 'required',
            'lnac_al' => 'required',
            'especialidad_id' => 'required',
            'reparto_id' => 'required',
            'tipogrado_id' => 'required',
            'tiposangre_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'dni_al.required' => 'Campo requerido',
            'dni_al.unique' => 'El DNi ya existe',

            'nom_al.required' => 'Campo requerido',
            'ape_al.required' => 'Campo requerido',
            'fnac_al.required' => 'Campo requerido',
            'lnac_al.required' => 'Campo requerido',

            'especialidad_id.required' => "Seleccione una opción",
            'reparto_id.required' => "Seleccione una opción",
            'tipogrado_id.required' => "Seleccione una opción",
            'tiposangre_id.required' => "Seleccione una opción",
        ];
    }
}
