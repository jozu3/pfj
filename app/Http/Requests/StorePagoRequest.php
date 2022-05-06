<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Obligacione;
use App\Models\Pago;

class StorePagoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $result = false;
        $user = auth()->user();
        $obligacione = Obligacione::find($this->obligacione_id);

        if ($user->personal->id == $obligacione->inscripcione->personal_id) {
            $result = true;
        } else {
            
            $roles =  $user->roles->pluck('name', 'id')->toArray();
            $clave = array_search('Admin', $roles);    
            if ($clave == false) {
                $clave = array_search('Asistente', $roles);    
            }

            if($clave != false ){
                $result = true;
            }
        }

        return $result;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function messages(){
        return [
            //'monto.max' => 'asd :max'
        ];
    }

    public function rules()
    {
        $obligacione = Obligacione::find($this->obligacione_id);
        $max = 0;

        $monto_pagado = Pago::where('obligacione_id', $this->obligacione_id)
                            ->where('id','<>',$this->pago_id)->sum('monto');

        $max = $obligacione->montofinal - $monto_pagado;
 
        $rules = [
            'cuenta_id' => 'required',
            'obligacione_id' => 'required',
            'fechapago' => 'required|date',
            'monto' => 'numeric|min:0.01|max:'.$max,
        ];       

        return $rules; 
    }
}
