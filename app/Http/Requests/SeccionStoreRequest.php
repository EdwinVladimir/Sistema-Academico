<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeccionStoreRequest extends FormRequest
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

            'cod_sec' => 'required|unique:seccions',
            'nom_sec' => 'required',
        ];
    }

    protected function update()
    {
        return [

            'cod_sec' => 'required|unique:seccions,cod_sec,'. $this->id,
            'nom_sec' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'cod_sec.required' => 'Campo requerido',
            'cod_sec.unique' => 'El Código ya existe',

            'nom_sec.required' => 'Campo requerido',
        ];
    }
}
