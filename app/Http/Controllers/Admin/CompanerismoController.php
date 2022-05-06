<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Companerismo;
use Illuminate\Http\Request;

class CompanerismoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'role_id' => 'required',
        ]);

        
        $companerismo = Companerismo::create($request->all());
        $programa = $companerismo->grupo->programa;
        $grupo = $companerismo->grupo;

        return redirect()->route('admin.programas.edit', compact('programa', 'grupo'))->with('info_comp', 'El compañerismo se creó con éxito'); 
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Companerismo  $companerismo
     * @return \Illuminate\Http\Response
     */
    public function show(Companerismo $companerismo)
    {
        //
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Companerismo  $companerismo
     * @return \Illuminate\Http\Response
     */
    public function edit(Companerismo $companerismo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Companerismo  $companerismo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Companerismo $companerismo)
    {
        if(!$request->organigrama){
            $request->validate([
                'role_id' => 'required',
            ]);
            
            $companerismo->update($request->all());
            $programa = $companerismo->grupo->programa;
            $grupo = $companerismo->grupo;
    
            
            return redirect()->route('admin.programas.edit', compact('programa', 'grupo'))->with('info_comp', 'El compañerismo se actualizó con éxito'); 
        }
        
        $companerismo->update([
            'grupo_id' => $request->grupo_id
        ]);
        return 'grupo editado';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Companerismo  $companerismo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Companerismo $companerismo)
    {
        //
    }
}
