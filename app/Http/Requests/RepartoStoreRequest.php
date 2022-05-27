<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RepartoStoreRequest extends FormRequest
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

            'nom_reparto' => 'required|unique:repartos',
            'desc_reparto' => 'required',
        ];
    }

    protected function update()
    {
        return [

            'nom_reparto' => 'required|unique:repartos,nom_reparto,'. $this->id,
            'desc_reparto' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nom_reparto.required' => 'Campo requerido',
            'nom_reparto.unique' => 'El Nombre ya existe',

            'desc_reparto.required' => 'Campo requerido',
        ];
    }
}
