<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocenteStoreRequest extends FormRequest
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

            'dni_doc' => 'required|unique:docentes',
            'nom_doc' => 'required',
            'ape_doc' => 'required', 
            'fnac_doc' => 'required',
            'lnac_doc' => 'required',
            'especialidad_id' => 'required',
            'reparto_id' => 'required',
            'tipogrado_id' => 'required',
            'tiposangre_id' => 'required',
            'instt_docp' => 'required',
            'cobt_doc' => 'required',
        ];
    }

    protected function update()
    {
        return [

            'dni_doc' => 'required|unique:docentes,dni_doc,'. $this->id,
            'nom_doc' => 'required',
            'ape_doc' => 'required', 
            'fnac_doc' => 'required',
            'lnac_doc' => 'required',
            'especialidad_id' => 'required',
            'reparto_id' => 'required',
            'tipogrado_id' => 'required',
            'tiposangre_id' => 'required',
            'instt_docp' => 'required',
            'cobt_doc' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'dni_doc.required' => 'Campo requerido',
            'dni_doc.unique' => 'El DNI ya existe',

            'nom_doc.required' => 'Campo requerido',
            'ape_doc.required' => 'Campo requerido',
            'fnac_doc.required' => 'Campo requerido',
            'lnac_doc.required' => 'Campo requerido',

            'especialidad_id.required' => "Seleccione una opción",
            'reparto_id.required' => "Seleccione una opción",
            'tipogrado_id.required' => "Seleccione una opción",
            'tiposangre_id.required' => "Seleccione una opción",

            'instt_docp.required' => 'Campo requerido',
            'cobt_doc.required' => 'Campo requerido',
        ];
    }
}
