<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AulaStoreRequest extends FormRequest
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

            'cod_aul' => 'required|unique:aulas',
            'num_aul' => 'required',
        ];
    }

    protected function update()
    {
        return [

            'cod_aul' => 'required|unique:aulas,cod_aul,'. $this->id,
            'num_aul' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'cod_aul.required' => 'Campo requerido',
            'cod_aul.unique' => 'El Código ya existe',

            'num_aul.required' => 'Campo requerido',
        ];
    }
}
