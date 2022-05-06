<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\PersonalesExport;
use App\Imports\PersonalesImport;
use App\Models\Grupo;
use App\Models\Programa;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\ValidationException;

class ExcelController extends Controller
{
    public function personalesGrupo(Grupo $grupo){
        $alumExport = new PersonalesExport();
        return $alumExport->forGroup($grupo->id)->download('personales.xlsx');
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
}
