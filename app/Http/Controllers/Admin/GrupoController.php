<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Grupo;

class GrupoController extends Controller
{
    public function __construct(){
        $this->middleware('can:admin.grupos.index');//->only('index');
    }
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
        //return ;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Grupo $grupo)
    {



    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grupo $grupo)
    {
         $request->validate([
            'numero' => 'required',
        ]);
         
        $grupo->update($request->all());
        $programa = $grupo->programa;

        return redirect()->route('admin.programas.edit', compact('programa'))->with('info_grupo', 'Se actualizaron los datos del grupo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grupo $grupo)
    {

        foreach ($grupo->companerismos as $companerismo){
            $companerismo->delete();
        }

        $grupo->delete();

        return redirect()->route('admin.programas.edit', $grupo->programa)->with('info', 'El grupo se eliminó con éxito'); 
    }

    public function migrupo(){
        
    }
}
