<?php

namespace App\Imports;

use App\Models\Barrio;
use App\Models\Contacto;
use App\Models\Funcione;
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
        if($row[0] == 'NOMBRES')
        {
            return null;
        }

        if($row[5] == 'No'){
            $mretornado = 0;
        }
        if($row[5] == 'Sí'){
            $mretornado = 1;
        } else {
            $mretornado = 0;
        }

        //genero
        if ($row[3] == 'V') {
            $genero = 'Hombre';
        }
        if ($row[3] == 'M') {
            $genero = 'Mujer';
        }

        $nombres = $row[0];
        $apellidos = $row[1];

        $contacto = Contacto::create([
            'nombres' => $nombres,
            'apellidos' => $apellidos,
            'fecnac' => Date::excelToDateTimeObject($row[2]) ,
            'genero' => $genero,
            'mretornado' => 0,
            'telefono' => str_replace(' ','',$row[4]),
            'email' => $row[5],
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
            'name' => $nombres. ' ' . $apellidos,
            'email' => $contacto->email,
            'password' => bcrypt('password'),
            'estado' => 1
        ]);
        $funcion = $row[8];
        $role = Role::where('name', $funcion)->first();
        $funcion = '';
        if ($role) {
            $user->assignRole($funcion);
        } else {
            $user->assignRole('Consejero');
            
            /*Funcione::create([
                'descripcion' => $funcion,
                'programa_id' => $this->programa
            ]);*/
            
        }

        $barrio = Barrio::where('nombre', 'like','%'.$row[7].'%')->first();

        if($barrio != null){
            $barrio = $barrio->id;
        } else {
            $barrio = 1;
        }

        $rtemplo = 0;
        $obs_rtemplo = $row[11];

        switch ($row[10]) {
            case 'Sí' || 'Si' || 'si' || 'sí' || 'SI' || 'sI' || 'sÍ':
                $rtemplo = 1;
                break;
            case 'No' || 'no' || 'NO':
                $rtemplo = 0;
                break;        
            default:
                # code...
                break;
        }

        $permiso_obispo = 0; //aprobacion final
        if ($row[12] == 'Aprobado') {
            $permiso_obispo = 2;//aprobacion final
        }
        if ($row[12] == 'Aprobación pendiente') {
            $permiso_obispo = 1;//aprobacion final
        }

        $preinscripcion = 0;
        
        switch ($row[9]) {
            case 'Sí' || 'Si' || 'si' || 'sí' || 'SI' || 'sI' || 'sÍ':
                $preinscripcion = 1;
                break;
            case 'No' || 'no' || 'NO':
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

/*
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
*/
        $inscripcione = Inscripcione::create([
            'personale_id' => $personale->id,
            'programa_id' => $this->programa,
            //'funcion' => $funcion,
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
