<?php

namespace App\Imports;

use App\Models\Barrio;
use App\Models\Contacto;
use App\Models\Inscripcione;
use App\Models\Personale;
use App\Models\PersonaleVacuna;
use App\Models\Programa;
use App\Models\User;
use App\Models\Vacuna;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Spatie\Permission\Models\Role;

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
        if($row[0] == 'ID')
        {
            return null;
        }

        if($row[6] == 'No'){
            $mretornado = 0;
        }
        if($row[6] == 'Sí'){
            $mretornado = 1;
        } else {
            $mretornado = 0;
        }

        //genero
        if ($row[4] == 'V') {
            $genero = 'Hombre';
        }
        if ($row[4] == 'M') {
            $genero = 'Mujer';
        }

        $contacto = Contacto::create([
            'nombres' => $row[1],
            'apellidos' => $row[2],
            'fecnac' => Date::excelToDateTimeObject($row[3]) ,
            'genero' => $genero,
            'mretornado' => 0,
            'telefono' => $row[5],
            'email' => $row[6],
            'obispo' => '',
            'telobispo' => '',
            'fotodrive' => '',
            'anterior' => '',
            'pasatiempos' => '',
            'paciencia' => 0,
            'liderazgo' => 0,
            'ensenanza' => 0,
            'experiencia' => 0,
            'estado' => 5,
        ]);

        $user = User::create([
            'name' => $row[2]. ' ' . $row[3],
            'email' => $contacto->email,
            'password' => bcrypt('password'),
            'estado' => 1
        ]);
        $rol = $row['9'];
        $role = Role::where('name', $rol)->first();
        $funcion = '';
        if ($role) {
            $user->assignRole($rol);
        } else {
            $user->assignRole('Consejero');
            $rol = 'Consejero';
            $funcion = $row['9'];
        }

        $barrio = Barrio::where('nombre', 'like','%'.$row[8].'%')->first();

        if($barrio != null){
            $barrio = $barrio->id;
        } else {
            $barrio = 1;
        }

        $rtemplo = 0;
        $obs_rtemplo = $row[12];

        switch ($row[11]) {
            case 'Sí':
                $rtemplo = 1;
                break;
            case 'No':
                $rtemplo = 0;
                break;        
            default:
                # code...
                break;
        }

        $permiso_obispo = 0;
        if ($row[16] == 'Sí') {
            $permiso_obispo = 1;//aprobacion final
        }

        $preinscripcion = 0;
        
        switch ($row[10]) {
            case 'Sí':
                $preinscripcion = 1;
                break;
            case 'No':
                $preinscripcion = 0;
                break;        
            default:
                # code...
                break;
        }

        $personale = Personale::create([
            'permiso_obispo' => $permiso_obispo,
            'estado_rtemplo' => $rtemplo,
            'obs_rtemplo' => $obs_rtemplo,
            'preinscripcion' => $preinscripcion,
            'barrio_id' => $barrio,
            'contacto_id' => $contacto->id,
            'user_id' => $user->id,
        ]);


        switch ($row[13]) {
            case 'Sí':
                $d1 = 1;
                break;
            case 'No':
                $d1 = 0;
                break;        
            default:
                # code...
                break;
        }

        $d1 = 0;
        $d2 = 0;
        $d3 = 0;

        if ($row[15] == 'Sí') {
            $d1 = 1;
            $d2 = 1;
            $d3 = 1;
        } else {
            if ($row[14] == 'Sí') {
                $d1 = 1;
                $d2 = 1;
            } else {
                if ($row[13] == 'Sí') {
                    $d1 = 1;
                }
            }
        }

        if ($d1 == 1) {
            PersonaleVacuna::create([
                'personale_id' => $personale->id,
                'vacuna_id' => Vacuna::find(1)->id,
                'vacunado' => $d1,
            ]);
        }

        if ($d2 == 1) {
            PersonaleVacuna::create([
                'personale_id' => $personale->id,
                'vacuna_id' => Vacuna::find(2)->id,
                'vacunado' => $d1,
            ]);
        }

        if ($d3 == 1) {
            PersonaleVacuna::create([
                'personale_id' => $personale->id,
                'vacuna_id' => Vacuna::find(3)->id,
                'vacunado' => $d1,
            ]);
        }

        $inscripcione = Inscripcione::create([
            'personale_id' => $personale->id,
            'programa_id' => $this->programa,
            'funcion' => $funcion,
            'role_id' => Role::where('name', $rol)->first()->id,//consejero
            'estado' => 1,//Activo-Habilitado
            'fecha' => date('Y-m-d')
        ]);



        return null;
    }

    public function rules(): array
    {
        return [
            '3' => 'required',
            '4' => 'required',
            '6' => function($attribute, $value, $onFailure) {
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
