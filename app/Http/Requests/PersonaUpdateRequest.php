<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonaUpdateRequest extends FormRequest
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
        return [
          'ci'=>'digits_between:5,10',
          'nombre'=>'required|max:50|serg_alfabeto',
          'apellido'=>'required|max:50|serg_alfabeto',
          'sexo'=>'required',
          'fechadenacimiento'=>'required|date',
          'direccion'=>'required|max:100',
          'lugardenacimiento'=>'required|max:100',
          'estadocivil'=>'required',
          'gradoinstruccion'=>'required',
          'cipadre' => 'digits_between:5,10|exists:Personas,ci',
          'cimadre' => 'digits_between:5,10|exists:Personas,ci',
        ];
    }
}
