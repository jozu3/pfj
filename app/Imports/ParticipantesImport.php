<?php

namespace App\Imports;

use App\Models\Barrio;
use App\Models\Participante;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ParticipantesImport implements ToCollection, WithHeadingRow, WithValidation
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) 
        {
            //genero
            // switch ($row['sexo']) {
            //     case 'Mujer' || 'mujer' || 'MUJER':
            //         $row['sexo'] = '0';
            //         break;
            //     case 'Hombre' || 'hombre' || 'HOMBRE':
                //         $row['sexo'] = '1';
                //         break;
                
                // }
                
            if ($row['sexo'] == 'Mujer' || $row['sexo'] == 'mujer' || $row['sexo'] == 'MUJER') {
                $row['sexo'] = '0';
            }
            if ($row['sexo'] == 'Hombre' || $row['sexo'] == 'hombre' || $row['sexo'] == 'HOMBRE') {
                $row['sexo'] = '1';
            }

            //barrio
            $row['barrio'] = Barrio::where('nombre', 'like', '%'.$row['barrio'].'%')->first();
            if ($row['barrio']) {
                $row['barrio'] = $row['barrio']->id;
            } else {
                $row['barrio'] = 1;//desconocido seeder
            }

            //estado
            if ($row['estado'] == 'Aprobados' || $row['estado'] == 'aprobados' || $row['estado'] == 'aprobado' || $row['estado'] == 'APROBADO') {
                $row['estado'] = 1;
            } else {
                $row['estado'] = 0;
            }

            //vacunas
            if (is_int($row['cuentas_con_las_dosis_requeridas_de_vacunacion_contra_covid'])) {
                //$row['cuentas_con_las_dosis_requeridas_de_vacunacion_contra_covid']
            } else {
                $row['cuentas_con_las_dosis_requeridas_de_vacunacion_contra_covid'] = 0;
            }

            if (is_numeric($row['cumpleanos'])) {
                $row['cumpleanos'] = Date::excelToDateTimeObject($row['cumpleanos']);
            }

            if (isset($row['correo_electronico'])) {
                # code...
            }


            Participante::create([
                'nombres' => $row['nombres'],
                'apellidos' => $row['apellidos'],
                'documento' => $row['documento'] == null ? '': $row['documento'] ,
                'fecnac' => $row['cumpleanos'],
                'genero' => $row['sexo'],
                'telefono' => $row['telefono'] == null ? '': $row['telefono'],
                'email' => $row['correo_electronico'] == null ? '': $row['correo_electronico'],
                'informacion_medica' => $row['informacion_medica'],
                'talla' => $row['tamano_de_camiseta'],
                'informacion_alimentaria' => $row['informacion_alimentaria'],
                'contacto1' => $row['contacto_1'] == null ? '': $row['contacto_1'] ,
                'contacto2' => $row['contacto_2'] == null ? '': $row['contacto_2'] ,
                'age' => $row['age'],
                'age_2022' => $row['cuantos_anos_cumples_en_el_2022'],
                'barrio_id' => $row['barrio'],
                'estado_aprobacion' => $row['estado'],
                'obispo' => $row['obispo'] == null ? '' : $row['obispo'],
                'sangre' => $row['grupo_sanguineo_y_factor_rh'] == null ? '' : $row['grupo_sanguineo_y_factor_rh'],
                'alergia' => $row['sufres_de_alergia'] == null ? '' : $row['sufres_de_alergia'],
                'tratamiento_medico' => $row['recibes_algun_tratamiento_medico'] == null ? '' : $row['recibes_algun_tratamiento_medico'],
                'diabetico_asmatico' => $row['eres_diabetico_o_asmatico'] == null ? '' : $row['eres_diabetico_o_asmatico'],
                'seguro_medico' => $row['seguro_medico'] == null ? '' : $row['seguro_medico'],
                'vacunas' => $row['cuentas_con_las_dosis_requeridas_de_vacunacion_contra_covid'] == null ? '0' : $row['cuentas_con_las_dosis_requeridas_de_vacunacion_contra_covid'],
                'programa_id' => session('programa_activo'),
                'estado' => 0,//inscrito
                'tipo_ingreso' => null,
                'horallegada' => null,
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'nombres' => 'required',
            'apellidos' => 'required',
            'cumpleanos' => 'required',
            'sexo' => 'required',
            'informacion_medica' => 'required',
            'tamano_de_camiseta' => 'required',
            'informacion_alimentaria' => 'required',
            'age' => 'required',
            'cuantos_anos_cumples_en_el_2022' => 'required',
            'estado' => 'required',
            'obispo' => 'required',
            'grupo_sanguineo_y_factor_rh' => 'required',
            'sufres_de_alergia' => 'required',
            'recibes_algun_tratamiento_medico' => 'required',
            'eres_diabetico_o_asmatico' => 'required',
            'seguro_medico' => 'required',
            'cuentas_con_las_dosis_requeridas_de_vacunacion_contra_covid' => 'required',

            // '4' => 'required',
           /* '5' => function ($attribute, $value, $onFailure) {
                if (User::where('email', $value)->count()) {
                    $onFailure('El correo ' . $value . ' ya está en uso.');
                }
            }*/
        ];
    }

    public function customValidationMessages()
    {
        return [
            'cuantos_anos_cumples_en_el_2022.required' => 'El campo ¿cuantos años cumples en el 2022? es requerido.',
            '4.required' => 'El campo teléfono es requerido.',
        ];
    }
}
