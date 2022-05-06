<?php

namespace App\Imports;

use App\Models\Barrio;
use App\Models\Contacto;
use App\Models\Inscripcione;
use App\Models\Personale;
use App\Models\Programa;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class PersonalesImport implements ToModel, WithValidation
{

    public function  __construct(Programa $programa)
    {
        $this->programa= $programa->id;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if($row[6] == 'No'){
            $mretornado = 0;
        }
        if($row[6] == 'Sí'){
            $mretornado = 1;
        } else {
            $mretornado = 0;
        }

       
        $contacto = Contacto::create([
            'nombres' => $row[2],
            'apellidos' => $row[3],
            'fecnac' => Date::excelToDateTimeObject($row[4]) ,
            'genero' => $row[5],
            'mretornado' => $mretornado,
            'telefono' => $row[7],
            'email' => $row[8],
            'obispo' => $row[11],
            'telobispo' => $row[12],
            'fotodrive' => $row[13],
            'anterior' => $row[14],
            'pasatiempos' => $row[15],
            'paciencia' => $row[16],
            'liderazgo' => $row[17],
            'ensenanza' => $row[18],
            'experiencia' => $row[19],
            'estado' => 3,
        ]);

        $user = User::create([
            'name' => $row[2]. ' ' . $row[3],
            'email' => $contacto->email,
            'password' => bcrypt('password'),
            'estado' => 1
        ]);
        $user->assignRole('Consejero');

        $barrio = Barrio::where('nombre', 'like','%'.$row[10].'%')->first();

        if($barrio != null){
            $barrio = $barrio->id;
        } else {
            $barrio = 1;
        }


        $personale = Personale::create([
            'permiso_obispo' => 0,
            'estado_rtemplo' => 0,
            'barrio_id' => $barrio,
            'contacto_id' => $contacto->id,
            'user_id' => $user->id,
        ]);

        $inscripcione = Inscripcione::create([
            'personale_id' => $personale->id,
            'programa_id' => $this->programa,
            'role_id' => 6,//consejero
            'estado' => 1,
            'fecha' => date('Y-m-d')
        ]);



        return null;
    }

    public function rules(): array
    {
        return [
            '5' => 'required',
            '8' => function($attribute, $value, $onFailure) {
                if (User::where('email', $value)->count()) {
                     $onFailure('El correo '. $value . ' ya está en uso.');
                }
            }
        ];
    }

    public function customValidationMessages()
        {
            return [
                '5.required' => 'El campo género es requerido.',
            ];
        }
}
