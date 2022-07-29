<?php

namespace App\Imports;

use App\Models\Barrio;
use App\Models\Participante;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rules\Exists;
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
            
                $row['sexo'] = str_replace(' ', '', $row['sexo'] );
            if ($row['sexo'] == 'Mujer' || $row['sexo'] == 'mujer' || $row['sexo'] == 'MUJER') {
                $row['sexo'] = '0';
            }
            if ($row['sexo'] == 'Hombre' || $row['sexo'] == 'hombre' || $row['sexo'] == 'HOMBRE') {
                $row['sexo'] = '1';
            }

            //barrio
            $row['nombre_del_barrio_o_rama'] = Barrio::where('nombre', 'like', '%'.$row['nombre_del_barrio_o_rama'].'%')->first();
            if ($row['nombre_del_barrio_o_rama']) {
                $row['nombre_del_barrio_o_rama'] = $row['nombre_del_barrio_o_rama']->id;
            } else {
                $row['nombre_del_barrio_o_rama'] = 1;//desconocido seeder
            }

            //estado
            if ($row['estado'] == 'Aprobados' || $row['estado'] == 'aprobados' || $row['estado'] == 'aprobado' || $row['estado'] == 'APROBADO' || $row['estado'] == 'Aprobados - L') {
                $row['estado'] = 1;
            } else {
                $row['estado'] = 0;
            }

            //vacunas
            if (is_int($row['cuentas_con_todas_las_dosis_requeridas_de_vacunacion_contra_covid'])) {
                //$row['cuentas_con_todas_las_dosis_requeridas_de_vacunacion_contra_covid']
            } else {
                $row['cuentas_con_todas_las_dosis_requeridas_de_vacunacion_contra_covid'] = 0;
            }

            if (is_numeric($row['cumpleanos'])) {
                $row['cumpleanos'] = Date::excelToDateTimeObject($row['cumpleanos']);
            }

            if (!isset($row['correo_electronico'])) {
                $row['correo_electronico'] = '';
            }   

            Participante::create([
                'nombres' => $row['nombre'],
                'apellidos' => $row['apellido'],
                'documento' => empty($row['documento']) ? '': $row['documento'] ,
                'fecnac' => $row['cumpleanos'],
                'genero' => $row['sexo'],
                'telefono' => $row['telefono'] == null ? '': $row['telefono'],
                'email' => $row['correo_electronico'] == null ? '': $row['correo_electronico'],
                'informacion_medica' => $row['informacion_medica'],
                'talla' => $row['tamano_de_camiseta'],
                'informacion_alimentaria' => $row['informacion_alimentaria'],
                'contacto1' => $row['contact_1_name'] == null ? '': $row['contact_1_name'] ,
                'contacto1_phone' => $row['contact_1_phone'] == null ? '': $row['contact_1_phone'] ,
                'contacto1_email' => $row['contact_1_email'] == null ? '': $row['contact_1_email'] ,
                'contacto2' => $row['contact_2_name'] == null ? '': $row['contact_2_name'] ,
                'contacto2_phone' => $row['contact_2_phone'] == null ? '': $row['contact_2_phone'] ,
                'contacto2_email' => $row['contact_2_email'] == null ? '': $row['contact_2_email'] ,
                'age' => $row['age'],
                'age_2022' => empty($row['cuantos_anos_cumples_en_el_2022']) ? '0' : $row['cuantos_anos_cumples_en_el_2022'],
                'barrio_id' => $row['nombre_del_barrio_o_rama'],
                'estado_aprobacion' => $row['estado'],
                'obispo' => $row['nombre_del_obispo'] == null ? '' : $row['nombre_del_obispo'],
                'obispo_email' => $row['correo_electronico_del_obispo'] == null ? '' : $row['correo_electronico_del_obispo'],
                'sangre' => $row['grupo_sanguineo_y_factor_rh'] == null ? '' : $row['grupo_sanguineo_y_factor_rh'],
                'alergia' => $row['sufres_de_algun_tipo_de_alergia'] == null ? '' : $row['sufres_de_algun_tipo_de_alergia'],
                'tratamiento_medico' => $row['recibes_algun_tipo_de_tratamiento_medico'] == null ? '' : $row['recibes_algun_tipo_de_tratamiento_medico'],
                'diabetico_asmatico' => $row['eres_diabetico_o_asmatico'] == null ? '' : $row['eres_diabetico_o_asmatico'],
                'seguro_medico' => $row['con_que_seguro_medico_cuentas'] == null ? '' : $row['con_que_seguro_medico_cuentas'],
                'vacunas' => $row['cuentas_con_todas_las_dosis_requeridas_de_vacunacion_contra_covid'] == null ? '0' : $row['cuentas_con_todas_las_dosis_requeridas_de_vacunacion_contra_covid'],
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
            'nombre' => 'required',
            'apellido' => 'required',
            'cumpleanos' => 'required',
            'sexo' => 'required',
            // 'informacion_medica' => 'required',
            'tamano_de_camiseta' => 'required',
            // 'informacion_alimentaria' => 'required',
            'age' => 'required',
            // 'cuantos_anos_cumples_en_el_2022' => 'required',
            'estado' => 'required',
            // 'obispo' => 'required',
            // 'grupo_sanguineo_y_factor_rh' => 'required',
            // 'sufres_de_alergia' => 'required',
            // 'recibes_algun_tratamiento_medico' => 'required',
            // 'eres_diabetico_o_asmatico' => 'required',
            // 'seguro_medico' => 'required',
            // 'cuentas_con_todas_las_dosis_requeridas_de_vacunacion_contra_covid' => 'required',

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
