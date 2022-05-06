<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\Profesore;
use App\Models\User;
use App\Models\Unidad;
use App\Models\Grupo;
use Illuminate\Http\Request;

class ProfesoreController extends Controller
{
    public function __construct(){
        $this->middleware('can:admin.profesores.index');//->only('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.profesores.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.profesores.create');
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
            'nombres' => 'required',
            'apellidos' => 'required',
            'telefono' => 'required',
            'email' => 'required',
        ]);

        $name = $request->nombres . ' ' . $request->apellidos;
        
        $user = User::create([
                    'name' => $name,
                    'email' => $_POST['email'],
                    'password' => Hash::make('password'),
                    'estado' => 1
                ])->assignRole('Profesor');

        $request['user_id'] = $user->id;

        //dd($request);
        $profesore = Profesore::create($request->all());


        return redirect()->route('admin.profesores.index')->with('info', 'El profesor se creó correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profesore  $profesore
     * @return \Illuminate\Http\Response
     */
    public function show(Profesore $profesore)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profesore  $profesore
     * @return \Illuminate\Http\Response
     */
    public function edit(Profesore $profesore)
    {
        $grupos = Grupo::select('pfjs.nombre','grupos.fecha', 'grupos.estado', 'grupos.id', 'pfjs.id as idcurso')
                            ->join('grupos', 'grupos.grupo_id', '=', 'grupos.id')
                            ->join('pfjs', 'grupos.pfj_id', '=', 'pfjs.id')
                            ->where('grupos.profesore_id', $profesore->id)
                            ->groupBy('grupos.id', 'pfjs.nombre', 'grupos.fecha', 'grupos.estado', 'idcurso')
                            ->get();

        return view('admin.profesores.edit', compact('profesore', 'grupos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profesore  $profesore
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profesore $profesore)
    {
        $profesore->user->update(['email' => $request->email]);
        $profesore->update([
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'telefono' => $request->telefono,
        ]);


        return redirect()->route('admin.profesores.edit', compact('profesore'))->with('info', 'Los datos se guardaron correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profesore  $profesore
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profesore $profesore)
    {
        //
    }
}
