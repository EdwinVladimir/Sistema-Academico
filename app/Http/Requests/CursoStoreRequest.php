<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CursoStoreRequest extends FormRequest
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

            'cod_cur' => 'required|unique:cursos',
            'nom_cur' => 'required|unique:cursos',
            'ejecurso_id' => 'required',
            'tipocurso_id' => 'required',
            'narea_cur' => 'required',
            'materia_id' => 'required',
            'nhor_cur' => 'required',
        ];
    }

    protected function update()
    {
        return [

            'cod_cur' => 'required|unique:cursos,cod_cur,'. $this->id,
            'nom_cur' => 'required|unique:cursos,nom_cur,'. $this->id,
            'ejecurso_id' => 'required',
            'tipocurso_id' => 'required', 
            'narea_cur' => 'required',
            'materia_id' => 'required',
            'nhor_cur' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'cod_cur.required' => 'Campo requerido',
            'cod_cur.unique' => 'El Código ya existe',

            'nom_cur.required' => 'Campo requerido',
            'nom_cur.unique' => 'El Nombre ya existe',

            'ejecurso_id.required' => 'Seleccione un item',
            'tipocurso_id.required' => 'Seleccione un item',
            'narea_cur.required' => 'Seleccione un item',
            'nhor_cur.required' => 'Campo requerido',
            'materia_id.required' => 'Seleccione uno o varios items',
        ];
    }
}
