<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        /*if ($this->personal_id_logged == auth()->user()->personal->id ) {
        } else {
            return false;
        }*/
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->asignar == 'true') {
            $rules = [
                'personal_id_logged' => 'required',
                'personal_id' => 'required',
            ];

            $this['newassign'] = 1;

        } else {

            $rules = [
                //'nombres' => 'required',
                'telefono' => 'required|numeric',
                'genero' => 'required',
                'imgperfil' => 'image',
                //'estado' => 'required|in:1,2,3,4,5', //el estado se actuliza solo
            ];

            /*if (auth()->user()->hasRole(['Admin', 'Asistente'])) {
                $rules['vendedor_id'] = 'required';
            }*/


            if ($this->email) {
                $rules = array_merge($rules, [
                    'email' => 'email',
                ]);   
            }

        }

        return $rules;
    }
}
