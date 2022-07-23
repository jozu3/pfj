<?php

namespace App\Imports;

use App\Models\Barrio;
use App\Models\Participante;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ParticipantesImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) 
        {
            //genero
            switch ($row['sexo']) {
                case 'Mujer' || 'mujer' || 'MUJER':
                    $row['sexo'] = '0';
                    break;
                case 'Hombre' || 'hombre' || 'HOMBRE':
                    $row['sexo'] = '1';
                    break;
                
            }

            //barrio
            $row['barrio'] = Barrio::where('nombre', $row['barrio'])->first();
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


            Participante::create([
                'nombres' => $row['nombres'],
                'apellidos' => $row['apellidos'],
                'documento' => $row['documento'],
                'fecnac' => $row['cumpleanos'],
                'genero' => $row['sexo'],
                'telefono' => $row['telefono'] == null ? '': $row['telefono'],
                'informacion_medica' => $row['informacion_medica'],
                'talla' => $row['tamano_de_camiseta'],
                'informacion_alimentaria' => $row['informacion_alimentaria'],
                'contacto1' => $row['contacto_1'] == null ? '': $row['contacto_1'] ,
                'contacto2' => $row['contacto_2'] == null ? '': $row['contacto_2'] ,
                'age' => $row['age'],
                'age_2022' => $row['cuantos_anos_cumples_en_el_2022'],
                'barrio_id' => $row['barrio'],
                'estado_aprobacion' => $row['estado'],
                'obispo' => $row['obispo'],
                'sangre' => $row['grupo_sanguineo_y_factor_rh'],
                'alergia' => $row['sufres_de_alergia'],
                'tratamiento_medico' => $row['recibes_algun_tratamiento_medico'],
                'diabetico_asmatico' => $row['eres_diabetico_o_asmatico'],
                'seguro_medico' => $row['seguro_medico'],
                'vacunas' => $row['cuentas_con_las_dosis_requeridas_de_vacunacion_contra_covid'],
                'programa_id' => session('programa_activo'),
                'estado' => 0,//inscrito
                'tipo_ingreso' => $row[''],
                'horallegada' => $row[''],
            ]);
        }
    }
}
