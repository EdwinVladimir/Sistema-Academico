<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MateriaStoreRequest extends FormRequest
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

            'nom_mat' => 'required|unique:materias',
            'nhor_mat' => 'required',
        ];
    }

    protected function update()
    {
        return [

            'nom_mat' => 'required|unique:materias,nom_mat,'. $this->id,
            'nhor_mat' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nom_mat.required' => 'Campo requerido',
            'nom_mat.unique' => 'El Código ya existe',

            'nhor_mat.required' => 'Campo requerido',
        ];
    }
}
