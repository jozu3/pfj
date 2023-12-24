<?php

namespace App\Http\Controllers\Admin;

use App\Exports\InscripcionesExport;
use App\Exports\ParticipantesExport;
use App\Http\Controllers\Controller;
use App\Imports\ParticipantesImport;
use Illuminate\Http\Request;
use App\Imports\PersonalesImport;
use App\Models\BarrioInfo;
use App\Models\Inscripcione;
use App\Models\Participante;
use App\Models\Programa;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\ValidationException;

class ExcelController extends Controller
{
    public function exportExcelPersonal(Programa $programa, $familia, $estaca, $estado, $rol){
        $inscripciones = new InscripcionesExport();
        return $inscripciones->programa($programa->id, $familia, $estaca, $estado, $rol)->download('inscripcionesPrograma.xlsx');
    }

    public function exportExcelParticipantes(Programa $programa, $compania, $estaca, $estado){
        // $inscripciones = new ParticipantesExport();
        // return $inscripciones->programa($programa->id, $compania, $estaca, $estado)->download('ParticipantesPrograma.xlsx');
    }


    public function importExcelPersonal(Request $request, Programa $programa){
        $file = $request->file('file');
        //return $file;

        try {
            Excel::import(new PersonalesImport($programa), $file);
            //$master = Excel::import(new MasterImport($auth), $request->file('master_upload'));
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            //dd($failures);
            
            $exception = ValidationException::withMessages(collect($failures)->map->toArray()->all());
            throw $exception;
            
            // foreach ($failures as $failure) {
            //      $failure->row(); // row that went wrong
            //      $failure->attribute(); // either heading key (if using heading row concern) or column index
            //      $failure->errors(); // Actual error messages from Laravel validator
            //      $failure->values(); // The values of the row that has failed.
            //  }
        }

        return back()->with('info', 'Importación de personal completada.');
    }

    public function importExcelParticipantes(Request $request, Programa $programa){
        $file = $request->file('file');
        //return $file;

        try {
            Excel::import(new ParticipantesImport($programa), $file);

            $inf = Participante::select('barrio_id', DB::raw('count(id) as cantidad'))
                            ->where('estado', '0') //inscritos
                            ->where('programa_id', $programa->id)
                            ->groupBy('barrio_id')->get();
            
                            
            foreach ($inf as $key => $value) {
                $barrio_id = $value->barrio_id;

                BarrioInfo::create([
                    'barrio_id' => $barrio_id,
                    'cupos' => $value->cantidad,
                    'programa_id' => $programa->id
                ]);
            }
            

        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            
            $exception = ValidationException::withMessages(collect($failures)->map->toArray()->all());
            throw $exception;
        }

        return back()->with('info', 'Importación de participantes completada.');
    }


    public function exportParticipantes(Programa $programa){
        $partis = new ParticipantesExport();
        return $partis->programa($programa->id)->download('ParticipantesPrograma.xlsx');
    }
}
