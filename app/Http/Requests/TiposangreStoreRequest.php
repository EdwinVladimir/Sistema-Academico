<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TiposangreStoreRequest extends FormRequest
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

            'nom_sangre' => 'required|unique:tiposangres',
            'desc_sangre' => 'required',
        ];
    }

    protected function update()
    {
        return [

            'nom_sangre' => 'required|unique:tiposangres,nom_sangre,'. $this->id,
            'desc_sangre' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nom_sangre.required' => 'Campo requerido',
            'nom_sangre.unique' => 'El Nombre ya existe',

            'desc_sangre.required' => 'Campo requerido',
        ];
    }
}
