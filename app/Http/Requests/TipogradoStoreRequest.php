<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipogradoStoreRequest extends FormRequest
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

            'nom_grado' => 'required|unique:tipogrados',
            'desc_grado' => 'required',
        ];
    }

    protected function update()
    {
        return [

            'nom_grado' => 'required|unique:tipogrados,nom_grado,'. $this->id,
            'desc_grado' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nom_grado.required' => 'Campo requerido',
            'nom_grado.unique' => 'El Nombre ya existe',

            'desc_grado.required' => 'Campo requerido',
        ];
    }
}
