<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EspecialidadStoreRequest extends FormRequest
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

            'nom_especialidad' => 'required|unique:especialidads',
            'desc_especialidad' => 'required',
        ];
    }

    protected function update()
    {
        return [

            'nom_especialidad' => 'required|unique:especialidads,nom_especialidad,'. $this->id,
            'desc_especialidad' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nom_especialidad.required' => 'Campo requerido',
            'nom_especialidad.unique' => 'El Nombre ya existe',

            'desc_especialidad.required' => 'Campo requerido',
        ];
    }
}
