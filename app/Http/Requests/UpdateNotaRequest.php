<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Nota;

class UpdateNotaRequest extends FormRequest
{
    
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $notas_completas = 0;
        $tiene_nota_recuperatoria = 0;

        $nota = Nota::find($this->id);
        $notas = Nota::where('id', '<>',$this->id)->where('unidad_id',$nota->unidad_id)->get();

        foreach ($notas as $not) {
            $notas_completas += $not->valor;
            if ($not->tipo == 1 && $this->tipo == 1) {
                $tiene_nota_recuperatoria = 1;
            }
        }  

        if ($this->tipo == 0)
        {
            $notas_completas += $this->valor;
        }


        $this->request->add([
            'notas_completas' => $notas_completas,
            'tiene_nota_recuperatoria' => $tiene_nota_recuperatoria,
        ]);

        return true;
    }

    public function messages()
    {
        return [
            'notas_completas.max' => 'La suma del valor de las notas no deben superar el 100%.',
            'tiene_nota_recuperatoria.in' => 'Esta unidad ya tiene una nota recuperatoria.',
            'valor.in' => 'Si la nota es de tipo "Nota recuperatoria" el valor debe ser "0".'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // = $nc;
        //dd($this);

        return [
            'descripcion' => 'required',
            'tipo' => 'required',
            'tiene_nota_recuperatoria' => 'in:0',
            'valor' => 'required|exclude_if:tipo,1|numeric|min:0.01|max:1',
            'valor' => 'required|exclude_if:tipo,0|numeric|in:0',
            'notas_completas' => 'required|numeric|min:0|max:1',
        ];
    }
}
