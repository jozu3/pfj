<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInscripcioneRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->personale_id == auth()->user()->personale->id || auth()->user()->can('admin.inscripciones.createAll')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
                'contacto_id' => 'required',
                'nombres' => 'required',
                'apellidos' => 'required',
                'telefono' => 'required',
                'doc' => 'required',
                'email' => ['required', 'email'],
                //'estado' => 'required|in:1,2,3,4,5',
                'pfj_id' => 'required',
                'role_id' => 'required',
                'programa_id' => 'required',
                'fecha' => ['required', 'date'],
            ];

        return $rules;
    }
}
