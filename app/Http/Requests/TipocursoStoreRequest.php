<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipocursoStoreRequest extends FormRequest
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

            'nom_curso' => 'required|unique:tipocursos',
            'desc_curso' => 'required',
        ];
    }

    protected function update()
    {
        return [

            'nom_curso' => 'required|unique:tipocursos,nom_curso,'. $this->id,
            'desc_curso' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nom_curso.required' => 'Campo requerido',
            'nom_curso.unique' => 'El Nombre ya existe',

            'desc_curso.required' => 'Campo requerido',
        ];
    }
}
