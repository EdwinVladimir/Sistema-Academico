<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EjecursoStoreRequest extends FormRequest
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

            'nom_ejecurso' => 'required|unique:ejecursos',
            'desc_ejecurso' => 'required',
        ];
    }

    protected function update()
    {
        return [

            'nom_ejecurso' => 'required|unique:ejecursos,nom_ejecurso,'. $this->id,
            'desc_ejecurso' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nom_ejecurso.required' => 'Campo requerido',
            'nom_ejecurso.unique' => 'El Nombre ya existe',

            'desc_ejecurso.required' => 'Campo requerido',
        ];
    }
}
